<?php
require "pdo.php";
session_start();
$id = $_SESSION['id'];
$user = $pdo->query("select count(distinct users.user_id) as user FROM new_orders
JOIN order_delivery_details ON order_delivery_details.order_delivery_details_id=new_orders.order_delivery_details_id
JOIN user_delivery_details ON user_delivery_details.user_delivery_details_id=order_delivery_details.user_delivery_details_id
JOIN users ON users.user_id=user_delivery_details.user_id
JOIN new_ordered_products ON new_ordered_products.new_orders_id=new_orders.new_orders_id
JOIN product_details ON new_ordered_products.product_details_id=product_details.product_details_id
JOIN item_description ON product_details.item_description_id=item_description.item_description_id
JOIN item ON item.item_id=item_description.item_id
JOIN category ON category.category_id=item.category_id
JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
JOIN store on store.store_id=product_details.store_id where product_details.store_id=$id ");
$selled = $pdo->query("  select count(new_ordered_products.new_ordered_products_id) as selled FROM new_orders
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
WHERE new_ordered_products.delivery_status='completed' AND product_details.store_id=$id ");
$neworder = $pdo->query("select count(new_ordered_products.new_ordered_products_id) as neworders FROM new_orders
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
WHERE new_ordered_products.delivery_status='pending' and product_details.store_id=$id ");
$newproduct = $pdo->query("select  count(item_id) as newproducts
from item where (added_date) in (
    select max(added_date) as date
    from item
)");
$rows = array();
$nu = $user->fetch(PDO::FETCH_ASSOC);
$rows[] = $nu;
$sn = $selled->fetch(PDO::FETCH_ASSOC);
$rows[] = $sn;
$nwo = $neworder->fetch(PDO::FETCH_ASSOC);
$rows[] = $nwo;
$npo = $newproduct->fetch(PDO::FETCH_ASSOC);
$rows[] = $npo;
echo json_encode($rows);
?>