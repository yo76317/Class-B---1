<?php
// 有類別跟其它的用once比較不會打架
include_once "base.php";
?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040)http://127.0.0.1/test/exercise/collage/? -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>卓越科技大學校園資訊系統</title>
    <link href="./css/css.css" rel="stylesheet" type="text/css">
    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/js.js"></script>
</head>

<body>
    <div id="cover" style="display:none; ">
        <div id="coverr">
			<!-- cl是淡出 -->
            <a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;"
                onclick="cl(&#39;#cover&#39;)">X</a>
            <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
        </div>
    </div>
    <div id="main">
	<!-- 到img 找圖片 -->
    <?php include "front/header.php";?>
        <div id="ms">
            <div id="lf" style="float:left;">
                <div id="menuput" class="dbor">
                    <!--主選單放此-->
                    <span class="t botli">主選單區</span>
                </div>
                <div class="dbor" style="margin:3px; width:95%; height:20%; line-height:100px;">
                <!-- total找到find1後再顯示到total -->    
				<span class="t">進站總人數 :<?=$Total->find(1)['total'];?></span>
                </div>
            </div>

			<!-- main class="di" 挖去front再include來 -->

            <?php
				$do=isset($_GET["do"])?$_GET["do"]:'main';
				// $do=isset($_GET["do"])??'main';
				// 上面那行相當於此列
				// if(isset($_GET['do']])){
				// 	$do=$_GET['do'];
				// 	}else{
				// 		$do='main';
				// 	}
				$file="./front/".$do.".php";
				// 判斷檔案存不存在，存在載include，反之不存在echo錯誤訊息
				if(file_exists($file)){
					include $file;
				}else{
					//echo "檔案不存在";
					include "./front/main.php";
				}	
				?>
            <div id="alt"
                style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
            </div>
            <script>
            $(".sswww").hover(
                function() {
                    $("#alt").html("" + $(this).children(".all").html() + "").css({
                        "top": $(this).offset().top - 50
                    })
                    $("#alt").show()
                }
            )
            $(".sswww").mouseout(
                function() {
                    $("#alt").hide()
                }
            )
            </script>
            <div class="di di ad" style="height:540px; width:23%; padding:0px; margin-left:22px; float:left; ">
                <!--右邊-->
                <button style="width:100%; margin-left:auto; margin-right:auto; margin-top:2px; height:50px;"
                    onclick="lo(&#39;back.php&#39;)">管理登入</button>
                <div style="width:89%; height:480px;" class="dbor">
                    <span class="t botli">校園映象區</span>
                    
                    <div class="t" onclick="pp(1)"><img src="icon/up.jpg"></div>
                        <?php 
                            $imgs=$Image->all(['sh'=>1]);
                            foreach($imgs as $key => $img){
                        ?>
                        <div class="im cent" id="ssaa<?=$key;?>">
                            <img src="img/<?=$img['img'];?>" style="width:150px;height:103px;border:3px solid orange;margin:1px">
                        </div>
                        <?php 
                            }
                        ?>
                        <div class="t" class="t" onclick="pp(2)"><img src="icon/dn.jpg"></div>
                    
                    
                    <script>
                    var nowpage = 0,
                    num = <?=$Image->math("count","*",['sh'=>1]);?>;

                    function pp(x) {
                        var s, t;
                        if (x == 1 && nowpage - 1 >= 0) {
                            nowpage--;
                        }
                        if (x == 2 && (nowpage + 3) < num) {
                            nowpage++;
                        }
                        $(".im").hide()
                        for (s = 0; s <= 2; s++) {
                            t = s * 1 + nowpage * 1;
                            $("#ssaa" + t).show()
                        }
                    }
                    pp(1)
                    </script>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div
            style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
            
			<!-- 頁尾 -->
			<span class="t" style="line-height:123px;"><?=$Bottom->find(1)['bottom'];?></span>
        </div>
    </div>

</body>

</html>