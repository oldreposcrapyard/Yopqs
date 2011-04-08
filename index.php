<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require_once 'inc/config.inc.php';
require_once "lang/{$CONF['lang']}.lang.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      <?php echo "$CONF[quiz_name]"; ?> - Marcinl's php quiz
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
                <a href="index.php" class="dwa"><?php echo "$LANG[mainpageuppercase]"; ?></a> 
                | <a href="http://www.stw.net23.net/">Strona autora</a>
                | <a href="<?php echo "$link1"; ?>"><?php echo "$link1_name"; ?></a>
                | <a href="<?php echo "$link2"; ?>"><?php echo "$link2_name"; ?></a>
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
              <?php echo "$LANG[welcomequizpage] $CONF[quiz_name]"; ?>
            </h2>
          </div><br />
          <?php echo "$CONF[start_content]"; ?><br />
          <div class="c3">
            <h1>
              <a href="quiz.php"><?php echo "$LANG[startquiz]"; ?></a>
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
