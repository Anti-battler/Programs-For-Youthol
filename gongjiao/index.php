<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>公交查询系统</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="css/weui.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body style="background:#fbf9fe;">
	<div class="hd">
	    <h1 class="page_title">公交查询系统</h1>
	</div>
	<form action="res.php" method="post" name="form">
		<div class="weui_cells weui_cells_form">
			<div class="weui_cell">
	            <div class="weui_cell_hd"><label for="" class="weui_label">城市（拼音）</label></div>
	            <div class="weui_cell_bd weui_cell_primary">
	                <input class="weui_input" name="city" type="text" placeholder="比如 jinan">
	            </div>
	        </div>
	    </div>
		<div class="weui_cells weui_cells_form">
			<div class="weui_cell">
	            <div class="weui_cell_hd"><label for="" class="weui_label">起点</label></div>
	            <div class="weui_cell_bd weui_cell_primary">
	                <input class="weui_input" name="qd" type="text">
	            </div>
	        </div>
	    </div>
	    <div class="weui_cells weui_cells_form">
			<div class="weui_cell">
	            <div class="weui_cell_hd"><label for="" class="weui_label">终点</label></div>
	            <div class="weui_cell_bd weui_cell_primary">
	                <input class="weui_input" name="zd" type="text">
	            </div>
	        </div>
	    </div>
		<br><br>
		<a class="weui_btn weui_btn_primary" href="javascript:form.submit();" id="showTooltips">确定</a>
	</form>
	<br>
	<p class="page_desc">数据由8684网站提供</p>	
</body>
</html>