<?php
require_once("../libs/require_once.php");

$data[$LDAP_FAVOURITE_USER_FIELD]=$_POST['favourite_user_dn'];
$ldap->removeValues($_POST['current_user_dn'], $data);
