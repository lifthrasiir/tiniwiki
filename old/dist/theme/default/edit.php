<? if($is_conflicted) { ?>
<p style="color:#FF0000;"><b>���!</b> �ٸ� ������ �̹� �� �������� �����߽��ϴ�. ���� �������� ������ Ȯ���Ͻ� �� �ٽ� �õ��Ͻʽÿ�.</p>
<hr class="hr />"
<? } ?>
<? if($is_preview) { ?>
<?=syntax_parsing($_pagedata)?>
<hr class="hr" />
<? } ?>

<form action="<?=$wikiPath?>/<?=$PAGE?>?edit=<?=$info['option']?>" method="post"><p>
<textarea rows="25" cols="80" name="contents"><?=htmlspecialchars($contents)?></textarea><br />
<input type="submit" name="preview" value="Preview" /> <input type="submit" name="submit" value="Save" />
</p></form>

