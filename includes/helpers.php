<?php
$path = str_replace("\\","/",dirname(__FILE__));



//系统配置
function config($name = '')
{
	global $db;
	if(!empty($name))
	{
		$config = $db->select()->from('config')->where("name = '$name'")->find();
		return $config['values'];
	}else{
		return '';
	}
	
}


// function config($name = '')
// {
// 	global $db;
// 	$config = isset($_SESSION['config']) ? $_SESSION['config'] : "";
// 	if(empty($config))
// 	{
// 		$config = $db->select()->from('config')->all();
// 		if($config)
// 		{
// 			$result = array();
// 			foreach($config as $item)
// 			{
// 				$result[$item['name']] = $item['values'];
// 			}
// 			//把系统配置保存到session里面
// 			$_SESSION['config'] = $result;
// 			return $result;
// 		}else{
// 			return false;
// 		}
// 	}else{
// 		//把数据从json 变成php
// 		return $config;
// 	}
	
// }


// 验证管理员是否登录
function checkAdmin()
{
	global $db;
	//判断是否登录
	$adminid = isset($_SESSION['adminid']) ? $_SESSION['adminid'] : 0;

	$admin = $db->select("*")->from('admin')->where("id = $adminid")->find();

	if(empty($admin))
	{
		//清空session
		session_unset();  //释放所有的会话变量
		@header("Location:login.php");
		exit;
	}else{
		return $admin;
	}

}


//管理员菜单
function adminMenu()
{
	global $db;

	$cacherule = isset($_SESSION['adminmenu']) ? $_SESSION['adminmenu'] : "";


	if(empty($cacherule))
	{
		//判断是否有没有登录
		$admin = checkAdmin();

		$group = $db->select()->from('group')->where("id = ".$admin['groupid'])->find();

		$ruleids = isset($group['rules']) ? $group['rules'] : 0;

		//规则列表
		$rulearr = $db->select()->from('rule')->where("id IN($ruleids)")->orderBy("pid","asc")->all();

		if(empty($rulearr))
		{
			return array();
		}

		$rulelist = array();

		foreach($rulearr as $key=>$item)
		{
			if($item['pid'] == 0)
			{
				$item['pidclass'] = "openable";
				$rulelist[] = $item;
			}

			foreach($rulelist as $k=>$v)
			{
				if($v['id'] == $item['pid'])
				{
					$rulelist[$k]['son'][] = $item;
				}
			}
		}

		//保存到session中
		$_SESSION['adminmenu'] = json_encode($rulelist);

		return json_encode($rulelist);

	}else{
		return $cacherule;
	}

}

//是否有权限
function isAuth($location=true,$auth='')
{
	global $db;
	if(empty($auth))
	{
		$url = $_SERVER["REQUEST_URI"];
		$pos = stripos($url,"?");
		if($pos != false)
		{
			$url = substr($url,0,$pos);
		}
	}else{
		$url = $auth;
	}
	

	$rule = $db->select('id')->from('rule')->where("url = '$url'")->find();

	$group_rules = $db->select("rules")->from('group')->where("id = ".$_SESSION['groupid'])->find();

	//把字符串变成数组
	$group_arr = explode(",",$group_rules['rules']);

	//判断规则id是否在角色里面
	$result = in_array($rule['id'],$group_arr);

	if(!$result)
	{
		//没有权限
		//location 为 false 说明 不跳转
		if($location)
		{
			//跳转
			session_unset();
			setcookie("auto",null,time()-111);
			showMsg('非法访问','login.php');
			exit;
		}else{
			//不跳转
			return false;
		}

	}else{
		return true;  //有权限
	}

}



//随机数
function random_str($length = 4)
{
	$str = "1234567890abcdefghijk";
	$new = str_shuffle($str);
	return substr($new,0,$length);
}


