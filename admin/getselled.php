<?php
require "pdo.php";
session_start();
$stmt = $pdo->query("select *  FROM new_orders
JOIN order_delivery_details ON order_delivery_details.order_delivery_details_id=new_orders.order_delivery_details_id
JOIN user_delivery_details ON user_delivery_details.user_delivery_details_id=order_delivery_details.user_delivery_details_id
JOIN users ON users.user_id=user_delivery_details.user_id
JOIN new_ordered_products ON new_ordered_products.new_orders_id=new_orders.new_orders_id
JOIN product_details ON new_ordered_products.product_details_id=product_details.product_details_id
JOIN item_description ON product_details.item_description_id=item_description.item_description_id
JOIN item ON item.item_id=item_description.item_id
JOIN category ON category.category_id=item.category_id
JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
JOIN store on store.store_id=product_details.store_id
WHERE new_ordered_products.delivery_status='completed'");
$rows = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $rows[] = $row;
}
echo json_encode($rows);
?>