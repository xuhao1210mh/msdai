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
    <span>审核成功</span>
</nav>
<div class="banner">
    <img src="/Public/assets/images/banner2.png" alt="">
</div>
<div class="foa">
    <img src="/Public/assets/images/foa.png" alt="">
</div>
<!-- <div class="kded">
    <span><?php echo ($sum); ?>元</span>
</div> -->
<div style="width: 400px;margin: 0 auto;margin-top: 100px;display: none;"><img src="/Public/setting/<?php echo ($pic); ?>" alt="" style="width: 400px;display: block"></div>
<span style="text-align: center;display: block;font-size: 30px;margin-top: 20px;display: none;">扫描客服专属二维码</span>
<a class="ljtx">生成凭证</a>
<script>
$('.ljtx').on('click', function(){
    $.ajax({
        url: "<?php echo U('/desk/wallet/withdraw');?>",
        type: "post",
        dataType: "json",
        success: function(data){
            if(data.status == 1){
                $(document).dialog({
                    title: false,
                    content: '凭证生成成功',
                    onClickConfirmBtn: function(){
                        location.href = data.url;
                    }
                });
            }else{
                $(document).dialog({
                    title: false,
                    content: '凭证生成失败',
                });
            }
        }  
    });
})

$('.back').on('click', function(){
    location.href = '/desk/wallet/myWallet';
})
</script>
</body>
</html>