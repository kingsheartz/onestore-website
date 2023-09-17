<?php
session_start();
if(!isset($_SESSION['forgot_pass_email'])){
  header('location:forgot-password-v2.html');
  return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OneStore | Verify OTP</title>
  <!--favicon-->
  <link href="../../../../images/logo/favicon.png" rel="icon"/>
  <!--//favicon-->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link href="../../../../css/font-awesome.css" rel="stylesheet">  
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="../CSS/OS.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body onload="verifyotp()" class="hold-transition login-page" style="background: url(../../../../images/logo/log2.jpg) no-repeat;position: absolute;background-position: center;width: 100%;">
<!--RESPONSE AWAITING-->
<div class="background_loader"></div>
<div class="std_loader"></div>
<!--RESPONSE AWAITING-->
<div style="background-color: rgba(0,0,0,0.65); position: absolute;width: 100%;height: 100%;align-items: center;justify-content: center;display: flex;overflow-y: scroll;" >  
<div class="login-box" style="display: inline-flex;">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../../../onestore.php" class="h1"><img src="../../../../images/logo/logost.svg" height="auto" width="auto " style="width: 80%;height: auto;" class="image-fluid mb-2"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Enter your OTP here.</p>
      <p id="emppass" style="color: red;display: none;">sdsds</p>
      <form action="#" name="Verify" method="post">
        <div class="input-group mb-3 input-field">
          <input type="tel" id="otp" class="form-control validate" placeholder="OTP" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" pattern="\d{6}" title="OTP Number Format (4321)- 6 digits" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="div-wrapper" style="display: flex;align-items: flex-end;justify-content: flex-end;">
              <button type="button" style="padding:5px;border-radius: .25rem;padding-left: 9px;padding-right: 9px;background-color: #02171e !important;border-top-right-radius:0px;border-bottom-right-radius:0px;" onclick="location.href='forgot-password-v2.html'">
                <i class="fa fa fa-arrow-left" style="color: #fff;"></i>
              </button>
              <button type="button" style="border-top-left-radius:0px;border-bottom-left-radius:0px;" id="otpbtn" onclick="otpcheck()" class="btn btn-primary btn-block real_btn">Verify</button>
              <button type="button" style="display:none;border-top-left-radius:0px;border-bottom-left-radius:0px;" class="btn btn-primary btn-block load_btn"><i class="fa fa-refresh fa-spin"></i>&nbsp;Verify</button>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="login-v2.html">Login</a>
        <a href="login-v2.html" style="float:right"><span id="expiry_caption" >retry in </span><span id="expiry"></span></a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<script src="../../../../js/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script type="text/javascript">


var time = 120;
var distance=60;
// Update the count down every 1 second
var x = setInterval(function() {
  time=time-1;
  var minutes = Math.floor(time  /  60);
  distance =  distance-1;
  var seconds=distance

  if(minutes==1 && seconds==0){
  	distance=60;
  }
  
  if(minutes!=0){
  // Output the result in an element with id="expiry"
  document.getElementById("expiry").innerHTML =minutes +"m "+ seconds + "s ";
  }  
  
  if(minutes==0){
  // Output the result in an element with id="expiry"
  document.getElementById("expiry").innerHTML =seconds + "s ";
  }

  // If the count down is over, write some text 
  if (minutes==0 && seconds==0) {
    clearInterval(x);
    $('#expiry_caption').hide();
    document.getElementById("expiry").innerHTML = "Expired OTP !";
    setInterval(function() {
    document.getElementById("expiry").innerHTML = "<a href='#' onclick='retry()'>Retry</a>";
    }, 2000)
  }
}, 1000);


function retry(){

$('.background_loader').show();
$('.std_loader').show();

var email="<?=$_SESSION['forgot_pass_email']?>";

$.ajax({
    url: "../../../../functions.php", //passing page info
    data: {"forgotlogin":1,"email":email},  //form data
    type: "post", //post data
    dataType: "json",   //datatype=json format
    timeout:18000,  //waiting time 3 sec
    
    success: function(data){  //if logging in is success
      
      if(data.status=='success'){

        $('.background_loader').hide();
        $('.std_loader').hide();

        swal({
              title: "Success!!!",
              text: "OTP Send",
              icon: "success",
              closeOnClickOutside: false,
              dangerMode: true,
              })
        .then((willSubmit) => {
          if (willSubmit) {  
            $(function () {
              location.href="OTP-v2.php"
            $('#emppass').hide();
              
          });
            return false;
          }
          else{
            return false;
          }
      });
      }
        else if(data.status=='admin'){
          
          $('.background_loader').hide();
          $('.std_loader').hide();

            swal({
                title: "Success!!!",
                text: "OTP Send",
                closeOnClickOutside: false,
                dangerMode: true,
                })
            .then((willSubmit) => {
                if (willSubmit) {  
          $('#emppass').hide();
                    location.href="OTP-v2.php";
                }
                else{
                    return false;
                }
            });
            }
},
    error: function(xmlhttprequest, textstatus, message) { //if it exceeds timeout period
      if(textstatus==="timeout") {   

        $('.background_loader').hide();
        $('.std_loader').hide();

          swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });

      return false;

      }
      else{return false;}
  }
    }); //closing ajax

}


    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
