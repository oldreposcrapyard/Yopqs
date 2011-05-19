<?php
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';


if(isSet($_POST["username"]) 
&& strlen($_POST["username"]) <= 20 
&& isSet($_POST["password"])
&& strlen($_POST["password"]) <= 30
){
$username = $_POST["username"];
$password = $_POST["password"];

if (Alibaba::login($username, $password)) {
    header("Location: index.php");
}
else {
    Alibaba::redirectToLogin("$LANG[loginfailed]");
}

}

$PHP_SELF = getNameFile();

$TBS              = new clsTinyButStrong;
$TBS->LoadTemplate("templates/$CONF[template]/admin_login.tpl");
$TBS->Show();

?>
