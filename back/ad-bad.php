<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$DB->title;?></p>

    <!-- 去api改資料,target="back"拿掉不然永遠送不出去 -->
    <form method="post"  action="api/edit_title.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
        	        <td width="45%"><?=$DB->header;?></td>
                    <td width="23%">替代文字</td>
                    <td width="7%">顯示</td>
                    <td width="7%">刪除</td>
                    <td>更新</td>
                </tr>
                
                <?php
                // 先準備好資料DB資料表
                $rows=$DB->all();
                // 一筆筆顯示
                foreach($rows as $row){
                    // 迴圈開始時設變數checked.判斷你是1還是0，如果是1就把checked放入:'';
                    // 兩個都是1就以最後一筆為準
                    $checked=($row['sh']==1)?'checked':'';
                ?>
                <tr>

                    <td width="23%">
                        <!-- 要多筆送出要在name後加上[] -->
                        <input type="text" name="text[]" value="<?=$row['text'];?>">
                    </td>
                    <td width="7%">
                        <!-- 因為要單選，所以用radion,name設一樣就只能選一個 -->
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>
                    </td>
                    <td width="7%">
                        <!-- 因為要多選，所以用陣列，不然只會送出最後一個值(一筆) -->
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                    <!-- 藏一個欄位 -->
                    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                        <td width="7%">
                            <!-- 自行設計 -->
                            <!-- 牽扯到更新，就一定要有對象(要知道是誰) -->
                            <!-- 所以帶一個id=row[] -->
                            <input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/update_title.php?id=<?=$row['id'];?>&#39;)" value="更新圖片">
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
                    <td width="200px">
                        <!-- 新增動態文字廣告 -->
                        <input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/ad.php&#39;)" 
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