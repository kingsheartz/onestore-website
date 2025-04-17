<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:../Main/onestore.php");
}
require "../Main/header.php";
$uid = $_SESSION['id'];
$sql = "select category.category_id,sub_category.sub_category_id,item_description.item_description_id,cart.quantity,cart.store_id,item.item_name,product_details.price from cart
inner join cart_temp on cart_temp.cart_id=cart.cart_id
inner join item_description on cart.item_description_id=item_description.item_description_id
inner join item on item_description.item_id=item.item_id
inner join category on category.category_id=item.category_id
inner join sub_category on category.category_id=sub_category.category_id
inner join product_details on item_description.item_description_id=product_details.item_description_id
inner join store on store.store_id=product_details.store_id
where item.sub_category_id=sub_category.sub_category_id and cart_temp.user_id=:user and cart_temp.cart_id=cart.cart_id and product_details.store_id=cart.store_id and product_details.item_description_id=cart.item_description_id GROUP BY cart.store_id,cart.item_description_id order by cart.item_description_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(
    ":user" => $uid
));
$pdt_cnt = $stmt->rowCount();
?>
<div style="background-color: #f8f8f8">
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

        .invert,
        .invert-image {
            border: 0px solid !important;
            border-bottom: 2px solid #bbb !important;
        }

        .small-size {
            display: none;
        }

        @media(max-width:991px) {
            #bill_gap {
                margin-bottom: 40px !important;
            }

            .billing_details {
                padding-left: 0px;
            }

            .large-size {
                display: none;
            }

            .small-size {
                display: unset;
            }

            .pdt_block {
                padding-left: 15px !important;
            }

            .checkout-left-basket {
                padding-top: 15px !important;
            }
        }

        @media(min-width:1001px) {
            td.invert-image a img {
                height: 150px !important;
                width: auto !important;
            }

            td.invert div ul li h4 {
                font-weight: bold;
            }
        }

        @media(max-width:1000px) {
            td.invert-image a img {
                height: 150px !important;
                width: auto !important;
            }

            td.invert div ul li h4 {
                font-weight: bold;
            }
        }

        @media(max-width:768px) {
            td.invert div ul li h4 {
                font-size: 16px;
            }

            td.invert-image a img {
                height: 100px !important;
                width: auto !important;
            }

            th.slno,
            td.slno {
                width: 10px !important;
            }
        }

        @media(max-width:480px) {
            td.invert div ul li h4 {
                font-size: 14px;
            }

            td.invert-image a img {
                height: 80px !important;
                width: auto !important;
            }
        }

        .timetable_sub th {
            background-color: #3399cc;
            border-color: white;
        }

        .load_btn {
            outline: none;
            border: none;
            padding: 10px 0;
            font-size: 1em;
            color: #fff;
            display: block;
            width: 100%;
            background-color: #5a88ca;
        }

        .place_order.nav-maker {
            background-color: #fe9126;
            color: white;
            outline: none;
            border: 0px;
            transform: bakground-color;
            transition: 0.5s;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
        }

        .place_order.nav-maker:hover {
            background-color: #337ab7;
        }

        @media(max-width:768px) {
            .place_order.nav-maker {
                position: fixed;
                bottom: 0px;
                left: 0px;
                right: 10px;
                width: 100% !important;
                z-index: 1 !important;
                background-color: #fe9126;
                color: white;
                outline: none;
                border: 0px;
                padding: 12px !important;
                font-weight: bold;
                font-size: 16px !important;
            }

            .place_order.nav-maker:hover {
                background-color: #337ab7;
            }

            .back-to-top {
                right: 0 !important;
                bottom: 50px !important;
            }
        }

        .checkmark {
            position: absolute;
            top: 0px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 50%
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

        .radio,
        .checkbox {
            padding: 6px 10px
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
            padding-left: 25px
        }

        .options input {
            opacity: 0
        }
    </style>
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1">
                <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Checkout</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!--<div style="background-image: url(../../images/logo/check.jpg);width: 100%;height: 100%;" >-->
    <!-- checkout -->
    <div class="checkout" style="padding-top: 0px;padding-bottom: 0px; background-color: rgba(255,255,255,0.05);">
        <div class="container" style="margin-left:0px;margin-right:6px;width: 100%;padding:0;"><br>
            <h2 style="padding:15px;">Your shopping cart contains: <span style="font-family: arial"><?= $pdt_cnt ?>
                    Products</span></h2>
            <div class="col-md-8" style="margin-bottom: 15px;">
                <div class="woocommerce-billing-fields small-size">
                    <div class="checkout-left-basket" style="width: 100%;background-color: white">
                        <ul style="margin: 0px;padding:0px;width: 100%;">
                            <div style="width: 100%;">
                                <li>
                                    <h4 style="font-weight: bolder;width: 100%;" class="shadow_b">Shopping Items <i
                                            class="fa fa-shopping-cart"></i></h4>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="checkout-right">
                    <table class="timetable_sub " style="background-color: white;">
                        <thead>
                            <tr>
                                <th class="slno">SL No.</th>
                                <th>Product</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <?php
                        $ai = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $sid = $row['store_id'];
                            $sql2 = "select * from store where store_id=:sid";
                            $stmt2 = $pdo->prepare($sql2);
                            $stmt2->execute(array(":sid" => $sid));
                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr class="rem1">
                                    <td class="invert slno"><?= $ai ?></td>
                                    <td class="invert-image" style=" "><a
                                            href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
                                                src="../../images\<?= $row['category_id'] ?>\<?= $row['sub_category_id'] ?>\<?= $row['item_description_id'] ?>.jpg"
                                                alt=" " class="img-responsive" /></a></td>
                                    <td class="invert">
                                        <div
                                            style="margin:auto;justify-content: left;align-items:left;display:flex;padding-left:20px;">
                                            <ul style="list-style: none;">
                                                <li>
                                                    <h4 style="text-align: left;"><?= $row['item_name'] ?></h4>
                                                </li>
                                                <li style="text-align: left;">
                                                    Seller : <?= $row2['store_name'] ?>
                                                </li>
                                                <li style="text-align: left;">
                                                    Price : &#8377; <?= $row['price'] ?>
                                                </li>
                                                <li style="text-align: left;">
                                                    Quantity : <?= $row['quantity'] ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $ai++;
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 pdt_block" style="padding: 0px;padding-right:15px;">
                <div class="woocommerce-billing-fields">
                    <div class="checkout-left-basket" style="width: 100%;background-color: white;">
                        <ul style="margin: 0px;padding:0px;width: 100%;">
                            <div style="width: 100%;">
                                <li class="large-size">
                                    <h4 style="font-weight: bolder;width: 100%;" class="shadow_b">Shopping Items <i
                                            class="fa fa-shopping-cart"></i></h4>
                                </li>
                                <div style="padding-left: 20px;padding-right:20px;width: 100%;">
                                    <?php
                                    $total = 0;
                                    $mrp_chrg = 0;
                                    $service_chrg = 0;
                                    $base = 0;
                                    $uid = $_SESSION['id'];
                                    $sql = "select DISTINCT c.cart_id,i.item_id,id.item_description_id,i.item_name,pd.price,i.price as mrp,c.quantity,c.total_amt from cart c
inner join cart_temp ct on ct.cart_id=c.cart_id
inner join item_description id on c.item_description_id=id.item_description_id
inner join item i on i.item_id=id.item_id
inner join product_details pd on id.item_description_id=pd.item_description_id
where ct.user_id=$uid GROUP BY c.cart_id";
                                    /*
                                    //(int)$row['mrp']*(int)$row['quantity'];
                                    //CODE:-<span style="text-decoration:line-through;padding-left:3px  ">  &#8377;<?=(int)$row['mrp']*(int)$row['quantity']?></span>
                                    //TOTAL AMOUNT / EACH PRODUCT
                                    */
                                    /*
                                    //CODE:-<span style="text-decoration:line-through;padding-left:3px;float: right;"> &#8377;<?=$mrp_chrg?></span>
                                    //TOTAL SERVICE CHARGES
                                    */
                                    /*
                                    //CODE:-<span style="text-decoration:line-through;padding-left:3px;color: #333;font-weight: normal;"><?=$base?></span>
                                    //TOTAL AMOUNT TO BE PAID
                                    */
                                    $stmt = $pdo->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <li style="color: #333"><?= $row['item_name'] ?> <i>-</i> <span>&#8377;
                                                <?= $row['total_amt'] ?></span></li>
                                        <?php
                                        $qty = $row['quantity'];
                                        $service_chrg += (($row['total_amt'] * 2) / 100);
                                        $mrp_chrg += ((($row['mrp'] * $qty) * 2) / 100);
                                        $total += $row['total_amt'];
                                        $base += $row['mrp'] * $qty;
                                    }
                                    $total_amt = $total;
                                    $total_mrp = $base;
                                    $total += $service_chrg;
                                    $base += $mrp_chrg;
                                    ?>
                                    <li>Total Service Charges <i>-</i>
                                        <span>&#8377;<?= $service_chrg . " " ?></span>
                                    </li>
                                    <li>Total Savings <i>-</i>
                                        <span>&#8377;<?= $total_mrp - $total_amt . " " ?></span>
                                    </li>
                                    <li><i
                                            style="font-weight: bolder;font-family:sans-serif; ;color: black;font-style: unset;">Total
                                            <i>-</i> </i><span
                                            style="font-weight: bolder;font-family:sans-serif; ;color: black;">&#8377;<?= $total_amt ?></span>
                                    </li>
                                    <hr>
                                </div><br>
                                <a href="../Main/onestore.php">
                                    <li id="bill_gap" class="shadow_b" style="padding:10px;background-color:#3399cc "><i
                                            class="glyphicon glyphicon-menu-left" style="color: white"
                                            aria-hidden="true"></i><span style="color: white">Continue Shopping</span>
                                    </li>
                                </a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //checkout -->
    <div class="container" style="margin-top: -80px;width:100% !important;">
        <div class="row">
            <div class="col-sm-12" style="padding-left: 0px;">
                <div class="product-content-right" style="width: 100%">
                    <div class="woocommerce">
                        <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout"
                            style="padding: 0px">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <p style="color: grey;"><b>NOTE : </b>Booked products need to received from the
                                    corresponding shops.</p>
                            </div>
                            <div class="col-sm-1"></div>
                            <div id="customer_details" class="col2-set" style="margin:6px;padding: 0px;width: 100%">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5">
                                    <div class="billing_details">
                                        <div class="woocommerce-shipping-fields">
                                            <h3 id="ship-to-different-address">
                                                <h3>Billing Details</h3>
                                                <br>
                                                <label class="options" for="use-as-register-checkbox">Use default
                                                    address?
                                                    <input type="radio" onclick="" style="float: left;"
                                                        value="register_details" name="use-as-register-checkbox"
                                                        id="use-as-register-checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <br>
                                                <label class="options" for="stda_check">Ship to a different address?
                                                    <input type="radio" style="float: left;" onclick="stda()"
                                                        name="use-as-register-checkbox" class="stda-checkbox"
                                                        id="stda_check"> <span class="checkmark"></span>
                                                </label><br>
                                            </h3>
                                            <p id="shipping_address_1_field"
                                                class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="order_comments">Order Notes <i
                                                        class="fa fa-file-text-o"></i></label>
                                                <textarea cols="5" rows="2"
                                                    placeholder="Notes about your order, e.g. special notes for delivery."
                                                    id="order_comments" name="order_comments"
                                                    oninput="$(this).removeClass('invalid')"
                                                    title="Minimal character count is 10" placeholder="Street address"
                                                    class="input-text validate"
                                                    onfocus="$('#myTextarea').prop('selectionStart');"></textarea>
                                            </p>
                                        </div>
                                        <div id="payment">
                                            <div class="form-row place-order" style="width: 100%">
                                                <button type="button" data-value="Place order" id="place_order"
                                                    name="woocommerce_checkout_place_order"
                                                    class="button alt real_btn place_order"
                                                    style="width: 100%;font-size:1em" onclick="placeorder()"><i
                                                        class="fas fa-shopping-bag"></i>&nbsp; PLACE ORDER </button>
                                            </div>
                                            <div class="form-row place-order" style="width: 100%">
                                                <button class="load_btn place_order" data-value="Place order"
                                                    style="display:none;width: 100%;font-weight:bold"
                                                    name="woocommerce_checkout_place_order" type="button"><i
                                                        class="fa fa-refresh fa-spin"></i>&nbsp;PLACE ORDER</button>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="shipping_address" style="display: none;" id="stda_div">
                                        <hr class="make_divc"><br>
                                        <p id="shipping_first_name_field"
                                            class="form-row form-row-first validate-required">
                                            <label class="" for="shipping_first_name"
                                                style="font-weight: normal;text-transform: capitalize;">First Name <abbr
                                                    title="required" class="required" style="color: #c50505">*</abbr>
                                            </label>
                                            <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                                placeholder="First name" id="shipping_first_name"
                                                name="shipping_first_name" class="input-text validate"
                                                pattern="^\S[a-zA-Z]{3,30}$" title="Minimum character '3'.Use alphabets"
                                                required="">
                                        </p>
                                        <p id="shipping_last_name_field"
                                            class="form-row form-row-last validate-required">
                                            <label class="" for="shipping_last_name"
                                                style="font-weight: normal;text-transform: capitalize;">Last Name <abbr
                                                    title="required" class="required" style="color: #c50505">*</abbr>
                                            </label>
                                            <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                                placeholder="Last name" id="shipping_last_name"
                                                name="shipping_last_name" class="input-text validate"
                                                pattern="^[a-zA-Z ]{1,20}$" title="Use alphabets" required="">
                                        </p>
                                        <p id="shipping_phone_number_field"
                                            class="form-row form-row-last validate-required">
                                            <label class="" for="shipping_phone_number"
                                                style="font-weight: normal;text-transform: capitalize;">Phone
                                                Number<abbr title="required" class="required"
                                                    style="color: #c50505">*</abbr>
                                            </label>
                                            <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                                placeholder="Phone number" id="shipping_ph_no" maxlength="10"
                                                name="shipping_ph_no" class="input-text validate"
                                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57;"
                                                pattern="^\d{10}$" title="Phone Number Format (9876543210)- 10 digits"
                                                required="">
                                        </p>
                                        <p id="shipping_phone_number2_field"
                                            class="form-row form-row-last validate-required">
                                            <label class="" for="shipping_ph_no2"
                                                style="font-weight: normal;text-transform: capitalize;">Alternate phone
                                                number<small title="required" class="required" style="color: #c50505">
                                                    (Optional)</small>
                                            </label>
                                            <input type="text" oninput="$(this).removeClass('invalid')" value=""
                                                placeholder="Alternate Phone Number" id="shipping_ph_no2" maxlength="10"
                                                name="shipping_ph_no2" class="input-text validate"
                                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57;"
                                                pattern="^(\d{0}|\d{10})$"
                                                title="Phone Number Format (9876543210)- 10 digits">
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
                                                id="shipping_address_1" name="shipping_address_1"
                                                class="input-text validate" required=""></textarea>
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
                                                pattern="^\d{6}$" title="PIN Number Format (654321)- 6 digits"
                                                required="">
                                        </p>
                                        <div class="clear"></div>
                                        <input type="submit" id="delivery_button" style="display:none" />
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<?php
require "../Main/footer.php";
?>
<script type="text/javascript">
    $(window).resize(function () {
        if ($(window).width() < 769) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                $('#payment').hide();
            }
            else {
                $('#payment').show();
            }
        }
        else {
            $('#payment').show();
        }
    });
    window.onscroll = function (ev) {
        if ($(window).width() < 769) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                $('#payment').hide();
            }
            else {
                $('#payment').show();
            }
        }
        else {
            $('#payment').show();
        }
    };
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
/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--->
/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--->
function placeorder(){
var order_notes=document.getElementById('order_comments').value;
    if(order_notes=="" || order_notes==null){
        order_notes=0;
    }
    if(checkBox_user.checked==false && checkBox_diff.checked==false){
        toastr.error('Require billing details!!!')
        return;
    } else if(checkBox_user.checked==true){
        var uid="<?= $_SESSION['id'] ?>";
    var pdt_cnt = "<?= $pdt_cnt ?>";
    var total_amt = "<?= $total_amt ?>";
    var data = { "placeorder_mul": 1, "user": 1, "user_id": uid, "order_notes": order_notes, "pdt_cnt": pdt_cnt, "total_amt": total_amt };
    // Create a form dynamically
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '../Payment/payment.php';
    for (let key in data) {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = data[key];
        form.appendChild(input);
    }
    document.body.appendChild(form);
    form.submit(); // This opens payment.php with POST data
    }
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
            $('#delivery_button').click();
            document.getElementById("shipping_ph_no").focus();
            document.getElementById("shipping_ph_no").className += " invalid";
            return false;
        }
        //validating shipping_ph_no 2 is a number
        if (shipping_ph_no2 != "" && shipping_ph_no2.length != 10) {
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
                text: "Invalid address",
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
        else {
            var uid = "<?= $_SESSION['id'] ?>";
            var pdt_cnt = "<?= $pdt_cnt ?>";
            var total_amt = "<?= $total_amt ?>";
            var data = { "placeorder_mul": 1, "user": 2, "user_id": uid, "shipping_first_name": shipping_first_name, "shipping_last_name": shipping_last_name, "shipping_ph_no": shipping_ph_no, "shipping_ph_no2": shipping_ph_no2, "shipping_address_1": shipping_address_1, "shipping_postcode": shipping_postcode, "order_notes": order_notes, "pdt_cnt": pdt_cnt, "total_amt": total_amt };
            // Create a form dynamically
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '../Payment/payment.php';
            for (let key in data) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = data[key];
                form.appendChild(input);
            }
            document.body.appendChild(form);
            form.submit(); // This opens payment.php with POST data
        }
    }
}
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--->
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--->
</script>
<!--</div>-->
</body>

</html>