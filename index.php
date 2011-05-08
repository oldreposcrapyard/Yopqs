<?php
define('is_included', true); //protection from direct display override
require_once 'inc/config.inc.php';
require_once "lang/{$CONF['lang']}.lang.php";
require_once 'inc/bbcode/BbCode.class.php';
require_once 'inc/template_tbs.php';
require_once 'inc/tbs_plugin_html.php';

$quiz_name     = $CONF['quiz_name'];
$main_page     = $LANG['mainpageuppercase'];
$start_quiz    = $LANG['startquiz'];
$start_content = $CONF['start_content'];
$welcome_text  = $LANG['welcomequizpage'];
$link1         = $CONF['link1'];
$link1_name    = $CONF['link1_name'];
$link2         = $CONF['link2'];
$link2_name    = $CONF['link2_name'];

$bb = new BbCode();
$bb->parse($start_content, false);
$start_content = $bb->getHtml();

$template = $CONF['template'];

$TBS           = new clsTinyButStrong;
$TBS->LoadTemplate("templates/$template/index.tpl");
$TBS->Show();
?>
