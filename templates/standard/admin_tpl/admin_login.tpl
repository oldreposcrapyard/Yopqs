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
  <link rel="stylesheet" href=
  "../templates/standard/bootstrap/assets/css/bootstrap.min.css" type=
  "text/css" />

</head>
<body>
<div class="container">
<br />
<p>[onshow._GET.message;noerr]</p>
<center>
<form name='Login' action='[onshow.PHP_SELF]' method='POST' enctype='application/x-www-form-urlencoded'>
Username:
<input type='text' name='username' id='username' size='30' maxlength='20'><br /><br />
Password:
<input type='password' name='password' id='password' size='30' maxlength='30'><br /><br />
<input type='submit' name='submit' value='Submit' class='btn'>&nbsp;<br />
</form>
</center>
</div>

</body>
</html>
