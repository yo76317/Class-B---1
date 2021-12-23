<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$DB->title;?></p>
    <form method="post"  action="api/edit.php?do=<?=$DB->table;?>">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="70%"><?=$DB->header;?></td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td></td>
                </tr>
                <?php
                // 如果用count要告訴全部有幾筆所以就用*，也可以用指定欄位
                // 得到筆數資料，分區(頁)指定要有幾筆
                // ceil取天花板(無條件進位) all/div
                // 現在頁面-1=開始頁*div (從0開始是因為資料庫為陣列)
                // limit 返回筆數
                // limit 第幾筆,取幾筆
                $all=$DB->math('count','*');
                $div=3;
                $pages=ceil($all/$div);
                $now=$_GET['p']??1;
                $start=($now-1)*$div;

                $rows=$DB->all(" limit $start,$div");
                foreach($rows as $row){
                $checked=($row['sh']==1)?'checked':'';
                ?>
                <tr>
                    <td>
                        <img src="./img/<?=$row['img'];?>" style="width:100px;height:68px">
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">

                    </td>
                    <td>
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                    <input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/upload.php?do=<?=$DB->table;?>&id=<?=$row['id'];?>&#39;)" 
                              value="更換圖片">
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!-- 分頁 -->
        <div class="cent">
            <?php
                // 分頁方向鍵 >
                // // 假如now-1最多等於0 用>
                 if(($now-1)>0){
                    $p=$now-1;
                    echo "<a href='?do={$DB->table}&p=$p'> &lt; </a>";   
                }


                // 第一頁開始,顯示到幾頁,+1
                for($i=1;$i<=$pages;$i++){
                    // 到了當前頁字加大
                    if($i==$now){
                        $fontsize="24px";
                    }else{
                        $fontsize="16px";
                    }
                    // echo "<a herf='?do=image&p=$i'> $i </a>";
                    // 改用DB取代image,{}包起來以防萬一
                    // 上面判斷決定變數長什麼樣子，下面輸出自動帶入，動態
                    echo "<a href='?do={$DB->table}&p=$i' style='font-size:$fontsize'> $i </a>";
                }

                // 分頁方向鍵 >
                // 假如now+1最多等於3 用<=
                if(($now+1)<=$pages){
                    $p=$now+1;
                    echo "<a href='?do={$DB->table}&p=$p'> &gt; </a>";
                }

            ?>
        </div>

        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                        <input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$DB->table;?>.php?table=<?=$DB->table;?>&#39;)" 
                              value="<?=$DB->button;?>">
                    </td>
                    <td class="cent">
                        
                        <input type="submit" value="修改確定">
                        <input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>

    </form>
</div>