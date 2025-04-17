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

  .immodal img {
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

  .immodal img:hover {
    transform: scale(1.5);
    /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  }

  .immodal {
    position: relative;
    height: auto;
    min-height: 300px;
    overflow: auto;
    background: white;
    color: #000;
    overflow-x: hidden;
    border-bottom: 1px solid #e6e6e6;
  }

  .immodal .prim {
    position: relative;
    justify-content: center;
    height: auto;
    background: white;
    text-align: center;
    float: left;
    padding-top: 100px;
  }

  .immodal .imdeta .col-sm-12 {
    position: relative;
    float: left;
    padding-top: 50px;
    margin: auto;
    display: block;
    font-size: 16px;
  }

  .price {
    font-size: 20px;
    color: green;
  }

  .immodal .imdeta {
    padding: 0;
    padding-left: 50px;
    padding-right: 50px;
    font-family: Roboto;
    height: 500px;
    overflow: overlay;
  }

  .immodal table,
  tr {
    width: 100%;
    text-align: center;
    vertical-align: middle;
  }

  .immodal th,
  td {
    width: 50%;
    text-align: left;
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
    width: 100%;
    float: left;
    margin: auto;
    display: block;
    margin-bottom: 30px;
    margin-top: 30px;
  }

  .immodal .newupdation {
    border-radius: 5px;
    background: #ffff;
    width: 100%;
    height: auto;
    overflow: auto;
    padding: 20px;
    box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);
  }

  .immodal #message {
    padding: 20px;
    margin: auto;
    display: block;
  }

  .immodal .subb button {
    width: 50%;
    height: 40px;
    border: none;
    color: #fff;
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

  .immodal .checkbox {
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

  .immodal .product {
    display: inline-block;
    text-align: center;
    padding: 5px;
    position: relative;
    height: 100px;
    width: 150px;
    border: 1px solid #dadada;
  }

  .modal-footer .btn+.btn {
    margin-bottom: 0;
    margin-left: 5px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0300a6), color-stop(1, #29015d)) !important;
  }

  .immodal .imscr {
    height: 150px;
    overflow: auto;
    width: 400px;
    margin: auto;
    display: block;
    white-space: nowrap;
    bottom: 0;
    margin-top: 50px;
  }

  .immodal .thd {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    color: white;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #656463), color-stop(1, #757473)) !important;
    padding: 5px;
    border: 1px solid white;
  }

  .imscr::-webkit-scrollbar {
    display: none;
  }

  h1 {
    color: red;
    text-align: center;
    border-bottom: 1px solid #bdbdbd;
    padding: 20px;
  }

  .imdeta::-webkit-scrollbar {
    width: 5px;
    height: 6px;
  }

  .imdeta::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgb(65, 65, 65);
  }

  .imdeta::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 30%);
    border-radius: 10px;
  }
</style>
<?php
require "pdo.php";
if (isset($_POST['item_description_id'])) {
  $x = $_POST['item_description_id'];
  $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id
  where item_description.item_description_id=$x";
  $st = $pdo->query($query);
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="col-sm-12">
      <div class="immodal">
        <form id="<?= $row['item_description_id'] ?>" method="post" name="<?= $row['item_description_id'] ?>">
          <div class="prim col-sm-5">
            <div class="product" style="position: absolute;
    left: 5px;
    top: 35px;
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
            <div style="width: 100%;">
              <img id="imr<?= $row['item_description_id'] ?>"
                src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
            </div>
            <div class="imscr" id="imsrc<?= $row['item_description_id'] ?>"
              onscroll="movefr('imsrc<?= $row['item_description_id'] ?>')">
              <button type="button" style=" position: absolute;
   top: 75%;
    right: 0;
    z-index: 1;
    height: 40px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    border: 1px solid #d4d4d4;" name="lfarr" class="left-arrow"
                onclick="moveleft('imsrc<?= $row['item_description_id'] ?>')"><i class="fas fa-chevron-right"></i></button>
              <button type="button" style=" position: absolute;
   top: 75%;
    left: 0;
    z-index: 1;
    height: 40px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border: 1px solid #d4d4d4;" name="rfarr" class="right-arrow"
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
    height: 100px;
    max-width: 150px;
   " onclick="$('#imr<?= $row['item_description_id'] ?>').attr('src', '../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>_<?= $i ?>.jpg');"
                    src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>_<?= $i ?>.jpg">
                </div>
                <?php
              }
              ?>
            </div>
          </div>
          <div class="imdeta col-sm-7">
            <h1><?= $row['item_name'] ?></h1>
            <div class="col-sm-12">
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
              <ul>
                <?php
                $cats = explode("\n", $row['description']);
                foreach ($cats as $cat) {
                  ?>
                  <li> <?= $cat ?></li>
                  <?php
                }
                ?>
              </ul>
              <br><br>
              <div class="price">
                Price <span style="
    margin-left: 50px;
    font-size: 24px;
"><i class="fas fa-rupee"></i>     <?= $row['price'] ?></span></div>
            </div>
          </div>
      </div>
    </div>
    <?php
  }
}
?>
<div class="clear-fix" style="clear:both"></div>