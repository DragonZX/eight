<?php
$DEBUG_MODE=true;
// LDAP
$LDAPTIMEZONE='Europe/Moscow';
$LDAPServer='dc.domain.ru';
$LDAPUser='domain_read_user@domain.ru';
$LDAPPassword='password_for_domain_read_user';
$LDAP_WRITE_USER='domain_write_user@domain.ru';
$LDAP_WRITE_PASSWORD='password_for_domain_write_user';
$OU="OU=orgunit,DC=domain,DC=ru";
$DIS_USERS_COND="(!(useraccountcontrol:1.2.840.113556.1.4.803:=2))(!(useraccountcontrol:1.2.840.113556.1.4.803:=16))";
$LDAP_SIZE_LIMIT_COMPATIBILITY=false;

//MOTD
$MOTD='Looking for MOTD? <a href="https://www.google.com/search?q=MOTD">Search here</a>';

// LDAP FIELDS
$LDAP_DISTINGUISHEDNAME_FIELD="distinguishedname";
$LDAP_USERPRINCIPALNAME_FIELD="userprincipalname";
$LDAP_COMPANY_FIELD="company";
$LDAP_NAME_FIELD="name";
$LDAP_OBJECTCLASS_FIELD="objectclass";
$LDAP_CN_FIELD="cn";
$LDAP_TITLE_FIELD="title";
$LDAP_DEPARTMENT_FIELD="department";
$LDAP_MANAGER_FIELD="manager";
$LDAP_HOMEPHONE_FIELD="homephone";
$LDAP_SN_FIELD="sn";
$LDAP_INITIALS_FIELD="initials";
$LDAP_DEPUTY_FIELD="extensionattribute15";
$LDAP_FAVOURITE_USER_FIELD="alexFavorites";
$LDAP_GUID_FIELD="objectguid";
$LDAP_SIZE_LIMIT_PAGE_DIVIDER_FIELD="displayname";
$LDAP_CREATED_DATE_FIELD="whenCreated";
$LDAP_CHANGED_DATE_FORMAT="yyyymmddhhmmss";
$LDAP_BIRTH_FIELD="extensionattribute10";
$LDAP_COMPUTER_FIELD="wwwhomepage";
$DISPLAY_NAME_FIELD="displayname";
$LDAP_MAIL_FIELD="mail";
$LDAP_INTERNAL_PHONE_FIELD="othertelephone";
$LDAP_CITY_PHONE_FIELD="telephonenumber";
$LDAP_CELL_PHONE_FIELD="mobile";
$LDAP_ST_DATE_VACATION_FIELD="extensionattribute13";
$LDAP_END_DATE_VACATION_FIELD="extensionattribute14";
$LDAP_AVATAR_FIELD="thumbnailphoto";
$LDAP_PHOTO_FIELD="jpegphoto";
$LDAP_ROOM_NUMBER_FIELD="extensionattribute15";
$LDAP_SOCIAL_FIELD="extensionattribute16";

// ADMIN LOGINS
$ADMIN_LOGINS[]='first_admin@domain.ru';

// BIRTHDAYS
$NUM_ALARM_DAYES=31;
$NEAR_BIRTHDAYS=true;
$BIRTH_DATE_FORMAT="dd.mm.yyyy";
$BIRTH_VIS_ROW_NUM=5;
$SHOW_JUBILEE_INFO=true;

// USER DATA
$USE_DISPLAY_NAME=true;

// USER COMPUTER NAME
$SHOW_COMPUTER_FIELD=false;
$SHOW_DEPUTY=true;
$SHOW_DEPUTY_IN_LISTS=false;

// ROOMS
$HIDE_ROOM_NUMBER=true;

// PHONE NUMBERS
$HIDE_CITY_PHONE_FIELD=false;
$HIDE_CELL_PHONE_FIELD=false;
$FORMAT_CITY_PHONE=true;
$FORMAT_CELL_PHONE=true;
$FORMAT_INTERNAL_PHONE=false;
$FORMAT_HOME_PHONE=true;
$USE_PHONE_CODES_DESCRIPTION=true;
$FORMAT_PHONE_BLOCKLEN=2;
$SHOW_SOCIAL_FIELD=false;
$SHOW_SOCIAL_FIELD_DETAILED=true;

// VACATIONS
$VACATION=true;
$VAC_CLAIM_ALARM=true;
$VAC_CLAIM_ALARM_DAYES_FROM=21;
$VAC_CLAIM_ALARM_DAYES_TO=13;
$VAC_DATE_FORMAT="dd.mm.yyyy";

$SHOW_PREV_VAC['si_employeeview']=false;
$SHOW_NEXT_VAC['si_employeeview']=false;
$SHOW_CURRENT_VAC['si_employeeview']=true;

$SHOW_PREV_VAC['si_alph_staff_list']=false;
$SHOW_NEXT_VAC['si_alph_staff_list']=false;
$SHOW_CURRENT_VAC['si_alph_staff_list']=true;

$SHOW_PREV_VAC['si_dep_staff_list']=false;
$SHOW_NEXT_VAC['si_dep_staff_list']=false;
$SHOW_CURRENT_VAC['si_dep_staff_list']=true;

