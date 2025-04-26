<?php
require_once "../../pdo.php";
$user_id = $_GET['id'];

$placesql_u = "select* from users where user_id=:user_id";
$placestmt_u = $pdo->prepare($placesql_u);
$placestmt_u->execute(array(':user_id' => $user_id));
$placerow_u = $placestmt_u->fetch(PDO::FETCH_ASSOC);
$first_name = $placerow_u['first_name'];
$last_name = $placerow_u['last_name'];
$address = $placerow_u['address'];
$location = $placerow_u['location'];
$phone = $placerow_u['phone'];
$email = $placerow_u['email'];
$placesql_s = "select* from store st inner join cart ca on st.store_id=ca.store_id inner join store_admin sa on st.store_id=sa.store_id where ca.user_id=:user_id  GROUP BY st.store_id";
$placestmt_s = $pdo->prepare($placesql_s);
$placestmt_s->execute(array(':user_id' => $user_id));
$i = 0;
$j = 0;
$total_bill = 0;
$order_id = "";
$store_array = array();
while ($placerow_s = $placestmt_s->fetch(PDO::FETCH_ASSOC)) {
  $store_array[$i]['store_id'] = $placerow_s['store_id'];
  $store_array[$i]['store_name'] = $placerow_s['store_name'];
  $store_array[$i]['opening_hours'] = $placerow_s['opening_hours'];
  $store_array[$i]['username'] = $placerow_s['username'];
  $store_array[$i]['address'] = $placerow_s['address'];
  $store_array[$i]['email'] = $placerow_s['email'];
  $store_array[$i]['phone'] = $placerow_s['phone'];
  $store_array[$i]['status'] = $placerow_s['status'];
  $i++;
}