</script>  

<script type="text/javascript">
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function verifyotp(){

<?php
if(isset($_GET['otp'])){
  $otp=$_GET['otp'];
?>
document.getElementById('otp').value="<?=$otp?>";
document.getElementById('otpbtn').click();  
<?php
}
?>
}

$('#otp').keyup(function(){
  if($('#otp').val().length==6){
    otpcheck();
  }
});

function otpcheck(){

var otp=document.getElementById("otp").value;

if(otp == null || otp == "" ){

    Toast.fire({
        icon: 'error',
        title: ' Enter your OTP !!! '
      })
    $('#emppass').html("Missing OTP !!!");
    $('#emppass').show();
    document.getElementById("otp").focus();
    return ;
}

if(isNaN(otp)){

    toastr.error('Invalid OTP!!!')
    $('#emppass').html("Invalid OTP !!!");
    $('#emppass').show();
    document.getElementById("otp").focus();
    return ;  
}
else{

$('.load_btn').show(); 
$('.real_btn').hide();
  
$.ajax({
    url: "../../../../functions.php", //passing page info
    data: {"otppass":1,"otp":otp},  //form data
    type: "post", //post data
    dataType: "json",   //datatype=json format
    timeout:18000,  //waiting time 3 sec
    
    success: function(data){  //if logging in is success
      
      if(data.status=='success'){

        $('.load_btn').hide(); 
        $('.real_btn').show();

        swal({
              title: "Success!!!",
              text: "Verification success",
              icon: "success",
              closeOnClickOutside: false,
              dangerMode: true,
              })
        .then((willSubmit) => {
          if (willSubmit) {  
            $(function () {
              location.href="recover-password-v2.php?otp="+data.otp+"";
            $('#emppass').hide();
          });
            return;
          }
          else{
            return ;
          }
      });
      }
        else if(data.status=='admin'){

        $('.load_btn').hide(); 
        $('.real_btn').show();

            swal({
                title: "Success!!!",
                text: "Verification success",
                closeOnClickOutside: false,
                dangerMode: true,
                })
            .then((willSubmit) => {
                if (willSubmit) {  
          $('#emppass').hide();
                     location.href="recover-password-v2.php?otp="+data.otp+"";
                }
                else{
                    return ;
                }
            });
            }

    else if(data.status=='error'){

        $('.load_btn').hide(); 
        $('.real_btn').show();

      swal({
              title: "Oops!!!",
              text: "Invalid OTP !!! ",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              })
      .then((willSubmit)=>{
        if(willSubmit){
          $('#emppass').html("Invalid OTP !!!");
          $('#emppass').show();
          //location.reload();
        }
      });
      }
    else if(data.status=='expired'){

        $('.load_btn').hide(); 
        $('.real_btn').show();

            swal({
                title: "Oops!!!",
                text: " OTP expired!!!",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                })
            .then((willSubmit)=>{
                if(willSubmit){
                  $('#emppass').html("OTP expired!!!.");
                  $('#emppass').show();
                    //location.reload();
                }
            });
            } 
              
    },
    error: function(xmlhttprequest, textstatus, message) { //if it exceeds timeout period
      if(textstatus==="timeout") {    

        $('.load_btn').hide(); 
        $('.real_btn').show();
                  
          swal({
                title: "Oops!!!",
                text: "server time out",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
              });

      return ;

      }
      else{return;}
  }
    }); //closing ajax
}
}
</script>

</body>
</html>
