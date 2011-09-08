<?php
header('Content-Type: text/html; charset=utf-8');
echo 'x';
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
echo 'x';
            }
            catch (PDOException $e) {
                echo $LANG['db_connect_error'] . $e->getMessage();
                exit;
            }
                echo "<table border='1' cellpadding='10'>";
                echo "<tr> <th>ID</th> <th>First Name</th> <th></th> <th></th></tr>";            
try {
                $stmt = $pdo->query('SELECT * FROM Questions');
echo 'x';

                while ($row = $stmt->fetch()) {
                    // echo out the contents of each row into a table
                    echo "<tr>";
                    echo '<td>' . $row['ID_lvl'] . '</td>';
                    echo '<td>' . $row['Question'] . '</td>';
                    echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
                    echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
                    echo "</tr>";
                }

                $stmt->closeCursor();
            }
            catch (PDOException $e) {
                return $e->getMessage();
            }
                // close table
                echo "</table>";
?>
