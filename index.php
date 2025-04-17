<?php
session_start();
$_COOKIE['animate'] = 0;
?>
<!DOCTYPE html>
<html>

<head>
  <title>OneStore || for all your needs</title>
  <!-- for-mobile-apps -->
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="images/logo/favicon.png" rel="icon" />
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  <script src="js/jquery-1.11.1.min.js"></script>
  <style type="text/css">
    img.log {
      max-height: 100px;
      max-width: 100px;
      width: 0;
      position: absolute;
      animation-name: rotate;
      animation-duration: 6s;
      animation-direction: normal;
      animation-iteration-count: 1;
      animation-delay: 2s;
    }

    @keyframes rotate {
      0% {
        transform: rotate(0);
        width: 0px;
        margin-left: 0px;
        margin-top: 60px;
      }

      50% {
        transform: rotate(360deg);
        margin-left: -50px;
        margin-top: -60px;
        width: 100px;
      }

      80% {
        margin-top: 60px;
        width: 100px;
      }

      100% {
        margin-left: 0px;
        margin-top: 0px;
        width: 100px;
      }
    }

    img.log:empty {
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      margin-left: -60px;
      margin-top: -60px;
    }

    .loader3 {
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

    .loader3 {
      animation: fadegone 4s infinite;
      animation-fill-mode: forwards;
    }

    @keyframes fadegone {
      100% {
        opacity: 100%;
        visibility: hidden;
      }
    }

    img.ic {
      max-height: 80px;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 999;
    }

    img.ic:empty {
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }

    .loader2 {
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

    .loader2 {
      animation: fadeloga 2s;
      animation-fill-mode: forwards;
    }

    @keyframes fadeloga {
      100% {
        opacity: 100%;
        visibility: hidden;
      }
    }

    img.ri {
      overflow-x: hidden;
      position: fixed;
      min-width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.9);
    }

    img.ri:empty {
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }

    .loader1 {
      position: fixed;
      z-index: 98;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .loader1 {
      animation: fadeimg 3s infinite;
      animation-fill-mode: forwards;
    }

    @keyframes fadeimg {
      100% {
        opacity: 100%;
        visibility: hidden;
      }
    }

    .loader {
      position: fixed;
      z-index: 99;
      top: 0;
      left: 0;
      height: 100%;
      background-color: rgb(000, 000, 000, 0.85);
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .loader img {
      margin-top: 120px;
    }

    .loader.hidden {
      animation: fadeout 3s;
      animation-fill-mode: forwards;
    }

    @keyframes fadeout {
      100% {
        opacity: 100%;
        visibility: hidden;
      }
    }
  </style>
</head>

<body onload="userlogged_in()">
  <div class="loader">
    <img src="images\load\3.svg" height="70" alt="loading..." />
  </div>
  <div class="loader1">
    <img src="images/logo/store.jpg" class="ri" />
  </div>
  <div class="loader2">
    <img src="images/logo/logo-high.png" class="ic">
  </div>
  <div class="loader3">
    <img src="images/logo/logofullfill.png" class="log">
  </div>
  <script src="js/sweetalert.min.js"></script>
  <script type="text/javascript">
    function getCookie(name) {
      // Split cookie string and get all individual name=value pairs in an array
      var cookieArr = document.cookie.split(";");

      // Loop through the array elements
      for (var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");

        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if (name == cookiePair[0].trim()) {
          // Decode the cookie value and return
          return decodeURIComponent(cookiePair[1]);
        }
      }

      // Return null if not found
      return " ";
    }
    function userlogged_in() {
      setTimeout(() => {
        const loader = document.querySelector(".loader1");
        console.log(loader);
        loader.className += " hidden";


        var email = getCookie("OneStore_email");
        var pass = getCookie("OneStore_password");
        if (email != " " && pass != " ") {
          //$("#strt").hide();
          $.ajax({
            url: "user/Common/functions.php", //passing page info
            data: { "login": 1, "email": email, "password": pass },  //form data
            type: "post", //post data
            dataType: "json",   //datatype=json format
            timeout: 18000,  //waiting time 3 sec

            success: function (data) {  //if logging in is success
              if (data.admin == 'true' && data.user == 'true') {
                location.href = "user/Main/onestore.php";
              }
              else if (data.status == 'success') {
                location.href = "user/Main/onestore.php";
                return
              }
              else if (data.admin == 'true') {

                location.href = "store-admin/index.php?id=" + data.id + "";
              }
              else if (data.status == 'error') {
                location.href = "user/Main/onestore.php";
                return;
              }
              else {
                if (status === "error1") {
                  swal({
                    title: "Oops!!!",
                    text: "Verify your email",
                    icon: "error",
                    closeOnClickOutside: false,
                    dangerMode: true,
                    timer: 6000,
                  });
                  location.href = "user/Main/onestore.php";
                }
                location.href = "user/Main/onestore.php";
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
                location.href = "user/Main/onestore.php";
                return;
              }
              else { return; }
            }
          }); //closing ajax
        }
        else {
          location.href = "user/Main/onestore.php";
        }
      }, 4800);
    }
  </script>
</body>

</html>