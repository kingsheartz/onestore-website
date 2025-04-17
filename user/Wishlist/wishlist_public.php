<?php
require "../Common/pdo.php";
if (isset($_GET['wishlist_id'])) {
    $wishlist_id = $_GET['wishlist_id'];
    $sqlc1 = "select user_id from wishlist where wishlist_id=:wid";
    $stmtc1 = $pdo->prepare($sqlc1);
    $stmtc1->execute(array(
        ':wid' => $wishlist_id
    ));
    $rowc1 = $stmtc1->fetch(PDO::FETCH_ASSOC);
    $sqlc2 = "select first_name from users where user_id=:uid";
    $stmtc2 = $pdo->prepare($sqlc2);
    $stmtc2->execute(array(
        ':uid' => $rowc1['user_id']
    ));
    $rowc2 = $stmtc2->fetch(PDO::FETCH_ASSOC);
} else {
    header("location:../Wishlist/wishlist.php");
    return;
}
require "../Main/header.php";
?>
<!-- breadcrumbs -->
<div class="breadcrumbs" style="background-color: #eaeded">
    <div class="container">
        <ol class="breadcrumb breadcrumb1" style="background-color: #eaeded">
            <li><a href="../Main/onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
            </li>
            <li class="active" style="text-transform: capitalize;">Wish list of <?= $rowc2['first_name'] ?></li>
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
</style>
<div class="single-product-area" style="padding-top: 0px; background-color: #eaeded;padding-bottom: 0px;">
    <div class="zigzag-bottom"></div>
    <div class="container nopadding-margin" style="margin-left: 0px;width: 100%;padding-bottom: 40px;">
        <div class="row" style="margin: 0px;">
            <div class="col-md-12" style="margin:0px;padding: 0px;width: 100%">
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                }
                $sqlc = "select * from wishlist_items where wishlist_id=:wid";
                $stmtc = $pdo->prepare($sqlc);
                $stmtc->execute(array(
                    ':wid' => $wishlist_id
                ));
                $rowc = $stmtc->fetch(PDO::FETCH_ASSOC);
                if ($rowc) {
                    ?>
                    <div class="col-md-12" style="margin:0px;padding: 0px;margin: 0px;">
                        <div class="product-content-right nopadding-margin"
                            style="margin:0px;padding: 0px;margin-right: 10px;background-color: white;border-radius: 10px;width: 100%;">
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
                            <div class="woocommerce">
                                <form method="post" action="#" class="hidescroll" style="overflow-x: hidden;">
                                    <table class="shop_table cart" border="0px"
                                        style="background-color:#ffffff;margin: 0px;margin-top: -20px">
                                        <tr>
                                            <?php
                                            $sql1 = "select * from wishlist_items where wishlist_id=:wid order by item_description_id";
                                            $stmt1 = $pdo->prepare($sql1);
                                            $stmt1->execute(array(
                                                ':wid' => $wishlist_id
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
       where item.sub_category_id=sub_category.sub_category_id and item_description.item_description_id=:item_description_id and product_details.store_id=:store_id order by item_description.item_description_id";
                                                $stmt2 = $pdo->prepare($sql2);
                                                $stmt2->execute(array(
                                                    ':item_description_id' => $item_description_id,
                                                    ':store_id' => $store_id
                                                ));
                                                $mrpsql = "select price from item where item_id=$item_description_id";
                                                $mrpstmt = $pdo->query($mrpsql);
                                                $mrprow = $mrpstmt->fetch(PDO::FETCH_ASSOC);
                                                $t_mrp = $mrprow['price'];
                                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
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
                                                                                style="margin-left: 0px;background-color: #02171e;padding-left: 15px;padding-right:15px;width: 100%;border-radius: 2px;margin-bottom: -8px;padding-top:8px;padding-bottom:8px;text-align:justify">
                                                                                <a href="#"
                                                                                    style="color: white;font-weight: normal;text-align:justify;font-size:17px;"><i
                                                                                        class="fa fa-product-hunt" style=""></i>
                                                                                    <?= $row2['item_name'] ?></a>
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
                                                                                        <input style="display:none"
                                                                                            id="check_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                            type="checkbox" name="select_item">
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
                                                                                    <td>
                                                                                        <div class="row"
                                                                                            style="margin-left: 5px;float: left;">
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
                                                                                                        <option
                                                                                                            style="background-color: white;color:#006904;font-weight: bold;text-align: center; "
                                                                                                            value="1">Booking
                                                                                                        </option>
                                                                                                        <option
                                                                                                            style="background-color: white;color:#006904;font-weight: bold;text-align: center;"
                                                                                                            value="2">delivery
                                                                                                        </option>
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
                                                                                                if (strlen($row2['description']) >= 300) {
                                                                                                    $description = substr($row2['description'], 0, 300);
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
                                                                                    onclick="$(this).hide();if($(this).html()<10){$('#sel_s<?= $store_id . "i" . $item_description_id ?>').show();}else{$('#qnty_s<?= $store_id . "i" . $item_description_id ?>').show();}">1</button>
                                                                                <select
                                                                                    id="sel_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                    onchange="select_item_option('<?= $store_id ?>','<?= $item_description_id ?>','<?= $t_mrp ?>');"
                                                                                    name="quantity" autocomplete="off"
                                                                                    style="width: 100%;min-width: 50px;bottom: 0;box-shadow: none;outline: none;border-color:#aaa;height:40px;display: none;background-color: white">
                                                                                    <option value="1"
                                                                                        id="sel_opt_s<?= $store_id . "i" . $item_description_id ?>"
                                                                                        selected disabled>1</option>
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
                                                                        <button type="button"
                                                                            onclick="updatecart(<?= $item_description_id ?>,<?= $store_id ?>)"
                                                                            title="Add to wish list"
                                                                            style="width: 100%;height: 40px;background-color: #f6f6f6;border: 0px solid #999;outline: none;font-weight: bold;-webkit-box-shadow: inset -1px 1px 15px 3px #bbb;box-shadow: inset -1px 1px 15px 3px #ccc;"><i
                                                                                class="fa fa trash"></i> Add to Cart <i
                                                                                style="color: #ff5722"
                                                                                class="fa fa-shopping-cart fa-lg"></i></button>
                                                                    </td>
                                                                    <td class="product-remove"
                                                                        style="padding: 0px;width: 45%;">
                                                                        <button type="button" title="Buy this item"
                                                                            style="width: 100%;height: 40px;border:none;border-color: #fff;color: #fff;background-color: #c50505;outline: none;-webkit-box-shadow: inset -1px 1px 15px 3px #76001d;box-shadow: inset -1px 1px 15px 3px #86001d;"
                                                                            class="remove"
                                                                            onclick="location.href='../Checkout/checkoutsingle.php?store_id=<?= $store_id ?>&item_description_id=<?= $item_description_id ?>';"
                                                                            href="#"><b>Buy Now </b><i
                                                                                class="fas fa-flash"></i></button>
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
                                <hr class="make_divc" style="margin-top: 40px;margin-bottom: 20px;">
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
                <!--LARGE-->
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
                        <center><img style="justify-content: center;max-height: 288px;" class="sidebar-title"
                                src="../../images/logo/wishlist.png">
                            <h2 class="sidebar-title"
                                style="text-align: center;display: inline-flex;font-weight: 600;color:#c50505">This Wish
                                List is Empty</h2>
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
                                            title="<?= $row1['item_name'] ?> " alt=" <?= $row1['item_name'] ?>" class="new_size"
                                            src="../../images/<?= $row1['category_id'] ?>/<?= $row1['sub_category_id'] ?>/<?= $row1['item_description_id'] ?>.jpg"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <div class="col-md-4 small" id="small_screen"></div>
                <?php
                }
                ?>
            <div class="container" style="width: 100%;background-color: #fff;margin-top: 15px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cart-collaterals">
                            <div class="cart_totals " style="width: 100%">
                                <h2>You may be interested in...</h2>
                                <div class="agile_top_brands_grids" style="overflow-x: scroll;">
                                    <?php
                                    $it_id = 1;
                                    $n = 0;
                                    $sql5 = "select * from item
                                    inner join category on category.category_id=item.category_id
                                    inner join sub_category on category.category_id=sub_category.category_id
                                    inner join item_description on item.item_id=item_description.item_id
                                    inner join product_details on product_details.item_description_id=item_description.item_description_id
                                    where item.sub_category_id=sub_category.sub_category_id and item.item_id=$it_id ";
                                    //Generate Dynamic Loading
                                    function randomGen($min, $max, $quantity)
                                    {
                                        $numbers = range($min, $max);
                                        shuffle($numbers);
                                        return array_slice($numbers, 0, $quantity);
                                    }
                                    //Generate Dynamic Loading
                                    $stmt5 = $pdo->query($sql5);
                                    $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
                                    $subcat = $row5['sub_category_name'];
                                    $r1 = $pdo->query("select MIN(item_description_id) from item_description
                                        inner join item on item.item_id=item_description.item_id
                                        inner join category on category.category_id=item.category_id
                                        inner join sub_category on category.category_id=sub_category.category_id
                                        where item.sub_category_id=sub_category.sub_category_id and sub_category.sub_category_name= '$subcat'");
                                    $id1 = $r1->fetch(PDO::FETCH_ASSOC);
                                    $r2 = $pdo->query("select MAX(item_description_id) from item_description
                                        inner join item on item.item_id=item_description.item_id
                                        inner join category on category.category_id=item.category_id
                                        inner join sub_category on category.category_id=sub_category.category_id
                                        where item.sub_category_id=sub_category.sub_category_id and sub_category.sub_category_name= '$subcat' ");
                                    $id2 = $r2->fetch(PDO::FETCH_ASSOC);
                                    $cn = 0;
                                    $ran = randomGen($id1['MIN(item_description_id)'], $id2['MAX(item_description_id)'], (int) $id2['MAX(item_description_id)'] - (int) $id1['MIN(item_description_id)']);
                                    while ($cn != 3) {
                                        $r = $pdo->query("select * from item inner join item_description on item.item_id=item_description.item_id where item_description_id= $ran[$cn]");
                                        $rw = $r->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <div class="col-md-3 top_brand_left-1">
                                            <div class="hover14 column">
                                                <div class="agile_top_brand_left_grid">
                                                    <div class="agile_top_brand_left_grid_pos">
                                                        <img src="../../images/offer.png" alt=" " class="img-responsive">
                                                    </div>
                                                    <div class="agile_top_brand_left_grid1">
                                                        <figure>
                                                            <div class="snipcart-item block" style="height: 330px">
                                                                <div class="snipcart-thumb" style="height: 320px">
                                                                    <a
                                                                        href="../Product/single.php?id=<?= $rw['item_id'] ?>"><img
                                                                            title=" " alt=" " style="height: 100px;"
                                                                            class="new_size"
                                                                            src="../../images/<?= $rw['category_id'] ?>/<?= $rw['sub_category_id'] ?>/<?= $rw['item_description_id'] ?>.jpg"></a>
                                                                    <p style="height: 70px;"><?= $rw['item_name'] ?></p>
                                                                    <div class="stars">
                                                                        <i class="fa fa-star blue-star"
                                                                            aria-hidden="true"></i>
                                                                        <i class="fa fa-star blue-star"
                                                                            aria-hidden="true"></i>
                                                                        <i class="fa fa-star blue-star"
                                                                            aria-hidden="true"></i>
                                                                        <i class="fa fa-star blue-star"
                                                                            aria-hidden="true"></i>
                                                                        <i class="fa fa-star gray-star"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <h4>$35.99 <span>$55.00</span></h4>
                                                                </div>
                                                                <div class="snipcart-details top_brand_home_details"
                                                                    style="margin-top: -30px;">
                                                                    <form action="#" method="post">
                                                                        <fieldset>
                                                                            <input type="hidden" name="cmd" value="_cart">
                                                                            <input type="hidden" name="add" value="1">
                                                                            <input type="hidden" name="business" value=" ">
                                                                            <input type="hidden" name="item_name"
                                                                                value="<?= $rw['item_name'] ?>">
                                                                            <input type="hidden" name="amount"
                                                                                value="35.99">
                                                                            <input type="hidden" name="discount_amount"
                                                                                value="1.00">
                                                                            <input type="hidden" name="currency_code"
                                                                                value="USD">
                                                                            <input type="hidden" name="return" value=" ">
                                                                            <input type="hidden" name="cancel_return"
                                                                                value=" ">
                                                                            <input type="submit" name="submit"
                                                                                value="Add to cart" class="button">
                                                                        </fieldset>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </figure>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $cn++;
                                        if ($cn == 3) {
                                            ?>
                                            <div class="clearfix"> </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "../Main/footer.php";
?>
<script type="text/javascript">
    //UPDATEALL CART
    function updatecart(idid, sid) {
        var item_description_id = idid;
        var store_id = sid;
        $n = 0;
        var total_amt = document.getElementById('total_s' + store_id + "i" + item_description_id + '').innerHTML;
        if ($('#qnty_s' + store_id + "i" + item_description_id + '').css('display') != 'none') {
            var quantity = document.getElementById('qnty_s' + store_id + "i" + item_description_id + '').value;
        }
        else if ($('#sel_s' + store_id + "i" + item_description_id + '').css('display') != 'none') {
            var quantity = document.getElementById('sel_s' + store_id + "i" + item_description_id + '').value;
            document.getElementById('sel_opt_s' + store_id + "i" + item_description_id + '').innerHTML = quantity;
            document.getElementById('sel_opt_s' + store_id + "i" + item_description_id + '').value = quantity;
        }
        else if ($('#btn_s' + store_id + "i" + item_description_id + '').css('display') != 'none') {
            var quantity = document.getElementById('btn_s' + store_id + "i" + item_description_id + '').innerHTML;
        }
        //1=booking;2=cash_on_delivery
        var order_type = document.getElementById('order_s' + store_id + "i" + item_description_id + '').value;
        var id = <?= $id ?>;
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
    //SELECT BOX OPERATION
    function select_item_option(store_id, item_description_id, tmrp) {
        var store_id = store_id;
        var item_description_id = item_description_id;
        var mrp = tmrp;
        old_value = $('#sel_s' + store_id + 'i' + item_description_id + ' :selected').val();
        if (old_value == '10') {
            $('#sel_s' + store_id + 'i' + item_description_id + '').hide();
            $('#qnty_s' + store_id + 'i' + item_description_id + '').show();
            $('#btn_s' + store_id + 'i' + item_description_id + '').hide();
        }
        else {
            total(store_id, item_description_id, mrp);
        }
    }
    selected = "<?= $row['quantity'] ?>"
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
            document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = 1;
            document.getElementById('qnty_s' + store_id + 'i' + item_description_id).innerHTML = 1;
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
                document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = 1;
                document.getElementById('qnty_s' + store_id + 'i' + item_description_id).innerHTML = 1;
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
        if (qnty == 0) {
            document.getElementById('btn_s' + store_id + 'i' + item_description_id).innerHTML = 1;
            document.getElementById('qnty_s' + store_id + 'i' + item_description_id).innerHTML = 1;
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
        }
    }
    //PRICE AND CART SETTINGS
</script>
</body>

</html>