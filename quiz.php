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

require_once 'inc/db.inc.php';

ob_end_flush();

require_once "lang/{$CONF['lang']}.lang.php";

require_once 'inc/allfunctions.inc.php';

require_once 'inc/bbcode/BbCode.class.php';

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
<div id="redbox">
<p> $LANG[badanswer] </p>
</div>
FAIL;
    
    $ANSWEREMPTY = <<<AE
<link rel="Stylesheet" type="text/css" href="inc/style_frames.css" />
<div id="redbox">
<p> $LANG[emptyanswer] </p>
</div>
AE;
    
    $WON = <<<WON
  <link rel="Stylesheet" type="text/css" href="inc/style_frames.css" />
  <div id="greenbox">
  <p>$LANG[goodanswer]</p>
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
        if(!IsSet($_SESSION['end_time'])){
        $_SESSION['end_time'] = time();
        }
        $start_time       = $_SESSION['start_time'];
        $time_solved_quiz = $_SESSION['end_time'] - $_SESSION['start_time'];
        $normal_time      = sec2hms($time_solved_quiz, true); 
        echo <<<DISP
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      $CONF[quiz_name] - Marcinl's php quiz
    </title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="inc/styl.css" />
    <style type="text/css">
/*<![CDATA[*/
    body {
    background-color: #434242;
    }
    td.c5 {background:URL('img/index_06.gif');}
    td.c4 {background-color: white}
    div.c3 {text-align: center}
    td.c2 {background:URL('img/index_04.gif');}
    td.c1 {background:URL('img/index_02.jpg');}
    /*]]>*/
    </style>
  </head>
  <body>
    <table width="750" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td colspan="3">
          <img src="img/logo.jpg" width="750" height="176" alt="" />
        </td>
      </tr>
      <tr>
        <td colspan="3" class="c1" width="750" height="38" valign="center">
          <table border="0" width="660" align="center">
            <tr>
              <td>
                <a href="index.php" class="dwa">$LANG[mainpageuppercase]</a> 
                | <a href="http://www.stw.net23.net/">Strona autora</a>
                | <a href="$link1">$link1_name</a>
                | <a href="$link2">$link2_name</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <img src="img/index_03.gif" width="750" height="23" alt="" />
        </td>
      </tr>
      <tr>
        <td class="c2" width="71"></td>
        <td class="c4" width="607">
          <div class="c3">
            <h2>
              $LANG[youhavesolved] $CONF[quiz_name]
            </h2>
          </div>
          <div class="c3">
            <h1>
            $LANG[ittookyou]  
            $time_solved_quiz $LANG[seconds], $LANG[thatis]<br>$LANG[hours]:$LANG[minutes]:$LANG[seconds]<br>$normal_time
            </h1>
          </div>
        </td>
        <td class="c5" width="72"></td>
      </tr>
      <tr>
        <td colspan="3">
          <img src="img/index_07.gif" width="750" height="80" alt="" />
        </td>
      </tr>
    </table>
  </body>
</html>
DISP;
        exit();
    } else {
        echo "$CONF[won_page_content]";
        include_once 'inc/foot.inc.php';
    }
} elseif (isSet($_POST['haslo']) && checkanswer($result, $_POST['haslo'])) {
    echo $WON;
    $_SESSION['actual_lvl']++;
} elseif (isSet($_POST["haslo"]) && $_POST["haslo"] == "" || preg_match('/^\s*$/', $_POST['haslo'])) {
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

//-----------------
// Parsing BBcode
//-----------------
$bb = new BbCode();
$bb->parse($query_question['question'], false);
$question_display = $bb->getHtml();

echo "
<!-- revision 2 -->
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

//--------------------------
// Footer
//--------------------------
include_once 'inc/foot.inc.php';

mysql_close();

?>							
