<?
############################################################
## TiniWiki version 0.1
##   config.php: configuration for TiniWiki
## Script by Tokigun <zenith@tokigun.net>
############################################################

////////////////////////////////////////////////////////////
// some special pages

# FrontPage
$wikiFrontPage = "�빮";
#$wikiFrontPage = "FrontPage";

////////////////////////////////////////////////////////////
// path to files (you must remove following slashes!)

# path to TiniWiki root (absolute path, except domain name)
$wikiRoot = "/tiniwiki";

# path to your theme files
$wikiTheme = "theme/default";
# path to your data files (writable)
$wikiData = "data";
# path to your plugin files
$wikiPlugin = "plugin";

////////////////////////////////////////////////////////////
// configuration for external link (netlink)

# available protocols
$netLink_protocol = "http://|ftp://|mailto:";
# default protocol (if protocol were omitted)
$netLink_default = "http://";

////////////////////////////////////////////////////////////
// permitted HTML tags

# singleton tags
$wikiHTMLsingle =
	"!--|img|br|hr";
# non-singleton tags
$wikiHTMLdouble =
	"table|tr|th|td|caption|".    // table
	"h[1-6]|".                    // heading
	"b|i|tt|sup|sub|".            // font
	"div|span|blockquote|pre|p|". // block
	"a";                          // link
# block tags (if this tag has appeared, previous tag SHOULD be closed.)
$wikiHTMLblock = array(
	"hr", "table",
	"h1", "h2", "h3", "h4", "h5", "h6",
	"div", "blockquote", "pre", "p"
);

////////////////////////////////////////////////////////////
// some regular expression for TiniWiki (don"t change)

# extended WikiWord
$wikiWord = "(?<![0-9a-zA-Z]|<\?)((?:[A-Z]?[a-z]+[A-Z]+|[A-Z]{2,}[a-z])[a-zA-Z]*)(?![0-9a-zA-Z])";
# external link
$netLink = "(?<![0-9a-zA-Z])((?:$netLink_protocol)[^\\s\x05]+)";

////////////////////////////////////////////////////////////
// miscellaneous configurations

# PHP header for data files in $wikiData
$wikiDataEscape = "<?php exit; ?>";

############################################################
##### Configuration has done.  Enjoy your TiniWiki! :) #####
############################################################
?>
