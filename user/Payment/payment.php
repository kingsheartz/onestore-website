<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location:../Main/onestore.php");
}
require "../Main/header.php";
require_once dirname(__DIR__, 2) . '/includes/logger.php';

$placeorder_mul        = json_encode(is_numeric($_POST['placeorder_mul'] ?? null) ? (int)$_POST['placeorder_mul'] : $_POST['placeorder_mul'] ?? null);
$buynow_placeorder     = json_encode(is_numeric($_POST['buynow_placeorder'] ?? null) ? (int)$_POST['buynow_placeorder'] : $_POST['buynow_placeorder'] ?? null);
$placeorder            = json_encode(is_numeric($_POST['placeorder'] ?? null) ? (int)$_POST['placeorder'] : $_POST['placeorder'] ?? null);
$shipping_first_name   = json_encode($_POST['shipping_first_name'] ?? null);
$shipping_last_name    = json_encode($_POST['shipping_last_name'] ?? null);
$user                  = json_encode(is_numeric($_POST['user'] ?? null) ? (int)$_POST['user'] : $_POST['user'] ?? null);
$user_id               = json_encode(is_numeric($_POST['user_id'] ?? null) ? (int)$_POST['user_id'] : $_POST['user_id'] ?? null);
$order_notes           = json_encode(is_numeric($_POST['order_notes'] ?? null) ? (int)$_POST['order_notes'] : $_POST['order_notes'] ?? null);
$pdt_cnt               = json_encode(is_numeric($_POST['pdt_cnt'] ?? null) ? (int)$_POST['pdt_cnt'] : $_POST['pdt_cnt'] ?? null);
$total_amt             = json_encode(is_numeric($_POST['total_amt'] ?? null) ? (float)$_POST['total_amt'] : $_POST['total_amt'] ?? null);
$shipping_postcode     = json_encode(is_numeric($_POST['shipping_postcode'] ?? null) ? (int)$_POST['shipping_postcode'] : $_POST['shipping_postcode'] ?? null);
$shipping_ph_no        = json_encode(is_numeric($_POST['shipping_ph_no'] ?? null) ? (int)$_POST['shipping_ph_no'] : $_POST['shipping_ph_no'] ?? null);
$idid                  = json_encode(is_numeric($_POST['idid'] ?? null) ? (int)$_POST['idid'] : null);
$shipping_ph_no2       = json_encode(is_numeric($_POST['shipping_ph_no2'] ?? null) ? (int)$_POST['shipping_ph_no2'] : $_POST['shipping_ph_no2'] ?? null);
$shipping_address_1    = json_encode($_POST['shipping_address_1'] ?? null);
$order_type            = json_encode(is_numeric($_POST['order_type'] ?? null) ? (int)$_POST['order_type'] : $_POST['order_type'] ?? null);
$store_id              = json_encode(is_numeric($_POST['store_id'] ?? null) ? (int)$_POST['store_id'] : $_POST['store_id'] ?? null);

