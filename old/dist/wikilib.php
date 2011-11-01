<?php
############################################################
## TiniWiki version 0.1
##   module: wikilib.php (library functions)
## Script by Tokigun <zenith@tokigun.net>
############################################################

function _elaspedtime() {
	static $_nowtime = array(0, 0);
	
	$__nowtime = explode(" ", microtime());
	$_diff = ($__nowtime[0] - $_nowtime[0]) + ($__nowtime[1] - $_nowtime[1]);
	$_nowtime = $__nowtime;
	return $_diff;
}

function toki_htmlspecialchars($str, $null_then_nbsp = FALSE) {
	if($str || !$null_then_nbsp)
		return str_replace("  ", "&nbsp;&nbsp;", htmlspecialchars($str));
	else
		return "&nbsp;";
}

function toki_urlencode($str) {
	return str_replace("%2F", "/", rawurlencode($str));
}

function toki_urldecode($str) {
	return rawurldecode(str_replace("+", "%20", $str));
}

function toki_newline($str) {
	$_r = substr_count($str, "\r");
	$_n = substr_count($str, "\n");
	return (min($_r, $_n) * 2 < max($_r, $_n) ? ($_r < $_n ? "\n" : "\r") : "\r\n");
}

function file_write($file, $mode, $contents) {
	$fp = fopen($file, $mode);
	flock($fp, LOCK_EX);
	fwrite($fp, $contents);
	flock($fp, LOCK_UN);
	fclose($fp);
}

////////////////////////////////////////////////////////////////////////////////

function preprocess_load_plugins() {
	global $wikiPlugin;
	
	$plugins = array(
		"i" => array(), "ix" => array(), "r" => array(), "rx" => array(),
		"l" => array(), "lx" => array(), "o" => array(), "ox" => array(),
		"m" => array(), "a" => array()
	);
	
	$dp = opendir($wikiPlugin);
	while(($f = readdir($dp)) !== FALSE) {
		if(!preg_match("/^(ix?|rx?|lx?|ox?|m|a)\.([A-Za-z0-9_-]+)\.php$/", $f, $m)) continue;
		
		$plugins[$m[1]][] = $m[2];
		include "$wikiPlugin/$m[0]";
	}
	foreach($plugins as $_type => $_list) {
		$plugins["_$_type"] = implode("|", $_list);
	}
	
	return $plugins;
}

function preprocess_parse_interwiki($file = "interwiki.map") {
	$contents = file_get_contents($file);
	preg_match_all("/^\s*((?<!#)\S+)\s+(\S+)\s*$/m", $contents, $m, PREG_SET_ORDER);
	
	$result = array();
	foreach($m as $value) {
		$result[$value[1]] = $value[2].(strpos($value[2], "%s") === FALSE ? "%s" : "");
	}
	return $result;
}

function preprocess_parse_path($path = NULL) {
	global $wikiPath, $plugins;
	
	$actions = "view|edit|info|goto|diff|links[12]".($plugins["_a"] ? "|$plugins[_a]" : "");
	
	if(is_null($path)) {
		$path = $_SERVER["REQUEST_URI"];
		if(get_magic_quotes_gpc())
			$path = stripslashes($path);
		$path = substr(toki_urldecode($path), strlen($wikiPath));
	}
	preg_match($q="#^(?:/(.*?)(?:\?($actions)(?:=(.*))?)?)?$#s", $path, $m);
	return array("page" => $m[1], "action" => $m[2], "option" => $m[3]);
}

////////////////////////////////////////////////////////////////////////////////

function action_diff($src, $dest, $nsrc, $ndest) {
	$result = $trace = array();
	for($i=0;$i<$nsrc;$i++)
		for($j=0;$j<$ndest;$j++)
			if($src[$i] === $dest[$j]) {
				$result[$i][$j] = $result[$i-1][$j-1] + 1;
			} else {
				$result[$i][$j] = max($result[$i][$j-1], $result[$i-1][$j]);
			}
	for($i=$nsrc-1,$j=$ndest-1;$i>=0 && $j>=0;$i--,$j--)
		if($src[$i] === $dest[$j]) {
			$trace[] = array($i, $j);
		} elseif($result[$i][$j-1] > $result[$i-1][$j]) {
			$i++;
		} else {
			$j++;
		}
	
	return array_reverse($trace);
}
?>
