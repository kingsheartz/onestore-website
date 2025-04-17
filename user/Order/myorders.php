<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location:../Main/onestore.php");
}
require "../Main/header.php";
require "../Common/pdo.php";
?>
<!-- breadcrumbs -->
<style type="text/css">
  .table1 {
    background: #eee;
  }

  .order {
    position: relative;
    height: auto;
    overflow: hidden;
    margin-top: 30px;
    margin-bottom: 30px;
    text-overflow: ellipsis;
    box-shadow: -2px -2px 3px 3px #ddd;
    border-radius: 10px;
    background: #fff;
  }

  .order-single {
    position: relative;
    height: auto;
    overflow: hidden;
    margin-top: 30px;
    margin-bottom: 30px;
    text-overflow: ellipsis;
    border-bottom: 1px solid #ddd;
    box-shadow: -1px -1px 1px 1px #ddd;
    border-radius: 5px;
  }

  .order button {
    color: white;
    font-size: 20px;
    border: none;
    width: 100%;
    margin: 0;
  }

  th {
    padding-right: 20px;
  }

  .order .orderbutton {
    position: absolute;
    right: 0;
    top: 0;
    width: 200px;
    height: 100%;
    background-color: #0080bb;
  }

  .col-sm-3,
  .col-sm-12,
  .col-sm-9 {
    padding: 0;
  }

  .col-sm-12,
  .col-sm-3 {
    margin-bottom: 13px;
  }

  .col-sm-12 button {
    background: #2b3740;
  }

  .orhead {
    position: relative;
    font-size: 34px;
    background: #00779e;
    color: #ffffff;
    height: 70px;
  }

  .tablhde {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 18px;
    background: #cacaca;
    color: #000;
    width: 100%;
    height: 30px;
    padding-top: 6px;
    padding-bottom: 6px;
    margin-bottom: 20px;
    text-align: center;
  }

  table {
    min-height: 45px;
  }

  table,
  tr {
    width: 100%;
    margin: 0;
  }

  tr {
    padding-top: 20px;
  }

  th,
  td {
    padding: 5px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .cust_details {
    font-weight: normal;
  }

  .cust_header {
    width: 80px;
  }

  .cust_header2 {
    width: 100%;
  }

  .dw {
    padding: 0;
    display: flex;
    grid-gap: 5px;
  }

  .col-sm-2,
  .col-sm-3,
  .col-sm-4,
  .col-sm-5,
  .col-sm-6 {
    padding: .5px;
  }

  .col-xs-2,
  .col-xs-3,
  .col-xs-4,
  .col-xs-5,
  .col-xs-6,
  .col-xs-8,
  .col-xs-9,
  .col-xs-10,
  .col-xs-11 {
    padding: .25px;
  }

  .col-sm-8 {
    padding: 0px;
  }

  #proceed {
    background: none repeat scroll 0 0 #5a88ca;
    border: medium none;
    color: #0080bb;
    padding: 0px 10px;
    text-transform: capitalize;
  }

  .sidebar-title {
    font-size: 20px;
  }

  @media(min-width: 430px) {
    #proceed {
      width: 150px;
      font-size: 16px;
    }
  }

  @media(max-width: 429px) {
    #proceed {
      font-size: 15px;
      width: 140px;
    }
  }

  @media(max-width: 370px) {
    .sidebar-title {
      font-size: 18px;
    }

    .sidebar-title-a {
      font-size: 22px;
      padding-bottom: 15px !important;
      padding-top: 15px !important;
    }

    .orhead {
      height: auto !important;
    }

    #proceed {
      font-size: 13px;
      width: 120px;
      height: 30px !important;
    }

    .noorder-title {
      font-size: 22px;
    }
  }

  @media(max-width: 768px) {
    .cust_header {
      width: 90px;
    }

    .cust_details {
      width: 50%;
    }

    .large-size {
      display: none;
    }

    .small-size {
      display: unset;
    }
  }

  @media(min-width:769px) {
    .col-sm-6 th.cust_header2 {
      width: 30%;
    }

    .table1 {
      padding: 20px !important;
    }

    .large-size {
      display: unset;
    }

    .small-size {
      display: none;
    }
  }

  @media(max-width: 430px) {

    .cust_header2,
    .cust_details {
      width: 100%;
    }

    .col-xs-10 div {
      font-size: 16px !important;
    }
  }

  @media(max-width: 600px) {
    .ord_srch {
      width: 100%;
    }

    .ord_filt {
      width: 100%;
      margin-top: 5px;
    }
  }

  @media(min-width: 401px) {
    .status_span {
      padding-bottom: 3px;
    }
  }

  @media(max-width: 400px) {
    .status_small {
      display: none;
    }

    .status_icon {
      border-radius: 50% !important;
      padding: 5px;
      margin-left: -7px !important;
    }
  }
