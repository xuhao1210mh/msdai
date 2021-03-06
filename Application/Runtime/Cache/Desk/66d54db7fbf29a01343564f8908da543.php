<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>首页</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <link rel="stylesheet" href="/Public/assets/js/idangerous.swiper.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
</head>
<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><a href="#"><img src="/Public/assets//images/banner1.png" alt=""></a></div>
        <div class="swiper-slide"><a href="#"><img src="/Public/assets//images/banner1.png" alt=""></a></div>
        <div class="swiper-slide"><a href="#"><img src="/Public/assets//images/banner1.png" alt=""></a></div>
        <div class="swiper-slide"><a href="#"><img src="/Public/assets//images/banner1.png" alt=""></a></div>
    </div>
    <div class="pagination"></div>
</div>
<div class="jsdk">
    <a id="apply">
        <img src="/Public/assets//images/jsdk.png" alt="">
    </a>
</div>
<div class="foot">
    <div>
        <a href="#">
            <img src="/Public/assets//images/homepage.png" alt="">
            <span style="color: #1267fe;">首页</span>
        </a>

    </div>
    <div>
        <a href="/desk/center/personalCenter" id="center">
            <img src="/Public/assets//images/my.png" alt="">
            <span style="color:#999999">我的</span>
        </a>
    </div>
</div>
</body>
</html>
<script src="/Public/assets/js/idangerous.swiper.min.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container',{
        autoplay : 5000,//可选选项，自动滑动
        loop : true,//可选选项，开启循环
        pagination : '.pagination',
        paginationClickable :true,
    })

    $('.jsdk').on('click', function(){
        $.ajax({
            url: "<?php echo U('/desk/certification/infoSubmit');?>",
            type: "post",
            dataType: "json",
            success: function(res){
                if(res.status == 0){
                    $(document).dialog({
                        title: false,
                        content: res.info,
                        onClickConfirmBtn: function(){
                            location.href = res.url;
                        }
                    });
                }else{
                    location.href = res.url;
                }
            }
        });
        
    })
</script>