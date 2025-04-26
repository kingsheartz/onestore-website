<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>OneStore || for all your needs</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords"
		content="One Store,OneStore,onestore,shoppingcart,One,one,Store,store,shopping,cart,for all your needs" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //for-mobile-apps -->
	<!--favicon-->
	<link href="../../images/logo/favicon.png" rel="icon" />
	<!--//favicon-->
	<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- font-awesome icons -->
	<link href="../../css/font-awesome.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- Font Awesome -->
	<!--<link rel="stylesheet" href="../../css/font-awesome.min.css">-->
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../../css/owl.carousel.css">
	<link rel="stylesheet" href="../CSS/style.css">
	<link href="../../css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../../extras/lib/slick/slick.css" rel="stylesheet">
	<link href="../../extras/lib/slick/slick-theme.css" rel="stylesheet">
	<link href="../../extras/css/style2.css" rel="stylesheet">
	<link href="../../extras/css/style3.css" rel="stylesheet">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="../../extras/OS/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="../../extras/OS/plugins/toastr/toastr.min.css">
	<!--<link rel="stylesheet" href="../../css/responsive.css">-->
	<link
		href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic'
		rel='stylesheet' type='text/css'>
	<link
		href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
		rel='stylesheet' type='text/css'>
	<!-- coc -->
	<!-- Template Stylesheet -->
	<link href="../../extras/css/style2.css" rel="stylesheet">
	<link href="../../extras/css/style3.css" rel="stylesheet">
	<!-- js -->
	<script src="../../js/jquery-1.11.1.min.js"></script>
	<!-- //js -->
	<!-- //IMPORTANT-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- //IMPORTANT-->
	<!-- jQuery Modal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />-->
	<!-- Bootstrap Core JavaScript -->
	<!--favicon-->
	<link href="../../images/logo/favicon.png" rel="icon" />
	<!--//favicon-->
	<!-- search bar -->
	<!-- searching the items -->
	<script type="text/javascript" src="../JS/search.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<!-- connecting with another template -->
	<!-- Bootstrap -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<style type="text/css">
		/*PAGE LOADER*/
		#popup2 {
			display: none;
		}

		#popup1 {
			display: none;
		}

		img.ic {
			max-height: 100px;
			max-width: 100px;
			width: 0;
			position: absolute;
			animation-name: rotate;
			animation-duration: 1s;
			animation-direction: alternate;
			animation-iteration-count: 1;
			/*  animation-delay: 1.5s;*/
		}

		/*
@keyframes rotate {
  0% {
	transform: rotate(0);
	width: 0px;
  }
  80% {
	width: 100px;
  }
  100% {
	transform: rotate(360deg);
	width: 100px;
  }
}
*/
		@keyframes rotate {
			0% {
				transform: rotate(0);
				width: 100px;
			}

			80% {
				width: 100px;
			}

			100% {
				transform: rotate(0deg);
				width: 100px;
			}
		}

		img.ic:empty {
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-moz-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			-o-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			margin-left: -50px;
			margin-top: -60px;
		}

		.loader2 {
			position: fixed;
			z-index: 999999999999;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background-color: rgb(000, 000, 000, 0.85);
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.loader2 {
			animation: fadegone 1s;
			animation-fill-mode: forwards;
		}

		@keyframes fadegone {
			100% {
				opacity: 100%;
				visibility: hidden;
			}
		}

		img.ri {
			position: absolute;
			min-width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			box-shadow: 0 3px 6px rgba(0, 0, 0, 0.9);
		}

		img.ri:empty {
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-moz-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			-o-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.loader1 {
			position: fixed;
			z-index: 999999999990;
			top: 0;
			left: 0;
			height: 100%;
			background-color: rgb(000, 000, 000, 0.85);
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.loader1>img {
			width: 50px;
		}

		.loader1 {
			animation: fadein 1s;
			animation-fill-mode: forwards;
		}

		@keyframes fadein {
			100% {
				opacity: 100%;
				visibility: hidden;
			}
		}

		.loader {
			position: fixed;
			z-index: 999999999999;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.loader>img {
			width: 50px;
			margin-top: 140px;
		}

		.loader {
			animation: fadeout 1s;
			animation-fill-mode: forwards;
		}

		@keyframes fadeout {
			100% {
				opacity: 100;
				visibility: hidden;
			}
		}

		@media(max-width: 567px) {
			#popup2 {
				width: 100%;
			}
		}

		@media(max-width: 767px) and (min-width: 568) {
			#popup2 {
				width: 80%;
			}
		}

		@media(min-width: 768px) {
			#popup2 {
				width: 30%;
			}
		}

		/*PAGE LOADER*/
		.tab-content {
			padding: 15px 15px 10px;
			margin-bottom: 20px;
			z-index: 2;
			border: 1px solid #ddd;
			border-top: 0px;
		}

		@media(max-width: 365px) {
			#sm_sign_up {
				display: none;
			}
		}

		/*
@media(max-width: 365px){
	#sm_category{
		display: none;
	}
}
*/
		@media(min-width: 1200px) and (max-width:1231px) {
			.col-lg-2 {
				width: 20% !important;
			}

			.col-lg-8 {
				width: 60% !important;
			}
		}

		body.modal-open {
			overflow: auto !important;
			padding: 0px !important;
			overflow-y: hidden !important;
		}

		body.modal-close {
			overflow: auto !important;
			padding: 0px !important;
		}

		.navbar ul li {
			z-index: 9 !important;
		}

		.navbar-inverse {
			border-top: 2px solid #0c99cc !important;
			border-bottom: 0px !important;
			background-color: #000;
		}

		/*background-image: linear-gradient(390deg, #03A9F4, #29ff92);*/
		.navbar-inverse .navbar-nav>.active>a,
		.navbar-inverse .navbar-nav>.active>a:focus,
		.navbar-inverse .navbar-nav>.active>a:hover {
			color: white !important;
			background-color: #222 !important;
			border-bottom: 4px solid #fe9126;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 5px;
			padding-bottom: 10px;
		}

		.dropdown-menu li>span:hover {
			color: white;
		}

		.dropdown-menu li>span:nth-child(1) {
			color: #fe9126;
		}

		.dropdown-menu li {
			color: black !important;
		}

		.dropdown-menu li:hover {
			background-color: #02171e !important;
			border-left: 4px solid #337ab7;
			padding: 0;
			color: white !important;
			border-bottom-left-radius: 3px;
			border-top-left-radius: 3px;
		}

		@media(min-width: 767px) and (max-width:1081px) {
			.navbar-center {
				padding-top: 5px !important;
			}

			#homeactive a {
				padding-left: 5px !important;
				padding-right: 5px !important;
			}

			#catactive>a {
				padding-left: 5px !important;
				padding-right: 5px !important;
			}

			#aboutactive a {
				padding-left: 5px !important;
				padding-right: 5px !important;
			}

			#contactactive a {
				padding-left: 5px !important;
				padding-right: 5px !important;
			}

			.navbar {
				margin-bottom: -5px !important;
			}

			.navbar-inverse .navbar-nav>.active>a,
			.navbar-inverse .navbar-nav>.active>a:focus,
			.navbar-inverse .navbar-nav>.active>a:hover {
				/*border-bottom:4px solid #fe9126;*/
				border-bottom: 4px solid #fe9126;
				border-top: 4px solid #222;
				margin-top: -4px;
			}
		}

		@media(max-width: 767px) {
			.navbar-inverse {
				background-color: #02171e;
				border-top: 0px !important;
			}

			.navbar-inverse .navbar-nav>.active>a,
			.navbar-inverse .navbar-nav>.active>a:focus,
			.navbar-inverse .navbar-nav>.active>a:hover {
				color: white !important;
				background-color: #0c99cc !important;
				border-bottom: 0px;
				border-bottom-right-radius: 0px;
				border-bottom-left-radius: 0px;
				border-left: 5px white solid;
				border-right: 5px white solid;
			}

			.navbar-inverse .navbar-nav li:hover {
				background-color: #000 !important;
				border-top-left-radius: 5px;
				border-bottom-left-radius: 5px;
				border-top-right-radius: 5px;
				border-bottom-right-radius: 5px;
				border-left: 5px #0c99cc solid;
				border-right: 5px #0c99cc solid;
			}

			#homeactive i {
				color: #fff;
			}

			#homeactive i:hover {
				color: #0c99cc;
			}

			#catactive i {
				color: #fff;
			}

			#catactive i:hover {
				color: #0c99cc;
			}

			#aboutactive i {
				color: #fff;
			}

			#aboutactive i:hover {
				color: #0c99cc;
			}

			#contactactive i {
				color: #fff;
			}

			#contactactive i:hover {
				color: #0c99cc;
			}

			#shopactive i {
				color: #fff;
			}

			#shopactive i:hover {
				color: #0c99cc;
			}

			.glyphicon-user {
				color: #fff;
			}

			.glyphicon-user:hover {
				color: #0c99cc;
			}
		}

		.active i {
			color: white !important;
		}

		@media (min-width: 992px) {
			#lg-cartcnt {
				height: 22px !important;
				margin-bottom: -12px !important;
			}
		}

		/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
		#category,
		#category li {
			z-index: 999999999 !important;
		}

		.side_nav_content_header {
			font-size: 18px;
		}

		.side_nav_content_head {
			background-color: #02171e;
			border-top: 0px !important;
			font-size: 15px;
		}

		.side_nav_content_head:hover,
		.category_side_head:hover {
			color: white !important;
			background-color: #0c99cc !important;
			border-bottom: 0px;
			border-bottom-right-radius: 0px;
			border-bottom-left-radius: 0px;
			border-left: 5px white solid;
			border-right: 5px white solid;
		}

		.side_nav_content_head:hover,
		.category_side_head:hover {
			background-color: #000 !important;
			border-top-left-radius: 5px;
			border-bottom-left-radius: 5px;
			border-top-right-radius: 5px;
			border-bottom-right-radius: 5px;
			border-left: 5px #0c99cc solid;
			border-right: 5px #0c99cc solid;
		}

		.side_nav_content_head,
		.category_side_head {
			color: white !important;
		}

		.side_nav_content_end {
			border-bottom: 2px solid #337ab7;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 5px;
			padding-bottom: 10px;
		}

		.sidenav {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #02171e;
			overflow-x: hidden;
			transition: 0.15s;
			padding-top: 60px;
		}

		.sidenav a {
			padding: 8px 8px 8px 32px;
			text-decoration: none;
			display: block;
		}

		.sidenav a:hover {
			color: #f1f1f1;
		}

		.closebtn {
			position: absolute;
			top: 0;
			right: 25px;
			font-size: 30px;
			margin-left: 50px;
		}

		.closebtn a,
		.closebtn img {
			z-index: 99999999;
			top: 0px;
			left: 0px;
			color: white;
			margin-left: 320px;
			margin-top: 20px;
			position: fixed;
		}

		#side_nav_bar_lock {
			position: fixed;
			z-index: 99;
			top: 0;
			left: 0;
			height: 100%;
			background-color: rgba(000, 000, 000, 0.85);
			width: 100%;
			display: none;
			justify-content: center;
			align-items: center;
		}

		.category_side_head {
			padding: 0px !important;
			padding-bottom: 0px !important;
		}

		.category_side_head a:active,
		.category_side_head a:focus {
			color: white !important;
			background-color: #000 !important;
			border-bottom: 0px;
			border-bottom-right-radius: 0px;
			border-bottom-left-radius: 0px;
			border-left: 5px #0c99cc solid;
			border-right: 5px #0c99cc solid;
		}

		.side_drop_li>span:hover {
			color: white;
		}

		.side_drop_li>span:nth-child(1) {
			color: #fe9126;
		}

		.side_drop_li {
			color: black !important;
			background-color: white !important;
			text-decoration: none !important;
		}

		.side_drop_li {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}

		.side_drop_li:hover {
			background-color: #02171e !important;
			border-left: 4px solid #337ab7;
			padding: 0;
			color: white !important;
			border-bottom-left-radius: 3px;
			border-top-left-radius: 3px;
		}

		.side_drop_li_main {
			background-color: #02171e;
			border-top: 0px !important;
		}

		.side_drop_li_main li:hover {
			background-color: #000 !important;
			border-top-left-radius: 5px;
			border-bottom-left-radius: 5px;
			border-top-right-radius: 5px;
			border-bottom-right-radius: 5px;
			border-left: 5px #0c99cc solid;
			border-right: 5px #0c99cc solid;
		}

		.slide_drop_li_main_first {
			margin-top: 8px !important;
			padding-top: 8px !important;
		}

		.category_side_head {
			background-color: #02171e;
		}

		/*
#main_all {
  transition: margin-left .5s;
  padding: 16px;
}
*/
		@media(max-height: 450px) {
			.sidenav {
				padding-top: 15px;
			}

			.sidenav a {
				font-size: 15px;
			}
		}

		/******************************************************************************************************************************/
		@media(max-width: 767px) {
			#lg_side_active {
				display: none;
			}

			#sm_side_active {
				display: unset;
			}
		}

		@media(min-width: 768px) {
			#lg_side_active {
				display: unset;
			}

			#sm_side_active {
				display: none;
			}
		}

		.dropdown-btn {
			text-decoration: none;
			font-size: 15px;
			display: block;
			border: none;
			background: none;
			width: 100%;
			text-align: left;
			cursor: pointer;
			outline: none;
		}

		.dropdown-container {
			display: none;
		}

		/* Optional: Style the caret down icon */
		.fa-caret-down {
			float: right;
			padding-right: 8px;
		}

		/*HORIZONTAL LISTING*/
		.div-wrapper {
			display: grid;
			grid-auto-flow: column;
			grid-gap: 5px;
			width: 100%;
		}

		.std_loader {
			border: 6px solid #f3f3f3;
			border-radius: 50%;
			border-top: 6px solid #3498db;
			width: 35px;
			height: 35px;
			-webkit-animation: spin 2s linear infinite;
			/* Safari */
			animation: spin 2s linear infinite;
			display: flex;
			align-items: center;
			justify-content: center;
			top: 50%;
			position: fixed;
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			z-index: 9999999999999999 !important;
		}

		.std_text,
		.std_text1,
		.std_text2,
		.std_text3 {
			text-align: center;
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100%;
			z-index: 1999999999999999999 !important;
			position: fixed;
			display: none;
			top: 10%;
		}

		.background_loader {
			margin: 0;
			padding: 0;
			top: 0;
			left: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.85);
			position: fixed;
			z-index: 99999999999999 !important;
			display: none;
		}

		/* Safari */
		@-webkit-keyframes spin {
			0% {
				-webkit-transform: rotate(0deg);
			}

			100% {
				-webkit-transform: rotate(360deg);
			}
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		/*****************************************************************************************************************************/
		/*****************************************************************************************************************************/
	</style>
	<style>
		img[alt="www.000webhost.com"] {
			display: none;
		}
	</style>
	<script type="text/javascript">
		var gonenetwork = 0;
		var NavScrollTop;
		function network_gone() {
			if (navigator.onLine == false) {
				$('#show_offline').css('display', 'block');
				$('#show_online').hide();
				gonenetwork = 1;
				return true;
			}
		}
		function check_network() {
			if (network_gone()) {
				return false;
			}
			else if ((navigator.onLine == true) && (gonenetwork == 1)) {
				$('#show_online').css('display', 'block');
				$('#show_offline').hide();
				setTimeout(function () { $('#show_online').hide(); }, 2000);
				gonenetwork = 0;
			}
		}
		setInterval(check_network, 2000);
	</script>
</head>

<body id="strt" class="scroll_handle_orange hidescroll" style="overflow-x:hidden; width: 100%;padding: 0px;">
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0"
		nonce="lJVMx4Fw"></script>
	<div id="show_online"
		style="padding: 3px;text-align: center;color: white;width: 100%;background-color: #489e07;display: none;font-weight: 400;font-size: 1.4rem ;font-family: Poppins, sans-serif">
		Online</div>
	<div id="show_offline"
		style="padding: 3px;text-align: center;color: white;width: 100%;background-color: #c50505;display: none;font-weight: 400;font-size: 1.4rem ;font-family: Poppins, sans-serif">
		Offline</div>
	<!--SIDE-BAR-DIV-->
	<div id="side_nav_bar_lock" style="padding: 0px;margin: 0px;">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="float: left;"><img
				src="../../images/close.png" alt="close"></a>
	</div>
	<!--SIDE-BAR-DIV-->
	<!--RESPONSE AWAITING-->
	<div class="background_loader">
		<div class="std_loader"></div>
	</div>
	<div class="std_text" style="color:white;font-size:17px;width:100%">
		<center>Cancelling...</center>
	</div>
	<div class="std_text1" style="color:white;font-size:17px;width:100%">
		<center>Wait a sec...</center>
	</div>
	<div class="std_text2" style="color:white;font-size:17px;width:100%">
		<center>Please wait...</center>
	</div>
	<div class="std_text3" style="color:white;font-size:17px;width:100%">
		<center>Placing order...</center>
	</div>
	<!--RESPONSE AWAITING-->
	<!--ANIMATION-->
	<div class="loader1">
		<img src="../../images/logo/store.jpg" class="ri" />
	</div>
	<div class="loader2">
		<img src="../../images/logo/logofullfill.png" class="ic">
	</div>
	<div class="loader">
		<img src="..\..\images\load\3.svg" height="70" alt="loading..." />
	</div>
	<!--ANIMATION-->
	<!-- header -->
	<div class="headimg" style="padding: 0px;margin: 0px;left: 0px;right: 0px;"><!--#1-->
		<div class="container top"
			style="width:100%;padding-top: 12px;margin: 0px;left: 0px;right: 0px;padding-bottom: 5px;">
			<div style="height: 100% ;width: 100%;display: block;margin: 0px;left: 0px;right: 0px">
				<div>
					<center>
						<div class="w3ls_logo_products_left1"
							style="width: 100% ;align-items:center;justify-content: center;left: 0px;right: 0px">
							<ul class="phone_email topli" style="padding: 0px;margin: 0px;left: 0px;right: 0px">
								<li class=" topli " style="float: left;"
									style="padding: 0px;margin: 0px;left: 0px;right: 0px">
									<div class="logo_img" style="padding: 0px;margin: 0px;left: 0px;right: 0px">
										<a href="#" style="float: left;margin-left:-10px;margin-right:5px;"
											id="sm_side_active">
											<span style="font-size:30px;cursor:pointer"
												onclick="openNav()">&#9776;</span>
										</a>
										<a href="../Main/onestore.php"><img src="../../images/logo/logo.svg"
												height="50px" style="padding: 0px;margin: 0px;left: 0px;right: 0px">
										</a>
									</div>
								</li>
								<li style="color: white;float: right;" class="topli" id="lg_top_ph_mail"><a
										href="tel:+918589024973" style="color:white;font-family:arial"><i
											class="fa fa-phone" aria-hidden="true"></i>Ph : <span><i>+91
												8589024973</i></span></a><br><i><span>onestoreforallyourneeds</span></i>
								</li>
								<li style="color: white;float: right;" class="topli" id="sm_top_ph_mail"><i
										class="fa fa-phone" aria-hidden="true"></i><br><i><span><i
												class="fa fa-envelope"></i></span></i>
								</li>
							</ul>
						</div>
					</center>
				</div>
			</div>
		</div>
		<div class=" nav-bar shadow_b"><!--#2-->
			<!-- //LARGE DIV -->
			<div id="large-div">
				<div class="agileits_header shadow_b">
					<div class="container head " style="padding: 0px;margin: 0px;left: 0px;right: 0px">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-3 icon-set" style="">
								<div class="option_segment">
									<div class="agile-login">
										<div>
											<ul class="phone_email topli">
												<li style="float: left;">
													<form action="#" method="post" class="last">
														<button class="w3view-cart location_marker popup2_open"
															type="submit" name="submit" value="">
															<i class="fa  fa-map-marker dropdown"
																aria-hidden="true"></i>
														</button>
														<span style="bottom: 0px;display: flex;justify-content:center;"
															id="location">
															<?php if (isset($_SESSION['location'])) { ?>You<?php } else { ?>Location
															<?php } ?>
														</span>
													</form>
												</li style="float: left;">
												<li style="float: left;margin-top: 5px;" class="cartdiv">
													<form action="#" method="post" class="last">
														<div id="cart" class="btn-group btn-shopping-cart">
															<a href="../Cart/cart.php">
																<div class="shopcart">
																	<div id="lg-cartcnt"
																		style="position: relative;margin-bottom: -10px;background-color: red;border-radius: 50px;width: 20px;height:20px;margin-left: 20px"
																		class="crt-count">
																		<?php
																		if (isset($_SESSION['cart_count'])) {
																			echo $_SESSION['cart_count'];
																		} else {
																			echo "0";
																		}
																		?>
																	</div>
																	<input type="hidden" name="cmd" value="_cart">
																	<input type="hidden" name="display" value="1">
																	<button class="w3view-cart carticon" type="button"
																		onclick="cartview()" name="submit" value=""><i
																			class="fa fa-cart-arrow-down"
																			aria-hidden="true"></i>
																	</button><span
																		style="bottom: 0px;display: flex;justify-content:center;font-weight: normal;"
																		id="location">Cart</span>
																</div>
															</a>
														</div>
													</form>
												</li>
												<li style="float: left;" class="wishdiv">
													<form action="#" method="post" class="last">
														<button class="w3view-cart wishicon" type="button" name="submit"
															value=""
															onclick="location.href='../Wishlist/wishlist.php';">
															<i class="fa fa-heart" aria-hidden="true"></i>
														</button><span
															style="bottom: 0px;display: flex;justify-content:center;"
															id="location">Wishlist</span>
													</form>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-6 col-sm-6 search-set" style="">
								<!--krg-->
								<div id="search-div" class=" srch bar-srch device-width-set"
									style="padding: 0px;margin: 0px;left: 0px;right: 0px">
									<div class=" search_bar bar-srch1">
										<div class="container-fluid bar-srch1"
											style="padding: 0px;margin: 0px;left: 0px;right: 0px">
											<div class="row bar-srch"
												style="padding: 0px;margin: 0px;left: 0px;right: 0px">
												<div class=" bar-srch" style="margin-left: 0px;width: 100%;">
													<div class="input-group bar-srch"
														style="padding: 0px;margin: 0px;left: 0px;right: 0px">
														<div class="input-group-btn search-panel"
															style=" position: relative;">
															<button type="button" id="search-panel"
																class="btn btn-default dropdown-toggle"
																onclick="catlistview()" style="position: relative;">
																<span id="search_concept">All</span> <span class="caret"
																	id="srch_pan"></span>
															</button>
															<ul id="category" class="dropdown-menu" name="cat2"
																role="menu"
																style="position: absolute;display: none;background-color: #CACACA !important">
																<li><a href="#0">All</a></li>
																<?php
																require "../Common/pdo.php";
																$sql = $pdo->query("select category_id,category_name from category");
																while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
																	?>
																	<li value="<?= $row['category_id'] ?>"
																		style="border-color: white;"><a
																			style='font-family:sans-serif '
																			href="#<?= $row['category_id'] ?>"><?= $row['category_name'] ?></a>
																	</li>
																	<?php
																}
																?>
															</ul>
														</div>
														<input type="hidden" name="search_param" value="0"
															id="search_param">
														<input type="text" class="form-control" id="search"
															onkeyup="searchele()" name="Search" placeholder="Search"
															style="margin-top: 0px;z-index: 0">
														<span class="input-group-btn">
															<button onclick="check()"
																onmouseover="$(this).css('background-color','#0c99cc')"
																onmouseleave="$(this).css('background-color','#fe9126')"
																style="color: white;background-color:#fe9126 "
																class="btn btn-default search_btn" type="button"><span
																	class="fa fa-search"></span></button>
														</span>
													</div>
												</div>
											</div>
											<div class="clear-fix"></div>
											<div id="display"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-3" style="margin-top: -20px;padding-left: 0px;">
								<!--krg-->
								<div class="option_segment" style="margin-top: -20px">
									<div class="agile-login">
										<?php
										if (isset($_SESSION['name'])) {
											?>
											<div style="float: right;margin-bottom: -7px" id="menu_items_reglog"
												class="menu_items_reglog">
												<ul style="margin-top: -13px;">
													<li>
														<form action="registered.php" method="post" class="last"
															onclick="openNav()">
															<button class="w3view-cart usericon " type="button"
																name="submit" value="">
																<i class="fa fa-user" aria-hidden="true"></i>
															</button><span
																style="bottom: 0px;display: flex;justify-content:center;"
																id="location"><?= $_SESSION['name'] ?></span>
														</form>
													</li>
												</ul>
											</div>
											<?php
										} else {
											?>
											<div style="float: right;" id="menu_items_reglog" class="menu_items_reglog">
												<ul>
													<li><a href="registered.php"> Create Account </a></li>
													<a href="#myModal" data-toggle="modal" data-dismiss="modal"
														style="color: white">
														<li style="margin-left: -20px;">Login</li>
													</a>
												</ul>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- //close large div -->
			<!-- //SMALL DIV -->
			<div id="small-div"><!--#3-->
				<div class="agileits_header"><!--#4-->
					<div class="container head" style="padding: 0px;margin: 0px;left: 0px;right: 0px"><!--#5-->
						<!--krg-->
						<div id="search-div" class=" srch bar-srch device-width-set"
							style="padding: 0px;margin: 0px;left: 0px;right: 0px">
							<div class=" search_bar bar-srch1"
								style="padding: 0px;margin-left: 15px;margin-right: 15px;margin-top: 5px;margin-bottom: 5px;left: 0px;right: 0px">
								<div class="container-fluid bar-srch1"
									style="padding: 0px;margin: 0px;left: 0px;right: 0px">
									<div class="row bar-srch" style="padding: 0px;margin: 0px;left: 0px;right: 0px">
										<div class=" bar-srch" style="margin-left: 0px;width: 100%;">
											<div class="input-group bar-srch"
												style="padding: 0px;margin: 0px;left: 0px;right: 0px">
												<div id="v-small-div" class="input-group-btn search-panel"
													style=" position: relative;">
													<button type="button" id="search-panel2"
														class="btn btn-default dropdown-toggle" onclick="catlistview2()"
														style="position: relative;">
														<span id="search_concept2">All</span> <span class="caret"
															id="srch_pan2"></span>
													</button>
													<ul id="category2" class="dropdown-menu" name="cat2" role="menu"
														style="position: absolute;z-index: 1;display: none;background-color: #CACACA !important; margin-bottom:10px;">
														<li><a href="#all">All</a></li>
														<?php
														require "../Common/pdo.php";
														$sql = $pdo->query("select category_id,category_name from category");
														while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
															?>
															<li value="<?= $row['category_id'] ?>"><a
																	style='font-family:sans-serif;border:1px white;'
																	href="#<?= $row['category_id'] ?>"><?= $row['category_name'] ?></a>
															</li>
															<?php
														}
														?>
													</ul>
												</div>
												<input type="hidden" name="search_param" value="0" id="search_param2">
												<input type="text" class="form-control" id="search2" autocomplete="off"
													onkeyup="searchele2()" name="Search" placeholder="Search"
													style="margin-top: 0px;">
												<span class="input-group-btn">
													<button onclick="check2()"
														onmouseover="$(this).css('background-color','#0c99cc')"
														onmouseleave="$(this).css('background-color','#fe9126')"
														style="color: white;background-color:#fe9126 "
														class="btn btn-default search_btn" type="button"><span
															class="fa fa-search"></span></button>
												</span>
											</div>
										</div>
									</div>
									<div class="clear-fix"></div>
									<div id="display2"></div>
								</div>
							</div>
						</div>
						<!--krg-->
						<div class="option_segment"><!--#6-->
							<div class="agile-login"><!--#7-->
								<div>
									<ul class="phone_email topli"><!--SIDE OPEN NAV BAR
						<li style="float: left;margin-top: 20px;" id="sm_side_active">
							<a href="#">
								<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
							</a>
						</li>-->
										<li style="float: left;">
											<form action="#" method="post" class="last">
												<button class="w3view-cart location_marker popup2_open" type="submit"
													name="submit" value="">
													<i class="fa  fa-map-marker dropdown" aria-hidden="true"></i>
												</button>
												<span style="bottom: 0px;display: flex;justify-content:center;"
													id="location">
													<?php if (isset($_SESSION['location'])) { ?>You<?php } else { ?>Location
													<?php } ?>
												</span>
											</form>
										</li style="float: left;">
										<li style="float: left;margin-top: 5px;" class="cartdiv">
											<form action="#" method="post" class="last">
												<div id="cart" class="btn-group btn-shopping-cart">
													<a href="..\Cart\cart.php">
														<div class="shopcart">
															<div id="sm-cartcnt"
																style="position: relative;margin-bottom: -10px;background-color: red;border-radius: 50px;width: 20px;height:20px;margin-left: 20px"
																class="crt-count">
																<?php
																if (isset($_SESSION['cart_count'])) {
																	echo $_SESSION['cart_count'];
																} else {
																	echo "0";
																}
																?>
															</div>
															<input type="hidden" name="cmd" value="_cart">
															<input type="hidden" name="display" value="1">
															<button class="w3view-cart carticon" onclick="cartview()"
																type="button" name="submit" value=""><i
																	class="fa fa-cart-arrow-down"
																	aria-hidden="true"></i>
															</button>
															<span
																style="bottom: 0px;display: flex;justify-content:center;font-weight: normal;"
																id="location">Cart</span>
														</div>
													</a>
												</div>
											</form>
										</li>
										<li style="float: left;" class="wishdiv">
											<form action="#" method="post" class="last">
												<button class="w3view-cart wishicon" type="button" name="submit"
													value="" onclick="location.href='../Wishlist/wishlist.php';">
													<i class="fa fa-heart" aria-hidden="true"></i>
												</button><span style="bottom: 0px;display: flex;justify-content:center;"
													id="location">Wishlist</span>
											</form>
										</li>
										<li style="float: left;" class="catdiv" id="sm_category">
											<form action="#" method="post" class="last">
												<button class="w3view-cart caticon popup1_open" type="button"
													name="submit" value="">
													<i class="fa fa-list-alt" aria-hidden="true"></i>
												</button><span style="bottom: 0px;display: flex;justify-content:center;"
													id="location">Category</span>
											</form>
										</li>
										<?php
										if (isset($_SESSION['name'])) {
											?>
											<div style="float: right;" id="menu_items_reglog">
												<a href="#">
													<li class="userdiv" style="float: right;">
														<form action="registered.php" method="post" class="last"
															onclick="openNav()">
															<button class="w3view-cart usericon " type="button"
																name="submit" value="">
																<i class="fa fa-user" aria-hidden="true"></i>
															</button><span
																style="bottom: 0px;display: flex;justify-content:center;"
																id="location"><?= $_SESSION['name'] ?></span>
														</form>
													</li>
												</a>
											</div>
											<?php
										} else {
											?>
											<div style="float: right;margin-top: 40px;" id="menu_items_reglog">
												<li><a href="registered.php"> Create Account </a></li>
												<li style="margin-left: -20px;"><a href="#myModal" data-toggle="modal"
														data-dismiss="modal">Login</a></li>
											</div>
											<?php
										}
										?>
										<div id="userdetails" style="float: right;">
											<?php
											if (isset($_SESSION['name'])) {
												?>
												<a href="#">
													<li class="userdiv" style="float: right;">
														<form action="registered.php" method="post" class="last"
															onclick="openNav()">
															<button class="w3view-cart usericon " type="button"
																name="submit" value="">
																<i class="fa fa-user" aria-hidden="true"></i>
															</button><span
																style="bottom: 0px;display: flex;justify-content:center;"
																id="location"><?= $_SESSION['name'] ?></span>
														</form>
													</li>
												</a>
											</div>
											<?php
											} else {
												?>
											<a href="registered.php" id="sm_sign_up">
												<li class="userdiv" style="float: right;">
													<form action="registered.php" method="post" class="last">
														<button class="w3view-cart usericon " type="button" name="submit"
															value="">
															<i class="fa fa-user" aria-hidden="true"></i>
														</button><span
															style="bottom: 0px;display: flex;justify-content:center;font-weight: normal;"
															id="location">Sign up</span>
													</form>
												</li>
											</a>
											<a href="#myModal" data-toggle="modal" data-dismiss="modal">
												<li class="logindiv" style="float: right;">
													<form action="login.php" method="post" class="last">
														<button class="w3view-cart loginicon " type="button" name="submit"
															value="">
															<i class="fa fa-sign-in" aria-hidden="true"></i>
														</button><span
															style="bottom: 0px;display: flex;justify-content:center;font-weight: normal;"
															id="location">Log in</span>
													</form>
												</li>
											</a>
									</div>
									<?php
											}
											?>
								<div id="vsmall">
									<div id="xsmall">
										<a href="#">
											<li class="logindiv" style="float: right;">
												<form action="#" method="post" class="last">
													<?php if (isset($_SESSION['name'])) { ?>
														<button class="w3view-cart loginicon" type="button" name="submit"
															value="" onclick="openNav()">
															<i class="fa fa-user" aria-hidden="true"></i>
														</button>
														<span style="bottom: 0px;display: flex;justify-content:center;"
															id="location"> <?= $_SESSION['name'] ?>
														</span>
													<?php } else { ?>
														<button class="w3view-cart loginicon" type="button" name="submit"
															value="" onclick="location.href='login.php'">
															<i class="fa fa-sign-in" aria-hidden="true"></i>
														</button>
														<span style="bottom: 0px;display: flex;justify-content:center;"
															id="location">Log in</span><?php } ?>
												</form>
											</li>
										</a>
									</div>
									<div id=xxsmall>
										<a href="#">
											<li class="logindiv" style="float: right;">
												<form action="#" method="post" class="last">
													<?php if (isset($_SESSION['name'])) { ?>
														<button class="w3view-cart loginicon " type="button" name="submit"
															value="" onclick="openNav()">
															<i class="fa fa-user" aria-hidden="true"></i>
														</button>
														<span style="bottom: 0px;display: flex;justify-content:center;"
															id="location"><?php echo "You"; ?>
														</span>
													<?php } else { ?>
														<button class="w3view-cart loginicon " type="button" name="submit"
															value="" onclick="location.href='login.php'">
															<i class="fa fa-sign-in" aria-hidden="true"></i>
														</button>
														<span style="bottom: 0px;display: flex;justify-content:center;"
															id="location">
															Log in
														</span><?php } ?>
												</form>
											</li>
										</a>
									</div>
								</div>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!-- //close small div -->
		</div>
	</div>
	<!-- //header -->
	</div><!--DON'T KNOW WHEN IT STARTS
