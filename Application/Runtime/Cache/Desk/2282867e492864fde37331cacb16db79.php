<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>三级分销</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<!--导航-->
<nav>
    <div class="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>三级分销</span>
    <!-- <p>分享</p> -->
</nav>
<div class="sjfx">
    <img src="/Public/assets/images/sjfx.png" alt="">
</div>
<!-- 1. Define some markup -->
<div class="yqm">
    <span>邀请码:</span>
    <textarea id="foo" type="text" readonly="value" style="vertical-align:top;width:320px;height:100px;"><?php echo ($code); ?></textarea>
    <button class="btn" data-clipboard-action="copy" data-clipboard-target="#foo">复制</button>
</div>

<!-- 2. Include library -->
<script src="/Public/assets/js/clipboard.min.js"></script>

<!-- 3. Instantiate clipboard -->
<script>
    var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });

    $('.back').on('click', function(){
        window.history.back();
    })
</script>
</body>
</html>