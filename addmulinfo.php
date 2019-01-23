<?php
    require_once 'session.php';
    require_once "lib/mysql_class.php";
    header("Content-Type:text/html; charset=utf-8");
    function upExecel(){
        
        //判断是否选择了要上传的表格
        if (empty($_POST['myfile'])) {
            echo "<script>alert(您未选择表格);history.go(-1);</script>";
        }
        
        //获取表格的大小，限制上传表格的大小5M
        $file_size = $_FILES['myfile']['size'];
        if ($file_size>5*1024*1024) {
        echo "<script>alert('上传失败，上传的表格不能超过5M的大小');history.go(-1);</script>";
            exit();
        }
        
        //限制上传表格类型
        /*$file_type = $_FILES['myfile']['type'];
        //application/vnd.ms-excel  为xls文件类型
        if ($file_type!='application/vnd.ms-excel') {
            echo "<script>alert('上传失败，只能上传excel2003的xls格式!');history.go(-1)</script>";
         exit();
        }*/
        
        //判断表格是否上传成功
        if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
            require_once 'PHPExcel.php';
            require_once 'PHPExcel/IOFactory.php';
            require_once 'PHPExcel/Reader/Excel5.php';
            //以上三步加载phpExcel的类
        
            $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
            //接收存在缓存中的excel表格
            $filename = $_FILES['myfile']['tmp_name'];
            $objPHPExcel = $objReader->load($filename); //$filename可以是上传的表格，或者是指定的表格
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); // 取得总行数 
            // $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            
            //循环读取excel表格,读取一条,插入一条
            //j表示从哪一行开始读取  从第二行开始读取，因为第一行是标题不保存
            //$a表示列号
            $count=0;
            for($j=2;$j<=$highestRow;$j++)  
            {
                $username = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();//姓名
                $sex = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();//性别
                $codeid = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();//身份证
                $domicile = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();//户籍地
                $livingplace = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();//现住地
                $workunit = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();//工作单位
                $wename = $objPHPExcel->getActiveSheet()->getCell("G".$j)->getValue();//微信昵称
                $weid = $objPHPExcel->getActiveSheet()->getCell("H".$j)->getValue();//微信号
                $wegroup = $objPHPExcel->getActiveSheet()->getCell("I".$j)->getValue();//微信群号
                $qqname = $objPHPExcel->getActiveSheet()->getCell("J".$j)->getValue();//QQ昵称
                $qqid = $objPHPExcel->getActiveSheet()->getCell("K".$j)->getValue();//QQ号
                $qqgroup = $objPHPExcel->getActiveSheet()->getCell("L".$j)->getValue();//QQ群号
                $blogname = $objPHPExcel->getActiveSheet()->getCell("M".$j)->getValue();//微博昵称
                $blogid = $objPHPExcel->getActiveSheet()->getCell("N".$j)->getValue();//微博ID
                $blognumber = $objPHPExcel->getActiveSheet()->getCell("O".$j)->getValue();//微博账号
                $bbsname = $objPHPExcel->getActiveSheet()->getCell("P".$j)->getValue();//论坛昵称
                $phone = $objPHPExcel->getActiveSheet()->getCell("Q".$j)->getValue();//手机号
                $email = $objPHPExcel->getActiveSheet()->getCell("R".$j)->getValue();//邮箱
                $pic = $objPHPExcel->getActiveSheet()->getCell("S".$j)->getValue();//照片
                $persontype = $objPHPExcel->getActiveSheet()->getCell("T".$j)->getValue();//人员属性
                $placebelong = $objPHPExcel->getActiveSheet()->getCell("U".$j)->getValue();//归属地
                
                //null 为主键id，自增可用null表示自动添加
                $sql = "INSERT INTO `netizeninfo`(`Name`, `Sex`, `CodeID`, `Domicile`, `Livingplace`, `Workunit`, `WeNickName`, `WeID`, `WeGroupNo`, `QQNickName`, `QQ`, `QQGroupNo`, `BlogNickName`, `BlogID`, `BlogNumber`, `BbsNickName`, `Phone`, `Email`, `Pic`,`PersonType`,`PlaceBelong`,`StartTime`)
                VALUES ('$username',$sex,'$codeid','$domicile','$livingplace','$workunit','$wename','$weid','$wegroup','$qqname','$qqid',
                '$qqgroup','$blogname','$blogid','$blognumber','$bbsname','$phone','$email','$pic',$persontype,$placebelong,now())";
                $res = mysql_query($sql);
                // echo "$sql";
                // exit();
                //$res = mysql_query($sql);
                if ($res) {
                    $count++;
                }
            }
            if($count>0){
                layer_message("添加成功");
            }
        }
    }
        
    //调用
    if($_FILES){
        upExecel();
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title> 
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
</head>
<body>
    <form enctype="multipart/form-data" action="?" method="post">
        <table>
            <tr><td align="center" colspan="2"><font style="font-size: 40px; font-family: 华文彩云;" >选择表格</font></td></tr>
            <tr><td align="center">请先<a href="model.xls"><span style="font-size:15px;font-weight:bold;">点击下载excel模板</span></a>按照模板格式编辑信息（<span style="color:red">最好用此模板作为导入文件</span>）</td></tr>
        　　<tr>
            <td align="center">请选择你要导入的文件：<input type="file" name="myfile"><input type="submit" value="开始导入" /></td>
            </tr>
        </table>
    </form>
</body>