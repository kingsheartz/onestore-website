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
    background-color: #423e75;
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
</style>
<script>
  $(document).ready(function (f) {
    var pageId = 1;
    $('#background_loader').show();
    $('#std_loader').show();
    var inputVal = $('#order_search').val();
    $.get("gethistorysearch.php", { "name": inputVal, 'page_no': pageId, "id": <?= $_SESSION['id'] ?> }).done(function (data) {
      $('#content_order').empty();
      $('#dynamic-paging').empty();
      $('#content_order').append(data.output);
      $('#dynamic-paging').append(data.paging);
    });
    $('#order_search').val('');
    $('#background_loader').hide();
    $('#std_loader').hide();
  });
  //edited by KinG's HearTz
  function dispsrch() {
    $('#background_loader').show();
    $('#std_loader').show();
    var inputVal = $('#order_search').val();
    $.get("gethistorysearch.php", { name: inputVal, id: <?= $_SESSION['id'] ?> }).done(function (data) {
      $('#content_order').empty();
      $('#dynamic-paging').empty();
      $('#content_order').append(data.output);
      $('#dynamic-paging').append(data.paging);
    });
    $('#background_loader').hide();
    $('#std_loader').hide();
  }
  // Pagination code
  $(document).on("click", ".pagination li a", function (e) {
    e.preventDefault();
    var pageId = $(this).attr("id");
    $('#background_loader').show();
    $('#std_loader').show();
    var inputVal = $('#order_search').val();
    $.get("gethistorysearch.php", { "name": inputVal, 'page_no': pageId, "id": <?= $_SESSION['id'] ?> }).done(function (data) {
      $('#content_order').empty();
      $('#dynamic-paging').empty();
      $('#content_order').append(data.output);
      $('#dynamic-paging').append(data.paging);
    });
    $('#background_loader').hide();
    $('#std_loader').hide();
  });
</script>
<div class="table1" style="padding:5px;">
  <div class="container" style="padding: 0;margin:0;width:100%">
    <div class="row" style="padding: 0;margin:0;">
      <div class="col-sm-12 col-md-12" style="padding: 0;margin:0;">
        <div class="col-md-6 col-sm-2 col-xs-1 ord_srch">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-1"></div>
        <div class="col-md-4 col-sm-8 col-xs-10 ord_filt">
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
      </div>
    </div>
  </div>
  <br>
  <hr class="make_divb">
  <br>
  <div id="content_order">
  </div>
  <div id="dynamic-paging"></div>
</div>
</div>
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