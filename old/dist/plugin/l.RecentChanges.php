<?php
############################################################
# TiniWiki version 0.1
#   WikiPlugin: RecentChanges
#               version 0.05d (April 13, 2004)
# Script by Tokigun <zenith@tokigun.net>
############################################################

function __plugin_l_RecentChanges_cmp($alpha, $beta) {
	if($alpha["mtime"] == $beta["mtime"]) return 0;
	return ($alpha["mtime"] > $beta["mtime"] ? -1 : 1);
}

function plugin_l_RecentChanges($attr, $text) {
	global $wikiPath;
	
	$plist = page_list();
	uasort($plist, "__plugin_l_RecentChanges_cmp");
	
	$result = "";
	$number = 0;
	$limit = (isset($attr["number"]) ? $attr["number"] : -1);
	foreach($plist as $page => $info) {
		$result .= "\x04<li\x04>\x04<a href=\"$wikiPath/".toki_urlencode($page)."\" class=\"link\"\x04>".
			syntax_escape($page)."\x04</a\x04> \x04<span class=\"mtime\"\x04>(".
			date("Y/m/d H:i:s", $info["mtime"]).")\x04</span\x04> ... ".
			"\x04<a href=\"$wikiPath/".rawurlencode($info["author"])."\" class=\"author\"\x04>".
			syntax_escape($info["author"])."\x04</a\x04>\x04</li\x04>\n";
		if($limit >= 0 && $limit <= ++$number) break;
	}
	$result = "\x00\x04</p\x04>\n\x04<ul class=\"pagelist\"\x04>\n$result\n\x04</ul\x04>\x04<p class=\"p\"\x04>";
	
	return syntax_escape_wikiword($result);
}
?>
