<?php
require_once 'session.php';
require_once "lib/mysql_class.php";
header("Content-Type:text/html; charset=utf-8");
$level=$_SESSION['level'];

	$posttype=$_REQUEST['posttype'];
	$title=$_REQUEST['title'];
	$con=$_REQUEST['con'];
	$sourc=$_REQUEST['sourc'];
	$persontype=$_REQUEST['persontype'];
	$place=$_REQUEST['place'];
	$where="1=1";
	if ($title){
		$where.=" AND PostTitle like '%$title%'";
  	}
	if (isset($posttype)&&$posttype!=''){
		$where.=" AND PostType =$posttype";
  	}
  	if ($con){
  		$where.=" AND PostCon like '%$con%'";
  	}
  	if ($sourc){
  		$where.=" AND PostSource like '%$sourc%'";
	}
	if (isset($persontype)&&$persontype!=''){
		$where.=" AND PersonType = $persontype";
	}
	if ($place){
		$where.=" AND PostPlace like '%$place%'";
	}
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
 <script type="text/javascript">
		$(function(){
			$("#addmulinfo").click(function(){
				layer.closeAll(); 
				layer.open({
					type: 2,
					title: '批量导入',
					shade: 0.6,
					shadeClose: true,
					maxmin: true, //开启最大化最小化按钮
					area: ['550px', '500px'],
					content: 'addmulpost.php'
				});
			});
		});
		function editinfo(id)
		{
			layer.closeAll(); 
  		    layer.open({
  		      type: 2,
  		      title: '信息修改',
    		  shade: 0.6,
  		      shadeClose: true,
  		      maxmin: true, //开启最大化最小化按钮
  		      area: ['550px', '500px'],
  		      content: 'addpost.php?id='+id
  		    });
		}
		//删除
		function delinfo(id)
		{
			var tip="确定要删除该信息吗？";
			layer.confirm(tip, {
				  	btn: ['确定','取消'] //按钮
			}, function(){
				layer.closeAll();
				layer.load();
				$.ajax({
	     	         type: "POST",
	     	         url: "postdel.php?id="+id,
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
	.lb{float: left;width: 65px;line-height: 25px;text-align: left;margin-top:.5em}
	#userdiv .rt{float: left;line-height: 20px;text-align: left;margin-top:.5em}
	.clearb{clear:both;margin:1em 0;}
	.table th,.table td{line-height:15px;}
	.nextprev{color:#06c}
</style>
</head>
<body>
<?php $a=array("0"=>"微信","1"=>"QQ","2"=>"微博","3"=>"网站论坛");
	$pt=array("0"=>"涉警","1"=>"涉政","2"=>"涉稳","3"=>"其它","4"=>"涉军");	
?>
 <table width="100%" height="100%" style="border:1px #c4d5e0 solid" cellpadding="2" cellspacing="2"> 
 	<tr>
		<td background="" height="30" style=" border-bottom:1px #c4d5e0 dashed">
		导航>>帖子管理   <input type="button" value="重新加载页面" onclick="window.location.reload()" /> 
		</td>
	</tr>
	<tr>
		<td id="userdiv">
			<form action="?" method="post" style="margin:0 40px;">
			<p>
				<label class="lb">贴文类型：</label>
				<select class="rt" name="posttype" style="border:1px solid #999;margin-right:2em;width:134px;height: 25px;">
					<option value="" <?=$posttype==""?'selected':''?>>-----请选择-----</option>
					<option value="0" <?=$posttype==0&&$posttype!=''&&isset($posttype)?'selectedselected':''?>>微信</option>
					<option value="1" <?=$posttype==1?'selected':''?>>QQ</option>
					<option value="2" <?=$posttype==2?'selected':''?>>微博</option>
					<option value="3" <?=$posttype==3?'selected':''?>>网站论坛</option>
				</select>
				<label class="lb">人员属性：</label>
				<select class="rt" name="persontype" style="border:1px solid #999;margin-right:2em;width:134px;height: 25px;">
					<option value="" <?=$persontype==""?'selected':''?>>-----请选择-----</option>
					<option value="0" <?=$persontype==0&&$persontype!=''&&isset($persontype)?'selectedselected':''?>>涉警</option>
					<option value="1" <?=$persontype==1?'selected':''?>>涉政</option>
					<option value="2" <?=$persontype==2?'selected':''?>>涉稳</option>
					<option value="4" <?=$persontype==4?'selected':''?>>涉军</option>
					<option value="3" <?=$persontype==3?'selected':''?>>其它</option>
				</select>
				<label class="lb">发帖地点：</label><input class="rt" name="place" type="text" value="<?php echo $postplace; ?>"/>
				<label class="lb">标题：</label><input class="rt" name="title" type="text" value="<?php echo $posttitle; ?>"/>
				<label class="lb">内容：</label><input class="rt" type="text" name="con"  value="<?php echo $postcon; ?>"/>
				<label class="lb">来源：</label><input class="rt" type="text" name="sourc"  value="<?php echo $sourc; ?>"/>
				<input class="rt" type="submit" style="background-color: #D7E8FF;PADDING:2px 6px" value="查询"/>
			</p>
			<p class="clearb">
				<input type="button" id="addmulinfo" style="background-color: #D7E8FF;PADDING:2px 6px;margin-top:10px;margin-left:20px" value="批量导入"/>
			</p>
			</form>
		</td>
	</tr>
	
	<tr>
		<td height="560" valign="top" align="center">
		<table style="width:98%;margin-left:1%" class="table table-border table-bordered table-bg table-hover table-sort"  cellpadding="3" cellspacing="1">
		  <thead class="text-c">  
			<tr>
				<th height="20" class="list_head" align="center">ID</th>
				<th height="20" class="list_head" align="center">帖子标题</th>
				<th height="20" class="list_head" align="center">帖子类型</th>
				<th height="20" class="list_head" align="center">发帖地点</th>
				<th height="20" class="list_head" align="center">发布时间</th>
				<th height="20" class="list_head" align="center">所属用户</th>
				<th height="20" class="list_head" align="center">人员属性</th>
				<th height="20" class="list_head" align="center">操作</th>
			</tr>
		  </thead>
			<?php				
				$pageSize=20;
		        $page=1;
		        $count=$mysql->total("SELECT count(*) FROM postinfo WHERE $where");
		        $pageNo=ceil($count/$pageSize);
		        if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page=1;}
		        if($page<=0)$page=1;
		        if($page>$pageNo&&$pageNo!=0){$page=$pageNo;}
        		$limit=" LIMIT ".(($page-1)*$pageSize).",".$pageSize;
				$mysql->query("SELECT * FROM postinfo WHERE $where ORDER BY PostID DESC $limit");
				$result=$mysql->result;
				while($row=mysql_fetch_array($result)){
					$userid=$row['UserID'];
					$mysql->query("SELECT Name FROM netizeninfo WHERE ID=$userid");
					$res=$mysql->result;
					while($rows=mysql_fetch_array($res)){
				?>
			<tbody class="text-c">
			<tr>
				<td align="center"><?php echo $row['PostID'];?></td>
				<td align="center"><?php echo $row['PostTitle'];?></td>
				<td align="center"><?php echo $a[$row['PostType']];?></td>
				<td align="center"><?php echo $row['PostPlace'];?></td>
				<td align="center"><?php echo $row['StartTime'];?></td>
				<td align="center"><?php echo $rows['Name'];?></td>
				<td align="center"><?php echo $pt[$row['PersonType']];?></td>
				<td align="center">
					<a href="articleinfo.php?id=<?php echo $row['PostID'];?>" style="color:#06c" target="_blank">查看</a>
					<?php if (empty($level)&&isset($level)):?>
					<a href="javascript:void(0);" style="color:#06c" onclick="editinfo(<?php echo $row['PostID'];?>)">编辑</a>
					<a href="javascript:void(0);" style="color:#06c" onclick="delinfo(<?php echo $row['PostID'];?>)">删除</a>
					<?php endif;?>
				</td>
			</tr>
			</tbody>
		<?php }}?>
	  </table>
	  <div class="page" style="margin:0 100px">
	  <script charset="utf-8" src="js/jquery-1.4.4.min.js"></script>
	  <form action="?" method="post" id="serach">
	  <input type="hidden" name="page" id="page" />
	  <input type="hidden" name="posttype" value="<?php echo $posttype; ?>" />
	  <input type="hidden" name="title" value="<?php echo $title; ?>" />
	  <input type="hidden" name="con" value="<?php echo $con; ?>" />
	  <input type="hidden" name="sourc" value="<?php echo $sourc; ?>" />
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