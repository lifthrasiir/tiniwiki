<?php
## TiniWiki version 0.1 [module: wikiengine.php]
## Copyright (c) 2004, Kang Seonghoon (Tokigun).
## This software is distributed under the GNU Public License.

class TiniWikiParser {
	function TiniWikiParser() {
	}
}

////////////////////////////////////////////////////////////////////////////////

function syntax_escape($str) {
	return strtr(syntax_escape_netlink($str), array(
		"\\"=>"\x03", "__"=>"\\__", "''"=>"\\''", "["=>"\\[", "]"=>"\\]",
		"<?"=>"\\<?", "%%%"=>"\\%%%", "`"=>"\\`", "|"=>"\\|", ":"=>"\\:",
		"//"=>"\\//", "/*"=>"\\/*", "{"=>"\\{", "}"=>"\\}"
	));
}

function syntax_escape_block($str) {
	return str_replace(":", "\\:", $str);
}

function syntax_escape_netlink($str) {
	global $netLink;
	
	return preg_replace("#$netLink#", "\x05\x05\\1", $str);
}

function syntax_escape_special($str) {
	return strtr($str, array(
		"\\"=>"",
		"\x00"=>"", "\x01"=>"", "\x02"=>"", "\x03"=>"\\", "\x04"=>"",
		"\x05"=>"", "\x0E"=>"<p class=\"p\">", "\x0F"=>"</p>"
	));
}

function syntax_escape_wikiword($str) {
	global $wikiWord;
	
	return preg_replace("#$wikiWord#", "\x05\x05\\1",
		str_replace("\x01", "", str_replace("\x02", "", $str)));
}

function syntax_escape_4attribute($str) {
	return str_replace("&", "\x04&", htmlspecialchars(
		syntax_escape_wikiword(syntax_escape(syntax_escape_special($str)))
	));
}

function syntax_escape_4attribute_post($str) {
	return str_replace("&", "\x04&", htmlspecialchars(
		syntax_escape_wikiword(syntax_escape($str))
	));
}

function syntax_unescape($str) {
	return strtr($str, array(
		"\\["=>"[", "\\]"=>"]", "__"=>"\\__", "''"=>"\\''", "\\<?"=>"<?",
		"\\%%%"=>"%%%", "\\`"=>"`", "\\|"=>"|", "\\:"=>":", "\\/*"=>"/*",
		"\\//"=>"//", "\\{"=>"{", "\\}"=>"}",
		
		"\\"=>"", "\\\\"=>"\\",
		"\x00"=>"", "\x01"=>"", "\x02"=>"", "\x03"=>"\\", "\x04"=>"",
		"\x05"=>"", "\x0E"=>"", "\x0F"=>""
	));
}

function syntax_unescape_entity($str) {
	return strtr($str, array(
		"&nbsp;"=>" ", "&lt;"=>"<", "&gt;"=>">", "&quot;"=>"\"", "&amp;"=>"&", "\x04"=>""
	));
}

////////////////////////////////////////////////////////////////////////////////

function syntax_image($matches) {
	global $bs, $netLink_default, $netLink_protocol;
	
	preg_match("/^(.+?)(?:(?<!$bs)\|(.+?))?$/", $matches, $image);
	$address = $image[1];
	if(!($anchor = $image[2])) $anchor = $address;
	
	if(!preg_match("#^(?:$netLink_protocol)#", $address)) {
		$address = $netLink_default.$address;
	}
	$address = syntax_escape_4attribute($address);
	$anchor = syntax_escape_4attribute($anchor);
	return syntax_escape_block("\x04<img src=\"$address\" alt=\"$anchor\" /\x04>");
}