</style>
<script>
  $(document).ready(function (f) {
    $.ajax({
      url: "../Common/functions.php", //passing page info
      data: { "cartcnt": 1, "user": "<?= $_SESSION['id'] ?>" },  //form data
      type: "post",	//post data
      dataType: "json", 	//datatype=json format
      timeout: 18000,	//waiting time 3 sec
      success: function (data) {	//if logging in is success
        if (data.status == "success") {
          document.getElementById("sm-cartcnt").innerHTML = "";
          document.getElementById("lg-cartcnt").innerHTML = "";
          document.getElementById("sm-cartcnt").innerHTML = data.cartcnt;
          document.getElementById("lg-cartcnt").innerHTML = data.cartcnt;
          return;
        }
      },
      error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
        if (textstatus === "timeout") {
          return;
        }
        else { return; }
      }
    }); //closing ajax
    var pageId = 1;
    $('.background_loader').css('display', 'flex');
    $('.std_loader').show();
    $('.std_text1').css('display', 'flex');
    var filter = $('#ord_filt').val();
    var inputVal = $('#order_search').val();
    $.get("getorder.php", { name: inputVal, "filter": filter, 'page_no': pageId, "id": <?= $_SESSION['id'] ?> }).done(function (data) {
      $('#content_order').empty();
      $('#dynamic-paging').empty();
      $('#content_order').append(data.output);
      $('#dynamic-paging').append(data.paging);
    });
    $('#order_search').val('');
    $('.background_loader').hide();
    $('.std_text1').hide();
    $('.std_loader').hide();
  });
  //edited by KinG's HearTz
  function dispsrch() {
    $('.background_loader').css('display', 'flex');
    $('#std_loader').show();
    $('.std_text1').css('display', 'flex');
    var inputVal = $('#order_search').val();
    var filter = $('#ord_filt').val();
    $.get("getorder.php", { name: inputVal, 'filter': filter, id: <?= $_SESSION['id'] ?> }).done(function (data) {
      $('#content_order').empty();
      $('#dynamic-paging').empty();
      $('#content_order').append(data.output);
      $('#dynamic-paging').append(data.paging);
    });
    $('.background_loader').hide();
    $('.std_loader').hide();
    $('.std_text1').hide();
  }
  //edited by KinG's HearTz
  function disfilter() {
    $('.background_loader').css('display', 'flex');
    $('#std_loader').show();
    $('.std_text1').css('display', 'flex');
    var inputVal = $('#order_search').val();
    var filter = $('#ord_filt').val();
    $.get("getorder.php", { 'name': inputVal, 'filter': filter, "id": <?= $_SESSION['id'] ?> }).done(function (data) {
      $('#content_order').empty();
      $('#dynamic-paging').empty();
      $('#content_order').append(data.output);
      $('#dynamic-paging').append(data.paging);
    });
    $('#order_search').val('');
    $('.background_loader').hide();
    $('.std_loader').hide();
    $('.std_text1').hide();
  }
  // Pagination code
  $(document).on("click", ".pagination li a", function (e) {
    e.preventDefault();
    var pageId = $(this).attr("id");
    $('.background_loader').css('display', 'flex');
    $('.std_loader').show();
    $('.std_text1').css('display', 'flex');
    var inputVal = $('#order_search').val();
    var filter = $('#ord_filt').val();
    $.get("getorder.php", { 'name': inputVal, 'filter': filter, 'page_no': pageId, "id": <?= $_SESSION['id'] ?> }).done(function (data) {
      $('#content_order').empty();
      $('#dynamic-paging').empty();
      $('#content_order').append(data.output);
      $('#dynamic-paging').append(data.paging);
    });
    $('.background_loader').hide();
    $('.std_loader').hide();
    $('.std_text1').hide();
  });
