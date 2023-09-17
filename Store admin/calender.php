<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style type="text/css">

/* This is our current day marker */
 
#current_day { background-color: rgba(255,255,255,0.3);
    border-radius: 5px;
    font-weight: bold;
     } 
div#show_calendar {
    width: 100%;
    height: 370px;
    
}
table.calendar {
    width: 100%;
}
caption {
    text-align: center;
    height: 40px;
    padding: 10px;
    color: white;
    font-size: 16px;
    font-weight: bolder;
    padding-top: 20px;
}
.cont{
    position: relative;
    color: white;
}
button#prev {
    position: absolute;
    top: 10px;
    left: 10px;
    background: transparent;
    border: none;
    color: white;
    font-size: 24px;
}
button#nextbt {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    border: none;
    color: white;
    font-size: 24px;
}
.calendar{
    color: white;
}
.calendar td{
    height: 40px;
    width: 14.28571428571429%;
    border-radius: 5px;
}
td.day:hover {
    background: rgba(255,255,255,0.3);
}
.modal-header .close {
    margin-top: -2px;
    position: absolute;
    top: 10px;
    right: 10px;
    height: 30px;
    width: 30px;
    color: #000000;
    background: white;
    z-index: 1;
}
.week td{
    font-weight: bold;
}
.modal-header {
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0300a6), color-stop(1, #5700ca)) !important;    color: white;
}
.modal-footer {
    padding: 15px;
    text-align: right;
    border-top: 1px solid #e5e5e5;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0300a6), color-stop(1, #5700ca)) !important;
  }
input#eventtxt {
    border-radius: 5px;
    width: 100%;
    height: 30px;
    border: 1px solid #969696;
    outline: none;
}
h4#eventname {
    margin-bottom: 24px;
    color: #038241;
}
.placnm{
    margin-top: 20px;
    font-size: 16px;
}

.modal-footer .btn+.btn {
    margin-bottom: 0;
    margin-left: 5px;
    background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #0300a6), color-stop(1, #29015d)) !important;
}
</style>
<?php
if(isset ($_POST['newData'])){
$updatedData = $_POST['newData'];
// please validate the data you are expecting for security
$myfile = fopen("event.json", "w") or die("Unable to open file!");
fwrite($myfile, $updatedData);

}

?>
<script type="text/javascript">
var today = new Date();
var month = today.getMonth();
//Using the Date prototype to assign our month names-->
Date.prototype.getMonthNames = function() { return [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ]; }

//Getting the number of day in the month.-->
Date.prototype.getDaysInMonth = function() 
{ return new Date( this.getFullYear(), this.getMonth() + 1, 0 ).getDate(); }
Date.prototype.calendar = function()
{  var numberOfDays = this.getDaysInMonth();
//This will be the starting day to our calendar-->
var startingDay = new Date(this.getFullYear(), this.getMonth(), 1).getDay();
//We will build the calendar_table variable then pass what we build back-->
   var calendarTable = '<table summary="Calendar" class="calendar" style="text-align: center;">';
calendarTable += '<caption>' + this.getMonthNames()[this.getMonth()] + '&nbsp;' + this.getFullYear() + '</caption>';
calendarTable += '<tr ><td colspan="7"></td></tr>';
calendarTable += '<tr class="week">';
calendarTable += '<td>S</td>';
calendarTable += '<td>M</td>';
calendarTable += '<td>T</td>';
calendarTable += '<td>W</td>';
calendarTable += '<td>TH</td>';
calendarTable += '<td>F</td>';
calendarTable += '<td>S</td></tr>'; 
//Lets create blank boxes until we get to the day which actually starts the month-->
for ( var i = 0; i < startingDay; i++ ) 
{ calendarTable += '<td>&nbsp;</td>'; }
//border is a counter, initialize it with the "blank"-->
//days at the start of the calendar-->
//Now each time we add new date we will do a modulus-->
//7 and check for 0 (remainder of border/7 = 0)
//if it's zero then it's time to make new row-->
var border = startingDay;
//For each day in the month, insert it into the calendar-->
for ( var id = '',  i = 1; i <= numberOfDays; i++ ) 
{ if (( month == month ) && ( today.getDate() == i )) { id = 'id="current_day"'; } 
else { id = ''; }
calendarTable += '<td  data-toggle="modal" data-target="#exampleModal" class="day"  ' + id + '>' + i + '</td>'; border++;
if ((( border % 7 ) == 0 ) && ( i < numberOfDays )) 
{ 
//Time to make new row, if there are any days left.-->
calendarTable += '<tr></tr>'; } } 
//All the days have been used up, so pad the empty days until the end of calendar-->
while(( border++ % 7)!= 0) 
{ calendarTable += '<td>&nbsp;</td>'; } 
//Finish the table-->
calendarTable += '</table>';
//Return it-->
return calendarTable; }
//--> Let's add up some dynamic effect
window.onload = function() {
selected_month = '<form name="month_holder">';
selected_month += '<select id="month_items" size="1" onchange="month_picker();">';
for ( var x = 0; x <= today.getMonthNames().length; x++ ) { selected_month += '<option value="' + today.getMonthNames()[x] + ' 1, ' + today.getFullYear() + '">' + today.getMonthNames()[x] + '</option>'; }
selected_month += '</select></form>';
actual_calendar = document.getElementById('show_calendar');
actual_calendar.innerHTML = today.calendar();
var month_listing = document.getElementById('current_month');
month_listing.innerHTML = selected_month;
actual_month = document.getElementById('month_items');
actual_month.selectedIndex = month;
}
//--> Month Picker <--\\
function month_picker()
{ month_menu = new Date(actual_month.value);
actual_calendar.innerHTML = month_menu.calendar();
}
// Done Hiding -->

