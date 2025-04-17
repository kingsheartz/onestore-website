<?php
require "head.php";
?>

<body>
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <script type="text/javascript">
      $('li').removeClass('active');
      $('#newordersphp').addClass('active');
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/JavaScript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
    <style type="text/css">
      .order {
        position: relative;
        height: auto;
        background: white;
        overflow: hidden;
        margin-top: 30px;
        box-shadow: -2px -2px 3px 3px #ddd;
      }

      .order button {
        color: white;
        font-size: 20px;
        border: none;
        width: 100%;
        margin: 0;
      }

      th {
        padding-right: 20px;
      }

      .order .orderbutton {
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
        height: 30px;
        border-radius: 5px;
        font-size: 16px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4caf50), color-stop(1, #45d44b)) !important;
      }

      .col-sm-3,
      .col-sm-12,
      .col-sm-9 {
        padding: 0;
      }

      .col-sm-12,
      .col-sm-3 {
        margin-bottom: 13px;
      }

      .col-sm-12 button {
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ea8d02), color-stop(1, #fd9700)) !important;
      }

      table,
      tr {
        width: 100%;
      }

      th,
      td {
        padding: 10px;
      }

      .orhd th {
        text-align: center;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #bbbbbb), color-stop(1, #bdbdbd)) !important;
        border: 1px solid white;
        color: white;
      }

      tr.orow {
        border-bottom: 1px solid #c0c0c0;
      }

      .amount {
        float: right;
        font-size: 16px;
        height: 100%;
        padding: 5px;
        position: relative;
        right: -5px;
        width: 200px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #9c4b06), color-stop(1, #7f4e05)) !important;
      }

      @media print {

        .panel-collapse,
        .collapse {
          display: block;
        }

        .orderbutton {
          display: none;
        }

        .prbt {
          display: none;
        }

        .order button {
          text-align: left;
        }

        .order {
          border: 1px solid #000;
          padding: 5px;
        }
      }

      button.prbt {
        border: none;
        width: auto;
        background: red;
        border-radius: 5px;
        font-size: 16px;
        padding: 5px;
        color: white;
      }
    </style>
    <?php
    if (isset($_POST['neworder'])) {
      $new = $_POST['neworder'];
      $query = "UPDATE new_ordered_products
   JOIN new_orders ON new_ordered_products.new_orders_id=new_orders.new_orders_id
   JOIN order_delivery_details ON order_delivery_details.order_delivery_details_id=new_orders.order_delivery_details_id
   JOIN user_delivery_details ON user_delivery_details.user_delivery_details_id=order_delivery_details.user_delivery_details_id
   JOIN users ON users.user_id=user_delivery_details.user_id
    JOIN product_details ON new_ordered_products.product_details_id=product_details.product_details_id
   JOIN item_description ON product_details.item_description_id=item_description.item_description_id
   JOIN item ON item.item_id=item_description.item_id
   JOIN category ON category.category_id=item.category_id
   JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
   JOIN store on store.store_id=product_details.store_id
    SET new_ordered_products.delivery_status='completed',new_ordered_products.delivery_date=NOW() WHERE user_delivery_details.user_delivery_details_id=$new";
      $statement = $pdo->prepare($query);
      $statement->execute();
    }
    ?>
    <div class="table1">
      <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;">
        <i class="fas fa-poll" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>New Orders
      </h4>
      <button style="float:right" class="prbt" onclick="$('#printarea').print();">Print All</button>
    </div>
    <div id="printarea"><?php
    require "pdo.php";
    $id = $_SESSION['id'];
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
    WHERE new_ordered_products.delivery_status='pending' AND product_details.store_id=$id";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $product = $statement->rowCount();
    if ($product == 0) {
      echo '<center><img src="images/sad.png" height="400px" width="400px"><h3>No Orders Yet.....</h3></center><br><br>';
    } else {
      $uid = 0;
      $lk = 0;
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        if ($row['user_delivery_details_id'] != $uid) {
          $lk++;
          $uid = $row['user_delivery_details_id'];
          if ($lk != 1) {
            echo '</table></div> </div>';
          }
          ?>
            <div class="order" id="order<?= $row['new_ordered_products_id'] ?>">
              <button class="prbt" onclick="$('#order<?= $row['new_ordered_products_id'] ?>').print();">Print to Pdf</button>
              <br><br>
              <div class="col-sm-12">
                <button type="button" data-toggle="collapse" href="#myNavbarc<?= $row['new_ordered_products_id'] ?>">
                  <span style="padding: 5px;font-size:16px"> Customer details</span> <span class="amount"> Total Amount <i
                      class="fas fa-rupee" style="padding-left: 12px;"></i><?= $row['sub_total'] ?> </span>
                </button>
                <div class="panel-collapse collapse " id="myNavbarc<?= $row['new_ordered_products_id'] ?>">
                  <table class="center" style="width: auto;margin-left:20px">
                    <tr>
                      <th>Customer Name</th>
                      <td><?= $row['first_name'] ?><?= $row['last_name'] ?></td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td><?= $row['phone'] ?></td>
                    </tr>
                    <tr>
                      <th>Location</th>
                      <td><?= $row['location'] ?></td>
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td><?= $row['address'] ?></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><?= $row['email'] ?></td>
                    </tr>
                  </table>
                </div>
              </div> <br>
              <div style="overflow-x: auto;width:100%">
                <table>
                  <tr class="orhd">
                    <th>OrderID</th>
                    <th> Product</th>
                    <th> Features</th>
                    <th> Order details</th>
                  </tr>
                  <?php
        } ?>
                <tr class="orow">
                  <td> <?= $row['new_ordered_products_id'] ?></td>
                  <td align="center">
                    <img style="height:auto;max-width: 100%;width:auto;max-height: 150px;display: block;margin: auto "
                      class="img-responsive"
                      src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
            </div>
            <?= $row['item_name'] ?></td>
            <td>
              <table cellpadding="10">
                <?php
                if ($row['size'] != 0) {
                  $query1 = "SELECT * FROM size where size_id=" . $row['size'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Size</th>
                    <td> <?= $row1['size_name'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['color'] != 0) {
                  $query1 = "SELECT * FROM color where color_id=" . $row['color'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Color</th>
                    <td><?= $row['color'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['weight'] != 0) {
                  ?>
                  <tr>
                    <th>Weight</th>
                    <td><?= $row['weight'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['flavour'] != 0) {
                  $query1 = "SELECT * FROM flavour where flavour_id=" . $row['flavour'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Flavour</th>
                    <td><?= $row1['flavour_name'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['processor'] != 0) {
                  $query1 = "SELECT * FROM processor where processor_id=" . $row['processor'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Processor</th>
                    <td><?= $row1['processor_name'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['display'] != 0) {
                  $query1 = "SELECT * FROM display where display_id=" . $row['display'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Display</th>
                    <td><?= $row1['display_name'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['battery'] != 0) {
                  $query1 = "SELECT * FROM battery where battery_id=" . $row['battery'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Battery</th>
                    <td><?= $row1['battery_name'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['internal_storage'] != 0) {
                  $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row['internal_storage'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Internal Storage</th>
                    <td><?= $row1['internal_storage_name'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['brand'] != 0) {
                  $query1 = "SELECT * FROM brand where brand_id=" . $row['brand'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Brand</th>
                    <td><?= $row1['brand_name'] ?></td>
                  </tr>
                  <?php
                }
                if ($row['material'] != 0) {
                  $query1 = "SELECT * FROM material where material_id=" . $row['material'];
                  $st1 = $pdo->query($query1);
                  $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                    <th>Material</th>
                    <td><?= $row1['material_name'] ?></td>
                  </tr>
                  <?php
                }
                ?>
              </table>
            </td>
            <td>
              <table>
                <tr>
                  <th> Order Type</th>
                  <td><?= $row['order_type'] ?></td>
                </tr>
                <tr>
                  <th>Order Date</th>
                  <td><?= $row['order_date'] ?></td>
                </tr>
                <tr>
                  <th> Item Quantity</th>
                  <td><?= $row['item_quantity'] ?></td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td><?= $row['total_amt'] ?></td>
                </tr>
              </table>
            </td>
            </tr>
            <script type="text/javascript">
              function ordchn() {
                $('orderbutton>i').attr('class', 'fas fa-check-double');
              }
            </script>
            <form method="post">
              <input type="hidden" name="neworder" value="<?= $row['user_delivery_details_id'] ?>">
              <button name="deliver" class="orderbutton" onclick="ordchn()">Mark As Shipped</button>
            </form>
            <?php
      }
    }
    ?>
      </div>
      <?php
      require "foot.php";
      ?>
      <script type="text/javascript">
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>