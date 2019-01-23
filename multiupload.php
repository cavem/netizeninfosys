<?php
	require_once 'session.php';
	date_default_timezone_set("Asia/Shanghai");
	header("Content-Type:text/html; charset=utf-8");
	if($_FILES){
        $textvalue="";
        //遍历所有照片的类型，判断上传的类型是否是常用的照片类型
        for ($i=0; $i<count($_FILES["file"]["name"]); $i++){
            //将信息存放在变量中
            $upfile=$_FILES["file"];//用一个数组类型的字符串存放上传文件的信息
            $exten_name=pathinfo($upfile['name'][$i],PATHINFO_EXTENSION);
            //生成照片证书guid
            $data=date('YmdHis');
            $name=$data. rand(0, 99).'.'.$exten_name;//便于以后转移文件时命名
            //如果打印则输出类似这样的信息Array ( [name] => m.jpg [type] => image/jpeg [tmp_name] => C:\WINDOWS\Temp\php1A.tmp [error] => 0 [size] => 44905 )
            $type=$upfile["type"][$i];//上传文件的类型
            $size=$upfile["size"][$i];//上传文件的大小
            $tmp_name=$upfile["tmp_name"][$i];//用户上传文件的临时名称
            $error=$upfile["error"][$i];//上传过程中的错误信息
            //对文件类型进行判断，判断是否要转移文件,如果符合要求则设置$ok=1即可以转移
            switch($type){
                case "image/gif" : $ok=1;
                break;
                case "image/jpg" : $ok=1;
                break;
                case "image/jpeg": $ok=1;
                break;
                case "image/png": $ok=1;
                break;
                default:$ok=0;
                break;
            }
            //如果文件符合要求并且上传过程中没有错误
            if($ok&&$error=='0'){
                //检查文件是否损坏
                $data = file_get_contents($tmp_name);
                $im = @imagecreatefromstring($data);
                if($im != false){
                    header("Content-type:text/html;charset=utf-8");
                    //乱码解决
                    $namea = iconv("utf-8","gb2312",$name);
                    //调用move_uploaded_file（）函数，进行文件转移
                    $path=$_SERVER['DOCUMENT_ROOT']."/uploadpic/".$namea;
                    if (!file_exists(dirname($path))){
                        mkdir(dirname($path), 0777);
                    }
                    move_uploaded_file($tmp_name,$path);
                    //echo "<p style='color:red'>上传成功！</p>";
                    echo "<script>alert('上传成功！')</script>";
                    //操作成功后，提示成功
                    $textvalue=$textvalue."/uploadpic/".$namea."||";
                    
                }
                else{
                    //如果文件不符合类型或者上传过程中有错误，提示失败
                    //echo "<p style='color:red'>图片损坏！</p>";
                    echo "<script>alert('图片损坏！')</script>";
                    exit();
                }
            }else{
                //如果文件不符合类型或者上传过程中有错误，提示失败
                //echo "<p style='color:red'>上传失败！</p>";
                echo "<script>alert('上传失败！')</script>";
                exit();
            }
        }
        echo "<script>window.parent.document.getElementById('textfield').value='".$textvalue."';</script>";
        exit();
    }
    else{
        echo "<p style='color:red'>选择文件</p>";
        exit();
    }
    		
?>