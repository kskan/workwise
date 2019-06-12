<?php
include_once('../includes/init.php');
include_once('../includes/class.order.php');
checkAdmin(); //检测是否登录
isAuth(); //是否有权限

//接收页码
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 8;
$size = 5;

$count = $db->select('COUNT(*) AS c')->from('group')->find();

//调用分页
$pageStr = page($page,$count['c'],$limit,$size);


//数据
$start = ($page-1)*$limit;
$grouplist = $db->select()->from('group')->limit("$start,$limit")->all();







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
						<li>Table</li>	 
						<li>Datatable</li>	 
					</ul>

					<h3 class="header-text m-top-lg">
						<button onclick="location.href='<?php echo config('website');?>/admin/groupadd.php'" type="button" class="btn btn-info marginTB-xs <?php echo isAuth(false,'/admin/groupadd.php') ? '':'hidden';?>">添加</button>
					</h3>

					<table id="rulelist" class="table table-striped" id="dataTable">
						<thead>
							<tr>
								<th><input type="checkbox" name="delete" /></th>
								<th>角色名称</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php foreach($grouplist as $item){?>
							<tr>
								<td><input type="checkbox" name="groupid[]" data-id="<?php echo $item['id']?>" value="<?php echo $item['id'];?>"></td>
								<td><?php echo $item['name'];?></td>
								<td><?php echo $item['status'] ? "<span class='label label-success'>启用</span>":"<span class='label label-danger'>禁用</span>";?></td>
								<td>
									<button onclick="location.href='<?php echo config('website');?>/admin/groupedit.php?id=<?php echo $item['id']?>'" type="button" class="btn btn-info btn-xs <?php echo isAuth(false,'/admin/groupedit.php') ? '':'hidden';?>">编辑</button>
									<a onclick="deleteAction(this)" data-action="one" data-id="<?php echo $item['id'];?>" href="javascript:void(0)" class="widget-remove-option btn btn-warning btn-xs <?php echo isAuth(false,'/admin/ruledelete.php') ? '':'hidden';?>">删除</a>
								</td>
							</tr>
							<?php }?>
							<tr>
								<td colspan="20">
									<a onclick="deleteAction(this)" data-action="all" href="javascript:void(0)" class="widget-remove-option btn btn-warning btn-xs <?php echo isAuth(false,'/admin/.php') ? '':'hidden';?>">删除</a>
								</td>
							</tr>
						</tbody>
					</table>
					<?php echo $pageStr;?>
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

		<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>
		

		<!-- Delete Widget Confirmation -->
		<form id="deletePost" method="post" action="<?php echo config('website').'/admin/ruledelete.php'?>">
			<input type="hidden" name="deleteRule" value="" />	
			<div class="custom-popup delete-widget-popup delete-confirmation-popup" id="deleteWidgetConfirm">
				<div class="popup-header text-center">
					<span class="fa-stack fa-4x">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-lock fa-stack-1x fa-inverse"></i>
					</span>
				</div>
				<div class="popup-body text-center">
					<strong class="block m-top-xs"><i class="fa fa-exclamation-circle m-right-xs text-danger"></i>是否确认删除?</strong>
					
					<div class="text-center m-top-lg">
						<button type="button" onclick="$('#deletePost').submit();" class="btn btn-success m-right-sm">删除</button>
						<button type="button" class="btn btn-default deleteWidgetConfirm_close">取消</button>
					</div>
				</div>
			</div>
		</form>
  	</body>
</html>
<?php include_once('script.php');?>
<script>

	//全部选中
	$("input[name='delete']").click(function(){
		$("input[name='groupid[]']").each(function(){
			this.checked = !this.checked;
		});
	});

	//判断是单条删除还是多条删除
	function deleteAction(obj)
	{
		var action = obj.dataset.action;
		var ids = [];
		if(action == "one")
		{
			ids.push(obj.dataset.id);
		}else{
			$("input[name='groupid[]']").each(function(){
				if(this.checked)
				{
					ids.push(this.value)
				}
			});
		}

		var str = ids.join(',');
		$("input[name='deleteRule']").val("");
		$("input[name='deleteRule']").val(str);
	}


</script>

