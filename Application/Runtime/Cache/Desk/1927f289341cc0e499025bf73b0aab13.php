<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>我的借款</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<nav>
    <div class="back" id="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>我的借款</span>
</nav>
<div class="paging">
    <a class="jkjl" id="myloan">借款记录</a>
    <a class="hkjl" id="myrepay">还款记录</a>
</div>
<?php if(is_array($result)): foreach($result as $key=>$vo): ?><div class="je jk" id="wall">
        <div>
            <p class="loan_id" id="<?php echo ($vo["loan_id"]); ?>"><?php echo ($vo["sum"]); ?></p>
            <p><?php echo ($vo["apply_time"]); ?></p>
        </div>
        <button><a href="/desk/wallet/voucherDetails/<?php echo ($vo["loan_id"]); ?>">查看</a></button>
    </div><?php endforeach; endif; ?>
<!-- <div class="je jk" id="wall">
    <div>
        <p>1000.10</p>
        <p>2018-06-04 15:20</p>
    </div>
    <button><a href="DetailsOfRepayment.html">提前还款</a></button>
</div> -->

</body>
<!--  -->
<script>
$('#myloan').on('click', function(){
    location.href = '/desk/center/myLoan';
})

$('#myrepay').on('click', function(){
    location.href = '/desk/center/myRepay';
})

$('#back').on('click', function(){
    location.href = '/desk/center/personalCenter';
})
</script>
</html>