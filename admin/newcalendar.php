<!DOCTYPE html>
<html>
<body>


<style type="text/css">
    
    #month{
        width: 100%;
    background: -webkit-linear-gradient(left, #a32929, #ff6666 75%);
    height: 40px;
    color: white;
    box-shadow: 0px 5px 5px #ddd;
    position: relative;

    }
    #monthname{
        padding-left: 10px;
    font-size: 20px;
    letter-spacing: 2px;
    position: absolute;
    bottom: 0;
    text-transform: uppercase;
    }
    #month:before{
content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    left: 60px;
    top: 5px;
    border-radius: 50%;
    background: #4d0000;
    box-shadow: 60px 0px 0px #4d0000;
    }
    #month:after{
        content: '';
    position: absolute;
    width: 7px;
    height: 20px;
    background: #555;
    border-radius: 20% 20% 0 0;
    left: 62px;
    top: -12px;
    box-shadow: 0px -2px 0px #777, -1px 0px 2px #777, 0px 3px 0px #4d0000, 60px 0px 0px #555, 60px -2px 0px #777;
    }
    #date{
        text-align: center;
    margin-top: -25px;
    font-size: 150px;
    color: #2d2d2d;
    font-weight: 700;

    }
    .one:before{
        content: '';
    position: absolute;
    border-left: 200px solid transparent;
    border-bottom: 30px solid rgba(0, 0, 0, 0.1);
    bottom: 0px;
    }
    .one{
            font-family: "Istok Web",sans-serif;
    width: 200px;
    height: 200px;
    margin: 60px auto;
    background: white;
    box-shadow: 0px 5px 5px #222, -5px 7px 0px 3px #726a57, -12px 13px 2px rgb(0 0 0 / 20%);
    position: relative;
    border-radius: 1px;
    
    transform: rotate(
-20deg
);
    }
    .caltwo{
      background: -webkit-linear-gradient(#4EFF00, #333);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
      font-weight: bolder;
        width: 300px;
  top: 50px;
  right:100px;
    position: absolute;
    text-transform: uppercase;
    padding: 10px 0;
    }
    #day{
      background: -webkit-linear-gradient(#4EFF00, #333);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
        font-size: 35px;
    letter-spacing: 7px;
  
    margin-bottom: 20px;
    }
    #moday{
        font-size: 35px;
    letter-spacing: 5px;
    word-spacing: 5px;
    background: -webkit-linear-gradient(#4EFF00, #333);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
    }
    .clock{
       
       
        font-size: 50px;
        font-weight: bolder;
        background: -webkit-linear-gradient(#4EFF00, #333);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
   


    }#ct6{
       font-family: "Lucida Sans",sans-serif;
    
    letter-spacing: 5px;
    }
    .cale{
          font-family: "Lucida Sans",sans-serif;
background: url('');
        position: relative;
        background: #FFFFFF;
        margin-top: 50px;
        height: 400px;
        border-radius: 5px;
        overflow: hidden;
    }
    .cale img{
        width: 100%;
        height: 500px;
               border-radius: 5px;

    }
    #canvas{
        position: absolute;
        left: 50px;

    }
</style>
<div class="cale">
  <img src="images/wheather.jpg">
<canvas id="canvas" width="400" height="400"
>
</canvas>

<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = '#000000';
  ctx.fill();
  
  ctx.beginPath();
  //ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#FFFFFF';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="top";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(-8, radius*0.85);
    ctx.rotate(-ang);
  }
  for(num = 1; num < 31; num++){
  ctx.textBaseline="bottom";
  ctx.textAlign="center";
    ctx.font = radius*0.15 + "px arial";

  //ctx.rotate(90deg);
    ang = num * Math.PI / 15;
   ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang-ctx.length*ang/2);
    ctx.fillText('|', 0,0);
  ctx.rotate(ang-ctx.length*ang/2);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
  for(num = 1; num < 61; num++){
  ctx.textBaseline="bottom";
  ctx.textAlign="center";
  ctx.fillStyle = '#201D1D';
    ang = num * Math.PI / 30;
   ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang-ctx.length*ang/2);
    ctx.fillText('l', 0,0);
  ctx.rotate(ang-ctx.length*ang/2);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.05);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.02);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.01);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
grad = ctx.createRadialGradient(0,0,radius*0.95, 80,170,radius*1.05);
  grad.addColorStop(0, '#0006FF');
  grad.addColorStop(0.5, '#FFFFFF');
  grad.addColorStop(1, '#0060FF');
  ctx.strokeStyle = grad;
   //ctx.lineWidth = radius*0.1;
  ctx.stroke();
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>


<script>
function display_ct6() {
var x = new Date();

hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
x1 =  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() ;
document.getElementById('ct6').innerHTML = x1;
display_c6();
 }
 function display_c6(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct6()',refresh)
}
display_c6()
</script>

	<div class="caltwo">
		<div id="day"></div>
		<div id="moday"></div>
	
	<div class="clock">
				<div id="ct6"></div>

	</div>	
</div>

</div>

<script type="text/javascript">
var month = new Array();
  month[0] = "January";
  month[1] = "February";
  month[2] = "March";
  month[3] = "April";
  month[4] = "May";
  month[5] = "June";
  month[6] = "July";
  month[7] = "August";
  month[8] = "September";
  month[9] = "October";
  month[10] = "November";
  month[11] = "December";

  var d = new Date();
  var n = month[d.getMonth()];
  var mon=n.substring(0,3);

var weekday = new Array(7);
weekday[0] = "Sunday";
weekday[1] = "Monday";
weekday[2] = "Tuesday";
weekday[3] = "Wednesday";
weekday[4] = "Thursday";
weekday[5] = "Friday";
weekday[6] = "Saturday";

var n1 = weekday[d.getDay()];
document.getElementById('day').innerHTML = n1;
document.getElementById('moday').innerHTML = n+' '+d.getDate();


</script>

