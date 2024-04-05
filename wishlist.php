<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];

$res=mysqli_query($con,"select product.name,product.image,product_attributes.price,product_attributes.mrp,product.id as pid,wishlist.id from product,wishlist,product_attributes where wishlist.product_id=product.id and wishlist.user_id='$uid' and product_attributes.product_id=product.id group by product_attributes.product_id");
?>
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Wishlist</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Wishlist</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Wishlist Page -->
		<div class="wishlist-page">
			<div class="container">
				<div class="table-responsive">
					<table class="table cart-table cart_prdct_table text-center">
						<thead>
							<tr>
								<th class="cpt_no">#</th>
								<th class="cpt_img">image</th>
								<th class="cpt_pn">product name</th>
								<!--<th class="stock">stock status</th>-->
								<th class="cpt_p">price</th>
								<th class="add-cart">add to cart</th>
								<th class="cpt_r">remove</th>
							</tr>
						</thead>
						<tbody>
                        <?php
						while($row=mysqli_fetch_assoc($res)){
						?>
											
							<tr>
								<td><span class="cart-number">1</span></td>
								<td><a href="#" class="cp_img"><img src="<?php echo 'media/product_images/'.$row['image']?>" alt="product images"/></a></td>
								<td><a href="#" class="cart-pro-title"><?php echo $row['name']?></a></td>
								<!--<td><p class="stock in-stock">Out of stock</p></td>-->
								<td><p class="cart-pro-price"><?php echo $row['price']?></p></td>
								<td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $row['pid']?>','add')" class="btn border-btn">add to cart</a></td>
								<td><a href="wishlist.php?wishlist_id=<?php echo $row['id']?>" class="cp_remove"><i class="fa fa-trash"></i></a></td>
							</tr>
                            <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
        <input type="hidden" id="qty" value="1"/>						
		<?php require('footer.php')?> 
