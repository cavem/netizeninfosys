<?php
	require_once 'session.php';
	require_once "lib/mysql_class.php";
	header("Content-Type:text/html; charset=utf-8");	
	if(isset($_REQUEST['sa'])&&$_REQUEST['sa']=='saveinfo'){
		$id=$_REQUEST['userid'];
		$username=$_REQUEST['username'];
		$sex=$_REQUEST['sex'];
		$codeid=$_REQUEST['codeid'];
		$domicile=$_REQUEST['domicile'];
		$livingplace=$_REQUEST['livingplace'];
		$workunit=$_REQUEST['workunit'];
		$personattr=$_REQUEST['personattr'];
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
		$pic=$_REQUEST['textfield'];
		$persontype=$_REQUEST['persontype'];
		$placebelong=$_REQUEST['placebelong'];
		$writeperson=$_REQUEST['writeperson'];
		$wepubname=$_REQUEST['wepubname'];
		try {
			if (empty($id))
			{
				//添加
				$mysql->query("INSERT INTO `netizeninfo`(`Name`, `Sex`, `CodeID`, `Domicile`, `Livingplace`, `Workunit`, `Personattr`, `WeNickName`, `WeID`, `WeGroupNo`, `QQNickName`, `QQ`, `QQGroupNo`, `BlogNickName`, `BlogID`, `BlogNumber`, `BbsNickName`, `Phone`, `Email`, `Pic`,`PersonType`,`StartTime`,`PlaceBelong`,`WritePerson`,`WePubName`)
						VALUES ('$username',$sex,'$codeid','$domicile','$livingplace','$workunit','$personattr','$wename','$weid','$wegroup','$qqname','$qqid','$qqgroup','$blogname','$blogid','$blognumber','$bbsname','$phone','$email','$pic',$persontype,now(),$placebelong,'$writeperson','$wepubname')");
			}
			else
			{
				//编辑
				$mysql->query("UPDATE `netizeninfo` SET `Name`='$username',`Sex`=$sex,`CodeID`='$codeid',`Domicile`='$domicile',`Livingplace`='$livingplace',`Workunit`='$workunit',`Personattr`='$personattr',`WeNickName`='$wename',`WeID`='$weid',`WeGroupNo`='$wegroup',`QQNickName`='$qqname',`QQ`='$qqid',`QQGroupNo`='$qqgroup',`BlogNickName`='$blogname',`BlogID`='$blogid',`BlogNumber`='$blognumber',`BbsNickName`='$bbsname',`Phone`='$phone',`Email`='$email',`Pic`='$pic',`PersonType`=$persontype,`PlaceBelong`=$placebelong,`WritePerson`='$writeperson' ,`WePubName`='$wepubname' WHERE `ID`=$id");
			}
			layer_message("保存成功");
			exit;
		} catch (Exception $e) {
			layer_message("系统出错");
			exit;
		}
	}
?>