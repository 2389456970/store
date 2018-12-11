//banner a定位上下中部
$banner_img_wd=parseInt($('.banner').css('width'));
$('.banner .left').css('top','39.10112359550562%');
$banner_a_left=($banner_img_wd-1200)/2+'px';
$('.banner .left').css('left',$banner_a_left);
$('.banner .right').css('top','39.10112359550562%');
$('.banner .right').css('right',$banner_a_left);

var curIndex=0,$wd=$('body').width(),
    imgLen=$(".banner .banner_pic_list li").length;
	  $('.banner .banner_pic_list').css('width',$wd*3);
    $('.banner .banner_pic_list li').css('width',$wd);

var autoChange = setInterval(function(){ 
    if(curIndex < imgLen-1){ 
      curIndex ++; 
    }else{ 
      curIndex = 0;
    }
    changeTo(curIndex); 
  },2500);
  
 
 $(".left").hover(function(){ 
    clearInterval(autoChange);
  },function(){ 
    autoChange();
  });
  $(".left").click(function(){ 
    curIndex = (curIndex > 0) ? (--curIndex) : (imgLen - 1);
    changeTo(curIndex);
  });
  $(".right").hover(function(){ 
    clearInterval(autoChange);
  },function(){ 
    autoChangeAgain();
  });
  $(".right").click(function(){ 
    curIndex = (curIndex < imgLen - 1) ? (++curIndex) : 0;
    changeTo(curIndex);
  });
  
  $(".banner_list").find("li").each(function(item){ 
    $(this).hover(function(){ 
      clearInterval(autoChange);
      changeTo(item);
      curIndex = item;
    },function(){ 
      autoChangeAgain();
    });
  });
  $(".banner_pic_list").find("li").each(function(item){ 
    $(this).hover(function(){ 
      clearInterval(autoChange);
      changeTo(item);
      curIndex = item;
    },function(){ 
      autoChangeAgain();
    });
  });
  
 
  function autoChangeAgain(){ 
      autoChange = setInterval(function(){ 
      if(curIndex < imgLen-1){ 
        curIndex ++;
      }else{ 
        curIndex = 0;
      }
      changeTo(curIndex); 
    },2500);
    }
function changeTo(num){
	var goLeft=num*$wd;
	$(".banner .banner_pic_list").animate({left: "-" + goLeft + "px"},0);
  $(".banner .banner_list").find("li").removeClass("current").eq(num).addClass("current");
	}

