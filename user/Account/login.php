<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location:../Main/onestore.php");
}
require "../Main/header.php";
?>
<style type="text/css">
    a:hover {
        color: #0c99cc !important;
    }

    p:hover {
        color: #fff;
    }
</style>
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Login Page</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- login -->
<div class="login" style="background: url(../../images/logo/log2.jpg) no-repeat;padding-top: 0px;padding-bottom: 0px;">
    <div style="background-color: rgba(0,0,0,0.55);width: 100%;height: 100%;padding-top: 30px;padding-bottom: 30px;">
        <div class="container">
            <h2 style="color: white">Login Form</h2>
            <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s"
                style="border-top: 10px solid #fe9126;border-radius: 5px;">
                <form name="login_form">
                    <?php
                    if (isset($_SESSION['errorlogin'])) {
                        ?>
                        <div class="alert alert-danger"><?= $_SESSION['errorlogin'] ?></div>
                        <?php
                        unset($_SESSION['errorlogin']);
                    }
                    ?>
                    <!--<?/*php if(isset($_SESSION['errorlogin'])){
              echo'<p style="color:red;margin-top:-5px;float:left;padding-bottom:15px;">*'.$_SESSION['errorlogin']."</p>";
              unset($_SESSION['errorlogin']);
    }*/ ?>-->
                    <input type="email" name="email" id="email" placeholder="Email Address" required=" ">
                    <div class="input-group bar-srch"
                        style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 15px;">
                        <p class="capson_warning" style="display: none;float:left;color: #d9534f"><i
                                class="fa fa-warning"></i> &nbsp;WARNING! Caps lock is ON.</p>
                        <input type="password" id="passfir" value="" placeholder="Password"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                            class="password_fields" required=" "
                            style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;'">
                        <span id="dis_pass1" class="input-group-btn">
                            <button onclick="view()" onmouseover="$(this).css('background-color','#c0c0c0')"
                                onmouseleave="$(this).css('background-color','#f1f2f3')"
                                style="color: #000;background-color:#f1f2f3;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                class="btn btn-default search_btn" type="button"><span
                                    class="fas fa-eye"></span></button>
                        </span>
                        <span id="hide_pass1" class="input-group-btn" style="display: none;">
                            <button onclick="view()" onmouseover="$(this).css('background-color','#c0c0c0')"
                                onmouseleave="$(this).css('background-color','#f1f2f3')"
                                style="color: #000;background-color:#f1f2f3;padding-top:10px;padding-bottom: 10px;outline: none;"
                                class="btn btn-default search_btn" type="button"><span
                                    class="fas fa-eye-slash"></span></button>
                        </span>
                    </div>
                    <div class="forgot">
                        <a href="../../extras/OS/pages/FRL/forgot-password-v2.html">Forgot Password?</a>
                    </div>
                    <input class="shadow_b" type="button" onclick="login()" value="Login">
                </form>
            </div>
            <h4 style="color: white">For New People</h4>
            <p><a href="../Account/registered.php">Register Here</a> (Or) go back to <a href="index.html">Home<span
                        class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
        </div>
    </div>
</div>
<!-- //login -->
<?php
require "../Main/footer.php";
?>
<!--///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- Bootstrap Core JavaScript -->
<!--<script src="../../js/bootstrap.min.js"></script>-->
<!-- top-header and slider -->
<!-- here stars scrolling icon -->
<!-- //here ends scrolling icon -->
<!--<script src="../../js/minicart.min.js"></script>-->
<!--<script>
    // Mini Cart
    paypal.minicart.render({
        action: '#'
    });
    if (~window.location.search.indexOf('reset=true')) {
        paypal.minicart.reset();
    }
</script>-->
<!-- main slider-banner -->
<!--<script src="../../js/skdslider.min.js"></script>
<link href="../../css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
            jQuery('#responsive').change(function(){
              $('#responsive_wrapper').width(jQuery(this).val());
            });
        });
</script>-->
<!-- //main slider-banner -->
<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////-->
<script type="text/javascript">
    function ValidateEmail(mail) {
        if (/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(login_form.email.value)) {
            return true;
        }
        return false;
    }
    function view() {
        var pass1 = document.getElementById("passfir");
        if (pass1.type == 'password') {
            pass1.type = 'text';
            $("#dis_pass1").hide();
            $("#hide_pass1").show();
        }
        else {
            pass1.type = 'password';
            $("#dis_pass1").show();
            $("#hide_pass1").hide();
        }
    }
    function login() {
        var password = document.getElementById("passfir").value;
        var email = document.getElementById("email").value;
        if (email == null || email == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter your email ID !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("email").focus();
            return;
        }
        if (ValidateEmail(email) == false) {
            swal({
                title: "Oops!!!",
                text: "Invalid email address!!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("email").focus();
            return;
        }
        //password verification of null value
        if (password == null || password == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter the password !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("passfir").value = "";
            document.getElementById("passfir").focus();
            return;
        }
        else {
            $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "login": 1, "email": email, "password": password },  //form data
                type: "post",	//post data
                dataType: "json", 	//datatype=json format
                timeout: 18000,	//waiting time 3 sec
                success: function (data) {	//if logging in is success
                    if (data.admin == 'true' && data.user == 'true') {
                        Swal.fire({
                            title: "<span style='font-family-arial'>Log in as</span>",
                            text: "User (or) Store owner",
                            icon: "success",
                            showCancelButton: true,
                            showConfirmButton: true,
                            confirmButtonColor: 'red',
                            confirmButtonText: '<i class="fas fa-store"></i> Admin',
                            cancelButtonColor: 'green',
                            allowOutsideClick: false,
                            cancelButtonText: '<i class="fa fa-shopping-cart"></i> User'
                        })
                            .then((willSubmit) => {
                                if (willSubmit.dismiss) {
                                    location.href = "../Main/onestore.php";
                                }
                                else if (willSubmit.isConfirmed) {
                                    location.href = "../../store-admin/index.php?id=" + data.id + "";
                                }
                            });
                        return;
                    }
                    else if (data.status == 'success') {
                        swal({
                            title: "Success!!!",
                            text: "Log in Success",
                            icon: "success",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    location.href = "../Main/onestore.php";
                                }
                                else {
                                    return;
                                }
                            });
                    }
                    else if (data.admin == 'true') {
                        swal({
                            title: "Success!!!",
                            text: "Admin privileges granted",
                            icon: "success",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    location.href = "../../store-admin/index.php?id=" + data.id + "";
                                }
                                else {
                                    return;
                                }
                            });
                    }
                    else if (data.status == 'error') {
                        swal({
                            title: "Oops!!!",
                            text: "Error logging in",
                            icon: "error",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    location.reload();
                                }
                            });
                    }
                    else if (data.status == 'errornotfound') {
                        swal({
                            title: "Oops!!!",
                            text: "You are not registered yet",
                            icon: "error",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    location.reload();
                                }
                            });
                    }
                    else if (data.status == 'error1') {
                        swal({
                            title: "Check your mailbox!!!",
                            text: "Pending email verification",
                            icon: "warning",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    location.reload();
                                }
                            });
                    }
                },
                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
                    console.log("Logging in....", message, xmlhttprequest, textstatus);
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
                    }
                    else { return; }
                }
            }); //closing ajax
        }
    }
</script>
</body>

</html>