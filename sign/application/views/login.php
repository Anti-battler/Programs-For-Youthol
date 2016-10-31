<?php
	$base_url=$this->config->item('base_url');
	error_reporting(E_ALL^E_NOTICE);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>荧光夜跑注册——青春在线</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="http://www.youthol.cn/wechat/sign/css/style.css">
</head>
<style>
	@media screen and (max-height: 400px) {
	.name{
		height: 324px;
		width: 298px;
		position: absolute;
	}
	input{
	min-height: 16px;
	font-size: 15px;
	}
}
</style>
<body>
	<div id="bg">
		<!-- style -->
		<img src="<?php echo $base_url; ?>/images/bg.jpg" alt="" width="100%" height="100%" style="min-height:400px;">
	</div>
	<?php echo form_open_multipart('Co/login','name="form"'); ?>
		<div class="name">
			<input type="text" name="name" class="namei">
			<input type="text" name="tel" class="tel">
			<input type="text" name="class" class="classi">
			<!-- style -->
			<input type="submit" style="bottom: -8%; right:15%;">
		</div>
		<!-- style -->
		<input type="hidden" name="openid" class="openid" value="<?php echo $openid; ?>">
	</form>
</body>
</html>