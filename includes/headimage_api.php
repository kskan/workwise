<?php
include ("init.php");
if(isset($_POST['image'])&&isset($_POST['userid']))
  {
    $result=array();
    $imagepath=base64_image_content($_POST['image'],"../assets/uploads/");
    if($imagepath){
     $url =@trim($imagepath,"../assets");
     $id=$_POST['userid'];
     $data=array(
       "avatar"=>$url,  
     );
     $avatar=$db->select("avatar")->from("user")->where("id = '$id'")->find();
     
     $update=$db->update("user",$data,"id='$id'");
     if($update){
         //删除原有的数据,更换添加的数据
         if($avatar['avatar']!="/home/images/resources/noim-user.png"){
         $imgpath = $_SERVER['DOCUMENT_ROOT'].'/assets/'.$avatar['avatar'];
         @unlink($imgpath);
         }
         $result["result"]="ok";
         $result["avatar"]=$url;

     }
    //  setcookie("avatar",$url,time()+3600*24);
    }
     echo json_encode($result);
     
  }
  function base64_image_content($base64_image_content,$path){
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $new_file = $path;
        if(!file_exists($new_file)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700);
        }
        $new_file = $new_file.date("YmdHis").random_str(8).".{$type}";
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            return '/'.$new_file;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
//随机数
// function random_str($length = 4)
// {
// 	$str = "1234567890abcdefghijk";
// 	$new = str_shuffle($str);
// 	return substr($new,0,$length);
// }