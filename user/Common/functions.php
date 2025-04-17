<?php
session_start();
require_once "../Common/pdo.php";
/*
require_once $_SERVER['DOCUMENT_ROOT'].'/mail/contactform/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/mail/contactform/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/mail/contactform/config.php';
*/
//K
require_once '../../mail/contactform/vendor/autoload.php';
require_once '../../mail/contactform/functions.php';
require_once '../../mail/contactform/config.php';
//K
//Email smtp access
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//Email smtp access
//-----------------Name Check------------------------------------------------------------------------------------------
if (isset($_POST['checkname'])) {
  $name = clean_text($_POST["name"]);
  if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $response['status'] = "error";
  }
  /*
    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['name']) == 0) {
      $response['status']="error";
      //$_SESSION['error']="First name is not valid!";
    }
  */ else {
    $response['status'] = "success";
  }
  echo json_encode($response);
}
//-----------------Email check------------------------------------------------------------------------------------------
if (isset($_POST['checkmail'])) {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['status'] = "error";
    //$_SESSION['error']="Email is not valid!";
  } else {
    $response['status'] = "success";
  }
  echo json_encode($response);
}
//-----------------Feedback------------------------------------------------------------------------------------------
if (isset($_POST['feedback'])) {
  $sql = "insert into feedback (name,email,feedback) values (:name,:email,:feedback)";
  $stmt = $pdo->prepare($sql);
  $row = $stmt->execute(array(
    ':name' => $_POST['name'],
    ':email' => $_POST['email'],
    ':feedback' => $_POST['msg']
  ));
  if ($row) {
    $response['status'] = "success";
  } else {
    $response['status'] = "error";
  }
  echo json_encode($response);
}
//-----------------Newsletter updation------------------------------------------------------------------------------------------
if (isset($_POST['nlmailcheck'])) {
  if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "select email from users where user_id=:user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      'user_id' => $id
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $emailcasecheck = strcmp($row['email'], $_POST['email']);
    if ($emailcasecheck == 0) {
      $sql1 = "update users set newsletter_status=1 where email=:email and user_id=:user_id";
      $stmt1 = $pdo->prepare($sql1);
      $row1 = $stmt1->execute(array(
        ':email' => $_POST['email'],
        ':user_id' => $id
      ));
      if ($row1) {
        $response['status'] = "success";
      } else {
        $response['status'] = "error";
      }
    } else {
      $response['status'] = "error2";
    }
  } else {
    $response['status'] = "error2";
  }
  echo json_encode($response);
}
//Register
if (isset($_POST['register'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $subscribe = $_POST['subscribe'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $pin = $_POST['pin'];
  $location = $_POST['location'];
  $lat = $_POST['latitude'];
  $long = $_POST['longitude'];
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['status'] = "error2";
    $_SESSION['error'] = "Email is not valid!";
  } else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['first_name']) == 0) {
    $response['status'] = "error3";
    $_SESSION['reg_error'] = "First name is not valid!";
  } else {
    $sql = "select email from users where email='$email'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sql1 = "select phone from users where phone='$phone'";
    $stmt1 = $pdo->query($sql1);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $response['status'] = "error";
      $_SESSION['reg_error'] = "Account already exists";
    } else if ($row1) {
      $response['status'] = "error1";
      $_SESSION['reg_error'] = "Phone number already exists";
    } else {
      $uniqid = uniqid();
      //EMAIL SENDING//
      $from = 'onestoreforallyourneeds@gmail.com';
      $subject = 'Account Activation Required';
      $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
      $activate_link = '../Common/functions.php?emailverified=1&email=' . $_POST['email'] . '&code=' . $uniqid;
      $message = '
<table style="width:100%!important">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Activation <span style="font-weight:bold">Required</span></p> </td>
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $last_name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Account has been created.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">Activation code : <span style="font-weight:bold;color:#000">' . $uniqid . '</span> </p></td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px;text-align: justify;">Your Account is created successfully  by <b>' . date("F j") . "," . date("Y") . '</b> and below is given your activation code (button) for activating your newly created account.You are one step away from sign in to our world of shopping </p><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Please click the following verify button to activate your account .</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top"> <p style="padding-left:15px;font-family:Arial;font-size:12px;line-height:1.58;margin-bottom:20px;margin-top:0;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121;font-weight: bold">Verification code</span><span style="display:inline-block;font-family:Arial;font-size:12px;font-weight:700;color:#139b3b;display:inline-block">' . $uniqid . '</span></p> </td>
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
                 <td valign="top" align="left"> <p style="padding-left:15px;margin-bottom:10px"> <a href="' . $activate_link . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">Verify Account</button> </a> </p>
                    <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: The <b>\'Verify Account\'</b> code/button will be de-activate once it is clicked and after activating your account , it won\'t be required anymore .Thanks for your support and also for being a member of our family .</p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
            <table width="640">
                <tr>
                    <td><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;"> if you\'re having trouble clicking the' . " \"<b>Verify Account</b>\" " . ' button,copy and paste the URL below into your web browser : ' . $activate_link . '  .</p>
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
      /*
              require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
              require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
              require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
              $mail = new PHPMailer;
              $mail->isSMTP();
              $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
              $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
              $mail->Port = 587; // TLS only
              $mail->SMTPSecure = 'tls'; // ssl is deprecated
              $mail->SMTPAuth = true;
              $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
              $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
              $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
              $mail->addAddress($_POST['email'],$_POST['first_name'] ); // to email and name
              $mail->Subject = $subject;
              $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
              $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
              // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
              $mail->SMTPOptions = array(
                                  'ssl' => array(
                                  'verify_peer' => false,
                                  'verify_peer_name' => false,
                                  'allow_self_signed' => true
                                  )
                              );
      */
      // Everything seems OK, time to send the email.
      $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
      $mail->isSMTP();
      $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
      $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
      $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
      $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
      $mail->SMTPAuth = true;
      $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
      $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
      // Recipients
      $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
      $mail->addAddress($_POST['email'], $_POST['first_name']); // to email and name
      // Content
      $mail->Subject = $subject;
      $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
      $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
      if (!$mail->send()) {
        $response['status'] = "error4";
        $_SESSION['reg_error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
        //echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        $sql = "insert into users (first_name,last_name,phone,pincode,location,latitude,longitude,address,newsletter_status,email,password,activation_code)values(:first_name,:last_name,:phone,:pin,:location,:lat,:long,:address,:newsletter_status,:email,:password,:activation_code)";
        $stmt = $pdo->prepare($sql);
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->execute(array(
          ':first_name' => $first_name,
          ':last_name' => $last_name,
          ':phone' => $phone,
          ':pin' => $pin,
          ':location' => $location,
          ':lat' => $lat,
          ':long' => $long,
          ':address' => $address,
          ':newsletter_status' => $subscribe,
          ':email' => $email,
          ':password' => $password,
          ':activation_code' => $uniqid
        ));
        $sql_user = 'select user_id from users where email=:email';
        $stmt_user = $pdo->prepare($sql_user);
        $stmt_user->execute(array(':email' => $email));
        $row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
        /*********************************************************************************************************************/
        /*DELIVERY ADDRESS*/
        $delivery = $_POST['delivery'];
        $type = 'permanent';
        $user_id = $row_user['user_id'];
        if ($_POST['delivery'] == 1) {
          $sql_delivery = "insert into user_delivery_details (first_name,last_name,phone,pincode,address,user_id,type)values(:first_name,:last_name,:phone,:pincode,:address,:user_id,:type)";
          $stmt_delivery = $pdo->prepare($sql_delivery);
          // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
          $stmt_delivery->execute(array(
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':phone' => $phone,
            ':pincode' => $pin,
            ':user_id' => $user_id,
            ':type' => $type,
            ':address' => $address
          ));
        } else if ($_POST['delivery'] == 2) {
          $shipping_first_name = $_POST['shipping_first_name'];
          $shipping_last_name = $_POST['shipping_last_name'];
          $shipping_ph_no = $_POST['shipping_ph_no'];
          $shipping_ph_no2 = $_POST['shipping_ph_no2'];
          $shipping_address_1 = $_POST['shipping_address_1'];
          $shipping_postcode = $_POST['shipping_postcode'];
          $sql_delivery = "insert into user_delivery_details (first_name,last_name,phone,pincode,address,alternative_phone,user_id,type)values(:first_name,:last_name,:phone,:pincode,:address,:alternative_phone,:user_id,:type)";
          $stmt_delivery = $pdo->prepare($sql_delivery);
          // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
          $stmt_delivery->execute(array(
            ':first_name' => $shipping_first_name,
            ':last_name' => $shipping_last_name,
            ':phone' => $shipping_ph_no,
            ':pincode' => $shipping_postcode,
            ':alternative_phone' => $shipping_ph_no2,
            ':user_id' => $user_id,
            ':type' => $type,
            ':address' => $shipping_address_1
          ));
        }
        $response['status'] = "success";
        $_SESSION['reg_success'] = "success";
      }
      //EMAIL SENDING//
    }
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//update_user_details//
if (isset($_POST['update_user_details'])) {
  $user_id = $_SESSION['id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $pin = $_POST['pin'];
  $location = $_POST['location'];
  $lat = $_POST['latitude'];
  $long = $_POST['longitude'];
  $shipping_first_name = $_POST['shipping_first_name'];
  $shipping_last_name = $_POST['shipping_last_name'];
  $shipping_ph_no = $_POST['shipping_ph_no'];
  $shipping_ph_no2 = $_POST['shipping_ph_no2'];
  $shipping_address_1 = $_POST['shipping_address_1'];
  $shipping_postcode = $_POST['shipping_postcode'];
  $sql = "select * from users where user_id='$user_id'";
  $stmt = $pdo->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $old_password = $row['password'];
  if ($new_password != "") {
    $new_password = $_POST['new_password'];
    $password = password_hash($new_password, PASSWORD_DEFAULT);
  } else {
    $password = $old_password;
  }
  $sqlmail = "select email from users where email='$email'";
  $stmtmail = $pdo->query($sqlmail);
  $rowmail = $stmtmail->fetch(PDO::FETCH_ASSOC);
  $current_mail = $rowmail['email'];
  $sqlphone = "select phone from users where phone='$phone'";
  $stmtphone = $pdo->query($sqlphone);
  $rowphone = $stmtphone->fetch(PDO::FETCH_ASSOC);
  $current_phone = $rowphone['phone'];
  if ($current_password !== 'no change') {
    if (!password_verify($current_password, $row['password'])) {
      $response['status'] = "error_no_match_password";
    }
  }
  if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['first_name']) == 0) {
    $response['status'] = "error3";
    $_SESSION['error'] = "First name is not valid!";
  } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['status'] = "error2";
    $_SESSION['error'] = "Email is not valid!";
  } else {
    if ($rowmail) {
      if (strcmp($current_mail, $row['email']) != 0) {
        $response['status'] = "error";
      }
    }
    if ($rowphone) {
      if ($current_phone != $row['phone']) {
        $response['status'] = "error1";
      }
    }
    if ($current_mail != $email) {
      if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
      }
      $time = date('h' . "." . 'i' . " " . 'A');
      $uniqid = uniqid();
      //EMAIL SENDING//
      $from = 'onestoreforallyourneeds@gmail.com';
      $subject = 'Account Details Updated';
      $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
      $activate_link = '../Common/functions.php?emailupdateverified=1&emailcurrent=' . $row['email'] . '&emailnew=' . $_POST['email'] . '&code=' . $uniqid . '&id=' . $user_id;
      $cancel = '../Common/functions.php?emailupdateverified=0&emailcurrent=' . $row['email'] . '&emailnew=' . $_POST['email'] . '&code=' . $uniqid;
      $message = '
<table style="width:100%!important">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Account details <span style="font-weight:bold">Updated</span></p> </td>
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $last_name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Account has been updated.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID <span style="font-weight:bold;color:#000">OSUID' . sprintf('%06d', $user_id) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Email <span style="font-weight:bold;color:#000">' . $row['email'] . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
            </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px;">Your Account is requested an email updation from ' . $row['email'] . ' to ' . $email . ' by <b>' . date("F j") . " , " . date("Y") . " at " . $time . '</b> and below is given your verification code (button) for activating your updated email. </p><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Please click the following verify button to verify your email .</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top"><p style="padding-left:15px;font-family:Arial;font-size:12px;line-height:1.58;margin-bottom:20px;margin-top:0;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121;font-weight: bold">Verification code</span><span style="display:inline-block;font-family:Arial;font-size:12px;font-weight:700;color:#139b3b;display:inline-block">' . $uniqid . '</span></p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: -20px;margin-bottom:10px;">
               <tbody>
                <tr>
                 <td valign="top" align="left"> <p style="padding-left:15px;margin-bottom:10px">
                    <a href="' . $activate_link . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">Verify Email</button>
                    </a>
                    <a href="' . $cancel . '" style="background-color:rgb(251,21,51);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none;margin-left: 20px;" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(251,21,5);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">No Thanks</button>
                    </a>
                    </p>
                    <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: <span style="color:red">In case you don\'t wish to change your current email , please click <b>\'No thanks\'</b> button.</span>The <b>\'Verify email\'</b> code/button will be de-activate once it is clicked and after verified your email , it won\'t be required anymore .Thanks for your support and also for being a member of our family .</p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
            <table width="640">
                <tr>
                    <td><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;"> if you\'re having trouble clicking the' . " \"<b>Verify Account</b>\" " . ' button,copy and paste the URL below into your web browser : ' . $activate_link . '  .</p>
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
      /*
              require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
              require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
              require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
              $mail = new PHPMailer;
              $mail->isSMTP();
              $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
              $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
              $mail->Port = 587; // TLS only
              $mail->SMTPSecure = 'tls'; // ssl is deprecated
              $mail->SMTPAuth = true;
              $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
              $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
              $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
              $mail->addAddress($row['email'],$_POST['first_name'] ); // to email and name
              $mail->Subject = $subject;
              $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
              $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
              // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
              $mail->SMTPOptions = array(
                                  'ssl' => array(
                                      'verify_peer' => false,
                                      'verify_peer_name' => false,
                                      'allow_self_signed' => true
                                  )
                              );
      */
      // Everything seems OK, time to send the email.
      $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
      $mail->isSMTP();
      $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
      $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
      $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
      $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
      $mail->SMTPAuth = true;
      $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
      $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
      // Recipients
      $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
      $mail->addAddress($row['email'], $_POST['first_name']); // to email and name
      // Content
      $mail->Subject = $subject;
      $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
      $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
      if (!$mail->send()) {
        $response['status'] = "error4";
        $_SESSION['reg_error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
        //echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
        $sql = "update users set first_name=:first_name,last_name=:last_name,phone=:phone,pincode=:pin,location=:location,latitude=:lat,longitude=:long,address=:address,password=:password,activation_code=:activation_code where user_id=:user_id";
        $stmt = $pdo->prepare($sql);
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $stmt->execute(array(
          ':first_name' => $first_name,
          ':last_name' => $last_name,
          ':phone' => $phone,
          ':pin' => $pin,
          ':location' => $location,
          ':lat' => $lat,
          ':long' => $long,
          ':address' => $address,
          ':password' => $password,
          ':user_id' => $user_id,
          ':activation_code' => $uniqid
        ));
        if (empty($shipping_ph_no2)) {
          $shipping_ph_no2 = NULL;
        }
        $sql = "update user_delivery_details set first_name=:shipping_first_name,last_name=:shipping_last_name,phone=:shipping_ph_no,alternative_phone=:shipping_ph_no2,address=:shipping_address_1,pincode=:shipping_postcode where user_id=:user_id";
        $stmt1 = $pdo->prepare($sql);
        $stmt1->execute(array(
          ':shipping_first_name' => $shipping_first_name,
          ':shipping_last_name' => $shipping_last_name,
          ':shipping_ph_no' => $shipping_ph_no,
          ':shipping_ph_no2' => $shipping_ph_no2,
          ':shipping_address_1' => $shipping_address_1,
          ':shipping_postcode' => $shipping_postcode,
          ':user_id' => $user_id
        ));
        $response['status'] = "success1";
      }
      //EMAIL SENDING//
    } else if (!(isset($response['status']))) {
      $sql = "update users set first_name=:first_name,last_name=:last_name,phone=:phone,pincode=:pin,location=:location,latitude=:lat,longitude=:long,address=:address,email=:email,password=:password where user_id=:user_id";
      $stmt = $pdo->prepare($sql);
      // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
      $stmt->execute(array(
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':phone' => $phone,
        ':pin' => $pin,
        ':location' => $location,
        ':lat' => $lat,
        ':long' => $long,
        ':address' => $address,
        ':email' => $email,
        ':user_id' => $user_id,
        ':password' => $password
      ));
      if (empty($shipping_ph_no2)) {
        $shipping_ph_no2 = NULL;
      }
      $sql = "update user_delivery_details set first_name=:shipping_first_name,last_name=:shipping_last_name,phone=:shipping_ph_no,alternative_phone=:shipping_ph_no2,address=:shipping_address_1,pincode=:shipping_postcode where user_id=:user_id";
      $stmt1 = $pdo->prepare($sql);
      $stmt1->execute(array(
        ':shipping_first_name' => $shipping_first_name,
        ':shipping_last_name' => $shipping_last_name,
        ':shipping_ph_no' => $shipping_ph_no,
        ':shipping_ph_no2' => $shipping_ph_no2,
        ':shipping_address_1' => $shipping_address_1,
        ':shipping_postcode' => $shipping_postcode,
        ':user_id' => $user_id
      ));
      $response['status'] = "success";
    }
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//EMAIL SENDING LOCALHOST MAIL() FUNCTION
/*
session_start();
require_once "pdo.php";
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//set_error_handler("var_dump");
if(isset($_POST['register'])){
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$subscribe=$_POST['subscribe'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$pin=$_POST['pin'];
	$location=$_POST['location'];
	$lat=$_POST['latitude'];
	$long=$_POST['longitude'];
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$response['status']="error2";
		$_SESSION['error']="Email is not valid!";
	}
	else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['first_name']) == 0) {
		$response['status']="error3";
		$_SESSION['error']="First name is not valid!";
	}
	else{
		$sql="select email from users where email='$email'";
		$stmt=$pdo->query($sql);
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$sql1="select phone from users where phone='$phone'";
		$stmt1=$pdo->query($sql1);
		$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
		if($row){
			$response['status']="error";
			$_SESSION['error']="Account already exists";
		}
		else if ($row1) {
			$response['status']="error1";
			$_SESSION['error']="Phone number already exists";
		}
		else{
			$sql="insert into users (first_name,last_name,phone,pincode,location,latitude,longitude,address,newsletter_status,email,password,activation_code)values(:first_name,:last_name,:phone,:pin,:location,:lat,:long,:address,:newsletter_status,:email,:password,:activation_code)";
			$stmt=$pdo->prepare($sql);
// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$uniqid = uniqid();
			$stmt->execute(array(
				':first_name'=>$first_name,
				':last_name'=>$last_name,
				':phone'=>$phone,
				':pin'=>$pin,
				':location'=>$location,
				':lat'=>$lat,
				':long'=>$long,
				':address'=>$address,
				':newsletter_status'=>$subscribe,
				':email'=>$email,
				':password'=>$password,
				':activation_code'=>$uniqid));
		//EMAIL SENDING LOCALHOST MAIL() FUNCTION
				$from    = 'onestoreforallyourneeds@gmail.com';
				$subject = 'Account Activation Required';
				$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
				// Update the activation variable below
				//$activate_link = 'https://falconsinfoworld.000webhostapp.com/OneStore/functions.php?emailverified=1&email=' . $_POST['email'] . '&code=' . $uniqid;
				$activate_link = 'http://localhost/MY%20WEBSITES/ONESTORE/OneStore/functions.php?emailverified=1&email='.$_POST['email'].'&code='.$uniqid;
				$message = '<html><body style="background-color:rgba(255,255,255,255.85);padding:20px;"><center>';
				$message .= '<img src="https://falconsinfoworld.000webhostapp.com/OneStore/images/logo/logomail.png"><br>';
				$message .= '<h3 style="color:#059DF9">Hi Govind, OneStore Welcomes You</h3><br></center>';
				$message .= '<h3 style="color:#FF8A00;text-align:margin-left">You are one step away from sign in to our world of shopping </h3>';
				$message .= '<p>Please click the following verify email button to activate your account</p><br>';
				$message .= ' <a style="margin-left:26%" href="'.$activate_link.'"><button style="background-color:rgba(0,0,0,85);color:white;border-radius:7px;">Verify Email</button></a><br>';
				$message .= '<br><p>Regards,</p>';
				$message .= '<p>OneStore</p><br>';
				$message .= '<br><p>if you\'re having trouble clicking the'." \"Verify Email\" ".' button,copy and paste the URL below into your web browser : '.$activate_link.' </p><br><br><br><br>';
				$message .= '<p><center>© 2020 <a href="https://falconsinfoworld.000webhostapp.com/">OneStore</a>. All rights reserved </center></p>';
				$message .= '</body></html>';
				mail($_POST['email'], $subject, $message,$headers);
				$response['status']="success";
		//EMAIL SENDING LOCALHOST MAIL() FUNCTION
	}
}
header('Content-type: application/json');
echo json_encode($response);
}
*/
//EMAIL SENDING LOCALHOST MAIL() FUNCTION
//email verification
//-----------------------------------------------------------------------------------------------------------
// First we check if the email and code exists...
if (isset($_GET['email'], $_GET['code'], $_GET['emailverified'])) {
  if ($_GET['emailverified'] == 1) {
    if ($stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND activation_code = :activation_code')) {
      $stmt->execute(array(
        ':email' => $_GET['email'],
        ':activation_code' => $_GET['code']
      ));
      // Store the result so we can check if the account exists in the database.
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
        // Account exists with the requested email and code.
        if ($stmt = $pdo->prepare('UPDATE users SET activation_code = :new_code WHERE email = :email AND activation_code = :activation_code')) {
          // Set the new activation code to 'activated', this is how we can check if the user has activated their account.
          $newcode = 'activated';
          $stmt->execute(array(
            ':new_code' => $newcode,
            ':email' => $_GET['email'],
            ':activation_code' => $_GET['code']
          ));
          //EMAIL SENDING//
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $email = $row['email'];
          $user_id = $row['user_id'];
          $from = 'onestoreforallyourneeds@gmail.com';
          $subject = 'Registration Successfully completed';
          $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
          // Update the activation variable below
          //$activate_link = 'https://falconsinfoworld.000webhostapp.com/OneStore/functions.php?emailverified=1&email='.$_POST['email'].'&code='.$uniqid;
          //$activate_link = 'http://localhost/MY%20WEBSITES/ONESTORE/OneStore/functions.php?emailverified=1&email='.$_POST['email'].'&code='.$uniqid;
          //$activate_link = 'https://onestore.epizy.com/functions.php?emailverified=1&email='.$_POST['email'].'&code='.$uniqid;
          $activate_link = 'http://localhost:81/One-Store-Renewed/onestore-website';
          $message = '
<table style="width:100%!important">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Account <span style="font-weight:bold">Activated</span></p> </td>
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $last_name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Account has been activated.</p> </td>
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
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px;text-align: justify;">Hi ' . $first_name . ', OneStore Welcomes You. Your Account is activated successfully  by <b>' . date("F j") . "," . date("Y") . '</b>. You are now became a member of our family.Enjoy shopping with us.</p><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Please click the following button to open your door to our world of shopping .</p> </td>
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
                 <td valign="top" align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: The \'<b>OneStore</b>\' button will send you to our website .Thanks for your support and also for being a member of our family .</p> </td>
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
          /*
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
                  $mail = new PHPMailer;
                  $mail->isSMTP();
                  $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
                  $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
                  $mail->Port = 587; // TLS only
                  $mail->SMTPSecure = 'tls'; // ssl is deprecated
                  $mail->SMTPAuth = true;
                  $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
                  $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
                  $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
                  $mail->addAddress($email,$first_name ); // to email and name
                  $mail->Subject = $subject;
                  $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
                  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
                  // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
                  $mail->SMTPOptions = array(
                                      'ssl' => array(
                                          'verify_peer' => false,
                                          'verify_peer_name' => false,
                                          'allow_self_signed' => true
                                      )
                                  );
          */
          // Everything seems OK, time to send the email.
          $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
          $mail->isSMTP();
          $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
          $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
          $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
          $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
          $mail->SMTPAuth = true;
          $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
          $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
          // Recipients
          $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
          $mail->addAddress($email, $first_name); // to email and name
          // Content
          $mail->Subject = $subject;
          $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
          $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
          if (!$mail->send()) {
            $response['status'] = "error4";
            $_SESSION['error'] = "Email can't Send";
            //echo "Mailer Error: " . $mail->ErrorInfo;
          }
          //EMAIL SENDING//
          header("location:../Account/registered.php?verified=yes");
        }
      } else {
        header("location:../Common/error.php?click=1");
      }
    }
  }
}
//email verification
//-----------------------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////EMAIL UPDATE VERIFICATION//////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------------------
// First we check if the email and code exists...
if (isset($_GET['emailnew'], $_GET['code'], $_GET['emailupdateverified'], $_GET['emailcurrent'])) {
  if ($_GET['emailupdateverified'] == 0) {
    if ($stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND activation_code = :activation_code')) {
      $stmt->execute(array(
        ':email' => $_GET['emailcurrent'],
        ':activation_code' => $_GET['code']
      ));
      // Store the result so we can check if the account exists in the database.
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
        // Account exists with the requested email and code.
        if ($stmt = $pdo->prepare('UPDATE users SET activation_code = :new_code WHERE email = :email AND activation_code = :activation_code')) {
          // Set the new activation code to 'activated', this is how we can check if the user has activated their account.
          $newcode = 'activated';
          $stmt->execute(array(
            ':new_code' => $newcode,
            ':email' => $_GET['emailcurrent'],
            ':activation_code' => $_GET['code']
          ));
          header("location:../Account/edit_user_details.php?changed=no");
        }
      } else {
        header("location:../Common/error.php?click=1");
      }
    }
  } else if ($_GET['emailupdateverified'] == 1) {
    if ($stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND activation_code = :activation_code')) {
      $stmt->execute(array(
        ':email' => $_GET['emailcurrent'],
        ':activation_code' => $_GET['code']
      ));
      // Store the result so we can check if the account exists in the database.
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
        // Account exists with the requested email and code.
        if ($stmt = $pdo->prepare('UPDATE users SET activation_code = :new_code , email = :emailnew WHERE email = :email AND activation_code = :activation_code')) {
          // Set the new activation code to 'activated', this is how we can check if the user has activated their account.
          $newcode = 'activated';
          $stmt->execute(array(
            ':new_code' => $newcode,
            ':email' => $_GET['emailcurrent'],
            ':emailnew' => $_GET['emailnew'],
            ':activation_code' => $_GET['code']
          ));
          //EMAIL SENDING//
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $email = $row['email'];
          $user_id = $row['user_id'];
          $from = 'onestoreforallyourneeds@gmail.com';
          $subject = 'Email Verified Successfully';
          $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
          // Update the activation variable below
          //$activate_link = 'https://falconsinfoworld.000webhostapp.com/OneStore/functions.php?emailverified=1&email='.$_POST['email'].'&code='.$uniqid;
          //$activate_link = 'http://localhost/MY%20WEBSITES/ONESTORE/OneStore/functions.php?emailverified=1&email='.$_POST['email'].'&code='.$uniqid;
          //$activate_link = 'https://onestore.epizy.com/functions.php?emailverified=1&email='.$_POST['email'].'&code='.$uniqid;
          $activate_link = 'http://localhost:81/One-Store-Renewed/onestore-website';
          $message = '
<table style="width:100%!important">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Email <span style="font-weight:bold">Verified</span></p> </td>
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $last_name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Email has been verified.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID : <span style="font-weight:bold;color:#000">OSUID' . sprintf('%06d', $user_id) . '</span> </p></td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px;text-align: justify;">Hi ' . $first_name . ', OneStore Welcomes You. Your Email id (' . $_GET['emailnew'] . ') is verified successfully  by <b>' . date("F j") . "," . date("Y") . '</b>. Enjoy shopping with us.</p><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Please click the following button to open your door to our world of shopping .</p> </td>
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
                 <td valign="top" align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: The \'<b>OneStore</b>\' button will send you to our website .Thanks for your support and also for being a member of our family .</p> </td>
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
          /*
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
                  $mail = new PHPMailer;
                  $mail->isSMTP();
                  $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
                  $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
                  $mail->Port = 587; // TLS only
                  $mail->SMTPSecure = 'tls'; // ssl is deprecated
                  $mail->SMTPAuth = true;
                  $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
                  $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
                  $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
                  $mail->addAddress($email,$first_name ); // to email and name
                  $mail->Subject = $subject;
                  $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
                  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
                  // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
          */
          // Everything seems OK, time to send the email.
          $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
          $mail->isSMTP();
          $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
          $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
          $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
          $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
          $mail->SMTPAuth = true;
          $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
          $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
          // Recipients
          $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
          $mail->addAddress($email, $first_name); // to email and name
          // Content
          $mail->Subject = $subject;
          $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
          $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
          $mail->SMTPOptions = array(
            'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
            )
          );
          if (!$mail->send()) {
            $response['status'] = "error4";
            $_SESSION['error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
            //echo "Mailer Error: " . $mail->ErrorInfo;
          }
          //EMAIL SENDING//
          header("location:../Account/edit_user_details.php?changed=yes");
        }
      } else {
        header("location:../Common/error.php?click=1");
      }
    }
  }
}
//email verification
//-----------------------------------------------------------------------------------------------------------
//Log in page operations
if (isset($_POST['login'])) {
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $sql = "select user_id,first_name,password,email,activation_code from users where email='$email'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sql2 = "select id,username,password,activation_code,email from store_admin where email='$email' and activation_code = 'activated'";
    $stmt2 = $pdo->query($sql2);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $osemail = "OneStore_email";
    $ospass = "OneStore_password";
    if ($row && $row2) {
      if (($row2['activation_code'] != 'activated') && ($row['activation_code'] != 'activated')) {
        $_SESSION['errorlogin'] = "Check and verify your email";
        $response['status'] = "error1";
      } else {
        if ((password_verify($_POST['password'], $row2['password'])) && (password_verify($_POST['password'], $row['password']))) {
          $emailcasecheck2 = strcmp($row2['email'], $_POST['email']);
          $emailcasecheck1 = strcmp($row['email'], $_POST['email']);
          if ($emailcasecheck1 == 0 && $emailcasecheck2 == 0) {
            $_SESSION['sname'] = $row2['username'];
            $_SESSION['sid'] = $row2['id'];
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['id'] = $row['user_id'];
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            } else if (!isset($_COOKIE[$osemail])) {
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            } else if (isset($_COOKIE[$osemail]) != $_POST['email']) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            }
            $response['admin'] = "true";
            $response['user'] = "true";
            $response['id'] = $row2['id'];
          } else {
            $_SESSION['errorlogin'] = "store-user admin check 1";
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
            }
            $response['status'] = "error";
          }
        } else {
          $_SESSION['errorlogin'] = "store-user admin check 2";
          if (isset($_COOKIE[$osemail])) {
            setcookie($osemail, NULL, time() - 3600, "/");
            setcookie($ospass, NULL, time() - 3600, "/");
          }
          $response['status'] = "error";
        }
      }
    } else if ($row2) {
      if ($row2['activation_code'] != 'activated') {
        $_SESSION['errorlogin'] = "Check and verify your email";
        $response['status'] = "error1";
      } else {
        if (password_verify($_POST['password'], $row2['password'])) {
          $emailcasecheck = strcmp($row2['email'], $_POST['email']);
          if ($emailcasecheck == 0) {
            $_SESSION['sname'] = $row2['username'];
            $_SESSION['sid'] = $row2['id'];
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            } else if (!isset($_COOKIE[$osemail])) {
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            }
            $response['admin'] = "true";
            $response['id'] = $row2['id'];
          }
        } else {
          $_SESSION['errorlogin'] = "Incorrect Email ID or Password-store";
          if (isset($_COOKIE[$osemail])) {
            setcookie($osemail, NULL, time() - 3600, "/");
            setcookie($ospass, NULL, time() - 3600, "/");
          }
          $response['status'] = "error";
        }
      }
    } else if ($row) {
      if ($row['activation_code'] != 'activated') {
        $_SESSION['errorlogin'] = "Check and verify your email";
        $response['status'] = "error1";
      } else {
        if (password_verify($_POST['password'], $row['password'])) {
          $emailcasecheck = strcmp($row['email'], $_POST['email']);
          if ($emailcasecheck == 0) {
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['id'] = $row['user_id'];
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            } else if (!isset($_COOKIE['OneStore_email'])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            }
            $response['user'] = "true";
            $response['status'] = "success";
          } else {
            $_SESSION['errorlogin'] = "Incorrect Email ID or Password-user";
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
            }
            $response['status'] = "error";
          }
        } else {
          $_SESSION['errorlogin'] = "Incorrect Password";
          if (isset($_COOKIE[$email])) {
            setcookie($email, NULL, time() - 3600, "/");
            setcookie($pass, NULL, time() - 3600, "/");
          }
          $response['status'] = "error";
        }
      }
    } else {
      $_SESSION['errorlogin'] = "You are not registered yet";
      $response['status'] = "errornotfound";
    }
    header('Content-type: application/json');
    echo json_encode($response);
  }
}
//-----------------------------------------------------------------------------------------------------------
//Auto login check
if (isset($_POST['userexists'])) {
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $osemail = "OneStore_email";
    $ospass = "OneStore_password";
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $sql = "select user_id,first_name,password,email from users where email='$email' and password='$password' and activation_code='activated'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sql2 = "select id,username,password,activation_code,email from store_admin where email='$email' and activation_code = 'activated'";
    $stmt2 = $pdo->query($sql2);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $passcasecheck = strcmp($row['password'], $_POST['password']);
      $emailcasecheck = strcmp($row['email'], $_POST['email']);
      if (password_verify($_POST['password'], $row['password'])) {
        if ($emailcasecheck == 0) {
          $_SESSION['name'] = $row['first_name'];
          $_SESSION['id'] = $row['user_id'];
        } else {
          if (isset($_COOKIE[$osemail])) {
            setcookie($osemail, NULL, time() - 3600, "/");
            setcookie($ospass, NULL, time() - 3600, "/");
            return;
          }
        }
      }
      if (isset($_COOKIE[$osemail])) {
        setcookie($osemail, NULL, time() - 3600, "/");
        setcookie($ospass, NULL, time() - 3600, "/");
        return;
      }
    }
    if ($row2) {
      if ($row2['activation_code'] != 'activated') {
        $_SESSION['errorlogin'] = "Check and verify your email";
        $response['status'] = "error1";
      } else {
        if (password_verify($_POST['password'], $row2['password'])) {
          $emailcasecheck = strcmp($row2['email'], $_POST['email']);
          if ($emailcasecheck == 0) {
            $_SESSION['sname'] = $row2['username'];
            $_SESSION['sid'] = $row2['id'];
          } else {
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
            }
            $response['status'] = "error";
          }
        } else {
          if (isset($_COOKIE[$osemail])) {
            setcookie($osemail, NULL, time() - 3600, "/");
            setcookie($ospass, NULL, time() - 3600, "/");
          }
          $response['status'] = "error";
        }
      }
    } else {
      if (isset($_COOKIE[$email])) {
        setcookie($email, NULL, time() - 3600, "/");
        setcookie($pass, NULL, time() - 3600, "/");
        return;
      }
    }
  }
}
//-----------------------------------------------------------------------------------------------------------
//Locate users
if (isset($_POST['location_access'])) {
  $loc = $_POST['location'];
  $_SESSION['location'] = $loc;
  $response['data'] = $loc;
  $response['status'] = "success";
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//price
if (isset($_POST['price'])) {
  if (isset($_POST['price'], $_POST['item_description_id'], $_POST['store_id'])) {
    $sql = "select * from product_details
    inner join item_description on item_description.item_description_id=product_details.item_description_id
    inner join store on store.store_id=product_details.store_id
    where product_details.item_description_id=:item_description_id and product_details.store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $response["price"] = $row['price'];
    $sql1 = "select price from item inner join item_description on item_description.item_id=item.item_id  where item_description_id=:item_description_id ";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
      ':item_description_id' => $_POST['item_description_id']
    ));
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $mrp = $row1['price'];
    $save = $mrp - $row['price'];
    $off = round(($save * 100) / $mrp);
    $response["save"] = $save;
    $response["off"] = $off;
    $response["quantity"] = $row['quantity'];
    $response["availability"] = $row['availability'];
    $response["sts"] = $row['status'];
    $response["address"] = $row['address'];
    $response["store_id"] = $_POST['store_id'];
    echo json_encode($response);
  }
}
//-----------------------------------------------------------------------------------------------------------
//CART ENTRY && UPDATE
if (isset($_POST['cart'])) {
  if (isset($_POST['cart'], $_POST['item_description_id'], $_POST['store_id'], $_SESSION['name'])) {
    $id = $_SESSION['id'];
    //checking if is it available
    $sql = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $qnty = $row['quantity'];
    if ($qnty != 0) {
      $sql3 = "select * from cart where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id'],
        ':user_id' => $id
      ));
      $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
      $sqlp = "select price from product_details
        inner join item_description on item_description.item_description_id=product_details.item_description_id
        where item_description.item_description_id=:item_description_id and store_id=:store_id";
      $stmtp = $pdo->prepare($sqlp);
      $stmtp->execute(array(
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $rowp = $stmtp->fetch(PDO::FETCH_ASSOC);
      $price = $rowp['price'];
      //DATE && TIME
      if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
      }
      //DATE && TIME
      $date = date("Y\-m\-d");
      $time = date("H:i:s");
      if ($row3) {
        $sql2 = "update cart set quantity=quantity+1,total_amt=total_amt+:price,date_of_order=:date,time_of_order=:time where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute(array(
          ':user_id' => $id,
          ':price' => $price,
          ':date' => $date,
          ':time' => $time,
          ':item_description_id' => $_POST['item_description_id'],
          'store_id' => $_POST['store_id']
        ));
      } else {
        $sql1 = "insert into cart (user_id,item_description_id,store_id,quantity,date_of_order,time_of_order,total_amt,order_type) values (:user_id,:item_description_id,:store_id,quantity+1,:date,:time,:total,'booking')";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute(array(
          ':user_id' => $id,
          ':total' => $price,
          ':date' => $date,
          ':time' => $time,
          ':item_description_id' => $_POST['item_description_id'],
          'store_id' => $_POST['store_id']
        ));
      }
      $sql2 = "update product_details set quantity=quantity-1 where item_description_id=:item_description_id and store_id=:store_id";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute(array(
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    } else {
      $sql2 = "update product_details set availability='no' where item_description_id=:item_description_id and store_id=:store_id";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute(array(
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "error1";
    }
    $cartcnt = cntcart($id);
    $response['cartcnt'] = $cartcnt;
  } else {
    $response['status'] = "error";
  }
  echo json_encode($response);
}
//COMPLETED 1
//-----------------QUANTITY CHECK------------------------------------------------------------------------------------------
if (isset($_POST['check_quantity'])) {
  $id = $_SESSION['id'];
  $sql = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':item_description_id' => $_POST['item_description_id'],
    'store_id' => $_POST['store_id']
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $sql2 = "select * from cart where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute(array(
    ':item_description_id' => $_POST['item_description_id'],
    'store_id' => $_POST['store_id'],
    'user_id' => $id
  ));
  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  $tot_quantity = $row['quantity'] + $row2['quantity'];
  if ($tot_quantity >= $_POST['quantity']) {
    $response['status'] = "avail";
  } else {
    $response['status'] = "notavail";
    $response['max_qnty'] = $tot_quantity;
  }
  echo json_encode($response);
}
//-----------------ITEM UPDATE------------------------------------------------------------------------------------------
if (isset($_POST['update_cart_item'])) {
  $id = $_SESSION['id'];
  $cartcnt = cntcart($id);
  $response['cartcnt'] = $cartcnt;
  $sql = "select * from cart where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':item_description_id' => $_POST['item_description_id'],
    'store_id' => $_POST['store_id'],
    'user_id' => $id
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($row) {
    $quantity_diff = $row['quantity'] - $_POST['quantity'];
    if ($_POST['order_type'] == 1) {
      $type = "booking";
    } else {
      $type = "delivery";
    }
    $sql1 = "update cart set quantity=:quantity,total_amt=:total,order_type=:type where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
      ':quantity' => $_POST['quantity'],
      ':total' => $_POST['total_amt'],
      ':type' => $type,
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id'],
      'user_id' => $id
    ));
    $sql2 = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $empty_check = $row2['quantity'] + $quantity_diff;
    if ($empty_check == 0) {
      $sql3 = "update product_details set quantity=:quantity,availability='no' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] + $quantity_diff,
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    } else {
      $sql3 = "update product_details set quantity=:quantity,availability='yes' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] + $quantity_diff,
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    }
    $sqlcst = "select sum(product_details.price*cart.quantity) as subtotal from cart inner join product_details on product_details.item_description_id=cart.item_description_id WHERE product_details.item_description_id=cart.item_description_id AND cart.store_id=product_details.store_id and cart.user_id=:id";
    $stmtcst = $pdo->prepare($sqlcst);
    $stmtcst->execute(array(
      ':id' => $id
    ));
    $rowcst = $stmtcst->fetch(PDO::FETCH_ASSOC);
    $response['total'] = $rowcst['subtotal'];
  } else {
    //checking if is it available
    $sql = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $qnty = $_POST['quantity'];
    if ($qnty != 0) {
      $price = $_POST['total_amt'];
      //DATE && TIME
      if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
      }
      //DATE && TIME
      $date = date("Y\-m\-d");
      $time = date("H:i:s");
      if ($_POST['order_type'] == 1) {
        $type = "booking";
      } else {
        $type = "delivery";
      }
      $sql1 = "insert into cart (user_id,item_description_id,store_id,quantity,date_of_order,time_of_order,total_amt,order_type) values (:user_id,:item_description_id,:store_id,:quantity,:date,:time,:total,:order_type)";
      $stmt1 = $pdo->prepare($sql1);
      $stmt1->execute(array(
        ':user_id' => $id,
        ':total' => $price,
        ':date' => $date,
        ':quantity' => $_POST['quantity'],
        ':time' => $time,
        ':order_type' => $_POST['order_type'],
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
    }
    $sql2 = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $empty_check = $row2['quantity'] - $_POST['quantity'];
    if ($empty_check == 0) {
      $sql3 = "update product_details set quantity=:quantity,availability='no' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] - $_POST['quantity'],
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    } else {
      $sql3 = "update product_details set quantity=:quantity,availability='yes' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] - $_POST['quantity'],
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    }
    $sqlcst = "select sum(product_details.price*cart.quantity) as subtotal from cart inner join product_details on product_details.item_description_id=cart.item_description_id WHERE product_details.item_description_id=cart.item_description_id AND cart.store_id=product_details.store_id and cart.user_id=:id";
    $stmtcst = $pdo->prepare($sqlcst);
    $stmtcst->execute(array(
      ':id' => $id
    ));
    $rowcst = $stmtcst->fetch(PDO::FETCH_ASSOC);
    $response['total'] = $rowcst['subtotal'];
    $cartcnt = cntcart($id);
    $response['cartcnt'] = $cartcnt;
  }
  if ($response['status'] != "success") {
    $response['status'] = "error";
  }
  echo json_encode($response);
}
//-----------------ITEM UPDATE------------------------------------------------------------------------------------------
//-----------------CART UPDATE------------------------------------------------------------------------------------------
if (isset($_POST['update_user_cart'])) {
  $id = $_SESSION['id'];
  $cartcnt = cntcart($id);
  $response['cartcnt'] = $cartcnt;
  $sql = "select * from cart where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':item_description_id' => $_POST['item_description_id'],
    'store_id' => $_POST['store_id'],
    'user_id' => $id
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($row) {
    $quantity_diff = $row['quantity'] - $_POST['quantity'];
    if ($_POST['order_type'] == 1) {
      $type = "booking";
    } else {
      $type = "delivery";
    }
    $sql1 = "update cart set quantity=:quantity,total_amt=:total,order_type=:type where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
      ':quantity' => $_POST['quantity'],
      ':total' => $_POST['total_amt'],
      ':type' => $type,
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id'],
      'user_id' => $id
    ));
    $sql2 = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $empty_check = $row2['quantity'] + $quantity_diff;
    if ($empty_check == 0) {
      $sql3 = "update product_details set quantity=:quantity,availability='no' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] + $quantity_diff,
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    } else {
      $sql3 = "update product_details set quantity=:quantity,availability='yes' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] + $quantity_diff,
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    }
    $sqlcst = "select sum(product_details.price*cart.quantity) as subtotal from cart inner join product_details on product_details.item_description_id=cart.item_description_id WHERE product_details.item_description_id=cart.item_description_id AND cart.store_id=product_details.store_id and cart.user_id=:id";
    $stmtcst = $pdo->prepare($sqlcst);
    $stmtcst->execute(array(
      ':id' => $id
    ));
    $rowcst = $stmtcst->fetch(PDO::FETCH_ASSOC);
    $response['total'] = $rowcst['subtotal'];
  } else {
    //checking if is it available
    $sql = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $qnty = $_POST['quantity'];
    if ($qnty != 0) {
      $price = $_POST['total_amt'];
      //DATE && TIME
      if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
      }
      //DATE && TIME
      $date = date("Y\-m\-d");
      $time = date("H:i:s");
      if ($_POST['order_type'] == 1) {
        $type = "booking";
      } else {
        $type = "delivery";
      }
      $sql1 = "insert into cart (user_id,item_description_id,store_id,quantity,date_of_order,time_of_order,total_amt,order_type) values (:user_id,:item_description_id,:store_id,:quantity,:date,:time,:total,:order_type)";
      $stmt1 = $pdo->prepare($sql1);
      $stmt1->execute(array(
        ':user_id' => $id,
        ':total' => $price,
        ':date' => $date,
        ':quantity' => $_POST['quantity'],
        ':time' => $time,
        ':order_type' => $_POST['order_type'],
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
    }
    $sql2 = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $empty_check = $row2['quantity'] - $_POST['quantity'];
    if ($empty_check == 0) {
      $sql3 = "update product_details set quantity=:quantity,availability='no' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] - $_POST['quantity'],
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    } else {
      $sql3 = "update product_details set quantity=:quantity,availability='yes' where item_description_id=:item_description_id and store_id=:store_id ";
      $stmt3 = $pdo->prepare($sql3);
      $stmt3->execute(array(
        ':quantity' => $row2['quantity'] - $_POST['quantity'],
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "success";
    }
    $sqlcst = "select sum(product_details.price*cart.quantity) as subtotal from cart inner join product_details on product_details.item_description_id=cart.item_description_id WHERE product_details.item_description_id=cart.item_description_id AND cart.store_id=product_details.store_id and cart.user_id=:id";
    $stmtcst = $pdo->prepare($sqlcst);
    $stmtcst->execute(array(
      ':id' => $id
    ));
    $rowcst = $stmtcst->fetch(PDO::FETCH_ASSOC);
    $response['total'] = $rowcst['subtotal'];
    $cartcnt = cntcart($id);
    $response['cartcnt'] = $cartcnt;
  }
  if ($response['status'] != "success") {
    $response['status'] = "error";
  }
  echo json_encode($response);
}
//-----------------CART REMOVE ITEM------------------------------------------------------------------------------------------
if (isset($_POST['remove_item'])) {
  $id = $_SESSION['id'];
  $sql = "select * from cart where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':item_description_id' => $_POST['item_description_id'],
    'store_id' => $_POST['store_id'],
    'user_id' => $id
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $quantity1 = $row['quantity'];
  $sql2 = "delete  from cart where item_description_id=:item_description_id and store_id=:store_id and user_id=:user_id";
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute(array(
    ':item_description_id' => $_POST['item_description_id'],
    'store_id' => $_POST['store_id'],
    'user_id' => $id
  ));
  //-----COMPLETED 2----//
  $sql3 = "update product_details set quantity=quantity+$quantity1,availability='yes' where item_description_id=:item_description_id and store_id=:store_id";
  $stmt3 = $pdo->prepare($sql3);
  $stmt3->execute(array(
    ':item_description_id' => $_POST['item_description_id'],
    'store_id' => $_POST['store_id']
  ));
  $sql4 = "select COUNT(item_description_id) as mulval2 from cart where user_id=:id and item_description_id=:item_description_id";
  $stmt4 = $pdo->prepare($sql4);
  $stmt4->execute(array(
    ':id' => $id,
    ':item_description_id' => $_POST['item_description_id']
  ));
  $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
  if ($row4['mulval2'] == 1) {
    $response['mulrow'] = "sin";
  } else {
    $response['mulrow'] = "mul";
  }
  $sqlcst = "select sum(product_details.price*cart.quantity) as subtotal from cart
    inner join product_details on product_details.item_description_id=cart.item_description_id
    WHERE product_details.item_description_id=cart.item_description_id AND cart.store_id=product_details.store_id and cart.user_id=:id";
  $stmtcst = $pdo->prepare($sqlcst);
  $stmtcst->execute(array(
    ':id' => $id
  ));
  $rowcst = $stmtcst->fetch(PDO::FETCH_ASSOC);
  $sqlemp = "select COUNT(cart_id) AS cnt from cart where user_id=:id";
  $stmtemp = $pdo->prepare($sqlemp);
  $stmtemp->execute(array(
    ':id' => $id
  ));
  $rowemp = $stmtemp->fetch(PDO::FETCH_ASSOC);
  $cartcnt = cntcart($id);
  $response['cartcnt'] = $cartcnt;
  $response['cart'] = $rowemp['cnt'];
  $response['total'] = $rowcst['subtotal'];
  $response['divhide'] = "tbl_s" . $_POST['store_id'] . "i" . $_POST['item_description_id'];
  $response['status'] = "success";
  echo json_encode($response);
}
//-----------------CART  ITEM COUNT------------------------------------------------------------------------------------------
if (isset($_POST['cartcnt'])) {
  $uid = $_POST['user'];
  $sqlcart = "select COUNT(cart_id) AS cartcnt FROM cart WHERE user_id=$uid";
  $stmtcart = $pdo->query($sqlcart);
  $rowcart = $stmtcart->fetch(PDO::FETCH_ASSOC);
  $response['status'] = "success";
  $_SESSION['cart_count'] = $rowcart['cartcnt'];
  $response['cartcnt'] = $rowcart['cartcnt'];
  echo json_encode($response);
}
function cntcart($uid)
{
  require "../Common/pdo.php";
  $id = $uid;
  $sqlcart = "select COUNT(cart_id) AS cartcnt FROM cart WHERE user_id=$id";
  $stmtcart = $pdo->query($sqlcart);
  $rowcart = $stmtcart->fetch(PDO::FETCH_ASSOC);
  $_SESSION['cart_count'] = $rowcart['cartcnt'];
  return $rowcart['cartcnt'];
}
//----------------------------------ADVANCED LOG IN AUTOMATION---------------------------------------------------------
//Advanced Log in page operations
if (isset($_POST['adlogin'])) {
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $remember = $_POST['remember'];
    $osemail = "OneStore_email";
    $ospass = "OneStore_password";
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $sql = "select user_id,first_name,password,email,activation_code from users where email='$email'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sql2 = "select id,username,password,activation_code,email from store_admin where email='$email' and activation_code = 'activated'";
    $stmt2 = $pdo->query($sql2);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row && $row2) {
      if (($row2['activation_code'] != 'activated') && ($row['activation_code'] != 'activated')) {
        $_SESSION['errorlogin'] = "Check and verify your email";
        $response['status'] = "error1";
      } else {
        if ((password_verify($_POST['password'], $row2['password'])) && (password_verify($_POST['password'], $row['password']))) {
          $emailcasecheck2 = strcmp($row2['email'], $_POST['email']);
          $emailcasecheck1 = strcmp($row['email'], $_POST['email']);
          if ($emailcasecheck1 == 0 && $emailcasecheck2 == 0) {
            $_SESSION['sname'] = $row2['username'];
            $_SESSION['sid'] = $row2['id'];
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['id'] = $row['user_id'];
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
              if ($remember == 1) {
                setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
                setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
              }
            } else if (!isset($_COOKIE[$osemail])) {
              if ($remember == 1) {
                setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
                setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
              }
            }
            $response['admin'] = "true";
            $response['user'] = "true";
            $response['id'] = $row2['id'];
          }
        } else {
          $_SESSION['errorlogin'] = "Incorrect Email ID or Password";
          if (isset($_COOKIE[$osemail])) {
            setcookie($osemail, NULL, time() - 3600, "/");
            setcookie($ospass, NULL, time() - 3600, "/");
          }
          $response['status'] = "error";
        }
      }
      header('Content-type: application/json');
      echo json_encode($response);
      return;
    } else if ($row2) {
      if (password_verify($_POST['password'], $row2['password'])) {
        $emailcasecheck = strcmp($row2['email'], $_POST['email']);
        if ($emailcasecheck == 0) {
          $_SESSION['sname'] = $row2['username'];
          $_SESSION['sid'] = $row2['id'];
          if (isset($_COOKIE[$osemail])) {
            setcookie($osemail, NULL, time() - 3600, "/");
            setcookie($ospass, NULL, time() - 3600, "/");
            if ($remember == 1) {
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            }
          }
          if (!isset($_COOKIE[$osemail])) {
            if ($remember == 1) {
              setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
              setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
            }
          }
          $response['status'] = "admin";
          $response['id'] = $row2['id'];
        }
      } else {
        $_SESSION['error'] = "Incorrect Email ID or Password";
        if (isset($_COOKIE[$osemail])) {
          setcookie($osemail, NULL, time() - 3600, "/");
          setcookie($ospass, NULL, time() - 3600, "/");
        }
        $response['status'] = "error";
      }
    } else if ($row) {
      if ($row['activation_code'] != 'activated') {
        $_SESSION['error'] = "Check and verify your email";
        $response['status'] = "error1";
      } else {
        if (password_verify($_POST['password'], $row['password'])) {
          $emailcasecheck = strcmp($row['email'], $_POST['email']);
          if ($emailcasecheck == 0) {
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['id'] = $row['user_id'];
            $email = "OneStore_email";
            $pass = "OneStore_password";
            if ($remember == 1) {
              if (isset($_COOKIE[$osemail])) {
                setcookie($osemail, NULL, time() - 3600, "/");
                setcookie($ospass, NULL, time() - 3600, "/");
                if ($remember == 1) {
                  setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
                  setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
                }
              } else if (!isset($_COOKIE[$osemail]) || $_COOKIE[$osemail] != $_POST['email']) {
                setcookie($osemail, NULL, time() - 3600, "/");
                setcookie($ospass, NULL, time() - 3600, "/");
                if ($remember == 1) {
                  setcookie($osemail, $_POST['email'], time() + (2 * 30 * 24 * 60 * 60), "/");
                  setcookie($ospass, $_POST['password'], time() + (2 * 30 * 24 * 60 * 60), "/");
                }
              }
              $response['status'] = "success";
            } else if ($remember == 0) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
              $response['status'] = "success";
            }
          } else {
            $_SESSION['error'] = "Incorrect Email ID or Password";
            if (isset($_COOKIE[$osemail])) {
              setcookie($osemail, NULL, time() - 3600, "/");
              setcookie($ospass, NULL, time() - 3600, "/");
            }
            $response['status'] = "error";
          }
        } else {
          $_SESSION['error'] = "Incorrect Password";
          if (isset($_COOKIE[$osemail])) {
            setcookie($osemail, NULL, time() - 3600, "/");
            setcookie($ospass, NULL, time() - 3600, "/");
          }
          $response['status'] = "error";
        }
      }
    } else {
      $_SESSION['error'] = "You are not registered yet";
      $response['status'] = "errornotfound";
    }
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//----------------------------------FORGOT LOG IN AUTOMATION---------------------------------------------------------
//FORGOT Log in page operations
if (isset($_POST['forgotlogin'])) {
  if (isset($_POST['email'])) {
    $emailget = htmlentities($_POST['email']);
    $sql = "select user_id,first_name,last_name,password,email,activation_code from users where email='$emailget'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sql2 = "select sa.id,sa.username,st.store_name,sa.password,sa.email from store_admin sa inner join store st on st.store_id=sa.store_id where email='$emailget'";
    $stmt2 = $pdo->query($sql2);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $otp = rand(100000, 999999);
    if ($row) {
      if ($row['activation_code'] != 'activated') {
        $_SESSION['error'] = "Check and verify your email";
        $response['status'] = "error1";
      } else {
        $_SESSION['forgot_pass_email'] = $emailget;
        $first_name = $row['first_name'];
        $emailcasecheck = strcmp($row['email'], $_POST['email']);
        if ($emailcasecheck == 0) {
          $_SESSION['name'] = $row['first_name'];
          $_SESSION['id'] = $row['user_id'];
          $email = "OneStore_email";
          $pass = "OneStore_password";
          if (isset($_COOKIE[$email])) {
            setcookie($email, NULL, time() - 3600, "/");
            setcookie($pass, NULL, time() - 3600, "/");
          } else if (!isset($_COOKIE[$email]) || $_COOKIE[$email] != $_POST['email']) {
            setcookie($email, NULL, time() - 3600, "/");
            setcookie($pass, NULL, time() - 3600, "/");
          }
          //EMAIL SENDING//
          $from = 'onestoreforallyourneeds@gmail.com';
          $subject = 'Reset password verification OTP';
          $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
          $activate_link = '../../extras/OS/pages/FRL/OTP-v2.php?otp=' . $otp;
          $message = '
 <table style="width:100%!important">
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $row['last_name'] . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">OTP generated for password recovery.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID : <span style="font-weight:bold;color:#000">' . $row['user_id'] . '</span> </p></td>
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
                 <td valign="top" align="left"> <p style="margin-top:5px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $row['email'] . '</span> </p> </td>
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
          /*
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
                  require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
                  $mail = new PHPMailer;
                  $mail->isSMTP();
                  $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
                  $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
                  $mail->Port = 587; // TLS only
                  $mail->SMTPSecure = 'tls'; // ssl is deprecated
                  $mail->SMTPAuth = true;
                  $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
                  $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
                  $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
                  $mail->addAddress($_POST['email'],$first_name ); // to email and name
                  $mail->Subject = $subject;
                  $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
                  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
                  // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
                  $mail->SMTPOptions = array(
                                      'ssl' => array(
                                          'verify_peer' => false,
                                          'verify_peer_name' => false,
                                          'allow_self_signed' => true
                                      )
                                  );
          */
          // Everything seems OK, time to send the email.
          $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
          $mail->isSMTP();
          $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
          $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
          $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
          $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
          $mail->SMTPAuth = true;
          $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
          $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
          // Recipients
          $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
          $mail->addAddress($_POST['email'], $first_name); // to email and name
          // Content
          $mail->Subject = $subject;
          $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
          $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
          if (!$mail->send()) {
            $response['status'] = "error4";
            $_SESSION['error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
            //echo "Mailer Error: " . $mail->ErrorInfo;
          } else {
            $sqlu = "update users set password_reset=:otp,attempt=1 where email=:email";
            $stmtu = $pdo->prepare($sqlu);
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $stmtu->execute(array(
              ':otp' => $otp,
              ':email' => $emailget
            ));
            $response['status'] = "success";
          }
          //EMAIL SENDING//
        }//end email check
        else {
          $_SESSION['error'] = "Incorrect Email ID";
          if (isset($_COOKIE[$email])) {
            setcookie($email, NULL, time() - 3600, "/");
            setcookie($pass, NULL, time() - 3600, "/");
          }
          $response['status'] = "error";
        }
      }//else acticate
    }//end row user
    else if ($row2) {
      $emailcasecheck = strcmp($row2['email'], $_POST['email']);
      if ($emailcasecheck == 0) {
        $email = "OneStore_email";
        $pass = "OneStore_password";
        if (isset($_COOKIE[$email])) {
          setcookie($email, NULL, time() - 3600, "/");
          setcookie($pass, NULL, time() - 3600, "/");
        }
        //EMAIL SENDING//
        $from = 'onestoreforallyourneeds@gmail.com';
        $subject = 'OTP generated for password recovery';
        $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        $activate_link = '../../extras/OS/pages/FRL/OTP-v2.php?otp=' . $otp;
        $message = '
 <table style="width:100%!important">
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
                   <span style="font-weight:bold;color:#191919"> ' . $row2['username'] . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">OTP generated for password recovery.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">Store ID : <span style="font-weight:bold;color:#000">OSSID' . sprintf('%06d', $row2['id']) . '</span> </p></td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px;text-align: justify;">Seems like you lost your key to your One-Store ' . $row2['store_name'] . ' .One time OTP for recovering your password is generated below .Enjoy shopping with us.</p><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px"> .Please click the  click the following button to reset your password .</p> </td>
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
                 <td valign="top" align="left"> <p style="margin-top:5px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $row2['email'] . '</span> </p> </td>
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
        // Everything seems OK, time to send the email.
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
        $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
        $mail->SMTPAuth = true;
        $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
        $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
        // Recipients
        $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
        $mail->addAddress($_POST['email'], $row2['username']); // to email and name
        // Content
        $mail->Subject = $subject;
        $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
        $mail->SMTPOptions = array(
          'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
          )
        );
        if (!$mail->send()) {
          $response['status'] = "error4";
          $_SESSION['error'] = "Email can't Send";
          //echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          $sqlsa = "update store_admin set password_reset=:otp,attempt=1 where email=:email";
          $stmtsa = $pdo->prepare($sqlsa);
          // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
          $stmtsa->execute(array(
            ':otp' => $otp,
            ':email' => $emailget
          ));
          $response['status'] = "admin";
        }
        //EMAIL SENDING//
        $response['otp'] = $otp;
      }//end emailcasecheck
      else {
        $_SESSION['error'] = "Incorrect Email ID";
        if (isset($_COOKIE[$email])) {
          setcookie($email, NULL, time() - 3600, "/");
          setcookie($pass, NULL, time() - 3600, "/");
        }
        $response['status'] = "error";
      }
    }//end row2
    else {
      $_SESSION['error'] = "You are not registered yet";
      $response['status'] = "errornotfound";
    }
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//----------------------------------OTP VERIFICATION---------------------------------------------------------
//OTP VERIFICATION
if (isset($_POST['otppass'])) {
  $otp = $_POST['otp'];
  $sqlotpupdate = "update users set attempt=0 where password_reset=$otp";
  $sqlotpupdate2 = "update store_admin set attempt=0 where password_reset=$otp";
  $sql = "select * from users where password_reset=$otp and attempt=1";
  $sql2 = "select * from store_admin where password_reset=$otp and attempt=1";
  $sql3 = "select * from users where password_reset=$otp and attempt=0";
  $sql4 = "select * from store_admin where password_reset=$otp and attempt=0";
  $stmt = $pdo->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt2 = $pdo->query($sql2);
  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  $stmt3 = $pdo->query($sql3);
  $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
  $stmt4 = $pdo->query($sql4);
  $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
  if ($row) {
    if ($row['attempt'] == 0) {
      $response['status'] = "expired";
    } else {
      $stmtotpupdate = $pdo->prepare($sqlotpupdate);
      $stmtotpupdate->execute();
      $response['otp'] = $otp;
      $response['status'] = "success";
    }
  } else if ($row2) {
    if ($row2['attempt'] == 0) {
      $response['status'] = "expired";
    } else {
      $stmtotpupdate2 = $pdo->prepare($sqlotpupdate2);
      $stmtotpupdate2->execute();
      $response['otp'] = $otp;
      $response['status'] = "success";
    }
  } else if ($row3 || $row4) {
    $response['status'] = "expired";
  } else {
    $response['status'] = "error";
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//----------------------------------PASSWORD RESET---------------------------------------------------------
//PASS RESET
if (isset($_POST['recoverlogin'])) {
  $otp = $_POST['otp'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $type = $_POST['type'];
  if ($type == "user") {
    $sql3 = "select activation_code from users where password_reset=$otp";
    $stmt3 = $pdo->query($sql3);
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    if ($row3['activation_code'] != "activated") {
      $response['status'] = "error1";
    } else {
      $sql = "update users set password='$password',password_reset=1 where password_reset=$otp";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $response['status'] = "success";
    }
  } else if ($type == "admin") {
    $sql4 = "select activation_code from store_admin where password_reset=$otp";
    $stmt4 = $pdo->query($sql4);
    $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
    if ($row4['activation_code'] != "activated") {
      $response['status'] = "error1";
    } else {
      $sql2 = "update store_admin set password='$password',password_reset=1 where password_reset=$otp";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute();
      $response['status'] = "success";
    }
  } else {
    $response['status'] = "error";
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//http://localhost/MY%20WEBSITES/ONESTORE/OneStore/extras/OS/pages/FRL/recover-password-v2.php?otp=123456
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------------------
//----------------------------------PLACE ORDER---------------------------------------------------------
//PLACE ORDER CART
//COMPLETED 3
if (isset($_POST['user_id'], $_POST['placeorder'])) {
  $user_id = $_POST['user_id'];
  if (isset($_POST['user'])) {
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
    $pin = $placerow_u['pincode'];
    $phone = $placerow_u['phone'];
    $email = $placerow_u['email'];
    $order_notes = $_POST['order_notes'];
    $pdt_cnt = $_POST['pdt_cnt'];
    $total_amt = $_POST['total_amt'];
    if ($_POST['user'] == 1) {
      $shipping_first_name = $first_name;
      $shipping_last_name = $last_name;
      $shipping_ph_no = $phone;
      $shipping_ph_no2 = "NULL";
      $shipping_address_1 = $address;
      $shipping_postcode = $pin;
      $sql = "select user_delivery_details_id from user_delivery_details where user_id=:user_id and type='permanent'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':user_id' => $_SESSION['id']));
      $row_uddid = $stmt->fetch(PDO::FETCH_ASSOC);
      $uddid = $row_uddid['user_delivery_details_id'];//USER DELIVERY DETAILS ID
    }
    if ($_POST['user'] == 2) {
      $shipping_first_name = $_POST['shipping_first_name'];
      $shipping_last_name = $_POST['shipping_last_name'];
      $shipping_ph_no = $_POST['shipping_ph_no'];
      $shipping_ph_no2 = $_POST['shipping_ph_no2'];
      $shipping_address_1 = $_POST['shipping_address_1'];
      $shipping_postcode = $_POST['shipping_postcode'];
      $type = 'temporary';
      $sql_delivery = "insert into user_delivery_details (first_name,last_name,phone,pincode,address,alternative_phone,user_id,type)values(:first_name,:last_name,:phone,:pincode,:address,:alternative_phone,:user_id,:type)";
      $stmt_delivery = $pdo->prepare($sql_delivery);
      // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
      $stmt_delivery->execute(array(
        ':first_name' => $shipping_first_name,
        ':last_name' => $shipping_last_name,
        ':phone' => $shipping_ph_no,
        ':pincode' => $shipping_postcode,
        ':alternative_phone' => $shipping_ph_no2,
        ':user_id' => $user_id,
        ':type' => $type,
        ':address' => $shipping_address_1
      ));
      $sql = "select max(user_delivery_details_id) as maxuddid from user_delivery_details where user_id=" . $_SESSION['id'];
      $stmt = $pdo->query($sql);
      $row_uddid = $stmt->fetch(PDO::FETCH_ASSOC);
      $uddid = $row_uddid['maxuddid'];//USER DELIVERY DETAILS ID
    }
  }
  $order_date = date("Y\-m\-j");
  $sql = "insert into order_delivery_details (user_delivery_details_id,order_notes)values(:uddid,:order_notes)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':uddid' => $uddid,
    ':order_notes' => $order_notes
  ));
  $sql = "select max(order_delivery_details_id) as maxoddid from order_delivery_details where user_delivery_details_id=" . $uddid;
  $stmt = $pdo->query($sql);
  $row_oddid = $stmt->fetch(PDO::FETCH_ASSOC);
  $oddid = $row_oddid['maxoddid'];//ORDER DELIVERY DETAILS ID
  $sql = "insert into new_orders (order_delivery_details_id,order_quantity,sub_total,order_date)values(:oddid,:order_quantity,:sub_total,:order_date)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':oddid' => $oddid,
    ':order_quantity' => $pdt_cnt,
    ':sub_total' => $total_amt,
    ':order_date' => $order_date
  ));
  $sql = "select new_orders_id  from new_orders where order_delivery_details_id=" . $oddid;
  $stmt = $pdo->query($sql);
  $row_oddid = $stmt->fetch(PDO::FETCH_ASSOC);
  $noid = $row_oddid['new_orders_id'];//NEW ORDER ID
//TEMPERORY
  $sql = "select product_details.product_details_id,cart.order_type,cart.quantity,cart.total_amt from cart join item_description on cart.item_description_id=item_description.item_description_id join product_details on product_details.item_description_id=item_description.item_description_id where cart.store_id=product_details.store_id and user_id=:user_id";
  $stmt_cart = $pdo->prepare($sql);
  $stmt_cart->execute(array(':user_id' => $_SESSION['id']));
  while ($row_cart = $stmt_cart->fetch(PDO::FETCH_ASSOC)) {
    $sql = "insert into new_ordered_products (new_orders_id,product_details_id,order_type,item_quantity,total_amt,delivery_status)values(:noid,:pdid,:order_type,:item_quantity,:total_amt,'pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':noid' => $noid,
      ':pdid' => $row_cart['product_details_id'],
      ':order_type' => $row_cart['order_type'],
      ':item_quantity' => $row_cart['quantity'],
      ':total_amt' => $row_cart['total_amt']
    ));
  }
  //TEMPERORY
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
    $order_id;
    $placesql_i = "select id.item_description_id,ca.cart_id,it.category_id,it.sub_category_id,it.item_id,it.item_name,it.description,pd.price,ca.quantity,ca.order_type,ca.total_amt from cart ca
        inner join product_details pd on ca.item_description_id=pd.item_description_id
        inner join item_description id on id.item_description_id=pd.item_description_id
        inner join store st on st.store_id=ca.store_id
        inner join item it on it.item_id=id.item_id
        where id.item_description_id=ca.item_description_id and ca.user_id=:user_id and st.store_id=:store_id GROUP BY ca.item_description_id";
    $placestmt_i = $pdo->prepare($placesql_i);
    $placestmt_i->execute(array(
      ':user_id' => $user_id,
      ':store_id' => $store_array[$j]['store_id']
    ));
    while ($placerow_i = $placestmt_i->fetch(PDO::FETCH_ASSOC)) {
      /////////////ADD AS ORDERED///////////
      $check = $pdo->query('select ordered_cnt,item_description_id from item_keys where item_description_id=' . $placerow_i['item_description_id'] . ' and user_id=' . $_SESSION['id']);
      if ($check->rowCount() > 0) {
        $checkrow = $check->fetch(PDO::FETCH_ASSOC);
        if (is_null($checkrow['ordered_cnt']) || $checkrow < 1) {
          $sql = 'update item_keys set ordered_cnt=' . $placerow_i['quantity'] . ' where item_description_id=' . $placerow_i['item_description_id'];
        } else {
          $sql = 'update item_keys set ordered_cnt=ordered_cnt+' . $placerow_i['quantity'] . ' where item_description_id=' . $placerow_i['item_description_id'];
        }
        $viewedsql = $pdo->query($sql);
      } else {
        $viewedsql = $pdo->prepare("insert into item_keys (views,ordered_cnt,user_id,item_description_id,date_of_preview) values (1,:oc,:uid,:idid,:dop)");
        $date = date("Y\-m\-d");
        $viewedsql->execute(array(
          ':oc' => $placerow_i['quantity'],
          ':uid' => $_SESSION['id'],
          ':idid' => $placerow_i['item_description_id'],
          ':dop' => $date
        ));
      }
      ////////////ADD AS ORDERED////////////
      $store_array[$j]['item_category_id'][$k] = $placerow_i['category_id'];
      $store_array[$j]['item_sub_category_id'][$k] = $placerow_i['sub_category_id'];
      $store_array[$j]['item_description_id'][$k] = $placerow_i['item_description_id'];
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
  $sqldel = "delete from cart where user_id=" . $_SESSION['id'];
  $stmtdel = $pdo->query($sqldel);
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EMAIL SENDING//
  $from = 'onestoreforallyourneeds@gmail.com';
  $subject = 'Your requested orders';
  $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
  $activate_link = '../Order/myorders.php?id=' . $user_id;
  //EMAIL SENDING//
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $message1 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
               <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Processed</span></p> </td>
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
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $last_name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Order has been successfully processed.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID <span style="font-weight:bold;color:#000">OSUID' . sprintf('%06d', $user_id) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">OSID' . sprintf('%06d', $noid) . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Your order for the below listed item(s) is processed successfully  by <b>' . date("F j") . " , " . date("Y") . '</b> and will be available for you to purchase at specific shops mentioned below . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $total_bill . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_first_name . " " . $shipping_last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_address_1 . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_postcode . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
               <tbody>
                <tr>
                 <td valign="top" align="left"><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: If you do not collect your items (booked) from specified shop with in specified period of time(varies according to the items) , your order will be cancelled.
                    In case this items will be removed from your cart and moved to wishlist .Thereafter you need to purchase it again as per as your needs. </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>';
  for ($l = 0; $l < $i; $l++) {
    $store_total = 0;
    $message1 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
				<tr>
					<td>
						<table width="600" align="center">
							<tr colspan="2" >
								<td>
									<h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 8px;padding-bottom: 25px;font-family:Arial">
								    <span style="float:left;">Opening hours : ' . $store_array[$l]['opening_hours'] . '</span>
								    <span style="float:right;">Store : ' . $store_array[$l]['store_name'] . '</span><br>
								    <span style="float:left;">status : ' . $store_array[$l]['status'] . '</span>
								    <span style="float:right;">Ph : ' . $store_array[$l]['phone'] . '</span>';
    $message1 .= '</h4></td></tr></table></td></tr></table>';
    for ($m = 0; $m < $store_cnt[$l]; $m++) {
      $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $store_array[$l]['item_description_id'][$m] . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $store_array[$l]['item_category_id'][$m] . '/' . $store_array[$l]['item_sub_category_id'][$m] . '/' . $store_array[$l]['item_description_id'][$m] . '.jpg" alt="' . $store_array[$l]['item_name'][$m] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
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
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Total: &#8377; ' . $store_array[$l]['item_total_amt'][$m] . '</p>';
      $store_total += $store_array[$l]['item_total_amt'][$m];
      $message1 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    }
    $message1 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount to be Paid @' . $store_array[$l]['store_name'] . ': &#8377; ' . $store_total . '</p>
				<hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
  }
  $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                    <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
  /*
          require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
          require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
          require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
          $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
          $mail->Port = 587; // TLS only
          $mail->SMTPSecure = 'tls'; // ssl is deprecated
          $mail->SMTPAuth = true;
          $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
          $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
          $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
          $mail->addAddress($email,$first_name ); // to email and name
          $mail->Subject = $subject;
          $mail->msgHTML($message1);//(file_get_contents('ordermailtouser.php'),'' ); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
          $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
          // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
  */
  // Everything seems OK, time to send the email.
  $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  $mail->isSMTP();
  $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
  $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
  $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
  $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
  $mail->SMTPAuth = true;
  $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
  $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
  // Recipients
  $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
  $mail->addAddress($email, $first_name); // to email and name
  // Content
  $mail->Subject = $subject;
  $mail->msgHTML($message1); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    $response['status'] = "error";
    $_SESSION['error'] = "Email can't Send";
    //echo "Mailer Error: " . $mail->ErrorInfo;
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $subject = 'Requested service';
  $activate_link = '../../Store%20admin/index.php?id=' . $user_id;
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
    $message2 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Requested</span></p> </td>
            </tr>
            <tr>
            </tr>
           </tbody>
          </table></td>
        </tr>
       </tbody>
      </table>
       </td>
    </tr>
    <tr>
     <td>
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $store_array[$l]['username'] . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px"> Order has been requested.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">Store ID <span style="font-weight:bold;color:#000">OSSID' . sprintf('%06d', $store_array[$l]['store_id']) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">OSID' . sprintf('%06d', $noid) . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Below listed item(s) are requested by the customer  by <b>' . date("F j") . " , " . date("Y") . '</b> from your store <b>' . $store_array[$l]['store_name'] . '</b>. Thanks for your cooperation with us and also wishing you best with your sales . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $total_bill . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_first_name . " " . $shipping_last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_address_1 . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_postcode . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
               <tbody>
                <br>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>  ';
    $message2 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
        <tr>
          <td>
            <table width="600" align="center">
              <tr colspan="2" >
                <td>
                  <h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 0px;padding-bottom: 0px;font-family:Arial">
                    <table width="100%" cellspacing="10px">
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer name : ' . $first_name . " " . $last_name . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">Ph : ' . $phone . '</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer id : OSUID' . sprintf('%06d', $user_id) . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">' . $email . '</span>
                        </td>
                  </tr>';
    $message2 .= '</table></h4></td></tr></table></td></tr></table>';
    for ($m = 0; $m < $store_cnt[$l]; $m++) {
      $store_array[$l]['item_description_id'][$m];
      $store_array[$l]['item_category_id'][$m];
      $store_array[$l]['item_sub_category_id'][$m];
      $store_array[$l]['item_name'][$m];
      $store_array[$l]['item_description'][$m];
      $store_array[$l]['item_price'][$m];
      $store_array[$l]['item_quantity'][$m];
      $store_array[$l]['item_ordertype'][$m];
      $store_array[$l]['item_total_amt'][$m];
      $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $store_array[$l]['item_description_id'][$m] . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $store_array[$l]['item_category_id'][$m] . '/' . $store_array[$l]['item_sub_category_id'][$m] . '/' . $store_array[$l]['item_description_id'][$m] . '.jpg" alt="' . $store_array[$l]['item_name'][$m] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
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
      $store_total += (int) $store_array[$l]['item_quantity'][$m] * (int) $store_array[$l]['item_price'][$m];
      $message2 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    }
    $message2 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount : &#8377; ' . $store_total . '</p><hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                     <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
    /*
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port = 587; // TLS only
            $mail->SMTPSecure = 'tls'; // ssl is deprecated
            $mail->SMTPAuth = true;
            $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
            $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
            $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
            $mail->addAddress( $store_array[$l]['email'],$store_array[$l]['store_name'] ); // to email and name
            $mail->Subject = $subject;
            $mail->msgHTML($message2);//(file_get_contents('ordermailtouser.php'),'' ); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
            $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
            // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    */
    // Everything seems OK, time to send the email.
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
    // Recipients
    $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    $mail->addAddress($store_array[$l]['email'], $store_array[$l]['store_name']); // to email and name
    // Content
    $mail->Subject = $subject;
    $mail->msgHTML($message2); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    if (!$mail->send()) {
      $response['status'] = "error";
      $_SESSION['error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
      //echo "Mailer Error: " . $mail->ErrorInfo;
    }
  }
  if (!isset($response['status'])) {
    $response['status'] = "success";
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//COMPLETED 3
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//DELETE LIST//
if (isset($_POST['del_list'])) {
  $sql = "delete from wishlist where wishlist_id=:wid and user_id=:uid";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':wid' => $_POST['wishlist_id'],
    ':uid' => $_SESSION['id']
  ));
  $sql = "delete from wishlist_items where wishlist_id=:wid";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':wid' => $_POST['wishlist_id']));
  $sql1 = "select count(wishlist_id) as cntlist from wishlist where user_id=:uid";
  $stmt1 = $pdo->prepare($sql1);
  $stmt1->execute(array(':uid' => $_SESSION['id']));
  $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
  $response['rem_list'] = $row1['cntlist'];
  $response['del_list'] = $_POST['wishlist_id'];
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*CREATE WISHLIST*/
if (isset($_POST['create_list'])) {
  if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
  }
  $date = date("Y\-m\-d");
  $time = date("H:i:s");
  $curr_id_stmt = $pdo->query('select max(wishlist_id) as max from wishlist');
  $curr_id_row = $curr_id_stmt->fetch(PDO::FETCH_ASSOC);
  $curr_id = $curr_id_row['max'] + 1;
  $uniqid = $curr_id . "_" . uniqid();
  $sql = 'insert into wishlist (list_name,share_link,user_id,wishlist_description,privacy,date,time) values (:list_name,:share,:user_id,:list_description,:privacy,:date,:time)';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':list_name' => htmlentities($_POST['listname']),
    ':share' => $uniqid,
    ':user_id' => $_SESSION['id'],
    ':list_description' => htmlentities($_POST['listdescription']),
    ':privacy' => $_POST['privacy'],
    ':date' => $date,
    ':time' => $time
  ));
  $sql_cnt_wid = 'select count(wishlist_id) as widcnt from wishlist where user_id=' . $_SESSION['id'];
  $stmt_cnt_wid = $pdo->query($sql_cnt_wid);
  $row_cnt_wid = $stmt_cnt_wid->fetch(PDO::FETCH_ASSOC);
  $sql_wid = 'select max(wishlist_id) as maxcnt from wishlist';
  $stmt_wid = $pdo->query($sql_wid);
  $row_wid = $stmt_wid->fetch(PDO::FETCH_ASSOC);
  $response['wid'] = $row_wid['maxcnt'];
  $response['status'] = 'success';
  $response['date'] = $date;
  $response['link'] = $uniqid;
  $response['cnt'] = $row_cnt_wid['widcnt'];
  header('Content-type: application/json');
  echo json_encode($response);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*UPDATE  WISHLIST*/
