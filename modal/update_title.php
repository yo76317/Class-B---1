<h3>更新標題區圖片</h3>
<hr>
<form action="api/update_title.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>標題區圖片：</td>
            <!-- name 對應的是資料表欄位 -->
            <td><input type="file" name="img" ></td>
        </tr>

    </table>
    <div><input type="submit" value="新增"><input type="reset" value="重置"></div>
</form> 