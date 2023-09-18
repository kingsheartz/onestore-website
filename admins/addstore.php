<?php
 require "head.php";
 ?>  
<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';



if (!empty($_SESSION['_contact_form_error'])) {
    $error = $_SESSION['_contact_form_error'];
    unset($_SESSION['_contact_form_error']);
}

if (!empty($_SESSION['_contact_form_success'])) {
    $success = true;
    unset($_SESSION['_contact_form_success']);
}

?>

     
<body>
     <div class="wrapper">
  <?php
 include "head1.php";
 ?> 

  <script type="text/javascript">

   $('li').removeClass('active');
   $('#addstorephp').addClass('active');
     function conca(){

        if($('#in1').val()=="" || $('#in2').val()=="" || $('#in4').val()=="" || $('#in5').val()==""){
            swal({
            title: "Oops!!!",
            text: "Opening hours can\'t be empty !!!",
            icon: "error",
            closeOnClickOutside: false,
            dangerMode: true,
            timer: 6000,
            });
        }    
        else{

            console.log('helo');
            var in1=$('#in1').val();
            var in2=$('#in2').val();
            var in4=$('#in4').val();
            var in5=$('#in5').val();
            var v1=in1+':'+in2+''+$('#in3').val()+' to '+in4+':'+in5+''+$('#in6').val();
            $('#opening_hours').val(v1);
            $('#hadiv').css('display','none')
        }
    }

function validtime(){
    if($('#hadiv').css('display')!='none'){
        var hr1=$('#in1').val();
        var hr2=$('#in4').val();
        var min1=$('#in2').val();
        var min2=$('#in5').val();
        hr1=parseInt(hr1);
        hr2=parseInt(hr2);
        min1=parseInt(min1);
        min2=parseInt(min2);

        if(!isNaN(hr1)){

            if((hr1>12) && (hr1<=24)){
                if(hr1==24){
                    $('#in1').val('12');
                    $('#in1').val('AM');
                }
                else{
                    hour1=hr1-12;
                    $('#in1').val(hour1);
                }
                $('#in3').val('AM');
            }
            else if(hr1>24){
                $('#in1').val('12');
                $('#in3').val('AM');
            }
            else if(hr1>=10 && hr1<=12){
                $('#in1').val(hr1);
            }
            else if(hr1>=0 && hr1<=9){
                $('#in1').val('0'+hr1);
            }
        }
        else{
            $('#in1').val('');
        }
//-------------------------------------------------------------------------------
        if(!isNaN(hr2)){

            if((hr2>12) && (hr2<=24)){
                if(hr2==24){
                    $('#in4').val('12');
                    $('#in6').val('AM');
                }
                else{
                    hour2=hr2-12;
                    $('#in4').val(hour2);
                }
                $('#in6').val('AM');
            }
            else if(hr2>24){
                $('#in4').val('12');
                $('#in6').val('AM');
            }
            else if(hr2>0 && hr2<=12){
                $('#in4').val(hr2);
            }
            else if(hr2>=0 && hr2<=9){
                $('#in4').val('0'+hr2);
            }
        }
        else{
            $('#in4').val('');
        }
//--------------------------------------------------------------------------------

        if(!isNaN(min1)){
            var houra=0;
            if((min1>=0) && (min1<=60)){

                if((min1==60)&&(hr1<=11)){

                    $('#in2').val('00');
                    if(hr1<8){
                       houra=hr1+1;
                        $('#in1').val('0'+houra);
                    }
                    else{ 
                        houra=hr1+1;
                        $('#in1').val(houra);
                    }
                   
                }

                else if((min1==60)&&(hr1==12)){
                    $('#in2').val('00');
                    $('#in1').val('01');

                    if(('#in3').value=='AM'){
                        $('#in3').val('PM')
                    }
                    else{
                        $('#in3').val('AM')
                    }
                }
                else if(min1<=60 && min1>=10){
                    $('#in2').val(min1);
                }
                if(min1>=0 && min1<=9){
                    $('#in2').val('0'+min1);
                }
            }
            else{
                $('#in2').val('59')
            }
        }
        else{
            $('#in2').val('');
        }
//------------------------------------------------------------------------------------
        if(!isNaN(min2)){
            var hourb=0;
            if((min2>=0) && (min2<=60)){

                if((min2==60)&&(hr2<=11)){

                    $('#in5').val('00');
                    if(hr2<8){
                       hourb=hr2+1;
                        $('#in4').val('0'+hourb);
                    }
                    else{ 
                        hourb=hr2+1;
                        $('#in4').val(hourb);
                    }
                   
                }

                else if((min2==60)&&(hr2==12)){
                    $('#in5').val('00');
                    $('#in4').val('01');

                    if(('#in6').value=='AM'){
                        $('#in6').val('PM')
                    }
                    else{
                        $('#in6').val('AM')
                    }
                }
                else if(min2<=60 && min2>=10){
                    $('#in5').val(min2);
                }
                if(min2>=0 && min2<=9){
                    $('#in5').val('0'+min2);
                }
            }
            else{
                $('#in5').val('59')
            }
        }
        else{
            $('#in5').val('');
        }
    }
}

 </script>


