<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location:../Main/onestore.php");
}
require "../Main/header.php";
?>
<style type="text/css">
    .left-log {
        color: white;
        font-weight: normal;
    }

    .my-account-active {
        color: #0f99cc;
        font-weight: bold;
        font-size: 16px;
    }

    .my-account {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .my-account:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        padding: 10px;
        font-weight: bold;
        font-size: 16px;
    }

    .my-account-active:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: #0f99cc;
        padding: 10px;
        font-weight: bold;
        font-size: 16px;
    }

    .account-li-bottom {
        padding: 0;
        margin: 0;
    }

    .account-details {
        display: none !important;
    }

    .account-details-active {
        display: unset !important;
    }

    .account-head {
        display: none !important;
    }

    .account-head-active {
        display: block !important;
    }

    @media (min-width: 992px) {
        .lt_menu {
            margin-top: 90px;
        }
    }

    /*TAB_regS*/
    /* Mark input boxes that gets an error on validation: */
    .invalid {
        background-color: #ffdddd !important;
    }

    .tab_reg {
        display: none;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #04AA6D;
    }

    button:hover {
        opacity: 0.8;
    }

    .stage_reg {
        color: #828282;
        background: #C8C8C8;
        width: 100%;
        height: 6px;
        float: left;
        margin: auto;
        display: block;
        margin-left: 0;
        margin-right: 0;
    }

    .round_reg {
        float: left;
        padding: 15px;
        margin: 0px;
        border: 5px solid white;
        border-radius: 50%;
        text-align: center;
        height: 50px;
        width: 50px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .stprd {
        display: flex;
    }

    .stage_reg.active {
        background-color: green;
    }

    .round_reg.active {
        background-color: green;
    }

    .input-text {
        font-weight: normal !important;
    }

    .load_btn {
        outline: none;
        border: none;
        padding: 10px 0;
        font-size: 1em;
        color: #fff;
        display: block;
        width: 100%;
        background: #3399cc;
        margin: 1.5em 0 0;
    }

    .checkmark {
        position: absolute;
        top: 0px;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 50%;
        margin-top: -3px;
    }

    .options input:checked~.checkmark:after {
        display: block
    }

    .options .checkmark:after {
        content: "";
        width: 9px;
        height: 9px;
        display: block;
        background: white;
        position: absolute;
        top: 52%;
        left: 51%;
        border-radius: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: 300ms ease-in-out 0s
    }

    .options input[type="radio"]:checked~.checkmark {
        background: #61b15a;
        transition: 300ms ease-in-out 0s
    }

    .options input[type="radio"]:checked~.checkmark:after {
        transform: translate(-50%, -50%) scale(1)
    }

    .radio label,
    .checkbox label {
        display: block;
        font-size: 14px;
        cursor: pointer;
        margin: 0
    }

    .options input {
        opacity: 0
    }

    .options {
        position: relative;
        padding-left: 25px;
    }

    .options input {
        opacity: 0
    }
</style>
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Register Page</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- register -->
<div class="register"
    style="background: url(../../images/logo/check1.jpg) no-repeat;padding-top: 0px;padding-bottom: 0px;position: sticky;background-size: cover;">
    <div style="background-color: rgba(0,0,0,0.55);width: 100%;height: 100%;padding-top: 20px;padding-bottom: 20px;">
        <div class="container" style="padding: 0px;">
            <div class="col-lg-4 col-md-5 lt_menu" style="color: white">
                <h3>Create Account</h3>
                <div class="stprd">
                    <div style="border-top-left-radius: 10px;border-bottom-left-radius: 10px "
                        class="stage_reg stage_reg_1 active"></div>
                    <div class="round_reg round_reg_1">1</div>
                    <div class="stage_reg stage_reg_2"></div>
                    <div class="stage_reg stage_reg_2"></div>
                    <div class="round_reg round_reg_2">2</div>
                    <div class="stage_reg stage_reg_3"></div>
                    <div class="stage_reg stage_reg_3"></div>
                    <div class="round_reg round_reg_3">3</div>
                    <div style="border-top-right-radius: 10px;border-bottom-right-radius: 10px "
                        class="stage_reg stage_reg_4"></div>
                </div>
                <br>
                <ul style="list-style: none;">
                    <a class="left-log">
                        <li class="ad my-account my-account-active">
                            <i class="fa fa-arrow-right"></i> Profile Information
                        </li>
                    </a>
                    <hr class="account-li-bottom">
                    <a class="left-log">
                        <li class="cep my-account">
                            <i class="fa fa-arrow-right"></i> Log in Information
                        </li>
                    </a>
                    <hr class="account-li-bottom">
                    <a class="left-log">
                        <li class="da my-account">
                            <i class="fa fa-arrow-right"></i> Delivery Address
                        </li>
                    </a>
                    <hr class="account-li-bottom">
                </ul>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-7 col-md-6">
                <h2 style="color: white;" class="account-head-active account-head acc_details">Profile Information</h2>
                <h2 style="color: white;" class="account-head changeep">Log in Information</h2>
                <h2 style="color: white;" class="account-head deladd">Delivery Address</h2>
                <div class="login-form-grids" style="border-top: 10px solid #fe9126;border-radius: 5px;width: 100%">
                    <div class="account-details pi account-details-active tab_reg">
                        <h5><i class="fa fa-info-circle fa-lg"></i>&nbsp;profile information</h5>
                        <!--<? php/* if(isset($_SESSION['error'])){
echo'<p style="color:red;float:left;">*'.."</p>";
unset($_SESSION['error']);
}*/ ?>-->
                        <form action="#" onsubmit="return err_display_fn();">
                            <?php
                            if (isset($_SESSION['reg_success'])) {
                                ?>
                                <div class="alert alert-success">Your message was sent successfully!</div>
                                <?php
                                unset($_SESSION['reg_success']);
                            }
                            ?>
                            <?php
                            if (isset($_SESSION['error'])) {
                                ?>
                                <div class="alert alert-danger"><?= $_SESSION['reg_error'] ?></div>
                                <?php
                                unset($_SESSION['reg_error']);
                            }
                            ?>
                            <p id="nameerror" style="display: none;color: red;font-weight: bolder;margin:0px"><i
                                    style="color: yellow" class="fa fa-warning"></i> Can't use any symbols(@ # $ % ... )
                            </p>
                            <div class="input-group input-group_form  bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 15px;">
                                <input type="text" id="first_name" oninput="$(this).removeClass('invalid');"
                                    required=" "
                                    style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                    pattern="^\S[a-zA-Z]{2,30}$" title="Minimum character '3'.Use alphabets"
                                    class="validate">
                                <label class="form-label" for="first_name">First Name</label>
                                <span class="input-group-btn">
                                    <button
                                        style="color: #000;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                        class="btn btn-default search_btn" type="button"><span class="fas fa-user"
                                            style="color: #777"></span></button>
                                </span>
                            </div>
                            <div class="input-group input-group_form bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 15px;">
                                <input type="text" id="last_name" oninput="$(this).removeClass('invalid');" required=" "
                                    style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;'"
                                    pattern="^[a-zA-Z ]{1,20}$" title="Use alphabets" class="validate">
                                <label class="form-label" for="last_name">Last Name</label>
                                <span class="input-group-btn">
                                    <button
                                        style="color: #000;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="   glyphicon glyphicon-text-color"></span></button>
                                </span>
                            </div>
                            <div class="input-group input-group_form bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 15px;">
                                <!---------------------------------------------------------------------------------------------------------------------------->
                                <div class="input-group-btn mob-panel" style=" position: relative;">
                                    <button type="button" class="btn btn-default dropdown-toggle mob-btn"
                                        onclick="moblistview()"
                                        style="position: relative;padding:10px;border-top-right-radius:0px;border-bottom-right-radius:0px;">
                                        <span class="mob_concept">+91</span> <span class="caret mob_pan"></span>
                                    </button>
                                    <ul class="dropdown-menu mobcategory" role="menu"
                                        style="position: absolute;display: none;background-color: #CACACA !important;min-width:55px !important;">
                                        <li><a style="font-family:arial;padding-left:10px;padding-right:10px"
                                                href="#+91">+91</a></li>
                                    </ul>
                                </div>
                                <!---------------------------------------------------------------------------------------------------------------------------->
                                <input type="tel" id="phone" oninput="$(this).removeClass('invalid')" required=" "
                                    style="margin: 0px;z-index: 0;border-radius: 0px;"
                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57;"
                                    pattern="^\d{10}$" title="Phone Number Format (9876543210)- 10 digits"
                                    maxlength="10" class="validate">
                                <label class="form-label label-ph" for="phone">Phone</label>
                                <span class="input-group-btn">
                                    <button
                                        style="color: #000;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="glyphicon glyphicon-earphone"></span></button>
                                </span>
                            </div>
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!--PIN & LOCATE-->
                            <ul style=";margin-bottom: -20px;">
                                <li style="list-style:none; ">
                                    <div id="pin" class="input-group input-group_form bar-srch input-field"
                                        style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                        <input type="tel" oninput="$(this).removeClass('invalid')"
                                            class="locmark validate" id="regpin" value="" name="pincode" maxlength="6"
                                            required=" "
                                            style="width: 100%;margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;'"
                                            onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                            pattern="^\d{6}$" title="PIN Number Format (654321)- 6 digits">
                                        <label class="form-label" for="regpin">PIN</label>
                                        <span id="dis_pin" class="input-group-btn">
                                            <button onclick="dis_pin()"
                                                onmouseover="$(this).css('background-color','#0c66cc')"
                                                onmouseleave="$(this).css('background-color','#0c77cc')"
                                                style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                                class="btn btn-default search_btn" type="button"><span
                                                    class="fa fa-lg fa-map-marker"></span></button>
                                        </span>
                                        <span id="hide_pin1" class="input-group-btn" style="display: none;">
                                            <button onclick="reglocate()"
                                                onmouseover="$(this).css('background-color','#ee8126');$(this).css('border-color','#ee8126')"
                                                onmouseleave="$(this).css('background-color','#fe9126');$(this).css('border-color','#fe9126')"
                                                style="color: white;background-color:#fe9126;padding-top:10px;padding-bottom: 10px;outline: none;border-color:#fe9126 "
                                                class="btn btn-default search_btn" type="button"><span
                                                    class="fa fa-search"></span></button>
                                        </span>
                                        <span id="hide_pin" class="input-group-btn" style="display: none;">
                                            <button onclick="reset_pin()"
                                                onmouseover="$(this).css('background-color','#bb0000')"
                                                onmouseleave="$(this).css('background-color','red')"
                                                style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;"
                                                class="btn btn-default search_btn" type="button"><span
                                                    class="fa fa-close" style="margin-left: -18px;"></span></button>
                                        </span>
                                    </div>
                                    <!---------------------------------------------------------------------------------------------------------------------------------------------->
                                    <!---------------------------------------------------------------------------------------------------------------------------------------------->
                                    <div id="setloc2" style="display: none;">
                                        <div class="input-group input-group_form bar-srch input-field"
                                            style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                            <select name="po_list" oninput="$(this).removeClass('invalid')"
                                                class="locmark validate" id="po_list1" name="pincode" required=" "
                                                style="width: 100%;height: 40px;margin: 0px;z-index: 0;border-radius: 5px;border:1px solid #DBDBDB;border-top-right-radius: 0px;border-bottom-right-radius: 0px;'">
                                                <option value="0" selected="" disabled="">Location</option>
                                            </select>
                                            <span id="hide_locate" class="input-group-btn">
                                                <button onclick="regsetlocation()"
                                                    onmouseover="$(this).css('background-color','#4f994f')"
                                                    onmouseleave="$(this).css('background-color','#006904')"
                                                    style="color: white;background-color:#006904;padding-top:10px;padding-bottom: 10px;outline: none;"
                                                    class="btn btn-default search_btn popuptext pin" type="button"><span
                                                        class="fa fa-check"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                </li><br>
                            </ul>
                            <!--PIN & LOCATE-->
                            <!------------------------------------------------------------------------------------------------------------------------------------------->
                            <!------------------------------------------------------------------------------------------------------------------------------------------->
                            <!------------------------------------------------------------------------------------------------------------------------------------------->
                            <!------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="form-group input-field"
                                style="text-align: right;width: 100%;position: relative;">
                                <textarea rows="4" oninput="$(this).removeClass('invalid')"
                                    title="Minimal character count is 10" required="" id="address"
                                    class="validate"></textarea>
                                <label class="form-label" for="address">Address</label>
                                <span class="glyphicon glyphicon-home glyphicon-sm"
                                    style="position: absolute;right: 0;top: 0;padding: 4px;"></span>
                            </div>
                            <div class="register-check-box">
                                <div class="check">
                                    <label class="checkbox"><input type="checkbox" id="subscribe" name="checkbox"><i>
                                        </i>Subscribe to Newsletter</label>
                                </div>
                            </div>
                            <br>
                            <hr style="padding: 0px;margin: 0px;">
                            <input type="submit" id="profile_button" style="display:none" />
                    </div>
                    </form>
                    <!------------------------------------------------------------------------------------------------------------------------------------------>
                    <!------------------------------------------------------------------------------------------------------------------------------------------>
                    <!------------------------------------------------------------------------------------------------------------------------------------------>
                    <!------------------------------------------------------------------------------------------------------------------------------------------>
                    <form action="#" onsubmit="return err_display_fn();">
                        <div class="li account-details tab_reg" style="">
                            <!--EMAIL-->
                            <h6 style="margin-top: 0px !important;"><i class="fa fa-info-circle fa-lg"></i>&nbsp;Login
                                information</h6>
                            <p id="emailerror" style="display: none;color: red;font-weight: bolder;margin:0px"><i
                                    style="color: yellow" class="fa fa-warning"></i> example@gmail.com</p>
                            <div class="input-group input-group_form bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 15px;">
                                <input type="email" oninput="$(this).removeClass('invalid')" name="email" id="email"
                                    required=" "
                                    style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;'"
                                    class="validate">
                                <label class="form-label" for="email">Email Address</label>
                                <span class="input-group-btn">
                                    <button
                                        style="color: #000;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="glyphicon glyphicon-envelope"></span></button>
                                </span>
                            </div>
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!--PASSWORD-->
                            <p class="capson_warning" style="display: none;color: #d9534f"><i class="fa fa-warning"></i>
                                &nbsp;WARNING! Caps lock is ON.</p>
                            <div id="pass" style="">
                                <div class="input-group input-group_form bar-srch input-field"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 15px;">
                                    <input type="password" id="passfir" oninput="$(this).removeClass('invalid')"
                                        value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                        required=" " class="password_fields validate"
                                        style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                        onblur="err_display_fn()">
                                    <label class="form-label" for="passfir">Password</label>
                                    <span id="dis_pass1" class="input-group-btn">
                                        <button onclick="view()" onmouseover="$(this).css('background-color','#c0c0c0')"
                                            onmouseleave="$(this).css('background-color','#f1f2f3')"
                                            style="color: #000;background-color:#f1f2f3;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                            class="reg-btn-pass btn btn-default search_btn" type="button"><span
                                                class="fas fa-eye"></span></button>
                                    </span>
                                    <span id="hide_pass1" class="input-group-btn" style="display: none;">
                                        <button onclick="view()" onmouseover="$(this).css('background-color','#c0c0c0')"
                                            onmouseleave="$(this).css('background-color','#f1f2f3')"
                                            style="color: #000;background-color:#f1f2f3;padding-top:10px;padding-bottom: 10px;outline: none;"
                                            class="reg-btn-pass btn btn-default search_btn" type="button"><span
                                                class="fas fa-eye-slash"></span></button>
                                    </span>
                                </div>
                                <div id="message" style="display:none">
                                    <h5>Password must contain the following:</h5>
                                    <p id="letter" class="invalid-msg">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid-msg">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid-msg">A <b>number</b></p>
                                    <p id="length" class="invalid-msg">Minimum <b>8 characters</b></p>
                                </div>
                                <div class="input-group input-group_form bar-srch input-field"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 15px;">
                                    <input type="password" oninput="$(this).removeClass('invalid')" id="passre"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Confirm your password by re-type as above" required=" "
                                        class="password_fields validate"
                                        style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                                    <label class="form-label" for="passre">Confirm password</label>
                                    <span class="input-group-btn">
                                        <button
                                            style="color: #000;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                            class=" btn btn-default search_btn" type="button"><span
                                                class="glyphicon glyphicon-lock"></span></button>
                                    </span>
                                </div>
                            </div>
                            <hr style="padding: 0px;margin: 0px;">
                            <input type="submit" id="login_button" style="display:none" />
                        </div>
                    </form>
                    <!--PASSWORD-->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------->
                    <form action="#" onsubmit="return err_display_fn();">
                        <div class="ada account-details tab_reg">
                            <!--EMAIL-->
                            <h6 style="margin-top: 0px !important;"><i
                                    class="fa fa-info-circle fa-lg"></i>&nbsp;Delivery Address</h6>
                            <p style="color:#666"><b>Note<b><span style="font-weight:normal"> : You can skip this step
                                            for now by choosing </span><b>"USE AS REGISTER DETAILS"<b></p>
                            <p id="emailerror" style="display: none;color: red;font-weight: bolder;margin:0px"><i
                                    style="color: yellow" class="fa fa-warning"></i> example@gmail.com</p>
                            <br>
                            <h5 id="ship-to-different-address" class="">
                                <label class="options" for="use-as-register-checkbox">Use as register details?
                                    <input type="radio" onclick="" style="float: left;" value="register_details"
                                        name="use-as-register-checkbox" id="use-as-register-checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <br><br>
                                <label class="options" for="stda_check">Add to a different address?
                                    <input type="radio" style="float: left;" onclick="stda()"
                                        name="use-as-register-checkbox" class="stda-checkbox" id="stda_check"> <span
                                        class="checkmark"></span>
                                </label>
                            </h5>
                            <div class="shipping_address" style="display: none;" id="stda_div">
                                <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="shipping_first_name"
                                        style="font-weight: normal;text-transform: capitalize;">First Name <abbr
                                            title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                        placeholder="First name" id="shipping_first_name" name="shipping_first_name"
                                        class="input-text validate" pattern="^\S[a-zA-Z]{3,30}$"
                                        title="Minimum character '3'.Use alphabets" required="">
                                </p>
                                <p id="shipping_last_name_field" class="form-row form-row-last validate-required">
                                    <label class="" for="shipping_last_name"
                                        style="font-weight: normal;text-transform: capitalize;">Last Name <abbr
                                            title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                        placeholder="Last name" id="shipping_last_name" name="shipping_last_name"
                                        class="input-text validate" pattern="^[a-zA-Z ]{1,20}$" title="Use alphabets"
                                        required="">
                                </p>
                                <p id="shipping_phone_number_field" class="form-row form-row-last validate-required">
                                    <label class="" for="shipping_phone_number"
                                        style="font-weight: normal;text-transform: capitalize;">Phone Number<abbr
                                            title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                        placeholder="Phone number" id="shipping_ph_no" maxlength="10"
                                        name="shipping_ph_no" class="input-text validate"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57;"
                                        pattern="^\d{10}$" title="Phone Number Format (9876543210)- 10 digits"
                                        required="">
                                </p>
                                <p id="shipping_phone_number2_field" class="form-row form-row-last validate-required">
                                    <label class="" for="shipping_ph_no2"
                                        style="font-weight: normal;text-transform: capitalize;">Alternate phone
                                        number<small title="required" class="required" style="color: #c50505">
                                            (Optional)</small>
                                    </label>
                                    <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                        placeholder="Alternate Phone Number" id="shipping_ph_no2" maxlength="10"
                                        name="shipping_ph_no2" class="input-text validate"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57;"
                                        pattern="^(\d{0}|\d{10})$" title="Phone Number Format (9876543210)- 10 digits">
                                </p>
                                <div class="clear"></div>
                                <p id="shipping_address_1_field"
                                    class="form-row form-row-wide address-field validate-required">
                                    <label class="" for="shipping_address_1"
                                        style="font-weight: normal;text-transform: capitalize;">Address <abbr
                                            title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <textarea oninput="$(this).removeClass('invalid')" value=""
                                        title="Minimal character count is 10" placeholder="Street address"
                                        id="shipping_address_1" name="shipping_address_1" class="input-text validate"
                                        required=""></textarea>
                                </p>
                                <p id="shipping_postcode_field"
                                    class="form-row form-row-last address-field validate-required validate-postcode"
                                    data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                                    <label class="" for="shipping_postcode"
                                        style="font-weight: normal;text-transform: capitalize;">Postcode <abbr
                                            title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                        placeholder="Postcode / Zip" id="shipping_postcode" maxlength="6"
                                        name="shipping_postcode" class="input-text validate"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        pattern="^\d{6}$" title="PIN Number Format (654321)- 6 digits" required="">
                                </p>
                                <div class="clear"></div>
                                <input type="submit" id="delivery_button" style="display:none" />
                            </div>
                        </div>
                        <br>
                        <div id="update_user_details" style="display: none;">
                            <div class="register-check-box">
                                <div class="check">
                                    <label class="checkbox"><input type="checkbox" id="accept" name="checkbox"><i> </i>I
                                        accept the <a href="../Main/terms&conditions.php" target="_blank">terms and
                                            conditions</a></label>
                                </div>
                            </div>
                            <div class="div-wrapper"
                                style="display: flex;align-items: flex-end;justify-content: flex-end;">
                                <button type="button"
                                    style="padding:8px;border-radius: 50%;padding-left: 9px;padding-right: 9px;background-color: #02171e"
                                    onclick="nextPrev(-1)">
                                    <i class="fa fa-lg fa-arrow-left" style="color: #fff"></i>
                                </button>
                                <input class="shadow_b real_btn" type="button" onclick="checkregister()"
                                    value="Register">
                                <button class="shadow_b load_btn" style="display:none" type="button"><i
                                        class="fa fa-refresh fa-spin"></i>&nbsp;Register</button>
                            </div>
                        </div>
                        <!------------------------------------------------------------------------------------------------------------------------------>
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" id="prevBtn"
                                    style="background-color: #999;color: #ffffff;border: none;padding: 6px 10px;font-size: 15px;font-family: Raleway;cursor: pointer;"
                                    onclick="nextPrev(-1)">Previous</button>
                                <button type="button" id="nextBtn"
                                    style="background-color: #0c77cc;color: #ffffff;border: none;padding: 6px 20px;font-size: 15px;font-family: Raleway;cursor: pointer;"
                                    onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        <!------------------------------------------------------------------------------------------------------------------------------>
                    </form>
                </div>
                <div class="register-home">
                    <a href="../Main/onestore.php" onmouseover="$(this).css('background-color','#0c66cc')"
                        onmouseleave="$(this).css('background-color','#fe9126')"
                        style="color: white;background-color:#fe9126;">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //register -->
<?php
require "../Main/footer.php";
?>
<!--///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- Bootstrap Core JavaScript -->
<!--<script src="../../js/bootstrap.min.js"></script>-->
<!-- top-header and slider -->
<!-- here stars scrolling icon --><!--
    <script type="text/javascript">
        $(document).ready(function() {
            /*
                var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
                };
            */
            $().UItoTop({ easingType: 'easeOutQuart' });
            });
    </script>-->
<!-- //here ends scrolling icon -->
<!--<script src="../../js/minicart.min.js"></script>-->
<!--///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////-->
<script>
    var page_selector = 0;
    var currentTab_reg = 0; // Current tab_reg is set to be the first tab_reg (0)
    showTab_reg(currentTab_reg); // Display the current tab_reg
    function showTab_reg(n) {
        // This function will display the specified tab_reg of the form...
        var x = document.getElementsByClassName("tab_reg");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("nextBtn").style.display = "inline";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("nextBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            //document.getElementById("nextBtn").innerHTML = "Submit";
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }
    function nextPrev(n) {
        // This function will figure out which tab_reg to display
        var x = document.getElementsByClassName("tab_reg");
        // Exit the function if any field in the current tab_reg is invalid:
        if (n == 1 && !validateForm()) { return false; }
        else {
            page_selector += n;
            if (page_selector == 0) {
                $('.my-account').removeClass('my-account-active'); $('.ad').addClass('my-account-active'); $('.account-details').removeClass('account-details-active'); $('.pi').addClass(' account-details-active'); $('.account-head').removeClass('account-head-active'); $('.acc_details').addClass(' account-head-active');
                $('#update_user_details').hide();
                $('.round_reg').removeClass('active');
                $('.stage_reg').removeClass('active');
                $('.stage_reg_1').addClass('active');
            }
            else if (page_selector == 1) {
                $('.my-account').removeClass('my-account-active'); $('.cep').addClass('my-account-active'); $('.account-details').removeClass('account-details-active'); $('.li').addClass(' account-details-active'); $('.account-head').removeClass('account-head-active'); $('.changeep').addClass(' account-head-active');
                $('#update_user_details').hide();
                $('.round_reg').removeClass('active');
                $('.stage_reg').removeClass('active');
                $('.stage_reg_1').addClass('active');
                $('.round_reg_1').addClass('active');
                $('.stage_reg_2').addClass('active');
            }
            else if (page_selector == 2) {
                $('.my-account').removeClass('my-account-active'); $('.da').addClass('my-account-active'); $('.account-details').removeClass('account-details-active'); $('.ada').addClass(' account-details-active'); $('.account-head').removeClass('account-head-active'); $('.deladd').addClass(' account-head-active');
                $('#update_user_details').show();
                $('.round_reg').removeClass('active');
                $('.stage_reg').removeClass('active');
                $('.stage_reg_1').addClass('active');
                $('.round_reg_1').addClass('active');
                $('.stage_reg_2').addClass('active');
                $('.round_reg_2').addClass('active');
                $('.stage_reg_3').addClass('active');
                //$('.round_reg_3').removeClass('active');
                //$('.stage_reg_4').removeClass('active');
            }
        }
        // Hide the current tab_reg:
        x[currentTab_reg].style.display = "none";
        // Increase or decrease the current tab_reg by 1:
        currentTab_reg = currentTab_reg + n;
        // if you have reached the end of the form...
        if (currentTab_reg >= x.length) {
            // ... the form gets submitted:
            checkregister();
            return false;
        }
        // Otherwise, display the correct tab_reg:
        showTab_reg(currentTab_reg);
    }
    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab_reg");
        y = x[currentTab_reg].getElementsByTagName("input");
        if ($('.account-head-active').html() == 'Profile Information') {
            if (!profile_check()) {
                valid = false;
            }
        }
        if ($('.account-head-active').html() == 'Log in Information') {
            if (!login_info_check()) {
                valid = false;
            }
        }
        if ($('.account-head-active').html() == 'Delivery Address') {
            valid = true;
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab_reg].className += " finish";
        }
        return valid; // return the valid status
    }
    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    var checkBox_diff = document.getElementById("stda_check");
    var checkBox_user = document.getElementById("use-as-register-checkbox");
    function stda() {
        if (checkBox_diff.checked == true) {
            $("#stda_div").css("display", "block");
        }
        else {
            $("#stda_div").css("display", "none");
        }
    }
    window.addEventListener("click", function () {
        if (checkBox_diff.checked == true) {
            checkBox_user.checked = false;
        }
        else if (checkBox_user.checked == true) {
            checkBox_diff.checked = false;
        }
    });
    checkBox_user.addEventListener("click", function () {
        $("#stda_div").css("display", "none");
        checkBox_diff.checked = false;
    });
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Mini Cart
    paypal.minicart.render({
        action: '#'
    });
    if (~window.location.search.indexOf('reset=true')) {
        paypal.minicart.reset();
    }
