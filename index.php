<?php
/*
 *  @author Vladimir Pitin <vladimir@pitin.su> Copyright 2012
 *  @url https://github.com/tdvsdv/eight
 *  @author Vitaliy Zhukov <dragonzx@aunited.ru> Copyright 2019
 *  @url https://github.com/DragonZX/eight
 */
if (!file_exists("./config.php")){die(_("Couldn't find configuration file"));};
require_once("./config.php");
require_once("./libs/forms.php");
require_once("./libs/staff.php");
require_once("./libs/phones.php");
require_once("./libs/time.php");
require_once("./libs/localization.php");
require_once("./libs/spyc.php");

if ($DEBUG_MODE){ini_set("display_errors", 1);}
Application::makeLdapConfigAttrLowercase();	//Преобразуем все атрибуты LDAP в нижний регистр.
$L=new Localization("./config/locales/".$LOCALIZATION.".yml");

//#####Database connection#####
$ldap=new LDAP($LDAPServer, $LDAPUser, $LDAPPassword);
//----------------------------------------	

setlocale(LC_CTYPE, "ru_RU.".$GLOBALS['CHARSET_APP']); 

@$menu_marker=($_POST['menu_marker'])?$_POST['menu_marker']:(($_GET['menu_marker'])?$_GET['menu_marker']:$DEFAULT_PAGE);
@$only_bookmark=($_POST['only_bookmark'])?$_POST['only_bookmark']:$_GET['only_bookmark'];
@$BOOKMARK_NAME=($_POST['bookmark_name'])?$_POST['bookmark_name']:(($_GET['bookmark_name'])?$_GET['bookmark_name']:current(array_keys($BOOKMARK_NAMES[current(array_keys($BOOKMARK_NAMES))])) );


if((@$_POST['form_sent']) && (@!$GLOBALS['only_bookmark'])) //Если отправлена форма поиска и флажок "только во вкладке не был установлен"
	@$BOOKMARK_NAME="";
$bookmark_name=$BOOKMARK_NAME;
@$bookmark_attr=($_POST['bookmark_attr'])?$_POST['bookmark_attr']:(($_GET['bookmark_attr'])?$_GET['bookmark_attr']:current(array_keys($BOOKMARK_NAMES)));


//Записываем переменные в массив. Массив используется для формирование скрытых полей форм и url-ов.
//-------------------------------------------------------------------------------------------------
$CurrentVars['menu_marker']=$menu_marker;
$CurrentVars['bookmark_name']=$bookmark_name;
$CurrentVars['bookmark_attr']=$bookmark_attr;
$CurrentVars['only_bookmark']=$only_bookmark;
//-------------------------------------------------------------------------------------------------

if(@$_POST['form_sent']&&(!$only_bookmark))
	$BOOKMARK_NAME="*";


//Auth for Staff
//-------------------------------------------------------------------------------------------------

@$dn=($_GET['dn'])?$_GET['dn']:$_POST['dn'];

if(@$_GET['iamnot']) //Если нажата кнопка выход, то уничтожаем куку
	{
	setcookie('dn');
	$_COOKIE['dn']="";
	}

if(@$_SERVER['REMOTE_USER']) //Если есть прозрачно аутентифицированный пользователь. И в серверной переменной хранится его логин
	{	
	if($DistinguishedName=$ldap->getValue($OU, $LDAP_DISTINGUISHEDNAME_FIELD, $LDAP_USERPRINCIPALNAME_FIELD."=".$_SERVER['REMOTE_USER']."*")) //Находим его distinguishedname
		{
		//Сохраняем куку с distinguishedname, что бы в дальнейшем аутентифицировать пользователя по куке.
		setcookie('dn', $DistinguishedName, time()+5000*24*60*60, "/");
		$_COOKIE['dn']=$DistinguishedName;
		}
	}
else
	{
	if(@$_POST['password']) //Если пользователь ввел пароль в ручную
		{
		$LC=ldap_connect($LDAPServer); //Connecting to the LDAP Server
		if(@ldap_bind($LC, $ldap->getValue($dn, $LDAP_USERPRINCIPALNAME_FIELD), $_POST['password']))	//Проверяем что пользователь может соединится с сервером LDAP используя введенный пароль.
			{
			setcookie('dn', $dn, time()+5000*24*60*60, "/"); //Сохраняем куку с distinguishedname, что бы в дальнейшем аутентифицировать пользователя по куке.
			$_COOKIE['dn']=$dn;
			}
		/*else
			$Error['password']=true;*/
		}
	}

