<?php
require "../Common/pdo.php";
if (isset($_GET['sharelink'])) {
	$sql = "select privacy from wishlist where share_link=:link";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
		':link' => $_GET['sharelink']
	));
	$linkrow = $stmt->fetch(PDO::FETCH_ASSOC);
	if (!$linkrow || $linkrow['privacy'] == 'private') {
		header('location:../../extras/OS/pages/Error/404.php');
		return false;
	}
}
require "../Main/header.php";
?>
<style type="text/css">
	td {
		text-align: center;
		color: #ccc;
		font-size: 15px;
	}

	th {
		text-align: center;
		color: #fff;
		font-size: 15px;
	}

	tr {
		border-bottom: 1px solid #bdbdbd;
	}

	select {
		border-color: #0c99cc !important;
		box-shadow: none;
		outline: none;
		border-radius: 5px;
		padding: 5px;
	}

	select:hover {
		transition-duration: 1s;
		box-shadow: inset 0 0 5px #0c99cc !important;
	}

	.wltr {
		background-color: rgba(0, 0, 0, .75);
	}

	.wltr:hover {
		background-color: rgba(0, 0, 0, .85);
	}

	.wltr td:hover {
		color: white !important;
	}

	.wltr td a {
		color:
	}

	select {
		color: #6a6a6a;
	}

	.wishlist-method {
		color: #ccc;
	}

	.wishlist-method:hover {
		color: #fff;
		cursor: pointer;
		font-size: 25px;
		transition: .3s;
	}

	/*///////////////////////////////////////////////////////////////*/
	/*CREATE WISHLIST*/
	.create_wishlist_table td {
		align-items: left;
		text-align: left;
		justify-content: left;
		padding: 5px;
		color: black;
	}

	.create_wishlist_table tr {
		border: none;
	}

	.create_wishlist_table {
		border-radius: 7px;
		margin-top: 10px;
	}

	@media (max-width: 710px) {
		.your_wishlist_large {
			display: none !important;
		}

		.wl_menu_large {
			display: none !important;
		}

		.your_wishlist_small {
			display: unset !important;
		}

		.wl_menu_small {
			display: grid !important;
		}
	}

	@media (max-width: 700px) {

		.your_wishlist_head,
		.create_wishlist_head,
		.search_wishlist_head {
			font-size: 20px;
		}

		.img_wishlist {
			max-width: 60px !important;
		}

		.img_wishlist_div {
			padding: 10px !important;
		}

		.wl_menu_small {
			margin-top: 10px !important;
		}

		.your_wishlist {
			margin-top: -20px !important;
		}
	}

	@media (min-width: 551px) {
		.ywl_table_small_list_head {
			font-size: 21px !important;
		}
	}

	@media (max-width: 550px) {
		.ywl_table_small .ywl_small_table_th h4 {
			font-size: 15px !important;
		}

		.ywl_table_small .ywl_small_table_td h4 {
			font-size: 15px !important;
		}
	}

	@media (max-width: 345px) {
		.ywl_table_small .ywl_small_table_th {
			text-align: left;
			padding-left: 20px;
		}

		.ywl_table_small .ywl_small_table_td {
			text-align: left;
			padding-left: 60px;
		}

		.yw span,
		.sw span,
		.caw span,
		.yw-active span,
		.sw-active span,
		.caw-active span {
			font-size: 18px !important;
		}
	}

	.wltr select option {
		font-size: 16px;
		display: inline-flex;
	}

	/*///////////////////////////////////////////////////////////////*/
