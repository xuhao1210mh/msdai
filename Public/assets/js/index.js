$(document).ready(function(){
    $(".zmrz").click(function(){
        $(this).next(".zm").slideToggle();
    });
    $(".zf>div").click(function () {
        $(".sure").attr("id","");
        $(this).children(".sure").attr("id","choice");
    });
    $(".hk").click(function () {
        $(".zq").css("display","none");
        $(".xybh").css("display","none");
        $(".shpz").css("display","block");
    });
});
