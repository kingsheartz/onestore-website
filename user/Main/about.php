<?php
require "header.php";
?>
<style type="text/css">
	@media(min-width: 992px) {
		.about-team-grids {
			width: 24.6%;
		}
	}

	.w3_agile_header {
		font-weight: bolder;
	}

	.about-team-grids {
		height: 610px;
	}

	.flip-box-inner {
		width: 100%;
		text-align: center;
		transition: transform 0.8s;
		transform-style: preserve-3d;
	}

	.flip-box:hover .flip-box-inner {
		transform: rotateY(180deg);
	}

	.flip-box-front,
	.flip-box-back {
		position: absolute;
		width: 100%;
		height: 100%;
		-webkit-backface-visibility: hidden !important;
		backface-visibility: hidden !important;
	}

	.flip-box-back {
		transform: rotateY(180deg);
	}
</style>
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="../Main/onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
			</li>
			<li class="active">About</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!-- about -->
<div class="about">
	<div class="container">
		<h3 class="w3_agile_header">About Us</h3>
		<div class="about-agileinfo w3layouts">
			<div class="col-md-8 about-wthree-grids grid-top">
				<h4>One World, One Store !!! </h4>
				<p class="top" style="padding:5px">Shopping without roaming, We are here for all your needs.......</p>
				<p>It goes back in time when we made our simple beginning in the year 2021.OneStore online shopping
					system which further contains several other entities describing the entire system. Also provides the
					24×7 service, that is customers can surf the website, place orders anytime they wish to. The
					delivery system works according to the shops opening and closing time.</p>
				<p>The pandemic has put people and economies under immense pressure. Nobody could have foreseen the
					disruption that came upon the world last year and continues to impact every single thing we do even
					today. It pushed boundaries and realigned priorities. It created daunting challenges especially for
					small businesses . Many of them have gone through personal loss and hardship in their lives in
					recent months. We at OneStore recognize the immense responsibility that we have as a company during
					such challenging times – to our customers as by partnering small scale companies to launch their
					products in good manner and also helps to reach people. </p>
				<p>OneStore helps customers to purchase commodities as per requirement during this covid-19
					circumstances. The major Objective of "OneStore" is that by enabling device location , we could know
					where to find our requirements at nearest location, also we can either order it to home or purchase
					from those particular shop by visiting over there. We could also know whether the shops are open or
					not.</p>
				<div class="about-w3agilerow">
					<div class="col-md-12" style="margin: 0px;padding: 0px;">
						<div class="col-md-4 about-w3imgs" style="margin: 0px;padding: 0px;">
							<img src="../../images/p5.jpg" alt="" class="img-responsive zoom-img"
								style="height: 147.53px" />
						</div>
						<div class="col-md-4 about-w3imgs" style="margin: 0px;padding: 0px;">
							<img src="../../images/logo/store.jpg" alt="" class="img-responsive zoom-img"
								style="height: 147.53px" />
						</div>
						<div class="col-md-4 about-w3imgs" style="margin: 0px;padding: 0px;">
							<img src="../../images/logo/login.jpg" alt="" class="img-responsive zoom-img"
								style="height: 147.53px" />
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 about-wthree-grids">
				<div class="offic-time">
					<div class="time-top">
						<h4>OneStore </h4>
					</div>
					<div class="time-bottom">
						<h5>From 9.00 AM </h5>
						<h5>To 9.00 PM :)</h5>
						<p>Service provided 24x7 hours a week. </p>
					</div>
				</div>
				<div class="testi">
					<h3 class="w3_agile_header">Testimonial</h3>
					<!--//End-slider-script -->
					<script src="../../js/responsiveslides.min.js"></script>
					<script>
						// You can also use "$(window).load(function() {"
						$(function () {
							// Slideshow 5
							$("#slider5").responsiveSlides({
								auto: true,
								pager: false,
								nav: true,
								speed: 500,
								namespace: "callbacks",
								before: function () {
									$('.events').append("<li>before event fired.</li>");
								},
								after: function () {
									$('.events').append("<li>after event fired.</li>");
								}
							});
						});
					</script>
					<div id="top" class="callbacks_container">
						<ul class="rslides" id="slider5">
							<li>
								<div class="testi-slider">
									<h4>" I AM VERY PLEASED.</h4>
									<p>Thanks for your visit to our store.We believe ,you like to shop with us.Feel free
										to explore our world.We are here to help you. :)</p>
									<div class="testi-subscript">
										<p><a href="#">Govind,</a>Leader</p>
										<span class="w3-agilesub"> </span>
									</div>
								</div>
							</li>
							<li>
								<div class="testi-slider">
									<h4>" WORLD IS SO BIG</h4>
									<p>World is so big,we can't roam for every needs.We try to bring that to your finger
										tips, so that you can save your precious time.</p>
									<div class="testi-subscript">
										<p><a href="#">KING'S HEARTZ,</a>Manager</p>
										<span class="w3-agilesub"> </span>
									</div>
								</div>
							</li>
							<li>
								<div class="testi-slider">
									<h4>" THANKS TO YOU.</h4>
									<p>Everything we doing great because of your support.We are expecting that it will
										continue from your side,Thank you !! </p>
									<div class="testi-subscript">
										<p><a href="#">Supporting Team,</a>OneStore</p>
										<span class="w3-agilesub"> </span>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!-- //about -->
