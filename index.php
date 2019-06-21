<?php
include_once('includes/init.php');
include('includes/postmode.php');
//获取关注人
if(isset( $_COOKIE['userid'])){
$userid= $_COOKIE['userid'];
$following =$db->select("count(*) as count")->from("follow")->where("followid = $userid")->find();
//获取被关注人数
$followed =$db->select("count(*) as count")->from("follow")->where("followedid = $userid")->find();
//获取最新动态
$find=$db->select("post.*,user.username as username ,user.avatar as avatar")->from("post as post")->leftjoin("user as user","post.userid=user.id")->where("post.userid='$userid'")->orderBy("post.createtime","desc")->find();
$alltag=$db->select()->from("tags")->all();
//获取当前关注用户状态
$followingpost=$db->select("post.*,user.username as username ,user.avatar as avatar ,follow.followid as followid")->from("post as post")->leftjoin("follow as follow","post.userid = follow.followedid")->leftjoin("user as user","post.userid=user.id")->where("follow.followid='$userid'")->orderBy("post.createtime","desc")->all();
}
if($_POST){
   $title=$_POST['title'];
   $content=$_POST['content'];
    $data=array(
	   'title'=>$title,
	   'content'=>$content,
	   'createtime'=>time(),
	   'userid'=>$_COOKIE['userid'],
	);
	if(isset($_FILES['url']))
  {
	$uploads = uploadalls("url","./assets/uploads/");

     $uploadsarr=array();
	   foreach($uploads as $item){

       if($item['result'])
       {
    
	   array_push($uploadsarr,$item['msg']);
	   }
   }
   if($uploadsarr){
	   $data['gallery']=json_encode( $uploadsarr);
   }
  }
   var_dump($data['gallery']);
//   exit;
	$inpost=$db->insert("post",$data);
	if($inpost){
		showMsg("输入信息成功",get_url());
		exit;
	}else{
		showMsg("输入信息失败",get_url());
		exit;
	}
}

?>


<!DOCTYPE html>
<html>
<head>
  <?php include("common/meta.php")?>
</head>


