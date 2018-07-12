<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/assets/css/index.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/vue.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
    <style>
    html,body{
        width: 100%;
        height: 100%;
    }
    #canvas{
        width: 750px;
        height: 370px;
        position: relative;
        border-bottom: 1px solid black;
    }
    #canvas canvas{
        display: block;
    }
    #clearCanvas{
        width: 50%;
        height: 80px;
        line-height: 40px;
        text-align: center;
        position: absolute;
        bottom: 0;
        left: 0;
        border: 1px solid #DEDEDE;
        z-index: 1;
        font-size: 40px;
    }
    #saveCanvas{
        width: 50%;
        height: 80px;
        line-height: 40px;
        text-align: center;
        position: absolute;
        bottom: 0;
        right: 0;
        border: 1px solid #DEDEDE;
        z-index: 1;
        font-size: 40px;
    }
    </style>
</head>
<body>


    <div id="canvas">
        <nav style="position: absolute;">
            <div class="back" id="back">
                <img src="/Public/assets/images/back.png" alt="">
            </div>
            <span>签名</span>
        </nav>
    </div>
    <p style="font-size: 20px;text-align: center;">请在以上区域手写签名</p>
    <p style="font-size: 20px;text-align: center;">以下区域为您保存的签名</p>
    <img src="<?php echo ($sign); ?>">
    <button id="clearCanvas">清除</button>
    <button id="saveCanvas">保存</button>
    </div>
<!--  -->
<script>
window.onload = function() {
    new lineCanvas({
        el: document.getElementById("canvas"),//绘制canvas的父级div
        clearEl: document.getElementById("clearCanvas"),//清除按钮
        saveEl: document.getElementById("saveCanvas"),//保存按钮
        //      linewidth:1,//线条粗细，选填
        //      color:"black",//线条颜色，选填
        //      background:"#ffffff"//线条背景，选填
    });
};
function lineCanvas(obj) {
    this.linewidth = 2;
    this.color = "#000000";
    this.background = "#ffffff";
    for (var i in obj) {
        this[i] = obj[i];
    };
    this.canvas = document.createElement("canvas");
    this.el.appendChild(this.canvas);
    this.cxt = this.canvas.getContext("2d");
    this.canvas.width = this.el.clientWidth;
    this.canvas.height = this.el.clientHeight;
    this.cxt.fillStyle = this.background;
    this.cxt.fillRect(0, 0, this.canvas.width, this.canvas.width);
    this.cxt.strokeStyle = this.color;
    this.cxt.lineWidth = this.linewidth;
    this.cxt.lineCap = "round";
    //开始绘制
    this.canvas.addEventListener("touchstart", function(e) {
        this.cxt.beginPath();
        this.cxt.moveTo(e.changedTouches[0].pageX, e.changedTouches[0].pageY);
    }.bind(this), false);
    //绘制中
    this.canvas.addEventListener("touchmove", function(e) {
        this.cxt.lineTo(e.changedTouches[0].pageX, e.changedTouches[0].pageY);
        this.cxt.stroke();
    }.bind(this), false);
    //结束绘制
    this.canvas.addEventListener("touchend", function() {
        this.cxt.closePath();
    }.bind(this), false);
    //清除画布
    this.clearEl.addEventListener("click", function() {
        this.cxt.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }.bind(this), false);
    //保存图片，直接转base64
    this.saveEl.addEventListener("click", function() {
        // if($('#canvas').text() == ''){
        //     $(document).dialog({
        //         titleShow: false,
        //         content: '请手写签名',
        //     });
        //     return false;
        // } 
        var imgBase64 = this.canvas.toDataURL();
        //console.log(imgBase64);
        $.ajax({
            url: "<?php echo U('/desk/center/sign');?>",
            type: "post",
            dataType: "json",
            data: {
                sign: imgBase64
            },
            success: function(data){
                if(data.status == 1){
                    $(document).dialog({
                        titleShow: false,
                        content: data.info,
                        onClickConfirmBtn: function(){
                            location.href = data.url;
                        }
                    });
                    return false;
                }else{
                    $(document).dialog({
                        titleShow: false,
                        content: data.info,
                    });
                    return false;
                }
            }  
        })
    }.bind(this), false);
};

$('.back').on('click', function(){
    window.history.back();
})
</script>
</body>
</html>