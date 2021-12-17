
<!-- 測試view.php?do=XX 是否用切換方式載入 -->
<?php
switch($_GET['do']){
    case "title":

        echo "A";
    break;
    case "ad":

        echo "B";
    break;
}
?>