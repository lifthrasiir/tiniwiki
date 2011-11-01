<? if($is_preview) { ?>
<?=syntax_parsing($pagedata)?>
<hr class="hr" />
<? } ?>

<form action="<?=$wikiPath?>/<?=$PAGE?>?edit" method="post"><p>
<textarea rows="25" cols="80" name="contents"><?=htmlspecialchars($contents)?></textarea><br />
<input type="submit" name="preview" value="Preview" /> <input type="submit" name="submit" value="Save" />
</p></form>

