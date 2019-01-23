<?php
require_once 'session.php';
require_once "lib/mysql_class.php";
header("Content-Type:text/html; charset=utf-8");
$id=$_REQUEST['id'];
$userid=$_REQUEST['userid'];
$posttype=$_REQUEST['posttype'];
$postimg=$_REQUEST['postimg'];
$postimg2=$_REQUEST['postimg2'];
$where="1=1";
if ($id)
{
	$where.=" AND PostID =$id";
}
if ($userid)
{
	$where.=" AND UserID=$userid";
}
if (isset($posttype))
{
	$where.=" AND PostType=$posttype";
}
if (isset($postimg))
{
	$where.=" AND PostImg=$postimg";
}
//print_R($where);exit;
?>
<!DOCTYPE html>
<html> 
<head> 
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>帖子记录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/css/client-page1cc06e.css" />
    <link rel="stylesheet" href="/css/article.css" />
    <link media="screen and (min-width:1000px)" rel="stylesheet" href="/css/pc-page1c98c1.css" />
    <style>
        body{ -webkit-touch-callout: none; -webkit-text-size-adjust: none; }
    </style>
    
    <style>
        #nickname{overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width:90%;}
        ol,ul{list-style-position:inside;}
        #activity-detail .page-content .text{font-size:16px;}
		.styletitle
		{
			font-size:17px;
			padding-left:0.3em;
			font-weight:bold;
			font-family:'黑体';
		}
		td{border:solid #FFF 0px;}
    </style>
</head> 

<body id="activity-detail" style="overflow-x:hidden;padding:0;margin-bottom:100px;">
   <?php $pt=array("0"=>"涉警","1"=>"涉政","2"=>"涉稳","3"=>"其它","4"=>"涉军");
         $tt=array("0"=>"微信","1"=>"QQ","2"=>"微博","3"=>"网站论坛");
   ?>
   <img width="12px" style="position: absolute;top:-1000px;" src="http://res.wx.qq.com/mmbizwap/zh_CN/htmledition/images/ico_loading1984f1.gif">
   <div style="padding:0 1em;">
      <div class="page-bizinfo">
          <div class="header">
            <h1 id="activity-name" style="text-align:center;margin-top:1em">负面贴文信息</h1>
          </div>
          <div style="color:gray;font-size:12px;margin-top:10px;float:left"></div>
      </div>
        
      <div id="page-content" class="page-content">
         <div id="img-content">
            <div class="text">
            	<?php
				$mysql->query("SELECT * FROM postinfo WHERE $where ORDER BY StartTime DESC");
				$result=$mysql->result;
				while($row=mysql_fetch_array($result)){
					$userid=$row['UserID'];
					$mysql->query("SELECT Name FROM netizeninfo WHERE ID=$userid");
					$res=$mysql->result;
					$picarr=explode("||",$row['PostImg']);
					while($rows=mysql_fetch_array($res)){
				?>
					<div style="background-color:#ECECEC;margin-bottom:1em">
						<p>发帖人：<?php echo $rows['Name'];?></p>
						<p>人员属性：<?php echo $pt[$row['PersonType']];?></p>
						<p>发帖时间：<?=$row['StartTime']?></p>
						<p>帖子来源：<?=$row['PostSource']?></p>
						<p>发帖地点：<?=$row['PostPlace']?></p>
						<p>帖子类型：<?echo $tt[$row['PostType']];?></p>
						<p>标题：<?=$row['PostTitle']?></p>
						<p>内容：<?=$row['PostCon']?></p>
						<p>图片：<?php for($i=0;$i<count($picarr);$i++){ ?><img style="width:85%;" src="<?=$picarr[$i]?>"/><?php }?></p>
						
					</div>
					
				<?php }}?>
              
			</div>
	     </div>
	  </div>
   </div>
</body>
</html>

