<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB{
    protected $dsn="myssql:host=localhost;charset=utf8;dbname=ewb01";
    protected $user="root";
    protected $pw='';
    protected $table;


    // table等於傳進來的table
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    }

    public function find($id){
        $qsl="SELECT * FROM $this->table WHERE ";
        
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

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }


    // 根據參數的個數來決定SWITCH裡面要怎麼處理
    public function all(...$arg){
        // table 這有個空白要加
        $qsl="SELECT * FROM $this->table ";
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
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }


    // 計算那個欄位，要用的什麼告訴我，條件是什麼
    public function math($method,$col,...$arg){
        $sql="SELECT $meethod($col) FROM $this ->table ";
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
        // 針對一個欄位，不用回傳全部
        return $this->pdo->query($sql)->fetchColumn();
    }


    // 包涵兩種做法合成一個，陣列，用來新增跟更新用，所有資料表都要加上id
    public function save($array){
        // 在裡面的有ID，外面的沒ID，所以用判斷有無ID來決定
        if(isset($array['id'])){
            //update
            foreach($array[0] as $key => $value){
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
    public function del($array){
        $qsl="DELETE * FROM $this->table WHERE ";
        
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
        return $this->pdo->ecev($sql);
    }


    // 複雜查詢(萬用)
    public function q($sql){
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
}


// 寫class DB外面，不用呼叫的
function to($url){
    header("location:".$url);
}


// 查看$total
// $total=$total->find(1);
// echo $total->(1)['total'];
// echo $total['total'];
// print_r($total->all());