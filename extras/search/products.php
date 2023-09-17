<?php
require "header.php";
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Products</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!--- products --->
	<div class="products">
		<div class="container">
			<div class="col-md-4 products-left">
				<div class="categories">
					<h2>Categories</h2>
					<ul class="cate">
						<li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>All Groceries</a></li>
							<ul>
								<li><a href="products.php?category=Grocery and Gourmet Foods & subcategory=Cereal and Muesli"><i class="fa fa-arrow-right" aria-hidden="true"></i>Cereal and Muesli</a></li>
								<li><a href="products.php?category=Grocery and Gourmet Foods & subcategory=Coffee, Tea and Beverages"><i class="fa fa-arrow-right" aria-hidden="true"></i>Coffee, Tea and Beverages</a></li>
								<li><a href="products.php?category=Grocery and Gourmet Foods & subcategory=Snack Foods"><i class="fa fa-arrow-right" aria-hidden="true"></i>Snack Foods</a></li>

							</ul>
						<li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>Household</a></li>
							<ul>
								<li><a href="products.php?category=House hold & subcategory=kitchen"><i class="fa fa-arrow-right" aria-hidden="true"></i>Kitchen</a> </li>
								<li><a href="products.php?category=House hold & subcategory=home"><i class="fa fa-arrow-right" aria-hidden="true"></i>Home</a> </li>

							</ul>

					</ul>
				</div>																																											
			</div>
			<div class="col-md-8 products-right">
				<div class="products-right-grid">
					<div class="products-right-grids">
						<div class="sorting">
							<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting</option>
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by popularity</option> 
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by average rating</option>					
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price</option>								
							</select>
						</div>
						<div class="sorting-left">
							<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 9</option>
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 18</option> 
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 32</option>					
								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>All</option>								
							</select>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>

<?php
        require "pdo.php";
        if(isset($_GET['item'])){
        	$nm=$_GET['item'];
        	        $res=$pdo->query("select * from item where item_name like '%$nm%'");

        }
        else{
        	$cat=$_GET['category'];
        $sub=$_GET['subcategory'];
        $res=$pdo->query("select * from item where category='$cat' and sub_category='$sub'");
 
        }

?>        	

				<div class="agile_top_brands_grids">

<?php
$cn=0;
          while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
            $cn++;
?>


					<div class="col-md-4 top_brand_left ">
						<div class="hover14 column ">
							<div class="agile_top_brand_left_grid height_set">
								<div class="agile_top_brand_left_grid_pos">
									<img src="images/offer.png" alt=" " class="img-responsive ">
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<a href="single.php?id=<?=$row['item_id']?>"><img title=" " alt=" " class="img_size" src="images/<?=$row['category']?>/<?=$row['sub_category']?>/<?=$row['item_id']?>.jpg"></a>		
												<p class="name_size"><?=$row['item_name']?></p>
												<h4>$35.99 <span>$55.00</span></h4>
											</div>
											<div class="snipcart-details top_brand_home_details">
												<form action="#" method="post">
													<fieldset>
														<input type="hidden" name="cmd" value="_cart">
														<input type="hidden" name="add" value="1">
														<input type="hidden" name="business" value=" ">
														<input type="hidden" name="item_name" value="Fortune Sunflower Oil">
														<input type="hidden" name="amount" value="35.99">
														<input type="hidden" name="discount_amount" value="1.00">
														<input type="hidden" name="currency_code" value="USD">
														<input type="hidden" name="return" value=" ">
														<input type="hidden" name="cancel_return" value=" ">
														<input type="submit" name="submit" value="Add to cart" class="button">
													</fieldset>
												</form>
											</div>
										</div>
									</figure>
								</div>
							</div>
						</div>
					</div>
<?php					
	if($cn>=3){

?>
				</div>
				<div class="clearfix"> </div>
				<div class="agile_top_brands_grids">
<?php
	}
}


?>
<div class="clearfix"> </div>
<nav class="numbering">
					<ul class="pagination paging">
						<li>
							<a href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li>
							<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		<div class="clearfix">	
	</div>
</div>
</div>
<!--- products --->
<?php
require "footer.php";
?>

<script type="text/javascript">
$(document).ready(function(){
    const loader = document.querySelector(".loader");
    console.log(loader);
    loader.className += " hidden";
});
</script>
</body>
</html>