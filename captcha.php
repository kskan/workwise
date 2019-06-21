<?php
// include_once("includes/init.php");
//开启会话
include('includes/init.php');
// session_start();
//cookie(存放在客户端) sesion(存放在服务器)
include_once("includes/class.captcha.php");


//实例化一个验证码对象
$captcha = new captcha();

if($_GET['mode']=='userlogin'){
$captcha->setWidth(100);
}else if($_GET['mode']=='adminlogin'){
    $captcha->setWidth(500);
}
$captcha->doimg();
$_SESSION['captcha'] = $captcha->getCode();
//异步处理
//    $captcha->setCookie();

// function _curl($url, $data=null, $timeout=0, $isProxy=false){

//     $curl = curl_init();

//     if($isProxy){   //是否设置代理

//         $proxy = "127.0.0.1";   //代理IP

//         $proxyport = "8001";   //代理端口

//         curl_setopt($curl, CURLOPT_PROXY, $proxy.":".$proxyport);

//     }

//     curl_setopt($curl, CURLOPT_URL, $url);

//     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

//     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

//     if(!empty($data)){

//         curl_setopt($curl, CURLOPT_POST, 1);

//         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//         curl_setopt($curl, CURLOPT_HTTPHEADER, array(

//                 "cache-control: no-cache",

//                 "content-type: application/json",)

//         );

//     }

//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

//     if ($timeout > 0) { //超时时间秒

//         curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

//     }

//     $output = curl_exec($curl);

//     $error = curl_errno($curl);

//     curl_close($curl);

//     if($error){

//         return false;

//     }

//     return $output;

// }
// $code=$captcha->getCode();
// _curl($GETWEBURL.'/includes/setcookie.php?data='.$code,null,1);


// $code=$captcha->getCode();
// $_COOKIE['v_c_v']=$captcha->getCode();
// setcookie("v_c_v","$code",time()+3600*24);
// setcookie("v_c_v",$captcha->getCode(),time()+3600*24);
?>