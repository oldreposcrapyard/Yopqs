<?php
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';

header('Content-Type: text/html; charset=utf-8');

Alibaba::forceAuthentication();
if (isset($_GET['module'])) {
switch($_GET['module']){
case 'level':
    require '../inc/config.inc.php';
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
                $stmt = $pdo->query('SELECT * FROM players');
                echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
                echo "<table border='1' cellpadding='10'>";
                echo "<tr> <th>ID</th> <th>First Name</th> <th></th> <th></th></tr>";
                while ($row = $stmt->fetch()) {
                    // echo out the contents of each row into a table
                    echo "<tr>";
                    echo '<td>' . $row['ID_lvl'] . '</td>';
                    echo '<td>' . $row['Question'] . '</td>';
                    echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
                    echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
                    echo "</tr>";
                }
                // close table
                echo "</table>";
                $stmt->closeCursor();
            }
            catch (PDOException $e) {
                return $e->getMessage();
            }
break;
}
} else {
    $TBS = new clsTinyButStrong;
    $TBS->LoadTemplate("../templates/$CONF[template]/admin_tpl/admin_index.tpl");
    $TBS->Show();
}
?>
