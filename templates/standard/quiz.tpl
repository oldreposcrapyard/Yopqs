<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>[onshow.CONF.quiz_name] - Marcinl's php quiz</title>
</head>
<body>
[onshow.message;ope=html;look]
<p align="right"> [onshow.LANG.level] [onshow._SESSION.actual_lvl] [onshow.LANG.of] [onshow._SESSION.max_lvl] </p>
<p>[onshow.question_display;ope=html;look]</p>
<p>[onshow.LANG.youranswer]:</p>
<FORM NAME = "formularz1"
ACTION = "[onshow.PHP_SELF]"
METHOD = "POST">
<INPUT TYPE="text" NAME="haslo">
<BR><BR>
<INPUT TYPE="submit" VALUE="[onshow.LANG.ianswer]">
</FORM>
<hr />
<a href="http://www.google.pl">Google</a> |
<a href="http://www.pl.wikipedia.org">Wikipedia</a> |
<a href="http://pl.wikipedia.org/wiki/Szablon:Siostrzane">Projekty siostrzane wikipedii</a> |
<a href="http://www.ttg.webuda.com/mail.php"> Marcinl </a> 2010 - 2011
<br>
<p>Strona została wygenerowana w [onshow.totaltime] sekund.</p>
</body>
</html>
