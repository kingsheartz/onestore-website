<?php
require "pdo.php";
$cat = $pdo->query("select * from item");
while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
	$rows[] = $row;
}
echo json_encode($rows);
?>