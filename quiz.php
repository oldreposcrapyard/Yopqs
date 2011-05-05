<?php
// Copyright (C) 2010 - 2011 by Marcin Lawniczak <marcin.safmb@wp.pl> |<www.stw.net23.net>
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 3
// of the License, or (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//---------------------------
// Page encoding
//---------------------------
header('Content-Type: text/html; charset=utf-8');
//---------------------------
//Error reporting
//---------------------------
error_reporting(E_ALL);
ini_set('display_errors', '1');
//---------------------------
// Includes and functions
//---------------------------
session_start();
ob_start();
require_once 'inc/config.inc.php';
ob_end_flush();
require_once "lang/{$CONF['lang']}.lang.php";
require_once 'inc/allfunctions.inc.php';
require_once 'inc/bbcode/BbCode.class.php';
$template = $CONF['template'];
//template files
require_once 'inc/template_tbs.php';
require_once 'inc/tbs_plugin_html.php';
$PHP_SELF = getnamefile();
//---------------------------
// Database connection
//---------------------------
if (!($conn = mysql_connect($db_hostname, $db_username, $db_password))) {
    print("$LANG[db_connect_error]");
    error_log("$LANG[db_connect_error]\r\n", 3, '../log/db.log');
    exit;
}
//---------------------------
// Database encoding
//---------------------------
mysql_set_charset('utf8', $conn);
//---------------------------
// Database selecting
//---------------------------
if (!($db = mysql_select_db($db_name, $conn))) {
    print("$LANG[db_select_error]");
    error_log("$LANG[db_select_error]\r\n", 3, '../log/db.log');
    exit;
}
//---------------------------
// New player
//---------------------------
If (!IsSet($_SESSION['start_time']) && $CONF['measure_time']) {
    $_SESSION['start_time'] = time();
}
If (!IsSet($_SESSION['actual_lvl'])) {
    $_SESSION['actual_lvl'] = 1;
}
//------------------
// Maximum level
//------------------
$max_level   = getmaxlevel();
//------------------
// Variables for Game...
//-------------
//shall be moved to config or sth nothing but form uses it
$FAIL        = <<<FAIL
<link rel="Stylesheet" type="text/css" href="templates/$template/style_frames.css" />
<div id="redbox">
<p>$LANG[badanswer]</p>
</div>
FAIL;
$ANSWEREMPTY = <<<AE
<link rel="Stylesheet" type="text/css" href="templates/$template/style_frames.css" />
<div id="redbox">
<p>$LANG[emptyanswer]</p>
</div>
AE;
$WON         = <<<WON
<link rel="Stylesheet" type="text/css" href="templates/$template/style_frames.css" />
<div id="greenbox">
<p>$LANG[goodanswer]</p>
</div>
WON;
//-------------
// Getting answers from database
//-------------
if (!($query1 = mysql_query("SELECT Answer FROM `Answers` WHERE ID_lvl=$_SESSION[actual_lvl]"))) {
print("$LANG[db_query_error]");
error_log("$LANG[db_query_error]\r\n", 3, 'log/db.log');
exit;
}
while ($row = mysql_fetch_array($query1, MYSQL_ASSOC)) {
$result[] = $row['Answer'];
}
//-----------------
// Checking answer
//-----------------
if (isSet($_POST['haslo'])) { //jezeli odpowiedz ustawiona
    if (checkanswer($result, $_POST['haslo']) && $_SESSION['actual_lvl'] >= $max_level) { //jezeli dobra odpowiedz na ostatni level
        if ($CONF['measure_time']) { //jezeli mierzyc czas
            if (!IsSet($_SESSION['end_time'])) {
                $_SESSION['end_time'] = time();
            }
            $start_time       = $_SESSION['start_time'];
            $time_solved_quiz = $_SESSION['end_time'] - $_SESSION['start_time'];
            $normal_time      = sec2hms($time_solved_quiz, true);
            $quiz_name        = $CONF['quiz_name'];
            $main_page        = $LANG['mainpageuppercase'];
            $link1            = $CONF['link1'];
            $link1_name       = $CONF['link1_name'];
            $link2            = $CONF['link2'];
            $link2_name       = $CONF['link2_name'];
            $youhavesolved    = $LANG['youhavesolved'];
            $ittookyou        = $LANG['ittookyou'];
            $seconds          = $LANG['seconds'];
            $thatis           = $LANG['thatis'];
            $hours            = $LANG['hours'];
            $minutes          = $LANG['minutes'];
            //template display
            $TBS              = new clsTinyButStrong;
            $TBS->LoadTemplate("templates/$template/quiz_time.tpl");
            $TBS->Show();
            exit();
        } else { //jezeli nie mierzyc czasu
            echo "$CONF[won_page_content]";
            include_once 'inc/foot.inc.php';
            exit;
        }
    }
    if (checkanswer($result, $_POST['haslo'])) { //jezeli dobra odpowiedz na level inny niz ostatni
        echo $WON;
        $_SESSION['actual_lvl']++;
    }
    elseif ($_POST['haslo'] == '' || preg_match('/^\s*$/', $_POST['haslo'])) { //jezeli odpowiedz pusta
        echo $ANSWEREMPTY;
    }
    elseif (!checkanswer($result, $_POST['haslo'])) { //odpowiedz zla
        echo "$FAIL";
        include_once "$PHP_SELF";
    }
} elseif (!isSet($_POST['haslo'])) { //jezeli nie wysłana odpowiedz
    echo '';
}
//-----------------
// Form data
//-----------------
if (!($query_question = mysql_query("SELECT question FROM `Levels` WHERE ID_lvl=$_SESSION[actual_lvl]"))) {
    print("$LANG[db_query_error]");
    error_log("$LANG[db_query_error]", 3, 'log/db.log');
    exit;
}

if (!($query_question = mysql_fetch_array($query_question, MYSQL_ASSOC))) {
    print("$LANG[db_query_error]");
    error_log("$LANG[db_query_error]", 3, 'log/db.log');
    exit;
}

mysql_close();
//-----------------
// Parsing BBcode
//-----------------
$bb = new BbCode();
$bb->parse($query_question['question'], false);
$question_display = $bb->getHtml();
echo <<<FORM
<!-- revision 6 -->
<p align="right"> $LANG[level] $_SESSION[actual_lvl] $LANG[of] $max_level </p>
<p>$question_display</p>
<p>$LANG[youranswer]:</p>
<FORM NAME = "formularz1"
ACTION = "$PHP_SELF"
METHOD = "POST">
<INPUT TYPE="text" NAME="haslo">
<BR><BR>
<INPUT TYPE="submit" VALUE="$LANG[ianswer]">
</FORM>
FORM;
//--------------------------
// Footer
//--------------------------
require_once 'inc/foot.inc.php';
?>							
