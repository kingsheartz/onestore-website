<?php
session_start();
require 'pdo.php';
unset($_SESSION['admin']);
if (isset($_POST['user']) || isset($_POST['pass'])) {
    $query = "SELECT * from admin";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if ($_POST['user'] != $row['username'] && !(password_verify($_POST['pass'], $row['password']))) {
        $_SESSION['error'] = "<script>$('#psin').show();
      $('#psin2').hide();
      $('#usin').show();
      $('#usin2').hide();
      $('#errorms').text('Incorrect UserName And Password');
      $('#errorms').show();</script>";
        header('Location:login.php');
        return;
    }
    if ($_POST['user'] != $row['username']) {
        $_SESSION['error'] = "<script>$('#usin').show();
    $('#usin2').hide();
    $('#errorms').text('Incorrect User Name');
    $('#errorms').show();</script>";
        header('Location:login.php');
        return;
    }
    if (!(password_verify($_POST['pass'], $row['password']))) {
        $_SESSION['error'] = "<script>$('#psin').show();
    $('#psin2').hide();
    $('#errorms').text('Incorrect Password');
    $('#errorms').show();</script>";
        header('Location:login.php');
        return;
    }
    if ($_POST['user'] == $row['username'] && password_verify($_POST['pass'], $row['password'])) {
        $_SESSION['admin'] = "1";
        header('Location:index.php');
    }
}
?>

<head>
    <title>One Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    body {
        overflow-x: hidden;
        width: 100%;
    }

    .card {
        padding: 20px;
        padding-right: 50px;
        padding-left: 50px;
        text-align: center;
        box-shadow: 1px 1px 3px rgb(0 0 0 / 10%);
        border-radius: 5px;
        background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #5b5d5b), color-stop(1, #191919)) !important;
    }

    .row {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        margin-right: -0.75rem;
        margin-left: -0.75rem;
        position: relative;
        z-index: 100;
        padding: 0;
        padding-top: 200px;
    }

    .justify-content-center {
        justify-content: center !important;
    }

    .card-head {
        color: #dedede;
        font-size: 28px;
        font-family: serif;
        margin-bottom: 20px;
    }

    label {
        float: left;
        color: #6d6d6d;
        font-family: 'Lucidia Sans';
        margin-top: 30px;
    }

    input {
        width: 100%;
        height: 30px;
        background: transparent;
        border: none;
        border-bottom: 2px solid #00bcd4;
        color: white;
        outline: none;
        padding-right: 15px;
    }

    .bck {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -100;
    }

    .back-hd {
        padding-top: 50px;
        background: url('images/logo/adminbackhd.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 1000px;
    }

    .back-bd {
        background: url(images/logo/adminlogo.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 800px;
        display: flex;
        flex-wrap: wrap;
        margin-right: -0.75rem;
        margin-left: -0.75rem;
    }

    button.Login {
        width: 200px;
        margin-top: 50px;
        padding: 5px;
        font-family: sans-serif;
        font-size: 16px;
        background: #2196f3;
        float: right;
        border: none;
        color: white;
        border-radius: 5px;
    }

    .grp {
        position: relative;
        width: 100%;
    }

    @media (min-width: 768px) {
        .back-hd {
            display: none;
        }
    }

    @media (max-width: 768px) {

        .back-bd,
        .back-bd-as,
        .col-sm-8 {
            display: none;
        }

        .back-hd {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .col-sm-4,
        .col-sm-8 {
            width: 100%;
        }

        .card,
        .row {
            width: 100%;
            margin: 0;
        }
    }

    #errorms {
        display: none;
        color: red;
    }

    .back-bd-as {
        height: 800px;
        background: #000;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        z-index: 9;
        position: absolute;
        opacity: 0.5;
        width: 100%;
        box-shadow: 1px 1px 2px 1px black;
    }
</style>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    function check() {
        var us = $('#user').val();
        var ps = $('#pass').val();
        if (ps == '' && us == '') {
            $('#psin').show();
            $('#psin2').hide();
            $('#usin').show();
            $('#usin2').hide();
            $('#errorms').text("All Fields Must Be Filled");
            $('#errorms').show();
            return;
        }
        if (us == '') {
            $('#usin').show();
            $('#usin2').hide();
            $('#errorms').text("User Name Must Be Filled");
            $('#errorms').show();
            return;
        }
        if (ps == '') {
            $('#psin').show();
            $('#psin2').hide();
            $('#errorms').text("Password Must Be Filled");
            $('#errorms').show();
            return;
        }
        return false;
    }
    function change() {
        $('#psin').hide();
        $('#psin2').show();
        $('#usin').hide();
        $('#usin2').show();
        $('#errorms').hide();
    }
</script>
<div class="bck">
    <div class="back-hd col-sm-4">
        <img class="img-responsive " src="images/logo/logo-high.png">
    </div>
    <div class="back-bd col-sm-12 justify-content-center">
        <div class="col-sm-4" style="z-index:100;
    padding: 50px;">
            <img class="img-responsive " src="images/logo/logo-high.png">
        </div>
    </div>
    <div class="back-bd-as col-sm-5 ">
    </div>
</div>
<div class="row justify-content-center">
    <div class="card col-sm-5 ">
        <form method="post" name="logfrm" id="logfrm">
            <div class="card-head">
                <i class="fas fa-user-cog" style="
    font-size: 40px;
    margin-right: 12px;
    float:left;
    color: #00bcd4;"></i> ADMIN PANEL
            </div>
            <span id="errorms">
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </span>
            <div class="card-body">
                <label> USERNAME</label><br>
                <div class="grp">
                    <input onkeyup="change()" type="text" name="user" id="user">
                    <i class="fas fa-info-circle" id="usin" style="display:none;position: absolute;
    color: red;
    font-size: 24px;
    right: 10px;"></i>
                    <i class="fas fa-user-tie" id="usin2" style="position: absolute;
    color: #6d6d6d;
    font-size: 24px;
    right: 10px;"></i>
                </div>
                <br>
                <label> PASSWORD</label><br>
                <div class="grp">
                    <input name="pass" onkeyup="change()" type="password" id="pass">
                    <i class="fas fa-info-circle" id="psin" style="display:none;position: absolute;
    color: red;
    font-size: 24px;
    right: 10px;"></i>
                    <i class="fas fa-user-lock" id="psin2" style="position: absolute;
    color: #6d6d6d;
    font-size: 24px;
    right: 10px;"></i>
                </div><br>
            </div>
            <div class="card-footer">
                <button type="submit" onclick="check()" class="Login"><span class="arrow"><i style="margin-right:12px;
   " class="fas fa-arrow-left"></i></span> Log In</button>
            </div>
        </form>
    </div>
</div>