<?php
require "../../../../pdo.php";
if(isset($_GET['code']) && isset($_GET['email']) && isset($_GET['emailverified']) && $_GET['emailverified']==1){
  $code=$_GET['code'];
  $email=$_GET['email'];
}
else{
  header('location:login-v2.html');
  return;
}

$sql2="select activation_code from store_admin where email='$email'";
$stmt2=$pdo->query($sql2);
$row2=$stmt2->fetch(PDO::FETCH_ASSOC);


if(($row2) && ($row2['activation_code']==$code)){

  if($code=='activated'){
    header('location:../../../../error.php?click=1');
    return;
  }
}
else{
   header('location:login-v2.html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OneStore | Set Password</title>
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
<body class="hold-transition login-page" style="background: url(../../../../images/logo/check1.jpg) no-repeat;position: absolute;background-position: center;width: 100%;">
<div style="background-color: rgba(0,0,0,0.65); position: absolute;width: 100%;height: 100%;align-items: center;justify-content: center;display: flex;" >  
<div class="register-box" style="display: inline-flex;">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><img src="../../../../images/logo/logost.svg" height="auto" width="auto " style="width: 80%;height: auto;" class="image-fluid mb-2"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg" style="padding-bottom: 0px;">Set your password for sign in</p>
      <p id="emppass" style="color: red;display: none;"></p>



      <form action="#">
       <div class="input-group mb-3 input-field">
          <p class="capson_warning" style="display: none;float:left;color: #d9534f"><i class="fa fa-warning"></i> &nbsp;WARNING! Caps lock is ON.</p>
          <input type="password" id="pass1" class="form-control password_fields validate" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=" " oninput="$(this).removeClass('invalid');" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 input-field">
          <input type="password" id="pass2" class="form-control password_fields validate" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=" " oninput="$(this).removeClass('invalid');" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="button" onclick="recover()" class="btn btn-primary btn-block real_btn">Change password</button>
            <button type="button" style="display:none;" class="btn btn-primary btn-block load_btn"><i class="fa fa-refresh fa-spin"></i>&nbsp;Change password</button>
            <input type="submit" style="display: none;" value="request" class="submit_this">
          </div>
          <!-- /.col -->
        </div>
      </form>


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
      var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
</script>  

<script type="text/javascript">
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var capson_warning = document.getElementsByClassName("capson_warning");
var  password_field=document.getElementsByClassName('password_fields');

for (var i = 0; i < password_field.length; i++) {
    password_field[i].addEventListener("keyup", function(event) {
    for (var j = 0; j < capson_warning.length; j++) {
        if (event.getModifierState("CapsLock")) {
            capson_warning[j].style.display = "block";
        }
        else {
            capson_warning[j].style.display = "none"
        }
    } 
        
});
}


function recover(){

var pass_input=document.getElementById("pass1");
var pass1=document.getElementById("pass1").value;
var pass2=document.getElementById("pass2").value;


//password verification of null value
if(pass1 == null || pass1 == "" ){
    $('.submit_this').click(); 
    document.getElementById("pass1").focus();
    document.getElementById("pass1").className += " invalid";
    return false;
} 

 // Validate lowercase letters
  var lowerCaseLetters = !/[a-z]/g;
  if(pass_input.value.match(lowerCaseLetters)) {  
    $('.submit_this').click(); 
    document.getElementById("pass1").focus();
    document.getElementById("pass1").className += " invalid";
    return false;
  }
  
  // Validate capital letters
  var upperCaseLetters = !/[A-Z]/g;
  if(pass_input.value.match(upperCaseLetters)) {  
    $('.submit_this').click(); 
    document.getElementById("pass1").focus();
    document.getElementById("pass1").className += " invalid";
    return false;
  }

  // Validate numbers
  var numbers = !/[0-9]/g;
  if(pass_input.value.match(numbers)) {  
    $('.submit_this').click(); 
    document.getElementById("pass1").focus();
    document.getElementById("pass1").className += " invalid";
    return false;
  }


//weak password verification
else if(pass1.length<8){
    $('.submit_this').click(); 
    document.getElementById("pass1").focus();
    document.getElementById("pass1").className += " invalid";
    return false;
}

if(pass2 == null || pass2 == "" ){
    $('.submit_this').click(); 
    document.getElementById("pass2").focus();
    document.getElementById("pass2").className += " invalid";
    return false;
}

//confirming both passwords are same
  else if(pass1!=pass2){
    
    swal({
            title: "Oops!!!",
            text: "Passwords do not match !!! Try again ",
            icon: "error",
            closeOnClickOutside: false,
            dangerMode: true,
            timer: 6000,
            });

    document.getElementById("pass2").value="";
    document.getElementById("pass2").focus();
    document.getElementById("pass1").className += " invalid";
    document.getElementById("pass2").className += " invalid";
    return;
} 

else{

$('.load_btn').show(); 
$('.real_btn').hide();

var code='<?=$code?>';
var email='<?=$email?>';

$.ajax({
    url: "../../../../admin/submit.php", //passing page info
    data: {"setstorepass":1,"password":pass1,"email":email,"code":code},  //form data
    type: "post", //post data
    dataType: "json",   //datatype=json format
    timeout:60000,  //waiting time 3 sec
    
    success: function(data){  //if logging in is success
      
      if(data.status=='success'){

        $('.load_btn').hide(); 
        $('.real_btn').show();

        swal({
              title: "Success!!!",
              text: "Password is set for your store",
              icon: "success",
              closeOnClickOutside: false,
              dangerMode: true,
              })
        .then((willSubmit) => {
          if (willSubmit) {  
            $(function () {
              location.href="login-v2.html"
            $('#emppass').hide();
              $('#myModal').modal('toggle');
          });
            return;
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
              text: "Something went wrong",
              icon: "error",
              closeOnClickOutside: false,
              dangerMode: true,
              })
      .then((willSubmit)=>{
        if(willSubmit){
          $('#emppass').html("Something went wrong");
          $('#emppass').show();
          //location.reload();
        }
      });
      }

        else if(data.status=='error1'){

          $('.load_btn').hide(); 
          $('.real_btn').show();

            swal({
                title: "Check your mailbox!!!",
                text: "Pending email verification",
                icon: "warning",
                closeOnClickOutside: false,
                dangerMode: true,
                })
            .then((willSubmit)=>{
                if(willSubmit){
                  $('#emppass').html("Verify your email");
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
