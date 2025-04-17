<?php
require "header.php"
    ?>
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="../Main/onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
            </li>
            <li class="active">Contact</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<style type="text/css">
    .input__label--ichiro::before {
        background-color: rgba(0, 0, 0, 0.55);
    }

    .w3_agileits_contact_grid_right textarea {
        background-color: rgba(0, 0, 0, 0.55);
    }

    textarea::-webkit-input-placeholder {
        /* Edge */
        color: white !important;
    }

    textarea:-ms-input-placeholder {
        /* Internet Explorer */
        color: white !important;
    }

    textarea::placeholder {
        color: white !important;
    }

    textarea::-webkit-input-placeholder {
        color: white !important;
    }

    textarea:-moz-placeholder {
        /* Firefox 18- */
        color: white !important;
    }

    textarea::-moz-placeholder {
        /* Firefox 19+ */
        color: white !important;
    }

    textarea:-ms-input-placeholder {
        color: white !important;
    }

    textarea::placeholder {
        color: white !important;
    }
</style>
<!-- contact -->
<div style="background:url(../../images/logo/store.jpg);width: 100%;">
    <div style="background-color: rgba(0,0,0,0.65);padding-right: 20px;padding-left: 20px; margin-top: 0px;">
        <div class="about" style="width: 100%">
            <div class="w3_agileits_contact_grids">
                <div class="col-md-5 w3_agileits_contact_grid_left">
                    <div class="agile_map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3922.6102591769463!2d76.21932811431537!3d10.531331466550668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba7ee5256ead4f5%3A0x561f76122d6724e6!2sMaharaja&#39;s%20Technological%20Institute%2C%20Thrissur!5e0!3m2!1sen!2sin!4v1625389112967!5m2!1sen!2sin"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="agileits_w3layouts_map_pos" style="background-color: #0c77aa">
                        <div class="agileits_w3layouts_map_pos1" style=" background-color: rgba(0,0,0,0.75)">
                            <img src="../../images/logo/logo.png">
                            <br><br>
                            <ul class="wthree_contact_info_address">
                                <li><i class="fa fa-envelope" aria-hidden="true"></i><a
                                        href="mailto:onestoreforallyourneeds@gmail.com">onestore</a></li>
                                <li><i class="fa fa-phone" aria-hidden="true"
                                        style="padding:0 14px 0 0;margin: 0;"></i>+91 8113990368</li>
                            </ul>
                            <div class="w3_agile_social_icons w3_agile_social_icons_contact">
                                <ul>
                                    <li><a href="https://www.facebook.com/falconsinfoworld/" target="_blank"
                                            class="icon icon-cube agile_facebook"></a></li>
                                    <li><a href="https://wa.me/[918113990368]?text=Hai%2C%20There!"
                                            data-action="share/whatsapp/share" target="_blank"
                                            class="icon icon-cube agile_phone"></a></li>
                                    <li><a href="mailto:onestoreforallyourneeds@gmail.com" target="_blank"
                                            class="icon icon-cube agile_email"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5 col-sm-12 w3_agileits_contact_grid_right">
                    <div style="background-color: #0c77aa;padding:5px;width: 100%;">
                        <div style="background-color: rgba(0,0,0,0.65);padding: 15px">
                            <h3 class="w3_agile_header"
                                style="color: white;font-weight: bolder;margin-top: 0px;padding-top: 20px;">Leave
                                a<span> Message</span></h3>
                            <form action="#" name="feedback_form" method="post"
                                style="background-color: rgba(0,0,0,0.55);padding: 5px;">
                                <span class="input input--ichiro">
                                    <input class="input__field input__field--ichiro" type="text" id="input-25"
                                        name="Name" onkeyup="checkname()" placeholder=" " required="" />
                                    <label class="input__label input__label--ichiro" for="input-25">
                                        <span class="input__label-content input__label-content--ichiro"
                                            style="color: white">Your Name</span>
                                    </label>
                                </span>
                                <p id="nameerror" style="display: none;color: red;font-weight: bolder;margin:0px"><i
                                        style="color: yellow" class="fa fa-warning"></i> Can't use any symbols(@ # $ %
                                    ... )</p>
                                <span class="input input--ichiro">
                                    <input class="input__field input__field--ichiro" type="email" onkeyup="checkmail()"
                                        id="input-26" name="Email" placeholder=" " required="" />
                                    <label class="input__label input__label--ichiro" for="input-26">
                                        <span class="input__label-content input__label-content--ichiro"
                                            style="color: white">Your Email</span>
                                    </label>
                                </span>
                                <p id="emailerror" style="display: none;color: red;font-weight: bolder;margin:0px"><i
                                        style="color: yellow" class="fa fa-warning"></i> example@gmail.com</p>
                                <textarea name="Message" style="color: white" id="input-27"
                                    placeholder="Your message here..." required=""></textarea>
                                <input class="button" style="background-color: #fe9126"
                                    onmouseover="$('.button').css('background-color','#0c99cc')"
                                    onmouseleave="$('.button').css('background-color','#fe9126')" type="button"
                                    onclick="feedback()" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
