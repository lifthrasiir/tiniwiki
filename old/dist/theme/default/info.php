<h1 class="heading">이 페이지의 정보</h1>
<table id="pageHistory">
	<tr class="header">
		<th><p>#</p></th>
		<th><p>크기</p></th>
		<th><p>고친 이</p></th>
		<th><p>고친 때</p></th>
		<th><p>비교</p></th>
	</tr>
<? foreach($pagehist["history"] as $k => $v) { ?>
	<tr>
		<td><p><b><a href="<?=$wikiPath?>/<?=$PAGE?>?view=<?=$k?>"><?=$k?></a></b></p></td>
		<td><p><?=filesize(page_address("p$k", $page))?></p></td>
		<td><p><?=$v["author"]?></p></td>
		<td><p><?=date("Y/m/d H:i:s", $v["mtime"])?></p></td>
		<td><p><? if($k > 1) { ?><a href="<?=$wikiPath?>/<?=$PAGE?>?diff=<?=$k-1?>,<?=$k?>">diff</a><? } ?></p></td>
	</tr>
<? } ?>
</table>
