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

require_once '../inc/config.inc.php';

require_once "../lang/{$CONF['lang']}.lang.php";

require_once '../inc/allfunctions.inc.php';

require_once '../inc/db.inc.php';

$PHP_SELF = getnamefile();

if (!($conn = mysql_connect($db_hostname, $db_username, $db_password))) {
    print("$LANG[db_connect_error]");
    error_log("$LANG[db_connect_error]", 3, "../log/db.log");
    exit;
}

if (!($db = mysql_select_db($db_name, $conn))) {
    print("$LANG[db_select_error]");
    error_log("$LANG[db_select_error]", 3, "../log/db.log");
    exit;
}

$FORM = <<<FORM
<head>
<script type="text/javascript">
<!--
function dodaj_element(kontener){
  var znacznik = document.createElement('input');
  znacznik.setAttribute('type', 'text');
  znacznik.setAttribute('name', 'answer[]');
  znacznik.className = 'input';
  var kontener = document.getElementById(kontener);
  kontener.appendChild(znacznik);
}
//-->
</script>
<style type="text/css">
<!--
input.input { display: block; }
-->
</style>
<script type="text/javascript">
/*****************************************/
// Name: Javascript Textarea BBCode Markup Editor
// Version: 1.3
// Author: Balakrishnan
// Last Modified Date: 25/jan/2009
// License: Free
// URL: http://www.corpocrat.com
/******************************************/
var textarea;$LANG[bold]
var content;
document.write("<link href=\"bbeditor/styles.css\" rel=\"stylesheet\" type=\"text/css\">");


function edToolbar(obj) {
    document.write("<div class=\"toolbar\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/bold.gif\" name=\"btnBold\" title=\"$LANG[bold]\" onClick=\"doAddTags('[b]','[/b]','" + obj + "')\">");
    document.write("<img class=\"button\" src=\"bbeditor/images/italic.gif\" name=\"btnItalic\" title=\"$LANG[italic]\" onClick=\"doAddTags('[i]','[/i]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/underline.gif\" name=\"btnUnderline\" title=\"$LANG[underline]\" onClick=\"doAddTags('[u]','[/u]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/link.gif\" name=\"btnLink\" title=\"$LANG[inserturl]\" onClick=\"doURL('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/picture.gif\" name=\"btnPicture\" title=\"$LANG[insertimg]\" onClick=\"doImage('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/quote.gif\" name=\"btnQuote\" title=\"$LANG[insertquote]\" onClick=\"doAddTags('[quote]','[/quote]','" + obj + "')\">"); 
  	document.write("<img class=\"button\" src=\"bbeditor/images/code.gif\" name=\"btnCode\" title=\"$LANG[insertcode]\" onClick=\"doAddTags('[code]','[/code]','" + obj + "')\">");
    document.write("<img class=\"button\" src=\"bbeditor/images/youtube.png\" name=\"btnYoutube\" title=\"$LANG[insertyt]\" onClick=\"doAddTags('[youtube]','[/youtube]','" + obj + "')\">");
	document.write("</div>");
	//document.write("<textarea id=\""+ obj +"\" name = \"" + obj + "\" cols=\"" + width + "\" rows=\"" + height + "\"></textarea>");
				}

function doImage(obj)
{
textarea = document.getElementById(obj);
var url = prompt('$LANG[enterimg]','http://');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

if (url != '' && url != null) {

	if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				sel.text = '[img]' + url + '[/img]';
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		var rep = '[img]' + url + '[/img]';
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
			
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}
}

}

function doURL(obj)
{
textarea = document.getElementById(obj);
var url = prompt('$LANG[enterurl]','http://');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

if (url != '' && url != null) {

	if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				
			if(sel.text==""){
					sel.text = '[url]'  + url + '[/url]';
					} else {
					sel.text = '[url=' + url + ']' + sel.text + '[/url]';
					}			

				//alert(sel.text);
				
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
        var sel = textarea.value.substring(start, end);
		
		if(sel==""){
				var rep = '[url]' + url + '[/url]';
				} else
				{
				var rep = '[url=' + url + ']' + sel + '[/url]';
				}
	    //alert(sel);
		
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
			
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}
 }
}

function doAddTags(tag1,tag2,obj)
{
textarea = document.getElementById(obj);
	// Code for IE
		if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				//alert(sel.text);
				sel.text = tag1 + sel.text + tag2;
			}
   else 
    {  // Code for Mozilla Firefox
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
		
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;

		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		var rep = tag1 + sel + tag2;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
		
		
	}
}
</script>  
</head>
<body>
<form action="$PHP_SELF" method="post">
Lvl:<input type="text" name="lvl_id" /><br>
Question:
<br>
<script>edToolbar('question'); </script>
<textarea name="question" id="question" rows="8" cols="35" class="ed">
</textarea>
<br>
<div id="answers">
Answers:<br><input type="text" name="answer[]" class="input"/>
</div>
<div>
  <input type="button" value="Dodaj odpowied&#378;" onclick="dodaj_element('answers');" />
</div>
<input type="hidden" name="IsSent" value="Yes" />
<button type="submit">Wy&#347;lij</button>
</form>
</body>
FORM;

If (IsSet($_POST['IsSent']) && $_POST['IsSent'] == 'Yes' && IsSet($_POST['lvl_id']) && IsSet($_POST['answer']) && IsSet($_POST['question'])) {
    $lvl_id   = mysql_real_escape_string($_POST['lvl_id']);
    $question = mysql_real_escape_string($_POST['question']);
    
    foreach ($_POST['answer'] as $value) {
        $answer = mysql_real_escape_string($value);
        $query1 = "INSERT INTO Answers (ID, ID_lvl, Answer) VALUES('NULL', '$lvl_id', '$answer');";
        If (!($result = mysql_query($query1))) {
            $error = mysql_error();
            print("$error");
            error_log("$error/n", 3, "../log/db.log");
            exit;
        }
    }
    
    $query2 = "INSERT INTO Levels (ID, ID_lvl, Question) VALUES('NULL', '$lvl_id','$question')";
    
    
    If (!($result = mysql_query($query2))) {
        $error = mysql_error();
        print("$error");
        error_log("$error/n", 3, "../log/db.log");
        exit;
    } else {
        echo "$LANG[db_query_success]";
        echo "
<form action=\"$PHP_SELF\" method=\"post\">
<button type=\"submit\">Z powrotem</button>
</form>
";
    }
} else {
    echo "$FORM";
}
mysql_close();
?>
