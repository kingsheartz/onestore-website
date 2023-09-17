<!DOCTYPE html>
<html>
<head>
<title>OneStore || for all your needs</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!--favicon-->
<link href="images/logo/favicon.png" rel="icon"/>
<!--//favicon-->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

<!-- connecting with another template -->


<!-- Bootstrap -->
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    
<!--<link rel="stylesheet" href="css/responsive.css">-->


<!-- coc -->    
	

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="extras/lib/slick/slick.css" rel="stylesheet">
        <link href="extras/lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="extras/css/style2.css" rel="stylesheet">
        <link href="extras/css/style3.css" rel="stylesheet">


<style type="text/css">
	/*PAGE LOADER*/
.loader{
  position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    height: 100%;
    background-color: rgb(000,000,000);
    width:100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.loader >img{
  width: 50px;
}

.loader{
  animation: fadeout 1s;
  animation-fill-mode: forwards;

}

@keyframes fadeout {
100%{
  opacity: 0;
  visibility: hidden;
}
}

/*PAGE LOADER*/
</style>
<style>img[alt="www.000webhost.com"]{display:none;}</style>
</head>

<body>
<!--ANIMATION-->

<div class="loader">
  <img src="images\load\4.svg" alt="loading..." />
</div>

<!--ANIMATION-->

<!-- header -->

    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                            <li><a href="cart.html"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="checkout.html"><i class="fa fa-user"></i> Checkout</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Login</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        <ul>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->


<div class="headimg" >
	<div class="container top" style="width:100%">
		<div class="row" style="height: 100%">
			<div class="col-lg-12">
				<div class="w3ls_logo_products_left1">
					<ul class="phone_email topli">
						<li style="color: white;" class="topli"><i class="fa fa-phone" aria-hidden="true"></i>Order online or call us : +91 8113990368</li>

					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="agileits_header">
		<div class="container head">
			<div class="row">
				<div class="col-md-2 col-lg-2 col-sm-3 col-3">
					<div class="w3ls_logo_products_left">
						<h1><a href="index.php"><img src="images/logo/logo.svg" height="50px" style="margin-left: 0px;"></a></h1>
					</div>
				</div>

				<div class="col-sm-1 cartsm">
					<form action="#" method="post" class="last" style="float: right;">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="display" value="1">
						<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
					</form>
				</div>
<?php

	if(isset($_POST['Search'])){
		if(strlen($_POST['Search'])>0){
			require "pdo.php";
			$sub=$_POST['Search'];
			$r6=$pdo->query("select item_id from item where item_name='$sub'");
			$id6=$r6->fetch(PDO::FETCH_ASSOC);
$it=$id6['item_id'];
		}

	}


 ?>
				<div class="col-md-5 col-lg-5 col-sm-9 col-9 srch">
					<div class="w3l_search">
						<form id="form1" action="single.php?id=<?=$it=isset($it)?$it:0;
?>" method="post">
							<input type="search" id="search" name="Search" placeholder="Search for a Product..." required="">
							<button  class="btn btn-default search" aria-label="Left Align">
							<i class="fa fa-search" aria-hidden="true"> </i>
							</button>
							<div id="display" ></div>

						</form>
					</div>
				</div>
				<div class="col-md-5 col-lg-5">
					<div class="agile-login">
						<ul style="float: right;">
							<li><a href="registered.php"> Create Account </a></li>
							<li><a href="login.php">Login</a></li>
							<li><a href="contact.html">Help</a></li>
							<li class="cartlg">
								<form action="cart.php" method="post" class="last">
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="display" value="1">
								<button class="w3view-cart" type="button" onclick="cart()" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
								</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<!-- //header -->
<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.php" class="act">Home</a></li>
									<!-- Mega Menu -->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Groceries<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Groceries</h6>
														<li><a href="products.php?category=Grocery and Gourmet Foods & subcategory=Cereal and Muesli">Dals & Pulses</a></li>
														<li><a href="products.php?category=Grocery and Gourmet Foods & subcategory=Coffee, Tea and Beverages">Coffee, Tea and Beverages</a></li>
														<li><a href="products.php?category=Grocery and Gourmet Foods & subcategory=Snack Foods">Snack Foods</a></li>
														<li><a href="products.php">Rice & Rice Products</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Household<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Household</h6>
														<li><a href="household.html">Cookware</a></li>
														<li><a href="household.html">Dust Pans</a></li>
														<li><a href="household.html">Scrubbers</a></li>
														<li><a href="household.html">Dust Cloth</a></li>
														<li><a href="products.php?category=House hold & subcategory=kitchen">Kitchen</a></li>
														<li><a href="products.php?category=House hold & subcategory=kitchen">Kitchenware</a></li>
													</ul>
												</div>


											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal Care<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Baby Care</h6>
														<li><a href="personalcare.html">Baby Soap</a></li>
														<li><a href="personalcare.html">Baby Care Accessories</a></li>
														<li><a href="personalcare.html">Baby Oil & Shampoos</a></li>
														<li><a href="personalcare.html">Baby Creams & Lotion</a></li>
														<li><a href="personalcare.html"> Baby Powder</a></li>
														<li><a href="personalcare.html">Diapers & Wipes</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Packaged Foods<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Accessories</h6>
														<li><a href="packagedfoods.html">Baby Food</a></li>
														<li><a href="packagedfoods.html">Dessert Items</a></li>
														<li><a href="packagedfoods.html">Biscuits</a></li>
														<li><a href="packagedfoods.html">Breakfast Cereals</a></li>
														<li><a href="packagedfoods.html"> Canned Food </a></li>
														<li><a href="packagedfoods.html">Chocolates & Sweets</a></li>
													</ul>
												</div>


											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Beverages<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Tea & Coeffe</h6>
														<li><a href="beverages.html">Green Tea</a></li>
														<li><a href="beverages.html">Ground Coffee</a></li>
														<li><a href="beverages.html">Herbal Tea</a></li>
														<li><a href="beverages.html">Instant Coffee</a></li>
														<li><a href="beverages.html"> Tea </a></li>
														<li><a href="beverages.html">Tea Bags</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li>
									<li><a href="offers.html">About</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</div>
							</nav>
			</div>
		</div>
<script type="text/javascript">
	
	function cart(){
		location.href="cart.php";
		return 0;
	}
</script>
<!-- //navigation -->
