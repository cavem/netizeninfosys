<?php
 require_once 'session.php';
 require_once "lib/mysql_class.php";
 header("Content-Type:text/html; charset=utf-8");
 $level=$_SESSION['level'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>网上办公</title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="layer/layer.js"></script>
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body>
<table width="100%" height="100%" style="border:1px #c4d5e0 solid" cellpadding="2" cellspacing="2"> 
 	<tr>
		<td background="" height="30" style=" border-bottom:1px #c4d5e0 dashed">
		导航>>网民信息统计   <input type="button" value="重新加载页面" onclick="window.location.reload()" /> 
		</td>
	</tr>
	<!--<tr>
        <td id="userdiv">
			<form action="?" method="post" style="margin-left:1%;">
			<p>
				<label class="lb">查询类型：</label>
				<select class="rt" name="counttype" style="border:1px solid #999;margin-right:2em;width:153px;height: 25px;">
					<option value="">-----请选择-----</option>
					<option value="0">人员属性</option>
					<option value="1">帖子类型</option>
				</select>
                <input class="rt" type="submit" style="background-color: #D7E8FF;PADDING:2px 6px" value="查询"/>
            </p>
			</form>
		</td>
    </tr>-->
    <tr>
        <td height="560" valign="top" align="left">
            <p><label class="lb" style="margin-left:1%">人员统计：</label></p>
            <table style="width:98%;margin-left:1%" class="table table-border table-bordered table-bg table-hover table-sort"  cellpadding="3" cellspacing="1">
                <thead class="text-c">
                <tr>
                    <th height="20" class="list_head" align="center">人员属性</th>
                    <th height="20" class="list_head" align="center">总人数</th>
                    <th height="20" class="list_head" align="center">日增加</th>
                    <th height="20" class="list_head" align="center">月增加</th>
                </tr>
                </thead>
                <?php
                    $ptarr=array("0"=>"涉警","1"=>"涉政","2"=>"涉稳","3"=>"其它","4"=>"涉军");
                    $today=date('Y-m-d');
                    $month=date('Y-m');
                    $todaycount=0;
                    $monthcount=0;
                    $alltodaycount=0;
                    $allmonthcount=0;
                    $alltotal=$mysql->total("SELECT count(*) FROM netizeninfo");
                    $mysql->query("SELECT StartTime FROM netizeninfo");
                    $result=$mysql->result;
                    while($row=mysql_fetch_array($result)){
                        if(substr($row["StartTime"],0,10)==$today){
                            $alltodaycount++;
                        }
                        if(substr($row["StartTime"],0,7)==$month){
                            $allmonthcount++;
                        }
                    }
                    for($i=0;$i<5;$i++){
                        $total=$mysql->total("SELECT count(*) FROM netizeninfo WHERE PersonType=$i");
                        $mysql->query("SELECT StartTime FROM netizeninfo WHERE PersonType=$i");
                        $result=$mysql->result;
                        while($row=mysql_fetch_array($result)){
                            if(substr($row["StartTime"],0,10)==$today){
                                $todaycount++;
                            }
                            if(substr($row["StartTime"],0,7)==$month){
                                $monthcount++;
                            }
                        }
                ?>
                    <tbody class="text-c">
                        <tr>
                            <td align="center"><?php echo $ptarr["$i"];?></td>
                            <td align="center"><?php echo $total;?></td>
                            <td align="center"><?php echo $todaycount;?></td>
                            <td align="center"><?php echo $monthcount;?></td>
                        </tr>
                <?php $todaycount=0;$monthcount=0;}?>
                        <tr>
                            <td align="center">总计</td>
                            <td align="center"><?php echo $alltotal;?></td>
                            <td align="center"><?php echo $alltodaycount;?></td>
                            <td align="center"><?php echo $allmonthcount;?></td>
                        </tr>
                    </tbody>
                    <?php $alltodaycount=0;$allmonthcount=0;?>
            </table>
            <p><label class="lb" style="margin-left:1%">帖子统计：</label></p>
            <table style="width:98%;margin-left:1%" class="table table-border table-bordered table-bg table-hover table-sort"  cellpadding="3" cellspacing="1">
                <thead class="text-c">
                <tr>
                    <th height="20" class="list_head" align="center">帖子类型</th>
                    <th height="20" class="list_head" align="center">总个数</th>
                    <th height="20" class="list_head" align="center">日增加</th>
                    <th height="20" class="list_head" align="center">月增加</th>	
                </tr>
                </thead>
                <?php
                    $ntarr=array("0"=>"微信","1"=>"QQ","2"=>"微博","3"=>"网站论坛");
                    $alltotal=$mysql->total("SELECT count(*) FROM postinfo");
                    $mysql->query("SELECT StartTime FROM postinfo");
                    $result=$mysql->result;
                    while($row=mysql_fetch_array($result)){
                        if(substr($row["StartTime"],0,10)==$today){
                            $alltodaycount++;
                        }
                        if(substr($row["StartTime"],0,7)==$month){
                            $allmonthcount++;
                        }
                    }
                    for($i=0;$i<4;$i++){
                        $total=$mysql->total("SELECT count(*) FROM postinfo WHERE PostType=$i");
                        $mysql->query("SELECT StartTime FROM postinfo WHERE PostType=$i");
                        $result=$mysql->result;
                        while($row=mysql_fetch_array($result)){
                            if(substr($row["StartTime"],0,10)==$today){
                                $todaycount++;
                            }
                            if(substr($row["StartTime"],0,7)==$month){
                                $monthcount++;
                            }
                        }
                ?>
                    <tbody class="text-c">
                        <tr>
                            <td align="center"><?php echo $ntarr["$i"];?></td>
                            <td align="center"><?php echo $total;?></td>
                            <td align="center"><?php echo $todaycount;?></td>
                            <td align="center"><?php echo $monthcount;?></td>
                        </tr>
                        <?php $todaycount=0;$monthcount=0;}?>
                        <tr>
                        <td align="center">总计</td>
                        <td align="center"><?php echo $alltotal;?></td>
                        <td align="center"><?php echo $alltodaycount;?></td>
                        <td align="center"><?php echo $allmonthcount;?></td>
                        </tr>
                    </tbody>
            </table>
            <p><label class="lb" style="margin-left:1%">虚拟身份统计：</label></p>
            <table style="width:98%;margin-left:1%" class="table table-border table-bordered table-bg table-hover table-sort"  cellpadding="3" cellspacing="1">
                <thead class="text-c">
                <tr>
                    <th height="20" class="list_head" align="center">虚拟身份</th>
                    <th height="20" class="list_head" align="center">总个数</th>
                    <th height="20" class="list_head" align="center">日增加</th>
                    <th height="20" class="list_head" align="center">月增加</th>	
                </tr>
                </thead>
                <?php
                    $alltodaycount=0;
                    $allmonthcount=0;
                    //微信
                    $wxtodaycount=0;
                    $wxmonthcount=0;
                    $wxtotal=$mysql->total("SELECT count(WeID) FROM netizeninfo where WeID!=''");
                    $mysql->query("SELECT StartTime FROM netizeninfo WHERE WeID!=''");
                    $result=$mysql->result;
                    while($row=mysql_fetch_array($result)){
                        if(substr($row["StartTime"],0,10)==$today){
                            $wxtodaycount++;
                        }
                        if(substr($row["StartTime"],0,7)==$month){
                            $wxmonthcount++;
                        }
                    }
                    //qq
                    $qqtodaycount=0;
                    $qqmonthcount=0;
                    $qqtotal=$mysql->total("SELECT count(QQ) FROM netizeninfo where QQ!=''");
                    $mysql->query("SELECT StartTime FROM netizeninfo WHERE QQ!=''");
                    $result=$mysql->result;
                    while($row=mysql_fetch_array($result)){
                        if(substr($row["StartTime"],0,10)==$today){
                            $qqtodaycount++;
                        }
                        if(substr($row["StartTime"],0,7)==$month){
                            $qqmonthcount++;
                        }
                    }
                    //微博
                    $wbtodaycount=0;
                    $wbmonthcount=0;
                    $wbtotal=$mysql->total("SELECT count(BlogID) FROM netizeninfo where BlogID!=''");
                    $mysql->query("SELECT StartTime FROM netizeninfo WHERE BlogID!=''");
                    $result=$mysql->result;
                    while($row=mysql_fetch_array($result)){
                        if(substr($row["StartTime"],0,10)==$today){
                            $wbtodaycount++;
                        }
                        if(substr($row["StartTime"],0,7)==$month){
                            $wbmonthcount++;
                        }
                    }
                    //luntan 
                    $lttodaycount=0;
                    $ltmonthcount=0;
                    $lttotal=$mysql->total("SELECT count(BbsNickName) FROM netizeninfo where BbsNickName!=''");
                    $mysql->query("SELECT StartTime FROM netizeninfo WHERE BbsNickName!=''");
                    $result=$mysql->result;
                    while($row=mysql_fetch_array($result)){
                        if(substr($row["StartTime"],0,10)==$today){
                            $lttodaycount++;
                        }
                        if(substr($row["StartTime"],0,7)==$month){
                            $ltmonthcount++;
                        }
                    }
                ?>
                <tbody>
                    <tr class="text-c">
                        <td align="center">微信</td>
                        <td align="center"><?php echo $wxtotal;?></td>
                        <td align="center"><?php echo $wxtodaycount;?></td>
                        <td align="center"><?php echo $wxmonthcount;?></td>
                    </tr>
                    <tr class="text-c">
                        <td align="center">QQ</td>
                        <td align="center"><?php echo $qqtotal;?></td>
                        <td align="center"><?php echo $qqtodaycount;?></td>
                        <td align="center"><?php echo $qqmonthcount;?></td>
                    </tr>
                    <tr class="text-c">
                        <td align="center">微博</td>
                        <td align="center"><?php echo $wbtotal;?></td>
                        <td align="center"><?php echo $wbtodaycount;?></td>
                        <td align="center"><?php echo $wbmonthcount;?></td>
                    </tr>
                    <tr class="text-c">
                        <td align="center">网站论坛</td>
                        <td align="center"><?php echo $lttotal;?></td>
                        <td align="center"><?php echo $lttodaycount;?></td>
                        <td align="center"><?php echo $ltmonthcount;?></td>
                    </tr>
                    <tr class="text-c">
                        <td align="center">总计</td>
                        <td align="center"><?php echo $wxtotal+$qqtotal+$wbtotal+$lttotal;?></td>
                        <td align="center"><?php echo $wxtodaycount+$qqtodaycount+$wbtodaycount+$lttodaycount;?></td>
                        <td align="center"><?php echo $wxmonthcount+$qqmonthcount+$wbmonthcount+$ltmonthcount;?></td>
                    </tr>
                </tbody>  
                    
            </table>
        </td>
    </tr>
</body>