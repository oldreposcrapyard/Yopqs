<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'Levels' table
*/
require '../inc/config.inc.php';
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
Alibaba::forceAuthentication();

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

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
$id = $_GET['id'];
 
try {
    $stmt = $pdo->query("DELETE FROM Levels WHERE ID_lvl=$id");
    $stmt->closeCursor();
    $stmt = $pdo->query("DELETE FROM Answers WHERE ID_lvl=$id");
    $stmt->closeCursor();
}
catch (PDOException $e) {
    return $e->getMessage();
}
header("Location: level.php");
}
else
{
header("Location: level.php");
}
 
?>