// ORGANISATION TABS
$BOOKMARK_NAMES['company']['Рога']="Рога и копыта";
$BOOKMARK_NAMES['company']['Интегра)']="Интегра групп";
$BOOKMARK_NAMES['company']['фгу']="ФГУ - распил бабла";

$BOOKMARK_NAMES['mobile']['*']="Все";
$BOOKMARK_NAMES['mobile']['902']="902";
$BOOKMARK_NAMES['mobile']['7 950']="+7 950";

$BOOKMARK_NAME_EXACT_FIT['company']=true;
$BOOKMARK_NAME_EXACT_FIT['mobile']=false;

$BOOKMARK_MAX_NUM_ITEMS['company']=3;


// PDF EXPORT
$PDF_TITLE="Справочник сотрудников";
$PDF_SECOND_LINE="факс: 2-222-222";
$PDF_LOGO="";
$PDF_HIDE_STAFF_WITHOUT_PHONES=true;
$PDF_MARGIN_LEFT=5;
$PDF_MARGIN_TOP=5;
$PDF_MARGIN_RIGHT=5;
$PDF_MARGIN_BOTTOM=5;
$PDF_LANDSCAPE=false;
$ENABLE_PDF_EXPORT=true;

// SORTING
$DIRECTOR_FULL_TITLE="Директор";
$DEP_SORT_ORDER["Дирекция"]='order_replace';
$DEP_SORT_ORDER["Департамент ИТ\Системные администраторы"]["Департамент ИТ\\"]='order_replace';
$STAFF_SORT_ORDER["Президент"]='order_replace';
$STAFF_SORT_ORDER["Старший"]='order_replace';
$STAFF_SORT_ORDER["Начальник"]='order_replace';
$STAFF_SORT_ORDER["Директор"]='order_replace';
$STAFF_SORT_ORDER["Руководитель"]='order_replace';
$STAFF_SORT_ORDER["Заместитель"]='order_replace';
$STAFF_SORT_ORDER["Главный"]='order_replace';

// SEARCH
$SEARCH_DEFAULT_VALUE="*";
$ONLY_BOOKMARK=false;
$ONLY_BOOKMARK_VIS=true;

// PHOTOS
$PHOTO_DIR="./files/ph";
$DIRECT_PHOTO=false;
$PHOTO_MAX_SIZE=500;
$PHOTO_EXT="jpg";
$PHOTO_MAX_WIDTH=300;
$PHOTO_MAX_HEIGHT=300;
$THUMBNAIL_PHOTO_MAX_WIDTH=32;
$THUMBNAIL_PHOTO_MAX_HEIGHT=32;
$THUMBNAIL_PHOTO_MAX_SIZE=10;
$THUMBNAIL_PHOTO_EDIT=true;
$THUMBNAIL_PHOTO_VIS=true;
$SHOW_EMPTY_AVATAR=true;

// REGULAR EXPRESSIONS (http://ru2.php.net/manual/ru/reference.pcre.pattern.syntax.php)
$RE_MAIL="(^\w+([\.\w]+)*\w@\w((\.\w)*\w+)*\.\w{2,4}$)|(^$)";
$RE_OTHER_TELEPHONE="(^[0-9]{3}$)|(^$)";
$RE_MOBILE="(^\+7[0-9]{10}$)|(^[0-9]{6}$)|(^2[0-9]{6}$)|(^$)";
$RE_TELEPHONE_NUMBER="(^[0-9]{7}$)|(^8[0-9]{10}$)|(^$)";
$RE_BIRTHDAY="(^[0-3]{1}[0-9]{1}.[0-1]{1}[0-9]{1}.[0-9]{4}$)|(^$)";
$RE_FIO="(^[ёA-zA-я-]+[\s]{1}([ёA-zA-я-]+[\s]{1}[ёA-zA-я-]+)$)|(^[ёA-zA-я-]+[\s]{1}[ёA-zA-я]{1}.[\s]{1}[ёA-zA-я-]+$)|(^$)";

// WEB-SETTINGS
$DEFAULT_PAGE="si_stafflist"; // Default page. Available settings in $PAGE_LINKS variable. For default «si_dep_staff_list»
$FAVICON_D=""; // Favicon for Desktop devices
$FAVICON_M=""; // Favicon for Mobile devices


$PAGE_LINKS['si_dep_staff_list']="По отделам";
$PAGE_LINKS['si_alph_staff_list']="По алфавиту";
$PAGE_LINKS['si_stafflist']="Поиск сотрудников";
$PAGE_LINKS['si_new_workers']="Новички";
$PAGE_LINKS['si_locked_list']="Уволенные";

