//SWAL 2

  Swal.fire({
      title: "invalid number",
      text: "input is not a number !!!",
      icon: "error",
      showCancelButton:false,
      showConfirmButton:true,
      confirmButtonColor: 'red',
      allowOutsideClick: false,
      confirmButtonText:'<i class="fa fa-close"></i>',
      cancelButtonColor:'green',
      cancelButtonText:'<i class="fa fa-check"></i> Register'
      })

      .then((willSubmit) => {
          if(willSubmit.isConfirmed){
              return;
          }
      });

//SWAL 2

//NUMBERS ONLY

    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"

//NUMBERS ONLY

//Disable 2nd click

$('#myForm').on('submit', function () {
    $('#myButton').prop('disabled', true);
});

//Disable 2nd click

<form id="formABC" action="#" method="POST">
    <input type="submit" id="btnSubmit" value="Submit"></input>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<input type="button" value="i am normal abc" id="btnTest"></input>

<script>
    $(document).ready(function () {

        $("#formABC").submit(function (e) {

            //stop submitting the form to see the disabled button effect
            e.preventDefault();

            //disable the submit button
            $("#btnSubmit").attr("disabled", true);

            //disable a normal button
            $("#btnTest").attr("disabled", true);

            return true;

        });
    });
</script>
//Disable 2nd click

//////////////////ORDER IMAGE IN MAIN PAGE////////////////////////////////////////////////////////////////////////////////////////////////////////////

<h4 class="show_cat_list_main tb-padding sidebar-title" style="border-left: 5px solid <?=$bgcolor[$rancolor1]?>;border-top-left-radius: 10px;text-align: left;padding-bottom: 10px;padding-top: 10px;background-color: white;font-weight:normal;border-bottom:#333;margin-bottom: -5px;margin-top: 13px;border-top-right-radius: 10px;color: black;text-transform: capitalize;padding-left: 10px; overflow: hidden;font-size: 20px;"><?=$sub_cat_name1?> <i style="color: #ff5722;" class="fa fa-arrow-right"></i>
    <span style="float: right;margin-right: 5px;margin-top: -4px;">
        <button type="button" style="max-width: 150px;height: 30px;font-weight: bold;border-top-right-radius: 10px;background-color: <?=$bgcolor[$rancolor1]?>;padding: 11px auto;text-transform: uppercase;font-size: 12px;"  name="proceed" class="checkout-button button alt wc-forward"><a href="" style="color:<?=$c1?>;">View all</button>
    </span>
</h4>

//////////////////ORDER IMAGE////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////DIRECTORY IMAGE PROCESSING///////////////////////////////////////////////////

$directorygk = "images/Gaming Keyboard/";

// Initialize filecount variavle
$filecount = 0;
$i=0;
$files2 = glob( $directorygk ."*" );

if( $files2 ) {
    $filecount = count($files2);
}
//finding count in particular fields
while($i < $filecount){
    $gk[$i]=$i+1;


/////DIRECTORY IMAGE PROCESSING///////////////////////////////////////////////////

//////////////////////find and list any subcategory////////////////////////

$cntsql="select count(sub_category_id) as sub_cnt from sub_category";
$cntstmt=$pdo->query($cntsql);
$cntrow=$cntstmt->fetch(PDO::FETCH_ASSOC);
$sub_cnt=$cntrow['sub_cnt'];

do{
$rand_sub_id1=randomGenerate('1',$sub_cnt,(int)$sub_cnt);
$rand_sub_id1_rand1=array_rand($rand_sub_id1,1);
$rand_sub_id1=$rand_sub_id1[$rand_sub_id1_rand1];

$rand_sub_id2=randomGenerate('1',$sub_cnt,(int)$sub_cnt);
$rand_sub_id2_rand2=array_rand($rand_sub_id2,1);
$rand_sub_id2=$rand_sub_id2[$rand_sub_id2_rand2];
}
while ($rand_sub_id1==$rand_sub_id2);

$catsql1="select* from sub_category where sub_category_id=".(int)$rand_sub_id1;
$catstmt1=$pdo->query($catsql1);
$sub_catrow1=$catstmt1->fetch(PDO::FETCH_ASSOC);

$catsql2="select* from sub_category where sub_category_id=".(int)$rand_sub_id2;
$catstmt2=$pdo->query($catsql2);
$sub_catrow2=$catstmt2->fetch(PDO::FETCH_ASSOC);

$cat_id1=$sub_catrow1['category_id'];
$sub_cat_id1=$sub_catrow1['sub_category_id'];
$sub_cat_name1=$sub_catrow1['sub_category_name'];
$cat_id2=$sub_catrow2['category_id'];
$sub_cat_id2=$sub_catrow2['sub_category_id'];
$sub_cat_name2=$sub_catrow2['sub_category_name'];

//////////////////////find and list any subcategory////////////////////////

style="max-height: 180px;width: auto;max-width: 180px;image-rendering: auto;margin-left: auto;margin-right: auto;"

//color ouline selected///
#66afe9---------#fe9126----------#02171e-------------#337ab7
//color ouline selected///

.cat-img a img{
  height: 20px !important;
  width: 25px !important;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

<?php

require_once('tcpdf_include.php');

/* create new PDF document */
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

/* set document information */
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


/* set header and footer fonts */
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

/* set default monospaced font */
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

/* set margins */
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

/* set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);*/

/* set image scale factor
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); */

/* set some language-dependent strings (optional) */
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
  require_once(dirname(__FILE__).'/lang/eng.php');
  $pdf->setLanguageArray($l);
}

/* --------------------------------------------------------- */

/* set default font subsetting mode */
$pdf->setFontSubsetting(true);

/* Set font
 dejavusans is a UTF-8 Unicode font, if you only need to
 print standard ASCII chars, you can use core fonts like
 helvetica or times to reduce file size. */
$pdf->SetFont('dejavusans', '', 14, '', true);

/* Add a page */
/* This method has several options, check the source code documentation for more information. */
$pdf->AddPage();

/* set text shadow effect */
$pdf->setTextShadow(
  array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196),
  'opacity'=>1, 'blend_mode'=>'Normal')
);

