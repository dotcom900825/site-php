var mobile = false;
$(document).ready(function(){
	//$(window).resize(function(){
	//$("h1").text($(window).width());
	//})
	Init();
	if(window.screen.width <= 800){
		mobile = true;
	}
	window.onorientationchange = function(){
		doOnOrientationChange();
	};
	doOnOrientationChange();

	/*$("div.OneCard#card3>a").fancybox({
            'width'             : 700,
            'height'            : 520,
            'autoScale'         : false,
            'transitionIn'      : 'none',
            'transitionOut'     : 'none',
            'type'              : 'iframe',
            'href'              : "./Client/UCSD_CU_Discount_Card_Update/index.php"
        });
		*/
	//$("a#third").fancybox();

});
function doOnOrientationChange(){
	switch(window.orientation)
	{
		case -90:
		case 90:
			//$("h1").text(window.screen.width);
			break;
		default:
			//$("h1").text(window.screen.width);
			break;
	}
};

function Init(){
	//var OneLevelShelf = $("div.OneLevelShelf.span12:first");
	//OneLevelShelf.children().css('border-bottom','3px double red');
	//var test = $("<p>test</p>");
	////$(".OneLevelShelf").remove();
	//var a = 'a';
	//var b = 'b';
	//var $div = $("test")
	//$("#Shelf").append(test);

	//$("h1").text($(window).width);
	//var width = window.screen.width;
	//$("h1").text(width);
	//if(window.screen.width<=320 | $(window).width()<=320){
	//$("img.OneShelf").attr('src','./img/Shelf320.png')
	//}
	//else if(window.screen.width<=800 | $(window).width()<=800){
	//alert($("a#second").html());
	if(window.screen.width<=800 | $(window).width()<=800 | mobile){
		$("img.OneShelf").attr('src','./img/Shelf582.png')
	}
	else{
		$("img.OneShelf").attr('src','./img/ShelfFullwidth.png')
	}
	$(window).resize(function(){
		var width = $(window).width();
		//$("h1").text(width);
		//if($(window).width()<=320){
		//$("img.OneShelf").attr('src','./img/Shelf320.png')
		//}
		//else if($(window).width()<=800){
		if($(window).width()<=800 | window.screen.width<=800 | mobile) {
			$("img.OneShelf").attr('src','./img/Shelf582.png')
		}
		else{
			$("img.OneShelf").attr('src','./img/ShelfFullwidth.png')
		}
	})
	}
