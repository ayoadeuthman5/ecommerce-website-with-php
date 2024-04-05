<?php 
ob_start();
require('top.php');
if(isset($_GET['id'])){
	$product_id=mysqli_real_escape_string($con,$_GET['id']);
	if($product_id>0){
		$get_product=get_product($con,'','',$product_id);
	}else{
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}
	
	$resMultipleImages=mysqli_query($con,"select product_images from product_images where product_id='$product_id'");
	$multipleImages=[];
	if(mysqli_num_rows($resMultipleImages)>0){
		while($rowMultipleImages=mysqli_fetch_assoc($resMultipleImages)){
			$multipleImages[]=$rowMultipleImages['product_images'];
		}
	}
	
	$resAttr=mysqli_query($con,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
	left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
	left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
	where product_attributes.product_id='$product_id'");
	$productAttr=[];
	$colorArr=[];
	$sizeArr=[];
	if(mysqli_num_rows($resAttr)>0){
		while($rowAttr=mysqli_fetch_assoc($resAttr)){
			$productAttr[]=$rowAttr;
			$colorArr[$rowAttr['color_id']][]=$rowAttr['color'];
			$sizeArr[$rowAttr['size_id']][]=$rowAttr['size'];
			
			$colorArr1[]=$rowAttr['color'];
			$sizeArr1[]=$rowAttr['size'];
		}
	}
	$is_size=count(array_filter($sizeArr1));
	$is_color=count(array_filter($colorArr1));
	//$colorArr=array_unique($colorArr);
	//$sizeArr=array_unique($sizeArr1);
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}

if(isset($_POST['review_submit'])){
	$rating=get_safe_value($con,$_POST['rating']);
	$review=get_safe_value($con,$_POST['review']);
	
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into product_review(product_id,user_id,rating,review,status,added_on) values('$product_id','".$_SESSION['USER_ID']."','$rating','$review','1','$added_on')");
	header('location:product_details.php?id='.$product_id);
	die();
}


$product_review_res=mysqli_query($con,"select users.name,product_review.id,product_review.rating,product_review.review,product_review.added_on from users,product_review where product_review.status=1 and product_review.user_id=users.id and product_review.product_id='$product_id' order by product_review.added_on desc");

?>
<!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Shop Details</h3>
				</div>		

				<div class="col-sm-6 text-end">
					<ul class="p_items">
						<li><a href="index.php">home</a></li>
						<li><a href="categories.php?id=<?php echo $get_product['0']['categories_id']?>"><?php echo $get_product['0']['categories']?></a></li>
						<li><span><?php echo $get_product['0']['name']?></span></li>
					</ul>					
				</div>						
			</div>
		</div>
	</div>

	<!-- Product Details Area  -->
	<div class="prdct_dtls_page_area">
		<div class="container">
			<div class="row">
				<!-- Product Details Image -->
				<div class="col-md-6 col-xs-12">
					<div class="pd_img fix">
						<a class="venobox" href="img/product/3.jpg"><img src="<?php echo 'media/product_images/'.$get_product['0']['image']?>" alt=""/></a>
					</div>
				</div>
				<!-- Product Details Content -->
				<div class="col-md-6 col-xs-12">
					<div class="prdct_dtls_content">
						<h3 class="title"><?php echo $get_product['0']['name']?></a></h3>
						<div class="pd_price_dtls fix">
							<!-- Product Price -->
							<div class="pd_price" class="pro__prize">
								<span class="new"class="new__price"><del>&#8358;<?php echo $get_product['0']['mrp']?></del></span>
								<span class="new" class="old__prize">&#8358;<?php echo $get_product['0']['price']?></span>
							</div>
							<!-- Product Ratting -->
							<div class="pd_ratng">
								<div class="rtngs">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</div>
							</div>
						</div>
						<div class="pd_text">
							<h4>overview:</h4>
							<p><?php echo $get_product['0']['short_desc']?></p>
						</div>
						<?php 
									$cart_show='yes';
									$is_cart_box_show="hide";
									if($is_color==0 && $is_size==0){
										$is_cart_box_show="";
									?>
						<div class="pd_text">
						<?php
											$getProductAttr=getProductAttr($con,$get_product['0']['id']);
										
											$productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id'],$getProductAttr);
											
											$pending_qty=$get_product['0']['qty']-$productSoldQtyByProductId;
											
											$cart_show='yes';
											if($get_product['0']['qty']>$productSoldQtyByProductId){
												$stock='In Stock';			
											}else{
												$stock='Not in Stock';
												$cart_show='';
											}
										
										?>
							<h4>Availability:<?php echo $stock?></h4>
						</div>
						<?php } ?>
						<?php if($is_size>0){?>
						<div class="pd_img_size fix">
							<h4>size:</h4>
							<select class="select__size" id="size_attr" onchange="showQty()">
											<option value="">Select</option>
											<?php 
											foreach($sizeArr as $key=>$val){
												echo "<option value='".$key."'>".$val[0]."</option>";
											}
											?>
											
										</select>
						</div>
							<?php	} ?>
						<div class="pd_clr_qntty_dtls fix">
						<?php if($is_color>0){?>
							<div class="pd_clr">
								<h4>color:</h4>
								<?php 
								foreach($colorArr as $key=>$val){
								echo "<a class='active' style='background:".$val[0]." none repeat scroll 0 0' href='javascript:void(0)' onclick=loadAttr('".$key."','".$get_product['0']['id']."','color')>".$val[0]."</a>";
								}?>
							</div>
							<?php } ?>
							<?php
									$isQtyHide="hide";
									if($is_color==0 && $is_size==0){
										$isQtyHide="";
									}
									?>
							<div class="pd_qntty_area <?php echo $isQtyHide ?>" id="cart_qty">
							<?php
										if($cart_show!=''){
										?>
								<h4>quantity:</h4>
								<!--<div class="pd_qty fix">-->
								<select id="qty"  class="select__size">
											<?php
											for($i=1;$i<=$pending_qty;$i++){
												echo "<option>$i</option>";
											}
											?>
										</select>
								<!--</div>-->
								<?php } ?>
							</div>
							<div id="cart_attr_msg" class="color:red;"></div>
						</div>
						<!-- Product Action -->
						<div class="pd_btn fix">
							<a class="btn btn-default acc_btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">add to Cart</a>
							<a class="btn btn-default acc_btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add','yes')">Buy Now</a><br>
							<a class="btn btn-default acc_btn btn_icn"><i class="fa fa-heart"></i></a>
							<a class="btn btn-default acc_btn btn_icn"><i class="fa fa-refresh"></i></a>
						</div>
						<div class="pd_share_area fix">
							<h4>share this on:</h4>
							<div class="pd_social_icon">
								<a class="facebook" href="https://facebook.com/share.php?u=<?php echo $meta_url?>"><i class="fa fa-facebook"></i></a>
								<a class="twitter" href="https://twitter.com/share?text=<?php echo $get_product['0']['name']?>&url=<?php echo $meta_url?>"><i class="fa fa-twitter"></i></a>
								<a class="vimeo" href="#"><i class="fa fa-vimeo"></i></a>
								<a class="google_plus" href="#"><i class="fa fa-google-plus"></i></a>
								<a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a>
								<a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" id="cid"/>
			<input type="hidden" id="sid"/>
			<div class="row">
				<div class="col-xs-12">					
					<div class="pd_tab_area fix">	

						<ul class="nav nav-pills mb-3 text-center" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
							</li>
							
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="pills-information-tab" data-bs-toggle="pill" data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information" aria-selected="false">Information</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</button>
							</li>
						</ul>

						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								
								<p> <?php echo $get_product['0']['description']?></p>
								
								<!--<ul>
									<li>Lorem ipsum dolor sit amet, consectetur product</li>
									<li>Duis aute irure dolor in reprehenderit in voluptate velit esse</li>
									<li>Excepteur sinted occaecat cupidatat non proident products</li>
									<li>Voluptate velit esse cillum.</li>
								</ul>-->
							</div>
							
							<div class="tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
								<p> <?php echo $get_product['0']['short_desc']?></p>	
							</div>
							<?php 
									if(mysqli_num_rows($product_review_res)>0){
									
									while($product_review_row=mysqli_fetch_assoc($product_review_res)){
									?>
							<div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
								<div class="pda_rtng_area fix">
									<h4>4.5 <span>(<?php echo $product_review_row['rating']?>)</span></h4>
									<span>Based on 9 Comments</span>
								</div>
								
								<div class="rtng_cmnt_area fix">
									<div class="single_rtng_cmnt">
										<div class="rtngs">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
										<span>(4)</span>
										</div>
										<div class="rtng_author">
											<h3><?php echo $product_review_row['name']?></h3>
											<span><?php
$added_on=strtotime($product_review_row['added_on']);
echo date('d M Y',$added_on);
?></span>
											<!--<span>6 January 2017</span>-->
										</div>
										<p><?php echo $product_review_row['review']?></p>
									</div>

								</div>
								<?php } }else { 
										echo "<h3 class='submit_review_hint'>No review added</h3><br/>";
									}
									?>
								<div class="col-md-6 rcf_pdnglft">
								<?php
									if(isset($_SESSION['USER_LOGIN'])){
									?>
									<div class="rtng_cmnt_form_area fix">
										<h3>Add your Comments</h3>
										<div class="rtng_form">
											<form action="" method="post">
												<div class="input-area"><select class="form-control" name="rating" required>
												  <option value="">Select Rating</option>
												  <option>Worst</option>
												  <option>Bad</option>
												  <option>Good</option>
												  <option>Very Good</option>
												  <option>Fantastic</option>
											 </select>	<br/></div>
												<div class="input-area"><textarea id="new-review" name="review"></textarea></div>
												<input class="btn border-btn" type="submit" name="review_submit" />
											</form>
										</div>
									</div>
								</div>
								<?php } else {
									echo "<span class='submit_review_hint'>Please <a href='login.php'>login</a> to submit your review</span>";
								}
								?>
							</div>
						</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		//unset($_COOKIE['recently_viewed']);
		if(isset($_COOKIE['recently_viewed'])){
			$arrRecentView=unserialize($_COOKIE['recently_viewed']);
			$countRecentView=count($arrRecentView);
			$countStartRecentView=$countRecentView-4;
			if($countStartRecentView>4){
				$arrRecentView=array_slice($arrRecentView,$countStartRecentView,4);
			}
			$recentViewId=implode(",",$arrRecentView);
			$res=mysqli_query($con,"select * from product where id IN ($recentViewId) and status=1");
			
		?>
	<!-- Related Product Area -->
	<div class="related_prdct_area text-center">
		<div class="container">		
			<!-- Section Title -->
			<div class="rp_title text-center"><h3>Related products</h3></div>
			
			<div class="row">
			<?php while($list=mysqli_fetch_assoc($res)){?>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="product-grid">
						<div class="product-image">
							<a href="product.php?id=<?php echo $list['id']?>">
								<img class="pic-1" src="<?php echo 'media/product_images/'.$list['image']?>" alt="Product Image">
								<img class="pic-2" src="<?php echo 'media/product_images/'.$list['image']?>" alt="Product Image">
							</a>
							<ul class="social">
								<li><a href="#" data-tip="Quick View"><i class="pe-7s-search"></i></a></li>
								<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="pe-7s-like"></i></a></li>
								<li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')" data-tip="Add to Cart"><i class="pe-7s-cart"></i></a></li>
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
				
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="product-grid">
						<div class="product-image">
							<a href="#">
								<img class="pic-1" src="img/product/3.jpg" alt="Product Image">
								<img class="pic-2" src="img/product/4.jpg" alt="Product Image">
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
							<div class="price">$29.00
								<span>$25.00</span>
							</div>
						</div>
					</div>
				</div><!-- End Col -->	
						
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="product-grid">
						<div class="product-image">
							<a href="#">
								<img class="pic-1" src="img/product/5.jpg" alt="Product Image">
								<img class="pic-2" src="img/product/6.jpg" alt="Product Image">
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
							<div class="price">$35.00
								<span>$30.00</span>
							</div>
						</div>
					</div>
				</div><!-- End Col -->	

				
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="product-grid">
						<div class="product-image">
							<a href="#">
								<img class="pic-1" src="img/product/7.jpg" alt="Product Image">
								<img class="pic-2" src="img/product/8.jpg" alt="Product Image">
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
							<div class="price">$150.00
								<span>$100.00</span>
							</div>
						</div>
					</div>
				</div><!-- End Col -->	
				<?php } ?>		
			</div>	
		</div>
	</div>
	<?php 
			$arrRec=unserialize($_COOKIE['recently_viewed']);
			if(($key=array_search($product_id,$arrRec))!==false){
				unset($arrRec[$key]);
			}
			$arrRec[]=$product_id;
		}else{
			$arrRec[]=$product_id;
		}
		setcookie('recently_viewed',serialize($arrRec),time()+60*60*24*365);
		?>
		
			<script>
			function showMultipleImage(im){
				jQuery('#img-tab-1').html("<img src='"+im+"' data-origin='"+im+"'/>");
				jQuery('.imageZoom').imgZoom();
			}
			let is_color='<?php echo $is_color?>';
			let is_size='<?php echo $is_size?>';
			let pid='<?php echo $product_id?>';
			</script>			
<?php 
require('footer.php');
ob_flush();
?>   