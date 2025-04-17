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
        margin: auto;
        display: block;
        padding: 0;
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
        margin-top: 30px;
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
        font-size: 12px;
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
        bottom: 17%;
        right: 0;
        z-index: 1;
        height: 40px;
        background: transparent;
        border: none;
        font-size: 24px;
      }

      .right-arrow {
        position: absolute;
        bottom: 17%;
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

      .imdeta .col-sm-12 {
        padding-top: 70px;
        min-height: 150px;
      }
    </style>
    <?php
    require "pdo.php";
    if (isset($_POST['check_id'])) {
      if (isset($_POST['update_data'])) {
        $it_id = $_POST['check_id'];
        $gt = $_POST['item_id'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $pref = $_POST['pref'];
        $data = array(
          ':price' => $price,
          ':quantity' => $quantity,
          ':pref' => $pref
        );
        $query1 = "UPDATE product_details SET
price=:price,
quantity=:quantity,order_preference=:pref WHERE product_details_id=$it_id";
        $statement = $pdo->prepare($query1);
        $statement->execute($data);
      }
      if (isset($_POST['remove_data'])) {
        $it_id = $_POST['check_id'];
        $gt = $_POST['item_id'];
        $query = "DELETE FROM product_details WHERE product_details_id=$it_id";
        $st = $pdo->query($query);
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
            processData: false,
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
        $('#' + x).scrollLeft(y + 50);
        $('#' + x + '>.right-arrow').show();
      }
      function moveright(x) {
        var y = $('#' + x).scrollLeft();
        $('#' + x + '>.left-arrow').show();
        if (y === 0) {
          $('#' + x + '>.right-arrow').hide();
        }
        $('#' + x).scrollLeft(y - 50);
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
            <span style="font-size: 14px;
    font-weight: bolder;
    color: #ffffff;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0082bd), color-stop(1, #326086)) !important;
    position: relative;
    top: 0px;
    left: 0;
    text-align: center;
    padding: 5px;
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
            <div class="row">
              <?php
              $id = $_SESSION['id'];
              $query = "SELECT * FROM item  JOIN item_description ON item.item_id=item_description.item_id JOIN product_details ON product_details.item_description_id=item_description.item_description_id where item_description.item_id=$it and product_details.store_id=$id";
              $st = $pdo->query($query);
              $tr = $st->rowCount();
              if ($tr == 0) {
                ?>
                <div class="alert alert-danger">item not yet added</div>
                <button
                  style="background: red;padding: 10px;color: white;border-radius: 5px;border:none;font-weight: bolder;"
                  onclick="location.href='additem.php'">Go To Add Product</button>
                <?php
              } else {
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
    height: 80px;">
                            <img style=" display: inline-block;
    text-align: center;
    padding: 14px;
    position: relative;
    height: 80px;
    max-width: 100px;
   " onclick="$('#imr<?= $row['item_description_id'] ?>').attr('src', '../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg');"
                              src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                          </div>
                          <div style="width: 100%;">
                            <img id="imr<?= $row['item_description_id'] ?>"
                              src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                          </div>
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
                          <div class="col-sm-12">
                            <input type="hidden" name="it_id" value="<?= $pr ?>">
                            <input type="hidden" name="item_id" value="<?= $it ?>">
                            <div class="thd">Features</div>
                            <table>
                              <?php
                              if ($row['size'] != 0) {
                                $query1 = "SELECT * FROM size where size_id=" . $row['size'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Size</th>
                                  <td> <?= $row1['size_name'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['color'] != 0) {
                                $query1 = "SELECT * FROM color where color_id=" . $row['color'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Color</th>
                                  <td><?= $row['color'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['weight'] != 0) {
                                ?>
                                <tr>
                                  <th>Weight</th>
                                  <td><?= $row['weight'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['flavour'] != 0) {
                                $query1 = "SELECT * FROM flavour where flavour_id=" . $row['flavour'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Flavour</th>
                                  <td><?= $row1['flavour_name'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['processor'] != 0) {
                                $query1 = "SELECT * FROM processor where processor_id=" . $row['processor'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Processor</th>
                                  <td><?= $row1['processor_name'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['display'] != 0) {
                                $query1 = "SELECT * FROM display where display_id=" . $row['display'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Display</th>
                                  <td><?= $row1['display_name'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['battery'] != 0) {
                                $query1 = "SELECT * FROM battery where battery_id=" . $row['battery'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Battery</th>
                                  <td><?= $row1['battery_name'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['internal_storage'] != 0) {
                                $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row['internal_storage'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Internal Storage</th>
                                  <td><?= $row1['internal_storage_name'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['brand'] != 0) {
                                $query1 = "SELECT * FROM brand where brand_id=" . $row['brand'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Brand</th>
                                  <td><?= $row1['brand_name'] ?></td>
                                </tr>
                                <?php
                              }
                              if ($row['material'] != 0) {
                                $query1 = "SELECT * FROM material where material_id=" . $row['material'];
                                $st1 = $pdo->query($query1);
                                $row1 = $st1->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <th>Material</th>
                                  <td><?= $row1['material_name'] ?></td>
                                </tr>
                                <?php
                              }
                              ?>
                            </table>
                          </div>
                          <div class="col-sm-12">
                            <div class="thd">Product Details</div>
                            <div class="form-group">
                              <label class="floating-label">Price</label>
                              <input type="number" name="price"
                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                value="<?= $row['price'] ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="floating-label">Quantity</label>
                              <input type="number" name="quantity"
                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                required="" value="<?= $row['quantity'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="floating-label">Order Preference</label>
                              <select name="pref" required="" class="form-control">
                                <option value="<?php if ($row['order_preference'] != 0) {
                                  echo $row['order_preference'];
                                } ?>">
                                  <?php
                                  if ($row['order_preference'] == 1) {
                                    echo 'Booking';
                                  }
                                  if ($row['order_preference'] == 2) {
                                    echo 'Delivery';
                                  }
                                  if ($row['order_preference'] == 3) {
                                    echo 'Both';
                                  } else {
                                    echo '';
                                  }
                                  ?>
                                </option>
                                <option value="1">Booking</option>
                                <option value="2">Delivery</option>
                                <option value="3">Both</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12 subb" style="position: absolute;bottom: 0;padding: 0">
                          <input type="hidden" name="check_id" value="<?= $row['product_details_id'] ?>">
                          <button name="update_data" style="float: right;
    background: green;
    margin-left: 12px;
    margin-right: 12px;
" onclick="showupda(<?= $row['item_description_id'] ?>,1)">
                            <i class="fas fa-pencil-square"
                              style="margin-right: 20px;float: left;font-size: 24px"></i>Update</button>
                          <button name="remove_data" style="float: right;
    background: #fd0018;
    margin-left: 12px;
    margin-right: 12px;" onclick="showupda(<?= $row['item_description_id'] ?>,0)"><i class="fas fa-trash"
                              style="margin-right: 20px;float: left;font-size: 24px"></i>Remove</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <?php
                }
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