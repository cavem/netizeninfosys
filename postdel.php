<?php
	require_once 'session.php';
	require_once "lib/mysql_class.php";
	header("Content-Type:text/html; charset=utf-8");	
	$id=$_REQUEST['id'];
	try {
		$mysql->query("DELETE FROM `postinfo` WHERE PostID=$id");
		echo 0;
		exit;
	} catch (Exception $e) {
		echo 1;
		exit;
	}
	
?>