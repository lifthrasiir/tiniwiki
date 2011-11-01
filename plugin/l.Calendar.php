<?php
############################################################
# TiniWiki version 0.1
#   WikiPlugin: Calendar
#               version 0.01 (April 15, 2004)
# Script by Tokigun <zenith@tokigun.net>
############################################################

// prefix: ������ �̸� prefix [default ""]
// suffix: ������ �̸� suffix [default ""]
// format: ������ �̸� strftime ���� [default "%Y-%m-%d"]
// pagelink: ������ ��ũ ���� [default "link"; none/link/page]
// viewlunar: ���� ��¥ ǥ�� [default "hide"; show/hide; m.Lunar2Solar.php �ʿ�]
// viewtoday: ���� ��¥ ǥ�� [default "show"; show/hide]
// year/yearoffset: ����
// month/monthoffset: ��
// viewothermonth: ���� �޿� ���ϴ� ��¥ �����ֱ� [default "hide"; show/hide]
// holiday: ������ ��� [default "none"; korea/none]
// cssid: �÷����� ��Ÿ�Ͻ�Ʈ�� �����ϱ� ���� ������ [default ""]
//        ������ ��� calendar<cssid>_...�� ���� �������� CSS�� �����ȴ�.

function __plugin_l_Calendar_holiday($mode) { // for future feature.
	return array();
}

function plugin_l_Calendar($attr, $text) {
	global $wikiPath;
	
	$__weekdays = array("sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
	$__weekdayz = array("S", "M", "T", "W", "T", "F", "S");
	
	$format =
		str_replace("%", "%%", $attr["prefix"]).
		($attr["format"] ? $attr["format"] : "%Y-%m-%d").
		str_replace("%", "%%", $attr["suffix"]);
	$year = ($attr["year"] ? $attr["year"] : date("Y")) + $attr["yearoffset"];
	$month = ($attr["month"] ? $attr["month"] : date("n")) + $attr["monthoffset"];
	$holiday = __plugin_l_Calendar_holiday($attr["holiday"] ? strtolower($attr["holiday"]) : "none");
	
	$_pagelink = strtolower($attr["pagelink"]);
	$_pagelink = ($_pagelink=="page" ? 2 : ($_pagelink=="none" || $_pagelink=="hide" ? 0 : 1));
	$_viewlunar = (strtolower($attr["viewlunar"])=="show" && function_exists("plugin_m_Lunar2Solar"));
	$_viewtoday = (strtolower($attr["viewtoday"])=="show" || !$attr["viewtoday"]);
	$_othermonth = (strtolower($attr["viewothermonth"])=="show");
	
	$today = mktime(0, 0, 0, $month, 1, $year);
	$lastday = mktime(0, 0, 0, $month+1, 1, $year);
	$now = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	$year = date("Y", $today);
	$month = date("n", $today);
	
	$contents =
		"\x04<table class=\"plugin_calendar$attr[cssid]\"\x04>\n".
		"\x04<caption\x04>$year / $month\x04</caption\x04>\n".
		"\x04<tr class=\"header\"\x04>\n";
	for($i=0;$i<7;$i++) {
		$contents .= "\x04<th class=\"this_$__weekdays[$i]\"\x04>\x04<p\x04>$__weekdayz[$i]\x04</p\x04>\x04</th\x04>\n";
	}
	$contents .= "\x04</tr\x04>\n";
	
	$today = $today - 86400 * date("w", $today);
	while($today < $lastday) {
		$contents .= "\x04<tr\x04>\n";
		for($i=0;$i<7;$i++,$today+=86400) {
			$_page = strftime($format, $today);
			if($month == date("n", $today)) {
				$contents .= "\x04<td class=\"this_$__weekdays[$i]";
				if($_viewtoday && $today == $now)
					$contents .= " today";
				if($_pagelink == 2)
					$contents .= (page_exists($_page) ? " link" : " nolink");
				$contents .= "\"\x04>\x04<p\x04>";
				if($_pagelink)
					$contents .= "\x04<a href=\"$wikiPath/".toki_urlencode($_page)."\"\x04>".date("j", $today)."\x04</a\x04>";
				else
					$contents .= date("j", $today);
				$contents .= "\x04</p\x04>\x04</td\x04>\n";
			} else {
				$contents .= "\x04<td class=\"other_$__weekdays[$i]";
				if($_viewtoday && $today == $now)
					$contents .= " today";
				if($_othermonth) {
					if($_pagelink == 2)
						$contents .= (page_exists($_page) ? " link" : " nolink");
					$contents .= "\"\x04>\x04<p\x04>";
					if($_pagelink)
						$contents .= "\x04<a href=\"$wikiPath/".toki_urlencode($_page)."\"\x04>".date("j", $today)."\x04</a\x04>";
					else
						$contents .= date("j", $today);
					$contents .= "\x04</p\x04>\x04</td\x04>\n";
				} else {
					$contents .= "\"\x04>\x04<p\x04>\x04&nbsp;\x04</p\x04>\x04</td\x04>\n";
				}
			}
		}
		$contents .= "\x04</tr\x04>\n";
	}
	
	$contents .= "\x04</table\x04>";
	return "\x00\x04</p\x04>$contents\x04<p class=\"p\"\x04>";
}
?>
