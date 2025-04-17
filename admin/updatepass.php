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
      $('#updatepassphp').addClass('active');
    </script>
    <style>
      .ftcl {
        border-color: #2e6da4;
        width: 100%;
        margin-right: 20px;
        outline: none;
        border-radius: 5px;
        height: 30px;
        margin-bottom: 20px;
      }

      .modal-header1 {
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #cd07ff), color-stop(1, #a900ff)) !important;
        color: white;
        padding: 15px;
      }

      .modal-title1 {
        margin: 0;
        line-height: 1.42857143;
      }

      .modal-body1 {
        position: relative;
        padding: 15px;
      }

      .modal-content1 {
        position: relative;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 6px;
        -webkit-box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
        box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
        outline: 0;
      }

      @media (min-width: 768px) {
        .modal-dialog1 {
          width: 600px;
          margin: 30px auto;
        }
      }

      .modal-dialog1 {
        position: relative;
        width: auto;
        margin: 10px;
      }

      select#brct {
        border-color: #2e6da4;
        width: 100%;
        margin-right: 20px;
        outline: none;
        border-radius: 5px;
        border-width: 2px;
      }

      button.btn.btn-primary {
        width: 100%;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #cd07ff), color-stop(1, #a900ff)) !important;
      }

      #eye,
      #eye2 {
        position: absolute;
        top: 0;
        right: 0;
        font-size: 24px;
        padding: 2px;
        height: 30px;
        background: black;
        color: white;
      }
    </style>
    <?php
    require "pdo.php";
    if (isset($_POST['pass'])) {
      $r = password_hash($_POST['pass'], PASSWORD_DEFAULT);
      $query = "UPDATE admin SET password='$r' WHERE admin_id=1";
      $statement = $pdo->prepare($query);
      $statement->execute();
    }
    ?>
    <script>
      function appjo() {
        var pass1 = $("#pass1").val();
        var pass2 = $("#pass2").val();
        if (pass1 != pass2 || pass1 == '' || pass2 == '') {
          $('#pass1').css('border-bottom', 'solid 4px red');
          $('#pass2').css('border-bottom', 'solid 4px red');
          return;
        }
        else {
          $('#pass1').css('border-bottom', 'solid 4px green');
          $('#pass2').css('border-bottom', 'solid 4px green');
          return false;
        }
      }
    </script>
    <form id="pass" method="post" style="justify-content: center;display:flex">
      <div class="col-sm-5" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog1" role="document">
          <div class="modal-content1">
            <div class="modal-header1">
              <h5 class="modal-title1">UPDATE PASSWORD</h5>
            </div>
            <div class="modal-body1" id="event">
              <label>Password</label>
              <div style="position: relative;">
                <input onkeyup="appjo()" type="password" name="pass" id="pass1" class="ftcl">
                <i id="eye" class="fas fa-eye"></i>
              </div>
              <label>Confirm Password</label>
              <div style="position: relative;">
                <input onkeyup="appjo()" type="password" id="pass2" class="ftcl">
                <i id="eye2" class="fas fa-eye"></i>
              </div>
              <button type="submit" onclick="appjo()" class="btn btn-primary">Reset</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php
    require 'foot.php';
    ?>
    <script>
      $("#eye").on("click", function () {
        if ($("#eye").hasClass("fas fa-eye-slash")) {
          $("#eye").removeClass("fa-eye-slash");
          $("#eye").addClass("fas fa-eye");
          $("#pass1").prop("type", "password");
        } else {
          $("#eye").removeClass("fa-eye");
          $("#eye").addClass("fas fa-eye-slash");
          $("#pass1").prop("type", "text");
        }
      });
      $("#eye2").on("click", function () {
        if ($("#eye2").hasClass("fas fa-eye-slash")) {
          $("#eye2").removeClass("fa-eye-slash");
          $("#eye2").addClass("fas fa-eye");
          $("#pass2").prop("type", "password");
        } else {
          $("#eye2").removeClass("fa-eye");
          $("#eye2").addClass("fas fa-eye-slash");
          $("#pass2").prop("type", "text");
        }
      });
    </script>