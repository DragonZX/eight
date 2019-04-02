<?php
abstract Class PDF
{
	static function get_pdf_head()
	{
	    if ($GLOBALS['PDF_LOGO']){$PRINT_LOGO=$GLOBALS['PDF_LOGO'];}else{$PRINT_LOGO="../skins/".$GLOBALS['CURRENT_SKIN']."/images/pdf/logo.png";}
		return "
		<table id=\"header\">
		<tr>
		<td rowspan=\"3\"><img alt=\"logo\" src=\"".$PRINT_LOGO."\" width=\"\" height=\"\"></td>
		<td id=\"title\">".$GLOBALS['PDF_TITLE']." (".$GLOBALS['BOOKMARK_NAMES'][$GLOBALS['bookmark_attr']][$GLOBALS['BOOKMARK_NAME']].")</td>
		</tr>
		<tr>
		<td id=\"second_life\">".$GLOBALS['PDF_SECOND_LINE']."</td>
		</tr>
		<tr>
		<td id=\"create_date\">Справочник создан: ".date("d.m.Y")."</td>
		</tr>
		</table>";
	}
}
