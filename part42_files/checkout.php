<?php 
require('top.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}

$cart_total=0;
if(isset($_POST['place_order'])){
$fname=get_safe_value($con,$_POST['billing_first_name']);
$lname=get_safe_value($con,$_POST['billing_last_name']);
$company=get_safe_value($con,$_POST['billing_company']);
$country=get_safe_value($con,$_POST['billing_country']);
$address1=get_safe_value($con,$_POST['billing_address_1']);
//$address2=get_safe_value($con,$_POST['billing_address_2']);
$city=get_safe_value($con,$_POST['billing_city']);
$state=get_safe_value($con,$_POST['billing_state']);
$postcode=get_safe_value($con,$_POST['billing_postcode']);
$mobile=get_safe_value($con,$_POST['billing_phone']);
$email=get_safe_value($con,$_POST['billing_email']);
$comments=get_safe_value($con,$_POST['order_comments']);
$payment_method=get_safe_value($con,$_POST['payment_method']);
$user_id=$_SESSION['USER_ID'];

foreach($_SESSION['cart'] as $key=>$val){
	$productArr=get_product($con,'','',$key);
	$price=$productArr[0]['price'];
	$qty=$val[7]['qty'];
	$cart_total=$cart_total+($price*$qty);
	
}
//print_r($_SESSION['cart']);

$total_price=$cart_total;
$payment_status='pending';

$order_status="1";
$added_on=date('y-m-d h:i:s');
$tnx = uniqid("id");

if(isset($_SESSION['COUPON_ID'])){
	$coupon_id=$_SESSION['COUPON_ID'];
	$coupon_code=$_SESSION['COUPON_CODE'];
	$coupon_value=$_SESSION['COUPON_VALUE'];
	$total_price=$total_price-$coupon_value;
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
}else{
	$coupon_id='';
	$coupon_code='';
	$coupon_value='';

}

 mysqli_query($con,"insert into `order`(user_id,firstname,lastname,city,state,country,payment_type,payment_status,companyname,address,phonenum,email,comment,postal_code,total_price,added_on,order_status,trans_id,coupon_id,coupon_code,coupon_value) values('$user_id','$fname','$lname','$city','$state','$country','$payment_method','$payment_status','$company','$address1','$mobile','$email','$comments','$postcode','$total_price','$added_on','$order_status','$tnx','$coupon_id','$coupon_code','$coupon_value')");


$order_id=mysqli_insert_id($con);

	foreach($_SESSION['cart'] as $key=>$val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$qty=$val[7]['qty'];
		
		mysqli_query($con,"insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
		
	}

	if($payment_method=="paystack"){

		$userArr=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$user_id'"));

	
    $currency = "NGN";
    $redirect = "http://localhost/swiftshop/pay.php";
	$customer = ['email'=> $userArr['email']];
    

	
    $request = json_encode([
      'tx_ref' => $tnx,
      'amount' => $total_price,
      'currency' => $currency,
      'redirect_url' => $redirect,
      'customer' => $customer
    ]);
    
          $url = "https://api.flutterwave.com/v3/payments";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $headers = [
      'Authorization: Bearer FLWSECK_TEST-7217e877679b0a5f959ea609fec91664-X',
      'Content-Type: application/json',
    
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);
   // print_r($response);
    curl_close($ch);
    
    $array = json_decode($response, true);
    //echo $response;
    if(array_key_exists("status", $array) && $array['status'] == "success"){
    
    $link = $array['data']['link'];
    ?>
	<script>
	window.location.href="<?php echo $link;?>";
	</script>
	<?php
    }

    }else{
		//sentInvoice($con,$order_id);
	  ?>
		<script>
		     window.location.href="thank_you.php";
		</script>
		<?php
	}
}
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
						<li><a href="#">home</a></li>
						<li><a href="#">category</a></li>
						<li><span>Checkout</span></li>
					</ul>					
				</div>	
			</div>
		</div>
	</div>
		
		
	<!-- Checkout Page -->
	<section class="checkout_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title">
                            <h3>Billing Details</h3>
                        </div>
                        <form class="checkout_form" action="#" method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
									<input name="billing_first_name" id="billing_first_name_field" placeholder="First name" class="form-control" type="text">
								</div>
								
								 <div class="form-group col-md-6">								
									<input name="billing_last_name" id="billing_last_name_field" placeholder="Last name" class="form-control" type="text">
								</div>
							</div>
							
                            <div class="form-group">      
                                  <input name="billing_company" id="billing_company_field" placeholder="Company name" class="form-control" type="text">                         
                            </div>
							
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="billing_email" id="billing_email_field" placeholder="Email address" class="form-control" type="email">
                                </div>
                           
      
                                <div class="form-group col-md-6">
                                    <input name="billing_phone" id="billing_phone_field" placeholder="Phone number" class="form-control" type="text">
                                </div>

								<div class="form-group col-md-6">
                                    <input name="billing_state" id="billing_state_field" placeholder="State" class="form-control" type="text">
                                </div>

                                <div class="form-group col-md-6">
                                    <input name="billing_country" id="billing_country_field" placeholder="Country" class="form-control" type="text">
                                </div>
							</div>
								
                           <!-- <div class="form-group">  
								<label for="country">Country:</label>
								<div class="custom-select-wrapper" >
									<select id="country" class="custom-select" >
										<option value="canada">Canada *</option>
										<option value="american">American</option>
										<option value="australia">Australia</option>
									</select>
								</div>
                            </div>-->
							
							
                            <div class="form-group">
								<label for="address">Address:</label>    
								<textarea rows="3" name="billing_address_1" id="billing_address_1_field" placeholder="Street address. Apartment, suite, unit etc. (optional)" class="form-control"></textarea>
                            </div>
							
                             <div class="form-row">
                               <div class="form-group col-md-6">
                                    <input name="billing_postcode" id="billing_postcode_field" placeholder="Post code / Zip" class="form-control" type="text">
                                </div>
								
								 <div class="form-group col-md-6">
                                    <input name="billing_city" id="billing_city_field" placeholder="Town / City" class="form-control" type="text">
                                </div>								
                            </div>

                            <div class="form-group">
								<label for="address">Order note:</label>    
								<textarea rows="3" name="order_comments" id="order_comments_field" placeholder="Order note" class="form-control"></textarea>
								<!--<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customCheck1">
									<label class="custom-control-label" for="customCheck1">SHIP TO A DIFFERENT ADDRESS?</label>
								</div>-->                          
                            </div>
							<div class="custom-control custom-radio">
										<input type="radio" id="paystack" name="payment_method" value="paystack" class="custom-control-input">
										<label class="custom-control-label" for="customRadio2">Debit/Credit Card payment</label>
										<p>Make payment using your debit and credit cards</p>

										<br>
										<input type="radio" id="payondelivery" value="payondelivery" name="payment_method" class="custom-control-input">
										<label class="custom-control-label" for="customRadio1">Pay On delivery</label>
										<p>Make payment using your debit and credit cards</p>
									</div>	
							<div class="qc-button">
                            <input name="place_order" type="submit" class="btn border-btn" tabindex="0"><!--Place Order</button>-->
                        	</div>
                        </form>
                    </div>
					
					
                    <div class="col-md-6">
                        <div class="title">
                            <h3>your order</h3>
                        </div>
						
						<div class="your-order-table table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="product-name">Product Name</th>
										<th class="product-total">Quantity</th>
										<th class="product-total">price</th>
										<th class="product-total">remove</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$cart_total=0;
								foreach($_SESSION['cart'] as $key=>$val){
								//$productArr=get_product($con,'','',$key);
								
								//prx($productArr);
								
								foreach($val as $key1=>$val1){
									
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
								
								$cart_total=$cart_total+($price*$qty);
								?>
									<tr>
										<td class="product-name"><?php echo $pname?></td>
										<td class="product-name"><?php echo $qty?></td>
										<td class="product-total"><span><?php echo $price*$qty?></span></td>
										<td><a class="btn btn-default cp_remove" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-trash"></i></a></td>
									</tr>
									<?php } } ?>
								</tbody>
								<tfoot>
									<tr>
										<th>Order Total</th>
										<td><span class="amount"><?php echo $cart_total?></span></td>
									</tr>
									<tr id="coupon_box">
										<th >Coupon Value</th>
										<td><span class="amount"id="coupon_price"></span></td>
									</tr>
								</tfoot>
							</table>
						</div>
						
                        <div class="payment_method">           
							<ul>
								<li>
									<!--<div class="custom-control custom-radio">
										<input type="radio" id="paystack" name="payment_method" value="paystack" class="custom-control-input">
										<label class="custom-control-label" for="customRadio2">Pay On delivery</label>

										<br>
										<input type="radio" id="payondelivery" value="payondelivery" name="payment_method" class="custom-control-input">
										<label class="custom-control-label" for="customRadio1">Debit/Credit Card payment</label>
										<p>Make payment using your debit and credit cards</p>
									</div>						
						
								</li>
								
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" id="payondelivery" value="payondelivery" name="payment_method" class="custom-control-input">
										<label class="custom-control-label" for="customRadio2">Pay On delivery</label>
										<p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy.</a></p>
									</div>	
								</li>-->
							</ul>  
							<div class="col-sm-5">
								<div class="cuppon-wrap">
									<h4>Discount Code</h4>
									<p>Enter your coupon code if you have</p>
									<form action="#" class="cuppon-form">
										<input type="text"id="coupon_str" placeholder="Coupon code"/>
										<button class="btn border-btn" onclick="set_coupon()" type="button" name="submit" value="Apply Coupon">apply coupon</button>
									</form>
								</div>
								<div id="coupon_result"></div>
							</div>   
                        </div>
						
                        <div class="qc-button">
                            <button name="submit" type="submit" class="btn border-btn" tabindex="0">Place Order</button>
                        </div>
                    </div>
					
                </div>
            </div>
        </section>
		<script>
			function set_coupon(){
				var coupon_str=jQuery('#coupon_str').val();
				if(coupon_str!=''){
					jQuery('#coupon_result').html('');
					jQuery.ajax({
						url:'set_coupon.php',
						type:'post',
						data:'coupon_str='+coupon_str,
						success:function(result){
							var data=jQuery.parseJSON(result);
							if(data.is_error=='yes'){
								jQuery('#coupon_box').hide();
								jQuery('#coupon_result').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
							if(data.is_error=='no'){
								jQuery('#coupon_box').show();
								jQuery('#coupon_price').html(data.dd);
								jQuery('#order_total_price').html(data.result);
							}
						}
					});
				}
			}
		</script>		
<?php 
if(isset($_SESSION['COUPON_ID'])){
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['COUPON_VALUE']);
	}
require("footer.php") ?>