//-------------------------------------------------------------------------------------------------	

//User auth
//----------------------------------------	
include_once("auth.php");
//----------------------------------------	

//If we have cookie with dn, searching for logined user
if(isset($_COOKIE['dn']))
	{
	if($USE_DISPLAY_NAME)
		$WhoAreYou=$ldap->getValue($_COOKIE['dn'], $DISPLAY_NAME_FIELD);
	else
		$WhoAreYou=$ldap->getValue($_COOKIE['dn'], $LDAP_NAME_FIELD);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $TITLE; ?></title>
    <?php require ("./skins/".$CURRENT_SKIN."/helper.php");
	 echo $skin_styles.$skin_js;
     if (isset($FAVICON_D)) {echo "<link rel=\"icon\" type=\"image/png\" href=\"$FAVICON_D\" />";}
     else{echo "<link rel=\"icon\" type=\"image/png\" href=\"/skins/".$CURRENT_SKIN."/favicon.png\" />";}
     if (isset($FAVICON_M)) {echo "<link rel=\"apple-touch-icon\" type=\"image/png\" href=\"$FAVICON_M\"/>";}
     else{echo "<link rel=\"icon\" type=\"image/png\" href=\"/skins/".$CURRENT_SKIN."/favicon-m.png\" />";}
    ?>
</head>

<body onLoad="scroll();">

<?php 
if (isset($MOTD) & $MOTD!=""){echo '<div id="motd">'.$MOTD.'</div><div id="motd_f"></div>';}
if($XMPP_ENABLE) 
	echo "<div id=\"send_xmpp_message\" class=\"lightview\">".$L->l('send_message')."</div>";
?>	
<div class="hidden">
<?php
if($_COOKIE['dn'])
	echo "<div id=\"current_user_dn\">".$_COOKIE['dn']."</div>";
?>
</div>

<?php	
if($ALARM_MESSAGE)
	echo"<div class=\"alarm\" id=\"alarm_mess\">".$ALARM_MESSAGE."</div>";
?>
	

<table class="main" align="center" cellpadding="5px" cellspacing="0px">

<tr>
	<td class="companies">
	
	<div class="sep_tabs">
		<?php		
		//Вывод закладок компаний
		if(count($BOOKMARK_NAMES)>1)
			{
			$i=0;
			foreach($BOOKMARK_NAMES AS $key=>$value)
				{
				if($i!=0)
					$class="border";
				else
					$class="";

				$BookMarkLinks=Application::getBookMarkLinks($key, $class);
				echo implode(current($BookMarkLinks));

				if(is_array($BookMarkLinks['window']))
					echo Application::makeWindow($BookMarkLinks['window']);
				$i++;
				}
			}
		?>				
	</div>
	
	<div class="sep_tabs">
		<?php
		//Вывод закладок на различные способы отображения справочника
		if(count($PAGE_LINKS)>1)
			{
			foreach($PAGE_LINKS AS $key=>$value)
				{
				if($menu_marker==$key)
					echo"<div class=\"sel views tab\">".$value."</div>";
				else
					echo"<div class=\"tab views\"><a href=\"".$_SERVER['PHP_SELF']."?bookmark_name=".$BOOKMARK_NAME."&bookmark_attr=".$bookmark_attr."&menu_marker=".$key."\">".$value."</a></div>";
				}
			}
		?>		
	</div>	

	<div class="sep_tabs">
<?php if($ENABLE_PDF_EXPORT) 
	{ ?>
		<div class="tab export"><a id="exp_pdf_sep_dep" href="./pages/si_export_pdf_department.php?bookmark_name=<?php echo $BOOKMARK_NAME; ?>&bookmark_attr=<?php echo $bookmark_attr; ?>" target="_blank" class="in_link"><?php echo $L->l('by_department'); ?></a></div>	
		<div class="tab export"><a id="exp_pdf_sep_alph" href="./pages/si_export_pdf_alphabet.php?bookmark_name=<?php echo $BOOKMARK_NAME; ?>&bookmark_attr=<?php echo $bookmark_attr; ?>" target="_blank" class="in_link"><?php echo $L->l('by_alphabet'); ?></a></div>
<?php } ?>
	</div>
		
	</td>
</tr>

<tr>
	<td>
		<?php	
		if(is_file($PHPPath."/".$menu_marker.".php")) {include($PHPPath."/".$menu_marker.".php");}
		?>
	</td>
</tr>

<tr class="copyright">
	<td><?php echo $COPY_RIGHT; ?></td>
</tr>

</table>

</body>
</html>