//Staff searching block
$BLOCK_VIS['si_dep_staff_list']['search']=false;
$BLOCK_VIS['si_alph_staff_list']['search']=false;
$BLOCK_VIS['si_stafflist']['search']=true;
//Auth block
$BLOCK_VIS['si_dep_staff_list']['profile']=false;
$BLOCK_VIS['si_alph_staff_list']['profile']=false;
$BLOCK_VIS['si_stafflist']['profile']=true;
//Birthdays block
$BLOCK_VIS['si_dep_staff_list']['birthdays']=false;
$BLOCK_VIS['si_alph_staff_list']['birthdays']=false;
$BLOCK_VIS['si_stafflist']['birthdays']=true;
//Fast switch block
$BLOCK_VIS['si_dep_staff_list']['fast_move']=true;
$BLOCK_VIS['si_alph_staff_list']['fast_move']=true;
$HIDE_STAFF_WITHOUT_PHONES=false; // As is $PDF_HIDE_STAFF_WITHOUT_PHONES, but for staff list.
$ALPH_ITEM_IN_LINE=35; // Number of words in one row for fast switch block. By default «35»
$DEP_ITEM_IN_COL=3; // Number of departments in one row of fast switch block. by default «3»
$COPY_RIGHT="<a href=\"http://www.pitin.su\" target=\"NewWindow\">&copy; V. Pitin, 2012 </a>"; // :-)
$COPY_RIGHT="";
/* 
$DEP_ADD - Этот атрибут позволяет добавить дополнительную строку в конце названия отдела на странице с разбивкой сотрудников по отделам.
Вот так, например, можно добавить общий телефон отдела:
$DEP_ADD['Департамент управления складом\Группа приемки']="<span class=\"add_dep_info\"><a href=\"tel:234-52-23\" class=\"in_link int_phone\">234-52-23</a><span>";
*/
$DEP_ADD['Департамент управления складом\Группа приемки']="<span class=\"add_dep_info\"><a href=\"tel:222-22-22\" class=\"in_link int_phone\">222-22-22</a><span>";
$DEP_ADD['Департамент аптечной сети']="<span class=\"add_dep_info\"><a href=\"tel:111-11-11\" class=\"in_link int_phone\">111-11-11</a><span>";
$ALARM_MESSAGE=""; // Если в параметре что-то есть, то будет выводиться «тревожное» сообщение на всех страницах справочника.
//----------------------------------------------------------------------------

//Skins
$CURRENT_SKIN='default';	// By default $CURRENT_SKIN='default'.

//Other
$PHPPath="./pages";
$CHARSET_DATA="UTF-8";
$CHARSET_APP="UTF-8";
$AUTH_TYPE="none"; //basic, sspi, none
$MENU=false;

$Alphabet = array ('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Э','Ю','Я');

$MONTHS = array (1=>"Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");


$BIND_DEPUTY_AND_VACATION=true;

$FAVOURITE_CONTACTS=true;

//New users
$LDAP_CREATED_DATE_FORMAT="dd.mm.yyyy hh:mm:ss";
$NEW_USERS_NUM_DAYS=30;
$EVALUATION_PERIOD=30;
$SHOW_EVALUATION_PERIOD_MESSAGE=true;


$ENABLE_DANGEROUS_AUTH=false;

$LOCALIZATION="ru";

//XMPP
$XMPP_ENABLE=true;
$XMPP_ENCRYPTION=false;
$XMPP_SERVER="192.168.3.33";
$XMPP_PORT="5222";
$XMPP_USER="bot_fluder";
$XMPP_PASSWORD="24234dsf";
$XMPP_DOMAIN="your_jabber_server.your_domain.ru";
$XMPP_ACCOUNT_END="srv-jabber";
$XMPP_MESSAGE_LISTS_ENABLE=true;
$XMPP_LAST_MESSAGE_TIME_OF_KEEPING = 30*24*60*60;

$XMPP_MESSAGE_LISTS_TIME_OF_LIVE=30*24*60*60;
$XMPP_LAST_MESS_NUM_SYM_OF_PRUNING = 100;
$XMPP_NUM_OF_LAST_MESSAGES_PER_USER = 10;

$XMPP_MESSAGE_SIGN_ENABLE = true;
$XMPP_USE_INTERNAL_PHONE_IN_SIGN_ENABLE = true;
$XMPP_USE_MOBILE_PHONE_IN_SIGN_ENABLE = true;

$XMPP_LDAP_GROUPS_ENABLE = true;
$XMPP_LDAP_GROUPS_OU = "OU=Группы безопасности,DC=PRP,DC=ru";
$XMPP_LDAP_GROUPS_SUBSTR = "jbr";
$LDAP_XMMP_GROUP_TITLE_FIELD = "description";

$LDAP_MEMBER_FIELD = "member";

//Call via IP phones
$ENABLE_CALL_VIA_IP = true;
$PHONE_LINK_TYPE = "callto:";
$CALL_VIA_IP_CHANGE_PLUS_AND_SEVEN="08";
$CALL_VIA_IP_HOST = "192.192.192.192";
$CALL_VIA_IP_USER = "user_name";
$CALL_VIA_IP_SECRET = "Secret_111";
$CALL_VIA_IP_CHANEL = "Infinity";
$CALL_VIA_IP_CONTEXT = "phone-book";
$CALL_VIA_IP_WAIT_TIME = "30";
$CALL_VIA_IP_PRIORITY = "1";
$CALL_VIA_IP_MAX_RETRY = "0";