</script>
<!-- main slider-banner -->
<script src="../../js/skdslider.min.js"></script>
<link href="../../css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#demo1').skdslider({ 'delay': 5000, 'animationSpeed': 2000, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading' });
        jQuery('#responsive').change(function () {
            $('#responsive_wrapper').width(jQuery(this).val());
        });
    });
</script>
<!-- //main slider-banner -->
<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>-->
<?php
if (isset($_GET['verified'])) {
    if ($_GET['verified'] == "yes") {
        ?>
        <script type="text/javascript">
            swal({
                title: "Account Activated",
                text: "Redirecting to login page",
                icon: "success",
                closeOnClickOutside: false,
                dangerMode: true,
            })
                .then((willSubmit) => {
                    if (willSubmit) {
                        location.href = "../Account/login.php";
                        return;
                    }
                    else {
                        return;
                    }
                });
        </script>
        <?php
    }
}
?>
<script type="text/javascript">
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //PIN
    function dis_pin() {
        if ($('#hide_pin').css('display') == 'none') {
            $('#dis_pin').hide();
            $('#hide_pin').show();
            $('#hide_pin1').show();
            document.getElementById("regpin").readOnly = false;
            document.getElementById("regpin").focus();
            var updatedetailInput = $("#regpin");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
    }
    function reset_pin() {
        $('#dis_pin').show();
        $('#hide_pin').hide();
        $('#hide_pin1').hide();
        $('#setloc2').hide();
        document.getElementById("regpin").value = "";
        document.getElementById("po_list1").value = 0;
        document.getElementById("regpin").readOnly = true;
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //LOCATE
    function dis_locate() {
        if ($('#hide_locate').css('display') != 'none') {
            $('#dis_pin').show();
            $('#hide_pin').hide();
            $('#hide_pin1').hide();
            document.getElementById("regpin").readOnly = true;
        }
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //Check name
    function checkname() {
        var name = document.getElementById('first_name').value;
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
        var email = document.getElementById('email').value;
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
    function ValidateEmail(mail) {
        if (/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(mail)) {
            return true;
        }
        return false;
    }
    $(document).ready(function (e) {
        $("#setloc2").hide();
    });
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function err_display_fn() {
        return false;
    }
    function profile_check() {
        var first_name = document.getElementById("first_name").value;
        var last_name = document.getElementById("last_name").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var regpin = document.getElementById("regpin").value;
        var loc = document.getElementById("po_list1").value;
        //checking unwanted space
        var first_namespace = first_name.split(" ");
        var Last_namespace = last_name.split(" ");
        //validating first name isempty
        if (first_name == null || first_name == "") {
            $('#profile_button').click();
            document.getElementById("first_name").focus();
            document.getElementById("first_name").className += " invalid";
            return false;
        }
        //validating first name is not a number
        if (!(isNaN(first_name))) {
            /*
                        swal({
                        title: "Oops!!!",
                        text: "Please use Albhabets",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#profile_button').click();
            document.getElementById("first_name").focus();
            document.getElementById("first_name").className += " invalid";
            return false;
        }
        //validating white spaces
        else if (first_namespace.length > 1) {
            swal({
                title: "Oops!!!",
                text: "'SPACE' not allowed",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('#profile_button').click();
            document.getElementById("first_name").focus();
            document.getElementById("first_name").className += " invalid";
            return false;
        }
        //limiting the name length
        else if (first_name.length > 20) {
            /*
                        swal({
                        title: "Oops!!!",
                        text: "Entry is too long !!! ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#profile_button').click();
            document.getElementById("first_name").focus();
            document.getElementById("first_name").className += " invalid";
            return false;
        }
        //minimal character check
        else if (first_name.length < 2) {
            /*
                        swal({
                        title: "Oops!!!",
                        text: "Entry is too short !!! ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#profile_button').click();
            document.getElementById("first_name").focus();
            document.getElementById("first_name").className += " invalid";
            return false;
        }
        //validating last name isempty
        if (last_name == null || last_name == "") {
            /*
                        swal({
                        title: "Oops!!!",
                        text: "Please enter  your last name",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#profile_button').click();
            document.getElementById("last_name").focus();
            document.getElementById("last_name").className += " invalid";
            return false;
        }
        //validating first name is not a number
        else if (!(isNaN(last_name))) {
            swal({
                title: "Oops!!!",
                text: "Please use Albhabets",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('#profile_button').click();
            document.getElementById("last_name").focus();
            document.getElementById("last_name").className += " invalid";
            return false;
        }
        //Phone number check
        if (phone == null || phone == "") {
            /*
                        swal({
                        title: "Oops!!!",
                        text: "Please enter your phone number",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#profile_button').click();
            document.getElementById("phone").focus();
            document.getElementById("phone").className += " invalid";
            return false;
        }
        //validating Phone is a number
        else if (isNaN(phone) || phone.length != 10) {
            /*
                        swal({
                        title: "Oops!!!",
                        text: "Invalid phone number",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#profile_button').click();
            document.getElementById("phone").focus();
            document.getElementById("phone").className += " invalid";
            return false;
        }
        //PIN check
        //PIN check
        else if (regpin == null || regpin == "") {
            /*
                swal({
                        title: "Oops!!!",
                        text: "Please enter the pincode !!! ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
            */
            $('#profile_button').click();
            document.getElementById("regpin").focus();
            document.getElementById("regpin").className += " invalid";
            return false;
        }
        else if (regpin.length != 6) {
            swal({
                title: "Oops!!!",
                text: "Please enter valid pincode !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('#profile_button').click();
            document.getElementById("regpin").value = "";
            document.getElementById("regpin").focus();
            document.getElementById("regpin").className += " invalid";
            return false;
        }
        //PIN check
        //Location
        else if (loc == 0) {
            swal({
                title: "Missing location!!!",
                text: "Please search your pin !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("po_list1").focus();
            document.getElementById("po_list1").className += " invalid";
            return false;
        }
        //Location
        //address check
        if (address == null || address == "") {
            $('#profile_button').click();
            document.getElementById("address").focus();
            document.getElementById("address").className += " invalid";
            return false;
        }
        //validating address if its length above 4
        if (address != null && address.length < 8) {
            swal({
                title: "Oops!!!",
                text: "Invalid Address",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('#profile_button').click();
            document.getElementById("address").focus();
            document.getElementById("address").className += " invalid";
            return false;
        }
        return true;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var pass_input = document.getElementById('passfir');
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    // When the user clicks outside of the password field, hide the message box
    pass_input.onblur = function () {
        document.getElementById("message").style.display = "none";
    }
    // When the user starts to type something inside the password field
    pass_input.onkeyup = function () {
        // When the user clicks on the password field, show the message box
        document.getElementById("message").style.display = "block";
        var crt = 0;
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (pass_input.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid-msg");
            letter.classList.add("valid-msg");
            crt++;
        } else {
            letter.classList.remove("valid-msg");
            letter.classList.add("invalid-msg");
        }
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if (pass_input.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid-msg");
            capital.classList.add("valid-msg");
            crt++;
        } else {
            capital.classList.remove("valid-msg");
            capital.classList.add("invalid-msg");
        }
        // Validate numbers
        var numbers = /[0-9]/g;
        if (pass_input.value.match(numbers)) {
            number.classList.remove("invalid-msg");
            number.classList.add("valid-msg");
            crt++;
        } else {
            number.classList.remove("valid-msg");
            number.classList.add("invalid-msg");
        }
        // Validate length
        if (pass_input.value.length >= 8) {
            length.classList.remove("invalid-msg");
            length.classList.add("valid-msg");
            crt++;
        } else {
            length.classList.remove("valid-msg");
            length.classList.add("invalid-msg");
        }
        if (crt == 4) {
            document.getElementById("message").style.display = "none";
        }
    }
    function login_info_check() {
        var pass_input = document.getElementById('passfir');
        var email = document.getElementById("email").value;
        var pass1 = document.getElementById("passfir").value;
        var pass2 = document.getElementById("passre").value;
        //email verification of null value
        if (email == null || email == "") {
            /*
                swal({
                        title: "Oops!!!",
                        text: "Please enter your email ID !!! ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#login_button').click();
            document.getElementById("email").focus();
            document.getElementById("email").className += " invalid";
            return false;
        }
        if (ValidateEmail(email) == false) {
            /*
                swal({
                        title: "Oops!!!",
                        text: "Invalid email address!!! ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#login_button').click();
            document.getElementById("email").focus();
            document.getElementById("email").className += " invalid";
            return false;
        }
        //password verification of null value
        if (pass1 == null || pass1 == "") {
            /*    swal({
                        title: "Oops!!!",
                        text: "Please enter the password !!! ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#login_button').click();
            document.getElementById("passfir").focus();
            document.getElementById("passfir").className += " invalid";
            return false;
        }
        // Validate lowercase letters
        var lowerCaseLetters = !/[a-z]/g;
        if (pass_input.value.match(lowerCaseLetters)) {
            $('#login_button').click();
            document.getElementById("passfir").focus();
            document.getElementById("passfir").className += " invalid";
            return false;
        }
        // Validate capital letters
        var upperCaseLetters = !/[A-Z]/g;
        if (pass_input.value.match(upperCaseLetters)) {
            $('#login_button').click();
            document.getElementById("passfir").focus();
            document.getElementById("passfir").className += " invalid";
            return false;
        }
        // Validate numbers
        var numbers = !/[0-9]/g;
        if (pass_input.value.match(numbers)) {
            $('#login_button').click();
            document.getElementById("passfir").focus();
            document.getElementById("passfir").className += " invalid";
            return false;
        }
        //weak password verification
        if (pass1.length < 8) {
            /*
                swal({
                        title: "Oops!!!",
                        text: "Weak Password !!! Try again ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                        });
            */
            $('#login_button').click();
            document.getElementById("passfir").focus();
            document.getElementById("passfir").className += " invalid";
            return false;
        }
        //confirming password
        if (pass2 == "" || pass2 == null) {
            $('#login_button').click();
            document.getElementById("passre").focus();
            document.getElementById("passre").className += " invalid";
            return false;
        }
        //confirming both passwords are same
        if (pass1 != pass2) {
            swal({
                title: "Oops!!!",
                text: "Passwords do not match !!! Try again ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("passfir").focus();
            document.getElementById("passfir").className += " invalid";
            document.getElementById("passre").className += " invalid";
            return false;
        }
        return true;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function checkregister() {
        //fetch data into variables
        var first_name = document.getElementById("first_name").value;
        var last_name = document.getElementById("last_name").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var email = document.getElementById("email").value;
        var pass1 = document.getElementById("passfir").value;
        var pass2 = document.getElementById("passre").value;
        var regpin = document.getElementById("regpin").value;
        var loc = document.getElementById("po_list1").value;
        var checkBox_diff = document.getElementById("stda_check");
        var checkBox_user = document.getElementById("use-as-register-checkbox");
        if (checkBox_user.checked == false && checkBox_diff.checked == false) {
            toastr.error('Require Delivery Address!!!');
            return false;
        }
        else {
            if (checkBox_user.checked == true) {
                if (document.getElementById("accept").checked == false) {
                    swal({
                        title: "Oops!!!",
                        text: "Please Accept the terms and conditions",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
                    return false;
                }
                $('.round_reg_3').addClass('active');
                $('.stage_reg_4').addClass('active');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You are about to register !!!",
                    icon: "warning",
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: 'red',
                    allowOutsideClick: false,
                    confirmButtonText: '<i class="fa fa-close"></i> Cancel',
                    cancelButtonColor: 'green',
                    cancelButtonText: '<i class="fa fa-check"></i> Register'
                })
                    .then((willSubmit) => {
                        if (willSubmit.dismiss) {
                            $('.background_loader').css('display', 'flex');
                            $('.load_btn').show();
                            $('.real_btn').hide();
                            $('.std_text2').css('display', 'flex');
                            if (document.getElementById("subscribe").checked == true) {
                                var subscribe = "1";
                            }
                            else {
                                var subscribe = "0";
                            }
    //var post="http://api.positionstack.com/v1/forward?access_key=02d2fe0121d695587c3ea6ec300a8a8e&query="+loc+"";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   /* var post="http://api.positionstack.com/v1/forward?access_key=02d2fe0121d695587c3ea6ec300a8a8e&query="+loc+"";//JSON RESPONSE
//REQUIRED FOR GEOLOCATION ACCESS
    var xmlhttp = new XMLHttpRequest();//HTTP REQUEST START
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { ////START IF
            addr = JSON.parse(this.responseText);
            console.log(addr);
            var lat=addr.data[0].latitude;
            console.log(lat);
            var long=addr.data[0].longitude;
            console.log(long); */
/*//NOT NECESSARY
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("my-address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      alert("Latitude: "+results[0].geometry.location.lat());
      alert("Longitude: "+results[0].geometry.location.lng());
      }
      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
*/var lat = long = 0;
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            $.ajax({
                                url: "../Common/functions.php", //passing page info
                                data: { "register": 1, "delivery": 1, "first_name": first_name, "last_name": last_name, "phone": phone, "pin": regpin, "location": loc, "latitude": lat, "longitude": long, "address": address, "subscribe": subscribe, "email": email, "password": pass1 },  //form data
                                type: "post",   //post data
                                dataType: "json",   //datatype=json format
                                timeout: 30000,   //waiting time 30 sec
                                success: function (data) {    //if registration is success
                                    if (data.status == 'success') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Success!!!",
                                            text: "Registered Successfully",
                                            icon: "success",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit1) => {
                                                if (willSubmit1) {
                                                    swal({
                                                        title: "Activate Account",
                                                        text: "Please check your mail !",
                                                        icon: "warning",
                                                        closeOnClickOutside: false,
                                                        dangerMode: true,
                                                    })
                                                        .then((willSubmit2) => {
                                                            if (willSubmit2) {
                                                                location.href = "../Main/onestore.php"
                                                                return false;
                                                            }
                                                            else {
                                                                return false;
                                                            }
                                                        })
                                                }
                                                else {
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "Account already exists",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    document.getElementById("email").className += " invalid";
                                                    document.getElementById("email").focus();
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error2') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "Email is not valid",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    document.getElementById("email").className += " invalid";
                                                    document.getElementById("email").focus();
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error3') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "First name is not valid",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    document.getElementById("first_name").className += " invalid";
                                                    document.getElementById("first_name").focus();
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error1') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "Phone number already exists",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    document.getElementById("phone").className += " invalid";
                                                    document.getElementById("phone").focus();
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                },
                                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
                                    if (textstatus === "timeout") {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
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
                                    else { return false; }
                                }
                            }); //closing ajax
                            /*
                                } //closing xmlhttprequest for lat & long
                                };

                                xmlhttp.open("GET", post , true);
                                xmlhttp.send();
                            }//END IF SUBMITTED
                                else{
                                    return;
                                }

                            }); */ //END OF SWAL WILLSUBMITTED
                        }//ELSE CLOSING (IN ACTUAL PRGM) ,NOW END WILL SUBMIT
                        else if (willSubmit.isConfirmed === Swal.DismissReason.cancel) {
                            $('.round_reg_3').removeClass('active');
                            $('.stage_reg_4').removeClass('active');
                            return false;
                        }
                    });//NOW .(THIS) END WILL SUBMIT (NOT NEEDED)
            }//IF DELIVERY = REGISTER
            else if (checkBox_diff.checked == true) {
                var shipping_first_name = document.getElementById("shipping_first_name").value;
                var shipping_last_name = document.getElementById("shipping_last_name").value;
                var shipping_ph_no = document.getElementById("shipping_ph_no").value;
                var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
                var shipping_address_1 = document.getElementById("shipping_address_1").value;
                var shipping_postcode = document.getElementById("shipping_postcode").value;
                //checking unwanted space
                var shipping_first_namespace = shipping_first_name.split(" ");
                //validating first name isempty
                if (shipping_first_name == null || shipping_first_name == "") {
                    $('#delivery_button').click();
                    document.getElementById("shipping_first_name").focus();
                    document.getElementById("shipping_first_name").className += " invalid";
                    return false;
                }
                //validating first name is not a number
                if (!(isNaN(shipping_first_name))) {
                    $('#delivery_button').click();
                    document.getElementById("shipping_first_name").focus();
                    document.getElementById("shipping_first_name").className += " invalid";
                    return false;
                }
                //validating white spaces
                else if (shipping_first_namespace.length > 1) {
                    swal({
                        title: "Oops!!!",
                        text: "'SPACE' not allowed",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
                    $('#delivery_button').click();
                    document.getElementById("shipping_first_name").focus();
                    document.getElementById("shipping_first_name").className += " invalid";
                    return false;
                }
                //limiting the name length
                else if (shipping_first_name.length > 20) {
                    $('#delivery_button').click();
                    document.getElementById("shipping_first_name").focus();
                    document.getElementById("shipping_first_name").className += " invalid";
                    return false;
                }
                //minimal character check
                else if (shipping_first_name.length < 2) {
                    $('#delivery_button').click();
                    document.getElementById("shipping_first_name").focus();
                    document.getElementById("shipping_first_name").className += " invalid";
                    return false;
                }
                //validating last name isempty
                if (shipping_last_name == null || shipping_last_name == "") {
                    $('#delivery_button').click();
                    document.getElementById("shipping_last_name").focus();
                    document.getElementById("shipping_last_name").className += " invalid";
                    return false;
                }
                //validating first name is not a number
                else if (!(isNaN(shipping_last_name))) {
                    swal({
                        title: "Oops!!!",
                        text: "Please use Albhabets",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
                    $('#delivery_button').click();
                    document.getElementById("shipping_last_name").focus();
                    document.getElementById("shipping_last_name").className += " invalid";
                    return false;
                }
                //Phone 2 number check
                if (shipping_ph_no == null || shipping_ph_no == "") {
                    $('#delivery_button').click();
                    document.getElementById("shipping_ph_no").focus();
                    document.getElementById("shipping_ph_no").className += " invalid";
                    return false;
                }
                //validating shipping_ph_no is a number
                else if (isNaN(shipping_ph_no) || shipping_ph_no.length != 10) {
                    /*
                                swal({
                                title: "Oops!!!",
                                text: "Invalid phone number",
                                icon: "error",
                                closeOnClickOutside: false,
                                dangerMode: true,
                                timer: 6000,
                                });
                    */
                    $('#delivery_button').click();
                    document.getElementById("shipping_ph_no").focus();
                    document.getElementById("shipping_ph_no").className += " invalid";
                    return false;
                }
                //validating shipping_ph_no 2 is a number
                if (shipping_ph_no2 != "" && shipping_ph_no2.length != 10) {
                    /*
                                swal({
                                title: "Oops!!!",
                                text: "Invalid shipping_ph_no number",
                                icon: "error",
                                closeOnClickOutside: false,
                                dangerMode: true,
                                timer: 6000,
                                });
                    */
                    $('#delivery_button').click();
                    document.getElementById("shipping_ph_no2").focus();
                    document.getElementById("shipping_ph_no2").className += " invalid";
                    return false;
                }
                //address check
                if (shipping_address_1 == null || shipping_address_1 == "") {
                    $('#delivery_button').click();
                    document.getElementById("shipping_address_1").focus();
                    document.getElementById("shipping_address_1").className += " invalid";
                    return false;
                }
                //validating address if its length above 4
                if (shipping_address_1 != null && shipping_address_1.length < 10) {
                    swal({
                        title: "Oops!!!",
                        text: "Invalid shipping_address_1",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
                    $('#delivery_button').click();
                    document.getElementById("shipping_address_1").focus();
                    document.getElementById("shipping_address_1").className += " invalid";
                    return false;
                }
                //PIN check
                //PIN check
                else if (shipping_postcode == null || shipping_postcode == "") {
                    /*
                        swal({
                                title: "Oops!!!",
                                text: "Please enter the pincode !!! ",
                                icon: "error",
                                closeOnClickOutside: false,
                                dangerMode: true,
                                timer: 6000,
                            });
                    */
                    $('#delivery_button').click();
                    document.getElementById("shipping_postcode").focus();
                    document.getElementById("shipping_postcode").className += " invalid";
                    return false;
                }
                else if (shipping_postcode.length != 6) {
                    swal({
                        title: "Oops!!!",
                        text: "Please enter valid pincode !!! ",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
                    $('#delivery_button').click();
                    document.getElementById("shipping_postcode").value = "";
                    document.getElementById("shipping_postcode").focus();
                    document.getElementById("shipping_postcode").className += " invalid";
                    return false;
                }
                //PIN check
                if (document.getElementById("accept").checked == false) {
                    swal({
                        title: "Oops!!!",
                        text: "Please Accept the terms and conditions",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
                    return false;
                }
                $('.round_reg_3').addClass('active');
                $('.stage_reg_4').addClass('active');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You are about to register !!!",
                    icon: "warning",
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: 'red',
                    allowOutsideClick: false,
                    confirmButtonText: '<i class="fa fa-close"></i> Cancel',
                    cancelButtonColor: 'green',
                    cancelButtonText: '<i class="fa fa-check"></i> Register'
                })
                    .then((willSubmit) => {
                        if (willSubmit.dismiss) {
                            $('.background_loader').css('display', 'flex');
                            $('.load_btn').show();
                            $('.real_btn').hide();
                            $('.std_text2').css('display', 'flex');
                            if (document.getElementById("subscribe").checked == true) {
                                var subscribe = "1";
                            }
                            else {
                                var subscribe = "0";
                            }
    //var post="http://api.positionstack.com/v1/forward?access_key=02d2fe0121d695587c3ea6ec300a8a8e&query="+loc+"";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   /* var post="http://api.positionstack.com/v1/forward?access_key=02d2fe0121d695587c3ea6ec300a8a8e&query="+loc+"";//JSON RESPONSE
//REQUIRED FOR GEOLOCATION ACCESS
    var xmlhttp = new XMLHttpRequest();//HTTP REQUEST START
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { ////START IF
            addr = JSON.parse(this.responseText);
            console.log(addr);
            var lat=addr.data[0].latitude;
            console.log(lat);
            var long=addr.data[0].longitude;
            console.log(long); */
/*//NOT NECESSARY
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("my-address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      alert("Latitude: "+results[0].geometry.location.lat());
      alert("Longitude: "+results[0].geometry.location.lng());
      }
      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
*/var lat = long = 0;
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            $.ajax({
                                url: "../Common/functions.php", //passing page info
                                data: { "register": 1, "delivery": 2, "first_name": first_name, "last_name": last_name, "phone": phone, "pin": regpin, "location": loc, "latitude": lat, "longitude": long, "address": address, "subscribe": subscribe, "email": email, "password": pass1, "shipping_first_name": shipping_first_name, "shipping_last_name": shipping_last_name, "shipping_ph_no": shipping_ph_no, "shipping_ph_no2": shipping_ph_no2, "shipping_address_1": shipping_address_1, "shipping_postcode": shipping_postcode },  //form data
                                type: "post",   //post data
                                dataType: "json",   //datatype=json format
                                timeout: 30000,   //waiting time 30 sec
                                success: function (data) {    //if registration is success
                                    if (data.status == 'success') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Success!!!",
                                            text: "Registered Successfully",
                                            icon: "success",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit1) => {
                                                if (willSubmit1) {
                                                    swal({
                                                        title: "Activate Account",
                                                        text: "Please check your mail !",
                                                        icon: "warning",
                                                        closeOnClickOutside: false,
                                                        dangerMode: true,
                                                    })
                                                        .then((willSubmit2) => {
                                                            if (willSubmit2) {
                                                                location.href = "../Main/onestore.php"
                                                                return false;
                                                            }
                                                            else {
                                                                return false;
                                                            }
                                                        })
                                                }
                                                else {
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "Account already exists",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    document.getElementById("email").className += " invalid";
                                                    document.getElementById("email").focus();
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error2') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "Email is not valid",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error3') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "First name is not valid",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    document.getElementById("first_name").className += " invalid";
                                                    document.getElementById("first_name").focus();
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                    else if (data.status == 'error1') {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
                                        swal({
                                            title: "Oops!!!",
                                            text: "Phone number already exists",
                                            icon: "error",
                                            closeOnClickOutside: false,
                                            dangerMode: true,
                                        })
                                            .then((willSubmit) => {
                                                if (willSubmit) {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    document.getElementById("phone").className += " invalid";
                                                    document.getElementById("phone").focus();
                                                    return false;
                                                }
                                                else {
                                                    nextPrev(-1);
                                                    nextPrev(-1);
                                                    return false;
                                                }
                                            });
                                    }
                                },
                                error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
                                    if (textstatus === "timeout") {
                                        $('.background_loader').hide();
                                        $('.std_loader').hide();
                                        $('.load_btn').hide();
                                        $('.real_btn').show();
                                        $('.std_text2').hide();
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
                                    else { return false; }
                                }
                            }); //closing ajax
                            /*
                                } //closing xmlhttprequest for lat & long
                                };

                                xmlhttp.open("GET", post , true);
                                xmlhttp.send();
                            }//END IF SUBMITTED
                                else{
                                    return;
                                }

                            }); */ //END OF SWAL WILLSUBMITTED
                        }//ELSE CLOSING (IN ACTUAL PRGM) ,NOW END WILL SUBMIT
                        else if (willSubmit.isConfirmed === Swal.DismissReason.cancel) {
                            $('.round_reg_3').removeClass('active');
                            $('.stage_reg_4').removeClass('active');
                            return false;
                        }
                    });//NOW .(THIS) END WILL SUBMIT (NOT NEEDED)
            }//IF DELIVERY != REGISTER
        }//END ELSE
    }//NOW END CHECK REGISTER
    function view() {
        var pass1 = document.getElementById("passfir");
        var pass2 = document.getElementById("passre");
        if (pass1.type == 'password') {
            pass1.type = 'text';
            pass2.type = 'text';
            $("#dis_pass1").hide();
            $("#hide_pass1").show();
        }
        else {
            pass1.type = 'password';
            pass2.type = 'password';
            $("#dis_pass1").show();
            $("#hide_pass1").hide();
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
</body>

</html>