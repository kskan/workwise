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
					<ul class="breadcrumb">
						<li><span class="primary-font"><i class="icon-home"></i></span><a href="index.html"> Home</a></li>
						<li>Table</li>	 
						<li>Datatable</li>	 
					</ul>

					<h3 class="header-text m-top-lg">
						<button onclick="location.href='<?php echo config('website');?>/admin/ruleadd.php'" type="button" class="btn btn-info marginTB-xs <?php echo isAuth(false,'/admin/ruleadd.php') ? '':'hidden';?>">添加</button>
					</h3>

					<table id="rulelist" class="table table-striped" id="dataTable">
						<thead>
							<tr>
								<th><input type="checkbox" name="delete" /></th>
								<th>规则名称</th>
								<th>规则地址</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php foreach($rulelist as $item){?>
							<tr data-tt-id="<?php echo $item['id']?>" data-tt-parent-id="<?php echo $item['pid']?>">
								<td><input type="checkbox" name="ruleid[]" data-id="<?php echo $item['id']?>" data-pid="<?php echo $item['pid'];?>" value="<?php echo $item['id'];?>"></td>
								<td><?php echo $item['title'];?></td>
								<td><?php echo $item['url'];?></td>
								<td><?php echo $item['ismenu'] ? "<span class='label label-success'>显示</span>":"<span class='label label-danger'>隐藏</span>";?></td>
								<td>
								<button onclick="location.href='<?php echo config('website');?>/admin/ruleedit.php?id=<?php echo $item['id']?>'" type="button" class="btn btn-info btn-xs <?php echo isAuth(false,'/admin/ruleedit.php') ? '':'hidden';?>">编辑</button>
								<a onclick="deleteAction(this)" data-action="one" data-id="<?php echo $item['id'];?>" href="javascript:void(0)" class="widget-remove-option btn btn-warning btn-xs <?php echo isAuth(false,'/admin/ruledelete.php') ? '':'hidden';?>">删除</a>
								</td>
							</tr>
							<?php }?>
							<tr>
								<td colspan="20">
									<a onclick="deleteAction(this)" data-action="all" href="javascript:void(0)" class="widget-remove-option btn btn-warning btn-xs <?php echo isAuth(false,'/admin/ruledelete.php') ? '':'hidden';?>">删除</a>
								</td>
							</tr>
						</tbody>
					</table>
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
		<form id="deletePost" method="post"  action="<?php echo config('website').'/admin/ruledelete.php'?>">
			<input type="hidden" name="deleteRule" value="" />	
			<div style="    display: none;">
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
			</div>
		</form>
  	</body>
</html>
<script>
	$('#rulelist').treetable({ expandable: true});


	//全部选中
	$("input[name='delete']").click(function(){
		$("input[name='ruleid[]']").each(function(){
			this.checked = !this.checked;
		});
		// $("input[name='ruleid[]']").attr("checked",true);
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

	//判断是单条删除还是多条删除
	function deleteAction(obj)
	{
		var action = obj.dataset.action;
		var ids = [];
		if(action == "one")
		{
			ids.push(obj.dataset.id);
		}else{
			$("input[name='ruleid[]']").each(function(){
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
<?php include_once('script.php');?>
