<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=web01";
    protected $user="root";
    protected $pw='';
    protected $table;
    protected $pdo;
    
    public $table;
    public $title;
    public $button;
    public $header;
    public $append;
    
    
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
        $this->setStr($table);
    }
     
     private function setStr($table){
        switch($table){
            case "ad";
                $this->title="動態文字廣告管理";
                $this->button="新增動態文字廣告";
                $this->header="動態文字廣告";
            break;          
            case "admin";
                $this->title="管理者帳號管理";
                $this->button="新增管理者帳號";
                $this->header="帳號";
                $this->append="密碼";
            break;          
            case "bottom";
                $this->title="頁尾版權資料管理";
                $this->button="";
                $this->header="頁尾版權資料";
            break;        
            case "image";
                $this->title="校園映像資料管理";
                $this->button="新增校園映像圖片";
                $this->header="校園映像資料圖片";
            break;         
            case "menu";
                $this->title="選單管理";
                $this->button="新增主選單";
                $this->header="主選單名稱";
                $this->append="選單連結網址";
            break;          
            case "mvim";
                $this->title="動畫圖片管理";
                $this->button="新增動畫圖片";
                $this->header="動畫圖片";
            break;         
            case "news";
                $this->title="最新消息資料管理";
                $this->button="新增最新消息資料";
                $this->header="最新消息資料內容";
            break;         
            case "title";
                $this->title="網站標題管理";
                $this->button="新增網站標題圖片";
                $this->header="網站標題";
            break;        
            case "total";
                $this->title="進站總人數管理";
                $this->button="";
                $this->header="進站總人數:";
            break;        
        } 
    }




    public function find($id){
        $sql="SELECT * FROM $this->table WHERE ";

        
        if(is_array($id)){
            
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            
            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }


    // 根據參數的個數來決定SWITCH裡面要怎麼處理
    public function all(...$arg){
        // table 這有個空白要加
        $sql="SELECT * FROM $this->table ";

        switch(count($arg)){
            // 兩個，第一個必須為陣列，第二個是字串
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }
                // 第一個陣列參數，接空白，再接第二個參數
                $sql .=" WHERE ".implode(" AND ".$arg[0])." ".$arg[1];

            break;
            // 只有一個，先判斷是否為陣列，陣列取前半段，字串取後半段
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ".$arg[0]);
                }else{
                    $sql .= $arg[1];
                    
                }
            break;
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    // 計算那個欄位，要用的什麼告訴我，條件是什麼
    public function math($method,$col,...$arg){
        $sql="SELECT $method($col) FROM $this->table ";

        switch(count($arg)){
            // 兩個，第一個必須為陣列，第二個是字串
            case 2:
                foreach($arg[0] as $key => $value){
                    $tmp[]="`$key`='$value'";
                }
                // 第一個陣列參數，接空白，再接第二個參數
                $sql .=" WHERE ".implode(" AND ".$arg[0])." ".$arg[1];
            break;
            // 只有一個，先判斷是否為陣列，陣列取前半段，字串取後半段
            case 1:
                if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
                        $tmp[]="`$key`='$value'";
                    }
                    $sql .= " WHERE ".implode(" AND ".$arg[0]);
                }else{
                    $sql .= $arg[1];
                    
                }
            break;
        }
        // 針對一個欄位，不用回傳全部
        return $this->pdo->query($sql)->fetchColumn();
    }


    // 包涵兩種做法合成一個，陣列，用來新增跟更新用，所有資料表都要加上id
    public function save($array){
        // 在裡面的有ID，外面的沒ID，所以用判斷有無ID來決定
        if(isset($array['id'])){
            //update $array陣列不指定
            foreach($array as $key => $value){
                $tmp[]="`$key`='$value'";
                // id在裡面看要不要加判斷式去掉id
            }
            // update 什麼欄位對什麼值
            $sql="UPDATE $this->table 
                     SET ".implode(",",$tmp)."
                   WHERE `id`='{$array['id']}'";
        }else{
            // insert 先寫出語法再慢慢填入

            $sql="INSERT INTO $this->table (`".implode("`,`",array_keys($array))."`) 
                                     VALUES('".implode("','",$array)."')";
        }
        // 回傳筆數
        return $this->pdo->exec($sql);
    }
    

    // 刪除
    public function del($id){
        $sql="DELETE FROM $this->table WHERE ";
        // 如果不是陣列就是id，那你就找出id給我
        if(is_array($id)){
             // 把東西變成這樣
            foreach($id as $key => $value){
                $tmp[]="`$key`='$value'";
            }
            // 跟上面的串起來
            $sql .= implode(" AND ",$tmp);
        }else{
            $sql .= " `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }


    // 複雜查詢(萬用)
    public function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


}

// 寫class DB外面，不用呼叫的
function to($url){
    header("location:".$url);
}

// 自定變數 = 導到資料庫
$Title=new DB('title');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$Image=new DB('image');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');
$Bottom=new DB('bottom');
$Total=new DB('total'); 

// $tt=(isset($_GET['do']))?$_GET['do']:'';
// $tt=isset($_GET['do'])??'';
$tt=$_GET['do']??'';
switch($tt){
    case "ad":
        $DB=$Ad;
    break;
    case "admin":
        $DB=$Admin;
    break;
    case "bottom":
        $DB=$Bottom;
    break;
    case "image":
        $DB=$Image;
    break;
    case "menu":
        $DB=$Menu;
    break;
    case "news":
        $DB=$News;
    break;
    case "title":
        $DB=$Title;
    break;
    case "total":
        $DB=$Total;
    break;
}

// 查看$total
// $total=$total->find(1);
// echo $total->(1)['total'];
// echo $total['total'];
// print_r($total->all());

// 有存在才做事，不存在才做事所以用!not
// 自定變數找到資料庫otal的值find(1)
// 找到後再+1,+1後存回去
// 接下來base.php會導到，前後端開頭，使其優於所有頁面
if(!isset($_SESSION['total'])){
    $total=$Total->find(1);
    $total['total']++;
    $Total->save($total);
    // 這行是上述結束後產生一個SESSION叫total
    // =後是因要=所以可隨意打
    $_SESSION['total']=$total['total'];
}

?>