// Log the data used for the payment page
log_message("Payment page data used: " . json_encode([
  'placeorder_mul' => $placeorder_mul,
  'buynow_placeorder' => $buynow_placeorder,
  'placeorder' => $placeorder,
  'shipping_first_name' => $shipping_first_name,
  'shipping_last_name' => $shipping_last_name,
  'user' => $user,
  'user_id' => $user_id,
  'order_notes' => $order_notes,
  'pdt_cnt' => $pdt_cnt,
  'total_amt' => $total_amt,
  'shipping_postcode' => $shipping_postcode,
  'shipping_ph_no' => $shipping_ph_no,
  'shipping_ph_no2' => $shipping_ph_no2,
  'shipping_address_1' => $shipping_address_1,
  'idid' => $idid,
  'order_type' => $order_type,
  'store_id' => $store_id
]));
?>
<script>
  var placeorder_mul = <?= $placeorder_mul ?>;
  var buynow_placeorder = <?= $buynow_placeorder ?>;
  var placeorder = <?= $placeorder ?>;
  var shipping_first_name = <?= $shipping_first_name ?>;
  var shipping_last_name = <?= $shipping_last_name ?>;
  var user = <?= $user ?>;
  var user_id = <?= $user_id ?>;
  var order_notes = <?= $order_notes ?>;
  var pdt_cnt = <?= $pdt_cnt ?>;
  var total_amt = <?= $total_amt ?>;
  var shipping_postcode = <?= $shipping_postcode ?>;
  var shipping_ph_no = <?= $shipping_ph_no ?>;
  var shipping_ph_no2 = <?= $shipping_ph_no2 ?>;
  var shipping_address_1 = <?= $shipping_address_1 ?>;
  var idid = <?= $idid ?>;
  var order_type = <?= $order_type ?>;
  var store_id = <?= $store_id ?>;

  if (placeorder_mul != null) {
    console.log("mul")
    if (shipping_first_name != null) {
      data_used = {
        "placeorder_mul": 1,
        "user": user,
        "user_id": user_id,
        "shipping_first_name": shipping_first_name,
        "shipping_last_name": shipping_last_name,
        "shipping_ph_no": shipping_ph_no,
        "shipping_ph_no2": shipping_ph_no2,
        "shipping_address_1": shipping_address_1,
        "shipping_postcode": shipping_postcode,
        "order_notes": order_notes,
        "pdt_cnt": pdt_cnt,
        "total_amt": total_amt
      };
    }
    data_used = {
      "placeorder_mul": 1,
      "user": user,
      "user_id": user_id,
      "order_notes": order_notes,
      "pdt_cnt": pdt_cnt,
      "total_amt": total_amt
    };
  } else if (buynow_placeorder != null) {
    console.log("buy noe")
    if (shipping_first_name != null) {
      data_used = {
        "buynow_placeorder": 1,
        "user": user,
        "user_id": user_id,
        "shipping_first_name": shipping_first_name,
        "shipping_last_name": shipping_last_name,
        "shipping_ph_no": shipping_ph_no,
        "shipping_ph_no2": shipping_ph_no2,
        "shipping_address_1": shipping_address_1,
        "shipping_postcode": shipping_postcode,
        "order_notes": order_notes,
        "pdt_cnt": pdt_cnt,
        "total_amt": total_amt,
        "idid": idid,
        "store_id": store_id,
        "order_type": order_type
      };
    }
    data_used = {
      "buynow_placeorder": 1,
      "user": user,
      "user_id": user_id,
      "order_notes": order_notes,
      "pdt_cnt": pdt_cnt,
      "total_amt": total_amt,
      "idid": idid,
      "store_id": store_id,
      "order_type": order_type
    };
  } else if (placeorder != null) {
    console.log("placeorder")
    if (shipping_first_name != null) {
      data_used = {
        "placeorder": 1,
        "user": user,
        "user_id": user_id,
        "shipping_first_name": shipping_first_name,
        "shipping_last_name": shipping_last_name,
        "shipping_ph_no": shipping_ph_no,
        "shipping_ph_no2": shipping_ph_no2,
        "shipping_address_1": shipping_address_1,
        "shipping_postcode": shipping_postcode,
        "order_notes": order_notes,
        "pdt_cnt": pdt_cnt,
        "total_amt": total_amt
      };
    }
    data_used = {
      "placeorder": 1,
      "user": user,
      "user_id": user_id,
      "order_notes": order_notes,
      "pdt_cnt": pdt_cnt,
      "total_amt": total_amt
    };
  }
  console.log(data_used)
</script>
<script>
  function onPay() {
    Swal.fire({
        title: "Are you sure?",
        text: "placing your orders !!!",
        icon: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: 'green',
        allowOutsideClick: false,
        confirmButtonText: '<i class="fa fa-shopping-bag"></i> Place',
        cancelButtonColor: 'red',
        cancelButtonText: '<i class="fa fa-close"></i> Cancel'
      })
      .then((willSubmit) => {
        if (willSubmit.isConfirmed) {
          $('.background_loader').css('display', 'flex');
          $('.load_btn').show();
          $('.real_btn').hide();
          $('.std_text3').css('display', 'flex');
          $.ajax({
            url: "../Common/functions.php", //passing page info
            data: data_used, //form data
            type: "post", //post data
            dataType: "json", //datatype=json format
            timeout: 30000, //waiting time 30 sec
            success: function(data) { //if registration is success
              if (data.status == 'success') {
                $('.background_loader').hide();
                $('.std_text3').hide();
                swal({
                    title: "Success!!!",
                    text: "Order Placed Successfully",
                    icon: "success",
                    closeOnClickOutside: false,
                    dangerMode: true,
                  })
                  .then((willSubmit1) => {
                    if (willSubmit1) {
                      location.href = "../Order/myorders.php";
                      return;
                    } else {
                      return;
                    }
                  });
              } else if (data.status == 'error') {
                $('.background_loader').hide();
                $('.load_btn').hide();
                $('.real_btn').show();
                $('.std_text3').hide();
                swal({
                    title: "Sorry!!!",
                    text: "Try again",
                    icon: "error",
                    closeOnClickOutside: false,
                    dangerMode: true,
                  })
                  .then((willSubmit) => {
                    if (willSubmit) {
                      location.reload();
                      return;
                    } else {
                      return;
                    }
                  });
              }
            },
            error: function(xmlhttprequest, textstatus, message) { //if it exceeds timeout period
              if (textstatus === "timeout") {
                $('.background_loader').hide();
                $('.load_btn').hide();
                $('.real_btn').show();
                $('.std_text3').hide();
                swal({
                  title: "Oops!!!",
                  text: "server time out",
                  icon: "error",
                  closeOnClickOutside: false,
                  dangerMode: true,
                  timer: 6000,
                });
                return;
              } else {
                return;
              }
            }
          }); //closing ajax
        } //ELSE CLOSING (IN ACTUAL PRGM) ,NOW END WILL SUBMIT
        else if (willSubmit.dismiss) {
          return;
        }
      }); //NOW .(THIS) END WILL SUBMIT (NOT NEEDED)
  }
