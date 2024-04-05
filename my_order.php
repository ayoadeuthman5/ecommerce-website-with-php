<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
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
					<div class="col-sm-6 text-start">
						<h3>My Order</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="index.php">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Order</span></li>
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
										<th class="cpt_no">Order ID</th>
										<th class="cpt_img">Order Date</th>
										<th class="cpt_pn">Address</th>
										<th class="cpt_q">Payment Type</th>
										<th class="cpt_p">Payment Status</th>
										<th class="cpt_t">Order Status</th>
									</tr>
								</thead>
								<tbody>
                                <?php
								$uid=$_SESSION['USER_ID'];
							    $res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where `order`.user_id='$uid' and order_status.id=`order`.order_status order by `order`.id desc");
								while($row=mysqli_fetch_assoc($res)){
								?>
									<tr>
										<td><a href="my_order_details.php?id=<?php echo $row['id']?>"> <?php echo $row['id']?></a>
												<br/>
												<a href="order_pdf.php?id=<?php echo $row['id']?>"> PDF</a>
                                        </td>
										<td><?php echo $row['added_on']?></td>
										<td>
                                            <?php echo $row['address']?><br/>
											<?php echo $row['city']?><br/>
											<?php echo $row['pincode']?>
                                        </td>
										<td><?php echo $row['payment_type']?></td>
										<td><?php echo ucfirst($row['payment_status'])?></td>
										<td><?php echo $row['order_status_str']?></td>
									</tr>
                                    <?php } ?>
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
									<a href="#" class="btn border-btn">continiue shopping</a>
								</div>
							</div>
							
							
						</div>
					</div>
					
			
				</div>
			</div>
		</div>
        <?php require('footer.php')?> 