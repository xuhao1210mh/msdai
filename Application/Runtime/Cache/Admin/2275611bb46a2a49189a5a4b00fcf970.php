<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Public/assets/admin/css/font.css">
    <link rel="stylesheet" href="/Public/assets/admin/css/xadmin.css">
    <link rel="stylesheet" href="/Public/assets/css/dialog.css">
    <script type="text/javascript" src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/assets/admin/js/xadmin.js"></script>
    <script src="/Public/assets/js/dialog.min.js"></script>

</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">分秒速贷后台管理登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" >
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" id="username">
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input" id="password">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" id="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            // layui.use('form', function(){
            //   var form = layui.form;
            //   // layer.msg('玩命卖萌中', function(){
            //   //   //关闭后的操作
            //   //   });
            //   //监听提交
            //   form.on('submit(login)', function(data){
            //     // alert(888)
            //     layer.msg(JSON.stringify(data.field),function(){
            //         location.href='index.html'
            //     });
            //     return false;
            //   });
            // });
            $('#submit').on('click', function(){
                var username = $('#username').val();
                var password = $('#password').val();
                if(username == ''){
                    layer.msg('请输入用户名', {icon: 2});
                    return false;
                }
                if(password == ''){
                    layer.msg('请输入密码', {icon: 2});
                    return false;
                }

                $.ajax({
                    url: "<?php echo U('/admin/admin/login');?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(data){
                        if(data.status == 1){
                            location.href = data.url;
                        }else{
                            layer.msg(data.info, {icon: 2});
                            return false;
                        }
                    }
                })
            })
        })

        
    </script>

    
    <!-- 底部结束 -->
    <script>

    </script>
</body>
</html>