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


function getNameFile() {
    $currentFile = $_SERVER['SCRIPT_NAME'];
    $parts       = Explode('/', $currentFile);
    $PHP_SELF    = $parts[count($parts) - 1];
    return $PHP_SELF;
}

//------------------------------------------------------------

function checkAnswer($array, $passwd_given) {
    if (!IsSet($passwd_given)) {
        return false;
    } else {
        foreach ($array as $pass) {
            if (mb_strtolower($passwd_given, 'UTF-8') == $pass) {
                return true;
            }
        }
        return false;
    }
}

//------------------------------------------------------------

// This function converts seconds into HH:MM:SS format.
function sec2hms ($sec, $padHours = false){
    $hms = '';
    $hours = intval(intval($sec) / 3600); 
    $hms .= ($padHours) 
          ? str_pad($hours, 2, '0', STR_PAD_LEFT). ':'
          : $hours. ':';
    $minutes = intval(($sec / 60) % 60); 
    $hms .= str_pad($minutes, 2, '0', STR_PAD_LEFT). ':';
    $seconds = intval($sec % 60); 
    $hms .= str_pad($seconds, 2, '0', STR_PAD_LEFT);
    return $hms;   
}

//------------------------------------------------------------
/*
function retrieveConfFromDb($conf_name){

    if (!($query_conf = mysql_query("SELECT Value FROM Config WHERE Name='$conf_name'"))) {
        exit;
    } 
    
    if (!($query_result = mysql_result($query_conf, 0))) {
        exit;
    } 
    return $query_result;
}
*/
?>
