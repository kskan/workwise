<?php
include_once('../includes/init.php');
include_once('../includes/class.order.php');
checkAdmin(); //检测是否登录
isAuth(); //是否有权限


$rulearr = $db->select()->from("rule")->orderBy("id","asc")->all();

$ruleChild = order::getTree($rulearr);

$rulelist = array();

foreach($ruleChild as $key=>$item)
{
	$current = array();

	$current['id'] = $item['id'];
	$current['url'] = $item['url'];
	$current['title'] = $item['title'];
	$current['pid'] = $item['pid'];
	$current['ismenu'] = $item['ismenu'];

	$rulelist[] = $current;

	if(isset($item['children']))
	{
		$child = order::orderTree($item['children']);
		$rulelist = array_merge($rulelist,$child);
	}
}


if($_POST)
{
	$ruleid = empty($_POST['ruleid']) ? 0 : implode(",",$_POST['ruleid']);
	$data = array(
		"name"=>$_POST['name'],
		"status"=>$_POST['status'],
		"rules"=>$ruleid
	);

	$insertid = $db->insert("group",$data);

	if($insertid)
	{
		showMsg('添加角色成功',config('website').'/admin/grouplist.php');
		exit;
	}else{
		showMsg('添加角色失败',config('website').'/admin/groupadd.php');
		exit;
	}

}



?>
<!DOCTYPE html>
<html lang="en">
  	<head>
		<?php include_once('meta.php');?>
		
		<link href="../assets/plugin/treetable/css/jquery.treetable.css" rel="stylesheet">

		<link href="../assets/plugin/treetable/css/jquery.treetable.theme.default.css" rel="stylesheet">

		<link href="../assets/plugin/treetable/css/screen.css" rel="stylesheet">

		<script src="../assets/admin/js/jquery-1.11.1.min.js"></script>

		<script src='../assets/plugin/treetable/jquery.treetable.js'></script>

  	</head>

  	<body class="overflow-hidden">
		<div class="wrapper preload">
			<?php include_once('header.php');?>

			<?php include_once('menu.php');?>
			
			<div class="main-container">
				<div class="padding-md">
					<h2 class="header-text">
						角色添加
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
										<label for="name">角色名称</label>
										<input type="text" required name="name" class="form-control" id="name" placeholder="请输入角色名称">
									</div>
									<div class="form-group">
										<label>状态</label>
										<div>
											<div class="radio inline-block">
												<div class="custom-radio m-right-xs">
													<input type="radio" checked id="show" name="status" value="1">
													<label for="show"></label>
												</div>
												<div class="inline-block vertical-top">启用</div>
											</div>
											<div class="radio inline-block">
												<div class="custom-radio m-right-xs">
													<input type="radio" id="hidden" name="status" value="0">
													<label for="hidden"></label>
												</div>
												<div class="inline-block vertical-top">禁用</div>
											</div>
										</div><!-- /.col -->
									</div>
									<div class="form-group">
										<label>上级菜单</label>
										<table id="rulelist" class="table table-striped" id="dataTable">
											<thead>
												<tr>
													<th><input type="checkbox" name="delete" /></th>
													<th>规则名称</th>
													<th>规则地址</th>
													<th>状态</th>
												</tr>
											</thead>
											<tbody id="tbody">
												<?php foreach($rulelist as $item){?>
												<tr data-tt-id="<?php echo $item['id']?>" data-tt-parent-id="<?php echo $item['pid']?>">
													<td><input type="checkbox" name="ruleid[]" data-id="<?php echo $item['id']?>" data-pid="<?php echo $item['pid'];?>" value="<?php echo $item['id'];?>"></td>
													<td><?php echo $item['title'];?></td>
													<td><?php echo $item['url'];?></td>
													<td><?php echo $item['ismenu'] ? "<span class='label label-success'>显示</span>":"<span class='label label-danger'>隐藏</span>";?></td>
												</tr>
												<?php }?>
											</tbody>
										</table>
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
	
  	</body>
</html>
<script>
	$('#rulelist').treetable({ expandable: true});

	//全部选中
	$("input[name='delete']").click(function(){
		$("input[name='ruleid[]']").each(function(){
			this.checked = !this.checked;
		});
	});


	//树级复选框
	$("input[name='ruleid[]']").click(function(){
		treeCheck($(this).data("id"))
	});

	function treeCheck(pid)
	{
		$("input[name='ruleid[]']").each(function(){
			if(this.dataset.pid == pid)
			{
				this.checked = !this.checked;
				treeCheck(this.dataset.id);
			}
		});
	}


</script>
<?php include_once('script.php');?>