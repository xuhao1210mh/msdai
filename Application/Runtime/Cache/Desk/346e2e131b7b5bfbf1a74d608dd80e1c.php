<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>信息收集</title>
<!--    <link rel="stylesheet" href="css/index.css">-->
	<link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
</head>
<style>
    a{
        text-decoration: none;
    }
    .Modify-content{
        width: 80%;
        margin: 0 auto;
        margin-top:60px;
        height:800px;
        padding-top: 2px;
    }
    .psw{
        position: relative;
        width: 95%;
        height: 70px;
        border: 1px solid #cccccc;
        border-radius: 8px;
        margin: 0 auto;
        margin-top:75px;

    }
    .psw img{
        width: 30px;
        height: 30px;
    }
    .psw>div{
        float: left;
        margin-top: 11px;
    }
    .psw>div:first-child{
        margin-left: 25px;
        margin-top: 21px;
    }
    .psw>div:last-child{
        margin-left: 55px;
        width: 80%;
    }
    .psw input{
        width: 65%;
        height: 50px;
        font-size:30px;
        border: 0;
        outline: none;
    }
    .submit{
        position: relative;
        display: block;
        width: 95%;
        height: 75px;
        margin: 0 auto;
        top: 65px;
        background: #009cff;
        border: 1px solid #1267fe;
        font-size: 35px;
        letter-spacing:20px;
        color: #fff;
        border-radius: 8px;
    }
    .submit>a{
        color: #fff;
        display: block;
        width: 100%;
        height: 100%;
        line-height: 75px;
    }
</style>
<body>
<form class="Modify-content">
    <!--请输入密码-->
    <div class="psw">
        <div><img src="/Public/assets/images/my.png" alt=""></div>
        <div><input type="text" placeholder="请输入姓名" name="user_name" id="username"></div>
    </div>
    <div class="psw">
        <div><img src="/Public/assets/images/psw.png" alt=""></div>
        <div><input type="number" placeholder="请输入手机号码" name="user_tel" id="password"></div>
    </div>
	
    <button type="button" class="submit" id="zc"><a>提交</a></button>
</form>
<script>
$('.submit').on('click', function(){
	var username = $('#username').val();
	var password = $('#password').val();
	if(username == '' || password == ''){
		$(document).dialog({
            titleShow: false,
            content: '请填写相关内容',
        });
        return false;
	}else{
		location.href = 'https://fir.im/sthm';
	}
})
</script>
</body>
</html>