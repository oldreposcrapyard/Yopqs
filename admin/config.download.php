<?php
header("Content-type: text/plain");

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="config.inc.php"');

// The PDF source is in original.pdf
readfile('inc/config.inc.php');
?>