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
if (isset($_POST['add'])) {
    require "pdo.php";
    if (empty($_POST['item_name'])) {
        redirectWithError("Please enter product name in the form.");
    }
    if (empty($_POST['cat'])) {
        redirectWithError("Please enter category in the form.");
    }
    if (empty($_POST['description'])) {
        redirectWithError("Please enter description in the form.");
    }
    if (empty($_POST['sub'])) {
        redirectWithError("Please enter subcategory in the form.");
    }
    if (empty($_POST['item_price'])) {
        redirectWithError("Please enter Price in the form.");
    }
    $flag = 0;
    for ($i = 1; $i <= 9; $i++) {
        if (($_FILES['my_file' . $i]['name'] != "")) {
            $flag = 1;
        }
    }
    if ($flag == 0) {
        redirectWithError("Please Select atleast One Image.");
    }
    $query = "SELECT max(item_id) FROM item  ";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $max = $result['max(item_id)'];
    if (isset($_POST['item_name']) && isset($_POST['description']) && isset($_POST['cat']) && isset($_POST['sub']) && isset($_POST['item_price'])) {
        $max = $max + 1;
        $data = array(
            ':item_id' => $max,
            ':item_name' => $_POST['item_name'],
            ':description' => $_POST['description'],
            ':category' => $_POST['cat'],
            ':subcategory' => $_POST['sub'],
            ':price' => $_POST['item_price']
        );
        $query = "INSERT INTO item (item_id,item_name,description,category_id,sub_category_id,added_date,permission,price) VALUES (:item_id,:item_name,:description,:category,:subcategory,NOW(),1,:price)";
        $statement = $pdo->prepare($query);
        $statement->execute($data);
        //for loop ending
        function makeDir($path)
        {
            return is_dir($path) || mkdir($path);
        }
        for ($i = 1; $i <= 9; $i++) {
            if (!isset($_POST['size' . $i]) || !isset($_POST['color' . $i]) || !isset($_POST['weight' . $i]) || !isset($_POST['flavour' . $i]) || !isset($_POST['processor' . $i]) || !isset($_POST['display' . $i]) || !isset($_POST['battery' . $i]) || !isset($_POST['internal_storage' . $i]) || !isset($_POST['brand' . $i]) || !isset($_POST['material' . $i]))
                continue;
            $size = isset($_POST['size' . $i]) ? $_POST['size' . $i] : 0;
            $color = isset($_POST['color' . $i]) ? $_POST['color' . $i] : 0;
            $weight = isset($_POST['weight' . $i]) ? $_POST['weight' . $i] : 0;
            if ($weight == '') {
                $weight = 0;
            }
            if ($size == '') {
                $size = 0;
            }
            if ($color == '') {
                $color = 0;
            }
            $flavour = isset($_POST['flavour' . $i]) ? $_POST['flavour' . $i] : 0;
            if ($flavour == '') {
                $flavour = 0;
            }
            $processor = isset($_POST['processor' . $i]) ? $_POST['processor' . $i] : 0;
            if ($processor == '') {
                $processor = 0;
            }
            $display = isset($_POST['display' . $i]) ? $_POST['display' . $i] : 0;
            if ($display == '') {
                $display = 0;
            }
            $battery = isset($_POST['battery' . $i]) ? $_POST['battery' . $i] : 0;
            if ($battery == '') {
                $battery = 0;
            }
            $internal_storage = isset($_POST['internal_storage' . $i]) ? $_POST['internal_storage' . $i] : 0;
            if ($internal_storage == '') {
                $internal_storage = 0;
            }
            $brand = isset($_POST['brand' . $i]) ? $_POST['brand' . $i] : 0;
            if ($brand == '') {
                $brand = 0;
            }
            $material = isset($_POST['material' . $i]) ? $_POST['material' . $i] : 0;
            if ($material == '') {
                $material = 0;
            }
            if (($_FILES['my_file' . $i]['name'] != "")) {
                $file = $_FILES['my_file' . $i]['name'];
                $path = pathinfo($file);
                $ext = $path['extension'];
                if ($ext != "jpg" && $ext != "JPG") {
                    redirectWithError("Please Select a jpg file");
                }
            }
            $data1 = array(
                ':item_id' => $max,
                ':size' => $size,
                ':color' => $color,
                ':weight' => $weight,
                ':flavour' => $flavour,
                ':processor' => $processor,
                ':display' => $display,
                ':battery' => $battery,
                ':internal_storage' => $internal_storage,
                ':brand' => $brand,
                ':material' => $material
            );
            $query1 = "INSERT INTO item_description (item_id,
size,
color,
weight,
flavour,
processor,
display,
battery,
internal_storage,
brand,
material) VALUES (:item_id,
:size,
:color,
:weight,
:flavour,
:processor,
:display,
:battery,
:internal_storage,
:brand,:material)";
            $statement1 = $pdo->prepare($query1);
            $statement1->execute($data1);
            if (($_FILES['my_file' . $i]['name'] != "")) {
                // Where the file is going to be stored
                $t1 = $_POST['cat'];
                $t2 = $_POST['sub'];
                $query = "SELECT max(item_description_id) FROM item_description  ";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $max1 = $result['max(item_description_id)'];
                makeDir("../images/" . $t1);
                makeDir("../images/" . $t1 . "/" . $t2);
                $target_dir = "../images/" . $t1 . "/" . $t2 . "/";
                $file = $_FILES['my_file' . $i]['name'];
                $path = pathinfo($file);
                $filename = $max1;
                $ext = $path['extension'];
                $temp_name = $_FILES['my_file' . $i]['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;
                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                    redirectWithError("Sorry, file already exists.");
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);
                }
            }
        }
        redirectSuccess();
    } else {
        redirectWithError("Wrong Input ");
    }
}
?>