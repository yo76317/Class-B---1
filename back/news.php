<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli"><?=$DB->title;?></p>
    <form method="post"  action="api/edit.php?do=<?=$DB->table;?>">
        <table width="100%">
            <tbody>
                <tr class="yel">

                    <td width="80%"><?=$DB->header;?></td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>

                </tr>
                <?php
                $all=$DB->math('count','*');
                $div=4;
                $pages=ceil($all/$div);
                $now=$_GET['p']??1;
                $start=($now-1)*$div;

                $rows=$DB->all(" limit $start,$div");
                foreach($rows as $row){
                    $checked=($row['sh']==1)?'checked':'';
                ?>
                <tr>

                    <td>
                        <textarea name="text" style="width:95%;height:60px"><?=$row['text'];?></textarea>
                    </td>
                    <td>
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>
                    </td>
                    <td>
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">

                        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                    </td>

                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="cent">

        <!-- copy過來 改db->那裡 -->
        <?php
            if(($now-1)>0){
                $p=$now-1;
                echo "<a href='?do={$DB->table}&p=$p'> &lt; </a>";   
            }
            for($i=1;$i<=$pages;$i++){
            if($i==$now){
                $fontsize="24px";
            }else{
                $fontsize="16px";
            }
             echo "<a href='?do={$DB->table}&p=$i' style='font-size:$fontsize'> $i </a>";
            }

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