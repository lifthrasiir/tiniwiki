<?
// tiniwiki 0.1.-14x�� ������ ���� ������
// pl.php, pll.php, p[0-9]+.*.php, ph.*.php, pc.*.php�� ���� �������� ���� ����
// ���� plt.*.php�� plf.*.php�� �ڵ����� ������ ��.
// (���: 0.1.-13x���ʹ� sqlite�� �����ϹǷ� sqlite ���� ȣȯ���� ����)

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
