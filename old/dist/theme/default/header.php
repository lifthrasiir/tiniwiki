<?php echo '<?xml version="1.0" encoding="EUC-KR" ?>'; ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko">

<head>
	<title><?=htmlspecialchars($page)?> -- TiniWiki version <?=$wikiVersion?></title>
	<meta http-equiv="content-type" content="text/html; charset=EUC-KR" />
	<meta name="generator" content="TiniWiki version <?=$wikiVersion?>" />
	<link rel="stylesheet" type="text/css" href="<?=$wikiRoot?>/<?=$wikiTheme?>/theme.css" />
</head>

<?php if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "opera") !== FALSE) { ?>
<body topmargin="0" leftmargin="0">
<?php } else { ?>
<body>
<?php } ?>

<p id="themeLogo">
	<a href="<?=$wikiPath?>/<?=rawurlencode($wikiFrontPage)?>">
		<img src="<?=$wikiRoot?>/<?=$wikiTheme?>/logo.png" alt="TiniWiki Logo" width="121" height="70" />
	</a>
</p>
<div id="themeHeader">
	<h1>
<?php if($info["action"] == "links1" || $info["action"] == "links2") { ?>
		<a href="<?=$wikiPath?>/<?=$PAGE?>"><?=htmlspecialchars($page)?></a><small>
<?php } else { ?>
		<a href="<?=$wikiPath?>/<?=$PAGE?>?links2"><?=htmlspecialchars($page)?></a><small>
<?php } ?>
		TiniWiki version <?=$wikiVersion?></small>
	</h1>
	<form action="<?=$wikiPath?>/<?=$PAGE?>" method="get"><p>
		<a href="<?=$wikiPath?>/<?=rawurlencode($wikiFrontPage)?>">FrontPage</a> |
		<a href="<?=$wikiPath?>/RecentChanges">RecentChanges</a> |
		<a href="<?=$wikiPath?>/AllPages">AllPages</a> |
		<a href="<?=$wikiPath?>/SearchPages">SearchPages</a> |
		GoTo <input type="text" id="wikiActionGoTo" name="goto" value="" />
	</p></form>
</div>

<div id="themeContents">
<!-- start of contents -->

