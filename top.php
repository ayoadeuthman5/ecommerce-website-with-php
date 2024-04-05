<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$wishlist_count=0;
$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
	$cat_arr[]=$row;	
}

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

if(isset($_SESSION['USER_LOGIN'])){
	$uid=$_SESSION['USER_ID'];
	
	if(isset($_GET['wishlist_id'])){
		$wid=get_safe_value($con,$_GET['wishlist_id']);
		mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
	}

	$wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
	
}

$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];

$meta_title="My Ecom Website";
$meta_desc="My Ecom Website";
$meta_keyword="My Ecom Website";
$meta_url=SITE_PATH;
$meta_image="";
if($mypage=='product.php'){
	$product_id=get_safe_value($con,$_GET['id']);
	$product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
	$meta_title=$product_meta['meta_title'];
	$meta_desc=$product_meta['meta_desc'];
	$meta_keyword=$product_meta['meta_keyword'];
	$meta_url=SITE_PATH."product.php?id=".$product_id;
	$meta_image=PRODUCT_IMAGE_SITE_PATH.$product_meta['image'];
}if($mypage=='contact.php'){
	$meta_title='Contact Us';
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
	

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $meta_title?></title>
        <meta name="description" content="<?php echo $meta_desc?>">
	    <meta name="keywords" content="<?php echo $meta_keyword?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	
	    <meta property="og:title" content="<?php echo $meta_title?>"/>
	    <meta property="og:image" content="<?php echo $meta_image?>"/>
	    <meta property="og:url" content="<?php echo $meta_url?>"/>
	    <meta property="og:site_name" content="<?php echo SITE_PATH?>"/>
		<link rel="preconnect" href="https://fonts.googleapis.com/">
		<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
		<link rel="icon" href="img/favicon.jpg"/>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />	
		<link rel="stylesheet" href="css/font-awesome.css" />
		<link rel="stylesheet" href="css/themify-icons.css" />
		<link rel="stylesheet" href="css/pe-icon-7-stroke.css" />
		<link rel="stylesheet" href="css/animate.css" />
		<link rel="stylesheet" href="css/owl.carousel.css" />
		<link rel="stylesheet" href="css/owl.theme.default.css" />
		<link rel="stylesheet" href="css/meanmenu.min.css" />
		<link rel="stylesheet" href="css/remodal.css" />
		<link rel="stylesheet" href="css/remodal-default-theme.css" />
		<link rel="stylesheet" href="css/venobox.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/responsive.css" />	
	</head>
	<body>
		<!--  Start Preloader  -->
			<!--<div class="preloader">
				<div class="status-mes">
					<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
				</div>
			</div>-->
		<!-- End Preloader -->
		
		<!--  Start Header  -->
			<header id="header_area">
				<div class="header_top_area">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-lg-6">
								<div class="hdr_tp_left">
									<div class="call_area">
										<span class="single_con_add bright"><i class="pe-7s-call"></i> +0123456789</span>
										<span class="single_con_add"><i class="pe-7s-mail"></i> example@example.com</span>
									</div>
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-6 col-lg-6">			
								<ul class="hdr_tp_right text-end">								
									<li class="lan_area dropdown bright"> HI
										<?php
											if(isset($_SESSION['USER_LOGIN'])){

											echo $_SESSION['USER_NAME'];

											}else{ 
										echo'<a href="Account.php"><i class="ti-user"></i> Login/Register</a>';
											}?>
									</li>
									<li class="currency_area dropdown bright">
										<a class="dropdown-toggle" href="Account.html" role="button" id="dropdownMenucur" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-user"></i>Profile/Order</a>

										<ul class="csub-menu dropdown-menu" aria-labelledby="dropdownMenucur">
									
											<li class="dropdown-item"><a href="profile.php">Profile</a></li>
											<li class="dropdown-item"><a href="my_order.php"> My Order</a></li>
											
										</ul>						
									</li>
									<li class="account_area"> 
										<a  href="logout.php" role="button" aria-expanded="false">Log out</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div> <!--  HEADER START  -->
				
				<div class="header_btm_area">
					<div class="container">
						<div class="row">		
							<div class="col-xs-12 col-sm-12 col-lg-3"> 
								<a class="logo" href="index-2.html"> <img alt="" src="img/logo.png"></a> 
							</div><!--  End Col -->
							
							<div class="col-xs-12 col-sm-12 col-lg-9 text-end">
								<div class="menu_wrap">
									<div class="main-menu">
										<nav>
											<ul>
												<li><a href="index.php">home</a>					
												</li>									
												<?php
										foreach($cat_arr as $list){
											?>
												<li><!--<a href="shop.html">Shop <i class="fa fa-angle-down"></i></a>-->
												<a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?>
												<?php
											$cat_id=$list['id'];
											$sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
											if(mysqli_num_rows($sub_cat_res)>0){
											?>
													<!-- Sub Menu -->
													<ul class="sub-menu">
													<?php
													while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
														echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a></li>
													';
													}
													?>
														<!--<li><a href="product-details.html">Product Details</a></li>
														<li><a href="cart.html">Cart</a></li>
														<li><a href="checkout.html">Checkout</a></li>
														<li><a href="wishlist.html">Wishlist</a></li>
														<li><a href="account.html">Account</a></li>-->
													</ul>
													<?php } ?>
												</li>
												<?php } ?>
											<!--	<li><a href="shop.html">Men <i class="fa fa-angle-down"></i></a>
													 --Mega Menu --
													<div class="mega-menu mm-4-column mm-left">
														<div class="mm-column mm-column-link float-start">
															<h3>Men</h3>
															<a href="#">Blazers</a>
															<a href="#">Jackets</a>
															<a href="#">Collections</a>
															<a href="#">T-S hirts</a>
															<a href="#">jens pant’s</a>
															<a href="#">sports shoes</a>												
														</div>
														
														<div class="mm-column mm-column-link float-start">
															<h3>Women</h3>
															<a href="#">Blazers</a>
															<a href="#">Jackets</a>
															<a href="#">Collections</a>
															<a href="#">T-Shirts</a>
															<a href="#">jens pant’s</a>
															<a href="#">sports shoes</a>												
														</div>
														
														<div class="mm-column mm-column-link float-start">
															<h3>Jackets</h3>
															<a href="#">Blazers</a>
															<a href="#">Jackets</a>
															<a href="#">Collections</a>
															<a href="#">T-Shirts</a>
															<a href="#">jens pant’s</a>
															<a href="#">sports shoes</a>	
														</div>						

														<div class="mm-column mm-column-link float-start">
															<h3>jens pant’s</h3>
															<a href="#">Blazers</a>
															<a href="#">Jackets</a>
															<a href="#">Collections</a>
															<a href="#">T-Shirts</a>
															<a href="#">jens pant’s</a>
															<a href="#">sports shoes</a>	
														</div>

													</div>
												</li>
												<li><a href="#">Women <i class="fa fa-angle-down"></i></a>
													-- Mega Menu --
													<div class="mega-menu mm-3-column mm-left">
														<div class="mm-column mm-column-link float-start">
															<h3>Woment</h3>
															<a href="#">Blazers</a>
															<a href="#">Jackets</a>
															<a href="#">Collections</a>
															<a href="#">T-Shirts</a>
															<a href="#">jens pant’s</a>
															<a href="#">sports shoes</a>	
														</div>
														
														<div class="mm-column mm-column-link float-start">
															<h3>T-Shirts</h3>
															<a href="#">Blazers</a>
															<a href="#">Jackets</a>
															<a href="#">Collections</a>
															<a href="#">T-Shirts</a>
															<a href="#">jens pant’s</a>
															<a href="#">sports shoes</a>	
														</div>					

														<div class="mm-column mm-column-link float-start">
															<h3>Jackets</h3>
															<a href="#">Blazers</a>
															<a href="#">Jackets</a>
															<a href="#">Collections</a>
															<a href="#">T-Shirts</a>
															<a href="#">jens pant’s</a>
															<a href="#">sports shoes</a>	
														</div>												
					
													</div>
												</li>
												
												<li><a href="#">pages <i class="fa fa-angle-down"></i></a>
													-- Sub Menu --
													<ul class="sub-menu">
														<li><a href="left-sidebar-blog.html">Left Sidebar Blog</a></li>
														<li><a href="right-sidebar-blog.html">Right Sidebar Blog</a></li>
														<li><a href="full-width-blog.html">Full Width Blog</a></li>
														<li><a href="blog-details.html">Blog Details</a></li>
														<li><a href="about-us.html">About Us</a></li>
														<li><a href="contact.html">Contact Us</a></li>
														<li><a href="404.html">404 Page</a></li>
													</ul>
												</li>-->
												<li><a href="contact.php">contact</a></li>
											</ul>
										</nav>
									</div> <!--  End Main Menu -->					

									<div class="mobile-menu text-right ">
										<nav>
											<ul>
												<li><a href="index.php">home</a></li>
												<?php
													foreach($cat_arr as $list){
													?>																		
												<li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?>
												<?php
											    $cat_id=$list['id'];
											    $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
											    if(mysqli_num_rows($sub_cat_res)>0){
											    ?>
													<!-- Sub Menu -->
													<ul>
													<?php
													while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
														echo '<li><a href="categories.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a></li>
													';
													}
													?>	
													<!--<li><a href="product-details.html">Product Details</a></li>
														<li><a href="cart.html">Cart</a></li>
														<li><a href="checkout.html">Checkout</a></li>
														<li><a href="wishlist.html">Wishlist</a></li>-->
													</ul>
													<?php } ?>
												</li>
												<?php } ?>
											
												<li><a href="contact.php">contact</a></li>
											</ul>
										</nav>
									</div> <!--  End mobile-menu -->						
								</div>
								
								<div class="right_menu clearfix">
									<ul class="nav">
										<li>
											<div class="search_icon">
												<a href="#modal" data-remodal-target="modal"><i class="pe-7s-search search_btn"></i></a>
												
												<div class="search-box remodal" data-remodal-id="modal">
													<button data-remodal-action="close" class="remodal-close"></button>
													<form action="search.php" method="get">
														<div class="input-group">
															<input type="text" name="str" class="form-control"  placeholder="enter keyword"/>				
															<button type="submit" class="btn btn-default"><i class="ti-search"></i></button>			
														</div>
													</form>
												</div>
											</div>
										</li>
										
										<li>
											<div class="cart_menu_area">
												<div class="cart_icon">
													<a href="cart.php"><i class="pe-7s-cart" aria-hidden="true"></i></a>
													<span class="cart_number" class="htc__qua"><?php echo $totalProduct?></span>
												</div>
												<?php
													if(isset($_SESSION['USER_ID'])){
													?>
												<div class="cart_menu_area">
												<div class="cart_icon">
													<a href="wishlist.php"><i class="pe-7s-like" aria-hidden="true"></i></a>
													<span class="cart_number" class="htc__wishlist"><?php echo $wishlist_count?></span>
												</div>
												<?php } ?>
												<!-- Mini Cart Wrapper -->					
											</div>	
											
										</li>
									</ul>
								</div>	
							</div><!--  End Col -->		
					
						</div>
					</div>
				</div>
			</header>
		<!--  End Header  -->
		