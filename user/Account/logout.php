<?php
session_start();
session_destroy();
$email = "OneStore_email";
$pass = "OneStore_password";
$cookieset = "cookieset";
if (isset($_COOKIE[$email])) {
	setcookie($email, NULL, time() - 3600, "/");
	setcookie($pass, NULL, time() - 3600, "/");
}
if (isset($_COOKIE[$cookieset])) {
	setcookie($cookieset, NULL, time() - 3600);
}
header("location:../Account/login.php");
?>