<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>还款详情</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<nav>
    <div class="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>还款详情</span>
</nav>
<p id="loan_id" style="display: none;"><?php echo ($loan_id); ?></p>
<div class="whbj">
    <span>还款金额(元)</span>
    <span id="sum"><?php echo ($repay); ?></span>
    <span>好借好还，再借不难</span>
</div>
<div class="details">
    <p>借款明细</p>
    <ul>
        <li>
            <span>借款金额</span>
            <span><?php echo ($sum); ?></span>
        </li>
        <li>
            <span>合同期限</span>
            <span><?php echo ($apply_time); ?>至<?php echo ($dead_time); ?></span>
        </li>
        <li>
            <span>利息(%)</span>
            <span><?php echo ($rate); ?></span>
        </li>
    </ul>
</div>
<button class="ljhk" id="pay_method"><a>立即还款</a></button>
<!--  -->
<script>
$('.back').on('click', function(){
    //location.href = '/desk/center/payBack';
    window.history.back();
})

$('#pay_method').on('click', function(){
    var loan_id = $('#loan_id').text();
    var sum = $('#sum').text();
    var data = 'loan_id=' + loan_id + '&sum=' + sum;
    location.href = '/desk/repayment/payMethod?'+ data;
})
</script>
</body>
</html>