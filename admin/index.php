<?php
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';

header('Content-Type: text/html; charset=utf-8');

Alibaba::forceAuthentication();
$username = Alibaba::getUsername();

$TBS              = new clsTinyButStrong;
$TBS->LoadTemplate("../templates/$CONF[template]/admin_index.tpl");
$TBS->Show();
?>
