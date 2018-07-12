<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>我要还钱</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
</head>
<body>
<nav>
    <div class="back" id="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>我要还钱</span>
</nav>
<div style="height: 20px;width: 100%;background:#ededed"></div>
<?php if(is_array($result)): foreach($result as $key=>$vo): ?><div class="je">
        <div>
            <p class="loan_id" id="<?php echo ($vo["loan_id"]); ?>">贷款发放金额：￥<?php echo ($vo["sum"]); ?></p>
            <p><?php echo ($vo["apply_time"]); ?></p>
        </div>
        <button><a class="repayment">我要还款</a></button>
    </div><?php endforeach; endif; ?>
<!-- <div class="je">
    <div>
        <p>贷款发放金额：￥2300</p>
        <p>2018-06-04 15:20</p>
    </div>
    <button><a href="DetailsOfRepayment.html">立即还款</a></button>
</div> -->
<!--  -->
<script>
$('.je button').each(function(i, e){
    $(e).on('click', function(){
        // var loan_id = $(this).parent().find('.loan_id').attr('id');
        // location.href = "/desk/repayment/execRepayment?loan_id=" + loan_id;
        $(document).dialog({
            titleShow: false,
            content: '如需还款，请您联系工作人员'
        });
        return false;
    })
})

$('#back').on('click', function(){
    location.href = '/desk/center/personalCenter';
})
</script>
</body>
</html>