<?php
require_once 'session.php';
require_once "lib/mysql_class.php";
header("Content-Type:text/html; charset=utf-8");
$id=$_REQUEST['id'];//存在说明是编辑
$userid=$_REQUEST['userid'];

if ($id)
{
	$mysql->query("SELECT * FROM postinfo WHERE PostID=$id");
	$result=$mysql->result;
	while($row=mysql_fetch_array($result)){
		$eposttitle=$row['PostTitle'];
		$epostcon=$row['PostCon'];
		$epostimg=$row['PostImg'];
		$epostimg2=$row['PostImg2'];
		$eposttype=$row['PostType'];
		$estarttime=$row['StartTime'];
		$epostsource=$row['PostSource'];
		$epostpersontype=$row['PersonType'];
		$epostplace=$row['PostPlace'];
		break;
	}
}

if(isset($_REQUEST['sa'])&&$_REQUEST['sa']=='saveinfo'){
	$id==$_REQUEST['id'];
	$userid=$_REQUEST['userid'];
	$posttype=$_REQUEST['posttype'];
	$startime=$_REQUEST['startime'];
	$posttitle=$_REQUEST['posttitle'];
	$postcon=$_REQUEST['postcon'];
	$postsource=$_REQUEST['postsource'];
	$postplace=$_REQUEST['postplace'];
	$postimg=$_REQUEST['textfield'];
	$postpersontype=$_REQUEST['persontype'];
	try {
		
		if (empty($id))
		{
			//添加
			$mysql->query("INSERT INTO `postinfo`(`PostTitle`, `PostCon`,`PostSource`, `PostType`, `StartTime`, `UserID`,`PersonType`,`PostImg`,`PostPlace`) 
					VALUES ('$posttitle','$postcon','$postsource',$posttype,'$startime',$userid,$postpersontype,'$postimg','$postplace')");
		}
		else
		{
			//编辑
			$mysql->query("UPDATE `postinfo` SET `PostTitle`='$posttitle',`PostCon`='$postcon',`PostSource`='$postsource',`PostType`=$posttype,`StartTime`='$startime',`PersonType`=$postpersontype,`PostImg`='$postimg',`PostPlace`='$postplace'  WHERE `PostID`=$id");
		}
		layer_message("保存成功");
		exit;
	} catch (Exception $e) {
		layer_message("系统出错");
		exit;
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
    <script src="DatePicker/WdatePicker.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
	<style type="text/css">
        .file-box{ position:relative;margin-left:4px}
        .txt{ border:1px solid #cdcdcd; width:203px;height:25px;}
        .file{ position:absolute; top:0; right:127px; height:30px; filter:alpha(opacity:0);opacity: 0;width:60px }
    	.btn{height:25px;font-size:12px}
    </style>
</head>
<body>
	<script type="text/javascript">
        $('document').ready(function(){
            $('#upload').click(function(){
                document.mform.action="multiupload.php";
                document.mform.target="state";
                document.mform.submit();
            });
            $('#save').click(function(){
                document.mform.action="?";
                document.mform.target="";
                document.mform.submit();
            });
        });
    </script>
    <div class="page-container Hui-article ml-5" style="top:0;">
    <form name="mform" action="?" method="post" enctype="multipart/form-data">
       <input name="sa" type="hidden" value="saveinfo"/>
	   <table class="table table-border table-bordered table-bg table-hover table-sort">
		<tr>
			<td class="text-r">贴文类型：</td>
			<td class="text-l">
				<select class="" name="posttype" style="border:1px solid #999;margin-left:.3em;width:205px;height: 25px;">
					<option value="0" <?=$eposttype==0&&$eposttype!=''&&isset($eposttype)?'selected':''?>>微信</option>
					<option value="1" <?=$eposttype==1?'selected':''?>>QQ</option>
					<option value="2" <?=$eposttype==2?'selected':''?>>微博</option>
					<option value="3" <?=$eposttype==3?'selected':''?>>网站论坛</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="text-r">人员属性：</td>
			<td class="text-l">
				<select class="" name="persontype" style="border:1px solid #999;margin-left:.3em;width:205px;height: 25px;">
					<option value="0" <?=$epostpersontype==0&&$epostpersontype!=''&&isset($epostpersontype)?'selected':''?>>涉警</option>
					<option value="1" <?=$epostpersontype==1?'selected':''?>>涉政</option>
					<option value="2" <?=$epostpersontype==2?'selected':''?>>涉稳</option>
					<option value="4" <?=$epostpersontype==4?'selected':''?>>涉军</option>
					<option value="3" <?=$epostpersontype==3?'selected':''?>>其它</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="text-r">帖子标题：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="posttitle" name="posttitle" value="<?=$eposttitle?>" style="width:205px;height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
			<td class="text-r">帖子内容：</td>
			<td class="text-l">
				&nbsp;<textarea rows="5" cols="40" name="postcon"><?=$eposttitle?></textarea>
			</td>
		</tr>
		<tr>
            <td class="text-r">帖子图片：</td>
            <td class="text-l">
            	<div class="file-box">
                <input type='text' name='textfield' id='textfield' class='txt' value="<?=$epostimg?>"/>
                <input type='button' class='btn' value='浏览...' />
                <input type="file" name="file[]" multiple class="file" multiple="true" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" />
                <input type="button" name="upload" id="upload" class="btn" value="上传" /><span>&nbsp;<iframe name="state" src="multiupload.php" style="border:none;height:24px;width:100px;display:none"></iframe></span>
             	</div>
            </td>
        </tr>
		<tr>
			<td class="text-r">帖子来源：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="postsource" name="postsource" value="<?=$epostsource?>" style="width:205px;height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
			<td class="text-r">发帖地点：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="postplace" name="postplace" value="<?=$epostplace?>" style="width:205px;height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
			<td class="text-r">发文时间：</td>
			<td class="text-l">
				&nbsp;<input type="text" name="startime" id="startime" class="input-text" style="width:205px;height:25px" value="<?=empty($estarttime)?'':$estarttime?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});"></input>
			</td>
		</tr>
		<tr class="text-c">
			<td colspan="2" align="center" >
			<input type="submit" id="save" style="margin-top:.5em" class="btn btn-primary size-S radius"  value="提交"/>
			<input type="hidden" name="userid" value="<?=$userid?>"></input>
			<input type="hidden" name="id" value="<?=$id?>"></input>
			</td>
		</tr>
		</table>
	</form>
	</div>
</body>
</html>
