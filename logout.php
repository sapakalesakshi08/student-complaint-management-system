<?php
session_start();

/* Remove all session variables */
$_SESSION = array();

/* Destroy session */
session_unset();
session_destroy();

/* Destroy session cookie */
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/* Prevent cache */
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

header("Location: signindemo.php");
exit();
?>