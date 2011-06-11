<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title>[onshow.CONF.quiz_name] - Marcinl's php quiz</title>
<style type="text/css">
/*
Here will be styles for this page
I am currently in process of learning CSS
*/
</style>

</head>
<body>

<div id="loginform">
<p>[onshow._GET.message;noerr]</p>
<form name='Login' action='[onshow.PHP_SELF]' method='POST' enctype='application/x-www-form-urlencoded'>
<table class='table_form_1' id='table_form_1' cellspacing='0'>
	<tr>
		<td class='ftbl_row_1' ><LABEL for='username'>Username:
		</td>
		<td class='ftbl_row_1a' ><input type='text' name='username' id='username' size='30' maxlength='20'>
		</td>
	</tr>
	<tr>
		<td class='ftbl_row_2' ><LABEL for='password'>Password:
		</td>
		<td class='ftbl_row_2a' ><input type='password' name='password' id='password' size='30' maxlength='30'  value=''>
		</td>
	</tr>
	<tr>
		<td colspan='2' align='right'><input type='submit' name='submit' value='Submit'>&nbsp;<br>
		</td>
	</tr>
</table>
</form>
</div>

</body>
</html>
