<?php
include("includes/init.php");
include("includes/postmode.php");
checkUser();

//获取关注人
if(isset( $_COOKIE['userid'])){
	$userid= $_COOKIE['userid'];
	$following =$db->select("count(*) as count")->from("follow")->where("followid = $userid")->find();
	//获取被关注人数
	$followed =$db->select("count(*) as count")->from("follow")->where("followedid = $userid")->find();
}
$find=$db->select("post.*,user.username as username ,user.avatar as avatar")->from("post as post")->leftjoin("user as user","post.userid=user.id")->where("post.userid='$userid'")->orderBy("post.createtime","desc")->all();


?>
<!DOCTYPE html>
<html>

<head>

<?php include("common/meta.php");?>
<?php include("common/imagemode.php")?>
</head>


<body>
	

	<div class="wrapper">
		<?php include("common/header.php")?>

		<section class="cover-sec">
			<img src="assets/home/images/resources/cover-img.jpg" alt="">
			<a href="Javascript:void(0)" title=""><i class="fa fa-camera"></i> Change Image</a>
		</section>
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3">
								<div class="main-left-sidebar">
									<div class="user_profile">
										<div class="user-pro-img">
											
											<?php if(isset($_COOKIE['avatar'])){?>
												<img width="200" height="200" id="headimg"  src="assets/<?=$_COOKIE['avatar']?>" alt="">
													<?php }else{?>
							               	<img width="200" height="200" id="headimg"  src="assets/home/images/resources/noim-user.png" alt="">
						                  	<?php }?>
											<a href="Javascript:void(0)"  id="up-img-touch" title=""><i class="fa fa-camera"></i></a>
										</div><!--user-pro-img end-->
										<div class="user_pro_status">
											<ul class="flw-status">
												<li onclick="location='myfollow.php'" style="cursor: pointer;" >
													<span>关注</span>
													<b><?=$following['count']?></b>
												</li>
												<li  onclick="location='myfollowed.php'" style="cursor: pointer;">
													<span>粉丝</span>
													<b><?=$followed['count']?></b>
												</li>
											</ul>
										</div><!--user_pro_status end-->
										<!-- <ul class="social_links">
											<li><a href="Javascript:void(0)" title=""><i class="la la-globe"></i> www.example.com</a></li>
											<li><a href="Javascript:void(0)" title=""><i class="fa fa-facebook-square"></i> Http://www.facebook.com/john...</a></li>
											<li><a href="Javascript:void(0)" title=""><i class="fa fa-twitter"></i> Http://www.Twitter.com/john...</a></li>
											<li><a href="Javascript:void(0)" title=""><i class="fa fa-google-plus-square"></i> Http://www.googleplus.com/john...</a></li>
											<li><a href="Javascript:void(0)" title=""><i class="fa fa-behance-square"></i> Http://www.behance.com/john...</a></li>
											<li><a href="Javascript:void(0)" title=""><i class="fa fa-pinterest"></i> Http://www.pinterest.com/john...</a></li>
											<li><a href="Javascript:void(0)" title=""><i class="fa fa-instagram"></i> Http://www.instagram.com/john...</a></li>
											<li><a href="Javascript:void(0)" title=""><i class="fa fa-youtube"></i> Http://www.youtube.com/john...</a></li>
										</ul> -->
									</div><!--user_profile end-->
									<div class="suggestions full-width">
										<div class="sd-title">
											<h3>People Viewed Profile</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
											<div class="suggestion-usd">
												<img src="assets/home/images/resources/s1.png" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="assets/home/images/resources/s2.png" alt="">
												<div class="sgt-text">
													<h4><?=$_COOKIE['username']?></h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="assets/home/images/resources/s3.png" alt="">
												<div class="sgt-text">
													<h4>Poonam</h4>
													<span>Wordpress Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="assets/home/images/resources/s4.png" alt="">
												<div class="sgt-text">
													<h4>Bill Gates</h4>
													<span>C & C++ Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="assets/home/images/resources/s5.png" alt="">
												<div class="sgt-text">
													<h4>Jessica William</h4>
													<span>Graphic Designer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="suggestion-usd">
												<img src="assets/home/images/resources/s6.png" alt="">
												<div class="sgt-text">
													<h4><?=$_COOKIE['username']?></h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="view-more">
												<a href="Javascript:void(0)" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div><!--suggestions end-->
								</div><!--main-left-sidebar end-->
							</div>
							<div class="col-lg-6">
								<div class="main-ws-sec">
									<div class="user-tab-sec">
										<h3><?=$_COOKIE['username']?></h3>
										<div class="star-descp">
											<span><?=isset( $_COOKIE['desc'])?$_COOKIE['desc']:"这家伙很懒,什么都没留"?></span>
											<ul>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-half-o"></i></li>
											</ul>
											<a href="Javascript:void(0)" title="">Status</a>
										</div><!--star-descp end-->
										<div class="tab-feed st2">
											<ul>
												<li data-tab="feed-dd" class="active">
													<a href="Javascript:void(0)" title="">
														<img src="assets/home/images/ic1.png" alt="">
														<span>Feed</span>
													</a>
												</li>
												<li data-tab="info-dd">
													<a href="Javascript:void(0)" title="">
														<img src="assets/home/images/ic2.png" alt="">
														<span>Info</span>
													</a>
												</li>
												<li data-tab="saved-jobs">
													<a href="Javascript:void(0)" title="">
														<img src="assets/home/images/ic4.png" alt="">
														<span>Saved Jobs</span>
													</a>
												</li>
												<li data-tab="my-bids">
													<a href="Javascript:void(0)" title="">
														<img src="assets/home/images/ic5.png" alt="">
														<span>My Bids</span>
													</a>
												</li>
												<li data-tab="portfolio-dd">
													<a href="Javascript:void(0)" title="">
														<img src="assets/home/images/ic3.png" alt="">
														<span>Portfolio</span>
													</a>
												</li>
												<li data-tab="payment-dd">
													<a href="Javascript:void(0)" title="">
														<img src="assets/home/images/ic6.png" alt="">
														<span>Payment</span>
													</a>
												</li>
											</ul>
										</div><!-- tab-feed end-->
									</div><!--user-tab-sec end-->
									<div class="product-feed-tab current" id="feed-dd">
										<div class="posts-section">
										<?php 										
										postall($find);
										?>
											<div class="process-comm">
												<a href="Javascript:void(0)" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
											</div><!--process-comm end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="info-dd">
										<div class="user-profile-ov">
											<h3><a href="Javascript:void(0)" title="" class="overview-open">Overview</a> <a href="Javascript:void(0)" title="" class="overview-open"><i class="fa fa-pencil"></i></a></h3>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. Nunc eu augue nec arcu efficitur faucibus. Aliquam accumsan ac magna convallis bibendum. Quisque laoreet augue eget augue fermentum scelerisque. Vivamus dignissim mollis est dictum blandit. Nam porta auctor neque sed congue. Nullam rutrum eget ex at maximus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget vestibulum lorem.</p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov st2">
											<h3><a href="Javascript:void(0)" title="" class="exp-bx-open">Experience </a><a href="Javascript:void(0)" title="" class="exp-bx-open"><i class="fa fa-pencil"></i></a> <a href="Javascript:void(0)" title="" class="exp-bx-open"><i class="fa fa-plus-square"></i></a></h3>
											<h4>Web designer <a href="Javascript:void(0)" title=""><i class="fa fa-pencil"></i></a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. </p>
											<h4>UI / UX Designer <a href="Javascript:void(0)" title=""><i class="fa fa-pencil"></i></a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id.</p>
											<h4>PHP developer <a href="Javascript:void(0)" title=""><i class="fa fa-pencil"></i></a></h4>
											<p class="no-margin">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. </p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov">
											<h3><a href="Javascript:void(0)" title="" class="ed-box-open">Education</a> <a href="Javascript:void(0)" title="" class="ed-box-open"><i class="fa fa-pencil"></i></a> <a href="Javascript:void(0)" title=""><i class="fa fa-plus-square"></i></a></h3>
											<h4>Master of Computer Science</h4>
											<span>2015 - 2017</span>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. </p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov">
											<h3><a href="Javascript:void(0)" title="" class="lct-box-open">Location</a> <a href="Javascript:void(0)" title="" class="lct-box-open"><i class="fa fa-pencil"></i></a> <a href="Javascript:void(0)" title=""><i class="fa fa-plus-square"></i></a></h3>
											<h4>India</h4>
											<p>151/4 BT Chownk, Delhi </p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov">
											<h3><a href="Javascript:void(0)" title="" class="skills-open">Skills</a> <a href="Javascript:void(0)" title="" class="skills-open"><i class="fa fa-pencil"></i></a> <a href="Javascript:void(0)"><i class="fa fa-plus-square"></i></a></h3>
											<ul>
												<li><a href="Javascript:void(0)" title="">HTML</a></li>
												<li><a href="Javascript:void(0)" title="">PHP</a></li>
												<li><a href="Javascript:void(0)" title="">CSS</a></li>
												<li><a href="Javascript:void(0)" title="">Javascript</a></li>
												<li><a href="Javascript:void(0)" title="">Wordpress</a></li>
												<li><a href="Javascript:void(0)" title="">Photoshop</a></li>
												<li><a href="Javascript:void(0)" title="">Illustrator</a></li>
												<li><a href="Javascript:void(0)" title="">Corel Draw</a></li>
											</ul>
										</div><!--user-profile-ov end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="saved-jobs">
										<div class="posts-section">
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pic.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Epic Coder</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="Javascript:void(0)" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pic.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Epic Coder</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="Javascript:void(0)" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pc2.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Epic Coder</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="Javascript:void(0)" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pic.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Epic Coder</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Senior Wordpress Developer</h3>
													<ul class="job-dt">
														<li><a href="Javascript:void(0)" title="">Full Time</a></li>
														<li><span>$30 / hr</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="process-comm">
												<a href="Javascript:void(0)" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
											</div><!--process-comm end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="my-bids">
										<div class="posts-section">
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pic.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="Javascript:void(0)" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Simple Classified Site</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
														<li><a href="Javascript:void(0)" title="">Photoshop</a></li> 	
														<li><a href="Javascript:void(0)" title="">Illustrator</a></li> 	
														<li><a href="Javascript:void(0)" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pic.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="Javascript:void(0)" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Ios Shopping mobile app</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
														<li><a href="Javascript:void(0)" title="">Photoshop</a></li> 	
														<li><a href="Javascript:void(0)" title="">Illustrator</a></li> 	
														<li><a href="Javascript:void(0)" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pic.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="Javascript:void(0)" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Simple Classified Site</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
														<li><a href="Javascript:void(0)" title="">Photoshop</a></li> 	
														<li><a href="Javascript:void(0)" title="">Illustrator</a></li> 	
														<li><a href="Javascript:void(0)" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<img src="assets/home/images/resources/us-pic.png" alt="">
														<div class="usy-name">
															<h3>John Doe</h3>
															<span><img src="assets/home/images/clock.png" alt="">3 min ago</span>
														</div>
													</div>
													<div class="ed-opts">
														<a href="Javascript:void(0)" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="Javascript:void(0)" title="">Edit Post</a></li>
															<li><a href="Javascript:void(0)" title="">Unsaved</a></li>
															<li><a href="Javascript:void(0)" title="">Unbid</a></li>
															<li><a href="Javascript:void(0)" title="">Close</a></li>
															<li><a href="Javascript:void(0)" title="">Hide</a></li>
														</ul>
													</div>
												</div>
												<div class="epi-sec">
													<ul class="descp">
														<li><img src="assets/home/images/icon8.png" alt=""><span>Frontend Developer</span></li>
														<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
													</ul>
													<ul class="bk-links">
														<li><a href="Javascript:void(0)" title=""><i class="la la-bookmark"></i></a></li>
														<li><a href="Javascript:void(0)" title=""><i class="la la-envelope"></i></a></li>
														<li><a href="Javascript:void(0)" title="" class="bid_now">Bid Now</a></li>
													</ul>
												</div>
												<div class="job_descp">
													<h3>Ios Shopping mobile app</h3>
													<ul class="job-dt">
														<li><span>$300 - $350</span></li>
													</ul>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id magna sit amet... <a href="Javascript:void(0)" title="">view more</a></p>
													<ul class="skill-tags">
														<li><a href="Javascript:void(0)" title="">HTML</a></li>
														<li><a href="Javascript:void(0)" title="">PHP</a></li>
														<li><a href="Javascript:void(0)" title="">CSS</a></li>
														<li><a href="Javascript:void(0)" title="">Javascript</a></li>
														<li><a href="Javascript:void(0)" title="">Wordpress</a></li> 	
														<li><a href="Javascript:void(0)" title="">Photoshop</a></li> 	
														<li><a href="Javascript:void(0)" title="">Illustrator</a></li> 	
														<li><a href="Javascript:void(0)" title="">Corel Draw</a></li> 	
													</ul>
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a href="Javascript:void(0)"><i class="la la-heart"></i> Like</a>
															<img src="assets/home/images/liked-img.png" alt="">
															<span>25</span>
														</li> 
														<li><a href="Javascript:void(0)" title="" class="com"><img src="assets/home/images/com.png" alt=""> Comment 15</a></li>
													</ul>
													<a><i class="la la-eye"></i>Views 50</a>
												</div>
											</div><!--post-bar end-->
											<div class="process-comm">
												<a href="Javascript:void(0)" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
											</div><!--process-comm end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="portfolio-dd">
										<div class="portfolio-gallery-sec">
											<h3>Portfolio</h3>
											<div class="gallery_pf">
												<div class="row">
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img1.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img2.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img3.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img4.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img5.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img6.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img7.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img8.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img9.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img10.jpg" alt="">
															<a href="Javascript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
												</div>
											</div><!--gallery_pf end-->
										</div><!--portfolio-gallery-sec end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="payment-dd">
										<div class="billing-method">
											<ul>
												<li>
													<h3>Add Billing Method</h3>
													<a href="Javascript:void(0)" title=""><i class="fa fa-plus-circle"></i></a>
												</li>
												<li>
													<h3>See Activity</h3>
													<a href="Javascript:void(0)" title="">View All</a>
												</li>
												<li>
													<h3>Total Money</h3>
													<span>$0.00</span>
												</li>
											</ul>
											<div class="lt-sec">
												<img src="assets/home/images/lt-icon.png" alt="">
												<h4>All your transactions are saved here</h4>
												<a href="Javascript:void(0)" title="">Click Here</a>
											</div>
										</div><!--billing-method end-->
										<div class="add-billing-method">
											<h3>Add Billing Method</h3>
											<h4><img src="assets/home/images/dlr-icon.png" alt=""><span>With workwise payment protection , only pay for work delivered.</span></h4>
											<div class="payment_methods">
												<h4>Credit or Debit Cards</h4>
												<form>
													<div class="row">
														<div class="col-lg-12">
															<div class="cc-head">
																<h5>Card Number</h5>
																<ul>
																	<li><img src="assets/home/images/cc-icon1.png" alt=""></li>
																	<li><img src="assets/home/images/cc-icon2.png" alt=""></li>
																	<li><img src="assets/home/images/cc-icon3.png" alt=""></li>
																	<li><img src="assets/home/images/cc-icon4.png" alt=""></li>
																</ul>
															</div>
															<div class="inpt-field pd-moree">
																<input type="text" name="cc-number" placeholder="">
																<i class="fa fa-credit-card"></i>
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>First Name</h5>
															</div>
															<div class="inpt-field">
																<input type="text" name="f-name" placeholder="">
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>Last Name</h5>
															</div>
															<div class="inpt-field">
																<input type="text" name="l-name" placeholder="">
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>Expiresons</h5>
															</div>
															<div class="rowwy">
																<div class="row">
																	<div class="col-lg-6 pd-left-none no-pd">
																		<div class="inpt-field">
																			<input type="text" name="f-name" placeholder="">
																		</div><!--inpt-field end-->
																	</div>
																	<div class="col-lg-6 pd-right-none no-pd">
																		<div class="inpt-field">
																			<input type="text" name="f-name" placeholder="">
																		</div><!--inpt-field end-->
																	</div>
																</div>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="cc-head">
																<h5>Cvv (Security Code) <i class="fa fa-question-circle"></i></h5>
															</div>
															<div class="inpt-field">
																<input type="text" name="l-name" placeholder="">
															</div><!--inpt-field end-->
														</div>
														<div class="col-lg-12">
															<button type="submit">Continue</button>
														</div>
													</div>
												</form>
												<h4>Add Paypal Account</h4>
											</div>
										</div><!--add-billing-method end-->
									</div><!--product-feed-tab end-->
								</div><!--main-ws-sec end-->
							</div>
							<div class="col-lg-3">
								<div class="right-sidebar">
									<div class="message-btn">
										<a href="Javascript:void(0)" title=""><i class="fa fa-envelope"></i> Message</a>
									</div>
									<div class="widget widget-portfolio">
										<div class="wd-heady">
											<h3>Portfolio</h3>
											<img src="assets/home/images/photo-icon.png" alt="">
										</div>
										<div class="pf-gallery">
											<ul>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery1.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery2.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery3.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery4.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery5.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery6.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery7.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery8.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery9.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery10.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery11.png" alt=""></a></li>
												<li><a href="Javascript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery12.png" alt=""></a></li>
											</ul>
										</div><!--pf-gallery end-->
									</div><!--widget-portfolio end-->
								</div><!--right-sidebar end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>


		<footer>
			<div class="footy-sec mn no-margin">
				<div class="container">
					<ul>
						<li><a href="Javascript:void(0)" title="">Help Center</a></li>
						<li><a href="Javascript:void(0)" title="">Privacy Policy</a></li>
						<li><a href="Javascript:void(0)" title="">Community Guidelines</a></li>
						<li><a href="Javascript:void(0)" title="">Cookies Policy</a></li>
						<li><a href="Javascript:void(0)" title="">Career</a></li>
						<li><a href="Javascript:void(0)" title="">Forum</a></li>
						<li><a href="Javascript:void(0)" title="">Language</a></li>
						<li><a href="Javascript:void(0)" title="">Copyright Policy</a></li>
					</ul>
					<p><img src="assets/home/images/copy-icon2.png" alt="">Copyright 2017</p>
					<img class="fl-rgt" src="assets/home/images/logo2.png" alt="">
				</div>
			</div>
		</footer><!--footer end-->

		<div class="overview-box" id="overview-box">
			<div class="overview-edit">
				<h3>Overview</h3>
				<span>5000 character left</span>
				<form>
					<textarea></textarea>
					<button type="submit" class="save">Save</button>
					<button type="submit" class="cancel">Cancel</button>
				</form>
				<a href="Javascript:void(0)" title="" class="close-box"><i class="la la-close"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->


		<div class="overview-box" id="experience-box">
			<div class="overview-edit">
				<h3>Experience</h3>
				<form>
					<input type="text" name="subject" placeholder="Subject">
					<textarea></textarea>
					<button type="submit" class="save">Save</button>
					<button type="submit" class="save-add">Save & Add More</button>
					<button type="submit" class="cancel">Cancel</button>
				</form>
				<a href="Javascript:void(0)" title="" class="close-box"><i class="la la-close"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->

		<div class="overview-box" id="education-box">
			<div class="overview-edit">
				<h3>Education</h3>
				<form>
					<input type="text" name="school" placeholder="School / University">
					<div class="datepicky">
						<div class="row">
							<div class="col-lg-6 no-left-pd">
								<div class="datefm">
									<input type="text" name="from" placeholder="From" class="datepicker">	
									<i class="fa fa-calendar"></i>
								</div>
							</div>
							<div class="col-lg-6 no-righ-pd">
								<div class="datefm">
									<input type="text" name="to" placeholder="To" class="datepicker">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
					</div>
					<input type="text" name="degree" placeholder="Degree">
					<textarea placeholder="Description"></textarea>
					<button type="submit" class="save">Save</button>
					<button type="submit" class="save-add">Save & Add More</button>
					<button type="submit" class="cancel">Cancel</button>
				</form>
				<a href="Javascript:void(0)" title="" class="close-box"><i class="la la-close"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->

		<div class="overview-box" id="location-box">
			<div class="overview-edit">
				<h3>Location</h3>
				<form>
					<div class="datefm">
						<select>
							<option>Country</option>
							<option value="pakistan">Pakistan</option>
							<option value="england">England</option>
							<option value="india">India</option>
							<option value="usa">United Sates</option>
						</select>
						<i class="fa fa-globe"></i>
					</div>
					<div class="datefm">
						<select>
							<option>City</option>
							<option value="london">London</option>
							<option value="new-york">New York</option>
							<option value="sydney">Sydney</option>
							<option value="chicago">Chicago</option>
						</select>
						<i class="fa fa-map-marker"></i>
					</div>
					<button type="submit" class="save">Save</button>
					<button type="submit" class="cancel">Cancel</button>
				</form>
				<a href="Javascript:void(0)" title="" class="close-box"><i class="la la-close"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->

		<div class="overview-box" id="skills-box">
			<div class="overview-edit">
				<h3>Skills</h3>
				<ul>
					<li><a href="Javascript:void(0)" title="" class="skl-name">HTML</a><a href="Javascript:void(0)" title="" class="close-skl"><i class="la la-close"></i></a></li>
					<li><a href="Javascript:void(0)" title="" class="skl-name">php</a><a href="Javascript:void(0)" title="" class="close-skl"><i class="la la-close"></i></a></li>
					<li><a href="Javascript:void(0)" title="" class="skl-name">css</a><a href="Javascript:void(0)" title="" class="close-skl"><i class="la la-close"></i></a></li>
				</ul>
				<form>
					<input type="text" name="skills" placeholder="Skills">
					<button type="submit" class="save">Save</button>
					<button type="submit" class="save-add">Save & Add More</button>
					<button type="submit" class="cancel">Cancel</button>
				</form>
				<a href="Javascript:void(0)" title="" class="close-box"><i class="la la-close"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->

		<div class="overview-box" id="create-portfolio">
			<div class="overview-edit">
				<h3>Create Portfolio</h3>
				<form>
					<input type="text" name="pf-name" placeholder="Portfolio Name">
					<div class="file-submit">
						<input type="file" name="file">
					</div>
					<div class="pf-img">
						<img src="assets/home/images/resources/np.png" alt="">
					</div>
					<input type="text" name="website-url" placeholder="htp://www.example.com">
					<button type="submit" class="save">Save</button>
					<button type="submit" class="cancel">Cancel</button>
				</form>
				<a href="Javascript:void(0)" title="" class="close-box"><i class="la la-close"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->

	</div><!--theme-layout end-->



	<div class="am-modal am-modal-no-btn up-frame-bj " tabindex="-1" id="doc-modal-1">
  <div class="am-modal-dialog up-frame-parent up-frame-radius">
	<div class="am-modal-hd up-frame-header">
	   <label>修改头像</label>
	  <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
	</div>
	<div class="am-modal-bd  up-frame-body">
	  <div class="am-g am-fl">
		<div class="am-form-group am-form-file">
		  <div class="am-fl">
			<button type="button" class="am-btn am-btn-default am-btn-sm">
			  <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
		  </div>
		  <input type="file" id="inputImage">
		</div>
	  </div>
	  <div class="am-g am-fl" >
		<div class="up-pre-before up-frame-radius">
			<img alt="" src="" id="image" >
		</div>
		<div class="up-pre-after up-frame-radius">
		</div>
	  </div>
	  <div class="am-g am-fl">
		<div class="up-control-btns">
			<span class="am-icon-rotate-left"  onclick="rotateimgleft()"></span>
			<span class="am-icon-rotate-right" onclick="rotateimgright()"></span>
			<span class="am-icon-check" id="up-btn-ok" url="includes/headimage_api.php" data-userid="<?=$_COOKIE['userid']?>"></span>
		</div>
	  </div>
	  
	</div>
  </div>
</div>

<!--加载框-->
<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
  <div class="am-modal-dialog">
	<div class="am-modal-hd">正在上传...</div>
	<div class="am-modal-bd">
	  <span class="am-icon-spinner am-icon-spin"></span>
	</div>
  </div>
</div>

<!--警告框-->
<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
	<div class="am-modal-hd">信息</div>
	<div class="am-modal-bd"  id="alert_content">
			  成功了
	</div>
	<div class="am-modal-footer">
	  <span class="am-modal-btn">确定</span>
	</div>
  </div>
</div>


<!-- 
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/flatpickr.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script> -->
</body>
</html>
