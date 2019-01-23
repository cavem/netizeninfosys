<?php
require_once 'session.php';
require_once "lib/mysql_class.php";
header("Content-Type:text/html; charset=utf-8");
$id=$_REQUEST['id'];//存在说明是编辑或查看
if($_POST["code"]=='1'){
	$_SESSION['addcount']++;
}
if ($id)
{
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
		$ewriteperson=$row['WritePerson'];
		$ewepubname=$row['WePubName'];
		break;
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
    <style type="text/css">
        .file-box{ position:relative;margin-left:4px}
        .txt{ border:1px solid #cdcdcd; width:203px;height:25px;}
        .file{ position:absolute; top:0; left:210px; height:30px; filter:alpha(opacity:0);opacity: 0;width:60px }
    	.btn{height:25px;font-size:12px}
		input[type="text"]{width:320px;}
    </style>
    <script type="text/javascript">
        $('document').ready(function(){
            $('#upload').click(function(){
                document.mform.action="uploadpic.php";
                document.mform.target="state";
                document.mform.submit();
            });
            $('#save').click(function(){
				var textfield=$("#textfield").val();
				var mobile=$("#phone").val();
				var code=$("#codeid").val();
				var weid=$("#weid").val();
				var qqid=$("#qqid").val();
				var blogid=$("#blogid").val();
				var bbsname=$("#bbsname").val();
				var writeperson=$("#writeperson").val();
				if(textfield.indexOf("uploadpic")==-1){
				　　alert('请点击上传图片！');
					return;
				}
				if(code.length!=18) 
				{ 
					alert('身份证号格式错误！'); 
					return; 
				}
				if(weid==""&&qqid==""&&blogid==""&&bbsname==""){
					alert('虚拟身份不能全为空！');
					return;
				}
				if(writeperson==""){
					alert("录入人不能为空！");
					return;
				}
				$.post('editinfo.php',{"code":'1'},function(data,status){

				})
                document.mform.action="infosave.php";
                document.mform.target="";
                document.mform.submit();
            });
        });
    </script>
</head>
<body>
    <div class="page-container Hui-article ml-5" style="top:0">
    <form name="mform" action="?" method="post" enctype="multipart/form-data">
       <input name="sa" type="hidden" value="saveinfo"/>
	   <table class="table table-border table-bordered table-bg table-hover table-sort">
		<tr>
            <td class="text-l">照片上传：</td>
            <td class="text-l">
            	<div class="file-box">
                <input type='text' name='textfield' id='textfield' class='txt' style="width:203px;" value="<?=$epic?>"/>
                <input type='button' class='btn' value='浏览...' />
                <input type="file" name="file" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" />
                <input type="button" name="upload" id="upload" class="btn" value="上传" /><span>&nbsp;<iframe name="state" src="uploadpic.php" style="border:none;height:24px;width:100px;display:none"></iframe></span>
             	</div>
            </td>
        </tr>
		<tr>
			<td class="text-l">姓名：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="username" name="username" value="<?=$ename?>" style="height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
		    <td class="text-l">性别：</td>
		    <td class="text-l" style="padding-left:.8em">
		    <input type="radio" id="s1" name="sex" style="vertical-align:middle;" <?=$esex==0?'checked="checked"':''?> value="0"/><label for="s1">男</label>&nbsp;
		    <input type="radio" id="s2" name="sex" style="vertical-align:middle" <?=$esex==1?'checked="checked"':''?> value="1"/><label for="s2">女</label>
		    </td>
		</tr>
		<tr>
		    <td class="text-l">人员属性：</td>
		    <td class="text-l" style="padding-left:.8em">
		    <input type="radio" id="p1" name="persontype" style="vertical-align:middle;" <?=$epersontype==0?'checked="checked"':''?> value="0"/><label for="p1">涉警</label>&nbsp;
		    <input type="radio" id="p2" name="persontype" style="vertical-align:middle" <?=$epersontype==1?'checked="checked"':''?> value="1"/><label for="p2">涉政</label>&nbsp;
			<input type="radio" id="p3" name="persontype" style="vertical-align:middle;" <?=$epersontype==2?'checked="checked"':''?> value="2"/><label for="p3">涉稳</label>&nbsp;
			<input type="radio" id="p5" name="persontype" style="vertical-align:middle;" <?=$epersontype==4?'checked="checked"':''?> value="4"/><label for="p5">涉军</label>&nbsp;
		    <input type="radio" id="p4" name="persontype" style="vertical-align:middle" <?=$epersontype==3?'checked="checked"':''?> value="3"/><label for="p4">其它</label>
		    </td>
		</tr>
		<tr>
		    <td class="text-l">归属地：</td>
		    <td class="text-l" style="padding-left:.8em">
		    <input type="radio" id="b1" name="placebelong" style="vertical-align:middle;" <?=$eplacebelong==0?'checked="checked"':''?> value="0"/><label for="b1">泗阳</label>&nbsp;
		    <input type="radio" id="b2" name="placebelong" style="vertical-align:middle" <?=$eplacebelong==1?'checked="checked"':''?> value="1"/><label for="b2">泗洪</label>&nbsp;
			<input type="radio" id="b3" name="placebelong" style="vertical-align:middle;" <?=$eplacebelong==2?'checked="checked"':''?> value="2"/><label for="b3">沭阳</label>&nbsp;
		    <input type="radio" id="b4" name="placebelong" style="vertical-align:middle" <?=$eplacebelong==3?'checked="checked"':''?> value="3"/><label for="b4">宿豫</label>&nbsp;
			<input type="radio" id="b5" name="placebelong" style="vertical-align:middle;" <?=$eplacebelong==4?'checked="checked"':''?> value="4"/><label for="b5">宿城</label>&nbsp;
		    <input type="radio" id="b6" name="placebelong" style="vertical-align:middle" <?=$eplacebelong==5?'checked="checked"':''?> value="5"/><label for="b6">湖滨</label>&nbsp;
			<input type="radio" id="b7" name="placebelong" style="vertical-align:middle;" <?=$eplacebelong==6?'checked="checked"':''?> value="6"/><label for="b7">经开区</label>&nbsp;
			<input type="radio" id="b8" name="placebelong" style="vertical-align:middle" <?=$eplacebelong==7?'checked="checked"':''?> value="7"/><label for="b8">洋河</label>&nbsp;
			<input type="radio" id="b9" name="placebelong" style="vertical-align:middle" <?=$eplacebelong==8?'checked="checked"':''?> value="8"/><label for="b9">其它</label>
		    </td>
		</tr>
		<tr>
			<td class="text-l">身份证号：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="codeid" name="codeid" value="<?=$ecodeid?>" style="height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
			<td class="text-l">户籍地：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="domicile" name="domicile" value="<?=$edomicile?>" style="height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
			<td class="text-l">现住地：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="livingplace" name="livingplace" value="<?=$elivingplace?>" style="height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
			<td class="text-l">工作单位：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="workunit" name="workunit" value="<?=$eworkunit?>" style="height:25px" class="input-text" />
			</td>
		</tr>
		<tr>
			<td class="text-l">微信昵称：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="wename" name="wename" value="<?=$ewename?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">微信ID：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="weid" name="weid" value="<?=$eweid?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">微信群号：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="wegroup" name="wegroup" value="<?=$ewegroup?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">微信公众号：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="wepubname" name="wepubname" value="<?=$ewepubname?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">QQ昵称：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="qqname" name="qqname" value="<?=$eqqname?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">QQ：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="qqid" name="qqid" value="<?=$eqqid?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">QQ群号：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="qqgroup" name="qqgroup" value="<?=$eqqgroup?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">微博昵称：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="blogname" name="blogname" value="<?=$eblogname?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">微博ID：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="blogid" name="blogid" value="<?=$eblogid?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">微博账号：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="blognumber" name="blognumber" value="<?=$eblognumber?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">网站论坛昵称：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="bbsname" name="bbsname" value="<?=$ebbsname?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">手机号：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="phone" name="phone" value="<?=$ephone?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">电子邮箱：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="email" name="email" value="<?=$eemail?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		<tr>
			<td class="text-l">录入人：</td>
			<td class="text-l">
				&nbsp;<input type="text" id="writeperson" name="writeperson" value="<?=$ewriteperson?>" style="height:25px" class="input-text"/>
			</td>
		</tr>
		
		<tr class="text-c">
			<td colspan="2" align="center" >
			<input type="button" id="save" style="margin-top:.5em" class="btn btn-primary size-S radius"  value="提交"/>
			<input type="hidden" name="userid" value="<?php echo $id?>"/>
			</td>
		</tr>
		</table>
		<iframe id="framepic" name="framepic" style="display:none"></iframe>
	</form>
	</div>
<!-- 	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> -->
<!--     <script type="text/javascript" src="layer/layer.js"></script> -->
<!--     <script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>  -->
<!--     <script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script> -->
    
</body>
</html>