/* Set some content to print */
$html =
'<h1 align="center">Hello World</h1>';

/* Print text using writeHTMLCell() */
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

/* --------------------------------------------------------- */

/* Close and output PDF document
 This method has several options, check the source code documentation for more information. */
$pdf->Output('example_001.pdf', 'I');

/*============================================================+
  END OF FILE
  ============================================================+*/


////////DATE & TIME/////////////////////////////

  if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
  }
//DATE & TIME

                $date=date("Y\-m\-d");
                $time =  date("H:i:s");
//////DATE&TIME////////////////////////////////

<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------SINGLE ITEM------------------------------------------------------------------>
<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->

<div id="myModal-single" class="modal-single">
  <span class="close-single cursor-single" onclick="closeModal_single()">&times;</span>
  <div class="modal-content-single" style="background-color: #000">

    <div class="mySlides-single">
      <div class="numbertext-single"><?=$img_cnt_flag?> / <?=$img_cnt_row['img_count']+1?></div>
      <img src="images/<?=$row2['category_id']?>/<?=$row2['sub_category_id']?>/<?=$row2['item_description_id']?>.jpg" style="max-height: 300px">
    </div>

<?php
$img_cnt_sql="select img_count from item_description where item_description_id=$item_description_id";
$img_cnt_stmt=$pdo->prepare($sql);
$img_cnt_stmt->execute();
$img_cnt_row=$img_cnt_stmt->fetch(PDO::FETCH_ASSOC);
$img_cnt_flag=1;
if(!empty($img_cnt_row['img_count'])){
while($img_cnt_flag<=$img_cnt_row['img_count']){
?>

    <div class="mySlides-single">
      <div class="numbertext-single"><?=$img_cnt_flag?> / <?=$img_cnt_row['img_count']+1?></div>
      <img src="images/<?=$row2['category_id']?>/<?=$row2['sub_category_id']?>/<?=$row2['item_description_id']?>_<?=$img_cnt_flag?>.jpg" style="max-height: 300px">
    </div>

<?php
$img_cnt_flag++;
}
}
?>

    <a class="prev-single" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next-single" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container-single">
      <p id="caption-single"></p>
    </div>

    <div class="column-single">
      <img class="demo-single cursor-single" src="images/<?=$row2['category_id']?>/<?=$row2['sub_category_id']?>/<?=$row2['item_description_id']?>.jpg" style="height: 160px" onclick="currentSlide(1)" alt="Nature and sunrise">
    </div>

<?php
$img_cnt_sql="select img_count from item_description where item_description_id=$item_description_id";
$img_cnt_stmt=$pdo->prepare($sql);
$img_cnt_stmt->execute();
$img_cnt_row=$img_cnt_stmt->fetch(PDO::FETCH_ASSOC);
$img_cnt_flag=1;
if(!empty($img_cnt_row['img_count'])){
while($img_cnt_flag<=$img_cnt_row['img_count']){
?>

    <div class="column-single">
      <img class="demo-single cursor-single" src="images/<?=$row2['category_id']?>/<?=$row2['sub_category_id']?>/<?=$row2['item_description_id']?>_<?=$img_cnt_flag?>.jpg" style="height: 160px" onclick="currentSlide(2)" alt="Snow">
    </div>

<?php
$img_cnt_flag++;
}
}
?>

  </div>
</div>

//

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
LOADER

