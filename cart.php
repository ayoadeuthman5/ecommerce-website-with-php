<?php 
require('top.php');
?>		
	
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-start">
						<h3>Shop Details</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Cart</span></li>
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
										<th class="cpt_img">Product image</th>
										<th class="cpt_pn">product name</th>
										<th class="cpt_q">quantity</th>
										<th class="cpt_p">price</th>
										<th class="cpt_t">total</th>
										<th class="cpt_r">remove</th>
									</tr>
								</thead>
								<tbody>
                                <?php
										if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
												
											foreach($val as $key1=>$val1)	{


$resAttr=mysqli_fetch_assoc(mysqli_query($con,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
	left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
	left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
	where product_attributes.id='$key1'"));

												
											$productArr=get_product($con,'','',$key,'','','','',$key1);
											$pname=$productArr[0]['name'];
											$mrp=$productArr[0]['mrp'];
											$price=$productArr[0]['price'];
											$image=$productArr[0]['image'];
											$qty=$val1['qty'];
											?>
									<tr>
										<td><span class="cp_no">1</span></td>
										<td><a href="#" class="cp_img"><img src="<?php echo 'media/product_images/'.$image?>" /></a></td>
										<td><a href="#" class="cp_title"><?php echo $pname?></a>
                                        <?php
if(isset($resAttr['color']) && $resAttr['color']!=''){
	echo "<br/>".$resAttr['color'].''; 
}
if(isset($resAttr['size']) && $resAttr['size']!=''){
	echo "<br/>".$resAttr['size'].''; 
}
?>				
					<ul  class="pro__prize">
														<li class="old__prize">&#8358;<?php echo $mrp?></li>
														<li>&#8358;<?php echo $price?></li>
													</ul>
                                        </td>
										<td>										
											<div class="cp_quntty">	
                                            <input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>"size="2"  />
												<br/><a href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','update','<?php echo $resAttr['size_id']?>','<?php echo $resAttr['color_id']?>')">update</a>																		
												<!--<input name="quantity" value="1" size="2" type="number">-->													
											</div>
										</td>
										<td><p class="cp_price">&#8358;<?php echo $price?></p></td>
										<td><p class="cpp_total">&#8358;<?php echo $qty*$price?></p></td>
										<td><a class="btn btn-default cp_remove" href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','remove','<?php echo $resAttr['size_id']?>','<?php echo $resAttr['color_id']?>')"><i class="fa fa-trash"></i></a></td>
									</tr>
                                    <?php } } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8 col-xs-12 cart-actions cart-button-cuppon">
						<div class="row">
							<div class="col-sm-7">
								<div class="cart-action">
									<a href="<?php echo SITE_PATH?>" class="btn border-btn">continiue shopping</a>
									<!--<a href="#" class="btn border-btn">update shopping bag</a>-->
								</div>
							</div>
							
							<!--<div class="col-sm-5">
								<div class="cuppon-wrap">
									<h4>Discount Code</h4>
									<p>Enter your coupon code if you have</p>
									<form action="#" class="cuppon-form">
										<input type="text" />
										<button class="btn border-btn">apply coupon</button>
									</form>
								</div>
							</div>-->
						</div>
					</div>
					
					<div class="col-md-4 col-xs-12 cart-checkout-process text-right">
						<div class="wrap">
							<!--<p><span>Subtotal</span><span>&nbsp;<?php //echo $cart_total ?></span></p>
							<h4><span>Grand total</span><span>$190.00</span></h4>-->
							<a href="<?php echo SITE_PATH?>checkout.php" class="btn border-btn">process to checkout</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
        <input type="hidden" id="sid">
		<input type="hidden" id="cid">								
<?php require('footer.php')?>  