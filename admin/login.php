<?php
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';

header('Content-Type: text/html; charset=utf-8');

if(isSet($_POST['username']) 
&& strlen($_POST['username']) <= 20 
&& isSet($_POST['password'])
&& strlen($_POST['password']) <= 30
){
if (Alibaba::login($_POST['username'], $_POST['password'])) {
    header("Location: index.php");
}
else {
    Alibaba::redirectToLogin("$LANG[loginfailed]");
}
}

$PHP_SELF = getNameFile();

$TBS              = new clsTinyButStrong;
$TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_login.tpl");
$TBS->Show();

?>
