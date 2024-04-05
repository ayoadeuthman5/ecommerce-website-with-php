<?php
include("top.php");

$resBanner=mysqli_query($con,"select * from banner where status='1' order by order_no asc");

?>
<!-- Start Slider Area -->
			<section id="slider_area">
			<?php if(mysqli_num_rows($resBanner)>0){ ?>
				<div class="slider_active owl-carousel">
				<?php while($rowBanner=mysqli_fetch_assoc($resBanner)){?>
					<div class="single_slide">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="single-slide-item-table">
										<div class="single-slide-item-tablecell">
											<div class="slider_content text-start slider-animated-2">						
												<h4 class="animated"><?php echo $rowBanner['heading1']; ?> </h4>
												<h1 class="animated"><?php echo $rowBanner['heading2']; ?> </h1>
												<?php
												if($rowBanner['btn_txt'] !='' && $rowBanner['btn_link']!=''){
												?>
												<a class="main_btn animated" href="<?php echo $rowBanner['btn_link']?>"><?php echo $rowBanner['btn_txt']?></a>
												<?php } ?>
											</div>
										</div>
									</div>	
								</div>
								
								<div class="col-lg-6 col-12 text-end">
								<img src="<?php echo 'media/banner/'.$rowBanner['image']?>" alt="Slider Image" >
								</div>
							</div>
							
						</div>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
			</section>
		<!-- End Slider Area -->		
	
		<!--  Promo ITEM STRAT  -->
			<section id="promo_area" class="section_padding">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12">							
							<div class="single_promo bg-color">
								<img src="img/promo/1.png" alt="promo image">
								<div class="box-content">
									<div class="promo-content">
										<span class="post">2021 Collection</span>
										<h3 class="title">Shoes</h3>
										<a href="#">Shop Now</a>
									</div>
								</div>
							</div>													
						</div><!--  End Col -->						
						
						<div class="col-lg-4 col-md-6 col-sm-12">							
							<div class="single_promo bg-color2">
								<img src="img/promo/2.png" alt="promo image">
								<div class="box-content">
									<div class="promo-content">
										<span class="post">Sprint Collection</span>
										<h3 class="title">Watch</h3>
										<a href="#">Shop Now</a>
									</div>
								</div>
							</div>														
						</div><!--  End Col -->					

						<div class="col-lg-4 col-md-6 col-sm-12">					
							<div class="single_promo bg-color3">
								<img src="img/promo/3.png" alt="promo image">
								<div class="box-content">
									<div class="promo-content">
										<span class="post">Exclusive Desgin</span>
										<h3 class="title">Bags</h3>									
										<a href="#">Shop Now</a>
									</div>
								</div>
							</div>									
						</div><!--  End Col -->					
					</div>			
				</div>		
			</section>
		<!--  Promo ITEM END -->	
		

<!-- Start product Area -->
<section id="product_area" class="section_padding">
				<div class="container">		
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="section_title">	
								<span class="sub-title">All Products</span>
								<h2>Our Products</h2>
								<div class="divider"></div>							
							</div>
						</div>
					</div>
				
					<div class="text-center">
						<div class="product_filter">
							<ul>
								<li class=" active filter" data-filter="all">All</li>
								<li class="filter" data-filter=".sale">Sale</li>
								<li class="filter" data-filter=".bslr">Bestseller</li>
								<li class="filter" data-filter=".ftrd">Featured</li>
							</ul>
						</div>
						
						<div class="product_item">
							<div class="row">		
							<?php
							$get_product=get_product($con,4,'','','','','yes');
							foreach($get_product as $list){
							?>
								<div class="col-lg-3 col-md-6 col-12 mix sale">
									<div class="product-grid">
										<div class="product-image">
											<a href="product.php?id=<?php echo $list['id']?>">
												<img class="pic-1" src="<?php echo 'media/product_images/'.$list['image']?>" alt="product image">
												<img class="pic-2" src="<?php echo 'media/product_images/'.$list['image']?>" alt="product image">
											</a>
											<ul class="social">
												<li><a href="product.php?id=<?php echo $list['id']?>" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
												<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
												<li><a href="product.php?id=<?php echo $list['id']?>" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
											</ul>
											
										</div>
										
										<div class="product-content">
											<ul class="rating">
												<li class="fa fa-star"></li>
												<li class="fa fa-star"></li>
												<li class="fa fa-star"></li>
												<li class="fa fa-star"></li>
												<li class="fa fa-star"></li>
											</ul>
											
											<h3 class="title"><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h3>
											<div class="price">
												<span class="new">&#8358;<?php echo $list['price']?></span>
												<span class="new"><del>&#8358;<?php echo $list['mrp']?></del></span>
												
											</div>
										</div>
									</div>
								</div><!-- End Col -->	
								
								<div class="col-lg-3 col-md-6 col-12 mix ftrd">
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
										
								<div class="col-lg-3 col-md-6 col-12 mix">
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
											</div>
										</div>
									</div>
								</div><!-- End Col -->	

								
								<div class="col-lg-3 col-md-6 col-12 mix sale bslr">
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
								
								
								<div class="col-lg-3 col-md-6 col-12 mix ftrd">
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
												
											</div>
										</div>
									</div>
								</div><!-- End Col -->			
								
								<div class="col-lg-3 col-md-6 col-12 mix sale bslr">
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
								
								<div class="col-lg-3 col-md-6 col-12 mix sale bslr">
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
												
											</div>
										</div>
									</div>
								</div><!-- End Col -->	

								
								<div class="col-lg-3 col-md-6 col-12 mix sale bslr">
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
						</div>
					</div>
				</div>
			</section>
		<!-- End product Area -->


		<!-- Special Offer Area -->
			<div class="special_offer_area section_padding">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-12 text-left">
							<div class="special_info">			
								<span>Hurry Up! Offer Ends In</span>
								<h3>Summer Flash Sale </h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et tincidunt lacus. Suspendisse ut odio tellus. Maecenas sollicitudin maximus erat vel malesuada In eu eros ut tellus tempus.  </p>																		
								<div id="countdown" class="text-center"></div>	
								<div class="clearfix"></div>
								<a href="#" class="main_btn">Shop Now</a>					
							</div>
						</div>
						
						<div class="col-lg-6 col-md-12 col-12">
							<div class="special_img_wrap text-end">						
								<div class="special_img">
									<img src="img/purple-blazer.png" width="350" alt="Offer Image" class="img-responsive">
									<span class="off_baudge text-center">30% <br /> <span>Discount</span></span>						
								</div>
							</div>
						</div>	
					</div>

				</div>
			</div>
		<!-- End Special Offer Area -->

		<!-- Start Featured product Area -->
			<section id="featured_product" class="featured_product_area section_padding">
				<div class="container">		
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="section_title">	
								<span class="sub-title">New Arrivals Products From Shop</span>
								<h2>New Products</h2>
								<div class="divider"></div>							
							</div>
						</div>
					</div>
						
					<div class="row text-center">	
							<?php
							$get_product=get_product($con,4);
							foreach($get_product as $list){
							?>				
						<div class="col-lg-3 col-md-6 col-12">
							<div class="product-grid">
								<div class="product-image">
									<a href="product.php?id=<?php echo $list['id']?>">
										<img class="pic-1" src="<?php echo 'media/product_images/'.$list['image']?>" alt="product images">
										<img class="pic-2" src="<?php echo 'media/product_images/'.$list['image']?>" alt="product images">
									</a>
									<ul class="social">
										<li><a href="product.php?id=<?php echo $list['id']?>" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
										<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')" data-tip="Add to Wishlist"><i class="pe-7s-like"></i></a></li>
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
									
									<h3 class="title"><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h3>
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
					</div>
					<?php } ?>
				</div>
			</section>
		<!-- End Featured Products Area -->

		<!-- Testimonials Area -->
			<section id="testimonials" class="testimonials_area" style="background: url(img/testimonial-bg.jpg); background-size: cover; background-attachment: fixed;">
				<div class="container">
					<div class="row">
						<div class="col-md-12 center-block">
							<div id="testimonial-slider" class="owl-carousel text-center">
								<div class="testimonial">
									<div class="testimonial-content">
										<div class="pic">
											<img src="img/testimonial/1.jpg" alt="">
										</div>
										
										<p class="description">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam risus felis, bibendum 
											eu finibus semper tincidunt. 
										</p>
										
										<div class="test-bottom text-center">
											<div class="test-des-area">
												<h3 class="testimonial-title">williamson</h3>
												<small class="post"> - Themesvila</small>
											</div>
										</div>
									</div>
								</div>
				 
								<div class="testimonial">
									<div class="testimonial-content">
										<div class="pic">
											<img src="img/testimonial/2.jpg" alt="">
										</div>
										
										<p class="description">									
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam risus felis, bibendum 
											eu finibus semper tincidunt.
										</p>
										<div class="test-bottom text-center">
											<div class="test-des-area">
												<h3 class="testimonial-title">Susana</h3>
												<small class="post"> - Themesvila</small>
											</div>
										</div>
									</div>
								</div>
								
								
								<div class="testimonial">
									<div class="testimonial-content">
										<div class="pic">
											<img src="img/testimonial/3.jpg" alt="">
										</div>
										<p class="description">
											Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam risus felis, bibendum 
											eu finibus semper tincidunt.
										</p>
										<div class="test-bottom text-center">
											<div class="test-des-area">			
												<h3 class="testimonial-title">Michel</h3>
												<small class="post"> - Themesvila</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<!-- End STestimonials Area -->		
		
        <!--  Blog -->
			<section id="blog_area" class="section_padding">
				<div class="container">	
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="section_title">	
								<span class="sub-title">News From Blog</span>
								<h2>News & Articles</h2>
								<div class="divider"></div>							
							</div>
						</div>
					</div>			
					
					<div class="row">	
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="single_blog">
								<div class="single_blog_img">
									<img src="img/blog/1.jpg" alt="">
									<div class="blog_date text-center">
										<div class="bd_day"> 28</div>
										<div class="bd_month">Sep</div>
									</div>
								</div>
													
								<div class="blog_content">									
									<ul class="post-meta">
										<li><i class="ti-user"></i> <a href="#">Admin</a></li>									
										<li><i class="ti-comments"></i> <a href="#">2 comments</a></li>
									</ul>	
									<h4 class="post_title"><a href="#">A Woman Holding Shopping Bags</a> </h4>								
									<p>Proin in blandit lacus. Nam pellentesque tortor eget dui feugiat venenatis ....</p>
								</div>
							</div>
						</div> <!--  End Col -->				
						
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="single_blog">
								<div class="single_blog_img">
									<img src="img/blog/2.jpg" alt="">
									<div class="blog_date text-center">
										<div class="bd_day"> 20</div>
										<div class="bd_month">JUl</div>
									</div>
								</div>
													
								<div class="blog_content">													
									<ul class="post-meta">
										<li><i class="ti-user"></i> <a href="#">Admin</a></li>									
										<li><i class="ti-comments"></i> <a href="#">2 comments</a></li>
									</ul>
									<h4 class="post_title"><a href="#">Offer 50% off on all Clothes </a> </h4>	
									<p>Proin in blandit lacus. Nam pellentesque tortor eget dui feugiat venenatis ....</p>
								</div>
							</div>
						</div> <!--  End Col -->				
						
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="single_blog">
								<div class="single_blog_img">
									<img src="img/blog/3.jpg" alt="">
									<div class="blog_date text-center">
										<div class="bd_day"> 26</div>
										<div class="bd_month">Aug</div>
									</div>
								</div>
													
								<div class="blog_content">
									<ul class="post-meta">
										<li><i class="ti-user"></i> <a href="#">Admin</a></li>									
										<li><i class="ti-comments"></i> <a href="#">2 comments</a></li>
									</ul>
									<h4 class="post_title"><a href="#">Family Doing Grocery Shopping</a> </h4>
									<p>Proin in blandit lacus. Nam pellentesque tortor eget dui feugiat venenatis ....</p>
								</div>
							</div>
						</div> <!--  End Col -->

					</div>
				</div>
			</section>
        <!--  Blog end -->
		

        <!--  Process -->
			<section class="process_area section_padding">
				<div class="container">
					<div class="row text-center">		
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="single-process">
								<!-- process Icon -->
								<div class="picon"><i class="ti-truck"></i></div>
								<!-- process Content -->
								<div class="process_content">
									<h3>Free Shipping</h3>
									<p>Best Shipping Service</p>
								</div>
							</div>	
						</div>	<!-- End Col -->				

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="single-process">
								<!-- process Icon -->
								<div class="picon"><i class="ti-credit-card"></i></div>
								<!-- process Content -->
								<div class="process_content">
									<h3>Cash On Delivery</h3>
									<p>Fast Delivery Method</p>
								</div>
							</div>	
						</div>	<!-- End Col -->				

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="single-process">
								<!-- process Icon -->
								<div class="picon"><i class="ti-headphone-alt"></i></div>
								<!-- process Content -->
								<div class="process_content">
									<h3>Support 24/7</h3>
									<p>24 Hours a Day</p>
								</div>
							</div>	
						</div>	<!-- End Col -->				

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="single-process">
								<!-- process Icon -->
								<div class="picon"><i class="ti-alarm-clock"></i></div>
								<!-- process Content -->
								<div class="process_content">
									<h3>30 Days Return</h3>
									<p>Simply Return 30 Days</p>
								</div>
							</div>	
						</div>	<!-- End Col -->
						
					</div>
				</div>
			</section>
        <!--  End Process -->
		
		<!--  Brand -->
			<section id="brand_area" class="text-center">
				<div class="container">					
					<div class="row">
						<div class="col-sm-12">
							<div class="brand_slide owl-carousel">
								<div class="item text-center"> <a href="#"><img src="img/brand/1.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/2.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/3.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/4.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/5.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/6.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/7.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/8.png" alt="" class="img-responsive" /></a> </div>
								<div class="item text-center"> <a href="#"><img src="img/brand/9.png" alt="" class="img-responsive" /></a> </div>
							</div>
						</div>
					</div>
				</div>        
			</section>        
        <!--   Brand end  -->			
		<input type="hidden" id="qty" value="1"/>
		<?php require('footer.php')?>        