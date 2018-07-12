<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>凭证详情</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">

    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>

</head>
<body>
<!--导航-->
<nav>
    <div class="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>凭证详情</span>
</nav>
<p id="loan_id"><?php echo ($loan_id); ?></p>
<div class="hp_cont">
    <div class="hp">
        <img src="/Public/assets/images/touxiang.png" alt="">
        <span><?php echo ($result["name"]); ?></span>
        <div class="qz">
            <img src="/files/setting/<?php echo ($result["pic"]); ?>" alt="">
            <span>签字区域</span>
        </div>
    </div>
    <div class="jkg">
        <span>》 借款给  》</span>
    </div>
    <div class="hp hp_two">
        <img src="/Public/assets/images/touxiang.png" alt="">
        <span><?php echo ($result["nickname"]); ?></span>
        <div class="qz">
            <img src="<?php echo ($result["sign"]); ?>" alt="">
            <span>签字区域</span>
        </div>
    </div>
</div>
<div style="width: 100%;height: 20px;background: #ededed"></div>
<div>
    <ul class="rq">
        <li><span>借款日期</span><span><?php echo ($result["apply_time"]); ?></span></li>
        <li><span>还款日期</span><span><?php echo ($result["dead_time"]); ?></span>
            <del class="old_time" id="<?php echo ($isFlag); ?>">原：<?php echo ($result["again_time"]); ?>(已展期)</del>
        </li>
        <li><span>借款金额</span><span class="qian"><?php echo ($result["sum"]); ?>元</span></li>
        <li><span>年化利率</span><span><?php echo ($result["rate"]); ?>%</span></li>
        <li><span>本息共计</span><span class="qian"><?php echo ($result["repay"]); ?>元</span></li>
        <li><span>借款用途</span><span><?php echo ($result["use"]); ?></span></li>
    </ul>
    <div style="clear: both"></div>
</div>
<div style="width: 100%;height: 20px;background: #ededed;margin-top:20px"></div>
<div class="xybh" id="flag1" style="display: none">
    <div class="ysx">
        <img src="/Public/assets/images/zhang.png" alt="">
    </div>
    <ul class="rq">
        <li><span>协议编号</span><span><?php echo ($result["receipt_id"]); ?></span>
            <!-- <a href="http://ypz.youmaijinkong.com/m/agreement/iou/2/!Zqv8rN!2rNv8vT86">电子协议(点击查看详情)</a> -->
        </li>
    </ul>
</div>
<div class="shpz" id="flag2" style="display: none">
    <div class="ysx sh">
        <img src="/Public/assets/images/zhangyi.png" alt="">
    </div>
    <ul class="rq">
        <li><span>实际还款日期</span><span><?php echo ($result["fact_time"]); ?></span></li>
        <!-- <li><span>是否逾期</span><span>否</span></li> -->
        <li><span>协议编号</span><span><?php echo ($result["receipt_id"]); ?></span>
            <!-- <a href="http://ypz.youmaijinkong.com/m/agreement/iou/2/!Zqv8rN!2rNv8vT86">电子协议(点击查看详情)</a> -->
        </li>
    </ul>
</div>
<!-- <div class="zq">
    <div>
        <button class="zq_btn">
            <a href="#">展期</a>
        </button>
        <button class="hk">对方以还款，撕毁凭证</button>
    </div>

</div> -->
<p style="display: none" id="status"><?php echo ($result["status"]); ?></p>
<script>
$(function(){
    var isFlag = $('.old_time').attr('id');
    if(isFlag == '1'){
        $('.old_time').show();
    }
    var status = $('#status').text();
    if(status == 1){
        $('#flag1').show();
        return false;
    }
    if(status ==3){
        //$('.zq').hide();
        $('#flag1').hide();
        $('#flag2').show();
        return false;
    }
})
$('.back').on('click', function(){
    //location.href = '/desk/center/myLoan';
    window.history.back();
})
</script>
</body>
<script src="/Public/assets/js/index.js"></script>
</html>