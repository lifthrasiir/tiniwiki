<?php
############################################################
## TiniWiki version 0.1
##   module: wikipage.php (page manipulation)
## Script by Tokigun <zenith@tokigun.net>
############################################################

function pagename_encode($str) {
	return str_replace("/", "-", str_replace("=", "", base64_encode($str)));
}

function pagename_decode($str) {
	return base64_decode($str);
}

function page_address($code, $page = "") {
	global $wikiData;
	
	if($page)
		return $wikiData."/$code.".pagename_encode($page).".php";
	else
		return $wikiData."/$code.php";
}

function page_cache() {
	global $wikiPageCache;
	
	$_pagecache = page_address("pll");
	$fp = fopen($_pagecache, "r");
	$wikiPageCache = fread($fp, filesize($_pagecache));
	$wikiPageCache = substr($wikiPageCache, strpos($wikiPageCache, "\r\n") + 2);
	fclose($fp);
}

function page_list() {
	$_page = page_address("pl");
	if(!is_readable($_page))
		return NULL;
	
	$plist = array();
	$pagelist = @file($_page);
	$_pagelist = count($pagelist);
	for($i=1;$i<$_pagelist;$i++) {
		if(($record = rtrim($pagelist[$i], "\r\n")) == "") continue;
		$record = explode("\t", $record);
		
		$plist[base64_decode($record[0])] = array(
			"version" => intval($record[1]),
			"author" => base64_decode($record[2]),
			"authorip" => $record[3],
			"mtime" => intval($record[4]),
			"tag" => base64_decode($record[5])
		);
	}
	
	return $plist;
}

function page_list_update($pagename, $newline) {
	$_pagelist = page_address("pl");
	
	$result = "";
	$_line = base64_encode($pagename)."\t";
	$fp = fopen($_pagelist, "r");
	while(!feof($fp)) {
		$line = fgets($fp, 1024);
		if(substr($line, 0, strlen($_line)) == $_line) break;
		$result .= $line;
	}
	$result .= $newline;
	while(!feof($fp))
		$result .= fread($fp, 1024);
	fclose($fp);
	
	file_write($_pagelist, "w", $result);
	
	return TRUE;
}

function page_npages() {
	global $wikiPageCache;
	if(!isset($wikiPageCache)) page_cache();
	return (substr_count($wikiPageCache, "|") - 1);
}

function page_exists($page) {
	global $wikiPageCache;
	if(!isset($wikiPageCache)) page_cache();
	return (strpos($wikiPageCache, "|".base64_encode($page)."|") !== FALSE);
}

function page_history($page) {
	$_page = page_address("ph", $page);
	if(!is_readable($_page))
		return NULL;
	
	$pagehist = @file($_page);
	$_pagehist = count($pagehist);
	$pageinfo = explode("\t", rtrim($pagehist[1], "\r\n"));
	
	$history = array();
	$version = $mtime = 0;
	for($i=2;$i<$_pagehist;$i++) {
		$record = explode("\t", rtrim($pagehist[$i], "\r\n"));
		if($record[0] <= 0) continue;
		
		$record[0] = intval($record[0]);
		$record[3] = intval($record[3]);
		$history[$record[0]] = array(
			"author" => base64_decode($record[1]),
			"authorip" => $record[2],
			"mtime" => $record[3],
			"tag" => base64_decode($record[4])
		);
		
		if($version < $record[0])
			$version = $record[0];
		if($mtime < $record[3])
			$mtime = $record[3];
	}
	
	$result = array(
		"pagename" => base64_decode($pageinfo[0]),
		"version" => $version,
		"tag" => base64_decode($pageinfo[1]),
		"history" => $history
	);
	return $result;
}

