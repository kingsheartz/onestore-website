<?php
require "head.php";
?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
if (!empty($_SESSION['_contact_form_error'])) {
  $error = $_SESSION['_contact_form_error'];
  unset($_SESSION['_contact_form_error']);
}
if (!empty($_SESSION['_contact_form_success'])) {
  $success = true;
  unset($_SESSION['_contact_form_success']);
}
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
        padding-bottom: 80px;
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
        justify-content: center;
        height: auto;
        width: 40%;
        margin-left: 5px;
        margin-top: 5px;
        background: white;
        text-align: center;
        float: left;
        padding: 50px;
      }

      .imdeta {
        padding-top: 50px;
        width: 100%;
      }

      table,
      tr {
        width: 100%;
        text-align: center;
        vertical-align: middle;
      }

      th,
      td {
        min-height: 200px;
        position: relative;
        padding-top: 50px;
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

      .form-group {
        position: relative;
        width: 45%;
        float: left;
        margin: auto;
        display: block;
        margin-left: 2%;
        margin-top: 20px;
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

      #imgdiv {
        display: block;
        margin: auto;
        text-align: center;
      }

      .image-upload {
        background: white;
        display: inline-block;
        margin: 20px;
        border: 1px dashed #9a9a9a;
      }

      .thd {
        border: 1px solid #fff;
        font-size: 16px;
        color: white;
        padding: 5px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #353433), color-stop(1, #484746)) !important;
        font-weight: normal;
        text-align: center;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }

      @media (min-width:768px) {
        .ttd {
          width: 200px;
        }
      }

      @media (max-width:768px) {

        th,
        td {
          width: 100%;
          display: block;
        }

        .rwtd {
          display: inline-block;
        }
      }
    </style>
    <?php
    require "pdo.php";
    ?>
    <script type="text/javascript">
      function showupda(x) {
        /*$( '#'+x ).on( "submit", function(e) {
              //stop submit the form, we will post it manually.
            e.preventDefault();
            // Get form
            var form = $('#'+x)[0];
            // Create an FormData object
            var data = new FormData(form);
            // If you want to add an extra field for the FormData
           // data.append("CustomField", "This is some extra data, testing");
            // disabled the submit button
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "productuplo.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    //console.log("SUCCESS");
                    //$("#btnSubmit").prop("disabled", false);
                },
                error: function (e) {
                    //console.log("ERROR : ", e);
                    //$("#btnSubmit").prop("disabled", false);
                }
            });
        });*/
        document.forms[x].submit();
      }
      function previewFile(inp, i, x) {
        var file = $('' + inp).get(0).files[0];
        if (file) {
          var reader = new FileReader();
          reader.onload = function () {
            $("#" + x + "previewImg" + i).attr("src", reader.result);
          }
          reader.readAsDataURL(file);
        }
      }
      function ImageExist(url) {
        result = false;
        $.ajaxSetup({ async: false });
        $.get(url)
          .done(function () {
            result = true;
          })
          .fail(function () {
            result = false;
          })
        $.ajaxSetup({ async: true });
        return (result);
        /*var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
           if (this.readyState === this.DONE) {
               if (xhr.status === 200) {
                   console.log('file exist');
               } else {
                   return false;
               }
           }
       }
        xhr.error = function() {
                            return false;
        }
        xhr.onabort = function() {
                            return false;
        }
        xhr.timeout = function() {
                            return false;
        }
         xhr.timeout = 5000;
       xhr.open('HEAD', url, true);
       xhr.send(null);
       if (xhr.status == "404") {
           console.log("File doesn't exist");
           return false;
       } else {
           console.log("File exists");
           return true;
       }*/
      }
      function upimg(cn, x) {
        cn = cn + 1;
        for (var i = cn; i <= 10; i++) {
          $(".image-upload:has('#" + x + "file-input" + i + "')").remove();
        }
        var n = $('#nj' + x).val();
        for (var i = cn; i <= n; i++) {
          $('#imgdiv' + x).append('<div class="image-upload">  \
        <label for="'+ x + 'file-input' + i + '" style="width: 100%; cursor: pointer;"><center>\
        <img id="'+ x + 'previewImg' + i + '" src="images/upload2.png" style="max-width: 150px;max-height: 150px;height: auto;width: auto;"> </center>      </label>      <input id="' + x + 'file-input' + i + '" required type="file" name="my_file' + i + '" onchange="previewFile(\'#' + x + 'file-input' + i + '\',' + i + ',' + x + ');" style="display: none; cursor: pointer;">    </div>');
          /* url="../images/"+cat+"/"+sub+"/"+it+"_"+i+".jpg";
         st=ImageExist(url) ;
         console.log(st);
            if(st){
              console.log('helo')
                $("#previewImg"+i).attr("src", url);
            }else {
                    console.log('hi')
                 $("#previewImg"+i).attr("src", 'images/upload2.png');
            }
        */
        }
      }
      function numplusone(cn, x) {
        var n = parseInt($('#nj' + x).val());
        console.log(n);
        if ($('#nj' + x).val() == '') {
          n = cn;
        }
        b = n + 1;
        if (b > 10) {
          return;
        }
        console.log(b);
        $('#nj' + x).val('');
        $('#nj' + x).val(b);
        upimg(cn, x);
      }
      function numminone(cn, x) {
        var n = parseInt($('#nj' + x).val());
        if (n < 1) {
          return;
        }
        b = n - 1;
        if (b < cn) {
          return;
        }
        $('#nj' + x).val('');
        $('#nj' + x).val(b);
        upimg(cn, x);
      }
    </script>
    <?php
    if (!empty($success)) {
      ?>
      <div class="alert alert-success">Images Added Successfully!</div>
      <a href="view.php"><button style="background: green;color: white;
    border: none;
    height: 40px;
    padding: 10px;
    width: 200px;
    border-radius: 5px;
    font-weight: bolder;">Go back</button></a>
      <?php
    }
    ?>
    <?php
    if (!empty($error)) {
      ?>
      <div class="alert alert-danger"><?= $error ?></div>
      <a href="view.php"><button style="background: red;color: white;
    border: none;
    height: 40px;
    padding: 10px;
    width: 200px;
    border-radius: 5px;
    font-weight: bolder;">Go back</button></a>
      <?php
    }
    ?>
    <?php
    if (
      isset($_POST['uppr_id']) || isset($_POST['upim_url']) || isset($_POST['upname']) ||
      isset($_POST['upprice']) || isset($_POST['updescription'])
    ) {
      require 'pdo.php';
      $pr = $_POST['uppr_id'];
      $img = $_POST['upim_url'];
      $itna = $_POST['upname'];
      $description = $_POST['updescription'];
      $price = $_POST['upprice'];
      $it = $_POST['upitem_id'];
      ?>
      <div class="pr1">
        <div class="proupda ">
          <div class="newupdation">
            <span style="font-size: 16px;
    font-weight: bolder;
    color: #ffffff;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ffc107), color-stop(1, #ff9800)) !important;    position: relative;
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
            <div class="row">
              <?php
              $query = "SELECT * FROM item JOIN item_description ON item.item_id=item_description.item_id where item_description.item_id=$it ";
              $st = $pdo->query($query);
              while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-sm-12" style="padding: 20px;">
                  <div class="imgdis">
                    <form id="<?= $row['item_description_id'] ?>" target='ifr<?= $row['item_description_id'] ?>'
                      method="post" name="<?= $row['item_description_id'] ?>" action="prosub.php"
                      enctype="multipart/form-data">
                      <table>
                        <tr>
                          <th class="ttd">
                            <div class="thd ">Product</div>
                            <div class="prim col-sm-12">
                              <img
                                src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                            </div>
                          </th>
                          <?php
                          $itcn = $row['img_count'];
                          if ($itcn == NULL) {
                            $itcn = 0;
                            $k = 48;
                          } else {
                            $k = 48 + $itcn;
                          }
                          ?>
                          <td rowspan=2 class="rwtd">
                            <div class="thd">Upload Images</div>
                            <div class="col-sm-12">
                              <div id="imgdiv<?= $row['item_description_id'] ?>">
                                <?php
                                $ico = $itcn;
                                if ($itcn > 0) {
                                  for ($i = 1; $i <= $ico; $i++) {
                                    ?>
                                    <div class="image-upload">
                                      <label for="<?= $row['item_description_id'] ?>file-input<?= $i ?>"
                                        style="width: 100%; cursor: pointer;">
                                        <center>
                                          <img id="<?= $row['item_description_id'] ?>previewImg<?= $i ?>"
                                            src="../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>_<?= $i ?>.jpg"
                                            style="max-width: 150px;max-height: 150px;height: auto;width: auto;">
                                        </center>
                                      </label>
                                      <input id="<?= $row['item_description_id'] ?>file-input<?= $i ?>" type="file"
                                        name="my_file<?= $i ?>"
                                        onchange="previewFile('#<?= $row['item_description_id'] ?>file-input<?= $i ?>',<?= $i ?>,<?= $row['item_description_id'] ?>);"
                                        style="display: none; cursor: pointer;">
                                    </div>
                                    <?php
                                  }
                                }
                                ?>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="ttd">
                            <div class="thd ">Number of Images</div>
                            <div class="imdeta col-sm-12">
                              <input type="number" maxlength="10" required="" class="form-control" name="nj"
                                style="height: 30px;"
                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= <?= $k ?> && event.charCode <= 57"
                                id="nj<?= $row['item_description_id'] ?>">
                              <div style="display: flex;width:100%;margin-top: 20px;">
                                <button name="newim" type="button" style="
  background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #151414), color-stop(1, #1d1d1d)) !important;
    color: white;
    border: none;
    border-radius: 5px;
    height: 30px;
    width: 100%;" onclick="upimg(<?= $itcn ?>,<?= $row['item_description_id'] ?>)">OK</button>
                                <button class="addim" type="button" style="width: 100%;
    height: 30px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ff0000), color-stop(1, #d00303)) !important;
    border: none;
    color: white;
    font-size: 16px;
    padding: 2px;
    border-radius: 5px;" name="numi" onclick="numplusone(<?= $itcn ?>,<?= $row['item_description_id'] ?>)"><i
                                    class="fas fa-plus"></i></button>
                                <button class="subim" type="button" style="width: 100%;
    height: 30px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4caf50), color-stop(1, #08c310)) !important;
    border: none;
    color: white;
    font-size: 16px;
    padding: 2px;
    border-radius: 5px;" name="numk" onclick="numminone(<?= $itcn ?>,<?= $row['item_description_id'] ?>)"><i
                                    class="fas fa-minus"></i></button>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <input type="hidden" name="cat" value="<?= $row['category_id'] ?>">
                        <input type="hidden" name="sub" value="<?= $row['sub_category_id'] ?>">
                        <input type="hidden" name="desc_id" value="<?= $row['item_description_id'] ?>">
                        <div class="col-sm-12" style="position: absolute;
    bottom: 0;"><button id="btnSubmit" onclick="showupda(<?= $row['item_description_id'] ?>)" name="upload_image"
                            style="width: 100%;
    padding: 5px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #2196f4), color-stop(1, #1965a2)) !important;
    border: none;
    color: white;
    font-weight: bolder;
    position: absolute;
    bottom: 0;
    left: 0;"><i class="fas fa-upload" style="font-size: 24px;float: left;"></i>Upload</button></div>
                      </table>
                    </form>
                  </div>
                </div>
                <iframe name='ifr<?= $row['item_description_id'] ?>' id="ifr<?= $row['item_description_id'] ?>"
                  style='display: none;'></iframe>
                <script>
                  var iframe = document.getElementById("ifr<?= $row['item_description_id'] ?>");
                  iframe.onload = function () {
                    var bodycontent = iframe.contentDocument.body.innerHTML;
                    console.log(bodycontent);
                    // processing content acquired;
                  }
                </script>
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