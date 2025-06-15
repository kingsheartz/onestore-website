<?php
require "../Common/pdo.php";
$result_con = "";
$getordercnt = 0;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$limit = 1;
if (isset($_GET['page_no'])) {
  $page_no = $_GET['page_no'];
} else {
  $page_no = 1;
}
$offset = ($page_no - 1) * $limit;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_REQUEST["name"])) {
  $data = array(
    ':name' => "%" . $_GET['name'] . "%"
  );
  if (isset($_GET['name'])) {
    if (strlen($_GET['name']) == 0) {
      $sql_order_cnt = "select new_orders.new_orders_id ,new_orders.sub_total from new_orders
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
                        where new_ordered_products.delivery_status='completed' and user_delivery_details.user_id=" . $_GET['id'] . " order by new_orders.order_date LIMIT " . $offset . "," . $limit;
      $stmt_order_cnt = $pdo->prepare($sql_order_cnt);
      $stmt_order_cnt->execute();
    } else {
      $sql_order_cnt = "select new_orders.new_orders_id ,new_orders.sub_total from new_orders
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
                        where new_ordered_products.delivery_status='completed' and (item.item_name like :name or user_delivery_details.first_name like :name) and user_delivery_details.user_id=:user_id order by new_orders.order_date LIMIT " . $offset . "," . $limit;
      $stmt_order_cnt = $pdo->prepare($sql_order_cnt);
      $stmt_order_cnt->execute(array(
        ':user_id' => $_GET['id'],
        ':name' => "%" . $_GET['name'] . "%"
      ));
    }
    while ($row_order_cnt = $stmt_order_cnt->fetch(PDO::FETCH_ASSOC)) {
      if (strlen($_GET['name']) == 0) {
        $query1 = "select user_delivery_details.first_name,user_delivery_details.last_name,user_delivery_details.phone,user_delivery_details.address,user_delivery_details.pincode,users.email,new_orders.new_orders_id  FROM new_orders
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
                    WHERE new_ordered_products.delivery_status='completed' and users.user_id=:user_id and new_orders.new_orders_id=:new_orders_id and new_ordered_products.product_details_id=product_details.product_details_id and product_details.item_description_id=item_description.item_description_id and item.item_id=item_description.item_id order by new_orders.new_orders_id";
        $statement1 = $pdo->prepare($query1);
        $statement1->execute(array(
          ':user_id' => $_GET['id'],
          ':new_orders_id' => $row_order_cnt['new_orders_id']
        ));
      } else {
        $query1 = "select user_delivery_details.first_name,user_delivery_details.last_name,user_delivery_details.phone,user_delivery_details.address,user_delivery_details.pincode,users.email,new_orders.new_orders_id  FROM new_orders
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
                    WHERE new_ordered_products.delivery_status='completed' and users.user_id=:user_id and new_orders.new_orders_id=:new_orders_id and (item.item_name like :name or user_delivery_details.first_name like :name) order by new_orders.new_orders_id";
        $statement1 = $pdo->prepare($query1);
        $statement1->execute(array(
          ':user_id' => $_GET['id'],
          ':new_orders_id' => $row_order_cnt['new_orders_id'],
          ':name' => "%" . $_GET['name'] . "%"
        ));
      }
      $row2 = $statement1->fetch(PDO::FETCH_ASSOC);
      if ($row2) {
        $result_con .= '<div class="order">
<div class="orhead" style="height:auto">
  <h2 class="sidebar-title" style="border-left: 5px solid #fff;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;margin-top: 0px;font-weight:normal;border-bottom:#333;margin-bottom: 0px;border-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px;color:white;border-bottom-left-radius:0px "> <i style="color: #fff" class="fa fa-file-text-o"></i> OSID' . sprintf('%06d', $row2['new_orders_id']) . '
    <span style="float: right;margin-right: 5px;margin-top: -5px;">
      <button type="button" style="max-width: 150px;min-width:90px;height: 33px;font-weight: bold;border-top-right-radius: 10px;background-color: #fff;"  id="proceed" name="proceed" class="checkout-button button alt wc-forward">Total <i class=\'fas fa-rupee-sign\'></i>' . $row_order_cnt['sub_total'] . '</button>
    </span>
  </h2>
</div>
<div style="background-color:#eee;height:5px;"></div>
<table>
  <tr>
    <th class="tablhde"colspan="2">Delivery details</th>
  </tr>
  <tr style="padding-bottom;30px;"></tr>
  <tr class="div-wrapper dw">
    <th class="cust_header">Name</th>
    <td class="cust_details">' . $row2['first_name'] . ' ' . $row2['last_name'] . '</td>
  </tr>
  <tr class="div-wrapper dw">
    <th class="cust_header">Phone</th>
    <td class="cust_details">' . $row2['phone'] . '</td>
  </tr>
  <tr class="div-wrapper dw">
    <th class="cust_header">Address</th>
    <td class="cust_details">' . $row2['address'] . '</td>
  </tr>
  <tr class="div-wrapper dw">
    <th class="cust_header">Pincode</th>
    <td class="cust_details">' . $row2['pincode'] . '</td>
  </tr>
  <tr class="div-wrapper dw">
    <th class="cust_header">Email</th>
    <td class="cust_details">' . $row2['email'] . '</td>
  </tr>
  <tr class="div-wrapper dw">
    <th class="cust_header">Order ID</th>
    <td class="cust_details">OSID' . sprintf('%06d', $row2['new_orders_id']) . '</td>
  </tr>
</table>
<div style="background-color:#eee;height:20px;"></div>';
        if (strlen($_GET['name']) == 0) {
          $query = "select *  FROM new_orders
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
                    WHERE new_ordered_products.delivery_status='completed' and users.user_id=:user_id and new_orders.new_orders_id=:new_orders_id and new_ordered_products.product_details_id=product_details.product_details_id and product_details.item_description_id=item_description.item_description_id and item.item_id=item_description.item_id order by new_orders.new_orders_id";
          $statement = $pdo->prepare($query);
          $statement->execute(array(
            ':user_id' => $_GET['id'],
            ':new_orders_id' => $row_order_cnt['new_orders_id']
          ));
        } else {
          $query = "select *  FROM new_orders
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
                    WHERE new_ordered_products.delivery_status='completed' and users.user_id=:user_id and new_orders.new_orders_id=:new_orders_id and new_ordered_products.product_details_id=product_details.product_details_id and product_details.item_description_id=item_description.item_description_id and item.item_id=item_description.item_id and (item.item_name like :name or user_delivery_details.first_name like :name) order by new_orders.new_orders_id";
          $statement = $pdo->prepare($query);
          $statement->execute(array(
            ':user_id' => $_GET['id'],
            ':new_orders_id' => $row_order_cnt['new_orders_id'],
            ':name' => "%" . $_GET['name'] . "%"
          ));
        }
        $flag = 0;
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
          if ($flag != 0) {
            $result_con .= ' <hr class="make_div">';
          }
          $result_con .= '<div class="order-single" style="margin:0;padding:0;" onclick="location.href=\'../Order/ordersingle.php?nopid=' . $row['new_ordered_products_id'] . '\'">
<div class="col-sm-2 col-xs-2" onclick="location.href=\'../Product/single.php?id=' . $row['item_description_id'] . '\'">
  <table>
    <tr style="padding-bottom:30px;"></tr>
    <tr>
      <td>
      <div style="width: 100%;height:100%;"> <img style="height:auto;max-width: 100%;width:auto;max-height: 120px;display: block;margin: auto;" class="img-responsive img_my_ord" src="../../images/' . $row['category_id'] . '/' . $row['sub_category_id'] . '/' . $row['item_description_id'] . '.jpg"> </div>
      </td>
    </tr>
  </table>
</div>
<div class="col-sm-10 col-xs-10" style="padding:10px;">
  <div style="width: 100%;text-align: center;color: #888;font-weight:bold;font-size:18px;text-align:left">' . $row['item_name'] . '</div>
  <div class="col-sm-4 large-size">
    <table>
      <tr style="padding-bottom:30px;"></tr>
        <tr class="div-wrapper dw">
          <th class="cust_header2"> </th>';
          if ($row['size'] != 0) {
            $query1 = "SELECT * FROM size where size_id=" . $row['size'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Size : <span class="cust_details"> ' . $row1['size_name'] . '</span></th>
            </tr>';
          }
          if ($row['color'] != 0) {
            $query1 = "SELECT * FROM color where color_id=" . $row['color'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Color : <span class="cust_details">' . $row1['color_name'] . '</span></th>
            </tr>';
          }
          if ($row['weight'] != 0) {
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Weight : <span class="cust_details">' . $row['weight'] . '</span></th>
            </tr>';
          }
          if ($row['flavour'] != 0) {
            $query1 = "SELECT * FROM flavour where flavour_id=" . $row['flavour'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Flavour : <span class="cust_details">' . $row1['flavour_name'] . '</span></th>
            </tr>';
          }
          if ($row['processor'] != 0) {
            $query1 = "SELECT * FROM processor where processor_id=" . $row['processor'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Processor : <span class="cust_details">' . $row1['processor_name'] . '</span></th>
            </tr>';
          }
          if ($row['display'] != 0) {
            $query1 = "SELECT * FROM display where display_id=" . $row['display'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Display : <span class="cust_details">' . $row1['display_name'] . '</span></th>
            </tr>';
          }
          if ($row['battery'] != 0) {
            $query1 = "SELECT * FROM battery where battery_id=" . $row['battery'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Battery : <span class="cust_details">' . $row1['battery_name'] . '</span></th>
            </tr>';
          }
          if ($row['internal_storage'] != 0) {
            $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row['internal_storage'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Internal Storage : <span class="cust_details">' . $row1['internal_storage_name'] . '</span></th>
            </tr>';
          }
          if ($row['brand'] != 0) {
            $query1 = "SELECT * FROM brand where brand_id=" . $row['brand'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Brand : <span class="cust_details">' . $row1['brand_name'] . '</span></th>
            </tr>';
          }
          if ($row['material'] != 0) {
            $query1 = "SELECT * FROM material where material_id=" . $row['material'];
            $st1 = $pdo->query($query1);
            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
            $result_con .= '
            <tr class="div-wrapper dw">
              <th class="cust_header2">Material : <span class="cust_details">' . $row1['material_name'] . '</span></th>
            </tr>';
          }
          $result_con .= '
          <tr class="div-wrapper dw">
            <th class="cust_header2">Seller : <span class="cust_details">' . $row['store_name'] . '</span></th>
          </tr>
        </table>
        </div>
        <div class="col-sm-4 large-size">
        <table>
          <tr style="padding-bottom:30px;"></tr>
          <tr class="div-wrapper dw">
          <th class="cust_header2"> </th>
          <tr class="div-wrapper dw">
            <th class="cust_header2"> Order Type : <span class="cust_details">' . $row['order_type'] . '</span></th>
          </tr>
          <tr class="div-wrapper dw">
            <th class="cust_header2">Ordered on <span class="cust_details">' . $row['order_date'] . '</span></th>
          </tr>
        </table>
        </div>
        <div class="col-sm-12 col-xs-12 small-size">
        <table >
          <tr style="padding-bottom:30px;"></tr>
          <tr class="div-wrapper dw"><th class="cust_header2"> </th>
          <tr class="div-wrapper dw">
            <th class="cust_header2"> Order Type : <span class="cust_details">' . $row['order_type'] . '</span></th>
            <td>
                <i class="fa fa-angle-right fa-lg" style="margin-right:10px;float:right;display:flex;align-items:center;justify-content:center;font-size:23px;"></i>
            </td>
          </tr>
          <tr class="div-wrapper dw">
            <th class="cust_header2" style="width:max-content">Ordered on : <span class="cust_details">' . $row['order_date'] . '</span></th>
              <td align="right" style="justify-content: flex-end;align-items: flex-end;display: flex;padding: 0px;margin:auto">';
                  if ($row['delivery_status'] == 'completed') {
                    $result_con .= '<span class="status_span" style="background-color: green;border-radius: 5px;color:white;font-weight:bold;float:right">&nbsp;
                        <i class="fa fa-check status_icon" title="completed" style="color: orange;text-shadow: 1px 2px 3px grey"></i>
                        <i class="status_small" style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey"> completed &nbsp;</i>
                      </span>';
                  } else if ($row['delivery_status'] == 'pending') {
                    $result_con .= '<span class="status_span" style="background-color: rgb(255, 123, 0);border-radius: 5px;color:white;font-weight:bold;float:right">&nbsp;
                        <i class="fa fa-clock-o status_icon" title="pending" style="color: rgb(0, 0, 0);text-shadow: 1px 2px 3px grey"></i>
                        <i class="status_small" style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey"> pending &nbsp;</i>
                      </span>';
                  } else if ($row['delivery_status'] == 'cancelled') {
                    $result_con .= '<span class="status_span" style="background-color: rgb(255, 0, 0);border-radius: 5px;color:white;font-weight:bold;float:right">&nbsp;
                        <i class="fa fa-close status_icon" title="cancelled" style="color: rgb(255, 255, 255);text-shadow: 1px 2px 3px grey"></i>
                        <i class="status_small" style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey"> cancelled &nbsp;</i>
                      </span>';
                  }
                  $result_con .= '</td>
          </tr>
        </table>
        </div>
        <div class="col-sm-4 large-size">
          <table>
            <tbody>
              <tr>
                <td>
                  <table>
                    <tr>
                      <td>
                        <table>
                          <tr>
                            <td>';
                  if ($row['delivery_status'] == 'completed') {
                    $result_con .= '<span style="background-color: green;border-radius: 5px;color:white;font-weight:bold;padding-bottom:3px">&nbsp;
                                  <i class="fa fa-check" style="color: orange;text-shadow: 1px 2px 3px grey"></i>
                                  <i style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey"> completed &nbsp;</i>
                                </span>';
                  } else if ($row['delivery_status'] == 'pending') {
                    $result_con .= '<span style="background-color: rgb(255, 123, 0);border-radius: 5px;color:white;font-weight:bold;padding-bottom:3px">&nbsp;
                                  <i class="fa fa-clock-o" style="color: rgb(0, 0, 0);text-shadow: 1px 2px 3px grey"></i>
                                  <i style="text-transform:capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey"> pending &nbsp;</i>
                                </span>';
                  } else if ($row['delivery_status'] == 'cancelled') {
                    $result_con .= '<span style="background-color: rgb(255, 0, 0);border-radius: 5px;color:white;font-weight:bold;padding-bottom:3px">&nbsp;
                                  <i class="fa fa-close" style="color: rgb(255, 255, 255);text-shadow: 1px 2px 3px grey"></i>
                                  <i style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey"> cancelled &nbsp;</i>
                                </span>';
                  }
                  $result_con .= '</td>
                          </tr>
                          <tr>
                            <th><span  style="color:maroon;font-size:19px;"><i class=\'fas fa-rupee-sign\'></i> ' . $row['total_amt'] . ' </span>(' . $row['item_quantity'] . ')</th>
                          </tr>
                        </table>
                        <table style="align-items:center;justify-content:center;height:0px;float:right;margin-top:-60px;">
                          <tr>
                            <td>
                              <i class="fa fa-angle-right fa-lg" style="margin-right:10px;float:right;display:flex;align-items:center;justify-content:center;font-size:25px;"></i>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
        </div>';
          $flag += 1;
        }
        $result_con .= '</div>';
        $getordercnt += 1;
      }
    }
  }
  if (strlen($_GET['name']) == 0) {
    $sql_order_cnt = "select new_orders.new_orders_id ,new_orders.sub_total from new_orders
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
    where new_ordered_products.delivery_status='completed' and user_delivery_details.user_id=" . $_GET['id'] . " order by new_orders.order_date";
    $stmt_order_cnt = $pdo->prepare($sql_order_cnt);
    $stmt_order_cnt->execute();
  } else {
    $sql_order_cnt = "select new_orders.new_orders_id ,new_orders.sub_total from new_orders
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
    where new_ordered_products.delivery_status='completed' and (item.item_name like :name or user_delivery_details.first_name like :name) and user_delivery_details.user_id=:user_id order by new_orders.order_date";
    $stmt_order_cnt = $pdo->prepare($sql_order_cnt);
    $stmt_order_cnt->execute(array(
      ':user_id' => $_GET['id'],
      ':name' => "%" . $_GET['name'] . "%"
    ));
  }
  $totalRecords = $stmt_order_cnt->rowCount();
  $totalPage = $totalRecords / $limit;
  $dynamic_paging = "<div class='container'><div class='col-12'><nav class='numbering' style='position:relative;bottom:0px;right:0px;'><ul class='pagination justify-content-center' style='margin:0px 0'>";
  if ($page_no <= $totalPage && $page_no > 1) {
    $prev = $page_no - 1;
    $dynamic_paging .= "<li class='page-item'><a  class='page-link' id='$prev' href=''>Prev</a></li>";
  }
  $ends_count = 1;  //how many items at the ends (before and after [...])
  $middle_count = 1;  //how many items before and after current page
  $dots = false;
  for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $page_no) {
      $dynamic_paging .= "<li class='page-item active'><a class='page-link' style='pointer-events: none;' id='$i' href=''>$i</a></li>";
      $dots = true;
    } else {
      if ($i <= $ends_count || ($page_no && $i > $page_no - $middle_count && $i <= $page_no + $middle_count) || $i > $totalPage - $ends_count) {
        $dynamic_paging .= "<li class='page-item '><a class='page-link' id='$i' href=''>$i</a></li>";
        $dots = true;
      } else if ($dots) {
        $dynamic_paging .= "<li><a>&hellip;</a></li>";
        $dots = false;
      }
    }
  }
  if ($totalPage > 1 && $page_no < $totalPage) {
    $next = $page_no + 1;
    $dynamic_paging .= "<li class='page-item'><a class='page-link' id='$next' href=''>Next</a></li>";
  }
  $dynamic_paging .= "</ul></nav></div></div>";
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //NAME CNT
  if ($getordercnt == 0) {
    $result_con .= '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Result Found...</h2></center><br><br>';
  }
}
$response['paging'] = $dynamic_paging;
$response['output'] = $result_con;
$response['status'] = "success";
header('Content-type: application/json');
echo json_encode($response);
