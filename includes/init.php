<?php
@session_start(); //开启会话
header("Content-Type:text/html;charset=utf-8");
// error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL);  //显示所有错误

//自动加载函数  自动
function __autoload($className)
{
    //class.DB.php
    include_once("class.$className.php");
}

//当实例化的对象不存在的时候
$db = new DB("localhost","root","a13316153401","workwise");

//随机字符串对象
$random = new random();


//引入函数库
include_once('helpers.php');

?>
