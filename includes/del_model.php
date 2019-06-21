<?php
include_once("../includes/init.php");
// $mode=isset($_GET('mode')) ? $_GET('mode') : "";
$mode = isset($_GET['mode']) ? $_GET['mode'] : "";
//真删除
if($mode=='realdel'){
     $id=$_GET['id'];
     $table=$_GET['table'];
     $del=$db->delete($table,"id='$id'");
     
     if($del)
	{
		showMsg('删除成功','');
		exit;
	}else{
		showMsg('删除失败','');
		exit;
	}
     


}
//假删除
if($mode=='fakedel'){
    $id=$_GET['id'];
    $table=$_GET['table'];
    $move=$db->update($table,["status" => 0],"id = '$id' ");


    if($move)
	{
		showMsg('移动垃圾桶成功','');
		exit;
	}else{
		showMsg('移动垃圾桶失败','');
		exit;
	}
}


//恢复删除
if($mode=='remove'){
    $id=$_GET['id'];
    $table=$_GET['table'];
    $move=$db->update($table,["status" => 1],"id = '$id' ");
    if($move)
	{
		showMsg('恢复成功','');
		exit;
	}else{
		showMsg('恢复失败','');
		exit;
	}
}


showMsg('异常操作','');
exit;

?>


