<header>
			<div class="container">
				<div class="header-data">
					<div class="logo">
						<a href="<?=$GETWEBURL?>" title=""><img src="assets/home/images/logo.png" alt=""></a>
					</div><!--logo end-->
					<?php if($_SERVER['PHP_SELF']!="/search.php"){?>
					<div class="search-bar">
						<form method="get" action="search.php">
							<input type="text" name="search" placeholder="Search...">
							<button type="submit"><i class="la la-search"></i></button>
						</form>
					</div><!--search-bar end-->
					<?php }?>
					
					<nav>
						<ul>
							<li>
								<a href="index.php" title="">
									<span><img src="assets/home/images/icon1.png" alt=""></span>
								    首页
								</a>
							</li>
							<li>
								<a href="companies.html" title="">
									<span><img src="assets/home/images/icon2.png" alt=""></span>
									Companies
								</a>
							</li>
							<li>
								<a href="projects.html" title="">
									<span><img src="assets/home/images/icon3.png" alt=""></span>
									Projects
								</a>
							</li>
							<li>
								<a href="profiles.html" title="">
									<span><img src="assets/home/images/icon4.png" alt=""></span>
									Profiles
								</a>
								<ul>
									<li><a href="user-profile.html" title="">User Profile</a></li>
									<li><a href="my-profile-feed.html" title="">my-profile-feed</a></li>
								</ul>
							</li>
							<li>
								<a href="jobs.html" title="">
									<span><img src="assets/home/images/icon5.png" alt=""></span>
									Jobs
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" title="" class="not-box-open">
									<span><img src="assets/home/images/icon6.png" alt=""></span>
									Messages
								</a>
								<div class="notification-box msg">
									<div class="nt-title">
										<h4>Setting</h4>
										<a href="javascript:void(0);" title="">Clear all</a>
									</div>
									<div class="nott-list">
										<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="assets/home/images/resources/ny-img1.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="messages.html" title="">Jassica William</a> </h3>
							  					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="assets/home/images/resources/ny-img2.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="messages.html" title="">Jassica William</a></h3>
							  					<p>Lorem ipsum dolor sit amet.</p>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="assets/home/images/resources/ny-img3.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="messages.html" title="">Jassica William</a></h3>
							  					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="view-all-nots">
						  					<a href="messages.html" title="">View All Messsages</a>
						  				</div>
									</div><!--nott-list end-->
								</div><!--notification-box end-->
							</li>
							<li>
								<a href="javascript:void(0);" title="" class="not-box-open">
									<span><img src="assets/home/images/icon7.png" alt=""></span>
									Notification
								</a>
								<div class="notification-box">
									<div class="nt-title">
										<h4>Setting</h4>
										<a href="javascript:void(0);" title="">Clear all</a>
									</div>
									<div class="nott-list">
										<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="assets/home/images/resources/ny-img1.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="javascript:void(0);" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="assets/home/images/resources/ny-img2.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="javascript:void(0);" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="assets/home/images/resources/ny-img3.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="javascript:void(0);" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="notfication-details">
							  				<div class="noty-user-img">
							  					<img src="assets/home/images/resources/ny-img2.png" alt="">
							  				</div>
							  				<div class="notification-info">
							  					<h3><a href="javascript:void(0);" title="">Jassica William</a> Comment on your project.</h3>
							  					<span>2 min ago</span>
							  				</div><!--notification-info -->
						  				</div>
						  				<div class="view-all-nots">
						  					<a href="javascript:void(0);" title="">View All Notification</a>
						  				</div>
									</div><!--nott-list end-->
								</div><!--notification-box end-->
							</li>
						</ul>
					</nav><!--nav end-->
					<div class="menu-btn">
						<a href="javascript:void(0);" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
				<?php if(isset( $_COOKIE['userid'])){?>
					<div class="user-account">
						<div class="user-info">
							<?php if(isset($_COOKIE['avatar'])){?>
							<img height="30" wight="30" id="headimg-h" src="assets/<?=$_COOKIE['avatar']?>" alt="">
							<?php }else{?>
								<img height="30" wight="30" id="headimg-h" src="assets/home/images/resources/noim-user.png" alt="">
							<?php }?>
							<a href="javascript:void(0);" title=""><?=$_COOKIE['username']?></a>
							<i class="la la-sort-down"></i>
						</div>
						<div class="user-account-settingss">
							<h3>Online Status</h3>
							<ul class="on-off-status">
								<li>
									<div class="fgt-sec">
										<input type="radio" name="cc" id="c5">
										<label for="c5">
											<span></span>
										</label>
										<small>Online</small>
									</div>
								</li>
								<li>
									<div class="fgt-sec">
										<input type="radio" name="cc" id="c6">
										<label for="c6">
											<span></span>
										</label>
										<small>Offline</small>
									</div>
								</li>
							</ul>
							<h3>Custom Status</h3>
							<div class="search_form">
								<form>
									<input type="text" name="search">
									<button type="submit">Ok</button>
								</form>
							</div><!--search_form end-->
							<h3>设置</h3>
							<ul class="us-links">
							     <li><a href="my-profile-feed.php" title="">我的信息</a></li>
								<li><a href="profile-account-setting.php" title="">账号设置</a></li>
								<li><a href="javascript:void(0);" title="">Terms & Conditions</a></li>
							</ul>
							<h3 class="tc"><a href="<?=$GETWEBURL?>/login.php?action=logout" title="">登出</a></h3>
						</div><!--user-account-settingss end-->
				<?php } else{?>
				<div class="user-account">
						<div class="user-info">
							<img height="30" wight="30" src="assets/home/images/resources/noim-user.png" alt="">
							<a href="login.php" title="">LOGIN</a>
							
						</div>
				</div>
				<?php }?>
					
					</div>
				</div><!--header-data end-->
			</div>
		</header><!--header end-->	