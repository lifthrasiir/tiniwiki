<?
header("Content-type: text/plain");
$p = "../data";
$dp = opendir($p);
while(($f = readdir($dp)) !== false) {
if($f{0} == '.') continue;
$ff = file_get_contents("$p/$f");
system("rm $p/$f");
$fp = fopen("$p/$f", "w");
fwrite($fp, $ff);
fclose($fp);
echo "processed: $f\n";
}
closedir($dp);
echo "done.\n";
?>
