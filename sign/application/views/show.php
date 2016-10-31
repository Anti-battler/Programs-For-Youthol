<?php
	$base_url=$this->config->item('base_url');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo $base_url; ?>/css/weui.css">
	<link rel="stylesheet" href="<?php echo $base_url; ?>/css/example.css">
</head>
<style>
	td{
		text-align: center;
	}
</style>
<body>
	<div class="container">
		<div class="hd">
		    <h1 class="page_title">BACKGROUND</h1>
		    <p class="page_desc">用表格纯粹是为了复制到excel简单=。= </p>
		</div>
		<br>
		<table border=1>	
			<?php foreach ($list as $key => $list) {
				# code...
				$id=$list['id'];
				$name=$list['name'];
				$class=$list['class'];
				$tel=$list['tel'];
				$openid=$list['openid'];
			 ?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $name; ?></td>
				<td><?php echo $class; ?></td>
				<td><?php echo $tel; ?></td>
				<td><?php echo $openid; ?></td>
			</tr>
			<?php }; //var_dump($list)?>
		</table>
	</div>
</body>
</html>