<?
function traveldir($path, $prefix = "") {
	$dp = opendir($path);
	while(($file = readdir($dp)) !== FALSE) {
		if(substr($file, -4) == ".php")
			echo "$prefix<a href=\"source.php?file=$path/$file\">$file</a><br>";
	}
	closedir($dp);
}

$file = $_GET[file];
if(preg_match("/^".preg_quote(getcwd(),"/")."/", realpath($file)) && substr($file, -4) == ".php") {
	$contents = file_get_contents($file);
	$bytes = filesize($file);
	$lines = max(substr_count($contents, "\r"), substr_count($contents, "\n")) + 1;
	
	echo "<table width=\"100%\" style=\"border:1px solid black;\">\n";
	echo "<tr><td colspan=\"2\" bgcolor=\"black\" style=\"color:white; padding:5px;\">";
	echo "<code><b>$file</b> (".number_format($bytes)." bytes, ".number_format($lines)." lines)</code></td></tr>\n";
	echo "<tr><td bgcolor=\"#E0E0E0\" valign=\"top\"><p align=\"right\"><code>";
	for($i=1;$i<=$lines;$i++) echo "$i<br />";
	echo "</code></p></td><td style=\"overflow:hidden;\" valign=\"top\">";
	show_source($file);
	echo "</td></tr></table>";
} else {
	$tab = str_repeat("&nbsp;", 4);
	
	echo "<code>";
	traveldir(".");
	echo "<br />plugin/<br />";
	traveldir("./plugin", $tab);
	echo "<br />theme/<br />${tab}default/<br />";
	traveldir("./theme/default/", "$tab$tab");
}
?>
