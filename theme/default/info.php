<h1 class="heading">�� �������� ����</h1>
<table id="pageHistory">
	<tr class="header">
		<th><p>#</p></th>
		<th><p>ũ��</p></th>
		<th><p>��ģ ��</p></th>
		<th><p>��ģ ��</p></th>
		<th><p>��</p></th>
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
