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
 <style>
   .ftcl{
   
    border-color: #2e6da4;
    width: 100%;
    margin-right: 20px;
    outline: none;
    border-radius: 5px;
   }
   .modal-header1{
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #337ab7), color-stop(1, #003c6f)) !important;
    color: white;
    padding: 15px;
   }
   .modal-title1 {
    margin: 0;
    line-height: 1.42857143;
}
.modal-body1 {
    position: relative;
    padding: 15px;
}
.modal-content1 {
    position: relative;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #999;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    -webkit-box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
    box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
    outline: 0;
}
@media (min-width: 768px){
.modal-dialog1 {
    width: 600px;
    margin: 30px auto;
}
}
.modal-dialog1 {
    position: relative;
    width: auto;
    margin: 10px;
}
select#brct {
    border-color: #2e6da4;
    width: 100%;
    margin-right: 20px;
    outline: none;
    border-radius: 5px;
    border-width: 2px;
}
 </style>
 
 <script>
   function appjo(x){
     if(x=='size'){
    var selected_option_value=$("#size").val();
    
 y='addfeat.php?size=1';
 z='size='+selected_option_value;
     }
     else if(x=='color'){
      var selected_option_value=$("#color").val();
    
    y='addfeat.php?color=1';
    z='color='+selected_option_value;
     }

     else if(x=='flavour'){
      var selected_option_value=$("#flavour").val();
    
    y='addfeat.php?flavour=1';
    z='flavour='+selected_option_value;
     }
     else if(x=='processor'){
      var selected_option_value=$("#processor").val();
    
    y='addfeat.php?processor=1';
    z='processor='+selected_option_value;
     }
     else if(x=='disp'){
      var selected_option_value=$("#disp").val();
    
    y='addfeat.php?display=1';
    z='display='+selected_option_value;
     }
     else if(x=='battery'){
      var selected_option_value=$("#battery").val();
    
    y='addfeat.php?battery=1';
    z='battery='+selected_option_value;
     }
     else if(x=='internal_storage'){
      var selected_option_value=$("#internal_storage").val();
    
    y='addfeat.php?internal_storage=1';
    z='internal_storage='+selected_option_value;
     }
     else if(x=='brand'){
      var selected_option_value=$("#brand").val();
    t=$("#brct").val();
    y='addfeat.php?	brand=1';
    z={	brand:selected_option_value,category:t};
     }
     else if(x=='material'){
      var selected_option_value=$("#material").val();
    
    y='addfeat.php?material=1';
    z='material='+selected_option_value;
     }
  console.log(selected_option_value);
    $.ajax({
        type:'POST',
        url:'featsub.php',
        data:z,
        
        success:function(html){
           $('#event').empty();
           $('#event').append('<div style=" width:100%" class="alert alert-success">New row added\
           </div>');
        }
    }); 

   }
 </script>
