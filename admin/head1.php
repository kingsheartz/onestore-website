<!-- Sidebar Holder -->
<style>
  #sidebar ul li ul {
    display: none;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #364348), color-stop(1, #353535)) !important;
  }

  #sidebar ul li ul li {

    color: #e8e8e8;
    padding-top: 5px;
  }

  #sidebar ul li ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
    background: black;
    border-left: 4px solid black;
  }

  #sidebar ul li ul li a.active {
    background-color: initial;
    color: #17629e;
    padding-bottom: initial
  }

  #sidebar ul li ul li a:hover {
    color: #fff;
    background-color: #17629e
  }
</style>
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
    font-size: 11px;"><i class="fa fa-circle" style="color: #3c763d;display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased"></i> Online</p>
      </div>
    </h3>
    <strong><img src="images/logo\logofullfill.png" class="img_size"></strong>
  </div>
  <ul class="list-unstyled components">
    <li id="indexphp" class="active"><a href="index.php"><span class="icons"><img
            src="images/speedometer.svg"></span><span class="nav_text">Dashboard</span><span style="float: right;"><i
            class="fa fa-angle-right"></i></span></a></li>
    <li id="shopsphp"><a href="shops.php"><span class="icons"><img src="images/shop.svg"></span><span
          class="nav_text">Shops</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
    <li id="addcategoriesphp"><a href="addcategories.php"><span class="icons"><img
            src="images/diagram-3.svg"></span><span class="nav_text">Category</span><span style="float: right;"><i
            class="fa fa-angle-right"></i></span></a></li>

    <li id="requestphp"><a href="request.php"><span class="icons"><img src="images/file-earmark-lock.svg"></span> <span
          class="nav_text">Requests</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
    <li id="selledproductsphp"><a href="selledproducts.php"><span class="icons"><img src="images/check-all.svg"></span>
        <span class="nav_text">Completed Orders</span><span style="float: right;"><i
            class="fa fa-angle-right"></i></span></a></li>
    <li id="uploadimagesphp"><a href="uploadimages.php"><span class="icons"><img
            src="images/file-earmark-plus.svg"></span><span class="nav_text"> Add Product</span><span
          style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
    <li id="viewphp"><a href="view.php"><span class="icons"><img src="images/file-earmark-arrow-up.svg"></span> <span
          class="nav_text">Update Products</span><span style="float: right;"><i
            class="fa fa-angle-right"></i></span></a></li>
    <li id="addstorephp"><a href="addstore.php"><span class="icons"><img src="images/plus-circle.svg"></span><span
          class="nav_text"> Add Store</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a>
    </li>



    <li id="addfeatphp"><a href="#"><span class="icons"><img src="images/grid-fill.svg"></span>
        <span class="nav_text"> Add Features</span><span style="float: right;"><i id="featic"
            class="fa fa-angle-right"></i></span></a>

      <ul class="list-unstyled components">
        <li>
          <a href="addfeat.php?size=1">
            <span class="icons"><img src="images/aspect-ratio-fill.svg"></span>
            <span class="nav_text"> Size</span></a>
        </li>
        <li>
          <a href="addfeat.php?color=1">
            <span class="icons"><img src="images/palette-fill.svg"></span>
            <span class="nav_text"> Color</span>
          </a>
        </li>

        <li>
          <a href="addfeat.php?flavour=1">
            <span class="icons"><img src="images/droplet-fill.svg"></span>
            <span class="nav_text"> Flavour</span>
          </a>
        </li>
        <li>
          <a href="addfeat.php?processor=1">
            <span class="icons"><img src="images/cpu-fill.svg"></span>
            <span class="nav_text"> Processor</span>
          </a>
        </li>
        <li>
          <a href="addfeat.php?display=1">
            <span class="icons"><img src="images/display.svg"></span>
            <span class="nav_text"> Display</span>
          </a>
        </li>

        <li>
          <a href="addfeat.php?battery=1">
            <span class="icons"><img src="images/battery-full.svg"></span>
            <span class="nav_text"> Battery</span>
          </a>
        </li>
        <li>
          <a href="addfeat.php?internal_storage=1">
            <span class="icons"><img src="images/sd-card-fill.svg"></span>
            <span class="nav_text">
              Internal Storage</span></a>
        </li>
        <li>
          <a href="addfeat.php?brand=1">
            <span class="icons"><img src="images/badge-ad.svg"></span>
            <span class="nav_text"> Brand</span></a>
        </li>
        <li>
          <a href="addfeat.php?material=1">
            <span class="icons"><img src="images/palette2.svg"></span>
            <span class="nav_text"> Material</span></a>
        </li>
      </ul>



    </li>
    <li id="updatepassphp"><a href="updatepass.php"><span class="icons"><img src="images/key-fill.svg"></span><span
          class="nav_text">Password</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
    <li id="chatphp"><a href="message.php"><span class="icons">
          <i class="fa fa-comments fa-2x"></i></span> <span class="nav_text">Chats</span>
        <span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>

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
      $query = "SELECT COUNT(*) FROM product_details join item_description on product_details.item_description_id=item_description.item_description_id join item on item.item_id=item_description.item_description_id  JOIN store on store.store_id=product_details.store_id WHERE  product_details.permission=0";
      $statement = $pdo->prepare($query);
      $statement->execute();
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      $query1 = "SELECT COUNT(*) FROM chats WHERE rname='admin' AND stat=0";
      $statement1 = $pdo->prepare($query1);
      $statement1->execute();
      $row1 = $statement1->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              <i class="fa fa-home" style="font-size: 20px; color:coral;
    padding-right: 8px;"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="request.php">
              <i class="fa fa-bell" style="font-size: 20px; color:coral;  "></i><span
                class="uppernum"><?= $row['COUNT(*)'] ?></span>Requests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="message.php">
              <i class="fa fa-comments" style="font-size: 20px; color:coral;
    padding-right: 8px;"></i><span class="uppernum1"><?= $row1['COUNT(*)'] ?></span>Chat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">
              <i class="fa fa-power-off" style="font-size: 20px; color:coral;
    padding-right: 8px;"></i>Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script>
    $('#sidebar li').on('click', 'a', function (e) {
      if ($(this).parent().children('ul').length) {
        e.preventDefault();
        $('#featic').attr('class', 'fas fa-angle-down');
        $(this).addClass('active');
        $(this).parent().children('ul').slideDown();
        setTimeout(function () {
          //$.fn.matchHeight._update();
          //  $.fn.matchHeight._maintainScroll = true;
        }, 1000);
      }
    });
    $('#sidebar li').on('click', 'a.active', function (e) {
      e.preventDefault();
      $(this).removeClass('active');
      $('#featic').attr('class', 'fas fa-angle-right');
      $(this).parent().children('ul').slideUp();
      setTimeout(function () {
        // $.fn.matchHeight._update();
        // $.fn.matchHeight._maintainScroll = true;
      }, 1000);
    });</script>