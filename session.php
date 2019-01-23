<?php
    session_start();
    ini_set('session.gc_maxlifetime', "43200"); // 秒  
	if($_SESSION['account_name']==''){header('location:login.php');}
?>