<?php

namespace Desk\Controller;

use Think\Controller;

class CenterController extends BaseController{
    //个人中心页面展示
    public function personalCenter(){
        $uid = $_SESSION['uid'];
        $user = M('user');
        $username = $user->where("uid=$uid")->getField('username');
        $nickname = $user->where("uid=$uid")->getField('nickname');
        $username = substr_replace($username,'****',3,4);
        $this->assign('username', $username);
        $this->assign('nickname', $nickname);

        if(IS_AJAX){
            $uid = $_SESSION['uid'];
            //$date = date('Y-m-d H:i');
            $message = M('message');
            $result = $message->where("uid=$uid")->order('send_time desc')->select();
            $this->assign('result', $result);
            if(!$result){
                exit();
            }
            if($result[0]['status'] == 0){
                $this->success('show');
            }
            // if(!$result){
            //     $this->success('show');
            // }
            // $loan = M('loan');
            // $result = $loan->where("uid='$uid' and status=4")->select();
            // foreach($result as $v){
            //     $dead_time = explode(' ', $v['dead_time']);
            //     if($date == $dead_time[0]){
            //         $loan_id = $v['loan_id'];
            //         $content = '你有一笔贷款即将到期，请及时还款';
            //         $message = M('message');
            //         $flag = $message->where("loan_id='$loan_id'")->find();
            //         if(!$flag){
            //             $data = [
            //                 'loan_id' => $loan_id,
            //                 'uid' => $uid,
            //                 'content' => $content,
            //                 'send_time' => date('Y-m-d H:i:s')
            //             ];
            //             $message->data($data)->add();
            //             $this->success('show');
            //         } 
            //     }
            // }
        }

        $this->display();
    }

    //三级分销
    public function distribution(){
        $uid = $_SESSION['uid'];
        $user = M('user');
        $code = $user->where("uid='$uid'")->getField('code');
        $this->assign('code', $code);
        $this->display();
    }

    //我的借款
    public function myLoan(){
        $uid = $_SESSION['uid'];
        $loan = M('loan');
        $result = $loan->where("uid='$uid' and status=4")->order('apply_time desc')->select();
        $this->assign('result', $result);

        $this->display();
    }

    //我的还款
    public function myRepay(){
        $uid = $_SESSION['uid'];
        $loan = M('loan');
        $result = $loan->where("uid='$uid' and status=5")->order('dead_time desc')->select();
        $this->assign('result', $result);

        $this->display();
    }

    //我要还款
    public function payBack(){
        $uid = $_SESSION['uid'];
        $loan = M('loan');
        $result = $loan->where("uid='$uid' and status=4")->order('apply_time desc')->select();
        $this->assign('result', $result);
        
        $this->display();
    }

    //修改密码
    public function changePassword(){

        if(IS_AJAX){
            $uid = $_SESSION['uid'];
            $old_password = $_POST['old_password'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            $user = M('user');
            $result = $user->where("uid=$uid")->getField('password');
            if($old_password == $result){
                $result = $user->execute("update user set password='$password' where uid='$uid'");
                if($result){
                    $this->success('密码修改成功', '/index.php/desk/center/personalCenter');
                }else{
                    $this->error('密码修改失败');
                }
            }else{
                $this->error('旧密码输入错误');
            }
        }

        $this->display();
    }

    //消息
    public function message(){

        $uid = $_SESSION['uid'];
        $message = M('message');
        $data['status'] = 1;
        $result = $message->where("uid='$uid'")->order('send_time desc')->select();
        $message->where("uid='$uid'")->data($data)->save();
        $this->assign('result', $result);

        if(IS_AJAX){
            $uid = $_SESSION['uid'];
            $message = M('message');
            $data['status'] = 1;
            $result = $message->where("uid='$uid'")->order('send_time desc')->select();
            $message->where("uid='$uid'")->data($data)->save();
            $this->assign('result', $result);
            $this->display();
            exit();
        }

        $this->display();
    }

    //签名
    public function sign(){
        $uid = $_SESSION['uid'];
        $info = M('user_info');
        $sign = $info->where("uid='$uid'")->getField('sign');
        $this->assign('sign', $sign);

        if(IS_AJAX){
            $uid = $_SESSION['uid'];
            $info = M('user_info');
            $sign = $info->where("uid='$uid'")->getField('sign');

            if($sign){
                $data = ['sign' => $_POST['sign']];
                $result = $info->where("uid='$uid'")->data($data)->save();
                if($result){
                    $this->success('修改签名成功', '/index.php/desk/center/personalCenter');
                }else{
                    $this->error('修改签名失败');
                }
            }else{
                $data = ['sign' => $_POST['sign']];
                $result = $info->where("uid='$uid'")->data($data)->save();
                if($result){
                    $this->success('保存签名成功', '/desk/center/personalCenter');
                }else{
                    $this->error('保存签名失败');
                }
            }
        }
        $this->display();
    }

    //联系客服  
    public function customService(){
        $code = M('two_code');
        $pic = $code->where("id=1")->getField('pic');
        $this->assign('pic', $pic);
        $this->display();
    }

    //退出登陆
    public function signOut(){
        if(IS_AJAX){
            session(null);
            $this->success('成功', '/desk/entry/login');
        }
    }
}