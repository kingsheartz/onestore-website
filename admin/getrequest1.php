<?php
require "pdo.php";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET') {
	$data = array(
		':product_details_id' => "%" . $_GET['product_details_id'] . "%",
		':item_description_id' => "%" . $_GET['item_description_id'] . "%",
		':item_name' => "%" . $_GET['item_name'] . "%",
		':store_name' => "%" . $_GET['store_name'] . "%",
		':permission' => "%" . $_GET['permission'] . "%"
	);
	$query = "SELECT product_details.product_details_id,item.item_name,store.store_name,product_details.permission,item_description.item_description_id FROM product_details join item_description on product_details.item_description_id=item_description.item_description_id join item on item.item_id=item_description.item_description_id  JOIN store on store.store_id=product_details.store_id WHERE item.item_name LIKE :item_name  AND store.store_name LIKE :store_name AND  product_details.permission like :permission AND  product_details.product_details_id like :product_details_id AND item_description.item_description_id LIKE :item_description_id AND product_details.permission=0";
	$statement = $pdo->prepare($query);
	$statement->execute($data);
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$output[] = array(
			'product_details_id' => $row['product_details_id'],
			'item_description_id' => $row['item_description_id'],
			'item_name' => $row['item_name'],
			'store_name' => $row['store_name'],
			'permission' => $row['permission']

		);
	}
	echo json_encode($output);

}
if (isset($_POST['type'])) {
	if ($_POST['type'] == "update") { //EDITED LINE
		parse_str(file_get_contents("php://input"), $_POST);
		$data = array(
			':product_details_id' => $_POST['product_details_id'],
			':permission' => $_POST['permission']
		);
		echo json_encode($_POST['type']);
		$query = "UPDATE product_details SET permission=:permission WHERE product_details_id=:product_details_id";
		$statement = $pdo->prepare($query);
		$statement->execute($data);
	}
	if ($_POST['type'] == "delete") { //EDITED LINE
		parse_str(file_get_contents("php://input"), $_POST);
		echo json_encode($_POST['type']); //EDITED LINE
		$query = "DELETE FROM product_details WHERE product_details_id='" . $_POST['product_details_id'] . "'";
		$statement = $pdo->prepare($query);
		$statement->execute();
	}
}
?>