</div>
</div>-->
	<!-- navigation -->
	<div class="navbar navbar-inverse shadow_b" style="margin-bottom: 10px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12" style="padding: 0px">
					<div class="navbar-header">
						<button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"
							onclick="myFun(this)">
							<span class="icon-bar icon-bar1"></span>
							<span class="icon-bar icon-bar2"></span>
							<span class="icon-bar icon-bar3"></span>
						</button>
					</div>
					<div class="navbar-collapse collapse" id="mobile_menu" style="margin-top: 0px">
						<ul class="nav navbar-nav navbar-center">
							<li id="lg_side_active">
								<a href="#" style="margin-bottom: -10px;">
									<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
								</a>
							</li>
							<li id="homeactive" class="active"><a href="../Main/onestore.php"><i
										class="fa fa-home fa-lg"></i> Home</a></li>
							<?php
							if (isset($_SESSION['sid'])) {
								?>
								<li id="shopactive"><a href="../../store-admin/index.php?id=<?= $_SESSION['sid'] ?>"><i
											class="fas fa-lg fa-store"></i> Store</a></li>
								<?php
							}
							?>
							<li id="aboutactive"><a href="../Main/about.php"><i class="fa fa-lg fa-info-circle"></i>
									About</a></li>
							<li id="contactactive"><a href="../Main/contact.php"><i class="fa fa-lg fa-users"></i>
									Contact Us</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right navbar-center">
							<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
										class="glyphicon glyphicon-user"></span> Profile <span class="caret"></span></a>
								<ul class="dropdown-menu" style="border:1px solid #337ab7;padding: 0px">
									<?php
									if (!isset($_SESSION['id'])) {
										?>
										<a href="../Account/login.php">
											<li onmouseover="$(this).css('color','white')"
												onmouseleave="$(this).css('background-color','white')"
												style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
												<span class="fa fa-sign-in"></span>
												<span style="font-family: arial;font-weight: 700; "> Login</span>
											</li>
										</a>
										<hr style="margin:0;padding: 0">
										<a href="../Account/registered.php">
											<li onmouseover="$(this).css('color','white')"
												onmouseleave="$(this).css('background-color','white')"
												style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
												<span class="fa fa-user-plus"></span>
												<span style="font-family: arial;font-weight: 700; "> Sign Up</span>
											</li>
										</a>
										<?php
									} else if (isset($_SESSION['id'])) {
										?>
											<a href="../Order/myorders.php">
												<li onmouseover="$(this).css('color','white')"
													onmouseleave="$(this).css('background-color','white')"
													style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
													<span class="fas fa-shopping-bag"></span>
													<span style="font-family: arial;font-weight: 700; "> My Orders</span>
												</li>
											</a>
											<hr style="margin:0;padding: 0">
											<a href="../Order/orderhistory.php">
												<li onmouseover="$(this).css('color','white')"
													onmouseleave="$(this).css('background-color','white')"
													style="padding-bottom: 8px;;padding-top: 8px;">&nbsp;
													<span class="fas fa-history"></span>
													<span style="font-family: arial;font-weight: 700; "> Order history</span>
												</li>
											</a>
											<hr style="margin:0;padding: 0">
											<a href="../Account/edit_user_details.php">
												<li onmouseover="$(this).css('color','white')"
													onmouseleave="$(this).css('background-color','white')"
													style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
													<span class="fas fa-user-cog"></span>
													<span style="font-family: arial;font-weight: 700; "> Change details</span>
												</li>
											</a>
											<hr style="margin:0;padding: 0">
											<a href="../Account/logout.php">
												<li onmouseover="$(this).css('color','white')"
													onmouseleave="$(this).css('background-color','white')"
													style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
													<span class="fas fa-power-off"></span>
													<span style="font-family: arial;font-weight: 700; "> Log out</span>
												</li>
											</a>
										<?php
									}
									?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--</nav>-->
	<!--CHOOSE CATEGORY-->
	<section id="popup1" style="width: fit-content;">
		<div class="multi-gd-img">
			<ul class="multi-column-dropdown">
				<h6>Choose Category</h6>
				<li id="">
					<!--pop up location-->
					<div style="width: 100%">
						<p><input type="radio" name="sel-category" id="Personal care" value="1">
							<img src="../../images/caticon/care.png" style="height: 30px;width:auto;">
							<label for="Personal care">Personal care</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id=" Food and Groceries" value="2">
							<img src="../../images/caticon/grocery.png" style="height: 30px;width:auto;">
							<label for=" Food and Groceries"> Food and Groceries</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id="Mobile" value="3">
							<img src="../../images/caticon/mobile.png" style="height: 30px;width:auto;">
							<label for="Mobile">Mobile</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id="Fasion" value="4">
							<img src="../../images/caticon/fasion.png" style="height: 30px;width:auto;">
							<label for="Fasion">Fasion</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id="Home" value="5">
							<img src="../../images/caticon/home.png" style="height: 30px;width:auto;">
							<label for="Home">Home</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id="Electronics" value="6">
							<img src="../../images/caticon/electronics.png" style="height: 30px;width:auto;">
							<label for="Electronics">Electronics</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id="Toys and Baby" value="7">
							<img src="../../images/caticon/toys&baby.png" style="height: 30px;width:auto;">
							<label for="Toys and Baby">Toys and Baby</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id="Sports" value="8">
							<img src="../../images/caticon/sports.png" style="height: 30px;width:auto;">
							<label for="Sports">Sports</label>
						</p>
						<hr>
						<p><input type="radio" name="sel-category" id="Beauty" value="9">
							<img src="../../images/caticon/beauty.png" style="height: 30px;width:auto;">
							<label for="Beauty">Beauty</label>
						</p>
						<hr>
					</div>
					<!--pop up set location-->
				</li>
			</ul>
		</div>
	</section>
	<!--CHOOSE CATEGORY-->
	<!--LOCATION ACCESS-->
	<section id="popup2">
		<div class="multi-gd-img">
			<ul class="multi-column-dropdown">
				<h6>Your Location</h6>
				<li>
					<input type="tel" class="locmark" name="pincode" id="pincode" placeholder="PIN">
					<button type="button" name="pin" class="locbtn" onclick="locate()"><i class="fa fa-search"></i>
					</button>
				</li>
				<li style="display: none;" id="setloc">
					<!--pop up location-->
					<span class="popuptext" id="myPopup">
						<select name="po_list" class="locmark" id="po_list">
							<option value="0" selected="" disabled="">location</option>
						</select>
					</span>
					<!--pop up set location-->
					<button class="popuptext locbtn" type="button" name="pin" onclick="setlocation()">
						<i class="fa fa-check"></i>
					</button>
				</li>
			</ul>
		</div>
	</section>
	<!--LOCATION ACCESS-->
	<!--SIDE NAV BAR-->
	<div id="mySidenav" class="sidenav scroll_handle_blue"
		style="z-index: 99999999;padding-top: 0px;overflow-y: scroll;">
		<a style="text-decoration:none;background-color: white;color: black">
			<i class="fas fa-user-circle fa-2x"><span style="font-family: arial;font-weight: bold;font-size: 22px">
					Hello,
					<?php if (isset($_SESSION['name'])) { ?>
						<span> <?= $_SESSION['name'] ?></span>
					<?php } else { ?>
						<span>Log in<?php } ?></span></span>
			</i>
		</a><br>
		<!--////////////////////////////////////////////////#1#/////////////////////////////////////////////////////////////////-->
		<a class="side_nav_content_header" href="#" style="color: #fe9126"> <i class="fa fa-sm fa-shopping-cart"
				style="color:white "></i> Shop By Category</a>
		<button class="dropdown-btn  category_side_head" id="list_enda"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Personal care
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container  side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=1&subcategory_id=1" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px; ">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Body Lotions</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=1&subcategory_id=2" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Femini</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=1&subcategory_id=3" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Foot Care</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=1&subcategory_id=4" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Hair Care</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=1&subcategory_id=5" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Make Up</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=1&subcategory_id=6" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Mouth Care</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#2#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endb"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Food & Groceries
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=7"
				style="width: 100%;padding: 0px;padding-top: 37px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px; ">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Canned and Jarred Food </span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=8" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Ceral and Muesli</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=9" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Coffee,Tea and Beverages</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=10" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Meat,Poultry and Seafood</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=11" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Pasta and Noodles</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=12" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Dried Fruits,Nuts and Seeds</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=13" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Rice,Flour and Pulses</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=14" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Snack Foods</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=2&subcategory_id=15" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Sweets, Choclate and Gum</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#3#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endc"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Mobile
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=3&subcategory_id=16"
				style="width: 100%;padding: 0px;padding-top: 74px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Smart Phone</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=3&subcategory_id=17" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Basic Mobile</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#4#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endd"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Fasion
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=4&subcategory_id=18"
				style="width: 100%;padding: 0px;padding-top: 111px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Clothing</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=4&subcategory_id=19" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Jwellery</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=4&subcategory_id=20" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Watches</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=4&subcategory_id=21" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Shoes</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=4&subcategory_id=22" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Eye Wear</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=4&subcategory_id=23" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Handbags and Clutches</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#5#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_ende"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Home
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=5&subcategory_id=24"
				style="width: 100%;padding: 0px;padding-top: 148px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Kitchen Appliances</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=5&subcategory_id=25" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Home Appliances</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=5&subcategory_id=26" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Heating Cooling and Air Quality</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#6#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endf"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Electronics
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=6&subcategory_id=27"
				style="width: 100%;padding: 0px;padding-top: 185px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Laptops and Accessories</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=6&subcategory_id=28" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> TV and Home Entertainment</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=6&subcategory_id=29" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Audio</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=6&subcategory_id=30" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Cameras</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=6&subcategory_id=31" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Computer Pheripherals</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#7#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endg"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Toys and Baby
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=7&subcategory_id=32"
				style="width: 100%;padding: 0px;padding-top: 222px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Baby Care</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=7&subcategory_id=33" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Baby Clothing</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=7&subcategory_id=34" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Baby Safety</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=7&subcategory_id=35" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Baby Shoes</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=7&subcategory_id=36" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Diappering and Nappy</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=7&subcategory_id=37" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Feeding</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=7&subcategory_id=38" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Toddler Toys</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#8#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endh"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Sports
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=39"
				style="width: 100%;padding: 0px;padding-top: 259px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Cricket</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=40" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Badminton</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=41" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Excercise and Fitness</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=42" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Running</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=43" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Camping and Hiking</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=44" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Cycling</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=45" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Football</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=46" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Tennis</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=47" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Swimming</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=8&subcategory_id=48" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Sport Shoes</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#9#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endi"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Beauty
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="../Product/products_limited.php?category_id=9&subcategory_id=49"
				style="width: 100%;padding: 0px;padding-top: 296px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Bath and Body</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=9&subcategory_id=50" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Fragrance</span>
				</li>
			</a>
			<a href="../Product/products_limited.php?category_id=9&subcategory_id=53" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Skin Care</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#10#/////////////////////////////////////////////////////////////////-->
		<button class="dropdown-btn category_side_head" id="list_endj"
			style="width: 100%;float: left;padding-left: 0px;"><a href="#" style="color: white;"> Appliances
				<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first">
			<a href="#" style="width: 100%;padding: 0px;padding-top: 333px;">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
			<a href="#" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
			<a href="#" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
			<a href="#" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')"
					onmouseleave="$(this).css('background-color','white')"
					style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
		</div>
		<!--////////////////////////////////////////////////#EXTRAS#/////////////////////////////////////////////////////////////////-->
		<!--////////////////////////////////////////////////#EXTRAS#/////////////////////////////////////////////////////////////////-->
		<!--////////////////////////////////////////////////#END#/////////////////////////////////////////////////////////////////-->
		<!--
		<button class="dropdown-btn category_side_head" id="list_endk" style="width: 100%;float: left;padding-left: 0px;display: none;"><a href="#" style="color: white;"> Unknown
			<i class="fa fa-caret-down"></i></a>
		</button>
		<div class="dropdown-container side_drop_li_main slide_drop_li_main_first" style="display: none;">
			<a href="#" style="width: 100%;padding: 0px;padding-top: 111px;">
				<li class="side_drop_li"  onmouseover="$(this).css('color','white')" onmouseleave="$(this).css('background-color','white')" style="padding-bottom: 8px;padding-top: 8px;margin-top:22px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
			<a href="#" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')" onmouseleave="$(this).css('background-color','white')" style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
			<a href="#" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')" onmouseleave="$(this).css('background-color','white')" style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
			<a href="#" style="width: 100%;padding: 0px">
				<li class="side_drop_li" onmouseover="$(this).css('color','white')" onmouseleave="$(this).css('background-color','white')" style="padding-bottom: 8px;padding-top: 8px;">&nbsp;
					<span class="fa fa-arrow-right"></span>
					<span style="font-family: arial;font-weight: 700; "> Unknown</span>
				</li>
			</a>
		</div>
