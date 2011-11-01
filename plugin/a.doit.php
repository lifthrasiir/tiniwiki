<?php
############################################################
# TiniWiki version 0.1
#   WikiPlugin: doit action
#               version 0.01 (April 13, 2004)
# Script by Tokigun <zenith@tokigun.net>
############################################################

function plugin_ap_doit() {
	return TRUE;
}

function plugin_a_doit($pagename, $parameter) {
	global $wikiTheme;
	
	$_pagedata = array(
		"pagename" => "doit_".md5($parameter),
		"version" => 1,
		"author" => "anonymous",
		"authorip" => $_SERVER["REMOTE_ADDR"],
		"mtime" => time(),
		"tag" => "",
		"contents" => $parameter
	);
	echo syntax_parsing($_pagedata);
}
?>
