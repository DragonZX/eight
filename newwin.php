<?php
require_once("./config.php");
require_once("./libs/forms.php");
require_once("./libs/staff.php");
require_once("./libs/phones.php");
require_once("./libs/time.php");
require_once("./libs/localization.php");
require_once("./libs/spyc.php");
require_once("./libs/social.php");

Application::makeLdapConfigAttrLowercase();
$L=new Localization("./config/locales/".$LOCALIZATION.".yml");

//Database
//----------------------------------------
$ldap=new LDAP($LDAPServer, $LDAPUser, $LDAPPassword);
//----------------------------------------	

setlocale(LC_CTYPE, "ru_RU.".$GLOBALS['CHARSET_APP']); 

@$menu_marker=($_POST['menu_marker'])?$_POST['menu_marker']:$_GET['menu_marker'];

//Basic Auth
//----------------------------------------	
include_once("auth.php");
//----------------------------------------	
?>
<html>

	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <?php require ("./skins/".$CURRENT_SKIN."/helper.php");
        echo $newwin_styles.$newwin_js;?>
	</head>

	<body>
		<?php	
		if(is_file($PHPPath."/".$menu_marker.".php")) {include($PHPPath."/".$menu_marker.".php");}
		?>
	</body>

</html>