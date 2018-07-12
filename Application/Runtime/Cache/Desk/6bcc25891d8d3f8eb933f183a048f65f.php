<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>我的钱包</title>
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
    <span>我的钱包</span>
</nav>
<div style="height: 20px;width: 100%;background:#ededed"></div>
<?php if(is_array($result)): foreach($result as $key=>$vo): ?><div class="je" id="wall">
        <div>
            <p class="loan_id" id="<?php echo ($vo["loan_id"]); ?>">申请金额：￥<?php echo ($vo["sum"]); ?></p>
            <p><?php echo ($vo["put_time"]); ?></p>
        </div>
        <button type="button" id="submit" class="withdraw">查看</button>
    </div><?php endforeach; endif; ?>
<!-- <div class="je" id="wall">
    <div>
        <p>贷款发放金额：￥2300</p>
        <p>2018-06-04 15:20</p>
    </div>
    <button>立即提现</button>
</div> -->
<!--  -->
<script>

$('.withdraw').on('click', function(){
    var loan_id = $(this).parent().find('.loan_id').attr('id');
    $.ajax({
        url: "<?php echo U('/desk/wallet/checkStatus');?>",
        type: "post",
        dataType: "json",
        data: {
            loan_id: loan_id
        },
        success: function(data){
            location.href = data.url;
        }  
    });
})

// $('.withdraw').on('click', function(){
//     var loan_id = $(this).parent().find('.loan_id').attr('id');
//     $.ajax({
//         url: "<?php echo U('/desk/wallet/withdraw');?>",
//         type: "post",
//         dataType: "json",
//         data: {
//             loan_id: loan_id
//         },
//         success: function(data){
//             if(data.status == 1){
//                 $(document).dialog({
//                     title: false,
//                     content: data.info,
//                     onClickConfirmBtn: function(){
//                         location.href = data.url;
//                     }
//                 });
//             }else{
//                 $(document).dialog({
//                     title: false,
//                     content: data.info
//                 });
//             }
//         }  
//     });
// })

$('#back').on('click', function(){
    location.href = '/desk/center/personalCenter';
})
</script>
</body>
</html>