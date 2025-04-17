<?php
require "pdo.php";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET') {
	$data = array(
		':store_id' => "%" . $_GET['store_id'] . "%",
		':store_name' => "%" . $_GET['store_name'] . "%",
		':opening_hours' => "%" . $_GET['opening_hours'] . "%",
		':address' => "%" . $_GET['address'] . "%",
		':status' => "%" . $_GET['status'] . "%",
		':longitude' => "%" . $_GET['longitude'] . "%",
		':latitude' => "%" . $_GET['latitude'] . "%"
	);
	$query = "SELECT * FROM store WHERE store_name LIKE :store_name AND opening_hours LIKE :opening_hours AND
	 address LIKE :address AND status LIKE :status AND longitude LIKE :longitude AND latitude LIKE :latitude
	  AND store_id LIKE :store_id";
	$statement = $pdo->prepare($query);
	$statement->execute($data);
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$output[] = array(
			'store_id' => $row['store_id'],
			'store_name' => $row['store_name'],
			'opening_hours' => $row['opening_hours'],
			'address' => $row['address'],
			'status' => $row['status'],
			'longitude' => $row['longitude'],
			'latitude' => $row['latitude']
		);
	}
	echo json_encode($output);
}/*
if($method=='POST'){
 $data=array(
	 ':store_name'=>$_POST['store_name'],
	 ':opening_hours'=>$_POST['opening_hours'],
	 ':address'=>$_POST['address'],
	 ':status'=>$_POST['status'],
	 ':longitude'=>$_POST['longitude'],
	 ':latitude'=>$_POST['latitude']
 );
$query="INSERT INTO store (store_name,opening_hours,address,status,longitude,latitude) VALUES (:store_name,:opening_hours,:address,:status,:longitude,:latitude)";
$statement=$pdo->prepare($query);
$statement->execute($data);
}
if($method=='PUT'){
parse_str(file_get_contents("php://input"),$_PUT);
$data=array(
 ':store_id'=>$_PUT['store_id'],
 ':store_name'=>$_PUT['store_name'],
	 ':opening_hours'=>$_PUT['opening_hours'],
	 ':address'=>$_PUT['address'],
	 ':status'=>$_PUT['status'],
	 ':longitude'=>$_PUT['longitude'],
	 ':latitude'=>$_PUT['latitude']
);
$query	="UPDATE store SET store_name=:store_name,opening_hours=:opening_hours,address=:address,status=:status,longitude=:longitude,latitude=:latitude WHERE store_id=:store_id";
$statement=$pdo->prepare($query);
$statement->execute($data);
}
if ($method=='DELETE') {
parse_str(file_get_contents("php://input"),$_DELETE);
$query="DELETE FROM store WHERE store_id='".$_DELETE['store_id']."'";
$statement=$pdo->prepare($query);
$statement->execute();
}*/
?>