-->
		<div id="side_cat_list_end_default" style="margin-top: 370px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_enda" style="display: none;margin-top: 333px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endb" style="display: none;margin-top: 296px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endc" style="display: none;margin-top: 259px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endd" style="display: none;margin-top: 222px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_ende" style="display: none;margin-top: 185px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endf" style="display: none;margin-top: 148px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endg" style="display: none;margin-top: 111px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endh" style="display: none;margin-top: 74px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endi" style="display: none;margin-top: 37px;"></div><!--n+4 breaks 37px difference-->
		<div id="side_cat_list_endj" style="display: none;margin-top: 0px;"></div><!--n+4 breaks 37px difference-->
		<a class="side_nav_content_end" id="side_nav_content_end_line" href="#"></a><br>
		<a class="side_nav_content_header" href="#" style="color: #fe9126"> <i class="fa fa-sm fa-cog"
				style="color:white "></i> Help & Settings</a>
		<?php
		if (isset($_SESSION['id'])) {
			?>
			<a class="side_nav_content_head" href="../Account/edit_user_details.php">My Account</a>
			<a class="side_nav_content_head" href="../Order/myorders.php">My orders</a>
			<?php
		}
		?>
		<a class="side_nav_content_head" href="../Main/about.php">About</a>
		<a class="side_nav_content_head" href="../Main/contact.php">Contact</a>
		<?php
		if (!isset($_SESSION['id'])) {
			?>
			<a class="side_nav_content_head" onclick="closeNav()" href="#myModal" data-toggle="modal"
				data-dismiss="modal">Sign In</a>
			<?php
		} else {
			?>
			<a class="side_nav_content_head" href="../Account/logout.php">Log out</a>
			<?php
		}
		?>
		<a class="side_nav_content_end" href="#"></a>
	</div>
	<!--SIDE-BAR-DIV #fe9126,#02171e,#337ab7-->
	<!--<div id="main_all" style="padding: 0px;margin: 0px;left: 0px;right: 0px">-->
	<!--SIDE-BAR-DIV-->