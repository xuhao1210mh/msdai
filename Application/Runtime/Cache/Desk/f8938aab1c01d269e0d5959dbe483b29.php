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
<!--导航-->
    <nav>
        <div class="back">
            <img src="/Public/assets/images/back.png" alt="">
        </div>
        <span>
            登录
        </span>
    </nav>
<!--content-->
    <form class="index-content">
        <!--输入手机号-->
        <div class="tele">
            <div><img src="/Public/assets/images/tell.png" alt=""></div>
            <div><input type="number" placeholder="请输入手机号" name="tele" id="username"></div>
        </div>
        <!--请输入密码-->
        <div class="psw">
            <div><img src="/Public/assets/images/psw.png" alt=""></div>
            <div><input type="password" placeholder="请输入密码" name="password" id="password"></div>
        </div>
        <div class="land">
            <span><a href="/desk/entry/recommendation">推荐码登录</a></span>
            <a href="/desk/entry/forget">忘记密码？</a>
        </div>
        <button type="button" class="submit" id="submit"><span>登 录</span></button>
        <div class="register"><a href="/desk/entry/register">注 册</a></div>
    </form>

<!--  -->
<script>
$('#submit').on('click', function(){
    var username = $('#username').val();
    var password = $('#password').val();
    if(username == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入手机号',
        });
        return false;
    }
    if(password == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入密码',
        });
        return false;
    }

    $.ajax({
        url: "<?php echo U('/desk/entry/login');?>",
        type: "post",
        dataType: "json",
        data: {
            username: $('#username').val(),
            password: $('#password').val(),
        },
        success: function(data){
            //console.log(data);
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
</script>
</body>
</html>