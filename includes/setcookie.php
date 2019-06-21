<?php
include_once('init.php');
// ob_start();
if($_GET){
 header('Content-type:text/html');
$code=$_GET['data'];
setcookie("v_c_v",$code,time()+3600*24,"/",str_replace("http://","", $GETWEBURL));
// var_dump($code);
exit;
// setcookie("userid",$code,time()+3600*24,"/",$GETWEBURL);
}

?>