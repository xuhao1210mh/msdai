<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>认证</title>
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
    <span>认证</span>
</nav>
<div class="tx">
    <span>请详细填写真实资料,方便您更好借款</span>
</div>
<div class="wc" id="wc_one">
    <div>
        <div><img src="/Public/assets/images/sfrz.png" alt=""></div>
        <span>身份认证</span>
        <a id="identify"><p id="<?php echo ($flag1); ?>">去完成</p></a>
    </div>
</div>
<div class="wc">
    <div>
        <div><img src="/Public/assets/images/jbxx.png" alt=""></div>
        <span>基本信息</span>
        <a id="info"><p id="<?php echo ($flag2); ?>">去完成</p></a>
    </div>
</div>
<div class="wc" id="wc_end">
    <div>
        <div><img src="/Public/assets/images/zmrz.png" alt=""></div>
        <span>芝麻认证</span>
        <a id="seasame"><p id="<?php echo ($flag3); ?>">去完成</p></a>
    </div>
</div>
<a id="identify2"><p id="<?php echo ($flag4); ?>" style="display: none;"></p></a>
<button class="tjsh" id="submit"><a>提交审核</a></button>
<!--  -->
<script>
$(function(){
    var identify = $('#identify').find('p').attr('id');
    var identify2 = $('#identify2').find('p').attr('id');
    var info = $('#info p').attr('id');
    var seasame = $('#seasame').find('p').attr('id');

    if(identify == 'exist' && identify2 == 'exist'){
        $('#identify').find('p').text('已完成');
        $('#identify').attr('href', '#'); 
        $('#identify').on('click', function(){
            $(document).dialog({
                titleShow: false,
                content: '您已完成该项认证',
            });
        })
    }else{
        identifyOne();
    }

    if(info == 'exist'){
        $('#info').find('p').text('已完成');
        $('#info').attr('href', '#'); 
        $('#info').on('click', function(){
            $(document).dialog({
                titleShow: false,
                content: '您已完成该项认证',
            });
        })
    }else{
        writeInfo();
    }

    if(seasame == 'exist'){
        $('#seasame').find('p').text('已完成');
        $('#seasame').attr('href', '#'); 
        $('#seasame').on('click', function(){
            $(document).dialog({
                titleShow: false,
                content: '您已完成该项认证',
            });
        })
    }else{
        checkSeasame();
    }

})

function identifyOne(){
    $('#identify').on('click', function(){
        location.href = '/desk/certification/identifyOne';
    })
}

function writeInfo(){
    $('#info').on('click', function(){
        location.href = '/desk/certification/writeInfo';
    });
}

function checkSeasame(){
    $('#seasame').on('click', function(){
        location.href = '/desk/certification/seasame';
    })
}

$('#submit').on('click', function(){
    var identify = $('#identify').find('p').attr('id');
    var info = $('#info p').attr('id');
    var seasame = $('#seasame').find('p').attr('id');

    if(identify != 'exist'){
        $(document).dialog({
            titleShow: false,
            content: '请先完成认证',
        });
        return false;
    }

    if(info != 'exist'){
        $(document).dialog({
            titleShow: false,
            content: '请先完成认证',
        });
        return false;
    }
    
    if(seasame != 'exist'){
        $(document).dialog({
            titleShow: false,
            content: '请先完成认证',
        });
        return false;
    }

    $.ajax({
        url: "<?php echo U('desk/wallet/submit');?>",
        type: "post",
        dataType: "json",
        success: function(data){
            if(data.status == 0){
                $(document).dialog({
                    titleShow: false,
                    content: data.info,
                });
                return false;

            }else{
                location.href = data.url;
                //console.log(data);
            }
        }
    });

})

$('#back').on('click', function(){
    $(document).dialog({
        type: 'confirm',
        titleShow: false,
        content: '此时退出，您之前填写的数据将不会被保存，您确定吗？',
        onClickConfirmBtn: function(){
            location.href = '/desk/main/index';
        }
    });
})
</script>
</body>
</html>