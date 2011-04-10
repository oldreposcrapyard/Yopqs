<?php
// Copyright (C) 2010 by Marcin Lawniczak <marcin.safmb@wp.pl> |<www.stw.net23.net>
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

require_once 'inc/config.inc.php';

require_once "lang/{$CONF['lang']}.lang.php";

require_once 'inc/allfunctions.inc.php';

require_once 'inc/db.inc.php';

include_once('inc/BbCode.class.php');

$PHP_SELF = getnamefile();
//---------------------------
// Database connection
//---------------------------
if (!($conn = mysql_connect($db_hostname, $db_username, $db_password))) {
    print("$LANG[db_connect_error]");
    error_log("$LANG[db_connect_error]\r\n", 3, "../log/db.log");
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
    error_log("$LANG[db_select_error]\r\n", 3, "../log/db.log");
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

$max_level = getmaxlevel();

//------------------
// Variables for Game...
//-------------
//shall be moved to config or sth nothing but form uses it

If (!IsSet($FAIL) && !IsSet($ANSWEREMPTY) && !IsSet($WON)) {
    $FAIL = <<<FAIL
<link rel="Stylesheet" type="text/css" href="inc/style_frames.css" />
<div id="fail">
<p> $LANG[fail] </p>
</div>
FAIL;
    
    $ANSWEREMPTY = <<<AE
<link rel="Stylesheet" type="text/css" href="inc/style_frames.css" />
<div id="fail">
<p> $LANG[answerempty] </p>
</div>
AE;
    
    $WON = <<<WON
  <link rel="Stylesheet" type="text/css" href="inc/style_frames.css" />
  <div id="text">
  <p>$LANG[togettonextlevel]</p>
  </div>
WON;
}


//-------------
// Getting answers from database
//-------------

if (!($query1 = mysql_query("SELECT Answer FROM `Answers` WHERE ID_lvl=$_SESSION[actual_lvl]"))) {
    print("$LANG[db_query_error]");
    error_log("$LANG[db_query_error]\r\n", 3, "log/db.log");
    exit;
}

while ($row = mysql_fetch_array($query1, MYSQL_ASSOC)) {
    $result[] = $row['Answer'];
}

//-----------------
// Checking answer
//-----------------
if (isSet($_POST['haslo']) && checkanswer($result, $_POST['haslo']) && $_SESSION['actual_lvl'] >= $max_level) {
    if ($CONF['measure_time']) {
        $now_time         = time();
        $start_time       = $_SESSION['start_time'];
        $time_solved_quiz = $now_time - $start_time;
        $normal_time      = sec2hms($time_solved_quiz, true); 
        echo "$normal_time";
        exit();
    } else {
        echo "$CONF[won_page_content]";
        include_once 'inc/foot.inc.php';
    }
} elseif (isSet($_POST['haslo']) && checkanswer($result, $_POST['haslo'])) {
    echo $WON;
    $_SESSION['actual_lvl']++;
} elseif (isSet($_POST["haslo"]) && $_POST["haslo"] == "") {
    echo $ANSWEREMPTY;
} elseif (!isSet($_POST["haslo"])) {
    echo '';
} else {
    echo "$FAIL";
    include_once("$PHP_SELF");
}

//-----------------
// Form data
//-----------------

if (!($query_question = mysql_query("SELECT question FROM `Levels` WHERE ID_lvl=$_SESSION[actual_lvl]"))) {
    print("$LANG[db_query_error]");
    error_log("$LANG[db_query_error]\r\n", 3, "log/db.log");
    exit;
}
if (!($query_question = mysql_fetch_assoc($query_question))) {
    print("$LANG[db_query_error]");
    error_log("$LANG[db_query_error]\r\n", 3, "log/db.log");
    exit;
}

//
//Parsing BBcode should be here(is now)
//
$bb = new BbCode();
$bb->parse($query_question['question'], false);
$question_display = $bb->getHtml();

echo "
<p align=\"right\"> $LANG[level] $_SESSION[actual_lvl] $LANG[of] $max_level </p>
<p>$question_display</p>
<p>$LANG[youranswer]:</p>
<FORM NAME = \"formularz1\"
ACTION = \"$PHP_SELF\"
METHOD = \"POST\">
<INPUT TYPE=\"text\" NAME=\"haslo\">
<BR><BR>
<INPUT TYPE=\"submit\" VALUE=\"$LANG[ianswer]\">
</FORM>
";

//<img src=\"$img[$_SESSION'actual_lvl]]\" alt=\"Image\" /> 
//move to database and when uploading to server just remember it's name
//Or maybe the bbcode solves it?

//--------------------------
// Footer
//--------------------------
include_once 'inc/foot.inc.php';
//--------------------------
// Debug mode
//--------------------------
//if ($CONF['debug_mode'] == TRUE) {   
//    echo "<br><font color=\"red\">Debug mode</font><br>";
//    echo "This file name: {$PHP_SELF}<br>";
//    echo "Actual level: ";
//    $debug_lvl =  print_r($_SESSION);
//    echo '<br>DATABASE CONNECTION SUCCESSFUL<br>';
//    echo "$max_level<br>";
//    If (Is_Array($result)) {
//        echo 'array it is<br>';
//    }
//    print_r($result);
//}
mysql_close();

?>							
