<?php

namespace Desk\Controller;

use Think\Controller;

class RepaymentController extends BaseController{
    public function execRepayment(){
        $loan_id = $_GET['loan_id'];

        $loan = M('loan');

        $sum = $loan->where("loan_id='$loan_id'")->getField('sum');
        $this->assign('sum', $sum);

        $repay = $loan->where("loan_id='$loan_id'")->getField('repay');
        $this->assign('repay', $repay);

        $apply_time = $loan->where("loan_id='$loan_id'")->getField('apply_time');
        $apply_time = explode(' ', $apply_time);

        $dead_time = $loan->where("loan_id='$loan_id'")->getField('dead_time');
        $dead_time = explode(' ', $dead_time);

        $setting = M('setting');
        $rate = $setting->where("id=1")->getField('rate');

        $this->assign('loan_id', $loan_id);
        $this->assign('apply_time', $apply_time[0]);
        $this->assign('dead_time', $dead_time[0]);
        $this->assign('rate', $rate);

        $this->display();
    }

    public function payMethod(){
        $loan_id = $_GET['loan_id'];
        $sum = $_GET['sum'];
        $this->assign('loan_id', $loan_id);
        $this->assign('sum', $sum);
        $this->display();
    }
}