<?php
include "top.php";
?>

		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Contact</h3>
					</div>		

					<div class="col-sm-6 text-end">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><span>Contact</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Contact Page -->
		<div class="contact_page_area fix">
			<div class="container">					
				<div class="row">
					<div class="contact_frm_area text-left col-lg-6 col-md-12 col-xs-12">
						<h3>Get in Touch</h3>
						<form method="POST" action="https://belaltheme.com/Mb/swiftshop/contact.php">
							<div class="row">
								<div class="form-group col-lg-6"><input type="text" name="name" class="form-control" id="name" placeholder="Name*" required="required"  /></div>
								<div class="form-group col-lg-6"><input type="email" name="email" class="form-control" id="email" placeholder="Email*" required="required" /></div>
							</div>
                            <div class="row">
								<div class="form-group col-lg-6"><input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile*" required="required"  /></div>
								<div class="form-group col-lg-6"><input type="text" name="subject" class="form-control" id="subject" placeholder="Subject*" required="required" /></div>
							</div>
							<!--<div class="form-group">
								<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" />
							</div>-->

				
							<div class="form-group">
								<textarea name="message" class="form-control" id="message" placeholder="Message" required="required"></textarea>
							</div>
							
							<div class="input-area submit-area"><button class="main_btn" type="button" onclick="send_message()">Send Message</button></div>
							
						</form>		
					</div>	
				
					<div class="contact_info col-lg-6 col-md-12 col-xs-12">
						<h3>Contact Info</h3>
						<p class="subtitle">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
							Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
						</p>
						<div class="single_info">
							<div class="con_icon"><i class="pe-7s-map-marker"></i></div>
							<p>1660 Travis Street <br />Miramar, FL 33025 </p>
						</div>
						<div class="single_info">
							<div class="con_icon"><i class="pe-7s-headphones"></i></div>
							<p>Phone : +772-607-0042</p>
							<p>Fax : +772-607-0042</p>
						</div>
						<div class="single_info">
							<div class="con_icon"><i class="pe-7s-mail"></i></div>
							<a href="#">sales@example.com </a> <br />
							<a href="#">support@example.com </a>
						</div>
						
					</div>
				</div>
			</div>
		
							
			<div class="fix">
				<div id="contact_map_area">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8352535722433!2d144.9537353148307!3d-37.817327679751706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sbd!4v1550438711298" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>	
				
		</div>
<?PHP ?>
<?php include "footer.php"; ?>