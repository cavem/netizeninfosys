<?php
require_once 'session.php';
require_once "lib/mysql_class.php";
header("Content-Type:text/html; charset=utf-8");
$id=$_REQUEST['id'];//存在说明是编辑
if ($id)
{
	$mysql->query("SELECT * FROM admin_user WHERE AdminID=$id");
	$result=$mysql->result;
	while($row=mysql_fetch_array($result)){
		$ename=$row['AdminName'];
		$elevel=$row['AdminLevel'];
		$emsg=$row['AdminMsg'];
		break;
	}
}

if(isset($_REQUEST['sa'])&&$_REQUEST['sa']=='saveinfo'){
	$id=$_REQUEST['userid'];
	$username=$_REQUEST['username'];
	$pwd=md5($_REQUEST['userpwd']);
	$level=$_REQUEST['level'];
	$msg=$_REQUEST['msg'];
	try {
		if (empty($id))
		{
			//添加
			$mysql->query("INSERT INTO `admin_user`(`AdminName`, `AdminLevel`, `AdminPwd`, `AdminMsg`) 
					VALUES ('$username',$level,'$pwd','$msg')");
		}
		else
		{
			//编辑
			$mysql->query("UPDATE `admin_user` SET `AdminName`='$username',`AdminLevel`=$level,`AdminMsg`='$msg' WHERE `AdminID`=$id");
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
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
</head>
<body>
    <div class="page-container Hui-article ml-5" style="top:0">
    <form name="mform" action="?" method="post">
       <input name="sa" type="hidden" value="saveinfo"/>
	   <table class="table table-border table-bordered table-bg table-hover table-sort">
		
		<tr>
			<td class="text-r">登录名：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="username" name="username" value="<?=$ename?>" style="width:205px;height:25px" class="input-text" />
			</td>
		</tr>
		<?php if (empty($id)):?>
		<tr>
			<td class="text-r">登录密码：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="userpwd" name="userpwd" value="" style="width:205px;height:25px" class="input-text" />
			</td>
		</tr>
		<?php endif;?>
		<tr>
			<td class="text-r">账号等级：</td>
			<td class="text-l">
				<select class="" name="level" style="border:1px solid #999;margin-left:.3em;width:205px;height: 25px;">
					<option value="0" <?=$elevel==0&&$sex!=''&&isset($elevel)?'selected':''?>>管理员</option>
					<option value="1" <?=$elevel==1?'selected':''?>>普通用户</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="text-r">人员姓名：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="msg" name="msg" value="<?=$emsg?>" style="width:205px;height:25px" class="input-text" />
			</td>
		</tr>
		<tr class="text-c">
			<td colspan="2" align="center" >
			<input type="submit" id="save" style="margin-top:.5em" class="btn btn-primary size-S radius"  value="提交"/>
			<input type="hidden" name="userid" value="<?=$id?>"></input>
			</td>
		</tr>
		</table>
	</form>
	</div>
</body>
</html>
