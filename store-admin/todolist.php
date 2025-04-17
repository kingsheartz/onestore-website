<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* Include the padding and border in an element's total width and height */
    * {
      box-sizing: border-box;
    }

    /* Remove margins and padding from the list */
    #myUL {
      margin: 0;
      padding: 0;
    }

    /* Style the list items */
    #myUL li {
      color: black;
      cursor: pointer;
      position: relative;
      padding: 12px 8px 12px 40px;
      list-style-type: none;
      transition: 0.2s;
      /* make the list items unselectable */
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Set all odd list items to a different color (zebra-stripes) */
    #myUL li:nth-child(odd) {
      background: #f9f9f9;
    }

    /* Darker background-color on hover */
    #myUL li:hover {
      background: #e0e0e0;
      color: #020202;
    }

    /* When clicked on, add a background color and strike out text */
    #myUL li.checked {
      background: #888;
      color: #fff;
      text-decoration: line-through;
    }

    /* Add a "checked" mark when clicked on */
    #myUL li.checked::before {
      content: '';
      position: absolute;
      border-color: #fff;
      border-style: solid;
      border-width: 0 2px 2px 0;
      top: 10px;
      left: 16px;
      transform: rotate(45deg);
      height: 15px;
      width: 7px;
    }

    /* Style the close button */
    .close {
      position: absolute;
      right: 0;
      top: 0;
      padding: 12px 16px 12px 16px;
      height: 100%;
    }

    .close:hover {
      background: red;
      color: white;
    }

    /* Style the header1 */
    .header1 {
      background-color: rgb(97 97 97);
      ;
      color: white;
      text-align: center;
    }

    /* Clear floats after the header1 */
    .header1:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Style the input */
    #myDIV input {
      color: black;
      margin: 0;
      border: none;
      border-radius: 0;
      width: 75%;
      height: 40px;
      padding: 10px;
      float: left;
      font-size: 16px;
      outline: none;
    }

    /* Style the "Add" button */
    .addBtn {
      border: none;
      padding: 10px;
      width: 25%;
      background: black;
      float: left;
      text-align: center;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
      border-radius: 0;
      height: 40px;
    }

    .handle {
      position: relative;
      left: -25px;
    }

    input[type=checkbox],
    input[type=radio] {
      margin: 4px 0 0;
      margin-top: 1px\9;
      line-height: normal;
      width: 20px;
      height: 20px;
    }

    span.nday {
      color: white;
      padding: 1px;
      width: 80px;
      font-size: 12px;
      border-radius: 5px;
      margin-left: 15px;
      font-weight: bold;
    }
  </style>
</head>

<body style="box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);">
  <script type="text/javascript">
    function updatelement(x, y) {
      var selected_option_value = x;
      var nw = y;
      if (selected_option_value) {
        $.ajax({
          type: 'POST',
          url: 'delto.php',
          data: { up_id: selected_option_value, up_tit: nw },
          success: function (data) {
            console.log(data);
            location.reload();
          }
        });
      } else {
        console.log('not submitt');
      }
    }
    function postelement(x) {
      var selected_option_value = x;
      if (selected_option_value) {
        $.ajax({
          type: 'POST',
          url: 'delto.php',
          data: 'dl_id=' + selected_option_value,
          success: function (data) {
            console.log(data);
            $('#myUL').load(location.href + " #myUL >");
          }
        });
      } else {
        console.log('not submitt');
      }
    }
    function addline() {
      var selected_option_value = document.getElementById('myInput').value;
      if (selected_option_value) {
        $.ajax({
          type: 'POST',
          url: 'delto.php',
          data: 'addnm=' + selected_option_value,
          success: function (data) {
            console.log(data);
            $('#myUL').load(location.href + " #myUL >");
          }
        });
      } else {
        console.log('not submitt');
      }
    }
  </script>
  <?php
  ?>
  <ul id="myUL">
    <?php
    $colors = array("red", "green", "#7d7d7d", "black", "#000c96", "dodgerblue", "#ff9800");
    $stmt = $pdo->query(
      "select  * from to_do_list_store where store_id=" . $_SESSION['id']
    );
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <li><span class="handle"><i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i>
          <input type="checkbox" id="<?= $row['list_id'] ?>"
            onclick="updatelement(<?= $row['list_id'] ?>,'<?= $row['title'] ?>')"></span>
        <?= $row['title'] ?><span class="nday" style="background:<?= $colors[array_rand($colors)] ?>;"><i style="padding-right: 4px;
  padding-left: 4px;" class="fas fa-clock"></i>
          <?php
          $start = strtotime($row['add_date']);
          $end = strtotime(date("Y/m/d"));
          $days_between = ceil(abs($end - $start) / 86400);
          if ($days_between == 0) {
            echo "Today";
          } else {
            echo $days_between . " days";
          }
          ?>
        </span><span class="close" onclick="postelement(<?= $row['list_id'] ?>)"><i class="fa fa-times"></i></span></li>
      <?php
      $r = explode('<strike>', $row['title']);
      if (isset($r[1])) {
        echo '<script>$("#' . $row['list_id'] . '").prop("checked", true);$("#' . $row['list_id'] . '").attr("disabled",true)</script>';
      }
      ?>
      <?php
    }
    ?>
  </ul>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
    // Create a "close" button and append it to each list item
    // Click on a close button to hide the current list items
  </script>
  <li class="list-group-item"
    style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00c0ef), color-stop(1, #01728e)) !important;">
    <div id="myDIV" class="header1">
      <form method="post" id="tofrm">
        <input type="text" id="myInput" name="addnm" placeholder="Title...">
        <button type="submit" onclick="addline()" id="addBtn" class="addBtn btn btn-primary">Add</button>
      </form>
    </div>
  </li>