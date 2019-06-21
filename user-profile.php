<?php 
   include("includes/init.php");
   include("includes/postmode.php");
   //获取所有用户信息;

   $userid=isset($_GET['id'])?$_GET['id']:null;
   
   $follow=isset($_GET['follow'])?$_GET['follow']:null;
   $meid=$_COOKIE['userid'];
   if($userid==$_COOKIE['userid']){
	header("Location: ".$GETWEBURL."/my-profile-feed.php"); 
   }
   if(!$userid){
	   showMsg("接收信息错误,请重试","");
	   exit;
   }
   //获取动态
   $find=$db->select("post.*,user.username as username ,user.avatar as avatar")->from("post as post")->leftjoin("user as user","post.userid=user.id")->where("post.userid='$userid'")->orderBy("post.createtime","desc")->all();
   $alltag=$db->select()->from("tags")->all();
   if($follow){
	   if($follow=="true"){
		   //关注
		   $data=array(
			"followid"=>$meid,
			"followedid"=>$userid,
			"createtime"=>time()
		   );
		   $infollow=$db->insert("follow",$data);
		   if($infollow){
			   showMsg("添加成功","user-profile.php?id=$userid");
			   exit;
		   }else{
			   showMsg("添加失败","user-profile.php?id=$userid");
			   exit;
		   }
	   }else if($follow=="false"){
		   $outfollow=$db->delete("follow","followid = $meid and followedid = $userid");
		   if($outfollow){
			showMsg("取消关注成功","user-profile.php?id=$userid");
			exit;
		}else{
			showMsg("取消关注失败","user-profile.php?id=$userid");
			exit;
		}
		   
		

	   }
   }
   
   //查找用户信息
   $finduser=$db->select("`id`,`username` , `avatar` ,`desc`,`gallery`")->from("user")->where("id= $userid")->find();
//    var_dump($finduser);
$following =$db->select("count(*) as count")->from("follow")->where("followid = $userid")->find();
//获取被关注人数
$followed =$db->select("count(*) as count")->from("follow")->where("followedid = $userid")->find();

//是否关注了他?

$isfollowed=$db->select("*")->from("follow")->where("followid = '$meid' and followedid='$userid'")->find();


   
   
   
?>
<!DOCTYPE html>
<html>
<head>
<?php 
include("common/meta.php")
?>
</head>


