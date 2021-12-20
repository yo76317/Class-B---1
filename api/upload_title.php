<?php
include_once "../base.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $data['img']=$_FILES['img']['name'];
    // 理論上unlink舊圖片
    $data['id']=$_POST['id'];
    // 檔案上傳成功存進去
    $Title->save($data);
}

to("../back.php?do=".$Title->table)
?>