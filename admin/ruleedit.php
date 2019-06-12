<?php
include_once('../includes/init.php');
include_once('../includes/class.order.php');
checkAdmin(); //检测是否登录
isAuth(); //是否有权限

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$rule = $db->select()->from('rule')->where("id = $id")->find();


if(!$rule)
{
	showMsg('该记录不存在，请重新选择',config('website').'/admin/rulelist.php');
	exit;
}

$rules = $db->select()->from('rule')->orderBy('pid','asc')->all();
$rulelist = order::getSubTree($rules,'pid','id');


if($_POST)
{
	$data = array(
		"url"=>$_POST['url'],
		"title"=>$_POST['title'],
		"ismenu"=>$_POST['ismenu'],
		"pid"=>$_POST['pid'],
	);

	$affectrow = $db->update("rule",$data,"id = $id");

	if($affectrow)
	{
		showMsg('编辑菜单规则成功',config('website').'/admin/rulelist.php');
		exit;
	}else{
		showMsg('编辑菜单规则失败',config('website')."/admin/ruleedit.php?id=$id");
		exit;
	}



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
					<h2 class="header-text">
						规则添加
					</h2>
					<div class="smart-widget m-top-lg widget-dark-blue">
						<div class="smart-widget-header">
							表单
							<span class="smart-widget-option">
								<span class="refresh-icon-animated">
									<i class="fa fa-circle-o-notch fa-spin"></i>
								</span>
	                            <a href="#" class="widget-toggle-hidden-option">
	                                <i class="fa fa-cog"></i>
	                            </a>
	                            <a href="#" class="widget-collapse-option" data-toggle="collapse">
	                                <i class="fa fa-chevron-up"></i>
	                            </a>
	                            <a href="#" class="widget-refresh-option">
	                                <i class="fa fa-refresh"></i>
	                            </a>
	                            <a href="#" class="widget-remove-option">
	                                <i class="fa fa-times"></i>
	                            </a>
	                        </span>
						</div>
						<div class="smart-widget-inner">
							<div class="smart-widget-hidden-section">
								<ul class="widget-color-list clearfix">
									<li style="background-color:#20232b;" data-color="widget-dark"></li>
									<li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
									<li style="background-color:#23b7e5;" data-color="widget-blue"></li>
									<li style="background-color:#2baab1;" data-color="widget-green"></li>
									<li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
									<li style="background-color:#fbc852;" data-color="widget-orange"></li>
									<li style="background-color:#e36159;" data-color="widget-red"></li>
									<li style="background-color:#7266ba;" data-color="widget-purple"></li>
									<li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
									<li style="background-color:#fff;" data-color="reset"></li>
								</ul>
							</div>
							<div class="smart-widget-body">
								<form method="post">
									<div class="form-group">
										<label for="url">规则地址</label>
										<input type="text" value="<?php echo $rule['url'];?>" required name="url" class="form-control" id="url" placeholder="请输入规则地址">
									</div>
									<div class="form-group">
										<label for="title">规则名称</label>
										<input type="text" value="<?php echo $rule['title'];?>" required name="title" class="form-control" id="title" placeholder="请输入规则名称">
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">是否显示在菜单</label>
										<div class="col-lg-10">
											<div class="radio inline-block">
												<div class="custom-radio m-right-xs">
													<input type="radio" <?php echo $rule['ismenu'] ? "checked":"";?> id="show" name="ismenu" value="1">
													<label for="show"></label>
												</div>
												<div class="inline-block vertical-top">显示</div>
											</div>
											<div class="radio inline-block">
												<div class="custom-radio m-right-xs">
													<input type="radio" <?php echo $rule['ismenu'] ? "":"checked";?> id="hidden" name="ismenu" value="0">
													<label for="hidden"></label>
												</div>
												<div class="inline-block vertical-top">隐藏</div>
											</div>
										</div><!-- /.col -->
									</div>
									<div class="form-group">
										<label>上级菜单</label>
										<div>
											<select name="pid" class="form-control">
												<option <?php echo $rule['pid']==0 ? "selected":"";?> value="0">顶级菜单</option>
												<?php foreach($rulelist as $item){?>
													<option <?php echo $rule['pid']==$item['id'] ? "selected":"";?> value="<?php echo $item['id'];?>"><?php echo $item['lev'].$item['title'];?></option>
												<?php }?>
											</select>
										</div><!-- /.col -->
									</div>
									<button type="submit" class="btn btn-success btn-sm">Submit</button>
								</form>
							</div>
						</div><!-- ./smart-widget-inner -->
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

		<!-- Small modal -->
		<div class="modal fade" id="formInModal">
		  	<div class="modal-dialog modal-sm">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        		<h4 class="modal-title" id="myModalLabel">Login</h4>
		      		</div>
		      		<div class="modal-body">
		        		<form role="form">
				  			<div class="form-group">
				    			<label for="inputEmailModal">Email address</label>
				    			<input type="email" class="form-control" id="inputEmailModal" placeholder="Enter email">
				  			</div>
				  			<div class="form-group">
							    <label for="inputPasswordModal">Password</label>
							    <input type="password" class="form-control" id="inputPasswordModal" placeholder="Password">
	  			  			</div>
	  			  			<div class="form-group">
			   	    			<div class="custom-checkbox">
									<input type="checkbox" id="checkboxModal">
							  	  	<label for="checkboxModal"></label>
				    			</div>
				    			Remember Me
				  			</div>
		        		</form>

				        <a class="btn btn-primary block m-top-md"><i class="fa fa-facebook"></i> Login with facebook</a>
				        <a class="btn btn-danger block m-top-md">Login</a>
		      		</div>
		    	</div>
		  	</div>
		</div>

		<!-- Delete Widget Confirmation -->
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

		<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>
		
		<?php include_once('script.php');?>
		<script>
			$(function()	{
				//Delete Widget Confirmation
				$('#deleteWidgetConfirm').popup({
					vertical: 'top',
					pagecontainer: '.container',
					transition: 'all 0.3s'
				});

				// Slider		
				$('#horizontalSlider1').slider();
				$('#horizontalSlider2').slider();
				$('#horizontalSlider3').slider();
				$('#horizontalSlider4').slider();
				
				$('#verticalSlider1').slider();
				$('#verticalSlider2').slider();
				$('#verticalSlider3').slider();
				$('#verticalSlider4').slider();
				$('#verticalSlider5').slider();

				//Select2
				$('.select2').select2();

				//Tag Input
				$('#tagsExample').tagsInput();

				//Date & Time Picker
				$('.datepicker-input').datetimepicker({
					pickTime: false
				});

				//Date & Time Picker
				$('.timepicker-input').datetimepicker({
					pickDate: false
				});

				//Date & Time Picker
				$('.datetimepicker-input').datetimepicker();
			});
			
		</script>
	
  	</body>
</html>
