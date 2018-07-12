<?php
namespace Admin\Controller;
use Think\Controller;
class MainController extends Controller {
    public function index(){
        $this->display();
    }

    public function order(){
        $loan = M('loan');
        $result = $loan->where("status=4")->order('apply_time desc')->select();
        $this->assign('result', $result);
        $this->display();
    }

    public function check(){
        $loan_id = $_GET['loan_id'];
        $uid = $_GET['uid'];
        $user = M('user');
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
        $this->assign('result5', $result5);
        $this->display();
    }

    public function setting(){
        $setting = M('setting');
        $result = $setting->select();
        $this->assign('result', $result);

        if(IS_AJAX){
            $sum = $_POST['sum'];
            $poundage = $_POST['poundage'];
            $rate = $_POST['rate'];
            $setting = M('setting');
            $result = $setting->execute("update setting set sum='$sum',poundage='$poundage',rate='$rate'");
            if($result){
                $this->success('成功', '/admin/main/setting');
            }else{
                $this->error('失败');
            }
        }

        $this->display();
    }
}