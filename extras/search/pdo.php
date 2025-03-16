<?php
try{
	$pdo=new PDO("mysql:host=localhost;port=3306;dbname=onestore","root","");
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$_SESSION['success']="Connected successfully";
}catch(PDOException $e){
	$_SESSION['error']="OOPS !!! CONNECTION CAN'T BE ESTABLISHED";
}
?>