<?php
require "../Main/header.php";
require "../Common/pdo.php";
//Generate Dynamic Loading
function randomGen($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
//Generate Dynamic Loading
?>
<!-- breadcrumbs -->
<div class="breadcrumbs" style="background-color: #eaeded">
    <div class="container">
        <ol class="breadcrumb breadcrumb1" style="background-color: #eaeded">
            <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Cart</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<style type="text/css">
    input[type="submit"],
    button[type=submit],
    input[type="button"] {
        background: none repeat scroll 0 0 #5a88ca;
        border: medium none;
        color: #fff;
        padding: 11px 20px;
        text-transform: uppercase;
        font-size: 12px;
    }

    table.shop_table td.product-remove a {
        display: inline-block;
        padding: 2px 5px 1px;
        text-transform: uppercase;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    table.shop_table {
        border-bottom: 0px none #fff;
        border-right: 0px none #fff;
        margin-bottom: 50px;
        width: 100%;
    }

    table.shop_table th,
    table.shop_table td {
        border-left: 0px none #fff;
        border-top: 0px none #fff;
        padding: 15px;
        text-align: left;
    }

    table.shop_table th {
        background: none repeat scroll 0 0 #5a88ca;
        color: #ffffff;
        font-size: 15px;
        text-transform: uppercase;
    }

    .cross-sells {
        float: left;
        margin-right: 3%;
        width: 57%;
    }

    div.cart-collaterals ul.products {
        list-style: outside none none;
        margin: 0 0 0 -30px;
        padding: 0;
    }

    .cart-collaterals {
        overflow: hidden;
    }

    .cart_totals {
        float: right;
        margin-bottom: 50px;
        width: 40%;
    }

    .cart-collaterals h2 {
        color: #5a88ca;
        font-size: 25px;
        margin-bottom: 25px;
        text-transform: uppercase;
    }

    div.cart-collaterals ul.products {
        list-style: outside none none;
        margin: 0 0 0 -30px;
        padding: 0;
    }

    div.cart-collaterals ul.products li.product {
        float: left;
        margin-left: 30px;
        position: relative;
        width: 198px;
    }

    .cart_totals table {
        border-bottom: 1px solid #ddd;
        border-right: 1px solid #ddd;
        width: 100%;
    }

    .cart_totals table th,
    .cart_totals table td {
        border-left: 1px solid #ddd;
        border-top: 1px solid #ddd;
        padding: 10px;
    }

    .cart_totals table th {
        background: none repeat scroll 0 0 #f4f4f4;
    }

    .onsale {}

    div.cart-collaterals ul.products li.product .onsale {
        background: none repeat scroll 0 0 #5a88ca;
        color: #fff;
        padding: 5px 10px;
        position: absolute;
        right: 0;
    }

    div.cart-collaterals ul.products li.product h3 {
        color: #333;
        font-size: 20px;
        margin-top: 15px;
    }

    div.cart-collaterals ul.products li.product .price {
        color: #333;
        display: block;
        margin-bottom: 10px;
        overflow: hidden;
    }

    .price>ins {}

    div.cart-collaterals ul.products li.product .price ins {
        color: #5a88ca;
        font-weight: 700;
        margin-left: 10px;
        text-decoration: none;
    }

    @media(max-width: 991px) {
        #large_screen {
            display: none;
        }

        #small_screen {
            display: unset;
        }

        .nopadding-margin {
            padding: 0px !important;
            margin-left: 0px !important;
            margin-right: 0px !important;
        }

        .full-size-cart-store-div {
            margin-left: 0px !important;
        }

        .full-size-cart-price-div {
            margin-left: 40px !important;
        }

        .emp_cart {
            margin-left: 20px;
            margin-right: 20px;
        }
    }

    @media(min-width: 992px) {
        #large_screen {
            display: unset;
        }

        #small_screen {
            display: none;
        }

        .full-size-cart-store-div {
            margin-left: 0 !important;
        }

        .full-size-cart-price-div {
            margin-left: 0 !important;
        }
    }

    table {
        border-spacing: 0px;
        table-layout: ;
        margin-left: auto;
        margin-right: auto;
    }

    @media(min-width: 993px) {
        .product-price {
            font-size: 22px !important;
        }
    }

    @media(max-width: 992px) {
        .product-price {
            font-size: 3vw !important;
        }
    }

    @media(max-width: 578px) {
        .large_specs_seen {
            display: none !important;
        }

        .product-price {
            font-size: 5vw !important;
        }
    }

    @media(max-width: 450px) {
        .item_description_td {
            float: left;
        }
    }

    @media(max-width: 370px) {
        .sidebar-title {
            font-size: 22px;
        }

        #proceed {
            background: none repeat scroll 0 0 #5a88ca;
            border: medium none;
            color: #fff;
            padding: 0px 8px;
            text-transform: uppercase;
            font-size: 10px;
        }

        .btn_sub_q,
        .btn_add_q {
            display: none;
        }

        .full-size-cart-store-div {
            margin-left: 0px !important;
        }

        img.shop_thumbnail {
            max-height: 120px !important;
            width: auto !important;
        }
    }

    .radio,
    .checkbox {
        padding: 6px 10px
    }

    .options {
        position: relative;
        padding-left: 25px
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

    .checkmark {
        position: absolute;
        top: 2px;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 50%
    }

    @media (min-width:451px) {
        .pd_name {
            font-size: 18px !important;
        }
    }

    @media (max-width:450px) {
        .checkmark {
            top: 5px;
        }

        .pd_name {
            font-size: 15px !important;
        }
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

    .side-arrow {
        transition: visibility 0s, opacity 0.8s linear;
    }

    .side-arrow {
        transition: 0.5s;
    }

    .side-ext-l {
        transition: visibility 0s, opacity 0.8s linear;
    }

    .side-ext-k {
        transition: visibility 0s, opacity 0.3s linear !important;
    }

    #update_item:hover {
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function () {
        $('.deselect').attr('checked', false);
    })
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //PRICE AND CART SETTINGS  WISHLIST
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //WISHLIST ENTRY ITEMS
    function wishlist_check_store_select(idid, store_id) {
        var item_description_id = idid;
        var id = store_id;
        $.ajax({
            url: "../Common/functions.php", //passing page info
            data: { "addtowishlist": 1, "item_description_id": item_description_id, "store_id": id },  //form data
            type: "post",   //post data
            dataType: "json",   //datatype=json format
            timeout: 30000,   //waiting time 30 sec
            success: function (data) {    //if registration is success
                if (data.status == 'success') {
                    $(".load_btn").hide();
                    $(".real_btn").show();
                    return;
                }
                else {
                    return;
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
    //WISHLIST ENTRY ITEMS
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function wishlist_check_list_select(wishlist_id) {
        $(".background_loader").show();
        $(".std_loader").show();
        $.ajax({
            url: "../Common/functions.php", //passing page info
            data: { "fetchedwishlistid": 1, "wishlist_id": wishlist_id },  //form data
            type: "post",   //post data
            dataType: "json",   //datatype=json format
            timeout: 30000,   //waiting time 30 sec
            success: function (data) {    //if registration is success
                if (data.status == 'success') {
                    $(".background_loader").hide();
                    $(".std_loader").hide();
                    $('#wish_cnt_' + wishlist_id + '').html(data.new_wish_cnt);
                    swal({
                        title: "Added!!!",
                        text: "Check your wishlist",
                        icon: "success",
                        closeOnClickOutside: false,
                        dangerMode: true,
                    })
                        .then((willSubmit1) => {
                            if (willSubmit1) {
                                return;
                            }
                            else {
                                return;
                            }
                        });
                }
                else if (data.status == 'success1') {
                    $(".background_loader").hide();
                    $(".std_loader").hide();
                    swal({
                        title: "Item exists!!!",
                        text: "Check your wishlist",
                        icon: "warning",
                        closeOnClickOutside: false,
                        dangerMode: true,
                    })
                        .then((willSubmit1) => {
                            if (willSubmit1) {
                                return;
                            }
                            else {
                                return;
                            }
                        });
                }
                else if (data.status == 'error') {
                    $(".background_loader").hide();
                    $(".std_loader").hide();
                    swal({
                        title: "Required!!!",
                        text: "You need to create an Account",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                    })
                        .then((willSubmit) => {
                            if (willSubmit) {
                                location.href = "../Account/registered.php";
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
                    $(".background_loader").hide();
                    $(".std_loader").hide();
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
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var filter = [];
    function addorremove(checkbox) {
        if (checkbox.checked) {
            var chks = document.getElementsByClassName("checktobuy");
            var id = 0;
            var flag = 0;
            var subtot = 0;
            for (var i = 0; i < chks.length; i++) {
                if (chks[i].checked == true) {
                    id = chks[i].value;
                    var sec = id.split("_");
                    var sid_sec = sec[0].split("-");
                    var idid_sec = sec[1].split("-");
                    var sid = sid_sec[1];
                    var idid = idid_sec[1];
                    subtot += parseInt($('#total_s' + sid + 'i' + idid).html());
                    flag++;
                }
            }
            if (flag == 1) {
                $('.side-arrow').show();
                $('.side-ext-l').show();
                $('.side-ext-r').css('display', 'flex');
                $('.side-arrow').css('display', 'flex');
                $('.side-arrow').css('visibility', 'visible');
                $('.side-ext-l').css('visibility', 'visible');
                $('.side-ext-r').css('visibility', 'visible');
                $('.side-ext-l').css('opacity', '1');
                $('.side-ext-r').css('opacity', '1');
                $('.side-arrow').css('opacity', '1');
                $('.side-arrow').css('right', '198px');
                $('.arr-r').show();
                $('.arr-l').hide();
            }
            if (flag != 0) {
                $('#sub_mul').html(subtot);
            }
            $('#sel_itcnt').html(flag);
            var val = checkbox.value;
            filter.push({ type: val });
            console.log('Before removing object from an array -> ' + JSON.stringify(filter));
            // Convert the cart object into JSON string and save it into storage
            localStorage.setItem("cartObject", JSON.stringify(filter));
            // Retrieve the JSON string
            /*var jsonString = localStorage.getItem("cartObject");
            var cartobj=JSON.parse(jsonString);
            console.log(cartobj);*/
        } else {
            var chks = document.getElementsByClassName("checktobuy");
            var id = 0;
            var checkempty = 0;
            var subtot = 0;
            for (var i = 0; i < chks.length; i++) {
                if (chks[i].checked == true) {
                    id = chks[i].value;
                    var sec = id.split("_");
                    var sid_sec = sec[0].split("-");
                    var idid_sec = sec[1].split("-");
                    var sid = sid_sec[1];
                    var idid = idid_sec[1];
                    subtot += parseInt($('#total_s' + sid + 'i' + idid).html());
                    checkempty++;
                }
            }
            if (checkempty == 0) {
                deselect();
            }
            if (checkempty != 0) {
                $('#sub_mul').html(subtot);
            }
            $('#sel_itcnt').html(checkempty);
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //REMOVING THE TAGS WITH VALUE OF THE KEY
            console.log('Before removing object from an array -> ' + JSON.stringify(filter));
            var removeIndex = filter.map(function (item) { return item.type; }).indexOf(val)
            console.log(removeIndex)
            filter.splice(removeIndex, 1);
            console.log('After removing object from an array -> ' + JSON.stringify(filter));
            //REMOVING THE TAGS WITH VALUE OF THE KEY
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
    }
    <?php
    if (isset($_SESSION['id'])) {
        ?>
        function check_mul() {
            $.ajax({
                url: "../Common/functions.php", //passing page info
                data: { "check_mul": 1, "key": filter, "user": <?= $_SESSION['id'] ?> },  //form data
                type: "post",   //post data
                dataType: "json",   //datatype=json format
                timeout: 30000,   //waiting time 30 sec
                success: function (data) {    //if registration is success
                    if (data.status == 'success') {
                        location.href = "../Checkout/checkout_mul.php";
                        return;
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
        <?php
    }
    ?>
    function deselect() {
        filter = [];
        $('.deselect').attr('checked', false);
        $('.side-arrow').css('visibility', 'hidden');
        $('.side-arrow').css('opacity', '0');
        $('.side-ext-l').css('visibility', 'hidden');
        $('.side-ext-l').css('opacity', '0');
        $('.side-ext-r').css('visibility', 'hidden');
        $('.side-ext-r').css('opacity', '0');
        $('.checktobuy').attr('checked', false);
        console.log('After removing object from an array -> ' + JSON.stringify(filter));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
<div class="side-arrow"
    style="position: fixed;bottom: 0px;height:148px;right:198px;z-index: 100;color:rgb(255, 255, 255);background-color: rgba(250, 245, 245, 0);padding:10px;border-top-left-radius: 10px;display: none;justify-content: center;align-items: center;">
    <div class="shadow_all_none"
        style="display: flex;justify-content: center;align-items: center;border-radius: 50%; background-color: rgb(1, 134, 187);width:35px;height:35px">
        <i style="display: none;margin-bottom: 0px;margin-left: -2px;" class="fa fa-shopping-cart fa-lg arr-l"
            onclick="$('.side-ext-r').css('visibility','visible');$('.side-ext-r').css('opacity','1');$('.side-arrow').css('right','198px');$('.arr-l').hide();$('.arr-r').show();"></i>
        <i style="font-size: 40px;margin-left: 10px;margin-bottom: 2px;" class="fa fa-angle-right fa-3x arr-r"
            onclick="$('.side-ext-r').css('visibility','hidden');$('.side-ext-r').css('opacity','0');$('.side-arrow').css('right','0');$('.arr-r').hide();$('.arr-l').show();"></i>
    </div>
</div>
<div class="side-ext shadow_l">
    <div class="div_wrapper side-ext-l side-ext-r shadow_l"
        style="display:flex;padding:0;display: none;bottom:100px;position: fixed;width: 200px;right:0;z-index: 99;">
        <input type="button"
            style="height: 50px;font-weight: bold;border-top-left-radius: 10px;background-color: #ff5722;bottom:100px;position: fixed;width: 200px;right:0;"
            onclick="check_mul()" value="Proceed to buy" name="proceed"
            class=" button alt wc-forward side-ext-k shadow_l">
    </div>
    <div class="side-ext-l side-ext-r shadow_l"
        style="visibility: visible;opacity: 1;display: none;position: fixed;width: 200px;right:0;bottom:0;z-index: 99;">
        <div class="side-ext-l side-ext-r shadow_l"
            style="position: fixed;bottom: 50px;right:0;z-index: 99;color:white;background-color: rgb(70, 70, 70);padding:10px;width:200px;">
            <label class="options"><span class="val-getbrand">Deselect all</span><input onclick="deselect()"
                    class="deselect" value="" id="mobgetbrand" type="radio" name="mob-radio-getbrand"> <span
                    class="checkmark "></span></label>
        </div>
        <div class="side-ext-l side-ext-r"
            style="display:flex;width: 100%;padding:0;justify-content: flex-end;padding-right: 0px;position: fixed;right:0;bottom:0;z-index: 99;">
            <div class="shadow_l"
                style="background-color: rgb(250, 245, 245);padding-left:10px;padding-right:10px;display:flex;justify-content: center;align-items: center;width:200px">
                <i class="fa fa-check fa-2x" style="color: seagreen;float:left;padding-right: 10px;"></i>
                <h5 style="float:left;font-weight: bold;">Selected <span id="sel_itcnt">0</span> item(s)
                    <div class="clearfix"></div>
                    <span style="float: left;margin-bottom: -5px;margin-top: 5px;">Subtotals <i class="fa fa-inr"></i>
                        <span id="sub_mul">0</span></span>
                </h5>
            </div>
        </div>
    </div>
</div><!--side-ext-->
<div class="single-product-area" style="padding-top: 0px; background-color: #eaeded;padding-bottom:0px">
    <div class="zigzag-bottom"></div>
    <div class="container nopadding-margin" style="margin-left: 0px;width: 100%;padding:0">
        <div class="row" style="margin: 0px;">
            <div class="col-md-12" style="margin:0px;padding: 0px;width: 100%">
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $sqlc = "select * from cart where user_id=:id";
                    $stmtc = $pdo->prepare($sqlc);
                    $stmtc->execute(array(
                        ':id' => $id
                    ));
                    $rowc = $stmtc->fetch(PDO::FETCH_ASSOC);
                    if ($rowc) {
                        ?>
                        <div class="col-md-9" style="margin:0px;padding: 0px;margin: 0px;">
                            <div class="product-content-right nopadding-margin"
                                style="margin:0px;padding: 0px;margin-right: 10px;background-color: white;border-radius: 10px;">
                                <h2 class="sidebar-title"
                                    style="border-left: 5px solid #ff5722;border-top-left-radius: 10px;text-align: left;padding-bottom: 30px;padding-top: 20px;background-color: white;margin-top: 0px;font-weight:normal;border-bottom:#333;margin-bottom: 0px;border-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; ">
                                    Shopping Cart <i style="color: #ff5722" class="fa fa-shopping-cart"></i>
                                    <span style="float: right;margin-right: 5px;margin-top: -16px;">
                                        <input type="button"
                                            style="max-width: 150px;height: 60px;font-weight: bold;border-top-right-radius: 10px;background-color: #ff5722;"
                                            onclick="go()" value="Proceed to buy" id="proceed" name="proceed"
                                            class="checkout-button button alt wc-forward">
                                    </span>
                                </h2>
                                <hr class="make_divc" style="margin-bottom: 0px;margin-top: -10px;">
                                <div class="woocommerce">
                                    <form method="post" action="#" class="hidescroll" style="overflow-x: hidden;">
                                        <table class="shop_table cart" border="0px"
                                            style="background-color:#ffffff;margin: 0px;margin-top: -20px">
                                            <tr>
                                                <!--
                                        <tr style="background-color:#5a88ca;">
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-store">Store</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-order">Order Type</th>
                                            <th class="product-remove">&nbsp;</th>
                                        </tr>
-->
                                                <?php
                                                $id = $_SESSION['id'];
                                                $sql1 = "select * from cart where user_id=:id order by item_description_id";
                                                $stmt1 = $pdo->prepare($sql1);
                                                $stmt1->execute(array(
                                                    ':id' => $id
                                                ));
                                                $dup = array();
                                                if (isset($dup)) {
                                                    unset($dup);
                                                }
                                                $item_cnt = 0;
                                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                    $item_description_id = $row1['item_description_id'];
                                                    $store_id = $row1['store_id'];
                                                    $n = 0;
                                                    $sql2 = "select * from item inner join category on category.category_id=item.category_id
       inner join sub_category on category.category_id=sub_category.category_id
       inner join item_description on item_description.item_id=item.item_id
       inner join product_details on item_description.item_description_id=product_details.item_description_id
       inner join store on store.store_id=product_details.store_id
       where item.sub_category_id=sub_category.sub_category_id and item_description.item_description_id=:item_description_id and product_details.store_id=:store_id order by item_description.item_description_id LIMIT 1";
                                                    $stmt2 = $pdo->prepare($sql2);
                                                    $stmt2->execute(array(
                                                        ':item_description_id' => $item_description_id,
                                                        ':store_id' => $store_id
                                                    ));
                                                    $mrpsql = "select item.price from item inner join item_description on item_description.item_id=item.item_id where item_description.item_description_id=$item_description_id";
                                                    $mrpstmt = $pdo->query($mrpsql);
                                                    $mrprow = $mrpstmt->fetch(PDO::FETCH_ASSOC);
                                                    $t_mrp = $mrprow['price'];
                                                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                                        $sql3 = "select COUNT(item_description_id) as mulval from cart where user_id=:id and item_description_id=:item_description_id";
                                                        $stmt3 = $pdo->prepare($sql3);
                                                        $stmt3->execute(array(
                                                            ':id' => $id,
                                                            ':item_description_id' => $item_description_id
                                                        ));
                                                        $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);//02171e
                                                        $total = $row2['price'] * $row1['quantity'];
                                                        $save = ($t_mrp * $row1['quantity']) - $total;
                                                        $off = round(($save * 100) / $total);
                                                        $subcat = $row2['sub_category_name'];
                                                        ?>
                                                        <table style="width: 100%;margin-top: 0px;margin-right: -10px;"
                                                            class="tbl_s<?= $store_id . "i" . $item_description_id ?>">
                                                            <table style="font-weight: bold;width: 100%;"
                                                                class="tbl_s<?= $store_id . "i" . $item_description_id ?>">
                                                                <tr>
                                                                    <table style="padding: 0px;width: 100%;"
                                                                        class="tbl_s<?= $store_id . "i" . $item_description_id ?>">
                                                                        <tr>
                                                                            <td class="product-name" colspan="2"
                                                                                style="padding: 0px;margin-top: 5px;">
                                                                                <p
                                                                                    style="margin:0px;margin-bottom: 20px;font-size:17px;">
                                                                                <div
                                                                                    style="margin-right:10px;background-color: #02171e;padding-right:20px;padding-left:10px;width: 100%;border-radius: 2px;margin-bottom: -8px;padding-top:8px;padding-bottom:8px;text-align:justify">
                                                                                    <div style="display: flex;">
                                                                                        <a class="pd_name" href="#"
                                                                                            style="color: white;font-weight: normal;text-align:justify;"><i
                                                                                                class="fa fa-product-hunt" style=""></i>
                                                                                            <?= $row2['item_name'] ?></a>
                                                                                    </div>
                                                                                </div>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="cart_item"
                                                                            style="width: 100%; background-color: #fff">
                                                                            <td style="padding: 0px;width: 20%">
                                                                                <table style="width: 180px;margin-top: 5px;"
                                                                                    class="tbl_s<?= $store_id . "i" . $item_description_id ?>">
                                                                                    <tr>
                                                                                        <td
                                                                                            style="padding: 0px;padding-left: 10px;padding-right: 10px;">
                                                                                            <input
                                                                                                id="check_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                                class="checktobuy"
                                                                                                onclick="addorremove(this)"
                                                                                                type="checkbox" name="select_item"
                                                                                                value="s-<?= $store_id . "_i-" . $item_description_id ?>">
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="product-quantity quantity buttons_added"
                                                                                                style="justify-content: center;display: flex;text-align: center;align-items: center;position: relative;margin-right: 0px">
                                                                                                <div class="product_img"
                                                                                                    style="padding: 0px; margin-top: 7px;margin-left: 15px;">
                                                                                                    <p class="product-thumbnail"
                                                                                                        style="text-align:right;">
                                                                                                        <a
                                                                                                            href="../Product/single.php?id=<?= $row2['item_description_id'] ?>"><img
                                                                                                                style="max-width:180px;max-height:180px;"
                                                                                                                alt="<?= $row2['item_name'] ?>"
                                                                                                                class="shop_thumbnail"
                                                                                                                src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>.jpg"></a>
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                            <td class="product-img" style="padding: 0px;width: 100%">
                                                                                <table
                                                                                    class="tbl_s<?= $store_id . "i" . $item_description_id ?> item_description_td">
                                                                                    <tr>
                                                                                        <td style="float: left;text-align: left;">
                                                                                            <div class="row"
                                                                                                style="margin-left: 0px;float: left;margin-right: 0px;">
                                                                                                <div class="col-md-6 full-size-cart-store-div"
                                                                                                    style="padding: 0px;margin-left: 20px;width: 200px;">
                                                                                                    <p
                                                                                                        style="z-index: 1;text-align:left;margin-top: 35px;">
                                                                                                        <span
                                                                                                            style='font-family: arial;color:#006904;font-weight: bold;text-decoration: none;font-size: 12px'>You
                                                                                                            Save &#8377; <span
                                                                                                                id="save_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                                                style="text-decoration: none;font-weight: bold;color: #006904;padding-left: 0px"><?= $save ?></span>
                                                                                                            (<span
                                                                                                                style="text-decoration: none;font-weight: bold;color: #006904;padding-left: 0px"
                                                                                                                id="off_s<?= $store_id . "i" . $item_description_id ?>"><?= $off ?></span>%)
                                                                                                        </span>
                                                                                                    </p>
                                                                                                    <p class="product-price"
                                                                                                        style="z-index: 1;text-align:left;margin-top: 10px;;font-weight: bold;font-size: 2vw">
                                                                                                        <span
                                                                                                            class="amount">&#8377;<span
                                                                                                                id="total_s<?= $store_id . "i" . $item_description_id ?>"><?= $total ?></span>
                                                                                                            <i style="color: #303030"
                                                                                                                class="fa fa-tags">&nbsp;<del
                                                                                                                    style="color: #999;font-weight:normal;font-size: 13px;">&#8377;</del></i><del
                                                                                                                style="color: #999;font-weight:normal;font-size: 13px;"
                                                                                                                id="mrp_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                                                style="text-decoration:"><?= (int) $t_mrp * (int) $row1['quantity'] ?></del></span>
                                                                                                    </p>
                                                                                                    <p style="margin-top:10px;">
                                                                                                        <select
                                                                                                            style="outline: none;border:none;background-color:#006904;color: white;padding: 5px;border-radius: 3px;padding-top: 1px;padding-bottom: 1px; "
                                                                                                            id="order_s<?= $store_id . "i" . $item_description_id ?>">
                                                                                                            <option selected=""
                                                                                                                disabled=""
                                                                                                                style="background-color: white;font-weight: bold;text-align: center;"
                                                                                                                value="<?= $row1['order_type'] ?>">
                                                                                                                <?= ucwords($row1['order_type']) ?>
                                                                                                            </option>
                                                                                                            <?php
                                                                                                            $preordsql = $pdo->query("select order_preference from product_details where store_id=" . $store_id . " and item_description_id=" . $item_description_id);
                                                                                                            $preord = $preordsql->fetch(PDO::FETCH_ASSOC);
                                                                                                            if ($preord['order_preference'] == 1) {
                                                                                                                ?>
                                                                                                                <option
                                                                                                                    style="background-color: white;color:#006904;font-weight: bold;text-align: center; "
                                                                                                                    value="1">Booking
                                                                                                                </option>
                                                                                                                <?php
                                                                                                            } else if ($preord['order_preference'] == 2) {
                                                                                                                $ord_typ = "Delivery";
                                                                                                                ?>
                                                                                                                    <option
                                                                                                                        style="background-color: white;color:#006904;font-weight: bold;text-align: center;"
                                                                                                                        value="2">Delivery
                                                                                                                    </option>
                                                                                                                <?php
                                                                                                            } else if ($preord['order_preference'] == 3) {
                                                                                                                $ord_typ = "Delivery";
                                                                                                                ?>
                                                                                                                        <option
                                                                                                                            style="background-color: white;color:#006904;font-weight: bold;text-align: center; "
                                                                                                                            value="1">Booking
                                                                                                                        </option>
                                                                                                                        <option
                                                                                                                            style="background-color: white;color:#006904;font-weight: bold;text-align: center;"
                                                                                                                            value="2">Delivery
                                                                                                                        </option>
                                                                                                                <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                    </p>
                                                                                                </div>
                                                                                                <div class="col-md-5 full-size-cart-price-div"
                                                                                                    style="padding-right: 0px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td class="large_specs_seen">
                                                                                            <div style="margin-top: 40px;">
                                                                                                <!--FEATURES-->
                                                                                                <ul>
                                                                                                    <li><span class="a-list-item">
                                                                                                            <span
                                                                                                                class="a-size-small a-color-success sc-product-availability"><b
                                                                                                                    style="color:#86001d; ">In
                                                                                                                    stock</b></span>
                                                                                                        </span>
                                                                                                    </li>
                                                                                                    <p><img alt=""
                                                                                                            src="../../images/logo/logofill-sm.png"
                                                                                                            style="max-width:115px"
                                                                                                            data-a-hires="https://m.media-amazon.com/images/G/31/marketing/fba/fba-badge_18px-2x._CB485942108_.png">
                                                                                                    </p>
                                                                                                    <?php
                                                                                                    $sqlfeatures = "select * from product_details
inner join item_description on item_description.item_description_id=product_details.item_description_id
where item_description.item_description_id=:item_description_id and store_id=:store_id";
                                                                                                    $stmtfeatures = $pdo->prepare($sqlfeatures);
                                                                                                    $stmtfeatures->execute(array(
                                                                                                        ':item_description_id' => $item_description_id,
                                                                                                        'store_id' => $row2['store_id']
                                                                                                    ));
                                                                                                    $rowfeatures = $stmtfeatures->fetch(PDO::FETCH_ASSOC);
                                                                                                    $rowfeatures['f0'] = $rowfeatures['size'];
                                                                                                    $rowfeatures['f1'] = $rowfeatures['color'];
                                                                                                    $rowfeatures['f2'] = $rowfeatures['weight'];
                                                                                                    $rowfeatures['f3'] = $rowfeatures['flavour'];
                                                                                                    $rowfeatures['f4'] = $rowfeatures['processor'];
                                                                                                    $rowfeatures['f5'] = $rowfeatures['display'];
                                                                                                    $rowfeatures['f6'] = $rowfeatures['battery'];
                                                                                                    $rowfeatures['f7'] = $rowfeatures['internal_storage'];
                                                                                                    $rowfeatures['f8'] = $rowfeatures['brand'];
                                                                                                    $rowfeatures['f9'] = $rowfeatures['material'];
                                                                                                    $features = array('size', 'color', 'weight', 'flavour', 'processor', 'display', 'battery', 'internal_storage', 'brand', 'material', 'price', 'quantity');
                                                                                                    $f = 0;
                                                                                                    while ($f < 10) {
                                                                                                        if ($rowfeatures['f' . $f] != 0 && $rowfeatures['f' . $f] != '0') {
                                                                                                            if ($features[$f] != 'weight') {
                                                                                                                $sqlfeature_name = "select " . $features[$f] . '_name from ' . $features[$f] . ' where ' . $features[$f] . '_id=' . (int) $rowfeatures['f' . $f];
                                                                                                                $stmtfeature_name = $pdo->query($sqlfeature_name);
                                                                                                                $rowfeature_name = $stmtfeature_name->fetch(PDO::FETCH_ASSOC);
                                                                                                            }
                                                                                                            if ($features[$f] == "color") {
                                                                                                                ?>
                                                                                                                <li class="sc-product-variation">
                                                                                                                    <span class="a-list-item">
                                                                                                                        <span
                                                                                                                            class="a-size-small a-text-bold"><b><?= ucwords($features[$f]) ?>:
                                                                                                                            </b></span>
                                                                                                                        <span class="a-size-small"
                                                                                                                            style="text-decoration: none;font-weight:normal;width:10px;height:0px !important;padding-right: 7px;padding-left: 7px;border:1px solid #000;padding-top:0px;padding-bottom:0px;background-color:<?= $rowfeature_name[$features[$f] . '_name'] ?>;font-size:12px;"></span>
                                                                                                                    </span>
                                                                                                                </li>
                                                                                                                <?php
                                                                                                            } else if ($features[$f] == "weight") {
                                                                                                                ?>
                                                                                                                    <li class="sc-product-variation">
                                                                                                                        <span class="a-list-item">
                                                                                                                            <span
                                                                                                                                class="a-size-small a-text-bold"><b><?= ucwords($features[$f]) ?>:
                                                                                                                                </b></span>
                                                                                                                            <span class="a-size-small"
                                                                                                                                style="text-decoration: none;font-weight:normal;padding: 0px;"><?= $rowfeatures['f2'] ?></span>
                                                                                                                        </span>
                                                                                                                    </li>
                                                                                                                <?php
                                                                                                            } else {
                                                                                                                ?>
                                                                                                                    <li class="sc-product-variation">
                                                                                                                        <span class="a-list-item">
                                                                                                                            <span
                                                                                                                                class="a-size-small a-text-bold"><b><?= ucwords($features[$f]) ?>:
                                                                                                                                </b></span>
                                                                                                                            <span
                                                                                                                                class="a-size-small"><?= $rowfeature_name[$features[$f] . '_name'] ?></span>
                                                                                                                        </span>
                                                                                                                    </li>
                                                                                                                <?php
                                                                                                            }
                                                                                                        }
                                                                                                        $f++;
                                                                                                    }
                                                                                                    if (strlen($row2['description']) >= 50) {
                                                                                                        $description = substr($row2['description'], 0, 45);
                                                                                                        $description2 = $description . "...";
                                                                                                    } else {
                                                                                                        $description2 = $row2['description'];
                                                                                                    }
                                                                                                    ?>
                                                                                                    <li class="sc-product-variation">
                                                                                                        <span class="a-list-item">
                                                                                                            <small><span
                                                                                                                    class="a-size-small a-text-bold"><b>Description:
                                                                                                                    </b></span>
                                                                                                                <span
                                                                                                                    class="a-size-small"><?= $description2 ?></span></small>
                                                                                                        </span>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="width: 100%">
                                                                            <table width="100%"
                                                                                class="tbl_s<?= $store_id . "i" . $item_description_id ?>">
                                                                                <tr class="product-quantity quantity buttons_added"
                                                                                    style="margin-right: 0px;width: 100%">
                                                                                    <td>
                                                                                        <p class="product-subtotal"
                                                                                            style="bottom: 0px;margin-left: 15px;float: left;font-weight: bold;">
                                                                                            Price
                                                                                            <span class="amount">&#8377;<span
                                                                                                    id="price_s<?= $store_id . "i" . $item_description_id ?>"><?= $row2['price'] ?></span><span>/-</span>
                                                                                                (1 Qty) |</span>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p><a id="update_item"
                                                                                                style="font-weight: bold;float: left;margin-top: -10px;"
                                                                                                onclick="updateitem(<?= $item_description_id . ',' . $store_id ?>)"
                                                                                                value="Update Cart"
                                                                                                name="update_cart">&nbsp;Update&nbsp;</a>
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="product-store"><span>|</span><i
                                                                                                style="color: #303030;bottom: 0px;margin-top: 2px;margin-left: 5px;"
                                                                                                class="fas fa-store">&nbsp;</i>
                                                                                            <a title="<?= $row2['store_name'] ?>"
                                                                                                href="#"><?= $row2['store_name'] ?></a>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </tr>
                                                                        <tr>
                                                                            <table width="100%"
                                                                                class="tbl_s<?= $store_id . "i" . $item_description_id ?>">
                                                                                <tr class="shadow_b">
                                                                                    <td style="padding: 0px;width: 10%">
                                                                                        <div class="div-wrapper"
                                                                                            style="text-align: left;padding: 0px;margin:0px;height: 40px;grid-gap: 0px;">
                                                                                            <!--------------------------------------------------------------------------------------------------------------------------------------------------------->
                                                                            <div class="btn_sub_q"
                                                                                style="padding: 0px;margin: 0px;margin-left: 2px;">
                                                                                <button
                                                                                    style="background-color: #02171e;-webkit-box-shadow: inset 0px 0px 15px 3px #02171e;box-shadow: inset 0px 0px 15px 3px #02171e;width: 100%;min-width: 30px;height: 40px;font-weight: bold;border-color: #02171e;color: white;font-size: 18px;border-radius: 5px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                                                                    type="button"
                                                                                    id="sub_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    onclick="sub_item_all('<?= $store_id ?>','<?= $item_description_id ?>','<?= $t_mrp ?>')">-</button>
                                                                            </div>
                                                                            <div style="padding: 0px;margin: 0px;">
                                                                                <button
                                                                                    id="btn_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    type="button"
                                                                                    style="width: 100%;min-width: 50px;height: 40px;font-weight: bold;font-size: 14px;background-color: white;outline: none;border-color:#02171e;padding: 0"
                                                                                    onclick="$(this).hide();if($(this).html()<10){$('#sel_s<?= $store_id . "i" . $item_description_id ?>').show();}else{$('#qnty_s<?= $store_id . "i" . $item_description_id ?>').show();}">
                                                                                    <?= $row1['quantity'] ?>
                                                                                </button>
                                                                                <select
                                                                                    id="sel_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    onchange="select_item_option('<?= $store_id ?>','<?= $item_description_id ?>','<?= $t_mrp ?>');"
                                                                                    name="quantity" autocomplete="off"
                                                                                    style="width: 100%;min-width: 50px;bottom: 0;box-shadow: none;outline: none;border-color:#aaa;height:40px;display: none;background-color: white">
                                                                                    <option
                                                                                        value="<?= $row1['quantity'] ?>"
                                                                                        id="sel_opt_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                        selected disabled>
                                                                                        <?= $row1['quantity'] ?>
                                                                                    </option>
                                                                                    <option value="0"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="0 (Delete)">
                                                                                        0 (Delete)</option>
                                                                                    <option value="1"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="1">1
                                                                                    </option>
                                                                                    <option value="2"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="2">2
                                                                                    </option>
                                                                                    <option value="3"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="3">3
                                                                                    </option>
                                                                                    <option value="4"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="4">4
                                                                                    </option>
                                                                                    <option value="5"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="5">5
                                                                                    </option>
                                                                                    <option value="6"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="6">6
                                                                                    </option>
                                                                                    <option value="7"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="7">7
                                                                                    </option>
                                                                                    <option value="8"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="8">8
                                                                                    </option>
                                                                                    <option value="9"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option"
                                                                                        data-a-html-content="9">9
                                                                                    </option>
                                                                                    <option value="10"
                                                                                        class="sc-update-quantity-option"
                                                                                        data-a-css-class="quantity-option quantity-option-10"
                                                                                        data-a-html-content="10+">10+
                                                                                    </option>
                                                                                </select>
                                                                                <input type="number"
                                                                                    id="qnty_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    size="4"
                                                                                    onchange="total('<?= $store_id ?>','<?= $item_description_id ?>','<?= $t_mrp ?>')"
                                                                                    onblur="$(this).hide();$('#sel_s<?= $store_id . "i" . $item_description_id ?>').hide();$('#btn_s<?= $store_id . "i" . $item_description_id ?>').show()"
                                                                                    style="text-align: center;display: none;height: 40px;width: 100%;min-width: 50px;outline: none;font-weight: bold"
                                                                                    class="input-text qty text"
                                                                                    title="Quantity"
                                                                                    value="<?= $row1['quantity'] ?>"
                                                                                    min="1" step="1"
                                                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                                                                            </div>
                                                                            <div class="btn_add_q"
                                                                                style="padding: 0px;margin: 0px;">
                                                                                <button
                                                                                    style="background-color: #02171e;-webkit-box-shadow: inset 0px 0px 15px 3px #02171e;box-shadow: inset 0px 0px 15px 3px #02171e;width: 100%;min-width: 30px;height: 40px;font-weight: bold;border-color: #02171e;color: white;font-size: 18px;border-radius: 5px;border-top-left-radius: 0px;border-bottom-left-radius: 0px;"
                                                                                    id="add_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    onclick="add_item_all('<?= $store_id ?>','<?= $item_description_id ?>','<?= $t_mrp ?>')"
                                                                                    type="button">+</button>
                                                                            </div>
                                                                        </div>
                                                                        <!--------------------------------------------------------------------------------------------------------------------------------------------------------->
                                                                    </td>
                                                                    <td style="padding: 0px;width: 45%">
                                                                        <button type="button" title="Add to wish list"
                                                                            style="width: 100%;height: 40px;background-color: #f6f6f6;border: 0px solid #999;outline: none;font-weight: bold;-webkit-box-shadow: inset -1px 1px 15px 3px #bbb;box-shadow: inset -1px 1px 15px 3px #ccc;"
                                                                            data-toggle="modal"
                                                                            data-target="#avail_wishlist"
                                                                            onclick="wishlist_check_store_select(<?= $item_description_id ?>,<?= $store_id ?>)">
                                                                            Wishlist <i style="color: red"
                                                                                class="fa fa-heart"></i></button>
                                                                    </td>
                                                                    <td class="product-remove"
                                                                        style="padding: 0px;width: 45%;">
                                                                        <button type="button" title="Remove this item"
                                                                            style="width: 100%;height: 40px;border:none;border-color: #fff;color: #fff;background-color: #c50505;outline: none;-webkit-box-shadow: inset -1px 1px 15px 3px #76001d;box-shadow: inset -1px 1px 15px 3px #86001d;"
                                                                            class="remove"
                                                                            onclick="remove_item('<?= $store_id ?>','<?= $item_description_id ?>')"
                                                                            href="#"><b>Remove </b><i
                                                                                class="fas fa-trash-alt"></i></button>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </tr>
                                                    </table>
                                                </tr>
                                            </table>
                                        </table>
                                        <?php
                                        $item_cnt++;
                                                    } ?>
                                    </tr>
                                </table>
                                <?php
                                                }
                                                ?>
                                <hr class="make_divc" style="margin-top: 40px;">
                                <?php
                                $id = $_SESSION['id'];
                                $sql = "select sum(product_details.price*cart.quantity) as subtotal from cart
inner join item_description on item_description.item_description_id=cart.item_description_id
inner join product_details on product_details.item_description_id=cart.item_description_id
WHERE item_description.item_description_id=cart.item_description_id AND cart.store_id=product_details.store_id and cart.user_id=:id";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(array(
                                    ':id' => $id
                                ));
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="cart-collaterals" style="margin:0px;padding: 0px">
                                    <div class="cart_totals shadow_all_none"
                                        style="width: 100%;margin:0px;padding: 0px;padding-top: 0px;">
                                        <div class="row">
                                            <div class="col-md-6" style="float:right;">
                                                <h4
                                                    style="padding-right: 10px;text-transform: capitalize;color:#000;float: right;">
                                                    Subtotals(<span id="total_rm_cnt">
                                                        <?= $item_cnt ?>
                                                    </span> item) <small style="font-weight: bolder;">&#8377;</small><b
                                                        id="tot_val2">
                                                        <?= $row['subtotal'] ?>
                                                    </b></h4>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="div-wrapper"
                                                        style="padding-left: 15px;padding-right: 15px;grid-gap: 0px;padding-top: 20px;">
                                                        <div style="padding: 10px;">
                                                            <button type="button"
                                                                style="width: 100%;padding-top:8px;padding-bottom: 8px;border-radius: 2px;font-weight: bold;float: left; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;"
                                                                onclick="updatecart()" name="update_cart"
                                                                class="btn-primary btn button"><i
                                                                    class="fas fa-upload fa-lg"></i> UPDATE
                                                                CART</button>
                                                        </div>
                                                        <div style="padding: 10px;">
                                                            <button type="button"
                                                                style="width: 100%;padding-top:8px;padding-bottom: 8px;border-radius: 2px;font-weight: bold;float: right;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #ff6f00), color-stop(1, hsl(21, 100%, 50%))) !important;"
                                                                onclick="go()" name="proceed"
                                                                class="checkout-button btn btn-primary button alt wc-forward"><i
                                                                    class="fa fa-check-square-o fa-lg"></i>
                                                                CHECKOUT</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--
                        <table cellspacing="0">
                            <tbody>
                                <tr class="cart-subtotal" style="background-color: #f2f3f4">
                                    <th style="background-color: #fff">Cart Subtotal</th>
                                        <td><span class="amount tot_val" id="tot_val1" style="background-color: #f2f3f4">&#8377;<?//=$row['subtotal'] ?></span></td>
                                </tr>
                                <tr class="order-total tot_val">
                                    <th style="background-color: #fff">Order Subtotal</th>
                                    <td><strong><span class="amount tot_val" id="tot_val2">&#8377;<?//=$row['subtotal'] ?></span></strong> </td>
                                </tr>
                            </tbody>
                        </table>
-->
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <!--LARGE-->
                        <style>
                            #collapse2 ul li.active>a,
                            a[aria-expanded="true"] {
                                text-decoration: none;
                                border-left: none;
                            }

                            .price {
                                position: absolute;
                                top: 0;
                                right: 0;
                                border-radius: 5px;
                                border: none;
                                height: 20px;
                                background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #d88d06), color-stop(1, #ffcf78)) !important;
                                color: #040404;
                            }

                            .panel-heading {
                                height: 50px;
                                padding: 15px;
                                color: white;
                                background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00c0ef), color-stop(1, #01728e)) !important;
                            }

                            .vwbt {
                                float: right;
                                border-radius: 5px;
                                border: none;
                                height: 30px;
                                background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00d01a), color-stop(1, #00bf4d)) !important;
                                color: white;
                            }

                            li.list-group-itemb:nth-child(odd) {
                                background: #f9f9f9;
                            }

                            li.list-group-itemb {
                                border: none;
                            }

                            img.smimg {
                                height: auto;
                                max-width: 70px;
                                max-height: 70px;
                                width: auto;
                            }
                        </style>
                        <?php
                        $stmt = $pdo->query("select item.item_name,item.category_id,item.sub_category_id,item_description.item_description_id,product_details.price from item
    join item_description on item_description.item_id=item.item_id
    join product_details on item_description.item_description_id=product_details.item_description_id where (added_date) in
    (select max(added_date) as date from item) group by item_description.item_description_id ORDER BY CAST(item.item_id AS UNSIGNED) DESC LIMIT 5");
                        $checkthis = $stmt->rowCount();
                        if ($checkthis != 0) {
                            ?>
                            <div class="panel-group col-md-3" id="large_screen"
                                style=" margin-left: 0px;background-color: #fff;border-radius: 3px;padding:0;">
                                <div class="panel panel-default">
                                    <a data-toggle="collapse" href="#collapse2">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                Recently Added Products
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapse2" class="panel-collapse collapse in">
                                        <ul class="list-group" style="list-style: none;">
                                            <?php
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <li class="list-group-itemb" style="display: flex;padding:5px;"
                                                    onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
                                                    <div style="width:70px">
                                                        <img class="smimg"
                                                            src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                                                    </div>
                                                    <div style="position: relative;float:left;width:100%;padding:20px">
                                                        <?= $row['item_name'] ?>
                                                        <button class="price"><i class="fas fa-rupee-sign"></i>
                                                            <?= $row['price'] ?></button>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <li class="list-group-itemb"
                                                style="padding:10px;height:50px;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #00c0ef), color-stop(1, #01728e)) !important;">
                                                <a href="../Product/allitems.php"><button class="vwbt"
                                                        onmouseover="$(this).css('color','#00c0ef')"
                                                        style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;"
                                                        onmouseout="$(this).css('color','#fff')">View All</button></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="panel-group col-md-3" id="large_screen"
                            style=" margin-left: 0px;background-color: #fff;border-radius: 3px;padding:0;">
                            <div class="panel panel-default">
                                <a data-toggle="collapse" href="#collapse2">
                                    <div class="panel-heading"
                                        style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #d606ff), color-stop(1, hsl(283, 99%, 34%))) !important;">
                                        <h4 class="panel-title">
                                            Popular Products
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapse2" class="panel-collapse collapse in">
                                    <ul class="list-group" style="list-style: none;">
                                        <?php
                                        $viewstmt = $pdo->query("select distinct(item_keys.item_description_id) from item_keys GROUP BY item_description_id order by CAST(sum(item_keys.views) as UNSIGNED) DESC LIMIT 4");
                                        $checkthis = $viewstmt->rowCount();
                                        if ($checkthis != 0) {
                                            while ($view = $viewstmt->fetch(PDO::FETCH_ASSOC)) {
                                                $item_desc_id = $view['item_description_id'];
                                                $ran = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                                                $row = $ran->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <li class="list-group-itemb" style="display: flex;padding:5px;"
                                                    onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
                                                    <div style="width:70px">
                                                        <img class="smimg"
                                                            src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                                                    </div>
                                                    <div style="position: relative;float:left;width:100%;padding:20px">
                                                        <?= $row['item_name'] ?>
                                                        <button class="price"><i class="fas fa-rupee-sign"></i>
                                                            <?= $row['price'] ?></button>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <li class="list-group-itemb"
                                            style="padding:10px;height:50px;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #d606ff), color-stop(1, hsl(283, 99%, 34%))) !important;">
                                            <a href="../Product/diff_views.php?popular=1"><button class="vwbt"
                                                    onmouseover="$(this).css('color','#f606ff')"
                                                    style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #410041), color-stop(1, #4f0063)) !important;"
                                                    onmouseout="$(this).css('color','#fff')">View All</button></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--LARGE-->
                    </div>
                    <!--SMALL-->
                    <div class="row" style="margin:0px;padding: 0px">
                        <div class="col-md-9" style="margin:0px;padding: 0px">
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="col-md-4 small" id="small_screen" style="margin:0px;padding: 0px"></div>
                    <?php
                    } else {
                        /*COLOR PICKER*/
                        $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
                        $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
                        $c1 = $c2 = 'white';
                        do {
                            $rancolor1 = array_rand($color, 1);
                            $rancolor2 = array_rand($color, 1);
                        }
                        while ($rancolor1 == $rancolor2);
                        if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
                            $c1 = "black";
                        }
                        if ($bgcolor[$rancolor2] == "cyan" || $bgcolor[$rancolor2] == "#FF6666" || $bgcolor[$rancolor2] == "#E6BF00") {
                            $c2 = "black";
                        }
                        /*COLOR PICKER*/
                        $cntsql = "select count(sub_category_id) as sub_cnt from sub_category";
                        $cntstmt = $pdo->query($cntsql);
                        $cntrow = $cntstmt->fetch(PDO::FETCH_ASSOC);
                        $sub_cnt = $cntrow['sub_cnt'];
                        do {
                            $rand_sub_id1 = randomGen('1', $sub_cnt, (int) $sub_cnt);
                            $rand_sub_id1_rand1 = array_rand($rand_sub_id1, 1);
                            $rand_sub_id1 = $rand_sub_id1[$rand_sub_id1_rand1];
                            $rand_sub_id2 = randomGen('1', $sub_cnt, (int) $sub_cnt);
                            $rand_sub_id2_rand2 = array_rand($rand_sub_id2, 1);
                            $rand_sub_id2 = $rand_sub_id2[$rand_sub_id2_rand2];
                        }
                        while ($rand_sub_id1 == $rand_sub_id2);
                        $catsql1 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id1;
                        $catstmt1 = $pdo->query($catsql1);
                        $sub_catrow1 = $catstmt1->fetch(PDO::FETCH_ASSOC);
                        $catsql2 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id2;
                        $catstmt2 = $pdo->query($catsql2);
                        $sub_catrow2 = $catstmt2->fetch(PDO::FETCH_ASSOC);
                        $cat_id1 = $sub_catrow1['category_id'];
                        $sub_cat_id1 = $sub_catrow1['sub_category_id'];
                        $sub_cat_name1 = $sub_catrow1['sub_category_name'];
                        $cat_id2 = $sub_catrow2['category_id'];
                        $sub_cat_id2 = $sub_catrow2['sub_category_id'];
                        $sub_cat_name2 = $sub_catrow2['sub_category_name'];
                        ?>
                    <div class="row emp_cart">
                        <div class="product-content-right">
                            <center><img style="justify-content: center;" class="sidebar-title"
                                    src="../../images/logo/cart-empty.png">
                                <h2 class="sidebar-title"
                                    style="text-align: center;display: inline-flex;font-weight: 600;color: #005549">Your Cart is
                                    Empty</h2>
                            </center>
                        </div>
                    </div><br><br>
                    <div class="element_grid">
                        <div class="shadow_b">
                            <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
                                style="border-left: 5px solid <?= $bgcolor[$rancolor1] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
                                <?= $sub_cat_name1 ?> <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
                                <span style="float: right;margin-right: 5px;margin-top: -4px;">
                                    <button type="button"
                                        style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor1] ?>;padding: 11px auto;font-size: 12px;"
                                        name="proceed" class="checkout-button button alt wc-forward"><a
                                            href="../Product/products_viewall.php?category_id=<?= $cat_id1 ?>&subcategory_id=<?= $sub_cat_id1 ?>"
                                            style="color:<?= $c1 ?>;">View all</a></button>
                                </span>
                            </h4>
                            <hr style="padding: 0;margin:0;">
                            <div class="scrollmenu bl_item_scroll  <?= $color[$rancolor1] ?>" style="background-color: #fff">
                                <?php
                                $row = $pdo->query("select item_description.item_description_id,item.item_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id1 and sub_category.sub_category_id=$sub_cat_id1 and item.sub_category_id=$sub_cat_id1 ");
                                while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                                            title="<?= $row1['item_name'] ?> " alt=" <?= $row1['item_name'] ?>" class="new_size"
                                            src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="shadow_b">
                            <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
                                style="border-left: 5px solid <?= $bgcolor[$rancolor2] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
                                <?= $sub_cat_name2 ?> <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
                                <span style="float: right;margin-right: 5px;margin-top: -4px;">
                                    <button type="button"
                                        style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor2] ?>;padding: 11px auto;font-size: 12px;"
                                        name="proceed" class="checkout-button button alt wc-forward"><a
                                            href="../Product/products_viewall.php?category_id=<?= $cat_id2 ?>&subcategory_id=<?= $sub_cat_id2 ?>"
                                            style="color:<?= $c2 ?>;">View all</a></button>
                                </span>
                            </h4>
                            <hr style="padding: 0;margin:0;">
                            <div class="scrollmenu mui_item_scroll <?= $color[$rancolor2] ?> " style="background-color: #fff">
                                <?php
                                $row = $pdo->query("select item_description.item_description_id,item.item_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id2 and sub_category.sub_category_id=$sub_cat_id2 and item.sub_category_id=$sub_cat_id2");
                                while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                                            title="<?= $row1['item_name'] ?> " alt=" <?= $row1['item_name'] ?>" class="new_size"
                                            src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 small" id="small_screen"></div>
                    <?php
                    /*COLOR PICKER*/
                    $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
                    $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
                    $c1 = $c2 = 'white';
                    do {
                        $rancolor1 = array_rand($color, 1);
                        $rancolor2 = array_rand($color, 1);
                    }
                    while ($rancolor1 == $rancolor2);
                    if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
                        $c1 = "black";
                    }
                    if ($bgcolor[$rancolor2] == "cyan" || $bgcolor[$rancolor2] == "#FF6666" || $bgcolor[$rancolor2] == "#E6BF00") {
                        $c2 = "black";
                    }
                    /*COLOR PICKER*/
                    ?>
                    <style type="text/css">
                        .difcat {
                            position: relative;
                            height: max-content;
                            margin: auto;
                            margin-top: 10px;
                            display: block;
                            background: #FFFFFF;
                            box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);
                        }

                        .difrow {
                            height: max-content;
                            overflow: auto;
                            width: 76vw;
                            margin: auto;
                            display: block;
                            white-space: nowrap;
                            bottom: 0;
                            width: 100%;
                        }

                        .products-all-in-one {
                            display: inline-block;
                            text-align: center;
                            padding: 14px;
                            padding-bottom: 0px;
                            position: relative;
                            height: 250px;
                            width: 200px;
                            background: white;
                            color: #000;
                        }

                        .products-all-in-one img {
                            margin: auto;
                            display: block;
                            background: white;
                            image-rendering: auto;
                            image-rendering: crisp-edges;
                            width: auto;
                            max-width: 170px;
                            height: auto;
                            max-height: 180px;
                        }

                        .difhed {
                            border-bottom: 3px solid #dadada;
                            width: 100%;
                            margin: 0;
                            font-size: 20px;
                            font-family: serif;
                            font-weight: bold;
                            text-transform: capitalize;
                            padding-bottom: 0px;
                            padding-top: 20px;
                            margin-left: 20px;
                        }

                        .left-arrow-btn-all {
                            position: absolute;
                            top: 30%;
                            left: 0;
                            width: 30px;
                            z-index: 1;
                            height: 100px;
                            font-size: 24px;
                            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #fff)) !important;
                            color: rgb(114, 114, 114);
                            border: none;
                            border-bottom-right-radius: 4px;
                            border-top-right-radius: 4px;
                            border-top-left-radius: 6px;
                            border-bottom-left-radius: 6px;
                        }

                        .right-arrow-btn-all {
                            position: absolute;
                            top: 30%;
                            right: 0;
                            width: 30px;
                            z-index: 1;
                            height: 100px;
                            font-size: 24px;
                            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #fff)) !important;
                            color: rgb(114, 114, 114);
                            border: none;
                            border-bottom-right-radius: 6px;
                            border-top-right-radius: 6px;
                            border-top-left-radius: 4px;
                            border-bottom-left-radius: 4px;
                        }

                        .difrow::-webkit-scrollbar {
                            width: 100%;
                            height: 4px;
                        }

                        .difrow::-webkit-scrollbar-thumb {
                            border-radius: 0px;
                            -webkit-box-shadow: inset 0 0 6px transparent;
                            box-shadow: inset 0 0 6px transparent;
                        }

                        .table1 {
                            margin-bottom: 0px;
                            max-height: max-content;
                            height: 60px;
                        }

                        .difhed button {
                            float: right;
                            font-weight: bold;
                            font-size: 16px;
                            margin-right: 5px;
                            margin-top: 5px;
                            padding: 2px;
                            width: 100px;
                            background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #3197ff), color-stop(1, #2196f3)) !important;
                            font-family: Verdana, Geneva, Tahoma, sans-serif;
                            border: none;
                            color: white;
                            border-radius: 5px;
                        }
                    </style>
                    <script type="text/javascript">
                        function scrolllisten(x) {
                            var y = Math.round($('#' + x).scrollLeft());
                            var width = $('#' + x).outerWidth();
                            var scrollWidth = $('#' + x)[0].scrollWidth;
                            var sub = Math.round(parseInt(scrollWidth) - parseInt(width));
                            console.log(width + " scrollwidth= " + scrollWidth + " scrollwidth - width = " + sub + " y= " + y);
                            if (sub == y) {
                                $('#' + x + '>.right-arrow-btn-all').hide();
                                return;
                            }
                            $('#' + x + '>.left-arrow-btn-all').show();
                            if (y === 0) {
                                $('#' + x + '>.left-arrow-btn-all').hide();
                            }
                            $('#' + x + '>.right-arrow-btn-all').show();
                        }
                        function moveright(x) {
                            var y = $('#' + x).scrollLeft();
                            var width = $('#' + x).outerWidth();
                            var scrollWidth = $('#' + x)[0].scrollWidth;
                            $('#' + x).scrollLeft(y + 250);
                        }
                        function moveleft(x) {
                            var y = $('#' + x).scrollLeft();
                            $('#' + x).scrollLeft(y - 250);
                        }
                    </script>
                    <?php
                    $viewstmt = $pdo->query("select views ,item_keys.item_description_id,sub_category.sub_category_id from item_keys
JOIN item_description ON item_keys.item_description_id=item_description.item_description_id
join item on item.item_id=item_description.item_id
join product_details on item_description.item_description_id=product_details.item_description_id
join sub_category on item.sub_category_id=sub_category.sub_category_id
where user_id=" . $_SESSION['id'] . " GROUP BY item_description_id ORDER BY CAST(item_keys.views as UNSIGNED) DESC");
                    $isready = $viewstmt->rowCount();
                    if ($isready != 0 && is_null($isready) == false) {
                        ?>
                        <!-- new -->
                        <div class="container" style="width: 100%;background-color: #fff;margin-top: 15px;">
                            <div class="row">
                                <div class="col-md-12" style="padding:0;">
                                    <div class="cart-collaterals">
                                        <div class="cart_totals " style="width: 100%">
                                            <h2 style="padding-left:15px;padding-right:15px;">You may be interested in...</h2>
                                            <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
                                                style="border-left: 5px solid <?= $bgcolor[$rancolor1] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
                                                Explore <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
                                                <span style="float: right;margin-right: 5px;margin-top: -4px;">
                                                    <button type="button"
                                                        style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor1] ?>;padding: 11px auto;font-size: 12px;"
                                                        name="proceed" class="checkout-button button alt wc-forward"><a
                                                            href="../Product/products_viewall.php?category_id=<?= $cat_id1 ?>&subcategory_id=<?= $sub_cat_id1 ?>"
                                                            style="color:<?= $c2 ?>;">View all</a></button>
                                                </span>
                                            </h4>
                                            <div class="difcat " style="border-radius: 5px;">
                                                <span class="difhed">
                                                </span>
                                                <div class="difrow hidescroll" id="difrow" onscroll="scrolllisten('difrow');">
                                                    <button class="left-arrow-btn-all shadow_all_none" onclick="moveleft('difrow')"
                                                        style="display: none;"><i class="fas fa-chevron-left"></i></button>
                                                    <button class="right-arrow-btn-all shadow_all_none"
                                                        onclick="moveright('difrow')"><i class="fas fa-chevron-right"></i></button>
                                                    <?php
                                                    while ($view = $viewstmt->fetch(PDO::FETCH_ASSOC)) {
                                                        $item_desc_id = $view['item_description_id'];
                                                        $ran = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    INNER JOIN product_details ON product_details.item_description_id=item_description.item_description_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                                                        $row = $ran->fetch(PDO::FETCH_ASSOC);
                                                        $subcat_id = $view['sub_category_id'];
                                                        ?>
                                                        <div class="products-all-in-one" title="<?= $row['item_name'] ?>"
                                                            onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
                                                            <div
                                                                style="display: flex;justify-content: center;height: 200px;width:100%;background: white;text-align: center;">
                                                                <img class="image" align="middle"
                                                                    src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                                                            </div>
                                                            <?php
                                                            if (strlen($row['item_name']) >= 22) {
                                                                $item = $row['item_name'];
                                                                $item_name = substr($item, 0, 25) . "...";
                                                            } else {
                                                                $item_name = $row['item_name'];
                                                            }
                                                            ?>
                                                            <div class="deupd"><?= $item_name ?><br>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    echo '</div></div>';
                                                    ?>
                                                    <div class="clearfix"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- //new -->
                                <?php
                    }
                    ?>
                            <!-- new -->
                            <div class="newproducts-w3agile" style="padding:0;padding-top:10px;">
                                <h3>Recently Viewed</h3>
                                <?php
                                $ran = $pdo->query("select views ,item_keys.item_description_id,sub_category.sub_category_id from item_keys
JOIN item_description ON item_keys.item_description_id=item_description.item_description_id
join item on item.item_id=item_description.item_id
join sub_category on item.sub_category_id=sub_category.sub_category_id
where user_id=" . $_SESSION['id'] . " GROUP BY item_description_id ORDER BY CAST(item_keys.date_of_preview as UNSIGNED) DESC");
                                $isready = $ran->rowCount();
                                if ($isready != 0 && is_null($isready) == false) {
                                    ?>
                                    <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
                                        style="border-left: 5px solid <?= $bgcolor[$rancolor2] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
                                        Explore <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
                                        <span style="float: right;margin-right: 5px;margin-top: -4px;">
                                            <button type="button"
                                                style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor2] ?>;padding: 11px auto;font-size: 12px;"
                                                name="proceed" class="checkout-button button alt wc-forward"><a
                                                    href="../Product/products_viewall.php?category_id=<?= $cat_id2 ?>&subcategory_id=<?= $sub_cat_id2 ?>"
                                                    style="color:<?= $c2 ?>;">View all</a></button>
                                        </span>
                                    </h4>
                                    <div class="difcat " style="border-radius: 5px;">
                                        <span class="difhed">
                                        </span>
                                        <div class="difrow hidescroll" id="difrow<?= $row['item_description_id'] ?>"
                                            onscroll="scrolllisten('difrow<?= $row['item_description_id'] ?>');">
                                            <button class="left-arrow-btn-all shadow_all_none"
                                                onclick="moveleft('difrow<?= $row['item_description_id'] ?>')"
                                                style="display: none;"><i class="fas fa-chevron-left"></i></button>
                                            <button class="right-arrow-btn-all shadow_all_none"
                                                onclick="moveright('difrow<?= $row['item_description_id'] ?>')"><i
                                                    class="fas fa-chevron-right"></i></button>
                                            <?php
                                            while ($view = $ran->fetch(PDO::FETCH_ASSOC)) {
                                                $item_desc_id = $view['item_description_id'];
                                                $preview = $pdo->query('select * from item_description
    inner join item on item.item_id=item_description.item_id
    where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
                                                $row = $preview->fetch(PDO::FETCH_ASSOC);
                                                $subcat_id = $view['sub_category_id'];
                                                ?>
                                                <div class="products-all-in-one" title="<?= $row['item_name'] ?>"
                                                    onclick="location.href='../Product/single.php?id=<?= $row['item_description_id'] ?>'">
                                                    <div
                                                        style="display: flex;justify-content: center;height: 200px;width:100%;background: white;text-align: center;">
                                                        <img class="image" align="middle"
                                                            src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg">
                                                    </div>
                                                    <?php
                                                    if (strlen($row['item_name']) >= 22) {
                                                        $item = $row['item_name'];
                                                        $item_name = substr($item, 0, 25) . "...";
                                                    } else {
                                                        $item_name = $row['item_name'];
                                                    }
                                                    ?>
                                                    <div class="deupd"><?= $item_name ?><br>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            echo '</div></div>';
                                }
                                ?>
                                        <div class="clearfix"> </div>
                                    </div>
                                    <?php
                    }
                } else {
                    /*COLOR PICKER*/
                    $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
                    $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
                    $c1 = $c2 = 'white';
                    do {
                        $rancolor1 = array_rand($color, 1);
                        $rancolor2 = array_rand($color, 1);
                    }
                    while ($rancolor1 == $rancolor2);
                    if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
                        $c1 = "black";
                    } else if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
                        $c2 = "black";
                    }
                    /*COLOR PICKER*/
                    $cntsql = "select count(sub_category_id) as sub_cnt from sub_category";
                    $cntstmt = $pdo->query($cntsql);
                    $cntrow = $cntstmt->fetch(PDO::FETCH_ASSOC);
                    $sub_cnt = $cntrow['sub_cnt'];
                    do {
                        $rand_sub_id1 = randomGen('1', $sub_cnt, (int) $sub_cnt);
                        $rand_sub_id1_rand1 = array_rand($rand_sub_id1, 1);
                        $rand_sub_id1 = $rand_sub_id1[$rand_sub_id1_rand1];
                        $rand_sub_id2 = randomGen('1', $sub_cnt, (int) $sub_cnt);
                        $rand_sub_id2_rand2 = array_rand($rand_sub_id2, 1);
                        $rand_sub_id2 = $rand_sub_id2[$rand_sub_id2_rand2];
                    }
                    while ($rand_sub_id1 == $rand_sub_id2);
                    $catsql1 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id1;
                    $catstmt1 = $pdo->query($catsql1);
                    $sub_catrow1 = $catstmt1->fetch(PDO::FETCH_ASSOC);
                    $catsql2 = "select* from sub_category where sub_category_id=" . (int) $rand_sub_id2;
                    $catstmt2 = $pdo->query($catsql2);
                    $sub_catrow2 = $catstmt2->fetch(PDO::FETCH_ASSOC);
                    $cat_id1 = $sub_catrow1['category_id'];
                    $sub_cat_id1 = $sub_catrow1['sub_category_id'];
                    $sub_cat_name1 = $sub_catrow1['sub_category_name'];
                    $cat_id2 = $sub_catrow2['category_id'];
                    $sub_cat_id2 = $sub_catrow2['sub_category_id'];
                    $sub_cat_name2 = $sub_catrow2['sub_category_name'];
                    ?>
                                <div class="row emp_cart" style="background-color: #fff;margin:0;">
                                    <div class="product-content-right">
                                        <center><img style="justify-content: center;" class="sidebar-title"
                                                src="../../images/logo/cart-empty.png">
                                            <h2 class="sidebar-title"
                                                style="text-align: center;display: inline-flex;font-weight: 600;">Your Cart
                                                is Empty</h2>
                                        </center>
                                    </div>
                                    <div class="element_grid">
                                        <div class="shadow_b">
                                            <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
                                                style="border-left: 5px solid <?= $bgcolor[$rancolor1] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
                                                <?= $sub_cat_name1 ?> <i style="color: #ff5722;"
                                                    class="fa fa-arrow-right"></i>
                                                <span style="float: right;margin-right: 5px;margin-top: -4px;">
                                                    <button type="button"
                                                        style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor1] ?>;padding: 11px auto;font-size: 12px;"
                                                        name="proceed" class="checkout-button button alt wc-forward"><a
                                                            href="../Product/products_viewall.php?category_id=<?= $cat_id1 ?>&subcategory_id=<?= $sub_cat_id1 ?>"
                                                            style="color:<?= $c1 ?>;">View all</a></button>
                                                </span>
                                            </h4>
                                            <div class="scrollmenu mui_item_scroll <?= $color[$rancolor1] ?>"
                                                style="background-color: #fff">
                                                <?php
                                                $row = $pdo->query("select item_description.item_description_id,item.item_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id1 and sub_category.sub_category_id=$sub_cat_id1 and item.sub_category_id=$sub_cat_id1 ");
                                                while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                                                            title=" " alt=" " class="new_size"
                                                            src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"></a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="shadow_b">
                                            <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
                                                style="border-left: 5px solid <?= $bgcolor[$rancolor2] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
                                                <?= $sub_cat_name2 ?> <i style="color: #ff5722;"
                                                    class="fa fa-arrow-right"></i>
                                                <span style="float: right;margin-right: 5px;margin-top: -4px;">
                                                    <button type="button"
                                                        style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor2] ?>;padding: 11px auto;font-size: 12px;"
                                                        name="proceed" class="checkout-button button alt wc-forward"><a
                                                            href="../Product/products_viewall.php?category_id=<?= $cat_id2 ?>&subcategory_id=<?= $sub_cat_id2 ?>"
                                                            style="color:<?= $c2 ?>;">View all</a></button>
                                                </span>
                                            </h4>
                                            <div class="scrollmenu bl_item_scroll  <?= $color[$rancolor2] ?>"
                                                style="background-color: #fff">
                                                <?php
                                                $row = $pdo->query("select item_description.item_description_id,item.item_id,item.item_name,category.category_name,category.category_id,sub_category.sub_category_id,sub_category.sub_category_name from item
    inner join item_description on item_description.item_id=item.item_id
    inner join category on category.category_id=item.category_id
    inner join sub_category on category.category_id=sub_category.category_id
    where  sub_category.category_id=$cat_id2 and sub_category.sub_category_id=$sub_cat_id2 and item.sub_category_id=$sub_cat_id2");
                                                while ($row1 = $row->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <a href="../Product/single.php?id=<?= $row1['item_description_id'] ?>"><img
                                                            title=" " alt=" " class="new_size"
                                                            src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"></a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 small" id="small_screen"></div>
                                <?php
                }
                ?>
                        </div>
                    </div>
                </div>
                <?php
                require "../Main/footer.php";
                ?>
                <script type="text/javascript">
                    function go() {
                        console.log("in function");
                        location.href = "../Checkout/checkout.php";
                    }
                </script>
                <script type="text/javascript">
                    //UPDATE ITEM
                    function updateitem(idid, sid) {
                        var id = sessionStorage.getItem("id");
                        var item_description_id = idid;
                        var store_id = sid;
                        var order_type = document.getElementById('order_s' + store_id + 'i' + idid).value;
                        var total_amt = document.getElementById('total_s' + store_id + 'i' + idid).innerHTML;
                        if ($('#qnty_s' + store_id + 'i' + idid).css('display') != 'none') {
                            var quantity = document.getElementById('qnty_s' + store_id + 'i' + idid).value;
                        }
                        else if ($('#sel_s' + store_id + 'i' + idid).css('display') != 'none') {
                            var quantity = document.getElementById('sel_s' + store_id + 'i' + idid).value;
                            document.getElementById('sel_opt_s' + store_id + 'i' + idid).innerHTML = quantity;
                            document.getElementById('sel_opt_s' + store_id + 'i' + idid).value = quantity;
                        }
                        else if ($('#btn_s' + store_id + 'i' + idid).css('display') != 'none') {
                            var quantity = document.getElementById('btn_s' + store_id + 'i' + idid).innerHTML;
                        }
                        //alert(order_type+","+store_id+","+id+","+idid+","+quantity+","+total_amt)
                        $.ajax({
                            url: "../Common/functions.php", //passing page info
                            data: { "update_cart_item": 1, "item_description_id": item_description_id, "store_id": store_id, "quantity": quantity, "total_amt": total_amt, "order_type": order_type },  //form data
                            type: "post",   //post data
                            dataType: "json",   //datatype=json format
                            timeout: 30000,   //waiting time 30 sec
                            success: function (data) {    //if registration is success
                                if (data.status == 'success') {
                                    swal({
                                        title: "Updated!!!",
                                        text: "Item is updated",
                                        icon: "success",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit1) => {
                                            if (willSubmit1) {
                                                //document.getElementById('tot_val1').innerHTML="";
                                                //document.getElementById('tot_val1').innerHTML=""+data.total;
                                                document.getElementById('tot_val2').innerHTML = "";
                                                document.getElementById('tot_val2').innerHTML = "" + data.total;
                                                document.getElementById("sm-cartcnt").innerHTML = "";
                                                document.getElementById("lg-cartcnt").innerHTML = "";
                                                document.getElementById("sm-cartcnt").innerHTML = data.cartcnt;
                                                document.getElementById("lg-cartcnt").innerHTML = data.cartcnt;
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
                    //UPDATE ITEM
                    //UPDATE CART
                    function updatecart() {
                        <?php
                        if (isset($id)) {
                            $sql1 = "select * from cart where user_id=:id order by item_description_id";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute(array(
                                ':id' => $id
                            ));
                            $dup = array();
                            if (isset($dup)) {
                                unset($dup);
                            }
                        }
                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $item_description_id = $row1['item_description_id'];
                            $store_id = $row1['store_id'];
                            $n = 0;
                            $sql2 = "select * from item
            inner join category on category.category_id=item.category_id
            inner join sub_category on category.category_id=sub_category.category_id
            inner join item_description on item_description.item_id=item.item_id
            inner join product_details on item_description.item_description_id=product_details.item_description_id
            inner join store on store.store_id=product_details.store_id
            where item.sub_category_id=sub_category.sub_category_id and item_description.item_description_id=:item_description_id and product_details.store_id=:store_id order by item_description.item_description_id";
                            $stmt2 = $pdo->prepare($sql2);
                            $stmt2->execute(array(
                                ':item_description_id' => $item_description_id,
                                ':store_id' => $store_id
                            ));
                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                $subcat = $row2['sub_category_name'];
                                ?>
                                var total_amt = document.getElementById('total_s' + '<?= $store_id . "i" . $item_description_id ?>').innerHTML;
                                if ($('#qnty_s<?= $store_id . "i" . $item_description_id ?>').css('display') != 'none') {
                                    var quantity = document.getElementById('qnty_s<?= $store_id . "i" . $item_description_id ?>').value;
                                }
                                else if ($('#sel_s<?= $store_id . "i" . $item_description_id ?>').css('display') != 'none') {
                                    var quantity = document.getElementById('sel_s<?= $store_id . "i" . $item_description_id ?>').value;
                                    document.getElementById('sel_opt_s<?= $store_id . "i" . $item_description_id ?>').innerHTML = quantity;
                                    document.getElementById('sel_opt_s<?= $store_id . "i" . $item_description_id ?>').value = quantity;
                                }
                                else if ($('#btn_s<?= $store_id . "i" . $item_description_id ?>').css('display') != 'none') {
                                    var quantity = document.getElementById('btn_s<?= $store_id . "i" . $item_description_id ?>').innerHTML;
                                }
                                //1=booking;2=cash_on_delivery
                                var order_type = document.getElementById('order_s' + '<?= $store_id . "i" . $item_description_id ?>').value;
                                var id = <?= $id ?>;
                                var item_description_id = <?= $item_description_id ?>;
                                var store_id = <?= $store_id ?>;
                                $.ajax({
                                    url: "../Common/functions.php", //passing page info
                                    data: { "update_user_cart": 1, "item_description_id": item_description_id, "store_id": store_id, "quantity": quantity, "total_amt": total_amt, "order_type": order_type },  //form data
                                    type: "post",   //post data
                                    dataType: "json",   //datatype=json format
                                    timeout: 30000,   //waiting time 30 sec
                                    success: function (data) {    //if registration is success
                                        if (data.status == 'success') {
                                            swal({
                                                title: "Updated!!!",
                                                text: "Cart is updated",
                                                icon: "success",
                                                closeOnClickOutside: false,
                                                dangerMode: true,
                                            })
                                                .then((willSubmit1) => {
                                                    if (willSubmit1) {
                                                        //document.getElementById('tot_val1').innerHTML="";
                                                        //document.getElementById('tot_val1').innerHTML=""+data.total;
                                                        document.getElementById('tot_val2').innerHTML = "";
                                                        document.getElementById('tot_val2').innerHTML = "" + data.total;
                                                        document.getElementById("sm-cartcnt").innerHTML = "";
                                                        document.getElementById("lg-cartcnt").innerHTML = "";
                                                        document.getElementById("sm-cartcnt").innerHTML = data.cartcnt;
                                                        document.getElementById("lg-cartcnt").innerHTML = data.cartcnt;
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
                                <?php
                            }
                        }
                        ?>
                    }
                    //DELETE FROM CART
                    function remove_item(store_id, item_description_id) {
                        var store_id = store_id;
                        var item_description_id = item_description_id;
                        swal({
                            title: "Remove !!!",
                            text: "Are you sure!!! ",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            buttons: true,
                            buttons: ["Cancel", "Remove"],
                        })
                            .then((willSubmit) => {
                                if (willSubmit) {
                                    $.ajax({
                                        url: "../Common/functions.php", //passing page info
                                        data: { "remove_item": 1, "item_description_id": item_description_id, "store_id": store_id },  //form data
                                        type: "post",   //post data
                                        dataType: "json",   //datatype=json format
                                        timeout: 30000,   //waiting time 30 sec
                                        success: function (data) {    //if registration is success
                                            if (data.status == 'success') {
                                                //document.getElementById('tot_val1').innerHTML="";
                                                // document.getElementById('tot_val1').innerHTML=""+data.total;
                                                document.getElementById('tot_val2').innerHTML = "";
                                                document.getElementById('tot_val2').innerHTML = data.total;
                                                document.getElementById("sm-cartcnt").innerHTML = "";
                                                document.getElementById("lg-cartcnt").innerHTML = "";
                                                document.getElementById("sm-cartcnt").innerHTML = data.cartcnt;
                                                document.getElementById("lg-cartcnt").innerHTML = data.cartcnt;
                                                $('#total_rm_cnt').html(data.cartcnt);
                                                if (data.cart == 0) {
                                                    swal({
                                                        title: "Empty!!!",
                                                        text: "Your cart is empty",
                                                        icon: "warning",
                                                        closeOnClickOutside: false,
                                                        dangerMode: true,
                                                    })
                                                        .then((willSubmit1) => {
                                                            if (willSubmit1) {
                                                                location.href = "../Cart/cart.php";
                                                                return;
                                                            }
                                                            else {
                                                                return;
                                                            }
                                                        });
                                                }
                                                /*
                                                if(data.mulrow=="sin"){
                                                    $("#"+data.divhide).hide();
                                                    location.href="../Cart/cart.php";
                                                    return;
                                                }*/
                                                else {
                                                    $("." + data.divhide).fadeOut('slow', function (c) {
                                                        $("." + data.divhide).hide();
                                                        return;
                                                    });
                                                }
                                            }
                                            else {
                                                swal({
                                                    title: "Try again!!!",
                                                    icon: "error",
                                                    dangerMode: true,
                                                    timer: 6000,
                                                });
                                                return;
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
                                else { return; }
                            });
                    }
                    //SELECT BOX OPERATION
                    function select_item_option(store_id, item_description_id, tmrp) {
                        var store_id = store_id;
                        var item_description_id = item_description_id;
                        var mrp = tmrp;
                        old_value = $('#sel_s' + store_id + 'i' + item_description_id + ' :selected').val();
                        if (old_value == '0') {//your specific condition
                            remove_item(store_id, item_description_id);
                            document.getElementById('sel_s' + store_id + 'i' + item_description_id).value = document.getElementById('sel_opt_s' + store_id + 'i' + item_description_id).value;
                            return;
                        }
                        else if (old_value == '10') {
                            $('#sel_s' + store_id + 'i' + item_description_id + '').hide();
                            $('#qnty_s' + store_id + 'i' + item_description_id + '').show();
                            $('#btn_s' + store_id + 'i' + item_description_id + '').hide();
                        }
                        else {
                            total(store_id, item_description_id, mrp);
                        }
                    }
                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    function sub_item_all(store_id, item_description_id, tmrp) {
                        var store_id = store_id;
                        var item_description_id = item_description_id;
                        var mrp = tmrp;
                        if (parseInt($('#btn_s' + store_id + 'i' + item_description_id).html()) != 1) {
                            var sub = 0;
                            sub = parseInt(document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML);
                            document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = sub - 1;
                            document.getElementById('qnty_s' + store_id + 'i' + item_description_id).value = sub - 1;
                            if ($('#btn_s' + store_id + 'i' + item_description_id).val() != 10) {
                                document.getElementById('btn_s' + store_id + 'i' + item_description_id).value = sub - 1;
                            }
                            if ($('#btn_s' + store_id + 'i' + item_description_id).val() > 10) {
                                select_item_option(store_id, item_description_id, mrp);
                            }
                        }
                        else if (parseInt($('#btn_s' + store_id + 'i' + item_description_id).html()) == 1) {
                            remove_item(store_id, item_description_id);
                        }
                        total(store_id, item_description_id, mrp);
                    }
                    function add_item_all(store_id, item_description_id, tmrp) {
                        var store_id = store_id;
                        var item_description_id = item_description_id;
                        var mrp = tmrp;
                        if (parseInt($('#btn_s' + store_id + 'i' + item_description_id).html()) != 0) {
                            add = parseInt(document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML);
                            document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = add + 1;
                            document.getElementById('qnty_s' + store_id + 'i' + item_description_id).value = add + 1;
                            if ($('#btn_s' + store_id + 'i' + item_description_id).val() != 10) {
                                document.getElementById('sel_s' + store_id + 'i' + item_description_id).value = add + 1;
                            }
                            if ($('#btn_s' + store_id + 'i' + item_description_id).val() > 10) {
                                select_item_option(store_id, item_description_id, mrp);
                            }
                        }
                        else if (parseInt($('#btn_s' + store_id + 'i' + item_description_id).html()) > 9) {
                            select_item_option(store_id, item_description_id, tmrp)
                        }
                        total(store_id, item_description_id, mrp);
                    }
                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    //PRICE AND CART SETTINGS
                    $(document).ready(function () {
                    });
                    function total(store_id, item_description_id, tmrp) {
                        var store_id = store_id;
                        var item_description_id = item_description_id;
                        var t_mrp = tmrp;
                        var mrp = tmrp;
                        if ($('#qnty_s' + store_id + 'i' + item_description_id).css('display') != 'none') {
                            var qnty = parseInt(document.getElementById('qnty_s' + store_id + 'i' + item_description_id).value);
                            document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = qnty;
                            document.getElementById('qnty_s' + store_id + 'i' + item_description_id).innerHTML = qnty;
                        }
                        else if ($('#sel_s' + store_id + 'i' + item_description_id).css('display') != 'none') {
                            var qnty = document.getElementById('sel_s' + store_id + 'i' + item_description_id).value;
                            document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = qnty;
                        }
                        else if ($('#btn_s' + store_id + 'i' + item_description_id).css('display') != 'none') {
                            var qnty = document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML;
                            if (qnty == 0) {
                                remove_item(store_id, item_description_id);
                            }
                        }
                        if (qnty < 10) {
                            $('#sel_s' + store_id + 'i' + item_description_id + '').hide();
                            $('#qnty_s' + store_id + 'i' + item_description_id + '').hide();
                            $('#btn_s' + store_id + 'i' + item_description_id + '').show();
                            document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = qnty;
                            $('#sel_s' + store_id + 'i' + item_description_id + ' option').filter(function () { return ($(this).text() == qnty); }).prop('selected', true);
                        }
                        if (qnty >= 10) {
                            $('#sel_s' + store_id + 'i' + item_description_id + '').hide();
                            $('#btn_s' + store_id + 'i' + item_description_id + '').hide();
                            $('#qnty_s' + store_id + 'i' + item_description_id + '').show();
                        }
                        if (qnty < 0) {
                            qnty = qnty * -1;
                        }
                        else {
                            qnty = qnty;
                        }
                        var price = document.getElementById('price_s' + store_id + 'i' + item_description_id).innerHTML;
                        $.ajax({
                            url: "../Common/functions.php", //passing page info
                            data: { "check_quantity": 1, "item_description_id": item_description_id, "store_id": store_id, "quantity": qnty },  //form data
                            type: "post",   //post data
                            dataType: "json",   //datatype=json format
                            timeout: 30000,   //waiting time 30 sec
                            success: function (data) {    //if registration is success
                                if (data.status == 'avail') {
                                    return;
                                }
                                else if (data.status == 'notavail') {
                                    document.getElementById('qnty_s' + store_id + 'i' + item_description_id).value = data.max_qnty;
                                    document.getElementById('sel_s' + store_id + 'i' + item_description_id).value = data.max_qnty;
                                    document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = data.max_qnty;
                                    if (data.max_qnty >= 10) {
                                        document.getElementById('sel_s' + store_id + 'i' + item_description_id).value = 9;
                                    }
                                    else if (data.max_qnty < 10) {
                                        document.getElementById('sel_s' + store_id + 'i' + item_description_id).value = data.max_qnty;
                                        $('#sel_s' + store_id + 'i' + item_description_id + '').hide();
                                        $('#qnty_s' + store_id + 'i' + item_description_id + '').hide();
                                        $('#btn_s' + store_id + 'i' + item_description_id + '').show();
                                    }
                                    var t_amnt = price * data.max_qnty;
                                    t_mrp = mrp * data.max_qnty;
                                    document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = "";
                                    document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = t_amnt;
                                    document.getElementById('mrp_s' + store_id + 'i' + item_description_id).innerHTML = "";
                                    document.getElementById('mrp_s' + store_id + 'i' + item_description_id).innerHTML = t_mrp;
                                    var save = t_mrp - t_amnt;
                                    var off = Math.round((save * 100) / t_amnt);
                                    document.getElementById('save_s' + store_id + 'i' + item_description_id).innerHTML = save;
                                    document.getElementById('off_s' + store_id + 'i' + item_description_id).innerHTML = off;
                                    swal({
                                        title: "Out of Stock!!!",
                                        text: "Choose another store !!!",
                                        icon: "warning",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                        timer: 6000,
                                    })
                                        .then((willSubmit1) => {
                                            if (willSubmit1) {
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
                        if (qnty > 0) {
                            var total = price * qnty;
                            var t_mrp = t_mrp * qnty;
                            document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = "";
                            document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = total;
                            document.getElementById('mrp_s' + store_id + 'i' + item_description_id).innerHTML = t_mrp;
                            var save = t_mrp - total;
                            var off = Math.round((save * 100) / total);
                            document.getElementById('save_s' + store_id + 'i' + item_description_id).innerHTML = save;
                            document.getElementById('off_s' + store_id + 'i' + item_description_id).innerHTML = off;
                        }
                        else if (qnty == 0) {
                            var total = price * 1;
                            document.getElementById('qnty_s' + store_id + 'i' + item_description_id).value = 1;
                            document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = "";
                            document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = total;
                            document.getElementById('mrp_s' + store_id + 'i' + item_description_id).innerHTML = t_mrp;
                            var save = t_mrp - total;
                            var off = Math.round((save * 100) / total);
                            document.getElementById('save_s' + store_id + 'i' + item_description_id).innerHTML = save;
                            document.getElementById('off_s' + store_id + 'i' + item_description_id).innerHTML = off;
                        }
                        else if (qnty < 0) {
                            document.getElementById('qnty_s' + store_id + 'i' + item_description_id).value = qnty * -1;
                            var total = price * qnty * -1;
                            var t_mrp = t_mrp * qnty * -1;
                            document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = "";
                            document.getElementById('total_s' + store_id + 'i' + item_description_id).innerHTML = total;
                            document.getElementById('mrp_s' + store_id + 'i' + item_description_id).innerHTML = t_mrp;
                            var save = t_mrp - total;
                            var off = Math.round((save * 100) / total);
                            document.getElementById('save_s' + store_id + 'i' + item_description_id).innerHTML = save;
                            document.getElementById('off_s' + store_id + 'i' + item_description_id).innerHTML = off;
                        }
                    }
                    //PRICE AND CART SETTINGS
                </script>
                </body>

                </html>