</style>
<!-- breadcrumbs -->
<div class="breadcrumbs" style="background-color: #eaeded">
	<div class="container">
		<ol class="breadcrumb breadcrumb1" style="background-color: #eaeded">
			<li><a href="onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">wishlist</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<div style="background: url(../../images/logo/check1.jpg);">
	<div style="background-color: rgba(0,0,0,.65);">
		<center>
			<div class="img_wishlist_div"
				style="background-color: rgba(255,255,255);padding: 30px;display: inline-block;border-radius: 50%;margin-top: 20px;border:3px solid black">
				<img class="img_wishlist" src="../../images/logo/wishlist2.png" style="max-width: 100px;">
			</div>
			<h2 style="display: none;" class="create_wishlist_head">
				<a href="#" style="color: #000;font-size: 1.5em">
					<span class="fa fa-file-text" style="color: #F1E5B5;"></span><span style="color: #fff"> Create a
						wishlist </span>
				</a>
			</h2>
			<h2 class="your_wishlist_head">
				<a href="#" style="color: #000;font-size: 1.5em">
					<span class="fa fa-heart" style="color: #c50505;"></span><span style="color: #fff"> Your Wishlists
					</span>
				</a>
			</h2>
			<h2 style="display: none;" class="search_wishlist_head">
				<a href="#" style="color: #000;font-size: 1.5em">
					<span class="fa fa-search" style="color: #fe9126;"></span><span style="color: #fff"> Search Wishlist
					</span>
				</a>
			</h2>
			<!------------------------------------------------------------------------------------------------------------------------------>
			<!--///////////////////////////////////WISHLIST SELECTION MENU LARGE//////////////////////////////////////////////////////////-->
			<!------------------------------------------------------------------------------------------------------------------------------>
			<div class="container  wl_menu_large" style="margin-top: 50px;">
				<div class="row" style="background-color: black;color: white;padding-bottom: 10px;">
					<div class="col-md-12">
						<h3>
							<div class="div-wrapper">
								<div class="wishlist-method caw" data-backdrop="static" data-keyboard="false"
									data-toggle="modal" data-target="#myModal_create_wishlist">
									<span class="fa fa-file-text"> Create a wishlist</span>
								</div>
								<div class="wishlist-method  caw-active" style="display: none;">
									<span class="fa fa-file-text" style="color: #F1E5B5"> <span
											style="color: #0f99ff;">Create a wishlist</span></span>
								</div>
								<div class="wishlist-method yw" style="border-left:1px solid #fff;display: none;">
									<span class="fa fa-heart"> Your wishlist</span>
								</div>
								<div class="wishlist-method yw-active" style="border-left:1px solid #fff;">
									<span class="fa fa-heart" style="color:#c50505 "> <span style="color: #0f99ff">Your
											wishlist</span></span>
								</div>
								<div class="wishlist-method sw" style="border-left:1px solid #fff">
									<span class="fa fa-search"> Search wishlist</span>
								</div>
								<div class="wishlist-method sw-active"
									style="border-left:1px solid #fff;display: none;">
									<span class="fa fa-search" style="color: #fe9126"> <span
											style="color: #0f99ff">Search wishlist</span></span>
								</div>
							</div>
						</h3>
					</div>
				</div>
			</div>
			<!------------------------------------------------------------------------------------------------------------------------------>
			<!--///////////////////////////////////WISHLIST SELECTION MENU SMALL//////////////////////////////////////////////////////////-->
			<!------------------------------------------------------------------------------------------------------------------------------>
			<div class="container   wl_menu_small" style="margin-top: 50px; display: none;">
				<div class="row" style="color: white;padding-bottom: 0px;">
					<div class="col-md-12">
						<h3>
							<div class="div-wrapper">
								<div style="background-color: black;padding: 15px;border-radius: 5px;"
									data-backdrop="static" data-keyboard="false" data-toggle="modal"
									data-target="#myModal_create_wishlist">
									<div class="wishlist-method caw"
										style="display:flex;align-items: center;justify-content: center;">
										<span class="fa fa-file-text"> Create</span>
									</div>
									<div class="wishlist-method  caw-active"
										style="display:flex;align-items: center;justify-content: center;display: none;">
										<span class="fa fa-file-text" style="color: #F1E5B5"> <span
												style="color: #0f99ff;">Create</span></span>
									</div>
								</div>
								<div style="background-color: black;padding: 15px;border-radius: 5px;">
									<div class="wishlist-method yw"
										style="display:flex;align-items: center;justify-content: center;display: none;">
										<span class="fa fa-heart"> Wishlist</span>
									</div>
									<div class="wishlist-method yw-active"
										style="display:flex;align-items: center;justify-content: center;">
										<span class="fa fa-heart" style="color:#c50505 "> <span
												style="color: #0f99ff;">Wishlist</span></span>
									</div>
								</div>
								<div style="background-color: black;padding: 15px;border-radius: 5px;">
									<div style="" class="wishlist-method sw"
										style="display:flex;align-items: center;justify-content: center;">
										<span class="fa fa-search"> Search</span>
									</div>
									<div class="wishlist-method sw-active"
										style="display:flex;align-items: center;justify-content: center;display: none;">
										<span class="fa fa-search" style="color: #fe9126"> <span
												style="color: #0f99ff;">Search</span></span>
									</div>
								</div>
							</div>
						</h3>
					</div>
				</div>
			</div>
			<!------------------------------------------------------------------------------------------------------------------------------>
			<!------------------------------------------------------------------------------------------------------------------------------>
			<!--///////////////////////////////////YOUR WISHLIST//////////////////////////////////////////////////////////////////////////-->
			<!------------------------------------------------------------------------------------------------------------------------------>
			<!--YOUR WISHLIST-->
			<div class="your_wishlist">
				<div class="your_wishlist_large">
					<?php
					if (isset($_SESSION['id'])) {
						$sql_check = 'select count(wishlist_id) as cnt from wishlist where user_id=:user_id';
						$stmt_check = $pdo->prepare($sql_check);
						$stmt_check->execute(array(':user_id' => $_SESSION['id']));
						$row_check = $stmt_check->fetch(PDO::FETCH_ASSOC);
						$sql_wish = 'select * FROM wishlist WHERE user_id=:user_id';
						$stmt_wish = $pdo->prepare($sql_wish);
						$stmt_wish->execute(array(':user_id' => $_SESSION['id']));
						if ($row_check['cnt'] > 0) {
							?>
							<div class="container" style="margin-top: 50px;">
								<div class="row">
									<div class="col-md-12">
										<table id="show_wishlist" cellpadding="20px" cellspacing="20px" width="100%">
											<tbody>
												<tr style="background-color: #0f99cc;">
													<th>
														<h4>Wishlists</h4>
													</th>
													<th>
														<h4>Privacy</h4>
													</th>
													<th>
														<h4>Item count</h4>
													</th>
													<th>
														<h4>Created on</h4>
													</th>
													<th>
														<h4>Action</h4>
													</th>
												</tr>
												<?php
												while ($row_wish = $stmt_wish->fetch(PDO::FETCH_ASSOC)) {
													$sql_wish1 = 'select count(wishlist_id) as item_count FROM wishlist_items WHERE wishlist_id=:wish_id ';
													$stmt_wish1 = $pdo->prepare($sql_wish1);
													$stmt_wish1->execute(array(':wish_id' => $row_wish['wishlist_id']));
													$row_wish1 = $stmt_wish1->fetch(PDO::FETCH_ASSOC);
													?>
													<tr class="wltr del_w_<?= $row_wish['wishlist_id'] ?>">
														<?php
														if (strlen($row_wish['list_name']) < 15) {
															$listname = $row_wish['list_name'];
														} else {
															$cutname = substr($row_wish['list_name'], 0, 15);
															$listname = $cutname . "...";
														}
														?>
														<div
															onclick="location.href='../Wishlist/wishlist_single.php?wishlist_id=<?= $row_wish['wishlist_id'] ?>'">
															<td
																onclick="location.href='../Wishlist/wishlist_single.php?wishlist_id=<?= $row_wish['wishlist_id'] ?>'">
																<h4 title="<?= $row_wish['list_name'] ?>"><?= $listname ?></h4>
															</td>
															<td
																onclick="location.href='../Wishlist/wishlist_single.php?wishlist_id=<?= $row_wish['wishlist_id'] ?>'">
																<h4><?= $row_wish['privacy'] ?></h4>
															</td>
															<td
																onclick="location.href='../Wishlist/wishlist_single.php?wishlist_id=<?= $row_wish['wishlist_id'] ?>'">
																<h4><?= $row_wish1['item_count'] ?></h4>
															</td>
															<td
																onclick="location.href='../Wishlist/wishlist_single.php?wishlist_id=<?= $row_wish['wishlist_id'] ?>'">
																<h4><?= $row_wish['date'] ?></h4>
															</td>
														</div>
														<td>
															<h4>
																<select style="font-size: 16px;"
																	onchange="actions(this,'<?= $row_wish['wishlist_id'] ?>')"
																	id="sharewid_<?= $row_wish['wishlist_id'] ?>">
																	<option value="0" selected="" disabled="">Select</option>
																	<option value='1' style="color: #333;">Edit</option>
																	<option value="2" style="color: #333;">Delete</i></option>
																	<option
																		value="wishlist_share.php?sharelink=<?= $row_wish['share_link'] ?>"
																		style="color: #333;">Share</i></option>
																</select>
															</h4>
														</td>
													</tr>
													<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php
						} else {
							?>
							<h4 style="margin-top: 50px;color: #ccc">No lists are found.<a data-backdrop="static"
									data-keyboard="false" data-toggle="modal" data-target="#myModal_create_wishlist">Create
									one!</a></h4>
							<br><br><br><br><br>
							<?php
						}
					} else {
						?>
						<h4 style="margin-top: 50px;color: #ccc">You are not logged in. Please <a href="#myModal"
								data-toggle="modal" data-dismiss="modal">Log in!</a></h4>
						<?php
					}
					?>
				</div>
				<!------------------------------------------------------------------------------------------------------------------------------>
				<!--///////////////////////////////////YOUR WISHLIST SMALL//////////////////////////////////////////////////////////////////////////-->
				<!------------------------------------------------------------------------------------------------------------------------------>
				<!--YOUR WISHLIST SMALL-->
				<div class="your_wishlist_small" style="display: none;">
					<?php
					$sql_check = 'select count(wishlist_id) as cnt from wishlist where user_id=:user_id';
					$stmt_check = $pdo->prepare($sql_check);
					$stmt_check->execute(array(':user_id' => $_SESSION['id']));
					$row_check = $stmt_check->fetch(PDO::FETCH_ASSOC);
					$sql_wish = 'select * FROM wishlist WHERE user_id=:user_id';
					$stmt_wish = $pdo->prepare($sql_wish);
					$stmt_wish->execute(array(':user_id' => $_SESSION['id']));
					if ($row_check['cnt'] > 0) {
						?>
						<div class="container" style="margin-top: 50px;">
							<div class="row" style="margin: 0;padding: 0;width: 100%">
								<div class="col-md-12" style="margin: 0;padding: 0;width: 100%">
									<?php
									while ($row_wish = $stmt_wish->fetch(PDO::FETCH_ASSOC)) {
										$sql_wish1 = 'select count(wishlist_id) as item_count FROM wishlist_items WHERE wishlist_id=:wish_id ';
										$stmt_wish1 = $pdo->prepare($sql_wish1);
										$stmt_wish1->execute(array(':wish_id' => $row_wish['wishlist_id']));
										$row_wish1 = $stmt_wish1->fetch(PDO::FETCH_ASSOC);
										////////////////////////////////////////////////////////////////////////
										if (strlen($row_wish['list_name']) < 15) {
											$listname = $row_wish['list_name'];
										} else {
											$cutname = substr($row_wish['list_name'], 0, 15);
											$listname = $cutname . "...";
										}
										?>
										<div id="show_wishlist_small">
											<table class="wltr ywl_table_small del_w_<?= $row_wish['wishlist_id'] ?>"
												cellpadding="20px" cellspacing="20px" width="100%"
												style="background-color: rgba(0,0,0,.65);">
												<tr style="background-color: #0f99cc;"
													onclick="location.href='../Wishlist/wishlist_single.php?wishlist_id=<?= $row_wish['wishlist_id'] ?>'">
													<th colspan="2">
														<h4 class="ywl_table_small_list_head"
															title="<?= $row_wish['list_name'] ?>"><?= $listname ?> &nbsp;<i
																class="fa fa-file-text"></i><i class="fa fa-heart"
																style="font-size: 12px;color:#c50505 "></i></h4>
													</th>
												</tr>
												<tr>
													<th class="ywl_small_table_th">
														<h4>Privacy</h4>
													</th>
													<td class="ywl_small_table_td">
														<h4><?= $row_wish['privacy'] ?></h4>
													</td>
												</tr>
												<tr>
													<th class="ywl_small_table_th">
														<h4>Item count</h4>
													</th>
													<td class="ywl_small_table_td">
														<h4><?= $row_wish1['item_count'] ?></h4>
													</td>
												</tr>
												<tr>
													<th class="ywl_small_table_th">
														<h4>Created on</h4>
													</th>
													<td class="ywl_small_table_td">
														<h4><?= $row_wish['date'] ?></h4>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<table style="width:100%">
															<tr>
																<td>
																	<h4><i class="fa fa-edit"
																			onclick="location.href='../Wishlist/wishlist_single.php?wishlist_id=<?= $row_wish['wishlist_id'] ?>&setting=1'"></i>
																	</h4>
																</td>
																<td>
																	<h4><i class="fa fa-trash"
																			onclick='del_list("<?= $row_wish['wishlist_id'] ?>")'></i>
																	</h4>
																</td>
																<td>
																	<h4><i class="fa fa-share"
																			onclick="copylink(<?= $row_wish['wishlist_id'] ?>,'wishlist_share.php?sharelink=<?= $row_wish['share_link'] ?>')"></i>
																	</h4>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<br>
										</div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
						<?php
					} else {
						?>
						<h4 style="margin-top: 50px;color: #ccc">No lists are found.<a data-backdrop="static"
								data-keyboard="false" data-toggle="modal" data-target="#myModal_create_wishlist">Create
								one!</a></h4>
						<br><br><br><br><br>
						<?php
					}
					?>
				</div>
			</div>
			<!------------------------------------------------------------------------------------------------------------------------------>
			<!--///////////////SEARCH WISHLIST////////////////////////////////////////////////////////////////////////////////////////////-->
			<!------------------------------------------------------------------------------------------------------------------------------>
			<!--SEARCH WISHLIST-->
			<script>
				//edited by KinG's HearTz
				function dispsrch() {
					//$('#wishsrch').on("keyup input", function(){
					/* Get input value on change */
					//console.log('helo');
					//var inputVal = $(this).val();
					var inputVal = $('#wishsrch').val();
					$.get("../Wishlist/getwishlist.php", { name: inputVal }).done(function (data) {
						// Display the returned data in browser
						console.log(data);
						$('#wishlisttable tr.wltr').remove();
						$('#wishlisttable').append(data);
					});
					//});
					// Set search input value on click of result item
				}
			</script>
			<div class="search_wishlist" style="display: none;">
				<?php
				$sql_check1 = 'select count(wishlist_id) as cnt from wishlist where privacy="public"';
				$stmt_check1 = $pdo->prepare($sql_check1);
				$stmt_check1->execute();
				$row_check1 = $stmt_check1->fetch(PDO::FETCH_ASSOC);
				$sql_wish1 = 'select users.first_name,wishlist.list_name,wishlist.wishlist_id,wishlist.date FROM wishlist INNER JOIN wishlist_items ON wishlist.wishlist_id=wishlist_items.wishlist_id inner join users on wishlist.user_id=users.user_id WHERE privacy="public" group by wishlist.wishlist_id';
				$stmt_wish1 = $pdo->prepare($sql_wish1);
				$stmt_wish1->execute();
				if ($row_check1['cnt'] > 0) {
					?>
					<div class="container" style="margin-top: 50px;">
						<div class="row">
							<div class="col-md-12">
								<table id="wishlisttable" cellpadding="20px" cellspacing="20px" width="100%">
									<tr>
										<div class="input-group bar-srch"
											style="padding: 0px;margin: 0px;left: 0px;right: 0px;margin-bottom: 15px;">
											<input type="text" class="" id="wishsrch" placeholder="Search wishlist" value=""
												name="" required=" "
												style="width: 100%;margin: 0px;z-index: 0;border-radius: 3px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;outline: none;">
											<span id="" class="input-group-btn">
												<button onclick="dispsrch()"
													onmouseover="$(this).css('background-color','#ee8126')"
													onmouseleave="$(this).css('background-color','#fe9126')"
													style="color: white;background-color:#fe9126;padding-top:10px;padding-bottom: 10px;outline: none;border-radius: 0;"
													class="btn btn-default search_btn" type="button"><span
														class="fa fa-search"></span></button>
											</span>
											<span id="" class="input-group-btn">
												<button onmouseover="$(this).css('background-color','#0d99cc')"
													onmouseleave="$(this).css('background-color','#0f99cc')"
													onclick="$('#wishsrch').val('');dispsrch()"
													style="color: white;background-color:#0f99cc;padding-top:10px;padding-bottom: 10px;outline: none;"
													class="btn btn-default search_btn" type="button"><span
														class="fa fa-refresh"></span></button>
											</span>
										</div>
									</tr>
									<tr style="background-color: #0f99cc;">
										<th>
											<h4>Wishlist of</h4>
										</th>
										<th>
											<h4>Name</h4>
										</th>
										<th>
											<h4>Item count</h4>
										</th>
										<th>
											<h4>Created on</h4>
										</th>
									</tr>
									<?php
									while ($row_wish1 = $stmt_wish1->fetch(PDO::FETCH_ASSOC)) {
										$sql_wish2 = 'select count(wishlist_id) as item_count FROM wishlist_items WHERE wishlist_id=:wish_id ';
										$stmt_wish2 = $pdo->prepare($sql_wish2);
										$stmt_wish2->execute(array(':wish_id' => $row_wish1['wishlist_id']));
										$row_wish2 = $stmt_wish2->fetch(PDO::FETCH_ASSOC);
										?>
										<tr class="wltr"
											onclick="location.href='../Wishlist/wishlist_public.php?wishlist_id=<?= $row_wish1['wishlist_id'] ?>'">
											<?php
											if (strlen($row_wish1['first_name']) < 12) {
												$listownername = $row_wish1['first_name'];
											} else {
												$cutname = substr($row_wish1['first_name'], 0, 12);
												$listownername = $cutname . "...";
											}
											if (strlen($row_wish1['list_name']) < 15) {
												$listname = $row_wish1['list_name'];
											} else {
												$cutname = substr($row_wish1['list_name'], 0, 15);
												$listname = $cutname . "...";
											}
											?>
											<td>
												<h4 title="<?= $row_wish1['first_name'] ?>"><?= $listownername ?></h4>
											</td>
											<td>
												<h4 title="<?= $row_wish1['list_name'] ?>"><?= $listname ?></h4>
											</td>
											<td>
												<h4><?= $row_wish2['item_count'] ?></h4>
											</td>
											<td>
												<h4><?= $row_wish1['date'] ?></h4>
											</td>
										</tr>
										<?php
									}
									?>
								</table>
							</div>
						</div>
					</div>
					<?php
				} else {
					?>
					<h4 style="margin-top: 50px;color: #ccc;">No lists are found.<a data-backdrop="static"
							data-keyboard="false" data-toggle="modal" data-target="#myModal_create_wishlist">Create one!</a>
					</h4>
					<br><br><br><br><br>
					<?php
				}
				?>
			</div>
			<!------------------------------------------------------------------------------------------------------------------------------>
			<br><br><br><br><br>
		</center>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------>
<!--///////////////////////////CREATE WISHLIST////////////////////////////////////////////////////////////////////////////////-->
<!------------------------------------------------------------------------------------------------------------------------------>
<!--CREATE WISHLIST-->
<!-- Modal -->
<div class="modal fade" id="myModal_create_wishlist" role="dialog" onclose="$('.yw').click();" style="height: 95%;">
	<div class="modal-dialog modal-m" style="background-color: white;border-radius: 7px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background-color: #fe9126">
				<button type="button" class="close" data-dismiss="modal" onclick="$('.yw').click();">&times;</button>
				<h4 class="modal-title">
					<span class="fa fa-file-text" style="color: #fff;"></span>
					<span style="color: #fff"> Create a wishlist </span>
				</h4>
			</div>
			<div class="modal-body">
				<center>
					<div
						style="background-color: rgba(255,255,255);padding: 10px;display: inline-block;border-radius: 50%;margin-top: 0px;border:3px solid black;">
						<img src="../../images/logo/wishlist1.png" style="max-width: 80px;">
						<span class="fa fa-plus fa-lg" style="margin-left: -10px;"></span>
					</div>
				</center>
				<div style="display: none;margin-top: 20px;" class="alert alert-danger"></div>
				<form action="#" onsubmit="return create_my_list()" method="post" enctype="multipart/form-data">
					<table style="background-color: #fff;width: 100%" class="create_wishlist_table">
						<tr>
							<td>
								<h4>
									Name of your list<span style="color: #c50505">*</span>
								</h4>
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" placeholder="Wishlist name" name="Wishlist_name" id="Wishlist_name"
									required="" style="width: 100%;border-radius: 5px;outline-color: #e59700">
							</td>
						</tr>
						<tr>
							<td>
								<h4>
									Describe your list
								</h4>
							</td>
						</tr>
						<tr>
							<td>
								<textarea placeholder="Describe your wishlist" name="Wishlist_descibe"
									id="Wishlist_descibe"
									style="width: 100%;border-radius: 5px;outline-color: #e59700"></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<h4>
									Privacy Settings<span style="color: #c50505">*</span>
								</h4>
							</td>
						</tr>
						<tr>
							<td>
								<div class="div-wrapper" style="grid-gap: 0;margin: auto;display: flex;"><input
										type="radio" id="public" class="privacy" name="privacy" value='public'><label
										for="public">&nbsp;Public</label>
									<div><span style="font-size: 12px;color: #666">-Anyone can search for and see this
											list.You can also share using a link</span></div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="div-wrapper" style="grid-gap: 0;margin: auto;display: flex;"><input
										type="radio" id="shared" class="privacy" name="privacy" value="shared"><label
										for="shared">&nbsp;Shared</label>
									<div><span style="font-size: 12px;color: #666">-Only people with the link see this
											list.It will not appear in public search results.</span></div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<input type="radio" id="private" class="privacy" name="privacy" value="private"><label
									for="private">&nbsp;Private</label><span style="font-size: 12px;color: #666"> - Only
									you can see the list</span>
							</td>
						</tr>
						<tr>
							<td><br><br>
								<center>
									<button style="width: 100%;color: white;padding-top: 3px;padding-bottom: 3px;"
										type="submit" id="createlist" class="btn btn-default search" name="createlist"
										onclick="">
										<h4 style="text-transform: capitalize;">create wishlist</h4>
									</button>
								</center>
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
<!------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------>
<!--///////////////////////////SHARE WISHLIST////////////////////////////////////////////////////////////////////////////////-->
<!------------------------------------------------------------------------------------------------------------------------------>
<!--SHARE WISHLIST-->
<!-- Modal -->
<div class="modal fade" id="myModal_share_wishlist" role="dialog" onclose="$('.yw').click();" style="height: 95%;">
	<div class="modal-dialog modal-m" style="background-color: white;border-radius: 7px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background-color: #c50505">
				<button type="button" class="close" data-dismiss="modal" onclick="$('.yw').click();">&times;</button>
				<h4 class="modal-title">
					<span class="fa fa-file-text" style="color: #fff;"></span>
					<span style="color: #fff"> Share your wishlist </span>
				</h4>
			</div>
			<div class="modal-body">
				<center>
					<div
						style="background-color: rgba(255,255,255);padding: 10px;display: inline-block;border-radius: 50%;margin-top: 0px;border:3px solid black;">
						<img src="../../images/logo/wishlist1.png" style="max-width: 80px;">
						<span class="fa fa-share fa-lg" style="margin-left: -10px;"></span>
					</div>
				</center>
				<div style="display: none;margin-top: 20px;" class="alert alert-danger"></div>
				<form action="#" onsubmit="return create_my_list()" method="post" enctype="multipart/form-data">
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
									<input readonly="true" type="text" class="" id="input_link"
										placeholder="URL to share" value="" name="" required=" "
										style="width: 100%;margin: 0px;z-index: 0;border-radius: 3px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;outline-color: #e59700;">
									<span id="" class="input-group-btn">
										<button onclick="clipboard()"
											style="color: white;background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #740000), color-stop(1, #ff0000)) !important;padding-top:10px;padding-bottom: 10px;outline: none;border-radius: 0;border-bottom-right-radius: 3px;border-top-right-radius: 3px;"
											class="btn btn-default search_btn" type="button"><span
												class="fas fa-copy"></span></button>
									</span>
								</div>
							</td>
						</tr>
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
										<td class="social-share whatsapp" style="text-align: center;"
											onclick="sharelink(1)">
											<div
												style="margin:auto;width: 30px;height: 30px;background-color: darkgreen;border-radius:3px;display: flex;align-items: center;justify-content: center;">
												<i class="fa fa-whatsapp fa-lg" style="color: white;"></i>
											</div>
											<p>Whatsapp</p>
										</td>
										<td class="social-share facebook" style="text-align: center;">
										</td>
										<td class="social-share twitter" style="text-align: center;"
											onclick="setShareLinks()">
											<div
												style="margin:auto;width: 30px;height: 30px;background-color: #1da1f2;border-radius:3px;display: flex;align-items: center;justify-content: center;">
												<i class="fa fa-twitter fa-lg" style="color: white;"></i>
											</div>
											<p>Twitter</p>
										</td>
										<td class="social-share linkedin" style="text-align: center;"
											onclick="setShareLinks()">
											<div
												style="margin:auto;width: 30px;height: 30px;background-color: #0077af;border-radius:3px;display: flex;align-items: center;justify-content: center;">
												<i class="fa fa-linkedin fa-lg" style="color: white;"></i>
											</div>
											<p>Linkedin</p>
										</td>
									</tr>
								</table>
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
<script type="text/javascript">
	function copylink(wid, link) {
		$('#input_link').val(link);
		var code = link.split("=");
		$('.facebook').html('');
		var fb_content = '<div class="fb-share-button"  data-href="' + link + '" data-layout="button_count" data-size="small" style="margin:auto;width: 30px;height: 30px;background-color: #395693;border-radius:3px;display: flex;align-items: center;justify-content: center;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fone-store.ml%2F/user/Wishlist/wishlist.php%3Fsharelink%3D' + code[1] + '&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa fa-facebook fa-lg" style="color: white;"></i></a></div><p>Facebook</p>';
		$('.facebook').html(fb_content);
		"wishlist_share.php?sharelink=62_60c9b30ccaa8a&amp;fbclid=IwAR310ESZCEPJ8uFUub--H6gnJ3FkFRjgzz1duPK3NVdARhV2f8VD1GWtpX0"
		$('#myModal_share_wishlist').modal('show');
	}
	function sharelink(sm) {
		var social_media = sm;
		var link = document.getElementById("input_link").value;
		//whatsapp=1
		if (social_media == 1) {
			window.open("whatsapp://send?text=See my wishlist :- " + link + "");
			return;
		}
	}
	function socialWindow(url) {
		var left = (screen.width - 570) / 2;
		var top = (screen.height - 570) / 2;
		var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
		window.open(url, "NewWindow", params);
	}
	function setShareLinks() {
		var pageUrl = encodeURIComponent(document.getElementById("input_link").value);
		var tweet = "See my wishlist :) !!";
		jQuery(".social-share.twitter").on("click", function () {
			url = "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + tweet;
			socialWindow(url);
		});
		jQuery(".social-share.linkedin").on("click", function () {
			url = "https://www.linkedin.com/shareArticle?mini=true&url=" + pageUrl;
			socialWindow(url);
		})
	}
	function clipboard() {
		var copyText = document.getElementById("input_link");
		copyText.select();
		copyText.setSelectionRange(0, 999999)
		document.execCommand("copy");
		toastr.success('Link copied :- ' + copyText.value);
	}
	function actions(selectmenu, wishlist_id) {
		if (selectmenu.value == 2) {
			del_list(wishlist_id);
			selectmenu.value = 0;
		}
		else if (selectmenu.value == 1) {
			location.href = '../Wishlist/wishlist_single.php?wishlist_id=' + wishlist_id + '&setting=1';
		}
		else {
			var link = selectmenu.value;
			copylink(wishlist_id, link);
			selectmenu.value = 0;
		}
	}
	$('.caw').click(function () {
		$('.caw').hide();
		$('.caw-active').show();
		$('.yw-active').hide();
		$('.yw').show();
		$('.sw-active').hide();
		$('.sw').show();
		$('.search_wishlist').hide();
		$('.create_wishlist').show();
		$('.your_wishlist').hide();
		$('.search_wishlist_head').hide();
		$('.your_wishlist_head').hide();
		$('.create_wishlist_head').show();
	})
	$('.yw').click(function () {
		$('.yw').hide();
		$('.yw-active').show();
		$('.caw-active').hide();
		$('.caw').show();
		$('.sw-active').hide();
		$('.sw').show();
		$('.search_wishlist').hide();
		$('.create_wishlist').hide();
		$('.your_wishlist').show();
		$('.search_wishlist_head').hide();
		$('.your_wishlist_head').show();
		$('.create_wishlist_head').hide();
	})
	$('.sw').click(function () {
		$('.sw').hide();
		$('.sw-active').show();
		$('.caw-active').hide();
		$('.caw').show();
		$('.yw-active').hide();
		$('.yw').show();
		$('.search_wishlist').show();
		$('.your_wishlist').hide();
		$('.create_wishlist').hide();
		$('.search_wishlist_head').show();
		$('.your_wishlist_head').hide();
		$('.create_wishlist_head').hide();
	})
	//DELETE FROM CART
	function del_list(wishlist_id) {
		var wishlist_id = wishlist_id;
		swal({
			title: "Are you sure ?!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			closeOnClickOutside: false,
			closeOnEsc: false,
			buttons: true,
			buttons: ["Cancel", "Remove"],
		})
			.then((willSubmit) => {
				if (willSubmit) {
					$.ajax({
						url: "../Common/functions.php", //passing page info
						data: { "del_list": 1, "wishlist_id": wishlist_id },  //form data
						type: "post",   //post data
						dataType: "json",   //datatype=json format
						timeout: 30000,   //waiting time 30 sec
						success: function (data) {    //if registration is success
							if (data.status == 'success') {
								if (data.rem_list == 0) {
									swal({
										title: "Empty!!!",
										text: "Your wishlist is empty",
										icon: "warning",
										closeOnClickOutside: false,
										dangerMode: true,
									})
										.then((willSubmit1) => {
											if (willSubmit1) {
												location.href = "../Wishlist/wishlist.php";
												return;
											}
											else {
												return;
											}
										});
								}
								else {
									$("." + "del_w_" + data.del_list).fadeOut('slow', function (c) {
										$("." + "del_w_" + data.del_list).hide();
										return;
									});
								}
							}
							else {
								swal({
									title: "Try again!!!",
									icon: "error",
									dangerMode: true,
									timer: 6000,
								});
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
								return;
							}
							else { return; }
						}
					}); //closing ajax
				}
				else { return; }
			});
	}
	function create_my_list() {
		var listname = document.getElementById('Wishlist_name').value;
		var listdescription = document.getElementById('Wishlist_descibe').value;
		var privacy_checked = document.getElementsByName('privacy');
		for (i = 0; i < privacy_checked.length; i++) {
			if (privacy_checked[i].checked) {
				var privacy = privacy_checked[i].value;
			}
		}
		if (privacy == null || privacy == "") {
			$('.alert-danger').html(' Choose privacy!!!');
			$('.alert-danger').show();
			return false;
		}
		Swal.fire({
			text: "Creating new list  !!!",
			icon: "warning",
			showCancelButton: true,
			showConfirmButton: true,
			confirmButtonColor: 'red',
			allowOutsideClick: false,
			confirmButtonText: '<i class="fa fa-close"></i> Close',
			cancelButtonColor: 'green',
			cancelButtonText: '<i class="fa fa-check"></i> OK'
		})
			.then((willSubmit) => {
				if (willSubmit.dismiss) {
					$.ajax({
						url: "../Common/functions.php", //passing page info
						data: { "create_list": 1, "listname": listname, "listdescription": listdescription, "privacy": privacy },  //form data
						type: "post",   //post data
						dataType: "json",   //datatype=json format
						timeout: 30000,   //waiting time 30 sec
						success: function (data) {    //if registration is success
							if (data.status == 'success') {
								var markup = '<tr class="wltr del_w_' + data.wid + '"><td onclick="location.href=\'wishlist_single.php?wishlist_id=\'' + data.wid + '"><h4 title="list_name">' + listname + '</h4></td><td onclick="location.href=\'wishlist_single.php?wishlist_id=\'' + data.wid + '"><h4>' + privacy + '</h4></td><td onclick="location.href=\'wishlist_single.php?wishlist_id=\'' + data.wid + '"><h4>0</h4></td><td onclick="location.href=\'wishlist_single.php?wishlist_id=\'' + data.wid + '"><h4>' + data.date + '</h4></td><td><h4><select style="font-size: 16px;" onchange=\'actions(this,' + data.wid + ')\'><option value="0" selected="" disabled="">Select</option><option value="1" style="color: #333;">Edit</option><option value="2" style="color: #333;">Delete</i></option><option value="../Wishlist/wishlist.php?sharelink=' + data.link + '" style="color: #333;">Share</i></option></select></h4></td></tr>';
								var tableBody = $('#show_wishlist');
								tableBody.append(markup);
								var link = '../Wishlist/wishlist.php?sharelink=' + data.link;
								var markupsmall = '<table class="wltr ywl_table_small del_w_' + data.wid + '" cellpadding="20px" cellspacing="20px" width="100%" style="background-color: rgba(0,0,0,.65);"><tr style="background-color: #0f99cc;" onclick="location.href=\'wishlist_single.php?wishlist_id=\'' + data.wid + '"><th colspan="2"><h4 class="ywl_table_small_list_head" title="' + listname + '">' + listname + ' &nbsp;<i class="fa fa-file-text"></i><i class="fa fa-heart" style="font-size: 12px;color:#c50505 "></i></h4></th></tr><tr><th class="ywl_small_table_th"><h4>Privacy</h4></th><td class="ywl_small_table_td"><h4>' + privacy + '</h4></td></tr><tr><th class="ywl_small_table_th"><h4>Item count</h4></th><td class="ywl_small_table_td"><h4>0</h4></td></tr><tr><th class="ywl_small_table_th"><h4>Created on</h4></th><td class="ywl_small_table_td"><h4>' + data.date + '</h4></td></tr><tr><td colspan="2"><table style="width:100%"><tr><td><h4><i class="fa fa-edit" onclick="location.href=\'wishlist_single.php?wishlist_id=' + data.wid + '&setting=1\'"></i></h4></td><td><h4><i class="fa fa-trash" onclick=\'del_list(' + data.wid + ')\'></i></h4></td><td><h4><i class="fa fa-share" onclick="copylink(' + data.wid + ',\'' + link + '\')"></i></h4></td></tr></table></td></tr></table><br>';
								var tableBodySmall = $('#show_wishlist_small');
								tableBodySmall.append(markupsmall);
								swal({
									title: "Created!!!",
									icon: "success",
									timer: 6000,
								});
								if (data.cnt == 1) {
									location.href = "../Wishlist/wishlist.php";
								}
								return;
							}
							else {
								swal({
									title: "Try again!!!",
									icon: "error",
									dangerMode: true,
									timer: 6000,
								});
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
								return;
							}
							else { return; }
						}
					}); //closing ajax
				}
				else if (willSubmit.isConfirmed) { return false; }
			});
		return false;
	}
</script>
<?php
require "../Main/footer.php";
?>
</body>
<html>