<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
	<meta charset="UTF-8">
	<title>后台管理</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Public/assets/admin/css/font.css">
	<link rel="stylesheet" href="/Public/assets/admin/css/xadmin.css">
    <script type="text/javascript" src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/Public/assets/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/assets/admin/js/xadmin.js"></script>

</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="./index.html">分秒速贷后台管理</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            
            <!--  -->
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;"><?php echo ($username); ?></a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <!-- <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
              <dd><a onclick="x_admin_show('切换帐号','http://www.baidu.com')">切换帐号</a></dd> -->
              <dd><a href="./login.html">退出</a></dd>
            </dl>
          </li>
          <!-- <li class="layui-nav-item to-index"><a href="/">前台首页</a></li> -->
        </ul>
        
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="userList.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>用户管理</cite>
                        </a>
                    </li >
                    
                    <li>
                    
                        <ul class="sub-menu">
                            
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>贷款管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="showLoan.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>贷款人审核</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="applyLoan.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>贷款人申请</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="repay.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>还款记录</cite>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!--  -->
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="adminList.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ce;</i>
                    <cite>系统管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="setting.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>平台设置</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="deadline.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>还款期限设置</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="twoCode.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>上传二维码</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="sign.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>签名管理</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <!-- <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b4;</i>
                    <cite>退出系统</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a id="back">
                            <i>&#xe6a7;</i>
                            <cite>退出系统</cite>
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='./welcome.html' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©2017 x-admin v2.3 All Rights Reserved</div>  
    </div>
    <!-- 底部结束 -->
    <script>
    // $('#back').on('click', function(){
    //     location.href = '/admin/admin/login';
    // })
    </script>

</body>
</html>