</script>
<div class="table1" style="padding:5px;">
  <?php
  $sql_order_cnt = "select new_orders_id ,new_orders.sub_total from new_orders
JOIN order_delivery_details ON order_delivery_details.order_delivery_details_id=new_orders.order_delivery_details_id
JOIN user_delivery_details ON user_delivery_details.user_delivery_details_id=order_delivery_details.user_delivery_details_id where user_delivery_details.user_id=" . $_SESSION['id'];
  $stmt_order_cnt = $pdo->prepare($sql_order_cnt);
  $stmt_order_cnt->execute();
  $order_cnt = $stmt_order_cnt->rowCount();
  if ($order_cnt == 0) {
    echo '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Orders Yet...</h2></center><br><br>';
  } else {
    ?>
    <div class="container" style="padding: 0;margin:0;width:100%">
      <div class="row" style="padding: 0;margin:0;">
        <div class="col-sm-12 " style="padding: 0;margin:0;">
          <div class="col-sm-6 col-xs-7 ord_srch">
            <div class="input-group bar-srch" style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 0px;">
              <input type="text" class="" id="order_search" placeholder="Search" value="" name="" required=" "
                style="width: 100%;margin: 0px;z-index: 0;border-radius: 3px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;outline: none;">
              <span id="" class="input-group-btn">
                <button id="ord_srch" onclick="dispsrch()"
                  style="color: white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;padding-top:10px;padding-bottom: 10px;outline: none;border-radius: 0;border-bottom-right-radius: 3px;border-top-right-radius: 3px;"
                  class="btn btn-default search_btn" type="button"><span class="fa fa-search"></span></button>
              </span>
            </div>
          </div>
          <div class="col-sm-2 col-xs-1 "></div>
          <div class="col-sm-4 col-xs-4 ord_filt">
            <div class="input-group bar-srch" style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 0px;">
              <select name="ord_filt" class="locmark" id="ord_filt" required=" "
                style="width: 100%;height: 40px;margin: 0px;z-index: 0;border-radius: 3px;border:1px solid #DBDBDB;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                <option value="all" selected>ALL</option>
                <option value="completed">COMPLETED</option>
                <option value="pending">PENDING</option>
                <option value="cancelled">CANCELLED</option>
              </select>
              <span id="hide_filt" class="input-group-btn">
                <button onclick="disfilter()" onmouseover="$(this).css('background-color','#4f994f')"
                  onmouseleave="$(this).css('background-color','#07C103')"
                  style="color: white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #029400), color-stop(1, #026400)) !important;padding-top:10px;padding-bottom: 10px;outline: none;"
                  class="btn btn-default search_btn popuptext pin" type="button"><span
                    class="fas fa-filter"></span></button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="order" style="border-bottom-left-radius:0px;border-bottom-right-radius:0px;margin-top: 10px;">
      <div class="orhead" style="background-color: #ffffff;">
        <h2 class="sidebar-title-a"
          style="border-left: 5px solid #00869e;border-top-left-radius: 10px;text-align: left;padding-bottom: 24px;padding-top: 20px;margin-top: 0px;font-weight:normal;border-bottom:#333;margin-bottom: 0px;border-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px;color:#00869e;border-bottom-left-radius:0px ">
          My Orders <i style="color: #ffc400" class="fa fa-shopping-bag"></i></h2>
      </div>
    </div>
    <div id="content_order">
    </div>
    <?php
  }
  ?>
</div>
<div id="dynamic-paging"></div>
<?php
require "../Main/footer.php";
?>
<script type="text/javascript">
  const homeactive = document.querySelector('#homeactive');
  //const catactive=document.querySelector('#catactive');
  const aboutactive = document.querySelector('#aboutactive');
  const contactactive = document.querySelector('#contactactive');
  homeactive.className = "";
  //catactive.className="";
  aboutactive.className = "";
  contactactive.className = "";
  //catactive.className="active";
</script>
</body>

</html>