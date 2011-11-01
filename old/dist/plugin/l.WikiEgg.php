<?php
############################################################
# TiniWiki version 0.1
#   WikiPlugin: WikiEgg
#               version 0.026 (August 15, 2004)
# Script by Tokigun <zenith@tokigun.net>
############################################################

/*
// original code by Ken Perlin [http://mrl.nyu.edu/~perlin/]
main(k) {float i,j,r,x,y=-16;while(puts(""),y++<15)for(x
=0;x++<84;putchar(" .:-;!/>)|&IH%*#"[k&15]))for(i=k=r=0;
j=r*r-i*i-2+x/25,i=2*r*i+y/10,j*j+i*i<11&&k++<111;r=j);}
*/

function plugin_l_WikiEgg($attr, $text) {
	global $_path, $wikiVersion;
	
	$_header = "TiniWiki version $wikiVersion";
	$_footer = "Script by Tokigun <zenith@tokigun.net>";
	$_version = explode("/", $wikiVersion, 2); $_version = $_version[0];
	$_memo = str_replace("&", "\x04&", toki_htmlspecialchars(implode("\n", array(
		""                                                            ,
		"@@@@@@ @@        @@ @@    @@ @@ @@    @@"                    ,
		"  @@                @@ @@ @@    @@"                          ,
		"  @@   @@ @@@@@  @@ @@ @@ @@ @@ @@ @@ @@"                    ,
		"  @@   @@ @@  @@ @@ @@ @@ @@ @@ @@@@  @@ THE TINY WIKIENGINE",
		"  @@   @@ @@  @@ @@  @@@@@@  @@ @@ @@ @@ version $_version"  ,
		"////////////////////////////////////////////////////////////",
		"//////////////////    TINIWIKI CREDITS    //////////////////",
		"////////////////////////////////////////////////////////////",
		"//                                                        //",
		"//  Core Development            Kang Seonghoon (Tokigun)  //",
		"//                                                        //",
		"//  Default Theme Design        Kang Seonghoon (Tokigun)  //",
		"//  Default Plugin Development  Kang Seonghoon (Tokigun)  //",
		"//                                                        //",
		"//  Original <Mandelbrot Set> Program by                  //",
		"//      Ken Perlin [http://mrl.nyu.edu/~perlin/]          //",
		"//                                                        //",
		"//  Thanks to                                             //",
		"//      Lee Hwaseob (ATply)     http://atply.com/         //",
		"//      Bae Seongho (9000MHz)   http://sayq.org/          //",
		"//      Yoon Seonggeun (Pe-i)   http://orir.net/          //",
		"//      Kim Yongmook            http://moogi.new21.org/   //",
		"//      Kim Jaejoo (azurespace) http://azure.raizel.net/  //",
		"//      Kim Joon-gi (daybreaker)                          //",
		"//                            http://daybreaker.x-y.net/  //",
		"//      Lee Baroseul (Barosl)   http://barosl.com/        //",
		"//                                                        //",
		"//                                                        //",
		"//  TiniWiki is distributed under GNU Public License.     //",
		"//                                                        //",
		"//  TiniWiki Website:                                     //",
		"//      http://dev.tokigun.net/tiniwiki/                  //",
		"//                                                        //",
		"//  Copyright (c) 2002-2004, Kang Seonghoon (Tokigun).    //",
		"//  All rights reserved.                                  //",
		"//                                                        //",
		"////////////////////////////////////////////////////////////",
		"                    -- This is WikiEgg plugin version 0.025."
	))));
	
	$_header = " $_header ".str_repeat("=", 81 - strlen($_header));
	$_footer = str_repeat("-", 81 - strlen($_footer))." $_footer ";
	$_memo = "\x04&nbsp;\x04&nbsp;".str_replace("\n", "\x04<br /\x04>\n\x04&nbsp;\x04&nbsp;", $_memo);
	$__header = "\x04<span style=\"background:#000000; color:#FFFFFF;\"\x04>";
	$__footer = "\x04</span\x04>";
	
	srand((double)microtime()*1000000);
	if(isset($property["color"]))
		$_pattern = $property["color"];
	else
		$_pattern = mt_rand(0, 6);
	$pattern = "#";
	for($i=1;$i<8;$i*=2)
		$pattern .= ($_pattern&$i ? "00" : "%02X");
	
	$p = array("\x04&nbsp;",".",":","-",";","!","/","\x04&gt;",")","|","\x04&amp;","I","H","%","*","#");
	for($i=0;$i<16;$i++) $_p[$i] = sprintf($pattern, $i*17, $i*17, $i*17);
	$__p = "\x04<span style=\"background:#000000; color:#FFFFFF;\"\x04>||\x04</span\x04>";
	
	$original = "";
	for($y=-15;$y<=15;$y++) {
		$previous = -1;
		for($x=1;$x<84;$x++) {
			$i = $r = $k = 0;
			do
				list($r, $i) = array($r*$r-$i*$i-2+$x/25, 2*$r*$i+$y/10);
			while($r*$r + $i*$i < 11 && $k++ < 111);
			if($previous != $k) {
				$original .= ($previous<0 ? "" : "\x04</span\x04>").
					"\x04<span style=\"background:".$_p[$k&15].
					"; color:".$_p[$k&15].";\"\x04>";
				$previous = $k;
			}
			$original .= $p[$k&15];
		}
		$original .= "\x04</span\x04>$__p\x04<br /\x04>\n$__p";
	}
	$original = "\x00\x04</p\x04>\x04<p style=\"line-height:100%;\"\x04>".
		"\x04<tt style=\"margin:0px; padding:0px; line-height:90%;\"\x04>\n".
		"$__p$__header$_header$__footer$__p\x04<br /\x04>$__p".
		$original.
		"$__header$_footer$__footer$__p\x04<br /\x04>$_memo".
		"\x04</tt\x04>\x04</p\x04>\x04<p class=\"p\"\x04>";
	
	return $original;
}

?>