<body>
	

	<div class="wrapper">
		


	<?php include("common/header.php")?>

		<section class="cover-sec">
			<img src="assets/home/images/resources/cover-img.jpg" alt="">
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
										<?php if(isset($finduser['avatar'])){?>
												<img width="200" height="200" src="assets/<?=$finduser['avatar']?>" alt="">
													<?php }else{?>
								<img width="200" height="200"  src="assets/home/images/resources/noim-user.png" alt="">
							<?php }?>
										</div><!--user-pro-img end-->
										<div class="user_pro_status">
											<ul class="flw-hr">
												<?php if(!$isfollowed){?>
												<li><a href="<?=get_url()?>follow=true" title="" class="flww"><i class="la la-plus"></i> 关注</a></li>
												<?php }else{?>
													<li><a href="<?=get_url()?>follow=false" title="" class="flww"><i class="la la-plus"></i> 关注中</a></li>
												<?php  }?>
												<li><a href="JavaScript:void(0)" title="" class="hre">Hire</a></li>
											</ul>
											<ul class="flw-status">
												<li onclick="location='userfollow.php?userid=<?=$finduser['id']?>'" style="cursor: pointer;">
													<span>关注</span>
													<b><?=$following['count']?></b>
												</li>

												<li onclick="location='userfollowed.php?userid=<?=$finduser['id']?>'" style="cursor: pointer;">
												
													<span>粉丝</span>
													<b><?=$followed['count']?></b>
												</li>
											</ul>
										</div><!--user_pro_status end-->
										<ul class="social_links">
											<li><a href="JavaScript:void(0)" title=""><i class="la la-globe"></i> www.example.com</a></li>
											<li><a href="JavaScript:void(0)" title=""><i class="fa fa-facebook-square"></i> Http://www.facebook.com/john...</a></li>
											<li><a href="JavaScript:void(0)" title=""><i class="fa fa-twitter"></i> Http://www.Twitter.com/john...</a></li>
											<li><a href="JavaScript:void(0)" title=""><i class="fa fa-google-plus-square"></i> Http://www.googleplus.com/john...</a></li>
											<li><a href="JavaScript:void(0)" title=""><i class="fa fa-behance-square"></i> Http://www.behance.com/john...</a></li>
											<li><a href="JavaScript:void(0)" title=""><i class="fa fa-pinterest"></i> Http://www.pinterest.com/john...</a></li>
											<li><a href="JavaScript:void(0)" title=""><i class="fa fa-instagram"></i> Http://www.instagram.com/john...</a></li>
											<li><a href="JavaScript:void(0)" title=""><i class="fa fa-youtube"></i> Http://www.youtube.com/john...</a></li>
										</ul>
									</div><!--user_profile end-->
									<div class="suggestions full-width">
										<div class="sd-title">
											<h3>Suggestions</h3>
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
													<h4>John Doe</h4>
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
													<h4>John Doe</h4>
													<span>PHP Developer</span>
												</div>
												<span><i class="la la-plus"></i></span>
											</div>
											<div class="view-more">
												<a href="JavaScript:void(0)" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div><!--suggestions end-->
								</div><!--main-left-sidebar end-->
							</div>
							<div class="col-lg-6">
								<div class="main-ws-sec">
									<div class="user-tab-sec">
										<h3><?=$finduser['username']?></h3>
										<div class="star-descp">
											<span><?=$finduser['desc']?></span>
											<!-- <ul>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-half-o"></i></li>
											</ul> -->
										</div><!--star-descp end-->
										<div class="tab-feed">
											<ul>
												<li data-tab="feed-dd" class="active">
													<a href="JavaScript:void(0)" title="">
														<img src="assets/home/images/ic1.png" alt="">
														<span>Feed</span>
													</a>
												</li>
												<li data-tab="info-dd">
													<a href="JavaScript:void(0)" title="">
														<img src="assets/home/images/ic2.png" alt="">
														<span>Info</span>
													</a>
												</li>
												<li data-tab="portfolio-dd">
													<a href="JavaScript:void(0)" title="">
														<img src="assets/home/images/ic3.png" alt="">
														<span>Portfolio</span>
													</a>
												</li>
											</ul>
										</div><!-- tab-feed end-->
									</div><!--user-tab-sec end-->
									<div class="product-feed-tab current" id="feed-dd">
										<div class="posts-section">
										<?php postall($find);?>
											<div class="process-comm">
												<a href="JavaScript:void(0)" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
											</div><!--process-comm end-->
										</div><!--posts-section end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="info-dd">
										<div class="user-profile-ov">
											<h3>Overview</h3>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. Nunc eu augue nec arcu efficitur faucibus. Aliquam accumsan ac magna convallis bibendum. Quisque laoreet augue eget augue fermentum scelerisque. Vivamus dignissim mollis est dictum blandit. Nam porta auctor neque sed congue. Nullam rutrum eget ex at maximus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget vestibulum lorem.</p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov st2">
											<h3>Experience</h3>
											<h4>Web designer</h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. </p>
											<h4>UI / UX Designer</h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id.</p>
											<h4>PHP developer</h4>
											<p class="no-margin">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. </p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov">
											<h3>Education</h3>
											<h4>Master of Computer Science</h4>
											<span>2015 - 2017</span>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo viverra. </p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov">
											<h3>Location</h3>
											<h4>India</h4>
											<p>151/4 BT Chownk, Delhi </p>
										</div><!--user-profile-ov end-->
										<div class="user-profile-ov">
											<h3>Skills</h3>
											<ul>
												<li><a href="JavaScript:void(0)" title="">HTML</a></li>
												<li><a href="JavaScript:void(0)" title="">PHP</a></li>
												<li><a href="JavaScript:void(0)" title="">CSS</a></li>
												<li><a href="JavaScript:void(0)" title="">Javascript</a></li>
												<li><a href="JavaScript:void(0)" title="">Wordpress</a></li>
												<li><a href="JavaScript:void(0)" title="">Photoshop</a></li>
												<li><a href="JavaScript:void(0)" title="">Illustrator</a></li>
												<li><a href="JavaScript:void(0)" title="">Corel Draw</a></li>
											</ul>
										</div><!--user-profile-ov end-->
									</div><!--product-feed-tab end-->
									<div class="product-feed-tab" id="portfolio-dd">
										<div class="portfolio-gallery-sec">
											<h3>Portfolio</h3>
											<div class="gallery_pf">
												<div class="row">
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img1.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img2.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img3.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img4.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img5.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img6.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img7.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img8.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img9.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
													<div class="col-lg-4 col-md-4 col-sm-6 col-6">
														<div class="gallery_pt">
															<img src="assets/home/images/resources/pf-img10.jpg" alt="">
															<a href="JavaScript:void(0)" title=""><img src="assets/home/images/all-out.png" alt=""></a>
														</div><!--gallery_pt end-->
													</div>
												</div>
											</div><!--gallery_pf end-->
										</div><!--portfolio-gallery-sec end-->
									</div><!--product-feed-tab end-->
								</div><!--main-ws-sec end-->
							</div>
							<div class="col-lg-3">
								<div class="right-sidebar">
									<div class="message-btn">
										<a href="JavaScript:void(0)" title=""><i class="fa fa-envelope"></i> Message</a>
									</div>
									<div class="widget widget-portfolio">
										<div class="wd-heady">
											<h3>Portfolio</h3>
											<img src="assets/home/images/photo-icon.png" alt="">
										</div>
										<div class="pf-gallery">
											<ul>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery1.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery2.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery3.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery4.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery5.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery6.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery7.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery8.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery9.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery10.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery11.png" alt=""></a></li>
												<li><a href="JavaScript:void(0)" title=""><img src="assets/home/images/resources/pf-gallery12.png" alt=""></a></li>
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
						<li><a href="JavaScript:void(0)" title="">Help Center</a></li>
						<li><a href="JavaScript:void(0)" title="">Privacy Policy</a></li>
						<li><a href="JavaScript:void(0)" title="">Community Guidelines</a></li>
						<li><a href="JavaScript:void(0)" title="">Cookies Policy</a></li>
						<li><a href="JavaScript:void(0)" title="">Career</a></li>
						<li><a href="JavaScript:void(0)" title="">Forum</a></li>
						<li><a href="JavaScript:void(0)" title="">Language</a></li>
						<li><a href="JavaScript:void(0)" title="">Copyright Policy</a></li>
					</ul>
					<p><img src="assets/home/images/copy-icon2.png" alt="">Copyright 2017</p>
					<img class="fl-rgt" src="assets/home/images/logo2.png" alt="">
				</div>
			</div>
		</footer><!--footer end-->


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
				<a href="JavaScript:void(0)" title="" class="close-box"><i class="la la-close"></i></a>
			</div><!--overview-edit end-->
		</div><!--overview-box end-->



	</div><!--theme-layout end-->




</body>
</html>
