<?php
require_once 'inc/config.inc.php';
require_once "lang/{$CONF['lang']}.lang.php";
require_once 'inc/bbcode/BbCode.class.php';
require_once 'inc/template_tbs.php';
require_once 'inc/tbs_plugin_html.php';

$bb = new BbCode();
$bb->parse($CONF['start_content'], false);
$start_content = $bb->getHtml();

$TBS           = new clsTinyButStrong;
$TBS->LoadTemplate("templates/$CONF[template]/index.tpl");
$TBS->Show();
?>
