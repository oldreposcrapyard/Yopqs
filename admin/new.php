<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
require '../inc/config.inc.php';
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';
header('Content-Type: text/html; charset=utf-8');
Alibaba::forceAuthentication();
$PHP_SELF = getNameFile();

//db connection
try {
    $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_name;charset=utf8", $db_username, $db_password, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo $LANG['db_connect_error'] . $e->getMessage();
    exit;
}

// check if the form has been submitted. If it has, start to process the form and save it to the database
if (IsSet($_POST['IsSent']) && $_POST['IsSent'] == 'Yes') {
    // get form data, making sure it is valid
    $lvl_id   = mysql_real_escape_string(htmlspecialchars($_POST['lvl_id']));
    $answer   = mysql_real_escape_string(htmlspecialchars($_POST['answer']));
    $question = mysql_real_escape_string(htmlspecialchars($_POST['question']));
    // check to make sure both fields are entered
    if ($lvl_id = '' || $answer = '' || $question = '') {
        // generate error message
        $errors = '<div style="padding:4px; border:1px solid red; color:red;">Please fill in all required fields!</div>';
        // if either field is blank, display the form again
        $TBS    = new clsTinyButStrong;
        $TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_new.tpl");
        $TBS->Show();
    } else {
        // save the data to the database
        //processing answers
        foreach ($answer as $value) {
            if ($value != "") {
                try {
                    $sql          = 'INSERT INTO Answers (ID_lvl, Answer) VALUES(:lvl_id, :answer)';
                    $stmt_answers = $pdo->prepare($sql);
                    $stmt_answers->execute(array(
                        ':lvl_id' => $lvl_id,
                        ':answer' => $answer
                    ));
                }
                catch (PDOException $e) {
                    echo $LANG['db_query_error'] . $e->getMessage();
                }
                try {
                    $sql          = 'INSERT INTO Levels (ID_lvl, Question) VALUES(:lvl_id, :question)';
                    $stmt_answers = $pdo->prepare($sql);
                    $stmt_answers->execute(array(
                        ':lvl_id' => $lvl_id,
                        ':question' => $question
                    ));
                }
                catch (PDOException $e) {
                    echo $LANG['db_query_error'] . $e->getMessage();
                }
            }
        }
    }
    // once saved, redirect back to the view page
    header("Location: level.php");
} else
// if the form hasn't been submitted, display the form
    {
    $TBS = new clsTinyButStrong;
    $TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_new.tpl");
    $TBS->Show();
}
?> 
