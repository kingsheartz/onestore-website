<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:../Main/onestore.php");
}
require "../Main/header.php";
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$usersql = 'select* from users where user_id=' . $id;
$userstmt = $pdo->query($usersql);
$userrow = $userstmt->fetch(PDO::FETCH_ASSOC);
$susersql = 'select* from user_delivery_details where type="permanent" and user_id=' . $id;
$suserstmt = $pdo->query($susersql);
$suserrow = $suserstmt->fetch(PDO::FETCH_ASSOC);
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

    .invalid {
        background-color: #ffdddd !important;
    }

    @media (min-width: 992px) {
        .lt_menu {
            margin-top: 90px;
        }
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
</style>
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">My Account</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- update -->
<div class="register"
    style="background: url(../../images/logo/check1.jpg) no-repeat;padding-top: 0px;padding-bottom: 0px;">
    <div style="background-color: rgba(0,0,0,0.55);width: 100%;height: 100%;padding-top: 20px;padding-bottom: 20px;">
        <div class="container" style="padding: 0px;">
            <div class="col-lg-3 col-md-5 lt_menu" style="color: white">
                <h3>My Account</h3>
                <br>
                <ul style="list-style: none;">
                    <a class="left-log">
                        <li class="ad my-account my-account-active"
                            onclick="$('.my-account').removeClass('my-account-active');$('.ad').addClass('my-account-active');$('.account-details').removeClass('account-details-active');$('.pi').addClass(' account-details-active');$('.account-head').removeClass('account-head-active');$('.acc_details').addClass(' account-head-active');">
                            <i class="fa fa-arrow-right"></i> Account Details
                        </li>
                    </a>
                    <hr class="account-li-bottom">
                    <a class="left-log">
                        <li class="cep my-account"
                            onclick="$('.my-account').removeClass('my-account-active');$('.cep').addClass('my-account-active');$('.account-details').removeClass('account-details-active');$('.li').addClass(' account-details-active');$('.account-head').removeClass('account-head-active');$('.changeep').addClass(' account-head-active');">
                            <i class="fa fa-arrow-right"></i> Change Email/Password
                        </li>
                    </a>
                    <hr class="account-li-bottom">
                    <a class="left-log">
                        <li class="da my-account"
                            onclick="$('.my-account').removeClass('my-account-active');$('.da').addClass('my-account-active');$('.account-details').removeClass('account-details-active');$('.ada').addClass(' account-details-active');$('.account-head').removeClass('account-head-active');$('.del_add').addClass(' account-head-active');">
                            <i class="fa fa-arrow-right"></i> Delivery Address
                        </li>
                    </a>
                    <hr class="account-li-bottom">
                </ul>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-7 col-md-6">
                <h2 style="color: white;" class="account-head-active account-head acc_details">ACCOUNT DETAILS</h2>
                <h2 style="color: white;" class="account-head changeep">Change Email / Password</h2>
                <h2 style="color: white;" class="account-head del_add">Delivery Address</h2>
                <div class="login-form-grids" style="border-top: 10px solid #fe9126;border-radius: 5px;width: 100%">
                    <div class="account-details pi account-details-active">
                        <h5 style=""><i class="fa fa-info-circle fa-lg"></i>&nbsp;profile information
                            <span id='succeeded'
                                style="float: right;background-color: green;border-radius: 5px;color:white">&nbsp;
                                <i class="fa fa-check" style="color: orange;text-shadow: 1px 2px 3px grey"></i>
                                <i style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey">
                                    verified &nbsp;</i>
                            </span>
                            <span id='pending'
                                style="display: none;float: right;background-color: white;border: 1px solid black;border-radius: 5px;color:white">&nbsp;
                                <i class="fa fa-close" style="color: red;text-shadow: 1px 2px 3px grey"></i>
                                <i
                                    style="text-transform: capitalize;font-size: 12px;color: black;text-shadow: 1px 2px 3px grey">
                                    pending &nbsp;</i>
                            </span>
                        </h5>
                        <div id="error_dis" style="display: none;margin-bottom: 50px;">
                            <p id="nameerror"
                                style="color: red;font-weight: bolder;margin-top:-5px;float:left;padding-bottom:0px;margin-bottom: 0px;text-shadow: 2px 3px 4px grey">
                            </p>
                        </div>
                        <form name="user_details_update_form" style="margin-top: 45px;">
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="input-group bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top:15px;">
                                <input type="text" oninput="$(this).removeClass('invalid');" onkeyup="changed_details()"
                                    id="first_name" placeholder="" value="<?= $userrow['first_name'] ?>" required=" "
                                    style="margin-top: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;padding-right: 1px;"
                                    readonly class="validate" pattern="^\S[a-zA-Z]{2,30}$"
                                    title="Minimum character '3'.Use alphabets">
                                <label class="form-label" for="first_name">First Name</label>
                                <span id="dis_fn" class="input-group-btn">
                                    <button onclick="dis_fn()" onmouseover="$(this).css('background-color','#0c66cc')"
                                        onmouseleave="$(this).css('background-color','#0c77cc')"
                                        style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;outline: none;"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="fa fa-edit"></span></button>
                                </span>
                                <span id="hide_fn" class="input-group-btn" style="display: none;">
                                    <button onclick="reset_fn()" onmouseover="$(this).css('background-color','#bb0000')"
                                        onmouseleave="$(this).css('background-color','red')"
                                        style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;"
                                        class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                            style="margin-left: -18px;"></span></button>
                                </span>
                                <span id="hide_fn1" style="display: none;" class="input-group-btn">
                                    <button onclick="dis_fn()" onmouseover="$(this).css('background-color','#4f994f')"
                                        onmouseleave="$(this).css('background-color','#07C103')"
                                        style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="fa fa-check"></span></button>
                                </span>
                            </div>
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="input-group bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top:25px;">
                                <input pattern="^[a-zA-Z ]{1,20}$" title="Use alphabets"
                                    oninput="$(this).removeClass('invalid');" type="text" onkeyup="changed_details()"
                                    id="last_name" placeholder="" value="<?= $userrow['last_name'] ?>" required=" "
                                    style="margin-top: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                    readonly class="validate">
                                <label class="form-label" for="last_name">Last Name</label>
                                <span id="dis_ln" class="input-group-btn">
                                    <button onclick="dis_ln()" onmouseover="$(this).css('background-color','#0c66cc')"
                                        onmouseleave="$(this).css('background-color','#0c77cc')"
                                        style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="fa fa-edit"></span></button>
                                </span>
                                <span id="hide_ln" class="input-group-btn" style="display: none;">
                                    <button onclick="reset_ln()" onmouseover="$(this).css('background-color','#bb0000')"
                                        onmouseleave="$(this).css('background-color','red')"
                                        style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;"
                                        class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                            style="margin-left: -18px;"></span></button>
                                </span>
                                <span id="hide_ln1" class="input-group-btn" style="display: none;">
                                    <button onclick="dis_ln()" onmouseover="$(this).css('background-color','#4f994f')"
                                        onmouseleave="$(this).css('background-color','#07C103')"
                                        style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="fa fa-check"></span></button>
                                </span>
                            </div>
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="input-group bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top:25px;">
                                <input oninput="$(this).removeClass('invalid');" onkeyup="changed_details()" type="tel"
                                    id="phone" placeholder="" value="<?= $userrow['phone'] ?>" required=" "
                                    style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                    readonly
                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                    maxlength="10" pattern="^(\d{0}|\d{10})$"
                                    title="Phone Number Format (9876543210)- 10 digits">
                                <label class="form-label" for="phone">Phone</label>
                                <span id="dis_ph" class="input-group-btn">
                                    <button onclick="dis_ph()" onmouseover="$(this).css('background-color','#0c66cc')"
                                        onmouseleave="$(this).css('background-color','#0c77cc')"
                                        style="color:white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="fa fa-edit"></span></button>
                                </span>
                                <span id="hide_ph" class="input-group-btn" style="display: none;">
                                    <button onclick="reset_ph()" onmouseover="$(this).css('background-color','#bb0000')"
                                        onmouseleave="$(this).css('background-color','red')"
                                        style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;"
                                        class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                            style="margin-left: -18px;"></span></button>
                                </span>
                                <span id="hide_ph1" class="input-group-btn" style="display: none;">
                                    <button onclick="dis_ph()" onmouseover="$(this).css('background-color','#4f994f')"
                                        onmouseleave="$(this).css('background-color','#07C103')"
                                        style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;"
                                        class="btn btn-default search_btn" type="button"><span
                                            class="fa fa-check"></span></button>
                                </span>
                            </div>
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!--PIN & LOCATE-->
                            <ul style="margin-bottom: -20px;">
                                <li style="list-style:none; ">
                                    <div id="pin" class="input-group bar-srch input-field"
                                        style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;margin-top: 25px;">
                                        <input pattern="^\d{6}$" title="PIN Number Format (654321)- 6 digits"
                                            maxlength="6" onkeyup="changed_details()" type="tel" class="locmark"
                                            id="regpin" placeholder="" value="<?= $userrow['pincode'] ?>" name="pincode"
                                            required=" "
                                            style="width: 100%;margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;'"
                                            readonly
                                            onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                        <label class="form-label" for="regpin">Pincode</label>
                                        <span id="dis_pin" class="input-group-btn">
                                            <button onclick="dis_pin()"
                                                onmouseover="$(this).css('background-color','#0c66cc')"
                                                onmouseleave="$(this).css('background-color','#0c77cc')"
                                                style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                                class="btn btn-default search_btn" type="button"><span
                                                    class="fa fa-edit"></span></button>
                                        </span>
                                        <span id="hide_pin1" class="input-group-btn" style="display: none;">
                                            <button onclick="user_update_locate()"
                                                onmouseover="$(this).css('background-color','#ee8126')"
                                                onmouseleave="$(this).css('background-color','#fe9126')"
                                                style="color: white;background-color:#fe9126;padding-top:10px;padding-bottom: 10px;outline: none;"
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
                                        <div class="input-group bar-srch"
                                            style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                            <select name="po_list" onchange="changed_details()" class="locmark"
                                                id="po_list1" placeholder="PIN" name="pincode" required=" "
                                                style="width: 100%;height: 40px;margin: 0px;z-index: 0;border-radius: 3px;border:1px solid #DBDBDB;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                                                <option value="<?= $userrow['location'] ?>" selected="" disabled="">
                                                    <?= $userrow['location'] ?>
                                                </option>
                                            </select>
                                            <span id="hide_locate" class="input-group-btn">
                                                <button onclick="regsetlocation()"
                                                    onmouseover="$(this).css('background-color','#4f994f')"
                                                    onmouseleave="$(this).css('background-color','#07C103')"
                                                    style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;"
                                                    class="btn btn-default search_btn popuptext pin" type="button"><span
                                                        class="fa fa-check"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                </li><br>
                            </ul>
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!---------------------------------------------------------------------------------------------------------------------------------------------->
                            <!--ADDRESS-->
                            <div class="form-group input-field"
                                style="text-align: right;width: 100%;position: relative;">
                                <textarea title="Minimal character count is 10" rows="4"
                                    oninput="$(this).removeClass('invalid');" onkeyup="changed_details()" id="address"
                                    placeholder="" readonly><?= $userrow['address'] ?></textarea>
                                <label class="form-label" for="address">Address</label>
                                <span onclick="dis_add()" id="dis_add" class="fa fa-sm fa-edit"
                                    style="position: absolute;right: 0;top: 0;color: white;background-color:#0c77cc;padding: 4px;"
                                    onmouseover="$(this).css('background-color','#0c66cc')"
                                    onmouseleave="$(this).css('background-color','#0c77cc')"></span>
                                <span onclick="reset_add()" id="hide_add" class="fa fa-sm fa-close"
                                    style="display: none;position: absolute;right: 0;top: 0;color: white;background-color:red;padding: 5px;padding-top: 4px;padding-bottom: 4px;"
                                    onmouseover="$(this).css('background-color','#bb0000')"
                                    onmouseleave="$(this).css('background-color','red')"></span>
                                <span onclick="dis_add()" id="hide_add1" class="fa fa-check"
                                    style="display:none;position: absolute;right: 0;top: 23px;color: white;background-color:#07C103;padding: 3px;"
                                    onmouseover="$(this).css('background-color','#4f994f')"
                                    onmouseleave="$(this).css('background-color','#07C103')"></span>
                            </div>
                            <hr style="padding: 0px;margin: 0px;">
                    </div>
                    <!---------------------------------------------------------------------------------------------------------------------------------------------->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------->
                    <!---------------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="li account-details" style="display: none;">
                        <!--EMAIL-->
                        <h6 style="margin-top: 0px !important;"><i class="fa fa-info-circle fa-lg"></i>&nbsp;Login
                            information
                            <span id='succeeded1'
                                style="float: right;background-color: green;border-radius: 5px;color:white">&nbsp;
                                <i class="fa fa-check" style="color: orange;text-shadow: 1px 2px 3px grey"></i>
                                <i style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey">
                                    verified &nbsp;</i>
                            </span>
                            <span id='pending1'
                                style="display: none;float: right;background-color: white;border: 1px solid black;border-radius: 5px;color:white">&nbsp;
                                <i class="fa fa-close" style="color: red;text-shadow: 1px 2px 3px grey"></i>
                                <i
                                    style="text-transform: capitalize;font-size: 12px;color: black;text-shadow: 1px 2px 3px grey">
                                    pending &nbsp;</i>
                            </span>
                        </h6>
                        <div id="error_dis2" style="display: none;margin-bottom: 50px;">
                            <p id="nameerror2"
                                style="color: red;font-weight: bolder;margin-top:-5px;float:left;padding-bottom:0px;margin-bottom: 0px;text-shadow: 2px 3px 4px grey">
                            </p>
                        </div>
                        <div class="input-group bar-srch input-field"
                            style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 25px;margin-top: 45px;">
                            <input oninput="$(this).removeClass('invalid');" onkeyup="changed_details()" type="email"
                                name="email" id="email" value="<?= $userrow['email'] ?>" placeholder="" required=" "
                                style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                readonly>
                            <label class="form-label" for="email">Email Address</label>
                            <span id="dis_mail" class="input-group-btn">
                                <button onclick="dis_mail()" onmouseover="$(this).css('background-color','#0c66cc')"
                                    onmouseleave="$(this).css('background-color','#0c77cc')"
                                    style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                    class="btn btn-default search_btn" type="button"><span
                                        class="fa fa-edit"></span></button>
                            </span>
                            <span id="hide_mail" class="input-group-btn" style="display: none;">
                                <button onclick="reset_mail()" onmouseover="$(this).css('background-color','#bb0000')"
                                    onmouseleave="$(this).css('background-color','red')"
                                    style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;"
                                    class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                        style="margin-left: -18px;"></span></button>
                            </span>
                            <span id="hide_mail1" class="input-group-btn" style="display: none;">
                                <button onclick="dis_mail()" onmouseover="$(this).css('background-color','#4f994f')"
                                    onmouseleave="$(this).css('background-color','#07C103')"
                                    style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;"
                                    class="btn btn-default search_btn" type="button"><span
                                        class="fa fa-check"></span></button>
                            </span>
                        </div>
                        <!---------------------------------------------------------------------------------------------------------------------------------------------->
                        <!---------------------------------------------------------------------------------------------------------------------------------------------->
                        <!---------------------------------------------------------------------------------------------------------------------------------------------->
                        <!---------------------------------------------------------------------------------------------------------------------------------------------->
                        <!--PASSWORD-->
                        <div class="input-group bar-srch input-field"
                            style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                            <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must be same as you had already entered"
                                oninput="$(this).removeClass('invalid');" type="password" id="pass3"
                                onkeyup="changed_details()" value="abcdefghijklmnopqrstuvwxyz" placeholder=""
                                required=" "
                                style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                readonly>
                            <label class="form-label" for="pass3">Current password</label>
                            <span id="dis_pass3" class="input-group-btn click-pass-opt">
                                <button onclick="dis_pass3()" onmouseover="$(this).css('background-color','#0c66cc')"
                                    onmouseleave="$(this).css('background-color','#0c77cc')"
                                    style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px"
                                    class="btn btn-default search_btn" type="button"><span
                                        class="fa fa-edit"></span></button>
                            </span>
                            <span id="hide_pass3_1" class="input-group-btn click-pass-opt" style="display: none;">
                                <button onclick="reset_pass3()" onmouseover="$(this).css('background-color','#bb0000')"
                                    onmouseleave="$(this).css('background-color','red')"
                                    style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;"
                                    class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                        style="margin-left: -18px;"></span></button>
                            </span>
                            <span id="hide_pass3_2" class="input-group-btn click-pass-opt" style="display: none;">
                                <button onclick="dis_pass3()" onmouseover="$(this).css('background-color','#4f994f')"
                                    onmouseleave="$(this).css('background-color','#07C103')"
                                    style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;"
                                    class="btn btn-default search_btn" type="button"><span
                                        class="fa fa-check"></span></button>
                            </span>
                        </div>
                        <div id="pass" style="display: none;margin-top:25px;">
                            <hr class="make_divc">
                            <div class="input-group bar-srch input-field"
                                style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 10px;">
                                <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    oninput="$(this).removeClass('invalid');" onkeyup="changed_details()"
                                    type="password" id="passfir" value="" placeholder="New password" required=" "
                                    style="margin: 0px;z-index: 0;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                    readonly>
                                <label class="form-label" for="passfir"></label>
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
                            <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Entered input must  matches the current password"
                                oninput="$(this).removeClass('invalid');" type="password" onkeyup="changed_details()"
                                id="passre" placeholder="Re-enter password" required=" " style="margin-bottom: 0px;">
                            <hr class="make_divc" style="margin-bottom: 14px;">
                        </div>
                        <hr style="padding: 0px;margin: 0px;">
                    </div>
                    <!-------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------->
                    <form action="#" onsubmit="return err_display_fn();">
                        <div class="ada account-details" style="display: none;">
                            <!--EMAIL-->
                            <h6 style="margin-top: 0px !important;"><i
                                    class="fa fa-info-circle fa-lg"></i>&nbsp;Delivery Address
                                <span id='succeeded2'
                                    style="float: right;background-color: green;border-radius: 5px;color:white">&nbsp;
                                    <i class="fa fa-check" style="color: orange;text-shadow: 1px 2px 3px grey"></i>
                                    <i style="text-transform: capitalize;font-size: 12px;text-shadow: 1px 2px 3px grey">
                                        verified &nbsp;</i>
                                </span>
                                <span id='pending2'
                                    style="display: none;float: right;background-color: white;border: 1px solid black;border-radius: 5px;color:white">&nbsp;
                                    <i class="fa fa-close" style="color: red;text-shadow: 1px 2px 3px grey"></i>
                                    <i
                                        style="text-transform: capitalize;font-size: 12px;color: black;text-shadow: 1px 2px 3px grey">
                                        pending &nbsp;</i>
                                </span>
                            </h6>
                            <div class="shipping_address" id="stda_div">
                                <p id="shipping_first_name_field" class="form-row form-row-first validate-required">
                                <div class="input-group bar-srch"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                    <label class="" for="shipping_first_name"
                                        style="font-weight: normal;text-transform: capitalize;color:#9e9e9e;font-size:12px;">First
                                        Name <abbr title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input oninput="$(this).removeClass('invalid');" type="text"
                                        onkeyup="changed_details()" oninput="$(this).removeClass('invalid')"
                                        value="<?= $suserrow['first_name'] ?>" placeholder="First name"
                                        id="shipping_first_name" name="shipping_first_name" class="input-text validate"
                                        pattern="^\S[a-zA-Z]{3,30}$" title="Minimum character '3'.Use alphabets"
                                        required=""
                                        style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;margin-top: 0px;margin-bottom: 0px;"
                                        readonly>
                                    <span id="dis_sfn" class="input-group-btn">
                                        <button onclick="dis_sfn()"
                                            onmouseover="$(this).css('background-color','#0c66cc')"
                                            onmouseleave="$(this).css('background-color','#0c77cc')"
                                            style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-edit"></span></button>
                                    </span>
                                    <span id="hide_sfn" class="input-group-btn" style="display: none;">
                                        <button onclick="reset_sfn()"
                                            onmouseover="$(this).css('background-color','#bb0000')"
                                            onmouseleave="$(this).css('background-color','red')"
                                            style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                                style="margin-left: -18px;"></span></button>
                                    </span>
                                    <span id="hide_sfn1" style="display: none;" class="input-group-btn">
                                        <button onclick="dis_sfn()"
                                            onmouseover="$(this).css('background-color','#4f994f')"
                                            onmouseleave="$(this).css('background-color','#07C103')"
                                            style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-check"></span></button>
                                    </span>
                                </div>
                                </p>
                                <p id="shipping_last_name_field" class="form-row form-row-last validate-required">
                                <div class="input-group bar-srch"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                    <label class="" for="shipping_last_name"
                                        style="font-weight: normal;text-transform: capitalize;color:#9e9e9e;font-size:12px;">Last
                                        Name <abbr title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input oninput="$(this).removeClass('invalid');" type="text"
                                        onkeyup="changed_details()" oninput="$(this).removeClass('invalid')"
                                        value="<?= $suserrow['last_name'] ?>" placeholder="Last name"
                                        id="shipping_last_name" name="shipping_last_name" class="input-text validate"
                                        pattern="^[a-zA-Z ]{1,20}$" title="Use alphabets" required=""
                                        style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;margin-top: 0px;margin-bottom:0;"
                                        readonly>
                                    <span id="dis_sln" class="input-group-btn">
                                        <button onclick="dis_sln()"
                                            onmouseover="$(this).css('background-color','#0c66cc')"
                                            onmouseleave="$(this).css('background-color','#0c77cc')"
                                            style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-edit"></span></button>
                                    </span>
                                    <span id="hide_sln" class="input-group-btn" style="display: none;">
                                        <button onclick="reset_sln()"
                                            onmouseover="$(this).css('background-color','#bb0000')"
                                            onmouseleave="$(this).css('background-color','red')"
                                            style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                                style="margin-left: -18px;"></span></button>
                                    </span>
                                    <span id="hide_sln1" style="display: none;" class="input-group-btn">
                                        <button onclick="dis_sln()"
                                            onmouseover="$(this).css('background-color','#4f994f')"
                                            onmouseleave="$(this).css('background-color','#07C103')"
                                            style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-check"></span></button>
                                    </span>
                                </div>
                                </p>
                                <p id="shipping_phone_number_field" class="form-row form-row-last validate-required">
                                <div class="input-group bar-srch"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                    <label class="" for="shipping_phone_number"
                                        style="font-weight: normal;text-transform: capitalize;color:#9e9e9e;font-size:12px;">Phone
                                        Number<abbr title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input oninput="$(this).removeClass('invalid');" type="text"
                                        onkeyup="changed_details()" oninput="$(this).removeClass('invalid')"
                                        value="<?= $suserrow['phone'] ?>" placeholder="Phone number" id="shipping_ph_no"
                                        maxlength="10" name="shipping_ph_no" class="input-text validate"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57;"
                                        pattern="^\d{10}$" title="Phone Number Format (9876543210)- 10 digits"
                                        required=""
                                        style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;margin-top: 0px;margin-bottom:0;"
                                        readonly>
                                    <span id="dis_sph" class="input-group-btn">
                                        <button onclick="dis_sph()"
                                            onmouseover="$(this).css('background-color','#0c66cc')"
                                            onmouseleave="$(this).css('background-color','#0c77cc')"
                                            style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-edit"></span></button>
                                    </span>
                                    <span id="hide_sph" class="input-group-btn" style="display: none;">
                                        <button onclick="reset_sph()"
                                            onmouseover="$(this).css('background-color','#bb0000')"
                                            onmouseleave="$(this).css('background-color','red')"
                                            style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                                style="margin-left: -18px;"></span></button>
                                    </span>
                                    <span id="hide_sph1" style="display: none;" class="input-group-btn">
                                        <button onclick="dis_sph()"
                                            onmouseover="$(this).css('background-color','#4f994f')"
                                            onmouseleave="$(this).css('background-color','#07C103')"
                                            style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-check"></span></button>
                                    </span>
                                </div>
                                </p>
                                <p id="shipping_phone_number2_field" class="form-row form-row-last validate-required">
                                <div class="input-group bar-srch"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                    <label class="" for="shipping_ph_no2"
                                        style="font-weight: normal;text-transform: capitalize;color:#9e9e9e;font-size:12px;">Alternate
                                        phone number<small title="required" class="required" style="color: #c50505">
                                            (Optional)</small>
                                    </label>
                                    <input oninput="$(this).removeClass('invalid');" type="text"
                                        onkeyup="changed_details()" oninput="$(this).removeClass('invalid')"
                                        value="<?= $suserrow['alternative_phone'] ?>"
                                        placeholder="Alternate Phone Number" id="shipping_ph_no2" maxlength="10"
                                        name="shipping_ph_no2" class="input-text validate"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57;"
                                        pattern="^(\d{0}|\d{10})$" title="Phone Number Format (9876543210)- 10 digits"
                                        style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;margin-top: 0px;margin-bottom:0;"
                                        readonly>
                                    <span id="dis_s2ph" class="input-group-btn">
                                        <button onclick="dis_s2ph()"
                                            onmouseover="$(this).css('background-color','#0c66cc')"
                                            onmouseleave="$(this).css('background-color','#0c77cc')"
                                            style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-edit"></span></button>
                                    </span>
                                    <span id="hide_s2ph" class="input-group-btn" style="display: none;">
                                        <button onclick="reset_s2ph()"
                                            onmouseover="$(this).css('background-color','#bb0000')"
                                            onmouseleave="$(this).css('background-color','red')"
                                            style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                                style="margin-left: -18px;"></span></button>
                                    </span>
                                    <span id="hide_s2ph1" style="display: none;" class="input-group-btn">
                                        <button onclick="dis_s2ph()"
                                            onmouseover="$(this).css('background-color','#4f994f')"
                                            onmouseleave="$(this).css('background-color','#07C103')"
                                            style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-check"></span></button>
                                    </span>
                                </div>
                                </p>
                                <div class="clear"></div>
                                <p id="shipping_address_1_field"
                                    class="form-row form-row-wide address-field validate-required">
                                <div class="input-group bar-srch"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;display: block;">
                                    <label class="" for="shipping_address_1"
                                        style="font-weight: normal;text-transform: capitalize;color:#9e9e9e;font-size:12px;">Address
                                        <abbr title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <div class="form-group" style="text-align: right;width: 100%;position: relative;">
                                        <textarea oninput="$(this).removeClass('invalid');" onkeyup="changed_details()"
                                            oninput="$(this).removeClass('invalid')" rows="4" value=""
                                            title="Minimal character count is 10" placeholder="Street address"
                                            id="shipping_address_1" name="shipping_address_1"
                                            class="input-text validate" required="margin-bottom:0;" readonly=""
                                            style="width: 100%;box-sizing: border-box;display:block"><?= $suserrow['address'] ?></textarea>
                                        <span onclick="dis_sadd()" id="dis_sadd" class="fa fa-sm fa-edit"
                                            style="position: absolute;right: 0;top: 0;color: white;background-color:#0c77cc;padding: 4px;"
                                            onmouseover="$(this).css('background-color','#0c66cc')"
                                            onmouseleave="$(this).css('background-color','#0c77cc')"></span>
                                        <span onclick="reset_sadd()" id="hide_sadd" class="fa fa-sm fa-close"
                                            style="display: none;position: absolute;right: 0;top: 0;color: white;background-color:red;padding: 5px;padding-top: 4px;padding-bottom: 4px;"
                                            onmouseover="$(this).css('background-color','#bb0000')"
                                            onmouseleave="$(this).css('background-color','red')"></span>
                                        <span onclick="dis_sadd()" id="hide_sadd1" class="fa fa-check"
                                            style="display:none;position: absolute;right: 0;top: 23px;color: white;background-color:#07C103;padding: 3px;"
                                            onmouseover="$(this).css('background-color','#4f994f')"
                                            onmouseleave="$(this).css('background-color','#07C103')"></span>
                                    </div>
                                </div>
                                </p>
                                <p id="shipping_postcode_field"
                                    class="form-row form-row-last address-field validate-required validate-postcode"
                                    data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                                <div class="input-group bar-srch"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
                                    <label class="" for="shipping_postcode"
                                        style="font-weight: normal;text-transform: capitalize;color:#9e9e9e;font-size:12px;">Postcode
                                        <abbr title="required" class="required" style="color: #c50505">*</abbr>
                                    </label>
                                    <input oninput="$(this).removeClass('invalid');" type="text"
                                        onkeyup="changed_details()" oninput="$(this).removeClass('invalid')"
                                        value="<?= $suserrow['pincode'] ?>" placeholder="Postcode / Zip"
                                        id="shipping_postcode" maxlength="6" name="shipping_postcode"
                                        class="input-text validate"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        pattern="^\d{6}$" title="PIN Number Format (654321)- 6 digits" required=""
                                        style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;margin-top: 0px;margin-bottom:0;"
                                        readonly>
                                    <span id="dis_spin" class="input-group-btn">
                                        <button onclick="dis_spin()"
                                            onmouseover="$(this).css('background-color','#0c66cc')"
                                            onmouseleave="$(this).css('background-color','#0c77cc')"
                                            style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-edit"></span></button>
                                    </span>
                                    <span id="hide_spin" class="input-group-btn" style="display: none;">
                                        <button onclick="reset_spin()"
                                            onmouseover="$(this).css('background-color','#bb0000')"
                                            onmouseleave="$(this).css('background-color','red')"
                                            style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                                style="margin-left: -18px;"></span></button>
                                    </span>
                                    <span id="hide_spin1" style="display: none;" class="input-group-btn">
                                        <button onclick="dis_spin()"
                                            onmouseover="$(this).css('background-color','#4f994f')"
                                            onmouseleave="$(this).css('background-color','#07C103')"
                                            style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;margin-top: 25px;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-check"></span></button>
                                    </span>
                                </div>
                                </p>
                                <div class="clear"></div>
                                <input type="submit" id="delivery_button" style="display:none" />
                            </div>
                        </div>
                        <br>
                    </form>
                    <!-------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------------------------------------------------->
                    <div id="update_user_details" style="display: none;">
                        <div class="register-check-box">
                            <div class="check">
                                <label class="checkbox"><input type="checkbox" id="accept" name="checkbox"><i> </i>I
                                    accept the terms and conditions</label>
                            </div>
                        </div>
                        <input class="shadow_b real_btn" type="button" onclick="checkupdate()" value="Update">
                        <button class="shadow_b load_btn" style="display:none" type="button"><i
                                class="fa fa-refresh fa-spin"></i>&nbsp;Update</button>
                    </div>
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
if ((isset($_GET['changed'])) && ($_GET['changed'] == "yes")) {
    ?>
    <script type="text/javascript">
        swal({
            title: "Email verified",
            text: "Redirecting to login page",
            icon: "success",
            closeOnClickOutside: false,
            dangerMode: true,
        })
            .then((willSubmit) => {
                if (willSubmit) {
                    location.href = "../Account/logout.php";
                    return;
                }
                else {
                    return;
                }
            });
    </script>
    <?php
}
if ((isset($_GET['changed'])) && ($_GET['changed'] == "no")) {
    ?>
    <script type="text/javascript">
        swal({
            title: "verification declined",
            text: "Email changed was reverted",
            icon: "success",
            closeOnClickOutside: false,
            dangerMode: true,
        })
            .then((willSubmit) => {
                if (willSubmit) {
                    location.href = "../Main/onestore.php";
                    return;
                }
                else {
                    return;
                }
            });
    </script>
    <?php
}
?>
<script type="text/javascript">
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function user_update_locate() {
        $("#po_list1").empty().append('<option selected="" disabled="" value="<?= $userrow['location'] ?>"><?= $userrow['location'] ?></option>');
        var locate, pin;
        var regpin = document.getElementById("regpin").value;
        if (regpin == null || regpin == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter the pincode !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            document.getElementById("regpin").focus();
            return;
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
            document.getElementById("regpin").value = "";
            document.getElementById("regpin").focus();
            return;
        }
        else {
            pin = "https://api.postalpincode.in/pincode/" + regpin + "";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    locate = JSON.parse(this.responseText);
                    console.log(locate);
                    //console.log(locate[0].PostOffice.length);
                    if (locate[0].Status == "Error") {
                        swal({
                            title: "Oops!!!",
                            text: "Invalid pincode !!! ",
                            icon: "error",
                            closeOnClickOutside: false,
                            dangerMode: true,
                            timer: 6000,
                        });
                        document.getElementById("regpin").value = "";
                        document.getElementById("regpin").focus();
                        return;
                    }
                    else {
                        /*Getting the id of select*/
                        var po = document.getElementById("po_list1");
                        for (i = 0; i < locate[0].PostOffice.length; i++) {
                            var create_po = document.createElement('option');
                            create_po.value = "" + locate[0].PostOffice[i].Name + "";
                            create_po.innerHTML = "" + locate[0].PostOffice[i].Name + "";
                            po.appendChild(create_po);
                            $("#setloc2").show();
                        }
                    }
                }
            };
            xmlhttp.open("GET", pin, true);
            xmlhttp.send();
        }
    }
    //////////////////DISPLAY DETAILS/////////////////
    function listenchanges() {
        var first_name = document.getElementById("first_name").value;
        var last_name = document.getElementById("last_name").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var email = document.getElementById("email").value;
        var pass1 = document.getElementById("passfir").value;
        var pass2 = document.getElementById("passre").value;
        var pass3 = document.getElementById("pass3").value;
        var regpin = document.getElementById("regpin").value;
        var loc = document.getElementById("po_list1").value;
        var shipping_first_name = document.getElementById("shipping_first_name").value;
        var shipping_last_name = document.getElementById("shipping_last_name").value;
        var shipping_ph_no = document.getElementById("shipping_ph_no").value;
        var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
        var shipping_address_1 = document.getElementById("shipping_address_1").value;
        var shipping_postcode = document.getElementById("shipping_postcode").value;
        var oldfirst_name = '<?= $userrow['first_name'] ?>';
        var oldlast_name = '<?= $userrow['last_name'] ?>';
        var oldphone = '<?= $userrow['phone'] ?>';
        var oldaddress = '<?= $userrow['address'] ?>';
        var oldemail = '<?= $userrow['email'] ?>';
        var oldpass3 = 'abcdefghijklmnopqrstuvwxyz';
        var oldregpin = '<?= $userrow['pincode'] ?>';
        var oldloc = '<?= $userrow['location'] ?>';
        var oldshipping_first_name = '<?= $suserrow['first_name'] ?>';
        var oldshipping_last_name = '<?= $suserrow['last_name'] ?>';
        var oldshipping_ph_no = '<?= $suserrow['phone'] ?>';
        var oldshipping_ph_no2 = '<?= $suserrow['alternative_phone'] ?>';
        var oldshipping_address_1 = '<?= $suserrow['address'] ?>';
        var oldshipping_postcode = '<?= $suserrow['pincode'] ?>    ';
        //sfn--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_sfn').css('display') == 'none') {
            if (shipping_first_name != oldshipping_first_name) {
                $('#hide_sfn').show();
                $('#hide_sfn1').show();
            }
            else if (shipping_first_name == oldshipping_first_name) {
                $('#hide_sfn').show();
                $('#hide_sfn1').hide();
            }
        }
        //sln--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_sln').css('display') == 'none') {
            if (shipping_last_name != oldshipping_last_name) {
                $('#hide_sln').show();
                $('#hide_sln1').show();
            }
            else if (shipping_last_name == oldshipping_last_name) {
                $('#hide_sln').show();
                $('#hide_sln1').hide();
            }
        }
        //sph--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_sph').css('display') == 'none') {
            if (shipping_ph_no != oldshipping_ph_no) {
                $('#hide_sph').show();
                $('#hide_sph1').show();
            }
            else if (shipping_ph_no == oldshipping_ph_no) {
                $('#hide_sph').show();
                $('#hide_sph1').hide();
            }
        }
        //   sph2--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_s2ph').css('display') == 'none') {
            if (shipping_ph_no2 != oldshipping_ph_no2) {
                $('#hide_s2ph').show();
                $('#hide_s2ph1').show();
            }
            else if (shipping_ph_no2 == oldshipping_ph_no2) {
                $('#hide_s2ph').show();
                $('#hide_s2ph1').hide();
            }
        }
        //saddress--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_sadd').css('display') == 'none') {
            if (shipping_address_1 != oldshipping_address_1) {
                $('#hide_sadd').show();
                $('#hide_sadd1').show();
            }
            else if (shipping_address_1 == oldshipping_address_1) {
                $('#hide_sadd').show();
                $('#hide_sadd1').hide();
            }
        }
        //spin--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_spin').css('display') == 'none') {
            if (shipping_postcode != oldshipping_postcode) {
                $('#hide_spin').show();
                $('#hide_spin1').show();
            }
            else if (shipping_postcode == oldshipping_postcode) {
                $('#hide_spin').show();
                $('#hide_spin1').hide();
            }
        }
        //fn--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_fn').css('display') == 'none') {
            if (first_name != oldfirst_name) {
                $('#hide_fn').show();
                $('#hide_fn1').show();
            }
            else if (first_name == oldfirst_name) {
                $('#hide_fn').show();
                $('#hide_fn1').hide();
            }
        }
        //ln--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_ln').css('display') == 'none') {
            if (last_name != oldlast_name) {
                $('#hide_ln').show();
                $('#hide_ln1').show();
            }
            else if (last_name == oldlast_name) {
                $('#hide_ln').show();
                $('#hide_ln1').hide();
            }
        }
        //ph--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_ph').css('display') == 'none') {
            if (phone != oldphone) {
                $('#hide_ph').show();
                $('#hide_ph1').show();
            }
            else if (phone == oldphone) {
                $('#hide_ph').show();
                $('#hide_ph1').hide();
            }
        }
        //mail--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_mail').css('display') == 'none') {
            if (email != oldemail) {
                $('#hide_mail').show();
                $('#hide_mail1').show();
            }
            else if (email == oldemail) {
                $('#hide_mail').show();
                $('#hide_mail1').hide();
            }
        }
        //address--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_add').css('display') == 'none') {
            if (address != oldaddress) {
                $('#hide_add').show();
                $('#hide_add1').show();
            }
            else if (address == oldaddress) {
                $('#hide_add').show();
                $('#hide_add1').hide();
            }
        }
        //pass--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_pass3').css('display') == 'none') {
            if ((pass3 != oldpass3) && (pass1 != "") && (pass2 != "")) {
                $('#hide_pass3_1').show();
                $('#hide_pass3_2').show();
                $('#dis_pass3').hide();
            }
            else if ((pass3 == oldpass3) || (pass1 == "") || (pass2 == "")) {
                $('#hide_pass3_1').show();
                $('#hide_pass3_2').hide();
                $('#hide_pass3').hide();
            }
        }
    }
    //--------------------------------------------------------------------------------------------------------------------------------------
    function succeeded() {
        var first_name = document.getElementById("first_name").value;
        var last_name = document.getElementById("last_name").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var email = document.getElementById("email").value;
        var pass1 = document.getElementById("passfir").value;
        var pass2 = document.getElementById("passre").value;
        var pass3 = document.getElementById("pass3").value;
        var regpin = document.getElementById("regpin").value;
        var loc = document.getElementById("po_list1").value;
        var shipping_first_name = document.getElementById("shipping_first_name").value;
        var shipping_last_name = document.getElementById("shipping_last_name").value;
        var shipping_ph_no = document.getElementById("shipping_ph_no").value;
        var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
        var shipping_address_1 = document.getElementById("shipping_address_1").value;
        var shipping_postcode = document.getElementById("shipping_postcode").value;
        var oldfirst_name = '<?= $userrow['first_name'] ?>';
        var oldlast_name = '<?= $userrow['last_name'] ?>';
        var oldphone = '<?= $userrow['phone'] ?>';
        var oldaddress = '<?= $userrow['address'] ?>';
        var oldemail = '<?= $userrow['email'] ?>';
        var oldpass3 = 'abcdefghijklmnopqrstuvwxyz';
        var oldregpin = '<?= $userrow['pincode'] ?>';
        var oldloc = '<?= $userrow['location'] ?>';
        var oldshipping_first_name = '<?= $suserrow['first_name'] ?>';
        var oldshipping_last_name = '<?= $suserrow['last_name'] ?>';
        var oldshipping_ph_no = '<?= $suserrow['phone'] ?>';
        var oldshipping_ph_no2 = '<?= $suserrow['alternative_phone'] ?>';
        var oldshipping_address_1 = '<?= $suserrow['address'] ?>';
        var oldshipping_postcode = '<?= $suserrow['pincode'] ?>';
        if ((first_name != oldfirst_name) || (last_name != oldlast_name) || (phone != oldphone) || (address != oldaddress) || (regpin != oldregpin) || (loc != oldloc)) {
            $('#succeeded').hide();
            $('#pending').show();
        }
        if ((first_name == oldfirst_name) && (last_name == oldlast_name) && (phone == oldphone) && (address == oldaddress) && (regpin == oldregpin) && (loc == oldloc)) {
            $('#succeeded').show();
            $('#pending').hide();
        }
        if ((email != oldemail) || (pass3 != oldpass3) || (pass1 != "") || (pass2 != "")) {
            $('#succeeded1').hide();
            $('#pending1').show();
        }
        if ((email == oldemail) && (pass3 == oldpass3) && (pass1 == "") && (pass2 == "")) {
            $('#succeeded1').show();
            $('#pending1').hide();
        }
        if ((shipping_first_name != oldshipping_first_name) || (shipping_last_name != oldshipping_last_name) || (shipping_ph_no != oldshipping_ph_no) || (shipping_ph_no2 != oldshipping_ph_no2) || (shipping_address_1 != oldshipping_address_1) || (shipping_postcode != oldshipping_postcode)) {
            $('#succeeded2').hide();
            $('#pending2').show();
        }
        if ((shipping_first_name == oldshipping_first_name) && (shipping_last_name == oldshipping_last_name) && (shipping_ph_no == oldshipping_ph_no) && (shipping_ph_no2 == oldshipping_ph_no2) && (shipping_address_1 == oldshipping_address_1) && (shipping_postcode == oldshipping_postcode)) {
            $('#succeeded2').show();
            $('#pending2').hide();
        }
        if (($('#succeeded1').css('display') != 'none') && ($('#succeeded').css('display') != 'none') && ($('#succeeded2').css('display') != 'none')) {
            $('#update_user_details').hide();
            $('#shipping_first_name').removeClass('invalid');
            $('#shipping_last_name').removeClass('invalid');
            $('#shipping_ph_no').removeClass('invalid');
            $('#shipping_ph_no2').removeClass('invalid');
            $('#shipping_address_1').removeClass('invalid');
            $('#shipping_postcode').removeClass('invalid');
        }
    }
    //SHIPPING FIRST_NAME
    function dis_sfn() {
        var shipping_first_name = document.getElementById("shipping_first_name").value;
        var oldshipping_first_name = '<?= $suserrow['first_name'] ?>';
        if ($('#hide_sfn').css('display') == 'none') {
            if (shipping_first_name == oldshipping_first_name) {
                $('#dis_sfn').hide();
                $('#hide_sfn').show();
            }
            if (shipping_first_name != oldshipping_first_name) {
                $('#dis_sfn').hide();
                $('#hide_sfn').show();
                $('#hide_sfn1').show();
            }
            document.getElementById("shipping_first_name").readOnly = false;
            document.getElementById("shipping_first_name").focus();
            var updatedetailInput = $("#shipping_first_name");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_sfn').show();
            $('#hide_sfn').hide();
            $('#hide_sfn1').hide();
            document.getElementById("shipping_first_name").readOnly = true;
        }
    }
    function reset_sfn() {
        var shipping_first_name = document.getElementById("shipping_first_name").value;
        var oldshipping_first_name = '<?= $suserrow['first_name'] ?>';
        if (($('#hide_sfn').css('display') != 'none') && ($('#hide_sfn1').css('display') != 'none')) {
            $('#dis_sfn').show();
            $('#hide_sfn').hide();
            $('#hide_sfn1').hide();
        }
        else if (($('#hide_sfn').css('display') != 'none') && ($('#hide_sfn1').css('display') == 'none')) {
            $('#dis_sfn').show();
            $('#hide_sfn').hide();
        }
        document.getElementById("shipping_first_name").value = oldshipping_first_name;
        document.getElementById("shipping_first_name").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //SHIPPING LAST_NAME
    function dis_sln() {
        var shipping_last_name = document.getElementById("shipping_last_name").value;
        var oldshipping_last_name = '<?= $suserrow['last_name'] ?>';
        if ($('#hide_sln').css('display') == 'none') {
            if (shipping_last_name == oldshipping_last_name) {
                $('#dis_sln').hide();
                $('#hide_sln').show();
            }
            if (shipping_last_name != oldshipping_last_name) {
                $('#dis_sln').hide();
                $('#hide_sln').show();
                $('#hide_sln1').show();
            }
            document.getElementById("shipping_last_name").readOnly = false;
            document.getElementById("shipping_last_name").focus();
            var updatedetailInput = $("#shipping_last_name");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_sln').show();
            $('#hide_sln').hide();
            $('#hide_sln1').hide();
            document.getElementById("shipping_last_name").readOnly = true;
        }
    }
    function reset_sln() {
        var shipping_last_name = document.getElementById("shipping_last_name").value;
        var oldshipping_last_name = '<?= $suserrow['last_name'] ?>';
        if (($('#hide_sln').css('display') != 'none') && ($('#hide_sln1').css('display') != 'none')) {
            $('#dis_sln').show();
            $('#hide_sln').hide();
            $('#hide_sln1').hide();
        }
        else if (($('#hide_sln').css('display') != 'none') && ($('#hide_sln1').css('display') == 'none')) {
            $('#dis_sln').show();
            $('#hide_sln').hide();
        }
        document.getElementById("shipping_last_name").value = oldshipping_last_name;
        document.getElementById("shipping_last_name").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //SHIPPING PH1
    function dis_sph() {
        var shipping_ph_no = document.getElementById("shipping_ph_no").value;
        var oldshipping_ph_no = '<?= $suserrow['phone'] ?>';
        if ($('#hide_sph').css('display') == 'none') {
            if (shipping_ph_no == oldshipping_ph_no) {
                $('#dis_sph').hide();
                $('#hide_sph').show();
            }
            if (shipping_ph_no != oldshipping_ph_no) {
                $('#dis_sph').hide();
                $('#hide_sph').show();
                $('#hide_sph1').show();
            }
            document.getElementById("shipping_ph_no").readOnly = false;
            document.getElementById("shipping_ph_no").focus();
            var updatedetailInput = $("#shipping_ph_no");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_sph').show();
            $('#hide_sph').hide();
            $('#hide_sph1').hide();
            document.getElementById("shipping_ph_no").readOnly = true;
        }
    }
    function reset_sph() {
        var shipping_ph_no = document.getElementById("shipping_ph_no").value;
        var oldshipping_ph_no = '<?= $suserrow['phone'] ?>';
        if (($('#hide_sph').css('display') != 'none') && ($('#hide_sph1').css('display') != 'none')) {
            $('#dis_sph').show();
            $('#hide_sph').hide();
            $('#hide_sph1').hide();
        }
        else if (($('#hide_sph').css('display') != 'none') && ($('#hide_sph1').css('display') == 'none')) {
            $('#dis_sph').show();
            $('#hide_sph').hide();
        }
        document.getElementById("shipping_ph_no").value = oldshipping_ph_no;
        document.getElementById("shipping_ph_no").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //SHIPPING PH2
    function dis_s2ph() {
        var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
        var oldshipping_ph_no2 = '<?= $suserrow['phone'] ?>';
        if ($('#hide_s2ph').css('display') == 'none') {
            if (shipping_ph_no2 == oldshipping_ph_no2) {
                $('#dis_s2ph').hide();
                $('#hide_s2ph').show();
            }
            if (shipping_ph_no2 != oldshipping_ph_no2) {
                $('#dis_s2ph').hide();
                $('#hide_s2ph').show();
                $('#hide_s2ph1').show();
            }
            document.getElementById("shipping_ph_no2").readOnly = false;
            document.getElementById("shipping_ph_no2").focus();
            var updatedetailInput = $("#shipping_ph_no2");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_s2ph').show();
            $('#hide_s2ph').hide();
            $('#hide_s2ph1').hide();
            document.getElementById("shipping_ph_no2").readOnly = true;
        }
    }
    function reset_s2ph() {
        var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
        var oldshipping_ph_no2 = '<?= $suserrow['phone'] ?>';
        if (($('#hide_s2ph').css('display') != 'none') && ($('#hide_s2ph1').css('display') != 'none')) {
            $('#dis_s2ph').show();
            $('#hide_s2ph').hide();
            $('#hide_s2ph1').hide();
        }
        else if (($('#hide_s2ph').css('display') != 'none') && ($('#hide_s2ph1').css('display') == 'none')) {
            $('#dis_s2ph').show();
            $('#hide_s2ph').hide();
        }
        document.getElementById("shipping_ph_no2").value = oldshipping_ph_no2;
        document.getElementById("shipping_ph_no2").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //SHIPPING PH2
    function dis_s2ph() {
        var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
        var oldshipping_ph_no2 = '<?= $suserrow['alternative_phone'] ?>';
        if ($('#hide_s2ph').css('display') == 'none') {
            if (shipping_ph_no2 == oldshipping_ph_no2) {
                $('#dis_s2ph').hide();
                $('#hide_s2ph').show();
            }
            if (shipping_ph_no2 != oldshipping_ph_no2) {
                $('#dis_s2ph').hide();
                $('#hide_s2ph').show();
                $('#hide_s2ph1').show();
            }
            document.getElementById("shipping_ph_no2").readOnly = false;
            document.getElementById("shipping_ph_no2").focus();
            var updatedetailInput = $("#shipping_ph_no2");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_s2ph').show();
            $('#hide_s2ph').hide();
            $('#hide_s2ph1').hide();
            document.getElementById("shipping_ph_no2").readOnly = true;
        }
    }
    function reset_s2ph() {
        var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
        var oldshipping_ph_no2 = '<?= $suserrow['alternative_phone'] ?>';
        if (($('#hide_s2ph').css('display') != 'none') && ($('#hide_s2ph1').css('display') != 'none')) {
            $('#dis_s2ph').show();
            $('#hide_s2ph').hide();
            $('#hide_s2ph1').hide();
        }
        else if (($('#hide_s2ph').css('display') != 'none') && ($('#hide_s2ph1').css('display') == 'none')) {
            $('#dis_s2ph').show();
            $('#hide_s2ph').hide();
        }
        document.getElementById("shipping_ph_no2").value = oldshipping_ph_no2;
        document.getElementById("shipping_ph_no2").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //SHIPPING ADDRESS
    function dis_sadd() {
        var oldshipping_address_1 = document.getElementById("shipping_address_1").value;
        var oldshipping_address_1 = '<?= $suserrow['address'] ?>';
        if ($('#hide_sadd').css('display') == 'none') {
            if (oldshipping_address_1 == oldshipping_address_1) {
                $('#dis_sadd').hide();
                $('#hide_sadd').show();
            }
            if (oldshipping_address_1 != oldshipping_address_1) {
                $('#dis_sadd').hide();
                $('#hide_sadd').show();
                $('#hide_sadd1').show();
            }
            document.getElementById("shipping_address_1").readOnly = false;
            document.getElementById("shipping_address_1").focus();
            var updatedetailInput = $("#oldshipping_address_1");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_sadd').show();
            $('#hide_sadd').hide();
            $('#hide_sadd1').hide();
            document.getElementById("shipping_address_1").readOnly = true;
        }
    }
    function reset_sadd() {
        var oldshipping_address_1 = document.getElementById("shipping_address_1").value;
        var oldshipping_address_1 = '<?= $suserrow['address'] ?>';
        if (($('#hide_sadd').css('display') != 'none') && ($('#hide_sadd1').css('display') != 'none')) {
            $('#dis_sadd').show();
            $('#hide_sadd').hide();
            $('#hide_sadd1').hide();
        }
        else if (($('#hide_sadd').css('display') != 'none') && ($('#hide_sadd1').css('display') == 'none')) {
            $('#dis_sadd').show();
            $('#hide_sadd').hide();
        }
        document.getElementById("shipping_address_1").value = oldshipping_address_1;
        document.getElementById("shipping_address_1").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //SHIPPING ADDRESS
    function dis_spin() {
        var oldshipping_postcode = document.getElementById("shipping_postcode").value;
        var oldshipping_postcode = '<?= $suserrow['pincode'] ?>';
        if ($('#hide_spin').css('display') == 'none') {
            if (oldshipping_postcode == oldshipping_postcode) {
                $('#dis_spin').hide();
                $('#hide_spin').show();
            }
            if (oldshipping_postcode != oldshipping_postcode) {
                $('#dis_spin').hide();
                $('#hide_spin').show();
                $('#hide_spin1').show();
            }
            document.getElementById("shipping_postcode").readOnly = false;
            document.getElementById("shipping_postcode").focus();
            var updatedetailInput = $("#oldshipping_postcode");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_spin').show();
            $('#hide_spin').hide();
            $('#hide_spin1').hide();
            document.getElementById("shipping_postcode").readOnly = true;
        }
    }
    function reset_spin() {
        var oldshipping_postcode = document.getElementById("shipping_postcode").value;
        var oldshipping_postcode = '<?= $suserrow['pincode'] ?>';
        if (($('#hide_spin').css('display') != 'none') && ($('#hide_spin1').css('display') != 'none')) {
            $('#dis_spin').show();
            $('#hide_spin').hide();
            $('#hide_spin1').hide();
        }
        else if (($('#hide_spin').css('display') != 'none') && ($('#hide_spin1').css('display') == 'none')) {
            $('#dis_spin').show();
            $('#hide_spin').hide();
        }
        document.getElementById("shipping_postcode").value = oldshipping_postcode;
        document.getElementById("shipping_postcode").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //FIRST_NAME
    function dis_fn() {
        var first_name = document.getElementById("first_name").value;
        var oldfirst_name = '<?= $userrow['first_name'] ?>';
        if ($('#hide_fn').css('display') == 'none') {
            if (first_name == oldfirst_name) {
                $('#dis_fn').hide();
                $('#hide_fn').show();
            }
            if (first_name != oldfirst_name) {
                $('#dis_fn').hide();
                $('#hide_fn').show();
                $('#hide_fn1').show();
            }
            document.getElementById("first_name").readOnly = false;
            document.getElementById("first_name").focus();
            var updatedetailInput = $("#first_name");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_fn').show();
            $('#hide_fn').hide();
            $('#hide_fn1').hide();
            document.getElementById("first_name").readOnly = true;
        }
    }
    function reset_fn() {
        var first_name = document.getElementById("first_name").value;
        var oldfirst_name = '<?= $userrow['first_name'] ?>';
        if (($('#hide_fn').css('display') != 'none') && ($('#hide_fn1').css('display') != 'none')) {
            $('#dis_fn').show();
            $('#hide_fn').hide();
            $('#hide_fn1').hide();
        }
        else if (($('#hide_fn').css('display') != 'none') && ($('#hide_fn1').css('display') == 'none')) {
            $('#dis_fn').show();
            $('#hide_fn').hide();
        }
        document.getElementById("first_name").value = oldfirst_name;
        document.getElementById("first_name").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //LAST_NAME
    function dis_ln() {
        var last_name = document.getElementById("last_name").value;
        var oldlast_name = '<?= $userrow['last_name'] ?>';
        if ($('#hide_ln').css('display') == 'none') {
            if (last_name == oldlast_name) {
                $('#dis_ln').hide();
                $('#hide_ln').show();
            }
            if (last_name != oldlast_name) {
                $('#dis_ln').hide();
                $('#hide_ln').show();
                $('#hide_ln1').show();
            }
            document.getElementById("last_name").readOnly = false;
            document.getElementById("last_name").focus();
            var updatedetailInput = $("#last_name");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_ln').show();
            $('#hide_ln').hide();
            $('#hide_ln1').hide();
            document.getElementById("last_name").readOnly = true;
        }
    }
    function reset_ln() {
        var last_name = document.getElementById("last_name").value;
        var oldlast_name = '<?= $userrow['last_name'] ?>';
        if (($('#hide_ln').css('display') != 'none') && ($('#hide_ln1').css('display') != 'none')) {
            $('#dis_ln').show();
            $('#hide_ln').hide();
            $('#hide_ln1').hide();
        }
        else if (($('#hide_ln').css('display') != 'none') && ($('#hide_ln1').css('display') == 'none')) {
            $('#dis_ln').show();
            $('#hide_ln').hide();
        }
        document.getElementById("last_name").value = oldlast_name;
        document.getElementById("last_name").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //PHONE
    function dis_ph() {
        var phone = document.getElementById("phone").value;
        var oldphone = '<?= $userrow['phone'] ?>';
        if ($('#hide_ph').css('display') == 'none') {
            if (phone == oldphone) {
                $('#dis_ph').hide();
                $('#hide_ph').show();
            }
            if (phone != oldphone) {
                $('#dis_ph').hide();
                $('#hide_ph').show();
                $('#hide_ph1').show();
            }
            document.getElementById("phone").readOnly = false;
            document.getElementById("phone").focus();
            var updatedetailInput = $("#phone");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_ph').show();
            $('#hide_ph').hide();
            $('#hide_ph1').hide();
            document.getElementById("phone").readOnly = true;
        }
    }
    function reset_ph() {
        var phone = document.getElementById("phone").value;
        var oldphone = '<?= $userrow['phone'] ?>';
        if (($('#hide_ph').css('display') != 'none') && ($('#hide_ph1').css('display') != 'none')) {
            $('#dis_ph').show();
            $('#hide_ph').hide();
            $('#hide_ph1').hide();
        }
        else if (($('#hide_ph').css('display') != 'none') && ($('#hide_ph1').css('display') == 'none')) {
            $('#dis_ph').show();
            $('#hide_ph').hide();
        }
        document.getElementById("phone").value = oldphone;
        document.getElementById("phone").readOnly = true;
        succeeded();
    }
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
        var oldregpin = '<?= $userrow['pincode'] ?>';
        var oldloc = '<?= $userrow['location'] ?>';
        $('#dis_pin').show();
        $('#hide_pin').hide();
        $('#hide_pin1').hide();
        $('#setloc2').hide();
        document.getElementById("regpin").value = oldregpin;
        document.getElementById("po_list1").value = oldloc;
        document.getElementById("regpin").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //LOCATE
    function dis_locate() {
        if ($('#hide_locate').css('display') != 'none') {
            $('#setloc2').hide();
            $('#dis_pin').show();
            $('#hide_pin').hide();
            $('#hide_pin1').hide();
            document.getElementById("regpin").readOnly = true;
            succeeded();
        }
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //ADDRESS
    function dis_add() {
        var address = document.getElementById("address").value;
        var oldaddress = '<?= $userrow['address'] ?>';
        if ($('#hide_add').css('display') == 'none') {
            if (address == oldaddress) {
                $('#dis_add').hide();
                $('#hide_add').show();
            }
            if (address != oldaddress) {
                $('#dis_add').hide();
                $('#hide_add').show();
                $('#hide_add1').show();
            }
            document.getElementById("address").readOnly = false;
            document.getElementById("address").focus();
            var updatedetailInput = $("#address");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_add').show();
            $('#hide_add').hide();
            $('#hide_add1').hide();
            document.getElementById("address").readOnly = true;
        }
    }
    function reset_add() {
        var address = document.getElementById("address").value;
        var oldaddress = '<?= $userrow['address'] ?>';
        if (($('#hide_add').css('display') != 'none') && ($('#hide_add1').css('display') != 'none')) {
            $('#dis_add').show();
            $('#hide_add').hide();
            $('#hide_add1').hide();
        }
        else if (($('#hide_add').css('display') != 'none') && ($('#hide_add1').css('display') == 'none')) {
            $('#dis_add').show();
            $('#hide_add').hide();
        }
        document.getElementById("address").value = oldaddress;
        document.getElementById("address").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //EMAIL
    function dis_mail() {
        var email = document.getElementById("email").value;
        var oldemail = '<?= $userrow['email'] ?>';
        if ($('#hide_mail').css('display') == 'none') {
            if (email == oldemail) {
                $('#dis_mail').hide();
                $('#hide_mail').show();
            }
            if (email != oldemail) {
                $('#dis_mail').hide();
                $('#hide_mail').show();
                $('#hide_mail1').show();
            }
            document.getElementById("email").readOnly = false;
            document.getElementById("email").focus();
        }
        else {
            $('#dis_mail').show();
            $('#hide_mail').hide();
            $('#hide_mail1').hide();
            document.getElementById("email").readOnly = true;
        }
    }
    function reset_mail() {
        var email = document.getElementById("email").value;
        var oldemail = '<?= $userrow['email'] ?>';
        if (($('#hide_mail').css('display') != 'none') && ($('#hide_mail1').css('display') != 'none')) {
            $('#dis_mail').show();
            $('#hide_mail').hide();
            $('#hide_mail1').hide();
        }
        else if (($('#hide_mail').css('display') != 'none') && ($('#hide_mail1').css('display') == 'none')) {
            $('#dis_mail').show();
            $('#hide_mail').hide();
        }
        document.getElementById("email").value = oldemail;
        document.getElementById("email").readOnly = true;
        succeeded();
    }
    //--------------------------------------------------------------------------------------------------------------------------------------------------------
    //CURRENT PASSWORD
    function dis_pass3() {
        var pass1 = document.getElementById("passfir").value;
        var pass2 = document.getElementById("passre").value;
        var pass3 = document.getElementById("pass3").value;
        var oldpass3 = 'abcdefghijklmnopqrstuvwxyz';
        if ($('#hide_pass3_1').css('display') == 'none') {
            if (document.getElementById("pass3").value == oldpass3) {
                document.getElementById("pass3").value = "";
                $('#dis_pass3').hide();
                $('#hide_pass3_1').show();
            }
            else if (document.getElementById("pass3").value != oldpass3 || document.getElementById("pass3").value != "") {
                $('#dis_pass3').hide();
                $('#hide_pass3_1').show();
                $('#hide_pass3_2').show();
            }
            document.getElementById("passfir").readOnly = false;
            document.getElementById("passre").readOnly = false;
            document.getElementById("pass3").readOnly = false;
            document.getElementById("pass3").focus();
            $('#pass').show();
        }
        else if ($('#dis_pass3').css('display') == 'none') {
            if ((pass3 == "") || (pass1 == "") || (pass2 == "")) {
                document.getElementById("pass3").value = oldpass3;
                document.getElementById("passfir").value = "";
                document.getElementById("passre").value = "";
                document.getElementById("passfir").readOnly = true;
                document.getElementById("passre").readOnly = true;
                document.getElementById("pass3").readOnly = true;
                $('#dis_pass3').show();
                $('#hide_pass3_1').hide();
                $('#hide_pass3_2').hide();
                $('#pass').hide();
            }
            if ((pass1 != "") && (pass2 != "") && (pass3 != "")) {
                $('#dis_pass3').show();
                $('#hide_pass3_1').hide();
                $('#hide_pass3_2').hide();
                document.getElementById("passfir").readOnly = true;
                document.getElementById("passre").readOnly = true;
                document.getElementById("pass3").readOnly = true;
                $('#pass').show();
            }
        }
        succeeded();
    }
    function reset_pass3() {
        var oldpass3 = 'abcdefghijklmnopqrstuvwxyz';
        document.getElementById("pass3").value = oldpass3;
        document.getElementById("passfir").value = "";
        document.getElementById("passre").value = "";
        document.getElementById("passfir").readOnly = true;
        document.getElementById("passre").readOnly = true;
        document.getElementById("pass3").readOnly = true;
        $('#dis_pass3').show();
        $('#hide_pass3_1').hide();
        $('#hide_pass3_2').hide();
        $('#pass').hide();
        succeeded();
    }
    function dis_change_pass() {
        if (document.getElementById("pass3").value == "" || document.getElementById("passfir").value == "" || document.getElementById("passre").value == "") {
            $('#dis_pass3').hide();
            $('#hide_pass3_1').show();
            $('#hide_pass3_2').hide();
        }
        else {
            $('#dis_pass3').hide();
            $('#hide_pass3_1').hide();
            $('#hide_pass3_2').show();
        }
        $('#update_user_details').show();
        succeeded();
    }
    function changed_details() {
        $('#update_user_details').show();
        listenchanges();
        succeeded();
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
        if (/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(user_details_update_form.email.value)) {
            return true;
        }
        return false;
    }
    $(document).ready(function (e) {
        $("#setloc2").hide();
    });
    function checkupdate() {
        //fetch data into variables
        var first_name = document.getElementById("first_name").value;
        var last_name = document.getElementById("last_name").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var email = document.getElementById("email").value;
        var pass1 = document.getElementById("passfir").value;
        var pass_input = document.getElementById("passfir");
        var pass2 = document.getElementById("passre").value;
        var pass3 = document.getElementById("pass3").value;
        var regpin = document.getElementById("regpin").value;
        var loc = document.getElementById("po_list1").value;
        var shipping_first_name = document.getElementById("shipping_first_name").value;
        var shipping_last_name = document.getElementById("shipping_last_name").value;
        var shipping_ph_no = document.getElementById("shipping_ph_no").value;
        var shipping_ph_no2 = document.getElementById("shipping_ph_no2").value;
        var shipping_address_1 = document.getElementById("shipping_address_1").value;
        var shipping_postcode = document.getElementById("shipping_postcode").value;
        var alert = "<i style='color: yellow;float: left;text-shadow: 1px 2px 3px black' class='fas fa-lg fa-warning'>&nbsp;</i>";
        //checking unwanted space
        var first_namespace = first_name.split(" ");
        var Last_namespace = last_name.split(" ");
        //validating first name isempty
        if (first_name == null || first_name == "") {
            toastr.error("First name can't be empty !");
            $('.ad').click();
            document.getElementById("first_name").focus();
            document.getElementById("first_name").className += " invalid";
            return;
        }
        //validating first name is not a number
        else if (!(isNaN(first_name))) {
            toastr.error("First name is not a number !");
            $('.ad').click();
            document.getElementById("first_name").className += " invalid";
            document.getElementById("first_name").focus();
            return;
        }
        //validating white spaces
        else if (first_namespace.length > 1) {
            toastr.error("'SPACE' not allowed");
            $('.ad').click();
            document.getElementById("first_name").className += " invalid";
            document.getElementById("first_name").focus();
            return;
        }
        //limiting the name length
        else if (first_name.length > 20) {
            toastr.error("Entry is too long !");
            $('.ad').click();
            document.getElementById("first_name").className += " invalid";
            document.getElementById("first_name").focus();
            return;
        }
        //minimal character check
        else if (first_name.length < 2) {
            toastr.error("Entry is too weak !");
            $('.ad').click();
            document.getElementById("first_name").className += " invalid";
            document.getElementById("first_name").focus();
            return;
        }
        //validating last name isempty
        if (last_name == null || last_name == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter  your last name",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("last_name").className += " invalid";
            document.getElementById("last_name").focus();
            return;
        }
        //validating last name is not a number
        else if (!(isNaN(last_name))) {
            swal({
                title: "Oops!!!",
                text: "Please use Albhabets",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("last_name").className += " invalid";
            document.getElementById("last_name").focus();
            return;
        }
        //Phone number check
        if (phone == null || phone == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter your phone number",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("phone").className += " invalid";
            document.getElementById("phone").focus();
            return;
        }
        //validating Phone is a number
        else if (isNaN(phone) || phone.length != 10) {
            swal({
                title: "Oops!!!",
                text: "Invalid phone number",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("phone").className += " invalid";
            document.getElementById("phone").focus();
            return;
        }
        //PIN check
        else if (regpin == null || regpin == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter the pincode !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("regpin").className += " invalid";
            document.getElementById("regpin").focus();
            return;
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
            $('.ad').click();
            document.getElementById("regpin").value = "";
            document.getElementById("regpin").className += " invalid";
            document.getElementById("regpin").focus();
            return;
        }
        //PIN check
        //Location
        else if (loc == 0) {
            swal({
                title: "Missing location!!!",
                text: "Search your pincode !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("po_list1").className += " invalid";
            document.getElementById("po_list1").focus();
            return;
        }
        //Location
        //address check
        if (address == null || address == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter your Address",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("address").className += " invalid";
            document.getElementById("address").focus();
            return;
        }
        //validating address is not a number and its length above 4
        else if (!(isNaN(address)) || address.length < 5) {
            swal({
                title: "Oops!!!",
                text: "Invalid Address",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.ad').click();
            document.getElementById("address").className += " invalid";
            document.getElementById("address").focus();
            return;
        }
        //email verification of null value
        if (email == null || email == "") {
            swal({
                title: "Oops!!!",
                text: "Please enter your email ID !!! ",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            $('.cep').click();
            document.getElementById("email").className += " invalid";
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
            $('.cep').click();
            document.getElementById("email").className += " invalid";
            document.getElementById("email").focus();
            return;
        }
        if (pass3 != 'abcdefghijklmnopqrstuvwxyz') {
            //current passwords
            if (pass3 == null || pass3 == "") {
                swal({
                    title: "Oops!!!",
                    text: "Please enter your current password",
                    icon: "error",
                    closeOnClickOutside: false,
                    dangerMode: true,
                    timer: 6000,
                });
                $('.cep').click();
                document.getElementById("pass3").focus();
                document.getElementById("pass3").className += " invalid";
                return;
                return;
            }
            //password verification of null value
            if (pass1 == null || pass1 == "") {
                swal({
                    title: "Oops!!!",
                    text: "Please enter new password !!! ",
                    icon: "error",
                    closeOnClickOutside: false,
                    dangerMode: true,
                    timer: 6000,
                });
                dis_pass3();
                $('.cep').click();
                document.getElementById("passfir").focus();
                document.getElementById("passfir").className += " invalid";
                return;
            }
            // Validate lowercase letters
            var lowerCaseLetters = !/[a-z]/g;
            if (pass_input.value.match(lowerCaseLetters)) {
                $('.cep').click();
                document.getElementById("passfir").focus();
                document.getElementById("passfir").className += " invalid";
                return false;
            }
            // Validate capital letters
            var upperCaseLetters = !/[A-Z]/g;
            if (pass_input.value.match(upperCaseLetters)) {
                $('.cep').click();
                document.getElementById("passfir").focus();
                document.getElementById("passfir").className += " invalid";
                return false;
            }
            // Validate numbers
            var numbers = !/[0-9]/g;
            if (pass_input.value.match(numbers)) {
                $('.cep').click();
                document.getElementById("passfir").focus();
                document.getElementById("passfir").className += " invalid";
                return false;
            }
            //weak password verification
            else if (pass1.length < 8) {
                swal({
                    title: "Oops!!!",
                    text: "Weak Password !!! Try again ",
                    icon: "error",
                    closeOnClickOutside: false,
                    dangerMode: true,
                    timer: 6000,
                });
                dis_pass3();
                $('.cep').click();
                document.getElementById("passfir").className += " invalid";
                document.getElementById("passfir").focus();
                return;
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
                dis_pass3();
                $('.cep').click();
                document.getElementById("passfir").className += " invalid";
                document.getElementById("passre").className += " invalid";
                document.getElementById("passre").focus();
                return;
            }
        }
        //checking unwanted space
        var shipping_first_namespace = shipping_first_name.split(" ");
        //validating first name isempty
        if (shipping_first_name == null || shipping_first_name == "") {
            toastr.error("First name can't be empty !");
            $('.da').click();
            document.getElementById("shipping_first_name").focus();
            document.getElementById("shipping_first_name").className += " invalid";
            return false;
        }
        //validating first name is not a number
        if (!(isNaN(shipping_first_name))) {
            toastr.error("First name is not a number !");
            $('.da').click();
            document.getElementById("shipping_first_name").focus();
            document.getElementById("shipping_first_name").className += " invalid";
            return false;
        }
        //validating white spaces
        else if (shipping_first_namespace.length > 1) {
            toastr.error("'SPACE' not allowed");
            return false;
        }
        //limiting the name length
        else if (shipping_first_name.length > 20) {
            toastr.error("Entry is too long !");
            $('.da').click();
            document.getElementById("shipping_first_name").focus();
            document.getElementById("shipping_first_name").className += " invalid";
            return false;
        }
        //minimal character check
        else if (shipping_first_name.length < 2) {
            toastr.error("Entry is too weak !");
            $('.da').click();
            document.getElementById("shipping_first_name").focus();
            document.getElementById("shipping_first_name").className += " invalid";
            return false;
        }
        //validating last name isempty
        if (shipping_last_name == null || shipping_last_name == "") {
            toastr.error("Please enter last name !");
            $('.da').click();
            document.getElementById("shipping_last_name").focus();
            document.getElementById("shipping_last_name").className += " invalid";
            return false;
        }
        //validating first name is not a number
        else if (!(isNaN(shipping_last_name))) {
            toastr.error("Please use alphabets !");
            $('.da').click();
            document.getElementById("shipping_last_name").focus();
            document.getElementById("shipping_last_name").className += " invalid";
            return false;
        }
        //Phone 2 number check
        if (shipping_ph_no == null || shipping_ph_no == "") {
            toastr.error("Required phone number !");
            $('.da').click();
            document.getElementById("shipping_ph_no").focus();
            document.getElementById("shipping_ph_no").className += " invalid";
            return false;
        }
        //validating shipping_ph_no is a number
        else if (isNaN(shipping_ph_no) || shipping_ph_no.length != 10) {
            toastr.error("Invalid phone number !");
            $('.da').click();
            document.getElementById("shipping_ph_no").focus();
            document.getElementById("shipping_ph_no").className += " invalid";
            return false;
        }
        //validating shipping_ph_no 2 is a number
        if (shipping_ph_no2 != "" && shipping_ph_no2.length != 10) {
            toastr.error("Invalid alternative number !");
            $('.da').click();
            document.getElementById("shipping_ph_no2").focus();
            document.getElementById("shipping_ph_no2").className += " invalid";
            return false;
        }
        //address check
        if (shipping_address_1 == null || shipping_address_1 == "") {
            toastr.error("Please enter your address !");
            $('.da').click();
            document.getElementById("shipping_address_1").focus();
            document.getElementById("shipping_address_1").className += " invalid";
            return false;
        }
        //validating address if its length above 4
        if (shipping_address_1 != null && shipping_address_1.length < 10) {
            toastr.error("Invalid shipping address !");
            $('.da').click();
            document.getElementById("shipping_address_1").focus();
            document.getElementById("shipping_address_1").className += " invalid";
            return false;
        }
        //PIN check
        //PIN check
        else if (shipping_postcode == null || shipping_postcode == "") {
            toastr.error("Please enter the pincode !!!");
            $('.da').click();
            document.getElementById("shipping_postcode").focus();
            document.getElementById("shipping_postcode").className += " invalid";
            return false;
        }
        else if (shipping_postcode.length != 6) {
            toastr.error("Please enter valid pincode !");
            $('.da').click();
            document.getElementById("shipping_postcode").value = "";
            document.getElementById("shipping_postcode").focus();
            document.getElementById("shipping_postcode").className += " invalid";
            return false;
        }
        if (document.getElementById("accept").checked == false) {
            swal({
                title: "Oops!!!",
                text: "Please Accept the terms and conditions",
                icon: "error",
                closeOnClickOutside: false,
                dangerMode: true,
                timer: 6000,
            });
            return;
        }
        else {
            if (pass3 == 'abcdefghijklmnopqrstuvwxyz') {
                pass3 = 'no change';
            }
            Swal.fire({
                title: "Are you sure?",
                text: "update your details",
                icon: "warning",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: 'red',
                allowOutsideClick: false,
                confirmButtonText: '<i class="fa fa-close"></i> Cancel',
                cancelButtonColor: 'green',
                cancelButtonText: '<i class="fa fa-check"></i> Update'
            })
                .then((willSubmit) => {
                    if (willSubmit.dismiss) {
                        $('.load_btn').show();
                        $('.real_btn').hide();
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
                            data: { "update_user_details": 1, "first_name": first_name, "last_name": last_name, "phone": phone, "pin": regpin, "location": loc, "latitude": lat, "longitude": long, "address": address, "current_password": pass3, "email": email, "new_password": pass1, "shipping_first_name": shipping_first_name, "shipping_last_name": shipping_last_name, "shipping_ph_no": shipping_ph_no, "shipping_ph_no2": shipping_ph_no2, "shipping_address_1": shipping_address_1, "shipping_postcode": shipping_postcode },  //form data
                            type: "post",   //post data
                            dataType: "json",   //datatype=json format
                            timeout: 30000,   //waiting time 30 sec
                            success: function (data) {    //if registration is success
                                if (data.status == 'success') {
                                    swal({
                                        title: "Success!!!",
                                        text: "Updated successfully",
                                        icon: "success",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit2) => {
                                            if (willSubmit2) {
                                                if (pass3 == 'no change') {
                                                    location.reload();
                                                    return;
                                                }
                                                else {
                                                    location.href = "../Account/logout.php"
                                                    return;
                                                }
                                            }
                                            else {
                                                return;
                                            }
                                        })
                                }
                                if (data.status == 'success1') {
                                    swal({
                                        title: "Success!!!",
                                        text: "Updation pending",
                                        icon: "success",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit1) => {
                                            if (willSubmit1) {
                                                swal({
                                                    text: "Please verify your email !",
                                                    icon: "warning",
                                                    closeOnClickOutside: false,
                                                    dangerMode: true,
                                                })
                                                    .then((willSubmit2) => {
                                                        if (willSubmit2) {
                                                            if (pass3 == 'no change') {
                                                                location.href = "../Main/onestore.php"
                                                                return;
                                                            }
                                                            else {
                                                                location.href = "../Account/logout.php"
                                                                return;
                                                            }
                                                        }
                                                        else {
                                                            return;
                                                        }
                                                    })
                                            }
                                            else {
                                                return;
                                            }
                                        });
                                }
                                else if (data.status == 'error3') {
                                    $('.load_btn').hide();
                                    $('.real_btn').show();
                                    swal({
                                        title: "Oops!!!",
                                        text: "First name is not valid",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit) => {
                                            if (willSubmit) {
                                                document.getElementById('nameerror').innerHTML = alert + "First name is not valid"
                                                $('#error_dis').show();
                                                var elem = $('#error_dis');
                                                if (elem) {
                                                    $('html').scrollTop(elem.offset().top);
                                                    $('html').scrollLeft(elem.offset().left);
                                                    return;
                                                }
                                            }
                                            else {
                                                return;
                                            }
                                        });
                                }
                                else if (data.status == 'error2') {
                                    $('.load_btn').hide();
                                    $('.real_btn').show();
                                    swal({
                                        title: "Oops!!!",
                                        text: "Email is not valid",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit) => {
                                            if (willSubmit) {
                                                document.getElementById('nameerror2').innerHTML = alert + "Can't use any symbols(@ # $ % ... )"
                                                $('#error_dis2').show();
                                                var elem = $('#error_dis2');
                                                if (elem) {
                                                    $('html').scrollTop(elem.offset().top);
                                                    $('html').scrollLeft(elem.offset().left);
                                                    return;
                                                }
                                            }
                                            else {
                                                return;
                                            }
                                        });
                                }
                                else if (data.status == 'error1') {
                                    $('.load_btn').hide();
                                    $('.real_btn').show();
                                    swal({
                                        title: "Oops!!!",
                                        text: "Another account with same mobile number already exists",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit) => {
                                            if (willSubmit) {
                                                document.getElementById('nameerror').innerHTML = alert + "Another account with same mobile number already exists";
                                                $('#error_dis').show();
                                                var elem = $('#error_dis');
                                                if (elem) {
                                                    $('html').scrollTop(elem.offset().top);
                                                    $('html').scrollLeft(elem.offset().left);
                                                    return;
                                                }
                                            }
                                            else {
                                                return;
                                            }
                                        });
                                }
                                else if (data.status == 'error') {
                                    $('.load_btn').hide();
                                    $('.real_btn').show();
                                    swal({
                                        title: "Oops!!!",
                                        text: "Another account with same email ID already exists",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit) => {
                                            if (willSubmit) {
                                                document.getElementById('nameerror2').innerHTML = alert + "Another account with same email ID already exists";
                                                $('#error_dis2').show();
                                                var elem = $('#error_dis2');
                                                if (elem) {
                                                    $('html').scrollTop(elem.offset().top);
                                                    $('html').scrollLeft(elem.offset().left);
                                                    return;
                                                }
                                            }
                                            else {
                                                return;
                                            }
                                        });
                                }
                                else if (data.status == 'error_no_match_password') {
                                    $('.load_btn').hide();
                                    $('.real_btn').show();
                                    swal({
                                        title: "Oops!!!",
                                        text: "Current passwords do not match  ",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit) => {
                                            if (willSubmit) {
                                                document.getElementById('nameerror2').innerHTML = alert + "Current passwords do not match ";
                                                $('#error_dis2').show();
                                                var elem = $('#error_dis2');
                                                if (elem) {
                                                    $('html').scrollTop(elem.offset().top);
                                                    $('html').scrollLeft(elem.offset().left);
                                                    return;
                                                }
                                            }
                                            else {
                                                return;
                                            }
                                        });
                                }
                            },
                            error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
                                if (textstatus === "timeout") {
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
                                    return;
                                }
                                else { return; }
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
                    else if (willSubmit.isConfirmed === Swal.DismissReason.cancel) { return; }
                });//NOW .(THIS) END WILL SUBMIT (NOT NEEDED)
        }//NOW END ELSE
    }
    function view() {
        var pass1 = document.getElementById("passfir");
        var pass2 = document.getElementById("passre");
        var pass3 = document.getElementById("pass3");
        if (pass1.type == 'password') {
            pass1.type = 'text';
            pass2.type = 'text';
            pass3.type = 'text';
            $("#dis_pass1").hide();
            $("#hide_pass1").show();
        }
        else {
            pass1.type = 'password';
            pass2.type = 'password';
            pass3.type = 'password';
            $("#dis_pass1").show();
            $("#hide_pass1").hide();
        }
    }
</script>
</body>

</html>