<?php

namespace Admin\Controller;

//use Think\Controller;
use Admin\Controller\BaseController;

class AdminController extends BaseController{

    //welcome
    public function welcome(){
        $uid = $_SESSION['admin_id'];
        $admin = M('admin');
        $username = $admin->where("uid='$uid'")->getField('username');
        $this->assign('username', $username);
        $this->display();
    }

    //用户管理
    public function userList(){
        $username = $_GET['username'];
        if($username != ''){
            $user = M('user');
            $result = $user->where("username='$username'")->order('create_time desc')->select();
            $this->assign('result', $result);
            $this->display();
            exit();
        }

        $user = M('user');
        $result = $user->order('create_time desc')->select();
        $this->assign('result', $result);
        $this->display();
    }

    //用户删除
    public function delUser(){
        $uid = $_POST['uid'];
        $user = M('user');
        $result = $user->where("uid='$uid'")->delete();
        if($result){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    //登陆
    public function login(){

        if(IS_AJAX){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $admin = M('admin');
            $result = $admin->where("username='$username' and password='$password'")->getField('uid');
            if($result){
                $_SESSION['admin_id'] = $result;
                $this->success('登陆成功', '/admin/admin/index');
            }else{
                $this->error('登陆失败');
            }
        }
        $this->display();
    }

    public function index(){
        parent::checkLogin();
        $uid = $_SESSION['admin_id'];
        $admin = M('admin');
        $username = $admin->where("uid='$uid'")->getField('username');
        $this->assign('username', $username);
        $this->display();
    }

    //展示用户申请信息
    public function showLoan(){
        $name = $_GET['name'];
        if($name != ''){
            $loan = M('loan');
            $result = $loan->where("status=1 and name='$name'")->order('put_time desc')->select();
            $this->assign('result', $result);
            $this->display();
            exit();
        }

        $loan = M('loan');
        $result = $loan->where("status=1")->order('put_time desc')->select();
        $this->assign('result', $result);
        $this->display();
    }

    //对用户信息进行审核
    public function checkLoan(){

        $loan_id = $_GET['loan_id'];
        $uid = $_GET['uid'];
        $user = M('user');

        $this->assign('loan_id', $loan_id);

        $username = $user->where("uid='$uid'")->getField('username');
        $this->assign('username', $username);

        $loan = M('loan_info');
        $result1 = $loan->where("loan_id='$loan_id'")->find();
        $this->assign('result1', $result1);

        $identify1 = M('identify_one');
        $result2 = $identify1->where("loan_id='$loan_id'")->find();
        $this->assign('result2', $result2);

        $identify2 = M('identify_two');
        $result3 = $identify2->where("loan_id='$loan_id'")->find();
        $this->assign('result3', $result3);

        $info = M('base_info');
        $result4 = $info->where("loan_id='$loan_id'")->find();
        $this->assign('result4', $result4);

        $seasame = M('seasame');
        $result5 = $seasame->where("loan_id='$loan_id'")->find();

        $contact = M('contact');
        $result6 = $contact->where("uid='$uid'")->select();
        $this->assign('result6', $result6);
        $this->assign('result5', $result5);
        $this->display();
    }

    //审核通过。
    public function yes(){
        $loan_id = $_POST['loan_id'];
        $data['status'] = 2;
        $loan = M('loan');
        $result = $loan->where("loan_id='$loan_id'")->data($data)->save();
        if($result){
            $this->success('该用户通过审核');
        }else{
            $this->error($loan_id);
        }
    }

    //审核不通过
    public function no(){
        $loan_id = $_POST['loan_id'];
        $data['status'] = 3;
        $loan = M('loan');
        $result = $loan->where("loan_id='$loan_id'")->data($data)->save();
        if($result){
            $this->success('该用户未通过审核');
        }else{
            $this->error($loan_id);
        }
    }

    //借款人申请信息
    public function applyLoan(){
        $name = $_GET['name'];
        if($name != ''){
            $loan = M('loan');
            $result = $loan->where("status=4 and name='$name'")->order('apply_time desc')->select();
            $this->assign('result', $result);
            $this->display();
            exit();
        }

        $loan = M('loan');
        $result = $loan->where("status=4")->order('apply_time desc')->select();
        $this->assign('result', $result);
        $this->display();
    }

    //借款人凭证
    public function voucherDetails2(){

        $loan_id = $_GET['loan_id'];
        $uid = $_GET['uid'];

        $receipt = M('receipt');
        $result = $receipt->where("loan_id='$loan_id' and uid='$uid'")->find();
        $this->assign('result', $result);

        $dead_time = $receipt->where("loan_id='$loan_id' and uid='$uid'")->getField('dead_time');
        $again_time = $receipt->where("loan_id='$loan_id' and uid='$uid'")->getField('again_time');
        if($dead_time != $again_time){          //到期时间与初次到期时间不匹配，则展期，展示原时间
            $this->assign('isFlag', 1);
        }

        $this->display();
    }

    //删除借款人信息
    public function delete(){
        $loan_id = $_POST['loan_id'];
        $data['status'] = 0;
        $loan = M('loan');
        $result = $loan->where("loan_id='$loan_id'")->data($data)->save();
        if($result){
            $this->success('删除成功');
        }else{
            $this->error($loan_id);
        }
    }

    //还款记录
    public function repay(){
        $name = $_GET['name'];
        if($name != ''){
            $loan = M('loan');
            $result = $loan->where("status=5 and name='$name'")->order('apply_time desc')->select();
            $this->assign('result', $result);
            $this->display();
            exit();
        }

        $loan = M('loan');
        $result = $loan->where("status=5")->order('apply_time desc')->select();
        $this->assign('result', $result);
        $this->display();
    }

    //管理员信息
    public function adminList(){
        $admin = M('admin');
        $result = $admin->where("status=1")->order('uid asc')->select();
        // print_r($result);
        $this->assign('result', $result);
        if(IS_AJAX){
            $uid = $_POST['uid'];
            $data['status'] = 0;
            $result = $admin->where("uid='$uid'")->data($data)->save();
            if($result){
                $this->success('success');
            }else{
                $this->error('error');
            }
        }
        $this->display();
    }

    //增加管理员
    public function adminAdd(){
        if(IS_AJAX){
            $uid = $_POST['uid'];
            $username = $_POST['username'];
            $data = [
                'username' => $username,
                'number' => $_POST['number'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'status' => 1
            ];
            $admin = M('admin');
            $result = $admin->data($data)->add();
            if($result){
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }
        $this->display();
    }

    //管理员信息修改
    public function adminEdit(){
        $uid = $_GET['uid'];
        $admin = M('admin');
        $admin->where("uid='$uid'")->getField('uid');
        $this->assign('uid', $uid);

        if(IS_AJAX){
            $uid = $_POST['uid'];
            $username = $_POST['username'];
            $data = [
                'username' => $username,
                'number' => $_POST['number'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];
            $admin = M('admin');
            $result = $admin->where("uid='$uid'")->data($data)->save();
            if($result){
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }
        $this->display();
    }

    //平台设置
    public function setting(){
        $setting = M('setting');
        $result = $setting->where("id=1")->find();
        $this->assign('result', $result);
        $this->display();
    }

    public function settingEdit(){
        $setting = M('setting');
        $result = $setting->where("id=1")->find();
        $this->assign('result', $result);

        if(IS_AJAX){
            $data = [
                'sum' => $_POST['sum'],
                'poundage' => $_POST['poundage'],
                'rate' => $_POST['rate'],
            ];
            $setting = M('setting');
            $result = $setting->where("id=1")->data($data)->save();
            if($result){
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }

        $this->display();
    }

    //还款期限设置
    public function deadline(){
        $deadline = M('deadline');
        $result = $deadline->where("status=1")->select();
        $this->assign('result', $result);
        if(IS_AJAX){
            $id = $_POST['id'];
            $data['status'] = 0;
            $result = $deadline->where("id='$id'")->data($data)->save();
            if($result){
                $this->success('success');
            }else{
                $this->error('fail');
            }
        }
        $this->display();
    }

    //增加还款期限
    public function deadlineAdd(){
        if(IS_AJAX){
            $deadline = M('deadline');
            $data['deadline'] = $_POST['deadline'];
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['status'] = 1;
            $result = $deadline->data($data)->add();
            if($result){
                $this->success('success');
            }else{
                $this->error('fail');
            }
        }
        $this->display();
    }

    public function delDeadline(){
        if(IS_AJAX){
            $id = $_POST['id'];
            $deadline = M('deadline');
            $result = $deadline->where("id=$id")->delete();
            if($result){
                $this->success('success');
            }else{
                $this->error('fail');
            }
        }
        $this->display();
    }

    //展示二维码
    public function twoCode(){
        $code = M('two_code');
        $result = $code->where('id=1')->find();
        $this->assign('result', $result);
        $this->display();
    }

    //上传二维码
    public function codeEdit(){
        if(IS_AJAX){
            $filename = $_FILES['file1']['name'];
            $tmpname = $_FILES['file1']['tmp_name'];

            $dir_name = dirname(dirname(dirname(__DIR__))) . '/' . 'Public/setting/' . $filename;
            if(!move_uploaded_file($tmpname, $dir_name)){
                $this->error('图片上传失败');
            }

            $data['name'] = $_POST['name'];
            $data['pic'] = $filename;
            $data['status'] = 1;

            $code = M('two_code');
            $result = $code->where("id=1")->data($data)->save();

            if($result){
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }
        $this->display();
    }

    //签名管理
    public function sign(){
        $sign = M('sign');
        $result = $sign->where("id=1")->find();
        $this->assign('result', $result);
        $this->display();
    }

    //修改签名
    public function signEdit(){
        if(IS_AJAX){
            $filename = $_FILES['file1']['name'];
            $tmpname = $_FILES['file1']['tmp_name'];

            $dir_name = dirname(dirname(dirname(__DIR__))) . '/' . 'Public/setting/' . $filename;
            if(!move_uploaded_file($tmpname, $dir_name)){
                $this->error('图片上传失败');
            }

            $data['name'] = $_POST['name'];
            $data['pic'] = $filename;
            $data['status'] = 1;

            $code = M('sign');
            $result = $code->where("id=1")->data($data)->save();

            if($result){
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }
        $this->display();
    }

    //撕毁借条
    public function clear(){
        $receipt_id = $_POST['receipt_id'];
        $receipt = M('receipt');
        $data['status'] = 3;        //status为3，表示借条已被撕毁
        $data['delete_time'] = date('Y-m-d');
        $loan_id = $receipt->where("receipt_id='$receipt_id'")->getField('loan_id');
        $repay = $receipt->where("receipt_id='$receipt_id'")->getField('repay');
        $data['fact_time'] = date('Y-m-d');

        $loan = M('loan');
        $data1['status'] = 5;       //借条撕毁，借款单关闭
        $data1['repay'] = $repay;
        $data1['dead_time'] = date('Y-m-d H:i:s');
        $loan->where("loan_id='$loan_id'")->data($data1)->save();
        $result = $receipt->where("receipt_id='$receipt_id'")->data($data)->save();
        if($result){
            $this->success('已撕毁');
        }else{
            $this->error('未知错误');
        }
    }

    //展期
    public function again(){
        $receipt_id = $_GET['receipt_id'];
        $this->assign('receipt_id', $receipt_id);
        if(IS_AJAX){
            $receipt_id = $_POST['receipt_id'];
            $day = $_POST['day'];
            $receipt = M('receipt');
            $dead_time = $receipt->where("receipt_id='$receipt_id'")->getField('dead_time');
            //$again_time = $receipt->where("receipt_id='$receipt_id'")->getField('again_time');
            //$data['again_time'] = $dead_time;
            $dead_time = date('Y-m-d H:i', strtotime("$dead_time + $day day"));

            $deadtime['dead_time'] = $dead_time . '00';
            $loan_id = $receipt->where("receipt_id='$receipt_id'")->getField('loan_id');
            $loan = M('loan');
            $loan->where("loan_id='$loan_id'")->data($deadtime)->save();

            $data['dead_time'] = $dead_time;
            $result = $receipt->where("receipt_id='$receipt_id'")->data($data)->save();
            if($result){
                $this->success('success');
            }else{
                $this->error('error');
            }
        }
        $this->display();
    }

    //发送信息
    public function collection(){
        $uid = $_GET['uid'];
        $this->assign('uid', $uid);
        if(IS_AJAX){
            $data['uid'] = $_POST['uid'];
            $data['content'] = $_POST['content'];
            $data['send_time'] = date('Y-m-d H:i');
            $data['status'] = 0;
            $message = M('message');
            $result = $message->data($data)->add();
            if($result){
                $this->success('success');
            }else{
                $this->error('error');
            }
        }
        $this->display();
    }
}