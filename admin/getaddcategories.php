<?php
require "pdo.php";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET') {
	$data = array(
		':category_name' => "%" . $_GET['category_name'] . "%"
	);
	$query = "SELECT * FROM category WHERE category_name LIKE :category_name ";
	$statement = $pdo->prepare($query);
	$statement->execute($data);
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$output[] = array(
			'category_id' => $row['category_id'],
			'category_name' => $row['category_name']

		);
	}
	echo json_encode($output);
}
//EDITED BY KINGSHEARTZ
if (isset($_POST['type'])) {
	if ($_POST['type'] == "insert") { //EDITED LINE
		$data = array(
			':category_name' => $_POST['category_name']
		);
		echo json_encode($_POST['type']); //EDITED LINE
		$query = "INSERT INTO category (category_name) VALUES (:category_name)";
		$statement = $pdo->prepare($query);
		$statement->execute($data);
	}
	if ($_POST['type'] == "update") { //EDITED LINE
		parse_str(file_get_contents("php://input"), $_POST);
		$data = array(
			'category_id' => $_POST['category_id'],
			'category_name' => $_POST['category_name']
		);
		echo json_encode($_POST['type']);
		$query = "UPDATE category SET category_name=:category_name WHERE category_id=:category_id";
		$statement = $pdo->prepare($query);
		$statement->execute($data);
	}
	if ($_POST['type'] == "delete") { //EDITED LINE
		parse_str(file_get_contents("php://input"), $_POST);
		echo json_encode($_POST['type']); //EDITED LINE
		$query = "DELETE FROM category WHERE category_id='" . $_POST['category_id'] . "'";
		$statement = $pdo->prepare($query);
		$statement->execute();
	}
}
//EDITED BY KINGSHEARTZ
?>