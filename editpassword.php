<?php
	require_once 'session.php';
	require_once "lib/mysql_class.php";
	header("Content-Type:text/html; charset=utf-8");	
	$newpass=$_REQUEST['newpass'];
	$mdpass=md5($newpass);
	$id=$_SESSION['adminid'];
	$mysql->query("UPDATE `admin_user` SET `AdminPwd` = '$mdpass' WHERE `AdminID` = $id");
	echo $newpass;
	exit;
?>