<?php
include_once "../base.php";

// if(isset($_POST['id'])){
// }
// to("../back.php?do=".$Ad->$table);
// base.php
// default
//     $DB=$Ad;

foreach($_POST['id'] as $key => $id){
    // 先檢查有無要刪除的
    // 判斷id是否有在陣列內
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        // 刪除-上述兩筆條件都成立就刪除~
        $DB->del($id);
    }else{
        // 更新
        // $date['text']=$_POST['text'][$key];
        // sh是固定值,所以寫判斷式，每一次迴圈去比對，同就回傳1,不同回傳0
            // if($_POST['sh']==$id){
            //     $data['sh']=1;
            // }else{
            //     $date['sh']=0
            // }        

            // 每一圈都跑一次，如果是它就顯示，如果不是它的話
            $data=$DB->find($id);

            switch($DB->table){
            case "title":
                $data['text']=$_POST['text'][$key];
                $data['sh']=($_POST['sh']==$id)?1:0;
            break;
            case "admin":
                $data['acc']=$_POST['acc'][$key];
                $data['pw']=$_POST['pw'][$key];
            break;
            case "menu":
                $data['name']=$_POST['name'][$key];
                $data['href']=$_POST['href'][$key];
                $data['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
            break;
            default: 
                // ad news image mvim 無文字
                // 先判斷有無POST資料，有就把text給key值，沒有就給空值(本來就空值)
                $data['text']=isset($_POST['text'])?$_POST['text'][$key]:'';
                $data['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
            break;
            }
            // dd($data);
            $DB->save($data);
                  
    }
}
to("../back.php?do=".$DB->table);
// dd($_POST);
?>