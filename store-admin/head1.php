<!-- Sidebar Holder -->
<nav id="sidebar">
  <div class="sidebar-header">
    <h3>
      <div class="text">
        <p style="font-weight: bolder;
    display: block;
    margin-block-start: 1em;
    margin-inline-start: 1rem;
    margin-inline-end: 1rem;
    font-size: 1.5em;"><img class="img-responsive" src="images/logo\logo-high.png"></p>
        <p style="text-decoration: none;
    padding-right: 5px;
    margin-top: 3px;
    font-size: 11px;">
          <?= $_SESSION['username'] ?>
          <i class="fa fa-circle" style="margin-left:12px;color: #3c763d;display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased"></i> Online
        </p>
      </div>
    </h3>
    <strong><img src="images/logo\logofullfill.png" class="img_size"></strong>
  </div>
  <ul class="list-unstyled components">
    <li id="indexphp" class="active"><a href="index.php">
        <span class="icons"><img src="images/speedometer.svg"></span>
        <span class="nav_text">Dashboard</span>
        <span style="float: right;"><i class="fa fa-angle-right"></i></span>
      </a></li>
    <li id="newordersphp"><a href="neworders.php">
        <span class="icons"><img src="images/bag-fill.svg"></span>
        <span class="nav_text">New Orders</span>
        <span style="float: right;"><i class="fa fa-angle-right"></i></span>
      </a></li>
    <li id="selledproductsphp"><a href="selledproducts.php">
        <span class="icons"><img src="images/check2-circle.svg"></span>
        <span class="nav_text">Completed Orders</span>
        <span style="float: right;"><i class="fa fa-angle-right"></i></span>
      </a></li>
    <li id="viewphp"><a href="view.php">
        <span class="icons"><img src="images/arrow-up-circle-fill.svg"></span>
        <span class="nav_text">Update Products</span>
        <span style="float: right;"><i class="fa fa-angle-right"></i></span>
      </a></li>
    <li id="additemphp"><a href="additem.php">
        <span class="icons"><img src="images/plus-circle.svg"></span>
        <span class="nav_text">Add Products</span>
        <span style="float: right;"><i class="fa fa-angle-right"></i></span>
      </a></li>
    <li id="statusphp"><a href="status.php"><span class="icons"><img src="images/file-arrow-up.svg"></span><span
          class="nav_text" style="color:white">Update status</span><span style="float: right;"><i
            class="fa fa-angle-right"></i></span></a>
    </li>
    <li id="chatphp"><a href="message.php"><span class="icons"><i class="fa fa-comments fa-2x"></i></span> <span
          class="nav_text">Chats</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
</nav>
<!-- Page Content Holder -->
<div id="content">
  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-fluid">
      <button type="button" id="sidebarCollapse" class="btn btn-info">
        <i class="fas fa-align-left"></i>
        <span></span>
      </button>
      <button class="btn btn-dark d-inline-block d-lg-none ml-auto  visible-xs" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="fas fa-align-justify"></i>
      </button>
      <?php
      require "pdo.php";
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
                 WHERE new_ordered_products.delivery_status='pending' and store.store_id=$id");
      $stmtn = $stmt->rowCount();
      $query1 = "SELECT COUNT(*) FROM chats WHERE rname='" . $_SESSION['username'] . "' AND stat=0";
      $statement1 = $pdo->prepare($query1);
      $statement1->execute();
      $row1 = $statement1->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php"><i class="fa fa-home" style="font-size: 20px;color: #ff9931;
    padding-right: 8px;"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="neworders.php"><i class="fas fa-cart-plus"
                style="font-size: 20px;color: #ff9931;"></i>
              <span class="uppernum"><?= $stmtn ?></span>Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="message.php"><i class="fa fa-comments" style="font-size: 20px;color: #ff9931;
    padding-right: 8px;"></i><span class="uppernum1"><?= $row1['COUNT(*)'] ?></span>Chat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/Account/logout.php"><i class="fa fa-power-off" style="font-size: 20px;color: #ff9931;
    padding-right: 8px;"></i>Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>