function syntax_link($matches) {
	global $bs, $wikiPath, $interwikimap;
	global $pageLink;
	
	preg_match("/^(?:(.+?)(?<!$bs)\|)?((?:(.+?)(?<!$bs):)?(.+?))$/", $matches, $link);
	if(!($anchor = $link[1])) $anchor = $link[2];
	$page = syntax_unescape(str_replace("\\:", ":", $link[2]));
	$interwiki_site = syntax_escape_special(strtr($link[3], array("\\:"=>":", "\\|"=>"|")));
	$interwiki_page = syntax_escape_special(strtr($link[4], array("\\:"=>":", "\\|"=>"|")));
	
	$anchor = str_replace("&", "\x04&", syntax_escape(syntax_escape_special($anchor)));
	if(array_key_exists($interwiki_site, $interwikimap)) {
		$_page = $interwikimap[$interwiki_site];
		$__page = syntax_escape_4attribute_post(str_replace("%s", $interwiki_page, $_page));
		return syntax_escape_block("\x04<a href=\"$__page\" class=\"interwiki\"\x04>$anchor\x04</a\x04>");
	} else {
		if(isset($pageLink[$page])) $pageLink[$page]++; else $pageLink[$page] = 1;
		$_page = syntax_unescape_entity($page);
		
		if(page_exists($_page)) {
			$__page = syntax_escape_4attribute_post("$wikiPath/".toki_urlencode($_page));
			return syntax_escape_block("\x04<a href=\"$__page\" class=\"link\"\x04>$anchor\x04</a\x04>");
		} else {
			$__page = syntax_escape_4attribute_post("$wikiPath/".toki_urlencode($_page)."?edit=1");
			return syntax_escape_block("\x04<a href=\"$__page\" class=\"no_link\"\x04>$anchor\x04</a\x04>");
		}
	}
}

function syntax_netlink($matches) {
	global $bs, $netLink_default, $netLink_protocol;
	
	preg_match("/^(?:(.+?)(?<!$bs)\|)?(.+?)$/", $matches, $netlink);
	if(!($anchor = $netlink[1])) $anchor = $netlink[2];
	$address = $netlink[2];
	
	if(!preg_match("#^(?:$netLink_protocol)#", $address)) {
		$address = $netLink_default.$address;
	}
	$address = syntax_escape_4attribute(syntax_unescape_entity($address));
	$anchor = str_replace("&", "\x04&", syntax_escape(syntax_escape_special($anchor)));
	return syntax_escape_block("\x04<a href=\"$address\" class=\"netlink\"\x04>$anchor\x04</a\x04>");
}

function syntax_html($mode, $tag, $property) {
	global $wikiHTMLblock;
	
	$_tag = $tag = strtolower($tag);
	if($tag{0} == "/") $_tag = substr($_tag, 1);
	$_block = in_array($_tag, $wikiHTMLblock);
	
	$property = str_replace("\\\"", "\"", $property);
	preg_match_all("/([a-z]+)(?:\s*=\s*(?:\"([^\"]*)\"|'([^']*)'|(\S*)))?/is", $property, $_property, PREG_SET_ORDER);
	$property = "";
	$prophash = array();
	foreach($_property as $value) {
		if($prophash[$value[1] = strtolower($value[1])]) continue;
		$prophash[$value[1]] = 1;
		$_value = syntax_unescape_entity($value[count($value) - 1]);
		
		$property .= " $value[1]=\"".syntax_escape_4attribute($_value ? $_value : $value[1])."\"";
	}
	
	if($mode) {
		if($tag{0} == "/") {
			return syntax_escape_block("\x04<$tag$property\x04>".($_block ? "\x0E" : ""));
		} else {
			return syntax_escape_block(($_block ? "\x0F" : "")."\x04<$tag$property\x04>");
		}
	} elseif($_block) {
		return syntax_escape_block("\x0F$br\x04<$tag$property /\x04>$br\x0E");
	} else {
		return syntax_escape_block("\x04<$tag$property /\x04>");
	}
}

