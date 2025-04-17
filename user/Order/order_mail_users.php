<?php
require_once "../Common/pdo.php";
$user_id = $_GET['id'];
$placesql_u = "select* from users where user_id=:user_id";
$placestmt_u = $pdo->prepare($placesql_u);
$placestmt_u->execute(array(
  ':user_id' => $user_id
));
$placerow_u = $placestmt_u->fetch(PDO::FETCH_ASSOC);
$first_name = $placerow_u['first_name'];
$last_name = $placerow_u['last_name'];
$address = $placerow_u['address'];
$location = $placerow_u['location'];
$phone = $placerow_u['phone'];
$email = $placerow_u['email'];
$activate_link = 'extras/OS/pages/FRL/OTP-v2.html';
$otp = rand(100000, 999999);
/*
                $message .= '<h3 style="color:#059DF9">Hi '.$first_name.', OneStore Welcomes You</h3><br></center>';
                $message .= '<h3 style="color:#FF8A00;text-align:margin-left">You are now became a member of our family.Enjoy shopping with us </h3>';
                $message .= '<p>Please click the following button to open your door to our world of shopping</p><br>';
                $message .= ' <a style="margin-left:26%" href="'.$activate_link.'"><button style="background-color:rgba(0,0,0,85);color:white;border-radius:7px;">OneStore</button></a><br>';
                $message .= '<br><p>Regards,</p>';
                $message .= '<p>OneStore - for all your needs</p><br>';
                $message .= '<br><p>if you\'re having trouble clicking the'." \"Verify Email\" ".' button,copy and paste the URL below into your web browser : '.$activate_link.' </p><br><br><br><br>';
                //$message .= '<p><center>© 2020 <a href="https://falconsinfoworld.000webhostapp.com/">OneStore</a>. All rights reserved </center></p>';
                //$message .= '<p><center>&#169; 2020 <a href="https://onestore.epizy.com/">OneStore</a>. All rights reserved </center></p>';
                $message .= '<p><center>&#169; 2020 <a href="">OneStore</a>. All rights reserved </center></p>';
                $message .= '</body></html>';
*/
echo ' <table style="width:100%!important">
   <tbody>
    <tr style="" width="834px" height="60" background="../../images/logo/log2.jpg" align="center">
     <td>
      <table width="100%" cellspacing="0" cellpadding="0" height="60" style="width:600px!important;text-align:center;margin:0 auto">
       <tbody>
        <tr>
         <td>
          <table style="width:640px;max-width:640px;padding-right:20px;padding-left:20px;">
           <tbody>
            <tr>
             <td style="width:35%;text-align:left">
              <a style="color:#027cd8;text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml" rel="noreferrer" target="_blank" data-saferedirecturl="">
               <img border="0"  src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none" class="CToWUd">
              </a>
             </td>
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Reissuing <span style="font-weight:bold">Password</span></p> </td>
            </tr>
            <tr>
            </tr>
           </tbody>
          </table> </td>
        </tr>
       </tbody>
      </table>
       </td>
    </tr>
    <tr>
     <td>
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb;">
       <tbody>
        <tr>
         <td align="center" valign="top" bgcolor="#fff">
          <table border="0" cellpadding="0" cellspacing="0" style="width:640px;max-width:640px;padding-right:20px;padding-left:20px;background-color:#fff;padding-top:5px;padding-bottom: 15px;">
           <tbody>
            <tr>
             <td align="left">
              <table width="370" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#878787;font-size:12px;font-weight:normal;font-style:normal;font-stretch:normal;margin-top:7px;line-height:.85;padding-top:0px">Hi
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $placerow_u['last_name'] . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">OTP generated for password recovery.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID : <span style="font-weight:bold;color:#000">' . $user_id . '</span> </p></td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px;text-align: justify;">Seems like you lost your key to our world of shopping .One time OTP for recovering your password is generated below .Enjoy shopping with us.</p><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px"> .Please click the  click the following button to reset your password .</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="170" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top"> <p style="padding-left:15px;font-family:Arial;font-size:12px;line-height:1.58;margin-bottom:20px;margin-top:0;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121;font-weight: bold"><a href="' . $activate_link . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">Verify OTP</button> </a></p> </td>
                </tr>
               </tbody>
              </table>
              <table width="180" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:5px;padding-left:12px;line-height:1.46;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:center;color:#212121">OTP</span> <br> <span style="font-family:Arial;font-size:18px;color:#027cd8;font-weight:bold">' . $otp . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:5px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top" align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: if you didn\'t request a password reset , you can ignore this email .Your password will not be changed  .</p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
            <table width="640">
                <tr>
                    <td><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;"> if you\'re having trouble clicking the' . " \"Verify OTP\" " . ' button,copy and paste the URL below into your web browser : ' . $activate_link . '  .</p>
                </td>
                </tr>
            </table>
          <table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                     </td>
                    </tr>
                   </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
          <table width="100%" style="background-color: #02171e;width:100%;text-align:center;margin:0px;margin-top:32px" >
            <tr>
              <td>
                <table width="600" align="center" style="background-color:  #02171e">
                  <tr colspan="2" >
                    <td>
                        <table style="background-color: ">
                          <tbody>
                            <tr>
                             <td style="width:10%;text-align:left;padding-top:5px"></td>
                             <td style="width:80%;text-align:center;font-family:Arial;color: #fff"> &#169; 2020 <a style="color:#027cd8;text-decoration:none;outline:none;font-weight:bold" href="">OneStore</a>. All rights reserved  </td>
                             <td style="width:10%;text-align:right"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" height="24" src="https://ci6.googleusercontent.com/proxy/3QE9kvI6a_sNZY1yz9h1e9UTtBEe6bvUPfsokYVFhigLrmrCJxcv1_CZk0b5cJWyTHa1prcEfHSGUl1QMcg36fPaTs0H7MVxDk0pgC8ujoEedjfg26Rdff_eNArN9_s=s0-d-e1-ft#http://img6a.flixcart.com/www/promos/new/20160910-183744-google-play-min.png" alt="Flipkart.com" style="border:none;margin-top:10px" class="CToWUd"> </a> </td>
                            </tr>
                          </tbody>
                        </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
               <tbody>
                <tr>
                 <td height="1" style="background-color:#f0f0f0;font-size:0px;line-height:0px" bgcolor="#f0f0f0"></td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td>
              <table width="100%" cellspacing="0" cellpadding="0" style="width:600px;max-width:600px;margin-top:0px">
               <tbody>
                <tr>
                 <td align="left" valign="top" style="color:#2c2c2c;line-height:20px;font-weight:300;background-color:transparent">
                 </td>
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
?>