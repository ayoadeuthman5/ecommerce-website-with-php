<?php 
require('top.php');

if(!isset($_GET['id']) && $_GET['id']!=''){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}

$cat_id=mysqli_real_escape_string($con,$_GET['id']);

$sub_categories='';
if(isset($_GET['sub_categories'])){
	$sub_categories=mysqli_real_escape_string($con,$_GET['sub_categories']);
}
$price_high_selected="";
$price_low_selected="";
$new_selected="";
$old_selected="";
$sort_order="";
if(isset($_GET['sort'])){
	$sort=mysqli_real_escape_string($con,$_GET['sort']);
	if($sort=="price_high"){
		$sort_order=" order by product.price desc ";
		$price_high_selected="selected";	
	}if($sort=="price_low"){
		$sort_order=" order by product.price asc ";
		$price_low_selected="selected";
	}if($sort=="new"){
		$sort_order=" order by product.id desc ";
		$new_selected="selected";
	}if($sort=="old"){
		$sort_order=" order by product.id asc ";
		$old_selected="selected";
	}

}

if($cat_id>0){
	$get_product=get_product($con,'',$cat_id,'','',$sort_order,'',$sub_categories);
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}										
?>
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Shop</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Shop</span></li>
						</ul>					
					</div>	

				</div>
			</div>
		</div>
		
		
		<!-- Shop Product Area -->
		<div class="shop_page_area">
			<div class="container">
				<div class="shop_bar_tp fix">
					<div class="row">
                        <?php if(count($get_product)>0){?>
						<div class="col-sm-6 col-xs-12 short_by_area">
							<div class="short_by_inner">
								<label>short by:</label>
								<!--<select class="sort-select">
									<option>Name Descending</option>
									<option>Date Descending</option>
									<option>Price Descending</option>
								</select>-->
                                <select class="sort-select" class="ht__select" onchange="sort_product_drop('<?php echo $cat_id?>','<?php echo SITE_PATH?>')" id="sort_product_id">
                                        <option value="">Default softing</option>
                                        <option value="price_low" <?php echo $price_low_selected?>>Sort by price low to hight</option>
                                        <option value="price_high" <?php echo $price_high_selected?>>Sort by price high to low</option>
                                        <option value="new" <?php echo $new_selected?>>Sort by new first</option>
										<option value="old" <?php echo $old_selected?>>Sort by old first</option>
                                    </select>
							</div>
						</div>

						<div class="col-sm-6 col-xs-12 show_area">
							<div class="show_inner">
								<label>show:</label>
								<select class="show-select">
									<option>8</option>
									<option>12</option>
									<option>30</option>
									<option>ALL</option>
								</select>
							</div>
						</div>
					</div>
				</div>	
					
				<div class="shop_details text-center">
					<div class="row">
                         <?php
						    foreach($get_product as $list){
						?>				
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="product.php?id=<?php echo $list['id']?>">
										<img class="pic-1" src="<?php echo 'media/product_images/'.$list['image']?>" alt="product image">
										<img class="pic-2" src="<?php echo 'media/product_images/'.$list['image']?>" alt="product image">
									</a>
									<ul class="social">
										<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="product.php?id=<?php echo $list['id']?>" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">Sale</span>
								</div>
								
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="product-details.html"><?php echo $list['name']?></a></h3>
									<div class="price"><?php echo $list['mrp']?>
										<span><?php echo $list['price']?></span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->	
						
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="img/product/3.jpg" alt="product image">
										<img class="pic-2" src="img/product/4.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="#" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">-20%</span>				
								</div>
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="#">Product Title</a></h3>
									<div class="price">$23.00
										<span>$25.00</span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->	
								
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="img/product/5.jpg" alt="product image">
										<img class="pic-2" src="img/product/6.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="#" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">Sale</span>
								</div>
								
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="#">Product Title</a></h3>
									<div class="price">$40.00
										<span>$35.00</span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->	

						
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="img/product/7.jpg" alt="product image">
										<img class="pic-2" src="img/product/8.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="#" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">New</span>
								</div>
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="#">Product Title</a></h3>
									<div class="price">$80.00
										<span>$60.00</span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->			
						
						
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="img/product/5.jpg" alt="product image">
										<img class="pic-2" src="img/product/6.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="#" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">Sale</span>
								</div>
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="#">Product Title</a></h3>
									<div class="price">$30.00
										<span>$21.00</span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->			
						
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="img/product/1.jpg" alt="product image">
										<img class="pic-2" src="img/product/2.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="#" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">-30%</span>
								</div>
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="#">Product Title</a></h3>
									<div class="price">$70.00
										<span>$25.00</span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->		
						
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="img/product/7.jpg" alt="product image">
										<img class="pic-2" src="img/product/8.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="#" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">Sale</span>
								</div>
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="#">Product Title</a></h3>
									<div class="price">$100.00
										<span>$80.00</span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->	

						
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="img/product/3.jpg" alt="product image">
										<img class="pic-2" src="img/product/4.jpg" alt="product image">
									</a>
									<ul class="social">
										<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="#" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
										<li><a href="#" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
									</ul>
									<span class="product-new-label">-50%</span>
								</div>
								<div class="product-content">
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									
									<h3 class="title"><a href="#">Product Title</a></h3>
									<div class="price">$100.00
										<span>$50.00</span>
									</div>
								</div>
							</div>
						</div><!-- End Col -->							
						<?php } ?>						
					</div>
					<?php } else { 
						echo " DData not found ";
					} ?>
				</div>
					
				<!-- Blog Pagination -->
				<div class="col-12">
					<div class="blog_pagination pgntn_mrgntp fix">
						<div class="pagination text-center">
							<ul>
								<li><a href="#"><i class="fa fa-angle-left"></i></a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#" class="active">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
					</div>
				</div>	
			</div>
		</div>
        <input type="hidden" id="qty" value="1"/>
        <?php require('footer.php')?> 