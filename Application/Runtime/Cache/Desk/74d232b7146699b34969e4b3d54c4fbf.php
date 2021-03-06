<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=750, user-scalable=no" target-densitydpi="device-dpi">
    <title>身份认证</title>
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
    <span>身份认证</span>
</nav>
<form action="" class="rz">
     <ul class="qs">
         <li class="none"></li>
         <li class="title"><p>联系人(亲属)</p></li>
         <li><span>姓名</span><input type="text" id="name1"></li>
         <li>
             <span>关系</span>
             <select name="" id="select1">
                 <option value="父">父</option>
                 <option value="母">母</option>
             </select>
         </li>
         <li><span>手机号码</span><input type="number" id="number1"></li>
     </ul>
    <ul class="qs">
        <li class="title"><p>联系人(朋友/同事)</p></li>
        <li><span>姓名</span><input type="text" id="name2"></li>
        <li>
            <span>关系</span>
            <select name="" id="select2">
                <option value="父">朋友</option>
                <option value="母">同事</option>
            </select>
        </li>
        <li><span>手机号码</span><input type="number" id="number2"></li>
    </ul>
    <ul class="qs">
        <li class="title"><p>联系人(朋友/同事)</p></li>
        <li><span>姓名</span><input type="text" id="name3"></li>
        <li>
            <span>关系</span>
            <select name="" id="select3">
                <option value="父">朋友</option>
                <option value="母">同事</option>
            </select>
        </li>
        <li><span>手机号码</span><input type="number" id="number3"></li>
    </ul>
    <button class="next" type="button" id="submit">
        <a>下一步</a>
    </button>

</form>
<!--  -->
<script>
$('#submit').on('click', function(){
    var name1 = $('#name1').val();
    var name2 = $('#name2').val();
    var name3 = $('#name3').val();
    var number1 = $('#number1').val();
    var number2 = $('#number2').val();
    var number3 = $('#number3').val();
    var relation1 = $('#select1').find('option:selected').val();
    var relation2 = $('#select2').find('option:selected').val();
    var relation3 = $('#select3').find('option:selected').val();
    if(name1 == '' || number1 == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入相关内容',
        });
        return false;
    }
    if(name2 == '' || number2 == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入相关内容',
        });
        return false;
    }
    if(name3 == '' || number3 == ''){
        $(document).dialog({
            titleShow: false,
            content: '请输入相关内容',
        });
        return false;
    }
    $.ajax({
        url: "<?php echo U('/desk/certification/identifyOne');?>",
        type: "post",
        dataType: "json",
        data: {
            name1: name1,
            number1: number1,
            relation1: relation1,
            name2: name2,
            number2: number2,
            relation2: relation2,
            name3: name3,
            number3: number3,
            relation3: relation3
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
    location.href = '/desk/certification/authentication';
})
</script>
</body>
</html>