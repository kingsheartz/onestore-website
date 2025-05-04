<?php
require "pdo.php";
session_start();
if (isset($_POST['dl_id'])) {
  $DELETE = $_POST['dl_id'];
  $data = array(
    ':title' => $_POST['dl_id']
  );
  $query = "DELETE FROM to_do_list_store WHERE list_id=:title";
  $statement = $pdo->prepare($query);
  $statement->execute($data);
  echo 'helo';
}
if (isset($_POST['addnm'])) {
  $data = array(
    ':title' => $_POST['addnm'],
    ':st_id' => $_SESSION['id']
  );
  $query = "INSERT INTO to_do_list_store (title,add_date,store_id) VALUES (:title,NOW(),:st_id)";
  $statement = $pdo->prepare($query);
  $statement->execute($data);
}
if (isset($_POST['up_id']) || isset($_POST['up_tit'])) {
  $up = '<strike>' . $_POST['up_tit'] . '</strike>';
  echo 'updated';
  $data = array(
    ':id' => $_POST['up_id'],
    ':title' => $up
  );
  $query = "UPDATE to_do_list_store set title=:title where list_id=:id";
  $statement = $pdo->prepare($query);
  $statement->execute($data);
}