function syntax_entity($entity, &$pagedata) {
	global $wikiVersion, $wikiRoot, $wikiTheme;
	
	switch($entity) {
	case "tiniwiki.name":
		return "TiniWiki";
	case "tiniwiki.author":
		return "Tokigun (Kang Seonghoon)";
	case "tiniwiki.Version":
		return $wikiVersion;
	case "tiniwiki.version";
		$_wikiVersion = explode("/", $wikiVersion, 2);
		return $_wikiVersion[0];
	
	case "path":
		return "http://$_SERVER[HTTP_HOST]$wikiRoot/wiki.php";
	case "path.host":
		return "http://$_SERVER[HTTP_HOST]";
	case "path.root":
		return "http://$_SERVER[HTTP_HOST]$wikiRoot";
	case "path.theme":
		return "http://$_SERVER[HTTP_HOST]$wikiRoot/$wikiTheme";
	
	case "npage";
	case "npages";
	case "nPages":
		return page_npages();
	
	case "pagename":
		return $pagedata["pagename"];
	case "PageName":
	case "pagename.asis":
		return syntax_escape_wikiword(syntax_escape($pagedata["pagename"]));
	case "pagename.url":
		return toki_urlencode($pagedata["pagename"]);
	
	case "author":
		return $pagedata["author"];
	case "author.asis":
		return syntax_escape_wikiword(syntax_escape($pagedata["author"]));
	case "author.url":
		return toki_urlencode($pagedata["author"]);
	
	#case "Author":
	#case "Author.asis":
	#case "Author.url":
	
	#case "cauthor":
	#case "cauthor.asis":
	#case "cauthor.url":
	
	#case "user":
	#case "user.asis":
	#case "user.url":
	case "userip":
		return $_SERVER["REMOTE_ADDR"];
	
	case "version":
		return $pagedata["version"];
	#case "Version":
	
	case "mtime":
		return date("Y-m-d H:i:s", $pagedata["mtime"]);
	#case "mTime":
	#case "ctime":
	
	case "yyyy":
		return date("Y");
	case "mm":
		return date("m");
	case "m":
		return date("n");
	case "dd":
		return date("d");
	case "d":
		return date("j");
	case "hh":
		return date("H");
	case "h":
		return date("G");
	case "nn":
		return date("i");
	case "ss":
		return date("s");
	case "today":
		return date("Y-m-d");
	case "now":
		return date("Y-m-d H:i:s");
	
	case "lt":
		return "\x04&lt;";
	case "gt":
		return "\x04&gt;";
	case "amp":
		return "\x04&amp;";
	case "quot";
		return "\x04&quot;";
	case "nbsp":
		return "\x04&nbsp;";
	
	default:
		return "&$entity;";
	}
}

function syntax_plugin($type, $command, $property, $innertext) {
	preg_match_all("#([a-z]+)=\"([^\"]*)\"#", $property, $_property, PREG_SET_ORDER);
	$attr = array();
	foreach($_property as $item)
		$attr[$item[1]] = syntax_unescape_entity($item[2]);
	
	return call_user_func("plugin_${type}_$command", $attr, $innertext);
}

////////////////////////////////////////////////////////////////////////////////

