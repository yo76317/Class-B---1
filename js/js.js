// JavaScript Document
$(document).ready(function(e) {
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").stop().show()
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
});



function lo(x)
{
	location.replace(x)
}


// $是jQ專用符號 正常是jQuery.(x)
// selector 分別是 # . html(標籤本身) 都叫選擇器
// x是選擇器就淡入，接下來看有無y，有的話也淡入，
// x是選擇器才能使用它,fadeIn淡入
// if只有一行要執行可省略{},假如有y,也把y做淡入
// 選擇器可以說是容器，容器就是拿起來放東西
// 假如有y跟網址
// 請在y的容器裡面,載入網址到y
function op(x,y,url)
{
	$(x).fadeIn()
	if(y)
	$(y).fadeIn()
	if(y&&url)
	$(y).load(url)
}


// 把x淡出
function cl(x)
{
	$(x).fadeOut();
}