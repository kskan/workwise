<?php
include_once('../includes/init.php');
checkAdmin(); //检测是否登录
isAuth(); //是否有权限
$links=$db->select()->from("links")->all();
// $admingroup=$db->select("id,name")->from("group")->all();

// var_dump($admingroup);

// exit;




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
					<button onclick="window.location.href='admin_add.php'" class="btn btn-success btn-sm">添加链接</button>

					<table class="table table-striped" id="dataTable">
						<thead>
							<tr>
								<th>NO</th>
								<th>url</th>
								<th>名字</th>
								<th>dec</th>
								<th>头像</th>
								<th>创建时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($links as $item){?>
							<tr>
								<td><?=$item['id']?></td>
								<td><?=$item['url']?></td>
								<td><?=$item['name']?></td>
								<td><?=$item['desc']?></td>
								<td><img  height="30" src="../assets/<?=$item['avatar']?>" alt="" class="img-circle"></td>
								<td><?= date("Y-m-d",$item['createtime'])?></td>
								<td><span class="label label-success">无法操作</span></td>
							</tr><?php } ?>
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
	   
  	</body>
</html>
<?php include_once('script.php');?>
