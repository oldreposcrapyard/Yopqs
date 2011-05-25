<?php
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';

header('Content-Type: text/html; charset=utf-8');

Alibaba::forceAuthentication();
$username = Alibaba::getUsername();

//connection
if (!($conn = mysql_connect($db_hostname, $db_username, $db_password))) {
    print("$LANG[db_connect_error]");
    error_log("$LANG[db_connect_error]\r\n", 3, '../log/db.log');
    exit;
}

//encoding
mysql_set_charset('utf8', $conn);

//db selection
if (!($db = mysql_select_db($db_name, $conn))) {
    print $LANG['db_select_error'];
    error_log("$LANG[db_select_error]\r\n", 3, '../log/db.log');
    exit;
}

//display db table
$result = mysql_query("SELECT * FROM Levels");
if (!$result) {
    die("$LANG[db_query_error]");
}

$fields_num = mysql_num_fields($result);

$table_display = "<table border='1'><tr>";

// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($result);
    $table_display .= "<td>{$field->name}</td>";
}
$table_display .= "</tr>\n";
// printing table rows
while($row = mysql_fetch_row($result))
{
    $table_display .= '<tr>';

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
        $table_display .= "<td>$cell</td>";

    $table_display .= "</tr>\n";
}

$TBS              = new clsTinyButStrong;
$TBS->LoadTemplate("../templates/$CONF[template]/admin_edit.tpl");
$TBS->Show();
?>
