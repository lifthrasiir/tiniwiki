<?php
############################################################
# TiniWiki version 0.1
#   WikiPlugin: rot13 (string transformation)
#               version 0.01 (April 14, 2004)
# Script by Tokigun <zenith@tokigun.net>
############################################################

function plugin_ix_rot13($property, $text) {
	return str_rot13($text);
}
?>
