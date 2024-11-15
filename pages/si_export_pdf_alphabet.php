<?php
require_once('../config.php');
require_once("../libs/forms.php");
require_once("../libs/staff.php");
require_once("../libs/phones.php");
require_once("../libs/pdf.php");

use Mpdf\Mpdf;
require_once ('../vendor/autoload.php');
if($ENABLE_PDF_EXPORT)
	{
	Application::makeLdapConfigAttrLowercase();
	$menu_marker="si_export_pdf_alphabet";

	@$BOOKMARK_NAME=($_POST['bookmark_name'])?$_POST['bookmark_name']:(($_GET['bookmark_name'])?$_GET['bookmark_name']:current(array_keys($BOOKMARK_NAMES[current(array_keys($BOOKMARK_NAMES))])) );
	@$bookmark_attr=($_POST['bookmark_attr'])?$_POST['bookmark_attr']:(($_GET['bookmark_attr'])?$_GET['bookmark_attr']:current(array_keys($BOOKMARK_NAMES)));


	$html_head = PDF::get_pdf_head();
	$html_table ="<table class='staff'>";

	$ldap=new LDAP($LDAPServer, $LDAPUser, $LDAPPassword);
	$CompanyNameLdapFilter=Application::getCompanyNameLdapFilter();

	if($USE_DISPLAY_NAME)
		$DisplayName=$DISPLAY_NAME_FIELD;
	else
		$DisplayName=$LDAP_NAME_FIELD;	

	$Staff=$ldap->getArray($OU, "(&".$CompanyNameLdapFilter."(".$LDAP_CN_FIELD."=*)".$DIS_USERS_COND.")", array($DisplayName, $LDAP_MAIL_FIELD, $LDAP_INTERNAL_PHONE_FIELD, $LDAP_CITY_PHONE_FIELD, $LDAP_TITLE_FIELD, $LDAP_DEPARTMENT_FIELD, $LDAP_CELL_PHONE_FIELD), array($DisplayName, array('ad_def_full_name')));

	if(is_array($Staff))
		{
		$sizeof=count($Staff[$DisplayName]);
		for($i=0; $i<$sizeof; $i++)
			{
			if(!($PDF_HIDE_STAFF_WITHOUT_PHONES&&(!$Staff[$LDAP_INTERNAL_PHONE_FIELD][$i])&&(!$Staff[$HIDE_CITY_PHONE_FIELD][$i])&&(!$Staff[$LDAP_CELL_PHONE_FIELD][$i])))
				{
				$FIO=explode(" ", $Staff[$DisplayName][$i]);	
				
				$Surname=$Staff[$DisplayName][$i];
				$Name="";
				$Patronymic="";
				
				if(preg_match("/[ЁA-ZА-Я]{1}[ёa-zа-я-]+[\s]{1}[ЁA-ZА-Я]{1}[ёa-zа-я-]+[\s]{1}[ЁA-ZА-Я]{1}[ёa-zа-я-]+/u", $Staff[$DisplayName][$i]))
					{
					$Surname=$FIO[0];
					$Name=$FIO[1];
					$Patronymic=$FIO[2];
					}
				if(preg_match("/[ЁA-ZА-Я]{1}[ёa-zа-я-]+[\s]{1}[ЁA-ZА-Я]{1}[.]{1}[\s]{1}[ЁA-ZА-Я]{1}[ёa-zа-я-]+/u", $Staff[$DisplayName][$i]))
					{
					$Surname=$FIO[2];
					$Name=$FIO[0];
					$Patronymic=$FIO[1];			
					}	

				$FirstLetter=mb_substr($Surname, 0, 1, 'UTF-8');
					
				$colspan=Staff::getNumStaffTableColls();

				if($PrevFirstLetter!=$FirstLetter)
					{
					$html.="<tr><td colspan=\"".$colspan."\" class=\"department\"><div>".$FirstLetter."</div><img src=\"../skins/".$CURRENT_SKIN."/images/pdf/pixel_black.png\" vspace=\"1\" width=\"100%\" height=\"1px\"></td></tr>";		
					$PrevFirstLetter=$FirstLetter;
					}
				else
					$html.="<tr><td colspan=\"".$colspan."\"><img src=\"../skins/".$CURRENT_SKIN."/images/pdf/divider.gif\" vspace=\"0\" width=\"100%\" height=\"1\"></td></tr>";			

				$html.="<tr>
				<td class=\"name\"><span class=\"surname\">".$Surname."</span><br><span class=\"patronymic\">".$Name." ".$Patronymic."</span></td>";
				if(!$HIDE_CELL_PHONE_FIELD)	
					$html.="<td class=\"cell_phone\">".Staff::makeCellPhone($Staff[$LDAP_CELL_PHONE_FIELD][$i], false)."</td>";

				if(!$HIDE_CITY_PHONE_FIELD)		
					$html.="<td class=\"city_phone\">".Staff::makeCityPhone($Staff[$LDAP_CITY_PHONE_FIELD][$i], false)."</td>";
				
				$html.="
				<td class=\"internal_phone\">".Staff::makeInternalPhone($Staff[$LDAP_INTERNAL_PHONE_FIELD][$i], false)."</td>
				<td class=\"mail\">".$Staff[$LDAP_MAIL_FIELD][$i]."</td>
				<td class=\"position\">".Staff::makeTitle($Staff[$LDAP_TITLE_FIELD][$i])."</td>
				</tr>
				";		
				}

			}
		}

	$html.="</table>";

        $mpdf= new Mpdf([
            'format' => 'A4',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'default_font' => 'arial2'
        ]);

	$stylesheet = file_get_contents("../skins/".$CURRENT_SKIN."/css/pdf.css");
	$mpdf->WriteHTML($stylesheet, 1);

	$mpdf->WriteHTML($html, 2);
	$mpdf->Output('pdf_alphabet.pdf', 'I');
	}
