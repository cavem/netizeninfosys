<?php
global $mysql;
date_default_timezone_set("Asia/Shanghai");
$mysql=new mysql_class;
$mysql->init('root','caicai525217','localhost','netizendb');

function goto_message($Mesg,$strUrl)
{
	print "
	<script language='javascript'>
		alert('$Mesg');
		window.location.href='$strUrl';
	</script>";
	exit();
}

function layer_message($Mesg)
{
	print "
	<script language='javascript'>
		alert('$Mesg');
		parent.location.reload();
	</script>";
	exit();
}
class mysql_class{
	var $user,$password,$host,$database,$connection;
	var $result,$rows;
	function init ($user,$password,$host,$database) {
		
		$this->user=$user;
		$this->password=$password;
		$this->host=$host;
		$this->database=$database;

		
		$this->connection = @mysql_pconnect($this->host, $this->user, $this->password) or
		message("不能连接到MYSQL服务器: $this->host : '$SERVER_NAME'[登录密码:". $this->pass."]");
		@mysql_select_db($database, $this->connection) or message("不能打开数据库: $database");


		mysql_query("SET character_set_connection='utf8', character_set_results='utf8', character_set_client=utf8", $this->connection);

	}
	
  	function query($sql) {
        $this->result = @mysql_query($sql, $this->connection) or message ("MYSQL语句错误: $sql");
        $this->rows = @mysql_num_rows($this->result);
        //$this->a_rows = @mysql_affected_rows($this->result);
    }
    
    function total($sql){
    	$this->result = @mysql_query($sql, $this->connection) or message ("MYSQL语句错误: $sql");
    	$row=mysql_fetch_array($this->result);
    	return $row[0];
    }
}