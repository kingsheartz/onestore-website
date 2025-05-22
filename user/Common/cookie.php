<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 45px;
    height: 23px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 4px;
    bottom: 2px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked+.slider {
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(20px);
    -ms-transform: translateX(20px);
    transform: translateX(20px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }

  @media(max-width:500px) {
    .mod_th {
      width: 100% !important;
      margin-left: 0;
      margin-right: 0;
    }
  }
</style>
<script>
  $(document).ready(function(f) {
    if ($(window).width() < 365) {
      $('.small-cookie-accept').html('Accept');
    }
  });
  $(window).resize(function() {
    if ($(window).width() < 365) {
      $('.small-cookie-accept').html('Accept');
    }
  });

  function setcookie(val) {
    <?php
    if (isset($_SESSION['id'])) {
    ?>
      if (val == 1) {
        var pc = 1;
        var fc = 1;
        var tc = 1;
      } else if (val == 2) {
        if ($('#pc').prop("checked") == true) {
          var pc = 1;
        } else if ($('#pc').prop("checked") == false) {
          var pc = 0;
        }
        if ($('#fc').prop("checked") == true) {
          var fc = 1;
        } else if ($('#fc').prop("checked") == false) {
          var fc = 0;
        }
        if ($('#tc').prop("checked") == true) {
          var tc = 1;
        } else if ($('#tc').prop("checked") == false) {
          var tc = 0;
        }
      }
      $.ajax({
        url: "functions.php", //passing page info
        data: {
          "storecookie": 1,
          "sn": 1,
          "pc": pc,
          "fc": fc,
          "tc": tc,
          "userid": <?= $_SESSION['id'] ?>
        }, //form data
        type: "post", //post data
        dataType: "json", //datatype=json format
        timeout: 30000, //waiting time 30 sec
        success: function(data) { //if registration is success
          if (data.status == 'success') {
            toastr.success("Cookies set successfully");
            return;
          }
        },
        error: function(xmlhttprequest, textstatus, message) { //if it exceeds timeout period
          if (textstatus === "timeout") {
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
    <?php
    } else {
    ?>
      document.cookie = 'cookieset=y';
    <?php
    }
    ?>
    $('.cookiesetting').hide();
  }
</script>
<!-- Modal -->
<div class="modal fade" id="cookiemodal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog"
  aria-labelledby="myModalLabel" style="height:max-content">
  <div class="modal-dialog modal-lg mod_th" role="document"
    style="background-color:white;border-radius:5px;height:max-content">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" style="margin-top:5px" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">�</span>
        </button>
        <h3 class="modal-title" id="myModalLabel"><b>Cookie Setting</b></h3>
      </div>
      <div class="modal-body">
        <p style="font-size:14px;color:rgb(44, 44, 44)">
          When you visit any of our websites, it may store or retrieve information on your browser, mostly in the form
          of cookies. This information might be about you, your preferences or your device and is mostly used to make
          the site work as you expect it to. The information does not usually directly identify you, but it can give you
          a more personalized web experience. Because we respect your right to privacy, you can choose not to allow some
          types of cookies. Click on the different category headings to find out more and manage your preferences.
          Please note, blocking some types of cookies may impact your experience of the site and the services we are
          able to offer.</p>
        <b style="float: left;font-size: 14px;">Strictly Necessary <i class="fa fa-question-circle"></i></b>
        <label class="switch" style="float: right;">
          <input type="checkbox" value="sn" name="sel_cookie1" id="sn" style="float: right;" checked="" disabled="">
          <span class="slider round"></span>
        </label><br><br>
        <b style="float: left;font-size: 14px;">Performance Cookies <i class="fa fa-question-circle"></i></b>
        <label class="switch" style="float: right;">
          <input type="checkbox" value="pc" name="sel_cookie2" id="pc" style="float: right;">
          <span class="slider round"></span>
        </label><br><br>
        <b style="float: left;font-size: 14px;">Functional Cookies <i class="fa fa-question-circle"></i></b>
        <label class="switch" style="float: right;">
          <input type="checkbox" value="fc" name="sel_cookie3" id="fc" style="float: right;">
          <span class="slider round"></span>
        </label><br><br>
        <b style="float: left;font-size: 14px;">Targeting Cookies <i class="fa fa-question-circle"></i></b>
        <label class="switch" style="float: right;">
          <input type="checkbox" value="tc" name="sel_cookie4" id="tc" style="float: right;">
          <span class="slider round"></span>
        </label><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn btn-primary" style="font-size:14px" onclick="setcookie(2)"
          data-dismiss="modal">Confirm my choices</button>
        <!--<button type="button" class="btn btn btn-success small-cookie-accept" style="font-size:14px" data-dismiss="modal">Accept all cookies</button>-->
        <button type="button" class="btn btn-orange" data-dismiss="modal"> Cancel</button>
      </div>
    </div>
  </div>
</div>