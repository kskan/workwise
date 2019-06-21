<?php
include_once('../includes/init.php');
$action = isset($_GET['action']) ? $_GET['action'] : "";
//退出操作
if($action == "logout")
{
	//释放所有会话变量，删除掉cookie
	session_unset();
	//如何让cookie过期
	setcookie('auto',null,time()-123);
	showMsg('退出成功','login.php');
	exit;
}


//是否要自动登录
$auto = isset($_COOKIE['auto']) ? $_COOKIE['auto'] : "";

if(!empty($auto))
{
	$userlist = $db->select("id,username,avatar,groupid,status")->from("admin")->all();

	if($userlist)
	{
		foreach($userlist as $item)
		{
			if(md5($item['username']) == $auto)
			{
				//保存cookie
				setcookie("auto",md5($item['username']),time()+3600*24);

				//保存session
				$_SESSION['adminid'] = $item['id'];
				$_SESSION['username'] = $item['username'];
				$_SESSION['avatar'] = $item['avatar'];
				$_SESSION['groupid'] = $item['groupid'];

				//跳转
				@header("Location:index.php");
				exit;
			}
		}
	}
}


if($_POST)
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$auto = isset($_POST['auto']) ? $_POST['auto'] : 0;
	$captcha = strtolower($_POST['captcha']);

	if($captcha != $_SESSION['captcha'])
	{
		showMsg('验证码输入错误','login.php');
		exit;
	}

	//先根据用户名找出记录
	//在去验证密码是否正确
	//把用户的信息记录到缓存里面
	//跳转

	//链式操作
	$admin = $db->select()->from("admin")->where("username = '$username'")->find();

	if(!$admin)
	{
		showMsg('管理员不存在','login.php');
		exit;
	}

	//管理员是否被禁用
	if(!$admin['status'])
	{
		showMsg('管理员被禁用了','login.php');
		exit;
	}

	//将明文密码和密码盐合并 md5加密
	$checkpass = md5($password.$admin['salt']);

	if($checkpass != $admin['password'])
	{
		showMsg('密码错误','login.php');
		exit;
	}else{
		//登录成功
		if($auto)  //自动登录
		{
			//cookie session
			//setcookie 设置cookie 参数(名称,值,有效时间)
			setcookie("auto",md5($admin['username']),time()+3600*24);
		}

		//把管理员存到服务器的缓存里面
		$_SESSION['adminid'] = $admin['id'];
		$_SESSION['username'] = $admin['username'];
		$_SESSION['avatar'] = $admin['avatar'];
		$_SESSION['groupid'] = $admin['groupid'];

		//登录成功跳转后台首页
		showMsg('登录成功','index.php');
		exit;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <title><?=$GETWEBTITLE?>Admin 登陆</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <!-- Bootstrap core CSS -->
	    <link href="../assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Font Awesome -->
		<link href="../assets/admin/css/font-awesome.min.css" rel="stylesheet">

		<!-- ionicons -->
		<link href="../assets/admin/css/ionicons.min.css" rel="stylesheet">
		
		<!-- Simplify -->
		<link href="../assets/admin/css/simplify.min.css" rel="stylesheet">
	
  	</head>

  	<body class="overflow-hidden light-background">
		<div class="wrapper no-navigation preload">
			<div class="sign-in-wrapper">
				<div class="sign-in-inner">
					<div class="login-brand text-center">
						<i class="fa fa-database m-right-xs"></i> <?=$GETWEBTITLE?> <strong class="text-skin">Admin</strong>
					</div>

					<form method="post">
						<div class="form-group m-bottom-md">
							<input type="text" class="form-control" placeholder="请输入用户名" required name="username">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="请输入密码" required name="password">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="请输入验证码" required name="captcha">
						</div>

						<div class="form-group">
							<img src="<?=$GETWEBURL?>/captcha.php?mode=adminlogin"onclick="this.src='<?=$GETWEBURL?>/captcha.php?mode=adminlogin&random='+Math.random();" />
						</div>

						<div class="form-group">
							<div class="custom-checkbox">
								<input type="checkbox" id="chkRemember" name="auto" value="1">
								<label for="chkRemember"></label>
							</div>记住登录
						</div>

						<div class="m-top-md p-top-sm">
							<button href="index.html" class="btn btn-success block" style="margin:0 auto;">登录</button>
						</div>
					</form>
				</div><!-- ./sign-in-inner -->
			</div><!-- ./sign-in-wrapper -->
		</div><!-- /wrapper -->

		<a href="" id="scroll-to-top" class="hidden-print"><i class="icon-chevron-up"></i></a>

	    <!-- Le javascript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
		
		<!-- Jquery -->
		<script src="../assets/admin/js/jquery-1.11.1.min.js"></script>
		
		<!-- Bootstrap -->
	    <script src="../assets/admin/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll -->
		<script src='../assets/admin/js/jquery.slimscroll.min.js'></script>
		
		<!-- Popup Overlay -->
		<script src='../assets/admin/js/jquery.popupoverlay.min.js'></script>

		<!-- Modernizr -->
		<script src='../assets/admin/js/modernizr.min.js'></script>
		
		<!-- Simplify -->
		<script src="../assets/admin/js/simplify/simplify.js"></script>
	
  	</body>
</html>
