<?php
require '../inc/alibaba.class.php';

if(isSet($_POST["username"]) && isSet($_POST["password"])){
$username = $_POST["username"];
$password = $_POST["password"];

if (Alibaba::login($username, $password)) {
    header("Location: index.php");
} else {
    Alibaba::redirectToLogin("Login failed");
}

}
function getNameFile(){
$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$PHP_SELF = $parts[count($parts) - 1]; 
return $PHP_SELF;
}
$PHP_SELF = getNameFile();

echo <<<LOGINFORM
<form name='Login' action='$PHP_SELF' method='POST' enctype='application/x-www-form-urlencoded'>
<table class='table_form_1' id='table_form_1' cellspacing='0'>
	<tr>
		<td class='ftbl_row_1' ><LABEL for='username'>Username:
		</td>
		<td class='ftbl_row_1a' ><input type='text' name='username' id='username' size='30' maxlength='20'>
		</td>
	</tr>
	<tr>
		<td class='ftbl_row_2' ><LABEL for='password'>Password:
		</td>
		<td class='ftbl_row_2a' ><input type='password' name='password' id='password' size='30' maxlength='30'  value=''>
		</td>
	</tr>
	<tr>
		<td colspan='2' align='right'><input type='submit' name='submit' value='Submit'>&nbsp;<br />
		</td>
	</tr>
</table>
</form>
LOGINFORM;

?>
