<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>
      [onshow.CONF.quiz_name] - Marcinl's php quiz
    </title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style type="text/css">
BODY{color:#7F7F7F;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px;text-align:justify;margin:0;padding:0;}
.szukaj{border-right:0 solid gray;border-top:0 solid gray;padding-left:4px;font-size:8pt;border-left:0 solid gray;color:#cecece;border-bottom:0 solid gray;font-family:Tahoma, Verdana, Helvetica, sans-serif;height:20px;background-color:#4e4e4e;}
.przycisk{border-right:1px solid gray;border-top:1px solid gray;font-size:8pt;border-left:1px solid gray;width:120px;color:#000;border-bottom:1px solid gray;font-family:Arial ,Verdana, Helvetica, sans-serif;height:20px;background-color:#EFEFEF;}
TD{color:#7F7F7F;font-family:Arial, Verdana, Helvetica, sans-serif;font-size:11px;}
.cop{color:#4C4C4C;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:9px;}
.rek{color:#999;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px;}
A{color:#0E0E0E;text-decoration:none;}
A:hover{color:#B4B4B4;text-decoration:underline;}
A.dwa{color:#181818;text-decoration:none;font-size:9px;}
A.menu{color:#EEE;text-decoration:none;font-size:11px;}
A.trzy:hover{color:#000;text-decoration:none;font-size:11px;}
A.me{color:#7A7A7A;text-decoration:none;font-size:10px;}
A.me:hover{color:#FF8000;text-decoration:none;font-size:10px;}
A.maly{color:gray;text-decoration:none;font-size:9px;}
.maly2{font-size:7.5pt;color:#595959;font-family:Arial, Verdana;}
P{line-height:14px;padding-bottom:2px;padding-top:2px;margin:2px 7px;}
.topbar{color:#909090;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:9px;}
.tytmen{color:#fff;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;}
.stopka{color:#EFEFEF;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:9px;}
.stopka2{color:#696969;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:9px;}
.tytul{color:#2d2d2d;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;}
.reg{color:#3F3F3F;font-family:Arial, Verdana, Helvetica, sans-serif;font-size:12px;}
.tytul2{color:#2d2d2d;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;}
.tab{color:#669;font-family:Arial, Helvetica, sans-serif;font-size:10px;margin-bottom:3px;margin-top:0;padding-bottom:3px;padding-top:0;text-align:center;text-transform:uppercase;}
A.dwa:hover,A.maly:hover{color:#000;text-decoration:none;font-size:9px;}
A.menu:hover,A.trzy{color:#FFF;text-decoration:none;font-size:11px;}
.tekst,.tekst2{color:#2d2d2d;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px;}
	</style>
    <style type="text/css">
/*<![CDATA[*/
    body {
    background-color: #434242;
    }
    td.c5 {background:URL('templates/standard/img/index_06.gif');}
    td.c4 {background-color: white}
    div.c3 {text-align: center}
    td.c2 {background:URL('templates/standard/img/index_04.gif');}
    td.c1 {background:URL('templates/standard/img/index_02.jpg');}
    /*]]>*/
    </style>
  </head>
  <body>
    <table width="750" border="0" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td colspan="3">
          <img src="templates/standard/img/logo.jpg" width="750" height="176" alt="" />
        </td>
      </tr>
      <tr>
        <td colspan="3" class="c1" width="750" height="38" valign="center">
          <table border="0" width="660" align="center">
            <tr>
              <td>
                <a href="index.php" class="dwa">[onshow.LANG.mainpageuppercase]</a> 
                | <a href="http://www.stw.net23.net/">Strona autora</a>
                | <a href="[onshow.CONF.link1]">[onshow.CONF.link1_name]</a>
                | <a href="[onshow.CONF.link2]">[onshow.CONF.link2_name]</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <img src="templates/standard/img/index_03.gif" width="750" height="23" alt="" />
        </td>
      </tr>
      <tr>
        <td class="c2" width="71"></td>
        <td class="c4" width="607">
          <div class="c3">
            <h2>
              [onshow.LANG.youhavesolved] [onshow.CONF.quiz_name]
            </h2>
          </div>
          <div class="c3">
            <h1>
            [onshow.LANG.ittookyou]  
            [onshow.time_solved_quiz] [onshow.LANG.seconds], [onshow.LANG.thatis]<br>[onshow.LANG.hours]:[onshow.LANG.minutes]:[onshow.LANG.seconds] 
			<br>[onshow.normal_time] <br>
			[onshow.LANG.thatis] [onshow.score_count] [onshow.LANG.time] [onshow.LANG.besttime] [onshow.best_score]s, [onshow.LANG.archieved] [timestamp]. 
            </h1>
            <a href="quiz.php?action=reset">Reset</a>
		  </div>
        </td>
        <td class="c5" width="72"></td>
      </tr>
      <tr>
        <td colspan="3">
          <img src="templates/standard/img/index_07.gif" width="750" height="80" alt="" />
        </td>
      </tr>
    </table>
  </body>
</html>