function syntax_linear($contents) {
	global $bs;
	static $blockdata = array(
		-1 => array("", "", "", "", "", "", "", "", "", "", "", ""),
		0 => array(
			"",
			"\x04<p class=\"p\"\x04>",
			"\x00\x04</p\x04>",
			"",
			"\x00\x04</p\x04>\n\x04<p class=\"p\"\x04>",
			"\x00\x04</p\x04>",
			"\x04<p class=\"p\"\x04>",
			"",
			"",
			"",
			""
		),
		1 => array(
			"\x04<ul class=\"ul\"\x04>\x04<li class=\"li\"\x04>",
			"",
			"",
			"\x04</li\x04>\x04</ul\x04>",
			"\x04</li\x04>\n\x04<li class=\"li\"\x04>",
			"",
			"\x04</li\x04>\x04<li class=\"li\"\x04>",
			"",
			"",
			"\x04<ul class=\"ul_invisible\"\x04>\x04<li class=\"li_invisible\"\x04>",
			""
		),
		2 => array(
			"\x04<ol class=\"ol\"\x04>\x04<li class=\"li\"\x04>",
			"",
			"",
			"\x04</li\x04>\x04</ol\x04>",
			"\x04</li\x04>\n\x04<li class=\"li\"\x04>",
			"",
			"\x04</li\x04>\x04<li class=\"li\"\x04>",
			"",
			"",
			"\x04<ol class=\"ol_invisible\"\x04>\x04<li class=\"li_invisible\"\x04>",
			""
		),
		3 => array(
			"\x04<blockquote class=\"blockquote\"\x04>",
			"\x04<p class=\"p\"\x04>",
			"\x04</p\x04>",
			"\x04</blockquote\x04>\n",
			"\x04</p\x04>\x04</blockquote\x04>\n\x04<blockquote class=\"blockquote\"\x04>\x04<p class=\"p\"\x04>",
			"\x04</p\x04>",
			"\x04<p class=\"p\"\x04>",
			"\x04</p\x04>",
			"\x04<p class=\"p\"\x04>",
			"\x04<blockquote class=\"blockquote\"\x04>",
			""
		),
		4 => array(
			"\x04<dl class=\"dl\"\x04>\x04<dt\x04>",
			"",
			"",
			"\x04</dd\x04>\x04</dl\x04>",
			"\x04</dd\x04>\x04<dt\x04>",
			"",
			"\x04</dd\x04>\x04<dt\x04>",
			"",
			"",
			"\x04<dl class=\"dl\"\x04>\x04<dt\x04>\x04</dt\x04>\x04<dd\x04>",
			"\x04</dt\x04>\x04<dd\x04>"
		)
	);
	
	$_contents = explode("\n", $contents);
	$_ncontents = count($_contents);
	$contents = "";
	$listing = -1;
	$listpre = $listtable = 0;
	for($i=0;$i<$_ncontents;$i++) {
		$plisting = $listing;
		$plistdepth = $listdepth;
		
		$line = $_contents[$i];
		$listupdate = TRUE;
		$listing = -1;
		$linelen = strlen($line);
		if(!$listpre && strspn($line, "{") == $linelen && $linelen > 1) {
			$listpre = $linelen;
			$listpreex = str_repeat("}", $linelen);
			if($plisting == 3) {
				$listing = $plisting;
				$listdepth = $plistdepth;
				$contents .= $blockdata[$plisting][2];
			} else {
				$contents .= $blockdata[$plisting][2].str_repeat($blockdata[$plisting][3], $plistdepth);
			}
			$contents .= "\n\x04<pre class=\"pre\"\x04>";
			
			continue;
		} elseif($listpre) {
			if($line == $listpreex) {
				$listpre = 0;
				$contents .= "\n\x04</pre\x04>";
				if($plisting >= 0) {
					$listing = $plisting;
					$listdepth = $plistdepth;
					$contents .= $blockdata[$plisting][1];
				}
			} else {
				$listing = $plisting;
				$listdepth = $plistdepth;
				$contents .= "\n".
					str_replace("\x0E", "\x04<pre class=\"pre\"\x04>",
					str_replace("\x0F", "\x04</pre\x04>",
						$line));
			}
			
			continue;
		} elseif(!$listtable && strspn($line, "|") > 1) {
			$contents .=
				$blockdata[$plisting][2].str_repeat($blockdata[$plisting][3], $plistdepth).
				"\n\x04<table class=\"table\"\x04>\n";
			$listtable = 1;
		} elseif($listtable) {
			if(strspn($line, "|") < 2) {
				$contents .= ($listtable == 1 ? "" : "\x04</tr\x04>\n")."\x04</table\x04>\n";
				$listtable = 0;
			}
		}
		
		if($listtable) {
			if($listtable == 1)
				$contents .= "\x04<tr\x04>\n";
			
			$line = preg_split("#(?<!$bs|\|)\|\|#", $line);
			$_line = count($line);
			for($j=1;$j<$_line;$j++) {
				if($j == $_line-1 && trim($line[$j]) == "") break;
				
				$line[$j] = substr($line[$j], $_colspan = strspn($line[$j], "|"));
				$line[$j] = substr($line[$j], $_rowspan = strspn($line[$j], "\x05"));
				$_style = $line[$j]{0};
				$_style = ($_style=="<" ? "left" : $_style==">" ? "right" : $_style=="^" ? "center" : "");
				if($_style) $line[$j] = substr($line[$j], 1);
				
				if(preg_match("#^\{(.*?)(?<!$bs)\}(.*)$#", $line[$j], $m)) {
					$_attribute = " ".str_replace("\x00", "\"",
						syntax_escape_4attribute_post(syntax_unescape_entity(
							strtr($m[1], array("\\{"=>"{", "\\}"=>"}", "\""=>"\x00"))
						))
					); // to do?!
					$line[$j] = $m[2];
				} else {
					$_attribute = "";
				}
				
				$contents .= "\x04<td".
					($_colspan ? " colspan=\"".($_colspan+1)."\"" : "").
					($_rowspan ? " rowspan=\"".($_rowspan+1)."\"" : "").
					($_style ? " style=\"text-align:$_style;\"" : "").
					"$_attribute\x04>\x04<p class=\"p\"\x04>".
					str_replace("\x0E", "",
					str_replace("\x0F", "",
						$line[$j]
					))."\x04</p\x04>\x04</td\x04>\n";
			}
			
			if($j != $_line) {
				$listtable = 1;
				$contents .= "\x04</tr\x04>\n";
			} else {
				$listtable = 2;
			}
		} else {
			if($line{0} == "*" || $line{0} == "#" || $line{0} == ">") {
				$listing = strpos(" *#>", $line{0});
				$listdepth = strspn($line, $line{0});
				$line = substr($line, $listdepth);
			} elseif($line{0} == ";") {
				$listing = 4;
				$listdepth = strspn($line, ";");
				$line = substr($line, $listdepth);
				if(preg_match("/^(.*?)(?<!$bs):(.*)$/", $line, $m)) {
					$line = array($m[1], $m[2]);
				} else {
					$listing = ($plisting<0 ? 0 : $plisting);
					$listupdate = FALSE;
				}
			} elseif($line{0} == "!") {
				$listdepth = strspn($line, "!");
				if($listdepth > 6) $listdepth = 6;
				$line = substr($line, $listdepth);
				
				$contents .= $blockdata[$plisting][2].str_repeat($blockdata[$plisting][3], $plistdepth);
				$contents .= "\n\x04<h$listdepth class=\"heading\"\x04>$line\x04</h$listdepth\x04>";
				
				continue;
			} elseif(strspn($line, "-") == $linelen && $linelen > 2) {
				$contents .= $blockdata[$plisting][2].str_repeat($blockdata[$plisting][3], $plistdepth);
				$contents .= "\n\x04<hr class=\"hr\" /\x04>";
				
				continue;
			} elseif($line != "") {
				$listing = ($plisting<0 ? 0 : $plisting);
				$listupdate = FALSE;
				$line = preg_replace("#$bs(left|right|center)(?![A-Za-z0-9_-]|\s*$)#",
					"\x00\x04</p\x04>\n\x04<p class=\"p\" style=\"text-align:\\1;\"\x04>", $line);
			}
			
			if($listing != $plisting) {
				$contents .=
					$blockdata[$plisting][2].str_repeat($blockdata[$plisting][3], $plistdepth).
					($listdepth > 0 ? str_repeat($blockdata[$listing][9], $listdepth - 1) : "").
					$blockdata[$listing][0].$blockdata[$listing][1];
			} elseif($listupdate) {
				if($plistdepth > $listdepth) {
					$contents .=
						$blockdata[$listing][5].
						str_repeat($blockdata[$listing][3], $plistdepth - $listdepth).
						$blockdata[$listing][6];
				} elseif($plistdepth < $listdepth) {
					$contents .=
						$blockdata[$listing][7].
						str_repeat($blockdata[$listing][9], $listdepth - $plistdepth - 1).
						$blockdata[$listing][0].$blockdata[$listing][8];
				} else {
					$contents .= $blockdata[$listing][4];
				}
			}
			
			if(is_array($line)) {
				$contents .=
					str_replace("\x0E",
						($listdepth > 0 ? str_repeat($blockdata[$listing][9], $listdepth - 1) : "").
						$blockdata[$listing][0].$blockdata[$listing][1],
					str_replace("\x0F",
						$blockdata[$listing][10].$blockdata[$listing][2].
						str_repeat($blockdata[$listing][3], $listdepth),
						$line[0])).
					$blockdata[$listing][10].
					str_replace("\x0E",
						($listdepth > 0 ? str_repeat($blockdata[$listing][9], $listdepth - 1) : "").
						$blockdata[$listing][0].$blockdata[$listing][1].$blockdata[$listing][10],
					str_replace("\x0F",
						$blockdata[$listing][2].str_repeat($blockdata[$listing][3], $listdepth),
						$line[1]))."\n";
			} else {
				$contents .=
					str_replace("\x0E",
						($listdepth > 0 ? str_repeat($blockdata[$listing][9], $listdepth - 1) : "").
						$blockdata[$listing][0].$blockdata[$listing][1],
					str_replace("\x0F",
						$blockdata[$listing][2].str_repeat($blockdata[$listing][3], $listdepth),
						$line))."\n";
			}
		}
	}
	if($listpre) {
		$contents .= "\x04</pre\x04>";
	} elseif($listtable) {
		$contents .= ($listtable == 2 ? "\x04</tr\x04>" : "")."\x04</table\x04>";
	} elseif($listing >= 0) {
		$contents .= $blockdata[$listing][2].str_repeat($blockdata[$listing][3], $listdepth);
	}
	
	return $contents;
}

