<?php
############################################################
## TiniWiki version 0.1.-143 (April 20, 2004)
## Script by Tokigun <zenith@tokigun.net>
############################################################

include "config.php";
include "wikilib.php";
include "wikipage.php";
include "wikiengine.php";

$wikiVersion = "0.1.-143";
$bs = "\\\\";
$wikiPath = "$wikiRoot/wiki.php";

////////////////////////////////////////////////////////////////////////////////

_elaspedtime();
$plugins = preprocess_load_plugins();
$interwikimap = preprocess_parse_interwiki();
$info = preprocess_parse_path();

if(!$info["page"]) $info["page"] = $wikiFrontPage;
if(!$info["action"]) $info["action"] = "view";

$page = $info["page"];
$PAGE = toki_urlencode($page);
if($info["action"] == "view") {
	$version = intval($info["option"]);
	$pagedata = page_read($page, $version ? $version : NULL);
	if(is_null($pagedata)) {
		if($version) {
			$pagedata = page_read($page);
			if(is_null($pagedata)) {
				header("Location: $wikiPath/$PAGE?edit=1");
			} else {
				header("Location: $wikiPath/$PAGE");
			}
		} else {
			header("Location: $wikiPath/$PAGE?edit=1");
		}
	} else {
		include "$wikiTheme/header.php";
		include "$wikiTheme/view.php";
		include "$wikiTheme/footer.php";
	}
} elseif($info["action"] == "edit") {
	$version = intval($info["option"]);
	$pagedata = page_read($page);
	if($pagedata["version"] >= $version) {
		$is_conflicted = TRUE;
	} else {
		$is_conflicted = FALSE;
	}
	
	if($_POST["submit"] && !$_POST["preview"] && !$is_conflicted) {
		$contents = $_POST["contents"];
		if(get_magic_quotes_gpc())
			$contents = stripslashes($contents);
		
		$pagedata = array(
			"pagename" => $page,
			"version" => 1,
			"author" => "anonymous",
			"authorip" => $_SERVER["REMOTE_ADDR"],
			"mtime" => time(),
			"tag" => "",
			"contents" => $contents
		);
		page_write($page, "anonymous", $contents, syntax_parsing($pagedata, TRUE));
		
		header("Location: $wikiPath/$PAGE");
	} elseif($_POST["preview"] || $is_conflicted) {
		$is_preview = TRUE;
		$contents = $_POST["contents"];
		if(get_magic_quotes_gpc())
			$contents = stripslashes($contents);
		if($is_conflicted && $_SERVER["REQUEST_METHOD"] != "POST")
			$contents = (is_null($pagedata) ? "" : $pagedata["contents"]);
		
		$_pagedata = array(
			"pagename" => $page,
			"version" => 1,
			"author" => "anonymous",
			"authorip" => $_SERVER["REMOTE_ADDR"],
			"mtime" => time(),
			"tag" => "",
			"contents" => $contents
		);
		include "$wikiTheme/header.php";
		include "$wikiTheme/edit.php";
		include "$wikiTheme/footer.php";
	} else {
		$is_preview = FALSE;
		$contents = (is_null($pagedata) ? "" : $pagedata["contents"]);
		include "$wikiTheme/header.php";
		include "$wikiTheme/edit.php";
		include "$wikiTheme/footer.php";
	}
} elseif($info["action"] == "info") {
	$pagedata = page_read($page);
	$pagehist = page_history($page);
	if(is_null($pagehist)) {
		header("Location: $wikiPath/$PAGE?edit=1");
	} else {
		krsort($pagehist["history"]);
		include "$wikiTheme/header.php";
		include "$wikiTheme/info.php";
		include "$wikiTheme/footer.php";
	}
} elseif($info["action"] == "goto") {
	$newpage = $info["option"];
	$_newpage = toki_urlencode($newpage);
	if(!$newpage) {
		header("Location: $wikiPath/");
	} elseif(page_exists($newpage)) {
		header("Location: $wikiPath/$_newpage");
	} else {
		header("Location: $wikiPath/$_newpage?edit=1");
	}
} elseif($info["action"] == "diff") {
	$pagedata = page_read($page);
	$pagehist = page_history($page);
	if(!is_null($pagehist)) {
		list($version0, $version1) = explode(",", $info["option"]);
		$contents0 = page_read($page, $version0);
		$contents1 = page_read($page, $version1);
		if(is_null($contents0) || is_null($contents1)) {
			header("Location: $wikiPath/$PAGE?info");
		} else {
			$contents0 = explode(toki_newline($contents0["contents"]), $contents0["contents"]);
			$contents1 = explode(toki_newline($contents1["contents"]), $contents1["contents"]);
			$diff = action_diff($contents0, $contents1, count($contents0), count($contents1));
			
			include "$wikiTheme/header.php";
			include "$wikiTheme/diff.php";
			include "$wikiTheme/footer.php";
		}
	} else {
		header("Location: $wikiPath/");
	}
} elseif($info["action"] == "links1") {
	$pagedata = page_read($page);
	$pagelink = page_link_read($page, TRUE);
	
	include "$wikiTheme/header.php";
	include "$wikiTheme/links1.php";
	include "$wikiTheme/footer.php";
} elseif($info["action"] == "links2") {
	$pagedata = page_read($page);
	$pagelink = page_link_read($page, FALSE);
	
	include "$wikiTheme/header.php";
	include "$wikiTheme/links2.php";
	include "$wikiTheme/footer.php";
} else {
	if(call_user_func("plugin_ap_$info[action]", $page, $info["option"])) {
		include "$wikiTheme/header.php";
		call_user_func("plugin_a_$info[action]", $page, $info["option"]);
		include "$wikiTheme/footer.php";
	} else {
		call_user_func("plugin_a_$info[action]", $page, $info["option"]);
	}
}
?>

