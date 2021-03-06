<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>资料提交</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
	<script src="/Public/assets/js/dsbridge.js"></script>
</head>
<body>
<nav>
    <div class="back" id="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>资料提交</span>
</nav>
<div class="banner">
    <img src="/Public/assets/images/banner2.png" alt="">
</div>
<div class="quota">
    <input type="number" placeholder="<?php echo ($result["sum"]); ?>" id="sum">
</div>
<div class="md">
    <div>
        <label for="">姓名</label>
        <input type="text" id="name">
    </div>
    <div>
        <label for="">电话</label>
        <input type="number" id="number">
    </div>
    <button class="ljsq" id="submit">立即申请</button>
</div>
<p id="rate" style="display: none"><?php echo ($result["rate"]); ?></p>
<!-- <div class="foot">
    <div>
        <a href="#">
            <img src="/Public/assets/images/homepage.png" alt="">
            <span>首页</span>
        </a>

    </div>
    <div>
        <a href="#">
            <img src="/Public/assets/images/my.png" alt="">
            <span>我的</span>
        </a>
    </div>
</div> -->
<!--  -->
<script>
$('#sum').bind('input propertychange', function(){
    if(parseInt($('#sum').val()) > parseInt($('#sum').attr('placeholder'))){
        $(this).blur();
        $(document).dialog({
            titleShow: false,
            content: '超过规定额度，请重新输入',
            onClickConfirmBtn: function(){
                $('#sum').val('');
            }
        });
    }
})

$('#submit').on('click', function(){
    var sum = $('#sum').val();
    var repay = parseInt($('#sum').val()) * (1 + (parseInt($('#rate').text())/100));
	var name = $('#name').val();
	var number = $('#number').val();
	
	<!-- dsBridge.call("getContacts", "getContacts", function(v) { -->
		<!-- alert(v); -->
		<!-- //var v = '[{"name":"xuhao","phone":"1231233"}]'; -->
		<!-- $.post("<?php echo U('desk/certification/postContacts');?>", {data:v}, function(res){ -->
			<!-- alert(res.info) -->
		<!-- }) -->
	<!-- }) -->
	<!-- return false; -->

    if(sum == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入借款额度',
        });
        return false;
    }
    if(name == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入姓名',
        });
        return false;
    }
    if(number == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入电话号码',
        });
        return false;
    }


    sum = parseInt(sum);
    sum = sum.toFixed(2);
    $.ajax({
        url: "<?php echo U('/desk/certification/writeLoan');?>",
        type: "post",
        dataType: "json",
        data: {
            sum: sum,
            repay: repay,
            name: name,
            number: number,
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
})

$('#back').on('click', function(){
    location.href = '/desk/main/index';
})
</script>
</body>
</html>