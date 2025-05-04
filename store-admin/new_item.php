<?php
require "head.php";
?>

<body>
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
      #cat {
        float: left;
        height: 30px;
      }

      #close {
        position: relative;
        float: right;
        margin-right: 0px;
        margin-bottom: -50px;
        background: #FF0000;
        color: white;
        padding: 5px;
        border-radius: 1px;
        font-size: 24px;
        cursor: pointer;
        z-index: 1;
      }

      .sel {
        margin-bottom: 50px;
        margin-top: 50px;
      }

      #search-box {
        width: 100%;
        position: relative;
        display: inline-block;
        font-size: 14px;
        margin-bottom: 50px;
      }

      #search-box .fa-search {
        position: absolute;
        left: 30px;
        top: 8px;
        color: #adadad;
      }

      #search-box input[type="text"] {
        outline: none;
        height: 32px;
        padding: 5px 40px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
        border-radius: 20px;
      }

      #result {
        position: relative;
        top: 100%;
        left: 0;
        width: 100%;
      }

      #search-box input[type="text"],
      #result {
        width: 100%;
        box-sizing: border-box;
      }

      /* Formatting result items */
      .imgdis {
        position: absolute;
        left: 0;
        margin-bottom: 20px;
        height: auto;
        max-height: 400px;
        overflow: auto;
        overflow-x: hidden;
      }

      .subbut button {
        width: 45%;
        height: 40px;
        color: white;
        font-size: 18px;
        margin: 2%;
        border: none;
        background: #014550;
        border-radius: 5px;
      }

      .subbut {
        margin-top: 20px;
        width: 100%;
      }

      .imgdis img {
        margin: auto;
        display: block;
        background: white;
        image-rendering: auto;
        image-rendering: crisp-edges;
        width: auto;
        max-width: 100px;
        height: auto;
        max-height: 100px;
        border: 1px solid #d2d2d2;
        margin-bottom: 5px;
        padding: 10px;
        -webkit-box-shadow: inset 0 0 1px #000;
      }

      .imgdis::-webkit-scrollbar {
        width: 5px;
        height: 6px;
      }

      .imgdis::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
      }

      .imgdis::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px #000;
      }

      .float-value {
        position: relative;
      }

      .float-value input.form-control {
        height: 40px;
      }

      .float-value select.form-control {
        height: 40px;
        padding: 8px;
      }

      .float-value .form-control {
        height: 40px;
        padding: 12px;
        border: 2px solid black;
      }

      .float-value label {
        position: absolute;
        top: -10px;
        background: white;
        left: 10px;
        font-weight: 700;
        color: #ff0000;
        padding-left: 12px;
        padding-right: 12px;
      }

      .float-value span {
        position: absolute;
        top: -10px;
        background: white;
        left: 10px;
        font-weight: 700;
        color: #ff0000;
        padding-left: 12px;
        padding-right: 12px;
      }

      .form-group {
        position: relative;
        margin-top: 50px;
      }

      table tr {
        padding-top: 12px;
        padding-bottom: 12px;
      }

      table {
        margin-bottom: 20px;
      }

      th,
      th {
        padding: 10px;
      }

      .form-group .floating-label {
        position: absolute;
        top: -10px;
        background: white;
        left: 10px;
        font-weight: 700;
        color: #ff9900;
        padding-left: 12px;
        padding-right: 12px;
      }

      .form-control {
        border: 2px solid black;
      }

      .difcat {
        position: relative;
        height: 380px;
        overflow: hidden;
        margin: auto;
        margin-top: 10px;
        margin-bottom: 10px;
        display: block;
        background: #FFFFFF;
        box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);
      }

      .difrow {
        height: 350px;
        overflow: auto;
        width: 76vw;
        margin: auto;
        display: block;
        white-space: nowrap;
        bottom: 0;
      }

      .products {
        display: inline-block;
        text-align: center;
        padding: 14px;
        position: relative;
        height: 300px;
        width: 200px;
        background: white;
        color: #000;
      }

      .products img {
        margin: auto;
        display: block;
        background: white;
        image-rendering: auto;
        image-rendering: crisp-edges;
        width: auto;
        max-width: 170px;
        height: auto;
        max-height: 200px;
      }

      .difhed {
        border-bottom: 1px solid #e2e2e2;
        width: 100%;
        margin: 0;
        height: auto;
        font-size: 22px;
        line-height: 32px;
        display: inline-block;
        font-weight: bolder;
        text-transform: capitalize;
        padding: 15px;
        font-family: 'Times New Roman', Times, serif;
      }

      .left-arrow {
        position: absolute;
        top: 40%;
        right: 0;
        z-index: 1;
        height: 100px;
        font-size: 24px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        border: 1px solid #d4d4d4;
      }

      .right-arrow {
        position: absolute;
        top: 40%;
        left: 0;
        z-index: 1;
        height: 100px;
        font-size: 24px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        border: 1px solid #d4d4d4;
      }

      .difrow::-webkit-scrollbar {
        display: none;
        width: 5px;
        height: 4px;
      }

      .difrow::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px #A200FF;
      }

      .difhed button {
        float: right;
        font-weight: bold;
        font-size: 16px;
        margin-right: 16px;
        padding: 2px;
        width: 100px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #3197ff), color-stop(1, #2196f3)) !important;
        border: none;
        color: white;
        border-radius: 5px;
      }

      .modal.in .modal-dialog {
        width: 85vw;
        margin: auto;
        display: block
      }

      button.close {
        margin-top: -30px;
      }

      .modal-header {
        padding: 15px;
        border-bottom: 1px solid #e5e5e5;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #000000), color-stop(1, #7221f3)) !important;
        color: white;
        font-family: -webkit-body;
      }

      .modal-footer {
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #000000), color-stop(1, #7221f3)) !important;
      }
    </style>

    <body>
      <div class="table1">
        <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;"><i
            class="fas fa-boxes" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>New Products</h4>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <br><br>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
      <script type="text/javascript">
        function moveleft(x) {
          var y = $('#' + x).scrollLeft();
          var width = $('#' + x).outerWidth()
          var scrollWidth = $('#' + x)[0].scrollWidth;
          if (scrollWidth - width === y) {
            $('#' + x + '>.left-arrow').hide();
            return;
          }
          $('#' + x).scrollLeft(y + 100);
          $('#' + x + '>.right-arrow').show();
        }
        function moveright(x) {
          var y = $('#' + x).scrollLeft();
          $('#' + x + '>.left-arrow').show();
          if (y === 0) {
            $('#' + x + '>.right-arrow').hide();
          }
          $('#' + x).scrollLeft(y - 100);
        }
        function movefr(x) {
          var y = $('#' + x).scrollLeft();
          var width = $('#' + x).outerWidth()
          var scrollWidth = $('#' + x)[0].scrollWidth;
          if (scrollWidth - width === y) {
            $('#' + x + '>.left-arrow').hide();
          }
          else if (y === 0) {
            $('#' + x + '>.right-arrow').hide();
          }
          else {
            $('#' + x + '>.left-arrow').show();
            $('#' + x + '>.right-arrow').show();
          }
        }
      </script>
      <?php
      require "pdo.php";
      $query11 = "SELECT * from  category";
      $st11 = $pdo->query($query11);
      while ($row11 = $st11->fetch(PDO::FETCH_ASSOC)) {
        $ct = $row11['category_id'];
        ?>
        <?php
        $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item.category_id=$ct and (item.added_date) in (
    select max(added_date) as date
    from item) GROUP BY item_description.item_id";
        $st = $pdo->query($query);
        $product = $st->rowCount();
        if ($product == 0) {
          continue;
        } else {
          ?>
          <div class="difcat ">
            <span class="difhed"><?= $row11['category_name'] ?>
              <button onclick="location.href='viewnewitems.php?category_id=<?= $ct ?>'">View All</button></span>
            </span>
            <div class="difrow" id="difrow<?= $ct ?>" onscroll="movefr('difrow<?= $ct ?>')">
              <button class="left-arrow" onclick="moveleft('difrow<?= $ct ?>')"><i
                  class="fas fa-chevron-right"></i></button>
              <button class="right-arrow" onclick="moveright('difrow<?= $ct ?>')" style="display: none;"><i
                  class="fas fa-chevron-left"></i></button>
              <?php
              while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="products">
                  <div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"><img class="image"
                      align="middle"
                      src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                  </div>
                  <div class="deupd"><?= $row['item_name'] ?><br>
                  </div>
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
        </div>
        <?php
        require "foot.php";
        ?>