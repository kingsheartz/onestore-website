<?php
require "header.php";
?>
<style>
	.que {
		color: #214c5f !important;
		font-weight: bold !important;
		background-color: rgb(235, 235, 235) !important;
		padding: 8px
	}
</style>
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">FAQ</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!-- help-page -->
<div class="faq-w3agile">
	<div class="container">
		<h2 class="w3_agile_header">Frequently asked <i class="fas fa-question-circle"></i> </h2>
		<ul class="faq">
			<li class="item1"><a href="#" title="click here" class="que">What makes you different from your competitors
					?</a>
				<ul>
					<li class="subitem1">
						<p> We provide location of stores to the customers,it helped our customers not to roam in search
							of products and wait till it arrives. </p>
					</li>
				</ul>
			</li>
			<li class="item2"><a href="#" title="click here" class="que">Do you accept returns/exchanges over and above
					what customers are entitled to by law (i.e., a replacement/repair for a minor fault or refund for a
					major fault)? </a>
				<ul>
					<li class="subitem1">
						<p> Yes, we laid a way for both in case of damaged products and the customer must report with in
							48 hours from the time of delivery.</p>
					</li>
				</ul>
			</li>
			<li class="item3"><a href="#" title="click here" class="que">What payment methods do you accept?</a>
				<ul>
					<li class="subitem1">
						<p>Currently we provide to our customers 2 choice 1) booking and 2) cash on delivery.Later we
							try to include card methods in it.</p>
					</li>
				</ul>
			</li>
			<li class="item4"><a href="#" title="click here" class="que">What do i do if i never recieved my order ?</a>
				<ul>
					<li class="subitem1">
						<p>We do our best not to happen such thing. In case you never received you order,You can report
							to <a href="mailto:onestoreforallyourneeds@gmail.com"
								target="_blank">onestoreforallyourneeds@gmail.com</a> or contact us +9181 13990368 or
							whatsapp us <a href="https://wa.me/[918113990368]?text=Missing%2C%20ordered%20product!"><i
									class="fa fa-whatsapp"></i></a></p>
					</li>
				</ul>
			</li>
			<li class="item5"><a href="#" title="click here" class="que">Can i make changes to an order i already placed
					?</a>
				<ul>
					<li class="subitem1">
						<p>No, but you can cancel you order with in a given period of time.</p>
					</li>
				</ul>
			</li>
			<li class="item6"><a href="#" title="click here" class="que">How do i get a new password?</a>
				<ul>
					<li class="subitem1">
						<p>
						<ul>
							<li style="list-style-type:disc !important">Step 1: Click on forgot password.</li>
							<li style="list-style-type:disc !important">Step 2: Enter your registered email ID.</li>
							<li style="list-style-type:disc !important">Step 3: You'll receive an 6 digit OTP to your
								email.</li>
							<li style="list-style-type:disc !important">Step 4: Click on the Verify OTP button to verify
								your OTP.</li>
							<li style="list-style-type:disc !important">Step 5: Enter your new password and confirm it
								to change your previous password to new.</li>
							<li style="list-style-type:none !important">You are all set !!! Enjoy shopping with us :)
							</li>
						</ul>
						</p>
					</li>
				</ul>
			</li>
			<li class="item7"><a href="#" title="click here" class="que">Is it necessary to have an account to shop on
					OneStore ?</a>
				<ul>
					<li class="subitem1">
						<p>Yes, it's necessary to log into your OneStore account to shop. Shopping as a logged-in user
							is fast & convenient and also provides extra security.</p>
						<p>You'll have access to a personalised shopping experience including recommendations and
							quicker check-out.</p>
					</li>
				</ul>
			</li>
			<li class="item8"><a href="#" title="click here" class="que">What does 'Out of Stock' mean ?</a>
				<ul>
					<li class="subitem1">
						<p> An item is marked as 'Out of stock' when it is not available with any Shoppers at the
							moment; you won't be able to buy it now.</p>
					</li>
				</ul>
			</li>
			<li class="item9"><a href="#" title="click here" class="que">Can I track my order ?</a>
				<ul>
					<li class="subitem1">
						<p>We will send you the tracking mail of the shipment when the parcel has been sent.</p>
					</li>
				</ul>
			</li>
			<li class="item10"><a href="#" title="click here" class="que">What are the terms and conditions ?</a>
				<ul>
					<li class="subitem1">
						<p>You can see the terms and conditions here <a href="../Main/terms&conditions.php">T&C</a>.</p>
					</li>
				</ul>
			</li>
			<li class="item10"><a href="#" title="click here" class="que">How can I connect with you ?</a>
				<ul>
					<li class="subitem1">
						<p>It's very simple just click <a href="../Main/contact.php">"Contact us"</a> option and there
							would be 3 ways<br><br>
							1.What's app<br>
							2.Facebook<br>
							3.Mail<br><br>
							you can choose as to your choice.</p>
					</li>
				</ul>
			</li>
		</ul>
		<!-- script for tabs -->
		<script type="text/javascript">
			$(function () {
				var menu_ul = $('.faq > li > ul'),
					menu_a = $('.faq > li > a');
				menu_ul.hide();
				menu_a.click(function (e) {
					e.preventDefault();
					if (!$(this).hasClass('active')) {
						menu_a.removeClass('active');
						menu_ul.filter(':visible').slideUp('normal');
						$(this).addClass('active').next().stop(true, true).slideDown('normal');
					} else {
						$(this).removeClass('active');
						$(this).next().stop(true, true).slideUp('normal');
					}
				});
			});
		</script>
		<!-- script for tabs -->
	</div>
</div>
<!-- //footer -->
<!-- //footer -->
<?php
require "footer.php";
?>