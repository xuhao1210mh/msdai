<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>审核结果</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
</head>
<body>
<nav>
    <div class="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>等待审核</span>
</nav>
<div class="banner">
    <img src="/Public/assets/images/banner2.png" alt="">
</div>
<div class="foa">
    <img src="/Public/assets/images/waitResult.png" alt="">
</div>
<!-- <div class="kded">
    <span><?php echo ($sum); ?>元</span>
</div> -->
<a class="ljtx" id="back">确认</a>
<p id="loan_id" style="display: none"><?php echo ($loan_id); ?></p>
<script>
$('#back').on('click', function(){
    location.href = '/desk/wallet/myWallet';
})

$('.back').on('click', function(){
    location.href = '/desk/wallet/myWallet';
})
</script>
</body>
</html>