<style>
.std_loader {
  border: 6px solid #f3f3f3;
  border-radius: 50%;
  border-top: 6px solid #3498db;
  width: 20px;
  height: 20px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>

<div class="std_loader"></div>

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
SNACK BAR ?? ERRROR SHOW

<style>
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>
</head>
<body>

<h2>Snackbar / Toast</h2>
<p>Snackbars are often used as a tooltips/popups to show a message at the bottom of the screen.</p>
<p>Click on the button to show the snackbar. It will disappear after 3 seconds.</p>

<button onclick="show_snackbar()">Show Snackbar</button>

<div id="snackbar">Some text some message..</div>

<script>
function show_snackbar() {
  $(".snackbar").addClass('show');
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>

////////////////////////////////////////////////////////////////////////////////////////////////////

//BUTTON

.button {
  border-radius: 4px;
  background-color: #f4511e;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}
.button:hover span:after {
  opacity: 1;
  right: 0;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

<style>
::placeholder {
  color: red;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: red;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: red;
}
</style>


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*CAPSLOCK PASSWORD*/
<p class="capson_warning" style="display: none;float:left;color: #d9534f"><i class="fa fa-warning"></i> &nbsp;WARNING! Caps lock is ON.</p>

  password_fields  ---CLASSNAME

  var capson_warning = document.getElementsByClassName("capson_warning");
  var  password_field=document.getElementsByClassName('password_fields');

  for (var i = 0; i < password_field.length; i++) {
      password_field[i].addEventListener("keyup", function(event) {
      for (var j = 0; j < capson_warning.length; j++) {
          if (event.getModifierState("CapsLock")) {
              capson_warning[j].style.display = "block";
          }
          else {
              capson_warning[j].style.display = "none"
          }
      }

  });
  }

//PASSWORD PATTERN
pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required=" "

///UNCHECK ALL CHECKBOX

$(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('uncheck all');
    },function(){
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all');
    })
})
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #337ab7), color-stop(1, #01728e)) !important;

background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;

background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #007ab7), color-stop(1, #01728e)) !important;

$('#background_loader').show();
$('#std_loader').show();

$('#background_loader').hide();
$('#std_loader').hide();

$starsql="select avg(item_keys.rating) AS avgrate FROM item_keys
JOIN item_description on item_keys.item_description_id=item_description.item_description_id
JOIN product_details on product_details.item_description_id = item_description.item_description_id
JOIN store ON store.store_id=product_details.store_id
WHERE store.store_id=product_details.store_id
AND product_details.item_description_id=item_description.item_description_id
and item_description.item_description_id=".$row['item_description_id']."
GROUP BY item_keys.store_id HAVING item_keys.store_id IN (".$row['store_id'].")";
$startstmt=$pdo->query($starsql);
$starrow=$startstmt->fetch(PDO::FETCH_ASSOC);
$stars=round($starrow['avgrate']);

if($stars=="" || $stars==0 || is_null($stars)){
  $dynamic_content.="<span style='color:#ff2222'>no rating</span>";
}
else{
  for($i=0;$i<5;$i++){
    if($i<$stars){
      $dynamic_content.="<span class='fas fa-star active'></span>";
    }
    else{
      $dynamic_content.="<span class='fas fa-star'></span>";
    }
  }
}

$dynamic_content.="</div>";

var filter=[];
function addorremove(checkbox){
  if(checkbox.checked) {
  var val=checkbox.value;

  filter.push({type:val});
  console.log('Before removing object from an array -> ' + JSON.stringify(filter));
  // Convert the cart object into JSON string and save it into storage
  localStorage.setItem("cartObject", JSON.stringify(filter));

  // Retrieve the JSON string
  var jsonString = localStorage.getItem("cartObject");

  var cartobj=JSON.parse(jsonString);
  console.log(cartobj);

  } else {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //REMOVING THE TAGS WITH VALUE OF THE KEY
    console.log('Before removing object from an array -> ' + JSON.stringify(filter));
    var removeIndex = filter.map(function(item) { return item.type; }).indexOf(val)
    console.log(removeIndex)
    filter.splice(removeIndex, 1);
    console.log('After removing object from an array -> ' + JSON.stringify(filter));
  //REMOVING THE TAGS WITH VALUE OF THE KEY
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  }
}

  $.ajax({
        url: "functions.php", //passing page info
        data: {"filter_sub_cat_a":1,"key":filter,"min-price":minprice,"max-price":maxprice,"sort":sort,"category":<?=$_GET['category_id']?>,"sub_category":<?=$_GET['subcategory_id']?>},  //form data
        type: "post",   //post data
        dataType: "json",   //datatype=json format
        timeout:30000,   //waiting time 30 sec
        success: function(data){    //if registration is success
          if(data.status=='success'){
            $("#table-data").html(data.content).show();
            $("#dynamic-paging").html(data.output).show();
            $('.background_loader').hide();
            $('.std_loader').hide();
              return;
          }
      },
        error: function(xmlhttprequest, textstatus, message) { //if it exceeds timeout period
            if(textstatus==="timeout") {
              swal({
                  title: "Oops!!!",
                  text: "server time out",
                  icon: "error",
                  closeOnClickOutside: false,
                  dangerMode: true,
                  timer: 6000,
              });

              return ;
            }

            else{return;}
        }
  }); //closing ajax

if($sort=='default'){
  $sort="CAST(item.sub_category_id AS UNSIGNED) ASC";
}
else if($sort=='high'){
  $sort="CAST(product_details.price AS UNSIGNED) DESC";
}
else if($sort=='low'){
  $sort="CAST(product_details.price AS UNSIGNED) ASC";
}
else if($sort=='view'){
  $sort="CAST(item_keys.views AS UNSIGNED) DESC";
}
