<?php
include_once('../includes/init.php');

$id=isset($_GET['id'])?$_GET['id']:null;
$show=$db->select()->from("admin")->where("id = $id")->find();
if(!$show){
  showMsg('用户不存在','');
  exit;
}
$grounp = $db->select()->from("group")->where("not id=1 ")->all();


if($_POST)
{

	$username = trim($_POST['username']);
	// $find=$db->select("username")->from("admin")->where("username = '$username'")->find();
	// if($find){
	// 	showMsg('用户已创建','admin_add.php');
	// 	exit;
	// }
	$password = trim($_POST['password']);
	$group_id= trim($_POST['group-id']);

	
	$data = array(
		"username"=>$_POST['username'],
		// "password"=> $md5password,
		// "salt"=>$salt,
		// "createtime"=>time(),
		"groupid"=>$_POST['group-id']
	  );
	  if(!empty($password)){
		 $salt=$random->getRandChar();
	      $md5password= md5($password.$salt);
		  $data['password']=$md5password;
		  $data['salt']=$salt;
	  }
	  if(isset($_FILES['avatar']))
	  {
		  $uploads = uploads("avatar","../assets/uploads/");
		  
		  
		  if($uploads['result'])
		  {
			  //文件上传成功
			  $data['avatar'] = @trim($uploads['msg'],"../assets");
			}
		}
		$admin = $db->update("admin",$data,"id = $id");
		
		if($admin)
		{
			showMsg('修改成功','adminlist.php');
			exit;
		}else{
			showMsg('修改失败','admin_add.php');
			exit;
		}
	}
	?>


