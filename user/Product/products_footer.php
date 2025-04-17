<!--<marquee style="font-weight: bold;">I <i style="color: red" class="fa fa-heart"></i> U <span style="color: red">KICHUZ</span></marquee>-->
<!-- //footer -->
<style type="text/css">
	.modal-guts {
		position: absolute !important;
		top: 0 !important;
		left: 0 !important;
		width: 100% !important;
		height: 100% !important;
	}

	.modal-overlay {
		z-index: 1040 !important;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		background-color: white;
		border-top-right-radius: 10px;
		border-top-left-radius: 10px;
		border: none;
	}

	.modal-content {
		background-color: transparent !important;
		box-shadow: none;
		border: none;
	}

	.modal-footer {
		border-bottom-right-radius: 10px;
		border-bottom-left-radius: 10px;
	}

	@media(max-width: 767px) {
		.modal-dialog {
			margin-top: 50px;
			width: 90% !important;
			margin-left: 5% !important;
		}

		.modal-content {
			width: 100% !important;
		}
	}
</style>
<div class="footer">
	<div class="container">
		<div class="w3_footer_grids">
			<div class="col-md-3 col-sm-6 w3_footer_grid">
				<h3>Contact</h3>
				<ul class="address">
					<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Thrissur</li>
					<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a
							href="mailto:onestoreforallyourneeds@gmail.com">onestore</a></li>
					<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+91 8113990368</li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-6 w3_footer_grid">
				<h3>Information</h3>
				<ul class="info">
					<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.php">About Us</a></li>
					<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="contact.php">Contact Us</a></li>
					<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="terms&conditions.php">T&C</a></li>
					<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="privacy.php">Privacy Policy</a>
					</li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-6 w3_footer_grid">
				<h3>Profile</h3>
				<ul class="info">
					<?php
					if (isset($_SESSION['name'])) {
						?>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="cart.php">My Cart</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="wishlist.php">Wishlist</a></li>
						<?php
					}
					if (!isset($_SESSION['name'])) {
						?>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="login.php">Login</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="registered.php">Create Account</a>
						</li>
						<?php
					}
					?>
					<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="faq.php">FAQ</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-6 w3_footer_grid">
				<h3 class="title">Newsletter</h3>
				<div class="newsletter">
					<p style="text-align: justify;">
						Send your email to us, so that we can let you know about our latest updates.
					</p>
					<form method="post" name="sendmail" action="#">
						<input name="cntemail" id="nlmail" class="form-control" type="email"
							placeholder="Your email here">
						<button type="button" class="btn" onclick="nlcheckmail()">Submit</button>
					</form>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="footer-copy">
		<div class="container">
			<p>© 2020 OneStore. All rights reserved | <a id="me" onmouseover="$('#me').css('color','#0c99cc')"
					onmouseleave="$('#me').css('color','#fe9126')" href="www.one-store.com">KinGsHearTz</a></p>
		</div>
	</div>
