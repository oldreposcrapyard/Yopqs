<?
// Alibaba
// PHP authentication library
//
// by Ben Crowder

include_once('config.inc.php');

class Alibaba {
    private static $app_name = 'YOPQS_admin_panel';
    private static $database_name = '';
    private static $database_host = '';
    private static $database_username = '';
    private static $database_password = '';
    private static $user_table_name = '';
    private static $username_field = '';
    private static $password_field = '';
    private static $cookie_expiration = '';
    private static $hash_function = '';
    private static $login_page_url = '';
    public static function AlibabaInit($db_name, $db_hostname, $db_username, $db_password, $USER_TABLE_NAME, $USERNAME_FIELD, $PASSWORD_FIELD, $COOKIE_EXPIRATION, $HASH_FUNCTION, $LOGIN_PAGE_URL) {
        self::$database_name     = $db_name;
        self::$database_host     = $db_hostname;
        self::$database_username = $db_username;
        self::$database_password = $db_password;
        self::$user_table_name   = $USER_TABLE_NAME;
        self::$username_field    = $USERNAME_FIELD;
        self::$password_field    = $PASSWORD_FIELD;
        self::$cookie_expiration = $COOKIE_EXPIRATION;
        self::$hash_function     = $HASH_FUNCTION;
        self::$login_page_url    = $LOGIN_PAGE_URL;
    }
    public static function forceAuthentication() {
        if (!self::authenticated()) {
            self::redirectToLogin();
        }
    }
    public static function authenticated() {
        if (isset($_COOKIE["alibaba_" . self::$app_name . "_username"])) {
            return true;
        } else {
            return false;
        }
    }
    public static function login($username, $password) {
        $db       = self::db_connect();
        $password = self::hashpass($password);
        $query    = "SELECT * FROM " . mysql_real_escape_string(self::$user_table_name) . " WHERE " . mysql_real_escape_string(self::$username_field) . "='" . mysql_real_escape_string($username) . "' AND " . mysql_real_escape_string(self::$password_field) . "='" . mysql_real_escape_string($password) . "'";
        $result = mysql_query($query) or die("Couldn't run: $query");
        if (mysql_numrows($result)) {
            $logged_in = true;
            setcookie("alibaba_" . self::$app_name . "_username", $username, time() + 60 * 60 * 24 * self::$cookie_expiration, "/");
        } else {
            $logged_in = false;
            setcookie("alibaba_" . self::$app_name . "_username", "", time() - 3600, "/");
        }
        self::db_close($db);
        return $logged_in;
    }
    public static function redirectToLogin($message = '', $login = '') {
        if ($login == '') {
            $login = self::$login_page_url;
        }
        $locstr = "Location: $login";
        if ($message) {
            $locstr .= "?message=$message";
        }
        header($locstr);
    }
    public static function getUsername() {
        return $_COOKIE["alibaba_" . self::$app_name . "_username"];
    }
    public static function logout($url = '') {
        setcookie("alibaba_" . self::$app_name . "_username", "", time() - 3600, "/");
        if ($url == '') {
            $url = self::$login_page_url;
        }
        header("Location: $url");
    }
    private static function hashpass($password) {
        switch (self::$hash_function) {
            case "md5":
                $password = md5($password);
                break;
            case "sha1":
                $password = sha1($password);
                break;
            case "md5sha1":
                $password = md5(sha1($password));
                break;
            case "sha1md5":
                $password = sha1(md5($password));
                break;
        }
        return $password;
    }
    private static function db_connect() {
        $conn = mysql_connect(self::$database_host, self::$database_username, self::$database_password);
        if (!$conn) {
            echo "Error connecting to database.\n";
        }
        @mysql_select_db(self::$database_name, $conn) or die("Unable to select database.");
        return $conn;
    }
    private static function db_close($conn) {
        mysql_close($conn);
    }
}
Alibaba::AlibabaInit($db_name, $db_hostname, $db_username, $db_password, 'Users', 'Username', 'Password', 1, $HASH_FUNCTION, $LOGIN_PAGE_URL);

?>