<?php
if(isset($_GET['size'])){
?>
<form id="size1">
<div class="new" id="myModal"tabindex="-1" role="dialog">
  <div class="modal-dialog1" role="document">
    <div class="modal-content1">
      <div class="modal-header1">
        <h5 class="modal-title1">Add Size</h5>
      </div>
      <div class="modal-body1" id="event" style="display: flex;">
        <input type="text" id="size" class="ftcl" name="size">
        <button type="button" onclick="appjo('size')"class="btn btn-primary">Save changes</button>
      </div>
      
    </div>
  </div>
</div>
</form>
<?php
}
//color
if(isset($_GET['color'])){
  ?>
  <form id="color1">
  <div class="new" id="myModal"tabindex="-1" role="dialog">
    <div class="modal-dialog1" role="document">
      <div class="modal-content1">
        <div class="modal-header1">
          <h5 class="modal-title1">Add color</h5>
        </div>
        <div class="modal-body1" id="event" style="display: flex;">
          <input type="text" id="color" class="ftcl" name="color">
          <button type="button" onclick="appjo('color')"class="btn btn-primary">Save changes</button>
        </div>
        
      </div>
    </div>
  </div>
  </form>
  <?php
  }
  //flavour
  if(isset($_GET['flavour'])){
    ?>
    <form id="flavour1">
    <div class="new" id="myModal"tabindex="-1" role="dialog">
      <div class="modal-dialog1" role="document">
        <div class="modal-content1">
          <div class="modal-header1">
            <h5 class="modal-title1">Add flavour</h5>
          </div>
          <div class="modal-body1" id="event" style="display: flex;">
            <input type="text" id="flavour" class="ftcl" name="flavour">
            <button type="button" onclick="appjo('flavour')"class="btn btn-primary">Save changes</button>
          </div>
          
        </div>
      </div>
    </div>
    </form>
    <?php
    }
     //processor
  if(isset($_GET['processor'])){
    ?>
    <form id="processor1">
    <div class="new" id="myModal"tabindex="-1" role="dialog">
      <div class="modal-dialog1" role="document">
        <div class="modal-content1">
          <div class="modal-header1">
            <h5 class="modal-title1">Add processor</h5>
          </div>
          <div class="modal-body1" id="event" style="display: flex;">
            <input type="text" id="processor" class="ftcl" name="processor">
            <button type="button" onclick="appjo('processor')"class="btn btn-primary">Save changes</button>
          </div>
          
        </div>
      </div>
    </div>
    </form>
    <?php
    }
         //display
  if(isset($_GET['display'])){
    ?>
    <form id="display22">
    <div class="new" id="myModal"tabindex="-1" role="dialog">
      <div class="modal-dialog1" role="document">
        <div class="modal-content1">
          <div class="modal-header1">
            <h5 class="modal-title1">Add display</h5>
          </div>
          <div class="modal-body1" id="event" style="display: flex;">
            <input type="text" id="disp" class="ftcl" name="disp">
            <button type="button" onclick="appjo('disp')"class="btn btn-primary">Save changes</button>
          </div>
          
        </div>
      </div>
    </div>
    </form>
    <?php
    }
             //battery
  if(isset($_GET['battery'])){
    ?>
    <form id="battery1">
    <div class="new" id="myModal"tabindex="-1" role="dialog">
      <div class="modal-dialog1" role="document">
        <div class="modal-content1">
          <div class="modal-header1">
            <h5 class="modal-title1">Add battery</h5>
          </div>
          <div class="modal-body1" id="event" style="display: flex;">
            <input type="text" id="battery" class="ftcl" name="battery">
            <button type="button" onclick="appjo('battery')"class="btn btn-primary">Save changes</button>
          </div>
          
        </div>
      </div>
    </div>
    </form>
    <?php
    }
                 //internal_storage
  if(isset($_GET['internal_storage'])){
    ?>
    <form id="internal_storage1">
    <div class="new" id="myModal"tabindex="-1" role="dialog">
      <div class="modal-dialog1" role="document">
        <div class="modal-content1">
          <div class="modal-header1">
            <h5 class="modal-title1">Add internal_storage</h5>
          </div>
          <div class="modal-body1" id="event" style="display: flex;">
            <input type="text" id="internal_storage" class="ftcl" name="internal_storage">
            <button type="button" onclick="appjo('internal_storage')"class="btn btn-primary">Save changes</button>
          </div>
          
        </div>
      </div>
    </div>
    </form>
    <?php
    }
               //brand
  if(isset($_GET['brand'])){
    ?>
    <form id="brand1">
    <div class="new" id="myModal"tabindex="-1" role="dialog">
      <div class="modal-dialog1" role="document">
        <div class="modal-content1">
          <div class="modal-header1">
            <h5 class="modal-title1">Add brand</h5>
          </div>
          <div class="modal-body1" id="event" style="display: flex;">
            <input type="text" placeholder="brand" id="brand" class="ftcl" name="brand">
            <select id='brct'>
              <?php
$cat=$pdo->query("select * from category");           



while($row=$cat->fetch(PDO::FETCH_ASSOC)){
              ?>
              <option value="<?=$row['category_id']?>"><?=$row['category_name']?></option>
              <?php
  }
              ?>
            </select>
            <button type="button" onclick="appjo('brand')"class="btn btn-primary">Save changes</button>
          </div>
          
        </div>
      </div>
    </div>
    </form>
    <?php
    }
                  //material
  if(isset($_GET['material'])){
    ?>
    <form id="material1">
    <div class="new" id="myModal"tabindex="-1" role="dialog">
      <div class="modal-dialog1" role="document">
        <div class="modal-content1">
          <div class="modal-header1">
            <h5 class="modal-title1">Add material</h5>
          </div>
          <div class="modal-body1" id="event" style="display: flex;">
            <input type="text" id="material" class="ftcl" name="material">
            <button type="button" onclick="appjo('material')"class="btn btn-primary">Save changes</button>
          </div>
          
        </div>
      </div>
    </div>
    </form>
    <?php
    }
?>
<?php
require "foot.php";
?>