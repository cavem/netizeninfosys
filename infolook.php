<?php
require_once 'session.php';
require_once "lib/mysql_class.php";
header("Content-Type:text/html; charset=utf-8");
$id=$_REQUEST['id'];
if ($id)
{
	$postarr=array();
	$mysql->query("SELECT * FROM netizeninfo WHERE ID=$id");
	$result=$mysql->result;
	while($row=mysql_fetch_array($result)){
		$ename=$row['Name'];
		$esex=$row['Sex'];
		$ecodeid=$row['CodeID'];
		$edomicile=$row['Domicile'];
		$elivingplace=$row['Livingplace'];
		$eworkunit=$row['Workunit'];
		$epersonattr=$row['Personattr'];
		$ewename=$row['WeNickName'];
		$eweid=$row['WeID'];
		$ewegroup=$row['WeGroupNo'];
		$eqqname=$row['QQNickName'];
		$eqqid=$row['QQ'];
		$eqqgroup=$row['QQGroupNo'];
		$eblogname=$row['BlogNickName'];
		$eblogid=$row['BlogID'];
		$eblognumber=$row['BlogNumber'];
		$ebbsname=$row['BbsNickName'];
		$ephone=$row['Phone'];
		$eemail=$row['Email'];
		$epic=$row['Pic'];
		$epersontype=$row['PersonType'];
		$eplacebelong=$row['PlaceBelong'];
		$ewepubname=$row['WePubName'];
		break;
	}
	$mysql->query("SELECT PostType FROM postinfo WHERE UserID=$id");
	$result2=$mysql->result;
	while($row2=mysql_fetch_array($result2)){
		array_push($postarr,$row2["PostType"]);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title> 
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
    <style>
    	.text-c{text-align:center}
		.infofont{font-family:楷体;font-size:15px;font-weight:bold;}
		.table th,.table td{line-height:25px;}
		.table-bordered th, .table-bordered td {border-left: 1px solid #555;}
		.table-border th, .table-border td {border-bottom: 1px solid #555;}
		.list_head{border-top:1px solid #555;}
		.list_right{border-right:1px solid #555;}
    </style>
	<script>
		$(function(){
			$(".printbtn").click(function(){
				window.open("print.php?id="+<?php echo $id?>);
			});
		});
	</script>
</head>
<body>
	<?php $asex=array("0"=>"男","1"=>"女");
	  $pt=array("0"=>"涉警","1"=>"涉政","2"=>"涉稳","3"=>"其它","4"=>"涉军");
	  $pb=array("0"=>"泗阳","1"=>"泗洪","2"=>"沭阳","3"=>"宿豫","4"=>"宿城","5"=>"湖滨","6"=>"经开区","7"=>"洋河","8"=>"其它");
	?>
    <div class="page-container Hui-article ml-5" style="top:0;">
	   <table class="table table-border table-bordered table-bg table-hover table-sort">
	   	<tr>
	   		<td colspan="5" style="text-align:center;font-size:18px;font-weight:bold;" class="list_head list_right">人&nbsp;&nbsp;员&nbsp;&nbsp;信&nbsp;&nbsp;息</td>
	   	</tr>
	   	<tr>
	   		<td class="text-c firtd" style="width:17%">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</td>
	   		<td class="text-c sectd infofont" style="width:23%"><?=$ename?></td>
	   		<td class="text-c thrtd" style="width:17%">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</td>
	   		<td class="text-c foutd infofont" style="width:23%"><?echo $asex[$row['Sex']];?></td>
	   		<td class="text-c fivtd list_right" rowspan="5">
	   			<img src="<?=$epic?>" alt="<?=$ename?>" width="100%"/>
	   		</td>
	   	</tr>
	   	<tr>
	   		<td class="text-c firtd">身份证号</td>
	   		<td class="text-c sectd infofont"><?=$ecodeid?></td>
			<td class="text-c firtd">归&nbsp;属&nbsp;地</td>
	   		<td class="text-c sectd infofont"><?php echo $pb[$eplacebelong];?></td> 
	   	</tr>
	   	<tr>
		    <td class="text-c thrtd">工作单位</td>
	   		<td class="text-c foutd infofont" colspan="3"><?=$eworkunit?></td>
		</tr>
		<tr>
	   		<td class="text-c firtd">户&nbsp;籍&nbsp;地</td>
	   		<td class="text-c sectd infofont" colspan="3"><?=$edomicile?></td>
		</tr>
		<tr>
	   		<td class="text-c thrtd">现&nbsp;住&nbsp;地</td>
	   		<td class="text-c foutd infofont" colspan="3"><?=$elivingplace?></td>
	   	</tr>
	   	<tr>
	   		<td class="text-c firtd">人员属性</td>
	   		<td class="text-c sectd infofont"><?php echo $pt[$row['PersonType']];?></td>
	   		<td class="text-c thrtd">联系方式</td>
			<td class="text-c foutd infofont"><?=$ephone?></td>
			<td class="list_right"></td>   
	   	</tr>
	   	<tr>
	   		<td colspan="5" class="list_right"></td>
	   	</tr>
		</table>
		<table class="table table-border table-bordered table-bg table-hover table-sort">
	   	<tr>
	   		<td colspan="5" style="text-align:center;font-size:18px;font-weight:bold;" class="list_right">人员虚拟身份关联信息</td>
	   	</tr>
		<tr>
			<td class="text-c fivtd" style="width:17%" rowspan="2">
	   			微&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;信
	   		</td>
	   		<td class="text-c firtd" style="width:23%">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</td>
	   		<td class="text-c sectd infofont" style="width:17%"><?=$ewename?></td>
			<td class="text-c firtd" style="width:23%">I&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D</td>
	   		<td class="text-c sectd infofont list_right"><?=$eweid?></td>
	   	</tr>
	   	<tr>
		    <td class="text-c thrtd">群&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号</td>
	   		<td class="text-c foutd infofont"><?=$ewegroup?></td>
	   		<td class="text-c thrtd">帖&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文</td>
			<td class="text-c firtd infofont list_right"><?php if(in_array(0,$postarr)):?><a href="articleinfo.php?userid=<?=$id?>&posttype=0" style="color:#06c" target="_blank"><u>浏览</u></a><?php endif;?></td>
	   	</tr>
		<tr>
	   		<td colspan="5" class="list_right"></td>
	   	</tr>
	   	<tr>
		    <td class="text-c fivtd" rowspan="2">
	   			Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q
	   		</td>
	   		<td class="text-c firtd">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</td>
	   		<td class="text-c sectd infofont"><?=$eqqname?></td>
			<td class="text-c firtd">I&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D</td>
			<td class="text-c sectd infofont list_right"><?=$eqqid?></td>
	   	</tr>
	   	<tr>
	   		<td class="text-c thrtd">群&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号</td>
			<td class="text-c foutd infofont"><?=$eqqgroup?></td>
	   		<td class="text-c thrtd">帖&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文</td>
	   		<td class="text-c sectd infofont list_right"><?php if(in_array(1,$postarr)):?><a href="articleinfo.php?userid=<?=$id?>&posttype=1" style="color:#06c" target="_blank"><u>浏览</u></a><?php endif;?></td>
	   	</tr>
		<tr>
	   		<td colspan="5" class="list_right"></td>
	   	</tr>
		<tr>
			<td class="text-c fivtd" rowspan="2">
	   			微&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;博
	   		</td>
	   		<td class="text-c firtd">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</td>
	   		<td class="text-c sectd infofont"><?=$eblogname?></td>
			<td class="text-c firtd">I&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D</td>
	   		<td class="text-c sectd infofont list_right"><?=$eblogid?></td>
	   	</tr>
	   	<tr>
		    <td class="text-c thrtd">账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号</td>
	   		<td class="text-c foutd infofont"><?=$eblognumber?></td>
	   		<td class="text-c thrtd">帖&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文</td>
	   		<td class="text-c thrtd infofont list_right"><?php if(in_array(2,$postarr)):?><a href="articleinfo.php?userid=<?=$id?>&posttype=2" style="color:#06c" target="_blank"><u>浏览</u></a><?php endif;?></td>
	   	</tr>
		<tr>
	   		<td colspan="5" class="list_right"></td>
	   	</tr>
		<tr>
			<td class="text-c fivtd" rowspan="1">
	   			网站论坛
	   		</td>
	   		<td class="text-c firtd">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</td>
	   		<td class="text-c sectd infofont"><?=$ebbsname?></td>
	   		<td class="text-c thrtd">帖&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文</td>
	   		<td class="text-c foutd infofont list_right"><?php if(in_array(3,$postarr)):?><a href="articleinfo.php?userid=<?=$id?>&posttype=3" style="color:#06c" target="_blank"><u>浏览</u></a><?php endif;?></td>
	   	</tr>
		<tr>
	   		<td colspan="5" class="list_right"></td>
	   	</tr>
		<tr>
			<td class="text-c fivtd" rowspan="1">
	   			微信公众号
	   		</td>
	   		<td colspan="4" class="text-c sectd infofont list_right"><?=$ewepubname?></td>
	   	</tr>
		</table>
		</br>
		<input class="printbtn" type="button" style="margin:0 350px;float:right;background-color: #D7E8FF;PADDING:2px 6px" value="打印该页"/>
	</div>
</body>
</html>
