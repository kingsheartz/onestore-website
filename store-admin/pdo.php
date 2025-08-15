<?php
try {
  // Server
  $pdo = new PDO("mysql:host=sql306.infinityfree.com;port=3306;dbname=if0_39541220_onestore", "if0_39541220", "Onestore12345");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $_SESSION['onestore_success'] = "Connected successfully";
} catch (PDOException $e) {
  try {
    // Local
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=onestore", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $_SESSION['onestore_success'] = "Connected successfully";
  } catch (PDOException $e) {
    $_SESSION['onestore_error'] = "OOPS !!! CONNECTION CAN'T BE ESTABLISHED";
  }
}
