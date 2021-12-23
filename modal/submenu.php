<h3>編輯次選單</h3>
<hr>
<form action="api/add.php?do=<?=$_GET['table'];?>" method="post" enctype="multipart/form-data">
    <table id="sub">
        <tr>
            <td>次選單名稱</td>
            <td>次選單名稱網址</td>
            <td>刪除</td>
        </tr>
        <tr>
            <td><input type="text" name="name"></td>
            <td><input type="text" name="href"></td>
            <input type="button" value="更多次選單" onclick="more()">
        </tr>
        <tr>
            <td><input type="text" name="name"></td>
            <td><input type="text" name="href"></td>
        </tr>
    </table>
        <div>
            <input type="submit" value="修改確定">
            <input type="reset" value="重置">
        </div>
</form>



<script>

// 增加一行,上引號內可放文字模板
function more(){
    row=`<tr>
            <td><input type="text" name="name"></td>
            <td><input type="text" name="href"></td>
         </tr>
         `

}

function more(){
    let row=`<tr>
                <td><input type="text" name="name" ></td>
                <td><input type="text" name="href" ></td>
                <td></td>
            </tr>`
        $("#sub").append(row);
        // console.log(row)
        // let table=document.getElementById('sub').innerHTML
}
</script>