if (isset($_POST['update_list'])) {
  if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
  }
  $date = date("Y\-m\-d");
  $time = date("H:i:s");
  $sql = 'update wishlist set list_name=:list_name,user_id=:user_id,wishlist_description=:list_description,privacy=:privacy,date=:date,time=:time where wishlist_id=:wishlist_id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':list_name' => htmlentities($_POST['listname']),
    ':user_id' => $_SESSION['id'],
    ':list_description' => htmlentities($_POST['listdescription']),
    ':privacy' => $_POST['privacy'],
    ':date' => $date,
    ':time' => $time,
    ':wishlist_id' => htmlentities($_POST['wishlist_id'])
  ));
  $response['status'] = 'success';
  header('Content-type: application/json');
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//WISHLIST ENTRY && UPDATE
if (isset($_POST['addtowishlist'])) {
  if (isset($_SESSION['id'])) {
    $_SESSION['wishlist_store_id'] = $_POST['store_id'];
    $_SESSION['wishlist_item_description_id'] = $_POST['item_description_id'];
    $response['status'] = 'success';
  } else {
    $response['status'] = 'error';
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//-----------------------------------------------------------------------------------------------------------
//WISHLIST ID FETCH AND ENTER INTO DB
if (isset($_POST['fetchedwishlistid'], $_POST['wishlist_id'])) {
  if (isset($_SESSION['wishlist_item_description_id'], $_SESSION['wishlist_store_id'])) {
    $id = $_SESSION['id'];
    //checking if is it available
    $sql = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_SESSION['wishlist_item_description_id'],
      'store_id' => $_SESSION['wishlist_store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $qnty = $row['quantity'];
    $sql3 = "select * from wishlist_items inner join wishlist on wishlist.wishlist_id=wishlist_items.wishlist_id where wishlist_items.item_description_id=:item_description_id and wishlist_items.store_id=:store_id and wishlist.user_id=:user_id and wishlist.wishlist_id = :wishlist_id";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute(array(
      ':item_description_id' => $_SESSION['wishlist_item_description_id'],
      'store_id' => $_SESSION['wishlist_store_id'],
      ':user_id' => $id,
      ':wishlist_id' => $_POST['wishlist_id']
    ));
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $sqlp = "select price from product_details where item_description_id=:item_description_id and store_id=:store_id";
    $stmtp = $pdo->prepare($sqlp);
    $stmtp->execute(array(
      ':item_description_id' => $_SESSION['wishlist_item_description_id'],
      'store_id' => $_SESSION['wishlist_store_id']
    ));
    $rowp = $stmtp->fetch(PDO::FETCH_ASSOC);
    $price = $rowp['price'];
    //DATE && TIME
    if (function_exists('date_default_timezone_set')) {
      date_default_timezone_set("Asia/Kolkata");
    }
    //DATE && TIME
    $date = date("Y\-m\-d");
    $time = date("H:i:s");
    if ($row3) {
      $sql2 = "update wishlist_items wi inner join wishlist w on w.wishlist_id=wi.wishlist_id set wi.quantity=1,wi.total_amt=wi.total_amt+:price,wi.date=:date,wi.time=:time where item_description_id=:item_description_id and wi.store_id=:store_id and w.user_id=:user_id and wi.wishlist_id=:wishlist_id";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute(array(
        ':user_id' => $id,
        ':price' => $price,
        ':date' => $date,
        ':time' => $time,
        ':item_description_id' => $_SESSION['wishlist_item_description_id'],
        'store_id' => $_SESSION['wishlist_store_id'],
        ':wishlist_id' => $_POST['wishlist_id']
      ));
      $response['status'] = "success1";
    } else {
      $sql1 = "insert into wishlist_items (wishlist_id,item_description_id,store_id,quantity,date,time,total_amt) values (:wishlist_id,:item_description_id,:store_id,quantity+1,:date,:time,:total)";
      $stmt1 = $pdo->prepare($sql1);
      $stmt1->execute(array(
        ':wishlist_id' => $_POST['wishlist_id'],
        ':total' => $price,
        ':date' => $date,
        ':time' => $time,
        ':item_description_id' => $_SESSION['wishlist_item_description_id'],
        'store_id' => $_SESSION['wishlist_store_id']
      ));
      $response['status'] = "success";
    }
    $response['new_wish_cnt'] = wishlist_item_count($_POST['wishlist_id']);
  } else {
    $response['status'] = "error";
  }
  echo json_encode($response);
}
//-----------------WISHLIST REMOVE ITEM--------------------------------------------------------------------------------------
if (isset($_POST['wishlist_remove_item'])) {
  $id = $_SESSION['id'];
  $sql = "select * from wishlist_items where wishlist_items_id=:wi_id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':wi_id' => $_POST['wishlist_items_id']
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $wishlist_id = $row['wishlist_id'];
  $sql2 = "delete  from wishlist_items where wishlist_items_id=:wi_id";
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute(array(
    ':wi_id' => $_POST['wishlist_items_id']
  ));
  $sql4 = "select COUNT(wishlist_items_id) as mulval2 from wishlist_items where wishlist_id=:wishlist_id";
  $stmt4 = $pdo->prepare($sql4);
  $stmt4->execute(array(
    ':wishlist_id' => $wishlist_id
  ));
  $row4 = $stmt4->fetch(PDO::FETCH_ASSOC);
  if ($row4['mulval2'] % 2 == 0) {
    $response['mulrow'] = "even";
  } else {
    $response['mulrow'] = "odd";
  }
  $response['cartcnt'] = $row4['mulval2'];
  $response['divhide'] = "tbl_wi" . $_POST['wishlist_items_id'];
  $response['status'] = "success";
  echo json_encode($response);
}
//-----------------WISHLIST COUNT------------------------------------------------------------------------------------------
function wishlist_item_count($wish_id)
{
  require "../Common/pdo.php";
  $wishlist_cnt = "select count(wishlist_items.wishlist_id) as item_count FROM wishlist_items
  join wishlist on wishlist_items.wishlist_id=wishlist.wishlist_id where wishlist.user_id=:id and wishlist_items.wishlist_id=:wid ";
  $wishlist_cnt_stmt = $pdo->prepare($wishlist_cnt);
  $wishlist_cnt_stmt->execute(array(
    ':id' => $_SESSION['id'],
    ':wid' => $wish_id
  ));
  $wishlist_cnt_row = $wishlist_cnt_stmt->fetch(PDO::FETCH_ASSOC);
  $wish_cnt = $wishlist_cnt_row['item_count'];
  return $wish_cnt;
}
//-----------------WISHLIST COUNT ITEM-------------------------------------------------------------------------------------
//-----------------BUY NOW ITEM------------------------------------------------------------------------------------------
if (isset($_POST['buynow_item'])) {
  if (isset($_SESSION['id'])) {
    //checking if is it available
    $sql = "select * from product_details
      inner join item_description on item_description.item_description_id=product_details.item_description_id
      where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $qnty = $row['quantity'];
    if ($qnty != 0) {
      $sql = "select user_id from users where user_id=" . $_SESSION['id'];
      $stmt = $pdo->query($sql);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
        $response['status'] = "success";
      } else {
        $response['status'] = "error2";
      }
    } else {
      $sql2 = "update product_details set availability='no' where item_description_id=:item_description_id and store_id=:store_id";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute(array(
        ':item_description_id' => $_POST['item_description_id'],
        'store_id' => $_POST['store_id']
      ));
      $response['status'] = "error";
    }
  } else {
    $response['status'] = "error1";
  }
  echo json_encode($response);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------------------
//----------------------------------PLACE ORDER BUY NOW---------------------------------------------------------
//PLACE ORDER BUY NOW
//COMPLETED 3
if (isset($_POST['user_id'], $_POST['buynow_placeorder'])) {
  $user_id = $_POST['user_id'];
  if (isset($_POST['user'])) {
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
    $pin = $placerow_u['pincode'];
    $phone = $placerow_u['phone'];
    $email = $placerow_u['email'];
    $order_notes = $_POST['order_notes'];
    $pdt_cnt = $_POST['pdt_cnt'];
    $total_amt = $_POST['total_amt'];
    if ($_POST['user'] == 1) {
      $shipping_first_name = $first_name;
      $shipping_last_name = $last_name;
      $shipping_ph_no = $phone;
      $shipping_ph_no2 = "NULL";
      $shipping_address_1 = $address;
      $shipping_postcode = $pin;
      $sql = "select user_delivery_details_id from user_delivery_details where user_id=:user_id and type='permanent'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':user_id' => $_SESSION['id']));
      $row_uddid = $stmt->fetch(PDO::FETCH_ASSOC);
      $uddid = $row_uddid['user_delivery_details_id'];//USER DELIVERY DETAILS ID
    }
    if ($_POST['user'] == 2) {
      $shipping_first_name = $_POST['shipping_first_name'];
      $shipping_last_name = $_POST['shipping_last_name'];
      $shipping_ph_no = $_POST['shipping_ph_no'];
      $shipping_ph_no2 = $_POST['shipping_ph_no2'];
      $shipping_address_1 = $_POST['shipping_address_1'];
      $shipping_postcode = $_POST['shipping_postcode'];
      $type = 'temporary';
      $sql_delivery = "insert into user_delivery_details (first_name,last_name,phone,pincode,address,alternative_phone,user_id,type)values(:first_name,:last_name,:phone,:pincode,:address,:alternative_phone,:user_id,:type)";
      $stmt_delivery = $pdo->prepare($sql_delivery);
      // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
      $stmt_delivery->execute(array(
        ':first_name' => $shipping_first_name,
        ':last_name' => $shipping_last_name,
        ':phone' => $shipping_ph_no,
        ':pincode' => $shipping_postcode,
        ':alternative_phone' => $shipping_ph_no2,
        ':user_id' => $user_id,
        ':type' => $type,
        ':address' => $shipping_address_1
      ));
      $sql = "select max(user_delivery_details_id) as maxuddid from user_delivery_details where user_id=" . $_SESSION['id'];
      $stmt = $pdo->query($sql);
      $row_uddid = $stmt->fetch(PDO::FETCH_ASSOC);
      $uddid = $row_uddid['maxuddid'];//USER DELIVERY DETAILS ID
    }
  }
  /////////////ADD AS ORDERED///////////
  $check = $pdo->query('select ordered_cnt,item_description_id from item_keys where item_description_id=' . $_POST['idid'] . ' and user_id=' . $_SESSION['id']);
  if ($check->rowCount() > 0) {
    $checkrow = $check->fetch(PDO::FETCH_ASSOC);
    if (is_null($checkrow['ordered_cnt']) || $checkrow < 1) {
      $sql = 'update item_keys set ordered_cnt=' . $_POST['pdt_cnt'] . ' where item_description_id=' . $_POST['idid'];
    } else {
      $sql = 'update item_keys set ordered_cnt=ordered_cnt+' . $_POST['pdt_cnt'] . ' where item_description_id=' . $_POST['idid'];
    }
    $viewedsql = $pdo->query($sql);
  } else {
    $viewedsql = $pdo->prepare("insert into item_keys (views,ordered_cnt,user_id,item_description_id,date_of_preview) values (1,:oc,:uid,:idid,:dop)");
    $date = date("Y\-m\-d");
    $viewedsql->execute(array(
      ':oc' => $_POST['pdt_cnt'],
      ':uid' => $_SESSION['id'],
      ':idid' => $_POST['idid'],
      ':dop' => $date
    ));
  }
  ////////////ADD AS ORDERED////////////
  $order_date = date("Y\-m\-j");
  $sql = "insert into order_delivery_details (user_delivery_details_id,order_notes)values(:uddid,:order_notes)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':uddid' => $uddid,
    ':order_notes' => $order_notes
  ));
  $sql = "select max(order_delivery_details_id) as maxoddid from order_delivery_details where user_delivery_details_id=" . $uddid;
  $stmt = $pdo->query($sql);
  $row_oddid = $stmt->fetch(PDO::FETCH_ASSOC);
  $oddid = $row_oddid['maxoddid'];//ORDER DELIVERY DETAILS ID
  $sql = "insert into new_orders (order_delivery_details_id,order_quantity,sub_total,order_date)values(:oddid,1,:sub_total,:order_date)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':oddid' => $oddid,
    ':sub_total' => $total_amt,
    ':order_date' => $order_date
  ));
  $sql = "select new_orders_id  from new_orders where order_delivery_details_id=" . $oddid;
  $stmt = $pdo->query($sql);
  $row_oddid = $stmt->fetch(PDO::FETCH_ASSOC);
  $noid = $row_oddid['new_orders_id'];//NEW ORDER ID
