<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$order_id=get_safe_value($con,$_GET['id']);

$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value from `order` where id='$order_id'"));
$coupon_value=$coupon_details['coupon_value'];
if($coupon_value==''){
	$coupon_value=0;	
}
?>
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-start">
						<h3>My Oreder Details</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Order details</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Cart Page -->
		<div class="cart_page_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="cart_table_area table-responsive">
							<table class="table cart_prdct_table text-center">
								<thead>
									<tr>
										<th class="cpt_no">No.</th>
										<th class="cpt_img">image</th>
										<th class="cpt_pn">product name</th>
										<th class="cpt_q">quantity</th>
										<th class="cpt_p">price</th>
										<th class="cpt_t">total Price</th>
									</tr>
								</thead>
								<tbody>
                                <?php
											$uid=$_SESSION['USER_ID'];
											$res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image from order_detail,product ,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and order_detail.product_id=product.id");
											$total_price=0;
											while($row=mysqli_fetch_assoc($res)){
											$total_price=$total_price+($row['qty']*$row['price']);
											?>
									<tr>
										<td><span class="cp_no">1</span></td>
										<td><a href="#" class="cp_img"><img src="<?php echo 'media/product_images/'.$row['image']?>"></a></td>
										<td><a href="#" class="cp_title"><?php echo $row['name']?></a></td>
										<td>										
											<div class="cp_quntty">																			
                                            <?php echo $row['qty']?>												
											</div>
										</td>
										<td><p class="cp_price">&#8358;<?php echo $row['price']?></p></td>
										<td><p class="cpp_total">&#8358;<?php echo $row['qty']*$row['price']?></p></td>
									</tr>
                                    <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="row">
					<!--<div class="col-md-8 col-xs-12 cart-actions cart-button-cuppon">
						<div class="row">
							<div class="col-sm-7">
								<div class="cart-action">
									<a href="#" class="btn border-btn">continiue shopping</a>
									<a href="#" class="btn border-btn">update shopping bag</a>
								</div>
							</div>
							
							<div class="col-sm-5">
								<div class="cuppon-wrap">
									<h4>Discount Code</h4>
									<p>Enter your coupon code if you have</p>
									<form action="#" class="cuppon-form">
										<input type="text" />
										<button class="btn border-btn">apply coupon</button>
									</form>
								</div>
							</div>
						</div>
					</div>-->
					
					<div class="col-md-4 col-xs-12 cart-checkout-process text-right">
						<div class="wrap">
                        <?php  
											if($coupon_value!=''){
											?>
							<p><span>Coupon Value</span><span>&#8358;<?php echo $coupon_value ?></span></p> <?php } ?>
							<h4><span>Grand total</span><span>&#8358;<?php 
												echo $total_price-$coupon_value;
												?></span></h4>
							<!--<a href="checkout.html" class="btn border-btn">process to checkout</a>-->
						</div>
					</div>
					
				</div>
			</div>
		</div>
        <?php require('footer.php')?>     