</script>
<style>
  .payment_full {
    background-color: #fff;
    width: 50%;
    margin: auto;
    color: #000;
    border-radius: 15px;
    box-shadow: 8px 8px 16px 2px #746363;
    padding: 1%;
  }

  .payment_options {
    margin: 2%;
    width: 96%;
    color: #000;
    border-radius: 15px;
    box-shadow: 0px 1px 2px 2px #e4dada;
  }

  .li-opt {
    display: inline-flex;
    width: 30%;
    height: 20%;
    margin: 2% 0%;
    margin-right: 2%;
    border-radius: 8px;
    box-shadow: 0px 1px 2px 2px #e4dada;
    margin-left: 3px;
    vertical-align: middle;
  }

  hr {
    margin: 0;
    padding: 0;
    border-top: 1px solid #c2c2c2;
  }

  .payment_list {
    width: 100%;
    font-size: 15px;
    font-weight: 500;
  }

  .ui-opt {
    padding: 2% 5%;
    background: aliceblue;
    margin: 0;
  }

  .upi-span {
    font-size: 93%;
    padding: 10% 0%;
    vertical-align: middle;
  }

  .icon-img {
    padding: 8% 8%;
  }

  .heading {
    margin: 0;
    padding: 3% 2%;
  }

  .payment_list select {
    padding: 1%;
    border-radius: 10px;
    border-color: silver;
    border-style: solid;
    width: 100%;
    margin: auto;
  }

  .pay-select {
    background: aliceblue;
    padding: 5% 5%;
  }

  .ui-opt,
  .pay-select {
    display: none;
  }

  .heading img {
    margin-right: 20px;
  }
</style>
<script>
  function togglePaymentOpt(right, top, disp) {
    if (document.getElementById(top).style.display == "none") {
      document.getElementById(top).style.display = "block"
      document.getElementById(right).style.display = "none"
      document.getElementById(disp).style.display = "block"
    } else {
      document.getElementById(right).style.display = "block"
      document.getElementById(top).style.display = "none"
      document.getElementById(disp).style.display = "none"
    }
  }