//TEMPERORY
  $sql = "select product_details.product_details_id from item_description
  join product_details on product_details.item_description_id=item_description.item_description_id where item_description.item_description_id=:idid and product_details.store_id=:store_id";
  $stmt_cart = $pdo->prepare($sql);
  $stmt_cart->execute(array(':idid' => $_POST['idid'], ':store_id' => $_POST['store_id']));
  while ($row_cart = $stmt_cart->fetch(PDO::FETCH_ASSOC)) {
    $pdid = $row_cart['product_details_id'];
    $sql = "insert into new_ordered_products (new_orders_id,product_details_id,order_type,item_quantity,total_amt,delivery_status)values(:noid,:pdid,:order_type,:item_quantity,:total_amt,'pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':noid' => $noid,
      ':pdid' => $row_cart['product_details_id'],
      ':order_type' => $_POST['order_type'],
      ':item_quantity' => $_POST['pdt_cnt'],
      ':total_amt' => $_POST['total_amt']
    ));
    $pdcnt = $_POST['pdt_cnt'];
    $sql2 = "update product_details set quantity=quantity-$pdcnt where product_details_id=:pdid";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(
      ':pdid' => $row_cart['product_details_id']
    ));
  }
  //TEMPERORY
  $placesql_s = "select* from store st inner join product_details pd on st.store_id=pd.store_id inner join store_admin sa on st.store_id=sa.store_id where st.store_id=:store_id  GROUP BY st.store_id";
  $placestmt_s = $pdo->prepare($placesql_s);
  $placestmt_s->execute(array(':store_id' => $_POST['store_id']));
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
    $order_id;
    $placesql_i = "select id.item_description_id,it.category_id,it.sub_category_id,it.item_id,it.item_name,it.description,pd.price from  product_details pd
        inner join item_description id on id.item_description_id=pd.item_description_id
        inner join store st on st.store_id=pd.store_id
        inner join item it on it.item_id=id.item_id
        where id.item_description_id=pd.item_description_id and st.store_id=:store_id and pd.product_details_id=:pdid AND  id.item_description_id=:idid";
    $placestmt_i = $pdo->prepare($placesql_i);
    $placestmt_i->execute(array(
      ':pdid' => $pdid,
      ':idid' => $_POST['idid'],
      ':store_id' => $_POST['store_id']
    ));
    while ($placerow_i = $placestmt_i->fetch(PDO::FETCH_ASSOC)) {
      $store_array[$j]['item_category_id'][$k] = $placerow_i['category_id'];
      $store_array[$j]['item_sub_category_id'][$k] = $placerow_i['sub_category_id'];
      $store_array[$j]['item_description_id'][$k] = $placerow_i['item_description_id'];
      $store_array[$j]['item_name'][$k] = $placerow_i['item_name'];
      $store_array[$j]['item_description'][$k] = $placerow_i['description'];
      $store_array[$j]['item_price'][$k] = $placerow_i['price'];
      $store_array[$j]['item_quantity'][$k] = $_POST['pdt_cnt'];
      $store_array[$j]['item_ordertype'][$k] = $_POST['order_type'];
      $store_array[$j]['item_total_amt'][$k] = $_POST['total_amt'];
      $total_bill += $_POST['total_amt'];
      $store_id = $_POST['store_id'];
      $order_id = $_POST['idid'];
      $k++;
    }
    $store_cnt[$j] = $k;
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EMAIL SENDING//
  $from = 'onestoreforallyourneeds@gmail.com';
  $subject = 'Your requested orders';
  $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
  $activate_link = '../Order/myorders.php?id=' . $user_id;
  //EMAIL SENDING//
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $message1 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
               <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Processed</span></p> </td>
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
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $last_name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Order has been successfully processed.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID <span style="font-weight:bold;color:#000">OSUID' . sprintf('%06d', $user_id) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">OSID' . sprintf('%06d', $noid) . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Your order for the below listed item(s) is processed successfully  by <b>' . date("F j") . " , " . date("Y") . '</b> and will be available for you to purchase at specific shops mentioned below . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $total_bill . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_first_name . " " . $shipping_last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_address_1 . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_postcode . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
               <tbody>
                <tr>
                 <td valign="top" align="left"><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: If you do not collect your items (booked) from specified shop with in specified period of time(varies according to the items) , your order will be cancelled.
                    In case this items will be removed from your cart and moved to wishlist .Thereafter you need to purchase it again as per as your needs. </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>';
  for ($l = 0; $l < $i; $l++) {
    $store_total = 0;
    $message1 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
				<tr>
					<td>
						<table width="600" align="center">
							<tr colspan="2" >
								<td>
									<h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 8px;padding-bottom: 25px;font-family:Arial">
								    <span style="float:left;">Opening hours : ' . $store_array[$l]['opening_hours'] . '</span>
								    <span style="float:right;">Store : ' . $store_array[$l]['store_name'] . '</span><br>
								    <span style="float:left;">status : ' . $store_array[$l]['status'] . '</span>
								    <span style="float:right;">Ph : ' . $store_array[$l]['phone'] . '</span>';
    $message1 .= '</h4></td></tr></table></td></tr></table>';
    for ($m = 0; $m < $store_cnt[$l]; $m++) {
      $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $store_array[$l]['item_description_id'][$m] . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $store_array[$l]['item_category_id'][$m] . '/' . $store_array[$l]['item_sub_category_id'][$m] . '/' . $store_array[$l]['item_description_id'][$m] . '.jpg" alt="' . $store_array[$l]['item_name'][$m] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
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
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Total: &#8377; ' . $store_array[$l]['item_total_amt'][$m] . '</p>';
      $store_total += $store_array[$l]['item_total_amt'][$m];
      $message1 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    }
    $message1 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount to be Paid @' . $store_array[$l]['store_name'] . ': &#8377; ' . $store_total . '</p>
				<hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
  }
  $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                    <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
  /*
          require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';
          require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';
          require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
          $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
          $mail->Port = 587; // TLS only
          $mail->SMTPSecure = 'tls'; // ssl is deprecated
          $mail->SMTPAuth = true;
          $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
          $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
          $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
          $mail->addAddress($email,$first_name ); // to email and name
          $mail->Subject = $subject;
          $mail->msgHTML($message1);//(file_get_contents('ordermailtouser.php'),'' ); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
          $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
          // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
  */
  // Everything seems OK, time to send the email.
  $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  $mail->isSMTP();
  $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
  $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
  $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
  $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
  $mail->SMTPAuth = true;
  $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
  $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
  // Recipients
  $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
  $mail->addAddress($email, $first_name); // to email and name
  // Content
  $mail->Subject = $subject;
  $mail->msgHTML($message1); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    $response['status'] = "error";
    $_SESSION['error'] = "Email can't Send";
    //echo "Mailer Error: " . $mail->ErrorInfo;
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $subject = 'Requested service';
  $activate_link = '../../Store%20admin/index.php?id=' . $user_id;
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
    $message2 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Requested</span></p> </td>
            </tr>
            <tr>
            </tr>
           </tbody>
          </table></td>
        </tr>
       </tbody>
      </table>
       </td>
    </tr>
    <tr>
     <td>
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $store_array[$l]['username'] . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px"> Order has been requested.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">Store ID <span style="font-weight:bold;color:#000">OSSID' . sprintf('%06d', $store_array[$l]['store_id']) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">OSID' . sprintf('%06d', $noid) . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Below listed item(s) are requested by the customer  by <b>' . date("F j") . " , " . date("Y") . '</b> from your store <b>' . $store_array[$l]['store_name'] . '</b>. Thanks for your cooperation with us and also wishing you best with your sales . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $total_bill . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_first_name . " " . $shipping_last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_address_1 . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_postcode . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
               <tbody>
                <br>
               </tbody>
              </table>  ';
    $message2 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
        <tr>
          <td>
            <table width="600" align="center">
              <tr colspan="2" >
                <td>
                  <h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 0px;padding-bottom: 0px;font-family:Arial">
                    <table width="100%" cellspacing="10px">
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer name : ' . $first_name . " " . $last_name . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">Ph : ' . $phone . '</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer id : OSUID' . sprintf('%06d', $user_id) . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">' . $email . '</span>
                        </td>
                  </tr>';
    $message2 .= '</table></h4></td></tr></table></td></tr></table>';
    for ($m = 0; $m < $store_cnt[$l]; $m++) {
      $store_array[$l]['item_description_id'][$m];
      $store_array[$l]['item_category_id'][$m];
      $store_array[$l]['item_sub_category_id'][$m];
      $store_array[$l]['item_name'][$m];
      $store_array[$l]['item_description'][$m];
      $store_array[$l]['item_price'][$m];
      $store_array[$l]['item_quantity'][$m];
      $store_array[$l]['item_ordertype'][$m];
      $store_array[$l]['item_total_amt'][$m];
      $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $store_array[$l]['item_description_id'][$m] . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $store_array[$l]['item_category_id'][$m] . '/' . $store_array[$l]['item_sub_category_id'][$m] . '/' . $store_array[$l]['item_description_id'][$m] . '.jpg" alt="' . $store_array[$l]['item_name'][$m] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
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
      $store_total += (int) $store_array[$l]['item_quantity'][$m] * (int) $store_array[$l]['item_price'][$m];
      $message2 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    }
    $message2 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount : &#8377; ' . $store_total . '</p><hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                     <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
    /*
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
            $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
            $mail->Port = 587; // TLS only
            $mail->SMTPSecure = 'tls'; // ssl is deprecated
            $mail->SMTPAuth = true;
            $mail->Username = "onestoreforallyourneeds@gmail.com"; // email
            $mail->Password = "lgjlpnjvlbdjlskh"; // Applicaton password
            $mail->setFrom('onestoreforallyourneeds@gmail.com', 'OneStore'); // From email and name
            $mail->addAddress( $store_array[$l]['email'],$store_array[$l]['store_name'] ); // to email and name
            $mail->Subject = $subject;
            $mail->msgHTML($message2);//(file_get_contents('ordermailtouser.php'),'' ); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
            $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
            // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    */
    // Everything seems OK, time to send the email.
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
    // Recipients
    $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    $mail->addAddress($store_array[$l]['email'], $store_array[$l]['store_name']); // to email and name
    // Content
    $mail->Subject = $subject;
    $mail->msgHTML($message2); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    if (!$mail->send()) {
      $response['status'] = "error";
      $_SESSION['error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
      //echo "Mailer Error: " . $mail->ErrorInfo;
    }
  }
  if (!isset($response['status'])) {
    $response['status'] = "success";
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//COMPLETED 3
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['storefinder'])) {
  $item_description_id = $_POST['item_description_id'];
  $result = $pdo->query("select * from product_details
	INNER JOIN store ON product_details.store_id=store.store_id
	INNER JOIN item_description on item_description.item_description_id=product_details.item_description_id
	where product_details.item_description_id=$item_description_id and product_details.availability='yes' group by store.store_id");
  $status = 0;
  $message = "";
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $store_id = $row['store_id'];
    $message .= '<tr class="store_rows"><td style="padding: 0px;margin: 0px;"><input type="checkbox" id="check' . $row['store_id'] . '" name="select" class="sel_store" onclick="pricing(' . $row['store_id'] . "," . $item_description_id . ');$(\'.sel_store\').not(this).prop(\'checked\', false);" value="' . $row['store_id'] . '"><button id="btn' . $row['store_id'] . '" style="display: none;height: 45px;width:100%;border-color: white;background-color:#006904;color: white;border-radius:7px;outline: none; " class="element_cart real_btn' . $row['store_id'] . '"><i class="fa fa-check"></i> <i class="fas fa-store" ></i></button><button style="display: none;height: 45px;width:100%;border-color: white;background-color:#006904;color: white;border-radius:7px;outline: none; " class="element_cart load_btn' . $row['store_id'] . '"><i class="fa fa-refresh fa-spin"></i> <i class="fas fa-store" ></i></button></td><td style="background-color: white" class="view_avail_stores">' . $row['store_name'] . '</td><td style="background-color: white" class="view_avail_stores">&#8377;' . $row['price'] . '</td><td style="background-color: white" class="view_avail_stores" onclick="getLocationa();" id="c' . $store_id . '"><span onclick="$(this).hide()"><i class="fa fa-calculator"></i> Get</span></td><td><form action="https://maps.google.com/maps" method="get" target="_blank"> <input type="hidden" name="saddr" id="daddr1" value=""  /><input type="hidden" name="daddr1" value="' . $row['latitude'] . ',' . $row['longitude'] . '" /><button type="submit" style="color: white;background-color: #337ab7;border-radius: 50px;width: 20px; outline: none;"><i class="fas fa-paper-plane" style="display: flex; justify-content: center;"></i></button></form></td></tr>';
    $status = 1;
  }
  $response['avail'] = $status;
  $response['status'] = "success";
  $response['data'] = $message;
  header('Content-type: application/json');
  echo json_encode($response);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['pricefinder'])) {
  if (isset($_POST['item_description_id'], $_POST['store_id'])) {
    $idid = $_POST['item_description_id'];
    $sql = "select * from product_details
    inner join item_description on item_description.item_description_id=product_details.item_description_id
    inner join store on store.store_id=product_details.store_id
    where product_details.item_description_id=:item_description_id and product_details.store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $response["price"] = $row['price'];
    $sql1 = "select price from item inner join item_description on item_description.item_id=item.item_id  where item_description_id=:item_description_id ";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
      ':item_description_id' => $_POST['item_description_id']
    ));
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $mrp = $row1['price'];
    $save = $mrp - $row['price'];
    $off = round(($save * 100) / $mrp);
    $message = "";
    $sqlfeatures = "select * from product_details
