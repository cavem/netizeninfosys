<?php
require_once 'session.php';
require_once "lib/mysql_class.php";
header("Content-Type:text/html; charset=utf-8");
$level=$_SESSION['level'];

	if($_POST['code']=='0'){
		$_SESSION['searchcount']++;
	}
	$username=$_REQUEST['username'];
	$sex=$_REQUEST['sex'];
	$codeid=$_REQUEST['codeid'];
	$wename=$_REQUEST['wename'];
	$weid=$_REQUEST['weid'];
	$wegroup=$_REQUEST['wegroup'];
	$qqname=$_REQUEST['qqname'];
	$qqid=$_REQUEST['qqid'];
	$qqgroup=$_REQUEST['qqgroup'];
	$blogname=$_REQUEST['blogname'];
	$blogid=$_REQUEST['blogid'];
	$blognumber=$_REQUEST['blognumber'];
	$bbsname=$_REQUEST['bbsname'];
	$phone=$_REQUEST['phone'];
	$email=$_REQUEST['email'];
	$persontype=$_REQUEST['persontype'];
	$placebelong=$_REQUEST['placebelong'];
	$writeperson=$_REQUEST['writeperson'];
	$wepubname=$_REQUEST['wepubname'];
	$where="1=1";
	if ($username){
		$where.=" AND Name like '%$username%'";
  	}
	if (isset($sex)&&$sex!=''){
		$where.=" AND Sex =$sex";
  	}
  	if ($codeid){
  		$where.=" AND CodeID ='$codeid'";
  	}
  	if ($wename){
  		$where.=" AND WeNickName ='$wename'";
  	}
  	if ($weid){
  		$where.=" AND WeID ='$weid'";
  	}
  	if ($wegroup){
  		$where.=" AND WeGroupNo ='$wegroup'";
  	}
  	if ($qqname){
  		$where.=" AND QQNickName ='$qqname'";
  	}
  	if ($qqid){
  		$where.=" AND QQ like '%$qqid%'";
  	}
  	if ($qqgroup){
  		$where.=" AND QQGroupNo ='$qqgroup'";
  	}
  	if ($blogname){
  		$where.=" AND BlogNickName ='$blogname'";
  	}
  	if ($blogid){
  		$where.=" AND BlogID ='$blogid'";
  	}
  	if ($blognumber){
  		$where.=" AND BlogNumber ='$blognumber'";
  	}
  	if ($bbsname){
  		$where.=" AND BbsNickName ='$bbsname'";
  	}
  	if ($phone){
  		$where.=" AND Phone ='$phone'";
  	}
  	if ($email){
  		$where.=" AND Email ='$email'";
	}
	if(isset($persontype)&&$persontype!=''){
		$where.=" AND PersonType=$persontype";
	}
	if(isset($placebelong)&&$placebelong!=''){
		$where.=" AND PlaceBelong=$placebelong";
	}
	if ($writeperson){
		$where.=" AND WritePerson='$writeperson'";
	}
	if ($wepubname){
		$where.=" AND WePubName='$wepubname'";
    }  
  	//print_r($where);exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网上办公</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
 <script type="text/javascript">
    $(function() {
		$("#search").click(function(){
			$.post('userlst.php',{'code':'0'},function(data,status){
				
			})
		})
		var arr=new Array();
        $("#addinfo").click(function(){
    		layer.closeAll(); 
      		layer.open({
      		    type: 2,
      		    title: '信息添加',
        		shade: 0.6,
      		    shadeClose: true,
      		    maxmin: true, //开启最大化最小化按钮
      		    area: ['600px', '500px'],
      		    content: 'editinfo.php'
      		});
			$.post('userlst.php',{'code':'1'},function(data,status){
				
			})
        });
		$("#addmulinfo").click(function(){
    		layer.closeAll(); 
      		layer.open({
      		    type: 2,
      		    title: '批量导入',
        		shade: 0.6,
      		    shadeClose: true,
      		    maxmin: true, //开启最大化最小化按钮
      		    area: ['550px', '500px'],
      		    content: 'addmulinfo.php'
      		});
		});
		$("#exportmulinfo").click(function(){
			//$("#loading").css("display","block");
			$.post("excel.php",{'ipav':'1'},
				function(data,status){
					if(data=="end"){
						//$("#loading").css("display","none");
						alert("导出成功!\n点击下载按钮下载该Excel文件");
					}
				}
			);
		});
		//单选
		$(".ckbox").click(function(){
			var userid=$(this).closest('tr').find('.userid').text();
			if($(this).attr('checked')){
				arr.push(userid);
			}else{
				arr.splice($.inArray(userid,arr),1);
			}  
		});
		//全选
		$(".ckall").click(function(){
			if($(this).attr("checked")){
				$(".ckbox").attr("checked",true);
				$(".userid").each(function(){
					arr.push($(this).text());
				});
			}else{
				$(".ckbox").attr("checked",false);
				arr=[];
			}
		});
		//批量导出
		$("#exportsome").click(function(){
			if(arr==""){
				alert("请选择需要导出的信息");
			}else{
				$.post("excel.php",{ar:JSON.stringify(arr)},function(data,status){
					if(data=="success"){
						alert("\t\t\t导出成功!\n可继续导出或点击下载按钮下载该Excel文件");
					}
				});
			}
			
		});
		//清空文件
		$("#del").click(function(){
			$.post("excel.php",{"del":"1"},function(data){
				if(data=="success"){
					alert("已清空");
				}
			});
		});

    });
        function info(id)
		{
			layer.closeAll(); 
  		    layer.open({
  		      type: 2,
  		      title: '信息查看',
    		  shade: 0.6,
  		      shadeClose: true,
  		      maxmin: true, //开启最大化最小化按钮
  		      area: ['800px', '500px'],
  		      content: 'infolook.php?id='+id
  		    });
		}
		function editinfo(id)
		{
			layer.closeAll(); 
  		    layer.open({
  		      type: 2,
  		      title: '信息修改',
    		  shade: 0.6,
  		      shadeClose: true,
  		      maxmin: true, //开启最大化最小化按钮
  		      area: ['600px', '500px'],
  		      content: 'editinfo.php?id='+id
  		    });
		}
		function addpost(id)
		{
			layer.closeAll(); 
  		    layer.open({
  		      type: 2,
  		      title: '贴文信息添加',
    		  shade: 0.6,
  		      shadeClose: true,
  		      maxmin: true, //开启最大化最小化按钮
  		      area: ['550px', '500px'],
  		      content: 'addpost.php?userid='+id
  		    });
		}
		//删除
		function delinfo(id)
		{
			var tip="确定要删除该人员信息吗？";
			layer.confirm(tip, {
				  	btn: ['确定','取消'] //按钮
			}, function(){
				layer.closeAll();
				layer.load();
				$.ajax({
	     	         type: "POST",
	     	         url: "infodel.php?id="+id,
	     	         success: function(msg){
		     	         if(msg==0)
	         	         {
		         	        layer.closeAll(); 
	         	        	layer.msg('删除成功', {icon: 1}); 
	         	        	window.location.href='?';
	         	        	return;
	             	     }
		     	         else if(msg==1)
	         	         {
	         	        	layer.closeAll(); 
	         	        	layer.msg('系统出错', {icon: 2});
	         	        	return;
	             	     }
	         	         else if(msg==2)
	           	         {
	    	         	    //token过期
	           	        	layer.closeAll(); 
	           	        	layer.msg('token过期，请重新登录', {icon: 5}); 
	           	        	parent.location.reload();
	           	        	return;
	               	     }
	     	         }
	     		})
			}, function(){
				layer.closeAll(); 
			});
		}
 </script>
