<?php
require "pdo.php";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET') {
	$data = array(
		':sub_category_name' => "%" . $_GET['sub_category_name'] . "%",
		':category_id' => "%" . $_GET['category_id'] . "%",
		':category_name' => "%" . $_GET['category_name'] . "%"
	);
	$query = "SELECT * FROM sub_category  join category on category.category_id=sub_category.category_id WHERE sub_category.sub_category_name LIKE :sub_category_name AND sub_category.category_id LIKE :category_id  AND category.category_name LIKE :category_name";
	$statement = $pdo->prepare($query);
	$statement->execute($data);
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$output[] = array(
			'sub_category_id' => $row['sub_category_id'],
			'sub_category_name' => $row['sub_category_name'],
			'category_id' => $row['category_id'],
			'category_name' => $row['category_name']
		);
	}
	echo json_encode($output);
}
if (isset($_POST['type'])) {
	if ($_POST['type'] == "insert") { //EDITED LINE
		$data = array(
			':sub_category_name' => $_POST['sub_category_name'],
			':category_id' => $_POST['category_id']
		);
		echo json_encode($_POST['type']); //EDITED LINE
		$query = "INSERT INTO sub_category (sub_category_name,category_id) VALUES (:sub_category_name,:category_id)";
		$statement = $pdo->prepare($query);
		$statement->execute($data);
	}
	if ($_POST['type'] == "update") { //EDITED LINE
		parse_str(file_get_contents("php://input"), $_POST);
		$data = array(
			':sub_category_id' => $_POST['sub_category_id'],
			':sub_category_name' => $_POST['sub_category_name'],
			':category_id' => $_POST['category_id']
		);
		echo json_encode($_POST['type']);
		$query = "UPDATE sub_category SET sub_category_name=:sub_category_name,category_id=:category_id WHERE sub_category_id=:sub_category_id";
		$statement = $pdo->prepare($query);
		$statement->execute($data);
	}
	if ($_POST['type'] == "delete") { //EDITED LINE
		parse_str(file_get_contents("php://input"), $_POST);
		echo json_encode($_POST['type']); //EDITED LINE
		$query = "DELETE FROM sub_category WHERE sub_category_id='" . $_POST['sub_category_id'] . "'";
		$statement = $pdo->prepare($query);
		$statement->execute();
	}
}
?>