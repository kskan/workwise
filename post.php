<?php 
include("includes/init.php");
include("includes/postmode.php");
if($_POST){
	$content=$_POST['content'];
	$pid=$_POST['pid'];
	$postid=$_POST['postid'];
	$data=array(
	   "content"=>$content,
	   "createtime"=>time(),
	   "userid"=>$_COOKIE['userid'],
	   "postid"=>$postid,
	   "pid"=>$pid

	);
	 $incomment=$db->insert("comments",$data);
	 if($incomment){
		 showMsg('添加回复成功',get_url());
		 exit;

	 }else{
		showMsg('添加回复失败',get_url());
		exit;
	 }

}


if(isset( $_GET['id'])){
	$postid=$_GET['id'];
	//获取文章
	// $post=$db->select()->from("post")->where("id ='$postid'")->find();
    
	$post=$db->select("post.*,user.username as username ,user.avatar as avatar,user.`desc` as `desc` ")->from("post as post")->leftjoin("user as user","post.userid=user.id")->where("post.id='$postid'")->orderBy("post.createtime","desc")->find();
     
	$userid= $post['userid'];

	$following =$db->select("count(*) as count")->from("follow")->where("followid = $userid")->find();
	//获取被关注人数
	$followed =$db->select("count(*) as count")->from("follow")->where("followedid = $userid")->find();
	$message=$db->select("comments.* ,user.username as username , user.avatar as avatar")->from("comments as comments")->leftjoin("user as user","comments.userid = user.id")->where("comments.postid = '$postid'")->all();
}



?>
<!DOCTYPE html>
<html>
<head>

	<?php include("common/meta.php"); ?>
	<script type="application/javascript">
	function request(e){
		// console.log('奏效');
		// console.log(e);	
		var dataid=e.dataset.id;
        var datausername=e.getAttribute("data-username");
		parentid=document.getElementById("parentid");
		pid=document.getElementById("pid");
		pid.value=dataid;
        // parentid.innerHTML=datausername;
		$("#content")[0].scrollIntoView();
		parentid.innerHTML="<ul class='skill-tags' onclick='move()'>	<li><a href='JavaScript:void(0)' title=''>回复给:"+datausername+"</a></li></ul>";
	}
	function move(){
		parentid=document.getElementById("parentid");
		pid=document.getElementById("pid");
		pid.value=0;
		parentid.innerHTML="";
	}
	
	</script>
</head>
<body>
	<div class="wrapper">
		<?php include("common/header.php");
		?>
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
						<div class="col-lg-3 col-md-4 pd-left-none no-pd">
								<div class="main-left-sidebar no-margin">
								
									<div class="user-data full-width">
										<div class="user-profile">
											<div class="username-dt">
												<div class="usr-pic">
									
													<img src="assets/<?=$post['avatar']?>" alt="">
									
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
												<h3><?=$post['username']?></h3>
												
												<span><?=isset( $post['desc'])?$post['desc']:"这家伙很懒,什么都没留"?></span>
											</div>
										</div><!--user-profile end-->
										<ul class="user-fw-status">
											<li onclick="location='userfollow.php?userid=<?=$userid?>'" style="cursor: pointer;" >
												<h4>正在关注</h4>
												<span><?=$following['count']?></span>
											</li>
											<li onclick="location='userfollowed.php?userid=<?=$userid?>'" style="cursor: pointer;">
												<h4>粉丝</h4>
												<span><?=$followed['count']?></span>
											</li>
											<li>
												<a href="user-profile.php?id=<?=$post['userid']?>" title="">View Profile</a>
											</li>
										</ul>
									</div><!--user-data end-->
								
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
							<div class="col-lg-9">
								<div class="main-ws-sec">
									<div class="posts-section">
										<?php
										$arr=array($post);
										postall($arr);
										?>
										<!-- <div class="process-comm">
											<a href="projects.html#" title=""><img src="assets/home/images/process-icon.png" alt=""></a>
										</div>process-comm end -->
									</div><!--posts-section end-->
									<div class="suggestions full-width">
										
										
										<div class="sd-title">
											<h3>留言</h3>
											<i class="la la-ellipsis-v"></i>
										</div><!--sd-title end-->
										<div class="suggestions-list">
										<?php foreach($message as $item){
											if($item['pid']==0){?>
											<div class="suggestion-usd">
												<img width="30" height="30" src="assets/<?=$item['avatar']?>" alt="">
												<div class="sgt-text">
													<h4><?=$item['username']?></h4>
													<span><?=$item['content']?></span>
												</div>
												<span data-username="<?=$item['username']?>" data-id="<?=$item["id"]?>" id="request" onclick="request(this)"><i class="la " style="font-size: 12px;font-weight: lighter;" > 留言</i></span>
												
											</div>
											<?php foreach($message as $item2){
												if($item2['pid']==$item['id']){
										?>
											<div style="background-color:#dddddd;width:90%;margin:0 5%;" class="suggestion-usd">
											
												<img width="30" height="30" src="assets/<?=$item2['avatar']?>" alt="">
												<div class="sgt-text">
													<h4><?=$item2['username']?></h4>
													<span><?=$item2['content']?></span>
												</div>
											</div>
										<?php
											}}
									} }	?>
											<div class="view-more">
												<a href="index.php#" title="">View More</a>
											</div>
											<div class="post-project-fields">
					         <form  method="post">
					         	<div class="row">
								 <div  class="col-lg-12" id="parentid">
								 <!-- <span></span> -->
								 </div>
					     		<div class="col-lg-12">
								<textarea name="content" id="content" placeholder="点此回复信息"></textarea>
							</div>
							<input type="hidden" id="pid" name="pid" value="0">
							<input type="hidden"  name="postid" value="<?=$_GET['id']?>">
							<div class="col-lg-12">
								<ul>
									<li><button class="active"  type="submit" value="post">发送</button></li>
								</ul>
							</div>
						</div>
						</form>
										</div><!--suggestions-list end-->
									</div><!--suggestions end-->
									
								</div><!--main-ws-sec end-->
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
									<li><a href="projects.html#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="projects.html#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->

		<div class="post-popup job_post">
			<div class="post-project">
				<h3>Post a job</h3>
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
							<div class="col-lg-6">
								<div class="price-br">
									<input type="text" name="price1" placeholder="Price">
									<i class="la la-dollar"></i>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="inp-field">
									<select>
										<option>Full Time</option>
										<option>Half time</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<textarea name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-lg-12">
								<ul>
									<li><button class="active" type="submit" value="post">Post</button></li>
									<li><a href="projects.html#" title="">Cancel</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div><!--post-project-fields end-->
				<a href="projects.html#" title=""><i class="la la-times-circle-o"></i></a>
			</div><!--post-project end-->
		</div><!--post-project-popup end-->


	</div><!--theme-layout end-->
	

</body>
</html>