<style>
	p{white-space:nowrap;}
	p input{margin-right:2em}
	.lb{float: left;width: 70px;line-height: 25px;text-align: left;margin-top:.5em}
	#userdiv .rt{float: left;line-height: 20px;text-align: left;margin-left:auto;margin-top:.5em}
	.clearb{clear:both;margin:1em 0;}
	.table th,.table td{line-height:15px;}
	.nextprev{color:#06c}
	a:hover{background-color:yellow;}
	.table-bordered th, .table-bordered td {border-left: 1px solid #555;}
	.table-border th, .table-border td {border-bottom: 1px solid #555;}
	.list_head{border-top:1px solid #555;}
	.list_right{border-right:1px solid #555;}
</style>
</head>
<body>
 <?php $pt=array("0"=>"涉警","1"=>"涉政","2"=>"涉稳","3"=>"其它","4"=>"涉军 ");
		$pb=array("0"=>"泗阳","1"=>"泗洪","2"=>"沭阳","3"=>"宿豫","4"=>"宿城","5"=>"湖滨","6"=>"经开区","7"=>"洋河","8"=>"其它");
 ?>
 <table width="100%" height="100%" style="border:1px #c4d5e0 solid" cellpadding="2" cellspacing="2"> 
 	<tr>
		<td background="" height="30" style=" border-bottom:1px #c4d5e0 dashed">
		导航>>网民信息管理   <input type="button" value="重新加载页面" onclick="window.location.reload()" /> 
		</td>
	</tr>
	<tr>
		<td id="userdiv">
			<form action="?" method="post" style="margin:0 50px">
			<p>
				<label class="lb">姓名：</label><input type="text" class="rt" name="username"  value="<?php echo $username; ?>"/>
				<label class="lb">性别：</label>
				<select class="rt" name="sex" style="border:1px solid #999;margin-right:2em;width:134px;height: 25px;">
					<option value="" <?=$sex==""?'selected':''?>>-----请选择-----</option>
					<option value="0" <?=$sex==0&&$sex!=''&&isset($sex)?'selected':''?>>男</option>
					<option value="1" <?=$sex==1?'selected':''?>>女</option>
				</select>
				<label class="lb">人员属性：</label>
				<select class="rt" name="persontype" style="border:1px solid #999;margin-right:2em;width:134px;height: 25px;">
					<option value="" <?=$persontype==""?'selected':''?>>-----请选择-----</option>
					<option value="0" <?=$persontype==0&&$persontype!=''&&isset($persontype)?'selected':''?>>涉警</option>
					<option value="1" <?=$persontype==1?'selected':''?>>涉政</option>
					<option value="2" <?=$persontype==2?'selected':''?>>涉稳</option>
					<option value="4" <?=$persontype==4?'selected':''?>>涉军</option>
					<option value="3" <?=$persontype==3?'selected':''?>>其它</option>
				</select>
				<label class="lb">身份证号：</label><input class="rt" name="codeid" type="text" value="<?php echo $codeid; ?>"/>
				<label class="lb">微信昵称：</label><input class="rt" type="text" name="wename"  value="<?php echo $wename; ?>"/>
				<label class="lb">微信ID：</label><input class="rt" type="text" name="weid"  value="<?php echo $weid; ?>"/>
			</p>
			<p class="clearb">
				<label class="lb">微信群号：</label><input class="rt" type="text" name="wegroup"  value="<?php echo $wegroup; ?>"/>
				<label class="lb">QQ昵称：</label><input class="rt" type="text" name="qqname"  value="<?php echo $qqname; ?>"/>
				<label class="lb">QQ号：</label><input class="rt" type="text" name="qq"  value="<?php echo $qq; ?>"/>
				<label class="lb">QQ群号：</label><input class="rt" type="text" name="qqgroup"  value="<?php echo $qqgroup; ?>"/>
				<label class="lb">微博昵称：</label><input class="rt" type="text" name="blogname"  value="<?php echo $blogname; ?>"/>
				<label class="lb">微博ID：</label><input class="rt" type="text" name="blogid"  value="<?php echo $blogid; ?>"/>
			</p>
			<p class="clearb">
				<label class="lb">微博账号：</label><input class="rt" type="text" name="blognumber"  value="<?php echo $blognumber; ?>"/>
				<label class="lb">论坛昵称：</label><input class="rt" type="text" name="bbsname"  value="<?php echo $bbsname; ?>"/>
				<label class="lb">手机号：</label><input class="rt" type="text" name="phone"  value="<?php echo $phone; ?>"/>
				<label class="lb">电子邮箱：</label><input class="rt" type="text" name="email"  value="<?php echo $email; ?>"/>
				<label class="lb">归属地：</label>
				<select class="rt" name="placebelong" style="border:1px solid #999;margin-right:2em;width:134px;height: 25px;">
					<option value="" <?=$placebelong==""?'selected':''?>>-----请选择-----</option>
					<option value="0" <?=$placebelong==0&&$placebelong!=''&&isset($placebelong)?'selected':''?>>泗阳</option>
					<option value="1" <?=$placebelong==1?'selected':''?>>泗洪</option>
					<option value="2" <?=$placebelong==2?'selected':''?>>沭阳</option>
					<option value="3" <?=$placebelong==3?'selected':''?>>宿豫</option>
					<option value="4" <?=$placebelong==4?'selected':''?>>宿城</option>
					<option value="5" <?=$placebelong==5?'selected':''?>>湖滨</option>
					<option value="6" <?=$placebelong==6?'selected':''?>>经发区</option>
					<option value="7" <?=$placebelong==7?'selected':''?>>洋河</option>
					<option value="8" <?=$placebelong==8?'selected':''?>>其它</option>
				</select>
				<label class="lb">录入人：</label><input type="text" class="rt" name="writeperson"  value="<?php echo $writeperson;?>"/>
			</p>
			<p class="clearb">
				<label class="lb">微信公众号</label><input class="rt" type="text" name="wepubname"  value="<?php echo $wepubname; ?>"/>
			</p>
			<p style="text-align:left;clear:both;">
				<input type="submit" style="background-color: #D7E8FF;PADDING:2px 6px" id="search" value="查询"/>
				<input type="button" id="addinfo" style="background-color: #D7E8FF;PADDING:2px 6px;" value="添加信息"/>
				<input type="button" id="addmulinfo" style="background-color: #D7E8FF;PADDING:2px 6px;margin-left:10px" value="批量导入"/>
				<input type="button" id="exportmulinfo" style="background-color: #D7E8FF;PADDING:2px 6px;margin-left:10px" data-toggle="tooltip" data-placement="bottom" title="导出全部人员信息" value="全部导出"/>
				<input type="button" id="exportsome" style="background-color: #D7E8FF;PADDING:2px 6px;margin-left:10px" data-toggle="tooltip" data-placement="bottom" title="导出选中人员信息，导出前建议清空文件" value="批量导出"/>
				<input type="button" id="del" style="background-color: #D7E8FF;PADDING:2px 6px;margin-left:10px" data-toggle="tooltip" data-placement="bottom" title="清空文件" value="清空文件"/>
				<input type="button" id="downmulinfo" style="background-color: #D7E8FF;PADDING:2px 6px;margin-left:10px" onclick="window.location.href='file.xls'" value="下载"/>
 			</p>
			</form>
		</td>
	</tr>
	
	<tr>
		<td height="560" valign="top" align="center">
		<table style="width:98%;margin-left:1%" class="table table-border table-bordered table-bg table-hover table-sort"  cellpadding="3" cellspacing="1">
		  	<thead class="text-c">
			  <tr>
			  	<th height="20" class="list_head" align="center"><label class="qcklb"><input type="checkbox" class="ckall"></label></th>
				<th height="20" class="list_head" align="center">ID</th>
				<th height="20" class="list_head" align="center">姓名</th>
				<th height="20" class="list_head" align="center">性别</th>
				<th height="20" class="list_head" align="center">人员属性</th>
				<th height="20" class="list_head" align="center">归属地</th>
				<th height="20" class="list_head" align="center">身份证号</th>
				<th height="20" class="list_head" align="center">手机号码</th>
				<th height="20" class="list_head" align="center">微信ID</th>
				<th height="20" class="list_head" align="center">微博ID</th>
				<th height="20" class="list_head" align="center">QQ号</th>
				<th height="20" class="list_head" align="center">电子邮箱</th>
				<th height="20" class="list_head" align="center">录入人</th>
				<th height="20" class="list_head" align="center">录入时间</th>
				<th height="20" class="list_head list_right" align="center">操作</th>
			  </tr>
			</thead>
			<tbody class="text-c">
			<?php				
				$pageSize=20;
		        $page=1;
		        $count=$mysql->total("SELECT count(*) FROM netizeninfo WHERE $where");
		        $pageNo=ceil($count/$pageSize);
		        if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page=1;}
		        if($page<=0)$page=1;
		        if($page>$pageNo&&$pageNo!=0){$page=$pageNo;}
        		$limit=" LIMIT ".(($page-1)*$pageSize).",".$pageSize;
				$mysql->query("SELECT * FROM netizeninfo WHERE $where ORDER BY ID DESC $limit");
				$result=$mysql->result;
				while($row=mysql_fetch_array($result)){
				?>
			<tr>
				<td><label class="cklab"><input type="checkbox" class="ckbox"></label></td>
				<td align="center" class="userid"><?php echo $row['ID'];?></td>
				<td align="center"><?php echo $row['Name'];?></td>
				<td align="center"><?php echo empty($row['Sex'])?'男':'女';?></td>
				<td align="center"><?php echo $pt[$row['PersonType']];?></td>
				<td align="center"><?php echo $pb[$row['PlaceBelong']];?></td>
				<td align="center"><?php echo $row['CodeID'];?></td>
				<td align="center"><?php echo $row['Phone'];?></td>
				<td align="center"><?php echo $row['WeID'];?></td>
				<td align="center"><?php echo $row['BlogID'];?></td>
				<td align="center"><?php echo $row['QQ'];?></td>
				<td align="center"><?php echo $row['Email'];?></td>
				<td align="center"><?php echo $row['WritePerson'];?></td>
				<td align="center"><?php echo $row['StartTime'];?></td>
				<td align="center" class="list_right">
					<a href="javascript:void(0);" style="color:#06c" onclick="info(<?php echo $row['ID'];?>)">查看</a>&nbsp;
					<a href="javascript:void(0);" style="color:#06c" onclick="editinfo(<?php echo $row['ID'];?>)">编辑</a>&nbsp;
					<?php if (empty($level)&&isset($level)):?>
					<a href="javascript:void(0);" style="color:#06c" onclick="delinfo(<?php echo $row['ID'];?>)">删除</a>&nbsp;
					<?php endif;?>
					<a href="javascript:void(0);" style="color:#06c" onclick="addpost(<?php echo $row['ID'];?>)">添加帖子信息</a>
				</td>
			</tr>
		<?php }?>
		</tbody>
	  </table>
	   <div class="page" style="margin:0 auto">
	   <script charset="utf-8" src="js/jquery-1.4.4.min.js"></script>
	  <form action="?" method="post" id="serach">
	  <input type="hidden" name="page" id="page" />
	  <input type="hidden" name="username" value="<?php echo $username; ?>" />
	  <input type="hidden" name="sex" value="<?php echo $sex; ?>" />
	  <input type="hidden" name="codeid" value="<?php echo $codeid; ?>" />
	  <input type="hidden" name="wename" value="<?php echo $wename; ?>" />
	  <input type="hidden" name="weid" value="<?php echo $weid; ?>" />
	  <input type="hidden" name="wegroup" value="<?php echo $wegroup; ?>" />
	  <input type="hidden" name="qqname" value="<?php echo $qqname; ?>" />
	  <input type="hidden" name="qqid" value="<?php echo $qqid; ?>" />
	  <input type="hidden" name="qqgroup" value="<?php echo $qqgroup; ?>" />
	  <input type="hidden" name="blogname" value="<?php echo $blogname; ?>" />
	  <input type="hidden" name="blogid" value="<?php echo $blogid; ?>" />
	  <input type="hidden" name="blognumber" value="<?php echo $blognumber; ?>" />
	  <input type="hidden" name="bbsname" value="<?php echo $bbsname; ?>" />
	  <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
	  <input type="hidden" name="email" value="<?php echo $email; ?>" />
	  <input type="hidden" name="persontype" value="<?php echo $persontype; ?>" />
	  <input type="hidden" name="placebelong" value="<?php echo $placebelong; ?>" />
	  <input type="hidden" name="writeperson" value="<?php echo $writeperson; ?>" />
	  <input type="submit" style="display: none;"/>
	  </form>
			<a href='#' onclick="go(1)" class='nextprev'>&laquo;首页</a>
			<a href='#' onclick="go(<?php echo $page-1;?>)" class='nextprev'>&laquo;上一页</a>
			<a href='#' onclick="go(<?php echo $page+1;?>)" class='nextprev'>下一页&raquo;</a>
			<a href='#' onclick="go(<?php echo $pageNo;?>)" class='nextprev'>末页&raquo;</a>
			转到<select id="go" onchange="go(this.value);">
			<?php for($i=1;$i<=$pageNo;$i++){
				echo "<option value=\"$i\">$i</option>";
			}?>
			<script type="text/javascript">
			function onsubmit(page){
				$('#page').val(page);
				$('#serach').submit();
			}
			function go(value){
				$('#page').val(value);
				$('#serach').submit();
			}
			document.getElementById('go').value=<?php echo $page;?>;
			</script>
			</select>
			<span>共<?php echo $pageNo;?>页， <?php echo $count;?> 条记录,每页<?php echo $pageSize;?>条记录</span>
			</div>
		</td>
	</tr>
 </table>
</body>
</html>