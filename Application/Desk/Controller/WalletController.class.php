<?php

namespace Desk\Controller;

use Think\Controller;

class WalletController extends BaseController{

    public function myWallet(){
        $uid = $_SESSION['uid'];
        $loan = M('loan');
        $result = $loan->where("uid='$uid' and (status='1' or status='2' or status='4')")->order('put_time desc')->select();
        $this->assign('result', $result);
        // $uid = $_SESSION['uid'];
        // $loan = M('loan');
        // $result = $loan->where("uid='$uid'")->select();
        // $this->assign('result', $result);
        $this->display();
    }

    public function withdraw(){
        $loan_id = $_POST['loan_id'];
        $loan_info = M('loan_info');
        $deadline = $loan_info->where("loan_id='$loan_id'")->getField('deadline');
        $date = date("Y-m-d H:i:s");

        $loan = M('loan');
        $data['status'] = 4;
        $data['apply_time'] = $date;
        $dead_time = date('Y-m-d H:i:s', strtotime("$date + $deadline day"));

        $data['dead_time'] = $dead_time;

        $result = $loan->where("loan_id='$loan_id'")->data($data)->save();
        if($result){
            //$this->success('申请成功，请等待工作人员处理', '/desk/wallet/myWallet');
            self::voucherDetails2($loan_id);
            $this->success('凭证生成成功，请扫描二维码联系工作人员');
        }else{
            $this->error('申请失败，请重试');
        }
    }

    //用户点击查看，展示凭借信息
    public function voucherDetails(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        $loan_id = end($uri);
        $uid = $_SESSION['uid'];

        $receipt = M('receipt');
        $result = $receipt->where("loan_id='$loan_id' and uid='$uid'")->find();
        $this->assign('result', $result);

        $dead_time = $receipt->where("loan_id='$loan_id' and uid='$uid'")->getField('dead_time');
        $again_time = $receipt->where("loan_id='$loan_id' and uid='$uid'")->getField('again_time');
        
        if($dead_time != $again_time){
            $this->assign('isFlag', 1);
        }

        $this->display();
    }

    //点击提现后，调用此方法，生成凭借
    public function voucherDetails2($loan_id){
        // $uri = $_SERVER['REQUEST_URI'];
        // $uri = explode('/', $uri);
        // $loan_id = end($uri);
        $data['loan_id'] = $loan_id;
        $uid = $_SESSION['uid'];
        $data['uid'] = $uid;

        $this->assign('loan_id', $data['loan_id']);

        $user = M('user');
        $info = M('user_info');
        $data['nickname'] = $user->where("uid='$uid'")->getField('nickname');
        //$number = $info->where("uid='$uid'")->getField('nickname');
        $data['sign'] = $info->where("uid='$uid'")->getField('sign');
        $this->assign('nickname', $data['nickname']);
        $this->assign('sign', $data['sign']);

        $sign1 = M('sign');
        $data['name'] = $sign1->where("id=1")->getField('name');
        $data['pic'] = $sign1->where("id=1")->getField('pic');
        $this->assign('name', $data['name']);
        $this->assign('pic', $data['pic']);

        $loan = M('loan');
        $apply_time = $loan->where("loan_id='$loan_id'")->getField('apply_time');
        $data['receipt_id'] = strtotime($apply_time);

        $this->assign('time', $data['receipt_id']);

        $apply_time = explode(' ', $apply_time);
        $data['apply_time'] = $apply_time[0];

        $dead_time = $loan->where("loan_id='$loan_id'")->getField('dead_time');
        $dead_time = explode(' ', $dead_time);
        $data['dead_time'] = $dead_time[0];

        $data['sum'] = $loan->where("loan_id='$loan_id'")->getField('sum');

        $loan_info = M('loan_info');
        $data['rate'] = $loan_info->where("loan_id='$loan_id'")->getField('rate'); 
        $data['repay'] = $loan_info->where("loan_id='$loan_id'")->getField('mon_repay');
        $data['use'] = $loan_info->where("loan_id='$loan_id'")->getField('use');
        $data['again_time'] = $dead_time[0];
        $data['status'] = 1;

        $this->assign('apply_time', $data['apply_time']);
        $this->assign('dead_time', $data['dead_time']);
        $this->assign('sum', $data['sum']);
        $this->assign('rate', $data['rate']);
        $this->assign('repay', $data['repay']);
        $this->assign('use', $data['use']);

        $receipt = M('receipt');
        $result = $receipt->data($data)->add();

    }

    //已废弃
    public function saveImg(){
        // $username = $_SESSION['username'];
        // $base64 = $_POST['image'];
        //$base64 = str_replace(' ', '+', $base64);
        // $img = \base64_decode($base64);
        // $filename = date('Y:m:d H:i:s') . 'png';
        // $dir_name = dirname(dirname(dirname(__DIR__))) . '/' . 'files/' . $username . '/' . 'heads/' . $filename;
        // file_put_contents($dir_name, $img);
        // $loan_id = $_POST['loan_id'];
        // $loan = M('loan');
        // $result = $loan->where("loan_id='$loan_id'")->data($data)->save();
        // if($result){
             //$this->success($img);
        // }else{
        //     $this->error('error');
        // }
    }

    //判断借款单状态
    public function checkStatus(){
        if(IS_AJAX){
            $loan_id = $_POST['loan_id'];
            $status = M('loan')->where("loan_id='$loan_id'")->getField('status');
            //审核通过
            if($status == 2 || $status == 4){
                $this->success('success', "/desk/wallet/findingsOfAudit?loan_id=$loan_id");
            }
            //待审核
            if($status == 1){
                $this->success('success', "/desk/wallet/waitResult?loan_id=$loan_id");
            }
            //审核不通过
            if($status == 3){
                $this->success('success', "/desk/wallet/noResult?loan_id=$loan_id");
            }
        }
    }

    //提交审核
    public function submit(){
        $loan_id = $_SESSION['loan_id'];
        $loan = M('loan');
        $data['status'] = 1;
        $data['put_time'] = date('Y:m:d H:i:s');
        $result = $loan->where("loan_id='$loan_id'")->data($data)->save();
        if($result){
            $this->success('success', '/desk/wallet/myWallet');
        }else{
            $this->error('提交失败');
        }
    }

    //审核通过状态
    public function findingsOfAudit(){
        $loan_id = $_GET['loan_id'];

        $code = M('two_code');
        $pic = $code->where("id=1")->getField('pic');

        $receipt = M('receipt');
        $result = $receipt->where("loan_id='$loan_id'")->find();
        if($result){
            $this->assign('flag', 'show');
        }else{
            $this->assign('flag', 'hide');
        }

        $this->assign('pic', $pic);
        $this->assign('loan_id', $loan_id);
        $this->display();
    }

    //等待审核状态
    public function waitResult(){
        $loan_id = $_GET['loan_id'];
        $this->assign('loan_id', $loan_id);
        $this->display();
    }

    //审核不通过状态
    public function noResult(){
        $loan_id = $_GET['loan_id'];
        $this->assign('loan_id', $loan_id);
        $this->display();
    }

    //删除订单
    public function delAll(){
        $loan_id = $_POST['loan_id'];
        $data['status'] = 0;
        $loan = M('loan');
        $result = $loan->where("loan_id='$loan_id'")->delete();

        if($result){
            $this->success('success', '/desk/wallet/myWallet');
        }else{
            $this->error('error');
        }
    }

}