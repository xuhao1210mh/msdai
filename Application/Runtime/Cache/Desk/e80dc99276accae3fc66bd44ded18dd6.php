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
    <span>审核通过</span>
</nav>
<div class="banner">
    <img src="/Public/assets/images/banner2.png" alt="">
</div>
<div class="foa">
    <img src="/Public/assets/images/noresult.jpg" alt="">
</div>
<!-- <div class="kded">
    <span><?php echo ($sum); ?>元</span>
</div> -->
<p id="loan_id" style="display: none"><?php echo ($loan_id); ?></p>
<p id="flag" style="display: none"><?php echo ($flag); ?></p>
<div style="width: 400px;margin: 0 auto;margin-top: 100px;display: none;" id="code"><img src="/Public/setting/<?php echo ($pic); ?>" alt="" style="width: 400px;display: block"></div>
<div style="text-align: center;font-size: 30px;margin-top: 20px;display: none;" id="tip">扫描客服专属二维码</div>
<a class="ljtx">生成凭证</a>
<script>
$(function(){
    var flag = $('#flag').text();
    if(flag == 'show'){
        $('.ljtx').hide();
        $('#code').show();
        $('#tip').show();
    }
})
$('.ljtx').on('click', function(){
    $.ajax({
        url: "<?php echo U('/desk/wallet/withdraw');?>",
        type: "post",
        dataType: "json",
        data: {
            loan_id: $('#loan_id').text()
        },
        success: function(data){
            if(data.status == 1){
                $(document).dialog({
                    title: false,
                    content: '凭证生成成功',
                    onClickConfirmBtn: function(){
                        $('.ljtx').hide();
                        $('#code').show();
                        $('#tip').show();
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