<?php
require "pdo.php";
if (isset($_POST['key'])) {
  $stmt = $pdo->query(
    "select * from item
    join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id  AND
    item.item_name like '%" . $_POST['key'] . "%' group by item_description.item_id limit 5"
  );
  $rows = array();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $row;
  }
  echo json_encode($rows);
}
