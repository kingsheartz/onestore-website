<?php
require "header.php";
require "../Common/cookie.php";
?>
<style type="text/css">
  .cn-slider img {
    height: 150px;
  }

  /*CATEGORY HORIZONTAL VIEW*/
  .cat-title a {
    width: 100%;
    transition: .3s;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding-top: 0px !important;
  }

  .cat-title a:hover {
    color: #0c99cc;
  }

  .cat-img {
    width: 108px;
    margin-top: -15px;
  }

  .cat-img a {
    padding-bottom: 0px !important;
  }

  .cookiesetting {
    transition: 1s;
  }

  .owl-item {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    height: 100% !important;
  }

  .single-promo:hover p {
    color: #fff !important;
  }
</style>
<?php
//if(isset($_SESSION['id'])){
?>
<script>
  function getCookieset(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  $(document).ready(function () {
    //DELETE THIS COOKIE//document.cookie = "cookieset=; expires=Thu, 01 Jan 1970 00:00:00 UTC; ";
    if (getCookieset('cookieset') !== "y") {
      <?php
      if (isset($_SESSION['id'])) {
        ?>
        $.ajax({
          url: "../Common/functions.php", //passing page info
          data: { "getcookie": 1, "userid": <?= $_SESSION['id'] ?> },  //form data
          type: "post",   //post data
          dataType: "json",   //datatype=json format
          timeout: 30000,   //waiting time 30 sec
          success: function (data) {    //if registration is success
            if (data.status == 'success') {
              return;
            }
            else if (data.status == 'error') {
              $('.cookiesetting').css('display', 'flex');
              setTimeout(function () { $('.cookiesetting').css('bottom', 25); }, 500);
            }
          },
          error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            if (textstatus === "timeout") {
              swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });
              return;
            }
            else { return; }
          }
        }); //closing ajax
        <?php
      } else {
        ?>
        $('.cookiesetting').css('display', 'flex');
        setTimeout(function () { $('.cookiesetting').css('bottom', 25); }, 500);
        <?php
      }
      ?>
    }
  });
  $(window).unload(function () { document.cookie = 'mainscrollTop=' + $(window).scrollTop(); });
  var scrollTop = 'mainscrollTop';
</script>
<div
  style="display:none;position: fixed;bottom:-500px;width:100%;z-index:999;padding-left:5px;padding-right:5px;justify-content:center"
  class="cookiesetting">
  <center>
    <div
      style="padding:10px;border-radius:5px;background-color: rgba(0,0,0,0.85);max-width: max-content;text-align: left;">
      <h4 style="color: white;">Your privacy</h4>
      <p style="color:white;text-align: justify;">By clicking "Accept all cookies", you agree Stack Exchange can store
        cookies on your device and disclose information in accordance with our <a
          href="https://www.cookiesandyou.com/about-cookies/" target="_blank" style="color: white;">Cookie Policy</a>.
      </p>
      <button type="button" class="btn btn btn-primary" style="font-size:14px"
        onclick="$('.cookiesetting').hide();setcookie(1);" data-dismiss="modal">Accept all cookies</button>
      <button type="button" class="btn btn btn-success small-cookie-accept" onclick="$('#cookiemodal').modal('show');"
        style="font-size:14px" data-dismiss="modal">Customize settings</button>
    </div>
  </center>
</div>
<?php
//}
?>
<div style="background-color: #e0e0e0;padding-bottom: 10px;">
  <div class="element_grid" style="background-color: #fff;">
    <div class="scrollmenu cat_item_scroll hidescroll" style="width: 100%;">
      <div class="div-wrapper " style="margin-bottom: 10px;">
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=1"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/care.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=1">Personal care</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=2"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/grocery.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=2">Grocery</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=3"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/mobile.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=3">Mobile</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=4"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/fasion.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=4">Fasion</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=5"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/home.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=5">Home</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=6"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/electronics.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=6">Electronics</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=10"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/appliances.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=10">Appliances</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=7"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/toys&baby.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=7">Toys&Baby</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=8"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/sports.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=8">Sports</a>
          </div>
        </div>
        <div class="cat-img">
          <a href="../Product/products_limited.php?category_id=9"><img title=" " alt=" " class="cat_new_size"
              src="../../images/caticon/beauty.png"></a>
          <div class="cat-title">
            <a href="../Product/products_limited.php?category_id=9">Beauty</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="slider-area" style="background-color: white;padding-top: 10px;margin-top: -32px;">
  <!-- Slider -->
  <div class="block-slider block-slider4">
    <ul class="" id="bxslider-home4" style="height: 400px;">
      <?php
      $slider = array("iPhone /6 /Plus //Dual SIM", " Offer /50% /off //school supplies & backpacks.*", "Apple /Store /Ipod //Select Item", "Apple /Store /Ipod //& Phone", "Brand /New /Mobiles //Smart Phones & Accessories");
      $i = 0;
      while ($i < sizeof($slider)) {
        unset($divider);
        unset($split);
        $divider = explode("//", $slider[$i]);
        $split = explode("/", $divider[0]);
        ?>
        <li>
          <div class="row captions">
            <div class="col-md-12 ">
              <img src="../../images/slider/h4-slide<?= $i + 1 ?>.png" alt="Slide">
              <div class="caption-group">
                <div class="cap_dyn">
                  <p class="cap_head">
                    <?= $split[0] ?> <span class="primary"><?= $split[1] ?> <strong><?= $split[2] ?></strong></span>
                  </p>
                  <p class="cap_body" style="font-family:Arial;"><?= $divider[1] ?></p>
                </div>
                <a class=" button-radius" href="#"><span class="icon"></span>Shop now</a>
              </div>
            </div>
          </div>
        </li>
        <?php
        $i++;
      }
      ?>
    </ul>
  </div><br>
