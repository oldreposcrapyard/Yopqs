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

//backup_tables('localhost','username','password','blog');
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
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

//Duration is a function used to turn seconds into a readable format, measured in weeks, days, hours, minutes and seconds.
function na_czytelny_format($secs) 
    { 
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

?>