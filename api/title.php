<?php

include  "../base.php";

// 如果這個東西不是空值代表存在，那檔案上傳成功
if(!empty($_FILES['img']['tmp_name'])){
    // 搬到這個目錄外面的img裡
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    // 打算寫到資料庫去,date裡面放著img，檔名像FILES
    $data['img']=$_FILES['img']['name'];
}

$data['text']=$_POST['text'];
// 全部預設不顯示之後再手動設顯示
$data['sh']=0;
$Title->save($data);
to("../back.php?do=".$Title->table)
// dd($_POST);
// dd($_FILES);
?>