<body>
	<div id="wrapper" class="wrapper">
	<?php include("common/header.php") ?>
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3 col-md-4 pd-left-none no-pd">
								<div class="main-left-sidebar no-margin">
								<?php if(isset( $_COOKIE['userid'])){?>
									<div class="user-data full-width">
										<div class="user-profile">
											<div class="username-dt">
												<div class="usr-pic">
													<?php if(isset($_COOKIE['avatar'])){?>
													<img src="assets/<?=$_COOKIE['avatar']?>" alt="">
													<?php }else{?>
								<img src="assets/home/images/resources/noim-user.png" alt="">
							<?php }?>
								</div>
								</div><!--username-dt end-->
									<div class="user-specs">
												<h3><?=$_COOKIE['username']?></h3>
												
												<span><?=isset( $_COOKIE['desc'])?$_COOKIE['desc']:"这家伙很懒,什么都没留"?></span>
											</div>
										</div><!--user-profile end-->
										<ul class="user-fw-status">
											<li onclick="location='myfollow.php'" style="cursor: pointer;" >
												<h4>正在关注</h4>
												<span><?=$following['count']?></span>
											</li>
											<li onclick="location='myfollowed.php'" style="cursor: pointer;">
												<h4>粉丝</h4>
												<span><?=$followed['count']?></span>
											</li>
											<li>
												<a href="my-profile-feed.php" title="">View Profile</a>
											</li>
										</ul>
									</div><!--user-data end-->
								<?php }?>
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
												<a href="index.php#" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div><!--suggestions end-->
									<div class="tags-sec full-width">
										<ul>
											<li><a href="index.php#" title="">Help Center</a></li>
											<li><a href="index.php#" title="">About</a></li>
											<li><a href="index.php#" title="">Privacy Policy</a></li>
											<li><a href="index.php#" title="">Community Guidelines</a></li>
											<li><a href="index.php#" title="">Cookies Policy</a></li>
											<li><a href="index.php#" title="">Career</a></li>
											<li><a href="index.php#" title="">Language</a></li>
											<li><a href="index.php#" title="">Copyright Policy</a></li>
										</ul>
										<div class="cp-sec">
											<img src="assets/home/images/logo2.png" alt="">
											<p><img src="assets/home/images/cp.png" alt="">Copyright 2017</p>
										</div>
									</div><!--tags-sec end-->
								</div><!--main-left-sidebar end-->
							</div>
							<div class="col-lg-6 col-md-8 no-pd">
								<div class="main-ws-sec">
									<div class="post-topbar">
										<div class="user-picy">
										<?php if(isset($_COOKIE['avatar'])){?>
													<img style="border-radius:50%" src="assets/<?=$_COOKIE['avatar']?>" alt="">
													<?php }else{?>
						      	     	<img style="border-radius:50%" src="assets/home/images/resources/noim-user.png" alt="">
							         <?php }?>
										</div>
										<?php if(isset($_COOKIE['userid'])){?>
										<div class="post-st">
											<ul>
												<li><a class="post-jb active" href="index.php#" title="">发推</a></li>
											</ul>
										</div><!--post-st end-->
										<?php }?>
									</div><!--post-topbar end-->
									
									
									<div class="posts-section">
									<?php 
									if(isset( $_COOKIE['userid'])){
									//搜寻最新
									if($find){
										$arr=array($find);
										postall($arr);
									}
								}
										?>
										<div class="top-profiles">
											<div class="pf-hd">
												<h3>Top Profiles</h3>
												<i class="la la-ellipsis-v"></i>
											</div>
											<div class="profiles-slider">
												<div class="user-profy">
													<img src="assets/home/images/resources/user1.png" alt="">
													<h3>John Doe</h3>
													<span>Graphic Designer</span>
													<ul>
														<li><a href="index.php#" title="" class="followw">Follow</a></li>
														<li><a href="index.php#" title="" class="envlp"><img src="assets/home/images/envelop.png" alt=""></a></li>
														<li><a href="index.php#" title="" class="hire">hire</a></li>
													</ul>
													<a href="index.php#" title="">View Profile</a>
												</div><!--user-profy end-->
												<div class="user-profy">
													<img src="assets/home/images/resources/user2.png" alt="">
													<h3>John Doe</h3>
													<span>Graphic Designer</span>
													<ul>
														<li><a href="index.php#" title="" class="followw">Follow</a></li>
														<li><a href="index.php#" title="" class="envlp"><img src="assets/home/images/envelop.png" alt=""></a></li>
														<li><a href="index.php#" title="" class="hire">hire</a></li>
													</ul>
													<a href="index.php#" title="">View Profile</a>
												</div><!--user-profy end-->
												<div class="user-profy">
													<img src="assets/home/images/resources/user3.png" alt="">
													<h3>John Doe</h3>
													<span>Graphic Designer</span>
													<ul>
														<li><a href="index.php#" title="" class="followw">Follow</a></li>
														<li><a href="index.php#" title="" class="envlp"><img src="assets/home/images/envelop.png" alt=""></a></li>
														<li><a href="index.php#" title="" class="hire">hire</a></li>
													</ul>
													<a href="index.php#" title="">View Profile</a>
												</div><!--user-profy end-->
												<div class="user-profy">
													<img src="assets/home/images/resources/user1.png" alt="">
													<h3>John Doe</h3>
													<span>Graphic Designer</span>
													<ul>
														<li><a href="index.php#" title="" class="followw">Follow</a></li>
														<li><a href="index.php#" title="" class="envlp"><img src="assets/home/images/envelop.png" alt=""></a></li>
														<li><a href="index.php#" title="" class="hire">hire</a></li>
													</ul>
													<a href="index.php#" title="">View Profile</a>
												</div><!--user-profy end-->
												<div class="user-profy">
													<img src="assets/home/images/resources/user2.png" alt="">
													<h3>John Doe</h3>
													<span>Graphic Designer</span>
													<ul>
														<li><a href="index.php#" title="" class="followw">Follow</a></li>
														<li><a href="index.php#" title="" class="envlp"><img src="assets/home/images/envelop.png" alt=""></a></li>
														<li><a href="index.php#" title="" class="hire">hire</a></li>
													</ul>
													<a href="index.php#" title="">View Profile</a>
												</div><!--user-profy end-->
												<div class="user-profy">
													<img src="assets/home/images/resources/user3.png" alt="">
													<h3>John Doe</h3>
													<span>Graphic Designer</span>
													<ul>
														<li><a href="index.php#" title="" class="followw">Follow</a></li>
														<li><a href="index.php#" title="" class="envlp"><img src="assets/home/images/envelop.png" alt=""></a></li>
														<li><a href="index.php#" title="" class="hire">hire</a></li>
													</ul>
													<a href="index.php#" title="">View Profile</a>
												</div><!--user-profy end-->
											</div><!--profiles-slider end-->
										</div><!--top-profiles end-->
									<?php
									if( isset( $_COOKIE['userid'])){
									postall($followingpost);
									?>
									<div class="process-comm">
											<a href="index.php#" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
										</div><!--process-comm end-->
                                    <?php
									}?>
										
									 
										
									</div><!--posts-section end-->
								</div><!--main-ws-sec end-->
							</div>
							
							<div class="col-lg-3 pd-right-none no-pd">
								<div class="right-sidebar">
								<?php if(!isset( $_COOKIE['userid'])){?>
									<div class="widget widget-about">
										<img src="assets/home/images/wd-logo.png" alt="">
										<h3>欢迎来到XX博客</h3>
										<span>开始来编写你的人生吧!</span>
										<div class="sign_link">
											<h3><a href="login.php" title="">登陆/注册</a></h3>
											<a href="index.php#" title="">获取更多信息</a>
										</div>
									</div><!--widget-about end-->
									<?php }?>
									<div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Top Jobs</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="jobs-list">
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Product Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior UI / UX Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Junior Seo Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior PHP Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Developer Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
										</div><!--jobs-list end-->
									</div><!--widget-jobs end-->
									<div class="widget widget-jobs">
										<div class="sd-title">
											<h3>Most Viewed This Week</h3>
											<i class="la la-ellipsis-v"></i>
										</div>
										<div class="jobs-list">
											<div class="job-info">
												<div class="job-details">
													<h3>Senior Product Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Senior UI / UX Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
											<div class="job-info">
												<div class="job-details">
													<h3>Junior Seo Designer</h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
												</div>
												<div class="hr-rate">
													<span>$25/hr</span>
												</div>
											</div><!--job-info end-->
										</div><!--jobs-list end-->
									</div><!--widget-jobs end-->
									<div class="widget suggestions full-width">
										<div class="sd-title">
											<h3>Most Viewed People</h3>
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
													<span>C &amp; C++ Developer</span>
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
												<a href="index.php#" title="">View More</a>
											</div>
										</div><!--suggestions-list end-->
									</div>
								</div><!--right-sidebar end-->
							</div>
							
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>




		<div class="post-popup pst-pj">
			<div class="post-project">
				<h3>Post a project</h3>
				<div class="post-project-fields">
					<form>
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="Title">
							</div>
							<div class="col-lg-12">
								<div class="inp-field">
									<select>
										<option>Category</option>
										<option>Category 1</option>
										<option>Category 2</option>
										<option>Category 3</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<input type="text" name="skills" placeholder="Skills">
							</div>
							<div class="col-lg-12">
								<div class="price-sec">
									<div class="price-br">
										<input type="text" name="price1" placeholder="Price">
										<i class="la la-dollar"></i>
									</div>
									<span>To</span>
									<div class="price-br">
										<input type="text" name="price1" placeholder="Price">
										<i class="la la-dollar"></i>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="index.php#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="index.php#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		<div class="post-popup job_post" id="in_post">
			<div class="post-project">
				<h3>发推特</h3>
				<div class="post-project-fields">
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="title" placeholder="标题">
							</div>						
							
							<div class="col-lg-12">
								<textarea name="content" placeholder="内容"></textarea>
							</div>
							<div id="imageset" class="col-lg-12">
							<div class="item " >
           <svg class="icon addImg" aria-hidden="true">
           <use xlink:href="#icon-tianjiatupian"></use>
      </svg>
        <input name="url[]" type="file" class="upload_input" onChange="preview(this)">
        <div class="preview"></div>
        <div class="click" onClick="loadImg(this)"></div>
        <div class="delete" onClick="deleteImg(this)">
        <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-shanchu4"></use>
          </svg>
      </div>
      </div>
								</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">发送</button></li>
									<li><a href="index.php#" onclick="outpost()" title="">取消</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="index.php#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->



		<div class="chatbox-list">
			<div class="chatbox">
				<div class="chat-mg">
					<a href="index.php#" title=""><img src="assets/home/images/resources/usr-img1.png" alt=""></a>
					<span>2</span>
				</div>
				<div class="conversation-box">
					<div class="con-title mg-3">
						<div class="chat-user-info">
							<img src="assets/home/images/resources/us-img1.png" alt="">
							<h3>John Doe <span class="status-info"></span></h3>
						</div>
						<div class="st-icons">
							<a href="index.php#" title=""><i class="la la-cog"></i></a>
							<a href="index.php#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
							<a href="index.php#" title="" class="close-chat"><i class="la la-close"></i></a>
						</div>
					</div>
					<div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
						<div class="chat-msg">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
							<span>Sat, Aug 23, 1:10 PM</span>
						</div>
						<div class="date-nd">
							<span>Sunday, August 24</span>
						</div>
						<div class="chat-msg st2">
							<p>Cras ultricies ligula.</p>
							<span>5 minutes ago</span>
						</div>
						<div class="chat-msg">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
							<span>Sat, Aug 23, 1:10 PM</span>
						</div>
					</div><!--chat-list end-->
					<div class="typing-msg">
						<form>
							<textarea placeholder="Type a message here"></textarea>
							<button type="submit"><i class="fa fa-send"></i></button>
						</form>
						<ul class="ft-options">
							<li><a href="index.php#" title=""><i class="la la-smile-o"></i></a></li>
							<li><a href="index.php#" title=""><i class="la la-camera"></i></a></li>
							<li><a href="index.php#" title=""><i class="fa fa-paperclip"></i></a></li>
						</ul>
					</div><!--typing-msg end-->
				</div><!--chat-history end-->
			</div>
			<div class="chatbox">
				<div class="chat-mg">
					<a href="index.php#" title=""><img src="assets/home/images/resources/usr-img2.png" alt=""></a>
				</div>
				<div class="conversation-box">
					<div class="con-title mg-3">
						<div class="chat-user-info">
							<img src="assets/home/images/resources/us-img1.png" alt="">
							<h3>John Doe <span class="status-info"></span></h3>
						</div>
						<div class="st-icons">
							<a href="index.php#" title=""><i class="la la-cog"></i></a>
							<a href="index.php#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
							<a href="index.php#" title="" class="close-chat"><i class="la la-close"></i></a>
						</div>
					</div>
					<div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
						<div class="chat-msg">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
							<span>Sat, Aug 23, 1:10 PM</span>
						</div>
						<div class="date-nd">
							<span>Sunday, August 24</span>
						</div>
						<div class="chat-msg st2">
							<p>Cras ultricies ligula.</p>
							<span>5 minutes ago</span>
						</div>
						<div class="chat-msg">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
							<span>Sat, Aug 23, 1:10 PM</span>
						</div>
					</div><!--chat-list end-->
					<div class="typing-msg">
						<form>
							<textarea placeholder="Type a message here"></textarea>
							<button type="submit"><i class="fa fa-send"></i></button>
						</form>
						<ul class="ft-options">
							<li><a href="index.php#" title=""><i class="la la-smile-o"></i></a></li>
							<li><a href="index.php#" title=""><i class="la la-camera"></i></a></li>
							<li><a href="index.php#" title=""><i class="fa fa-paperclip"></i></a></li>
						</ul>
					</div><!--typing-msg end-->
				</div><!--chat-history end-->
			</div>
			<div class="chatbox">
				<div class="chat-mg bx">
					<a href="index.php#" title=""><img src="assets/home/images/chat.png" alt=""></a>
					<span>2</span>
				</div>
				<div class="conversation-box">
					<div class="con-title">
						<h3>Messages</h3>
						<a href="index.php#" title="" class="close-chat"><i class="la la-minus-square"></i></a>
					</div>
					<div class="chat-list">
						<div class="conv-list active">
							<div class="usrr-pic">
								<img src="assets/home/images/resources/usy1.png" alt="">
								<span class="active-status activee"></span>
							</div>
							<div class="usy-info">
								<h3>John Doe</h3>
								<span>Lorem ipsum dolor <img src="assets/home/images/smley.png" alt=""></span>
							</div>
							<div class="ct-time">
								<span>1:55 PM</span>
							</div>
							<span class="msg-numbers">2</span>
						</div>
						<div class="conv-list">
							<div class="usrr-pic">
								<img src="assets/home/images/resources/usy2.png" alt="">
							</div>
							<div class="usy-info">
								<h3>John Doe</h3>
								<span>Lorem ipsum dolor <img src="assets/home/images/smley.png" alt=""></span>
							</div>
							<div class="ct-time">
								<span>11:39 PM</span>
							</div>
						</div>
						<div class="conv-list">
							<div class="usrr-pic">
								<img src="assets/home/images/resources/usy3.png" alt="">
							</div>
							<div class="usy-info">
								<h3>John Doe</h3>
								<span>Lorem ipsum dolor <img src="assets/home/images/smley.png" alt=""></span>
							</div>
							<div class="ct-time">
								<span>0.28 AM</span>
							</div>
						</div>
					</div><!--chat-list end-->
				</div><!--conversation-box end-->
			</div>
		</div><!--chatbox-list end-->

	</div><!--theme-layout end-->
<script>
function outpost(){
	var post=document.getElementById("in_post");
	post.classList.remove("active");
	// overlay
	var wrapper=document.getElementById("wrapper");
	wrapper.classList.remove("overlay");
}


</script>



</body>
</html>
