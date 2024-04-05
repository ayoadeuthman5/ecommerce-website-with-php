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
						<h3>Account</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Login</span></li>
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
						<div class="create_account_area caa_pdngbtm">
							<h2 class="caa_heading">Create an account</h2>
							<div class="caa_form_area">
								<p>Please enter your email address to create an account.</p>
								<div class="caa_form_group">
									<div class="caf_form">
										<label>Your Name</label>
										<div class="input-area"><input type="text" id="name" name="name" placeholder="Your Name*" />
										<span class="field_error" id="name_error" style="color:red;"></span>
									</div>
									</div>
									<div class="caf_form">
										<label> Your Email address</label>
										<div class="input-area"><input type="text" name="email" id="email" placeholder="Your Email*" style="width:45%">
											
											
											<button type="button" class="btn btn-default acc_btn email_sent_otp height_60px" onclick="email_sent_otp()">Send OTP</button>
											
										</div>
										<div class="input-area"><input type="text" id="email_otp" placeholder="OTP" style="width:45%" class="email_verify_otp">
											
										<span id="email_otp_result" style="color:red;"></span>
											<button type="button" class="btn btn-default acc_btn email_verify_otp height_60px" onclick="email_verify_otp()">Verify OTP</button>
											
										</div>
										
									</div>
									<span class="field_error" id="email_error" style="color:red;"></span>
									<div class="caf_form">
										<label>Phone Number</label>
										<div class="input-area"><input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:45%">
											
											
											<button type="button" class="btn btn-default acc_btn mobile_sent_otp height_60px" onclick="mobile_sent_otp()">Send OTP</button>
											
										</div>
										<div class="input-area"><input type="text" id="mobile_otp" placeholder="OTP" style="width:45%" class="mobile_verify_otp">
										
										<span id="mobile_otp_result" style="color:red;"></span>
											
											<button type="button" class="btn btn-default acc_btn mobile_verify_otp height_60px" onclick="mobile_verify_otp()">Verify OTP</button>
											
										</div>
									</div>
									<span class="field_error" id="mobile_error" style="color:red;"></span>
									<div class="caf_form">
										<label>Password</label>
										<div class="input-area"><input type="password" id="password" name="password" placeholder="Your Password*"  /></div>
									</div>
									<button class="btn btn-default acc_btn" type="button" id="btn_register" onclick="user_register()" > 
										<span> <i class="fa fa-user btn_icon"></i> Create an account </span> 
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="create_account_area">
							<h2 class="caa_heading">Already registered?</h2>
							<div class="caa_form_area">
								<div class="caa_form_group">
									<div class="login_email">
										<label>Email address</label>
										<div class="input-area"><input type="email" name="login_email" id="login_email" placeholder="Your Email*" /></div>
									</div>
									<span class="field_error" id="login_email_error" style="color:red;"></span>
									<div class="login_password">
										<label>Password</label>
										<div class="input-area"><input type="password" name="login_password" id="login_password" placeholder="Your Password*" /></div>
									</div>
									<span class="field_error" id="login_password_error" style="color:red;"></span>
									<p class="forgot_password">
										<a href="forgot_password.php" title="Recover your forgotten password" rel="">Forgot your password?</a>
									</p>
									<div class="form-output login_msg">
									<p class="form-messege field_error" style="color:red;"></p>
									</div>
									<button type="button" onclick="user_login()" class="btn btn-default acc_btn"> 
										<a><span> <i class="fa fa-lock btn_icon"></i> Sign in </span></a?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<input type="hidden" id="is_email_verified"/>
		<input type="hidden" id="is_mobile_verified"/>
		<script>
		function email_sent_otp(){
			jQuery('#email_error').html('');
			var email=jQuery('#email').val();
			if(email==''){
				jQuery('#email_error').html('Please enter email id');
			}else{
				jQuery('.email_sent_otp').html('Please wait..');
				jQuery('.email_sent_otp').attr('disabled',true);
				jQuery.ajax({
					url:'send_otp.php',
					type:'post',
					data:'email='+email+'&type=email',
					success:function(result){
						if(result=='done'){
							jQuery('#email').attr('disabled',true);
							jQuery('.email_verify_otp').show();
							jQuery('.email_sent_otp').hide();
							
						}else if(result=='email_present'){
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_error').html('Email id already exists');
						}else{
							jQuery('.email_sent_otp').html('Send OTP');
							jQuery('.email_sent_otp').attr('disabled',false);
							jQuery('#email_error').html('Please try after sometime');
						}
					}
				});
			}
		}
		function email_verify_otp(){
			jQuery('#email_error').html('');
			var email_otp=jQuery('#email_otp').val();
			if(email_otp==''){
				jQuery('#email_error').html('Please enter OTP');
			}else{
				jQuery.ajax({
					url:'check_otp.php',
					type:'post',
					data:'otp='+email_otp+'&type=email',
					success:function(result){
						if(result=='done'){
							jQuery('.email_verify_otp').hide();
							jQuery('#email_otp_result').html('Email id verified');
							jQuery('#is_email_verified').val('1');
							if(jQuery('#is_mobile_verified').val()==1){
								jQuery('#btn_register').attr('disabled',false);
							}
						}else{
							jQuery('#email_error').html('Please enter valid OTP');
						}
					}
					
				});
			}
		}
		
		function mobile_sent_otp(){
			jQuery('#mobile_error').html('');
			var mobile=jQuery('#mobile').val();
			if(mobile==''){
				jQuery('#mobile_error').html('Please enter mobile number');
			}else{
				jQuery('.mobile_sent_otp').html('Please wait..');
				jQuery('.mobile_sent_otp').attr('disabled',true);
				jQuery('.mobile_sent_otp');
				jQuery.ajax({
					url:'send_otp.php',
					type:'post',
					data:'mobile='+mobile+'&type=mobile',
					success:function(result){
						if(result=='done'){
							jQuery('#mobile').attr('disabled',true);
							jQuery('.mobile_verify_otp').show();
							jQuery('.mobile_sent_otp').hide();
						}else if(result=='mobile_present'){
							jQuery('.mobile_sent_otp').html('Send OTP');
							jQuery('.mobile_sent_otp').attr('disabled',false);
							jQuery('#mobile_error').html('Mobile number already exists');
						}else{
							jQuery('.mobile_sent_otp').html('Send OTP');
							jQuery('.mobile_sent_otp').attr('disabled',false);
							jQuery('#mobile_error').html('Please try after sometime');
						}
					}
				});
			}
		}
		function mobile_verify_otp(){
			jQuery('#mobile_error').html('');
			var mobile_otp=jQuery('#mobile_otp').val();
			if(mobile_otp==''){
				jQuery('#mobile_error').html('Please enter OTP');
			}else{
				jQuery.ajax({
					url:'check_otp.php',
					type:'post',
					data:'otp='+mobile_otp+'&type=mobile',
					success:function(result){
						if(result=='done'){
							jQuery('.mobile_verify_otp').hide();
							jQuery('#mobile_otp_result').html('Mobile number verified');
							jQuery('#is_mobile_verified').val('1');
							if(jQuery('#is_email_verified').val()==1){
								jQuery('#btn_register').attr('disabled',false);
							}
						}else{
							jQuery('#mobile_error').html('Please enter valid OTP');
						}
					}
					
				});
			}
		}
		</script>
<?php require('footer.php')?>