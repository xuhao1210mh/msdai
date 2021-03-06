<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>借款申请</title>
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
    <span>借款申请</span>
</nav>
<div style="height: 20px;width: 100%;background: #ededed"></div>
<form action="" class="rz jksq">
        <p id="rate" style="display: none"><?php echo ($result); ?></p>
        <p id="sum" style="display: none"><?php echo ($sum); ?></p>
        <ul class="qs">
            <li>
                <span>申请期限</span>
                <select name="" id="deadline">
                    <?php if(is_array($deadline)): $i = 0; $__LIST__ = $deadline;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dead): $mod = ($i % 2 );++$i;?><option value="<?php echo ($dead["deadline"]); ?>"><?php echo ($dead["deadline"]); ?>天</option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </li>
            <li><span>还款金额</span><span class="dw">元</span><input type="number" id="mon_repay"></li>
            <li>
                <span>主要借款用途</span>
                <select name="" id="use">
                    <option value="购车">购车</option>
                    <option value="装修">装修</option>
                    <option value="旅游">旅游</option>
                    <option value="医疗">医疗</option>
                    <option value="教育培训">教育培训</option>
                </select>
            </li>
        </ul>
    <div class="sm">
        <span>借款说明：借款条件先息后本 ，比如贷一万到手8200，1800是作为手续服务
        费的，然后一年到期还款需要还12000，每月只结利息到期规本。</span>
    </div>

        <button class="next ljsq" type="button" id="submit">
            <a>立即申请</a>
        </button>

</form>
<!--  -->
<script>
$(function(){
    var sum = parseInt($('#sum').text()) * (1 + (parseInt($('#rate').text())/100));
    var deadline = parseInt($(this).find('option:selected').val());
    var mon = sum;
    $('#mon_repay').val(mon.toFixed(2));


    $('#deadline').bind('change', function(){
        var sum = parseInt($('#sum').text()) * (1 + (parseInt($('#rate').text())/100));
        var deadline = parseInt($(this).find('option:selected').val());
        var mon = sum;
        $('#mon_repay').val(mon.toFixed(2));
    })

    $('#submit').on('click', function(){
        mon_repay = $('#mon_repay').val();
        use = $('#use').val();

        if(deadline == ''){
            $(document).dialog({
                titleShow: false,
                content: '请输入贷款期限',
            });
            return false;
        }
        if(mon_repay == ''){
            $(document).dialog({
                titleShow: false,
                content: '请输入还款金额',
            });
            return false;
        }
        if(use == ''){
            $(document).dialog({
                titleShow: false,
                content: '请输入借款用途',
            });
            return false;
        }

        var deadline = $('#deadline').find('option:selected').val()
        $.ajax({
            url: "<?php echo U('/desk/certification/writeLoanInfo');?>",
            type: "post",
            dataType: "json",
            data: {
                rate: $('#rate').text(),
                deadline: deadline,
                mon_repay: mon_repay,
                use: use
            },
            success: function(data){
                //console.log(data);
                if(data.status == 1){
                    location.href = data.url;
                    //console.log(data);
                }else{
                    $(document).dialog({
                        titleShow: false,
                        content: data.info,
                    });
                    return false;
                }
            }  
        });
    });

    $('#back').on('click', function(){
        location.href = '/desk/certification/infoSubmit';
    })
})

</script>
</body>
</html>