<h1 class="heading">이 페이지를 링크하는 페이지들</h1>
<?php
$_pagelink = count($pagelink);
if($_pagelink > 0) {
	ksort($pagelink);
	echo "<h2 class=\"heading\">총 $_pagelink 페이지</h2>\n<ul class=\"pagelist\">\n";
	foreach($pagelink as $_pagename => $_pagenumber) {
		if(page_exists($_pagename)) {
			echo "<li><a href=\"$wikiPath/".toki_urlencode($_pagename)."\" class=\"link\">".
				htmlspecialchars($_pagename)."</a></li>\n";
		} else {
			echo "<li><a href=\"$wikiPath/".toki_urlencode($_pagename)."?edit=1\" class=\"no_link\>".
				htmlspecialchars($_pagename)."</a></li>\n";
		}
	}
	echo "</ul>\n";
} else {
	echo "<h2 class=\"heading\">이 페이지를 링크하는 페이지가 없습니다.</h2>\n";
}
?>
<hr class="hr" />
<h1 class="heading"><a href="<?=$wikiPath?>/<?=$PAGE?>?links1" class="_noline">이 페이지가 링크한 페이지들</a></h1>