<!-- contact -->
<?php
require "footer.php";
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
    contactactive.className = "active";
    //Check name
    function checkname() {
        var name = document.getElementById('input-25').value;
        if (name == null || name == "") {
            $("#nameerror").hide();
            return;
        }
        else {
            $.ajax({
                url: "../Common/functions.php",
                data: { "checkname": 1, "name": name },
                dataType: "json",
                type: "post",
                timeout: 30000,
                success: function (data) {
                    if (data.status == 'success') {
                        $("#nameerror").hide();
                    }
                    else if (data.status == 'error') {
                        $("#nameerror").show();
                    }
                },
                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
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
    //Check Email
    function checkmail() {
        var email = document.getElementById('input-26').value;
        if (email == null || email == "") {
            $("#emailerror").hide();
            return;
        }
        else {
            $.ajax({
                url: "../Common/functions.php",
                data: { "checkmail": 1, "email": email },
                dataType: "json",
                type: "post",
                timeout: 30000,
                success: function (data) {
                    if (data.status == 'success') {
                        $("#emailerror").hide();
                    }
                    else if (data.status == 'error') {
                        $("#emailerror").show();
                    }
                },
                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
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
    //Feedback check
    function ValidateEmail(mail) {
        if (/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(feedback_form.Email.value)) {
            return true;
        }
        return false;
    }
    $(document).ready(function (e) {
        $("#setloc2").hide();
    });
    function feedback() {
        var name = document.getElementById('input-25').value;
        var email = document.getElementById('input-26').value;
        var message = document.getElementById('input-27').value;
        var namespace = name.split(" ");
        if (name == null || name == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter  your Name",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-25").focus();
            return;
        }
        //validating Name is not a number
        if (!(isNaN(name))) {
            swal({
                title: "Oops!!!",
                text: "Please use Albhabets",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-25").focus();
            return false;
        }
        else if (namespace.length > 1) {
            swal({
                title: "Oops!!!",
                text: "'SPACE' not allowed",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-25").focus();
            return false;
        }
        //limiting the name length
        else if (name.length > 20) {
            swal({
                title: "Oops!!!",
                text: "Entry is too long !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-25").focus();
            return false;
        }
        //minimal character check
        else if (name.length < 2) {
            swal({
                title: "Oops!!!",
                text: "Entry is too short !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-25").focus();
            return false;
        }
        //email verification of null value
        if (email == null || email == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter your email !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-26").focus();
            return false;
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
            document.getElementById("input-26").focus();
            return false;
        }
        //message check
        if (message == null || message == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter your message",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-27").focus();
            return false;
        }
        //validating message is not a number and its length above 4
        else if (!(isNaN(message)) || message.length < 5) {
            swal({
                title: "Oops!!!",
                text: "Invalid message",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("input-27").focus();
            return false;
        }
        else {
            $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "feedback": 1, "name": name, "email": email, "msg": message },  //form data
                type: "post",   //post data
                dataType: "json",   //datatype=json format
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {    //if registration is success
                    if (data.status == 'success') {
                        swal({
                            title: "Success!!!",
                            text: "Response recorded",
                            icon: "success",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit1) => {
                                if (willSubmit1) {
                                    location.href = "../Main/contact.php"
                                    return;
                                }
                                else {
                                    return;
                                }
                            });
                    }
                    else if (data.status == 'error') {
                        swal({
                            title: "Oops!!!",
                            text: "Try again later",
                            icon: "error",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    return;
                                }
                                else {
                                    return;
                                }
                            });
                    }
                    else if (data.status == 'error2') {
                        swal({
                            title: "Sorry!!!",
                            text: "Please log in ",
                            icon: "warning",
                            closeOnClickOutside: false,
                            dangerMode: true,
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    location.href = "../Account/login.php"
                                    return;
                                }
                                else {
                                    return;
                                }
                            });
                    }
                },
                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
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