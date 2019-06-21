<?php
include("includes/init.php");

$links=$db->select()->from("links")->orderBy("createtime","desc")->all();





?>
<!DOCTYPE html>
<html>
<head>
<?php include('common/meta.php')?>

</head>


<body>
	

	<div class="wrapper">
	<?php include('common/header.php')?>
		<section class="companies-info">
			<div class="container">
				<div class="company-title">
					<h3>友情链接</h3>
				</div><!--company-title end-->
				<div class="companies-list">
					<div class="row">
						<?php foreach( $links as $item){?>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="company_profile_info">
								<div class="company-up-info">
									<img src="assets/home/images/resources/cmp-icon1.png" alt="">
									<h3><?=$item['name']?></h3>
									<h4><?=$item['desc']?></h4>
									<ul>
										<li><a href="<?=$item['url']?>" title="" class="follow">前往</a></li>
										<li><a href="companies.html#" title="" class="message-us"><i class="fa fa-envelope"></i></a></li>
									</ul>
								</div>
								<a href="companies.html#" title="" class="view-more-pro">View Profile</a>
							</div><!--company_profile_info end-->
						</div>
						<?php }?>
					</div>
				</div><!--companies-list end-->
				<div class="process-comm">
					<a href="companies.html#" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
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
