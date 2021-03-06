<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>个人中心</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
    <header>
        <h1>个人中心</h1>
        <div class="Head-portrait">
            <img src="/Public/assets/images/portrait.png" alt="">
        </div>
        <p><?php echo ($nickname); ?></p>
        <span><?php echo ($username); ?></span>
        <!-- <span style=""><a href="/desk/certification/authentication">认证</a></span> -->
        <div class="notice"><a id="message"><img src="/Public/assets/images/notice.png" alt=""><div class="red" style="display: none"></div></a></div>
    </header>
    <!--<div style="width: 100%;height: 20px;background:#ededed"></div>-->
   <ul class="per-list">
        <li>
            <a id="wallet">
                <div><img src="/Public/assets/images/wallet.png" alt=""></div>
                <span>我的申请</span>
                <div><img src="/Public/assets/images/right.png" alt=""></div>
            </a>
        </li>
        <li>
            <a href="/desk/center/distribution">
                <div><img src="/Public/assets/images/distribution.png" alt=""></div>
                <span>三级分销</span>
                <div><img src="/Public/assets/images/right.png" alt=""></div>
            </a>
        </li>
        <li>
            <a id="myloan">
                <div><img src="/Public/assets/images/Loan.png" alt=""></div>
                <span>我的借款</span>
                <div><img src="/Public/assets/images/right.png" alt=""></div>
            </a>
        </li>
        <li>
            <a id="payback">
                <div><img src="/Public/assets/images/repayment.png" alt=""></div>
                <span>我要还款</span>
                <div><img src="/Public/assets/images/right.png" alt=""></div>
            </a>
        </li>
        <li>
            <a id="sign" href="/desk/center/sign">
                <div><img src="/Public/assets/images/Loan.png" alt=""></div>
                <span>我的签名</span>
                <div><img src="/Public/assets/images/right.png" alt=""></div>
            </a>
        </li>
        <li>
            <a href="/desk/center/changePassword" id="change">
                <div><img src="/Public/assets/images/psd.png" alt=""></div>
                <span>修改密码</span>
                <div><img src="/Public/assets/images/right.png" alt=""></div>
            </a>
        </li>
        <!-- <li>
            <a href="/desk/center/customService">
                <div><img src="/Public/assets/images/Loan2.png" alt=""></div>
                <span>联系客服</span>
                <div><img src="/Public/assets/images/right.png" alt=""></div>
            </a>
        </li> -->
    </ul>
    <div class="out" id="out">
        <span>退出登录</span>
    </div>
    <div class="foot">
        <div>
            <a href="/desk/main/index">
                <img src="/Public/assets/images/shouye1.png" alt="">
                <span style="color:#999999">首页</span>
            </a>

        </div>
        <div>
            <a href="">
                <img src="/Public/assets/images/wode1.png" alt="">
                <span style="color: #1267fe;">我的</span>
            </a>
        </div>
    </div>
<!--  -->
<script>
//查询消息
$(function(){
    getMessage();
    setInterval(getMessage, 3000);
})

function getMessage(){
    $.ajax({
        url: "<?php echo U('/desk/center/personalCenter');?>",
        type: "post",
        dataType: "json",
        success: function(data){
            if(data.info == 'show'){
                $('.red').show();
            }
        }  
    });
}

$('#wallet').on('click', function(){
    location.href = '/desk/wallet/myWallet';
});

$('#myloan').on('click', function(){
    location.href = '/desk/center/myLoan';
});

$('#payback').on('click', function(){
    location.href = '/desk/center/payBack';
});

$('#message').on('click', function(){
    $('.red').hide();
    location.href = '/desk/center/message';
});

$('#out').on('click', function(){
    $.ajax({
        url: "<?php echo U('/desk/center/signOut');?>",
        type: "post",
        dataType: "json",
        success: function(data){
            location.href = data.url;
        }  
    });
});

</script>
</body>
</html>