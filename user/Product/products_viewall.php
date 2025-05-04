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
			if (isset($_GET['item'])) {
				$nm = ucwords($_GET['item']);
				$res1 = $pdo->query("select* from item where item_name like '%" . $nm . "%'");
				$row = $res1->fetch(PDO::FETCH_ASSOC);
				$head = "Items related to '" . $nm . "'";
			} else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
				$cat = $_GET['category_id'];
				$sub = $_GET['subcategory_id'];
				$res1 = $pdo->query("select* from sub_category where sub_category_id=" . $_GET['subcategory_id']);
				$row = $res1->fetch(PDO::FETCH_ASSOC);
				$head = $row['sub_category_name'];
			} else if (isset($_GET['category_id'])) {
				$res1 = $pdo->query("select* from category where category_id=" . $_GET['category_id']);
				$row = $res1->fetch(PDO::FETCH_ASSOC);
				$head = $row['category_name'];
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
		if (isset($_GET['item'])) {
			$nm = ucwords($_GET['item']);
			$total_pages_sql = $pdo->query("select COUNT(*) from item
			inner join item_description on item_description.item_id=item.item_id
			inner join product_details on product_details.item_description_id=item_description.item_description_id
			inner join category on category.category_id=item.category_id
			inner join sub_category on category.category_id=sub_category.category_id
			where item.item_name like \"%$nm%\" and sub_category.sub_category_id=item.sub_category_id");
			$res = $pdo->query("select item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
        		inner join product_details on product_details.item_description_id=item_description.item_description_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id=sub_category.category_id
        		where item.item_name like \"%$nm%\" and sub_category.sub_category_id=item.sub_category_id
				LIMIT $offset, $no_of_records_per_page");
		} else if (isset($_GET['category_id']) && isset($_GET['subcategory_id'])) {
			$cat = $_GET['category_id'];
			$sub = $_GET['subcategory_id'];
			$total_pages_sql = $pdo->query("select COUNT(*) from item
			inner join item_description on item_description.item_id=item.item_id
			inner join product_details on product_details.item_description_id=item_description.item_description_id
			inner join sub_category on sub_category.sub_category_id=item.sub_category_id
			inner join category on category.category_id=sub_category.category_id
			where sub_category.sub_category_id=item.sub_category_id and category.category_id='$cat' and sub_category.sub_category_id='$sub' ");
			$res = $pdo->query("select store.store_name ,item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
	        	inner join item_description on item_description.item_id=item.item_id
                inner join product_details on product_details.item_description_id=item_description.item_description_id
                inner join store on product_details.store_id=store.store_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id= sub_category.category_id
	        	where sub_category.sub_category_id=item.sub_category_id and category.category_id='$cat'
				 and sub_category.sub_category_id='$sub' LIMIT $offset, $no_of_records_per_page");
		} else if (isset($_GET['category_id'])) {
			$cat = $_GET['category_id'];
			$total_pages_sql = $pdo->query("select COUNT(*),item.category_id from item
				inner join item_description on item_description.item_id=item.item_id
				inner join product_details on product_details.item_description_id=item_description.item_description_id
				inner join category on category.category_id=item.category_id
				inner join sub_category on category.category_id= sub_category.category_id
				GROUP BY item.item_id HAVING item.category_id=$cat");
			$res = $pdo->query("select item.item_id,item.price as 'mrp',product_details.price,item_description.item_description_id,item.item_name,item.description,item.category_id,item.sub_category_id from item
        		inner join item_description on item_description.item_id=item.item_id
        		inner join product_details on product_details.item_description_id=item_description.item_description_id
        		inner join category on category.category_id=item.category_id
        		inner join sub_category on category.category_id=sub_category.category_id
        		GROUP BY item.item_id HAVING item.category_id=$cat LIMIT $offset, $no_of_records_per_page");
		}
		function addOrUpdateUrlParam($name, $value)
		{
			$params = $_GET;
			unset($params[$name]);
			$params[$name] = $value;
			return basename($_SERVER['PHP_SELF']) . '?' . http_build_query($params);
		}
		if (isset($_GET['category_id']) && !isset($_GET['subcategory_id'])) {
			$total_rows = $total_pages_sql->rowCount();
		} else {
			$row = $total_pages_sql->fetch(PDO::FETCH_ASSOC);
			$total_rows = $row['COUNT(*)'];
		}
		$total_pages = ceil($total_rows / $no_of_records_per_page);
		$rcount = $res->rowCount();
		?>
		<div style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"
			class="agile_top_brands_grids">
			<?php
			if ($rcount < 1) {
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
				while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
					?>
			<div class="col-md-3 col-sm-4  col-xs-6 top_brand_left ">
				<div class="hover14 column ">
					<div class="agile_top_brand_left_grid height_set">
						<div class="agile_top_brand_left_grid1">
							<figure>
								<div class="snipcart-item block">
									<div class="snipcart-thumb">
										<div style="display: flex;
									justify-content: center;height: 200px;width:100%;background: white;text-align:
									center;"> <a class="img-cont" href="../Product/single.php?id=<?= $row['item_description_id'] ?>"><img
													title=" " alt=" " class="img_size" src="../../images/
									<?= $row['category_id'] ?>/
									<?= $row['sub_category_id'] ?>/
									<?= $row['item_description_id'] ?>.jpg"></a>
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
											<span>&#8377;
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
			?>
		</div>
		<div class="clearfix"> </div>
		<div style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"
			class="agile_top_brands_grids">
			<div class="clearfix"> </div>
			<?php
			if ($total_pages != 1) {
				?>
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
						<a href=" <?php
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
			<?php
			}
			?>
		</div>
		<div class=" clearfix">
		</div>
	</div> <!--- products --->
	<?php
	require "../Main/footer.php";
	?>
	<script type="text/javascript">
		const homeactive = document.querySelector('#homeactive');
		//const catactive=document.querySelector('#catactive');
		const aboutactive = document.querySelector('#aboutactive ');
		const contactactive = document.querySelector('#contactactive ');
		homeactive.className = "";
		//catactive.className="";
		aboutactive.className = "";
		contactactive.className = "";
		//catactive.className="active";
	</script>
	</body>

	</html>