<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>[onshow.CONF.quiz_name] - Marcinl's php quiz</title>
  <link rel="stylesheet" href=
  "../bootstrap/assets/css/bootstrap.min.css" type=
  "text/css" />
<script type="text/javascript">
<!--
function addElement(kontener){
  var tag = document.createElement('input');
  tag.setAttribute('type', 'text');
  tag.setAttribute('name', 'answer[]');
  tag.className = 'input';
  var container = document.getElementById(kontener);
  container.appendChild(tag);
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
var textarea;
var content;
document.write("<link href=\"bbeditor/styles.css\" rel=\"stylesheet\" type=\"text/css\">");


function edToolbar(obj) {
    document.write("<div class=\"toolbar\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/bold.gif\" name=\"btnBold\" title=\"$[onshow.LANG.bold]\" onClick=\"doAddTags('[b]','[/b]','" + obj + "')\">");
    document.write("<img class=\"button\" src=\"bbeditor/images/italic.gif\" name=\"btnItalic\" title=\"[onshow.LANG.italic]\" onClick=\"doAddTags('[i]','[/i]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/underline.gif\" name=\"btnUnderline\" title=\"[onshow.LANG.underline]\" onClick=\"doAddTags('[u]','[/u]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/link.gif\" name=\"btnLink\" title=\"[onshow.LANG.inserturl]\" onClick=\"doURL('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/picture.gif\" name=\"btnPicture\" title=\"[onshow.LANG.insertimg]\" onClick=\"doImage('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"bbeditor/images/quote.gif\" name=\"btnQuote\" title=\"[onshow.LANG.insertquote]\" onClick=\"doAddTags('[quote]','[/quote]','" + obj + "')\">"); 
  	document.write("<img class=\"button\" src=\"bbeditor/images/code.gif\" name=\"btnCode\" title=\"[onshow.LANG.insertcode]\" onClick=\"doAddTags('[code]','[/code]','" + obj + "')\">");
    document.write("<img class=\"button\" src=\"bbeditor/images/youtube.png\" name=\"btnYoutube\" title=\"[onshow.LANG.insertyt]\" onClick=\"doAddTags('[youtube]','[/youtube]','" + obj + "')\">");
	document.write("</div>");
				}

function doImage(obj)
{
textarea = document.getElementById(obj);
var url = prompt('[onshow.LANG.enterimg]','http://');
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
var url = prompt('[onshow.LANG.enterurl]','http://');
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
		var rep = tag1 + sel + tag2;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}
}
</script>  
</head>
<body>
  <br />

  <div class="container">
    <ul class="pills">
      <li><a href="index.php">[onshow.LANG.mainpage]</a></li>

      <li class="active"><a href="level.php">[onshow.LANG.levelediting]</a></li>

      <li><a href="logout.php">[onshow.LANG.logout]</a></li>
    </ul>

<form action="[onshow.PHP_SELF]" method="post">
[onshow.errors;ope=html;look;noerr]<br>
[onshow.LANG.level]:<input type="text" name="lvl_id" /><br>
[onshow.LANG.question]:
<br>
<script>edToolbar('question');</script>
<textarea name="question" id="question" rows="8" cols="35" class="ed">
</textarea>
<br>
<div id="answers">
[onshow.LANG.answers]:<br><input type="text" name="answer[]" class="input"/>
</div>
<div>
  <input type="button" value="[onshow.LANG.addanswer]" onclick="addElement('answers');" class="btn" />
</div>
<input type="hidden" name="IsSent" value="Yes" />
<button type="submit" class="btn">[onshow.LANG.send]</button>
</form>
</body>
</html>

