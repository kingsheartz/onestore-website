<?php
session_start();
$_SESSION['failed'] = "Unauthorised entry is prohibited";
try {
  if (isset($_GET['click'])) {
    $_SESSION['failed'] = "The account is already activated <br> (or) <br> doesn't exist!";
  }
} catch (Exception $e) {
  return;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Sorry :(</title>
  <!--<link href="../../extras/css/style1.css" rel="stylesheet" type="text/css" media="all" />-->.
  <link href="../../images/logo/favicon.png" rel="icon">
  <!-- font-awesome icons -->
  <link href="../../css/font-awesome.css" rel="stylesheet">
  <!-- //font-awesome icons -->
  <style>
    img[alt="www.000webhost.com"] {
      display: none;
    }
  </style>
  <meta name="viewport" content="user-scalable=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords"
    content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <!--favicon-->
</head>
<style type="text/css">
  body {
    text-align: center;
    background: url("../../images/logo/store1.jpg") 0px 0px no-repeat;
    background-size: cover;
    background-attachment: fixed;
  }

  /*PAGE LOADER*/
  .loader {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    height: 100%;
    background-color: rgba(000, 000, 000, 0.85);
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .loader>img {
    width: 50px;
  }

  .loader .hidden {
    animation: fadeout 1s;
    animation-fill-mode: forwards;
  }

  @keyframes fadeout {
    100% {
      opacity: 0;
      visibility: hidden;
    }
  }

  /*PAGE LOADER*/
  body {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #main {
    top: -150px;
    left: -12px;
    width: 100%;
    padding-right: 101010px;
    padding-bottom: 150px;
    height: 100%;
    margin: auto;
    background-color: rgba(000, 000, 000, 0.8);
    position: relative;
    border-radius: 0px;
  }

  #cont {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>

<body>
  <!--ANIMATION-->
  <div class="loader">
    <img src="../../images\load\4.svg" alt="loading..." />
  </div>
  <!--ANIMATION-->
  <div>
  </div>
  <div id="main">
    <?php
    if (isset($_SESSION['failed'])) {
      echo '<div id="cont"><div style="padding-top:100px;"><center><a href="../Main/onestore.php" ><img src="../../images/logo/logomail.png"  ></a></center></div>';
      echo '<div id="error">';
      echo "<p style='text-align:center;font-size:42px;color:white;padding-top:5%;'><i style='color:yellow' class='fa fa-warning'></i> " . $_SESSION['failed'] . " <span style='color:red'>!!!</span></p><br>";
      echo "<center><a style='font-size:34px;color:white;font-weight:bold;text-decoration:none' href='../Account/login.php'><i style='color:#FFB04A' class='fas fa-hand-point-right'></i> <span style='color:red'><u>Log In</u></span></a></center>";
      echo '</div></div>';
    }
    ?>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script type="text/javascript">
    //ANIMATION
    window.addEventListener("load", function () {
      const loader = document.querySelector(".loader");
      console.log(loader);
      loader.className += " hidden";
    });
    //ANIMATION
  </script>
</body>

</html>