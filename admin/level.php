<?php
header('Content-Type: text/html; charset=utf-8');
require '../inc/config.inc.php';
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';
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

try {
    $stmt = $pdo->query('SELECT * FROM Levels');
$table_contents = '';    
while ($row = $stmt->fetch()) {
        $table_contents .= '<tr>';
        $table_contents .= '<td>' . $row['ID_lvl'] . '</td>';
        $table_contents .= '<td>' . $row['Question'] . '</td>';
        $table_contents .= '<td><a href="edit.php?id=' . $row['ID_lvl'] . "\">$LANG['edit']</a></td>";
        $table_contents .= '<td><a href="delete.php?id=' . $row['ID_lvl'] . "\">$LANG['delete']</a></td>";
        $table_contents .= '</tr>';
    }
    $stmt->closeCursor();
}
catch (PDOException $e) {
    return $e->getMessage();
}
$TBS              = new clsTinyButStrong;
$TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_level.tpl");
$TBS->Show();
?>