function syntax_linear_plugin($contents, $type) {
	global $bs, $plugins;
	
	$_plugin = $plugins["_$type"];
	if($plugins["_${type}x"])
		$_plugin .= ($_plugin ? "|" : "")."/?(?:".$plugins["_${type}x"].")";
	if(!$_plugin) return $contents;
	
	$contents = preg_split("#(?<!$bs)<\?($_plugin)((?: +[a-z0-9_-]+=\"[^\"]*\")*)>#ie", $contents, -1, PREG_SPLIT_DELIM_CAPTURE);
	$ncontents = count($contents) - 1;
	
	$stack = $pstack = array();
	$nstack = 0;
	for($i=0;$i<$ncontents;$i+=3) {
		$stack[$nstack] .= $contents[$i];
		if($contents[$i+1] == "/".$pstack[$nstack][0]) {
			$stack[$nstack-1] .= syntax_plugin("${type}x", $pstack[$nstack][0], $pstack[$nstack][1], $stack[$nstack]);
			unset($stack[$nstack--]);
		} elseif(in_array($contents[$i+1], $plugins[$type])) {
			$stack[$nstack] .= syntax_plugin($type, $contents[$i+1], $contents[$i+2], "");
		} else {
			$pstack[++$nstack] = array($contents[$i+1], $contents[$i+2]);
		}
	}
	
	$stack[$nstack] .= $contents[$ncontents];
	for(;$nstack>0;$nstack--)
		$stack[$nstack - 1] = syntax_plugin("${type}x", $pstack[$nstack][0], $pstack[$nstack][1], $stack[$nstack]);
	return $stack[0];
}

