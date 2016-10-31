<?php
	$base_url=$this->config->item('base_url');
	error_reporting(E_ALL^E_NOTICE);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error</title>
	<link rel="stylesheet" href="<?php echo $base_url; ?>/css/style.css">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
</head>
</head>
<body>
	<div id="bg">
		<img src="<?php echo $base_url; ?>/images/error.jpg" alt="" width="100%" height="100%">
	</div>
</body>
</html>