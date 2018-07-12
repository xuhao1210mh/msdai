<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/Public/assets/admin/css/font.css">
    <link rel="stylesheet" href="/Public/assets/admin/css/xadmin.css">
    <script type="text/javascript" src="/Public/assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/Public/assets/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/Public/assets/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">系统管理</a>
        <a>
          <cite>还款期限设置</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
          <xblock>
              <button class="layui-btn" onclick="x_admin_show('添加期限','deadlineAdd')"><i class="layui-icon"></i>添加</button>
            </xblock>
      </div>

      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>还款期限(天)</th>
            <th>创建时间</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
          <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
              <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
              </td>
              <td><?php echo ($val["id"]); ?></td>
              <td><?php echo ($val["deadline"]); ?>天</td>
              <td><?php echo ($val["create_time"]); ?></td>
              <td class="td-status">
                <span class="layui-btn layui-btn-normal layui-btn-mini">正常</span>
              </td>
              <td class="td-manage">
                <!-- <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                  <i class="layui-icon">&#xe601;</i>
                </a> -->
                <a title="删除" onclick="del(this,'要删除的id')" href="javascript:;">
                  <i class="layui-icon">&#xe640;</i>
                </a>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div class="page">
       
      </div>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function del(obj,id){
        layer.confirm('确认删除吗？',function(index){
            var id = $(obj).parent().parent().parent().find('td').eq(1).text();
              //发异步删除数据
              $.ajax({
                url: "<?php echo U('/admin/admin/delDeadline');?>",
                type: "post",
                dataType: "json",
                data: {
                    id: id,
                },
                success: function(data){
                    console.log(data.info);
                }
              })
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }


      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
  
  </body>

</html>