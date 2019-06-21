<meta charset="UTF-8">
<title><?=$GETWEBTITLE?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="assets/home/css/animate.css">
<link rel="stylesheet" type="text/css" href="assets/home/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/home/css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="assets/home/css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/home/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/home/css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" type="text/css" href="assets/home/lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="assets/home/lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="assets/home/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/home/css/responsive.css">
<script type="text/javascript" src="assets/home/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/home/js/popper.js"></script>
<script type="text/javascript" src="assets/home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/home/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="assets/home/lib/slick/slick.min.js"></script>
<script type="text/javascript" src="assets/home/js/scrollbar.js"></script>
<script type="text/javascript" src="assets/home/js/script.js"></script>

<?php if($_SERVER['PHP_SELF']=="/index.php"|| $_SERVER['PHP_SELF']=="/"){
    ?>

<script type="text/javascript" src="assets/home/js/svg.js"></script>
<script type="text/javascript" src="assets/home/js/template.js"></script>
<script id="tpl" type="text/html">
<div class="item ">
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
</script>
<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
<style type="text/css">
/* body {
	background: #efd;
}
section {
	width: 1200px;
	margin: 200px auto;
}
article {
	border: 1px solid #ccc;
	padding: 20px;
} */
.icon {
	width: 2em;
	height: 2em;
	vertical-align: -0.15em;
	fill: currentColor;
	overflow: hidden;
}
.item {
	float: left;
	position: relative;
	margin: 20px 30px;
}
.addImg {
	width: 100px;
	height: 100px;
}
.upload_input {
	display: none;
}
.preview {
	position: absolute;
	width: 100px;
	height: 100px;
	left: 0;
	top: 0;
}
.click {
	position: absolute;
	width: 100px;
	height: 100px;
	left: 0;
	top: 0;
	z-index: 1;
	cursor: pointer;
}
.delete {
	position: absolute;
	right: -2rem;
	top: -1rem;
	cursor: pointer;
	display: none;
}
.preview img {
	width: 100%;
	height: 100%;
}
</style>
<script type="text/javascript">
  //选择图片
  var loadImg = function(obj){
    $(obj).parent().find(".upload_input").click();
  }
  //删除
  var deleteImg = function(obj){
    $(obj).parent().find('input').val('');
    $(obj).parent().find('.preview').html('');
    $(obj).hide();
    $(obj).parent().remove();
  }
</script> 

<!-- 预览 --> 
<script type="text/javascript">
function preview(file) {
    var tpl1 = document.getElementById("tpl").innerHTML;
		// var img = template(tpl1,{list:null})
   //div  item;
   $("#imageset").append(tpl1);
  var prevDiv = $(file).parent().find('.preview');
  if (file.files && file.files[0]) {
    var reader = new FileReader();
    reader.onload = function(evt) {
      prevDiv.html('<img src="' + evt.target.result + '" />');
    }
    reader.readAsDataURL(file.files[0]);
  } else {//IE
    prevDiv.html('<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>');
  }
  $(file).parent().find('.delete').show();
}
</script>
<?php }?>