<?php
if (isset($_GET['wishlist_id'])) {
    $wishlist_id = $_GET['wishlist_id'];
} else {
    header("location:../Wishlist/wishlist.php");
    return;
}
require "../Main/header.php";
require "../Common/pdo.php";
$update_setting_sql = 'select* from wishlist where wishlist_id= ' . $wishlist_id;
$update_setting_stmt = $pdo->query($update_setting_sql);
$update_setting_row = $update_setting_stmt->fetch(PDO::FETCH_ASSOC);
?>
<!-- breadcrumbs -->
<div class="breadcrumbs" style="background-color: #eaeded">
    <div class="container">
        <ol class="breadcrumb breadcrumb1" style="background-color: #eaeded">
            <li><a href="../Main/onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
            </li>
            <li><a href="../Wishlist/wishlist.php"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Wish
                    list</a></li>
            <li class="active">Manage List</li>
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

        .height_setter {
            height: auto !important;
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

        td.product-img {
            float: left !important;
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

        .shop_table {
            margin-top: -23px !important;
        }
    }

    @media(max-width: 578px) {
        .product-price {
            font-size: 5vw !important;
        }
    }

    @media(max-width: 510px) {
        div.cart_item {
            padding: 0px !important;
        }

        .full-size-cart-store-div {
            margin-left: -20px !important;
        }

        .wishlist_items_show {
            padding: 0px !important;
        }

        .settings_show {
            padding: 0px !important;
        }

        .settings_show h3,
        .wishlist_items_show h3 {
            padding-left: 15px !important;
        }

        .main_padding {
            padding: 0px !important;
        }
    }

    @media(max-width: 450px) {
        .large_specs_seen {
            display: none !important;
        }

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

        img.shop_thumbnail {
            max-height: 120px !important;
            width: auto !important;
        }
    }

    .manage_list_table td {
        border-bottom: 1px solid #bdbdbd;
    }

    @media (min-width: 992px) {
        .listgrp {
            width: 50% !important;
        }
    }

    div.cart_item {
        padding: 0px !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("#<?= $update_setting_row['privacy'] ?>").prop('checked', true);
        <?php
        if (isset($_GET['setting']) && $_GET['setting'] == 1) {
            ?>
            $('.settings_row').click();
            <?php
        }
        ?>
    });
