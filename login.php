<?php
include("includes/init.php");
$action = isset($_GET['action']) ? $_GET['action'] : "";

//退出操作
if($action == "logout")
{
	
    //释放所有会话变量，删除掉cookie
    session_unset();
    //如何让cookie过期
    setcookie('userid',null,time()-123);
    setcookie('username',null,time()-123);
    setcookie('avatar',null,time()-123);
    setcookie('userid',null,time()-123);
    showMsg('退出成功','login.php');
    exit;
}
if($_POST)
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
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
	$user = $db->select()->from("user")->where("username = '$username'")->find();
	if(!$user)
	{
		showMsg('用户不存在','login.php');
		exit;
	}
	//将明文密码和密码盐合并 md5加密
	$checkpass = md5($password.$user['salt']);

	if($checkpass != $user['password'])
	{
		showMsg('密码错误','login.php');
		exit;
	}else{
		//登录成功
		setcookie("userid",$user['id'],time()+3600*24);
		setcookie("username",$user['username'],time()+3600*24);
		setcookie("avatar",$user['avatar'],time()+3600*24);
		setcookie("userid",$user['id'],time()+3600*24);
		setcookie("desc",$user['desc'],time()+3600*24);

		//登录成功跳转后台首页
		showMsg('登录成功','index.php');
		exit;
	}
}
?>
<html>
	<head>
		<title>登录</title>
		<link rel="stylesheet" href="assets/login/css/login.css">
		<script type="text/javascript">
            function changeImg() {
                var img = document.getElementById("img");
                img.src = "/captcha.php?mode=userlogin&date=" + new Date();
				console.log(getCookie('v_c_v'));
            }
			
    //        console.log(getCookie("v_c_v"));

            function checkVerificationCode() 
			{
				// console.log(getCookie("v_c_v"));
	
				return ture;
            }

            function getCookie(cookie_name) {
                var allCookies = document.cookie;
                var cookie_pos = allCookies.indexOf(cookie_name);   //如果找到了索引，就代表cookie存在
                if (cookie_pos != -1) {
                    cookie_pos += cookie_name.length + 1;
                    var cookie_end = allCookies.indexOf(";", cookie_pos);
                    if (cookie_end == -1) {
                        cookie_end = allCookies.length;
                    }
                    return unescape(allCookies.substring(cookie_pos, cookie_end));
                }
                return null;
            }
		</script>
	</head>
	<body>
		<div class="login">
			<div class="header">
				<h1>
					<a href="/login.php">登录</a>
					<a href="/register.php">注册</a>
				</h1>
				<button onclick="location='<?=$GETWEBURL?>'"></button>
			</div>
			<form  method="post">
				<div class="name">
					<input type="text" id="name" name="username" placeholder="请输入登录用户名">
					<p></p>
				</div>
				<div class="pwd">
					<input type="password" id="pwd" name="password" placeholder="6-16位密码，区分大小写，不能用空格">
					<p></p>
				</div>
				<div class="idcode">
					<input type="text" id="verificationCode" name="captcha" placeholder="请输入验证码">
					<a href='#' onclick="javascript:changeImg()">&nbsp;&nbsp;&nbsp;&nbsp;换一张</a>
					<span><img height="100%"  width="100%" id="img" src="captcha.php?mode=userlogin"/></span>
					<div class="clear"></div>
				</div>
				<div class="autoLogin">
					<a href="">忘记密码</a>
				</div>
				<div class="btn-red">
					<input onclick="return checkVerificationCode();" type="submit" value="登录" id="login-btn">
				</div>
			</form>
		</div>
	</body>
</html>