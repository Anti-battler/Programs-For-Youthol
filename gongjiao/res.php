<?php
    error_reporting(E_ALL^E_NOTICE);
	header("Content-type: text/html; charset=utf-8");
	$qd=$_POST['qd'];
    $zd=$_POST['zd'];
	$city=$_POST['city'];
	$url='http://'.$city.'.8684.cn/so.php?k=p2p&q='.$qd.'&q1='.$zd;
    // echo $url;
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $res=curl_exec($ch);
    preg_match_all('#<div class="cr_plan_results">([^<>]+)| class="cr_plan_link1">([^<>]+)|class="cr_plan_link2">([^<>]+)|class="cr_plan_img">([^<>]+)|class="busline_walk">([^<>]+)#', $res, $xx);
    // var_dump($xx);
    if($xx[0][0]=='')
    {
        echo "<script>alert('无数据，填写出现错误或填写的太过笼统');history.go(-1);</script>";
    }
    else{
    $count=count($xx[0]);
    $new=array();
    for($z=0,$x=0;$z<$count;$z++,$x++)      //这里的算法。。。有点尴尬  
    {
        if(strstr($xx[0][$z],'cr_plan_link2')&&strstr($xx[0][$z+1],'cr_plan_link2'))
        {
            $new[$x]=$xx[0][$z].'/'.$xx[0][$z+1];
            $z++;
            if(strstr($xx[0][$z],'cr_plan_link2')&&strstr($xx[0][$z+1],'cr_plan_link2'))
            {
                $new[$x]=$new[$x].'/'.$xx[0][$z+1];
                $z++;
                if(strstr($xx[0][$z],'cr_plan_link2')&&strstr($xx[0][$z+1],'cr_plan_link2'))
                {
                    $new[$x]=$new[$x].'/'.$xx[0][$z+1];
                    $z++;
                    if(strstr($xx[0][$z],'cr_plan_link2')&&strstr($xx[0][$z+1],'cr_plan_link2'))
                    {
                        $new[$x]=$new[$x].'/'.$xx[0][$z+1];
                        $z++;
                    }
                }
            }
        }
        else
        {
            $new[$x]=$xx[0][$z];
        }
    }
    $res=array();
    $i=-1;
    for($j=0,$k=0;$j<$count;$j++,$k++){
        if(strstr($new[$j],"方案"))
        {
            $i++;
            $k=0;
        }
        if($new[$j]==NULL)
        {
            break;
        }
        $res[$i][$k]=$new[$j];
    }
    // var_dump($new);
    // var_dump($res);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>公交查询系统</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link rel="stylesheet" href="css/weui.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body  style="background:#fbf9fe;">
    <div class="hd">
        <h1 class="page_title">公交查询系统</h1>
    </div>
    <?php
    foreach ($res as $key => $val) 
    {
    	# code...
        ?>
        <div class="weui-panel__bd"  style="background:#fff;">
                <div class="weui-media-box weui-media-box_small-appmsg">
                    <div class="weui-cells">
        <?php
        foreach ($val as $key => $value) {
            # code...
        $value=preg_replace('#class="cr_plan_link1">#i','', $value);
        $value=preg_replace('#class="cr_plan_img">#i','', $value);
        $value=preg_replace('#class="busline_walk">#i','', $value);
        $value=preg_replace('#class="cr_plan_link2">#i','', $value);
        $value=preg_replace('#<div class="cr_plan_results">#i','路线概况：', $value);
        ?>
                        <a class="weui_cell weui_cell_access" >
                            <div class="weui_cell_hd"></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p><?php echo $value; ?></p>
                            </div>
                            <span class="weui_cell_ft"></span>
                        </a>
        <?php
        }
    ?>
                    </div>
                </div>
            </div>
            <br>
    <?php } ?>
</body>
</html>
<?php } ?>