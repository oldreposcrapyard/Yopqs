<?php
/* 
EDIT.PHP
Allows user to edit an entry in the database
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
    $lvl_id   = $_POST['lvl_id'];
    $answer   = $_POST['answer'];
    $question = $_POST['question'];
    // check to make sure all fields are entered
    if ($lvl_id == '' || $answer == '' || $question == '') {
        // generate error message
        $errors = '<div class="alert-message error">Please fill in all required fields!</div>';
        // if either field is blank, display the form again
        $TBS    = new clsTinyButStrong;
        $TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_edit.tpl");
        $TBS->Show();
        exit;
    } //$lvl_id == '' || $answer == '' || $question == ''
    else {
        // save the data to the database
        //processing answers
        //delete old answers
        try {
            $stmt = $pdo->query("DELETE FROM Levels WHERE ID_lvl=$lvl_id LIMIT 1");
            $stmt->closeCursor();
            $stmt = $pdo->query("DELETE FROM Answers WHERE ID_lvl=$lvl_id LIMIT 1");
            $stmt->closeCursor();
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }
        //insert new ones
        foreach ($answer as $value) {
            if ($value != "") {
                $value = mb_strtolower(strip_tags($value));
                try {
                    $sql  = 'INSERT INTO Answers (ID_lvl, Answer) VALUES(:lvl_id, :value)';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':lvl_id' => $lvl_id,
                        ':value' => $value
                    ));
                    $stmt->closeCursor();
                }
                catch (PDOException $e) {
                    echo $LANG['db_query_error'] . $e->getMessage();
                }
            } //$value != ""
        } //$answer as $value
        try {
            $question = mb_strtolower(strip_tags($question));
            $sql  = 'INSERT INTO Levels (ID_lvl, Question) VALUES(:lvl_id, :question)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':lvl_id' => $lvl_id,
                ':question' => $question
            ));
            $stmt->closeCursor();
        }
        catch (PDOException $e) {
            echo $LANG['db_query_error'] . $e->getMessage();
        }
    }
    // once saved, redirect back to the view page
    header("Location: level.php");
} //IsSet($_POST['IsSent']) && $_POST['IsSent'] == 'Yes'
else
// if the form hasn't been submitted, display the form with the data filled in
    {
    $id = $_GET['id'];
    //getting answers and packing them in code
    try {
        $answerscode = '';
        $sql         = "SELECT `Answer` FROM `Answers` WHERE `ID_lvl` = $id";
        foreach ($pdo->query($sql) as $row) {
            $answerscode .= <<<CODE
<input type="text" name="answer[]" class="input" value="$row[Answer]"/> <br />
CODE;
        }
        
    }
    catch (PDOException $e) {
        echo $LANG['db_query_error'] . $e->getMessage();
    }
    //getting question
    try {
        $sql = "SELECT `Question` FROM `Levels` WHERE `ID_lvl` = $id";
        foreach ($pdo->query($sql) as $row) {
            $question =  strip_tags($row['Question']);
        }
        
    }
    catch (PDOException $e) {
        echo $LANG['db_query_error'] . $e->getMessage();
    }
    $TBS = new clsTinyButStrong;
    $TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_edit.tpl");
    $TBS->Show();
}
?>
