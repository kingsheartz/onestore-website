<?php
require_once __DIR__ . '/vendor/autoload.php';
function redirectWithError($error)
{
  $_SESSION['_contact_form_error'] = $error;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  echo "Error: " . $error;
  die();
}
function redirectSuccess()
{
  $_SESSION['_contact_form_success'] = true;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  echo "Product added  successfully!";
  die();
}
session_start();
require "pdo.php";
if (isset($_POST['desc_id'])) {
  if (isset($_POST['upload_image'])) {
    $it = $_POST['desc_id'];
    $n = $_POST['nj'];
    function makeDir($path)
    {
      return is_dir($path) || mkdir($path);
    }
    for ($i = 1; $i <= $n; $i++) {
      if (($_FILES['my_file' . $i]['name'] != "")) {
        // Where the file is going to be stored
        $t1 = $_POST['cat'];
        $t2 = $_POST['sub'];
        $max1 = $it;
        $res = "" . $it . "_" . $i;
        makeDir("../images/" . $t1);
        makeDir("../images/" . $t1 . "/" . $t2);
        $target_dir = "../images/" . $t1 . "/" . $t2 . "/";
        $file = $_FILES['my_file' . $i]['name'];
        $path = pathinfo($file);
        $filename = $res;
        $ext = $path['extension'];
        $temp_name = $_FILES['my_file' . $i]['tmp_name'];
        $path_filename_ext = $target_dir . $filename . "." . $ext;
        // Check if file already exists
        move_uploaded_file($temp_name, $path_filename_ext);
      }
      //file upload
    }
    $query = "UPDATE item_description SET img_count=$n WHERE item_description_id=$it";
    $statement = $pdo->prepare($query);
    $statement->execute($data);
    redirectSuccess();
  }
}
?>