</div>
<link rel="stylesheet" href="../../css/font-awesome.min.css">
<div class="footer-botm">
	<div class="container">
		<div class="w3layouts-foot">
			<ul>
				<li><a href="https://www.facebook.com/falconsinfoworld/" target="_blank" class="w3_agile_facebook"><i
							class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="https://www.instagram.com/_k_i_n_g_s_h_e_a_r_t_z/" target="_blank"
						class="w3_agile_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="https://twitter.com/GovindA20531879" target="_blank" class="w3_agile_twitter"><i
							class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<li><a href="#" data-toggle="modal" data-target="#myModal_share_apk" onclick="copyapklink()"
						class="w3_agile_android" style=><i class="fa fa-android" aria-hidden="true"></i></a></li>
			</ul>
		</div>
		<div class="payment-w3ls">
			<img src="../../images/card.png" alt=" " class="img-responsive">
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //footer -->
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!---------------------------------------------SINGLE ITEM---------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!--///////////////////////////SHARE APK////////////////////////////////////////////////////////////////////////////////-->
<!------------------------------------------------------------------------------------------------------------------------------>
<!--SHARE APK-->
<!-- Modal -->
<div class="modal fade" id="myModal_share_apk" role="dialog" onclose="$('.yw').click();" style="height: 95%;">
	<div class="modal-dialog modal-m" style="background-color: white;border-radius: 7px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header item_share_header"
				style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #004114), color-stop(1, #309700)) !important;">
				<button type="button" class="close" data-dismiss="modal" onclick="$('.yw').click();">&times;</button>
				<h4 class="modal-title">
					<span class="fa fa-info-circle fa-lg" style="color: #fff;"></span>
					<span style="color: #fff"> Share Apk <i class="fa fa-android"></i></span>
				</h4>
			</div>
			<div class="modal-body">
				<center>
					<div
						style="background-color: rgba(255,255,255);padding: 10px;display: inline-block;border-radius: 50%;margin-top: 0px;border:3px solid #018a2a;height:100px;width">
						<img src="../../images/logo/logofullfill.png" style="max-width: 80px;height:70px;">
					</div>
				</center>
				<div style="display: none;margin-top: 20px;" class="alert alert-danger"></div>
				<form action="#" method="post" enctype="multipart/form-data">
					<table style="background-color: #fff;width: 100%" class="create_wishlist_table">
						<tr>
							<td>
								<h4>
									Here is your link<span style="color: #c50505">*</span>
								</h4>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group bar-srch"
									style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 0px;">
									<input readonly="true" type="text" class="" id="input_apk_link"
										placeholder="URL to share"
										value="http://localhost:81/One-Store-Renewed/onestore-website/extras/APK/RELEASE/OneStore_version_high.apk"
										name="" required=" "
										style="width: 100%;margin: 0px;z-index: 0;border-radius: 3px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;outline-color: #e59700;">
									<span id="" class="input-group-btn">
										<button id="copy_wl" onclick="apkclipboard()"
											style="color: white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #004114), color-stop(1, #309700)) !important;padding-top:10px;padding-bottom: 10px;outline: none;border-radius: 0;border-bottom-right-radius: 3px;border-top-right-radius: 3px;"
											class="btn btn-default search_btn" type="button"><span
												class="fas fa-copy"></span></button>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<td>
						<tr>
							<td>
								<h4>
									Share via<span style="color: #c50505">*</span>
								</h4>
							</td>
						</tr>
						<tr>
							<td>
								<table style="width: 100%;">
									<tr style="overflow-x: scroll;">
										<td class="social-share whatsapp_apk" style="text-align: left;">
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<h4>
									Choose a device<span style="color: #c50505">*</span>
								</h4>
							</td>
						</tr>
						<tr>
							<td>
								<table style="width: 100%;">
									<tr style="overflow-x: scroll;">
										<td class="social-share " style="text-align: left;">
											<div onclick="$('.apk').removeClass('selected');$(this).addClass('selected');copyapklink(1)"
												class="apk"
												style="margin-left:20px;width: 30px;height: 30px;background-color: #1da1f2;border-radius:3px;display: flex;align-items: center;justify-content: center;">
												<i class="fa fa-mobile fa-lg" style="color: white;"></i>
											</div>
											<p><i class="fa fa-arrow-up" style="color:#348f00"></i> Android 9</p>
										</td>
										<td class="social-share " style="text-align: left;">
											<div onclick="$('.apk').removeClass('selected');$(this).addClass('selected');copyapklink(2)"
												class="apk"
												style="margin-left:20px;width: 30px;height: 30px;background-color: #0077af;border-radius:3px;display: flex;align-items: center;justify-content: center;">
												<i class="fa fa-mobile fa-lg" style="color: white;"></i>
											</div>
											<p><i class="fa fa-arrow-up" style="color:#348f00"></i> Android 6.1</p>
										</td>
										<td class="social-share" style="text-align: center;">
											<div class="downloadapk" onclick="downloadapk()"
												style="margin:auto;width: max-content;height: 30px;background-color: #ff6600;border-radius:3px;display: flex;align-items: center;justify-content: center;padding-left:20px;padding-right:20px">
												<i class="fa fa-download fa-lg" style="color: white;"> Download</i>
											</div>
											<p></p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"
					onclick="$('.yw').click();">Close</button>
			</div>
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------>
<script>
	function apkclipboard() {
		var copyText = document.getElementById("input_apk_link");
		var link = $('#input_apk_link').val();
		if (link == "" || link == null) {
			swal({
				title: "Sorry!!!",
				text: "No device selected !",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
		}
		else {
			copyText.select();
			copyText.setSelectionRange(0, 999999)
			document.execCommand("copy");
			toastr.success('Link copied :- ' + copyText.value);
		}
	}
	function downloadapk() {
		var link = $('#input_apk_link').val();
		if (link == "" || link == null) {
			swal({
				title: "Sorry!!!",
				text: "No device selected !",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
		}
		else {
			window.open('' + link + '', '_blank');
		}
	}
	function copyapklink(n) {
		if (n == 1) {
			var link = "http://localhost:81/One-Store-Renewed/onestore-website/extras/APK/RELEASE/OneStore_version_high.apk";
		}
		else if (n == 2) {
			var link = "http://localhost:81/One-Store-Renewed/onestore-website/extras/APK/RELEASE/OneStore_version_low.apk";
		}
		else {
			var link = "http://localhost:81/One-Store-Renewed/onestore-website/extras/APK/RELEASE/OneStore_version_low.apk";
		}
		$('#input_apk_link').val(link);
		///////////WHATSAPP///////////
		$('.whatsapp_apk').html('');
		var wa_content = '<div style="margin-left:15px;width: 30px;height: 30px;background-color: darkgreen;border-radius:3px;display: flex;align-items: center;justify-content: center;"><a target="_blank" data-action="share/whatsapp/share" href="https://api.whatsapp.com/send?text=Download Apk Now :- ' + link + '"><i class="fa fa-whatsapp fa-lg" style="color: white;"></i></a></div><p>Whatsapp</p>';
		$('.whatsapp_apk').html(wa_content);
	}
</script>
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!---------------------------------------------LOG IN--FORM--------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="myModal" role="dialog"
	style="width: 100%; height:100% ;background-color: rgba(0,0,0,.80) !important;">
	<div class="modal-dialog" style="width: 70%;height: 70%;">
		<!-- Modal content-->
		<div class="modal-content" style="width: 70%,height:70%;background-color:white;">
			<div class="modal-header" style="padding: 0px;min-height: 0px;border:0px;">
				<button type="button"
					style="font-size: 2.2em;margin-right: -20px;margin-top: -20px;opacity: unset;outline: none;color: white"
					class="close" data-dismiss="modal"><img src="../../images/close.png" alt="close"></button>
			</div>
			<div class="modal-body" style="padding:0px;height: 100%;">
				<div class="col-md-12">
					<div class="col-md-12" style="padding: 0px;height: 100%;background-color: white">
						<form name="signin_form" id="signin_form">
							<div class="col-md-12" style="padding: 0px;height: 100%;background-color: white">
								<div class="col-md-6 hidden-xs no-padding" style="padding:0px;height: 70%"><img
										class="img-responsive"
										style="padding: 0px;padding-top: 0px;height: 400px;position: relative;"
										src="../../images/logo/store.jpg">
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<br>
										<img src="../../images/logo/logost.svg" height="50px"><i
											style="font-size: 1.6em;font-weight: bolder;font-family: sans-serif;font-style: normal;">
											Log in</i><br>
										<p id="emppass" style="color: red;position: relative;top: 45px;display: none;">
										</p><br><br>
										<input type="email" class="form-control md-brdr" id="mobile" name="mobile"
											placeholder="Email ID" required>
										<input type="hidden" id="valchg">
									</div>
									<p class="capson_warning" style="display: none;float:left;color: #d9534f"><i
											class="fa fa-warning"></i> &nbsp;WARNING! Caps lock is ON.</p>
									<div id="passdiv" style="display: block;background-color: white">
										<div class="form-group">
											<input type="password" class="form-control  md-brdr password_fields"
												pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
												title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
												required=" " placeholder="Enter  Password" name="password" id="pwd"
												required>
										</div>
									</div>
									<div class="col-md-12">
										<a href="#" data-toggle="modal" data-dismiss="modal" style="color: black">
											<button type="button" onclick="forgottenpass()"
												style="background-color: transparent;border: none;"
												class="frgt-pswrd">Forgot Password?</button>
										</a>
										<br><br><br>
										<button onclick="signin()" type="button"
											class="btn btn-primary btn-full mgbtm15 real_btn">LOGIN</button>
										<button type="button" style="display:none"
											class="btn btn-primary btn-full mgbtm15 load_btn"><i
												class="fa fa-refresh fa-spin"></i> LOGIN</button>
										<a href="registered.php"> <button type="button"
												class="btn btn-danger btn-full mgbtm15" onclick="signup()">Sign
												Up</button></a><br><br>
										<!--<a href="registered.php" data-toggle="modal" data-dismiss="modal"> <button type="button" class="btn btn-danger btn-full mgbtm15" onclick="signup()" data-dismiss="modal">Sign Up</button></a>-->
									</div>
								</div>
							</div>
						</form>
						<div class="pop-btm-fx">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////----->
<!-- Detail about shops--><!--ADD TO CART-->
<div id="avail_stores" tabindex="-1" role="dialog" aria-labelledby="store_title" class="modal modal-xl hidescroll"
	style="height: 90%;position:fixed">
	<div class="modal-dialog modal-xl" style="height: 90%;">
		<div class="modal-content" style="height: 90%;" style="border-bottom-left-radius: 10px">
			<div class="modal-overlay" id="modal-overlay">
				<div class="modal-header shadow_b"
					style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #007ab7), color-stop(1, #01728e)) !important;color: white">
					<button type="button" class="close" data-dismiss="modal"
						style="outline: none;background-color: white;opacity: unset;color: red;margin-top: 0px;font-size: 2.3em;border-radius: 5px;padding-left:5px;padding-right: 5px; ">&times;</button>
					<h3 id="store_title" class="modal-title">Available Stores</h3>
				</div>
			</div>
			<div class="modal-guts scroll_handle_orange" style="border-bottom-left-radius: 10px">
				<div class="model-body" id="multi_store_listing"
					style="overflow-x: scroll;margin-top: 50px;background-color: white"><br>
					<table id="store" cellspacing="50px" cellpadding="20px" width="100%" class="single_product_info"
						border="5px" style="overflow-x: scroll;border: 5px ;border-radius: 10px;">
						<tbody>
							<tr
								style="border-left:white;border-right:white;border-top:white;border-left:none;border:0px;border-top: none;border-right: none;">
								<td colspan="9">
									<button type="button" onclick="sortTable(3)"
										style="float: left;color: white;background-color: #F08200;border-radius: 5px;border:#ffffff"
										name="button">Sort by Distance</button>
									<button type="button" onclick="sortTable(2)"
										style="float: left;color: white;background-color: #F08200;margin-left:3px;border-radius: 5px;border:#ffffff"
										name="button">Sort by Price</button>
								</td>
							</tr>
							<tr
								style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;color: white">
								<th style="border: none;text-align:center" class="view_avail_stores">Select</th>
								<th style="border: none;text-align:center" class="view_avail_stores">Store Name </th>
								<th style="border: none;text-align:center" class="view_avail_stores">Price </th>
								<th style="border: none;text-align:center" class="view_avail_stores">Distance(KM) </th>
								<th style="border: none;text-align:center" class="view_avail_stores">Direction </th>
							</tr>
							<div id="multi_store_response" style="display:none">
								<br>
								<div style="display:flex;justify-content:center;align-items:center">
									<img src="../../images/logo/not-avail.png"
										style="max-height:150px;width:auto;clear:both">
									<h3 style="clear:both;font-size:20px">&nbsp;&nbsp;No result found</h3>
								</div>
								<br>
							</div>
						</tbody>
					</table>
					<div class="m-sing" id="per"
						style="background-color: #f2f2f2;color:black;padding-top: 7px;padding-bottom: 7px;;">
						<div class="px-3">
							<h4 class="m-sing">
								<span
									style='font-family: arial;color:#07C103;font-weight: bold;text-decoration: none;font-size:15px'>You
									Save &#8377; <span id="save"
										style="text-decoration: none;font-weight: bold;color: #07C103;padding-left: 0px"></span>
									(<span
										style="text-decoration: none;font-weight: bold;color: #07C103;padding-left: 0px"
										id="off"></span>%)</span>
								<br><br>
								<ul id="item_detailed_features" style="padding-left:10px;margin:0;">
									<li style="font-weight:normal;font-size: 14px;">Item remaing : <span
											style="text-decoration: none;font-weight:normal;font-family:arial"
											id="dis_qnty"></span> only</li>
									<li style="font-weight: normal;font-size: 14px;">Availability : <span
											style="text-decoration: none;font-weight:normal;" id="dis_avail"></span>
									</li>
									<li style="font-weight:normal;font-size: 14px;">Status : <span
											style="text-decoration: none;font-weight:normal;" id="dis_sts"></span></li>
									<li style="font-weight:normal;font-size: 14px;">Address : <span
											style="text-decoration: none;font-weight:normal;" id="dis_add"></span></li>
									<div id="addfeature"></div>
								</ul>
								<input type="hidden" value="" id="idid_keeper" />
							</h4>
							<button
								style="height: 45px;width:100%;border-color: white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;color: white;border-radius:7px;outline: none; "
								onclick="check_store_select()"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO CART</button>
						</div>
					</div>
				</div>
				<div class="modal-footer"
					style=" background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #007ab7), color-stop(1, #01728e)) !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal"
						style="outline: none;font-size: 1.2em;">Close <i style="color: red"
							class="fa fa-times-circle"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->
<!-- Detail about shops--><!--ADD TO WISHLIST-->
<div id="avail_stores_wishlist" tabindex="-1" role="dialog" aria-labelledby="store_title"
	class="modal fade modal-xl hidescroll" style="height: 90%;">
	<div class="modal-dialog modal-xl" style="height: 90%;">
		<div class="modal-content" style="height: 90%;" style="border-bottom-left-radius: 10px">
			<div class="modal-overlay" id="modal-overlay">
				<div class="modal-header shadow_b"
					style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #007ab7), color-stop(1, #01728e)) !important;)) !important;color: white">
					<button type="button" class="close" data-dismiss="modal"
						style="outline: none;background-color: white;opacity: unset;color: red;margin-top: 0px;font-size: 2.3em;border-radius: 5px;padding-left:5px;padding-right: 5px; ">&times;</button>
					<h3 id="store_title" class="modal-title">Available Stores</h3>
				</div>
			</div>
			<div class="modal-guts scroll_handle_orange" style="border-bottom-left-radius: 10px">
				<div class="model-body " style="overflow-x: scroll;margin-top: 50px;background-color: white"><br>
					<table id="wishlist_store" cellspacing="50px" cellpadding="20px" width="100%"
						class="single_product_info" border="5px"
						style="overflow-x: scroll;border: 5px ;border-radius: 10px;">
						<tbody>
							<tr
								style="border-left:white;border-right:white;border-top:white;border-left:none;border:0px;border-top: none;border-right: none;">
								<td colspan="9">
									<button type="button" onclick="sortTable(3)"
										style="float: left;color: white;background-color: #F08200;border-radius: 5px;border:#ffffff"
										name="button">Sort by Distance</button>
									<button type="button" onclick="sortTable(2)"
										style="float: left;color: white;background-color: #F08200;margin-left:3px;border-radius: 5px;border:#ffffff"
										name="button">Sort by Price</button>
								</td>
							</tr>
							<tr
								style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;color: white">
								<th style="border: none;text-align:center" class="view_avail_stores">Select</th>
								<th style="border: none;text-align:center" class="view_avail_stores">Store Name </th>
								<th style="border: none;text-align:center" class="view_avail_stores">Price </th>
								<th style="border: none;text-align:center" class="view_avail_stores">Distance(KM) </th>
								<th style="border: none;text-align:center" class="view_avail_stores">Direction </th>
							</tr>
							<div id="wishlist_multi_store_response" style="display:none">
								<br>
								<div style="display:flex;justify-content:center;align-items:center">
									<img src="../../images/logo/not-avail.png"
										style="max-height:150px;width:auto;clear:both">
									<h3 style="clear:both;font-size:20px">&nbsp;&nbsp;No result found</h3>
								</div>
								<br>
							</div>
						</tbody>
					</table>
					<div class="m-sing" id="per2"
						style="background-color: #f2f2f2;color:black;padding-top: 7px;padding-bottom: 7px;;">
						<div class="px-3">
							<h4 class="m-sing">
								<span
									style='font-family: arial;color:#07C103;font-weight: bold;text-decoration: none;font-size:15px'>You
									Save &#8377; <span id="save2"
										style="text-decoration: none;font-weight: bold;color: #07C103;padding-left: 0px"></span>
									(<span
										style="text-decoration: none;font-weight: bold;color: #07C103;padding-left: 0px"
										id="off2"></span>%)</span>
								<br><br>
								<ul id="wishlist_item_detailed_features" style="padding-left:10px">
									<li style="font-weight:normal;font-size: 14px;">Item remaing : <span
											style="text-decoration: none;font-weight:normal;font-family:arial"
											id="dis_qnty2"></span> only</li>
									<li style="font-weight: normal;font-size: 14px;">Availability : <span
											style="text-decoration: none;font-weight:normal;" id="dis_avail2"></span>
									</li>
									<li style="font-weight:normal;font-size: 14px;">Status : <span
											style="text-decoration: none;font-weight:normal;" id="dis_sts2"></span></li>
									<li style="font-weight:normal;font-size: 14px;">Address : <span
											style="text-decoration: none;font-weight:normal;" id="dis_add2"></span></li>
									<div id="wishaddfeature"></div>
								</ul>
								<input type="hidden" value="" id="wishlist_idid_keeper" />
							</h4>
							<button class="wishlist_btn" style="height: 45px;width:100%;border-color: white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #002b41), color-stop(1, #004f63)) !important;
color: white;border-radius:7px;outline: none;" onclick="wishlist_check_store_select()" class="element_cart"
								type="button" data-dismiss="modal" data-toggle="modal" data-target="#wishlist_avail">
								SELECT STORE <i class="fa fa-arrow-right"></i></i></button>
						</div>
					</div>
				</div>
				<div class="modal-footer"
					style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #007ab7), color-stop(1, #01728e)) !important;">
					<button type="button" class="btn btn-default" data-dismiss="modal"
						style="outline: none;font-size: 1.2em;">Close <i style="color: red"
							class="fa fa-times-circle"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------------------->
<!-- Detail about lists--><!--ADD TO WISHLIST-->
<?php
if (isset($_SESSION['id'])) {
	$result = $pdo->query("select * from wishlist where user_id=" . $_SESSION['id']);
	$status = 0;
	?>
	<div id="wishlist_avail" tabindex="-1" role="dialog" aria-labelledby="store_title"
		class="modal fade modal-xl hidescroll" style="height: 90%;">
		<div class="modal-dialog modal-xl" style="height: 90%;">
			<div class="modal-content" style="height: 90%;" style="border-bottom-left-radius: 10px">
				<div class="modal-overlay" id="modal-overlay">
					<div class="modal-header shadow_b" style="background-color: #337ab7;color: white">
						<button type="button" class="close" data-dismiss="modal"
							style="outline: none;background-color: white;opacity: unset;color: red;margin-top: 0px;font-size: 2.3em;border-radius: 5px;padding-left:5px;padding-right: 5px; ">&times;</button>
						<h3 id="store_title" class="modal-title">Your Wishlists</h3>
					</div>
				</div>
				<div class="modal-guts scroll_handle_orange" style="border-bottom-left-radius: 10px">
					<div class="model-body " style="overflow-x: scroll;margin-top: 50px;background-color: white"><br>
						<table id="list_wishlist" cellspacing="50px" cellpadding="20px" width="100%"
							class="single_product_info" border="5px"
							style="overflow-x: scroll;border: 5px ;border-radius: 10px;">
							<?php
							$rows = $result->rowCount();
							if (!is_null($rows) && $rows > 0) {
								?>
								<tr style="background-color: #22374e;color: white">
									<th style="border: none;" class="view_avail_stores">Select</th>
									<th style="border: none;" class="view_avail_stores">List Name </th>
									<th style="border: none;" class="view_avail_stores">Privacy </th>
									<th style="border: none;" class="view_avail_stores">item count </th>
									<th style="border: none;" class="view_avail_stores">Created on </th>
								</tr>
								<?php
								while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
									$sql_wish1 = 'select count(wishlist_id) as item_count FROM wishlist_items WHERE wishlist_id=:wish_id ';
									$stmt_wish1 = $pdo->prepare($sql_wish1);
									$stmt_wish1->execute(array(':wish_id' => $row['wishlist_id']));
									$row_wish1 = $stmt_wish1->fetch(PDO::FETCH_ASSOC);
									?>
									<tr>
										<td style="padding: 0px;margin: 0px;">
											<button id="list_btn<?= $row['wishlist_id'] ?>"
												style="height: 45px;width:100%;border-color: white;background-color:#006904;color: white;border-radius:7px;outline: none;display:unset; "
												onclick="wishlist_check_list_select(<?= $row['wishlist_id'] ?>)">Add <i
													class="fa fa-heart"></i></button>
										</td>
										<td style="background-color: white" class="view_avail_stores"><?= $row['list_name'] ?></td>
										<td style="background-color: white" class="view_avail_stores"><?= $row['privacy'] ?></td>
										<!--<td id="Q<?= $store_id ?>"><?//=$row['quantity'] ?></td>-->
										<td style="background-color: white" id="wish_cnt_<?= $row['wishlist_id'] ?>"
											class="view_avail_stores"><?= $row_wish1['item_count'] ?></td>
										<?php
										$dateofcreate = explode('-', $row['date']);
										$day = $dateofcreate[1] . "/" . $dateofcreate[2] . "/" . substr($dateofcreate[0], 2);
										?>
										<td style="background-color: white" class="view_avail_stores"><?= $day ?></td>
									</tr>
									<?php
								}
								$status = 1;
							}
							if ($status == 0) {
								?>
								<br>
								<div style="display:flex;justify-content:center;align-items:center">
									<img src="../../images/logo/wishlist1.png" style="max-height:150px;width:auto;clear:both">
									<h3 style="clear:both;font-size:20px">&nbsp;&nbsp;No result found</h3>
								</div>
								<br>
								<?php
							}
							?>
						</table>
					</div>
					<div class="modal-footer" style="background-color: white">
						<button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal"
							data-target="#avail_stores_wishlist"
							style="outline: none;font-size: 1.2em;float:left;background-color:#22374e"><i
								style="color: #fff" class="fa fa-arrow-left fa-lg"></i></button>
						<button type="button" class="btn btn-default" data-dismiss="modal"
							style="outline: none;font-size: 1.2em;">Close <i style="color: red"
								class="fa fa-times-circle"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
<!-------------------------------------JAVA SCRIPT FUNCTIONS BEGIN------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<script>
	lens_cnt = 0;
	function imageZoom(imgID, resultID) {
		var img, lens, result, cx, cy;
		img = document.getElementById(imgID);
		result = document.getElementById(resultID);
		/*create lens:*/
		if (lens_cnt == 0) {
			lens = document.createElement("DIV");
			lens.setAttribute("class", "img-zoom-lens");
			lens_cnt = 1;
			/*insert lens:*/
			img.parentElement.insertBefore(lens, img);
			/*calculate the ratio between result DIV and lens:*/
			cx = result.offsetWidth / lens.offsetWidth;
			cy = result.offsetHeight / lens.offsetHeight;
			/*set background properties for the result DIV:*/
			result.style.backgroundImage = "url('" + img.src + "')";
			result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
			/*execute a function when someone moves the cursor over the image, or the lens:*/
			lens.addEventListener("mousemove", moveLens);
			img.addEventListener("mousemove", moveLens);
			/*and also for touch screens:*/
			lens.addEventListener("touchmove", moveLens);
			img.addEventListener("touchmove", moveLens);
		}
		function moveLens(e) {
			var pos, x, y;
			/*prevent any other actions that may occur when moving over the image:*/
			e.preventDefault();
			/*get the cursor's x and y positions:*/
			pos = getCursorPos(e);
			/*calculate the position of the lens:*/
			x = pos.x - (lens.offsetWidth / 2);
			y = pos.y - (lens.offsetHeight / 2);
			/*prevent the lens from being positioned outside the image:*/
			if (x > img.width - lens.offsetWidth) { x = img.width - lens.offsetWidth; }
			if (x < 0) { x = 0; }
			if (y > img.height - lens.offsetHeight) { y = img.height - lens.offsetHeight; }
			if (y < 0) { y = 0; }
			/*set the position of the lens:*/
			lens.style.left = x + "px";
			lens.style.top = y + "px";
			/*display what the lens "sees":*/
			result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
		}
		function getCursorPos(e) {
			var a, x = 0, y = 0;
			e = e || window.event;
			/*get the x and y positions of the image:*/
			a = img.getBoundingClientRect();
			/*calculate the cursor's x and y coordinates, relative to the image:*/
			x = e.pageX - a.left;
			y = e.pageY - a.top;
			/*consider any page scrolling:*/
			x = x - window.pageXOffset;
			y = y - window.pageYOffset;
			return { x: x, y: y };
		}
	}
	// Initiate zoom effect:
</script>
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<script type="text/javascript">
	//////////////////////////////////////////////////////////////
	var capson_warning = document.getElementsByClassName("capson_warning");
	var password_field = document.getElementsByClassName('password_fields');
	for (var i = 0; i < password_field.length; i++) {
		password_field[i].addEventListener("keyup", function (event) {
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
	//////////////////////////////////////////////////////////////
	$('.tab-pane').on('click', function () {
		$('.tab-pane').css('border', '0px none');
		$('.tab-pane').css('border-bottom', '1px solid transparent');
		var elementtodisplay = $(this).find('.active');
		$(elementtodisplay).css('border', '1px solid transparent');
		$(elementtodisplay).css('border-top-left-radius', '0.25rem');
		$(elementtodisplay).css('border-top-right-radius', '0.25rem');
	})
</script>
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-----------------------------------------SINGLE JSS----------------------------------------------------------------->
<!-------TESTING SIDE-NAV---------->
<script type="text/javascript">
	function openNav() {
		document.cookie = 'OpenNavScroll=' + $(window).scrollTop();
		var NavScrollTop = 'OpenNavScroll';
		document.getElementById("mySidenav").style.width = "300px";
		//document.getElementById("main_all").style.marginLeft = "250px";
		$('body').css("z-index", "0");
		$('body').css("position", "fixed");
		$('#side_nav_bar_lock').css("display", "flex");
		$('#side_nav_bar_lock').css("z-index", "9999999");
	}
	function closeNav() {
		if (typeof NavScrollTop != 'undefined') {
			NavScrollNow = getCookieset(NavScrollTop);
			$("html,body").scrollTop(NavScrollNow);
		}
		document.getElementById("mySidenav").style.width = "0";
		$('body').css("z-index", "1");
		$('body').css("position", "unset");
		$('body').css("z-index", "1");
		$('#side_nav_bar_lock').css("display", "hide");
		$('#side_nav_bar_lock').css("z-index", "-9999999");
		//document.getElementById("main_all").style.marginLeft= "0";
	}
	$('#side_nav_bar_lock').click(function () {
		closeNav();
	});
	////////////////////////////////BREAK SIDE NAV EVENT/////////////////////////////////////////////////////////////////////////////////////////
	$('#list_enda').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_enda").css("display", "block");
	});
	$('#list_endb').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endb").css("display", "block");
	});
	$('#list_endc').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endc").css("display", "block");
	});
	$('#list_endd').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endd").css("display", "block");
	});
	$('#list_ende').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_ende").css("display", "block");
	});
	$('#list_endf').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endf").css("display", "block");
	});
	$('#list_endg').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endg").css("display", "block");
	});
	$('#list_endh').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endh").css("display", "block");
	});
	$('#list_endi').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endj").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endi").css("display", "block");
	});
	$('#list_endj').click(function () {
		$("#side_cat_list_enda").css("display", "none");
		$("#side_cat_list_endb").css("display", "none");
		$("#side_cat_list_endc").css("display", "none");
		$("#side_cat_list_endd").css("display", "none");
		$("#side_cat_list_ende").css("display", "none");
		$("#side_cat_list_endf").css("display", "none");
		$("#side_cat_list_endg").css("display", "none");
		$("#side_cat_list_endh").css("display", "none");
		$("#side_cat_list_endi").css("display", "none");
		$("#side_cat_list_end_default").css("display", "none");
		$("#side_cat_list_endj").css("display", "block");
	});
	//////////////////////////////////BREAK SIDE NAV EVENT/////////////////////////////////////////////////////////////////////////////////
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;
	for (i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function () {
			this.classList.toggle("active");
			var dropdownContent = this.nextElementSibling;
			if (dropdownContent.style.display === "block") {
				dropdownContent.style.display = "none";
				/*CLICK EVENT OVERRIDING USING DISPLAY BLOCK or NONE */
				$("#side_cat_list_enda").css("display", "none");
				$("#side_cat_list_endb").css("display", "none");
				$("#side_cat_list_endc").css("display", "none");
				$("#side_cat_list_endd").css("display", "none");
				$("#side_cat_list_ende").css("display", "none");
				$("#side_cat_list_endf").css("display", "none");
				$("#side_cat_list_endg").css("display", "none");
				$("#side_cat_list_endh").css("display", "none");
				$("#side_cat_list_endi").css("display", "none");
				$("#side_cat_list_endj").css("display", "none");
				$("#side_cat_list_end_default").css("display", "block");
				$("#side_nav_content_end_line").css("display", "block");
				/*CLICK EVENT OVERRIDING USING DISPLAY BLOCK or NONE */
			}
			else {
				$(".dropdown-container").hide();//HIDE ALL OPENED DROPDOWN WHEN OPEN DROPDOWN
				dropdownContent.style.display = "block";
			}
		});
	}