</script>
<?php
$sql_single_div = "select COUNT(wishlist_items_id) as checksingle from wishlist_items where wishlist_id=:wishlist_id";
$stmt_single_div = $pdo->prepare($sql_single_div);
$stmt_single_div->execute(array(
    ':wishlist_id' => $wishlist_id
));
$row_single_div = $stmt_single_div->fetch(PDO::FETCH_ASSOC);
$rowcount = $row_single_div['checksingle'];
?>
<div class="single-product-area" style="padding-top: 0px; background-color: #eaeded;padding-bottom: 0px;">
    <div class="zigzag-bottom"></div>
    <div class="container nopadding-margin" style="margin-left: 0px;width: 100%;padding: 0px;padding-bottom: 30px;">
        <div class="row" style="margin: 0px;padding: 0px;">
            <div class="col-md-12 main_padding" style="padding: 15px;">
                <div class="shadow_b" style="background-color: white;border-radius: 5px;padding: 15px;">
                    <h2><i class="fa fa-edit"></i> Manage List </h2>
                    <br>
                    <h3 style="color: #0599dd;display: flex;" class="div-wrapper">
                        <div><img src="../../images/logo/wishlist2.png" style="max-height: 45px;"> </div>
                        <div style="display: flex;align-items: center;"><?= $update_setting_row['list_name'] ?>
                            <div class="wishlist_cnt">(<?= $rowcount ?>)</div>
                        </div>
                    </h3>
                    <br>
                    <div>
                        <table style="width: 100%;" class="manage_list_table">
                            <tr class="list_items_row"
                                onclick="$('.wishlist_items_show').show();$('.settings_row_close').show();$('.wishlist_items_show_open').show();$('.settings_show').hide();$('.settings_row_open').hide();$('.wishlist_items_show_close').hide();">
                                <td style="cursor: pointer;">
                                    <h4>
                                        List Items &nbsp;<i class="fa fa-file-text-o"></i>
                                    </h4>
                                </td>
                                <td align="right">
                                    <h4>
                                        <i class="fa fa-chevron-right wishlist_items_show_close"></i>
                                        <i class="fa fa-chevron-down wishlist_items_show_open"
                                            style="display: none;"></i>
                                    </h4>
                                </td>
                            </tr>
                            <tr class="settings_row"
                                onclick="$('.settings_show').show();$('.settings_row_open').show();$('.wishlist_items_show_close').show();$('.settings_row_close').hide();$('.wishlist_items_show_open').hide();$('.wishlist_items_show').hide();">
                                <td style="cursor: pointer;">
                                    <h4>
                                        Settings &nbsp;<i class="fa fa-cog"></i>
                                    </h4>
                                </td>
                                <td align="right">
                                    <h4>
                                        <i class="fa fa-chevron-right settings_row_close"></i>
                                        <i class="fa fa-chevron-down settings_row_open" style="display: none;"></i>
                                    </h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                </div>
                <br>
            </div>
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <div style="display: none;" class="col-md-12 settings_show" style="margin:0px;padding: 15px;width: 100%;">
                <h3>Settings <i class="fa fa-cog"></i></h3>
                <form action="#" onsubmit="return update_my_list()" class=" shadow_b"
                    style="background-color: white;padding: 15px;border-radius: 5px;">
                    <table style="width: 100%;padding: 5px;" class="create_wishlist_table">
                        <tr>
                            <td>
                                <h4>
                                    Name of your list<span style="color: #c50505">*</span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group bar-srch listgrp"
                                    style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;grid-gap: 0px;">
                                    <input type="text" placeholder="Wishlist name" id="wishlist_name_input"
                                        onkeyup="changed_details()" value="<?= $update_setting_row['list_name'] ?>"
                                        name=""
                                        style="width: 100%;border-radius: 5px;outline-color: #e59700;border-top-right-radius: 0px;border-bottom-right-radius: 0px;"
                                        required="" readonly>
                                    <span id="dis_fn" class="input-group-btn">
                                        <button onclick="dis_fn()"
                                            onmouseover="$(this).css('background-color','#0c66cc')"
                                            onmouseleave="$(this).css('background-color','#0c77cc')"
                                            style="color: white;background-color:#0c77cc;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;outline: none;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-edit"></span></button>
                                    </span>
                                    <span id="hide_fn" class="input-group-btn" style="display: none;">
                                        <button onclick="reset_fn()"
                                            onmouseover="$(this).css('background-color','#bb0000')"
                                            onmouseleave="$(this).css('background-color','red')"
                                            style="color: white;background-color:red;padding-top:10px;padding-bottom: 10px;outline: none;border-top-left-radius: 0px;border-bottom-left-radius: 0px;margin-left: -1px;padding-left: 28px;"
                                            class="btn btn-default search_btn" type="button"><span class="fa fa-close"
                                                style="margin-left: -18px;"></span></button>
                                    </span>
                                    <span id="hide_fn1" style="display: none;" class="input-group-btn">
                                        <button onclick="dis_fn()"
                                            onmouseover="$(this).css('background-color','#4f994f')"
                                            onmouseleave="$(this).css('background-color','#07C103')"
                                            style="color: white;background-color:#07C103;padding-top:10px;padding-bottom: 10px;outline: none;"
                                            class="btn btn-default search_btn" type="button"><span
                                                class="fa fa-check"></span></button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    Describe your list
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!--ADDRESS-->
                                <div class="form-group listgrp"
                                    style="text-align: right;width: 100%;position: relative;">
                                    <textarea rows="4" onkeyup="changed_details()" id="wishlist_description_input"
                                        style="width: 100%;border-radius: 5px;outline-color: #e59700"
                                        placeholder="Describe your wishlist"
                                        readonly><?= $update_setting_row['wishlist_description'] ?></textarea>
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
                                <!--ADDRESS-->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    Privacy Settings<span style="color: #c50505">*</span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="div-wrapper" onclick="changed_details()"
                                    style="grid-gap: 0;margin: auto;display: flex;"><input type="radio" value="public"
                                        id="public" name="privacy"><label for="public">&nbsp;Public</label>
                                    <div><span style="font-size: 12px;color: #666">-Anyone can search for and see this
                                            list.You can also share using a link</span></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="div-wrapper" onclick="changed_details()"
                                    style="grid-gap: 0;margin: auto;display: flex;"><input type="radio" value="shared"
                                        id="shared" name="privacy"><label for="shared">&nbsp;Shared</label>
                                    <div><span style="font-size: 12px;color: #666">-Only people with the link see this
                                            list.It will not appear in public search results.</span></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" id="private" onclick="changed_details()" value="private"
                                    name="privacy"><label for="private">&nbsp;Private</label><span
                                    style="font-size: 12px;color: #666"> - Only you can see the list</span>
                            </td>
                        </tr>
                        <tr>
                            <td><br><br>
                                <center>
                                    <button
                                        style="width: 40%;color: white;padding-top: 3px;padding-bottom: 3px;float:left"
                                        type="submit" id="createlist" class="btn btn-default search" name="createlist"
                                        disabled="">
                                        <h4 style="text-transform: capitalize;">Save changes</h4>
                                    </button>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
                <br>
            </div>
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <!----------------------------------------------------------------------------------------------------------------------------->
            <div class="col-md-12 wishlist_items_show"
                style="margin:0px;padding: 0px; padding-left: 15px;padding-right: 15px;">
                <h3>List Items <i class="fa fa-file-text-o"></i></h3>
                <?php
                //Generate Dynamic Loading
                function randomGen($min, $max, $quantity)
                {
                    $numbers = range($min, $max);
                    shuffle($numbers);
                    return array_slice($numbers, 0, $quantity);
                }
                //Generate Dynamic Loading
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $sqlc = "select * from wishlist_items where wishlist_id=:wid";
                    $stmtc = $pdo->prepare($sqlc);
                    $stmtc->execute(array(
                        ':wid' => $wishlist_id
                    ));
                    $rowc = $stmtc->fetch(PDO::FETCH_ASSOC);
                    if ($rowc) {
                        ?>
                <div class="col-md-12" style="margin:0px;padding: 0px;">
                    <div class="product-content-right nopadding-margin"
                        style="margin:0px;padding: 0px;margin-right:0px;background-color: white;border-radius: 10px;">
                        <h2 class="sidebar-title"
                            style="border-left: 5px solid #c50505;border-top-left-radius: 10px;text-align: left;padding-bottom: 30px;padding-top: 20px;background-color: white;margin-top: 0px;font-weight:normal;border-bottom:#333;margin-bottom: 0px;border-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; ">
                            Wish List <i style="color: red" class="fa fa-heart"></i>
                            <span style="float: right;margin-right: 5px;margin-top: -16px;">
                                <input type="button"
                                    style="max-width: 150px;height: 60px;font-weight: bold;border-top-right-radius: 10px;background-color: #c50505"
                                    onclick="updateall_cart()" value="Move to cart" id="proceed" name="proceed"
                                    class="checkout-button button alt wc-forward">
                            </span>
                        </h2>
                        <hr class="make_divc" style="margin-bottom: 0px;margin-top: -10px;">
                        <div class="woocommerce" style="padding: 0;">
                            <form method="post" action="#" class="hidescroll" style="overflow-x: hidden;width: 100%">
                                <?php
                                $id = $_SESSION['id'];
                                $sql1 = "select * from wishlist_items where wishlist_id=:wid order by item_description_id";
                                $stmt1 = $pdo->prepare($sql1);
                                $stmt1->execute(array(
                                    ':wid' => $wishlist_id
                                ));
                                $dup = array();
                                if (isset($dup)) {
                                    unset($dup);
                                }
                                $flag = 0;
                                $item_cnt = 0;
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    $wishlist_items_id = $row1['wishlist_items_id'];
                                    $item_description_id = $row1['item_description_id'];
                                    $store_id = $row1['store_id'];
                                    $n = 0;
                                    $sql2 = "select * from item inner join category on category.category_id=item.category_id
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
                                    $mrpsql = "select item.price from item inner join item_description on item_description.item_id=item.item_id where item_description.item_description_id=$item_description_id";
                                    $mrpstmt = $pdo->query($mrpsql);
                                    $mrprow = $mrpstmt->fetch(PDO::FETCH_ASSOC);
                                    $t_mrp = $mrprow['price'];
                                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                        $total = $row2['price'] * $row1['quantity'];
                                        $save = ($t_mrp * $row1['quantity']) - $total;
                                        $off = round(($save * 100) / $total);
                                        $subcat = $row2['sub_category_name'];
                                        if ($flag == 2) {
                                            $flag == 0;
                                        }
                                        if ($flag == 0) {
                                            ?>
                                <div class="container" style="padding: 0px;margin:0;width: 100%">
                                    <div class="row" style="padding: 0;margin:0;width: 100%;">
                                        <div class="col-md-12 shop_table cart"
                                            style="background-color: :#fff;margin: 0px;margin-top: -28px;padding: 0;width: 100%;">
                                            <?php
                                        }
                                        ?>
                                            <div style="margin-top: 0px;margin-right: 0px;padding: 0;border-right: 2px solid #a2a3a4"
                                                class="col-md-6 tbl_wi<?= $wishlist_items_id ?>">
                                                <div style="font-weight: bold;padding: 0;"
                                                    class="tbl_wi<?= $wishlist_items_id ?> col-md-12">
                                                    <div style="padding: 0px;"
                                                        class="tbl_wi<?= $wishlist_items_id ?> col-md-12">
                                                        <div class="product-name col-md-12" colspan="2"
                                                            style="padding: 0px;margin-top: 5px;">
                                                            <p style="margin:0px;margin-bottom: 20px;font-size:17px;">
                                                            <div
                                                                style="margin-left: 0px;background-color: #02171e;padding-left: 15px;padding-right:15px;width: 100%;border-radius: 2px;margin-bottom: -8px;padding-top:8px;padding-bottom:8px;text-align:justify">
                                                                <?php
                                                                if (strlen($row2['item_name']) >= 50) {
                                                                    $item_name = substr($row2['item_name'], 0, 50);
                                                                    $item_name2 = $item_name . "...";
                                                                } else {
                                                                    $item_name2 = $row2['item_name'];
                                                                }
                                                                ?>
                                                                <a href="#"
                                                                    style="color: white;font-weight: normal;text-align:justify;font-size:17px;"><i
                                                                        class="fa fa-product-hunt" style=""></i>
                                                                    <?= $item_name2 ?>
                                                                </a>
                                                            </div>
                                                            </p>
                                                        </div>
                                                        <div class="cart_item col-md-12"
                                                            style=" background-color: #fff">
                                                            <div class="div-wrapper height_setter"
                                                                style="height: 250px;">
                                                                <div class="img_check_big col-md-5"
                                                                    style="padding: 0px;">
                                                                    <div style="width: 180px;margin-top: 5px;"
                                                                        class="tbl_wi<?= $wishlist_items_id ?>">
                                                                        <div class="product-quantity quantity buttons_added"
                                                                            style="justify-content: center;display: flex;text-align: center;align-items: center;position: relative;margin-right: 0px">
                                                                            <div class="product_img div-wrapper"
                                                                                style="padding: 0px; margin-top: 7px;margin-left: 15px;grid-gap: 10px;">
                                                                                <input style="display:none"
                                                                                    id="check_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    type="checkbox" name="select_item">
                                                                                <p class="product-thumbnail"
                                                                                    style="text-align:right;">
                                                                                    <a
                                                                                        href="../Product/single.php?id=<?= $row2['item_description_id'] ?>">
                                                                                        <img style="max-width:180px;max-height:180px;"
                                                                                            alt="<?= $row2['item_name'] ?>"
                                                                                            class="shop_thumbnail"
                                                                                            src="../../images/<?= $row2['category_id'] ?>/<?= $row2['sub_category_id'] ?>/<?= $row2['item_description_id'] ?>.jpg">
                                                                                    </a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tbl_wi<?= $wishlist_items_id ?> item_description_td col-md-7 product-img"
                                                                    style="padding:0;">
                                                                    <div class=" full-size-cart-store-div"
                                                                        style="padding: 0px;margin-left: 20px;width: 200px;">
                                                                        <p
                                                                            style="z-index: 1;text-align:left;margin-top: 15px;">
                                                                            <span
                                                                                style='font-family: arial;color:#006904;font-weight: bold;text-decoration: none;font-size: 12px'>You
                                                                                Save &#8377; <span
                                                                                    id="save_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    style="text-decoration: none;font-weight: bold;color: #006904;padding-left: 0px">
                                                                                    <?= $save ?>
                                                                                </span> (<span
                                                                                    style="text-decoration: none;font-weight: bold;color: #006904;padding-left: 0px"
                                                                                    id="off_s<?= $store_id . "i" . $item_description_id ?>">
                                                                                    <?= $off ?>
                                                                                </span>%)
                                                                            </span>
                                                                        </p>
                                                                        <p class="product-price"
                                                                            style="z-index: 1;text-align:left;margin-top: 10px;;font-weight: bold;font-size: 2vw">
                                                                            <span class="amount">&#8377;<span
                                                                                    id="total_s<?= $store_id . "i" . $item_description_id ?>">
                                                                                    <?= $total ?>
                                                                                </span> <i style="color: #303030"
                                                                                    class="fa fa-tags">&nbsp;<del
                                                                                        style="color: #999;font-weight:normal;font-size: 13px;">&#8377;</del></i><del
                                                                                    style="color: #999;font-weight:normal;font-size: 13px;"
                                                                                    id="mrp_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    style="text-decoration:">
                                                                                    <?= (int) $t_mrp * (int) $row1['quantity'] ?>
                                                                                </del></span>
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <!--FEATURES-->
                                                                                        <ul>
                                                                                            <li class="large_specs_seen"><span
                                                                                                    class="a-list-item">
                                                                                                    <span
                                                                                                        class="a-size-small a-color-success sc-product-availability"><b
                                                                                                            style="color:#86001d;">In
                                                                                                            stock</b></span>
                                                                                                </span>
                                                                                            </li>
                                                                                            <p class="large_specs_seen">
                                                                                                <img alt=""
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
                                                                                            $features = array('size', 'color', 'weight', 'flavour', 'processor', 'display', 'battery', 'Internal_storage', 'brand', 'material', 'price', 'quantity');
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
                                                                                            ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div width="100%" class="tbl_wi<?= $wishlist_items_id ?>">
                                                                                <div class="product-quantity quantity buttons_added big_bottom_pdt_dtls"
                                                                                    style="margin-right: 0px;width: 100%">
                                                                                    <div>
                                                                                        <p class="product-subtotal"
                                                                                            style="bottom: 0px;margin-left: 15px;float: left;font-weight: bold;">
                                                                                            Price
                                                                                            <span class="amount">&#8377;<span
                                                                                                    id="price_s<?= $store_id . "i" . $item_description_id ?>"><?= $row2['price'] ?></span><span>/-</span>
                                                                                                (1 Qty) |</span>
                                                                                        </p>
                                                                                    </div>
                                                                                    <div>
                                                                                        <p class="product-store"><i
                                                                                                style="color: #303030;bottom: 0px;margin-top: 2px;margin-left: 5px;"
                                                                                                class="fas fa-store">&nbsp;</i>
                                                                                            <a title="<?= $row2['store_name'] ?>"
                                                                                                href="#"><?= $row2['store_name'] ?></a>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div width="100%" class="tbl_wi<?= $wishlist_items_id ?>">
                                                                                <div class="shadow_b div-wrapper"
                                                                                    style="grid-gap: 0px;width: 100%;">
                                                                                    <div style="padding: 0px;width: 100%"
                                                                                        class="col-md-6 ">
                                                                                        <button type="button"
                                                                                            onclick="updatecart(<?= $item_description_id ?>,<?= $store_id ?>)"
                                                                                            title="Add to wish list"
                                                                                            style="width: 100%;height: 40px;background-color: #f6f6f6;border: 0px solid #999;outline: none;font-weight: bold;-webkit-box-shadow: inset -1px 1px 15px 3px #bbb;box-shadow: inset -1px 1px 15px 3px #ccc;"><i
                                                                                                class="fa fa trash"></i> Add to Cart <i
                                                                                                style="color: red"
                                                                                                class="fa fa-shopping-cart fa-lg"></i></button>
                                                                                    </div>
                                                                                    <div class="product-remove col-md-6"
                                                                                        style="padding: 0px;width: 100%;">
                                                                                        <button type="button" title="Remove this item"
                                                                                            style="width: 100%;height: 40px;border:none;border-color: #fff;color: #fff;background-color: #c50505;outline: none;-webkit-box-shadow: inset -1px 1px 15px 3px #76001d;box-shadow: inset -1px 1px 15px 3px #86001d;"
                                                                                            class="remove"
                                                                                            onclick="remove_item('<?= $row1['wishlist_items_id'] ?>')"
                                                                                            href="#"><b>Remove </b><i
                                                                                                class="fas fa-trash-alt"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $item_cnt++;
                                                            $flag++;
                                                            $sql_single_div = "select COUNT(wishlist_items_id) as checksingle from wishlist_items where wishlist_id=:wishlist_id";
                                                            $stmt_single_div = $pdo->prepare($sql_single_div);
                                                            $stmt_single_div->execute(array(
                                                                ':wishlist_id' => $wishlist_id
                                                            ));
                                                            $row_single_div = $stmt_single_div->fetch(PDO::FETCH_ASSOC);
                                                            $rowcount = $row_single_div['checksingle'];
                                                            if ($flag == 2 || $rowcount == 1) {
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                    }
                                    ?>
                                            <?php
                                }
                                ?>
                                    </form>
                                </div>
                                <hr class="make_divc" style="margin-top: 40px;margin-bottom: 20px;"> <br>
                            </div>
                        </div>
                        <!------------------------------------------------------------------------------------------------------------------------------>
                        <!--SMALL-->
                        <!------------------------------------------------------------------------------------------------------------------------------>
                        <div class="row" style="margin:0px;padding: 0px">
                            <div class="col-md-9" style="margin:0px;padding: 0px"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="col-md-4 small" id="small_screen" style="margin:0px;padding: 0px"></div>
                        <center style="margin-bottom:0px;margin-top: 50px;">
                            <h4>Need more ?<a href="../Main/onestore.php"> Start adding!</a></h4>
                        </center>
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
                                <center><img style="justify-content: center;max-height: 288px;" class="sidebar-title"
                                        src="../../images/logo/wishlist.png">
                                    <h2 class="sidebar-title"
                                        style="text-align: center;display: inline-flex;font-weight: 600;color:#c50505">Your Wish
                                        List is Empty</h2>
                                    <h4>No items in your wishlist.<a href="../Main/onestore.php">Start adding!</a></h4>
                                </center>
                            </div>
                            <div class="element_grid">
                                <div class="shadow_b">
                                    <h4 class="show_cat_list_main tb-padding sidebar-title cart_empty_show_cat"
                                        style="border-left: 5px solid <?= $bgcolor[$rancolor1] ?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 18px;">
                                        <?= $sub_cat_name1 ?> <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
                                        <span style="float: right;margin-right: 5px;margin-top: -4px;">
                                            <button type="button"
                                                style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?= $bgcolor[$rancolor1] ?>;padding: 11px auto;font-size: 12px;"
                                                name="proceed" class="checkout-button button alt wc-forward"><a href=""
                                                    style="color:<?= $c1 ?>;">View all</a></button>
                                        </span>
                                    </h4>
                                    <hr style="padding: 0;margin:0;">
                                    <div class="scrollmenu bl_item_scroll  <?= $color[$rancolor1] ?>"
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
                                                    title="<?= $row1['item_name'] ?> " alt=" <?= $row1['item_name'] ?>"
                                                    class="new_size"
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
                                                name="proceed" class="checkout-button button alt wc-forward"><a href=""
                                                    style="color:<?= $c2 ?>;">View all</a></button>
                                        </span>
                                    </h4>
                                    <hr style="padding: 0;margin:0;">
                                    <div class="scrollmenu mui_item_scroll <?= $color[$rancolor2] ?> "
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
                                                    title="<?= $row1['item_name'] ?> " alt=" <?= $row1['item_name'] ?>"
                                                    class="new_size"
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
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!--LARGE-->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<?php
require "../Main/footer.php";
?>
<script type="text/javascript">
    function update_my_list() {
        var listname = document.getElementById('wishlist_name_input').value;
        var listdescription = document.getElementById('wishlist_description_input').value;
        var wishlist_id =<?= $_GET['wishlist_id'] ?>;
        var privacy_check = document.getElementsByName('privacy');
        for (i = 0; i < privacy_check.length; i++) {
            if (privacy_check[i].checked) {
                var privacy = privacy_check[i].value;
            }
        }
        Swal.fire({
            text: "Updating your list  !!!",
            icon: "warning",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: 'red',
            allowOutsideClick: false,
            confirmButtonText: '<i class="fa fa-close"></i> Close',
            cancelButtonColor: 'green',
            cancelButtonText: '<i class="fa fa-check"></i> OK'
        })
            .then((willSubmit) => {
                if (willSubmit.dismiss) {
                    $.ajax({
                        url: "../Common/functions.php", //passing page info
                        data: { "update_list": 1, "listname": listname, "listdescription": listdescription, "privacy": privacy, "wishlist_id": wishlist_id },  //form data
                        type: "post",   //post data
                        dataType: "json",   //datatype=json format
                        timeout: 30000,   //waiting time 30 sec
                        success: function (data) {    //if registration is success
                            if (data.status == 'success') {
                                swal({
                                    title: "Updated!!!",
                                    dangerMode: true,
                                    icon: "success",
                                    timer: 6000,
                                });
                                return;
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
                else if (willSubmit.isConfirmed) { return false; }
            });
        return false;
    }
    function changed_details() {
        $('#createlist').prop('disabled', false);
        listenchanges();
    }
    function succeeded() {
        var wishlist_name_input = document.getElementById("wishlist_name_input").value;
        var oldwishlist_name_input = '<?= $update_setting_row['list_name'] ?>';
        var wishlist_description_input = document.getElementById("wishlist_description_input").value;
        var oldwishlist_description_input = '<?= $update_setting_row['wishlist_description'] ?>';
        //CHECK BOX LISTENING CHANGES
        var privacy_checked = document.getElementsByName('privacy');
        for (i = 0; i < privacy_checked.length; i++) {
            if (privacy_checked[i].checked) {
                var curr_privacy = privacy_checked[i].value;
            }
        }
        var oldprivacy = "<?= $update_setting_row['privacy'] ?>";
        //CHECK BOX LISTENING CHANGES
        if (oldwishlist_description_input == "" || oldwishlist_description_input == null) {
            if ((wishlist_description_input != "") || (wishlist_description_input != null) || (wishlist_name_input != oldwishlist_name_input) || (curr_privacy != oldprivacy)) {
                $('#createlist').prop('disabled', false);
            }
            else if ((wishlist_description_input == oldwishlist_description_input) && (wishlist_name_input == oldwishlist_name_input) && (curr_privacy == oldprivacy)) {
                $('#createlist').prop('disabled', true);
            }
        }
        else {
            if ((wishlist_name_input != oldwishlist_name_input) || (wishlist_description_input != oldwishlist_description_input) || (curr_privacy != oldprivacy)) {
                $('#createlist').prop('disabled', false);
            }
            else if ((wishlist_name_input == oldwishlist_name_input) && (wishlist_description_input == oldwishlist_description_input) && (curr_privacy == oldprivacy)) {
                $('#createlist').prop('disabled', true);
            }
        }
        function privacycheck() {
            if (curr_privacy != oldprivacy) {
                $('#createlist').prop('disabled', false);
            }
            else if (curr_privacy == oldprivacy) {
                $('#createlist').prop('disabled', true);
            }
        }
    }
    function listenchanges() {
        var wishlist_name_input = document.getElementById("wishlist_name_input").value;
        var oldwishlist_name_input = '<?= $update_setting_row['list_name'] ?>';
        var wishlist_description_input = document.getElementById("wishlist_description_input").value;
        var oldwishlist_description_input = '<?= $update_setting_row['wishlist_description'] ?>';
        //name--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_fn').css('display') == 'none') {
            if (wishlist_name_input != oldwishlist_name_input) {
                $('#hide_fn').show();
                $('#hide_fn1').show();
            }
            else if (wishlist_name_input == oldwishlist_name_input) {
                $('#hide_fn').show();
                $('#hide_fn1').hide();
            }
        }
        //descibe--------------------------------------------------------------------------------------------------------------------------------------
        if ($('#dis_add').css('display') == 'none') {
            if (oldwishlist_description_input == "" || oldwishlist_description_input == null) {
                if ((wishlist_description_input != "") || (wishlist_description_input != null)) {
                    $('#hide_add').show();
                    $('#hide_add1').show();
                }
                else if ((wishlist_description_input == "") || (wishlist_description_input == null)) {
                    $('#hide_add').show();
                    $('#hide_add1').hide();
                }
            }
            else {
                if (wishlist_description_input != oldwishlist_description_input) {
                    $('#hide_add').show();
                    $('#hide_add1').show();
                }
                else if (wishlist_description_input == oldwishlist_description_input) {
                    $('#hide_add').show();
                    $('#hide_add1').hide();
                }
            }
        }
        succeeded();
    }
    function dis_fn() {
        var wishlist_name_input = document.getElementById("wishlist_name_input").value;
        var oldwishlist_name_input = '<?= $update_setting_row['list_name'] ?>';
        if ($('#hide_fn').css('display') == 'none') {
            if (wishlist_name_input == oldwishlist_name_input) {
                $('#dis_fn').hide();
                $('#hide_fn').show();
            }
            if (wishlist_name_input != oldwishlist_name_input) {
                $('#dis_fn').hide();
                $('#hide_fn').show();
                $('#hide_fn1').show();
            }
            document.getElementById("wishlist_name_input").readOnly = false;
            document.getElementById("wishlist_name_input").focus();
            var updatedetailInput = $("#wishlist_name_input");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_fn').show();
            $('#hide_fn').hide();
            $('#hide_fn1').hide();
            document.getElementById("wishlist_name_input").readOnly = true;
        }
        succeeded();
    }
    function reset_fn() {
        var wishlist_name_input = document.getElementById("wishlist_name_input").value;
        var oldwishlist_name_input = '<?= $update_setting_row['list_name'] ?>';
        if (($('#hide_fn').css('display') != 'none') && ($('#hide_fn1').css('display') != 'none')) {
            $('#dis_fn').show();
            $('#hide_fn').hide();
            $('#hide_fn1').hide();
        }
        else if (($('#hide_fn').css('display') != 'none') && ($('#hide_fn1').css('display') == 'none')) {
            $('#dis_fn').show();
            $('#hide_fn').hide();
        }
        document.getElementById("wishlist_name_input").value = oldwishlist_name_input;
        document.getElementById("wishlist_name_input").readOnly = true;
        succeeded();
    }
    function dis_add() {
        var wishlist_description_input = document.getElementById("wishlist_description_input").value;
        var oldwishlist_description_input = '<?= $update_setting_row['wishlist_description'] ?>';
        if ($('#hide_add').css('display') == 'none') {
            if (oldwishlist_description_input == "" || oldwishlist_description_input == null) {
                if ((wishlist_description_input != "") || (wishlist_description_input != null)) {
                    $('#dis_add').hide();
                    $('#hide_add').show();
                    $('#hide_add1').show();
                }
                else if ((wishlist_description_input == "") || (wishlist_description_input == null)) {
                    $('#dis_add').hide();
                    $('#hide_add').show();
                }
            }
            else {
                if (wishlist_description_input == oldwishlist_description_input) {
                    $('#dis_add').hide();
                    $('#hide_add').show();
                }
                if (wishlist_description_input != oldwishlist_description_input) {
                    $('#dis_add').hide();
                    $('#hide_add').show();
                    $('#hide_add1').show();
                }
            }
            document.getElementById("wishlist_description_input").readOnly = false;
            document.getElementById("wishlist_description_input").focus();
            var updatedetailInput = $("#wishlist_description_input");
            updatedetailInput.putCursorAtEnd().on("focus", function () {
                updatedetailInput.putCursorAtEnd()
            });
        }
        else {
            $('#dis_add').show();
            $('#hide_add').hide();
            $('#hide_add1').hide();
            document.getElementById("wishlist_description_input").readOnly = true;
        }
        succeeded();
    }
    function reset_add() {
        var wishlist_description_input = document.getElementById("wishlist_description_input").value;
        var oldwishlist_description_input = '<?= $update_setting_row['wishlist_description'] ?>';
        if (($('#hide_add').css('display') != 'none') && ($('#hide_add1').css('display') != 'none')) {
            $('#dis_add').show();
            $('#hide_add').hide();
            $('#hide_add1').hide();
        }
        else if (($('#hide_add').css('display') != 'none') && ($('#hide_add1').css('display') == 'none')) {
            $('#dis_add').show();
            $('#hide_add').hide();
        }
        document.getElementById("wishlist_description_input").value = oldwishlist_description_input;
        document.getElementById("wishlist_description_input").readOnly = true;
        succeeded();
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //UPDATEALL CART
    function updatecart(idid, sid) {
        var item_description_id = idid;
        var store_id = sid;
        $n = 0;
        var total_amt = document.getElementById('total_s' + store_id + "i" + item_description_id + '').innerHTML;
        //1=booking;2=cash_on_delivery
        var order_type = 'booked';
        var id =<?= $id ?>;
        $.ajax({
            url: "../Common/functions.php", //passing page info
            data: { "update_user_cart": 1, "item_description_id": item_description_id, "store_id": store_id, "quantity": 1, "total_amt": total_amt, "order_type": order_type },  //form data
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
    //UPDATEALL CART
    function updateall_cart() {
        <?php
        if (isset($id)) {
            $sql1 = "select * from wishlist_items where wishlist_id=:wid order by item_description_id";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute(array(
                ':wid' => $wishlist_id
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
            $sql2 = "select * from item inner join category on category.category_id=item.category_id
        inner join sub_category on category.category_id=sub_category.category_id
        inner join item_description on item_description.item_id=item.item_id
        inner join product_details on item_description.item_description_id=product_details.item_description_id
        inner join store on store.store_id=product_details.store_id
        where item.sub_category_id=sub_category.sub_category_id and item.item_id=:item_description_id and product_details.store_id=:store_id order by item_description.item_description_id";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute(array(
                ':item_description_id' => $item_description_id,
                ':store_id' => $store_id
            ));
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $subcat = $row2['sub_category_name'];
                ?>
        var total_amt = document.getElementById('total_s' + '<?= $store_id . "i" . $item_description_id ?>').innerHTML;
                //1=booking;2=cash_on_delivery
                var order_type = 'booked';
                var id =<?= $id ?>;
                var item_description_id =<?= $item_description_id ?>;
                var store_id =<?= $store_id ?>;
                $.ajax({
                    url: "../Common/functions.php", //passing page info
                    data: { "update_user_cart": 1, "item_description_id": item_description_id, "store_id": store_id, "quantity": 1, "total_amt": total_amt, "order_type": order_type },  //form data
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
    function remove_item(wishlist_items_id) {
        var wishlist_items_id = wishlist_items_id;
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
                        data: { "wishlist_remove_item": 1, "wishlist_items_id": wishlist_items_id },  //form data
                        type: "post",   //post data
                        dataType: "json",   //datatype=json format
                        timeout: 30000,   //waiting time 30 sec
                        success: function (data) {    //if registration is success
                            if (data.status == 'success') {
                                if (data.cartcnt == 0) {
                                    swal({
                                        title: "Empty!!!",
                                        text: "Your list is empty",
                                        icon: "warning",
                                        closeOnClickOutside: false,
                                        dangerMode: true,
                                    })
                                        .then((willSubmit1) => {
                                            if (willSubmit1) {
                                                location.href = "../Wishlist/wishlist_single.php";
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
            remove_item(store_id, item_id);
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
    selected = "<?= $row1['quantity'] ?>"
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function sub_item_all(store_id, item_id, tmrp) {
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
    function add_item_all(store_id, item_id, tmrp) {
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