</script>
<script>
$(function(){
    $('#current_month').hide();
  $('#nextbt').on('click', function(){
    $('#prev').show();
    var selected_element = $('#month_items option:selected');
    selected_element.removeAttr('selected');
    selected_element.next().attr('selected', 'selected');
    console.log(selected_element.next().val());
    if(selected_element.next().val()=='December 1, 2021'){
      $('#nextbt').hide();
      
    }
    
    $('#month_items').val(selected_element.next().val());
month_picker();
  });
  $("#prev").click(function() {
    $('#nextbt').show();
    if($("#month_items > option:selected").prev().val()=='January 1, 2021'){
      $('#prev').hide();
      
    }
    $("#month_items").val($("#month_items > option:selected").prev().val());
    month_picker();

})
});
</script>
<div class="cont">
<button id="prev"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i></button>
<div id="show_calendar">&nbsp;</div><button id="nextbt"><i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></button>
<div id="current_month">&nbsp;</div>
</div>
<div id="event"></div>
    </div>
<script>
document.addEventListener("load",$.getJSON( "event.json", function( data ) {
    var flag=0;
    var evnm;
newtt=$('#current_day').text()+" "+$('caption').text();
for(var i=0;i<data.length;i++){
  
  newnm=data[i].name;
  if(newnm==newtt){
    flag=1;
    evnm=data[i].title;
  }
 }
 if(flag==1){
    $('#event').empty();
h="";
h+="<div>"+evnm+"<div>";
h+='<div class="progress" style="height:10px">  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
     $('#event').append(h);
    
    }
    else{
        $('#event').empty();

$('#event').append('No Event');
    }

}) );



    $("#show_calendar").on("click", "td.day", function() {
        $('.day').not('#current_day').css("background", "transparent");

        $(this).css("background", " -webkit-gradient(linear, left bottom, left top, color-stop(0, #59ab8d), color-stop(1, #449485))");

newtt=$(this).text()+" "+$('caption').text();
$.getJSON( "event.json", function( data ) {
    var flag=0;
    var evnm;

for(var i=0;i<data.length;i++){
  
  newnm=data[i].name;
  if(newnm==newtt){
    flag=1;
    evnm=data[i].title;
  }
 }
 if(flag==1){
    $('#event').empty();
h="";
h+="<div>"+evnm+"<div>";
h+='<div class="progress" style="height:10px">  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
     $('#event').append(h);
     p="<h4 id='eventname'>"+newtt+"</h4>";
p+="<label>Event</label><div class='placnm'>"+evnm+"</div>";
     $('#newevent').empty();

$('#newevent').append(p);
$('#savebt').hide();
 }
 else{
  $('#savebt').show();
    p="<h4 id='eventname'>"+newtt+"</h4>";
p+="<label>Event</label><input type='text' id='eventtxt'>";
    $('#newevent').empty();

$('#newevent').append(p);
$('#event').empty();

$('#event').append('No Event');

 }  
});
});
function appjso(){
var x=$('#eventtxt').val();
var y=$('#eventname').text();
bigid=0;
$.getJSON( "event.json", function( data ) {
  // now data is JSON converted to an object / array for you to use.
  // Tim Robbins, Morgan Freeman, Bob Gunton
  
for(var i=0;i<data.length;i++){
  
 bigid=data[i].id;
}
bigid=bigid+1
 var newMovie = {id:bigid,name:y,title:x}; // a new movie object
//
  // add a new movie to the set
  data.push(newMovie); 
  console.log(data);  
  var newData = JSON.stringify(data);
$.post('calender.php', {
    newData: newData
}, function(response){
  $('#savebt').hide();
  p="<h4 id='eventname'>"+y+"</h4>";
p+="<label>Event</label><div class='placnm'>"+x+"</div>";
     $('#newevent').empty();

$('#newevent').append(p);
  $('#event').empty();
h="";
h+="<div>"+x+"<div>";
h+='<div class="progress" style="height:10px">  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>';
     $('#event').append(h);
});  
});
}

 

</script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="newevent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="appjso()" id="savebt"class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>