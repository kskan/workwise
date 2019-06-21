<?php
include_once('../includes/init.php');

$configGroup = $db->select()->from("config_groupname")->groupBy('`id`')->all();
$config = $db->select()->from("config")->orderBy("`groups`","asc")->all();




if($_POST)
{
	$update = 0;
	foreach($_POST as $key=>$item)
	{
		//检查类型
		$data=array();
		$type=$db->select('type')->from("config")->where("name='$key'")->find();
		if($type['type']=="text"||$type['type']=="textarea"){
		$data = array("values"=>$item);
		}
		else if($type['type']=="radio"||$type['type']=="select"){
			$radio=$db->select('`values`')->from("config")->where("name='$key'")->find();;
			$list=json_decode($radio['values'],true);
			$list['now']=$item;
			$data=array("values"=>json_encode($list,JSON_UNESCAPED_UNICODE));
		}
		else if($type['type']=="checkbox"){
			$radio=$db->select('`values`')->from("config")->where("name='$key'")->find();;
			$list=json_decode($radio['values'],true);
			$list['now']=implode("," ,$item);	
			$data=array("values"=>json_encode($list,JSON_UNESCAPED_UNICODE));
		}
		else{
			continue;
		}
		$affectrows = $db->update("config",$data,"name = '$key'");
		
		if($affectrows)
		{
			$update++;
		}
	}

	showMsg("修改了{$update}条系统配置","conflist.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  	<head>
	  <?php include_once('meta.php');?>
  	</head>

  	<body class="overflow-hidden">
		<div class="wrapper preload">
			<?php include_once('header.php');?>

			<?php include_once('menu.php');?>
			
			<div class="main-container">
				<div class="padding-md">
					<ul class="breadcrumb">
						<li><span class="primary-font"><i class="icon-home"></i></span><a href="index.html"> Home</a></li>
						<li>UI Elements</li>	 
						<li>Tab</li>	 
					</ul>

					<h3 class="header-text m-bottom-md m-top-lg">
						系统设置
					</h3>

					<div class="smart-widget">
						<div class="smart-widget-inner">
							<ul class="nav nav-tabs tab-style1">
								<?php foreach($configGroup as $item){?>
									<?php if($item['id'] == 1){?>
										<li class="active">
											<a href="#system" data-toggle="tab">
												<span class="icon-wrapper"><i class="fa fa-bar-chart-o"></i></span>
											  <?=$item['title']?>
											</a>
										</li>
								 <?php }else{?>
										<li>
											<a href="#<?=$item['title']?>" data-toggle="tab">
												<span class="icon-wrapper"><i class="fa fa-bar-chart-o"></i></span>
												<?=$item['title']?>
											</a>
										</li>
									<?php }?> 
								  
								<?php  }?>
								<li>
											<a href="addconflist.php"  >
												<span class="icon-wrapper"><i class="fas fa-plus"></i></span>
											     添加
											</a>
										</li>
							</ul>
							<form method="post" class="form-horizontal">
								<div class="smart-widget-body">
									<div class="tab-content">
										<?php foreach($configGroup as $item){?>
											<?php if($item['id'] == 1){?>
												<div class="tab-pane fade in active" id="system">
													<?php foreach($config as $item){?>
														<?php if($item['groups'] == 1){?>
															<div class="form-group">
																<label for="<?php echo $item['name'];?>" class="col-lg-2 control-label"><?php echo $item['title']?></label>
																<div class="col-lg-10">
																<?php intype($item) ?>
																</div><!-- /.col -->
															</div><!-- /form-group -->
														<?php }?>
													<?php }?>
												</div><!-- ./tab-pane -->
											<?php }else{ ?>
												<div class="tab-pane fade" id="<?=$item['title']?>">
													<?php foreach($config as $item2){?>
														<?php if($item2['groups'] == $item['id']){?>
															<div class="form-group">
																<label for="<?php echo $item2['name'];?>" class="col-lg-2 control-label"><?php echo $item2['title']?></label>
																<div class="col-lg-10">
															<?php	intype($item2) ?>
																</div>
															</div>
														<?php }?>
													<?php }?>
												</div><!-- ./tab-pane -->
											<?php }?>
										<?php }?>
										
										<div class="form-group">
											<div class="col-lg-offset-2 col-lg-10">
												<button type="submit" class="btn btn-success btn-sm">提交</button>
											</div><!-- /.col -->
										</div><!-- /form-group -->
									</div><!-- ./tab-content -->
								</div>
							</form>
						</div>
					</div><!-- ./smart-widget -->

				</div><!-- ./padding-md -->
			</div><!-- /main-container -->
			<footer class="footer">
				<span class="footer-brand">
					<strong class="text-danger">Simplify</strong> Admin
				</span>
				<p class="no-margin">
					&copy; 2014 <strong>Simplify Admin</strong>. ALL Rights Reserved. 
				</p>	
			</footer>
		</div><!-- /wrapper -->
		<!-- Delete Widget Confirmation -->
		<div style="display:none;">
		<div class="custom-popup delete-widget-popup delete-confirmation-popup" id="deleteWidgetConfirm">
			<div class="popup-header text-center">
				<span class="fa-stack fa-4x">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
				</span>
			</div>
			<div class="popup-body text-center">
				<h5>Are you sure to delete this widget?</h5>
				<strong class="block m-top-xs"><i class="fa fa-exclamation-circle m-right-xs text-danger"></i>This action cannot be undone</strong>
			
				<div class="text-center m-top-lg">
					<a class="btn btn-success m-right-sm remove-widget-btn">Delete</a>
					<a class="btn btn-default deleteWidgetConfirm_close">Cancel</a>
				</div>
			</div>
		</div>
		</div>

		<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>
		
	    
  	</body>
</html>
<?php include_once('script.php');?>




<?php 

//类型函数打包

function  intype($item){
if($item['type']=="select"){
$list = json_decode($item['values'],true);
?>
<select class='form-control' name="<?=$item['name']?>">
<?php foreach($list as $k=>$v){
if($k!="now"){?>
<option value="<?=$v?>" <?=$v==$list['now']?"selected":""?> ><?=$k?></option>
<?php	}
}?>
</select>
<?php }

if($item['type']=="text"){?>
<input type="text" name="<?php echo $item['name'];?>" value='<?php echo $item['values'];?>' class="form-control" id="<?php echo $item['name'];?>" placeholder="请输入<?=$item['name']?>">
<?php }

if($item['type']=="checkbox"){
	$list = json_decode($item['values'],true);
	$nowlist=explode(",",  $list['now']);
	foreach($list as $k=>$v){
		if($k!="now"){
?>

<div class="checkbox-wrapper col-xs-12 col-sm-12 col-md-2 col-lg-2 ">
		<div class="custom-checkbox">
	<input type="checkbox" id="<?=$k?>"  name="<?=$item['name']?>[]" value="<?=$v?>" <?=in_array($v,$nowlist)?"checked":""?> >
			<label for="<?=$k?>"></label>
					</div>
					<?=$k?>
		</div>
<?php
}
}
}

if($item['type']=="textarea"){
	?>
<textarea class="form-control" placeholder="Your message here..." name="<?php echo $item['name'];?>" rows="3" data-parsley-required="true">
<?php echo $item['values'];?>
</textarea>
	<?php

}

if($item['type']=="radio"){
$list = json_decode($item['values'],true);
foreach($list as $k=>$v){
if($k!="now"){?>
<div class="radio inline-block">
				<div class="custom-radio m-right-xs">
			<input type="radio" id="<?=$k?>"  name="<?=$item['name']?>" value="<?=$v?>" <?=$v==$list['now']?"checked":""?>>
				<label for="<?=$k?>"></label>
					</div>
					<div class="inline-block vertical-top"><?=$k?></div>
			</div>
<?php	
}
} 
}
}

?>