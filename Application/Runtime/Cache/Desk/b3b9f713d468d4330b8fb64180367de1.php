<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>分秒速贷注册</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
</head>
<body>
<nav>
    <span>分秒速贷</span>
</nav>
<form class="index-content">
    <!--输入手机号-->
    <div class="tele">
        <div><img src="/Public/assets/images/tell.png" alt=""></div>
        <div><input type="number" placeholder="请输入手机号" name="tele" id="username"></div>
    </div>
    <div class="psw">
        <div><img src="/Public/assets/images/tell.png" alt=""></div>
        <div><input type="text" placeholder="请输入昵称" name="nickname" id="nickname"></div>
    </div>
    <!--请输入密码-->
    <div class="psw">
        <div><img src="/Public/assets/images/psw.png" alt=""></div>
        <div><input type="password" placeholder="请输入密码" name="password" id="password"></div>
    </div>
    <div class="psw">
        <div><img src="/Public/assets/images/psw.png" alt=""></div>
        <div><input type="password" placeholder="请确认密码" name="password" id="repassword"></div>
    </div>
    <div class="psw">
        <div><img src="/Public/assets/images/psw.png" alt=""></div>
        <div><input type="text" placeholder="请输入验证码" name="captcha" id="captcha"><span class="yzm" id="getCaptcha">获取验证码</span></div>
    </div>
    <div class="psw">
        <div><img src="/Public/assets/images/tjm.png" alt=""></div>
        <div><input type="text" placeholder="请输入推荐码" name="code" id="code"></div>
    </div>
    <button type="button" class="submit" id="zc"><a>下载</a></button>
    <div class="zcxy">
        <div>
            <span>注册即同意</span><a href="#">《用户注册协议》</a>
        </div>
    </div>
</form>

<!--  -->
<script>
$('#getCaptcha').on('click', function(){
    if($('#username').val() == ''){
        $(this).dialog({
            content: '请输入手机号',
        });
        return false;
    }
    $.ajax({
        url: "<?php echo U('/desk/entry/getCaptcha');?>",
        type: "post",
        dataType: "json",
        data: {
            username: $('#username').val()
        },
        success: function(data){
            if(data.status == 1){
                $(document).dialog({
                    titleShow: false,
                    content: data.info,
                });
                return false;
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

$('.submit').on('click', function(){
    var username = $('#username').val();
    var nickname = $('#nickname').val();
    var password = $('#password').val();
    var repassword = $('#repassword').val();
    var captcha = $('#captcha').val();

    // location.href = 'https://fir.im/sthm';

    // return false;
    if(username == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入手机号',
        });
        return false;
    }
    if(nickname == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入昵称',
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
    if(repassword == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入确认密码',
        });
        return false;
    }
    if(captcha == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入验证码',
        });
        return false;
    }

    $.ajax({
        url: "<?php echo U('/desk/entry/h5register');?>",
        type: "post",
        dataType: "json",
        data: {
            username: username,
            nickname: nickname,
            password: password,
            repassword: repassword,
            captcha: $('#captcha').val(),
            code: $('#code').val()
        },
        success: function(data){
            //console.log(data);
            if(data.status == 1){
                $(document).dialog({
                    titleShow: false,
                    content: data.info,
                    onClickConfirmBtn: function(){
                        location.href = 'https://fir.im/sthm';
                    }
                });
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