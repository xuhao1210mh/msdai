<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>联系客服</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<nav>
    <div class="back">
        <img src="/Public/assets/images/back.png" alt="">    </div>
    <span>联系客服</span>
</nav>
<div style="width:100%;height:50px;background:#ffeccc;text-align: center;font-size: 24px;color:#c17a00;line-height: 50px"><span>客服在线时间:08:00-22:00</span></div>
<div style="width: 400px;margin: 0 auto;margin-top: 100px"><img src="/Public/setting/<?php echo ($pic); ?>" alt="" style="width: 400px;display: block"></div>
<span style="text-align: center;display: block;font-size: 30px;margin-top: 20px">扫描客服专属二维码</span>
<script>
    $('.back').on('click', function(){
        window.history.back();
    })
</script>
</body>
</html>