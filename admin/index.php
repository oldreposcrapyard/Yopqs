<?php
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';

header('Content-Type: text/html; charset=utf-8');

Alibaba::forceAuthentication();
if (isset($_GET['module']) && file_exists('./' . $_GET['module'] . '.php')) {
    include $_GET['module'] . '.php';
} else {
    $TBS = new clsTinyButStrong;
    $TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_index.tpl");
    $TBS->Show();
}
?>
