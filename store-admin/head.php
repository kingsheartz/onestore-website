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
if (isset($_GET['id'])) {
  $_SESSION['id'] = $_GET['id'];
}
require "pdo.php";
$nw = $_SESSION['id'];
$qu = "SELECT username from store_admin where store_id=$nw";
$st = $pdo->query($qu);
$r = $st->fetch(PDO::FETCH_ASSOC);
$_SESSION['username'] = $r['username'];
if (!isset($_SESSION['username'])) {
  die("<div style='width: 100%;
display: flex;
flex-wrap: wrap;
margin-right: -0.75rem;
margin-left: -0.75rem;justify-content:center;padding-top:50px;padding-bottom:50px'>
<a href='../login.php'><img class='img-responsive' src='images/logo/loginerr.png'></a></div>");
}
?>