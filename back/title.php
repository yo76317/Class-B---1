<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"> <?=$DB->title;?> </p>
        
    <form method="post" target="back" action="?do=tii">
        <table width="100%">
    	    <tbody>
                <tr class="yel">
        	        <td width="45%"><?=$DB->header;?></td>
                    <td width="23%">替代文字</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td><td></td>
                </tr>
     

                <?php
                // 先準備好資料
                $rows=$DB->all();
                // 一筆筆顯示
                foreach($rows as $row){
                ?>
                <tr>
        	        <td width="45%">
                        <img src="./img/<?=$row['img'];?>" style="height:300px;height:30px">
                    </td>
                    <td width="23%">
                        <input type="text" name="text" value="<?=$row['text'];?>">
                    </td>
                    <td width="7%">
                    <!-- 因為要單選，所以用radion,name設一樣就只能選一個 -->
                    <input type="radio" name="sh" value="<?=$row['id'];?>">
                    </td>
                    <td width="7%">
                    <!-- 因為要多選，所以用陣列，不然只會送出最後一個值(一筆) -->
                    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                    <!-- 自行設計 -->
                    <td width="7%">
                    <input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/update_title.php&#39;)" value="更新圖片">
                    </td>
                </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
         <!-- 新增動態文字廣告 -->
                    <td width="200px">
                    <input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/title.php&#39;)" value="<?=$DB->button;?>">
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