<?php
$filename = "inc/config.inc.php";
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
fclose($handle);
$_oo = str_replace('$debug_mode == TRUE;', '$debug_mode == FALSE;', $contents);
$encoded = highlight_string("$_oo");
echo "$encoded";

?>