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

ob_start();
//start measuring time
$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$starttime = $mtime;

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
require 'inc/config.inc.php';
require "lang/{$CONF['lang']}.lang.php";
require 'inc/allfunctions.inc.php';
require 'inc/bbcode/BbCode.php';
//template files
require 'inc/template_tbs.php';
require 'inc/tbs_plugin_html.php';
$PHP_SELF = getNameFile();
//---------------------------
// Database connection
//---------------------------
try {
    $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_name;charset=utf8", $db_username, $db_password, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch (PDOException $e) {
    echo $LANG['db_connect_error'] . $e->getMessage();
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
function getmaxlevel(){
try
   {
   $stmt = $pdo -> query('SELECT MAX(ID_lvl) FROM `Levels`');

          foreach($stmt as $row)
      {
          return $row[0];
      }

   $stmt -> closeCursor();
   
   }
   catch(PDOException $e)
   {
      return $e->getMessage();
   }
}

If (!IsSet($_SESSION['max_lvl'])) {
    $_SESSION['max_lvl'] = getmaxlevel();
}
//------------------
// Variables for Game...
//-------------
//shall be moved to config or sth nothing but form uses it
$FAIL        = <<<FAIL
<link rel="Stylesheet" type="text/css" href="templates/$CONF[template]/style_frames.css" />
<div id="redbox">
<p>$LANG[badanswer]</p>
</div>
FAIL;
$ANSWEREMPTY = <<<AE
<link rel="Stylesheet" type="text/css" href="templates/$CONF[template]/style_frames.css" />
<div id="redbox">
<p>$LANG[emptyanswer]</p>
</div>
AE;
$WON         = <<<WON
<link rel="Stylesheet" type="text/css" href="templates/$CONF[template]/style_frames.css" />
<div id="greenbox">
<p>$LANG[goodanswer]</p>
</div>
WON;
$FOOT        = <<<FOOTER
<hr />
<a href="http://www.google.pl">Google</a> |
<a href="http://www.pl.wikipedia.org">Wikipedia</a> |
<a href="http://pl.wikipedia.org/wiki/Szablon:Siostrzane">Projekty siostrzane wikipedii</a> |
<a href="http://www.ttg.webuda.com/mail.php"> Marcinl </a> 2010 - 2011
FOOTER;
//-------------
// Getting answers from database
//-------------
 try
   {
   $sql = 'SELECT Answer FROM `Answers` WHERE ID_lvl=:actual_lvl';
   $stmt_answers = $pdo -> prepare($sql);
   $stmt_answers ->execute(array(':actual_lvl'=>$_SESSION['actual_lvl']));
          foreach($stmt_answers as $row)
      {
          $result[] = $row['Answer'];
      }

   $stmt -> closeCursor();

   }
   catch(PDOException $e)
   {
      echo $LANG['db_query_error'] . $e->getMessage();
   }
//-----------------
// Checking answer
//-----------------
if (isSet($_POST['haslo'])) { //jezeli odpowiedz ustawiona
    if (checkanswer($result, $_POST['haslo']) && $_SESSION['actual_lvl'] >= $_SESSION['max_lvl']) { //jezeli dobra odpowiedz na ostatni level
        $_SESSION['last_level_passed'] = 'TRUE';
        if ($CONF['measure_time']) { //jezeli mierzyc czas
            if (!IsSet($_SESSION['end_time'])) {
                $_SESSION['end_time'] = time();
            }
            $time_solved_quiz = $_SESSION['end_time'] - $_SESSION['start_time'];
            $normal_time      = sec2hms($time_solved_quiz, true);
            //template display
            $TBS              = new clsTinyButStrong;
            $TBS->LoadTemplate("templates/$CONF[template]/quiz_time.tpl");
            $TBS->Show();
            exit();
        } else { //jezeli nie mierzyc czasu
            echo $CONF['won_page_content'];
            include_once 'inc/foot.inc.php';
            exit;
        }
    }
    if (checkanswer($result, $_POST['haslo'])) { //jezeli dobra odpowiedz na level inny niz ostatni
        $message = $WON;
        ++$_SESSION['actual_lvl'];
    }
    elseif ($_POST['haslo'] == '' || preg_match('/^\s*$/', $_POST['haslo'])) { //jezeli odpowiedz pusta
        $message = $ANSWEREMPTY;
    }
    elseif (!checkanswer($result, $_POST['haslo'])) { //odpowiedz zla
        $message = $FAIL;
    }
} elseif (!isSet($_POST['haslo'])) { //jezeli nie wysłana odpowiedz
    if(isSet($_SESSION['last_level_passed'])){
    if ($CONF['measure_time']) { //jezeli mierzyc czas
            if (!IsSet($_SESSION['end_time'])) {
                $_SESSION['end_time'] = time();
            }
            $time_solved_quiz = $_SESSION['end_time'] - $_SESSION['start_time'];
            $normal_time      = sec2hms($time_solved_quiz, true);
            //template display
            $TBS              = new clsTinyButStrong;
            $TBS->LoadTemplate("templates/$CONF[template]/quiz_time.tpl");
            $TBS->Show();
            exit;
        } else { //jezeli nie mierzyc czasu
            echo $CONF['won_page_content'];
            echo $FOOT;
            exit;
        }
    }
} 

//-----------------
// Form data
//-----------------
try
   {
   $sql = 'SELECT question FROM `Levels` WHERE ID_lvl=:actual_lvl';
   $stmt_question = $pdo -> prepare($sql);
   $stmt_question ->execute(array(':actual_lvl'=>$_SESSION['actual_lvl']));
          foreach($stmt_question as $row)
      {
          $query_question[] = $row['question'];
      }

   $stmt -> closeCursor();

   }
   catch(PDOException $e)
   {
      echo $LANG['db_query_error'] . $e->getMessage();
   }

//-----------------
// Parsing BBcode
//-----------------
$bb = new BbCode();
$bb->parse($query_question['question'], false);
$question_display = $bb->getHtml();
if (!isSet($message)){
$message = '';
}

$mtime = microtime(); 
$mtime = explode(" ",$mtime); 
$mtime = $mtime[1] + $mtime[0]; 
$endtime = $mtime; 
$totaltime = ($endtime - $starttime); 
//template display
$TBS              = new clsTinyButStrong;
$TBS->LoadTemplate("templates/$CONF[template]/quiz.tpl");
$TBS->Show();
ob_end_flush();
?>							
