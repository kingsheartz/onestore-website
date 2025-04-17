<?php
require "head.php";
?>

<body>
    <div class="wrapper">
        <?php
        include "head1.php";
        ?>
        <script type="text/javascript">
            $('li').removeClass('active');
            $('#statusphp').addClass('active');
        </script>
        <style type="text/css">
            .card-body {
                padding: 40px;
                padding-bottom: 50px;
            }

            .col-sm-6 .btn {
                margin-top: 50px;
                background: dodgerblue;
                width: 100%;
                margin: 0;
                margin-top: 50px;
            }

            .input-class {
                width: 100%;
                position: relative;
            }

            .input-class i {
                position: absolute;
                top: 0;
                right: 0;
                font-size: 24px;
                padding: 2px 10px 2px 2px;
            }

            .form-group {
                margin-top: 30px;
            }

            .form-control1 {
                width: 33.3%;
                height: 34px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
                box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
                -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                text-align: center !important;
            }

            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                text-indent: 1px;
                text-overflow: '';
            }

            .hrdiv {
                display: inline-flex;
            }

            .hadiv {
                display: inline-flex;
            }

            @media screen and (max-width: 1200px) and (min-width: 768px) {
                .col-sm-6 {
                    width: 100%;
                }
            }

            @media screen and (max-width: 350px) {
                .form-control1 {
                    width: 25% !important;
                    font-size: 12px;
                }
            }

            @media screen and (max-width: 330px) {
                .form-control1 {
                    width: 20% !important;
                    font-size: 10px;
                    height: 20px;
                }

                .dot {
                    margin-top: -3px !important;
                }

                .fa-clock-o {
                    margin-top: -4px !important;
                }
            }

            input[type="number"]::placeholder {
                /* Firefox, Chrome, Opera */
                text-align: center;
            }
        </style>
        <?php
        $id = $_SESSION['id'];
        require "pdo.php";
        if (isset($_POST['status']) || isset($_POST['hours'])) {
            $st = $_POST['status'];
            $hr = $_POST['hours'];
            $query = "UPDATE store SET status='$st',opening_hours='$hr' WHERE store_id=$id";
            $statement = $pdo->prepare($query);
            $statement->execute();
        }
        ?>
        <script type="text/javascript">
            function showupda() {
                $('#chfrm').on("submit", function (e) {
                    var dataString = new FormData(this);
                    if (y == 1) {
                        dataString.append('update_data', '1');
                    }
                    else if (y == 0) {
                        dataString.append('remove_data', '1');
                    }
                    $.ajax({
                        type: "POST",
                        url: "status.php",
                        data: dataString,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function () {
                            location.reload();
                        }
                    });
                    e.preventDefault();
                });
                return false;
            }
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            function conca() {
                if ($('#in1').val() == "" || $('#in2').val() == "" || $('#in4').val() == "" || $('#in5').val() == "") {
                    swal({
                        title: "Oops!!!",
                        text: "Opening hours can\'t be empty !!!",
                        icon: "error",
                        closeOnClickOutside: false,
                        dangerMode: true,
                        timer: 6000,
                    });
                }
                else {
                    console.log('helo');
                    var in1 = $('#in1').val();
                    var in2 = $('#in2').val();
                    var in4 = $('#in4').val();
                    var in5 = $('#in5').val();
                    var v1 = in1 + ':' + in2 + '' + $('#in3').val() + ' to ' + in4 + ':' + in5 + '' + $('#in6').val();
                    $('#opening_hours').val(v1);
                    $('#hadiv').css('display', 'none')
                }
            }
            function validtime() {
                if ($('#hadiv').css('display') != 'none') {
                    var hr1 = $('#in1').val();
                    var hr2 = $('#in4').val();
                    var min1 = $('#in2').val();
                    var min2 = $('#in5').val();
                    hr1 = parseInt(hr1);
                    hr2 = parseInt(hr2);
                    min1 = parseInt(min1);
                    min2 = parseInt(min2);
                    if (!isNaN(hr1)) {
                        if ((hr1 > 12) && (hr1 <= 24)) {
                            if (hr1 == 24) {
                                $('#in1').val('12');
                                $('#in1').val('AM');
                            }
                            else {
                                hour1 = hr1 - 12;
                                $('#in1').val(hour1);
                            }
                            $('#in3').val('AM');
                        }
                        else if (hr1 > 24) {
                            $('#in1').val('12');
                            $('#in3').val('AM');
                        }
                        else if (hr1 >= 10 && hr1 <= 12) {
                            $('#in1').val(hr1);
                        }
                        else if (hr1 >= 0 && hr1 <= 9) {
                            $('#in1').val('0' + hr1);
                        }
                    }
                    else {
                        $('#in1').val('');
                    }
                    //-------------------------------------------------------------------------------
                    if (!isNaN(hr2)) {
                        if ((hr2 > 12) && (hr2 <= 24)) {
                            if (hr2 == 24) {
                                $('#in4').val('12');
                                $('#in6').val('AM');
                            }
                            else {
                                hour2 = hr2 - 12;
                                $('#in4').val(hour2);
                            }
                            $('#in6').val('AM');
                        }
                        else if (hr2 > 24) {
                            $('#in4').val('12');
                            $('#in6').val('AM');
                        }
                        else if (hr2 > 0 && hr2 <= 12) {
                            $('#in4').val(hr2);
                        }
                        else if (hr2 >= 0 && hr2 <= 9) {
                            $('#in4').val('0' + hr2);
                        }
                    }
                    else {
                        $('#in4').val('');
                    }
                    //--------------------------------------------------------------------------------
                    if (!isNaN(min1)) {
                        var houra = 0;
                        if ((min1 >= 0) && (min1 <= 60)) {
                            if ((min1 == 60) && (hr1 <= 11)) {
                                $('#in2').val('00');
                                if (hr1 < 8) {
                                    houra = hr1 + 1;
                                    $('#in1').val('0' + houra);
                                }
                                else {
                                    houra = hr1 + 1;
                                    $('#in1').val(houra);
                                }
                            }
                            else if ((min1 == 60) && (hr1 == 12)) {
                                $('#in2').val('00');
                                $('#in1').val('01');
                                if (('#in3').value == 'AM') {
                                    $('#in3').val('PM')
                                }
                                else {
                                    $('#in3').val('AM')
                                }
                            }
                            else if (min1 <= 60 && min1 >= 10) {
                                $('#in2').val(min1);
                            }
                            if (min1 >= 0 && min1 <= 9) {
                                $('#in2').val('0' + min1);
                            }
                        }
                        else {
                            $('#in2').val('59')
                        }
                    }
                    else {
                        $('#in2').val('');
                    }
                    //------------------------------------------------------------------------------------
                    if (!isNaN(min2)) {
                        var hourb = 0;
                        if ((min2 >= 0) && (min2 <= 60)) {
                            if ((min2 == 60) && (hr2 <= 11)) {
                                $('#in5').val('00');
                                if (hr2 < 8) {
                                    hourb = hr2 + 1;
                                    $('#in4').val('0' + hourb);
                                }
                                else {
                                    hourb = hr2 + 1;
                                    $('#in4').val(hourb);
                                }
                            }
                            else if ((min2 == 60) && (hr2 == 12)) {
                                $('#in5').val('00');
                                $('#in4').val('01');
                                if (('#in6').value == 'AM') {
                                    $('#in6').val('PM')
                                }
                                else {
                                    $('#in6').val('AM')
                                }
                            }
                            else if (min2 <= 60 && min2 >= 10) {
                                $('#in5').val(min2);
                            }
                            if (min2 >= 0 && min2 <= 9) {
                                $('#in5').val('0' + min2);
                            }
                        }
                        else {
                            $('#in5').val('59')
                        }
                    }
                    else {
                        $('#in5').val('');
                    }
                }
            }
        </script>
        <div class="col-sm-6" style="background: white;">
            <h4 style="margin-top: 30px;margin-bottom:50px;border-bottom:  1px solid#E3E3E3;padding:10px;"><i
                    class="fas fa-user-edit" style="font-size: 24px;padding-right: 12px" aria-hidden="true"></i>Update
                Status</h4>
            <div id="imgf">
                <?php
                $cat = $pdo->query("select * from store where store_id=$id");
                $row = $cat->fetch(PDO::FETCH_ASSOC);
                ?>
                <center><img class="img-responsive" id="previ" src=""></center>
            </div>
            <form method="post" id="chfrm">
                <div class="form-group">
                    <select class="form-control" required="" id="status" name="status">
                        <option value="<?= $row['status'] ?>"><?= $row['status'] ?></option>
                        <option value="open">Open</option>
                        <option value="closed"> Closed</option>
                    </select>
                </div>
                <div class="form-group" class="store-opening-hours" id="store-opening-hours">
                    <div class="input-class store-opening-hours"
                        style="background-color: #ededed;border:1px solid #999;border-color:#ccc;border-radius: 5px">
                        <input type="text" title="opening hour" name="hours" id="opening_hours"
                            style="background-color: #fff;border-color: #fff" class="form-control store-opening-hours"
                            placeholder="Opening hours" autocomplete="false" required="" readonly=""
                            onfocus="$('.hadiv').css('display','block');if(this.value==''){this.value='12:00AM to 11:59PM';$('#in1').val('12');;$('#in2').val('00');$('#in4').val('11');$('#in5').val('59')}">
                        <!--select boxes for hours-->
                        <div class="hadiv store-opening-hours" id="hadiv"
                            style="display: none;margin-top: 12px;padding-left: 5px;width: 100% "
                            focusout="this.hide();$('#opening_hours').show()">
                            <div class="hrdiv store-opening-hours" style="width: auto;">
                                <i class="fa fa-clock-o" class="form-control1"
                                    style="position: relative;margin-top: 2px;"></i>
                                <input type="number" onblur="validtime()" class="form-control1" id="in1"
                                    placeholder="HH" name="" min="1" max="12"
                                    style="padding: 0;margin: 0;text-align: center;">
                                <span class="dot" style="margin-top: 6px;font-weight: bolder;padding: 2px;">:</span>
                                <input type="number" onblur="validtime()" class="form-control1" id="in2"
                                    placeholder="MM" name="" min="00" max="59"
                                    style="padding: 0;margin: 0;text-align: center;">
                                <select id="in3" class="form-control1"
                                    style="padding: 0;margin: 0;text-align: center;background-color: #1e2629;border-color: #1e2629;box-shadow: none;border-bottom-color: orange;margin-left: 10px;outline: none;color:white;font-weight: bolder;max-width: 28px;">
                                    <option value="AM" selected="">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                            <div class="dot" style="width: 5%;text-align: center;">to</div>
                            <div class="hrdiv" style="width: auto;padding-bottom: 10px;">
                                <i class="fa fa-clock-o" class="form-control1"
                                    style="position: relative;margin-top: 2px;"></i>
                                <input type="number" onblur="validtime()" id="in4" class="form-control1"
                                    placeholder="HH" name="" min="1" max="12"
                                    style="padding: 0;margin: 0;text-align: center;">
                                <span class="dot" style="margin-top: 6px;font-weight: bolder;padding: 2px;">:</span>
                                <input type="number" onblur="validtime()" id="in5" class="form-control1"
                                    placeholder="MM" name="" min="00" max="59"
                                    style="padding: 0;margin: 0;text-align: center;">
                                <select id="in6" class="form-control1"
                                    style="padding: 0;margin: 0;text-align: center;background-color: #1e2629;border-color: #1e2629;box-shadow: none;border-bottom-color: orange;margin-left: 10px;outline: none;color:white;font-weight: bolder;max-width: 28px;">
                                    <option value="AM" style="">AM</option>
                                    <option value="PM" selected="">PM</option>
                                </select>
                            </div>
                            <button onclick="conca();" onmouseover="$(this).css('background-color','#4f994f')"
                                onmouseleave="$(this).css('background-color','#07C103')"
                                style="color: white;background-color:#07C103;outline: none;margin-top: 0px;padding: 0px;padding-left: 2px;padding-right:2px;max-width: 30px;position: absolute;border:2px solid white"
                                class="form-control1" type="button">
                                <span class="fa fa-check"></span>
                            </button>
                        </div>
                        <!--//select boxes for hours-->
                        <i class="fa fa-hourglass-start" style="color: #777;margin-top: 1px;"></i>
                    </div>
                </div>
                <script>
                    if ($('#status').val() == 'open') {
                        $('#previ').attr("src", "images/open.jpg");
                    }
                    if ($('#status').val() == 'closed') {
                        $('#previ').attr("src", "images/close.jpg");
                    }
                </script>
                <button style="width: 100%;
    margin-left: 0;
    padding: 5px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4caf50), color-stop(1, #07c103)) !important;
    border: none;
    border-radius: 5px;
    color: white;" onclick="showupda()">Change</button><br><br><br>
            </form>
            <?php
            require "foot.php";
            ?>
        </div>
    </div>
    </div>
</body>