for ($j = 0; $j < $i; $j++) {

  $k = 0;
  $placesql_i = "select ca.cart_id,it.category_id,it.sub_category_id,it.item_id,it.item_name,it.description,pd.price,ca.quantity,ca.order_type,ca.total_amt from cart ca inner join product_details pd on ca.store_id=pd.store_id inner join store st on st.store_id=ca.store_id inner join item it on it.item_id=ca.item_id where pd.item_id=ca.item_id and ca.user_id=:user_id and st.store_id=:store_id GROUP BY ca.item_id";
  $placestmt_i = $pdo->prepare($placesql_i);
  $placestmt_i->execute(array(
    ':user_id' => $user_id,
    ':store_id' => $store_array[$j]['store_id']
  ));
  while ($placerow_i = $placestmt_i->fetch(PDO::FETCH_ASSOC)) {

    $store_array[$j]['item_category_id'][$k] = $placerow_i['category_id'];
    $store_array[$j]['item_sub_category_id'][$k] = $placerow_i['sub_category_id'];
    $store_array[$j]['item_id'][$k] = $placerow_i['item_id'];
    $store_array[$j]['item_name'][$k] = $placerow_i['item_name'];
    $store_array[$j]['item_description'][$k] = $placerow_i['description'];
    $store_array[$j]['item_price'][$k] = $placerow_i['price'];
    $store_array[$j]['item_quantity'][$k] = $placerow_i['quantity'];
    $store_array[$j]['item_ordertype'][$k] = $placerow_i['order_type'];
    $store_array[$j]['item_total_amt'][$k] = $placerow_i['total_amt'];
    $total_bill += $placerow_i['total_amt'];
    $cart_id = $placerow_i['cart_id'];
    $order_id = $order_id . $cart_id;
    $k++;
  }
  $store_cnt[$j] = $k;
}
for ($l = 0; $l < $i; $l++) {
  $storerecieve_sql = "select sum(total_amt) as storerecieve from cart  where  user_id=:user_id and store_id=:store_id";
  $storerecieve_stmt = $pdo->prepare($storerecieve_sql);
  $storerecieve_stmt->execute(array(
    ':user_id' => $user_id,
    ':store_id' => $store_array[$l]['store_id']
  ));
  $storerecieve_row = $storerecieve_stmt->fetch(PDO::FETCH_ASSOC);
  $storerecieve = $storerecieve_row['storerecieve'];
  $store_total = 0;
  ?>
  <table style="width:100%!important">
    <tbody>
      <tr background="../../images/logo/log2.jpg" width="834px" height="60">
        <td>
          <table width="100%" cellspacing="0" cellpadding="0" height="60"
            style="width:600px!important;text-align:center;margin:0 auto">
            <tbody>
              <tr>
                <td>
                  <table style="width:640px;max-width:640px;padding-right:20px;padding-left:20px">
                    <tbody>
                      <tr>
                        <td style="width:40%;text-align:left;padding-top:5px"> <a
                            style="text-decoration:none;outline:none;color:#ffffff;font-size:13px"
                            href="https://www.one-store.ml"><img border="0" src="../../images/logo/logo-high.png"
                              alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
                        <td style="width:60%;text-align:right;padding-top:5px">
                          <p
                            style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">
                            Order <span style="font-weight:bold">Requested</span></p>
                        </td>
                      </tr>
                      <tr>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5"
            style="border:1px solid #bbb">
            <tbody>
              <tr>
                <td align="center" valign="top" bgcolor="#fff">

                  <table border="0" cellpadding="0" cellspacing="0"
                    style="width:640px;max-width:640px;padding-right:20px;padding-left:20px;background-color:#fff;padding-top:5px;padding-bottom: 15px;">
                    <tbody>
                      <tr>
                        <td align="left">
                          <table width="370" border="0" cellpadding="0" cellspacing="0" align="left">
                            <tbody>
                              <tr>
                                <td valign="top">
                                  <p
                                    style="font-family:Arial;color:#878787;font-size:12px;font-weight:normal;font-style:normal;font-stretch:normal;margin-top:7px;line-height:.85;padding-top:0px">
                                    Hi
                                    <span style="font-weight:bold;color:#191919">
                                      <?= $store_array[$l]['username'] ?>,</span>
                                  </p>
                                  <p
                                    style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">
                                    Order has been requested.</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
                            <tbody>
                              <tr>
                                <td valign="top">
                                  <p
                                    style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">
                                    Store ID <span
                                      style="font-weight:bold;color:#000">OSSID<?= $store_array[$l]['store_id'] ?></span>
                                  </p>
                                  <p
                                    style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">
                                    Order ID <span style="font-weight:bold;color:#000">OD<?= $order_id ?></span> </p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td border="1" align="left"
                          style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
                          <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
                            <tbody>
                              <tr>
                                <td align="left">
                                  <p
                                    style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">
                                    Below listed item(s) are requested by the customer by
                                    <b><?= date("F j") . " , " . date("Y") ?></b> from your store
                                    <b><?= $store_array[$l]['store_name'] ?></b>. Thanks for your cooperation with us and
                                    also wishing you best with your sales . </p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
                            <tbody>
                              <tr>
                                <td valign="top">
                                  <p
                                    style="padding-left:15px;font-family:Arial;font-size:12px;line-height:1.58;margin-bottom:20px;margin-top:0;padding-top:2px">
                                    <span style="display:inline-block;width:167px;color:#212121">Total amount</span><span
                                      style="display:inline-block;font-family:Arial;font-size:12px;font-weight:700;color:#139b3b;display:inline-block">Rs.
                                      <?= $storerecieve ?></span></p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
                            <tbody>
                              <tr>
                                <td valign="top" align="left">
                                  <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span
                                      style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email
                                      updates sent to</span> <br> <span
                                      style="font-family:Arial;font-size:12px;color:#212121"><?= $store_array[$l]['email'] ?></span>
                                  </p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
                            <tbody>
                              <tr>
                                <td valign="top" align="left">
                                  <p style="padding-left:15px;margin-bottom:10px"> <a
                                      href="http://localhost:81/One-Store-Renewed/onestore-website/user/Orders/yourorders.php?id=<?= $user_id ?>"
                                      style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none"
                                      rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button"
                                        style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View
                                        Order Status</button> </a> </p>
                                  <p
                                    style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;">
                                    Note: Please ensure that the requested services are available in your store and be
                                    ready for your customer arrival.If the customer didn't appear as per the conditions
                                    applied or cancel their order ,we will inform you soon.
                                    In case if the requirements aren't met in your shop, please inform us as soon as
                                    possible or contact your customer. </p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <?php
                  echo '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
        <tr>
          <td>
            <table width="600" align="center">
              <tr colspan="2" >
                <td>
                  <h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 0px;padding-bottom: 0px;font-family:Arial">
                    <table width="100%" cellspacing="10px">
                      <tr>
                        <td>
                          <span style="color:#fff;">Customer name : ' . $first_name . " " . $last_name . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">Ph : ' . $phone . '</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span style="color:#fff;">Customer id : OSUID' . $user_id . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">' . $email . '</span>
                        </td>
                  </tr>';

                  echo '</table></h4></td></tr></table></td></tr></table>';

                  for ($m = 0; $m < $store_cnt[$l]; $m++) {
                    $store_array[$l]['item_id'][$m];
                    $store_array[$l]['item_category_id'][$m];
                    $store_array[$l]['item_sub_category_id'][$m];
                    $store_array[$l]['item_name'][$m];
                    $store_array[$l]['item_description'][$m];
                    $store_array[$l]['item_price'][$m];
                    $store_array[$l]['item_quantity'][$m];
                    $store_array[$l]['item_ordertype'][$m];
                    $store_array[$l]['item_total_amt'][$m];
                    echo '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="single.php?id=' . $store_array[$l]['item_id'][$m] . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $store_array[$l]['item_category_id'][$m] . '/' . $store_array[$l]['item_sub_category_id'][$m] . '/' . $store_array[$l]['item_id'][$m] . '.jpg" alt="' . $store_array[$l]['item_name'][$m] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
                </tr>
               </tbody>
              </table>
              <table width="455" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top" align="left">
                 <p style="margin-bottom:13px;margin-top:20px"> <a href="" style="font-family:Arial;font-size:14.5px;font-weight:bold;font-style:normal;font-stretch:normal;line-height:1.43;color:#15c;text-decoration:none!important;word-spacing:0.2em" rel="noreferrer" target="_blank" data-saferedirecturl=""> ' . $store_array[$l]['item_name'][$m] . '</a> </p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Price: &#8377; ' . $store_array[$l]['item_price'][$m] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Qty: ' . $store_array[$l]['item_quantity'][$m] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Order type: ' . $store_array[$l]['item_ordertype'][$m] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Total: &#8377; ' . (int) $store_array[$l]['item_quantity'][$m] * (int) $store_array[$l]['item_price'][$m] . '</p>';
                    ;
                    $store_total += (int) $store_array[$l]['item_quantity'][$m] * (int) $store_array[$l]['item_price'][$m];
                    echo '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
                  }
                  echo '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount : &#8377; ' . $store_total . '</p><hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';

                  echo '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:18px">
               <tbody>
                <tr>
                 <td height="1" style="background-color:#f0f0f0;font-size:0px;line-height:0px" bgcolor="#f0f0f0"></td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td>
              <table width="100%" cellspacing="0" cellpadding="0" style="width:600px;max-width:600px;background:#ffffff">
               <tbody>
                <tr style="color:#212121">
                 <td align="left" valign="top" style="color:#212121;border-bottom:solid 1px #f0f0f0"> <p style="font-family:Arial;font-size:14px;font-weight:bold;line-height:1.86;color:#212121;margin-top:22px">Hope to see you again soon.</p>  <br> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td>
              <table width="100%" cellspacing="0" cellpadding="0" style="width:600px;max-width:600px;margin-top:14px">
               <tbody>
                <tr>
                 <td align="left" valign="top" style="color:#2c2c2c;line-height:20px;font-weight:300;background-color:transparent">
                  <table>
                   <tbody>
                    <tr>
                     <td style="width:35%;text-align:left"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none" class="CToWUd"> </a> </td>
                     <td style="width:55%;text-align:left;font-family:Arial"> &#169; 2020 <a style="color:#027cd8;text-decoration:none;outline:none;font-weight:bold" href="">OneStore</a>. All rights reserved  </td>
                     <td style="width:10%;text-align:right"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" height="24" src="https://ci6.googleusercontent.com/proxy/3QE9kvI6a_sNZY1yz9h1e9UTtBEe6bvUPfsokYVFhigLrmrCJxcv1_CZk0b5cJWyTHa1prcEfHSGUl1QMcg36fPaTs0H7MVxDk0pgC8ujoEedjfg26Rdff_eNArN9_s=s0-d-e1-ft#http://img6a.flixcart.com/www/promos/new/20160910-183744-google-play-min.png" alt="Flipkart.com" style="border:none;margin-top:10px" class="CToWUd"> </a> </td>
                    </tr>
                   </tbody>
                  </table> </td>
                </tr>
                <tr>
                 <td>
                  <table width="100%" cellspacing="0" cellpadding="0" style="margin:0 auto;width:600px;max-width:600px;margin-top:14px">
                   <tbody>
                    <tr>
                     <td align="left" valign="top" style="color:#2c2c2c;line-height:20px;font-weight:300;background-color:transparent">
                      <table>
                       <tbody>
                        <tr>
                         <td> <p style="font-family:Arial;font-size:10px;color:#878787">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p> </td>
                        </tr>
                       </tbody>
                      </table> </td>
                    </tr>
                   </tbody>
                  </table>
                   </td>
                </tr>
               </tbody>
              </table>
               </td>
            </tr>
           </tbody>
          </table> </td>
        </tr>
       </tbody>
      </table> </td>
    </tr>
   </tbody>
  </table>';
}
?>