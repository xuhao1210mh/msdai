<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>还款支付</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>

</head>
<body>
<nav>
    <div class="back">
        <img src="/Public/assets//images/back.png" alt="">
    </div>
    <span>还款支付</span>
</nav>
<div class="zffs">
    <span>选择支付方式</span>
</div>
<div class="yes">
    <div class="zf wc">
        <div>
            <div class="sb"><img src="/Public/assets//images/zfb.png" alt=""></div>
            <span class="fs">支付宝</span>
            <div class="sure"></div>
        </div>
    </div>
    <div class="zf wc">
        <div>
            <div class="sb"><img src="/Public/assets//images/wx.png" alt=""></div>
            <span class="fs">微信支付</span>
            <div class="sure" ></div>
        </div>
    </div>
    <div class="zf wc">
        <div>
            <div class="sb"><img src="/Public/assets//images/gsyh.png" alt=""></div>
            <span class="fs">工商银行借记卡(尾号3025)</span>
            <div class="sure "></div>
        </div>
    </div>
</div>
<button class="qrzf"><a href="">确认支付￥<span id="sum"><?php echo ($sum); ?></span></a></button>
</body>
<script src="/Public/assets/js/index.js"></script>
<script>
$('.back').on('click', function(){
    window.history.back();
})
</script>
</html>