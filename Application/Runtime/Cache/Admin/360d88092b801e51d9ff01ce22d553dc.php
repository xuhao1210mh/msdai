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
            <h2></h2>
        </div>
        <div class="body">
            <div>
                <div class="panel panel-default">
                    <div class="panel-body" style="text-align: center;">
                        借款人申请表
                    </div>
                </div>

                <table class="table table-secondary table-hover text-center col-md-2">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th style="display: none">编号</th>
                            <th style="display: none">用户id</th>
                            <th>申请时间</th>
                            <th>金额</th>
                            <th>借款人姓名</th>
                            <th>借款人电话</th>
                            <th>到期时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                                <td><input type="checkbox"></td>
                                <td style="display: none;"><?php echo ($val["loan_id"]); ?></td>
                                <td style="display: none;"><?php echo ($val["uid"]); ?></td>
                                <td><?php echo ($val["apply_time"]); ?></td>
                                <td><?php echo ($val["sum"]); ?></td>
                                <td><?php echo ($val["name"]); ?></td>
                                <td><?php echo ($val["number"]); ?></td>
                                <td><?php echo ($val["dead_time"]); ?></td>
                                <!-- <td>
                                    <?php switch($val['status']): case "1": ?>待审核<?php break;?>
                                        <?php case "2": ?>审核通过<?php break;?>
                                        <?php case "3": ?>审核失败<?php break; endswitch;?>
                                </td> -->
                                <td><button class="btn btn-primary btn-sm btn-block check_loan_info">查看</button></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer">

        </div>
    </div>
<!--  -->
<script>
$('.check_loan_info').on('click', function(){
    var loan_id = $(this).parent().parent().children().eq(1).text();
    var uid = $(this).parent().parent().children().eq(2).text();
    location.href = '/admin/main/check?loan_id=' + loan_id + '&uid=' + uid;
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