</script>
<div style="margin: 10%;"></div>
<div class='payment_full'>
  <div style="font-size: 100%;
    font-weight: bold;
    margin: 2%;">
    Payment Options
  </div>
  <div class="payment_options">
    <div class="payment_list" onclick='togglePaymentOpt("cat-right-UPI", "cat-down-UPI", "upi-options")'>
      <div class="heading">
        <img src="..\..\images\payment-icons\icons8-UPI-32.png"> UPI
        <i class="fa fa-angle-right" id="cat-right-UPI" style="float: right; font-size:30px;"></i>
        <i class="fa fa-angle-up " id="cat-down-UPI" style="float: right;display: none; font-size:30px;border-bottom:none;"></i>
      </div>
      <ul id="upi-options" class="ui-opt" background-color="#000">
        <li class="li-opt">
          <img src="..\..\images\payment-icons\icons8-google-pay-32.png" class="icon-img">
          <span class="upi-span">Google pay</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\icons8-paytm-32.png" class="icon-img">
          <span class="upi-span">Paytm</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\icons8-phone-pe-32.png" class="icon-img">
          <span class="upi-span">Phone Pe</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\icons8-bhim-32.png" class="icon-img">
          <span class="upi-span">BHIM</span>
        </li>
      </ul>
    </div>
    <hr>
    <div class="payment_list" onclick='togglePaymentOpt("cat-right-cards", "cat-down-cards", "card-options")'>
      <div class="heading">
        <img src="..\..\images\payment-icons\icons8-card-32.png"> Cards
        <i class="fa fa-angle-right" id="cat-right-cards" style="float: right; font-size:30px;"></i>
        <i class="fa fa-angle-up " id="cat-down-cards" style="float: right;display: none; font-size:30px;border-bottom:none;"></i>
      </div>
      <ul id="card-options" class="ui-opt" background-color="#000">
        <li class="li-opt">
          <img src="..\..\images\payment-icons\icons8-visa-32.png" class="icon-img">
          <span class="upi-span">Visa</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\icons8-mastercard-logo-32.png" class="icon-img">
          <span class="upi-span">Master card</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\icons8-rupay-32.png" class="icon-img">
          <span class="upi-span">Rupay</span>
        </li>
      </ul>
    </div>
    <hr>
    <div class="payment_list" onclick='togglePaymentOpt("cat-right-bank", "cat-down-bank", "net-banking-options")'>
      <div class="heading">
        <img src="..\..\images\payment-icons\icons8-bank-building-32.png"> Net banking
        <i class="fa fa-angle-right " id="cat-right-bank" style="float: right; font-size:30px;"></i>
        <i class="fa fa-angle-up" id="cat-down-bank" style="float: right;display: none; font-size:30px;border-bottom:none;"></i>
      </div>
      <ul id="net-banking-options" class="ui-opt" background-color="#000">
        <li class="li-opt">
          <img src="..\..\images\payment-icons\sbi-logo-33234.png" style="width: 40%; height: 40%;" class="icon-img">
          <span class="upi-span">SBI bank</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\IBN.png" style="width: 40%; height: 40%;" class="icon-img">
          <span class="upi-span">ICICI bank</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\KOTAKBANK.NS.png" style="width: 40%; height: 40%;" class="icon-img">
          <span class="upi-span">Kotak</span>
        </li>
        <li class="li-opt">
          <img src="..\..\images\payment-icons\AXISBANK.BO.png" style="width: 40%; height: 40%;" class="icon-img">
          <span class="upi-span">Axis</span>
        </li>
      </ul>
    </div>
    <hr>
    <div class="payment_list" onclick='togglePaymentOpt("cat-right-emi", "cat-down-emi", "emi-options")'>
      <div class="heading">
        <img src="..\..\images\payment-icons\icons8-installment-plan-32.png"> EMI
        <i class="fa fa-angle-right " id="cat-right-emi" style="float: right; font-size:30px;"></i>
        <i class="fa fa-angle-up" id="cat-down-emi" style="float: right;display: none; font-size:30px;border-bottom:none;"></i>
      </div>
      <div class="pay-select" id="emi-options">
        <select>
          <option>Select an EMI option</option>
        </select>
      </div>
    </div>
    <hr>
    <div class="payment_list" onclick='togglePaymentOpt("cat-right-wallet", "cat-down-wallet", "wallet-options")'>
      <div class="heading">
        <img src="..\..\images\payment-icons\icons8-wallet-32.png"> Wallet
        <i class="fa fa-angle-right " id="cat-right-wallet" style="float: right; font-size:30px;"></i>
        <i class="fa fa-angle-up " id="cat-down-wallet" style="float: right;display: none; font-size:30px;border-bottom:none;"></i>
      </div>
      <ul id="wallet-options" class="ui-opt" background-color="#000">
        <li class="li-opt"><img src="..\..\images\payment-icons\icons8-google-pay-32.png" class="icon-img">
          <span class="upi-span">Gpay wallet</span>
        </li>
        <li class="li-opt"><img src="..\..\images\payment-icons\icons8-paytm-32.png" class="icon-img">
          <span class="upi-span">Paytm wallet</span>
        </li>
        <li class="li-opt"><img src="..\..\images\payment-icons\icons8-phone-pe-32.png" class="icon-img">
          <span class="upi-span">Phone Pe wallet</span>
        </li>
      </ul>
    </div>
    <hr>
    <div class="payment_list" onclick='togglePaymentOpt("cat-right-pay", "cat-down-pay", "pay-later-options")'>
      <div class="heading">
        <img src="..\..\images\payment-icons\icons8-time-32.png"> Pay Later
        <i class="fa fa-angle-right" id="cat-right-pay" style="float: right; font-size:30px;"></i>
        <i class="fa fa-angle-up" id="cat-down-pay" style="float: right;display: none; font-size:30px;border-bottom:none;"></i>
      </div>
      <div class="pay-select" id="pay-later-options">
        <select>
          <option>Select an option for pay later</option>
        </select>
      </div>
    </div>
  </div>
  <button
    style="width: 100%;
    background: black;
    color: white;
    border-radius: 5px;
    height: 50px;"
    onclick="onPay()"> Pay <?= $total_amt ?>
  </button>
</div>
<div style="margin: 10%;"></div>
<?php
require "../Main/footer.php";
?>