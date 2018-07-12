<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height,user-scalable=no">
    <title>后台管理</title>
    <link rel="stylesheet" href="/Public/admin/css/foundation.min.css" />
    <link rel="stylesheet" href="/Public/admin/css/normalize.css">
    <link rel="stylesheet" href="/Public/admin/css/index.css" />
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/popper.min.js"></script>
    <script src="/Public/assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/Public/dist/css/bootstrap.min.css">
</head>
<body>
    <!--left Menu-->
    <div class="large-2 columns">
        <div>
        	<img src="/Public/admin/images/logo.png"/>
        </div>
        
        <ul class="menu-list">
            <!-- <li data-icon="work-summary1" data-code="work-summary" class="selected" id="check">
                <img src="/Public/admin/images/work-plan.png" />
                <span>信息审核</span>
            </li> -->
            <!-- <li data-icon="work-summary1" data-code="work-plan" id="second" >
                <img src="/Public/admin/images/work-summary.png" />
                <span>房秒借</span>
            </li> -->
            <li data-icon="work-summary1" data-code="work-summary" id="order">
                <img src="/Public/admin/images/work-plan.png" />
                <span>申请信息</span>
            </li>
            <li data-icon="work-summary1" data-code="work-summary" id="setting">
                <img src="/Public/admin/images/work-plan.png" />
                <span>设置</span>
            </li>
            <li data-icon="work-summary1" data-code="work-plan" id="exit">
                <img src="/Public/admin/images/work-summary.png" />
                <span>退出系统</span>
            </li>
        </ul>
    </div>

    <!--right content-->
    <div class="large-10 columns content" style="overflow: auto;"><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <div class="header">
            <h2>checkLoan</h2>
        </div>
        <div class="body">
            <div>
                <div class="panel panel-default">
                    <div class="panel-body" style="text-align: center;">
                        查看信息
                    </div>
                </div>

                <table class="table table-secondary table-hover text-center col-md-2">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>借款期限(月)</td>
                            <td><?php echo ($result1["deadline"]); ?></td>
                        </tr>
                        <tr>
                            <td>月还款</td>
                            <td><?php echo ($result1["mon_repay"]); ?></td>
                        </tr>
                        <tr>
                            <td>用途</td>
                            <td><?php echo ($result1["use"]); ?></td>
                        </tr>
                        <tr>
                            <td>亲属(<?php echo ($result2["relation1"]); ?>)姓名</td>
                            <td><?php echo ($result2["name1"]); ?></td>
                        </tr>
                        <tr>
                            <td>亲属(<?php echo ($result2["relation1"]); ?>)电话</td>
                            <td><?php echo ($result2["number1"]); ?></td>
                        </tr>
                        <tr>
                            <td>朋友(<?php echo ($result2["relation2"]); ?>)姓名</td>
                            <td><?php echo ($result2["name2"]); ?></td>
                        </tr>
                        <tr>
                            <td>朋友(<?php echo ($result2["relation2"]); ?>)电话</td>
                            <td><?php echo ($result2["number2"]); ?></td>
                        </tr>
                        <tr>
                            <td>朋友(<?php echo ($result2["relation3"]); ?>)姓名</td>
                            <td><?php echo ($result2["name3"]); ?></td>
                        </tr>
                        <tr>
                            <td>朋友(<?php echo ($result2["relation3"]); ?>)电话</td>
                            <td><?php echo ($result2["number3"]); ?></td>
                        </tr>
                        <tr>
                            <td>身份证正面</td>
                            <td><img class="rounded col-3" src="/files/<?php echo ($username); ?>/pics/<?php echo ($result3["pic1"]); ?>" alt=""></td>
                        </tr>
                        <tr>
                            <td>身份证反面</td>
                            <td><img class="rounded col-3" src="/files/<?php echo ($username); ?>/pics/<?php echo ($result3["pic2"]); ?>" alt=""></td>
                        </tr>
                        <tr>
                            <td>手持身份证照片</td>
                            <td><img class="rounded col-3" src="/files/<?php echo ($username); ?>/pics/<?php echo ($result3["pic3"]); ?>" alt=""></td>
                        </tr>
                        <tr>
                            <td>银行卡照片</td>
                            <td><img class="rounded col-3" src="/files/<?php echo ($username); ?>/pics/<?php echo ($result3["pic4"]); ?>" alt=""></td>
                        </tr>
                        <tr>
                            <td>银行卡号</td>
                            <td><?php echo ($result3["card_number"]); ?></td>
                        </tr>
                        <tr>
                            <td>开户名</td>
                            <td><?php echo ($result3["card_name"]); ?></td>
                        </tr>
                        <tr>
                            <td>工作单位名称</td>
                            <td><?php echo ($result4["company"]); ?></td>
                        </tr>
                        <tr>
                            <td>工作单位地址</td>
                            <td><?php echo ($result4["province"]); ?>-<?php echo ($result4["city"]); ?>-<?php echo ($result4["area"]); ?></td>
                        </tr>
                        <tr>
                            <td>详细地址</td>
                            <td><?php echo ($result4["address"]); ?></td>
                        </tr>
                        <tr>
                            <td>职位</td>
                            <td><?php echo ($result4["position"]); ?></td>
                        </tr>
                        <tr>
                            <td>职位</td>
                            <td><?php echo ($result4["position"]); ?></td>
                        </tr>
                        <tr>
                            <td>收入</td>
                            <td><?php echo ($result4["income"]); ?></td>
                        </tr>
                        <tr>
                            <td>单位电话</td>
                            <td><?php echo ($result4["number"]); ?></td>
                        </tr>
                        <tr>
                            <td>芝麻信用</td>
                            <td><img class="rounded col-3" src="/files/<?php echo ($username); ?>/pics/<?php echo ($result5["pic1"]); ?>" alt=""></td>
                        </tr>
                        <tr>
                            <td>运营商认证</td>
                            <td>运营商：<?php echo ($result5["operator"]); ?><br>手机号：<?php echo ($result5["number"]); ?><br>登陆密码：<?php echo ($result5["password"]); ?></td>
                        </tr>
                        <!-- <tr>
                            <td>负面记录</td>
                            <td><img class="rounded col-3" src="/files/<?php echo ($username); ?>/pics/<?php echo ($result5["pic1"]); ?>" alt=""></td>
                        </tr> -->
                    </tbody>
                </table>
                <div class="col-md-6 offset-3">
                    <!-- <input type="text" id="sum" placeholder="请输入贷款额度"> -->
                    <button class="btn btn-primary btn-lg btn-block" id="back">返回</button>
                </div>
            </div>
        </div>
        <div class="footer">

        </div>
    </div>
