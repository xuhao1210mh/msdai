<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>负面影响</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
    <style>
    #submit{
        display: block;
        margin: 300px auto;
        width: 30%;
        height:75px;
        font-size: 35px;
        color: #fff;
        border: 0;
        background: #1267fe;
    }
    </style>
</head>
<body>
<!--导航-->
    <nav>
        <div class="back" id="back">
            <img src="/Public/assets/images/back.png" alt="">
        </div>
        <span>芝麻认证</span>
    </nav>
    <div style="width: 100%;height: 20px;background:#ededed"></div>
    <div class="neg-list">
        <div>
            <div class="zmrz">
                <span>芝麻认证</span>
                <div><img src="/Public/assets/images/back2.png" alt=""></div>
            </div>
            <div class="zm">
                <div class="container">
                    <!--    照片添加    -->
                    <div class="z_photo">
                        <div class="jia">
                            <img src="/Public/assets/images/jia.png" alt="">
                            <span>上传芝麻信用分截图</span>
                        </div>
                        <div class="z_file">
                            <input type="file" name="file" id="file" value="" accept="image/*" enctype="multipart/form-data" multiple onchange="imgChange('z_photo','z_file');" />
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="neg-list">
        <div>
            <div class="zmrz">
                <span>运营商认证</span>
                <div><img src="/Public/assets/images/back2.png" alt=""></div>
            </div>
            <form class="zm yys">
                <div class="xz">
                    <div class="xzyys">
                        <span>选择运营商：</span>
                        <input type="radio" id="yd" name="yys" class="yys" value="移动"><label for="yd">移动</label>
                        <input type="radio" id="lt" name="yys" class="yys" value="联通"><label for="lt">联通</label>
                        <input type="radio" id="dx" name="yys" class="yys" value="电信"><label for="dx">电信</label>
                    </div>
                    <input type="number" placeholder="请输入手机号码" value="" name="" id="number">
                    <input type="password" placeholder="请输入登陆密码" value="" name="" id="password">
                    <!-- <button type="button">确认</button> -->
                </div>
            </form>
        </div>
    </div>
    <!-- <div class="neg-list">
        <div>
            <div class="zmrz">
                <span>负面记录</span>
                <div><img src="/Public/assets/images/back2.png" alt=""></div>
            </div>
            <div class="zm">
                <div class="fmjl">
                    <span>某某银行逾期未归还</span>
                    <span>2018.6.7</span>
                </div>
                <div class="fmjl">
                    <span>某某银行逾期未归还</span>
                    <span>2018.6.7</span>
                </div>
                <div class="fmjl">
                    <span>某某银行逾期未归还</span>
                    <span>2018.6.7</span>
                </div>
            </div>
        </div>
    </div> -->
<button type="button" id="submit">确认</button>
</body>
<script src="/Public/assets/js/index.js"></script>
<script>
    function imgChange(obj1, obj2) {
        //获取点击的文本框
        var file = document.getElementById("file");
        //存放图片的父级元素
        var imgContainer = document.getElementsByClassName(obj1)[0];
        //获取的图片文件
        var fileList = file.files;
        //文本框的父级元素
        var input = document.getElementsByClassName(obj2)[0];
        var imgArr = [];
        //遍历获取到得图片文件
        for (var i = 0; i < fileList.length; i++) {
            var imgUrl = window.URL.createObjectURL(file.files[i]);
            imgArr.push(imgUrl);
            var img = document.createElement("img");
            img.setAttribute("src", imgArr[i]);
            var imgAdd = document.createElement("div");
            imgAdd.setAttribute("class", "z_addImg");
            imgAdd.appendChild(img);
            imgContainer.appendChild(imgAdd);
        };
        imgRemove();
    };

    function imgRemove() {
        var imgList = document.getElementsByClassName("z_addImg");
        var mask = document.getElementsByClassName("z_mask")[0];
        var cancel = document.getElementsByClassName("z_cancel")[0];
        var sure = document.getElementsByClassName("z_sure")[0];
        for (var j = 0; j < imgList.length; j++) {
            imgList[j].index = j;
            imgList[j].onclick = function() {
                var t = this;
                mask.style.display = "block";
                cancel.onclick = function() {
                    mask.style.display = "none";
                };
                sure.onclick = function() {
                    mask.style.display = "none";
                    t.style.display = "none";
                };

            }
        };
    };

    $('#submit').on('click', function(){
        var file = $('#file').val();
        var operator = $('input:radio:checked').val();
        var number = $('#number').val();
        var password = $('#password').val();
        //console.log(operator);
        if(file == ''){
            $(document).dialog({
                titleShow: false,
                content: '请完成相关信息的填写',
            });
            return false;
        }
        if(operator == null){
            $(document).dialog({
                titleShow: false,
                content: '请完成相关信息的填写',
            });
            return false;
        }
        if(number == ''){
            $(document).dialog({
                titleShow: false,
                content: '请完成相关信息的填写',
            });
            return false;
        }
        if(password == ''){
            $(document).dialog({
                titleShow: false,
                content: '请完成相关信息的填写',
            });
            return false;
        }

        var formData = new FormData();
        formData.append('file1', $('#file')[0].files[0]);
        formData.append('operator', $('input:radio:checked').val());
        formData.append('number', number);
        formData.append('password', password);
        $.ajax({
            url: "<?php echo U('desk/certification/seasame');?>",
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
                    location.href = data.url;//'/desk/certification/authentication';
                    //console.log(data);
                }
            }
        });

    })

    $('#back').on('click', function(){
        location.href = '/desk/certification/authentication';
    })

</script>
</html>