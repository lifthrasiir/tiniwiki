<?php
exit; // comment this line

/*
// adjust file
fwrite($fp=fopen("pll.php","w"),
"<?php exit; ?>\r\n".
"|tOu5rg==|U3ludGF4UGFyc2luZw==|QWxsUGFnZXM=|Q2hhbmdlTG9n|UHJldmlvdXNTeW50YXhQYXJzaW5n|V2lraVNhbmRCb3g=|VGluaVdpa2k=|d2lraVg=|xeSzorG6|V2lraUVnZw==|UGhwV2lraQ==|VGluaVdpa2lEZWZhdWx0|wKfFsMCnxbA=|UmVjZW50Q2hhbmdlcw==|V2lraUVuZ2luZQ==|UmVjZW50VmlzaXRvcnM=|VG9Ebw==|VGluaVdpa2lFbg==|VGluaVdpa2lHb2Fs|dG9raVdpa2k=|d2lraVRoZW1lL1RpbmlXaWtpRGVmYXVsdA==|d2lraVBsdWdpbi9SZWNlbnRDaGFuZ2Vz|d2lraVBsdWdpbi9BbGxQYWdlcw==|d2lraVBsdWdpbi9XaWtpRWdn|RnJvbnRQYWdl|"
);fclose($fp);
*/

/*
// convert file format (0.1.-164 to 0.1.-157)
$dp = opendir(".");
while(($f = readdir($dp)) !== false) {
	if($f{0} == ".") continue;
	$q = file_get_contents($f);
	$q = str_replace("\t0\t0\t", "\t", $q);
	$fp = fopen($f, "w");
	fwrite($fp, $q);
	fclose($fp);
}
*/

// make new file format (plf/plt)
#$wikiData = ".";
#$wikiDataEscape = "<?php exit; ? >";
include "config.php";
include "wikilib.php";
include "wikiengine.php";
include "wikipage.php";
$wikiVersion = "0.1.xxx?";
$bs = "\\\\";
$wikiPath = "$wikiRoot/wiki.php";
$interwikimap = parsing_interwiki();
header("Content-type: text/plain");

echo "Parsing...\n";flush();
$plist = page_list();
$PLT = $PLF = array();
foreach($plist as $_pagename => $_x) {
	echo "\t$_pagename\n";flush();
	$_contents = page_read($_pagename);
	syntax_parsing($_contents);
	foreach($pageLink as $alpha => $beta) {
		// 이 페이지를 링크하는 페이지: links to
		$PLF[$_pagename][$alpha] = $beta;
		$PLT[$alpha][$_pagename] = 1; #$beta;
	}
}

echo "\nUpdating...";flush();
foreach($PLT as $_pagename => $_list) {
	$contents = "$wikiDataEscape\r\n".count($_list)."\n";
	foreach($_list as $_xpagename => $_xpagenumber)
		$contents .= base64_encode($_xpagename)."\t$_xpagenumber\n";
	$fp = fopen(page_address("plt", $_pagename), 'w');
	fwrite($fp, $contents);
	fclose($fp);
}
foreach($PLF as $_pagename => $_list) {
	$contents = "$wikiDataEscape\r\n".count($_list)."\n";
	foreach($_list as $_xpagename => $_xpagenumber)
		$contents .= base64_encode($_xpagename)."\t$_xpagenumber\n";
	$fp = fopen(page_address("plf", $_pagename), 'w');
	fwrite($fp, $contents);
	fclose($fp);
}

echo "\nDone.";
?>
