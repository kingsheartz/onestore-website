<?php
require "../Main/header.php";
?>
<style>
	.wrapper {
		display: flex;
		align-items: stretch;
		margin-bottom: 20px;
		margin-top: 0px;
	}

	.card-header {
		background-color: transparent;
		border-bottom: 1px solid rgba(0, 0, 0, .125);
		padding: .75rem 1.25rem;
		position: relative;
		border-top-left-radius: .25rem;
		font-size: 50px;
		text-align: center;
		text-transform: uppercase;
		margin-bottom: 10px;
		border-top-right-radius: .25rem;
	}

	.hover14.column {
		border: none;
	}

	.table1 {
		height: auto;
		overflow: auto;
		background-color: white;
		padding: 5px;
		margin-bottom: 20px;
		border-top: 5px solid #116d60;
	}

	.img_size {
		margin: auto;
		display: flex;
		background: white;
		image-rendering: auto;
		image-rendering: crisp-edges;
		width: auto;
		max-width: 170px;
		height: auto;
		max-height: 200px;
	}

	a.img-cont {
		display: flex;
		justify: center;
		align-items: center;
		margin: auto;
	}
</style>
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="../Main/onestore.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
			</li>
			<li class="active">Products</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!--- products --->
<div class="products" style="padding: 0px">
	<div class="col-12 products-right  card">
		<div class="card-header">
			<?php
			require "../Common/pdo.php";
			if (isset($_GET['popular'])) {
				$head = "Popular Products";
			} else if (isset($_GET['recent'])) {
				$head = "Recently Viewed";
			} else if (isset($_GET['prev'])) {
				$head = "Previously Purchased";
			} else if (isset($_GET['topseller'])) {
				$head = "Top Seller";
			} else if (isset($_GET['brand'])) {
				$head = $_GET['brand'];
			}
			?>
			<h3 style="text-transform:capitalize;font-weight:bold;text-align:center">
				<?= $head ?>
			</h3>
			<h4></h4>
		</div>
		<?php
		require "../Common/pdo.php";
		if (isset($_GET['pageno'])) {
			$pageno = $_GET['pageno'];
		} else {
			$pageno = 1;
		}
		$no_of_records_per_page = 12;
		$offset = ($pageno - 1) * $no_of_records_per_page;
		if (isset($_GET['popular'])) {
			$total_pages_sql = $pdo->query("select distinct(item_keys.item_description_id) from item_keys
			inner join product_details on product_details.item_description_id=item_keys.item_description_id
			GROUP BY item_keys.item_description_id order by CAST(sum(item_keys.views) as UNSIGNED) DESC");
			$viewstmt = $pdo->query("select distinct(item_keys.item_description_id) from item_keys
			inner join product_details on product_details.item_description_id=item_keys.item_description_id
			GROUP BY item_keys.item_description_id order by CAST(sum(item_keys.views) as UNSIGNED) DESC LIMIT $offset, $no_of_records_per_page");
		} else if (isset($_SESSION['id'], $_GET['recent'])) {
			$total_pages_sql = $pdo->query("select views ,item_keys.item_description_id,sub_category.sub_category_id from item_keys
	JOIN item_description ON item_keys.item_description_id=item_description.item_description_id
	join item on item.item_id=item_description.item_id
	join sub_category on item.sub_category_id=sub_category.sub_category_id
	where user_id=" . $_SESSION['id'] . " GROUP BY item_description_id ORDER BY CAST(item_keys.date_of_preview as UNSIGNED) DESC");
			$viewstmt = $pdo->query("select views ,item_keys.item_description_id,sub_category.sub_category_id from item_keys
	JOIN item_description ON item_keys.item_description_id=item_description.item_description_id
	join item on item.item_id=item_description.item_id
	join sub_category on item.sub_category_id=sub_category.sub_category_id
	where user_id=" . $_SESSION['id'] . " GROUP BY item_description_id ORDER BY CAST(item_keys.date_of_preview as UNSIGNED) DESC LIMIT $offset, $no_of_records_per_page");
		} else if (isset($_SESSION['id'], $_GET['prev'])) {
			$total_pages_sql = $pdo->query("select item_description_id from item_keys WHERE rating=0 AND ordered_cnt>0 AND review= '0' and user_id=" . $_SESSION['id'] . "");
			$viewstmt = $pdo->query("select item_description_id from item_keys WHERE rating=0 AND ordered_cnt>0 AND review= '0' and user_id=" . $_SESSION['id'] . " LIMIT $offset, $no_of_records_per_page");
		} else if (isset($_GET['topseller'])) {
			$total_pages_sql = $pdo->query("select distinct(item_keys.item_description_id) from product_details
	join item_keys on item_keys.item_description_id=product_details.item_description_id
	GROUP BY item_description_id order by CAST(sum(item_keys.ordered_cnt) as UNSIGNED) DESC");
			$viewstmt = $pdo->query("select distinct(item_keys.item_description_id) from product_details
	join item_keys on item_keys.item_description_id=product_details.item_description_id
	GROUP BY item_description_id order by CAST(sum(item_keys.ordered_cnt) as UNSIGNED) DESC LIMIT $offset, $no_of_records_per_page");
		} else if (isset($_GET['brand'])) {
			$total_pages_sql = $pdo->query("SELECT item_description.item_description_id FROM brand
	JOIN item_description ON brand.brand_id=item_description.brand
	JOIN product_details ON product_details.item_description_id=item_description.item_description_id
	WHERE brand_name IN('" . $_GET['brand'] . "')
	GROUP BY item_description.item_description_id");
			$viewstmt = $pdo->query("SELECT item_description.item_description_id FROM brand
	JOIN item_description ON brand.brand_id=item_description.brand
	JOIN product_details ON product_details.item_description_id=item_description.item_description_id
	WHERE brand_name IN('" . $_GET['brand'] . "')
	GROUP BY item_description.item_description_id LIMIT $offset, $no_of_records_per_page");
		}
		function addOrUpdateUrlParam($name, $value)
		{
			$params = $_GET;
			unset($params[$name]);
			$params[$name] = $value;
			return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
		}
		if (isset($_GET['popular'])) {
			$total_rows = $total_pages_sql->rowCount();
		} else if (isset($_SESSION['id'], $_GET['recent'])) {
			$total_rows = $total_pages_sql->rowCount();
		} else if (isset($_SESSION['id'], $_GET['prev'])) {
			$total_rows = $total_pages_sql->rowCount();
		} else if (isset($_GET['topseller'])) {
			$total_rows = $total_pages_sql->rowCount();
		} else if (isset($_GET['brand'])) {
			$total_rows = $total_pages_sql->rowCount();
		}
		if (isset($total_rows)) {
			if ($total_rows == 0) {
				$empty_check = 1;
			} else {
				$empty_check = 0;
			}
			$total_pages = ceil($total_rows / $no_of_records_per_page);
		}
		?>
		<div style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"
			class="agile_top_brands_grids">
			<?php
			if ($empty_check == 1) {
				?>
			<div class="product-content-right">
				<center><img style="justify-content: center;" class="sidebar-title"
						src="../../images/logo/error-no-search.png">
					<h2 class="sidebar-title"
						style="text-align: center;color:#2d70ff;display: inline-flex;font-weight: 600;">No result found
					</h2>
				</center>
			</div>
			<center style="margin-bottom:0px;margin-top: 50px;">
				<h4>Can't find requested product ?<a href="../Main/onestore.php"> Try again!</a></h4>
			</center>
			<?php
			} else {
				if (isset($_GET['popular'])) {
					while ($view = $viewstmt->fetch(PDO::FETCH_ASSOC)) {
						$item_desc_id = $view['item_description_id'];
						$res = $pdo->query('select item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item_description
			inner join product_details on product_details.item_description_id=item_description.item_description_id
			inner join item on item.item_id=item_description.item_id
			where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
						$row = $res->fetch(PDO::FETCH_ASSOC);
						?>
			<div class="col-md-3 col-sm-4  col-xs-6 top_brand_left ">
				<div class="hover14 column ">
					<div class="agile_top_brand_left_grid height_set">
						<div class="agile_top_brand_left_grid1">
							<figure>
								<div class="snipcart-item block">
									<div class="snipcart-thumb">
										<div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"> <a class="img-cont"
												href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
													title=" " alt=" " class="img_size"
													src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"></a>
										</div>
										<?php
										if (strlen($row['item_name']) >= 35) {
											$item = $row['item_name'];
											$item_name = substr($item, 0, 22) . "... <small class='div_wrapper' style='color:#109502'>view</small>";
										} else {
											$item_name = $row['item_name'];
										}
										?>
										<p style="margin:auto;display:block;margin:0;margin-top:5px;overflow:hidden"
											class="name_size">
											<?= $item_name ?>
										</p>
										<h4 style="color:green;margin:auto;display:block;margin:0">&#8377;
											<?= $row['price'] ?> <span>&#8377;
												<?= $row['mrp'] ?>
											</span>
										</h4>
									</div>
								</div>
							</figure>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				} else if (isset($_SESSION['id'], $_GET['recent'])) {
					while ($view = $viewstmt->fetch(PDO::FETCH_ASSOC)) {
						$item_desc_id = $view['item_description_id'];
						$res = $pdo->query('select * from item_description
			inner join item on item.item_id=item_description.item_id
			where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
						$row = $res->fetch(PDO::FETCH_ASSOC);
						?>
			<div class="col-md-3 col-sm-4  col-xs-6 top_brand_left ">
				<div class="hover14 column ">
					<div class="agile_top_brand_left_grid height_set">
						<div class="agile_top_brand_left_grid1">
							<figure>
								<div class="snipcart-item block">
									<div class="snipcart-thumb">
										<div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"> <a class="img-cont"
												href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
													title=" " alt=" " class="img_size"
													src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"></a>
										</div>
										<?php
										if (strlen($row['item_name']) >= 35) {
											$item = $row['item_name'];
											$item_name = substr($item, 0, 22) . "... <small class='div_wrapper' style='color:#109502'>view</small>";
										} else {
											$item_name = $row['item_name'];
										}
										?>
										<p style="margin:auto;display:block;margin:0;margin-top:5px;overflow:hidden"
											class="name_size">
											<?= $item_name ?>
										</p>
										<h4 style="color:green;margin:auto;display:block;margin:0">&#8377;
											<?= $row['price'] ?>
										</h4>
									</div>
								</div>
							</figure>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				} else if (isset($_SESSION['id'], $_GET['prev'])) {
					while ($view = $viewstmt->fetch(PDO::FETCH_ASSOC)) {
						$res = $pdo->query("select * from item_description
        inner join item on item.item_id=item_description.item_id
        inner join category on category.category_id=item.category_id
        inner join sub_category on category.category_id=sub_category.category_id
        where item.sub_category_id=sub_category.sub_category_id and item_description_id=" . $view['item_description_id']);
						$row = $res->fetch(PDO::FETCH_ASSOC);
						?>
			<div class="col-md-3 col-sm-4  col-xs-6 top_brand_left ">
				<div class="hover14 column ">
					<div class="agile_top_brand_left_grid height_set">
						<div class="agile_top_brand_left_grid1">
							<figure>
								<div class="snipcart-item block">
									<div class="snipcart-thumb">
										<div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"> <a class="img-cont"
												href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
													title=" " alt=" " class="img_size"
													src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"></a>
										</div>
										<?php
										if (strlen($row['item_name']) >= 35) {
											$item = $row['item_name'];
											$item_name = substr($item, 0, 22) . "... <small class='div_wrapper' style='color:#109502'>view</small>";
										} else {
											$item_name = $row['item_name'];
										}
										?>
										<p style="margin:auto;display:block;margin:0;margin-top:5px;overflow:hidden"
											class="name_size">
											<?= $item_name ?>
										</p>
										<h4 style="color:green;margin:auto;display:block;margin:0">&#8377;
											<?= $row['price'] ?>
										</h4>
									</div>
								</div>
							</figure>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				}
				if (isset($_GET['topseller'])) {
					while ($view = $viewstmt->fetch(PDO::FETCH_ASSOC)) {
						$item_desc_id = $view['item_description_id'];
						$res = $pdo->query('select item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item_description
			inner join product_details on product_details.item_description_id=item_description.item_description_id
			inner join item on item.item_id=item_description.item_id
			where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
						$row = $res->fetch(PDO::FETCH_ASSOC);
						?>
			<div class="col-md-3 col-sm-4  col-xs-6 top_brand_left ">
				<div class="hover14 column ">
					<div class="agile_top_brand_left_grid height_set">
						<div class="agile_top_brand_left_grid1">
							<figure>
								<div class="snipcart-item block">
									<div class="snipcart-thumb">
										<div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"> <a class="img-cont"
												href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
													title=" " alt=" " class="img_size"
													src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"></a>
										</div>
										<?php
										if (strlen($row['item_name']) >= 35) {
											$item = $row['item_name'];
											$item_name = substr($item, 0, 22) . "... <small class='div_wrapper' style='color:#109502'>view</small>";
										} else {
											$item_name = $row['item_name'];
										}
										?>
										<p style="margin:auto;display:block;margin:0;margin-top:5px;overflow:hidden"
											class="name_size">
											<?= $item_name ?>
										</p>
										<h4 style="color:green;margin:auto;display:block;margin:0">&#8377;
											<?= $row['price'] ?> <span>&#8377;
												<?= $row['mrp'] ?>
											</span>
										</h4>
									</div>
								</div>
							</figure>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				}
				if (isset($_GET['brand'])) {
					while ($view = $viewstmt->fetch(PDO::FETCH_ASSOC)) {
						$item_desc_id = $view['item_description_id'];
						$res = $pdo->query('select item.item_id,item.price as \'mrp\',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item_description
			inner join product_details on product_details.item_description_id=item_description.item_description_id
			inner join item on item.item_id=item_description.item_id
			where item_description.item_description_id=' . $item_desc_id . ' GROUP BY item_description.item_description_id');
						$row = $res->fetch(PDO::FETCH_ASSOC);
						?>
			<div class="col-md-3 col-sm-4  col-xs-6 top_brand_left ">
				<div class="hover14 column ">
					<div class="agile_top_brand_left_grid height_set">
						<div class="agile_top_brand_left_grid1">
							<figure>
								<div class="snipcart-item block">
									<div class="snipcart-thumb">
										<div style="display: flex;
  justify-content: center;height: 200px;width:100%;background: white;text-align: center;"> <a class="img-cont"
												href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
													title=" " alt=" " class="img_size"
													src="../../images/<?= $row['category_id'] ?>/<?= $row['sub_category_id'] ?>/<?= $row['item_description_id'] ?>.jpg"></a>
										</div>
										<?php
										if (strlen($row['item_name']) >= 35) {
											$item = $row['item_name'];
											$item_name = substr($item, 0, 22) . "... <small class='div_wrapper' style='color:#109502'>view</small>";
										} else {
											$item_name = $row['item_name'];
										}
										?>
										<p style="margin:auto;display:block;margin:0;margin-top:5px;overflow:hidden"
											class="name_size">
											<?= $item_name ?>
										</p>
										<h4 style="color:green;margin:auto;display:block;margin:0">&#8377;
											<?= $row['price'] ?> <span>&#8377;
												<?= $row['mrp'] ?>
											</span>
										</h4>
									</div>
								</div>
							</figure>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				}
			}
			?>
		</div>
		<div class="clearfix"> </div>
		<div style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"
			class="agile_top_brands_grids">
			<div class="clearfix"> </div>
			<nav class="numbering">
				<ul class="pagination">
					<li class="<?php if ($pageno <= 1) {
						echo 'disabled';
					} ?>">
						<a id="prev" href="<?php if ($pageno <= 1) {
							echo '#';
						} else {
							$_GET['pageno'] = $pageno - 1;
							echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
						} ?>">Prev</a>
					</li>
					<?php
					$ends_count = 1;  //how many items at the ends (before and after [...])
					$middle_count = 1;  //how many items before and after current page
					$dots = false;
					for ($page = 1; $page <= $total_pages; $page++) {
						if ($page == $pageno) {
							?>
					<li class="active">
						<a href="<?php
						$_GET['pageno'] = $page;
						echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET); ?>">
							<?= $page ?>
						</a>
					</li>
					<?php
					$dots = true;
						} else {
							if ($page <= $ends_count || ($pageno && $page >= $pageno - $middle_count && $page <= $pageno + $middle_count) || $page > $total_pages - $ends_count) {
								?>
					<li>
						<a href="<?php
						$_GET['pageno'] = $page;
						echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET); ?>">
							<?= $page ?>
						</a>
					</li>
					<?php
					$dots = true;
							} elseif ($dots) {
								?>
					<li><a>&hellip;</a></li>
					<?php
					$dots = false;
							}
						}
						?>
					<?php
					}
					?>
					<li class="<?php if ($pageno >= $total_pages) {
						echo 'disabled';
					} ?>">
						<a id="next" href="<?php if ($pageno >= $total_pages) {
							echo '#';
						} else {
							$_GET['pageno'] = $pageno + 1;
							echo $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($_GET);
						} ?>">Next</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="clearfix">
		</div>
	</div>
	<!--- products --->
	<?php
	require "../Main/footer.php";
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
		//catactive.className="active";
	</script>
	</body>

	</html>