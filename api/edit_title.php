<?php
include_once "../base.php";

// if(isset($_POST['id'])){
// }
// to("../back.php?do=".$Title->$table);
// base.php
// default
//     $DB=$Title;

foreach($_POST['id'] as $key => $id){
    // 先檢查有無要刪除的
    // 判斷id是否有在陣列內
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        // 刪除-上述兩筆條件都成立就刪除~
        $Title->del($id);
    }else{
        // 更新
        // $date['text']=$_POST['text'][$key];
        // sh是固定值,所以寫判斷式，每一次迴圈去比對，同就回傳1,不同回傳0
            // if($_POST['sh']==$id){
            //     $data['sh']=1;
            // }else{
            //     $date['sh']=0
            // }        
            $data['id']=$id;
            $data['text']=$_POST['text'][$key];
            $data['sh']=($_POST['sh']==$id)?1:0;
            $Title->save($data);       
    }
}

to("../back.php?do=".$Title->title);
// dd($_POST);
?>