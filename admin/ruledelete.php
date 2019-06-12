<?php
include_once('../includes/init.php');
checkAdmin(); //检测是否登录
isAuth(); //是否有权限


if($_POST)
{

	$deleteRule = isset($_POST['deleteRule']) ? $_POST['deleteRule'] : 0;

	$affectrows = $db->delete("rule","id IN($deleteRule)");

	if($affectrows)
	{
		header("Location:".config('website').'/admin/rulelist.php');
		exit;
	}else{
		showMsg('删除菜单规则失败',config('website').'/admin/rulelist.php');
		exit;
	}

}
?>