<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>登录</title>
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
    <span>登录</span>
</nav>
<form class="index-content">
    <div class="psw" style="margin-top: 0">
        <div><img src="/Public/assets/images/tjm.png" alt=""></div>
        <div><input type="text" placeholder="请输入推荐码" name="password" id="code"></div>
    </div>
    <button type="button" class="submit"><a>登录</a></button>
</form>
<!--  -->
<script>
$('.submit').on('click', function(){
    var code = $('#code').val();
    if(code == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入推荐码'
        })
        return false;
    }

    $.ajax({
        url: "<?php echo U('/desk/entry/recommendation');?>",
        type: "post",
        dataType: "json",
        data: {
            code: code,
        },
        success: function(data){
            if(data.status == 1){
                location.href = data.url;
            }else{
                $(document).dialog({
                    titleShow: false,
                    content: data.info,
                });
                return false;
            }
        }  
    });
})

$('.back').on('click', function(){
    window.history.back();
})
</script>
</body>
</html>