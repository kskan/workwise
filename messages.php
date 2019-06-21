<?php
include ("includes/init.php");
$message=$db->select()->from("message")->find();



?>
<!DOCTYPE html>
<html>
<head>
<?php include("common/meta.php");?>
</head>


<body>
	

	<div class="wrapper">
		

   <?php include("common/header.php")?>



		<section class="messages-page">
			<div class="container">
				<div class="messages-sec">
					<div class="row">
						<div class="col-lg-4 col-md-12 no-pdd">
							<div class="msgs-list">
								<div class="msg-title">
									<h3>Messages</h3>
									<ul>
										<li><a href="messages.php#" title=""><i class="fa fa-cog"></i></a></li>
										<li><a href="messages.php#" title=""><i class="fa fa-ellipsis-v"></i></a></li>
									</ul>
								</div><!--msg-title end-->
								<div class="messages-list">
									<ul>
										<li class="active">
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="assets/home/images/resources/m-img1.png" alt="">
													<span class="msg-status"></span>
												</div>
												<div class="usr-mg-info">
													<h3>John Doe</h3>
													<p>Lorem ipsum dolor <img src="assets/home/images/smley.png" alt=""></p>
												</div><!--usr-mg-info end-->
												<span class="posted_time">1:55 PM</span>
												<span class="msg-notifc">1</span>
											</div><!--usr-msg-details end-->
										</li>
										<li>
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="assets/home/images/resources/m-img2.png" alt="">
												</div>
												<div class="usr-mg-info">
													<h3>David Vane</h3>
													<p>Vestibulum ac diam..</p>
												</div><!--usr-mg-info end-->
												<span class="posted_time">1:55 PM</span>
											</div><!--usr-msg-details end-->
										</li>
										<li>
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="assets/home/images/resources/m-img3.png" alt="">
												</div>
												<div class="usr-mg-info">
													<h3>Nancy Dilan</h3>
													<p>Quam vehicula.</p>
												</div><!--usr-mg-info end-->
												<span class="posted_time">1:55 PM</span>
											</div><!--usr-msg-details end-->
										</li>
										<li>
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="assets/home/images/resources/m-img4.png" alt="">
													<span class="msg-status"></span>
												</div>
												<div class="usr-mg-info">
													<h3>Norman Kenney</h3>
													<p>Nulla quis lorem ut..</p>
												</div><!--usr-mg-info end-->
												<span class="posted_time">1:55 PM</span>
											</div><!--usr-msg-details end-->
										</li>
										<li>
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="assets/home/images/resources/m-img5.png" alt="">
													<span class="msg-status"></span>
												</div>
												<div class="usr-mg-info">
													<h3>James Dilan</h3>
													<p>Vivamus magna just..</p>
												</div><!--usr-mg-info end-->
												<span class="posted_time">1:55 PM</span>
											</div><!--usr-msg-details end-->
										</li>
										<li>
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="assets/home/images/resources/m-img6.png" alt="">
												</div>
												<div class="usr-mg-info">
													<h3>Mike Dorn</h3>
													<p>Praesent sapien massa.</p>
												</div><!--usr-mg-info end-->
												<span class="posted_time">1:55 PM</span>
											</div><!--usr-msg-details end-->
										</li>
										<li>
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="assets/home/images/resources/m-img7.png" alt="">
												</div>
												<div class="usr-mg-info">
													<h3>Patrick Morison</h3>
													<p>Convallis a pellente...</p>
												</div><!--usr-mg-info end-->
												<span class="posted_time">1:55 PM</span>
											</div><!--usr-msg-details end-->
										</li>
									</ul>
								</div><!--messages-list end-->
							</div><!--msgs-list end-->
						</div>
						<div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
							<div class="main-conversation-box">
								<div class="message-bar-head">
									<div class="usr-msg-details">
										<div class="usr-ms-img">
											<img src="assets/home/images/resources/m-img1.png" alt="">
										</div>
										<div class="usr-mg-info">
											<h3>John Doe</h3>
											<p>Online</p>
										</div><!--usr-mg-info end-->
									</div>
									<a href="messages.php#" title=""><i class="fa fa-ellipsis-v"></i></a>
								</div><!--message-bar-head end-->
								<div class="messages-line">
									<div class="main-message-box">
										<div class="messg-usr-img">
											<img src="assets/home/images/resources/m-img1.png" alt="">
										</div><!--messg-usr-img end-->
										<div class="message-dt">
											<div class="message-inner-dt img-bx">
												<img src="assets/home/images/resources/mt-img1.png" alt="">
												<img src="assets/home/images/resources/mt-img2.png" alt="">
												<img src="assets/home/images/resources/mt-img3.png" alt="">
											</div><!--message-inner-dt end-->
											<span>Sat, Aug 23, 1:08 PM</span>
										</div><!--message-dt end-->
									</div><!--main-message-box end-->
									<div class="main-message-box ta-right">
										<div class="message-dt">
											<div class="message-inner-dt">
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
											</div><!--message-inner-dt end-->
											<span>Sat, Aug 23, 1:08 PM</span>
										</div><!--message-dt end-->
										<div class="messg-usr-img">
											<img src="assets/home/images/resources/m-img2.png" alt="">
										</div><!--messg-usr-img end-->
									</div><!--main-message-box end-->
									<div class="main-message-box st3">
										<div class="message-dt st3">
											<div class="message-inner-dt">
												<p>Cras ultricies ligula.<img src="assets/home/images/smley.png" alt=""></p>
											</div><!--message-inner-dt end-->
											<span>5 minutes ago</span>
										</div><!--message-dt end-->
										<div class="messg-usr-img">
											<img src="assets/home/images/resources/m-img1.png" alt="">
										</div><!--messg-usr-img end-->
									</div><!--main-message-box end-->
									<div class="main-message-box ta-right">
										<div class="message-dt">
											<div class="message-inner-dt">
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
											</div><!--message-inner-dt end-->
											<span>Sat, Aug 23, 1:08 PM</span>
										</div><!--message-dt end-->
										<div class="messg-usr-img">
											<img src="assets/home/images/resources/m-img2.png" alt="">
										</div><!--messg-usr-img end-->
									</div><!--main-message-box end-->
									<div class="main-message-box st3">
										<div class="message-dt st3">
											<div class="message-inner-dt">
												<p>....</p>
											</div><!--message-inner-dt end-->
											<span>Typing...</span>
										</div><!--message-dt end-->
										<div class="messg-usr-img">
											<img src="assets/home/images/resources/m-img1.png" alt="">
										</div><!--messg-usr-img end-->
									</div><!--main-message-box end-->
									<div class="main-message-box ta-right">
										<div class="message-dt">
											<div class="message-inner-dt">
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
											</div><!--message-inner-dt end-->
											<span>Sat, Aug 23, 1:08 PM</span>
										</div><!--message-dt end-->
										<div class="messg-usr-img">
											<img src="assets/home/images/resources/m-img2.png" alt="">
										</div><!--messg-usr-img end-->
									</div><!--main-message-box end-->
									<div class="main-message-box st3">
										<div class="message-dt st3">
											<div class="message-inner-dt">
												<p>....</p>
											</div><!--message-inner-dt end-->
											<span>Typing...</span>
										</div><!--message-dt end-->
										<div class="messg-usr-img">
											<img src="assets/home/images/resources/m-img1.png" alt="">
										</div><!--messg-usr-img end-->
									</div><!--main-message-box end-->
								</div><!--messages-line end-->
								<div class="message-send-area">
									<form>
										<div class="mf-field">
											<input type="text" name="message" placeholder="Type a message here">
											<button type="submit">Send</button>
										</div>
										<ul>
											<li><a href="messages.php#" title=""><i class="fa fa-smile-o"></i></a></li>
											<li><a href="messages.php#" title=""><i class="fa fa-camera"></i></a></li>
											<li><a href="messages.php#" title=""><i class="fa fa-paperclip"></i></a></li>
										</ul>
									</form>
								</div><!--message-send-area end-->
							</div><!--main-conversation-box end-->
						</div>
					</div>
				</div><!--messages-sec end-->
			</div>
		</section><!--messages-page end-->



		<footer>
			<div class="footy-sec mn no-margin">
				<div class="container">
					<ul>
						<li><a href="messages.php#" title="">Help Center</a></li>
						<li><a href="messages.php#" title="">Privacy Policy</a></li>
						<li><a href="messages.php#" title="">Community Guidelines</a></li>
						<li><a href="messages.php#" title="">Cookies Policy</a></li>
						<li><a href="messages.php#" title="">Career</a></li>
						<li><a href="messages.php#" title="">Forum</a></li>
						<li><a href="messages.php#" title="">Language</a></li>
						<li><a href="messages.php#" title="">Copyright Policy</a></li>
					</ul>
					<p><img src="assets/home/images/copy-icon2.png" alt="">Copyright 2017</p>
					<img class="fl-rgt" src="assets/home/images/logo2.png" alt="">
				</div>
			</div>
		</footer>

	</div><!--theme-layout end-->




</body>
</html>
