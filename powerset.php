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
 <script type="text/javascript">
    $(function() {
        $("#addinfo").click(function(){
    		layer.closeAll(); 
      		layer.open({
      		    type: 2,
      		    title: '账号添加',
        		shade: 0.6,
      		    shadeClose: true,
      		    maxmin: true, //开启最大化最小化按钮
      		    area: ['500px', '300px'],
      		    content: 'editadmininfo.php'
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
  		      area: ['500px', '250px'],
  		      content: 'editadmininfo.php?id='+id
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
	     	         url: "admindel.php?id="+id,
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
	.lb{float: left;width: 110px;line-height: 25px;text-align: right;margin-top:.5em}
	#userdiv .rt{float: left;line-height: 20px;text-align: left;margin-top:.5em}
	.clearb{clear:both;margin:1em 0;}
	.nextprev{color:#06c}
</style>
</head>
<body>
 <table width="100%" height="100%" style="border:1px #c4d5e0 solid" cellpadding="2" cellspacing="2"> 
 	<tr>
		<td background="" height="30" style=" border-bottom:1px #c4d5e0 dashed">
		导航>>权限设置   <input type="button" value="重新加载页面" onclick="window.location.reload()" /> 
		</td>
	</tr>
	<tr>
		<td id="userdiv">
			<p class="clearb" style="float:right">
			<?php if (empty($level)&&isset($level)):?>
				<input type="button" id="addinfo" style="background-color: #D7E8FF;PADDING:2px 6px" value="添加信息"/>
 			<?php endif;?>
 			</p>
		</td>
	</tr>
	
	<tr>
		<td height="560" valign="top" align="center">
		<table style="width:98%;margin-left:1%" class="table table-border table-bordered table-bg table-hover table-sort"  cellpadding="3" cellspacing="1">
			<thead class="text-c">  
			<tr>
				<th height="20" class="list_head" align="center">ID</th>
				<th height="20" class="list_head" align="center">登录名</th>
				<th height="20" class="list_head" align="center">账号等级</th>
				<th height="20" class="list_head" align="center">人员姓名</th>
				<th height="20" class="list_head" align="center">操作</th>
			</tr>
			</thead>
			<?php				
				$pageSize=20;
		        $page=1;
		        $count=$mysql->total("SELECT count(*) FROM admin_user WHERE 1=1");
		        $pageNo=ceil($count/$pageSize);
		        if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page=1;}
		        if($page<=0)$page=1;
		        if($page>$pageNo&&$pageNo!=0){$page=$pageNo;}
        		$limit=" LIMIT ".(($page-1)*$pageSize).",".$pageSize;
				$mysql->query("SELECT * FROM admin_user WHERE 1=1 ORDER BY AdminID DESC $limit");
				$result=$mysql->result;
				while($row=mysql_fetch_array($result)){
				?>
			<tbody class="text-c">
			<tr>
				<td align="center"><?php echo $row['AdminID'];?></td>
				<td align="center"><?php echo $row['AdminName'];?></td>
				<td align="center"><?php echo empty($row['AdminLevel'])?"管理员":"普通用户";?></td>
				<td align="center"><?php echo $row['AdminMsg'];?></td>
				<td align="center">
					<?php if (empty($level)&&isset($level)):?>
					<a href="javascript:void(0);" style="color:#06c" onclick="editinfo(<?php echo $row['AdminID'];?>)">编辑</a>
					<a href="javascript:void(0);" style="color:#06c" onclick="delinfo(<?php echo $row['AdminID'];?>)">删除</a>
					<?php endif;?>
				</td>
			</tr>
			</tbody>
		<?php }?>
	  </table>
	   <div class="page">
	   <script charset="utf-8" src="js/jquery-1.4.4.min.js"></script>
	   <form action="?" method="post" id="serach">
	    	<input type="hidden" name="page" id="page" />
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