inner join item_description on item_description.item_description_id=product_details.item_description_id
where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmtfeatures = $pdo->prepare($sqlfeatures);
    $stmtfeatures->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      ':store_id' => $_POST['store_id']
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
      if ($rowfeatures['f' . $f] != 0 && $features[$f] != "0") {
        if ($features[$f] != 'weight') {
          $sqlfeature_name = "select " . $features[$f] . '_name from ' . $features[$f] . ' where ' . $features[$f] . '_id=' . (int) $rowfeatures['f' . $f];
          $stmtfeature_name = $pdo->query($sqlfeature_name);
          $rowfeature_name = $stmtfeature_name->fetch(PDO::FETCH_ASSOC);
        }
        $message .= '<li class="sc-product-variation wishlist_store_item_features" style="font-size: 14px !important;">
                                  <span class="a-list-item" style="text-decoration: none;font-weight:normal;padding: 0px;font-size: 14px;">
                                      <span class="a-size-small a-text-bold" style="text-decoration: none;padding: 0px;font-weight:normal;">' . ucwords($features[$f]) . ' :&nbsp; </span>';
        if ($features[$f] == "color") {
          $message .= '<span class="a-size-small" style="text-decoration: none;font-weight:normal;width:10px;height:0px !important;padding-right: 7px;padding-left: 7px;border:1px solid #000;padding-top:0px;padding-bottom:0px;background-color:' . $rowfeature_name[$features[$f] . '_name'] . ';font-size:12px;"></span>';
        } else if ($features[$f] == "weight") {
          $message .= '<span class="a-size-small" style="text-decoration: none;font-weight:normal;padding: 0px;">' . $rowfeatures['f2'] . '</span>';
        } else {
          $message .= '<span class="a-size-small" style="text-decoration: none;font-weight:normal;padding: 0px;">' . $rowfeature_name[$features[$f] . '_name'] . '</span>
                           </span>
                           </li>';
        }
      }
      $f++;
    }
    $response["save"] = $save;
    $response["off"] = $off;
    $response["quantity"] = $row['quantity'];
    $response["availability"] = $row['availability'];
    $response["sts"] = $row['status'];
    $response["address"] = $row['address'];
    $response["store_id"] = $_POST['store_id'];
    $response["idid"] = $idid;
    $response['status'] = "success";
    $response['features'] = $message;
    header('Content-type: application/json');
    echo json_encode($response);
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['wishlist_storefinder'])) {
  $item_description_id = $_POST['item_description_id'];
  $result = $pdo->query("select * from product_details
	INNER JOIN store ON product_details.store_id=store.store_id
	INNER JOIN item_description on item_description.item_description_id=product_details.item_description_id
	where product_details.item_description_id=$item_description_id and product_details.availability='yes' group by store.store_id");
  $status = 0;
  $message = "";
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $store_id = $row['store_id'];
    $message .= '<tr class="wishlist_store_rows"><td style="padding: 0px;margin: 0px;"><input type="checkbox" id="wishlist_check' . $row['store_id'] . '" name="select" class="sel_store2" onclick="wishlist_pricing(' . $row['store_id'] . "," . $item_description_id . ');$(\'.sel_store2\').not(this).prop(\'checked\', false);" value="' . $row['store_id'] . '"><button id="wishlist_btn' . $row['store_id'] . '" style="display: none;height: 45px;width:100%;border-color: white;background-color:#006904;color: white;border-radius:7px;outline: none; "  class="element_cart2" type="button"><i class="fa fa-check"></i> <i class="fas fa-store" ></i></button><button style="display: none;height: 45px;width:100%;border-color: white;background-color:#006904;color: white;border-radius:7px;outline: none; " class="element_cart load_btn' . $row['store_id'] . '"><i class="fa fa-refresh fa-spin"></i> <i class="fas fa-store" ></i></button></td><td style="background-color: white" class="view_avail_stores">' . $row['store_name'] . '</td><td style="background-color: white" class="view_avail_stores">&#8377;' . $row['price'] . '</td><td style="background-color: white" onclick="getLocationb();" class="view_avail_stores" id="w' . $store_id . '"><span onclick="$(this).hide()"><i class="fa fa-calculator"></i> Get</span></td><td><form action="https://maps.google.com/maps" method="get" target="_blank"><input type="hidden" name="saddr" id="wishlist_daddr" value="" /><input type="hidden" name="daddr1" value="' . $row['latitude'] . ',' . $row['longitude'] . '"  /><button type="submit" style="color: white;background-color: #337ab7;border-radius: 50px;width: 20px; outline: none;"><i class="fas fa-paper-plane" style="display: flex; justify-content: center;"></i></button></form></td></tr>';
    $status = 1;
  }
  $response['avail'] = $status;
  $response['status'] = "success";
  $response['data'] = $message;
  header('Content-type: application/json');
  echo json_encode($response);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['wishlist_pricefinder'])) {
  if (isset($_POST['item_description_id'], $_POST['store_id'])) {
    $idid = $_POST['item_description_id'];
    $sid = $_POST['store_id'];
    $sql = "select * from product_details
    inner join item_description on item_description.item_description_id=product_details.item_description_id
    inner join store on store.store_id=product_details.store_id
    where product_details.item_description_id=:item_description_id and product_details.store_id=:store_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':item_description_id' => $_POST['item_description_id'],
      'store_id' => $_POST['store_id']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $response["price"] = $row['price'];
    $sql1 = "select price from item inner join item_description on item_description.item_id=item.item_id  where item_description_id=:item_description_id ";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(
      ':item_description_id' => $_POST['item_description_id']
    ));
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $mrp = $row1['price'];
    $save = $mrp - $row['price'];
    $off = round(($save * 100) / $mrp);
    $message = "";
    $sqlfeatures = "select * from product_details
inner join item_description on item_description.item_description_id=product_details.item_description_id
where item_description.item_description_id=:item_description_id and store_id=:store_id";
    $stmtfeatures = $pdo->prepare($sqlfeatures);
    $stmtfeatures->execute(array(
      ':item_description_id' => $idid,
      ':store_id' => $sid
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
      if ($rowfeatures['f' . $f] != 0 && $features[$f] != "0") {
        if ($features[$f] != 'weight') {
          $sqlfeature_name = "select " . $features[$f] . '_name from ' . $features[$f] . ' where ' . $features[$f] . '_id=' . (int) $rowfeatures['f' . $f];
          $stmtfeature_name = $pdo->query($sqlfeature_name);
          $rowfeature_name = $stmtfeature_name->fetch(PDO::FETCH_ASSOC);
        }
        $message .= '<li class="sc-product-variation wishlist_store_item_features" style="font-size: 14px !important;">
                                  <span class="a-list-item" style="text-decoration: none;font-weight:normal;padding: 0px;font-size: 14px;">
                                      <span class="a-size-small a-text-bold" style="text-decoration: none;padding: 0px;font-weight:normal;">' . ucwords($features[$f]) . ' :&nbsp; </span>';
        if ($features[$f] == "color") {
          $message .= '<span class="a-size-small" style="text-decoration: none;font-weight:normal;width:10px;height:0px !important;padding-right: 7px;padding-left: 7px;border:1px solid #000;padding-top:0px;padding-bottom:0px;background-color:' . $rowfeature_name[$features[$f] . '_name'] . ';font-size:12px;"></span>';
        } else if ($features[$f] == "weight") {
          $message .= '<span class="a-size-small" style="text-decoration: none;font-weight:normal;padding: 0px;">' . $rowfeatures['f2'] . '</span>';
        } else {
          $message .= '<span class="a-size-small" style="text-decoration: none;font-weight:normal;padding: 0px;">' . $rowfeature_name[$features[$f] . '_name'] . '</span>
                           </span>
                           </li>';
        }
      }
      $f++;
    }
    $response["save"] = $save;
    $response["off"] = $off;
    $response["quantity"] = $row['quantity'];
    $response["availability"] = $row['availability'];
    $response["sts"] = $row['status'];
    $response["address"] = $row['address'];
    $response["store_id"] = $_POST['store_id'];
    $response["idid"] = $idid;
    $response['status'] = "success";
    $response['features'] = $message;
    header('Content-type: application/json');
    echo json_encode($response);
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER  CATEGROY GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER  CATEGROY GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER  CATEGROY GRID
if (isset($_POST['filter_cat_a'])) {
  $dynamic_content = "";
  $sqlbrand = $sqlcat = $sqlstar = "";
  $minprice = $_POST['min-price'];
  $maxprice = $_POST['max-price'];
  $sort = $_POST['sort'];
  if ($sort == 'default') {
    $sort = "CAST(item.sub_category_id AS UNSIGNED) ASC";
  } else if ($sort == 'high') {
    $sort = "CAST(product_details.price AS UNSIGNED) DESC";
  } else if ($sort == 'low') {
    $sort = "CAST(product_details.price AS UNSIGNED) ASC";
  } else if ($sort == 'view') {
    $sort = "CAST(item_keys.views AS UNSIGNED) DESC";
  }
  if (isset($_POST['key'])) {
    for ($i = 0; $i < count($_POST['key']); $i++) {
      $split = explode('-', $_POST['key'][$i]['type']);
      $type = $split[0];
      $id = $split[2];
      $name = $split[3];
      /*
      echo $_POST['key'][$i]['type'].PHP_EOL;
      echo $type.PHP_EOL;
      echo $id.PHP_EOL;
      echo $name.PHP_EOL;
      */
      if ($type == 'star') {
        $sqlstar .= $id . ",";
        $ratingarray[$i] = $id;
      }
      if ($type == 'brand') {
        $sqlbrand .= $id . ",";
      }
      if ($type == 'category') {
        $sqlcat .= $id . ',';
      }
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $limit = 12;
  if (isset($_POST['page_no'])) {
    $page_no = $_POST['page_no'];
  } else {
    $page_no = 1;
  }
  $offset = ($page_no - 1) * $limit;
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and  round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views , store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlcat != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id  having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id  having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlcat != "" && $sqlbrand != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlcat != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  }
  //echo $sql.PHP_EOL;
  $res = $pdo->query($sql);
  while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    /*
    if($sqlstar!=""){
    $sumcnt="select sum(item_keys.rating) AS sumrate,COUNT(item_keys.item_keys_id) AS countkeys FROM item_keys
    JOIN item_description on item_keys.item_description_id=item_description.item_description_id
    JOIN product_details on product_details.item_description_id = item_description.item_description_id
    JOIN store ON store.store_id=product_details.store_id
    WHERE store.store_id=product_details.store_id
    AND product_details.item_description_id=item_description.item_description_id
    and item_description.item_description_id=".$row['item_description_id']."
    AND product_details.price BETWEEN ".$minprice." AND ".$maxprice."
    GROUP BY item_keys.store_id HAVING item_keys.store_id IN (".$row['store_id'].")";
    $sumcnt_stmt=$pdo->query($sumcnt);
    $sumcnt_row=$sumcnt_stmt->fetch(PDO::FETCH_ASSOC);
    $cntrate=$sumcnt_row['sumrate'];
    $cntnum=$sumcnt_row['countkeys'];
    if($cntnum==0){
      continue;
    }
    $avgrating=$cntrate/$cntnum;
    $minrate=min($ratingarray);
      if($avgrating>=$minrate){
    */
    if ($row) {
      if (strlen($row['item_name']) >= 30) {
        $item = $row['item_name'];
        $item_name = substr($item, 0, 30) . "...";
      } else {
        $item_name = $row['item_name'];
      }
      if (strlen($row['description']) >= 50) {
        $description = substr($row['description'], 0, 45);
        $description2 = $description . "...";
      } else {
        $description = $row['description'];
        $description2 = $row['description'] . "... ";
      }
      $discount = $row['mrp'] - $row['price'];
      $dynamic_content .= "<div class='col-lg-3 col-md-4 col-sm-4 col-xs-6 offset-md-0 offset-sm-1 dynamic-content' style='height: 340px;margin:0px;padding:8px;padding-top:0px;'>
            <div class='flip-box'>
                 <div class='flip-box-inner' >
                    <div class='flip-box-front'>
                        <div class='card card-front' style='height: 320px;padding-top: 10px;'> <img  class='card-img-top' style='max-width: 100%;' src='../../images/" . $row['category_id'] . "/" . $row['sub_category_id'] . "/" . $row['item_description_id'] . ".jpg'>
                            <div class='card-body'>
                                <!--NAME--><br>
                                <h6 class='font-weight-bold pt-1'><center>" . $item_name . "</center></h6>
                                <!--DESCRIPTION-->
                                <div class='text-muted description' style='font-size: 10px;'>" . $description2 . "<span style='color:#0b8a00'> View more </span></div>
                                <!--RATING-->
                                <div class=' align-items-center product'> ";
      $starsql = "select round(avg(item_keys.rating),0) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
WHERE item_keys.rating!=0 and item_description.item_description_id=" . $row['item_description_id'];
      $startstmt = $pdo->query($starsql);
      $starrow = $startstmt->fetch(PDO::FETCH_ASSOC);
      $stars = round($starrow['avgrate']);
      if ($stars == "" || $stars == 0 || is_null($stars)) {
        $dynamic_content .= "<span style='color:#ff2222'>no rating</span>";
      } else {
        for ($i = 0; $i < 5; $i++) {
          if ($i < $stars) {
            $dynamic_content .= "<span class='fas fa-star active'></span>";
          } else {
            $dynamic_content .= "<span class='fas fa-star'></span>";
          }
        }
      }
      $dynamic_content .= "</div>";
      $dynamic_content .= "<div class=' align-items-center justify-content-between pt-3' style='margin-bottom: 5px;'>
                                    <!--PRICE-->
                                    <div class='h6 font-weight-bold' style='font-size: 12px;display: flex;justify-content: center;align-items: center;'><i class='fas fa-store'></i>
                                        <span>" . $row['store_name'] . "</span>
                                    </div>
                                    <div class=' align-items-center justify-content-between pt-3 flex-column' style='position: absolute;bottom:8px;display:flex;align-items: center;justify-content: center;text-align: center;width:100%'>
                                        <div class='h6 font-weight-bold' style='font-size: 16px;display: flex;justify-content: center;align-items: center;'>&#8377; <span>" . $row['price'] . "</span><small style='color: #0b8a00;'>&nbsp;Saves(&#8377;<span>" . $discount . " </span>)</small></div>
                                        <div class='text-muted rebate' style='font-size: 9px;display:flex;justify-content: flex-start;align-items: flex-start;'>MRP <del>&#8377; " . $row['mrp'] . "</del></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='flip-box-back'>
                        <div class='card card-back' style='height: 320px;padding-top: 10px;'> <img  class='card-img-top' src='../../images/" . $row['category_id'] . "/" . $row['sub_category_id'] . "/" . $row['item_description_id'] . ".jpg'>
                            <div class='card-body'>
                                <!--NAME-->
                                <h6 class='font-weight-bold pt-1'><center>" . $item_name . "</center></h6>
                                <!--DESCRIPTION-->
                                <div class='text-muted description' style='font-size: 10px;'>" . $description2 . "<span style='color:#0b8a00'> View more </span></div>
                                <!--RATING-->
                                <div class='d-flex align-items-center product'> ";
      $starsql = "select round(avg(item_keys.rating),0) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
WHERE item_keys.rating!=0 and item_description.item_description_id=" . $row['item_description_id'];
      $startstmt = $pdo->query($starsql);
      $starrow = $startstmt->fetch(PDO::FETCH_ASSOC);
      $stars = round($starrow['avgrate']);
      if ($stars == "" || $stars == 0 || is_null($stars)) {
        $dynamic_content .= "<span style='color:#ff2222'>no rating</span>";
      } else {
        for ($i = 0; $i < 5; $i++) {
          if ($i < $stars) {
            $dynamic_content .= "<span class='fas fa-star active'></span>";
          } else {
            $dynamic_content .= "<span class='fas fa-star'></span>";
          }
        }
      }
      $dynamic_content .= "</div>";
      $save = round(($row['mrp'] - (int) $row['price']) / $row['mrp'] * 100);
      $dynamic_content .= "<div class='d-flex align-items-center justify-content-between pt-3' style='margin-bottom: 5px;padding-left:0px !important'>
                                <!--PRICE-->
                                    <div class='d-flex flex-column'  style='float: left;align-items:flex-start;justify-content: flex-start;display: flex;'>
                                        <div class='h6 font-weight-bold' style='font-size:15px;font-weight:bold;display: flex;margin-left'>&#8377; <span>" . $row['price'] . "</span><small style='color: #0b8a00;font-weight:bold'>&nbsp;(<span style='font-size:10px;'>" . $save . "%</span> off)</small></div>
                                        <div class='text-muted rebate'>MRP <del>&#8377; " . $row['mrp'] . "</del></div>
                                    </div>
                                <!--VIEW ITEM-->
                                    <div class='btn-pdt_pg btn-primary-pdt_pg' onclick='location.href=\"../Product/single.php?id=" . $row['item_description_id'] . "\"' alt='" . $item_name . "' style='cursor:pointer;padding: 5px;padding-top:2px;padding-bottom:2px;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0b8a00), color-stop(1, #006d12)) !important;'>View <i class='fas fa-eye '></i>
                                    </div>
                                </div>
                                <!--ADD TO CART-->
                                <div class='btn btn-primary btn-lg ' onclick='storefinder(" . $row['item_description_id'] . ")'  type='button' name='submit' data-toggle='modal' data-target='#avail_stores' style='width: 96%;border-radius: 4px;bottom:5px;left:5px;position: absolute;padding: 3px 12px;'>
                                    <i class='fas fa-plus mr-2'></i>
                                        Add to Cart
                                </div>
                                <!--CART ICON-->
                                <div class='btn btn-default btn-lg btn-flat' type='button' name='submit' data-toggle='modal' data-target='#avail_stores_wishlist' style='width: 38px;height:38px;position: absolute;justify-content: center;border-radius: 50%;bottom:25px;left:5px;'><i style='color: #D70000;display: flex;align-items: center;justify-content: center;margin-left: 50%;' class='fas fa-cart-plus mr-2 fa-lg mr-2'></i>
                                </div>
                                <!--WISH LIST-->
                                <div class='btn btn-default btn-lg btn-flat' type='button' name='submit' onclick='wishlist_storefinder(" . $row['item_description_id'] . ")' data-toggle='modal' data-target='#avail_stores_wishlist' style='width: 38px;height:38px;position: absolute;top: 10px;right: 10px;justify-content: center;border-radius: 50%;background-color:#bbb ;'><i style='color:#fff ;display: flex;align-items: center;justify-content: center;margin-left: 50%;' class='fas fa-heart mr-2'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
  }
  if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and  round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' AND item_keys.rating!=0 AND item_keys.rating!=0  GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0  GROUP BY item.item_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . "  AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views , store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id  having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id  having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlcat != "" && $sqlbrand != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlcat != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  }
  //echo $sql.PHP_EOL;
/*
if($sqlstar!=""){
$records=$pdo->query($sumcnt);
}
*/
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $records = $pdo->query($sql);
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $output = "<div class='container'><div class='col-12'><nav class='numbering' style='position:relative;bottom:0px;right:0px;'><ul class='pagination justify-content-center' style='margin:0px 0'>";
  if ($page_no <= $totalPage && $page_no > 1) {
    $prev = $page_no - 1;
    $output .= "<li class='page-item'><a  class='page-link' id='$prev' href=''>Prev</a></li>";
  }
  $ends_count = 1;  //how many items at the ends (before and after [...])
  $middle_count = 2;  //how many items before and after current page
  $dots = false;
  for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $page_no) {
      $output .= "<li class='page-item active'><a class='page-link' style='pointer-events: none;' id='$i' href=''>$i</a></li>";
      $dots = true;
    } else {
      if ($i <= $ends_count || ($page_no && $i > $page_no - $middle_count && $i <= $page_no + $middle_count) || $i > $totalPage - $ends_count) {
        $output .= "<li class='page-item '><a class='page-link' id='$i' href=''>$i</a></li>";
        $dots = true;
      } else if ($dots) {
        $output .= "<li><a>&hellip;</a></li>";
        $dots = false;
      }
    }
  }
  if ($totalPage > 1 && $page_no < $totalPage) {
    $next = $page_no + 1;
    $output .= "<li class='page-item'><a class='page-link' id='$next' href=''>Next</a></li>";
  }
  $output .= "</ul></nav></div></div>";
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$response['pages']=$output;
  if ($dynamic_content == "" || is_null($dynamic_content)) {
    $dynamic_content .= '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Result Found...</h2></center><br><br>';
  }
  $response['content'] = $dynamic_content;
  $response['output'] = $output;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//FILTER CATEGORY GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER  CATEGROY GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER  CATEGROY GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER  CATEGROY GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER  CATEGROY LIST
if (isset($_POST['filter_cat_b'])) {
  $dynamic_content = "";
  $sqlbrand = $sqlcat = $sqlstar = "";
  $minprice = $_POST['min-price'];
  $maxprice = $_POST['max-price'];
  $sort = $_POST['sort'];
  if ($sort == 'default') {
    $sort = "CAST(item.sub_category_id AS UNSIGNED) ASC";
  } else if ($sort == 'high') {
    $sort = "CAST(product_details.price AS UNSIGNED) DESC";
  } else if ($sort == 'low') {
    $sort = "CAST(product_details.price AS UNSIGNED) ASC";
  } else if ($sort == 'view') {
    $sort = "CAST(item_keys.views AS UNSIGNED) DESC";
  }
  if (isset($_POST['key'])) {
    for ($i = 0; $i < count($_POST['key']); $i++) {
      $split = explode('-', $_POST['key'][$i]['type']);
      $type = $split[0];
      $id = $split[2];
      $name = $split[3];
      /*
      echo $_POST['key'][$i]['type'].PHP_EOL;
      echo $type.PHP_EOL;
      echo $id.PHP_EOL;
      echo $name.PHP_EOL;
      */
      if ($type == 'star') {
        $sqlstar .= $id . ",";
        $ratingarray[$i] = $id;
      }
      if ($type == 'brand') {
        $sqlbrand .= $id . ",";
      }
      if ($type == 'category') {
        $sqlcat .= $id . ',';
      }
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $limit = 12;
  if (isset($_POST['page_no'])) {
    $page_no = $_POST['page_no'];
  } else {
    $page_no = 1;
  }
  $offset = ($page_no - 1) * $limit;
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and  round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views , store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id  having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id  having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlcat != "" && $sqlbrand != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlcat != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  }
  //echo $sql.PHP_EOL;
  $res = $pdo->query($sql);
  while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    if ($row) {
      if (strlen($row['item_name']) >= 30) {
        $item = $row['item_name'];
        $item_name = substr($item, 0, 30) . "...";
      } else {
        $item_name = $row['item_name'];
      }
      if (strlen($row['description']) >= 30) {
        $description = substr($row['description'], 30);
        $description2 = $description . "...";
      } else {
        $description = $row['description'];
        $description2 = $row['description'] . "... ";
      }
      $discount = $row['mrp'] - $row['price'];
      $dynamic_content .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 offset-md-0 offset-sm-1" style="height: 280px;margin:0px;padding:8px;padding-bottom:0px;padding-top:0px;">';
      $query = "select size,color,weight,flavour,processor,display,battery,internal_storage,brand,material FROM product_details
      JOIN item_description ON product_details.item_description_id=item_description.item_description_id
      JOIN item ON item.item_id=item_description.item_id
      JOIN category ON category.category_id=item.category_id
      JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
      JOIN store on store.store_id=product_details.store_id
      where item_description.item_description_id=:idid";
      $statement = $pdo->prepare($query);
      $statement->execute(array(
        ':idid' => $row['item_description_id']
      ));
      $row_feature = $statement->fetch(PDO::FETCH_ASSOC);
      $dynamic_content .= '<div class="order-single" style="margin:0;padding:0;background-color:#fff;width:100%;height:100%;border-bottom: 1px solid #666;">
<div class="col-sm-3 col-xs-3" style="background-color:#fff" onclick=\'location.href="../Product/single.php?id=' . $row['item_description_id'] . '"\'>
  <table>
    <tr style="padding-bottom:30px;"></tr>
    <tr>
        <td>
            <div style="height: 150px;width: 100%">
                <img style="height:auto;max-width: 100%;width:auto;max-height: 250px;display: block;margin: auto;padding-top:30px " class="img-responsive" src="../../images/' . $row['category_id'] . '/' . $row['sub_category_id'] . '/' . $row['item_description_id'] . '.jpg">
            </div>
        </td>
    </tr>
  </table>
</div>
<div class="col-sm-9 col-xs-9" style="padding:0px;">
 <table >
    <tr><td><div style="width: 100%;text-align: center;color: #000;font-weight:bold;font-size:20px;padding-top:30px">' . $row['item_name'] . '</div></td></tr>
</table>
<div class="col-sm-12 col-xs-12" style="padding:0px;">
<div class="col-sm-7 col-xs-7" style="min-height:200px;padding:0;">
  <table width="100%" style="padding:0px;margin:0px;">
    <tr  style="padding-top:10px;"><td colspan="2"><div style="width: 100%;text-align: left;color: #333;font-weight:normal;font-size:14px;padding-top:30px;padding-bottom:10px"></div></td> </tr>';
      if ($row_feature['size'] != 0) {
        $query1 = "SELECT * FROM size where size_id=" . $row_feature['size'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
    <th class="cust_header2"><li>Size</li></th>
    <td class="cust_details"> ' . $row1['size_name'] . '</td>
    </tr>';
      }
      if ($row_feature['color'] != 0) {
        $query1 = "SELECT * FROM color where color_id=" . $row_feature['color'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Color</li></th>
      <td class="cust_details"><div style="height:16px;width:16px;border:.5px solid #999;background-color:' . $row1['color_name'] . '"></div></td>
    </tr>';
      }
      if ($row_feature['weight'] != 0) {
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Weight</li></th>
      <td class="cust_details">' . $row_feature['weight'] . '</td>
    </tr>';
      }
      if ($row_feature['flavour'] != 0) {
        $query1 = "SELECT * FROM flavour where flavour_id=" . $row_feature['flavour'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Flavour</li></th>
      <td class="cust_details">' . $row1['flavour_name'] . '</td>
    </tr>';
      }
      if ($row_feature['processor'] != 0) {
        $query1 = "SELECT * FROM processor where processor_id=" . $row_feature['processor'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Processor</li></th>
      <td class="cust_details">' . $row1['processor_name'] . '</td>
    </tr>';
      }
      if ($row_feature['display'] != 0) {
        $query1 = "SELECT * FROM display where display_id=" . $row_feature['display'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Display</li></th>
      <td class="cust_details">' . $row1['display_name'] . '</td>
    </tr>';
      }
      if ($row_feature['battery'] != 0) {
        $query1 = "SELECT * FROM battery where battery_id=" . $row_feature['battery'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Battery</li></th>
      <td class="cust_details">' . $row1['battery_name'] . '</td>
    </tr>';
      }
      if ($row_feature['internal_storage'] != 0) {
        $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row_feature['internal_storage'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Internal Storage</li></th>
      <td class="cust_details">' . $row1['internal_storage_name'] . '</td>
    </tr>';
      }
      if ($row_feature['brand'] != 0) {
        $query1 = "SELECT * FROM brand where brand_id=" . $row_feature['brand'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Brand</li></th>
      <td class="cust_details">' . $row1['brand_name'] . '</td>
    </tr>';
      }
      if ($row_feature['material'] != 0) {
        $query1 = "SELECT * FROM material where material_id=" . $row_feature['material'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw"><th class="cust_header2"><li>Material</li></th>
      <td class="cust_details">' . $row1['material_name'] . '</td>
    </tr>';
      }
      $item_det = $pdo->query("select category.category_name,sub_category.sub_category_name,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " and item_description.item_description_id=" . $row['item_description_id'] . " and sub_category.sub_category_id=item.sub_category_id");
      $item_det_row = $item_det->fetch(PDO::FETCH_ASSOC);
      $dynamic_content .= '<tr class=" dw"><th class="cust_header2"><li>Category</th>
      <td class="cust_details">' . $item_det_row['category_name'] . '</li></td>
    </tr>
    <tr class=" dw"><th class="cust_header2"><li>Sub Category</th>
      <td class="cust_details">' . $item_det_row['sub_category_name'] . '</li></td>
    </tr>
    <tr class=" dw"><th class="cust_header2"><li>Seller</th>
      <td class="cust_details">' . $item_det_row['store_name'] . '</li></td>
    </tr>
  </table>
</div>
<div class="col-sm-5 col-xs-5">
  <table width="100%" style="padding:0px;margin:0px;">';
      $save = round(($row['mrp'] - $row['price']) / $row['mrp'] * 100);
      $dynamic_content .= '<tr>
        <td align="right">
            <img style="height:auto;max-width: 100%;width:auto;max-height: 50px;display: block;padding-top:30px; " class="img-responsive" src="../../images/logo/logofill-sm.png">
            </td>
    </tr>
    <tr class="div-wrapper dw" style="padding-top:30px;">
        <td class="cust_details" style="font-size:24px;font-weight:bold" align="right"><i class=\'fa fa-rupee-sign\'></i>' . $row['price'] . ' </td></tr>
        <td class="cust_details" style="font-size:14px;font-weight:normal" align="right"><del><i class=\'fa fa-rupee-sign\'></i> ' . $row['mrp'] . '</del> <span style="color: #119904;font-weight:bold">' . $save . '% off</span></td>
    </tr>
  </table>
</div>
</div>
</div>
</div>
</div>';
    }
  }
  if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and  round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views, store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlcat != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlcat != "" && $_POST['sort'] == 'view') {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views , store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlcat != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' AND item_keys.rating!=0 GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item.item_id  having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id  having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlcat != "" && $sqlbrand != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlcat != "") {
    $sqlcat = rtrim($sqlcat . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' GROUP BY item.item_id HAVING item.sub_category_id IN (' . $sqlcat . ') order by ' . $sort;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') GROUP BY item.item_id order by ' . $sort;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select item_keys.views,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  }
  //echo $sql.PHP_EOL;
/*
if($sqlstar!=""){
$records=$pdo->query($sumcnt);
}
*/
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $records = $pdo->query($sql);
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $output = "<div class='container'><div class='col-12'><nav class='numbering' style='position:relative;bottom:0px;right:0px;'><ul class='pagination justify-content-center' style='margin:0px 0'>";
  if ($page_no <= $totalPage && $page_no > 1) {
    $prev = $page_no - 1;
    $output .= "<li class='page-item'><a  class='page-link' id='$prev' href=''>Prev</a></li>";
  }
  $ends_count = 1;  //how many items at the ends (before and after [...])
  $middle_count = 2;  //how many items before and after current page
  $dots = false;
  for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $page_no) {
      $output .= "<li class='page-item active'><a class='page-link' style='pointer-events: none;' id='$i' href=''>$i</a></li>";
      $dots = true;
    } else {
      if ($i <= $ends_count || ($page_no && $i > $page_no - $middle_count && $i <= $page_no + $middle_count) || $i > $totalPage - $ends_count) {
        $output .= "<li class='page-item '><a class='page-link' id='$i' href=''>$i</a></li>";
        $dots = true;
      } else if ($dots) {
        $output .= "<li><a>&hellip;</a></li>";
        $dots = false;
      }
    }
  }
  if ($totalPage > 1 && $page_no < $totalPage) {
    $next = $page_no + 1;
    $output .= "<li class='page-item'><a class='page-link' id='$next' href=''>Next</a></li>";
  }
  $output .= "</ul></nav></div></div>";
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$response['pages']=$output;
  if ($dynamic_content == "" || is_null($dynamic_content)) {
    $dynamic_content .= '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Result Found...</h2></center><br><br>';
  }
  $response['content'] = $dynamic_content;
  $response['output'] = $output;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//FILTER CATEGORY LIST
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER SUB CATEGROY GRID
if (isset($_POST['filter_sub_cat_a'])) {
  $dynamic_content = "";
  $sqlbrand = $sqlstar = "";
  $minprice = $_POST['min-price'];
  $maxprice = $_POST['max-price'];
  $sort = $_POST['sort'];
  if ($sort == 'default') {
    $sort = "CAST(item.sub_category_id AS UNSIGNED) ASC";
  } else if ($sort == 'high') {
    $sort = "CAST(product_details.price AS UNSIGNED) DESC";
  } else if ($sort == 'low') {
    $sort = "CAST(product_details.price AS UNSIGNED) ASC";
  } else if ($sort == 'view') {
    $sort = "CAST(item_keys.views AS UNSIGNED) DESC";
  }
  if (isset($_POST['key'])) {
    for ($i = 0; $i < count($_POST['key']); $i++) {
      $split = explode('-', $_POST['key'][$i]['type']);
      $type = $split[0];
      $id = $split[2];
      $name = $split[3];
      /*
      echo $_POST['key'][$i]['type'].PHP_EOL;
      echo $type.PHP_EOL;
      echo $id.PHP_EOL;
      echo $name.PHP_EOL;
      */
      if ($type == 'star') {
        $sqlstar .= $id . ",";
        $ratingarray[$i] = $id;
      }
      if ($type == 'brand') {
        $sqlbrand .= $id . ",";
      }
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $limit = 12;
  if (isset($_POST['page_no'])) {
    $page_no = $_POST['page_no'];
  } else {
    $page_no = 1;
  }
  $offset = ($page_no - 1) * $limit;
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') group by item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  }
  //echo $sql.PHP_EOL;
  $res = $pdo->query($sql);
  while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    if ($row) {
      if (strlen($row['item_name']) >= 30) {
        $item = $row['item_name'];
        $item_name = substr($item, 0, 30) . "...";
      } else {
        $item_name = $row['item_name'];
      }
      if (strlen($row['description']) >= 50) {
        $description = substr($row['description'], 0, 45);
        $description2 = $description . "...";
      } else {
        $description = $row['description'];
        $description2 = $row['description'] . "... ";
      }
      $discount = $row['mrp'] - $row['price'];
      $dynamic_content .= "<div class='col-lg-3 col-md-4 col-sm-4 col-xs-6 offset-md-0 offset-sm-1 dynamic-content' style='height: 340px;margin:0px;padding:8px;padding-top:0px;'>
            <div class='flip-box'>
                 <div class='flip-box-inner' >
                    <div class='flip-box-front'>
                        <div class='card card-front' style='height: 320px;padding-top: 10px;'> <img  class='card-img-top' style='max-width: 100%;' src='../../images/" . $row['category_id'] . "/" . $row['sub_category_id'] . "/" . $row['item_description_id'] . ".jpg'>
                            <div class='card-body'>
                                <!--NAME--><br>
                                <h6 class='font-weight-bold pt-1'><center>" . $item_name . "</center></h6>
                                <!--DESCRIPTION-->
                                <div class='text-muted description' style='font-size: 10px;'>" . $description2 . "<span style='color:#0b8a00'> View more </span></div>
                                <!--RATING-->
                                <div class=' align-items-center product'> ";
      $starsql = "select round(avg(item_keys.rating),0) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
WHERE item_keys.rating!=0 and item_description.item_description_id=" . $row['item_description_id'];
      $startstmt = $pdo->query($starsql);
      $starrow = $startstmt->fetch(PDO::FETCH_ASSOC);
      $stars = round($starrow['avgrate']);
      if ($stars == "" || $stars == 0 || is_null($stars)) {
        $dynamic_content .= "<span style='color:#ff2222'>no rating</span>";
      } else {
        for ($i = 0; $i < 5; $i++) {
          if ($i < $stars) {
            $dynamic_content .= "<span class='fas fa-star active'></span>";
          } else {
            $dynamic_content .= "<span class='fas fa-star'></span>";
          }
        }
      }
      $dynamic_content .= "</div>";
      $dynamic_content .= "<div class=' align-items-center justify-content-between pt-3' style='margin-bottom: 5px;'>
                                    <!--PRICE-->
                                    <div class='h6 font-weight-bold' style='font-size: 12px;display: flex;justify-content: center;align-items: center;'><i class='fas fa-store'></i>
                                        <span>" . $row['store_name'] . "</span>
                                    </div>
                                    <div class=' align-items-center justify-content-between pt-3 flex-column' style='position: absolute;bottom:8px;display:flex;align-items: center;justify-content: center;text-align: center;width:100%'>
                                        <div class='h6 font-weight-bold' style='font-size: 16px;display: flex;justify-content: center;align-items: center;'>&#8377; <span>" . $row['price'] . "</span><small style='color: #0b8a00;'>&nbsp;Saves(&#8377;<span>" . $discount . " </span>)</small></div>
                                        <div class='text-muted rebate' style='font-size: 9px;display:flex;justify-content: flex-start;align-items: flex-start;'>MRP <del>&#8377; " . $row['mrp'] . "</del></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='flip-box-back'>
                        <div class='card card-back' style='height: 320px;padding-top: 10px;'> <img  class='card-img-top' src='../../images/" . $row['category_id'] . "/" . $row['sub_category_id'] . "/" . $row['item_description_id'] . ".jpg'>
                            <div class='card-body'>
                                <!--NAME-->
                                <h6 class='font-weight-bold pt-1'><center>" . $item_name . "</center></h6>
                                <!--DESCRIPTION-->
                                <div class='text-muted description' style='font-size: 10px;'>" . $description2 . "<span style='color:#0b8a00'> View more </span></div>
                                <!--RATING-->
                                <div class='d-flex align-items-center product'> ";
      $starsql = "select round(avg(item_keys.rating),0) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
WHERE item_keys.rating!=0 and item_description.item_description_id=" . $row['item_description_id'];
      $startstmt = $pdo->query($starsql);
      $starrow = $startstmt->fetch(PDO::FETCH_ASSOC);
      $stars = round($starrow['avgrate']);
      if ($stars == "" || $stars == 0 || is_null($stars)) {
        $dynamic_content .= "<span style='color:#ff2222'>no rating</span>";
      } else {
        for ($i = 0; $i < 5; $i++) {
          if ($i < $stars) {
            $dynamic_content .= "<span class='fas fa-star active'></span>";
          } else {
            $dynamic_content .= "<span class='fas fa-star'></span>";
          }
        }
      }
      $dynamic_content .= "</div>";
      $save = round(($row['mrp'] - (int) $row['price']) / $row['mrp'] * 100);
      $dynamic_content .= "<div class='d-flex align-items-center justify-content-between pt-3' style='margin-bottom: 5px;padding-left:0px !important'>
                                <!--PRICE-->
                                    <div class='d-flex flex-column'  style='float: left;align-items:flex-start;justify-content: flex-start;display: flex;'>
                                        <div class='h6 font-weight-bold' style='font-size:15px;font-weight:bold;display: flex;margin-left'>&#8377; <span>" . $row['price'] . "</span><small style='color: #0b8a00;font-weight:bold'>&nbsp;(<span style='font-size:10px;'>" . $save . "%</span> off)</small></div>
                                        <div class='text-muted rebate'>MRP <del>&#8377; " . $row['mrp'] . "</del></div>
                                    </div>
                                <!--VIEW ITEM-->
                                    <div class='btn-pdt_pg btn-primary-pdt_pg' onclick='location.href=\"../Product/single.php?id=" . $row['item_description_id'] . "\"' alt='" . $item_name . "' style='cursor:pointer;padding: 5px;padding-top:2px;padding-bottom:2px;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0b8a00), color-stop(1, #006d12)) !important;'>View <i class='fas fa-eye '></i>
                                    </div>
                                </div>
                                <!--ADD TO CART-->
                                <div class='btn btn-primary btn-lg ' onclick='storefinder(" . $row['item_description_id'] . ")'  type='button' name='submit' data-toggle='modal' data-target='#avail_stores' style='width: 96%;border-radius: 4px;bottom:5px;left:5px;position: absolute;padding: 3px 12px;'>
                                    <i class='fas fa-plus mr-2'></i>
                                        Add to Cart
                                </div>
                                <!--CART ICON-->
                                <div class='btn btn-default btn-lg btn-flat' type='button' name='submit' data-toggle='modal' data-target='#avail_stores_wishlist' style='width: 38px;height:38px;position: absolute;justify-content: center;border-radius: 50%;bottom:25px;left:5px;'><i style='color: #D70000;display: flex;align-items: center;justify-content: center;margin-left: 50%;' class='fas fa-cart-plus mr-2 fa-lg mr-2'></i>
                                </div>
                                <!--WISH LIST-->
                                <div class='btn btn-default btn-lg btn-flat' type='button' name='submit' onclick='wishlist_storefinder(" . $row['item_description_id'] . ")' data-toggle='modal' data-target='#avail_stores_wishlist' style='width: 38px;height:38px;position: absolute;top: 10px;right: 10px;justify-content: center;border-radius: 50%;background-color:#bbb ;'><i style='color:#fff ;display: flex;align-items: center;justify-content: center;margin-left: 50%;' class='fas fa-heart mr-2'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
  }
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort;
  }
  //echo $sql.PHP_EOL;
/*
if($sqlstar!=""){
$records=$pdo->query($sumcnt);
}
*/
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $records = $pdo->query($sql);
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $output = "<div class='container'><div class='col-12'><nav class='numbering' style='position:relative;bottom:0px;right:0px;'><ul class='pagination justify-content-center' style='margin:0px 0'>";
  if ($page_no <= $totalPage && $page_no > 1) {
    $prev = $page_no - 1;
    $output .= "<li class='page-item'><a  class='page-link' id='$prev' href=''>Prev</a></li>";
  }
  $ends_count = 1;  //how many items at the ends (before and after [...])
  $middle_count = 2;  //how many items before and after current page
  $dots = false;
  for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $page_no) {
      $output .= "<li class='page-item active'><a class='page-link' style='pointer-events: none;' id='$i' href=''>$i</a></li>";
      $dots = true;
    } else {
      if ($i <= $ends_count || ($page_no && $i > $page_no - $middle_count && $i <= $page_no + $middle_count) || $i > $totalPage - $ends_count) {
        $output .= "<li class='page-item '><a class='page-link' id='$i' href=''>$i</a></li>";
        $dots = true;
      } else if ($dots) {
        $output .= "<li><a>&hellip;</a></li>";
        $dots = false;
      }
    }
  }
  if ($totalPage > 1 && $page_no < $totalPage) {
    $next = $page_no + 1;
    $output .= "<li class='page-item'><a class='page-link' id='$next' href=''>Next</a></li>";
  }
  $output .= "</ul></nav></div></div>";
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$response['pages']=$output;
  if ($dynamic_content == "" || is_null($dynamic_content)) {
    $dynamic_content .= '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Result Found...</h2></center><br><br>';
  }
  $response['content'] = $dynamic_content;
  $response['output'] = $output;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//FILTER SUB CATEGORY GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER SUB CATEGROY LIST
if (isset($_POST['filter_sub_cat_b'])) {
  $dynamic_content = "";
  $sqlbrand = $sqlstar = "";
  $minprice = $_POST['min-price'];
  $maxprice = $_POST['max-price'];
  $sort = $_POST['sort'];
  if ($sort == 'default') {
    $sort = "CAST(item.sub_category_id AS UNSIGNED) ASC";
  } else if ($sort == 'high') {
    $sort = "CAST(product_details.price AS UNSIGNED) DESC";
  } else if ($sort == 'low') {
    $sort = "CAST(product_details.price AS UNSIGNED) ASC";
  } else if ($sort == 'view') {
    $sort = "CAST(item_keys.views AS UNSIGNED) DESC";
  }
  if (isset($_POST['key'])) {
    for ($i = 0; $i < count($_POST['key']); $i++) {
      $split = explode('-', $_POST['key'][$i]['type']);
      $type = $split[0];
      $id = $split[2];
      $name = $split[3];
      /*
      echo $_POST['key'][$i]['type'].PHP_EOL;
      echo $type.PHP_EOL;
      echo $id.PHP_EOL;
      echo $name.PHP_EOL;
      */
      if ($type == 'star') {
        $sqlstar .= $id . ",";
        $ratingarray[$i] = $id;
      }
      if ($type == 'brand') {
        $sqlbrand .= $id . ",";
      }
      if ($type == 'category') {
        $sqlcat .= $id . ',';
      }
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $limit = 12;
  if (isset($_POST['page_no'])) {
    $page_no = $_POST['page_no'];
  } else {
    $page_no = 1;
  }
  $offset = ($page_no - 1) * $limit;
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
            inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
            inner join category on category.category_id=item.category_id
            inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
            inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
            inner join category on category.category_id=item.category_id
            inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
            inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
            inner join category on category.category_id=item.category_id
            inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
            inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
            inner join category on category.category_id=item.category_id
            inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  }
  //echo $sql.PHP_EOL;
  $res = $pdo->query($sql);
  while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    if ($row) {
      if (strlen($row['item_name']) >= 30) {
        $item = $row['item_name'];
        $item_name = substr($item, 0, 30) . "...";
      } else {
        $item_name = $row['item_name'];
      }
      if (strlen($row['description']) >= 30) {
        $description = substr($row['description'], 30);
        $description2 = $description . "...";
      } else {
        $description = $row['description'];
        $description2 = $row['description'] . "... ";
      }
      $discount = $row['mrp'] - $row['price'];
      $dynamic_content .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 offset-md-0 offset-sm-1" style="height: 280px;margin:0px;padding:8px;padding-bottom:0px;padding-top:0px;">';
      $query = "select size,color,weight,flavour,processor,display,battery,internal_storage,brand,material FROM product_details
      JOIN item_description ON product_details.item_description_id=item_description.item_description_id
      JOIN item ON item.item_id=item_description.item_id
      JOIN category ON category.category_id=item.category_id
      JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
      JOIN store on store.store_id=product_details.store_id
      where item_description.item_description_id=:idid";
      $statement = $pdo->prepare($query);
      $statement->execute(array(
        ':idid' => $row['item_description_id']
      ));
      $row_feature = $statement->fetch(PDO::FETCH_ASSOC);
      $dynamic_content .= '<div class="order-single" style="margin:0;padding:0;background-color:#fff;width:100%;height:100%;border-bottom: 1px solid #666;">
<div class="col-sm-3 col-xs-3" style="background-color:#fff" onclick=\'location.href="../Product/single.php?id=' . $row['item_description_id'] . '"\'>
  <table>
    <tr style="padding-bottom:30px;"></tr>
    <tr>
        <td>
            <div style="height: 150px;width: 100%">
                <img style="height:auto;max-width: 100%;width:auto;max-height: 250px;display: block;margin: auto;padding-top:30px " class="img-responsive" src="../../images/' . $row['category_id'] . '/' . $row['sub_category_id'] . '/' . $row['item_description_id'] . '.jpg">
            </div>
        </td>
    </tr>
  </table>
</div>
<div class="col-sm-9 col-xs-9" style="padding:0px;">
 <table >
    <tr><td><div style="width: 100%;text-align: center;color: #000;font-weight:bold;font-size:20px;padding-top:30px">' . $row['item_name'] . '</div></td></tr>
</table>
<div class="col-sm-12 col-xs-12" style="padding:0px;">
<div class="col-sm-7 col-xs-7" style="min-height:200px;padding:0;">
  <table width="100%" style="padding:0px;margin:0px;">
    <tr  style="padding-top:10px;"><td colspan="2"><div style="width: 100%;text-align: left;color: #333;font-weight:normal;font-size:14px;padding-top:30px;padding-bottom:10px"></div></td> </tr>';
      if ($row_feature['size'] != 0) {
        $query1 = "SELECT * FROM size where size_id=" . $row_feature['size'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
    <th class="cust_header2"><li>Size</li></th>
    <td class="cust_details"> ' . $row1['size_name'] . '</td>
    </tr>';
      }
      if ($row_feature['color'] != 0) {
        $query1 = "SELECT * FROM color where color_id=" . $row_feature['color'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Color</li></th>
      <td class="cust_details"><div style="height:16px;width:16px;border:.5px solid #999;background-color:' . $row1['color_name'] . '"></div></td>
    </tr>';
      }
      if ($row_feature['weight'] != 0) {
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Weight</li></th>
      <td class="cust_details">' . $row_feature['weight'] . '</td>
    </tr>';
      }
      if ($row_feature['flavour'] != 0) {
        $query1 = "SELECT * FROM flavour where flavour_id=" . $row_feature['flavour'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Flavour</li></th>
      <td class="cust_details">' . $row1['flavour_name'] . '</td>
    </tr>';
      }
      if ($row_feature['processor'] != 0) {
        $query1 = "SELECT * FROM processor where processor_id=" . $row_feature['processor'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Processor</li></th>
      <td class="cust_details">' . $row1['processor_name'] . '</td>
    </tr>';
      }
      if ($row_feature['display'] != 0) {
        $query1 = "SELECT * FROM display where display_id=" . $row_feature['display'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Display</li></th>
      <td class="cust_details">' . $row1['display_name'] . '</td>
    </tr>';
      }
      if ($row_feature['battery'] != 0) {
        $query1 = "SELECT * FROM battery where battery_id=" . $row_feature['battery'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Battery</li></th>
      <td class="cust_details">' . $row1['battery_name'] . '</td>
    </tr>';
      }
      if ($row_feature['internal_storage'] != 0) {
        $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row_feature['internal_storage'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Internal Storage</li></th>
      <td class="cust_details">' . $row1['internal_storage_name'] . '</td>
    </tr>';
      }
      if ($row_feature['brand'] != 0) {
        $query1 = "SELECT * FROM brand where brand_id=" . $row_feature['brand'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Brand</li></th>
      <td class="cust_details">' . $row1['brand_name'] . '</td>
    </tr>';
      }
      if ($row_feature['material'] != 0) {
        $query1 = "SELECT * FROM material where material_id=" . $row_feature['material'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw"><th class="cust_header2"><li>Material</li></th>
      <td class="cust_details">' . $row1['material_name'] . '</td>
    </tr>';
      }
      $item_det = $pdo->query("select category.category_name,sub_category.sub_category_name,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " and item_description.item_description_id=" . $row['item_description_id'] . " and sub_category.sub_category_id=item.sub_category_id");
      $item_det_row = $item_det->fetch(PDO::FETCH_ASSOC);
      $dynamic_content .= '<tr class=" dw"><th class="cust_header2"><li>Category</th>
      <td class="cust_details">' . $item_det_row['category_name'] . '</li></td>
    </tr>
    <tr class=" dw"><th class="cust_header2"><li>Sub Category</th>
      <td class="cust_details">' . $item_det_row['sub_category_name'] . '</li></td>
    </tr>
    <tr class=" dw"><th class="cust_header2"><li>Seller</th>
      <td class="cust_details">' . $item_det_row['store_name'] . '</li></td>
    </tr>
  </table>
</div>
<div class="col-sm-5 col-xs-5">
  <table width="100%" style="padding:0px;margin:0px;">';
      $save = round(($row['mrp'] - $row['price']) / $row['mrp'] * 100);
      $dynamic_content .= '<tr>
        <td align="right">
            <img style="height:auto;max-width: 100%;width:auto;max-height: 50px;display: block;padding-top:30px; " class="img-responsive" src="../../images/logo/logofill-sm.png">
            </td>
    </tr>
    <tr class="div-wrapper dw" style="padding-top:30px;">
        <td class="cust_details" style="font-size:24px;font-weight:bold" align="right"><i class=\'fa fa-rupee-sign\'></i>' . $row['price'] . ' </td></tr>
        <td class="cust_details" style="font-size:14px;font-weight:normal" align="right"><del><i class=\'fa fa-rupee-sign\'></i> ' . $row['mrp'] . '</del> <span style="color: #119904;font-weight:bold">' . $save . '% off</span></td>
    </tr>
  </table>
</div>
</div>
</div>
</div>
</div>';
    }
  }
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id, round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (' . $_POST['sub_category'] . ') and round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") and round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where category.category_id=' . $_POST['category'] . ' AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id having item.sub_category_id IN(' . $_POST['sub_category'] . ') order by ' . $sort;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $_POST['category'] . " AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id HAVING item.sub_category_id IN (" . $_POST['sub_category'] . ") order by " . $sort;
  }
  //echo $sql.PHP_EOL;
/*
if($sqlstar!=""){
$records=$pdo->query($sumcnt);
}
*/
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $records = $pdo->query($sql);
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $output = "<div class='container'><div class='col-12'><nav class='numbering' style='position:relative;bottom:0px;right:0px;'><ul class='pagination justify-content-center' style='margin:0px 0'>";
  if ($page_no <= $totalPage && $page_no > 1) {
    $prev = $page_no - 1;
    $output .= "<li class='page-item'><a  class='page-link' id='$prev' href=''>Prev</a></li>";
  }
  $ends_count = 1;  //how many items at the ends (before and after [...])
  $middle_count = 2;  //how many items before and after current page
  $dots = false;
  for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $page_no) {
      $output .= "<li class='page-item active'><a class='page-link' style='pointer-events: none;' id='$i' href=''>$i</a></li>";
      $dots = true;
    } else {
      if ($i <= $ends_count || ($page_no && $i > $page_no - $middle_count && $i <= $page_no + $middle_count) || $i > $totalPage - $ends_count) {
        $output .= "<li class='page-item '><a class='page-link' id='$i' href=''>$i</a></li>";
        $dots = true;
      } else if ($dots) {
        $output .= "<li><a>&hellip;</a></li>";
        $dots = false;
      }
    }
  }
  if ($totalPage > 1 && $page_no < $totalPage) {
    $next = $page_no + 1;
    $output .= "<li class='page-item'><a class='page-link' id='$next' href=''>Next</a></li>";
  }
  $output .= "</ul></nav></div></div>";
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$response['pages']=$output;
  if ($dynamic_content == "" || is_null($dynamic_content)) {
    $dynamic_content .= '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Result Found...</h2></center><br><br>';
  }
  $response['content'] = $dynamic_content;
  $response['output'] = $output;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//FILTER SUB CATEGORY LIST
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER ITEM GRID
if (isset($_POST['filter_item_a'])) {
  $dynamic_content = "";
  $sqlbrand = $sqlstar = "";
  $minprice = $_POST['min-price'];
  $maxprice = $_POST['max-price'];
  $sort = $_POST['sort'];
  if ($sort == 'default') {
    $sort = "CAST(item.sub_category_id AS UNSIGNED) ASC";
  } else if ($sort == 'high') {
    $sort = "CAST(product_details.price AS UNSIGNED) DESC";
  } else if ($sort == 'low') {
    $sort = "CAST(product_details.price AS UNSIGNED) ASC";
  } else if ($sort == 'view') {
    $sort = "CAST(item_keys.views AS UNSIGNED) DESC";
  }
  if (isset($_POST['key'])) {
    for ($i = 0; $i < count($_POST['key']); $i++) {
      $split = explode('-', $_POST['key'][$i]['type']);
      $type = $split[0];
      $id = $split[2];
      $name = $split[3];
      /*
      echo $_POST['key'][$i]['type'].PHP_EOL;
      echo $type.PHP_EOL;
      echo $id.PHP_EOL;
      echo $name.PHP_EOL;
      */
      if ($type == 'star') {
        $sqlstar .= $id . ",";
        $ratingarray[$i] = $id;
      }
      if ($type == 'brand') {
        $sqlbrand .= $id . ",";
      }
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $limit = 12;
  if (isset($_POST['page_no'])) {
    $page_no = $_POST['page_no'];
  } else {
    $page_no = 1;
  }
  $offset = ($page_no - 1) * $limit;
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,store.store_name ,item_keys.views,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  }
  //echo $sql.PHP_EOL;
  $res = $pdo->query($sql);
  while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    if ($row) {
      if (strlen($row['item_name']) >= 30) {
        $item = $row['item_name'];
        $item_name = substr($item, 0, 30) . "...";
      } else {
        $item_name = $row['item_name'];
      }
      if (strlen($row['description']) >= 30) {
        $description = substr($row['description'], 0, 30);
        $description2 = $description . "...";
      } else {
        $description = $row['description'];
        $description2 = $row['description'] . "... ";
      }
      $discount = $row['mrp'] - $row['price'];
      $dynamic_content .= "<div class='col-lg-3 col-md-4 col-sm-4 col-xs-6 offset-md-0 offset-sm-1 dynamic-content' style='height: 340px;margin:0px;padding:8px;padding-top:0px;'>
            <div class='flip-box'>
                 <div class='flip-box-inner' >
                    <div class='flip-box-front'>
                        <div class='card card-front' style='height: 320px;padding-top: 10px;'> <img  class='card-img-top' style='max-width: 100%;' src='../../images/" . $row['category_id'] . "/" . $row['sub_category_id'] . "/" . $row['item_description_id'] . ".jpg'>
                            <div class='card-body'>
                                <!--NAME--><br>
                                <h6 class='font-weight-bold pt-1'><center>" . $item_name . "</center></h6>
                                <!--DESCRIPTION-->
                                <div class='text-muted description' style='font-size: 10px;'>" . $description2 . "<span style='color:#0b8a00'> View more </span></div>
                                <!--RATING-->
                                <div class=' align-items-center product'> ";
      $starsql = "select round(avg(item_keys.rating),0) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
WHERE item_keys.rating!=0 and item_description.item_description_id=" . $row['item_description_id'];
      $startstmt = $pdo->query($starsql);
      $starrow = $startstmt->fetch(PDO::FETCH_ASSOC);
      $stars = round($starrow['avgrate']);
      if ($stars == "" || $stars == 0 || is_null($stars)) {
        $dynamic_content .= "<span style='color:#ff2222'>no rating</span>";
      } else {
        for ($i = 0; $i < 5; $i++) {
          if ($i < $stars) {
            $dynamic_content .= "<span class='fas fa-star active'></span>";
          } else {
            $dynamic_content .= "<span class='fas fa-star'></span>";
          }
        }
      }
      $dynamic_content .= "</div>";
      $dynamic_content .= "<div class=' align-items-center justify-content-between pt-3' style='margin-bottom: 5px;'>
                                    <!--PRICE-->
                                    <div class='h6 font-weight-bold' style='font-size: 12px;display: flex;justify-content: center;align-items: center;'><i class='fas fa-store'></i>
                                        <span>" . $row['store_name'] . "</span>
                                    </div>
                                    <div class=' align-items-center justify-content-between pt-3 flex-column' style='position: absolute;bottom:8px;display:flex;align-items: center;justify-content: center;text-align: center;width:100%'>
                                        <div class='h6 font-weight-bold' style='font-size: 16px;display: flex;justify-content: center;align-items: center;'>&#8377; <span>" . $row['price'] . "</span><small style='color: #0b8a00;'>&nbsp;Saves(&#8377;<span>" . $discount . " </span>)</small></div>
                                        <div class='text-muted rebate' style='font-size: 9px;display:flex;justify-content: flex-start;align-items: flex-start;'>MRP <del>&#8377; " . $row['mrp'] . "</del></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='flip-box-back'>
                        <div class='card card-back' style='height: 320px;padding-top: 10px;'> <img  class='card-img-top' src='../../images/" . $row['category_id'] . "/" . $row['sub_category_id'] . "/" . $row['item_description_id'] . ".jpg'>
                            <div class='card-body'>
                                <!--NAME-->
                                <h6 class='font-weight-bold pt-1'><center>" . $item_name . "</center></h6>
                                <!--DESCRIPTION-->
                                <div class='text-muted description' style='font-size: 10px;'>" . $description2 . "<span style='color:#0b8a00'> View more </span></div>
                                <!--RATING-->
                                <div class='d-flex align-items-center product'> ";
      $starsql = "select round(avg(item_keys.rating),0) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
WHERE item_keys.rating!=0 and item_description.item_description_id=" . $row['item_description_id'];
      $startstmt = $pdo->query($starsql);
      $starrow = $startstmt->fetch(PDO::FETCH_ASSOC);
      $stars = round($starrow['avgrate']);
      if ($stars == "" || $stars == 0 || is_null($stars)) {
        $dynamic_content .= "<span style='color:#ff2222'>no rating</span>";
      } else {
        for ($i = 0; $i < 5; $i++) {
          if ($i < $stars) {
            $dynamic_content .= "<span class='fas fa-star active'></span>";
          } else {
            $dynamic_content .= "<span class='fas fa-star'></span>";
          }
        }
      }
      $dynamic_content .= "</div>";
      $save = round(($row['mrp'] - (int) $row['price']) / $row['mrp'] * 100);
      $dynamic_content .= "<div class='d-flex align-items-center justify-content-between pt-3' style='margin-bottom: 5px;padding-left:0px !important'>
                                <!--PRICE-->
                                    <div class='d-flex flex-column'  style='float: left;align-items:flex-start;justify-content: flex-start;display: flex;'>
                                        <div class='h6 font-weight-bold' style='font-size:15px;font-weight:bold;display: flex;margin-left'>&#8377; <span>" . $row['price'] . "</span><small style='color: #0b8a00;font-weight:bold'>&nbsp;(<span style='font-size:10px;'>" . $save . "%</span> off)</small></div>
                                        <div class='text-muted rebate'>MRP <del>&#8377; " . $row['mrp'] . "</del></div>
                                    </div>
                                <!--VIEW ITEM-->
                                    <div class='btn-pdt_pg btn-primary-pdt_pg' onclick='location.href=\"../Product/single.php?id=" . $row['item_description_id'] . "\"' alt='" . $item_name . "' style='cursor:pointer;padding: 5px;padding-top:2px;padding-bottom:2px;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0b8a00), color-stop(1, #006d12)) !important;'>View <i class='fas fa-eye '></i>
                                    </div>
                                </div>
                                <!--ADD TO CART-->
                                <div class='btn btn-primary btn-lg ' onclick='storefinder(" . $row['item_description_id'] . ")'  type='button' name='submit' data-toggle='modal' data-target='#avail_stores' style='width: 96%;border-radius: 4px;bottom:5px;left:5px;position: absolute;padding: 3px 12px;'>
                                    <i class='fas fa-plus mr-2'></i>
                                        Add to Cart
                                </div>
                                <!--CART ICON-->
                                <div class='btn btn-default btn-lg btn-flat' type='button' name='submit' data-toggle='modal' data-target='#avail_stores_wishlist' style='width: 38px;height:38px;position: absolute;justify-content: center;border-radius: 50%;bottom:25px;left:5px;'><i style='color: #D70000;display: flex;align-items: center;justify-content: center;margin-left: 50%;' class='fas fa-cart-plus mr-2 fa-lg mr-2'></i>
                                </div>
                                <!--WISH LIST-->
                                <div class='btn btn-default btn-lg btn-flat' type='button' name='submit' onclick='wishlist_storefinder(" . $row['item_description_id'] . ")' data-toggle='modal' data-target='#avail_stores_wishlist' style='width: 38px;height:38px;position: absolute;top: 10px;right: 10px;justify-content: center;border-radius: 50%;background-color:#bbb ;'><i style='color:#fff ;display: flex;align-items: center;justify-content: center;margin-left: 50%;' class='fas fa-heart mr-2'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
  }
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,store.store_name ,item_keys.views,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  }
  //echo $sql.PHP_EOL;
/*
if($sqlstar!=""){
$records=$pdo->query($sumcnt);
}
*/
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $records = $pdo->query($sql);
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $output = "<div class='container'><div class='col-12'><nav class='numbering' style='position:relative;bottom:0px;right:0px;'><ul class='pagination justify-content-center' style='margin:0px 0'>";
  //echo $totalPage;
  if ($page_no <= $totalPage && $page_no >= 2) {
    $prev = $page_no - 1;
    $output .= "<li class='page-item'><a  class='page-link' id='$prev' href=''>Prev</a></li>";
  }
  $ends_count = 1;  //how many items at the ends (before and after [...])
  $middle_count = 2;  //how many items before and after current page
  $dots = false;
  for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $page_no) {
      $output .= "<li class='page-item active'><a class='page-link' style='pointer-events: none;' id='$i' href=''>$i</a></li>";
      $dots = true;
    } else {
      if ($i <= $ends_count || ($page_no && $i > $page_no - $middle_count && $i <= $page_no + $middle_count) || $i > $totalPage - $ends_count) {
        $output .= "<li class='page-item '><a class='page-link' id='$i' href=''>$i</a></li>";
        $dots = true;
      } else if ($dots) {
        $output .= "<li><a>&hellip;</a></li>";
        $dots = false;
      }
    }
  }
  if ($totalPage > 1 && $page_no < $totalPage) {
    $next = $page_no + 1;
    $output .= "<li class='page-item'><a class='page-link' id='$next' href=''>Next</a></li>";
  }
  $output .= "</ul></nav></div></div>";
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$response['pages']=$output;
  if ($dynamic_content == "" || is_null($dynamic_content)) {
    $dynamic_content .= '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Result Found...</h2></center><br><br>';
  }
  $response['content'] = $dynamic_content;
  $response['output'] = $output;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//FILTER ITEM GRID
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//FILTER ITEM LIST
if (isset($_POST['filter_item_b'])) {
  $dynamic_content = "";
  $sqlbrand = $sqlstar = "";
  $minprice = $_POST['min-price'];
  $maxprice = $_POST['max-price'];
  $sort = $_POST['sort'];
  if ($sort == 'default') {
    $sort = "CAST(item.sub_category_id AS UNSIGNED) ASC";
  } else if ($sort == 'high') {
    $sort = "CAST(product_details.price AS UNSIGNED) DESC";
  } else if ($sort == 'low') {
    $sort = "CAST(product_details.price AS UNSIGNED) ASC";
  } else if ($sort == 'view') {
    $sort = "CAST(item_keys.views AS UNSIGNED) DESC";
  }
  if (isset($_POST['key'])) {
    for ($i = 0; $i < count($_POST['key']); $i++) {
      $split = explode('-', $_POST['key'][$i]['type']);
      $type = $split[0];
      $id = $split[2];
      $name = $split[3];
      /*
      echo $_POST['key'][$i]['type'].PHP_EOL;
      echo $type.PHP_EOL;
      echo $id.PHP_EOL;
      echo $name.PHP_EOL;
      */
      if ($type == 'star') {
        $sqlstar .= $id . ",";
        $ratingarray[$i] = $id;
      }
      if ($type == 'brand') {
        $sqlbrand .= $id . ",";
      }
      if ($type == 'category') {
        $sqlcat .= $id . ',';
      }
    }
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $limit = 12;
  if (isset($_POST['page_no'])) {
    $page_no = $_POST['page_no'];
  } else {
    $page_no = 1;
  }
  $offset = ($page_no - 1) * $limit;
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,store.store_name ,item_keys.views,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  }
  //echo $sql.PHP_EOL;
  $res = $pdo->query($sql);
  while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    if ($row) {
      if (strlen($row['item_name']) >= 30) {
        $item = $row['item_name'];
        $item_name = substr($item, 0, 30) . "...";
      } else {
        $item_name = $row['item_name'];
      }
      if (strlen($row['description']) >= 30) {
        $description = substr($row['description'], 30);
        $description2 = $description . "...";
      } else {
        $description = $row['description'];
        $description2 = $row['description'] . "... ";
      }
      $discount = $row['mrp'] - $row['price'];
      $dynamic_content .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 offset-md-0 offset-sm-1" style="height: 280px;margin:0px;padding:8px;padding-bottom:0px;padding-top:0px;">';
      $query = "select size,color,weight,flavour,processor,display,battery,internal_storage,brand,material FROM product_details
      JOIN item_description ON product_details.item_description_id=item_description.item_description_id
      JOIN item ON item.item_id=item_description.item_id
      JOIN category ON category.category_id=item.category_id
      JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
      JOIN store on store.store_id=product_details.store_id
      where item_description.item_description_id=:idid";
      $statement = $pdo->prepare($query);
      $statement->execute(array(
        ':idid' => $row['item_description_id']
      ));
      $row_feature = $statement->fetch(PDO::FETCH_ASSOC);
      $dynamic_content .= '<div class="order-single" style="margin:0;padding:0;background-color:#fff;width:100%;height:100%;border-bottom: 1px solid #666;">
<div class="col-sm-3 col-xs-3" style="background-color:#fff" onclick=\'location.href="../Product/single.php?id=' . $row['item_description_id'] . '"\'>
  <table>
    <tr style="padding-bottom:30px;"></tr>
    <tr>
        <td>
            <div style="height: 150px;width: 100%">
                <img style="height:auto;max-width: 100%;width:auto;max-height: 250px;display: block;margin: auto;padding-top:30px " class="img-responsive" src="../../images/' . $row['category_id'] . '/' . $row['sub_category_id'] . '/' . $row['item_description_id'] . '.jpg">
            </div>
        </td>
    </tr>
  </table>
</div>
<div class="col-sm-9 col-xs-9" style="padding:0px;">
 <table >
    <tr><td><div style="width: 100%;text-align: center;color: #000;font-weight:bold;font-size:20px;padding-top:30px">' . $row['item_name'] . '</div></td></tr>
</table>
<div class="col-sm-12 col-xs-12" style="padding:0px;">
<div class="col-sm-7 col-xs-7" style="min-height:200px;padding:0;">
  <table width="100%" style="padding:0px;margin:0px;">
    <tr  style="padding-top:10px;"><td colspan="2"><div style="width: 100%;text-align: left;color: #333;font-weight:normal;font-size:14px;padding-top:30px;padding-bottom:10px"></div></td> </tr>';
      if ($row_feature['size'] != 0) {
        $query1 = "SELECT * FROM size where size_id=" . $row_feature['size'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
    <th class="cust_header2"><li>Size</li></th>
    <td class="cust_details"> ' . $row1['size_name'] . '</td>
    </tr>';
      }
      if ($row_feature['color'] != 0) {
        $query1 = "SELECT * FROM color where color_id=" . $row_feature['color'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Color</li></th>
      <td class="cust_details"><div style="height:16px;width:16px;border:.5px solid #999;background-color:' . $row1['color_name'] . '"></div></td>
    </tr>';
      }
      if ($row_feature['weight'] != 0) {
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Weight</li></th>
      <td class="cust_details">' . $row_feature['weight'] . '</td>
    </tr>';
      }
      if ($row_feature['flavour'] != 0) {
        $query1 = "SELECT * FROM flavour where flavour_id=" . $row_feature['flavour'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Flavour</li></th>
      <td class="cust_details">' . $row1['flavour_name'] . '</td>
    </tr>';
      }
      if ($row_feature['processor'] != 0) {
        $query1 = "SELECT * FROM processor where processor_id=" . $row_feature['processor'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Processor</li></th>
      <td class="cust_details">' . $row1['processor_name'] . '</td>
    </tr>';
      }
      if ($row_feature['display'] != 0) {
        $query1 = "SELECT * FROM display where display_id=" . $row_feature['display'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Display</li></th>
      <td class="cust_details">' . $row1['display_name'] . '</td>
    </tr>';
      }
      if ($row_feature['battery'] != 0) {
        $query1 = "SELECT * FROM battery where battery_id=" . $row_feature['battery'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Battery</li></th>
      <td class="cust_details">' . $row1['battery_name'] . '</td>
    </tr>';
      }
      if ($row_feature['internal_storage'] != 0) {
        $query1 = "SELECT * FROM internal_storage where internal_storage_id=" . $row_feature['internal_storage'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Internal Storage</li></th>
      <td class="cust_details">' . $row1['internal_storage_name'] . '</td>
    </tr>';
      }
      if ($row_feature['brand'] != 0) {
        $query1 = "SELECT * FROM brand where brand_id=" . $row_feature['brand'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw">
      <th class="cust_header2"><li>Brand</li></th>
      <td class="cust_details">' . $row1['brand_name'] . '</td>
    </tr>';
      }
      if ($row_feature['material'] != 0) {
        $query1 = "SELECT * FROM material where material_id=" . $row_feature['material'];
        $st1 = $pdo->query($query1);
        $row1 = $st1->fetch(PDO::FETCH_ASSOC);
        $dynamic_content .= '<tr class=" dw"><th class="cust_header2"><li>Material</li></th>
      <td class="cust_details">' . $row1['material_name'] . '</td>
    </tr>';
      }
      $item_det = $pdo->query("select category.category_name,sub_category.sub_category_name,store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where category.category_id=" . $row['category_id'] . " and item_description.item_description_id=" . $row['item_description_id'] . " and sub_category.sub_category_id=item.sub_category_id");
      $item_det_row = $item_det->fetch(PDO::FETCH_ASSOC);
      $dynamic_content .= '<tr class=" dw"><th class="cust_header2"><li>Category</th>
      <td class="cust_details">' . $item_det_row['category_name'] . '</li></td>
    </tr>
    <tr class=" dw"><th class="cust_header2"><li>Sub Category</th>
      <td class="cust_details">' . $item_det_row['sub_category_name'] . '</li></td>
    </tr>
    <tr class=" dw"><th class="cust_header2"><li>Seller</th>
      <td class="cust_details">' . $item_det_row['store_name'] . '</li></td>
    </tr>
  </table>
</div>
<div class="col-sm-5 col-xs-5">
  <table width="100%" style="padding:0px;margin:0px;">';
      $save = round(($row['mrp'] - $row['price']) / $row['mrp'] * 100);
      $dynamic_content .= '<tr>
        <td align="right">
            <img style="height:auto;max-width: 100%;width:auto;max-height: 50px;display: block;padding-top:30px; " class="img-responsive" src="../../images/logo/logofill-sm.png">
            </td>
    </tr>
    <tr class="div-wrapper dw" style="padding-top:30px;">
        <td class="cust_details" style="font-size:24px;font-weight:bold" align="right"><i class=\'fa fa-rupee-sign\'></i>' . $row['price'] . ' </td></tr>
        <td class="cust_details" style="font-size:14px;font-weight:normal" align="right"><del><i class=\'fa fa-rupee-sign\'></i> ' . $row['mrp'] . '</del> <span style="color: #119904;font-weight:bold">' . $save . '% off</span></td>
    </tr>
  </table>
</div>
</div>
</div>
</div>
</div>';
    }
  }
  if ($sqlstar != "" && $sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "" && $_POST['sort'] == 'view') {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "" && $_POST['sort'] == 'view') {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort;
  } else if ($sqlstar != "" && $sqlbrand != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and item_description.brand IN(' . $sqlbrand . ') AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (' . $sqlstar . ') order by ' . $sort;
  } else if ($sqlstar != "") {
    $sqlstar = rtrim($sqlstar . ',', ",");
    $sql = "select store.store_id,round(avg(item_keys.rating),0) AS avgrate,item_keys.views,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " AND item_keys.rating!=0 GROUP BY item_description.item_description_id having round(avg(item_keys.rating),0) in (" . $sqlstar . ") order by " . $sort;
  } else if ($sqlbrand != "") {
    $sqlbrand = rtrim($sqlbrand . ',', ",");
    $sql = 'select store.store_id,store.store_name ,item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
            inner join product_details on product_details.item_description_id=item_description.item_description_id
            inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
            where  item.item_name like "%' . $_POST['item'] . '%" and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN ' . $minprice . ' AND ' . $maxprice . ' and  item_description.brand IN(' . $sqlbrand . ') GROUP BY item_description.item_description_id order by ' . $sort;
  } else if ($_POST['sort'] == 'view') {
    $sql = "select store.store_id,store.store_name ,item_keys.views,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      INNER JOIN item_keys ON item_keys.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort . ' LIMIT ' . $offset . ',' . $limit;
  } else {
    $sql = "select store.store_id,store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
      inner join item_description on item_description.item_id=item.item_id
      inner join product_details on product_details.item_description_id=item_description.item_description_id
      inner join store on product_details.store_id=store.store_id
      inner join category on category.category_id=item.category_id
      inner join sub_category on category.category_id= sub_category.category_id
      where  item.item_name like '%" . $_POST['item'] . "%' and sub_category.sub_category_id=item.sub_category_id  AND product_details.price BETWEEN " . $minprice . " AND " . $maxprice . " GROUP BY item_description.item_description_id order by " . $sort;
  }
  //echo $sql.PHP_EOL;
/*
if($sqlstar!=""){
$records=$pdo->query($sumcnt);
}
*/
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $records = $pdo->query($sql);
  $totalRecords = $records->rowCount();
  ;
  $totalPage = $totalRecords / $limit;
  $output = "<div class='container'><div class='col-12'><nav class='numbering' style='position:relative;bottom:0px;right:0px;'><ul class='pagination justify-content-center' style='margin:0px 0'>";
  if ($page_no <= $totalPage && $page_no > 1) {
    $prev = $page_no - 1;
    $output .= "<li class='page-item'><a  class='page-link' id='$prev' href=''>Prev</a></li>";
  }
  $ends_count = 1;  //how many items at the ends (before and after [...])
  $middle_count = 2;  //how many items before and after current page
  $dots = false;
  for ($i = 1; $i <= $totalPage; $i++) {
    if ($i == $page_no) {
      $output .= "<li class='page-item active'><a class='page-link' style='pointer-events: none;' id='$i' href=''>$i</a></li>";
      $dots = true;
    } else {
      if ($i <= $ends_count || ($page_no && $i > $page_no - $middle_count && $i <= $page_no + $middle_count) || $i > $totalPage - $ends_count) {
        $output .= "<li class='page-item '><a class='page-link' id='$i' href=''>$i</a></li>";
        $dots = true;
      } else if ($dots) {
        $output .= "<li><a>&hellip;</a></li>";
        $dots = false;
      }
    }
  }
  if ($totalPage > 1 && $page_no < $totalPage) {
    $next = $page_no + 1;
    $output .= "<li class='page-item'><a class='page-link' id='$next' href=''>Next</a></li>";
  }
  $output .= "</ul></nav></div></div>";
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$response['pages']=$output;
  if ($dynamic_content == "" || is_null($dynamic_content)) {
    $dynamic_content .= '<center><img src="../../images/logo/noorder.png" style="width:100%;justify-content: center;max-width:300px;height:auto;" ><h2 class="noorder-title" style="text-align: center;color:#f16b7f;display: inline-flex;font-weight: 600;">No Result Found...</h2></center><br><br>';
  }
  $response['content'] = $dynamic_content;
  $response['output'] = $output;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//FILTER ITEM LIST
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ADD USER RATING
if (isset($_POST['userrated']) && $_POST['userrated'] == 1) {
  $rating = $_POST['rating'];
  $review = $_POST['review'];
  $idid = $_POST['item_description_id'];
  $user_id = $_POST['user_id'];
  $addsql = $pdo->prepare("update item_keys set review=:review,rating=:rating,date_of_review=:dor where item_description_id=:idid and user_id=:user");
  $date = date("Y\-m\-d");
  $addsql->execute(array(
    ':review' => $review,
    ':rating' => $rating,
    ':dor' => $date,
    ':idid' => $idid,
    ':user' => $user_id
  ));
  /*COLOR PICKER*/
  $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
  $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
  $c1 = 'white';
  $rancolor1 = array_rand($color, 1);
  if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
    $c1 = "black";
  }
  /*COLOR PICKER*/
  $myreviewstmt = $pdo->query("select review,rating,date_of_review as date,users.first_name,users.last_name from item_keys join users on users.user_id=item_keys.user_id where item_description_id=" . $idid . " and item_keys.user_id=" . $user_id);
  $myreviewrow = $myreviewstmt->fetch(PDO::FETCH_ASSOC);
  $myreview = $myreviewrow['review'];
  $user_firstnm = $myreviewrow['first_name'];
  $user_lastnm = $myreviewrow['last_name'];
  $user_rated = $myreviewrow['rating'];
  $user_date_of_review = $myreviewrow['date'];
  $user_firstletter = substr($user_firstnm, 0, 1);
  $add_data = "";
  $add_data .= ' <section id="user_reviewed_already" style="margin-top:20px;">
    <div class="div-wrapper" style="width:max-content">
    <div style="height:20px;width:20px;border-radius:50%;background-color: ' . $bgcolor[$rancolor1] . ';display:flex;align-items:center;justify-content:center;color: ' . $c1 . '">' . $user_firstletter . '</div>
    <p>' . $user_firstnm . " " . $user_lastnm . '</p>
    </div>
    <div class="div-wrapper" style="width:max-content">';
  for ($g = 1; $g <= 5; $g++) {
    if ($g <= $user_rated) {
      $add_data .= '<span class="fa fa-star star-checked"></span>';
    } else {
      $add_data .= '<span class="fa fa-star"></span>';
    }
  }
  $add_data .= '<p>' . $user_date_of_review . '</p>
    </div>
    <div>
      <article>
      <p> ' . htmlentities($myreview) . '</p>
      </article>
      <a onclick="editurresponse()" style="cursor:pointer"><i class="fas fa-pen"></i> edit your review </a>
    </div>
  </section>';
  $response['addreview'] = $add_data;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//ADD USER RATING
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//EDIT USER RATING
if (isset($_POST['edituserrated']) && $_POST['edituserrated'] == 1) {
  $idid = $_POST['item_description_id'];
  $user_id = $_POST['user_id'];
  $checkbuysql = $pdo->query("select rating,review from item_keys where item_description_id=" . $idid . " and user_id=" . $user_id);
  $checkbuy = $checkbuysql->fetch(PDO::FETCH_ASSOC);
  $rating = $checkbuy['rating'];
  $review = $checkbuy['review'];
  $update_data = "";
  $update_data .= '
<div id="editoraddreview" style="margin:0;padding:0;">
  <h3 style="margin-top:20px;">Edit your review</h3>
  <div class="rate">';
  for ($i = 5; $i > 0; $i--) {
    if ($i == $rating) {
      $update_data .= '<input type="radio" id="star' . $i . '" name="rate" value="' . $i . '" checked/>
              <label for="star' . $i . '" title="text">' . $i . ' stars</label>';
    } else {
      $update_data .= '<input type="radio" id="star' . $i . '" name="rate" value="' . $i . '" />
              <label for="star' . $i . '" title="text">' . $i . ' stars</label>';
    }
  }
  $update_data .= '
  </div>
  <div class="clearfix"> </div>
                  <label class="form-label" for="reviewinput">edit your review <i class="fas fa-pen"></i><span style="color:red" onclick="canceledit()">&nbsp;Cancel</span><span id="charnow" style="color:rgb(0, 97, 0);padding-left:10px">' . strlen($review) . '</span>/<span style="color:rgb(0, 97, 0)">500</span></label>
                  <div class="form-group input-field" style="width: 100%;margin-top:0;">
                    <textarea maxlength="500" style="width:100%;outline:#0c99cc" title="Maximum character count is 500" rows="4" onkeyup="changed_details();maxchar()" onfocus="dis_add();" onblur="dis_add()" id="reviewinput" placeholder="" >' . $review . '</textarea>
                    <span onclick="dis_add()" id="dis_add" class="fa fa-sm fa-edit" style="position: absolute;right: 0;top: 0;color: white;background-color:#0c77cc;padding: 4px;" onmouseover="$(this).css(\'background-color\',\'#0c66cc\')" onmouseleave="$(this).css(\'background-color\',\'#0c77cc\')"></span>
                    <span onclick="reset_add()" id="hide_add" class="fa fa-sm fa-close" style="display: none;position: absolute;right: 0;top: 0;color: white;background-color:red;padding: 5px;padding-top: 4px;padding-bottom: 4px;" onmouseover="$(this).css(\'background-color\',\'#bb0000\')" onmouseleave="$(this).css(\'background-color\',\'red\')"></span>
                    <span onclick="dis_ok()" id="hide_add1" class="fa fa-check" style="display:none;position: absolute;right: 0;top: 23px;color: white;background-color:#07C103;padding: 3px;" onmouseover="$(this).css(\'background-color\',\'#4f994f\')" onmouseleave="$(this).css(\'background-color\',\'#07C103\')"></span>
                </div>
                <div id="add_user_review" style="display: none;">
                  <input class="shadow_b real_btn" type="button" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #410041), color-stop(1, #4f0063)) !important;color:white;border-radius:3px" onclick="ratethisnow()"  value="Submit">
                  <button class="shadow_b load_btn" style="display:none;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #410041), color-stop(1, #4f0063)) !important;color:white;border-radius:3px" type="button" ><i class="fa fa-refresh fa-spin"></i>&nbsp;Submit</button>
                </div>
</div>
<div class="clearfix"> </div>
  ';
  $response['status'] = "success";
  $response['editreview'] = $update_data;
  header('Content-type: application/json');
  echo json_encode($response);
}
//EDIT USER RATING
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CANCEL USER RATING
if (isset($_POST['canceluserrated']) && $_POST['canceluserrated'] == 1) {
  $idid = $_POST['item_description_id'];
  $user_id = $_POST['user_id'];
  /*COLOR PICKER*/
  $color = array('scroll_handle_orange', 'scroll_handle_blue', 'scroll_handle_red', 'scroll_handle_cyan', 'scroll_handle_magenta', 'scroll_handle_green', 'scroll_handle_green1', 'scroll_handle_peach', 'scroll_handle_munsell', 'scroll_handle_carmine', 'scroll_handle_lightbrown', 'scroll_handle_hanblue', 'scroll_handle_kellygreen');
  $bgcolor = array('orange', '#0c99cc', 'red', 'cyan', 'magenta', 'green', '#006622', '#FF6666', '#E6BF00', '#AB274F', '#C46210', '#485CBE', '#65BE00');
  $c1 = 'white';
  $rancolor1 = array_rand($color, 1);
  if ($bgcolor[$rancolor1] == "cyan" || $bgcolor[$rancolor1] == "#FF6666" || $bgcolor[$rancolor1] == "#E6BF00") {
    $c1 = "black";
  }
  /*COLOR PICKER*/
  $myreviewstmt = $pdo->query("select review,rating,date_of_review as date,users.first_name,users.last_name from item_keys join users on users.user_id=item_keys.user_id where item_description_id=" . $idid . " and item_keys.user_id=" . $user_id);
  $myreviewrow = $myreviewstmt->fetch(PDO::FETCH_ASSOC);
  $myreview = $myreviewrow['review'];
  $user_firstnm = $myreviewrow['first_name'];
  $user_lastnm = $myreviewrow['last_name'];
  $user_rated = $myreviewrow['rating'];
  $user_date_of_review = $myreviewrow['date'];
  $user_firstletter = substr($user_firstnm, 0, 1);
  $add_data = "";
  $add_data .= ' <section id="user_reviewed_already" style="margin-top:20px;">
    <div class="div-wrapper" style="width:max-content">
    <div style="height:20px;width:20px;border-radius:50%;background-color: ' . $bgcolor[$rancolor1] . ';display:flex;align-items:center;justify-content:center;color: ' . $c1 . '">' . $user_firstletter . '</div>
    <p>' . $user_firstnm . " " . $user_lastnm . '</p>
    </div>
    <div class="div-wrapper" style="width:max-content">';
  for ($g = 1; $g <= 5; $g++) {
    if ($g <= $user_rated) {
      $add_data .= '<span class="fa fa-star star-checked"></span>';
    } else {
      $add_data .= '<span class="fa fa-star"></span>';
    }
  }
  $add_data .= '<p>' . $user_date_of_review . '</p>
    </div>
    <div>
      <article>
      <p> ' . htmlentities($myreview) . '</p>
      </article>
      <a onclick="editurresponse()" style="cursor:pointer"><i class="fas fa-pen"></i> edit your review </a>
    </div>
  </section>';
  $response['addreview'] = $add_data;
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//CANCEL USER RATING
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CHECK_MUL FROM CART
if (isset($_POST['check_mul']) && $_POST['check_mul'] == 1) {
  if (isset($_POST['key'])) {
    //CLEAR CART TEMP OF THIS USER
    $sql_del = "delete from cart_temp where user_id=" . $_SESSION['id'];
    $stmt_del = $pdo->query($sql_del);
    for ($i = 0; $i < count($_POST['key']); $i++) {
      $split = explode('_', $_POST['key'][$i]['type']);
      $sid_sec = explode('-', $split[0]);
      $idid_sec = explode('-', $split[1]);
      $sid = $sid_sec[1];
      $idid = $idid_sec[1];
      /*
      echo $_POST['key'][$i]['type'].PHP_EOL;
      echo $sid.PHP_EOL;
      echo $idid.PHP_EOL;
      */
      //RETRIEVING SELECTED CART ID'S
      $sql = "select cart_id from cart where store_id=" . $sid . " and item_description_id=" . $idid . " and user_id=" . $_SESSION['id'];
      $stmt = $pdo->query($sql);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      //CART ID
      $cid = $row['cart_id'];
      //CHECK IF CART_ID IS ALREADY PRESENT IN CART TEMP
      $sql1 = "select cart_id from cart_temp where cart_id=" . $cid;
      $stmt1 = $pdo->query($sql1);
      $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
      //DO IF YES
      if ($row1) {
        $response['status'] = "success";
      }
      //DO IF NO
      else {
        $sql = "insert into cart_temp (cart_id,user_id)  values(:cid,:uid)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':cid' => $cid,
          ':uid' => $_SESSION['id']
        ));
        $response['status'] = "success";
      }
    }
    header('Content-type: application/json');
    echo json_encode($response);
  }
}
//CHECK_MUL FROM CART
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------------------------------------
//----------------------------------PLACE ORDER MULTI---------------------------------------------------------
//PLACE ORDER CART MULTI SELECT
//COMPLETED 3
if (isset($_POST['user_id'], $_POST['placeorder_mul'])) {
  $user_id = $_POST['user_id'];
  if (isset($_POST['user'])) {
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
    $pin = $placerow_u['pincode'];
    $phone = $placerow_u['phone'];
    $email = $placerow_u['email'];
    $order_notes = $_POST['order_notes'];
    $pdt_cnt = $_POST['pdt_cnt'];
    $total_amt = $_POST['total_amt'];
    if ($_POST['user'] == 1) {
      $shipping_first_name = $first_name;
      $shipping_last_name = $last_name;
      $shipping_ph_no = $phone;
      $shipping_ph_no2 = "NULL";
      $shipping_address_1 = $address;
      $shipping_postcode = $pin;
      $sql = "select user_delivery_details_id from user_delivery_details where user_id=:user_id and type='permanent'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(':user_id' => $_SESSION['id']));
      $row_uddid = $stmt->fetch(PDO::FETCH_ASSOC);
      $uddid = $row_uddid['user_delivery_details_id'];//USER DELIVERY DETAILS ID
    }
    if ($_POST['user'] == 2) {
      $shipping_first_name = $_POST['shipping_first_name'];
      $shipping_last_name = $_POST['shipping_last_name'];
      $shipping_ph_no = $_POST['shipping_ph_no'];
      $shipping_ph_no2 = $_POST['shipping_ph_no2'];
      $shipping_address_1 = $_POST['shipping_address_1'];
      $shipping_postcode = $_POST['shipping_postcode'];
      $type = 'temporary';
      $sql_delivery = "insert into user_delivery_details (first_name,last_name,phone,pincode,address,alternative_phone,user_id,type)values(:first_name,:last_name,:phone,:pincode,:address,:alternative_phone,:user_id,:type)";
      $stmt_delivery = $pdo->prepare($sql_delivery);
      // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
      $stmt_delivery->execute(array(
        ':first_name' => $shipping_first_name,
        ':last_name' => $shipping_last_name,
        ':phone' => $shipping_ph_no,
        ':pincode' => $shipping_postcode,
        ':alternative_phone' => $shipping_ph_no2,
        ':user_id' => $user_id,
        ':type' => $type,
        ':address' => $shipping_address_1
      ));
      $sql = "select max(user_delivery_details_id) as maxuddid from user_delivery_details where user_id=" . $_SESSION['id'];
      $stmt = $pdo->query($sql);
      $row_uddid = $stmt->fetch(PDO::FETCH_ASSOC);
      $uddid = $row_uddid['maxuddid'];//USER DELIVERY DETAILS ID
    }
  }
  $order_date = date("Y\-m\-j");
  $sql = "insert into order_delivery_details (user_delivery_details_id,order_notes)values(:uddid,:order_notes)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':uddid' => $uddid,
    ':order_notes' => $order_notes
  ));
  $sql = "select max(order_delivery_details_id) as maxoddid from order_delivery_details where user_delivery_details_id=" . $uddid;
  $stmt = $pdo->query($sql);
  $row_oddid = $stmt->fetch(PDO::FETCH_ASSOC);
  $oddid = $row_oddid['maxoddid'];//ORDER DELIVERY DETAILS ID
  $sql = "insert into new_orders (order_delivery_details_id,order_quantity,sub_total,order_date)values(:oddid,:order_quantity,:sub_total,:order_date)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
    ':oddid' => $oddid,
    ':order_quantity' => $pdt_cnt,
    ':sub_total' => $total_amt,
    ':order_date' => $order_date
  ));
  $sql = "select new_orders_id  from new_orders where order_delivery_details_id=" . $oddid;
  $stmt = $pdo->query($sql);
  $row_oddid = $stmt->fetch(PDO::FETCH_ASSOC);
  $noid = $row_oddid['new_orders_id'];//NEW ORDER ID
//TEMPERORY
  $sql = "select product_details.product_details_id,cart.order_type,cart.quantity,cart.total_amt from cart
  inner join cart_temp on cart_temp.cart_id=cart.cart_id
  join item_description on cart.item_description_id=item_description.item_description_id
  join product_details on product_details.item_description_id=item_description.item_description_id
  where cart.store_id=product_details.store_id and cart_temp.user_id=:user_id";
  $stmt_cart = $pdo->prepare($sql);
  $stmt_cart->execute(array(':user_id' => $_SESSION['id']));
  while ($row_cart = $stmt_cart->fetch(PDO::FETCH_ASSOC)) {
    $sql = "insert into new_ordered_products (new_orders_id,product_details_id,order_type,item_quantity,total_amt,delivery_status)values(:noid,:pdid,:order_type,:item_quantity,:total_amt,'pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':noid' => $noid,
      ':pdid' => $row_cart['product_details_id'],
      ':order_type' => $row_cart['order_type'],
      ':item_quantity' => $row_cart['quantity'],
      ':total_amt' => $row_cart['total_amt']
    ));
  }
  //TEMPERORY
  $placesql_s = "select* from store st
    inner join cart ca on st.store_id=ca.store_id
    inner join cart_temp ct on ct.cart_id=ca.cart_id
    inner join store_admin sa on st.store_id=sa.store_id
    where ca.user_id=:user_id  GROUP BY st.store_id";
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
    $order_id;
    $placesql_i = "select id.item_description_id,ca.cart_id,it.category_id,it.sub_category_id,it.item_id,it.item_name,it.description,pd.price,ca.quantity,ca.order_type,ca.total_amt from cart ca
        join cart_temp ct on ct.cart_id=ca.cart_id
        inner join product_details pd on ca.item_description_id=pd.item_description_id
        inner join item_description id on id.item_description_id=pd.item_description_id
        inner join store st on st.store_id=ca.store_id
        inner join item it on it.item_id=id.item_id
        where id.item_description_id=ca.item_description_id and ca.user_id=:user_id and st.store_id=:store_id GROUP BY ca.item_description_id";
    $placestmt_i = $pdo->prepare($placesql_i);
    $placestmt_i->execute(array(
      ':user_id' => $user_id,
      ':store_id' => $store_array[$j]['store_id']
    ));
    while ($placerow_i = $placestmt_i->fetch(PDO::FETCH_ASSOC)) {
      /////////////ADD AS ORDERED///////////
      $check = $pdo->query('select ordered_cnt,item_description_id from item_keys where item_description_id=' . $placerow_i['item_description_id'] . ' and user_id=' . $_SESSION['id']);
      if ($check->rowCount() > 0) {
        $checkrow = $check->fetch(PDO::FETCH_ASSOC);
        if (is_null($checkrow['ordered_cnt']) || $checkrow < 1) {
          $sql = 'update item_keys set ordered_cnt=' . $placerow_i['quantity'] . ' where item_description_id=' . $placerow_i['item_description_id'];
        } else {
          $sql = 'update item_keys set ordered_cnt=ordered_cnt+' . $placerow_i['quantity'] . ' where item_description_id=' . $placerow_i['item_description_id'];
        }
        $viewedsql = $pdo->query($sql);
      } else {
        $viewedsql = $pdo->prepare("insert into item_keys (views,ordered_cnt,user_id,item_description_id,date_of_preview) values (1,:oc,:uid,:idid,:dop)");
        $date = date("Y\-m\-d");
        $viewedsql->execute(array(
          ':oc' => $placerow_i['quantity'],
          ':uid' => $_SESSION['id'],
          ':idid' => $placerow_i['item_description_id'],
          ':dop' => $date
        ));
      }
      ////////////ADD AS ORDERED////////////
      $store_array[$j]['item_category_id'][$k] = $placerow_i['category_id'];
      $store_array[$j]['item_sub_category_id'][$k] = $placerow_i['sub_category_id'];
      $store_array[$j]['item_description_id'][$k] = $placerow_i['item_description_id'];
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
  $sql = "select cart_id from cart_temp where user_id=:user_id";
  $stmt_cart = $pdo->prepare($sql);
  $stmt_cart->execute(array(':user_id' => $_SESSION['id']));
  while ($row_cart = $stmt_cart->fetch(PDO::FETCH_ASSOC)) {
    $sqldel1 = "delete from cart where cart_id=" . $row_cart['cart_id'];
    $stmtdel1 = $pdo->query($sqldel1);
    $sqldel2 = "delete from cart_temp where cart_id=" . $row_cart['cart_id'];
    $stmtdel2 = $pdo->query($sqldel2);
  }
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EMAIL SENDING//
  $from = 'onestoreforallyourneeds@gmail.com';
  $subject = 'Your requested orders';
  $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
  $activate_link = '../Order/myorders.php?id=' . $user_id;
  //EMAIL SENDING//
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $message1 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
               <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Processed</span></p> </td>
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
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $first_name . " " . $last_name . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Order has been successfully processed.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID <span style="font-weight:bold;color:#000">OSUID' . sprintf('%06d', $user_id) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">OSID' . sprintf('%06d', $noid) . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Your order for the below listed item(s) is processed successfully  by <b>' . date("F j") . " , " . date("Y") . '</b> and will be available for you to purchase at specific shops mentioned below . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $total_bill . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_first_name . " " . $shipping_last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_address_1 . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_postcode . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
               <tbody>
                <tr>
                 <td valign="top" align="left"><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: If you do not collect your items (booked) from specified shop with in specified period of time(varies according to the items) , your order will be cancelled.
                    In case this items will be removed from your cart and moved to wishlist .Thereafter you need to purchase it again as per as your needs. </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>';
  for ($l = 0; $l < $i; $l++) {
    $store_total = 0;
    $message1 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
				<tr>
					<td>
						<table width="600" align="center">
							<tr colspan="2" >
								<td>
									<h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 8px;padding-bottom: 25px;font-family:Arial">
								    <span style="float:left;">Opening hours : ' . $store_array[$l]['opening_hours'] . '</span>
								    <span style="float:right;">Store : ' . $store_array[$l]['store_name'] . '</span><br>
								    <span style="float:left;">status : ' . $store_array[$l]['status'] . '</span>
								    <span style="float:right;">Ph : ' . $store_array[$l]['phone'] . '</span>';
    $message1 .= '</h4></td></tr></table></td></tr></table>';
    for ($m = 0; $m < $store_cnt[$l]; $m++) {
      $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $store_array[$l]['item_description_id'][$m] . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $store_array[$l]['item_category_id'][$m] . '/' . $store_array[$l]['item_sub_category_id'][$m] . '/' . $store_array[$l]['item_description_id'][$m] . '.jpg" alt="' . $store_array[$l]['item_name'][$m] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
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
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Total: &#8377; ' . $store_array[$l]['item_total_amt'][$m] . '</p>';
      $store_total += $store_array[$l]['item_total_amt'][$m];
      $message1 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    }
    $message1 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount to be Paid @' . $store_array[$l]['store_name'] . ': &#8377; ' . $store_total . '</p>
				<hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
  }
  $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                    <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
  // Everything seems OK, time to send the email.
  $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  $mail->isSMTP();
  $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
  $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
  $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
  $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
  $mail->SMTPAuth = true;
  $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
  $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
  // Recipients
  $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
  $mail->addAddress($email, $first_name); // to email and name
  // Content
  $mail->Subject = $subject;
  $mail->msgHTML($message1); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    $response['status'] = "error";
    $_SESSION['error'] = "Email can't Send";
    //echo "Mailer Error: " . $mail->ErrorInfo;
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $subject = 'Requested service';
  $activate_link = '../../Store%20admin/index.php?id=' . $user_id;
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
    $message2 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Requested</span></p> </td>
            </tr>
            <tr>
            </tr>
           </tbody>
          </table></td>
        </tr>
       </tbody>
      </table>
       </td>
    </tr>
    <tr>
     <td>
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $store_array[$l]['username'] . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px"> Order has been requested.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">Store ID <span style="font-weight:bold;color:#000">OSSID' . sprintf('%06d', $store_array[$l]['store_id']) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">OSID' . sprintf('%06d', $noid) . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Below listed item(s) are requested by the customer  by <b>' . date("F j") . " , " . date("Y") . '</b> from your store <b>' . $store_array[$l]['store_name'] . '</b>. Thanks for your cooperation with us and also wishing you best with your sales . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $total_bill . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_first_name . " " . $shipping_last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $shipping_address_1 . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">PIN - ' . $shipping_postcode . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $email . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
                <tbody>
                </tbody>
              </table>  ';
    $message2 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
        <tr>
          <td>
            <table width="600" align="center">
              <tr colspan="2" >
                <td>
                  <h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 0px;padding-bottom: 0px;font-family:Arial">
                    <table width="100%" cellspacing="10px">
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer name : ' . $first_name . " " . $last_name . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">Ph : ' . $phone . '</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer id : OSUID' . sprintf('%06d', $user_id) . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">' . $email . '</span>
                        </td>
                  </tr>';
    $message2 .= '</table></h4></td></tr></table></td></tr></table>';
    for ($m = 0; $m < $store_cnt[$l]; $m++) {
      $store_array[$l]['item_description_id'][$m];
      $store_array[$l]['item_category_id'][$m];
      $store_array[$l]['item_sub_category_id'][$m];
      $store_array[$l]['item_name'][$m];
      $store_array[$l]['item_description'][$m];
      $store_array[$l]['item_price'][$m];
      $store_array[$l]['item_quantity'][$m];
      $store_array[$l]['item_ordertype'][$m];
      $store_array[$l]['item_total_amt'][$m];
      $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $store_array[$l]['item_description_id'][$m] . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $store_array[$l]['item_category_id'][$m] . '/' . $store_array[$l]['item_sub_category_id'][$m] . '/' . $store_array[$l]['item_description_id'][$m] . '.jpg" alt="' . $store_array[$l]['item_name'][$m] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
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
      $store_total += (int) $store_array[$l]['item_quantity'][$m] * (int) $store_array[$l]['item_price'][$m];
      $message2 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    }
    $message2 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount : &#8377; ' . $store_total . '</p><hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
    $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                     <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
    // Everything seems OK, time to send the email.
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
    // Recipients
    $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    $mail->addAddress($store_array[$l]['email'], $store_array[$l]['store_name']); // to email and name
    // Content
    $mail->Subject = $subject;
    $mail->msgHTML($message2); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
    if (!$mail->send()) {
      $response['status'] = "error";
      $_SESSION['error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
      //echo "Mailer Error: " . $mail->ErrorInfo;
    }
  }
  if (!isset($response['status'])) {
    $response['status'] = "success";
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//COMPLETED 3
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CANCEL PRODUCT
if (isset($_POST['cancel_product'])) {
  $nopid = $_POST['nopid'];
  $query = "select users.first_name as fn,users.last_name as ln,user_delivery_details.user_id,user_delivery_details.first_name,user_delivery_details.last_name,user_delivery_details.phone,user_delivery_details.address,user_delivery_details.pincode,users.email,new_orders.new_orders_id,new_orders.order_quantity,new_orders.sub_total,new_orders.order_date,size,color,weight,flavour,processor,display,battery,internal_storage,brand,material,new_ordered_products.order_type,new_ordered_products.new_ordered_products_id,new_ordered_products.item_quantity,new_ordered_products.total_amt,new_ordered_products.delivery_status,product_details.product_details_id,product_details.price,store_admin.email as storemail,store_admin.username,store.store_id,store.store_name,store.opening_hours,store.status,store_admin.phone,item.price as mrp,item_description.item_description_id,category.category_id,sub_category.sub_category_id,item.item_name FROM new_orders
      JOIN order_delivery_details ON order_delivery_details.order_delivery_details_id=new_orders.order_delivery_details_id
      JOIN user_delivery_details ON user_delivery_details.user_delivery_details_id=order_delivery_details.user_delivery_details_id
      JOIN users ON users.user_id=user_delivery_details.user_id
      JOIN new_ordered_products ON new_ordered_products.new_orders_id=new_orders.new_orders_id
      JOIN product_details ON new_ordered_products.product_details_id=product_details.product_details_id
      JOIN item_description ON product_details.item_description_id=item_description.item_description_id
      JOIN item ON item.item_id=item_description.item_id
      JOIN category ON category.category_id=item.category_id
      JOIN sub_category ON sub_category.sub_category_id=item.sub_category_id
      JOIN store on store.store_id=product_details.store_id
      JOIN store_admin on store.store_id=store_admin.store_id
      WHERE users.user_id=:user_id and new_ordered_products.new_ordered_products_id=:nopid ";
  $statement = $pdo->prepare($query);
  $statement->execute(array(
    ':user_id' => $_SESSION['id'],
    ':nopid' => $nopid
  ));
  $row = $statement->fetch(PDO::FETCH_ASSOC);
  $item_qnty = $row['item_quantity'];
  $item_tot_amt = $row['total_amt'];
  $prev_order_tot_amt = $row['sub_total'];
  $new_order_tot_amt = $prev_order_tot_amt - $item_tot_amt;
  $idid = $row['item_description_id'];
  $pid = $row['product_details_id'];
  $order_id = "OSID" . sprintf('%06d', $row['new_orders_id']);
  /*
    echo "Order_id : ".$order_id." | product_details_id : ".$pid." | item_qnty : ".$item_qnty." | pre_tot : ".$prev_order_tot_amt." | new_tot : ".$new_order_tot_amt;
  */
  $pdtupdatestmt = $pdo->query("update product_details set quantity=quantity+" . $item_qnty . " where product_details_id=" . $pid);
  $sql = $pdo->query("update item_keys set ordered_cnt=ordered_cnt-" . $item_qnty . " where item_description_id=" . $idid . " and user_id=" . $_SESSION['id']);
  $chkpendstmt = $pdo->query("update new_ordered_products set delivery_status='cancelled' where new_ordered_products_id=" . $nopid);
  $user_firstnm = $row['fn'];
  $user_lastnm = $row['ln'];
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $user_id = $row['user_id'];
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //EMAIL SENDING//
  $from = 'onestoreforallyourneeds@gmail.com';
  $subject = 'Order cancelled';
  $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
  $activate_link = '../Order/myorders.php?id=' . $user_id;
  //EMAIL SENDING//
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $message1 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
               <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Cancelled</span></p> </td>
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
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $user_firstnm . " " . $user_lastnm . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px">Your Order has been cancelled.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">User ID <span style="font-weight:bold;color:#000">OSUID' . sprintf('%06d', $user_id) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">' . $order_id . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Your order for the below listed item(s) is cancelled successfully  by <b>' . date("F j") . " , " . date("Y") . '</b> and your updated price is given below if your order contain multiple products, ignore otherwise . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $new_order_tot_amt . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $first_name . " " . $last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $row['address'] . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">PIN - ' . $row['pincode'] . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $row['email'] . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
               <tbody>
                <tr>
                 <td valign="top" align="left"><p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;padding-bottom:2px;line-height:19px;padding-right:10px;text-align: justify;"> Note: If you do not collect your items (booked) from specified shop with in specified period of time(varies according to the items) , your order will be cancelled.
                    In case this items will be removed from your cart and moved to wishlist .Thereafter you need to purchase it again as per as your needs. </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>';
  $message1 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
				<tr>
					<td>
						<table width="600" align="center">
							<tr colspan="2" >
								<td>
									<h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 8px;padding-bottom: 25px;font-family:Arial">
								    <span style="float:left;">Opening hours : ' . $row['opening_hours'] . '</span>
								    <span style="float:right;">Store : ' . $row['store_name'] . '</span><br>
								    <span style="float:left;">status : ' . $row['status'] . '</span>
								    <span style="float:right;">Ph : ' . $row['phone'] . '</span>';
  $message1 .= '</h4></td></tr></table></td></tr></table>';
  $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $idid . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $row['category_id'] . '/' . $row['sub_category_id'] . '/' . $row['item_description_id'] . '.jpg" alt="' . $row['item_name'] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
                </tr>
               </tbody>
              </table>
              <table width="455" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top" align="left">
                 <p style="margin-bottom:13px;margin-top:20px"> <a href="" style="font-family:Arial;font-size:14.5px;font-weight:bold;font-style:normal;font-stretch:normal;line-height:1.43;color:#15c;text-decoration:none!important;word-spacing:0.2em" rel="noreferrer" target="_blank" data-saferedirecturl=""> ' . $row['item_name'] . '</a> </p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Price: &#8377; ' . $row['price'] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Qty: ' . $row['item_quantity'] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Order type: ' . $row['order_type'] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Total: &#8377; ' . $item_tot_amt . '</p>';
  $message1 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
  $message1 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount to be Paid @' . $row['store_name'] . ': &#8377; ' . $new_order_tot_amt . '</p>
				<hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
  $message1 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                    <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
  // Everything seems OK, time to send the email.
  $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  $mail->isSMTP();
  $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
  $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
  $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
  $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
  $mail->SMTPAuth = true;
  $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
  $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
  // Recipients
  $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
  $mail->addAddress($row['email'], $user_firstnm); // to email and name
  // Content
  $mail->Subject = $subject;
  $mail->msgHTML($message1); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    $response['status'] = "error";
    $_SESSION['error'] = "Email can't Send";
    //echo "Mailer Error: " . $mail->ErrorInfo;
  }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $subject = 'Requested service cancelled by a user';
  $activate_link = '../../Store%20admin/index.php?id=' . $row['store_id'];
  $message2 = '<table style="width:100%!important">
   <tbody>
    <tr background="../../images/logo/log2.jpg" width="834px" height="60">
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
             <td style="width:60%;text-align:right;padding-top:5px"> <p style="color:rgba(255,255,255,0.8);font-family:Arial;font-size:16px;text-align:right;color:#ffffff;font-style:normal;font-stretch:normal">Order <span style="font-weight:bold">Cancelled</span></p> </td>
            </tr>
            <tr>
            </tr>
           </tbody>
          </table></td>
        </tr>
       </tbody>
      </table>
       </td>
    </tr>
    <tr>
     <td>
      <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" style="border:1px solid #bbb">
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
                   <span style="font-weight:bold;color:#191919"> ' . $row['username'] . ',</span> </p> <p style="font-family:Arial;font-size:12px;color:#878787;line-height:1.22;padding-top:0px;margin-top:0px"> Order has been cancelled.</p> </td>
                </tr>
               </tbody>
              </table>
              <table width="230" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top"> <p style="font-family:Arial;color:#747474;font-size:11px;font-weight:normal;text-align:right;font-style:normal;line-height:1.1;font-stretch:normal;margin-top:7px;padding-top:0px;color:#878787">Store ID <span style="font-weight:bold;color:#000">OSSID' . sprintf('%06d', $row['store_id']) . '</span> </p> <p style="font-family:Arial;font-size:11px;color:#878787;line-height:1.22;text-align:right;padding-top:0px">Order ID <span style="font-weight:bold;color:#000">' . $order_id . '</span> </p> </td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
            <tr>
             <td border="1" align="left" style="background-color:rgba(245,245,245,0.5);background:rgba(245,245,245,0.5);border:.5px solid #6ed49e;border-radius:2px;padding-top:10px;padding-bottom:5x;border-color:#6ed49e;border-width:.08em;border-style:solid;border:.08em solid #6ed49e">
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td align="left"> <p style="font-family:Arial;font-size:12px;text-align:left;color:#212121;padding-left:15px;padding-top:0px;line-height:1.62;padding-right:10px">Below listed item(s) are cancelled by the customer  by <b>' . date("F j") . " , " . date("Y") . '</b> from your store <b>' . $row['store_name'] . '</b>. Thanks for your cooperation with us and also wishing you best with your sales . </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="350" border="0" cellpadding="0" cellspacing="0" align="left">
               <tbody>
                <tr>
                 <td valign="top">
                  <p style="padding-left:15px;font-family:Arial;font-size:14px;line-height:1.58;margin-bottom:30px;margin-top:15;padding-top:2px"><span style="display:inline-block;width:167px;color:#212121">Total amount</span><span style="display:inline-block;font-family:Arial;font-size:15px;font-weight:700;color:#139b3b;display:inline-block">Rs. ' . $new_order_tot_amt . '</span></p>
                 </td>
                </tr>
                <tr>
                  <td valign="top">
                    <p style="padding-left:15px;margin-bottom:10px;margin-top: 0px;"> <a href="../Order/myorders.php?id=' . $user_id . '" style="background-color:rgb(41,121,251);color:#fff;padding:8px 16px 7px 16px;border:0px;font-size:14px;display:inline-block;margin-top:10px;border-radius:2px;text-decoration:none" rel="noreferrer" target="_blank" data-saferedirecturl=""> <button type="button" style="background-color:rgb(41,121,251);color:#fff;border:0px;font-size:14px;border-radius:2px;text-decoration:none">View Order Status</button> </a> </p>
                  </td>
                </tr>
               </tbody>
              </table>
              <table width="235" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                  <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Delivery Address</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $first_name . " " . $last_name . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">' . $row['address'] . '</span>
                  <br> <span style="font-family:Arial;text-transform:capitalize;font-size:12px;color:#212121">PIN - ' . $row['pincode'] . '</span></p> <br></td>
                </tr>
                <tr>
                 <td valign="top" align="left"> <p style="margin-top:0px;padding-left:12px;line-height:1.56;margin-bottom:0"><span style="font-family:Arial;font-size:14px;font-weight:bold;text-align:left;color:#212121">Email updates sent to</span> <br> <span style="font-family:Arial;font-size:12px;color:#212121">' . $row['storemail'] . '</span> </p> </td>
                </tr>
               </tbody>
              </table>
              <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-top: 0px;">
               <tbody>
                <br>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>  ';
  $message2 .= '<table style="background-color: #02171e;width:100%;text-align:center" align="center">
        <tr>
          <td>
            <table width="600" align="center">
              <tr colspan="2" >
                <td>
                  <h4 style="padding:5px;margin:0px;background-color: #02171e;color: white;padding-top: 0px;padding-bottom: 0px;font-family:Arial">
                    <table width="100%" cellspacing="10px">
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer name : ' . $user_firstnm . " " . $user_lastnm . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">Ph : ' . $row['phone'] . '</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span style="color:#fff;float:left">Customer id : OSUID' . sprintf('%06d', $user_id) . '</span>
                        </td>
                        <td>
                          <span style="color:#fff;float:right">' . $row['email'] . '</span>
                        </td>
                  </tr>';
  $message2 .= '</table></h4></td></tr></table></td></tr></table>';
  $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
           <tbody>
            <tr>
             <td align="left">
              <table width="120" border="0" cellpadding="0" cellspacing="0" align="left" style="margin-bottom: 15px;">
               <tbody>
                <tr>
                 <td valign="middle" width="120" align="center"> <a style="color:#027cd8;text-decoration:none;outline:none;color:#fff;font-size:13px" href="../Product/single.php?id=' . $idid . '" rel="noreferrer" target="_blank" data-saferedirecturl=""> <img border="0" src="../../images/' . $row['category_id'] . '/' . $row['sub_category_id'] . '/' . $idid . '.jpg" alt="' . $row['item_name'] . '" style="border:none;max-width:125px;max-height:125px;margin-top:20px" class="CToWUd"> </a> </td>
                </tr>
               </tbody>
              </table>
              <table width="455" border="0" cellpadding="0" cellspacing="0" align="right">
               <tbody>
                <tr>
                 <td valign="top" align="left">
                 <p style="margin-bottom:13px;margin-top:20px"> <a href="" style="font-family:Arial;font-size:14.5px;font-weight:bold;font-style:normal;font-stretch:normal;line-height:1.43;color:#15c;text-decoration:none!important;word-spacing:0.2em" rel="noreferrer" target="_blank" data-saferedirecturl=""> ' . $row['item_name'] . '</a> </p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Price: &#8377; ' . $row['price'] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Qty: ' . $row['item_quantity'] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Order type: ' . $row['order_type'] . '</p>
                 <p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;line-height:12px">Total: &#8377; ' . (int) $row['item_quantity'] * (int) $row['price'] . '</p>';
  $message2 .= '</td>
                </tr>
               </tbody>
              </table> </td>
            </tr>
           </tbody>
          </table>
          <hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
  $message2 .= '<p style="font-family:Arial;font-style:normal;font-size:12px;font-stretch:normal;color:#212121;font-weight:bold;line-height:12px">Total amount : &#8377; ' . $new_order_tot_amt . '</p><hr style="    border: 3px solid #E0E0E0 !important;margin: 0px;padding: 0px;color: #E0E0E0 !important;background-color:#E0E0E0 !important;">';
  $message2 .= '<table border="0" width="600" cellpadding="0" cellspacing="0" style="padding-right:20px;padding-left:20px;background-color:#fff;width:640px;max-width:640px">
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
                     <td style="width:40%;text-align:left;padding-top:5px"> <a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="https://www.one-store.ml"><img  border="0" src="../../images/logo/logo.png" alt="OneStore.ml" style="border:none;width: 150px;" class="CToWUd"> </a> </td>
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
  // Everything seems OK, time to send the email.
  $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  $mail->isSMTP();
  $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
  $mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
  $mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
  $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
  $mail->SMTPAuth = true;
  $mail->Username = CONTACTFORM_SMTP_USERNAME;// email
  $mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
  // Recipients
  $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
  $mail->addAddress($row['storemail'], $row['store_name']); // to email and name
  // Content
  $mail->Subject = $subject;
  $mail->msgHTML($message2); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
  $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  if (!$mail->send()) {
    $response['status'] = "error";
    $_SESSION['error'] = "An error occurred while trying to send your message: " . $mail->ErrorInfo;
    //echo "Mailer Error: " . $mail->ErrorInfo;
  }
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//CANCEL PRODUCT
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//GET COOKIE
if (isset($_POST['getcookie'])) {
  $sql = $pdo->query("select * from cookie where user_id=" . $_POST['userid']);
  $check = $sql->rowCount();
  if ($check > 0) {
    $cookieset = "cookieset";
    setcookie($cookieset, "y", time() + (2 * 30 * 24 * 60 * 60));
    $response['status'] = "success";
  } else {
    $response['status'] = "error";
  }
  header('Content-type: application/json');
  echo json_encode($response);
}
//GET COOKIE
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//STORE COOKIE
if (isset($_POST['storecookie'])) {
  $pc = $_POST['pc'];
  $fc = $_POST['fc'];
  $tc = $_POST['tc'];
  $stmt = $pdo->prepare("insert into cookie (user_id,strictly_necessary,performance,functional,targeting) values(:uid,1,:pc,:fc,:tc)");
  $stmt->execute(array(
    ':uid' => $_POST['userid'],
    ':pc' => $pc,
    ':fc' => $fc,
    ':tc' => $tc
  ));
  $cookieset = "cookieset";
  setcookie($cookieset, "y", time() + (2 * 30 * 24 * 60 * 60));
  $response['status'] = "success";
  header('Content-type: application/json');
  echo json_encode($response);
}
//STORE COOKIE
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>