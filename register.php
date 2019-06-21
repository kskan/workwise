<?php

//   include("include/init.php");
include("includes/init.php");
if($_POST){
	$username=isset( $_POST['username'])?$_POST['username']:"";
	$password=isset( $_POST['password'])?$_POST['password']:"";
	$repassword=isset( $_POST['repassword'])?$_POST['repassword']:"";
	if($username!=""&&$password!=""&&$repassword!=""){
		// $code=$_POST['captcha'];
		$captcha = strtolower($_POST['captcha']);
	   if($captcha != $_SESSION['captcha'])
	   {
		showMsg('验证码输入错误','login.php');
		exit;
		}
		$find=$db->select("username")->from("user")->where("username = '$username'")->find();
	if($find){
		showMsg('用户已创建','admin_add.php');
		exit;
	}
		if($password==$repassword){
			//制作盐
			$salt=$random->getRandChar();
         	$md5password= md5($password.$salt);
			$data=array(
				"username"=>$username,
				"password"=>$md5password,
				"salt"=>$salt,
				"createtime"=>time(),
				"avatar"=>"/home/images/resources/noim-user.png",
				"desc"=>"这家伙很懒,什么都没留"
			);
			$user = $db->insert("user",$data);
	if($user)
	{
		showMsg('注册成功','login.php');
		exit;
	}else{
		showMsg('注册失败','register.php');
		exit;
	}

		}
		showMsg("注册成功","login.php");
		exit;
	}else{
		showMsg("数据接收错误,请重试","register.php");
		exit;
	}
}


?>
<html>
	<head>
		<title>注册</title>
		<link rel="stylesheet" href="/assets/login/css/login.css">

		<script type="text/javascript">
            function changeImg() {
                var img = document.getElementById("img");
                img.src = "/captcha.php?mode=userlogin&date=" + new Date();
            }

            function checkVerificationCode() {
				// var verificationCode = document.getElementById('verificationCode').value;
                // var flag = (getCookie('v_c_v') == verificationCode);
                // if (!flag) {
                //     alert('验证码输入错误');
				// }
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
            var message="<?=isset( $_SESSION['message'])?$_SESSION['message']:""?>";
            <?php  $_SESSION['message']=null?>
            if(message!=null &&message!="null"&&message!=""){
            	alert(message);
			}
		</script>
	</head>
	<body>
		<div class="login">
			<div class="header">
				<h1>
					<a href="javasrcpit:void(0)">注册</a>
					<a href="/login.php">登录</a>

				</h1>
				<button onclick="location='<?=$GETWEBURL?>'"></button>
			</div>
			<form method="post">
				<div class="name">
					<input type="text" id="name" name="username" placeholder="请输入注册用户名">
					<p></p>
				</div>
				<div class="pwd">
					<input type="password" id="pwd" name="password" placeholder="6-16位密码，区分大小写，不能用空格">
					<p></p>
				</div>
				<div class="pwd">
					<input type="password" id="rpwd" name="repassword" placeholder="请在输入一次密码">
					<p></p>
				</div>
				<div class="idcode">
					<input type="text" id="verificationCode" name="captcha" placeholder="请输入验证码">
					<a href='#'  onclick="javascript:changeImg()">&nbsp;&nbsp;&nbsp;&nbsp;换一张</a>
					<span><img height="100%"  width="100%" id="img" src="/captcha.php?mode=userlogin"/></span>
					<div class="clear"></div>
				</div>

				<div class="btn-red">
					<input onclick="return checkVerificationCode();" type="submit" value="注册" id="login-btn">
				</div>
			</form>
		</div>
	</body>
</html>