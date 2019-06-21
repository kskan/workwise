<?php 



$alltag=$db->select()->from("tags")->all();





function  postall($data){
	global $alltag;
	global $db;

foreach($data as $item){?>
			<div class="post-bar" >
													<div class="post_topbar">
												<div class="usy-dt">
													<img width="50" height="50" src="assets/<?=$item['avatar']?>" alt="">
													<div class="usy-name">
														<h3 onclick="location='user-profile.php?id=<?=$item['userid']?>'" style="cursor: pointer;" ><?=$item['username']?></h3>
														<span><img src="assets/home/images/clock.png" alt=""><?=date("Y-m-d",$item['createtime'])?></span>
													</div>
												</div>
												<div class="ed-opts" >
													<a href="index.php#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a href="index.php#" title="">Edit Post</a></li>
														<li><a href="index.php#" title="">Unsaved</a></li>
														<li><a href="index.php#" title="">Unbid</a></li>
														<li><a href="index.php#" title="">Close</a></li>
														<li><a href="index.php#" title="">Hide</a></li>
													</ul>
												</div>
											</div>
											<div class="epi-sec">
												<ul class="descp">
													<li><img src="assets/home/images/icon8.png" alt=""><span>Epic Coder</span></li>
													<li><img src="assets/home/images/icon9.png" alt=""><span>India</span></li>
												</ul>
												<ul class="bk-links">
													<li><a href="index.php#" title=""><i class="la la-bookmark"></i></a></li>
													<li><a href="index.php#" title=""><i class="la la-envelope"></i></a></li>
													<li><a href="index.php#" title="" class="bid_now">Bid Now</a></li>
												</ul>
											</div>
											<div class="job_descp" onclick="location='post.php?id=<?=$item['id']?>'">
												<h3><?=$item['title']?></h3>
												<!-- <ul class="job-dt">
													<li><a href="index.php#" title="">Full Time</a></li>
													<li><span>$30 / hr</span></li>
												</ul> -->
												<p><?=$item['content']?><a href="index.php#" title="">view more</a></p>
												<?php if($item['gallery']){
													$json=json_decode($item['gallery']);
													// var_dump($json);
													// exit;
													foreach( $json as $item2){
														?>
														<img width="100"  height="100" style="margin:10px;" src="<?=$item2?>" alt="">
<?php

													}


												}?>
											<?php if ($item['tagsid']!=""){?>
												<ul class="skill-tags">
												<?php $tagid =explode(",", $item['tagsid']);	
												foreach($tagid as $item2){
												foreach($alltag as $item3){
													if($item2==$item3['id']){
												?>
													<li><a href="index.php#" title=""><?=$item3['name']?></a></li>
										<?php }} }?>
										</ul>
												<?php
											 }?>
											</div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a href="index.php#"><i class="la la-heart"></i> Like</a>
														<img src="assets/home/images/liked-img.png" alt="">
														<span>25</span>
													</li> 
													<li><a href="post.php?id=<?=$item['id']?>" title="" class="com"><img src="assets/home/images/com.png" alt=""><?php
													$postid=$item['id'];
													$findcomments=$db->select("count(*) as count")->from("comments")->where("postid ='$postid'")->find();
													if($findcomments['count']==0){
														echo "点击留言";

													}
													else{
														echo  $findcomments['count']."条留言";
													}
													?></a></li>
												</ul>
												<a><i class="la la-eye"></i>Views 50</a>
											</div>
										</div><!--post-bar end-->
                                        <?php }
                                            }                                             
                                        ?>
										