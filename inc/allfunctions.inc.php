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

function getnamefile(){
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$PHP_SELF = $parts[count($parts) - 1]; 
return "$PHP_SELF";
}

//------------------------------------------------------------

function checkanswer($array,$passwd_given){
  if (!IsSet($passwd_given)){
  return false;
  }
  else{
  foreach($array as $pass){
    if($passwd_given == $pass){
      return true;
    }
  }
  return false;
}
}

//------------------------------------------------------------

function getmaxlevel(){

    if (!($query_id = mysql_query("SELECT MAX(ID_lvl) FROM `Levels`"))) {
        return("$LANG[db_query_error]");
        error_log("$LANG[db_query_error]\r\n", 3, "log/db.log");
        exit;
    } 
    
    if (!($query_id2 = mysql_result($query_id, 0))) {
        return("$LANG[db_query_error]");
        error_log("$LANG[db_query_error]\r\n", 3, "log/db.log");
        exit;
    } 
    return $query_id2;
} 

//------------------------------------------------------------

function displaytime($timeinseconds, $timeformatted){
require_once 'config.inc.php';
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
                | <a href="$link1>$link1_name</a>
                | <a href="$link2>$link2_name</a>
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
          </div><br />
          $LANG[ittookyou]<br />
          <div class="c3">
            <h1>
              $timeinseconds $LANG[seconds], $LANG[thatis] $LANG[hours]:$LANG[minutes]:$LANG[seconds]
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
}

//------------------------------------------------------------

//backup_tables('localhost','username','password','blog');
function backup_tables($host,$user,$pass,$name,$tables = '*'){
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

//------------------------------------------------------------

//Duration is a function used to turn seconds into a readable format, measured in weeks, days, hours, minutes and seconds.
function na_czytelny_format($secs){ 
        $vals = array('tygodni' => (int) ($secs / 86400 / 7), 
                      'dni' => $secs / 86400 % 7, 
                      'godzin' => $secs / 3600 % 24, 
                      'minut' => $secs / 60 % 60, 
                      'sekund' => $secs % 60); 
 
        $ret = array(); 
 
        $added = false; 
        foreach ($vals as $k => $v) { 
            if ($v > 0 || $added) { 
                $added = true; 
                $ret[] = $v . $k; 
            } 
        } 
 
        return join(' ', $ret); 
    } 


//Sample usage
//$dateOfBirth = $someTimestamp;
//$ageInSeconds = time() - $dateOfBirth;
//echo 'I am ' . duration($ageInSeconds) . ' old';

//------------------------------------------------------------

function sec2hms ($sec, $padHours = false){

    // start with a blank string
    $hms = "";
    
    // do the hours first: there are 3600 seconds in an hour, so if we divide
    // the total number of seconds by 3600 and throw away the remainder, we're
    // left with the number of hours in those seconds
    $hours = intval(intval($sec) / 3600); 

    // add hours to $hms (with a leading 0 if asked for)
    $hms .= ($padHours) 
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
          : $hours. ":";
    
    // dividing the total seconds by 60 will give us the number of minutes
    // in total, but we're interested in *minutes past the hour* and to get
    // this, we have to divide by 60 again and then use the remainder
    $minutes = intval(($sec / 60) % 60); 

    // add minutes to $hms (with a leading 0 if needed)
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";

    // seconds past the minute are found by dividing the total number of seconds
    // by 60 and using the remainder
    $seconds = intval($sec % 60); 

    // add seconds to $hms (with a leading 0 if needed)
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

    // done!
    return $hms;
    
}
?>
