<?php
    require_once "lib/mysql_class.php";
    set_time_limit(0);
    //字符转码
    function utf_gb($str){
        $encode = mb_detect_encoding($str, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
        //echo $encode;
        if($encode=="UTF-8"){
            $data= iconv("utf-8","gb2312//IGNORE",$str);
        }
        else if($encode="EUC-CN"){
            $data= iconv("gbk","gb2312//IGNORE",$str);
        }
        else if($encode="GB2312"){
            $data=$str;
        }
        return $data;
    }
    function gbk_utf($str){
        $encode = mb_detect_encoding($str, array("ASCII","UTF-8","GB2312","GBK","BIG5"));
        //echo $encode;
        if($encode=="UTF-8"){
            $data=$str;
        }
        else if($encode="EUC-CN"){
            $data= iconv("gbk","utf-8//IGNORE",$str);
        }
        return $data;
    }

    //全部插入
    if(isset($_POST["ipav"])){
        $asex=array("0"=>"男","1"=>"女");
        $pt=array("0"=>"涉警","1"=>"涉政","2"=>"涉稳","3"=>"其它");
        $pb=array("0"=>"泗阳","1"=>"泗洪","2"=>"沭阳","3"=>"宿豫","4"=>"宿城","5"=>"湖滨","6"=>"经开区","7"=>"洋河");
        $file = fopen("file.xls", "w") or die("打开文件失败");        
        $str="姓名\t性别（男填0，女填1）\t归属地\t身份证号\t户籍地\t现住地\t工作单位\t微信昵称\t微信号\t微信群号\tQQ昵称\tQQ号\tQQ群号\t微博昵称\t微博ID\t微博账号\t论坛昵称\t手机号\t电子邮箱\t照片（格式：/uploadpic/照片名.后缀名）\t人员属性（涉警：0，涉政：1，涉稳：2，其它：3）\t\n";
        fwrite($file,utf_gb($str));
        $mysql->query("SELECT `Name`, `Sex`, `CodeID`, `Domicile`, `Livingplace`, `Workunit`, `WeNickName`, `WeID`, `WeGroupNo`, `QQNickName`, `QQ`, `QQGroupNo`, `BlogNickName`, `BlogID`, `BlogNumber`, `BbsNickName`, `Phone`, `Email`, `Pic`,`PersonType`,`PlaceBelong` FROM netizeninfo ORDER BY ID DESC");
        $result=$mysql->result;
        while($row=mysql_fetch_array($result)){
            $name=$row['Name'];
            $sex=$row['Sex'];
            $codeid=$row['CodeID']." ";
            $domicile=$row['Domicile'];
            $livingplace=$row['Livingplace'];
            $workunit=$row['Workunit'];
            $wenickname=$row['WeNickName'];
            $weid=$row['WeID'];
            $wegroup=$row['WeGroupNo'];
            $qqnickname=$row['QQNickName'];
            $qq=$row['QQ'];
            $qqgroupno=$row['QQGroupNo'];
            $blognickname=$row['BlogNickName'];
            $blogid=$row['BlogID'];
            $blogno=$row['BlogNumber'];
            $bbsnick=$row['BbsNickName'];
            $phone=$row['Phone'];
            $email=$row['Email'];
            $pic=$row['Pic'];
            $persontype=$row['PersonType'];
            $placebelong=$row['PlaceBelong'];
            $ss=$name."\t".$asex[$sex]."\t".$pb[$placebelong]."\t"."'".$codeid."\t".$domicile."\t".$livingplace."\t".$workunit."\t".$wenickname."\t".$weid."\t".$wegroup."\t".$qqnickname."\t".$qq."\t".$qqgroupno."\t".$blognickname."\t".$blogid."\t".$blogno."\t".$bbsnick."\t".$phone."\t".$email."\t".$pic."\t".$pt[$persontype]."\t\n";
            fwrite($file, utf_gb($ss));
        }
        echo "end";
    }
    if(isset($_POST["ar"])){
        $ar=json_decode($_POST["ar"]);
        $asex=array("0"=>"男","1"=>"女");
        $pt=array("0"=>"涉警","1"=>"涉政","2"=>"涉稳","3"=>"其它");
        $pb=array("0"=>"泗阳","1"=>"泗洪","2"=>"沭阳","3"=>"宿豫","4"=>"宿城","5"=>"湖滨","6"=>"经开区","7"=>"洋河","8"=>"其它");
        $file = fopen("file.xls", "a+") or die("打开文件失败");        
        foreach($ar as $value){
            $mysql->query("SELECT `Name`, `Sex`, `CodeID`, `Domicile`, `Livingplace`, `Workunit`, `WeNickName`, `WeID`, `WeGroupNo`, `QQNickName`, `QQ`, `QQGroupNo`, `BlogNickName`, `BlogID`, `BlogNumber`, `BbsNickName`, `Phone`, `Email`, `Pic`,`PersonType`,`PlaceBelong` FROM netizeninfo WHERE ID='$value' ORDER BY ID DESC");
            $result=$mysql->result;
            while($row=mysql_fetch_array($result)){
                $name=$row['Name'];
                $sex=$row['Sex'];
                $codeid=$row['CodeID']." ";
                $domicile=$row['Domicile'];
                $livingplace=$row['Livingplace'];
                $workunit=$row['Workunit'];
                $wenickname=$row['WeNickName'];
                $weid=$row['WeID'];
                $wegroup=$row['WeGroupNo'];
                $qqnickname=$row['QQNickName'];
                $qq=$row['QQ'];
                $qqgroupno=$row['QQGroupNo'];
                $blognickname=$row['BlogNickName'];
                $blogid=$row['BlogID'];
                $blogno=$row['BlogNumber'];
                $bbsnick=$row['BbsNickName'];
                $phone=$row['Phone'];
                $email=$row['Email'];
                $pic=$row['Pic'];
                $persontype=$row['PersonType'];
                $placebelong=$row['PlaceBelong'];
                $ss=$name."\t".$asex[$sex]."\t".$pb[$placebelong]."\t"."'".$codeid."\t".$domicile."\t".$livingplace."\t".$workunit."\t".$wenickname."\t".$weid."\t".$wegroup."\t".$qqnickname."\t".$qq."\t".$qqgroupno."\t".$blognickname."\t".$blogid."\t".$blogno."\t".$bbsnick."\t".$phone."\t".$email."\t".$pic."\t".$pt[$persontype]."\t\n";
                fwrite($file, utf_gb($ss));
            }
        }
        echo "success";
    }
    if(isset($_POST["del"])){
        $file = fopen("file.xls", "w") or die("打开失败");
        $str="姓名\t性别（男填0，女填1）\t归属地\t身份证号\t户籍地\t现住地\t工作单位\t微信昵称\t微信号\t微信群号\tQQ昵称\tQQ号\tQQ群号\t微博昵称\t微博ID\t微博账号\t论坛昵称\t手机号\t电子邮箱\t照片（格式：/uploadpic/照片名.后缀名）\t人员属性（涉警：0，涉政：1，涉稳：2，其它：3）\t\n";
        fwrite($file,utf_gb($str));
        echo "success";
    }
?>