////////////////////////////////////////////////////////////////////////////////

function syntax_parsing($pagedata, $_linkparsing = FALSE) {
	global $wikiWord, $netLink, $bs, $wikiHTMLsingle, $wikiHTMLdouble;
	global $pageLink, $plugins;
	
	$pageLink = array();
	$contents = $pagedata["contents"];
	$contents = str_replace(toki_newline($contents), "\n", $contents);
	
	$contents = syntax_linear_plugin($contents, "i");
	$contents = str_replace("\\\\", "\x03", $contents);
	$contents = str_replace("`", "\x05", $contents);
	$contents = str_replace("\\\x05", "`", $contents);
	$contents = preg_replace("#(?<!$bs)/\*.*?(?<!$bs)\*/#s", "", $contents);
	$contents = preg_replace("#(?<!$bs|:|/)//.*$#m", "", $contents);
	$contents = preg_replace("#(?<!$bs)<($wikiHTMLsingle)(?![0-9a-z])([^>]*)>#ie", "syntax_html(FALSE, \"\\1\", \"\\2\")", $contents);
	$contents = preg_replace("#(?<!$bs)<(/?(?:$wikiHTMLdouble))(?![0-9a-z])([^>]*)>#ie", "syntax_html(TRUE, \"\\1\", \"\\2\")", $contents);
	$contents = preg_replace("#(?<!$bs)&([0-9A-Za-z.]+);#e", "syntax_entity(\"\\1\", \$pagedata);", $contents);
	$contents = preg_replace("#(?<!$bs)\[\[\|(.+?)(?<!$bs)\|\]\]#e", "syntax_image(\"\\1\")", $contents);
	$contents = preg_replace("#(?<!^\x05|\n\x05|[^a-zA-Z]\x05)$wikiWord#s", "\x01\\1\x02", $contents);
	$contents = preg_replace("#(?<!$bs)\[\[(.+?)(?<!$bs)\]\]#e", "syntax_netlink(\"\\1\")", $contents);
	$contents = preg_replace("#(?<!^\x05|\n\x05|\s\x05|\x05\x05)$netLink#es", "syntax_netlink(\"\\1\")", $contents);
	$contents = preg_replace("#(?<!$bs|\[)\[(.+?)(?<!$bs)\]#e", "syntax_link(\"\\1\")", $contents);
	$contents = preg_replace("#\x01([^\x01\x02\x05]+)\x02#e", "syntax_link(\"\\1\")", $contents);
	
	if($_linkparsing) return $pageLink;
	
	$contents = preg_replace("#(?<!$bs)''(.+)(?<!$bs)''#U", "\x04<i\x04>\\1\x04</i\x04>", $contents);
	$contents = preg_replace("#(?<!$bs)__(.+)(?<!$bs)__#U", "\x04<b\x04>\\1\x04</b\x04>", $contents);
	$contents = preg_replace("#(?<!$bs)%%%#", "\x04<br class=\"br\" /\x04>", $contents);
	$contents = preg_replace("#(?<!$bs|\{)\{\{(.+)(?<!$bs|\})}}#U", "\x04<tt class=\"tt\"\x04>\\1\x04</tt\x04>", $contents);
	
	$contents = syntax_linear_plugin($contents, "r");
	$contents = syntax_linear($contents);
	$contents = syntax_linear_plugin($contents, "l");
	
	$contents = str_replace("\\", "", $contents);
	$contents = str_replace("\x03", "\\", $contents);
	$contents = str_replace("\x05", "", $contents);
	$contents = str_replace("&", "&amp;", $contents);
	$contents = str_replace("<", "&lt;", $contents);
	$contents = str_replace(">", "&gt;", $contents);
	$contents = str_replace("\x04&lt;", "<", $contents);
	$contents = str_replace("\x04&gt;", ">", $contents);
	$contents = str_replace("\x04&amp;", "&", $contents);
	$contents = str_replace("\x04", "", $contents);
	
	// o/ox-type plugins must be here.
	
	$contents = preg_replace("#<p class=\"p\"[^>]*>\n*\\x00</p>#s", "", $contents);
	$contents = str_replace("\x00", "", $contents);
	
	return $contents;
}

# vim: ts=4 sw=4
?>
