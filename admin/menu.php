<?php
include_once('../includes/init.php');

checkAdmin(); //检测是否登录

//把json转化为php数组
$adminmenu = json_decode(adminMenu(),true);

?>
<aside class="sidebar-menu fixed">
	<div class="sidebar-inner scrollable-sidebar">
		<div class="main-menu">
			<ul class="accordion">
				<li class="menu-header">
					Main Menu
				</li>

				<?php foreach($adminmenu as $item){?>
					<li class="<?php echo $item['pidclass']?> bg-palette3 <?php echo $item['ismenu'] ? '':'hidden';?>">
						<a href="<?php echo config('website').$item['url']?>">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
								<span class="text m-left-sm"><?php echo $item['title'];?></span>
								<span class="submenu-icon"></span>
							</span>
							<span class="menu-content-hover block">
							<?php echo $item['title'];?>
							</span>
						</a>
						<?php if(isset($item['son']) && !empty($item['son'])){?>
						<ul class="submenu bg-palette4">
							<?php foreach($item['son'] as $value){?>
							<li class="<?php echo $value['ismenu'] ? '':'hidden';?>"><a href="<?php echo config('website').$value['url'];?>"><span class="submenu-label"><?php echo $value['title'];?></span></a></li>
							<?php }?>
						</ul>
						<?php }?>
					</li>
				<?php }?>
				
			</ul>
		</div>	
		<div class="sidebar-fix-bottom clearfix">
			<div class="user-dropdown dropup pull-left">
				<a href="#" class="dropdwon-toggle font-18" data-toggle="dropdown"><i class="ion-person-add"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="inbox.html">
							Inbox
							<span class="badge badge-danger bounceIn animation-delay2 pull-right">1</span>
						</a>
					</li>			  
					<li>
						<a href="#">
							Notification
							<span class="badge badge-purple bounceIn animation-delay3 pull-right">2</span>
						</a>
					</li>			  
					<li>
						<a href="#" class="sidebarRight-toggle">
							Message
							<span class="badge badge-success bounceIn animation-delay4 pull-right">7</span>
						</a>
					</li>			  	  
					<li class="divider"></li>
					<li>
						<a href="#">Setting</a>
					</li>			  	  
				</ul>
			</div>
			<a href="lockscreen.html" class="pull-right font-18"><i class="ion-log-out"></i></a>
		</div>
	</div><!-- sidebar-inner -->
</aside>