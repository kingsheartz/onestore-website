<head>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<script src="jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="search.js"></script>

<style type="text/css">
	#display{
       position: absolute;
       z-index:999;
       left:13px;
}
#display{
	width:90%;

           box-sizing: border-box;
           background-color: #cccccc;



}

</style>
</head>


<div id="search-div" class="col-md-5 col-lg-5 col-sm-9 ">
<select id="category" name="cat" >
	<option value=""></option>
	<?php
		require "pdo.php";
		$sql=$pdo->query("select category from item group by category");
		while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {
		?>
		<option value="<?=$row['category']?>"><?=$row['category']?></option>
		<?php
		}
	?>
</select>
<input type="text" name="search-box" id="search"  onkeyup ="searchele()">
<button onclick="check()" >Search</button>
<div class="clear-fix"></div>	
<div id="display" class="col-md-5 col-lg-5 col-sm-9"></div>
</div>

<div style="clear: both;"></div>	

