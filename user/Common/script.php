<script src="../../js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- //IMPORTANT-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- //IMPORTANT-->
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />-->
<!-- Bootstrap Core JavaScript -->
<!--favicon-->
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
</script>
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
			var link = "../../extras/APK/RELEASE/OneStore_version_high.apk";
		}
		else if (n == 2) {
			var link = "../../extras/APK/RELEASE/OneStore_version_low.apk";
		}
		else {
			var link = "../../extras/APK/RELEASE/OneStore_version_low.apk";
		}
		$('#input_apk_link').val(link);
		///////////WHATSAPP///////////
		$('.whatsapp_apk').html('');
		var wa_content = '<div style="margin-left:15px;width: 30px;height: 30px;background-color: darkgreen;border-radius:3px;display: flex;align-items: center;justify-content: center;"><a target="_blank" data-action="share/whatsapp/share" href="https://api.whatsapp.com/send?text=Download Apk Now :- ' + link + '"><i class="fa fa-whatsapp fa-lg" style="color: white;"></i></a></div><p>Whatsapp</p>';
		$('.whatsapp_apk').html(wa_content);
	}
</script>
<!-------------------------------------JAVA SCRIPT FUNCTIONS BEGIN------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------->
<!-------TESTING SIDE-NAV---------->
<script type="text/javascript">
	function openNav() {
		document.cookie = 'OpenNavScroll=' + $(window).scrollTop();
		NavScrollTop = 'OpenNavScroll';
		document.getElementById("mySidenav").style.width = "300px";
		//document.getElementById("main_all").style.marginLeft = "250px";
		$('body').css("z-index", "0");
		$('body').css("position", "fixed");
		$('#side_nav_bar_lock').css("display", "flex");
		$('#side_nav_bar_lock').css("z-index", "9999999");
	}
	function closeNav() {
		if (typeof NavScrollTop != 'undefined') {
			var NavScrollNow = getCookieset(NavScrollTop);
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
	////////////CAPSLOCK FINDER//////////////////////////////////////////////////
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
	$(document).mouseup(function (e) {
		if ($(e.target).closest(".mobcategory").length === 0) {
			$(".mobcategory").hide();
		}
	});
	function moblistview() {
		if ($('.mobcategory').css('display') != 'none') {
			$(".mobcategory").hide();
		}
		else {
			$(".mobcategory").show();
		}
	}
	$(document).ready(function (f) {
		$('.mob-panel .dropdown-menu').find('a').click(function (f) {
			f.preventDefault();
			var param = $(this).attr("href").replace("#", "");
			var concept = $(this).text();
			$('.mob-panel span.mob_concept').text(concept);
			$(".mobcategory").hide();
		});
	});
	//////////////////////////////////////////////////////////////
	//MOBILE MENU
	$(function () {
		$("#mobile-menu").click(function () {
			$("#mobile-menu").toggleClass("active");
		});
	})
	//MOBILE MENU
	//////////////////////////////////////////////////////////////
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
			console.log(param)
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
		location.href = "../Account/registered.php";
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
				url: "../Common/functions.php", //passing page info
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
									location.href = "../../store-admin/index.php?id=" + data.id + "";
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
									location.href = "../../store-admin/index.php?id=" + data.id + "";
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
									location.href = "../../store-admin/index.php?id=" + data.id + "";
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
						$('.load_btn').side();
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
			url: "../Common/functions.php", //passing page info
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
			url: "../Common/functions.php", //passing page info
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
		//$('#update_user_details').show();
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
		location.href = "../Cart/cart.php"
	}
	//AUTO LOG IN
	$(document).ready(function () {
		/*/////////////////////////////HIDDING LOADER//////////////////////////////////////////////
			setTimeout(() => {
			const loader = document.querySelector(".loader");
			const loader1 = document.querySelector(".loader1");
			const loader2 = document.querySelector(".loader2");
			loader.className += " hidden";
			loader1.className += " hidden";
			loader2.className += " hidden";
			  }, 3000);
		/*/////////////////////////////HIDDING LOADER//////////////////////////////////////////////
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
		if (isset($_SESSION['id']) && !isset($_SESSION['cart_count'])) {
			?>
				var email = getCookie("OneStore_email");
				var pass = getCookie("OneStore_password");
				if (email != " " && pass != " ") {
					//$("#strt").hide();
					$.ajax({
						url: "../Common/functions.php", //passing page info
						data: { "login": 1, "email": email, "password": pass },  //form data
						type: "post",	//post data
						dataType: "json", 	//datatype=json format
						timeout: 18000,	//waiting time 3 sec
						success: function (data) {	//if logging in is success
							if (data.status == 'success') {
								//location.href="onestore.php";
							}
							else if (data.status == 'admin') {
								location.href = "../../store-admin/index.php?id=" + data.id + "";
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
						url: "../Common/functions.php", //passing page info
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
				url: "../Common/functions.php",
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
									location.href = "../Account/login.php"
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
									//location.href="../Account/login.php"
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
<script>
	$(document).ready(function () {
		if (typeof scrollTop != 'undefined') {
			var scrollNow = getCookieset(scrollTop);
			setTimeout(function () {
				$("html,body").animate({ scrollTop: scrollNow }, 1500);
			}, 1500);
		}
	});
</script>