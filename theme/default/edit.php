<? if($is_conflicted) { ?>
<p style="color:#FF0000;"><b>경고!</b> 다른 곳에서 이미 이 페이지를 수정했습니다. 현재 페이지의 내용을 확인하신 후 다시 시도하십시오.</p>
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

