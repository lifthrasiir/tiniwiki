<?
header("content-type:text/plain");
$dest = array(
	'config.php',
	'index.php',
	'wiki.php',
	'wikiengine.php',
	'wikilib.php',
	'wikipage.php',
	'plugin/l.AllPages.php',
	'plugin/l.RecentChanges.php',
	'plugin/l.WikiEgg.php',
	'plugin/ix.rot13.php',
	'plugin/a.doit.php',
	'theme/default/diff.php',
	'theme/default/edit.php',
	'theme/default/footer.php',
	'theme/default/header.php',
	'theme/default/info.php',
	'theme/default/view.php',
	'theme/default/links1.php',
	'theme/default/links2.php'
);
$_path = "../";

$xlines = 0;
foreach($dest as $destn) {
	$lines = count(@file($_path.$destn));
	printf("%-30s%d\n", $destn, $lines);
	$xlines += $lines;
}
echo "== TOTAL $xlines ==\n";
?>