function uploads($input,$path="uploads",$size=123123123)
{
	$error = $_FILES[$input]['error'];

	$res = array("result"=>false,"msg"=>null);

	if($error > 0)
	{
		switch($error)
		{
			case 1:
				$res['result'] = false;
				$res['msg'] = "超过php.ini配置大小";
				break;
			case 2:
				$res['result'] = false;
				$res['msg'] = '超出隐藏域大小';
				break;
			case 3:
				$res['result'] = false;
				$res['msg'] = '网络中断';
				break;
			case 4:
				$res['result'] = false;
				$res['msg'] = '没有文件上传';
		}

		return $res;
	}


	$input_size = $_FILES[$input]['size'];

	//判断是否有超出文件大小
	if($input_size > $size)
	{
		$res['result'] = false;
		$res['msg'] = '文件大小超出函数限制';
		return $res;
	}


	//生成新的文件名称
	$ext = PATHINFO($_FILES[$input]['name'],PATHINFO_EXTENSION);

	$name = date("YmdHis").random_str(8).".$ext";

	//判断文件是否是从正确的表单提交过来
	if(is_uploaded_file($_FILES[$input]['tmp_name']))
	{
		//把文件移动
		if(move_uploaded_file($_FILES[$input]['tmp_name'],$path.$name))
		{
			$res['result'] = true;
			$res['msg'] = $path.$name;
		}else{
			$res['result'] = false;
			$res['msg'] = '文件失败成功';
		}
		return $res;
	}
}


function showMsg($msg='',$url = '')
{
    if(empty($url))
    {
        echo "<script>alert('$msg');history.go(-1);</script>";
        exit;
    }else{
        echo "<script>alert('$msg');location.href='$url';</script>";
        exit;
    }
}




//得到当前网址
function get_url(){
	//http://localhost/h1901/company/person_list.php?keyword=2345&
	$str = $_SERVER['PHP_SELF'].'?';
	if($_GET){
		foreach ($_GET as $k=>$v){  //$_GET['page']
			if($k!='page'){
				$str .= $k.'='.$v.'&';
			}
		}
	}
	return $str;
}

/*
	
	[1]  2   3   4     5
	 1  [2]  3   4     5   要求显示五页，但是没有这么多数据，就只能按照总页数来排
	


	 1   2  [3]  4     5	 
     2   3  [4]  5     6
     3   4  [5]  6     7
     4   5  [6]  7	   8
     5   6  [7]	 8     9
	   
     6   7	[8]  9     10
	 

     6   7	 8  [9]    10
     6   7	 8   9     [10]
	
	$pages   5

	$pages-5+1;
*/


//分页函数
/**
 *@pargam $current	当前页
 *@pargam $count	记录总数
 *@pargam $limit	每页显示多少条
 *@pargam $size		中间显示多少条
 *@pargam $class	样式
*/
function page($current,$count,$limit,$size,$class='sabrosus'){
	$str='';
	if($count>$limit){
		$pages = ceil($count/$limit);//算出总页数
		$url = get_url();//获取当前页面的URL地址（包含参数）
		
		$str.='<div class="'.$class.'">';
		//开始
		if($current==1){
			$str.='<span class="disabled">首&nbsp;&nbsp;页</span>';
			$str.='<span class="disabled">  &lt;上一页 </span>';
		}else{
			$str.='<a href="'.$url.'page=1">首&nbsp;&nbsp;页 </a>';
			$str.='<a href="'.$url.'page='.($current-1).'">  &lt;上一页 </a>';
		}
		//中间
		//判断得出star与end
	    
		 if($current<=floor($size/2)){ //情况1
			$star=1;
			$end=$pages >$size ? $size : $pages; //看看他两谁小，取谁的
		 }else if($current>=$pages - floor($size/2)){ // 情况2
				 
			$star=$pages-$size+1<=0?1:$pages-$size+1; //避免出现负数
		
			$end=$pages;
		 }else{ //情况3
		 
			$d=floor($size/2);
			$star=$current-$d;
			$end=$current+$d;
		 }
	
		for($i=$star;$i<=$end;$i++){
			if($i==$current){
				$str.='<span class="current">'.$i.'</span>';	
			}else{
				$str.='<a href="'.$url.'page='.$i.'">'.$i.'</a>';
			}
		}
		//最后
		if($pages==$current){
			$str .='<span class="disabled">  下一页&gt; </span>';
			$str.='<span class="disabled">尾&nbsp;&nbsp;页  </span>';
		}else{
			$str.='<a href="'.$url.'page='.($current+1).'">下一页&gt; </a>';
			$str.='<a href="'.$url.'page='.$pages.'">尾&nbsp;&nbsp;页 </a>';
		}
		$str.='</div>';
	}
	
	return $str;
}




?>