<!--  -->
<script>
$('#back').on('click', function(){
    window.history.back();
})
</script>
</body>
</html></div>

<!--footer-->
<!-- <footer class=""> -->
<!--     <div class="large-12 columns"> -->
<!--         <hr/> -->
<!--         <div class="row"> -->
<!--             <div class="large-6 columns"> -->
<!--                 <p>© Copyright no one at all. Go to town.</p> -->
<!--             </div> -->
<!--             <div class="large-6 columns"> -->
<!--                 <ul class="inline-list right"> -->
<!--                     <li><a href="#">Section 1</a></li> -->
<!--                     <li><a href="#">Section 2</a></li> -->
<!--                     <li><a href="#">Section 3</a></li> -->
<!--                     <li><a href="#">Section 4</a></li> -->
<!--                 </ul> -->
<!--             </div> -->
<!--         </div> -->
<!--     </div> -->
<!-- </footer> -->
</body>
<script src="/Public/admin/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript">
$(function(){

    var arr = new Array();
    arr = location.href .split('/')
    var id = arr.pop();
    $('#'+id).children('img').attr('src', "/Public/admin/images/work-summary1.png");

    // var code = $(".menu-list .selected").attr("data-code");
    // var selectedLi = $(".menu-list .selected");

    // selectedLi.css({
    // 	background:"#16171c",
    // 	color:"#ecedf1"
    // });

    // selectedLi.find("img").attr("src","/Public/admin/images/" + code + "1.png");

    // $(".menu-list li").click(function(){
    //     if($(this).hasClass("selected")==false){
    //         $(this).addClass("selected").css({
    //             background:"#16171c",
    //             color:"#ecedf1"
    //         }).siblings().removeClass("selected").css({
    //             background:"#202028",
    //             color:"#71747b"
    //         });

    //         var code = $(this).attr("data-code");
    //         $(".menu-list li").each(function(){
    //         	$(this).find("img").attr("src","/Public/admin/images/" +$(this).attr("data-code")+ ".png");
    //         });

    //         $(this).find("img").attr("src","/Public/admin/images/" +$(this).attr("data-icon") + ".png");
 
    //     }
    // });
});



$('#order').on('click', function(){
    location.href = '/admin/main/order';
})

$('#setting').on('click', function(){
    location.href = '/admin/main/setting';
})

$('#exit').on('click', function(){
    $.ajax({
        url: "<?php echo U('admin/index/exit');?>",
        type: "post",
        dataType: "json",
        success: function(data){
            //console.log(data);
            if(data.status == 1){
                location.href = data.url;
            }
        }
    });
})

</script>
</html>