<!-- about-slid -->
<div class="about-slid agileits-w3layouts">
	<div style="background-color: rgba(0,0,0,0.55);">
		<div class="container">
			<div class="about-slid-info">
				<h2>OneStore, Save time for doing great !</h2>
				<p style="text-align:justify">Technology is growing day to day for saving our time and giving
					extraordinary features and specifications to us. We also thinks in the same way to provide the same
					result to you. We believe in providing you a best user friendly atmosphere is our success. We are
					trying hard time-to-time in achieving that .</p>
			</div>
		</div>
	</div>
</div>
<!-- //about-slid -->
<!-- about-team -->
<div class="about-team">
	<div class="row">
		<h3 class="w3_agile_header">Meet Our Team</h3>
		<div class="team-agileitsinfo">
			<div class="col-md-12">
				<div class="col-md-3 about-team-grids">
					<img src="../../images/team/t1.JPG" alt="" height="450px" />
					<div class="team-w3lstext">
						<h4><span>GOVIND,</span> Leader</h4>
						<p>Controls overall project and direct into the right path for the fullfilness of work.</p>
					</div>
					<div class="social-icons caption">
						<ul>
							<li><a href="https://www.facebook.com/As.Govind" target="_blank"
									class="fa fa-facebook facebook"> </a></li>
							<li><a href="https://wa.me/[918113990368]?text=Hai%2C%20There!"
									data-action="share/whatsapp/share" target="_blank" class="fa fa-whatsapp"
									style="font-size:15px"> </a></li>
							<li><a href="mailto:govind.das279@gmail.com" target="_blank" class="fa fa-envelope mail">
								</a></li>
						</ul>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class=" col-md-3 about-team-grids flip-box">
					<div class='flip-box-inner'>
						<div class='flip-box-front'>
							<img src="../../images/team/t2.JPG" alt="" height="450px" />
							<div class="team-w3lstext">
								<h4><span>Anumol,</span> Member</h4>
								<p>Provides datas and support to the team which helps in reaching fullness of work.</p>
							</div>
						</div>
						<div class='flip-box-back'>
							<img src="../../images/team/t5.jpg" alt="" height="450px" />
							<div class="team-w3lstext">
								<h4><span>Dhanalakshmi,</span> Member</h4>
								<p>Helps collecting datas for the project completion.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 about-team-grids">
					<img src="../../images/team/t4.JPG" alt="" height="450px" />
					<div class="team-w3lstext">
						<h4><span>KRISHNENDU,</span> Co-Leader</h4>
						<p>Functional advisor of the extra-ordinary requirements in our work.</p>
					</div>
					<div class="social-icons caption">
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-3 about-team-grids">
					<img src="../../images/team/t3.JPG" alt="" height="450px" />
					<div class="team-w3lstext">
						<h4><span>SHAHANAS,</span> Supervisor</h4>
						<p>Holds the root of our project and supervise the members group .</p>
					</div>
					<div class="social-icons caption">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- //about-team -->
<?php
require "footer.php";
?>
<script type="text/javascript">
	const homeactive = document.querySelector('#homeactive');
	//const catactive=document.querySelector('#catactive');
	const aboutactive = document.querySelector('#aboutactive');
	const contactactive = document.querySelector('#contactactive');
	homeactive.className = "";
	//catactive.className="";
	aboutactive.className = "";
	contactactive.className = "";
	aboutactive.className = "active";
</script>
</body>

</html>