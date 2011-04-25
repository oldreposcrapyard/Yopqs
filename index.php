<?php
require_once 'inc/config.inc.php';
require_once "lang/{$CONF['lang']}.lang.php";
require_once('inc/template_tbs.php');
$TBS = new clsTinyButStrong;
$quiz_name     = "$CONF[quiz_name]";
$main_page     = "$LANG[mainpageuppercase]";
$start_quiz    = "$LANG[startquiz]";
$start_content = "$CONF[start_content]";
$welcome_text  = "$LANG[welcomequizpage]";
$link1         = "$CONF[link1]";
$link1_name    = "$CONF[link1_name]";
$link2         = "$CONF[link2]";
$link2_name    = "$CONF[link2_name]";
$TBS->LoadTemplate("templates/{$CONF[template]}/index.tpl");
$TBS->Show();
?>
