<?php
require '../Main/header.php';
require "../Main/map.php";
require "../Common/pdo.php";
$item_description_id = $_GET['id'];
if (isset($_GET['id'], $_SESSION['id'])) {
  $check = $pdo->query('select item_description_id from item_keys where item_description_id=' . $_GET['id'] . ' and user_id=' . $_SESSION['id']);
  if ($check->rowCount() > 0) {
    $viewedsql = $pdo->prepare("update item_keys set views=views+1,date_of_preview=:dop where item_description_id=" . $_GET['id']);
    $date = date("Y\-m\-d");
    $viewedsql->execute(array(
      ':dop' => $date
    ));
  } else {
    $viewedsql = $pdo->prepare("insert into item_keys (views,user_id,item_description_id,date_of_preview) values (1,:uid,:idid,:dop)");
    $date = date("Y\-m\-d");
    $viewedsql->execute(array(
      ':uid' => $_SESSION['id'],
      ':idid' => $_GET['id'],
      ':dop' => $date
    ));
  }
}
$ratingstmt = $pdo->query("select avg(item_keys.rating) AS avgrate from item_keys where item_description_id=" . $_GET['id'] . " and rating>0 and ordered_cnt>0 and review!='0'");
$ratecount = $ratingstmt->rowCount();
if ($ratecount != 0) {
  $ratingrow = $ratingstmt->fetch(PDO::FETCH_ASSOC);
  $rating = $ratingrow['avgrate'];
} else {
  $rating = 0;
}
$n = 0;
//CHANGE 1////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
$sql="select * from item
inner join item_description on item_description.item_id=item.item_id
inner join category on category.category_id=item.category_id
inner join sub_category on category.category_id=sub_category.category_id
inner join product_details on item_description.item_description_id=product_details.item_description_id
where item.sub_category_id=sub_category.sub_category_id and item_description.item_description_id=$item_description_id ";
*/
$sql = "select * from item
inner join item_description on item_description.item_id=item.item_id
inner join category on category.category_id=item.category_id
inner join sub_category on category.category_id=sub_category.category_id
where item.sub_category_id=sub_category.sub_category_id and item_description.item_description_id=$item_description_id ";
$stmt = $pdo->query($sql);
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$cat_id = $row2['category_id'];
$subcat = $row2['sub_category_name'];
$subcat_id = $row2['sub_category_id'];
$sql1 = "select price from item inner join item_description on item_description.item_id=item.item_id where item_description_id=:item_description_id ";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute(array(
  ':item_description_id' => $item_description_id
));
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
$mrp = $row1['price'];
//Generate Dynamic Loading
function randomGen($min, $max, $quantity)
{
  $numbers = range($min, $max);
  shuffle($numbers);
  return array_slice($numbers, 0, $quantity);
}
//Generate Dynamic Loading
?>
<style type="text/css">
  /*//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
  /*SINGLE PAGE STYLING*/
  .product-image-thumb {
    margin: auto;
    display: block;
    max-height: 100px;
    width: 100px;
    margin-bottom: 5px;
    margin-bottom: 5px;
  }

  .product-image {
    margin: auto;
    display: block;
    max-height: 50px;
    width: auto;
  }

  #myimage {
    float: left;
    margin: auto;
    display: block;
    max-height: 450px;
    width: auto;
  }

  #example {
    float: left;
    margin: auto;
    display: block;
    max-height: 450px;
    width: auto;
  }

  .img-example-left {
    float: left;
    list-style: none;
    margin-left: -15px;
  }

  @media (max-width: 767px) {
    .d-inline-block {
      display: inline-block !important;
    }
  }

  @media (min-width: 768px) {
    .d-inline-block {
      display: none !important;
    }
  }

  /* Style the tab */
  .tab_single {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab_single */
  .tab_single button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab_single button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tab_singlelink class */
  .tab_single .active {
    background-color: #ccc;
  }

  /* Style the tab_single content */
  .tabcontentsingle {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }

  /*****************************************************************************************************************************/
  /*****************************************************************************************************************************/
  /*SINGLE.PHP*/
  .img-zoom-container {
    position: relative;
  }

  .img-zoom-lens {
    position: absolute;
    border: 1px solid #d4d4d4;
    /*set the size of the lens:*/
    max-width: 100%;
    min-width: 25%;
    height: 45px;
  }

  .img-zoom-result {
    border: 1px solid #d4d4d4;
    /*set the size of the result div:*/
    width: 50%;
    /*height:518px;*/
    float: left;
  }

  .img-zoom-result {
    right: 10px;
  }

  @media (max-width: 991px) {
    .img-zoom-result {
      right: 10px;
    }
  }

  @media (max-width: 767px) {
    #myresult {
      display: none !important;
    }

    #img-zoom-conatiner-none {
      display: unset !important;
    }

    #img-zoom-conatiner {
      display: none !important;
    }

    #myimage {
      display: none !important;
    }

    .img-zoom-lens {
      display: none !important;
    }
  }

  #view-single-img:hover {
    transition: 0.3s;
    opacity: .6;
  }

  /* The Modal (background) */
  .modal-single {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: #fff;
    z-index: 99999;
  }

  .column-single {
    float: left;
    width: auto;
    background-color: #fff;
  }

  .column-single img {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
  }

  /* Modal Content */
  .modal-content-single {
    position: relative;
    background-color: #FFF;
    margin: auto;
    padding: 0;
    width: 90%;
    max-width: 1200px;
  }

  .holder {
    position: relative;
    max-height: 80%;
  }

  /* The Close Button */
  .close-single {
    color: #ca0700;
    position: absolute;
    top: 10px;
    right: 25px;
    font-size: 35px;
    font-weight: bold;
  }

  .close-single:hover,
  .close-single:focus {
    color: #ac0600;
    text-decoration: none;
    cursor: pointer;
  }

  .mySlides-single {
    display: none;
    background-color: transparent;
    max-height: 100%;
    max-width: 100%;
  }

  .mySlides-single img {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: auto;
    margin-right: auto;
    width: auto;
    height: 400px;
    max-width: 100%;
  }

  .cursor-single {
    cursor: pointer;
  }

  /* Next & previous buttons */
  .prev-single,
  .next-single {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    background-color: black;
    font-weight: bold;
    font-size: 20px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
  }

  /* Position the "next button" to the right */
  .next-single {
    right: 0;
    border-radius: 3px 0 0 3px;
  }

  /* On hover, add a black background color with a little bit see-through */
  .prev-single:hover,
  .next-single:hover {
    background-color: #0c99cc;
    color: white;
  }

  /* Number text (1/3 etc) */
  .numbertext-single {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    bottom: -50px;
    right: 0;
    background-color: black;
  }

  img-single {
    margin-bottom: -4px;
  }

  .caption-container-single {
    text-align: center;
    background-color: transparent;
    padding: 2px 16px;
    color: white;
  }

  #caption-single {
    color: white;
    padding-bottom: 0px;
    margin-bottom: 0px;
  }

  .demo-single {
    opacity: 0.6;
    background-color: #fff;
    border: 2px solid #666;
  }

  .active-single,
  .demo-single:hover {
    opacity: 1;
  }

  img.hover-shadow-single {
    transition: 0.3s;
  }

  .hover-shadow-single:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  @media (max-width: 991px) {
    .mySlides-single img {
      max-height: 300px;
    }
  }

  #myresult {
    -moz-box-shadow: 5px 5px 5px rgba(68, 68, 68, 0.6), -5px -5px 5px rgba(68, 68, 68, 0.6);
    -webkit-box-shadow: 5px 5px 5px rgba(68, 68, 68, 0.6), -5px -5px 5px rgba(68, 68, 68, 0.6);
    box-shadow: 5px 5px 5px rgba(68, 68, 68, 0.6), -5px -5px 5px rgba(68, 68, 68, 0.6);
    filter: progid: DXImageTransform.Microsoft.Blur(PixelRadius=3, MakeShadow=true, ShadowOpacity=0.30);
    -ms-filter: "progid:DXImageTransform.Microsoft.Blur(PixelRadius=3,MakeShadow=true,ShadowOpacity=0.30)";
    zoom: 1;
  }

  @media (min-width: 768px) {
    .large-btn {
      display: none !important;
    }

    .fixed-pos-left {
      position: fixed;
      left: 10px !important;
      z-index: 1;
      width: 50%;
      /*transition:0.8s;*/
    }

    #myresult {
      position: fixed !important;
      right: 10px !important;
      width: 50%;
      overflow-y: scroll;
      display: flex;
      justify-content: flex-end;
      align-items: flex-end;
      max-height: 100%;
      min-height: 50%;
      border-radius: 5px;
      transition: 0.2s;
    }

    #partially_needed {
      min-height: 550px !important;
    }

    .big-btn {
      width: 96%;
    }
  }

  @media (max-width: 767px) {
    .fixed-pos-left-container {
      min-height: 450px !important;
    }

    .mySlides-single img {
      height: 100%;
    }

    .holder {
      height: 80%;
      position: relative;
    }

    .prev-single {
      top: 150px;
      left: 0px;
      position: fixed;
      margin-top: auto;
      margin-bottom: auto;
    }

    .next-single {
      top: 150px;
      right: 0px;
      position: fixed;
      margin-top: auto;
      margin-bottom: auto;
    }

    .big-btn {
      display: none !important;
    }
  }

  .btn-buy {
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #b6010a), color-stop(1, #f82b10)) !important;
    color: white;
  }

  .btn-buy:hover {
    background-color: #ff0000 !important;
    color: white !important;
  }

  .btn-cart {
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #337ab7), color-stop(1, #0045da)) !important;
    color: white;
  }

  .btn-cart:hover {
    background-color: #337ab7 !important;
    color: white !important;
  }

  @media(min-width:568px) {
    .small-btn {
      display: none !important;
    }
  }

  @media (max-width: 567px) {
    #btn-pc {
      display: none !important;
    }

    #btn-mob {
      position: fixed;
      bottom: 0px;
      left: 0px;
      width: 100% !important;
      z-index: 1 !important;
      color: white;
      outline: none;
      border: 0px;
      grid-gap: 0px;
    }

    .back-to-top {
      right: 0 !important;
      bottom: 50px !important;
    }
  }

  .pricetag {
    display: inline-block;
    width: auto;
    height: 38px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ff4800), color-stop(1, #f17500)) !important;
    -webkit-border-radius: 3px 4px 4px 3px;
    -moz-border-radius: 3px 4px 4px 3px;
    border-radius: 3px 4px 4px 3px;
    border-left: 1px solid #ff0000;
    /* This makes room for the triangle */
    margin-left: 19px;
    position: relative;
    color: white;
    font-weight: 400;
    font-family: 'Source Sans Pro', sans-serif;
    font-size: 22px;
    line-height: 38px;
    padding: 0 10px 0 10px;
  }

  /* Makes the triangle */
  .pricetag:before {
    content: "";
    position: absolute;
    display: block;
    left: -19px;
    width: 0;
    height: 0;
    border-top: 19px solid transparent;
    border-bottom: 19px solid transparent;
    border-right: 19px solid #000000;
  }

  /* Makes the circle */
  .pricetag:after {
    content: "";
    background-color: white;
    border-radius: 50%;
    width: 4px;
    height: 4px;
    display: block;
    position: absolute;
    left: -9px;
    top: 17px;
  }

  /*****************************************************************************************************************************/
  /*****************************************************************************************************************************/
  /*SINGLE PAGE STYLING*/
  /*//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
  .hidescroll::-webkit-scrollbar {
    display: none !important;
  }

  /* Hide scrollbar for IE, Edge and Firefox */
  .hidescroll {
    -ms-overflow-style: none !important;
    /* IE and Edge */
    scrollbar-width: none !important;
    /* Firefox */
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

  @media(max-height:610px) {
    .product_contain_div {
      height: 350px !important;
    }
  }

  @media(max-height:524px) and (min-width:767px) {
    .product_contain_div {
      height: 270px !important;
    }

    #myimage {
      height: 250px !important;
    }
  }

  @media(max-height:524px) and (min-width:767px) {
    .product_contain_div {
      height: 200px !important;
    }

    #myimage {
      height: 200px !important;
    }

    .fixed-pos-left-container {
      min-height: 400px !important;
    }
  }

  .item_share {
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ededed), color-stop(1, #ffffff)) !important;
    margin-top: 15px !important;
    border-color: #cdcdcd !important;
  }

  .item_wish {
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #efefef), color-stop(1, #ffffff)) !important;
  }

  /*
@media(max-width:991px) and (min-width:769px){
 .product_contain_div{
   height:300px !important;
 }
}
*/
  @media(min-width:768px) {
    .left-small-img {
      display: flex !important;
    }

    .bottom-small-img {
      display: none !important;
    }
  }

  @media(max-width:767px) {
    .left-small-img {
      display: none !important;
    }

    .bottom-small-img {
      display: unset !important;
    }

    .img-big {
      width: 100% !important;
    }

    .img-zoom-container-none {
      width: 100% !important;
    }
  }
