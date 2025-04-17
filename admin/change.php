<?php
require "head.php";
?>

<body>
  <div class="wrapper">
    <?php
    include "head1.php";
    ?>
    <style type="text/css">
      #close {
        position: relative;
        float: right;
        margin-right: 0px;
        margin-top: 0px;
        background: #FF0000;
        color: white;
        padding: 2px;
        border-radius: 1px;
        font-size: 24px;
        cursor: pointer;
      }

      .imgdis img {
        height: auto;
        width: auto;
        max-height: 190px;
        max-width: auto;
        display: block;
        margin: auto;
        image-rendering: auto;
        padding-top: 5px;
        transition: transform .2s;
        /* Animation */
      }

      .imgdis img:hover {
        transform: scale(1.5);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
      }

      .imgdis {
        padding-bottom: 40px;
        position: relative;
        height: auto;
        min-height: 300px;
        overflow: auto;
        background: white;
        color: #000;
        overflow-x: hidden;
        box-shadow: 1px 1px 3px 3px rgb(0 0 0 / 10%);
      }

      .prim {
        position: relative;
        justify-content: center;
        height: auto;
        background: white;
        text-align: center;
        float: left;
        padding-top: 100px;
      }

      .imdeta {
        position: relative;
        float: left;
        padding-top: 50px;
        margin: auto;
        display: block;
        text-align: center;
      }

      table,
      tr {
        width: 100%;
        text-align: center;
        vertical-align: middle;
      }

      th,
      td {
        width: 50%;
        text-align: center;
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

      .newupdation {
        border-radius: 5px;
        width: 100%;
        height: auto;
        overflow: hidden;
        padding-top: 20px;
      }

      #message {
        padding: 20px;
        margin: auto;
        display: block;
      }

      .subb button {
        width: 200px;
        border-radius: 5px;
        height: 40px;
        border: none;
        color: #fff;
        margin-bottom: 12px;
      }

      @media (max-width: 768px) {

        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9 {
          width: 100%;
        }
      }

      .form-group {
        position: relative;
        width: 100%;
        float: left;
        margin: auto;
        display: block;
      }

      .form-group .floating-label {
        position: absolute;
        top: -10px;
        background: white;
        left: 10px;
        font-weight: 700;
        color: #390094;
        padding-left: 12px;
        padding-right: 12px;
      }

      .form-control {
        border: 2px solid black;
      }

      .checkbox {
        display: inline-flex;
        cursor: pointer;
        position: relative;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 5px;
        width: 100%;
      }

      .checkbox>span {
        color: #34495E;
        padding: 0.5rem 0.25rem;
        margin-left: 20px;
        width: 200px;
        text-align: left;
        font-size: 12px;
      }

      .checkbox>input {
        height: 25px;
        width: 25px;
        -webkit-appearance: none;
        -moz-appearance: none;
        -o-appearance: none;
        appearance: none;
        border: 1px solid #34495E;
        border-radius: 20px;
        outline: none;
        transition-duration: 0.3s;
        background-color: #41B883;
        cursor: pointer;
      }

      .checkbox input[type=checkbox] {
        margin-left: 0;
        position: relative;
        width: 36px;
      }

      .checkbox>input:checked {
        border: 1px solid #41B883;
        background-color: #34495E;
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

      .product {
        display: inline-block;
        text-align: center;
        padding: 5px;
        position: relative;
        height: 80px;
        width: 100px;
        border: 1px solid #dadada;
      }

      .left-arrow {
        position: absolute;
        bottom: 12%;
        right: 0;
        z-index: 1;
        height: 40px;
        background: transparent;
        border: none;
        font-size: 24px;
      }

      .right-arrow {
        position: absolute;
        bottom: 12%;
        left: 0;
        z-index: 1;
        height: 40px;
        background: transparent;
        border: none;
        font-size: 24px;
      }

      .imscr {
        height: 150px;
        overflow: auto;
        width: 300px;
        margin: auto;
        display: block;
        white-space: nowrap;
        bottom: 0;
        margin-top: 50px;
      }

      .checkbox>input:checked+span::before {
        content: '\2713';
        display: block;
        text-align: center;
        color: #41B883;
        position: absolute;
        left: 0.7rem;
        top: 0.2rem;
      }

      .checkbox>input:active {
        border: 2px solid #34495E;
      }

      .imscr::-webkit-scrollbar {
        display: none;
      }

      .thd {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        color: white;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #656463), color-stop(1, #171717)) !important;
        padding: 5px;
        border: 1px solid white;
        font-weight: bold;
        padding: 10px;
      }

      .col-sm-12 textarea {
        height: 200px;
        border: 1px solid #b1b1b1;
        border-radius: 5px;
        padding: 10px;
        white-space: pre-line;
      }

      .col-sm-12 {
        padding: 20px;
      }
    </style>
    <?php
    require "pdo.php";
    if (isset($_POST['cid'])) {
      $gt1 = $_POST['cid'];
      $rt1 = $_POST['price'];
      $des1 = $_POST['description'];
      $data8 = array(
        ':item_id' => $gt1,
        ':description' => $des1,
        ':price' => $rt1
      );
      $query6 = "UPDATE item SET
  description=:description, price=:price
  WHERE item_id=:item_id";
      $statement6 = $pdo->prepare($query6);
      print_r($statement6);
      $statement6->execute($data8);
    }
    if (isset($_POST['it_id'])) {
      if (isset($_POST['update_data'])) {
        $it_id = $_POST['it_id'];
        $size = isset($_POST['size' . $i]) ? $_POST['size' . $i] : 0;
        $color = isset($_POST['color' . $i]) ? $_POST['color' . $i] : 0;
        $weight = isset($_POST['weight' . $i]) ? $_POST['weight' . $i] : 0;
        if ($weight == '') {
          $weight = 0;
        }
        if ($size == '') {
          $size = 0;
        }
        if ($color == '') {
          $color = 0;
        }
        $flavour = isset($_POST['flavour' . $i]) ? $_POST['flavour' . $i] : 0;
        if ($flavour == '') {
          $flavour = 0;
        }
        $processor = isset($_POST['processor' . $i]) ? $_POST['processor' . $i] : 0;
        if ($processor == '') {
          $processor = 0;
        }
        $display = isset($_POST['display' . $i]) ? $_POST['display' . $i] : 0;
        if ($display == '') {
          $display = 0;
        }
        $battery = isset($_POST['battery' . $i]) ? $_POST['battery' . $i] : 0;
        if ($battery == '') {
          $battery = 0;
        }
        $internal_storage = isset($_POST['internal_storage' . $i]) ? $_POST['internal_storage' . $i] : 0;
        if ($internal_storage == '') {
          $internal_storage = 0;
        }
        $brand = isset($_POST['brand' . $i]) ? $_POST['brand' . $i] : 0;
        if ($brand == '') {
          $brand = 0;
        }
        $material = isset($_POST['material' . $i]) ? $_POST['material' . $i] : 0;
        if ($material == '') {
          $material = 0;
        }
        $gt = $_POST['item_id'];
        $data = array(
          ':item_description_id' => $it_id,
          ':item_id' => $gt,
          ':size' => $size,
          ':color' => $color,
          ':weight' => $weight,
          ':flavour' => $flavour,
          ':processor' => $processor,
          ':display' => $display,
          ':battery' => $battery,
          ':internal_storage' => $internal_storage,
          ':brand' => $brand,
          ':material' => $material
        );
        $query1 = "UPDATE item_description SET
item_id=:item_id,
size=:size,
color=:color,
weight=:weight,
flavour=:flavour,
processor=:processor,
display=:display,
battery=:battery,
internal_storage=:internal_storage,
brand=:brand,
material=:material
WHERE item_description_id=:item_description_id
";
        $statement = $pdo->prepare($query1);
        $statement->execute($data);
      }
      if (isset($_POST['remove_data'])) {
        $it_id = $_POST['it_id'];
        $gt = $_POST['item_id'];
        $cat = $_POST['catid'];
        $sub = $_POST['subid'];
        $query = "DELETE FROM item_description WHERE item_description_id=$it_id";
        $st = $pdo->query($query);
        $query1 = "SELECT * from item_description where item_id=$gt";
        $st1 = $pdo->query($query1);
        $gn = $st1->rowCount();
        if ($gn == 0) {
          $query2 = "DELETE FROM item WHERE item_id=$gt";
          $st2 = $pdo->query($query2);
        }
        $filename = $_POST['imfinm'];
        if (file_exists($filename)) {
          unlink($filename);
        }
        $count = $_POST['count'];
        if ($count == 0) {
        } else {
          for ($i = 1; $i <= $count; $i++) {
            $filename = "../images/" . $cat . "/" . $sub . "/" . $it_id . "_" . $i . ".jpg";
            if (file_exists($filename)) {
              unlink($filename);
            }
          }
        }
      }
    }
    ?>
    <script type="text/javascript">
      function conca(i) {
        console.log('helo');
        if ($('#' + i + 'w1').val() != 0) {
          var v1 = $('#' + i + 'w1').val() + ' ' + $('#' + i + 'w2').val();
          $('#' + i + 'w3').val(v1);
        }
      }
      function showupda(x, y) {
        $('#' + x).on("submit", function (e) {
          var dataString = new FormData(this);
          if (y == 1) {
            dataString.append('update_data', '1');
          }
          else if (y == 0) {
            dataString.append('remove_data', '1');
          }
          $.ajax({
            type: "POST",
            url: "change.php",
            data: dataString,
            contentType: false,
            cache: false,
            processData: true,
            success: function () {
              $("#" + x).html("<div id='message'></div>");
              $("#message")
                .hide()
                .fadeIn(1500, function () {
                  $("#message").append(
                    "<div class='alert alert-success'>Product Updated \
                        <button onclick='location.reload()' style='background: green;padding: 5px;border: none;color: white;border-radius: 5px;height: 30px;display: block;margin: auto;'>Refresh</button></div>"
                  );
                });
            }
          });
          e.preventDefault();
        });
        return false;
      }
    </script>
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
    if (
      isset($_POST['pr_id']) || isset($_POST['im_url']) || isset($_POST['name']) ||
      isset($_POST['price']) || isset($_POST['description'])
    ) {
      require 'pdo.php';
      $pr = $_POST['pr_id'];
      $img = $_POST['im_url'];
      $itna = $_POST['name'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $it = $_POST['item_id'];
      ?>
      <div class="pr1">
        <div class="proupda ">
          <div class="newupdation">
            <span style="font-size: 16px;
    font-weight: bolder;
    color: #ffffff;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #9c27b0), color-stop(1, #741a84)) !important;
    position: relative;
    top: 0px;
    left: 0;
    text-align: center;
    padding: 10px;
    width: 100%;
    justify-content: center;
    display: flex;
    ">
              <h4 style="text-overflow: ellipsis;
    width: 400px;
    white-space: nowrap;
    overflow: hidden;
    "> <?= $itna ?></h4>
            </span><br>
            <form id="itemdesc">
              <div class="col-sm-12 imgdis" style="padding-top: 100px;
    position: relative;">
                <?php
                $query = "SELECT * FROM item  where item_id=$it ";
                $st = $pdo->query($query);
                while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="form-group" style="margin-bottom: 30px;">
                    <span class="floating-label">Price</span>
                    <input name="price"
                      onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                      style="    width: 100%;
    height: 40px;
    border-radius: 5px;
    outline: none;" value="<?= $row['price'] ?>">
                  </div>
                  <div class="form-group">
                    <span class="floating-label">Description</span>
                    <textarea name="description"><?= $row['description'] ?></textarea>
                  </div>
                  <input type="hidden" name="cid" value="<?= $row['item_id'] ?>">
                  <?php
                }
                ?>
                <button name="update_data" style="    font-weight: bold;
    float: right;
    background: #1336ff;
    margin-right: 12px;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    position: absolute;
    right: 0;
    top: 10px;" onclick="showupda('itemdesc',1)">
                  <i class="fa fa-pencil" style="margin-right: 20px;float: left;font-size: 24px"></i>Update</button>
              </div>
            </form>
            <div class="row">
              <?php
              $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item_description.item_id=$it ";
              $st = $pdo->query($query);
              while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-sm-12">
                  <div class="imgdis">
                    <form id="<?= $row['item_description_id'] ?>" method="post" name="<?= $row['item_description_id'] ?>">
                      <div class="prim col-sm-5">
                        <div class="thd">Product</div>
                        <div class="product" style="position: absolute;
    left: 10px;
    top: 55px;
    width: 100px;
    height: 100px;">
                          <img style=" display: inline-block;
  text-align: center;
  padding: 14px;
  position: relative;
    height: 100px;
    max-width: 100px;
   " onclick="$('#imr<?= $row['item_description_id'] ?>').attr('src', '../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg');"
                            src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                        </div>
                        <div style="    width: 100%;
    height: 280px;
    margin-top: 80px;">
                          <img id="imr<?= $row['item_description_id'] ?>"
                            src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                        </div>
                        <input type="hidden" name="imfinm"
                          value="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                        <input type="hidden" name="count" value="<?= $row['img_count'] ?>">
                        <input type="hidden" name="catid" value="<?= $row['category_id'] ?>">
                        <input type="hidden" name="subid" value="<?= $row['sub_category_id'] ?>">
                        <div class="imscr" id="imsrc<?= $row['item_description_id'] ?>"
                          onscroll="movefr('imsrc<?= $row['item_description_id'] ?>')">
                          <button type="button" name="lfarr" class="left-arrow"
                            onclick="moveleft('imsrc<?= $row['item_description_id'] ?>')"><i
                              class="fas fa-chevron-right"></i></button>
                          <button type="button" name="rfarr" class="right-arrow"
                            onclick="moveright('imsrc<?= $row['item_description_id'] ?>')" style="display: none;"><i
                              class="fas fa-chevron-left"></i></button>
                          <?php
                          $t = $row['img_count'];
                          for ($i = 1; $i <= $t; $i++) {
                            ?>
                            <div class="product">
                              <img style=" display: inline-block;
    text-align: center;
    padding: 14px;
    position: relative;
    height: 80px;
    max-width: 100px;
   " onclick="$('#imr<?= $row['item_description_id'] ?>').attr('src', '../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>_<?= $i ?>.jpg');"
                                src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>_<?= $i ?>.jpg">
                            </div>
                            <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="imdeta col-sm-7">
                        <div class="thd">Features</div>
                        <label class="checkbox">
                          <input class="form-control-check" type="checkbox"
                            onclick="$('#<?= $row['item_description_id'] ?>size').toggle();$('#<?= $row['item_description_id'] ?>size1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check1" value="size"><span>Size</span>
                          <?php
                          if ($row['size'] != 0) {
                            $query1 = "SELECT * FROM size where size_id=" . $row['size'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check1').prop('checked', true); $('#<?= $row['item_description_id'] ?>check1').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>size" class="form-control" name="size">
                                <option value="<?= $row1['size_id'] ?>"><?= $row1['size_name'] ?></option>
                                <?php
                                $cat = $pdo->query("select * from size");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['size_id'] ?>"><?= $row2['size_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>size" class="form-control"
                                style="display:none;width: 100%" name="size">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from size");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['size_id'] ?>"><?= $row2['size_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>color').toggle();$('#<?= $row['item_description_id'] ?>color1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check2" value="color"><span>Color</span>
                          <?php
                          if ($row['color'] != 0) {
                            $query1 = "SELECT * FROM color where color_id=" . $row['color'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check2').prop('checked', true); $('#<?= $row['item_description_id'] ?>check2').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>color" class="form-control" name="color">
                                <option style="background:<?= $row1['color_name'] ?>" value="<?= $row1['color_id'] ?>">
                                  <?= $row1['color_name'] ?>
                                </option>
                                <?php
                                $cat = $pdo->query("select * from color");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option style="background:<?= $row2['color_name'] ?>" value="<?= $row2['color_id'] ?>">
                                    <?= $row2['color_name'] ?>
                                  </option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>color" placeholder="color" class="form-control"
                                style="display:none;width: 100%" name="color">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from color");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['color_id'] ?>"><?= $row2['color_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>w1').toggle();$('#<?= $row['item_description_id'] ?>w2').toggle();$('#<?= $row['item_description_id'] ?>weight1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check3" value="weight"><span>Weight</span>
                          <?php
                          if ($row['weight'] != 0) {
                            $we = $row['weight'];
                            $we3 = explode(' ', $we);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check3').prop('checked', true); $('#<?= $row['item_description_id'] ?>check3').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <input type="number"
                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                class="form-control" style="width:70%;border-right:none;
        float:left;" id="<?= $row['item_description_id'] ?>w1" onkeyup="conca(<?= $row['item_description_id'] ?>)"
                                value="<?= $we3[0] ?>">
                              <select class="form-control" style="width:30%;float:left;color: white;background: #0B7383"
                                id="<?= $row['item_description_id'] ?>w2"
                                onchange="conca(<?= $row['item_description_id'] ?>)">
                                <option value="<?= $we3[1] ?>" selected><?= $we3[1] ?></option>
                                <option value="kg">kg</option>
                                <option value="g">g</option>
                                <option value="lt">lt</option>
                                <option value="ml">ml</option>
                              </select>
                              <input type="hidden" id="<?= $row['item_description_id'] ?>w3" name="weight">
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <input
                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                type="number" class="form-control" style="display:none;width:70%;border-right:none;
        float:left;" id="<?= $row['item_description_id'] ?>w1" onkeyup="conca(<?= $row['item_description_id'] ?>)">
                              <select class="form-control"
                                style="display:none;width:30%;float:left;color: white;background: #0B7383"
                                id="<?= $row['item_description_id'] ?>w2"
                                onchange="conca(<?= $row['item_description_id'] ?>)">
                                <option value="kg">kg</option>
                                <option value="g">g</option>
                                <option value="lt">lt</option>
                                <option value="ml">ml</option>
                              </select>
                              <input type="hidden" id="<?= $row['item_description_id'] ?>w3" name="weight">
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>flavour').toggle();$('#<?= $row['item_description_id'] ?>flavour1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check4" value="flavour"><span>Flavour</span>
                          <?php
                          if ($row['flavour'] != 0) {
                            $query1 = "SELECT * FROM flavour where flavour_id=" . $row['flavour'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check4').prop('checked', true); $('#<?= $row['item_description_id'] ?>check4').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>flavour" class="form-control" name="flavour">
                                <option value="<?= $row1['flavour_id'] ?>"><?= $row1['flavour_name'] ?></option>
                                <?php
                                $cat = $pdo->query("select * from flavour");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['flavour_id'] ?>"><?= $row2['flavour_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>flavour" class="form-control"
                                style="display:none;width: 100%" name="flavour">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from flavour");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['flavour_id'] ?>"><?= $row2['flavour_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>processor').toggle();$('#<?= $row['item_description_id'] ?>processor1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check5"
                            value="processor"><span>Processor</span>
                          <?php
                          if ($row['processor'] != 0) {
                            $query1 = "SELECT * FROM processor where processor_id=" . $row['processor'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check5').prop('checked', true); $('#<?= $row['item_description_id'] ?>check5').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>processor" class="form-control" name="processor">
                                <option value="<?= $row1['processor_id'] ?>"><?= $row1['processor_name'] ?></option>
                                <?php
                                $cat = $pdo->query("select * from processor");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['processor_id'] ?>"><?= $row2['processor_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>processor" placeholder="processor"
                                class="form-control" style="display:none;width: 100%" name="processor">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from processor");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['processor_id'] ?>"><?= $row2['processor_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>disp').toggle();$('#<?= $row['item_description_id'] ?>disp1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check6" value="display"><span>Display</span>
                          <?php
                          if ($row['display'] != 0) {
                            $query1 = "SELECT * FROM display where display_id=" . $row['display'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check6').prop('checked', true); $('#<?= $row['item_description_id'] ?>check6').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>disp" class="form-control" name="display">
                                <option value="<?= $row1['display_id'] ?>"><?= $row1['display_name'] ?></option>
                                <?php
                                $cat = $pdo->query("select * from display");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['display_id'] ?>"><?= $row2['display_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>disp" placeholder="display" class="form-control"
                                style="display:none;width: 100%" name="display">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from display");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['display_id'] ?>"><?= $row2['display_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>battery').toggle();$('#<?= $row['item_description_id'] ?>battery1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check7" value="battery"><span>Battery</span>
                          <?php
                          if ($row['battery'] != 0) {
                            $query1 = "SELECT * FROM battery where battery_id=" . $row['battery'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check7').prop('checked', true); $('#<?= $row['item_description_id'] ?>check7').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>battery" class="form-control" name="battery">
                                <option value="<?= $row1['battery_id'] ?>"><?= $row1['battery_name'] ?></option>
                                <?php
                                $cat = $pdo->query("select * from battery");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['battery_id'] ?>"><?= $row2['battery_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>battery" placeholder="battery"
                                class="form-control" style="display:none;width: 100%" name="battery">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from battery");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['battery_id'] ?>"><?= $row2['battery_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>internal_storage').toggle();$('#<?= $row['item_description_id'] ?>internal_storage1').toggle()"
                            id="<?= $row['item_description_id'] ?>check8" name="check1"
                            value="internal_storage"><span>Internal storage</span>
                          <?php
                          if ($row['internal_storage'] != 0) {
                            $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row['internal_storage'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check8').prop('checked', true); $('#<?= $row['item_description_id'] ?>check8').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>internal_storage" class="form-control"
                                name="internal_storage">
                                <option value="<?= $row1['internal_storage_id'] ?>"><?= $row1['internal_storage_name'] ?>
                                </option>
                                <?php
                                $cat = $pdo->query("select * from internal_storage");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['internal_storage_id'] ?>"><?= $row2['internal_storage_name'] ?>
                                  </option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>internal_storage" placeholder="internal_storage"
                                class="form-control" style="display:none;width: 100%" name="internal_storage">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from internal_storage");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['internal_storage_id'] ?>"><?= $row2['internal_storage_name'] ?>
                                  </option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>brand').toggle();$('#<?= $row['item_description_id'] ?>brand1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check9" value="brand"><span>Brand</span>
                          <?php
                          if ($row['brand'] != 0) {
                            $query1 = "SELECT * FROM brand where brand_id=" . $row['brand'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check9').prop('checked', true); $('#<?= $row['item_description_id'] ?>check9').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <span id="<?= $row['item_description_id'] ?>brand" class="floating-label"
                                id="<?= $row['item_description_id'] ?>brand1">Brand</span>
                              <select class="form-control" name="brand">
                                <option value="<?= $row1['brand_id'] ?>"><?= $row1['brand_name'] ?></option>
                                <?php
                                $cat = $pdo->query("select * from brand where category_id=" . $row['category_id']);
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['brand_id'] ?>"><?= $row2['brand_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>brand" placeholder="brand" class="form-control"
                                style="display:none;width: 100%" name="brand">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from brand where category_id=" . $row['category_id']);
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['brand_id'] ?>"><?= $row2['brand_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" class="form-control-check"
                            onclick="$('#<?= $row['item_description_id'] ?>material').toggle();$('#<?= $row['item_description_id'] ?>material1').toggle()"
                            name="check1" id="<?= $row['item_description_id'] ?>check10"
                            value="material"><span>Material</span>
                          <?php
                          if ($row['material'] != 0) {
                            $query1 = "SELECT * FROM material where material_id=" . $row['material'];
                            $st1 = $pdo->query($query1);
                            $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <script type="text/javascript">$('#<?= $row['item_description_id'] ?>check10').prop('checked', true); $('#<?= $row['item_description_id'] ?>check10').attr('disabled', true);
                            </script>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>material" class="form-control" name="material">
                                <option value="<?= $row1['material_id'] ?>"><?= $row1['material_name'] ?></option>
                                <?php
                                $cat = $pdo->query("select * from material");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['material_id'] ?>"><?= $row2['material_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          } else {
                            ?>
                            <div class="form-group">
                              <select id="<?= $row['item_description_id'] ?>material" placeholder="material"
                                class="form-control" style="display:none;width: 100%" name="material">
                                <option value="">Select...</option>
                                <?php
                                $cat = $pdo->query("select * from material");
                                while ($row2 = $cat->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                  <option value="<?= $row2['material_id'] ?>"><?= $row2['material_name'] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                            <?php
                          }
                          ?>
                        </label>
                        <input type="hidden" name="it_id" value="<?= $row['item_description_id'] ?>">
                        <input type="hidden" name="item_id" value="<?= $it ?>">
                      </div>
                      <div class="col-sm-12 subb" style="position: absolute;
    bottom: 100px;
    left: 0;
    padding: 0;">
                        <input type="hidden" name="check_id" value="<?= $row['item_description_id'] ?>">
                        <button name="update_data" style="font-weight: bold;
    float: right;
    background: green;
    margin-right: 12px;" onclick="showupda(<?= $row['item_description_id'] ?>,1)"><i class="fas fa-pen-alt"
                            style="margin-right: 20px;float: left;font-size: 24px"></i>Update</button>
                        <button name="remove_data" style="font-weight: bold;
    float: right;
    background: red;
    margin-right: 5px;" onclick="showupda(<?= $row['item_description_id'] ?>,0)"><i class="fas fa-trash"
                            style="margin-right: 20px;float: left;font-size: 24px"></i>Remove</button>
                      </div>
                    </form>
                  </div>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
    <?php
    require "foot.php";
    ?>