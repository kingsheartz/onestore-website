<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/config.php';
require 'pdo.php';
session_start();
/*
try{
    $pdo=new PDO("mysql:host=sql204.epizy.com;port=3306;dbname=epiz_28189397_os;charset=utf8","epiz_28189397","KinGsHearTz123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $_SESSION['success']="Connected successfully";
}catch(PDOException $e){
    $_SESSION['error']="OOPS !!! CONNECTION CAN'T BE ESTABLISHED";
}
*/
if (isset($_POST['setstorepass'])) {
  if ($_POST['setstorepass'] == 1) {
    $sql3 = "select activation_code from store_admin where email=':email'";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute(array(':email' => $_POST['email']));
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    if ($row3['activation_code'] != 'activated') {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $sql = "update store_admin set password=:password,activation_code=:activation_code where email=:email";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':password' => $password,
        ':activation_code' => "activated",
        ':email' => $_POST['email']
      ));
      $response['status'] = "success";
    } else {
      $response['status'] = "error1";
    }
  } else {
    $response['status'] = "error";
  }
  header('Content-type: application/json');
  echo json_encode($response);
} else {
  // Basic check to make sure the form was submitted.
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirectWithError("The form must be submitted with POST data.");
  }
  /*
  // Do some validation, check to make sure the name, email and message are valid.
  if (empty($_POST['g-recaptcha-response'])) {
      redirectWithError("Please complete the CAPTCHA.");
  }
  $recaptcha = new \ReCaptcha\ReCaptcha(CONTACTFORM_RECAPTCHA_SECRET_KEY);
  $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_REQUEST['REMOTE_ADDR']);
  if (!$resp->isSuccess()) {
      $errors = $resp->getErrorCodes();
      $error = $errors[0];
      $recaptchaErrorMapping = [
          'missing-input-secret' => 'No reCAPTCHA secret key was submitted.',
          'invalid-input-secret' => 'The submitted reCAPTCHA secret key was invalid.',
          'missing-input-response' => 'No reCAPTCHA response was submitted.',
          'invalid-input-response' => 'The submitted reCAPTCHA response was invalid.',
          'bad-request' => 'An unknown error occurred while trying to validate your response.',
          'timeout-or-duplicate' => 'The request is no longer valid. Please try again.',
      ];
      $errorMessage = $recaptchaErrorMapping[$error];
      redirectWithError("Please retry the CAPTCHA: ".$errorMessage);
  }*/
  if (empty($_POST['store_name'])) {
    redirectWithError("Please enter store_name in the form.");
  }
  if (empty($_POST['opening_hours'])) {
    redirectWithError("Please enter opening_hours in the form.");
  }
  if (empty($_POST['address'])) {
    redirectWithError("Please enter address in the form.");
  }
  if (empty($_POST['status'])) {
    redirectWithError("Please enter status in the form.");
  }
  if (empty($_POST['longitude'])) {
    redirectWithError("Please enter longitude in the form.");
  }
  if (empty($_POST['latitude'])) {
    redirectWithError("Please enter latitude in the form.");
  }
  if (empty($_POST['name'])) {
    redirectWithError("Please enter name in the form.");
  }
  if (empty($_POST['email'])) {
    redirectWithError("Please enter your email address in the form.");
  }
  if (empty($_POST['phone'])) {
    redirectWithError("Please enter phone in the form.");
  }
  if (strlen($_POST['phone']) < 10) {
    redirectWithError("Please enter at least 10 numbers in the phone field.");
  }
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    redirectWithError("Please enter a valid email address.");
  }
  if (!is_numeric($_POST['longitude'])) {
    redirectWithError("Please enter longitude in float value.");
  }
  if (!is_numeric($_POST['latitude'])) {
    redirectWithError("Please enter latitude in float value in the form.");
  }
  // Everything seems OK, time to send the email.
  $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  $uniqid = uniqid();
  $activate_link = 'http://localhost:81/One-Store-Renewed/onestore-website/extras/OS/pages/FRL/register-v2.php?emailverified=1&email=' . $_POST['email'] . '&code=' . $uniqid;
  $que = "select max(store_id) from store ";
  $sta = $pdo->prepare($que);
  $sta->execute();
  $r = $sta->fetch(PDO::FETCH_ASSOC);
  $id = $r['max(store_id)'];
  echo 'helo';
  $store_name = $_POST['store_name'];
  $opening_hours = $_POST['opening_hours'];
  $address = $_POST['address'];
  $status = $_POST['status'];
  $longitude = $_POST['longitude'];
  $latitude = $_POST['latitude'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $que = "select * from store_admin where email=:email";
  $sta = $pdo->prepare($que);
  $sta->execute(array(':email' => $email));
  $co = $sta->rowCount();
  echo 'helo';
  echo 'helo';
  if ($co == 0) {
    $id = ++$id;
    //store table
    $data1 = array(
      ':store_id' => $id,
      ':store_name' => $store_name,
      ':opening_hours' => $opening_hours,
      ':address' => $address,
      ':status' => $status,
      ':longitude' => $longitude,
      ':latitude' => $latitude
    );
    $sql1 = "insert into store (store_id,store_name,opening_hours,address,status,longitude,latitude)values(:store_id,:store_name,:opening_hours,:address,:status,:longitude,:latitude)";
    $statement1 = $pdo->prepare($sql1);
    $statement1->execute($data1);
    //store_admin table
    $data = array(
      ':store' => $id,
      ':name' => $name,
      ':email' => $email,
      ':phone' => $phone,
      ':activation_code' => $uniqid
    );
    $sql = "insert into store_admin (store_id,username,email,phone,activation_code)values(:store,:name,:email,:phone,:activation_code)";
    $statement = $pdo->prepare($sql);
    print_r($statement);
    $statement->execute($data);
  } else {
    redirectWithError("The Store is already Registered");
  }
  try {
    //Server settings
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
    $mail->isSMTP();
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
    $mail->Port = CONTACTFORM_SMTP_PORT;
    // Recipients
    $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    $mail->addAddress($_POST['email'], $_POST['name']);
    $mail->addReplyTo(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    // Content
    $mail->Subject = "Store Added";
    $message = '
<table style="width:100%!important">
   <tbody>
    <tr style="" width="834px" height="60" background="http://localhost:81/One-Store-Renewed/onestore-website/images/logo/log2.jpg" align="center">
     <td>
      <table width="100%" cellspacing="0" cellpadding="0" height="60" style="width:600px!important;text-align:center;margin:0 auto">
       <tbody>
        <tr>
         <td>
          <table style="width:640px;max-width:640px;padding-right:20px;padding-left:20px;">
           <tbody>
            <tr>
             <td style="width:35%;text-align:left">
              <a style="color:#027cd8;text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="http://localhost:81/One-Store-Renewed/onestore-website/" rel="noreferrer" target="_blank" data-saferedirecturl="">
               <img border="0"  src="http://localhost:81/One-Store-Renewed/onestore-website/images/logo/logo.png" alt="OneStore.ml" style="border:none" class="CToWUd">
              </a>
             </td>
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Store <span style="font-weight:bold">Added</span></p> </td>
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
                   <span style="font-weight:bold;color:#191919"> ' . $name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Email has been verified.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">Store ID : <span style="font-weight:bold;color:#000">OSSID' . sprintf('%06d', $id) . '</span> </p></td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px;text-align: justify;">Hi ' . $name . ', OneStore Welcomes You. Your Email id (' . $email . ') is verified successfully  by <b>' . date("F j") . "," . date("Y") . '</b>. You are now became a seller of our family.Best wishes for your product sales.</p><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Please click the following button to open the door to your new <span style="color:red" >on</span><span style="color:#000">lin</span><span style="color:red ">e store</span> in our world .</p> </td>
                </tr>
               </tbody>
              </table>
        <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top"> <p style="padding-left:15px;font-family:Arial;font-size:12px;line-height:1.58;margin-bottom:20px;margin-top:0;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121;font-weight: bold"><a href="' . $activate_link . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">OneStore</button> </a></p> </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top" align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: The \'<b>OneStore</b>\' button will send you to your <span style="color:red" >on</span><span style="color:#000">lin</span><span style="color:red ">e store</span> .Thanks for your support and also for being a member of our family .</p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
            <table width="640">
                <tr>
                    <td><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;"> if you\'re having trouble clicking the' . " \"Verify Account\" " . ' button,copy and paste the URL below into your web browser : ' . $activate_link . '  .</p>
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
                             <td style="width:80%;text-align:center;font-family:Arial;color: #fff"> &#169; 2020 <a style="color:#027cd8;text-decoration:none;outline:none;font-weight:bold" href="http://localhost:81/One-Store-Renewed/onestore-website/">OneStore</a>. All rights reserved  </td>
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
    $mail->msgHTML($message);
    $mail->AltBody = 'HTML messaging not supported';
    $mail->send();
    redirectSuccess();
  } catch (Exception $e) {
    redirectWithError("An error occurred while trying to send your message: " . $mail->ErrorInfo);
  }
}