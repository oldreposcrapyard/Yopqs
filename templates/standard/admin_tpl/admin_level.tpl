<html>
<head>
  <title>[onshow.CONF.quiz_name] - Marcinl's php quiz</title>
  <link rel="stylesheet" href=
  "http://twitter.github.com/bootstrap/assets/css/bootstrap-1.2.0.min.css" type=
  "text/css" />
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
var textarea;
var content;
document.write("<link href=\"bbeditor/styles.css\" rel=\"stylesheet\" type=\"text/css\">");


function edToolbar(obj) {
    document.write("<div class=\"toolbar\">");
	document.write("<img class=\"button\" src=\"../inc/bbeditor/images/bold.gif\" name=\"btnBold\" title=\"$LANG[bold]\" onClick=\"doAddTags('[b]','[/b]','" + obj + "')\">");
    document.write("<img class=\"button\" src=\"../inc/bbeditor/images/italic.gif\" name=\"btnItalic\" title=\"$LANG[italic]\" onClick=\"doAddTags('[i]','[/i]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"../inc/bbeditor/images/underline.gif\" name=\"btnUnderline\" title=\"$LANG[underline]\" onClick=\"doAddTags('[u]','[/u]','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"../inc/bbeditor/images/link.gif\" name=\"btnLink\" title=\"$LANG[inserturl]\" onClick=\"doURL('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"../inc/bbeditor/images/picture.gif\" name=\"btnPicture\" title=\"$LANG[insertimg]\" onClick=\"doImage('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"../inc/bbeditor/images/quote.gif\" name=\"btnQuote\" title=\"$LANG[insertquote]\" onClick=\"doAddTags('[quote]','[/quote]','" + obj + "')\">"); 
  	document.write("<img class=\"button\" src=\"../inc/bbeditor/images/code.gif\" name=\"btnCode\" title=\"$LANG[insertcode]\" onClick=\"doAddTags('[code]','[/code]','" + obj + "')\">");
    document.write("<img class=\"button\" src=\"../inc/bbeditor/images/youtube.png\" name=\"btnYoutube\" title=\"$LANG[insertyt]\" onClick=\"doAddTags('[youtube]','[/youtube]','" + obj + "')\">");
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
<br />
  <div class="container">
    <ul class="pills">
      <li><a href="index.php">Home</a></li>

      <li class="active"><a href="index.php?module=level">Level editing</a></li>

      <li><a href="#">Messages</a></li>

      <li><a href="#">Settings</a></li>

      <li><a href="logout.php">[onshow.LANG.logout]</a></li>
    </ul>

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
  <input type="button" value="Dodaj odpowiedź" onclick="dodaj_element('answers');" />
</div>
<input type="hidden" name="IsSent" value="Yes" />
<button type="submit">Wyślij</button>
</div>
</form>
</body>
</html>