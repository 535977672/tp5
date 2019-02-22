$(function () {
    $(".headLineImg").each(function(){
       var imgNum =  $(this).find('img').length;
       if(imgNum == 1){
           $(this).insertBefore($(this).siblings("p"));
           $(this).css("float","left");
           $(this).children("img").removeClass("col-xs-4").css("width","260px");
           var $clear = $("<div class='clearfix'></div>");
           $clear.appendTo($(this).parent());
           $(this).siblings("p").css({"float":"left","marginTop":"40px"});
       }
    })
});