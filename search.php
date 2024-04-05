<?php 
require('top.php');
$str=mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
	$get_product=get_product($con,'','','',$str);
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
				<?php if(count($get_product)>0){?>
				<div class="shop_details text-center">
					<div class="row">			
						<div class="col-lg-3 col-md-6 col-12">
						<?php
						    foreach($get_product as $list){
						?>	
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
						echo " Data not found ";
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