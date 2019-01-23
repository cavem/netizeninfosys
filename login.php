<?php header('P3P: CP="CAO PSA OUR"'); ?>
<?php

session_start();
header("Content-Type:text/html; charset=utf-8");
require_once "lib/mysql_class.php";
if(isset($_REQUEST['ac'])&&$_REQUEST['ac']=='login'){
	$loginName=$_REQUEST['loginname'];
	$password=md5($_REQUEST['password']);
	if($loginName==""||$password==""){
		goto_message("用户名或密码不能为空",'login.php');
		exit;
	}
	else{
		$mysql->query("SELECT AdminID,AdminName,AdminLevel,AdminMsg FROM admin_user WHERE AdminName='$loginName' AND AdminPwd='$password'");
		$result=$mysql->result;
		if ($row=mysql_fetch_array($result)){
			$_SESSION['adminid']=$row['AdminID'];
			$_SESSION['account_name']=$row['AdminName'];
			$_SESSION['level']=$row['AdminLevel'];
			$_SESSION['msg']=$row['AdminMsg'];
			header('location:index.php');
		}
		else{
			goto_message('账号或密码错误,请重新输入.','login.php');
		}
		
	}
}	
$_SESSION['logincount']=0;
$_SESSION['logincount']++;
$_SESSION['searchcount']=0;
$_SESSION['addcount']=0;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD><META content="IE=11.0000" http-equiv="X-UA-Compatible">
<META http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<TITLE>登录页面</TITLE> 
<SCRIPT src="js/jquery-1.9.1.min.js" type="text/javascript"></SCRIPT>
<link rel="stylesheet" type="text/css" href="css/login.css" />
     
<SCRIPT type="text/javascript">
document.onkeydown = function(e) {
    e = e || window.event;
    if(e.keyCode == 13) {
    	$('#Submit').click();
    }
}
$(function(){
	//得到焦点
	$("#password").focus(function(){
		$("#left_hand").animate({
			left: "150",
			top: " -38"
		},{step: function(){
			if(parseInt($("#left_hand").css("left"))>140){
				$("#left_hand").attr("class","left_hand");
			}
		}}, 2000);
		$("#right_hand").animate({
			right: "-64",
			top: "-38px"
		},{step: function(){
			if(parseInt($("#right_hand").css("right"))> -70){
				$("#right_hand").attr("class","right_hand");
			}
		}}, 2000);
	});
	//失去焦点
	$("#password").blur(function(){
		$("#left_hand").attr("class","initial_left_hand");
		$("#left_hand").attr("style","left:100px;top:-12px;");
		$("#right_hand").attr("class","initial_right_hand");
		$("#right_hand").attr("style","right:-112px;top:-12px");
	});
});
</SCRIPT>
 
<META name="GENERATOR" content="MSHTML 11.00.9600.17496"></HEAD> 
<BODY>
<DIV class="top_div"></DIV>
<DIV style="background: rgb(255, 255, 255); margin: -100px auto auto; border: 1px solid rgb(231, 231, 231); border-image: none; width: 400px; height: 200px; text-align: center;">
	<DIV style="width: 165px; height: 96px; position: absolute;">
		<DIV class="tou"></DIV>
		<DIV class="initial_left_hand" id="left_hand"></DIV>
		<DIV class="initial_right_hand" id="right_hand"></DIV>
	</DIV>
	<FORM name="loginfm" action="login.php" method="post">
	<INPUT name="ac" type="hidden" value="login"/>
	<P style="padding: 30px 0px 10px; position: relative;">
		<SPAN class="u_logo"></SPAN>         
		<INPUT class="ipt" type="text" name="loginname" placeholder="请输入用户名或邮箱" value=""> 
    </P>
	<P style="position: relative;"><SPAN class="p_logo"></SPAN>         
		<INPUT class="ipt" id="password" name="password" type="password" placeholder="请输入密码" value="">   
  	</P>
	<DIV style="height: 50px; line-height: 50px; margin-top: 30px; border-top-color: rgb(231, 231, 231); border-top-width: 1px; border-top-style: solid;">
		<P style="margin: 0px 35px 20px 45px;"><SPAN style="float: left;"><!-- <A style="color: rgb(204, 204, 204);" href="#">忘记密码?</A> --></SPAN> 
           <SPAN style="float: right;"><A style="color: rgb(204, 204, 204); margin-right: 10px;" href="#"></A>  
           	  <INPUT type="submit" style="margin-top:10px;background: #3384B2; padding: 7px 10px; border-radius: 4px; border: 1px solid rgb(26, 117, 152); border-image: none; color: rgb(255, 255, 255); font-weight: bold;" value=" 登 录 " id="Submit">
           </SPAN>         
	    </P>
	</DIV>
	</FORM>
</DIV>
<DIV style="text-align:center;"></DIV>
</BODY>
</HTML>
