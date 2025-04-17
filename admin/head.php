<!DOCTYPE html>
<html lang="en">

<head>
  <title>One Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link id="pagestyle" rel="stylesheet" type="text/css" href="">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="images/logo/favicon.png" rel="icon" />
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/style4.css">
  <!-- SweetAlert2 -->
  <script src="../extras/OS/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="../extras/OS/plugins/toastr/toastr.min.js"></script>
  <!-- Defining Toastr -->
  <!--JS GRID 1 KRG--><!--
<link type="text/css" rel="stylesheet" href="js/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="js/jsgrid-theme.min.css" />
<script type="text/javascript" src="js/jsgrid.min.js"></script>-->
  <!--JS GRID 1 KRG-->
  <!--JS GRID 1 GDAS-->
  <link type="text/css" rel="stylesheet" href="js/jsgrid/dist/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="js/jsgrid/dist/jsgrid-theme.min.css" />
  <script type="text/javascript" src="js/jsgrid/dist/jsgrid.min.js"></script>
  <!--JS GRID 1 GDAS-->
  <script type="text/javascript">
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  </script>
  <script src="../js/sweetalert.min.js"></script>
</head>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
  die("<div style='width: 100%;
display: flex;
flex-wrap: wrap;
margin-right: -0.75rem;
margin-left: -0.75rem;justify-content:center;padding-top:50px;padding-bottom:50px'>
<a href='login.php'><img class='img-responsive' src='images/logo/loginerr.png'></a></div>");
}
?>
<!--STYLING-->
<!--
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;}
    }
 @media screen and (max-width: 1200px) and (min-width: 768px) {
      .nav_text{
        display: none;
      }
      .icons img{
        height: 30px;
        width: 30px;
      }
      .text{
        display: none;
      }
    }
    .show-white-space {
        white-space: pre-wrap;
    }
    .ne_lab{
      font-size: 18px;
      margin: 15px;
    }
  .bcolo{
        background-color: #333e33;
}
  </style>
</head>
<body>
<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <a class="navbar-brand" href="#"  style="color:white"> <img src="images/logo/logo.png" height="50px" width="140px;" style="margin-top: -15px;"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
    <li id="indexphp"  class="active"><a href="index.php" ><span class="icons"><img src="images/speedometer.svg"></span><span class="nav_text">Dashboard</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="shopsphp"><a href="shops.php"><span class="icons"><img src="images/shop.svg"></span><span class="nav_text">Shops</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="addcategoriesphp"><a href="addcategories.php"><span class="icons"><img src="images/diagram-3.svg"></span><span class="nav_text">Category</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="requestphp"><a href="request.php"><span class="icons"><img src="images/file-earmark-lock.svg"></span> <span class="nav_text">Requests</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="selledproductsphp"><a href="selledproducts.php"><span class="icons"><img src="images/check-all.svg"></span> <span class="nav_text">Completed Orders</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
       <li id="uploadimagesphp"><a href="uploadimages.php"><span class="icons"><img src="images/file-earmark-plus.svg"></span><span class="nav_text"> Add Product</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
       <li id="viewphp"><a href="view.php"><span class="icons"><img src="images/file-earmark-arrow-up.svg"></span> <span class="nav_text">Update Products</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
       <li id="addstorephp"><a href="addstore.php"><span class="icons"><img src="images/plus-circle.svg"></span><span class="nav_text"> Add Store</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
       <li id="chatphp" ><a href="message.php"><span class="icons"><i class="fa fa-comments fa-2x"></i></span> <span class="nav_text" >Chats</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid ">
  <div class="row content">
    <div id="side-nav" class="col-sm-2  hidden-xs ">
      <div class="heading"><img src="images/logo\favicon.png" class="img_size">
        <div class="text">
     <p style="font-weight: bolder;
   display: block;
    margin-block-start: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;font-size: 1.5em">OneStore</p><p style="text-decoration: none;
    padding-right: 5px;
    margin-top: 3px;
    font-size: 11px;"><i class="fa fa-circle" style="color: #3c763d;display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased"></i> Online</p>
      </div></div>
      <ul class="nav nav-pills nav-stacked ">
    <li id="indexphp"  class="active"><a href="index.php" ><span class="icons"><img src="images/speedometer.svg"></span><span class="nav_text">Dashboard</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="shopsphp"><a href="shops.php"><span class="icons"><img src="images/shop.svg"></span><span class="nav_text">Shops</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="addcategoriesphp"><a href="addcategories.php"><span class="icons"><img src="images/diagram-3.svg"></span><span class="nav_text">Category</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="requestphp"><a href="request.php"><span class="icons"><img src="images/file-earmark-lock.svg"></span> <span class="nav_text">Requests</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      <li id="selledproductsphp"><a href="selledproducts.php"><span class="icons"><img src="images/check-all.svg"></span> <span class="nav_text">Completed Orders</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
       <li id="uploadimagesphp"><a href="uploadimages.php"><span class="icons"><img src="images/file-earmark-plus.svg"></span><span class="nav_text"> Add Product</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
        <li id="viewphp"><a href="view.php"><span class="icons"><img src="images/file-earmark-arrow-up.svg"></span> <span class="nav_text">Update Products</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
       <li id="addstorephp"><a href="addstore.php"><span class="icons"><img src="images/plus-circle.svg"></span><span class="nav_text"> Add Store</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
       <li id="chatphp" ><a href="message.php"><span class="icons"><i class="fa fa-comments fa-2x"></i></span> <span class="nav_text" >Chats</span><span style="float: right;"><i class="fa fa-angle-right"></i></span></a></li>
      </ul><br>
    </div>
    <br>
  </body>
-->