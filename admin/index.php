<?php
require '../inc/alibaba.class.php';
Alibaba::forceAuthentication();
$username = Alibaba::getUsername();
echo <<<PAGE
zalogowany jako $username
<a href="logout.php">Wyloguj</a>
PAGE;

?>
