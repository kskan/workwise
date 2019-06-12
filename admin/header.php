<?php 
include_once('../includes/init.php');

checkAdmin(); //检测是否登录

?>
<header class="top-nav">
	<div class="top-nav-inner">
		<!-- 手机端 -->
		<div class="nav-header">
			<button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleSM">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
			<!-- 手机端 -->
			<ul class="nav-notification pull-right">
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg"></i></a>
					<span class="badge badge-danger bounceIn">1</span>
					<ul class="dropdown-menu dropdown-sm pull-right user-dropdown">
						<li class="user-avatar">
							<?php if(isset($_SESSION['avatar']) && is_file($_SESSION['avatar'])){?>
								<img src="../assets/<?php echo $_SESSION['avatar'];?>" alt="" class="img-circle">
							<?php }else{?>
								<img src="../assets/admin/images/profile/profile1.jpg" alt="" class="img-circle">
							<?php }?>
							<div class="user-content">
								<h5 class="no-m-bottom"><?php echo $_SESSION['username'];?></h5>
								<div class="m-top-xs">
									<a href="profile.html" class="m-right-sm">个人中心</a>
									<a href="login.php?action=logout">退出</a>
								</div>
							</div>
						</li>			  	  
					</ul>
				</li>
			</ul>
			
			<a href="index.html" class="brand">
				<span class="brand-name">SIMPLIFY ADMIN</span>
			</a>
		</div>

		<!-- PC端 -->
		<div class="nav-container">
			<button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleLG">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- 搜索 -->
			<ul class="nav-notification">	
				<li class="search-list">
					<div class="search-input-wrapper">
						<div class="search-input">
							<input type="text" class="form-control input-sm inline-block">
							<a href="#" class="input-icon text-normal"><i class="ion-ios7-search-strong"></i></a>
						</div>
					</div>
				</li>
			</ul>

			<!-- 当前用户 -->
			<div class="pull-right m-right-sm">
				<div class="user-block hidden-xs">
					<a href="#" id="userToggle" data-toggle="dropdown">
						<?php if(isset($_SESSION['avatar']) && is_file($_SESSION['avatar'])){?>
							<img src="../assets/<?php echo $_SESSION['avatar'];?>" alt="" class="img-circle inline-block user-profile-pic">
						<?php }else{?>
							<img src="../assets/admin/images/profile/profile1.jpg" alt="" class="img-circle inline-block user-profile-pic">
						<?php }?>
						<div class="user-detail inline-block">
							<?php echo $_SESSION['username'];?>
							<i class="fa fa-angle-down"></i>
						</div>
					</a>
					<div class="panel border dropdown-menu user-panel">
						<div class="panel-body paddingTB-sm">
							<ul>
								<li>
									<a href="profile.html">
										<i class="fa fa-edit fa-lg"></i><span class="m-left-xs">个人中心</span>
									</a>
								</li>
								<li>
									<a href="login.php?action=logout">
										<i class="fa fa-power-off fa-lg"></i><span class="m-left-xs">退出</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- ./top-nav-inner -->	
</header>