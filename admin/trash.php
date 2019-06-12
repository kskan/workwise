<?php
include_once('../includes/init.php');
checkAdmin(); //检测是否登录
isAuth(); //是否有权限
$admin=$db->select("id,username,avatar,createtime,groupid,status")->from("admin")->where("status='0'")->all();
$admingroup=$db->select("id,name")->from("group")->all();
$groupid=$_SESSION['groupid'];
$rulue=$db->select("rules")->from('group')->where(" id = '$groupid'")->find();
$rulue=$rulue['rules'];
$rulues=explode( ",",$rulue);								

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
					<table class="table table-striped" id="dataTable">
						<thead>
							<tr>
								<th>NO</th>
								<th>用户名</th>
								<th>头像</th>
								<th>创建时间</th>
								<th>状态</th>
								<th>用户组</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($admin as $item){?>
							<tr>
								<td><?=$item['id']?></td>
								<td><?=$item['username']?></td>
								<td><img  height="30" width="30" src="../assets/<?=$item['avatar']?>" alt="" class="img-circle"></td>
								<td><?= date("Y-m-d",$item['createtime'])?></td>
								<td><span class="label <?=$item['status']==1?"label-success":"label-danger"?>"><?=$item['status']==1?'正常':'锁定中'?></span></td>								
								<?php foreach($admingroup as $item2){?>
								<?php if($item['groupid']==$item2['id']){?> 
								<td><?=$item2['name']?></td>
								<?php }?>
								<?php }?>
								<td>	
									<?php if(array_search("13",$rulues)){?>
									<button type="submit" class="btn btn-info btn-xs" onclick="window.location.href='../includes/del_model.php?table=admin&mode=remove&id=<?=$item['id']?>'">恢复</button>
									<?php }?>
									<?php if(array_search("13",$rulues)){?>
								    <button type="submit" class="btn btn-warning btn-xs" onclick="window.location.href='../includes/del_model.php?table=admin&mode=realdel&id=<?=$item['id']?>'">完全删除</button>	
									<?php }?>
								</td>
							</tr>
							<?php } ?>
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
