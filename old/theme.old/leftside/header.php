<?php echo '<?xml version="1.0" encoding="EUC-KR" ?>'; ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko">

<head>
	<title><?=htmlspecialchars($page)?> -- TiniWiki version <?=$wikiVersion?></title>
	<meta http-equiv="content-type" content="text/html; charset=EUC-KR" />
	<meta name="generator" content="TiniWiki version <?=$wikiVersion?>" />
	<link rel="stylesheet" type="text/css" href="<?=$wikiRoot?>/<?=$wikiTheme?>/theme.css" />
</head>

<?php if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera') !== FALSE) { ?>
<body topmargin="0" leftmargin="0" style="background:url(<?=$wikiRoot?>/<?=$wikiTheme?>/back.png) repeat-y;">
<?php } else { ?>
<body style="background:url(<?=$wikiRoot?>/<?=$wikiTheme?>/back.png) repeat-y;">
<?php } ?>

<table id="themeLayout"><tr><td id="themeSidebar">
	<p class="logo">
		<a href="<?=$wikiPath?>/<?=rawurlencode($wikiFrontPage)?>">
			<img src="<?=$wikiRoot?>/<?=$wikiTheme?>/logo.png" width="165" height="50" alt="TiniWiki logo" />
		</a><br />.version <?=$wikiVersion?><br />&nbsp;
	</p>
	<p class="menu">&nbsp;.<a href="<?=$wikiPath?>/<?=rawurlencode($wikiFrontPage)?>">FrontPage</a></p>
	<p class="menu">&nbsp;.<a href="<?=$wikiPath?>/RecentChanges">RecentChanges</a></p>
	<p class="menu">&nbsp;.<a href="<?=$wikiPath?>/AllPages">AllPages</a></p>
	<p>&nbsp;</p>
	<p class="menu">&nbsp;.GoTo</p>
	<form action="<?=$wikiPath?>/<?=$PAGE?>" method="get"><p>
		<input type="text" class="textbox" name="goto" value="" />
	</p></form>
	<p class="menu">&nbsp;.<a href="<?=$wikiPath?>/SearchPages">SearchPages</a></p>
	<form action="<?=$wikiPath?>/<?=$PAGE?>" method="get"><p>
		<input type="text" class="textbox" name="search" value=" -- not implemented --" />
	</p></form>
</td><td id="themeMain">

<div id="themeHeader">
	<h1>blahblah</h1>
</div>
<div id="themeContents">
<!-- start of contents -->

