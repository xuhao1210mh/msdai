<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>消息</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<nav>
    <div class="back" id="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>消息</span>
</nav>
<?php if(is_array($result)): foreach($result as $key=>$vo): ?><div class="massage">
        <p><?php echo ($vo["content"]); ?></p>
        <span><?php echo ($vo["send_time"]); ?></span>
    </div><?php endforeach; endif; ?>
<!--  -->
<script>
$(function(){
    $.ajax({
        url: "<?php echo U('/desk/center/message');?>",
        type: "post",
        dataType: "json",
        success: function(data){
            console.log(data);
        }  
    });
    setInterval(getMessage, 5000);
})

function getMessage(){
    $.ajax({
        url: "<?php echo U('/desk/center/message');?>",
        type: "post",
        dataType: "json",
        success: function(data){
            console.log(data);
        }  
    });
}

$('#back').on('click', function(){
    location.href = '/desk/center/personalCenter';
})
</script>
</body>
</html>