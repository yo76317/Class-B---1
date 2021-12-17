<?php include_once "../base.php";
// 上述會拿到total 變更的數量

// $Title=new DB('title');
// 下述拿到total的值
$views =$_POST['total'];
// 自定義變數 = 資料庫的資料表->第一項
$total=$Total->find(1);
// 自定義變數的資料表第一項['第一行拿到的total']=views
$total['total']=$views;
// 資料庫存檔資料表->save上一行的資料
$Total->save($total);

//上面四行的簡述寫法
// $Total->save(['id'=>1,'total'=>$_POST['total']]);


// 結束後導回這頁面
to("../back.php?do=total");