</div>
<!-- ./Slider -->
<div style="background-color: #e0e0e0;padding-left: 7px;padding-right: 7px;">
  <br>
  <!-- //top-header and slider -->
  <!-- top-brands -->
  <?php
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Generate Dynamic Loading
  function randomGenerate($min, $max, $quantity)
  {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
  }
  //Generate Dynamic Loading
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /*COLOR PICKER*/
  $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
  $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
  do {
    $rancolor1 = array_rand($color, 1);
    $rancolor2 = array_rand($color, 1);
  }
  while ($rancolor1 == $rancolor2);
  $c1 = $c2 = "white";
  if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
    $c1 = "black";
  }
  if ($bgcolor[$rancolor2] == "cyan" || $bgcolor[$rancolor2] == "#FF6666" || $bgcolor[$rancolor2] == "#E6BF00") {
    $c2 = "black";
  }
  /*COLOR PICKER*/
  $cntsql = "select count(sub_category_id) as sub_cnt from sub_category where category_id=1";
  $cntstmt = $pdo->query($cntsql);
  $cntrow = $cntstmt->fetch(PDO::FETCH_ASSOC);
  $sub_cnt = $cntrow['sub_cnt'];
  do {
    $rand_sub_id1 = randomGenerate('1', $sub_cnt, (int) $sub_cnt);
    $rand_sub_id1_rand1 = array_rand($rand_sub_id1, 1);
    $rand_sub_id1 = $rand_sub_id1[$rand_sub_id1_rand1];
    $rand_sub_id2 = randomGenerate('1', $sub_cnt, (int) $sub_cnt);
    $rand_sub_id2_rand2 = array_rand($rand_sub_id2, 1);
    $rand_sub_id2 = $rand_sub_id2[$rand_sub_id2_rand2];
  }
  while ($rand_sub_id1 == $rand_sub_id2);
  $catsql1 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id1;
  $catstmt1 = $pdo->query($catsql1);
  $sub_catrow1 = $catstmt1->fetch(PDO::FETCH_ASSOC);
  $catsql2 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id2;
  $catstmt2 = $pdo->query($catsql2);
  $sub_catrow2 = $catstmt2->fetch(PDO::FETCH_ASSOC);
  $cat_id1 = $sub_catrow1['category_id'];
  $sub_cat_id1 = $sub_catrow1['sub_category_id'];
  $sub_cat_name1 = $sub_catrow1['sub_category_name'];
  $cat_id2 = $sub_catrow2['category_id'];
  $sub_cat_id2 = $sub_catrow2['sub_category_id'];
  $sub_cat_name2 = $sub_catrow2['sub_category_name'];
  ?>
  <div class="element_grid" style="margin: 0px;padding: 0px;border-radius: 10px;margin-top: -20px;">
    <div>
      <h4 class="show_cat_list_main tb-padding sidebar-title"
        style="border-left: 5px solid <?= $bgcolor[$rancolor1] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
        <?= $sub_cat_name1 ?> <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
        <span style="float: right;margin-right: 5px;margin-top: -4px;">
          <button type="button"
            style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor1] ?>;padding: 11px auto;font-size: 12px;"
            name="proceed" class="checkout-button button alt wc-forward"><a
              href="../Product/products_viewall.php?category_id=<?= $cat_id1 ?>&subcategory_id=<?= $sub_cat_id1 ?>"
              style="color:<?= $c1 ?>;">View all</a></button>
        </span>
      </h4>
      <hr style="padding: 0;margin:0;">
      <div class="scrollmenu bl_item_scroll  <?= $color[$rancolor1] ?>"
        style="background-color: #fff;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
        <?php
        require "../Common/pdo.php";
        $row = $pdo->query("select item_description.item_description_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id1 and sub_category.sub_category_id=$sub_cat_id1 and item.sub_category_id=$sub_cat_id1 ");
        while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <a class="img_trans" href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
              title="<?= $row1['item_name'] ?>" alt=" <?= $row1['item_name'] ?>" class="new_size"
              src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"
              style="max-height: 180px;max-width: 180px;image-rendering: auto;margin-left: auto;margin-right: auto;"></a>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
  <hr class="make_div">
  <hr class="make_div">
  <!-- //top-brands -->
  <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  <!-- main-slider -->
  <ul id="demo1">
    <li>
      <img src="../../images/k1.jpg" alt="" />
      <!--Slider Description example-->
      <div class="slide-desc">
        <h3>We brings you the best in all manners ...</h3>
      </div>
    </li>
    <li>
      <img src="../../images/k2.jpg" alt="" />
      <div class="slide-desc">
        <h3>Everything you wishes is in your finger tips !</h3>
      </div>
    </li>
    <li>
      <img src="../../images/k3.jpg" alt="" />
      <div class="slide-desc">
        <h3>Your happiness is our happiness !</h3>
      </div>
    </li>
  </ul>
  <!-- //main-slider -->
  <!-- //top-header and slider -->
  <!-- //top-brands -->
  <hr class="make_div">
  <div class="element_grid" style="margin: 0px;padding: 0px;">
    <div style="margin: 0px;padding: 0px;">
      <h4 class="show_cat_list_main tb-padding sidebar-title"
        style="border-left: 5px solid <?= $bgcolor[$rancolor2] ?>;border-top-left-radius: 5px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
        <?= $sub_cat_name2 ?> <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
        <span style="float: right;margin-right: 5px;margin-top: -4px;">
          <button type="button"
            style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor2] ?>;padding: 11px auto;font-size: 12px;"
            name="proceed" class="checkout-button button alt wc-forward"><a
              href="../Product/products_viewall.php?category_id=<?= $cat_id2 ?>&subcategory_id=<?= $sub_cat_id2 ?>"
              style="color:<?= $c2 ?>;">View all</a></button>
        </span>
      </h4>
      <hr style="padding: 0;margin:0;">
      <div class="scrollmenu mui_item_scroll <?= $color[$rancolor2] ?>"
        style="background-color: #fff;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
        <?php
        require "../Common/pdo.php";
        $row = $pdo->query("select item_description.item_description_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id2 and sub_category.sub_category_id=$sub_cat_id2 and item.sub_category_id=$sub_cat_id2");
        while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <a class="img_trans" href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
              title="<?= $row1['item_name'] ?>" alt=" <?= $row1['item_name'] ?>" class="new_size"
              src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"
              style="max-height: 180px;width: auto;max-width: 180px;image-rendering: auto;margin-left: auto;margin-right: auto;"></a>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
  <!-- //top-brands -->
  <hr class="make_div">
  <hr class="make_div">
  <!-- Carousel
    ================================================== -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active" style="background-color: #999"></li>
      <li data-target="#myCarousel" data-slide-to="1" style="background-color: #999"></li>
      <li data-target="#myCarousel" data-slide-to="2" style="background-color: #999"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <a href="../Product/products_limited.php?category_id=1"> <img class="first-slide" src="../../images/b4.jpg"
            alt="First slide"></a>
      </div>
      <div class="item">
        <a href="../Product/products_limited.php?category_id=5&sub_category_id=24"> <img class="second-slide "
            src="../../images/b1.jpg" alt="Second slide"></a>
      </div>
      <div class="item">
        <a href="../Product/products_limited.php?category_id=2"><img class="second-slide " src="../../images/b2.gif"
            alt="Second slide"></a>
      </div>
    </div>
  </div><!-- /.carousel -->
  <div class="clearfix"> </div>
  <hr class="make_div">
  <hr class="make_div">
  <style type="text/css">
    .difcat {
      position: relative;
      height: max-content;
      margin: auto;
      margin-top: 10px;
      display: block;
      background: #FFFFFF;
      box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);
    }

    .difrow {
      height: max-content;
      overflow: auto;
      width: 76vw;
      margin: auto;
      display: block;
      white-space: nowrap;
      bottom: 0;
      width: 100%;
    }

    .products-all-in-one {
      display: inline-block;
      text-align: center;
      padding: 14px;
      padding-bottom: 0px;
      position: relative;
      height: 250px;
      width: 200px;
      background: white;
      color: #000;
    }

    .products-all-in-one img {
      margin: auto;
      display: block;
      background: white;
      image-rendering: auto;
      image-rendering: crisp-edges;
      width: auto;
      max-width: 170px;
      height: auto;
      max-height: 180px;
    }

    .difhed {
      border-bottom: 3px solid #dadada;
      width: 100%;
      margin: 0;
      font-size: 20px;
      font-family: serif;
      font-weight: bold;
      text-transform: capitalize;
      padding-bottom: 0px;
      padding-top: 20px;
      margin-left: 20px;
    }

    .left-arrow-btn-all {
      position: absolute;
      top: 30%;
      left: 0;
      width: 30px;
      z-index: 1;
      height: 100px;
      font-size: 24px;
      background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #fff)) !important;
      color: rgb(114, 114, 114);
      border: none;
      border-bottom-right-radius: 4px;
      border-top-right-radius: 4px;
      border-top-left-radius: 6px;
      border-bottom-left-radius: 6px;
    }

    .right-arrow-btn-all {
      position: absolute;
      top: 30%;
      right: 0;
      width: 30px;
      z-index: 1;
      height: 100px;
      font-size: 24px;
      background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #fff)) !important;
      color: rgb(114, 114, 114);
      border: none;
      border-bottom-right-radius: 6px;
      border-top-right-radius: 6px;
      border-top-left-radius: 4px;
      border-bottom-left-radius: 4px;
    }

    .difrow::-webkit-scrollbar {
      width: 100%;
      height: 4px;
    }

    .difrow::-webkit-scrollbar-thumb {
      border-radius: 0px;
      -webkit-box-shadow: inset 0 0 6px transparent;
      box-shadow: inset 0 0 6px transparent;
    }

    .table1 {
      margin-bottom: 0px;
      max-height: max-content;
      height: 60px;
    }

    .difhed button {
      float: right;
      font-weight: bold;
      font-size: 16px;
      margin-right: 5px;
      margin-top: 5px;
      padding: 2px;
      width: 100px;
      background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #3197ff), color-stop(1, #2196f3)) !important;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      border: none;
      color: white;
      border-radius: 5px;
    }

    .star-checked {
      color: orange;
    }

    .stars-outer {
      display: inline-block;
      position: relative;
      font-family: FontAwesome;
      font-size: 20px;
      letter-spacing: 5px;
    }

    .stars-outer::before {
      content: "\f006 \f006 \f006 \f006 \f006";
    }

    .stars-inner {
      position: absolute;
      top: 0;
      left: 0;
      white-space: nowrap;
      overflow: hidden;
      width: 0;
    }

    .stars-inner::before {
      content: "\f005 \f005 \f005 \f005 \f005";
      color: orange;
    }
  </style>
  <script type="text/javascript">
    function scrolllisten(x) {
      var y = Math.round($('#' + x).scrollLeft());
      var width = $('#' + x).outerWidth();
      var scrollWidth = $('#' + x)[0].scrollWidth;
      var sub = Math.round(parseInt(scrollWidth) - parseInt(width));
      console.log(width + " scrollwidth= " + scrollWidth + " scrollwidth - width = " + sub + " y= " + y);
      if (sub == y) {
        $('#' + x + '>.right-arrow-btn-all').hide();
        return;
      }
      $('#' + x + '>.left-arrow-btn-all').show();
      if (y === 0) {
        $('#' + x + '>.left-arrow-btn-all').hide();
      }
      $('#' + x + '>.right-arrow-btn-all').show();
    }
    function moveright(x) {
      var y = $('#' + x).scrollLeft();
      var width = $('#' + x).outerWidth();
      var scrollWidth = $('#' + x)[0].scrollWidth;
      $('#' + x).scrollLeft(y + 250);
    }
    function moveleft(x) {
      var y = $('#' + x).scrollLeft();
      $('#' + x).scrollLeft(y - 250);
    }
  </script>
  <?php
  require "../Common/pdo.php";
  $query11 = "SELECT * from  category";
  $st11 = $pdo->query($query11);
  while ($row11 = $st11->fetch(PDO::FETCH_ASSOC)) {
    $ct = $row11['category_id'];
    ?>
    <?php
    //$query="SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item.category_id=$ct and (item.added_date) in (select max(added_date) as date from item) GROUP BY item_description.item_id LIMIT 15";
    $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item.category_id=$ct GROUP BY item_description.item_id LIMIT 15";
    $st = $pdo->query($query);
    $product = $st->rowCount();
    if ($product == 0) {
      continue;
    } else {
      ?>
      <div class="difcat " style="border-radius: 5px;padding-bottom:3px">
        <span class="difhed"><?= $row11['category_name'] ?>
          <button onclick="location.href='../Product/viewsubcat.php?category_id=<?= $ct ?>'">View All</button></span></span>
        <div class="difrow hidescroll" id="difrow<?= $ct ?>" onscroll="scrolllisten('difrow<?= $ct ?>');">
          <button class="left-arrow-btn-all shadow_all_none" onclick="moveleft('difrow<?= $ct ?>')"
            style="display: none;"><i class="fas fa-chevron-left"></i></button>
          <button class="right-arrow-btn-all shadow_all_none" onclick="moveright('difrow<?= $ct ?>')"><i
              class="fas fa-chevron-right"></i></button>
          <?php
          while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="products-all-in-one" title="<?= $row['item_name'] ?>"
              onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
              <div
                style="display: flex;justify-content: center;height: 200px;width:100%;background: white;text-align: center;">
                <img class="image" align="middle"
                  src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
              </div>
              <?php
              if (strlen($row['item_name']) >= 22) {
                $item = $row['item_name'];
                $item_name = substr($item, 0, 25) . "...";
              } else {
                $item_name = $row['item_name'];
              }
              ?>
              <div class="deupd"><?= $item_name ?><br></div>
            </div>
            <?php
          }
          echo '</div></div>';
    }
  }
  ?>
      <script type="text/javascript">
        function showupda(x) {
          document.forms[x].submit();
        }
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
        function conca() {
          console.log('helo');
          if ($('#w1').val() != 0) {
            var v1 = $('#w1').val() + ' ' + $('#w2').val();
            $('#w3').val(v1);
          }
        }
      </script>
      <!-- Category News Start-->
      <?php
      /*COLOR PICKER*/
      $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
      $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
      $rancolor = array_rand($color, 4);
      $c1 = $c2 = $c3 = $c4 = "white";
      if ($bgcolor[$rancolor[0]] == "cyan" || $bgcolor[$rancolor[0]] == "#FF6666" || $bgcolor[$rancolor[0]] == "#E6BF00") {
        $c1 = "black";
      }
      if ($bgcolor[$rancolor[1]] == "cyan" || $bgcolor[$rancolor[1]] == "#FF6666" || $bgcolor[$rancolor[1]] == "#E6BF00") {
        $c2 = "black";
      }
      if ($bgcolor[$rancolor[2]] == "cyan" || $bgcolor[$rancolor[2]] == "#FF6666" || $bgcolor[$rancolor[2]] == "#E6BF00") {
        $c3 = "black";
      }
      if ($bgcolor[$rancolor[3]] == "cyan" || $bgcolor[$rancolor[3]] == "#FF6666" || $bgcolor[$rancolor[3]] == "#E6BF00") {
        $c4 = "black";
      }
      /*COLOR PICKER*/
      $cntsql = "select min(sub_category_id) as minsubid,max(sub_category_id) as maxsubid , count(sub_category_id) as sub_cnt from sub_category where category_id=1";
      $cntstmt = $pdo->query($cntsql);
      $cntrow = $cntstmt->fetch(PDO::FETCH_ASSOC);
      $min_sub_cnt = $cntrow['minsubid'];
      $max_sub_cnt = $cntrow['maxsubid'];
      $sub_cnt = $cntrow['sub_cnt'];
      do {
        $rand_sub_id = randomGenerate($min_sub_cnt, $max_sub_cnt, (int) $sub_cnt);
        $rand_sub_id_rand = array_rand($rand_sub_id, 4);
        $rand_sub_id1 = $rand_sub_id[$rand_sub_id_rand[0]];
        $rand_sub_id2 = $rand_sub_id[$rand_sub_id_rand[1]];
        $rand_sub_id3 = $rand_sub_id[$rand_sub_id_rand[2]];
        $rand_sub_id4 = $rand_sub_id[$rand_sub_id_rand[3]];
      }
      while ($rand_sub_id1 == $rand_sub_id2);
      $catsql1 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id1;
      $catstmt1 = $pdo->query($catsql1);
      $sub_catrow1 = $catstmt1->fetch(PDO::FETCH_ASSOC);
      $catsql2 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id2;
      $catstmt2 = $pdo->query($catsql2);
      $sub_catrow2 = $catstmt2->fetch(PDO::FETCH_ASSOC);
      $catsql3 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id3;
      $catstmt3 = $pdo->query($catsql3);
      $sub_catrow3 = $catstmt3->fetch(PDO::FETCH_ASSOC);
      $catsql4 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id4;
      $catstmt4 = $pdo->query($catsql4);
      $sub_catrow4 = $catstmt4->fetch(PDO::FETCH_ASSOC);
      $cat_id1 = $sub_catrow1['category_id'];
      $sub_cat_id1 = $sub_catrow1['sub_category_id'];
      $sub_cat_name1 = $sub_catrow1['sub_category_name'];
      $cat_id2 = $sub_catrow2['category_id'];
      $sub_cat_id2 = $sub_catrow2['sub_category_id'];
      $sub_cat_name2 = $sub_catrow2['sub_category_name'];
      $cat_id3 = $sub_catrow3['category_id'];
      $sub_cat_id3 = $sub_catrow3['sub_category_id'];
      $sub_cat_name3 = $sub_catrow3['sub_category_name'];
      $cat_id4 = $sub_catrow4['category_id'];
      $sub_cat_id4 = $sub_catrow4['sub_category_id'];
      $sub_cat_name4 = $sub_catrow4['sub_category_name'];
      ?>
      <style>
        .cn1 .slick-dots li button:before {
          color:
            <?= $bgcolor[$rancolor[0]] ?>
          ;
        }

        .cn2 .slick-dots li button:before {
          color:
            <?= $bgcolor[$rancolor[1]] ?>
          ;
        }

        .cn3 .slick-dots li button:before {
          color:
            <?= $bgcolor[$rancolor[2]] ?>
          ;
        }

        .cn4 .slick-dots li button:before {
          color:
            <?= $bgcolor[$rancolor[3]] ?>
          ;
        }
      </style>
      <div class="cat-news" style="padding: 0px;margin: 0px;width: 100%;margin-top:10px">
        <div class="container" style="padding: 0px;margin: 0px;width: 100%">
          <div class="row" style="padding: 0px;margin: 0px;width: 100%">
            <div class="col-md-12 "
              style="border-right: 5px solid <?= $bgcolor[$rancolor[0]] ?>;border-left:5px solid <?= $bgcolor[$rancolor[0]] ?>;color:#000;border-radius: 5px;background-color: #fff">
              <h4 style=""><?= $sub_catrow1['sub_category_name'] ?></h4>
              <div class="row cn-slider cn cn1" style="background-color: #fff;">
                <?php
                require_once "../Common/pdo.php";
                $row = $pdo->query("select item_description.item_description_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id1 and sub_category.sub_category_id=$sub_cat_id1 and item.sub_category_id=$sub_cat_id1 LIMIT 10");
                while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="col-lg-3" title="<?= $row1['item_name'] ?>"
                    onclick="location.href='../Product/single.php?id=<?= $row1['item_description_id'] ?>'">
                    <div class="cn-img">
                      <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                          title="<?= $row1['item_name'] ?>" alt=" <?= $row1['item_name'] ?>" class="new_size"
                          src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"
                          style="height: 150px;max-width: 150px;image-rendering: auto;margin-left: auto;margin-right: auto;"></a>
                      <div class="cn-title">
                        <a
                          href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><?= $row1['item_name'] ?></a>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div><br>
            </div>
            <hr class="make_div">
            <hr class="make_div">
            <div class="col-md-12 "
              style="border-right: 5px solid <?= $bgcolor[$rancolor[1]] ?>;border-left:5px solid <?= $bgcolor[$rancolor[1]] ?>;color:#000;border-radius: 5px;background-color: #fff">
              <h4 style=""><?= $sub_catrow2['sub_category_name'] ?></h4>
              <div class="row cn-slider cn cn2" style="background-color: #fff">
                <?php
                $row = $pdo->query("select item_description.item_description_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id2 and sub_category.sub_category_id=$sub_cat_id2 and item.sub_category_id=$sub_cat_id2 LIMIT 10");
                while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="col-lg-3" title="<?= $row1['item_name'] ?>"
                    onclick="location.href='../Product/single.php?id=<?= $row1['item_description_id'] ?>'">
                    <div class="cn-img">
                      <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                          title="<?= $row1['item_name'] ?>" alt=" <?= $row1['item_name'] ?>" class="new_size"
                          src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"
                          style="height: 150px;max-width: 150px;image-rendering: auto;margin-left: auto;margin-right: auto;"></a>
                      <div class="cn-title">
                        <a
                          href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><?= $row1['item_name'] ?></a>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div><br>
            </div>
          </div>
        </div>
      </div>
      <!-- Category News End-->
      <hr class="make_div">
      <hr class="make_div">
      <!-- Category News Start-->
      <div class="cat-news" style="padding: 0px;margin: 0px;width: 100%">
        <div class="container" style="padding: 0px;margin: 0px;width: 100%">
          <div class="row" style="padding: 0px;margin: 0px;width: 100%">
            <div class="col-md-12 "
              style="border-right: 5px solid <?= $bgcolor[$rancolor[2]] ?>;border-left:5px solid <?= $bgcolor[$rancolor[2]] ?>;color:#000;border-radius: 5px;background-color: #fff">
              <h4 style=""><?= $sub_catrow3['sub_category_name'] ?></h4>
              <div class="row cn-slider cn cn3">
                <?php
                $row = $pdo->query("select item_description.item_description_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id3 and sub_category.sub_category_id=$sub_cat_id3 and item.sub_category_id=$sub_cat_id3 LIMIT 10");
                while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="col-lg-3" title="<?= $row1['item_name'] ?>"
                    onclick="location.href='../Product/single.php?id=<?= $row1['item_description_id'] ?>'">
                    <div class="cn-img">
                      <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                          title="<?= $row1['item_name'] ?>" alt=" <?= $row1['item_name'] ?>" class="new_size"
                          src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"
                          style="height: 150px;max-width: 150px;image-rendering: auto;margin-left: auto;margin-right: auto;"></a>
                      <div class="cn-title">
                        <a
                          href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><?= $row1['item_name'] ?></a>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div><br>
            </div>
            <hr class="make_div">
          </div>
          <hr class="make_div">
          <div class="col-md-12 "
            style="border-right: 5px solid <?= $bgcolor[$rancolor[3]] ?>;border-left:5px solid <?= $bgcolor[$rancolor[3]] ?>;color:#000;border-radius: 5px;background-color: #fff">
            <h4 style=""><?= $sub_catrow4['sub_category_name'] ?></h4>
            <div class="row cn-slider cn cn4">
              <?php
              $row = $pdo->query("select item_description.item_description_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where sub_category.category_id=$cat_id4 and sub_category.sub_category_id=$sub_cat_id4 and item.sub_category_id=$sub_cat_id4 LIMIT 10");
              while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-lg-3" title="<?= $row1['item_name'] ?>"
                  onclick="location.href='../Product/single.php?id=<?= $row1['item_description_id'] ?>'">
                  <div class="cn-img">
                    <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                        title="<?= $row1['item_name'] ?>" alt=" <?= $row1['item_name'] ?>" class="new_size"
                        src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"
                        style="height:150px; max-width: 150px;image-rendering: auto;margin-left: auto;margin-right: auto;"></a>
                    <div class="cn-title">
                      <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"
                        style="color:black"><?= $row1['item_name'] ?></a>
                    </div>
                  </div>
                </div>
                <?php
              }
              ?>
            </div><br>
          </div>
        </div>
      </div>
    </div>
    <!-- Category News End-->
    <hr class="make_div">
    <hr class="make_div">
    <!--banner-bottom-->
    <div class="ban-bottom-w3l">
      <div class="container">
        <div class="col-md-6 ban-bottom3">
          <div class="ban-top">
            <img src="../../images/p2.jpg" class="img-responsive" alt=""
              onclick="location.href='../Product/products_limited.php?category_id=6&subcategory_id=30'" />
          </div>
          <div class="ban-img">
            <div class=" ban-bottom1">
              <div class="ban-top">
                <img src="../../images/p1.jpg" class="img-responsive" alt=""
                  onclick="location.href='../Product/products_limited.php?category_id=4&subcategory_id=20'" />
              </div>
            </div>
            <div class="ban-bottom2">
              <div class="ban-top">
                <img src="../../images/p3.jpg" class="img-responsive" alt=""
                  onclick="location.href='../Product/products_limited.php?category_id=6&subcategory_id=28'" />
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="col-md-6 ban-bottom">
          <div class="ban-top">
            <img src="../../images/p4.jpg" class="img-responsive" alt=""
              onclick="location.href='../Product/products_limited.php?category_id=6&subcategory_id=27'" />
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <!--banner-bottom-->
    <?php
    if (isset($_SESSION['id'])) {
      $presql = "select item_description_id from item_keys WHERE rating=0 AND ordered_cnt>0 AND review= '0' and user_id=" . $_SESSION['id'];
      $prest = $pdo->query($presql);
      $precnt = $prest->rowCount();
      if ($precnt > 0) {
        ?>
        <!-- new -->
        <div class="newproducts-w3agile" style="padding:0;padding-top:10px;">
          <h3>Previously Purchased</h3>
          <?php
          /*COLOR PICKER*/
          $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
          $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
          $c1 = $c2 = 'white';
          do {
            $rancolor1 = array_rand($color, 1);
            $rancolor2 = array_rand($color, 1);
          }
          while ($rancolor1 == $rancolor2);
          if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
            $c1 = "black";
          }
          if ($bgcolor[$rancolor2] == "cyan" || $bgcolor[$rancolor2] == "#FF6666" || $bgcolor[$rancolor2] == "#E6BF00") {
            $c2 = "black";
          }
          /*COLOR PICKER*/
          ?>
          <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
            style="border-left: 5px solid <?= $bgcolor[$rancolor1] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
            Rate this <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
            <span style="float: right;margin-right: 5px;margin-top: -4px;">
              <button type="button"
                style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor1] ?>;padding: 11px auto;font-size: 12px;"
                name="proceed" class="checkout-button button alt wc-forward"><a href="../Product/diff_views.php?prev=1"
                  style="color:<?= $c2 ?>;">View all</a></button>
            </span>
          </h4>
          <div class="difcat " style="border-radius: 5px;">
            <span class="difhed">
            </span>
            <div class="difrow hidescroll" id="difrow<?= $prerow['item_description_id'] ?>"
              onscroll="scrolllisten('difrow<?= $prerow['item_description_id'] ?>');">
              <button class="left-arrow-btn-all shadow_all_none"
                onclick="moveleft('difrow<?= $prerow['item_description_id'] ?>')" style="display: none;"><i
                  class="fas fa-chevron-left"></i></button>
              <button class="right-arrow-btn-all shadow_all_none"
                onclick="moveright('difrow<?= $prerow['item_description_id'] ?>')"><i
                  class="fas fa-chevron-right"></i></button>
              <?php
              while ($prerow = $prest->fetch(PDO::FETCH_ASSOC)) {
                $ran = $pdo->query("select * from item_description
        inner join item on item.item_id=item_description.item_id
        inner join category on category.category_id=item.category_id
        inner join sub_category on category.category_id=sub_category.category_id
        where item.sub_category_id=sub_category.sub_category_id and item_description_id=" . $prerow['item_description_id']);
                $row = $ran->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="products-all-in-one" title="<?= $row['item_name'] ?>"
                  onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
                  <div
                    style="display: flex;justify-content: center;height: 200px;width:100%;background: white;text-align: center;">
                    <img class="image" align="middle"
                      src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                  </div>
                  <?php
                  if (strlen($row['item_name']) >= 22) {
                    $item = $row['item_name'];
                    $item_name = substr($item, 0, 25) . "...";
                  } else {
                    $item_name = $row['item_name'];
                  }
                  ?>
                  <div class="deupd"><?= $item_name ?><br>
                  </div>
                </div>
                <?php
              }
              echo '</div></div>';
              ?>
              <div class="clearfix"> </div>
            </div>
            <!-- //new -->
            <?php
      }
    }
    ?>
        <div class="promo-area">
          <div class="zigzag-bottom"></div>
          <div class="container">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1" onclick="location.href='../Main/terms&conditions.php?return=1'">
                  <i class="fa fa-refresh"></i>
                  <p>Return policy</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2" onclick="location.href='../Main/terms&conditions.php?shipping=1'">
                  <i class="fa fa-truck"></i>
                  <p>Free shipping</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3" onclick="location.href='../Main/terms&conditions.php?payment=1'">
                  <i class="fa fa-lock"></i>
                  <p>Secure payments</p>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4" onclick="location.href='../Product/allitems.php'">
                  <i class="fa fa-gift"></i>
                  <p>New products</p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- End promo area -->
        <div class="maincontent-area">
          <div class="zigzag-bottom"></div>
          <div class="container" style="width:100%">
            <div class="row">
              <div class="col-md-12">
                <div class="latest-product">
                  <h2 class="section-title">Latest Products</h2>
                  <div class="product-carousel">
                    <?php
                    $sql = $pdo->query("select item_description.item_description_id,category_id,sub_category_id,item_name,item.price as mrp,product_details.price from item
join item_description on item_description.item_id=item.item_id
join product_details on product_details.item_description_id=item_description.item_description_id
where sub_category_id=16
group by item_description.item_description_id limit 2,17");
                    while ($ph = $sql->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="single-product">
                        <div class="product-f-image">
                          <img style="height:180px;max-width:90px;width:auto"
                            src="../../images/<?= $ph['category_id'] . "/" . $ph['sub_category_id'] . "/" . $ph['item_description_id'] ?>.jpg"
                            alt="<?= $ph['item_name'] ?>">
                          <div class="product-hover">
                            <a href="../Product/single.php?id=<?= $ph['item_description_id'] ?>"
                              class="view-details-link"><i class="fa fa-link"></i> See details</a>
                          </div>
                        </div>
                        <h2><a href="single-product.html"><?= $ph['item_name'] ?></a></h2>
                        <div class="product-carousel-price">
                          <ins><i class="fa fa-inr"></i><?= $ph['price'] ?></ins> <del><i
                              class="fa fa-inr"></i><?= $ph['mrp'] ?></del>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- End main content area -->
        <div class="brands-area">
          <div class="zigzag-bottom"></div>
          <div class="container" style="width:100%">
            <div class="row">
              <div class="col-md-12">
                <div class="brand-wrapper">
                  <div class="brand-list">
                    <img style="height:130px;width:auto" src="../../images/brand/nokia.png" alt="">
                    <img style="height:130px;width:auto" src="../../images/brand/canon.png" alt="">
                    <img style="height:130px;width:auto" src="../../images/brand/samsung.png" alt="">
                    <img style="height:130px;width:auto" src="../../images/brand/apple.png"
                      onclick="location.href='../Product/diff_views.php?brand=Apple'" alt="Apple">
                    <img style="height:130px;width:auto" src="../../images/brand/htc.png" alt="">
                    <img style="height:130px;width:auto" src="../../images/brand/lg.png" alt="">
                    <img style="height:130px;width:auto" src="../../images/brand/vivo.png"
                      onclick="location.href='../Product/diff_views.php?brand=Vivo'" alt="Vivo">
                    <img style="height:140px;width:auto" src="../../images/brand/oppo.png"
                      onclick="location.href='../Product/diff_views.php?brand=Oppo'" alt="Oppo">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- End brands area -->
        <!-- new -->
        <div class="newproducts-w3agile" style="padding-top:10px">
          <div class="container">
            <h3>New offers</h3>
            <div class="agile_top_brands_grids">
              <?php
              $no = $pdo->query("select item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.category_id,item.sub_category_id from item_description
join product_details on product_details.item_description_id=item_description.item_description_id
join item on item.item_id=item_description.item_id where sub_category_id=25 limit 4");
              while ($norow = $no->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-md-3 top_brand_left-1">
                  <div class="hover14 column">
                    <div class="agile_top_brand_left_grid" style="height:270px">
                      <div class="agile_top_brand_left_grid_pos">
                        <img src="../../images/offer.png" alt=" " class="img-responsive">
                      </div>
                      <div class="agile_top_brand_left_grid1">
                        <figure>
                          <div class="snipcart-item block">
                            <div class="snipcart-thumb">
                              <a href="../Product/single.php?id=<?= $norow['item_description_id'] ?>"><img title=" "
                                  style="max-width:70px;max-height:100px" alt=" "
                                  src="../../images/<?= $norow['category_id'] . "/" . $norow['sub_category_id'] . "/" . $norow['item_description_id'] ?>.jpg"></a>
                              <p><?= $norow['item_name'] ?></p>
                              <div class="stars">
                                <?php
                                $starsql = "select round(avg(item_keys.rating),0) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
WHERE item_keys.rating!=0 and item_description.item_description_id=" . $norow['item_description_id'];
                                $startstmt = $pdo->query($starsql);
                                $starrow = $startstmt->fetch(PDO::FETCH_ASSOC);
                                $stars = round($starrow['avgrate']);
                                if ($stars == "" || $stars == 0 || is_null($stars)) {
                                  echo "<span style='color:#ff2222'>no rating</span>";
                                } else {
                                  for ($i = 0; $i < 5; $i++) {
                                    if ($i < $stars) {
                                      echo "<i class='fa fa-star blue-star' aria-hidden='true'></i>";
                                    } else {
                                      echo "<i class='fa fa-star gray-star' aria-hidden='true'></i>";
                                    }
                                  }
                                }
                                ?>
                              </div>
                              <h4><i class="fa fa-inr"></i><?= $norow['price'] ?> <span><i
                                    class="fa fa-inr"></i><?= $norow['mrp'] ?></span></h4>
                            </div>
                          </div>
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              }
              ?>
              <div class="clearfix"> </div>
            </div>
          </div>
        </div>
        <!-- sweet section -->
        <section class="fruit_section layout_padding" style="padding: 0;">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4">
                <div class="container">
                  <div class="heading_container">
                    <h3><i class="fa fa-arrow-right"></i>Sports</h3>
                  </div>
                </div>
                <div class="container-fluid">
                  <div class="fruit_container">
                    <?php
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=39 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=8&subcategory_id=39">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=45 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=8&subcategory_id=45">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=40 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=8&subcategory_id=40">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="container">
                  <div class="heading_container">
                    <h3><i class="fa fa-arrow-right"></i>Trending fasion</h3>
                  </div>
                </div>
                <div class="container-fluid">
                  <div class="fruit_container">
                    <?php
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=23 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <h5>
                            <a href="../Product/products_viewall.php?category_id=4&subcategory_id=23">
                              View
                            </a>
                        </div>
                      </div>
                      <?php
                    }
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=21 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=4&subcategory_id=21">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=18 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=4&subcategory_id=18">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="container">
                  <div class="heading_container">
                    <h3><i class="fa fa-arrow-right"></i>Baby products</h3>
                  </div>
                </div>
                <div class="container-fluid">
                  <div class="fruit_container">
                    <?php
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=35 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=7&subcategory_id=35">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=36 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=7&subcategory_id=36">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    $cat = $pdo->query("select * from item join item_description on item_description.item_id=item.item_id
where item.sub_category_id=32 ORDER BY rand() LIMIT 3");
                    while ($row = $cat->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="box">
                        <img
                          src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                          style="max-width:100%" alt="">
                        <div class="link_box">
                          <a href="../Product/products_viewall.php?category_id=7&subcategory_id=32">
                            View
                          </a>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- end sweet section -->
        <style>
          .diro {
            padding-left: 5px;
            padding-right: 5px;
            padding-bottom: 30px;
          }

          .indi {
            width: 100%;
            background: white;
            margin-top: 20px;
            position: relative;
            padding: 10px;
            background: #fdfdfdfa;
          }

          @media(min-width:992px) {
            .indi {
              height: 400px;
            }

            .divmain {
              height: 500px;
            }
          }

          @media(max-width:991px) {
            .divmain {
              padding-bottom: 30px;
            }
          }

          .in11,
          .in12,
          .in13,
          .in14,
          .in21,
          .in22,
          .in23,
          .in31,
          .in32,
          .in33 {
            justify-content: center;
            display: flex;
            background: white;
          }

          .in1 {
            padding-bottom: 20px;
          }

          .in img {
            width: 100%;
            height: 100%;
          }

          .in2 {
            padding-bottom: 20px;
          }

          .in3 {
            padding-bottom: 20px;
          }

          .indi h3 {
            font-family: 'Font Awesome 5 Free';
            text-align: center;
            height: 60px;
          }

          .fill_box {
            background-color: #000000;
            color: #ffffff;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
          }

          .fill a {
            display: inline-block;
            padding: 7px 35px;
            border: 1px solid #ffffff;
            background-color: #000000;
            color: #ffffff;
            font-size: 15px;
          }

          .fill a:hover {
            background-color: #ffffff;
            color: #000000;
          }

          .fill {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
          }

          .in1:hover .fill,
          .in2:hover .fill,
          .in3:hover .fill {
            bottom: 0;
            opacity: 0.9;
          }

          @media(max-width:767px) {
            .divmain {
              padding-bottom: 0;
            }

            .indi {
              margin-top: 0;
              padding-top: 0;
              ;
            }
          }
        </style>
        <hr class="make_div">
        <div class="row diro">
          <div class="col-sm-4 divmain">
            <div class="indi">
              <h3>Emerging fashions</h3>
              <div class="row">
                <div class="col-xs-6">
                  <div class="in11 in1 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/mw-1.jpeg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=4&subcategory_id=20">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in12 in1 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/hb-1.jpg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=4&subcategory_id=23">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in13 in1 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/f-1.jpg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=4&subcategory_id=18">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in14 in1 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/fw-1.jpeg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=4&subcategory_id=21">
                        View
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 divmain">
            <div class="indi">
              <h3>Make More Beauty</h3>
              <div class="row">
                <div class="col-xs-6">
                  <div class="in21 in2 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/ew-1.jpeg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=4&subcategory_id=22">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in22 in2 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/b-1.jpg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=1&subcategory_id=5">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in23 in2 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/sc-1.jpg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=1&subcategory_id=1">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in24 in2 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/hc-1.jpg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=1&subcategory_id=4">
                        View
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 divmain">
            <div class="indi">
              <h3>Make Your Home More Beautiful</h3>
              <div class="row">
                <div class="col-xs-6">
                  <div class="in31 in3 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/ha-1.jpg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=5&subcategory_id=25">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in32 in3 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/ka-1.jpeg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=5&subcategory_id=24">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in33 in3 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/tc-1.jpeg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=2&subcategory_id=9">
                        View
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="in34 in3 in">
                    <img class="img-responsive fill_box" src="../../images/subcaticon/hca-1.jpg">
                    <div class="fill">
                      <a href="../Product/products_limited.php?category_id=5&subcategory_id=26">
                        View
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="make_div">
        <style>
          .fa-star.active {
            color: orange;
          }
        </style>
        <!-- //new -->
        <div class="product-widget-area" style="padding-top: 0;">
          <div class="zigzag-bottom"></div>
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="single-product-widget">
                  <h2 class="product-wid-title">Top Sellers</h2>
                  <a href="../Product/diff_views.php?topseller=1" class="wid-view-more">View All</a>
                  <?php
                  $ran = $pdo->query("select distinct(item_keys.item_description_id) from item_keys
inner join product_details on product_details.item_description_id=item_keys.item_description_id
GROUP BY item_description_id order by CAST(sum(item_keys.ordered_cnt) as UNSIGNED) DESC LIMIT 3");
                  $isready = $ran->rowCount();
                  if ($isready != 0 && is_null($isready) == false) {
                    $l = 1;
                    while ($view = $ran->fetch(PDO::FETCH_ASSOC)) {
                      $item_desc_id = $view['item_description_id'];
                      $preview = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    INNER JOIN product_details ON product_details.item_description_id=item_description.item_description_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                      $row = $preview->fetch(PDO::FETCH_ASSOC);
                      if (strlen($row['item_name']) > 28) {
                        $item_name = substr($row['item_name'], 0, 28) . "...";
                      } else {
                        $item_name = $row['item_name'];
                      }
                      $ratingstmt = $pdo->query("select round(avg(item_keys.rating)) AS avgrate from item_keys where item_description_id=" . $item_desc_id . " and rating>0 and ordered_cnt>0 and review!='0'");
                      $ratecount = $ratingstmt->rowCount();
                      if ($ratecount != 0 && !is_null($ratecount)) {
                        $ratingrow = $ratingstmt->fetch(PDO::FETCH_ASSOC);
                        $rating = $ratingrow['avgrate'];
                      } else {
                        $rating = 0;
                      }
                      ?>
                      <div class="single-wid-product">
                        <a class="product-thumb" href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
                            style="max-width:100px;width:auto;height:auto"
                            src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                            alt="<?= $item_name ?>"></a>
                        <h2><a href="single-product.html"><?= $item_name ?></a></h2>
                        <?php
                        if ($rating == "" || $rating == 0 || is_null($rating)) {
                          echo "<span style='color:#ff2222'>No rating..!</span>";
                        } else {
                          for ($i = 0; $i < 5; $i++) {
                            if ($i < $rating) {
                              echo "<span class='fas fa-star active'></span>";
                            } else {
                              echo "<span class='fas fa-star'></span>";
                            }
                          }
                        }
                        ?>
                        <div class="product-wid-price">
                          <ins><i class="fa fa-inr"></i> <?= $row['price'] ?></ins>
                        </div>
                      </div>
                      <?php
                      $l++;
                    }
                  }
                  ?>
                </div>
              </div>
              <?php
              if (isset($_SESSION['id'])) {
                ?>
                <div class="col-md-4">
                  <div class="single-product-widget">
                    <h2 class="product-wid-title">Recently Viewed</h2>
                    <a href="../Product/diff_views.php?recent=1" class="wid-view-more">View All</a>
                    <?php
                    $ran = $pdo->query("select views ,item_keys.item_description_id from item_keys
JOIN item_description ON item_keys.item_description_id=item_description.item_description_id
join item on item.item_id=item_description.item_id
where user_id=" . $_SESSION['id'] . " GROUP BY item_description_id ORDER BY CAST(item_keys.date_of_preview as UNSIGNED) DESC limit 3");
                    $isready = $ran->rowCount();
                    if ($isready != 0 && is_null($isready) == false) {
                      $m = 0;
                      while ($view = $ran->fetch(PDO::FETCH_ASSOC)) {
                        $item_desc_id = $view['item_description_id'];
                        $preview = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                        $row = $preview->fetch(PDO::FETCH_ASSOC);
                        if (strlen($row['item_name']) > 28) {
                          $item_name = substr($row['item_name'], 0, 28) . "...";
                        } else {
                          $item_name = $row['item_name'];
                        }
                        $ratingstmt = $pdo->query("select round(avg(item_keys.rating)) AS avgrate from item_keys where item_description_id=" . $item_desc_id . " and rating>0 and ordered_cnt>0 and review!='0'");
                        $ratecount = $ratingstmt->rowCount();
                        if ($ratecount != 0 && !is_null($ratecount)) {
                          $ratingrow = $ratingstmt->fetch(PDO::FETCH_ASSOC);
                          $rating = $ratingrow['avgrate'];
                        } else {
                          $rating = 0;
                        }
                        ?>
                        <div class="single-wid-product">
                          <a class="product-thumb" href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
                              src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                              style="max-width:100px;width:auto;height:auto" alt="<?= $item_name ?>"></a>
                          <h2><a href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><?= $item_name ?></a></h2>
                          <?php
                          if ($rating == "" || $rating == 0 || is_null($rating)) {
                            echo "<span style='color:#ff2222'>No rating..!</span>";
                          } else {
                            for ($i = 0; $i < 5; $i++) {
                              if ($i < $rating) {
                                echo "<span class='fas fa-star active'></span>";
                              } else {
                                echo "<span class='fas fa-star'></span>";
                              }
                            }
                          }
                          ?>
                          <div class="product-wid-price">
                            <ins><i class="fa fa-inr"></i> <?= $row['price'] ?></ins>
                          </div>
                        </div>
                        <?php
                        $m++;
                      }
                    }
              } else {
                ?>
                    <div class="col-md-4">
                      <div class="single-product-widget">
                        <h2 class="product-wid-title">Popular Products</h2>
                        <a href="../Product/diff_views.php?popular=1" class="wid-view-more">View All</a>
                        <?php
                        $ran = $pdo->query("select distinct(item_keys.item_description_id) from item_keys GROUP BY item_description_id order by CAST(sum(item_keys.views) as UNSIGNED) DESC LIMIT 3");
                        $isready = $ran->rowCount();
                        if ($isready != 0 && is_null($isready) == false) {
                          $n = 0;
                          while ($view = $ran->fetch(PDO::FETCH_ASSOC)) {
                            $item_desc_id = $view['item_description_id'];
                            $preview = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                            $row = $preview->fetch(PDO::FETCH_ASSOC);
                            if (strlen($row['item_name']) > 28) {
                              $item_name = substr($row['item_name'], 0, 28) . "...";
                            } else {
                              $item_name = $row['item_name'];
                            }
                            $ratingstmt = $pdo->query("select round(avg(item_keys.rating)) AS avgrate from item_keys where item_description_id=" . $item_desc_id . " and rating>0 and ordered_cnt>0 and review!='0'");
                            $ratecount = $ratingstmt->fetch(PDO::FETCH_ASSOC);
                            $rating = $ratecount['avgrate'];
                            if ($rating != 0 && !is_null($rating)) {
                              $rating = $rating;
                            } else {
                              $rating = 0;
                            }
                            ?>
                            <div class="single-wid-product">
                              <a class="product-thumb" href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
                                  style="max-width:100px;width:auto;height:autoo"
                                  src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                                  alt="<?= $item_name ?>"></a>
                              <h2><a href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><?= $item_name ?></a>
                              </h2>
                              <?php
                              if ($rating == "" || $rating == 0 || is_null($rating)) {
                                echo "<span style='color:#ff2222'>No rating..!</span>";
                              } else {
                                for ($i = 0; $i < 5; $i++) {
                                  if ($i < $rating) {
                                    echo "<span class='fas fa-star active'></span>";
                                  } else {
                                    echo "<span class='fas fa-star'></span>";
                                  }
                                }
                              }
                              ?>
                              <div class="product-wid-price">
                                <ins><i class="fa fa-inr"></i> <?= $row['price'] ?></ins>
                              </div>
                            </div>
                            <?php
                            $n++;
                          }
                        }
              }
              ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="single-product-widget">
                      <h2 class="product-wid-title">Top New</h2>
                      <a href="../Product/allitems.php?topnew=1" class="wid-view-more">View All</a>
                      <?php
                      $ran = $pdo->query("select * from item_description
join item on item.item_id=item_description.item_id WHERE (item.added_date) in (
    select max(added_date) as date
    from item) GROUP BY item_description.item_id ORDER BY CAST(item.item_id AS UNSIGNED) DESC limit 3");
                      $isready = $ran->rowCount();
                      if ($isready != 0 && is_null($isready) == false) {
                        $k = 1;
                        while ($view = $ran->fetch(PDO::FETCH_ASSOC)) {
                          $item_desc_id = $view['item_description_id'];
                          $preview = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                          $row = $preview->fetch(PDO::FETCH_ASSOC);
                          $subcat_id = $view['sub_category_id'];
                          if (strlen($row['item_name']) > 28) {
                            $item_name = substr($row['item_name'], 0, 28) . "...";
                          } else {
                            $item_name = $row['item_name'];
                          }
                          $ratingstmt = $pdo->query("select round(avg(item_keys.rating)) AS avgrate from item_keys where item_description_id=" . $item_desc_id . " and rating>0 and ordered_cnt>0 and review!='0'");
                          $ratecount = $ratingstmt->rowCount();
                          if ($ratecount != 0) {
                            $ratingrow = $ratingstmt->fetch(PDO::FETCH_ASSOC);
                            $rating = $ratingrow['avgrate'];
                          } else {
                            $rating = 0;
                          }
                          ?>
                          <div class="single-wid-product">
                            <a class="product-thumb" href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
                                style="max-width:100px;width:auto;height:auto"
                                src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"
                                alt="<?= $item_name ?>"></a>
                            <h2><a href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><?= $item_name ?></a>
                            </h2>
                            <?php
                            if ($rating == "" || $rating == 0 || is_null($rating)) {
                              echo "<span style='color:#ff2222'>No rating..!</span>";
                            } else {
                              for ($i = 0; $i < 5; $i++) {
                                if ($i < $rating) {
                                  echo "<span class='fas fa-star active'></span>";
                                } else {
                                  echo "<span class='fas fa-star'></span>";
                                }
                              }
                            }
                            ?>
                            <div class="product-wid-price">
                              <ins><i class="fa fa-inr"></i> <?= $row['price'] ?></ins>
                            </div>
                          </div>
                          <?php
                          $k++;
                        }
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- End product widget area -->
          </div>
          <?php
          require "footer.php";
          ?>
          </body>

          </html>