<!DOCTYPE html>
<html lang="en">
  	<head>
	   <?php include("meta.php")?>

  	</head>

  	<body class="overflow-hidden">
		<div class="wrapper preload">
			<div class="sidebar-right">
				<div class="sidebar-inner scrollable-sidebar">
					<div class="sidebar-header clearfix">
						<input class="form-control dark-input" placeholder="Search" type="text">
						<div class="btn-group pull-right">
							<a href="#" class="sidebar-setting" data-toggle="dropdown"><i class="fa fa-cog fa-lg"></i></a>
							<ul class="dropdown-menu pull-right flipInV">
								<li><a href="#"><i class="fa fa-circle text-danger"></i><span class="m-left-xs">Busy</span></a></li>
								<li><a href="#"><i class="fa fa-circle-o"></i><span class="m-left-xs">Turn Off Chat</span></a></li>
							</ul>
						</div>
					</div>
					<div class="title-block">
						Group Chat
					</div>
					<div class="content-block">
						<ul class="sidebar-list">
							<li>
								<a href="#">
									<i class="fa fa-circle-o text-success"></i><span class="m-left-xs">Close Friends</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-circle-o text-success"></i><span class="m-left-xs">Business</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="title-block">
						Favorites
					</div>
					<div class="content-block">
						<ul class="sidebar-list">
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile2.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											John Doe
										</div>
										<div class="chat-message">
											Where are you?
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-success"></i>
									</div>
									<div class="chat-alert">
										<span class="badge badge-purple bounceIn animation-delay2">2</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile3.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											Jane Doe
										</div>
										<div class="chat-message">
											Hello
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-success"></i>
									</div>
									<div class="chat-alert">
										<span class="badge badge-info bounceIn animation-delay2">1</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile4.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											John Doe
										</div>
										<div class="chat-message">
											See you again next week.
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-danger"></i>
									</div>
									<div class="chat-alert">
										<i class="fa fa-check text-success"></i>
									</div>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile5.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											John Doe
										</div>
										<div class="chat-message">
											Hello, Are you there?
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-danger"></i>
									</div>
									<div class="chat-alert">
										<i class="fa fa-reply"></i>
									</div>
								</a>
							</li>
						</ul>
					</div>
					<div class="title-block">
						More friends
					</div>
					<div class="content-block">
						<ul class="sidebar-list">
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile6.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											John Doe
										</div>
										<div class="chat-message">
											Where are you?
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-success"></i>
									</div>
									<div class="chat-alert">
										<span class="badge badge-success bounceIn animation-delay2">2</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile7.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											Jane Doe
										</div>
										<div class="chat-message">
											Hello
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-success"></i>
									</div>
									<div class="chat-alert">
										<span class="badge badge-danger bounceIn animation-delay2">1</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile8.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											John Doe
										</div>
										<div class="chat-message">
											See you again next week.
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-danger"></i>
									</div>
									<div class="chat-alert">
										<i class="fa fa-check text-success"></i>
									</div>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<img src="images/profile/profile9.jpg" class="img-circle" alt="user avatar">
									<div class="chat-detail m-left-sm">
										<div class="chat-name">
											John Doe
										</div>
										<div class="chat-message">
											Hello, Are you there?
										</div>
									</div>
									<div class="chat-status">
										<i class="fa fa-circle-o text-danger"></i>
									</div>
									<div class="chat-alert">
										<i class="fa fa-reply"></i>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div><!-- sidebar-inner -->
			</div><!-- sidebar-right -->
		<?php include("header.php")?>
			<?php include("menu.php")?>
			
			<div class="main-container">
				<div class="padding-md">
					<h2 class="header-text">
						账号管理
						<span class="sub-header">
							管理账号
						</span>
					</h2>
					<div class="smart-widget m-top-lg widget-dark-blue">
						<div class="smart-widget-header">
							账号添加
							<span class="smart-widget-option">
								<span class="refresh-icon-animated">
									<i class="fa fa-circle-o-notch fa-spin"></i>
								</span>
	                            <a href="#" class="widget-toggle-hidden-option">
	                                <i class="fa fa-cog"></i>
	                            </a>
	                            <a href="#" class="widget-collapse-option" data-toggle="collapse">
	                                <i class="fa fa-chevron-up"></i>
	                            </a>
	                            <a href="#" class="widget-refresh-option">
	                                <i class="fa fa-refresh"></i>
	                            </a>
	                            <a href="#" class="widget-remove-option">
	                                <i class="fa fa-times"></i>
	                            </a>
	                        </span>
						</div>
						<div class="smart-widget-inner">
							<div class="smart-widget-hidden-section">
								<ul class="widget-color-list clearfix">
									<li style="background-color:#20232b;" data-color="widget-dark"></li>
									<li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
									<li style="background-color:#23b7e5;" data-color="widget-blue"></li>
									<li style="background-color:#2baab1;" data-color="widget-green"></li>
									<li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
									<li style="background-color:#fbc852;" data-color="widget-orange"></li>
									<li style="background-color:#e36159;" data-color="widget-red"></li>
									<li style="background-color:#7266ba;" data-color="widget-purple"></li>
									<li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
									<li style="background-color:#fff;" data-color="reset"></li>
								</ul>
							</div>
							<div class="smart-widget-body">
								<form method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label for="exampleInputEmail1">新添加管理员</label>
										<input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Enter admin" value="<?=$show['username']?>">
									</div><!-- /form-group -->
									<div class="form-group">
										<label for="exampleInputPassword1">管理密码</label>
										<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" >
									</div><!-- /form-group -->
									<div class="form-group">
										<label class="col-lg-2 control-label">头像上传</label>
										<div class="col-lg-10">
											<input type="file" name="avatar">
										</div><!-- /.col -->
									</div><!-- /form-group -->
									
									<div class="form-group">
										
									<label for="exampleInputPassword1">给予权限</label>
									<select class="form-control" name="group-id">
												<?php  foreach($grounp as $item){?>
													<option value="<?=$item['id']?>" <?=$item['id']==$show['groupid']?"selected":""?>><?=$item['name']?></option>
												<?php }?>
											</select>

									</div><!-- /form-group -->
									<button type="submit" class="btn btn-success btn-sm">Submit</button>
								</form>
							</div>
						</div><!-- ./smart-widget-inner -->
					</div><!-- ./smart-widget -->

					
				</div><!-- ./padding-md -->
			</div><!-- /main-container -->

			<footer class="footer">
				<span class="footer-brand">
					<strong class="text-danger">Simplify</strong> Admin
				</span>
				<p class="no-margin">
					&copy; 2014 <strong>Simplify Admin</strong>. ALL Rights Reserved. 
				</p>	
			</footer>
		</div><!-- /wrapper -->

		<!-- Small modal -->
		<div class="modal fade" id="formInModal">
		  	<div class="modal-dialog modal-sm">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h4 class="modal-title" id="myModalLabel">Login</h4>
		      		</div>
		      		<div class="modal-body">
		        		<form role="form">
				  			<div class="form-group">
				    			<label for="inputEmailModal">Email address</label>
				    			<input type="email" class="form-control" id="inputEmailModal" placeholder="Enter email">
				  			</div>
				  			<div class="form-group">
							    <label for="inputPasswordModal">Password</label>
							    <input type="password" class="form-control" id="inputPasswordModal" placeholder="Password">
	  			  			</div>
	  			  			<div class="form-group">
			   	    			<div class="custom-checkbox">
									<input type="checkbox" id="checkboxModal">
							  	  	<label for="checkboxModal"></label>
				    			</div>
				    			Remember Me
				  			</div>
		        		</form>

				        <a class="btn btn-primary block m-top-md"><i class="fa fa-facebook"></i> Login with facebook</a>
				        <a class="btn btn-danger block m-top-md">Login</a>
		      		</div>
		    	</div>
		  	</div>
		</div>

		<!-- Delete Widget Confirmation -->
		<div class="custom-popup delete-widget-popup delete-confirmation-popup" id="deleteWidgetConfirm">
			<div class="popup-header text-center">
				<span class="fa-stack fa-4x">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
				</span>
			</div>
			<div class="popup-body text-center">
				<h5>Are you sure to delete this widget?</h5>
				<strong class="block m-top-xs"><i class="fa fa-exclamation-circle m-right-xs text-danger"></i>This action cannot be undone</strong>
			
				<div class="text-center m-top-lg">
					<a class="btn btn-success m-right-sm remove-widget-btn">Delete</a>
					<a class="btn btn-default deleteWidgetConfirm_close">Cancel</a>
				</div>
			</div>
		</div>

		<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>
		<?php include_once('script.php');?>
	
  	</body>
</html>