function page_read($page, $version = NULL) {
	$_page = page_address(is_null($version) ? "pc" : "p$version", $page);
	if(!is_readable($_page))
		return NULL;
	
	$fp = fopen($_page, "r");
	$contents = fread($fp, filesize($_page));
	fclose($fp);
	
	preg_match("/^(?:[^\r]*)\r\n([^\r]*)\r\n(.*)$/s", $contents, $match);
	unset($contents);
	$info = explode("\t", $match[1], 6);
	$result = array(
		"pagename" => base64_decode($info[0]),
		"version" => intval($info[1]),
		"author" => base64_decode($info[2]),
		"authorip" => $info[3],
		"mtime" => intval($info[4]),
		"tag" => base64_decode($info[5]),
		"contents" => $match[2]
	);
	
	return $result;
}

function page_write($pagename, $author, $contents, $links, $tag = "") {
	global $wikiDataEscape;
	
	$_history = page_address("ph", $pagename);
	$r_pagename = base64_encode($pagename);
	$r_author = base64_encode($author);
	$r_authorip = $_SERVER["REMOTE_ADDR"];
	$r_time = time();
	$r_tag = base64_encode($tag);
	if(!page_exists($pagename)) {
		$version = 1;
		file_write($_history, "w",
			"$wikiDataEscape\r\n$r_pagename\t\n".
			"1\t$r_author\t$r_authorip\t$r_time\t$r_tag\n"
		);
		file_write(page_address("pll"), "a", "$r_pagename|");
	} else {
		$pagehist = page_history($pagename);
		$version = $pagehist["version"] + 1;
		file_write($_history, "a",
			"$version\t$r_author\t$r_authorip\t$r_time\t$r_tag\n"
		);
	}
	page_list_update($pagename,
		"$r_pagename\t$version\t$r_author\t$r_authorip\t$r_time\t$r_tag\n"
	);
	
	// to do
	$header =
		base64_encode($pagename)."\t".
		"$version\t".
		base64_encode($author)."\t".
		$_SERVER["REMOTE_ADDR"]."\t".
		time()."\t".
		base64_encode($tag);
	$result = "$wikiDataEscape\r\n$header\r\n$contents";
	
	file_write(page_address("pc", $pagename), "w", $result);
	file_write(page_address("p$version", $pagename), "w", $result);
	
	page_link_update($pagename, $links);
	
	return 0;
}

function page_link_read($page, $type) {
	$_page = page_address($type ? "plf" : "plt", $page);
	if(!is_readable($_page))
		return array();
	
	$pagelink = @file($_page);
	$_pagelink = count($pagelink);
	
	$links = array();
#       $_number = intval($pagelink[1]);        // not used
	for($i=2;$i<$_pagelink;$i++) {
		$record = explode("\t", rtrim($pagelink[$i], "\r\n"));
		if($record[1] <= 0) continue;
		
		$links[base64_decode($record[0])] = intval($record[1]);
	}
	
	return $links;
}

function page_link_update_once($page, $pagelink, $type) {
	global $wikiDataEscape;
	
	$_page = page_address($type ? "plf" : "plt", $page);
	if(count($pagelink) > 0) {
		$contents = "$wikiDataEscape\r\n".count($pagelink)."\n";
		foreach($pagelink as $_pagename => $_pagenumber)
			$contents .= base64_encode($_pagename)."\t$_pagenumber\n";
		file_write($_page, "w", $contents);
	} else {
		@unlink($_page);
	}
	
	return TRUE;
}

function page_link_update($page, $pagelink) {
	global $wikiDataEscape;
	
	$oldpagelink = array_keys(page_link_read($page, TRUE));
	page_link_update_once($page, $pagelink, TRUE);
	$pagelink = array_keys($pagelink);
	$_newlink = array_diff($pagelink, $oldpagelink);
	$_prevlink = array_diff($oldpagelink, $pagelink);
	
	foreach($_newlink as $_pagename) {
		$xpagelink = page_link_read($_pagename, FALSE);
		$xpagelink[$page] = 1;
		page_link_update_once($_pagename, $xpagelink, FALSE);
	}
	foreach($_prevlink as $_pagename) {
		$xpagelink = page_link_read($_pagename, FALSE);
		unset($xpagelink[$page]);
		page_link_update_once($_pagename, $xpagelink, FALSE);
	}
	
	return TRUE;
}
?>
