<?php
require "head.php";
?>

<body>
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <div class="row">
      <div class="col-md-3 cart">
        <div class="well">
          <div class="well-box">
            <div class="well-text ">
              <?php
              require "pdo.php";
              //no of categories
              $cat = $pdo->query("select distinct category_name from category");
              $catn = $cat->rowCount();
              //no of products
              $id = $_SESSION['id'];
              $pro = $pdo->query("SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where
item_description.item_description_id IN (SELECT item_description_id FROM product_details where store_id=$id )");
              $product = $pro->rowCount();
              //new item
              $new = $pdo->query("select  *
from item where (added_date) in (
    select max(added_date) as date
    from item
) ");
              $new_it = $new->rowCount();
              //new orders
              $id = $_SESSION['id'];
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
                 WHERE new_ordered_products.delivery_status='pending' and product_details.store_id=$id");
              $stmtn = $stmt->rowCount();
              ?>
              <p class="num"><?= $catn ?></p>
              <h4>Categories</h4>
            </div>
            <div class="img-responsive ban-top">
              <img src="images/diagram-3-fill.svg">
            </div>
          </div>
          <div class="new-text">
            <a href="categories.php" class="text-under" style=" color:white;   text-decoration: none;"><span>More
                info</span><span><img src="images/arrow-right-circle.svg"></span></a>
          </div>
        </div>
      </div>
      <div class="col-md-3 cart">
        <div class="well" style="background-color: #00a65a">
          <div class="well-box">
            <div class="well-text ">
              <p class="num"><?= $product ?></p>
              <h4>Products</h4>
            </div>
            <div class="img-responsive ban-top">
              <img src="images/wallet.svg">
            </div>
          </div>
          <div class="new-text">
            <a href="products.php" class="text-under" style=" color:white;   text-decoration: none;"><span>More
                info</span><span><img src="images/arrow-right-circle.svg"></span></a>
          </div>
        </div>
      </div>
      <div class="col-md-3 cart">
        <div class="well" style="background-color: #f39c12">
          <div class="well-box">
            <div class="well-text ">
              <p class="num"><?= $new_it ?></p>
              <h4>New </h4>
            </div>
            <div class="img-responsive ban-top">
              <img src="images/file-plus.svg">
            </div>
          </div>
          <div class="new-text">
            <a href="new_item.php" class="text-under" style=" color:white;   text-decoration: none;"><span>More
                info</span><span><img src="images/arrow-right-circle.svg"></span></a>
          </div>
        </div>
      </div>
      <div class="col-md-3 cart">
        <div class="well" style="background-color: #dd4b39">
          <div class="well-box">
            <div class="well-text ">
              <p class="num"><?= $stmtn ?></p>
              <h4>Orders</h4>
            </div>
            <div class="img-responsive ban-top">
              <img src="images/cart-fill.svg">
            </div>
          </div>
          <div class="new-text">
            <a href="neworders.php" class="text-under" style=" color:white;   text-decoration: none;"> <span>More
                info</span><span><b><img src="images/arrow-right-circle.svg"></b></span></a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-sm-3" style="height: 500px;
    margin-top: 50px;
    background: #FFFFFF;
    padding: 0;
    border-top: 4px solid #2D720B
">
        <h4 style="border-bottom: 1px solid #D6D6D6;padding-bottom: 20px;padding-left: 20px;margin-bottom: 20px;"><i
            class="fa fa-pie-chart" style="padding-right: 20px"></i>Average Day</h4>
        <div id="piechart" style="width: 100%;overflow-x: hidden;
        justify-content:center;
        display:flex;">
        </div>
      </div>
      <div id="calendar-div" class="col-lg-5 col-sm-3" style="padding: 0;
    margin-top: 50px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00a65a), color-stop(1, #00ca6d)) !important;
    border-top: none;
    position: relative;
    height: 500px;
   ">
        <h4 style="border-bottom: 1px solid #D6D6D6;
    padding-bottom: 20px;
    padding-left: 20px;
    background: #fff;
    margin: 0;
    padding-top: 10px;
    border-top: 4px solid #2d720b;"><i class="fas fa-calendar" style="padding-right: 20px"></i>Calendar</h4>
        <?php
        require "calender.php";
        ?>
      </div>
      <br><br><br><br>
      <div class="row">
        <div class="panel-group col-sm-7">
          <div class="panel panel-default">
            <a data-toggle="collapse" href="#collapse1">
              <div class="panel-heading">
                <h4 class="panel-title">
                  To Do List
                </h4>
              </div>
            </a>
            <div id="collapse1" class="panel-collapse collapse in">
              <ul class="list-group">
                <?php
                include "todolist.php";
                ?>
              </ul>
            </div>
          </div>
        </div>
        <style>
          #collapse2 table,
          tr {
            width: 100%;
          }

          #collapse2 th,
          td {
            text-align: center;
            width: 32%;
            padding-left: 2%;
            padding-right: 2%;
          }

          #collapse2 ul li.active>a,
          a[aria-expanded="true"] {
            text-decoration: none;
            border-left: none;
          }

          .price {
            position: absolute;
            top: 0;
            right: 0;
            border-radius: 5px;
            border: none;
            height: 20px;
            color: #ffffff;
            font-size: 10px;
            font-weight: bolder;
            width: 80px;
          }

          .panel-heading {
            height: 50px;
            padding: 15px;
            color: white;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00c0ef), color-stop(1, #01728e)) !important;
          }

          .vwbt {
            float: right;
            border-radius: 5px;
            border: none;
            height: 30px;
            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00d01a), color-stop(1, #00bf4d)) !important;
            color: white;
          }

          li.list-group-item:nth-child(odd) {
            background: #f9f9f9;
          }

          li.list-group-item {
            border: none;
          }

          #event {
            height: 100px;
            padding: 10px;
            background-color: #FFFFFF;
          }

          img.smimg {
            height: auto;
            max-width: 60px;
            max-height: 60px;
            width: auto;
          }
        </style>
        <?php
        $colors = array("red", "green", "#7d7d7d", "black", "#000c96", "dodgerblue", "#ff9800"); ?>
        <div class="panel-group col-sm-5">
          <div class="panel panel-default">
            <a data-toggle="collapse" href="#collapse2">
              <div class="panel-heading">
                <h4 class="panel-title">
                  Recently Added Products
                </h4>
              </div>
            </a>
            <div id="collapse2" class="panel-collapse collapse in">
              <ul class="list-group">
                <?php
                $stmt = $pdo->query(
                  "select  *
        from item join item_description on item_description.item_id=item.item_id where item.added_date in (
            select max(added_date) as date
            from item
        ) LIMIT 4"
                );
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <li class="list-group-item" style="display: flex;">
                    <div style="width:70px">
                      <img class="smimg"
                        src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                    </div>
                    <div style="position: relative;float:left;width:100%;padding:20px"> <?= $row['item_name'] ?>
                      <button class="price" style="background:<?= $colors[array_rand($colors)] ?>;"><i
                          class="fas fa-rupee-sign"></i> <?= $row['price'] ?></button>
                    </div>
                  </li> <?php
                }
                ?>
                <li class="list-group-item" style="padding:10px;height:50px;
       background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00c0ef), color-stop(1, #01728e)) !important;
">
                  <a href="new_item.php"><button class="vwbt">View All</button></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        var clients;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            clients = JSON.parse(this.responseText);
          }
        };
        xmlhttp.open("GET", "piechart.php", true);
        xmlhttp.send();
        // Load google charts
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);
        setInterval(drawChart, 1000);
        // Draw the chart and set the chart values
        function drawChart() {
          var result = [];
          result.push(['user', parseInt(clients[0].user)]);
          result.push(['selled', parseInt(clients[1].selled)]);
          result.push(['neworders', parseInt(clients[2].neworders)]);
          result.push(['newproducts', parseInt(clients[3].newproducts)]);
          console.log(result);
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Topping');
          data.addColumn('number', 'Slices');
          data.addRows(result);
          // Optional; add a title and set the width and height of the chart
          var options = {
            backgroundColor: 'transparent', color: 'none', position: 'center',
            'title': 'Average Day', 'width': 480, 'height': 420, pieHole: 0.4, legend: { position: 'right' }
          };
          // Display the chart inside the <div> element with id="piechart"
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
        }
      </script>
      <?php
      require "foot.php";
      ?>
    </div>