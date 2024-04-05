<?php 
require('top.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	?>
	<script>
	window.location.href='my_order.php';
	</script>
	<?php
}
?>
	<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Forgot Password</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Forgot Password</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		
		<!-- Login Page -->
		<div class="login_page_area">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="create_account_area">
							<h2 class="caa_heading">Forgot Password?</h2>
							<div class="caa_form_area">
								<div class="caa_form_group">
									<div class="login_email">
										<label>Email address</label>
										<div class="input-area"><input type="text" name="email" id="email" placeholder="Your Email*" /></div>
									</div>
									<span class="field_error" id="email_error" style="color:red;"></span>
									<div class="form-output login_msg">
									<p class="form-messege field_error" style="color:red;"></p>
									</div>
									<button type="button" onclick="forgot_password()" id="btn_submit" class="btn btn-default acc_btn"> 
										<a><span>Sudmit </span></a?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<script>
		function forgot_password(){
			jQuery('#email_error').html('');
			var email=jQuery('#email').val();
			if(email==''){
				jQuery('#email_error').html('Please enter email id');
			}else{
				jQuery('#btn_submit').html('Please wait...');
				jQuery('#btn_submit').attr('disabled',true);
				jQuery.ajax({
					url:'forgot_password_submit.php',
					type:'post',
					data:'email='+email,
					success:function(result){
						jQuery('#email').val('');
						jQuery('#email_error').html(result);
						jQuery('#btn_submit').html('Submit');
						jQuery('#btn_submit').attr('disabled',false);
					}
				})
			}
		}
		</script>
<?php require('footer.php')?>        