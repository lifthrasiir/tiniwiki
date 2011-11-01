<?
$cversion = $pagehist['version'];
?>
<h1 class="heading">이 페이지의 옛 버전 비교</h1>
<p class="p"></p>
<h2 class="heading">
<? if($version0 < $cversion && $version1 < $cversion) { ?>
	<a href="<?=$wikiPath?>/<?=$PAGE?>?diff=<?=$version0+1?>,<?=$version1+1?>" class="_diff">&lt;</a>
<? } ?>
	<a href="<?=$wikiPath?>/<?=$PAGE?>?view=<?=$version0?>" class="_diff">v<?=$version0?></a> - 
	<a href="<?=$wikiPath?>/<?=$PAGE?>?view=<?=$version1?>" class="_diff">v<?=$version1?></a>
<? if($version0 > 1 && $version1 > 1) { ?>
	<a href="<?=$wikiPath?>/<?=$PAGE?>?diff=<?=$version0-1?>,<?=$version1-1?>" class="_diff">&gt;</a>
<? } ?>
</h2>
<p class="p"></p>
<?
$previous = array(-1, -1);
$diff[] = array(count($contents0), count($contents1));
foreach($diff as $current) {
	/*
	if($current[1] - $previous[1] == $current[0] - $previous[0]) {
		for($i=$previous[0]+1,$j=$previous[1]+1;$i<$current[0];$i++,$j++) {
			echo "<p class=\"diff_modified_previous\">".toki_htmlspecialchars($contents0[$i], TRUE)."</p>\n";
			echo "<p class=\"diff_modified_current\">".toki_htmlspecialchars($contents1[$j], TRUE)."</p>\n";
		}
	} else {
	*/
		for($i=$previous[0]+1;$i<$current[0];$i++)
			echo "<p class=\"diff_removed\">".toki_htmlspecialchars($contents0[$i], TRUE)."</p>\n";
		for($i=$previous[1]+1;$i<$current[1];$i++)
			echo "<p class=\"diff_added\">".toki_htmlspecialchars($contents1[$i], TRUE)."</p>\n";
	/*
	}
	*/
	echo "<p class=\"diff\">".toki_htmlspecialchars($contents0[$current[0]], TRUE)."</p>\n";
	$previous = $current;
}
?>

