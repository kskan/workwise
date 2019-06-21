<?php
include("includes/init.php");
checkUser();

$userid=$_GET['userid'];
//查看关注列表
$followlist=$db->select("user.* ,follow.followedid as followedid,follow.createtime as fcreatetime")->from("user as user")->leftjoin("follow as follow","user.id = follow.followid")->where("follow.followedid = '$userid'")->orderBy("follow.createtime","desc")->all();


?>
<!DOCTYPE html>
<html>
<head>
<?php
//所有关注
include("common/meta.php");


?>
</head>
<body>
	

	<div class="wrapper">
		<?php  
		include("common/header.php");
		?>
		<section class="companies-info">
			<div class="container">
				<div class="company-title">
					<h3>所有粉丝</h3>
				</div><!--company-title end-->
				<div class="companies-list">
					<div class="row">
					<?php foreach($followlist as $item){?>
						<div class="col-lg-3 col-md-4 col-sm-6 col-12">
							<div class="company_profile_info">
								<div class="company-up-info">
									<img src="assets/<?=$item['avatar']?>" alt="">
									<h3><?=$item['username']?></h3>
									<h4><?=$item['desc']?></h4>
									<ul>
										<li><a href="profiles.html#" title="" class="follow">关注中</a></li>
										<li><a href="profiles.html#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>
										<!-- <li><a href="profiles.html#" title="" class="hire-us">Hire</a></li> -->
									</ul>
								</div>
								<a href="user-profile.php?id=<?=$item['id']?>" title="" class="view-more-pro">进入个人页面</a>
							</div><!--company_profile_info end-->
						</div>
					<?php } ?>
					
					</div>
				</div><!--companies-list end-->
				<div class="process-comm">
					<a href="profiles.html#" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
				</div>
			</div>
		</section><!--companies-info end-->


	</div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/flatpickr.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
