<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/js/popper.min.js"></script>
    <script src="/Public/assets/js/bootstrap.min.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>
    <link rel="stylesheet" href="/Public/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2></h2>
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
                        <tr style="display: none">
                            <td>loan_id</td>
                            <td id="loan_id"><?php echo ($loan_id); ?></td>
                        </tr>
                        <tr>
                            <td>借款期限(天)</td>
                            <td><?php echo ($result1["deadline"]); ?></td>
                        </tr>
                        <tr>
                            <td>还款金额</td>
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
                        <tr>
                            <td>通讯录</td>
                            <td><?php if(is_array($result6)): $i = 0; $__LIST__ = $result6;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($i % 2 );++$i;?>姓名：<?php echo ($res["name"]); ?><br>手机号：<?php echo ($res["phone"]); ?><br><hr><?php endforeach; endif; else: echo "" ;endif; ?></td>
                        </tr>
                        <!-- <tr>
                            <td>负面记录</td>
                            <td><img class="rounded col-3" src="/files/<?php echo ($username); ?>/pics/<?php echo ($result5["pic1"]); ?>" alt=""></td>
                        </tr> -->
                    </tbody>
                </table>
                <div class="col-md-6 offset-3">
                    <!-- <input type="text" id="sum" placeholder="请输入贷款额度"> -->
                    <!-- <button class="btn btn-primary btn-lg btn-block" id="yes">审核通过</button><button class="btn btn-danger btn-lg btn-block" id="no">审核不通过</button>
                    <div class="col-md-3"></div> -->
                </div>
            </div>
        </div>
        <div class="footer">

        </div>
    </div>
<!--  -->
<script>
$('#yes').on('click', function(){
    $.ajax({
        url: "<?php echo U('/admin/admin/check');?>",
        type: "post",
        dataType: "json",
        data: {
            loan_id: $('#loan_id').text(),
        },
        success: function(data){
            if(data.status == 1){
                $(document).dialog({
                    titleShow: false,
                    content: data.info,
                    onClickConfirmBtn: function(){
                        $('#search').click();
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
})
</script>
</body>
</html>