<?php
require "pdo.php";
if (isset($_POST['size'])) {
  $s = $_POST['size'];
  echo $s;
  $query1 = "INSERT INTO size(size_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['color'])) {
  $s = $_POST['color'];
  echo $s;
  $query1 = "INSERT INTO color(color_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['flavour'])) {
  $s = $_POST['flavour'];
  echo $s;
  $query1 = "INSERT INTO flavour(flavour_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['processor'])) {
  $s = $_POST['processor'];
  echo $s;
  $query1 = "INSERT INTO processor(processor_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['display'])) {
  $s = $_POST['display'];
  echo $s;
  $query1 = "INSERT INTO display(display_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['battery'])) {
  $s = $_POST['battery'];
  echo $s;
  $query1 = "INSERT INTO battery(battery_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['internal_storage'])) {
  $s = $_POST['internal_storage'];
  echo $s;
  $query1 = "INSERT INTO internal_storage(internal_storage_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['brand'])) {
  $s = $_POST['brand'];
  echo $s;
  $f = $_POST['category'];
  $query1 = "INSERT INTO brand(brand_name,category_id) values('$s',$f)";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
if (isset($_POST['material'])) {
  $s = $_POST['material'];
  echo $s;
  $query1 = "INSERT INTO material(material_name) values('$s')";
  $statement1 = $pdo->prepare($query1);
  $statement1->execute();
}
?>