</script>
<!-------TESTING SIDE-NAV---------->
<!-------TESTING NAV---------->
<script type="text/javascript">
	$(function () {
		var navMain = $(".navbar-collapse"); // avoid dependency on #id
		// "a:not([data-toggle])" - to avoid issues caused
		// when you have dropdown inside navbar
		navMain.on("click", "a:not([data-toggle])", null, function () {
			navMain.collapse('hide');
		});
	});
</script>
<!-------TESTING NAV---------->
<!-- Back to Top -->
<!--
<a href="#" id="toTop" style="background-color: white" class="back-to-top"><span id="toTopHover"></span></a>-->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- added script for new template -->
<!-- Latest jQuery form server -->
<!------------------------------------------------------------>
<!--/////////////////////START-303///END-833/////////////////////////////////////////-->
<!----------THIS IS FROM HEADER ------------------->
<!--///////////////////////////////////////////////////////////////-->
<script src="https://cdn.jsdelivr.net/gh/vast-engineering/jquery-popup-overlay@2/jquery.popupoverlay.min.js"></script>
<script type="text/javascript">
	jQuery.fn.putCursorAtEnd = function () {
		return this.each(function () {
			// Cache references
			var $el = $(this),
				el = this;
			// Only focus if input isn't already
			if (!$el.is(":focus")) {
				$el.focus();
			}
			// If this function exists... (IE 9+)
			if (el.setSelectionRange) {
				// Double the length because Opera is inconsistent about whether a carriage return is one character or two.
				var len = $el.val().length * 2;
				// Timeout seems to be required for Blink
				setTimeout(function () {
					el.setSelectionRange(len, len);
				}, 1);
			} else {
				// As a fallback, replace the contents with itself
				// Doesn't work in Chrome, but Chrome supports setSelectionRange
				$el.val($el.val());
			}
			// Scroll to the bottom, in case we're in a tall textarea
			// (Necessary for Firefox and Chrome)
			this.scrollTop = 999999;
		});
	};
	$(document).ready(function (e) {
		$('.search-panel .dropdown-menu').find('a').click(function (e) {
			e.preventDefault();
			var param = $(this).attr("href").replace("#", "");
			var concept = $(this).text();
			$('.search-panel span#search_concept').text(concept);
			$('.input-group #search_param').val(param);
			$("#category").hide();
		});
	});
	function catlistview() {
		$('#display').hide();
		document.onclick = function (div) {
			if (div.target.id !== 'search-panel' && div.target.id !== 'search_concept' && div.target.id !== 'srch_pan') {
				$("#category").hide();
			}
			else if (div.target.id == 'search-panel' || div.target.id == 'search_concept' || div.target.id == 'srch_pan') {
				if ($('#category').css('display') != 'none') {
					$("#category").hide();
				}
				else {
					$("#category").show();
				}
			}
			else {
				$("#category").show();
			}
		}
	}
	/*SMALL DIV*/
	$(document).ready(function (f) {
		$('.search-panel .dropdown-menu').find('a').click(function (f) {
			f.preventDefault();
			var param = $(this).attr("href").replace("#", "");
			console.log(param)
			var concept = $(this).text();
			$('.search-panel span#search_concept2').text(concept);
			$('.input-group #search_param2').val(param);
			$("#category2").hide();
		});
	});
	function catlistview2() {
		$('#display2').hide();
		document.onclick = function (div) {
			if (div.target.id !== 'search-panel2' && div.target.id !== 'search_concept2' && div.target.id !== 'srch_pan2') {
				$("#category2").hide();
			}
			else if (div.target.id == 'search-panel2' || div.target.id == 'search_concept2' || div.target.id == 'srch_pan2') {
				if ($('#category2').css('display') != 'none') {
					$("#category2").hide();
				}
				else {
					$("#category2").show();
				}
			}
			else {
				$("#category2").show();
			}
		}
	}
	document.onclick = function (div) {
		if (div.target.id !== 'search' && div.target.id !== 'search2') {
			$("#display").hide();
			$("#display2").hide();
		}
	}
	/*/////////////////////////////////MODAL SIGN IN//////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
	function signup() {
		location.href = "registered.php";
		return;
	}
	function ValidateSigninEmail(mail) {
		if (/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(mail)) {
			return true;
		}
		return false;
	}
	function signin() {
		var password = document.getElementById("pwd").value;
		var email = document.getElementById("mobile").value;
		if (email == null || email == "") {
			swal({
				title: "Oops!!!",
				text: "Please enter your email ID !!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("mobile").focus();
			return;
		}
		if (ValidateSigninEmail(email) == false) {
			swal({
				title: "Oops!!!",
				text: "Invalid email address!!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("mobile").focus();
			return;
		}
		//password verification of null value
		if (password == null || password == "") {
			swal({
				title: "Oops!!!",
				text: "Please enter the password !!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("pwd").value = "";
			document.getElementById("pwd").focus();
			return;
		}
		else {
			$('.load_btn').show();
			$('.real_btn').hide();
			$.ajax({
				url: "functions.php", //passing page info
				data: { "login": 1, "email": email, "password": password },  //form data
				type: "post",	//post data
				dataType: "json", 	//datatype=json format
				timeout: 18000,	//waiting time 3 sec
				success: function (data) {	//if logging in is success
					if (data.admin == 'true' && data.user == 'true') {
						$('.real_btn').show();
						$('.load_btn').hide();
						Swal.fire({
							title: "<span style='font-family-arial'>Log in as</span>",
							text: "User (or) Store owner",
							icon: "success",
							showCancelButton: true,
							showConfirmButton: true,
							confirmButtonColor: 'red',
							confirmButtonText: '<i class="fas fa-store"></i> Admin',
							cancelButtonColor: 'green',
							allowOutsideClick: false,
							cancelButtonText: '<i class="fa fa-shopping-cart"></i> User'
						})
							.then((willSubmit) => {
								if (willSubmit.dismiss) {
									location.href = "onestore.php";
								}
								else if (willSubmit.isConfirmed) {
									location.href = "store-admin/index.php?id=" + data.id + "";
								}
							});
						return;
					}
					else if (data.admin == 'true') {
						$('.real_btn').show();
						$('.load_btn').hide();
						swal({
							title: "Success!!!",
							text: "Admin privileges granted",
							icon: "success",
							closeOnClickOutside: false,
							dangerMode: true,
						})
							.then((willSubmit) => {
								if (willSubmit) {
									$('#emppass').hide();
									location.href = "store-admin/index.php?id=" + data.id + "";
								}
								else {
									return;
								}
							});
					}
					else if (data.status == 'success') {
						$('.real_btn').show();
						$('.load_btn').hide();
						swal({
							title: "Success!!!",
							text: "Log in Success",
							icon: "success",
							closeOnClickOutside: false,
							dangerMode: true,
						})
							.then((willSubmit) => {
								if (willSubmit) {
									$(function () {
										document.getElementById("pwd").value = "";
										location.reload();
										$('#emppass').hide();
										$('#myModal').modal('toggle');
									});
									return;
								}
								else {
									return;
								}
							});
					}
					else if (data.status == 'admin') {
						$('.real_btn').show();
						$('.load_btn').hide();
						swal({
							title: "Success!!!",
							text: "Admin privileges granted",
							icon: "success",
							closeOnClickOutside: false,
							dangerMode: true,
						})
							.then((willSubmit) => {
								if (willSubmit) {
									$('#emppass').hide();
									location.href = "store-admin/index.php?id=" + data.id + "";
								}
								else {
									return;
								}
							});
					}
					else if (data.status == 'error') {
						$('.real_btn').show();
						$('.load_btn').hide();
						swal({
							title: "Oops!!!",
							text: "Error logging in",
							icon: "error",
							closeOnClickOutside: false,
							dangerMode: true,
						})
							.then((willSubmit) => {
								if (willSubmit) {
									$('#emppass').html("Incorrect Password");
									$('#emppass').show();
									//location.reload();
								}
							});
					}
					else if (data.status == 'errornotfound') {
						$('.real_btn').show();
						$('.load_btn').hide();
						swal({
							title: "Oops!!!",
							text: "You are not registered yet",
							icon: "error",
							closeOnClickOutside: false,
							dangerMode: true,
						})
							.then((willSubmit) => {
								if (willSubmit) {
									$('#emppass').html("You are not registered with us. Please sign up.");
									$('#emppass').show();
									//location.reload();
								}
							});
					}
					else if (data.status == 'error1') {
						$('.real_btn').show();
						$('.load_btn').hide();
						swal({
							title: "Check your mailbox!!!",
							text: "Pending email verification",
							icon: "warning",
							closeOnClickOutside: false,
							dangerMode: true,
						})
							.then((willSubmit) => {
								if (willSubmit) {
									$('#emppass').html("Verify your email");
									$('#emppass').show();
									//location.reload();
								}
							});
					}
				},
				error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
					if (textstatus === "timeout") {
						$('.real_btn').show();
						$('.load_btn').hide();
						swal({
							title: "Oops!!!",
							text: "server time out",
							icon: "error",
							closeOnClickOutside: false,
							dangerMode: true,
							timer: 6000,
						});
						return;
					}
					else { return; }
				}
			}); //closing ajax
		}
	}
	//<?php
	//    $fourRandomDigit = mt_rand(1000,9999);
//    echo $fourRandomDigit;
// ?>
	/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
</script>
<!-- //navigation -->
<!-- navigation -->
<script type="text/javascript">
	function forgottenpass() {
		location.href = "../../extras/OS/pages/FRL/forgot-password-v2.html";
		return;
	}
	//menu
	function myFun(x) {
		x.classList.toggle("change");
	}
	//menu
</script>
<!-- //navigation -->
<script type="text/javascript">
	//POP UP LOCATION & PIN ARGUMENT
	function locate() {
		$("#setloc").hide();
		$("#po_list").empty().append('<option selected="" disabled="" value="0">Location</option>');
		var locate, pin;
		var postcode = document.getElementById("pincode").value;
		if (postcode == null || postcode == "") {
			swal({
				title: "Oops!!!",
				text: "Please enter the pincode !!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("pincode").focus();
			return;
		}
		else if (postcode.length != 6) {
			swal({
				title: "Oops!!!",
				text: "Please enter valid pincode !!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("pincode").value = "";
			document.getElementById("pincode").focus();
			return;
		}
		else {
			pin = "https://api.postalpincode.in/pincode/" + postcode + "";
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					locate = JSON.parse(this.responseText);
					console.log(locate);
					console.log(locate[0].PostOffice.length);
					/*Getting the id of select*/
					var po = document.getElementById("po_list");
					for (i = 0; i < locate[0].PostOffice.length; i++) {
						var create_po = document.createElement('option');
						create_po.value = "" + locate[0].PostOffice[i].Name + "";
						create_po.innerHTML = "" + locate[0].PostOffice[i].Name + "";
						po.appendChild(create_po);
						$("#setloc").show();
					}
				}
			};
			xmlhttp.open("GET", pin, true);
			xmlhttp.send();
		}
	}
	//POP UP LOCATION & PIN ARGUMENT
	/*currently working*/
	function setlocation() {
		var po = document.getElementById("po_list").value;
		//	'<%Session["location"]="'+po+'";%>';//SET JS VALUE TO PHP SESSION VARIABLE
		$.ajax({
			url: "functions.php", //passing page info
			data: { "location_access": 1, "location": po },  //form data
			type: "post",	//post data
			dataType: "json", 	//datatype=json format
			timeout: 30000,	//waiting time 3 sec
			success: function (data) {	//if registration is success
				if (data.status == 'success') {
					//CODE TO REMOVE
					swal({
						title: "Success!!!",
						text: "Located Successfully",
						icon: "success",
						closeOnClickOutside: false,
						dangerMode: true,
					})
						.then((willSubmit) => {
							if (willSubmit) {
								location.href = "onestore.php";
							}
							else {
								return;
							}
						});
					//CODE TO REMOVE
				}
				else if (data.status == 'error') {
					swal({
						title: "Oops!!!",
						text: "Couldn't locate your place",
						icon: "error",
						closeOnClickOutside: false,
						dangerMode: true,
					})
						.then((willSubmit) => {
							if (willSubmit) {
								return;
							}
							else {
								return;
							}
						});
				}
			},
			error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
				if (textstatus === "timeout") {
					swal({
						title: "Oops!!!",
						text: "server time out",
						icon: "error",
						closeOnClickOutside: false,
						dangerMode: true,
						timer: 6000,
					});
					return;
				}
				else { return; }
			}
		}); //closing ajax
		document.getElementById("location").innerHTML = "You";
		$("#popup2").hide();
		$("#popup2_background").hide();
		$("#popup2_wrapper").hide();
	}
	/*find latitude and longitude with postal code and postoffice*/
	/*
	   var address=document.getElementById('po_list').value;
	   var post="https://api.positionstack.com/v1/forward?access_key=02d2fe0121d695587c3ea6ec300a8a8e&query="+address+"";
	   var xmlhttp = new XMLHttpRequest();
	   xmlhttp.onreadystatechange = function() {
			   if (this.readyState == 4 && this.status == 200) {
			   locate = JSON.parse(this.responseText);
		   }
	   };
	   xmlhttp.open("GET", post , true);
	   xmlhttp.send();
   */
	/*working*/
	//REGISTER LOCATION & PIN
	function reglocate() {
		$("#po_list1").empty().append('<option selected="" disabled="" value="0">Location</option>');
		var locate, pin;
		var regpin = document.getElementById("regpin").value;
		if (regpin == null || regpin == "") {
			swal({
				title: "Oops!!!",
				text: "Please enter the pincode !!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("regpin").focus();
			return;
		}
		else if (regpin.length != 6) {
			swal({
				title: "Oops!!!",
				text: "Please enter valid pincode !!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("regpin").value = "";
			document.getElementById("regpin").focus();
			return;
		}
		else {
			pin = "https://api.postalpincode.in/pincode/" + regpin + "";
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					locate = JSON.parse(this.responseText);
					console.log(locate);
					//console.log(locate[0].PostOffice.length);
					if (locate[0].Status == "Error") {
						swal({
							title: "Oops!!!",
							text: "Invalid pincode !!! ",
							icon: "error",
							closeOnClickOutside: false,
							dangerMode: true,
							timer: 6000,
						});
						document.getElementById("regpin").value = "";
						document.getElementById("regpin").focus();
						return;
					}
					else {
						/*Getting the id of select*/
						var po = document.getElementById("po_list1");
						for (i = 0; i < locate[0].PostOffice.length; i++) {
							var create_po = document.createElement('option');
							create_po.value = "" + locate[0].PostOffice[i].Name + "";
							create_po.innerHTML = "" + locate[0].PostOffice[i].Name + "";
							po.appendChild(create_po);
							$("#setloc2").show();
						}
					}
				}
			};
			xmlhttp.open("GET", pin, true);
			xmlhttp.send();
		}
	}
	//REGISTER LOCATION & PIN
	/*currently working*/
	function regsetlocation() {
		var po = document.getElementById("po_list").value;
		//	'<%Session["location"]="'+po+'";%>';//SET JS VALUE TO PHP SESSION VARIABLE
		$.ajax({
			url: "functions.php", //passing page info
			data: { "location_access": 1, "location": po },  //form data
			type: "post",	//post data
			dataType: "json", 	//datatype=json format
			timeout: 30000,	//waiting time 3 sec
			success: function (data) {	//if registration is success
				if (data.status == 'success') {
					//CODE TO REMOVE
					swal({
						title: "Success!!!",
						text: "Located Successfully",
						icon: "success",
						closeOnClickOutside: false,
						dangerMode: true,
					})
						.then((willSubmit) => {
							if (willSubmit) {
								return;
							}
							else {
								return;
							}
						});
					//CODE TO REMOVE
				}
				else if (data.status == 'error') {
					swal({
						title: "Oops!!!",
						text: "Couldn't locate your place",
						icon: "error",
						closeOnClickOutside: false,
						dangerMode: true,
					})
						.then((willSubmit) => {
							if (willSubmit) {
								return;
							}
							else {
								return;
							}
						});
				}
			},
			error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
				if (textstatus === "timeout") {
					swal({
						title: "Oops!!!",
						text: "server time out",
						icon: "error",
						closeOnClickOutside: false,
						dangerMode: true,
						timer: 6000,
					});
					return;
				}
				else { return; }
			}
		}); //closing ajax
		////////////////////////////////////////////////////////////////////////////////////////
		dis_locate();
		$('#update_user_details').show();
		document.getElementById("location").innerHTML = "You";
		///////////////////////////////////////////////////////////////////////////////////////
		$("#popup2").hide();
		$("#popup2_background").hide();
		$("#popup2_wrapper").hide();
		/*find latitude and longitude with postal code and postoffice*/
		/*
		   var address=document.getElementById('po_list').value;
		   var post="https://api.positionstack.com/v1/forward?access_key=02d2fe0121d695587c3ea6ec300a8a8e&query="+address+"";
		   var xmlhttp = new XMLHttpRequest();
		   xmlhttp.onreadystatechange = function() {
				   if (this.readyState == 4 && this.status == 200) {
				   locate = JSON.parse(this.responseText);
			   }
		   };
		   xmlhttp.open("GET", post , true);
		   xmlhttp.send();
	   */
		/*working*/
	}
</script>
<!--//////////////////////END-833///START-303/////////////////////////////////////-->
<!----------THIS IS FROM HEADER ------------------->
<!--///////////////////////////////////////////////////////////////-->
<!-------------------------------------------------------------------- >
	<!-- Bootstrap JS form CDN -->
<script type="text/javascript">
	$('#myModal').on('show.bs.modal', function (event) {
		$('#myModal').modal('handleUpdate');
	});
	$('#myModal2').on('show.bs.modal', function (event) {
		$('myModal2').modal('handleUpdate');
	});
	/*
			$('avail_stores').on('show.bs.model',function (event){
				$('#avail_stores').modal('handleUpdate') ;
			});
	 */
</script>
<!-- start-smoth-scrolling --><!--
	<script type="text/javascript" src="../../js/move-top.js"></script>
	<script type="text/javascript" src="../../js/easing.js"></script>-->
<!--ending of added script -->
<!-- top-header and slider -->
<!-- here stars scrolling icon -->
<!--	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/
			$().UItoTop({ easingType: 'easeOutQuart' });
			});
	</script>
