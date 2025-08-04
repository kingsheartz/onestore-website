<?php
try {
	$pdo = new PDO("mysql:host=localhost;port=3306;dbname=onestore", "root", "");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$_SESSION['onestore_success'] = "Connected successfully";
} catch (PDOException $e) {
	$_SESSION['onestore_error'] = "OOPS !!! CONNECTION CAN'T BE ESTABLISHED";
}
?>