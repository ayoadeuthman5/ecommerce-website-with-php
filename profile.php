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
					<div class="col-sm-6 text-left">
						<h3>Profile</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Profile</span></li>
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
							<h2 class="caa_heading">Change Password</h2>
							<div class="caa_form_area">
								<p>Please enter your details correctly.</p>
								<div class="caa_form_group">
									<div class="caf_form">
										<label>Current Password</label>
										<div class="input-area"><input type="password" name="current_password" id="current_password" /></div>
									</div>
                                    <span class="field_error" id="current_password_error" style="color:red;"></span>
									<div class="caf_form">
										<label>New Password</label>
										<div class="input-area"><input type="password" name="new_password" id="new_password"  /></div>
									</div>
                                    <span class="field_error" id="new_password_error" style="color:red;"></span>
									<div class="caf_form">
										<label>confirm New Password</label>
										<div class="input-area"><input type="password" name="confirm_new_password" id="confirm_new_password" /></div>
									</div>
                                    <span class="field_error" id="confirm_new_password_error" style="color:red;"></span>
									<button class="btn btn-default acc_btn" type="button" onclick="update_password()" id="btn_update_password""> 
										<span> Update </span> 
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="create_account_area">
							<h2 class="caa_heading">Profile</h2>
							<div class="caa_form_area">
								<div class="caa_form_group">
									<div class="login_email">
										<label>Email address</label>
										<div class="input-area"><input type="text" name="name" id="name" placeholder="Your Name*" value="<?php echo $_SESSION['USER_NAME']?>" /></div>
									</div>
									<span class="field_error" id="name_error" style="color:red;"></span>
									<button type="button" onclick="update_profile()" class="btn btn-default acc_btn"> 
										<a><span> Update </span></a?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	<script>
		function update_profile(){
			jQuery('.field_error').html('');
			var name=jQuery('#name').val();
			if(name==''){
				jQuery('#name_error').html('Please enter your name');
			}else{
				jQuery('#btn_submit').html('Please wait...');
				jQuery('#btn_submit').attr('disabled',true);
				jQuery.ajax({
					url:'update_profile.php',
					type:'post',
					data:'name='+name,
					success:function(result){
						jQuery('#name_error').html(result);
						jQuery('#btn_submit').html('Update');
						jQuery('#btn_submit').attr('disabled',false);
					}
				})
			}
		}
		
		function update_password(){
			jQuery('.field_error').html('');
			var current_password=jQuery('#current_password').val();
			var new_password=jQuery('#new_password').val();
			var confirm_new_password=jQuery('#confirm_new_password').val();
			var is_error='';
			if(current_password==''){
				jQuery('#current_password_error').html('Please enter password');
				is_error='yes';
			}if(new_password==''){
				jQuery('#new_password_error').html('Please enter password');
				is_error='yes';
			}if(confirm_new_password==''){
				jQuery('#confirm_new_password_error').html('Please enter password');
				is_error='yes';
			}
			
			if(new_password!='' && confirm_new_password!='' && new_password!=confirm_new_password){
				jQuery('#confirm_new_password_error').html('Please enter same password');
				is_error='yes';
			}
			
			if(is_error==''){
				jQuery('#btn_update_password').html('Please wait...');
				jQuery('#btn_update_password').attr('disabled',true);
				jQuery.ajax({
					url:'update_password.php',
					type:'post',
					data:'current_password='+current_password+'&new_password='+new_password,
					success:function(result){
						jQuery('#current_password_error').html(result);
						jQuery('#btn_update_password').html('Update');
						jQuery('#btn_update_password').attr('disabled',false);
						jQuery('#frmPassword')[0].reset();
					}
				})
			}
			
		}
		</script>	
		<?php
		include('footer.php');
		?>