-->
<!-- //here ends scrolling icon -->
<!--// Mini Cart //-->
<script src="../../js/minicart.min.js"></script>
<!--// Mini Cart //-->
<script>
	<!--// Mini Cart //-->
	paypal.minicart.render({
		action: '#'
	});
	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
<!--// Mini Cart //-->
<!-- main slider-banner -->
<script type="text/javascript">
	//TO REMOVE PADDING AFTER CLOSING MODAL
	$(".close").on("hidden", function () {
		$('#strt').css('padding', '0px');
	});
	window.addEventListener("click", function (e) {
		e.stopPropagation();
		$('body').css('padding-right', '-10px');
	});
	//TO REMOVE PADDING AFTER CLOSING MODAL
	jQuery(document).ready(function () {
		jQuery('#demo1').skdslider({ 'delay': 5000, 'animationSpeed': 2000, 'showNextPrev': true, 'showPlayButton': true, 'autoSlide': true, 'animationType': 'fading' });
		jQuery('#responsive').change(function () {
			$('#responsive_wrapper').width(jQuery(this).val());
		});
	});
	$('#popup2').popup({
		pagecontainer: '#page',
		escape: false
	});
	$('#popup1').popup({
		pagecontainer: '#page',
		escape: false
	});
	function cartview() {
		location.href = "cart.php"
	}
	//AUTO LOG IN
	$(document).ready(function () {
		setTimeout(() => {
			const loader1 = document.querySelector(".loader1");
			const loader2 = document.querySelector(".loader2");
			const loader = document.querySelector(".loader");
			loader.className += " hidden";
			loader1.className += " hidden";
			loader2.className += " hidden";
		}, 3000);
		function getCookie(name) {
			// Split cookie string and get all individual name=value pairs in an array
			var cookieArr = document.cookie.split(";");
			// Loop through the array elements
			for (var i = 0; i < cookieArr.length; i++) {
				var cookiePair = cookieArr[i].split("=");
				/* Removing whitespace at the beginning of the cookie name
				and compare it with the given string */
				if (name == cookiePair[0].trim()) {
					// Decode the cookie value and return
					return decodeURIComponent(cookiePair[1]);
				}
			}
			// Return null if not found
			return " ";
		}
		<?php
		if (!isset($_SESSION['id'])) {
			?>
			var email = getCookie("OneStore_email");
			var pass = getCookie("OneStore_password");
			if (email != " " && pass != " ") {
				//$("#strt").hide();
				$.ajax({
					url: "functions.php", //passing page info
					data: { "login": 1, "email": email, "password": pass },  //form data
					type: "post",	//post data
					dataType: "json", 	//datatype=json format
					timeout: 18000,	//waiting time 3 sec
					success: function (data) {	//if logging in is success
						if (data.status == 'success') {
							//location.href="onestore.php";
						}
						else if (data.status == 'admin') {
							location.href = "store-admin/index.php?id=" + data.id + "";
						}
						else if (data.status == 'error') {
							return;
						}
					},
					error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
						if (textstatus === "timeout") {
							swal({
								title: "Oops!!!",
								text: "server time out",
								icon: "error",
								closeOnClickOutside: false,
								dangerMode: true,
								timer: 6000,
							});
							location.href = "onestore.php";
							return;
						}
						else { return; }
					}
				}); //closing ajax
			}
			<?php
		}
		if (isset($_SESSION['id']) && !isset($_SESSION['cart_count'])) {
			?>
			//CART COUNT
			$.ajax({
				url: "functions.php", //passing page info
				data: { "cartcnt": 1, "user": "<?= $_SESSION['id'] ?>" },  //form data
				type: "post",	//post data
				dataType: "json", 	//datatype=json format
				timeout: 18000,	//waiting time 3 sec
				success: function (data) {	//if logging in is success
					if (data.status == "success") {
						document.getElementById("sm-cartcnt").innerHTML = "";
						document.getElementById("lg-cartcnt").innerHTML = "";
						document.getElementById("sm-cartcnt").innerHTML = data.cartcnt;
						document.getElementById("lg-cartcnt").innerHTML = data.cartcnt;
						return;
					}
				},
				error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
					if (textstatus === "timeout") {
						return;
					}
					else { return; }
				}
			}); //closing ajax
			<?php
		}
		?>
	});
	//AUTO LOG IN
	//Newsletter activation
	//Feedback check
	function NLValidateEmail(mail) {
		if (/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(sendmail.cntemail.value)) {
			return true;
		}
		return false;
	}
	function nlcheckmail() {
		var nle = document.getElementById("nlmail").value;
		if (nle == null || nle == "") {
			swal({
				title: "Oops!!!",
				text: "Please enter your email",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("nlmail").focus();
			return;
		}
		else if (NLValidateEmail(nle) == false) {
			swal({
				title: "Oops!!!",
				text: "Invalid email address!!! ",
				icon: "error",
				closeOnClickOutside: false,
				dangerMode: true,
				timer: 6000,
			});
			document.getElementById("nlmail").focus();
			return false;
		}
		else {
			$.ajax({
				url: "functions.php",
				data: { "nlmailcheck": 1, "email": nle },
				dataType: "json",
				type: "post",
				timeout: 30000,
				success: function (data) {
					if (data.status == 'success') {
						swal({
							title: "Added!!!",
							text: "added to Newsletter",
							icon: "success",
							closeOnClickOutside: false,
							dangerMode: true,
							timer: 6000,
						});
					}
					else if (data.status == 'error') {
						swal({
							title: "Oops!!!",
							text: "Try agan later",
							icon: "error",
							closeOnClickOutside: false,
							dangerMode: true,
							timer: 6000,
						})
							.then((willSubmit1) => {
								if (willSubmit1) {
									location.href = "login.php"
									return;
								}
								else {
									return;
								}
							});
					}
					else if (data.status == 'error2') {
						swal({
							title: "Not found!!!",
							text: "Please log in",
							icon: "error",
							closeOnClickOutside: false,
							dangerMode: true,
							timer: 6000,
						})
							.then((willSubmit1) => {
								if (willSubmit1) {
									//location.href="login.php"
									return;
								}
								else {
									return;
								}
							});
					}
				},
				error: function (xmlhttprequest, textstatus, message) { //if it exceeds timeout period
					if (textstatus === "timeout") {
						swal({
							title: "Oops!!!",
							text: "server time out",
							icon: "error",
							closeOnClickOutside: false,
							dangerMode: true,
							timer: 6000,
						});
						return;
					}
					else { return; }
				}
			}); //closing ajax
		}
	}
	//Newsletter activation
	function hostReachable() {
		// Handle IE and more capable browsers
		var xhr = new (window.ActiveXObject || XMLHttpRequest)("Microsoft.XMLHTTP");
		// Open new request as a HEAD to the root hostname with a random param to bust the cache
		xhr.open("HEAD", "//" + window.location.hostname + "/?rand=" + Math.floor((1 + Math.random()) * 0x10000), false);
		// Issue request and handle response
		try {
			xhr.send();
			return (xhr.status >= 200 && (xhr.status < 300 || xhr.status === 304));
		} catch (error) {
			return false;
		}
	}
</script>
<!------------------------------------------------------------>
<!--/////////////////////START-303///END-833/////////////////////////////////////////-->
<!----------THIS IS FROM HEADER ------------------->
<!--///////////////////////////////////////////////////////////////-->
<!-- Scroll->Drag -->
<script src="../../js/scroll.js"></script>
<!-- jQuery sticky menu -->
<script src="../../js/owl.carousel.min.js"></script>
<script src="../../js/jquery.sticky.js"></script>
<!-- jQuery easing -->
<!--<script src="../../js/jquery.easing.1.3.min.js"></script>-->
<script src="../../js/easing.js"></script>
<!-- Main Script -->
<script src="../../js/main.js"></script>
<!-- Slider -->
<script type="text/javascript" src="../../js/bxslider.min.js"></script>
<script type="text/javascript" src="../../js/script.slider.js"></script>
<!-- Bootstrap Core JavaScript ///IMPORTANT///-->
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/skdslider.min.js"></script>
<link href="../../css/skdslider.css" rel="stylesheet">
<!--/////////////////////START-303///END-833/////////////////////////////////////////-->
<!----------THIS IS FROM HEADER ------------------->
<!--///////////////////////////////////////////////////////////////-->
<!------------------------------------------------------------>
<!-- //main slider-banner -->
<!-- coc -->
<!-- JavaScript Libraries -->
<!--<script src="../../js/bootstrap.min.js"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>-->
<!--<script src="../../extras/lib/easing/easing.min.js"></script>-->
<script src="../../extras/lib/slick/slick.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../extras/OS/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../extras/OS/plugins/toastr/toastr.min.js"></script>
<!-- Defining Toastr -->
<script type="text/javascript">
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	/*
		Toast.fire({
			icon: 'error',
			title: ' Enter your OTP !!! '
		})
	*/
</script>
<!-- SweetAlert -->
<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<script src="../../js/sweetalert.min.js"></script>
<!-- Template Javascript -->
<script src="../../extras/js/main.js"></script>
<!-- Detail about shops-->
<script src="../../extras/OS/dist/js/demo.js"></script>
<!-- AdminLTE App -->
<script src="../../extras/OS/dist/js/adminlte.min.js"></script>
<script>
	var scrollNow = getCookieset(scrollTop);
	$("html,body").animate({ scrollTop: scrollNow }, 1000);
</script>