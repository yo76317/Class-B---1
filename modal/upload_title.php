<?php
include_once "../base.php";
?>

<h3>更新標題區圖片</h3>
<hr>
<form action="api/upload.php?do=<?=$DB->table;?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><?=$DB->upload;?>：</td>
            <!-- name 對應的是資料表欄位 -->
            <td><input type="file" name="img" ></td>
        </tr>

    </table>
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
    <div><input type="submit" value="更新"><input type="reset" value="重置"></div>
</form> 