</style>
<script type="text/javascript">
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
  var url = window.location.href;
  if (sessionStorage.getItem("prev_url") == url) {
    var scrollTop = 'singlescrollTop';
  }
  else {
    var scrollTop = 'scroll_begin';
  }
  $(window).unload(function () { document.cookie = 'singlescrollTop=' + $(window).scrollTop(); });
  sessionStorage.setItem("prev_url", url);
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SCROLLING AND RESIZING EFFECTS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $(window).scroll(function () {
    if ($(this).scrollTop() > 60) {
      if ($(window).width() > 825) {
        $('.fixed-pos-left').css('top', '80px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '90px');
        $('#myresult').css('height', screen.height - 200);
      }
      else if ($(window).width() <= 825 && $(window).width() > 767) {
        $('.fixed-pos-left').css('top', '80px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '120px');
        $('#myresult').css('height', screen.height - 355);
      }
    }
    else {
      if ($(window).width() > 825) {
        $('.fixed-pos-left').css('top', '200px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '200px');
        $('#myresult').css('height', screen.height - 310);
      }
      else if ($(window).width() <= 825 && $(window).width() > 767) {
        $('.fixed-pos-left').css('top', '230px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '230px');
        $('#myresult').css('height', screen.height - 345);
      }
    }
  });
  var big_screen = 0;
  $(window).resize(function () {
    if ($(this).scrollTop() > 60) {
      if ($(window).width() > 825) {
        $('.fixed-pos-left').css('top', '80px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '90px');
        $('#myresult').css('height', screen.height - 200);
      }
      else if ($(window).width() <= 825 && $(window).width() > 767) {
        $('.fixed-pos-left').css('top', '80px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '120px');
        $('#myresult').css('height', screen.height - 355);
      }
    }
    else {
      if ($(window).width() > 825) {
        big_screen = 1;
        $('.fixed-pos-left').css('top', '200px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '200px');
        $('#myresult').css('height', screen.height - 310);
      }
      else if ($(window).width() <= 825 && $(window).width() > 767) {
        big_screen = 1;
        $('.fixed-pos-left').css('top', '230px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '230px');
        $('#myresult').css('height', screen.height - 345);
      }
    }
    if ($(window).width() <= 767) {
      $('.fixed-pos-left').css('position', 'inherit');
      $('.fixed-pos-left').css('width', '100%');
      $('.fixed-pos-left-container').css('height', '0');
      $('#myresult').css('position', 'inherit');
      $('#myresult').css('width', '50%');
    }
  });
  window.onscroll = function (ev) {
    if ($(window).width() < 568) {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
        $('.small-btn').hide();
      }
      else {
        $('.small-btn').show();
      }
    }
    else {
      $('.small-btn').show();
    }
    if ($(window).width() > 767) {
      var big_screen = 1;
      if ($(window).scrollTop() >= $('#partially_needed').offset().top + $('#partially_needed').outerHeight() - window.innerHeight + 0) {
        $('.fixed-pos-left-container').css('position', 'relative');
        $('.fixed-pos-left-container').css('width', '100%');
        $('.fixed-pos-left-container').css('height', $('#partially_needed').offset().top + $('#partially_needed').outerHeight() - 250);
        $('.fixed-pos-left').css('position', 'absolute');
        $('.fixed-pos-left').css('width', '100%');
        $('.fixed-pos-left').css('top', $('#partially_needed').offset().top + $('#partially_needed').outerHeight() - $('.fixed-pos-left').outerHeight() - 170);
        if ($(window).scrollTop() <= 60) {
          $('.fixed-pos-left').css('top', 0);
        }
      }
      else if ($(window).scrollTop() <= 60) {
        $('.fixed-pos-left').css('position', 'absolute');
        $('.fixed-pos-left').css('width', '100%');
        $('.fixed-pos-left').css('top', '-20px');
        $('#myresult').css('position', 'inherit');
        $('#myresult').css('width', '50%');
      }
      else if ($(window).scrollTop() > 60) {
        $('.fixed-pos-left').css('position', 'fixed');
        $('.fixed-pos-left').css('width', '50%');
        $('#myresult').css('position', 'fixed');
        $('#myresult').css('width', '50%');
        $('#myresult').css('right', '10px');
      }
    }
  };
  $(window).resize(function () {
    if ($(window).width() < 768) {
      if (big_screen == 1) {
        location.reload();
      }
      $('.small-btn').css('display', 'grid');
    }
    if ($(window).width() < 568) {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
        $('.small-btn').hide();
      }
      else {
        $('.small-btn').show();
      }
    }
    else {
      $('.small-btn').show();
    }
    if ($(window).width() > 767) {
      if ($(window).scrollTop() >= $('#partially_needed').offset().top + $('#partially_needed').outerHeight() - window.innerHeight + 0) {
        $('.fixed-pos-left-container').css('position', 'relative');
        $('.fixed-pos-left-container').css('width', '100%');
        $('.fixed-pos-left-container').css('height', $('#partially_needed').offset().top + $('#partially_needed').outerHeight() - 250);
        $('.fixed-pos-left').css('position', 'absolute');
        $('.fixed-pos-left').css('width', '100%');
        $('.fixed-pos-left').css('top', $('#partially_needed').offset().top + $('#partially_needed').outerHeight() - $('.fixed-pos-left').outerHeight() - 250);
      }
      else if ($(window).scrollTop() <= 60) {
        $('.fixed-pos-left').css('position', 'absolute');
        $('.fixed-pos-left').css('width', '100%');
        $('.fixed-pos-left').css('top', '-20px');
        $('#myresult').css('position', 'inherit');
        $('#myresult').css('width', '50%');
      }
      else if ($(window).scrollTop() > 60) {
        $('.fixed-pos-left').css('position', 'fixed');
        $('.fixed-pos-left').css('width', '50%');
        $('#myresult').css('position', 'fixed');
        $('#myresult').css('width', '50%');
        $('#myresult').css('right', '10px');
      }
    }
  });
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //SCROLLING AND RESIZING EFFECTS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //showing onlt mrp at loading
  $(document).ready(function (f) {
    $("#per").hide();
    $("#per2").hide();
    $("#per3").hide();
    if ($(this).scrollTop() > 60) {
      if ($(window).width() > 825) {
        $('.fixed-pos-left').css('top', '120px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '90px');
        $('#myresult').css('height', screen.height - 200);
      }
      else if ($(window).width() <= 825 && $(window).width() > 767) {
        $('.fixed-pos-left').css('top', '120px');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '120px');
        $('#myresult').css('height', screen.height - 355);
      }
    }
    else {
      if ($(window).width() > 825) {
        $('.fixed-pos-left').css('top', 'auto');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '200px');
        $('#myresult').css('height', screen.height - 310);
      }
      else if ($(window).width() <= 825 && $(window).width() > 767) {
        $('.fixed-pos-left').css('top', 'auto');
        $('.fixed-pos-left-container').css('height', '0');
        $('#myresult').css('top', '230px');
        $('#myresult').css('height', screen.height - 345);
      }
    }
    if ($(window).width() <= 767) {
      $('.fixed-pos-left').css('position', 'inherit');
      $('.fixed-pos-left').css('width', '100%');
      $('.fixed-pos-left-container').css('height', '0');
      $('#myresult').css('position', 'inherit');
      $('#myresult').css('width', '50%');
    }
  });
  //showing onlt mrp at loading
  function check_store_select() {
    var tbl = document.getElementById("store");
    var chks = tbl.getElementsByTagName("INPUT");
    var id = 0;
    var flag = 0;
    for (var i = 0; i < chks.length; i++) {
      if (chks[i].checked == true) {
        id = chks[i].value;
        flag = 1;
      }
    }
    if (flag == 0) {
      swal({
        title: "Sorry!!!",
        text: "Select a store",
        icon: "warning",
        closeOnClickOutside: false,
        dangerMode: true,
      })
        .then((willSubmit1) => {
          if (willSubmit1) {
            return;
          }
          else {
            return;
          }
        });
    }
    else {
      var item_description_id = <?= $item_description_id ?>;
      $.ajax({
        url: "../Common/functions.php", //passing page info
        data: { "cart": 1, "item_description_id": item_description_id, "store_id": id },  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout: 30000,   //waiting time 30 sec
        success: function (data) {    //if registration is success
          if (data.status == 'success') {
            swal({
              title: "Added!!!",
              text: "Check your cart",
              icon: "success",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit1) => {
                if (willSubmit1) {
                  document.getElementById("sm-cartcnt").innerHTML = "";
                  document.getElementById("lg-cartcnt").innerHTML = "";
                  document.getElementById("sm-cartcnt").innerHTML = data.cartcnt;
                  document.getElementById("lg-cartcnt").innerHTML = data.cartcnt;
                  return;
                }
                else {
                  return;
                }
              });/*
                      var qnty=document.getElementById("Q"+id+"").innerHTML;
                      if(qnty!=0){
                        document.getElementById("Q"+id+"").innerHTML="";
                        document.getElementById("Q"+id+"").innerHTML=qnty-1;
                      }*/
            var qnty = document.getElementById("dis_qnty").innerHTML;
            if (qnty != 0) {
              document.getElementById("dis_qnty").innerHTML = "";
              document.getElementById("dis_qnty").innerHTML = qnty - 1;
            }
          }
          else if (data.status == 'error') {
            swal({
              title: "Required!!!",
              text: "You need to create an Account",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit) => {
                if (willSubmit) {
                  location.href = "../Account/registered.php";
                  return;
                }
                else {
                  return;
                }
              });
          }
          else if (data.status == 'error1') {
            swal({
              title: "Not Available!!!",
              text: "Choose another Store",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
            })
              .then((willSubmit) => {
                if (willSubmit) {
                  location.href = "../Product/single.php?id=" + item_description_id + "";
                  return;
                }
                else {
                  return;
                }
              });
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
      //location.href="../Cart/cart.php?store="+id+"&item=<?//=$row['item_id'] ?>";
    }
  }
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("store");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 2; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (dir == "asc") {
          if (Number(x.innerHTML) > Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (Number(x.innerHTML) < Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
  function sortTable(n) {
    var table, rows, switching, i, x, y, a, b, c, d, shouldSwitch, dir, switchcount = 0;
    if ($('#avail_stores').css('display') != 'none') {
      table = document.getElementById("store");
    }
    else if ($('#avail_stores_wishlist').css('display') != 'none') {
      table = document.getElementById("store_wishlist");
    }
    else if ($('#avail_stores_buy').css('display') != 'none') {
      table = document.getElementById("store_buynow");
    }
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 2; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (n == 2) {
          a = x.innerHTML.substring(1);
          b = y.innerHTML.substring(1);
          if (dir == "asc") {
            if (Number(a) > Number(b)) {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          } else if (dir == "desc") {
            if (Number(a) < Number(b)) {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          }
        }
        else if (n == 3) {
          if (dir == "asc") {
            if (Number(x.innerHTML) > Number(y.innerHTML)) {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          } else if (dir == "desc") {
            if (Number(x.innerHTML) < Number(y.innerHTML)) {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          }
        }
      }//END FOR LOOP
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
  $(document).ready(function () {
    var starTotal = 5;
    <?php
    if ($rating != 0) {
      ?>
      var ratings = <?= $rating ?>;
      var starPercentage = ratings / starTotal * 100;
      var star = starPercentage + '%';
      $(".stars-inner").width(star);
      <?php
    } else {
      ?>
      $(".stars-outer").empty();
      $(".stars-outer").html('<p style="color:red">No rating..!</p>');
      <?php
    }
    ?>
  });
  var lastScrollTop = 0;
  $(window).scroll(function (event) {
    var st = $(this).scrollTop();
    if (st > lastScrollTop) {
      // downscroll code
    } else {
      // upscroll code
    }
    lastScrollTop = st;
  });
</script>
<div id="myresult" class="col-12 col-sm-6 img-zoom-result hidescroll"
  style="display: none;z-index: 99;background-repeat: no-repeat;max-width: 100%px;background-color:white;"></div>
<div class="div-wrapper small-btn btn-cart" id="btn-mob" style="width:100%;">
  <div id="atc-mob" type="button" name="submit" class="btn btn-primary btn-lg button btn-cart btn-flat"
    data-toggle="modal" data-target="#avail_stores"
    style="width: 100%;justify-content: flex-start;border-radius: 0px;border-color: #fff;">
    <i class="fas fa-cart-plus mr-2"></i>
    Add to Cart
  </div>
  <div class="btn btn-default btn-lg btn-flat btn-buy button" id="btn-buy-mob" type="button" name="submit"
    data-toggle="modal" data-target="#avail_stores_buy"
    style="width: 100%;position: relative;float: left;justify-content: flex-start;border-radius: 0px;">
    <div class="btn btn-default btn-lg btn-flat" type="button" name="submit"
      style="font-size: 16px;width: 25px;height:25px;position: relative;justify-content: center;border-radius: 50%;padding:4px;background-color: #fff;">
      <i style="color: #c50505;display: flex;align-items: center;justify-content: center;margin-left: 50%;"
        class="fas fa-flash mr-2"></i>
    </div>
    Buy Now
  </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="overflow-x: hidden;width: 100%">
  <section class="content">
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body" style="margin-top: 0px;">
        <div class="row">
          <div class="col-12 col-sm-6 fixed-pos">
            <h3 class="d-inline-block d-sm-none"><?= $row2['item_name'] ?></h3>
            <!---------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------------------------------------------------------->
            <!---------------------------------------------------------------------------------------------------------------->
            <div class="fixed-pos-left-container" style="background-color:white">
              <div class="fixed-pos-left" style="background-color:white">
                <div class="abolute_div" style="margin:0;">
                  <div class="relative_div" style="margin:0;">
                    <div class="row zoom-in-adjust" style="margin:0;width:100%;">
                      <div class="col-md-12 div-wrapper product_contain_div"
                        style="margin-top: 20px;padding-right:0px;height:430px;">
                        <?php
                        $img_cnt_sql = "select img_count from item_description where item_description_id=$item_description_id";
                        $img_cnt_stmt = $pdo->prepare($sql);
                        $img_cnt_stmt->execute();
                        $img_cnt_row = $img_cnt_stmt->fetch(PDO::FETCH_ASSOC);
                        if (!empty($img_cnt_row['img_count'])) {
                          if ($img_cnt_row['img_count'] > 3) {
                            ?>
                            <div class=" col-md-1 col-sm-1 hidescroll left-small-img"
                              style="justify-content: right;overflow-y:scroll;width:100%">
                              <?php
                          } else {
                            ?>
                              <div class=" col-md-1 col-sm-1 left-small-img" style="justify-content: right;">
                                <?php
                          }
                        } else {
                          ?>
                              <div class=" col-md-1 col-sm-1 left-small-img" style="justify-content: right;">
                                <?php
                        }
                        ?>
                              <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                              <div style="margin:0;padding:0;width:100%">
                                <ul class="img-example-left">
                                  <li>
                                    <div class="product-image-thumb active"><img
                                        src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>.jpg"
                                        alt=" " class="product-image img-responsive" alt="Product Image"></div>
                                  </li>
                                  <?php
                                  if (!empty($img_cnt_row['img_count'])) {
                                    $img_cnt_flag = 1;
                                    while ($img_cnt_flag <= $img_cnt_row['img_count']) {
                                      ?>
                                      <li>
                                        <div class="product-image-thumb"><img
                                            src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>_<?= $img_cnt_flag ?>.jpg"
                                            alt=" " class="product-image img-responsive" alt="Product Image"></div>
                                      </li>
                                      <?php
                                      $img_cnt_flag++;
                                    }
                                  }
                                  ?>
                                </ul>
                              </div>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10 img-big"
                              style="position: relative;justify-content:center;align-items:center;display:flex;padding-left:0;">
                              <div id="img-zoom-container" class="img-zoom-container"
                                onmouseover="$('.img-zoom-result').css('display','unset');imageZoom('myimage', 'myresult');$('.img-zoom-lens').css('display','unset');$('.zoom-in-adjust').css('height','max-content');"
                                onmouseleave="$('.img-zoom-result').css('display','none');$('.img-zoom-lens').hide();$('.zoom-in-adjust').css('height','max-content');">
                                <img id="myimage"
                                  src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>.jpg"
                                  alt=" " class="product-image product-image-view img-responsive myimage">
                              </div>
                              <div id="img-zoom-conatiner-none" class="img-zoom-conatiner-none" style="display: none;">
                                <img id="example"
                                  src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>.jpg"
                                  alt=" " class="product-image product-image-view img-responsive">
                              </div>
                              <!--<div id="view-single-img" style="display: flex;position: absolute;bottom: 20px;right: 25px;border:1px solid #999;padding:10px;padding-top: 13px;background-color: rgba(0,0,0,0.75);" onclick="openModal_single();currentSlide(1)"><i style="color: #fff" class="fa fa-search-plus fa-lg"></i></div>-->
                            </div>
                            <div class=" col-md-1 col-sm-1" style="justify-content: right;padding:0px;">
                              <div class="btn btn-default btn-lg btn-flat item_wish" type="button" name="submit"
                                class="btn btn-primary btn-lg button" data-toggle="modal"
                                data-target="#avail_stores_wishlist"
                                style="width: 40px;position: relative;justify-content: center;border-radius: 50%;clear:right">
                                <i style="color: #c50505;display: flex;align-items: center;justify-content: center;margin-left: 3px;"
                                  class="fas fa-heart fa-lg mr-2"></i>
                              </div>
                              <div onclick="copylink(<?= $_GET['id'] ?>,'single.php?id=<?= $_GET['id'] ?>')"
                                class="btn btn-default btn-lg btn-flat item_share" type="button" name="submit"
                                class="btn btn-primary btn-lg button" data-toggle="modal"
                                data-target="#myModal_share_item"
                                style="width: 40px;position: relative;justify-content: center;border-radius: 50%;align-items: left;justify-content: left;display: flex;">
                                <i style="color: #999898;display: flex;align-items: left;justify-content: left;margin-left: -8px;border-color: #e2e2e2;"
                                  class="fas fa-share fa-lg mr-2"></i>
                              </div>
                              <div id="view-single-img"
                                style="display: flex;position: absolute;bottom: 20px;float:left;border:1px solid #999;padding:10px;padding-top: 13px;background-color: rgba(0,0,0,0.75);"
                                onclick="openModal_single();currentSlide(1)"><i style="color: #fff"
                                  class="fa fa-search-plus fa-lg"></i></div>
                            </div>
                          </div>
                        </div>
                        <div style="margin-top:20px;"></div>
                        <div class="div-wrapper big-btn" style="width: 100%;display: flex;">
                          <div class="btn btn-primary btn-lg btn-flat btn-cart button" id="atc" type="button"
                            name="submit" data-toggle="modal" data-target="#avail_stores"
                            style="width: 100%;justify-content: flex-start;border-radius: 4px;">
                            <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                          </div>
                          <div class="btn btn-default btn-lg btn-flat btn-buy button" type="button" name="submit"
                            data-toggle="modal" data-target="#avail_stores_buy"
                            style="width: 100%;position: relative;float: left;justify-content: flex-start;border-radius: 4px;">
                            <div class="btn btn-default btn-lg btn-flat" type="button" name="submit"
                              style="font-size: 16px;width: 25px;height:25px;position: relative;justify-content: center;border-radius: 50%;padding:4px;background-color: #fff;">
                              <i style="color: #c50505;display: flex;align-items: center;justify-content: center;margin-left: 50%;"
                                class="fas fa-flash mr-2"></i>
                            </div>
                            Buy Now
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!--fixed-pos-left end-->
              </div><!--fixed-pos-left-container end-->
              <!---------------------------------------------------------------------------------------------------------------->
              <!---------------------------------------------------------------------------------------------------------------->
              <!---------------------------------------------------------------------------------------------------------------->
              <div class="container bottom-small-img" style="margin:0;">
                <div class="row" style="margin:0;margin-right:5px;margin-left:5px">
                  <?php
                  $img_cnt_sql = "select img_count from item_description where item_description_id=$item_description_id";
                  $img_cnt_stmt = $pdo->prepare($sql);
                  $img_cnt_stmt->execute();
                  $img_cnt_row = $img_cnt_stmt->fetch(PDO::FETCH_ASSOC);
                  if (!empty($img_cnt_row['img_count'])) {
                    if ($img_cnt_row['img_count'] > 3) {
                      ?>
                      <div class=" col-md-12 col-sm-12 hidescroll "
                        style="justify-content: right;overflow-x:scroll;width:100%;">
                        <?php
                    } else {
                      ?>
                        <div class=" col-md-12 col-sm-12" style="justify-content: right;">
                          <?php
                    }
                  } else {
                    ?>
                        <div class=" col-md-12 col-sm-12" style="justify-content: right;">
                          <?php
                  }
                  ?>
                        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                        <ul class="img-example-left" style="display: flex;">
                          <li style="margin-right: 5px;">
                            <div class="product-image-thumb active"><img
                                src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>.jpg"
                                alt=" " class="product-image img-responsive" alt="Product Image"></div>
                          </li>
                          <?php
                          if (!empty($img_cnt_row['img_count'])) {
                            $img_cnt_flag = 1;
                            while ($img_cnt_flag <= $img_cnt_row['img_count']) {
                              ?>
                              <li style="margin-right: 5px;">
                                <div class="product-image-thumb"><img
                                    src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>_<?= $img_cnt_flag ?>.jpg"
                                    alt=" " class="product-image img-responsive" alt="Product Image"></div>
                              </li>
                              <?php
                              $img_cnt_flag++;
                            }
                          }
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6" id="partially_needed" style="padding-left:15px">
                    <div style="margin-left:25px">
                      <h3 class="my-3"><?= $row2['item_name'] ?></h3>
                      <div class="div-wrapper" style="width: max-content;">
                        <div style="display: flex;align-items: center;justify-content: flex-start;width: max-content;">
                          <span class="starRating"
                            style="margin: 0px;margin-left:0px;width:max-content;height:max-content;">
                            <span class="stars-outer" style="width:max-content;height:max-content;margin:0;padding:0;">
                              <span class="stars-inner"
                                style="width:max-content;height:max-content;margin:0;padding:0;"></span>
                            </span>
                          </span>
                        </div>
                        <div
                          style="padding:0px !important;display: flex;align-items: center;justify-content: flex-start;width: max-content;">
                          <div class="px-3" style="padding-bottom: 5px;">
                            <h2 class="mb-0">
                              <span class="m-sing pricetag" id="ini"> &#8377;<?= $mrp ?> /-</span>
                              <span id="oldpriceofitem" style="display: none;">
                                <span id="org" class="m-sing pricetag"></span>
                                <del>
                                  <small><span style="color: #6d6d6d;font-size: 16px;">&#8377;<?= $mrp ?></span></small>
                                </del>
                              </span>
                            </h2>
                            <h4 class="mt-0">
                              <small style="color: white"> </small>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <!---------------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------------->
                      <?php
                      //CHANGE 2////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
        $sqlfeatures_color="select * from product_details
        inner join item_description on item_description.item_description_id=product_details.item_description_id
        where item_description.item_id=:item_id and store_id=:store_id";
        $stmtfeatures_color=$pdo->prepare($sqlfeatures_color);
        $stmtfeatures_color->execute(array(
                ':item_id'=>$row2['item_id'],
                'store_id'=>$row2['store_id']));
*/
                      $sqlfeatures_color = "select * from item_description
        where item_description.item_id=:item_id";
                      $stmtfeatures_color = $pdo->prepare($sqlfeatures_color);
                      $stmtfeatures_color->execute(array(
                        ':item_id' => $row2['item_id']
                      ));
                      $color_cnt = 0;
                      while ($rowfeatures_color = $stmtfeatures_color->fetch(PDO::FETCH_ASSOC)) {
                        if (!is_null($rowfeatures_color['color']) && $rowfeatures_color['color'] != 0) {
                          if ($color_cnt == 0) {
                            ?>
                      <h4>Available Colors</h4>
                      <?php
                          }
                          ?>
                      <div class="btn-group btn-group-toggle" data-toggle="buttons" style="z-index:0 !important"
                        onclick="location.href='../Product/single.php?id=<?= $rowfeatures_color['item_description_id'] ?>'">
                        <?php
                        $sqlcolor_name = 'select color_name from color where color_id=' . (int) $rowfeatures_color['color'];
                        $stmtcolor_name = $pdo->query($sqlcolor_name);
                        while ($rowcolor_name = $stmtcolor_name->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                        <label class="btn btn-default text-center active">
                          <input type="radio" name="color_option"
                            id="color_option_a1<?= $rowcolor_name['color_name'] ?>" autocomplete="off" checked>
                          <i class="fas fa-circle fa-2x"
                            style="color: <?= $rowcolor_name['color_name'] ?>!important ;"></i>
                        </label>
                        <?php
                        }
                        ?>
                      </div>
                      <?php
                      $color_cnt += 1;
                        }
                      }
                      if ($color_cnt > 0) {
                        echo "<hr>";
                      }
                      //CHANGE 3////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
        $sqlfeatures_size="select * from product_details
        inner join item_description on item_description.item_description_id=product_details.item_description_id
        where item_description.item_id=:item_id and store_id=:store_id";
        $stmtfeatures_size=$pdo->prepare($sqlfeatures_size);
        $stmtfeatures_size->execute(array(
                ':item_id'=>$row2['item_id'],
                'store_id'=>$row2['store_id']));
*/
                      $sqlfeatures_size = "select * from item_description
        where item_description.item_id=:item_id";
                      $stmtfeatures_size = $pdo->prepare($sqlfeatures_size);
                      $stmtfeatures_size->execute(array(
                        ':item_id' => $row2['item_id']
                      ));
                      $size_cnt = 0;
                      while ($rowfeatures_size = $stmtfeatures_size->fetch(PDO::FETCH_ASSOC)) {
                        if (!is_null($rowfeatures_size['size']) && $rowfeatures_size['size'] != 0) {
                          if ($size_cnt == 0) {
                            ?>
                      <h4 class="mt-3">Size <small>Please select one</small></h4>
                      <?php
                          }
                          ?>
                      <div class="btn-group btn-group-toggle" data-toggle="buttons"
                        onclick="location.href='../Product/single.php?id=<?= $rowfeatures_size['item_description_id'] ?>'">
                        <?php
                        $sqlsize_name = 'select size_name from size where size_id=' . (int) $rowfeatures_size['size'];
                        $stmtsize_name = $pdo->query($sqlsize_name);
                        while ($rowsize_name = $stmtsize_name->fetch(PDO::FETCH_ASSOC)) {
                          ;
                          if ($rowsize_name['size_name'] == 'XL') {
                            $size_abbreviation = 'Xtra-Large';
                          }
                          if ($rowsize_name['size_name'] == 'XXL') {
                            $size_abbreviation = 'Xtra-Xtra-Large';
                          }
                          if ($rowsize_name['size_name'] == 'L') {
                            $size_abbreviation = 'Large';
                          }
                          if ($rowsize_name['size_name'] == 'M') {
                            $size_abbreviation = 'Medium';
                          }
                          if ($rowsize_name['size_name'] == 'SM' || $rowsize_name['size_name'] == 'S') {
                            $size_abbreviation = 'Small';
                          }
                          if ($rowsize_name['size_name'] == 'XS') {
                            $size_abbreviation = 'Xtra-Small';
                          }
                          ?>
                        <label class="btn btn-default text-center">
                          <input type="radio" name="color_option" id="color_option_b1<?= $rowsize_name['size_name'] ?>"
                            autocomplete="off">
                          <span class="text-xl">
                            <?= $rowsize_name['size_name'] ?>
                          </span>
                          <br>
                          <?= $size_abbreviation ?>
                        </label>
                        <?php
                        }
                        ?>
                      </div>
                      <?php
                      $size_cnt += 1;
                        }
                      }
                      if ($size_cnt > 0) {
                        echo "<hr>";
                      }
                      ?>
                      <p>
                      <ul>
                        <?php
                        $cats = explode("\n", $row2['description']);
                        foreach ($cats as $cat) {
                          ?>
                        <li>
                          <?= $cat ?>
                        </li>
                        <?php
                        }
                        ?>
                      </ul>
                      </p>
                      <hr>
                      <!---------------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------------------------------------->
                      <div class="container">
                        <div class="agileinfo_single">
                          <div class="col-md-12 agileinfo_single_right">
                            <div class="snipcart-thumb agileinfo_single_right_snipcart">
                            </div>
                            <div class="div-wrapper large-btn" id="btn-pc"
                              style="width: 80%;margin-left: -30px;display: flex;">
                              <div class="btn btn-primary btn-lg btn-flat btn-cart button" id="atc" type="button"
                                name="submit" data-toggle="modal" data-target="#avail_stores"
                                style="max-width: 200px;justify-content: flex-start;border-radius: 4px;">
                                <i class="fas fa-cart-plus mr-2"></i>
                                Add to Cart
                              </div>
                              <div class="btn btn-default btn-lg btn-flat btn-buy button" id="btn-buy" type="button"
                                name="submit" data-toggle="modal" data-target="#avail_stores_buy"
                                style="max-width: 200px;min-width: 150px;position: relative;float: left;justify-content: flex-start;border-radius: 4px;">
                                <div class="btn btn-default btn-lg btn-flat" type="button" name="submit"
                                  style="font-size: 16px;width: 25px;height:25px;position: relative;justify-content: center;border-radius: 50%;padding:4px;background-color: #fff;">
                                  <i style="color: #c50505;display: flex;align-items: center;justify-content: center;margin-left: 50%;"
                                    class="fas fa-flash mr-2"></i>
                                </div>
                                Buy Now
                              </div>
                            </div>
                            <div style="margin-top:20px;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab_single" style="position:inherit">
                <button id="tab_start" class="tablinkssingle"
                  onclick="openhiddentab(event, 'ratingsingle')">Rating</button>
                <button class="tablinkssingle" onclick="openhiddentab(event, 'reviewsingle')">Reviews</button>
              </div>
              <style>
                .rate {
                  float: left;
                  height: 46px;
                  padding: 0 10px;
                }

                .rate:not(:checked)>input {
                  position: fixed;
                  z-index: 0;
                  top: 0px;
                }

                .rate:not(:checked)>label {
                  float: right;
                  width: 1em;
                  overflow: hidden;
                  white-space: nowrap;
                  cursor: pointer;
                  font-size: 30px;
                  color: #ccc;
                }

                .rate:not(:checked)>label:before {
                  content: '★ ';
                }

                .rate>input:checked~label {
                  color: #ffc700;
                }

                .rate:not(:checked)>label:hover,
                .rate:not(:checked)>label:hover~label {
                  color: #deb217;
                }

                .rate>input:checked+label:hover,
                .rate>input:checked+label:hover~label,
                .rate>input:checked~label:hover,
                .rate>input:checked~label:hover~label,
                .rate>label:hover~input:checked~label {
                  color: #c59b08;
                }
              </style>
              <div id="reviewsingle" class="tabcontentsingle">
                <p style="margin-bottom:0;"><i class="fa fa-info-circle fa-lg"></i> comment on this particular product.
                </p>
                <div id="edit_user_reviewed"></div>
                <?php
                /*COLOR PICKER*/
                $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
                $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
                $reviewlen = 0;
                //USER REVIEW
//-------------------------------------------------------------------------------------------------------------------
                if (isset($_SESSION['id'])) {
                  $myreviewstmt = $pdo->query("select ordered_cnt,review,rating,date_of_review as date,users.first_name,users.last_name from item_keys join users on users.user_id=item_keys.user_id where item_description_id=" . $_GET['id'] . " and item_keys.user_id=" . $_SESSION['id']);
                  $myreviewcount = $myreviewstmt->rowCount();
                  if ($myreviewcount != 0) {
                    $myreviewrow = $myreviewstmt->fetch(PDO::FETCH_ASSOC);
                    $myordered_cnt = $myreviewrow['ordered_cnt'];
                    $myreview = $myreviewrow['review'];
                    $user_firstnm = $myreviewrow['first_name'];
                    $user_lastnm = $myreviewrow['last_name'];
                    if ($myreview != '0' && $myordered_cnt != 0) {
                      $user_rated = $myreviewrow['rating'];
                      $user_date_of_review = $myreviewrow['date'];
                      $user_firstletter = substr($user_firstnm, 0, 1);
                      /*COLOR PICKER*/
                      $c1 = 'white';
                      $rancolor1 = array_rand($color, 1);
                      if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
                        $c1 = "black";
                      }
                      /*COLOR PICKER*/
                      //MY REVIEW HERE
//-------------------------------------------------------------------------------------------------------------------
                      ?>
                <section id="user_reviewed_already" style="margin-top:20px;">
                  <div class="div-wrapper" style="width:max-content">
                    <div
                      style="height:20px;width:20px;border-radius:50%;background-color: <?= $bgcolor[$rancolor1] ?>;display:flex;align-items:center;justify-content:center;color: <?= $c1 ?>">
                      <?= $user_firstletter ?>
                    </div>
                    <p>
                      <?= $user_firstnm . " " . $user_lastnm ?>
                    </p>
                  </div>
                  <div class="div-wrapper" style="width:max-content">
                    <?php
                    for ($g = 1; $g <= 5; $g++) {
                      if ($g <= $user_rated) {
                        ?>
                    <span class="fa fa-star star-checked"></span>
                    <?php
                      } else {
                        ?>
                    <span class="fa fa-star"></span>
                    <?php
                      }
                    }
                    $user_dor = explode("-", $user_date_of_review);
                    $user_date = $user_dor[2] . "/" . $user_dor[1] . "/" . substr($user_dor[0], 2);
                    ?>
                    <p>
                      <?= $user_date ?>
                    </p>
                  </div>
                  <div>
                    <article>
                      <p>
                        <?= htmlentities($myreview) ?>
                      </p>
                    </article>
                    <a onclick="editurresponse()" style="cursor:pointer"><i class="fas fa-pen"></i> edit your review
                    </a>
                  </div>
                </section>
                <div class="clearfix"> </div>
                <?php
                $reviewlen++;
                    }
                    //MY REVIEW HERE
//-------------------------------------------------------------------------------------------------------------------
//
//USER RATING & REVIEW
                    else {
                      $checkbuysql = $pdo->query("select ordered_cnt,users.first_name,users.last_name from item_keys join users on users.user_id=item_keys.user_id where item_description_id=" . $_GET['id'] . " and item_keys.user_id=" . $_SESSION['id'] . " and item_keys.ordered_cnt>0");
                      $checkbuycnt = $checkbuysql->rowCount();
                      if (is_null($checkbuycnt) == false && $checkbuycnt != 0) {
                        $checkbuy = $checkbuysql->fetch(PDO::FETCH_ASSOC);
                        $isorder = $checkbuy['ordered_cnt'];
                        if ($isorder != 0) {
                          ?>
                <div id="editoraddreview" style="margin:0;padding:0;">
                  <h3 style="margin-top:20px;">Rate this product</h3>
                  <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
                  </div>
                  <div class="clearfix"> </div>
                  <label class="form-label" for="reviewinput">Write a review <i class="fas fa-pen"></i>
                    <?php
                    if (isset($_SESSION['id'])) {
                      $checkbuysql = $pdo->query("select rating,review from item_keys where item_description_id=" . $_GET['id'] . " and user_id=" . $_SESSION['id']);
                      $checkbuy = $checkbuysql->fetch(PDO::FETCH_ASSOC);
                      if ($checkbuy) {
                        if ($checkbuy['rating'] != 0 && $checkbuy['ordered_cnt'] > 1 && $checkbuy['ordered_cnt'] != "0") {
                          ?>
                    <span style="color:red" onclick="canceledit()">&nbsp;Cancel</span>
                    <?php
                        }
                      }
                    }
                    ?>
                    <span id="charnow" style="color:rgb(0, 97, 0);padding-left:10px">0</span>/<span
                      style="color:rgb(0, 97, 0)">500</span>
                  </label>
                  <div class="form-group input-field" style="width: 100%;margin-top:0;">
                    <textarea maxlength="500" style="width:100%;outline:#0c99cc" title="Maximum character count is 500"
                      rows="4" oninput="$(this).removeClass('invalid');" onkeyup="changed_details();maxchar()"
                      onfocus="dis_add();" onblur="dis_add()" id="reviewinput" placeholder=""></textarea>
                    <span onclick="dis_add()" id="dis_add" class="fa fa-sm fa-edit"
                      style="position: absolute;right: 0;top: 0;color: white;background-color:#0c77cc;padding: 4px;"
                      onmouseover="$(this).css('background-color','#0c66cc')"
                      onmouseleave="$(this).css('background-color','#0c77cc')"></span>
                    <span onclick="reset_add()" id="hide_add" class="fa fa-sm fa-close"
                      style="display: none;position: absolute;right: 0;top: 0;color: white;background-color:red;padding: 5px;padding-top: 4px;padding-bottom: 4px;"
                      onmouseover="$(this).css('background-color','#bb0000')"
                      onmouseleave="$(this).css('background-color','red')"></span>
                    <span onclick="dis_ok()" id="hide_add1" class="fa fa-check"
                      style="display:none;position: absolute;right: 0;top: 23px;color: white;background-color:#07C103;padding: 3px;"
                      onmouseover="$(this).css('background-color','#4f994f')"
                      onmouseleave="$(this).css('background-color','#07C103')"></span>
                  </div>
                  <div id="add_user_review" style="display: none;">
                    <input class="shadow_b real_btn" type="button"
                      style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #410041), color-stop(1, #4f0063)) !important;color:white;border-radius:3px"
                      onclick="ratethisnow()" value="Submit">
                    <button class="shadow_b load_btn"
                      style="display:none;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #410041), color-stop(1, #4f0063)) !important;color:white;border-radius:3px"
                      type="button"><i class="fa fa-refresh fa-spin"></i>&nbsp;Submit</button>
                  </div>
                  <div class="clearfix"> </div>
                  <br>
                </div>
                <?php
                        }
                      }
                    }
                    ?>
                <?php
                    //USER RATING & REVIEW
                  }
                }
                //USER REVIEW
//--------------------------------------------------------------------------------------------------------------------
                if (isset($_SESSION['id'])) {
                  ?>
                <script>
                  function maxchar() {
                    var reviewlen = document.getElementById('reviewinput').value.length;
                    $('#charnow').html(reviewlen);
                  }
                  function editurresponse() {
                    $('#background_loader').show();
                    $('#std_loader').show();
                    $('#user_reviewed_already').hide();
                    var item_description_id =<?= $_GET['id'] ?>;
                    var user_id =<?= $_SESSION['id'] ?>;
                    $.ajax({
                      url: "../Common/functions.php", //passing page info
                      data: { "edituserrated": 1, "item_description_id": item_description_id, "user_id": user_id },  //form data
                      type: "post",   //post data
                      dataType: "json",   //datatype=json format
                      timeout: 30000,   //waiting time 30 sec
                      success: function (data) {    //if registration is success
                        if (data.status == 'success') {
                          $('#edit_user_reviewed').html(data.editreview);
                          $('#background_loader').show();
                          $('#std_loader').show();
                          return;
                        }
                        else {
                          return;
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
                          $('#background_loader').show();
                          $('#std_loader').show();
                          return;
                        }
                        else { return; }
                      }
                    }); //closing ajax
                  }
                  function ratethisnow() {
                    var reviewtext = document.getElementById('reviewinput').value;
                    var getSelectedValue = document.querySelector(
                      'input[name="rate"]:checked');
                    if (getSelectedValue == null) {
                      swal({
                        title: "Oops!!!",
                        text: "Please rate this product!!",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                      });
                      return;
                    }
                    if (getSelectedValue != null) {
                      var noofstars = getSelectedValue.value;
                      var item_description_id =<?= $_GET['id'] ?>;
                      var user_id =<?= $_SESSION['id'] ?>;
                      $('.real_btn').hide();
                      $('.load_btn').show();
                      $.ajax({
                        url: "../Common/functions.php", //passing page info
                        data: { "userrated": 1, "item_description_id": item_description_id, "user_id": user_id, "rating": noofstars, "review": reviewtext },  //form data
                        type: "post",   //post data
                        dataType: "json",   //datatype=json format
                        timeout: 30000,   //waiting time 30 sec
                        success: function (data) {    //if registration is success
                          if (data.status == 'success') {
                            $('#editoraddreview').hide();
                            $('#edit_user_reviewed').html(data.addreview);
                            swal({
                              title: "Thanks!!!",
                              text: "your response is added",
                              icon: "success",
                              closeOnClickOutside: false,
                              dangerMode: true,
                              timer: 6000,
                            })
                              .then((willSubmit1) => {
                                if (willSubmit1) {
                                  $('.real_btn').hide();
                                  $('.load_btn').hide();
                                  location.reload();
                                  return;
                                }
                              });
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
                    }
                  }
                  function canceledit() {
                    var item_description_id =<?= $_GET['id'] ?>;
                    var user_id =<?= $_SESSION['id'] ?>;
                    $.ajax({
                      url: "../Common/functions.php", //passing page info
                      data: { "canceluserrated": 1, "item_description_id": item_description_id, "user_id": user_id },  //form data
                      type: "post",   //post data
                      dataType: "json",   //datatype=json format
                      timeout: 30000,   //waiting time 30 sec
                      success: function (data) {    //if registration is success
                        if (data.status == 'success') {
                          $('#editoraddreview').hide();
                          $('#edit_user_reviewed').html(data.addreview);
                          $('.real_btn').hide();
                          $('.load_btn').hide();
                          return;
                        }
                        else {
                          return;
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
                  }
                  function listenchanges() {
                    var reviewinput = document.getElementById("reviewinput").value;
                    var oldreviewinput = '<?= $myreview ?>';
                    //reviewinput--------------------------------------------------------------------------------------------------------------------------------------
                    if ($('#dis_add').css('display') == 'none') {
                      if (reviewinput != oldreviewinput) {
                        $('#hide_add').show();
                        $('#hide_add1').show();
                      }
                      else if (reviewinput == oldreviewinput) {
                        $('#hide_add').show();
                        $('#hide_add1').hide();
                      }
                    }
                  }
                  function changed_details() {
                    $('#add_user_review').show();
                    listenchanges();
                    succeeded();
                  }
                  function succeeded() {
                    var reviewinput = document.getElementById("reviewinput").value;
                    var oldreviewinput = '<?= $myreview ?>';
                    if (reviewinput != oldreviewinput && reviewinput.length > 3) {
                      $('#add_user_review').show();
                    }
                    else {
                      $('#add_user_review').hide();
                    }
                  }
                  //--------------------------------------------------------------------------------------------------------------------------------------------------------
                  //REVIEW BOX
                  function dis_add() {
                    var reviewinput = document.getElementById("reviewinput").value;
                    var oldreviewinput = '<?= $myreview ?>';
                    if ($('#hide_add').css('display') == 'none' && $('#hide_add1').css('display') == 'none') {
                      if (reviewinput == oldreviewinput) {
                        $('#dis_add').hide();
                        $('#hide_add').show();
                      }
                      if (reviewinput != oldreviewinput) {
                        $('#dis_add').hide();
                        $('#hide_add').show();
                        $('#hide_add1').show();
                      }
                      document.getElementById("reviewinput").readOnly = false;
                      document.getElementById("reviewinput").focus();
                      var updatedetailInput = $("#reviewinput");
                      updatedetailInput.putCursorAtEnd().on("focus", function () {
                        updatedetailInput.putCursorAtEnd()
                      });
                    }
                    else if ($('#hide_add1').css('display') == 'none') {
                      $('#dis_add').show();
                      $('#hide_add').hide();
                      $('#hide_add1').hide();
                    }
                  }
                  function dis_ok() {
                    $('#dis_add').show();
                    $('#hide_add').hide();
                    $('#hide_add1').hide();
                  }
                  function reset_add() {
                    var reviewinput = document.getElementById("reviewinput").value;
                    var oldreviewinput = '<?= $myreview ?>';
                    if (oldreviewinput == "0") {
                      oldreviewinput = "";
                    }
                    if (($('#hide_add').css('display') != 'none') && ($('#hide_add1').css('display') != 'none')) {
                      $('#dis_add').show();
                      $('#hide_add').hide();
                      $('#hide_add1').hide();
                    }
                    else if (($('#hide_add').css('display') != 'none') && ($('#hide_add1').css('display') == 'none')) {
                      $('#dis_add').show();
                      $('#hide_add').hide();
                    }
                    document.getElementById("reviewinput").value = oldreviewinput;
                    succeeded();
                  }
                  //--------------------------------------------------------------------------------------------------------------------------------------------------------
                </script>
                <?php
                }
                //PUBLIC REVIEW
                if (isset($_SESSION['id'])) {
                  $reviewstmt = $pdo->query("select item_keys.ordered_cnt,item_keys.review,rating,users.first_name,users.last_name,date_of_review as date from item_keys join users on users.user_id=item_keys.user_id where item_description_id=" . $_GET['id'] . " and item_keys.user_id not in (" . $_SESSION['id'] . ") and rating>0 and review!='0' and item_keys.ordered_cnt>0 and review!='0' limit 5");
                } else {
                  $reviewstmt = $pdo->query("select item_keys.ordered_cnt,item_keys.review,rating,users.first_name,users.last_name,date_of_review as date from item_keys join users on users.user_id=item_keys.user_id where item_description_id=" . $_GET['id'] . " and rating>0 and review!='0' and item_keys.ordered_cnt>0 and review!='0' limit 5");
                }
                $reviewcount = $reviewstmt->rowCount();
                if ($reviewcount != 0) {
                  while ($reviewrow = $reviewstmt->fetch(PDO::FETCH_ASSOC)) {
                    $ordered_cnt = $reviewrow['ordered_cnt'];
                    $review = $reviewrow['review'];
                    $pulic_rated = $reviewrow['rating'];
                    $date_of_review = $reviewrow['date'];
                    $firstnm = $reviewrow['first_name'];
                    $lastnm = $reviewrow['last_name'];
                    $firstletter = substr($firstnm, 0, 1);
                    if ($review != '0') {
                      /*COLOR PICKER*/
                      $c1 = 'white';
                      $rancolor1 = array_rand($color, 1);
                      if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
                        $c1 = "black";
                      }
                      /*COLOR PICKER*/
                      //PUBLIC REVIEW HERE
                      if ($reviewlen != 0) {
                        ?>
                <hr style="margin-top:10px;">
                <?php
                      }
                      ?>
                <section>
                  <div class="div-wrapper" style="width:max-content;margin-top:20px;">
                    <div
                      style="height:20px;width:20px;border-radius:50%;background-color: <?= $bgcolor[$rancolor1] ?>;display:flex;align-items:center;justify-content:center;color: <?= $c1 ?>">
                      <?= $firstletter ?>
                    </div>
                    <p>
                      <?= $firstnm . " " . $lastnm ?>
                    </p>
                  </div>
                  <div class="div-wrapper" style="width:max-content">
                    <?php
                    for ($k = 1; $k <= 5; $k++) {
                      if ($k <= $pulic_rated) {
                        ?>
                    <span class="fa fa-star star-checked"></span>
                    <?php
                      } else {
                        ?>
                    <span class="fa fa-star"></span>
                    <?php
                      }
                    }
                    $dor = explode("-", $date_of_review);
                    $date = $dor[2] . "/" . $dor[1] . "/" . substr($dor[0], 2);
                    ?>
                    <p>
                      <?= $date ?>
                    </p>
                  </div>
                  <div>
                    <article>
                      <p>
                        <?= htmlentities($review) ?>
                      </p>
                    </article>
                  </div>
                </section>
                <div class="clearfix"> </div>
                <?php
                $reviewlen++;
                    }
                  }
                } else {
                  echo "<img src='../../images/logo/no-review.png' style='max-height:150px;max-width:250px'><p><i class='fa fa-frown fa-lg' style='color:#000000;background-color:#ffff00;border-radius:50%'></i> No reviews on this product..! </p>";
                }
                ?>
              </div>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <div id="ratingsingle" class="tabcontentsingle" style="background-color:#f2f2f2;padding:0px">
                <style>
                  .rating_circle {
                    width: 100px;
                    height: 100px;
                    border-radius: 70px;
                    border: 1px none;
                    font-size: 35px;
                  }

                  .rating_text {
                    margin-top: 38px;
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

                  .dark {}

                  /* Individual bars */
                  .bar-a {
                    background-color: #04AA6D;
                  }

                  .bar-b {
                    background-color: #2196F3;
                  }

                  .bar-c {
                    background-color: #00bcd4;
                  }

                  .bar-d {
                    background-color: #ff9800;
                  }

                  .bar-e {
                    background-color: #f44336;
                  }

                  @media(max-width:768px) {
                    .review {
                      font-size: 24px;
                    }

                    .rating_circle {
                      width: 80px;
                      height: 80px;
                      border-radius: 70px;
                      border: 1px none;
                      font-size: 30px;
                    }

                    .rating_text {
                      margin-top: 38px;
                    }
                  }

                  @media(max-width:568px) {
                    .review {
                      font-size: 20px;
                    }

                    .rating_circle {
                      width: 70px;
                      height: 70px;
                      border-radius: 70px;
                      border: 1px none;
                      font-size: 27px;
                    }

                    .rating_text {
                      margin-top: 38px;
                    }
                  }

                  @media(max-width:420px) {
                    .review {
                      font-size: 20px;
                    }

                    .rating_circle {
                      width: 70px;
                      height: 70px;
                      border-radius: 70px;
                      border: 1px none;
                      font-size: 25px;
                    }

                    .rating_text {
                      margin-top: 38px;
                    }

                    .rating-left-padding {
                      padding-left: 5px !important;
                    }

                    .review_container {
                      width: 100%;
                    }

                    .review_content {
                      width: 100%;
                      padding-left: 15px !important;
                      padding-right: 20px !important;
                    }
                  }
                </style>
                <?php
                $tot_ratingstarstmt = $pdo->query("select count(item_keys.rating) as totratingcnt from item_keys where item_description_id=" . $_GET['id'] . " and rating>0 and ordered_cnt>0 and review!='0'");
                $tot_ratestarcount = $tot_ratingstarstmt->rowCount();
                if (is_null($tot_ratestarcount) == false && $tot_ratestarcount != 0) {
                  $tot_ratingstarrow = $tot_ratingstarstmt->fetch(PDO::FETCH_ASSOC);
                  $tot_ratingstar = $tot_ratingstarrow['totratingcnt'];
                  for ($i = 5; $i > 0; $i--) {
                    $ratingstarstmt = $pdo->query("select count(item_keys.rating) as ratingcnt,rating from item_keys where item_description_id=" . $_GET['id'] . " and rating=" . $i . " and ordered_cnt>0 and review!='0'");
                    $ratestarcount = $ratingstarstmt->rowCount();
                    if ($ratecount != 0) {
                      $ratingstarrow = $ratingstarstmt->fetch(PDO::FETCH_ASSOC);
                      $ratingstar[$i] = $ratingstarrow['ratingcnt'];
                      if ($tot_ratingstar != 0) {
                        $ratingper[$i] = $ratingstar[$i] / $tot_ratingstar * 100;
                      } else {
                        $ratingper[$i] = 0;
                      }
                    } else {
                      $ratingper[$i] = 0;
                    }
                  }
                } else {
                  $ratingper[5] = $rating[4] = $rating[3] = $rating[2] = $rating[1] = 0;
                }
                ?>
                <div class="col-md-12 col-xs-12" style="padding:0;">
                  <div class="container" style="padding:0;width:100%;">
                    <div class="row" style="padding:0;">
                      <div class="col-md-12 col-xs-12">
                        <div class="card mt-5" style="margin:0;margin-top:0 !important;">
                          <div class="card-body rating-left-padding" style="width:100%;padding:0px;">
                            <div class="row">
                              <div class="col-md-3 col-xs-5 review_container" style="text-align:center">
                                <h2 class="review">Reviews</h2>
                                <button class="rating_circle"><?= round($rating, 1) ?></button>
                                <div>
                                  <div class="stars-outer mt-4">
                                    <div class="stars-inner"></div>
                                  </div><span>(<?= $tot_ratingstar ?>)</span>
                                </div>
                              </div>
                              <div class="col-md-8 col-xs-6 review_content" style="padding:5px;">
                                <br>
                                <span><b>5</b> <i class="fa fa-star"
                                    style="color: orange;"></i>(<?= $ratingstar[5] ?>)</span>
                                <div class="progress mt-3" style="height:10px;margin-top:0px !important;">
                                  <div class="progress-bar dark bar-a" style="width:<?= $ratingper[5] ?>%;height:10px;">
                                  </div>
                                </div>
                                <span><b>4</b> <i class="fa fa-star"
                                    style="color: orange;"></i>(<?= $ratingstar[4] ?>)</span>
                                <div class="progress mt-3" style="height:10px;margin-top:0px !important;">
                                  <div class="progress-bar dark bar-b" style="width:<?= $ratingper[4] ?>%;height:10px">
                                  </div>
                                </div>
                                <span><b>3</b> <i class="fa fa-star"
                                    style="color: orange;"></i>(<?= $ratingstar[3] ?>)</span>
                                <div class="progress mt-3" style="height:10px;margin-top:0px !important;">
                                  <div class="progress-bar dark bar-c" style="width:<?= $ratingper[3] ?>%;height:10px">
                                  </div>
                                </div>
                                <span><b>2</b> <i class="fa fa-star"
                                    style="color: orange;"></i>(<?= $ratingstar[2] ?>)</span>
                                <div class="progress mt-3" style="height:10px;margin-top:0px !important;">
                                  <div class="progress-bar dark bar-d" style="width:<?= $ratingper[2] ?>%;height:10px">
                                  </div>
                                </div>
                                <span><b>1</b> <i class="fa fa-star"
                                    style="color: orange;"></i>(<?= $ratingstar[1] ?>)</span>
                                <div class="progress mt-3" style="height:10px;margin-top:0px !important;">
                                  <div class="progress-bar dark bar-e" style="width:<?= $ratingper[1] ?>%;height:10px">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!------------------------------------------------------------------------------------------------------------------>
              <!-- /.card-body -->
              <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<!-- Bootstrap 4 -->
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
<!-- new -->
<div class="newproducts-w3agile" style="padding:0;padding-top:10px;">
  <h3>Related Products</h3>
  <?php
  $ran = $pdo->query("select * from item_description
              inner join item on item.item_id=item_description.item_id
              inner join category on category.category_id=item.category_id
              inner join sub_category on category.category_id=sub_category.category_id
              where item.sub_category_id=sub_category.sub_category_id and sub_category.sub_category_id= '$subcat_id' ");
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
  $product = $ran->rowCount();
  if ($product != 0) {
    ?>
    <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
      style="border-left: 5px solid <?= $bgcolor[$rancolor1] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
      Explore <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
      <span style="float: right;margin-right: 5px;margin-top: -4px;">
        <button type="button"
          style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor1] ?>;padding: 11px auto;font-size: 12px;"
          name="proceed" class="checkout-button button alt wc-forward"><a
            href="../Product/products_viewall.php?category_id=<?= $cat_id ?>&subcategory_id=<?= $subcat_id ?>"
            style="color:<?= $c2 ?>;">View all</a></button>
      </span>
    </h4>
    <div class="difcat " style="border-radius: 5px;">
      <span class="difhed">
      </span>
      <div class="difrow hidescroll" id="difrow<?= $row['item_description_id'] ?>"
        onscroll="scrolllisten('difrow<?= $row['item_description_id'] ?>');">
        <button class="left-arrow-btn-all shadow_all_none" onclick="moveleft('difrow<?= $row['item_description_id'] ?>')"
          style="display: none;"><i class="fas fa-chevron-left"></i></button>
        <button class="right-arrow-btn-all shadow_all_none"
          onclick="moveright('difrow<?= $row['item_description_id'] ?>')"><i class="fas fa-chevron-right"></i></button>
        <?php
        while ($row = $ran->fetch(PDO::FETCH_ASSOC)) {
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
  }
  ?>
      <div class="clearfix"> </div>
    </div>
    <!-- //new -->
    <?php
    if (isset($_SESSION['id'])) {
      ?>
      <!-- new -->
      <div class="newproducts-w3agile" style="padding:0;padding-top:10px;">
        <h3>Recently Viewed</h3>
        <?php
        //CHANGE 4////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
$ran=$pdo->query("select views ,item_keys.item_description_id,sub_category.sub_category_id from item_keys
JOIN item_description ON item_keys.item_description_id=item_description.item_description_id
join product_details on item_description.item_description_id=product_details.item_description_id
join item on item.item_id=item_description.item_id
join sub_category on item.sub_category_id=sub_category.sub_category_id
where user_id=".$_SESSION['id']." GROUP BY item_description_id ORDER BY CAST(item_keys.date_of_preview as UNSIGNED) DESC");
$isready=$ran->rowCount();
*/
        $ran = $pdo->query("select views ,item_keys.item_description_id,sub_category.sub_category_id from item_keys
JOIN item_description ON item_keys.item_description_id=item_description.item_description_id
join item on item.item_id=item_description.item_id
join sub_category on item.sub_category_id=sub_category.sub_category_id
where user_id=" . $_SESSION['id'] . " GROUP BY item_description_id ORDER BY CAST(item_keys.date_of_preview as UNSIGNED) DESC");
        $isready = $ran->rowCount();
        if ($isready != 0 && is_null($isready) == false) {
          ?>
          <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
            style="border-left: 5px solid <?= $bgcolor[$rancolor2] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
            Explore <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
            <span style="float: right;margin-right: 5px;margin-top: -4px;">
              <button type="button"
                style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor2] ?>;padding: 11px auto;font-size: 12px;"
                name="proceed" class="checkout-button button alt wc-forward"><a href="../Product/diff_views.php?recent=1"
                  style="color:<?= $c2 ?>;">View all</a></button>
            </span>
          </h4>
          <div class="difcat " style="border-radius: 5px;">
            <span class="difhed">
            </span>
            <div class="difrow hidescroll" id="difrow1<?= $row['item_description_id'] ?>"
              onscroll="scrolllisten('difrow1<?= $row['item_description_id'] ?>');">
              <button class="left-arrow-btn-all shadow_all_none"
                onclick="moveleft('difrow1<?= $row['item_description_id'] ?>')" style="display: none;"><i
                  class="fas fa-chevron-left"></i></button>
              <button class="right-arrow-btn-all shadow_all_none"
                onclick="moveright('difrow1<?= $row['item_description_id'] ?>')"><i
                  class="fas fa-chevron-right"></i></button>
              <?php
              while ($view = $ran->fetch(PDO::FETCH_ASSOC)) {
                $item_desc_id = $view['item_description_id'];
                $preview = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                $row = $preview->fetch(PDO::FETCH_ASSOC);
                $subcat_id = $view['sub_category_id'];
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
        }
        ?>
            <div class="clearfix"> </div>
          </div>
          <?php
    }
    ?>
        <br><br>
        <!-- //new -->
        <?php
        require '../Product/single_footer.php';
        ?>
        <script>
          $(document).ready(function () {
            openhiddentab(event, 'ratingsingle');
            document.getElementById('tab_start').className += " active";
            $('input:checkbox').click(function () {
              $('input:checkbox').not(this).prop('checked', false);
            });
          });
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          function openhiddentab(evt, TabSingleName) {
            var i, tabcontentsingle, tablinkssingle;
            tabcontentsingle = document.getElementsByClassName("tabcontentsingle");
            for (i = 0; i < tabcontentsingle.length; i++) {
              tabcontentsingle[i].style.display = "none";
            }
            tablinkssingle = document.getElementsByClassName("tablinkssingle");
            for (i = 0; i < tablinkssingle.length; i++) {
              tablinkssingle[i].className = tablinkssingle[i].className.replace(" active", "");
            }
            document.getElementById(TabSingleName).style.display = "block";
            evt.currentTarget.className += " active";
          }
          //SINGLE IMG VIEW
          function openModal_single() {
            document.getElementById("myModal-single").style.display = "block";
          }
          function closeModal_single() {
            document.getElementById("myModal-single").style.display = "none";
          }
          var slideIndex = 1;
          showSlides_single(slideIndex);
          function plusSlides(n) {
            showSlides_single(slideIndex += n);
          }
          function currentSlide(n) {
            showSlides_single(slideIndex = n);
          }
          function showSlides_single(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides-single");
            var dots = document.getElementsByClassName("demo-single");
            var captionText = document.getElementById("caption-single");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active-single", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active-single";
            //captionText.innerHTML = dots[slideIndex-1].alt;
          }
          //SINGLE IMG VIEW
          //PRICE AND CART SETTINGS
          function pricing(store) {
            var item_description_id = <?= $item_description_id ?>;
            var store_id = store;
            $('.sel_store').css('display', 'unset');
            $('.element_cart').hide();
            $('#check' + store_id).css('display', 'none');
            $('#btn' + store_id).css('display', 'unset');
            //if none is checked
            if ($('.sel_store:checkbox:checked').length == 0) {
              $("#ini").show();
              $("#per").hide();
            }
            //if none is checked
            else {
              $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "price": 1, "item_description_id": item_description_id, "store_id": store_id },  //form data
                type: "post",   //post data
                dataType: "json",   //datatype=json format
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {    //if registration is success
                  $("#ini").hide();
                  document.getElementById('org').innerHTML = "";
                  document.getElementById('org').innerHTML += "&#8377;" + data.price + " /-";
                  document.getElementById('save').innerHTML = "";
                  document.getElementById('save').innerHTML += data.save;
                  document.getElementById('off').innerHTML = "";
                  document.getElementById('off').innerHTML += data.off;
                  document.getElementById('dis_avail').innerHTML = "";
                  document.getElementById('dis_avail').innerHTML = "" + data.availability;
                  document.getElementById('dis_sts').innerHTML = "";
                  document.getElementById('dis_sts').innerHTML = "" + data.sts;
                  document.getElementById('dis_qnty').innerHTML = "";
                  document.getElementById('dis_qnty').innerHTML = "" + data.quantity;
                  document.getElementById('dis_add').innerHTML = "";
                  document.getElementById('dis_add').innerHTML = "" + data.address;
                  $("#oldpriceofitem").show();
                  $("#per").show();
                  return;
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
            }
          }
          //PRICE AND CART SETTINGS
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //PRICE AND CART SETTINGS WISHLIST
          function wishlist_pricing(store) {
            var item_description_id = <?= $item_description_id ?>;
            var store_id = store;
            $('.sel_store2').css('display', 'unset');
            $('.element_cart2').hide();
            $('#wishlist_check' + store_id).css('display', 'none');
            $('#wishlist_btn' + store_id).css('display', 'unset');
            //if none is checked
            if ($('.sel_store2:checkbox:checked').length == 0) {
              $("#ini").show();
              $("#per2").hide();
            }
            //if none is checked
            else {
              $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "price": 1, "item_description_id": item_description_id, "store_id": store_id },  //form data
                type: "post",   //post data
                dataType: "json",   //datatype=json format
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {    //if registration is success
                  $("#ini").hide();
                  document.getElementById('org').innerHTML = "";
                  document.getElementById('org').innerHTML += "&#8377;" + data.price + " /-";
                  document.getElementById('save2').innerHTML = "";
                  document.getElementById('save2').innerHTML += data.save;
                  document.getElementById('off2').innerHTML = "";
                  document.getElementById('off2').innerHTML += data.off;
                  document.getElementById('dis_avail2').innerHTML = "";
                  document.getElementById('dis_avail2').innerHTML = "" + data.availability;
                  document.getElementById('dis_sts2').innerHTML = "";
                  document.getElementById('dis_sts2').innerHTML = "" + data.sts;
                  document.getElementById('dis_qnty2').innerHTML = "";
                  document.getElementById('dis_qnty2').innerHTML = "" + data.quantity;
                  document.getElementById('dis_add2').innerHTML = "";
                  document.getElementById('dis_add2').innerHTML = "" + data.address;
                  $("#oldpriceofitem").show();
                  $("#per2").show();
                  return;
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
            }
          }
          //PRICE AND CART SETTINGS  WISHLIST
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //WISHLIST ENTRY ITEMS
          function wishlist_check_store_select() {
            var tbl = document.getElementById("store_wishlist");
            var chks = tbl.getElementsByTagName("INPUT");
            var id = 0;
            var flag = 0;
            for (var i = 0; i < chks.length; i++) {
              if (chks[i].checked == true) {
                id = chks[i].value;
                flag = 1;
              }
            }
            if (flag == 0) {
              swal({
                title: "Sorry!!!",
                text: "Select a store",
                icon: "warning",
                closeOnClickOutside: false,
                dangerMode: true,
              })
                .then((willSubmit1) => {
                  if (willSubmit1) {
                    return;
                  }
                  else {
                    return;
                  }
                });
            }
            else {
              var item_description_id = <?= $item_description_id ?>;
              $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "addtowishlist": 1, "item_description_id": item_description_id, "store_id": id },  //form data
                type: "post",   //post data
                dataType: "json",   //datatype=json format
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {    //if registration is success
                  if (data.status == 'success') {
                    return;
                  }
                  else if (data.status == 'error') {
                    swal({
                      title: "Required!!!",
                      text: "You need to create an Account",
                      icon: "error",
                      closeOnClickOutside: false,
                      dangerMode: true,
                    })
                      .then((willSubmit) => {
                        if (willSubmit) {
                          location.href = "../Account/registered.php";
                          return;
                        }
                        else {
                          return;
                        }
                      });
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
            }
          }
          //WISHLIST ENTRY ITEMS
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          function wishlist_check_list_select(wishlist_id) {
            $.ajax({
              url: "../Common/functions.php", //passing page info
              data: { "fetchedwishlistid": 1, "wishlist_id": wishlist_id },  //form data
              type: "post",   //post data
              dataType: "json",   //datatype=json format
              timeout: 30000,   //waiting time 30 sec
              success: function (data) {    //if registration is success
                if (data.status == 'success') {
                  $('#wish_cnt_' + wishlist_id + '').html(data.new_wish_cnt);
                  swal({
                    title: "Added!!!",
                    text: "Check your wishlist",
                    icon: "success",
                    closeOnClickOutside: false,
                    dangerMode: true,
                  })
                    .then((willSubmit1) => {
                      if (willSubmit1) {
                        return;
                      }
                      else {
                        return;
                      }
                    });
                }
                else if (data.status == 'success1') {
                  $(".background_loader").hide();
                  $(".std_loader").hide();
                  swal({
                    title: "Item exists!!!",
                    text: "Check your wishlist",
                    icon: "warning",
                    closeOnClickOutside: false,
                    dangerMode: true,
                  })
                    .then((willSubmit1) => {
                      if (willSubmit1) {
                        return;
                      }
                      else {
                        return;
                      }
                    });
                }
                else if (data.status == 'error') {
                  swal({
                    title: "Required!!!",
                    text: "You need to create an Account",
                    icon: "error",
                    closeOnClickOutside: false,
                    dangerMode: true,
                  })
                    .then((willSubmit) => {
                      if (willSubmit) {
                        location.href = "../Account/registered.php";
                        return;
                      }
                      else {
                        return;
                      }
                    });
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
          }
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //PRICE AND CART SETTINGS /// BUY NOW ///
          function buynow_pricing(store) {
            var item_description_id = <?= $item_description_id ?>;
            var store_id = store;
            $('.sel_store3').css('display', 'unset');
            $('.element_cart3').hide();
            $('#buynow_check' + store_id).css('display', 'none');
            $('#buynow_btn' + store_id).css('display', 'unset');
            //if none is checked
            if ($('.sel_store3:checkbox:checked').length == 0) {
              $("#ini").show();
              $("#per3").hide();
            }
            //if none is checked
            else {
              $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "price": 1, "item_description_id": item_description_id, "store_id": store_id },  //form data
                type: "post",   //post data
                dataType: "json",   //datatype=json format
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {    //if registration is success
                  $("#ini").hide();
                  document.getElementById('org').innerHTML = "";
                  document.getElementById('org').innerHTML += "&#8377;" + data.price + " /-";
                  document.getElementById('save3').innerHTML = "";
                  document.getElementById('save3').innerHTML += data.save;
                  document.getElementById('off3').innerHTML = "";
                  document.getElementById('off3').innerHTML += data.off;
                  document.getElementById('dis_avail3').innerHTML = "";
                  document.getElementById('dis_avail3').innerHTML = "" + data.availability;
                  document.getElementById('dis_sts3').innerHTML = "";
                  document.getElementById('dis_sts3').innerHTML = "" + data.sts;
                  document.getElementById('dis_qnty3').innerHTML = "";
                  document.getElementById('dis_qnty3').innerHTML = "" + data.quantity;
                  document.getElementById('dis_add3').innerHTML = "";
                  document.getElementById('dis_add3').innerHTML = "" + data.address;
                  $("#oldpriceofitem").show();
                  $("#per3").show();
                  return;
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
            }
          }
          //PRICE AND CART SETTINGS BUY NOW
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //BUY NOW ITEM RESPONSE
          function buynow_place_order_select() {
            var tbl = document.getElementById("store_buynow");
            var chks = tbl.getElementsByTagName("INPUT");
            var id = 0;
            var flag = 0;
            for (var i = 0; i < chks.length; i++) {
              if (chks[i].checked == true) {
                id = chks[i].value;
                flag = 1;
              }
            }
            if (flag == 0) {
              swal({
                title: "Sorry!!!",
                text: "Select a store",
                icon: "warning",
                closeOnClickOutside: false,
                dangerMode: true,
              })
                .then((willSubmit1) => {
                  if (willSubmit1) {
                    return;
                  }
                  else {
                    return;
                  }
                });
            }
            else {
              var item_description_id = <?= $item_description_id ?>;
              $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "buynow_item": 1, "item_description_id": item_description_id, "store_id": id },  //form data
                type: "post",   //post data
                dataType: "json",   //datatype=json format
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {    //if registration is success
                  if (data.status == 'success') {
                    location.href = "../Checkout/checkoutsingle.php?store_id=" + id + "&item_description_id=" + item_description_id + "";
                    return;
                  }
                  else if (data.status == 'error') {
                    swal({
                      title: "Not Available!!!",
                      text: "Choose another Store",
                      icon: "error",
                      closeOnClickOutside: false,
                      dangerMode: true,
                    })
                      .then((willSubmit) => {
                        if (willSubmit) {
                          location.href = "../Product/single.php?id=" + item_description_id + "";
                          return;
                        }
                        else {
                          return;
                        }
                      });
                  }
                  else if (data.status == 'error1') {
                    swal({
                      title: "Required!!!",
                      text: "You need to create an Account",
                      icon: "error",
                      closeOnClickOutside: false,
                      dangerMode: true,
                    })
                      .then((willSubmit) => {
                        if (willSubmit) {
                          location.href = "../Account/registered.php";
                          return;
                        }
                        else {
                          return;
                        }
                      });
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
            }
          }
          //BUY NOW ITEM RESPONSE
          ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          //AVAILABLE STORE LISTING
          /*
          function display_store(){
            if($('#avail_stores').css('display','none')){
              $('#avail_stores').show();
            }
            else if($('#avail_stores').css('display','unset')){
              $('#avail_stores').hide();
            }
          }
          */
        </script>
        <!--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM6g1c7vkW8WZjAy-vfKfCOQ3ysJrrIxY&callback=initMap" async defer></script>
-->
        </body>

        </html>