<style type="text/css">
    .card ,.mt-5 {
        /*border-top: 4px solid #0C8EB4;*/
        background: #fff;
    padding-top: 20px;
    }
    body{
    font-family: 'Lucida Sans','Helvetica Neue',Helvetica,Arial,sans-serif;
    }
    h4{
        width: 100%;
        padding: 0;
        padding-top: 10px;
                padding-bottom: 10px;
border-bottom: 1px solid #E1E1E1;
    }
    .card-body{
            padding: 40px;
    padding-bottom: 50px;
   
    }

    .col-sm-6 .btn{
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
    .input-class i{
        position: absolute;
    top: 0;
    right: 0;
    font-size: 24px;
    padding: 2px 10px 2px 2px;
    }
    .form-group{
        margin-top: 30px;
    }
    .form-control1{
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
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    text-align: center !important;

    }
    select {
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
}
.hrdiv{
    display: inline-flex;

}
.hadiv{
    display: inline-flex;

    
}
 @media screen and (max-width: 1200px) and (min-width: 768px) {
    .col-sm-6{
        width: 100%;
    }
}
@media screen and (max-width: 350px){
    .form-control1{
        width: 25% !important;
        font-size: 12px;
        
    }

}
@media screen and (max-width: 330px){
    .form-control1{
        width: 20% !important;
        font-size: 10px;
        height: 20px;
    }
    .dot{

        margin-top: -3px !important; 
    }
    .fa-clock-o{
        margin-top: -4px !important; 
    }
}
 input[type="number"]::placeholder { 
                  
    /* Firefox, Chrome, Opera */
    text-align: center;
}
.field_entry{
    border:none;box-shadow: none;
    border-bottom: 2px solid #66afe9;
    border-radius: 0px;
    padding-right: 0px;
}
 .input-class i{
    padding-right: 0;
    padding-top: 0;
} 
</style>

    <div class="row">
        <div class="col-sm-6 " >
            <div class="card mt-5" style="border-radius: 10px; border-top : 5px solid #fe9126;border-bottom: 2px solid #fe9126;">
                <center>
                    
                    <h3 style="margin-top: 0px;background-color: #fff;color:#333;padding-top: 10px;padding-bottom: 10px;margin-top: -20px;border-radius: 10px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;margin-bottom: 50px;border-bottom: 2px solid #66afe9;">
                        REGISTER STORE &nbsp;<i class="fas fa-store-alt" style="font-size: 24px;color: #fe9126"aria-hidden="true"></i><i class="fas fa-plus" style="font-size: 16px;color: #fff"aria-hidden="true"></i></h3></center>
                    <div class="card-body" style="padding-top: 0px;">
                        <?php
                        if (!empty($success)) {
                            ?>
                            <div class="alert alert-success">Your message was sent successfully!</div>
                            <?php
                        }
                        ?>

                        <?php
                        if (!empty($error)) {
                            ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                            <?php
                        }
                        ?>
<form method="post" action="submit.php" style="margin-top: 30px;">
    <h5><i class="fa fa-info-circle fa-lg"></i>&nbsp;Store informations</h5>
    <div class="form-group">
        <div class="input-class">
            <input type="text" title="store name" name="store_name" id="store_name" class="form-control field_entry" placeholder="Store Name" required="">
            <i class="fas fa-store " style="color: #777;margin-top: 1px;"></i>
        </div>
    </div>

    <div class="form-group" class="store-opening-hours" id="store-opening-hours">
        <div class="input-class store-opening-hours" style="background-color: #ededed;border-radius: 5px">
            <input type="text" title="opening hour" name="opening_hours" id="opening_hours" style="background-color: #fff;" class="form-control store-opening-hours field_entry" placeholder="Opening hours" autocomplete="false" required="" readonly=""  onfocus="$('.hadiv').css('display','block');if(this.value==''){this.value='12:00AM to 11:59PM';$('#in1').val('12');$('#in2').val('00');$('#in4').val('11');$('#in5').val('59')}">
<!--select boxes for hours-->
            <div class="hadiv store-opening-hours" id="hadiv" style="display: none;margin-top: 12px;padding-left: 5px;width: 100% " focusout="this.hide();$('#opening_hours').show()">
                <div class="hrdiv store-opening-hours" style="width: auto;">
                    <i class="fa fa-clock-o" class="form-control1" style="position: relative;margin-top: 2px;"></i>&nbsp;    
                    <input type="number" onblur="validtime()" class="form-control1" id="in1" placeholder="HH" name="" min="1" max="12" maxlength="2" style="padding: 0;margin: 0;text-align: center;">
                    <span class="dot" style="margin-top: 6px;font-weight: bolder;padding: 2px;">:</span>

                    <input type="number" onblur="validtime()" class="form-control1" id="in2" placeholder="MM"  name="" min="00" max="59" maxlength="2" style="padding: 0;margin: 0;text-align: center;">

                    <select  id="in3" class="form-control1" style="padding: 0;margin: 0;text-align: center;background-color: #1e2629;border-color: #1e2629;box-shadow: none;border-bottom-color: orange;margin-left: 10px;outline: none;color:white;font-weight: bolder;max-width: 28px;">
                        <option value="AM" selected="">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
                <div class="dot" style="width: 5%;text-align: center;">to</div>
                    <div class="hrdiv" style="width: auto;padding-bottom: 10px;">
                        <i class="fa fa-clock-o" class="form-control1" style="position: relative;margin-top: 2px;"></i>&nbsp;
                        <input type="number" onblur="validtime()" id="in4"class="form-control1" placeholder="HH" name="" min="1" max="12" maxlength="2"style="padding: 0;margin: 0;text-align: center;">
                        <span class="dot" style="margin-top: 6px;font-weight: bolder;padding: 2px;">:</span>

                        <input type="number" onblur="validtime()" id="in5"class="form-control1" placeholder="MM" name="" min="00" max="59" maxlength="2" style="padding: 0;margin: 0;text-align: center;">

                        <select id="in6"class="form-control1" style="padding: 0;margin: 0;text-align: center;background-color: #1e2629;border-color: #1e2629;box-shadow: none;border-bottom-color: orange;margin-left: 10px;outline: none;color:white;font-weight: bolder;max-width: 28px;">
                            <option value="AM" style="">AM</option>
                            <option value="PM" selected="">PM</option>
                        </select>
                    </div>&nbsp;
                <button onclick="conca();" onmouseover="$(this).css('background-color','#4f994f')" onmouseleave="$(this).css('background-color','#07C103')" style="color: white;background-color:#07C103;outline: none;margin-top: 0px;padding: 0px;padding-left: 2px;padding-right:2px;max-width: 30px;position: absolute;border:2px solid white;height: 35px;" class="form-control1" type="button">
                <span class="fa fa-check"></span>
                </button>
            </div>

<!--//select boxes for hours-->


            <i class="fa fa-hourglass-start" style="color: #777;margin-top: 1px;"></i>
            </div>
                </div>

                <div class="form-group">
                    <div class="input-class">
                        <textarea name="address" title="address" rows="8" id="address" class="form-control" placeholder="Address" style="border-color:#66afe9" required=""></textarea>
                        <i class="fa fa-address-card " style="color: #777"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-class">
                        <select name="status" title="status" id="status" class="form-control field_entry" placeholder="Status" required="">
                            <option value="open">open</option>
                            <option value="closed">closed</option>
                        </select>
                    <i class="fa fa-unlock" style="color: #777;margin-top: 3px;"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-class">
                        <input type="text" title="longitude" name="longitude" id="longitude" class="form-control field_entry" placeholder="longitude" required="">
                        <i class="fa fa-map-marker" style="color: #777"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-class">
                        <input type="text" title="latitude" name="latitude" id="latitude" class="form-control field_entry" placeholder="latitude" required="">
                        <i class="fa fa-map-marker" style="color: #777"></i>
                    </div>
                </div>
                <h5 style="margin-top: 40px;"><i class="fa fa-info-circle fa-lg"></i>&nbsp;Log in information</h5>
                <div class="form-group">
                    <div class="input-class">
                        <input type="text" title="Owner name" name="name" id="name" class="form-control field_entry" placeholder="Username" required="">
                        <i class="fa fa-user" style="color: #777"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-class">
                        <input type="email" title="email" name="email" id="email" class="form-control field_entry" placeholder="Email" required="">
                        <i class="fa fa-envelope" style="color: #777;margin-top: 2px;"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-class">
                        <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" pattern="^(\d{0}|\d{10})$" title="Phone Number Format (9876543210)- 10 digits" name="phone" id="phone" class="form-control field_entry" placeholder="Phone Number" required="">
                        <i class="fa fa-volume-control-phone" style="color: #777"></i>
                    </div>
                </div>

                <center><button title="Add store" class="btn btn-primary btn-block" style="background-color: #0c99cc;width: 75%;">Add Store</button></center>
</form>
                </div>
            </div>
        </div>
    </div>

  <?php
 require "foot.php";
 ?>        