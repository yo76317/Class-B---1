<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <p class="t cent botli">頁尾版權資料管理</p>
        <!-- 沒地方去只能在當前頁(target)，但我們是要它去api改完再送回給我
             所以傳到api -->
        <form method="post" action="./api/bottom.php">
            <table width="50%" style="margin:auto">
    	        <tbody>
                    <tr class="yel">
                        <td width="50%">頁尾版權資料管理:</td>
                        <td width="50%">
                            <input type="text" name="bottom" value="<?=$Bottom->find(1)['bottom'];?>">
                        </td>
                    </tr>
                </tbody>
            </table>
           
            <table style="margin-top:40px; width:70%;">
                <tbody>
                    <tr>
                        <td width="200px"></td>
                        <td class="cent">
                            <input type="submit" value="修改確定">
                            <input type="reset" value="重置">
                        </td>
                    </tr>
                </tbody>
            </table>    
        </form>
                                    
    </div>