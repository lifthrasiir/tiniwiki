<?
// tiniwiki 0.1.-14x의 데이터 파일 복구용
// pl.php, pll.php, p[0-9]+.*.php, ph.*.php, pc.*.php는 파일 내용으로 복구 가능
// 따라서 plt.*.php와 plf.*.php만 자동으로 생성해 냄.
// (경고: 0.1.-13x부터는 sqlite를 지원하므로 sqlite 사용시 호환되지 않음)

include 'config.php';
include 'wikilib.php';
include 'wikiengine.php';
include 'wikipage.php';

$plugins = preprocess_load_plugins();
$interwikimap = preprocess_parse_interwiki();
foreach(page_list() as $page => $_) {
	$pagedata = page_read($page);
	page_link_update($pagedata["pagename"], syntax_parsing($pagedata, TRUE));
	echo "$page\n";
}
?>
