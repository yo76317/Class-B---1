<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<!-- include marquee -->
	<?php include "marquee.php";?>
    <div style="height:32px; display:block;"></div>
    <!--正中央-->

	<div style="width:100%; padding:2px; height:290px;">
        <div id="mwww" loop="true" style="width:100%; height:100%;">
            <div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
        </div>
    </div>

    <script>
		// var宣告lin = new Array 成陣列，但沒內容所以自己生
        var lin = new Array();
		// 陣列，但沒內容所以自己生
		// lin[0]='圖片檔名.jpg'
		<?php
			//sh是1的取出
			$mvs=$Mvim->all(['sh'=>1]);
			foreach($mvs as $mv){
				?>	
				// push 把值塞在最後位補上
				 lin.push('<?="img/{$mv['img']}";?>')
	<?php
	}
	?>

		var now = 0;
		ww()   //先執行一次
		// 陣列長度>0 最少為2
		// 兩個以上的話sI間隔時間3s後執行ww(),第一次執行時now=1
		// 因為三秒後執行..ww(),now先超車執行,時間到再執行now=1
		// js特性
		if (lin.length > 1) {
        setInterval("ww()", 3000);
        now = 1;
    	}
		// 宣告function = jqs.  .html是選擇器
		// loop循環,lin[now]這是陣列放now值=0

		function ww() {
			$("#mwww").html("<embed loop=true src='" + lin[now] + "' style='width:99%; height:100%;'></embed>")
			//$("#mwww").attr("src",lin[now])
			// 假設length=5 , 1=>now++=2=>小餘5不執行
			// 2++=3 => 小餘不執行
			// 跳到 4++=5 => 等於5執行 => now=0
			// 陣列索引值超過4以後變為0，再重頭來就會一直循環
			now++;
			if (now >= lin.length)
            now = 0;
    		}
    </script>
    
	<div
        style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
        <span class="t botli">最新消息區
            <?php 
                if($News->math('count','*',['sh'=>1])>5){
                    echo "<a href='?do=news' style='float:right'>More...</a>";
                }
            ?>
        </span>
        <ul class="ssaa" style="list-style-type:decimal;">
        <?php
            $news=$News->all(['sh'=>1]," LIMIT 5");
            foreach($news as $n){
                echo "<li>";
                echo mb_substr($n['text'],0,20);
                echo "<div class='all' style='display:none'>{$n['text']}</div>";
                echo "</li>";
            }

        ?>
        </ul>
        <div id="altt"
            style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
        </div>
        <script>

        $(".ssaa li").hover(
            function() {
                $("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
                $("#altt").show()
            }
        )
        $(".ssaa li").mouseout(
            function() {
                $("#altt").hide()
            }
        )
                    </script>
                </div>
	</div>