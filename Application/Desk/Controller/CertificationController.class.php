<?php

namespace Desk\Controller;

use Think\Controller;

class CertificationController extends BaseController{

    //跳转至申请页面
    public function infoSubmit(){
        $uid = $_SESSION['uid'];
        $user = M('user_info');
        $sign = $user->where("uid='$uid'")->getField('sign');
        if(!$sign){
            $this->error('请在个人中心上传您的签名', '/desk/center/personalCenter');
        }

        $setting = M('setting');
        $result = $setting->where("id=1")->find();
        $this->assign('result', $result);
        if(IS_AJAX){
            $this->success('成功', '/desk/certification/infoSubmit');
        }

        $this->display();
    }

    //填写申请信息，金额/姓名/电话
    public function writeLoan(){
        $uid = $_SESSION['uid'];
        $data = array(
            'uid' => $uid,
            'sum' => $_POST['sum'],
            'repay' => $_POST['repay'],
            'name' => $_POST['name'],
            'number' => $_POST['number'],
            'status' => 0
        );
        $loan = M('loan');
        $result = $loan->data($data)->add();
        if($result){
            session('loan_id', $result);        //暂时存储loan_id
            $this->success('成功', '/desk/certification/writeLoanInfo');
        }else{
            $this->error('失败');
        }
    }

    //填写申请信息，申请期限/月还/用途
    public function writeLoanInfo(){
        $loan_id = $_SESSION['loan_id'];
        $loan = M('loan');
        $sum = $loan->where("loan_id='$loan_id'")->getField('sum');
        $this->assign('sum', $sum);
        $setting = M('setting');
        $result = $setting->where("id=1")->getField('rate');
        $this->assign('result', $result);
        $deadline = M('deadline');
        $deadline = $deadline->where("status=1")->order('deadline asc')->select();
        $this->assign('deadline', $deadline);

        if(IS_AJAX){

            $data = array(
                'loan_id' => $loan_id,
                'rate' => $_POST['rate'],
                'deadline' => $_POST['deadline'],
                'mon_repay' => $_POST['mon_repay'],
                'use' => $_POST['use'],
                'create_time' => date("Y-m-d H:i:s"),
                'status' => 0
            );

            $loan_info = M('loan_info');
            $result = $loan_info->where("loan_id='$loan_id'")->find();

            if($result){
                $loan_info->where("lona_id='$loan_id'")->data($data)->save();
                $this->success('数据已存在', '/desk/certification/authentication');
            }

            $result = $loan_info->data($data)->add();
            if($result){
                $this->success('成功', '/desk/certification/authentication');
            }else{
                $this->error('失败');
            }

        }

        $this->display();
    }

    //认证主页面，同时判断认证是否完成
    public function authentication(){

        $flag = $_POST['flag'];
        $loan_id = $_SESSION['loan_id'];

        $identify = M('identify_one');
        $info = M('base_info');
        $seasame = M('seasame');
        $identify2 = M('identify_two');
        $result1 = $identify->where("loan_id='$loan_id'")->getField('loan_id');
        $result2 = $info->where("loan_id='$loan_id'")->find();
        $result3 = $seasame->where("loan_id='$loan_id'")->getField('loan_id');
        $result4 = $identify2->where("loan_id='$loan_id'")->getField('loan_id');
        if($result1){
            $flag1 = 'exist';
        }else{
            $flag1 = 'none';
        }
        if($result2){
            $flag2 = 'exist';
        }else{
            $flag2 = 'none';
        }
        if($result3){
            $flag3 = 'exist';
        }else{
            $flag3 = 'none';
        }
        if($result4){
            $flag4 = 'exist';
        }else{
            $flag4 = 'none';
        }
        $this->assign('flag1', $flag1);
        $this->assign('flag2', $flag2);
        $this->assign('flag3', $flag3);
        $this->assign('flag4', $flag4);
        $this->display();
    }

    //身份认证1
    public function identifyOne(){

        if(IS_AJAX){
            $loan_id = $_SESSION['loan_id'];
            $data['loan_id'] = $loan_id;
            $data['name1'] = $_POST['name1'];
            $data['number1'] = $_POST['number2'];
            $data['relation1'] = $_POST['relation1'];
            $data['name2'] = $_POST['name2'];
            $data['number2'] = $_POST['number2'];
            $data['relation2'] = $_POST['relation2'];
            $data['name3'] = $_POST['name3'];
            $data['number3'] = $_POST['number3'];
            $data['relation3'] = $_POST['relation3'];
            $data['status'] = 0;
            $identify = M('identify_one');
            $result = $identify->where("loan_id='$loan_id'")->find();
            if($result){
                $identify->where("loan_id='$loan_id'")->data($data)->save();
                $this->success('成功', '/desk/certification/identifyTwo');
            }
            if($identify->create()){
                $result = $identify->data($data)->add();
                if($result){
                    $this->success('成功', '/desk/certification/identifyTwo');
                }else{
                    $this->error('失败');
                }
            }else{
                $this->error($identify->getError());
            }
        }

        $this->display();

    }

    //身份认证2
    public function identifyTwo(){

        if(IS_AJAX){
            
            $username = $_SESSION['username'];
            //获取文件名
            $filename = [
                $_FILES['file1']['name'],
                $_FILES['file2']['name'],
                $_FILES['file3']['name'],
                $_FILES['file4']['name'],
            ];

            //获取图片临时存储位置
            $tmpname = [
                $_FILES['file1']['tmp_name'],
                $_FILES['file2']['tmp_name'],
                $_FILES['file3']['tmp_name'],
                $_FILES['file4']['tmp_name'],
            ];

            foreach($filename as $k => $v){
                $dir_name[$k] = dirname(dirname(dirname(__DIR__))) . '/' . 'files/' . $username . '/' . 'pics/' . $v;
                if(!move_uploaded_file($tmpname[$k], $dir_name[$k])){
                    $this->error('图片上传失败');
                }
            }

            $loan_id = $_SESSION['loan_id'];
            $card_number = $_POST['card_number'];
            $card_name = $_POST['card_name'];
            $identify = M('identify_two');
            $result = $identify->where("loan_id='$loan_id'")->find();

            if($result){
                $this->success('数据已存在', '/desk/certification/authentication');
            }

            $result = $identify->execute("insert into identify_two(loan_id,pic1,pic2,pic3,pic4,card_number,card_name,status) values('$loan_id', '$filename[0]', '$filename[1]', '$filename[2]', '$filename[3]', '$card_number', '$card_name', 0)");
            if($result){
                $this->success('成功', '/desk/certification/authentication');
            }else{
                // $certification->where("loan_id='$loan_id'")->delete();
                $this->error('资料提交失败，请重新填写');
            }
        }

        $this->display();
    }

    //填写基本信息
    public function writeInfo(){

        if(IS_AJAX){
            $loan_id = $_SESSION['loan_id'];
            $data = array(
                'loan_id' => $loan_id,
                'company' => $_POST['company'],
                'province' => $_POST['province'],
                'city' => $_POST['city'],
                'area' => $_POST['area'],
                'address' => $_POST['address'],
                'position' => $_POST['position'],
                'income' => $_POST['income'],
                'number' => $_POST['number'],
                'status' => 0
            );
            $info = M('base_info');
            $result = $info->where("loan_id='$loan_id'")->find();

            if($result){
                $info->where("loan_id='$loan_id'")->data($data)->save();
                $this->success('数据已存在', '/desk/certification/authentication');
            }

            $result = $info->data($data)->add();
            if($result){
                $this->success('成功', '/desk/certification/authentication');
            }else{
                $this->error('失败');
            }
        }

        $this->display();
    }

    //芝麻分/运营商/负面记录认证
    public function seasame(){

        if(IS_AJAX){
            $username = $_SESSION['username'];
            $loan_id = $_SESSION['loan_id'];
            $filename = $_FILES['file1']['name'];
            $tmpname = $_FILES['file1']['tmp_name'];

            $dir_name = dirname(dirname(dirname(__DIR__))) . '/' . 'files/' . $username . '/' . 'pics/' . $filename;
            if(!move_uploaded_file($tmpname, $dir_name)){
                $this->error('图片上传失败');
            }

            $data['pic1'] = $filename;
            $data['operator'] = $_POST['operator'];
            $data['number'] = $_POST['number'];
            $data['password'] = $_POST['password'];
            $data['status'] = 0;

            $seasame = M('seasame');
            $result = $seasame->where("loan_id='$loan_id'")->find();
            if($result){
                $seasame->where("loan_id='$loan_id'")->data($data)->save();
                $this->success('成功', '/desk/certification/authentication');
            }

            $data['loan_id'] = $loan_id;
            $result = $seasame->data($data)->add();
            if($result){
                $this->success('成功', '/desk/certification/authentication');
            }else{
                $this->error('失败');
            }
        }

        $this->display();
    }

    public function findingsOfAudit(){
        $loan_id = $_SESSION['loan_id'];
        $loan = M('loan');
        $sum = $loan->where("loan_id='$loan_id'")->getField('sum');
        $this->assign('sum', $sum);

        if(IS_AJAX){
            $data['status'] = 1;        //状态1，用户已提交审核
            $data['put_time'] = date('Y-m-d H:i:s');  //提交审核时间
            $result = $loan->where("loan_id='$loan_id'")->data($data)->save();
            if($result){
                $this->success('成功', '/desk/certification/findingsOfAudit');
            }else{
                $this->error('失败');
            }
        }

        $this->display();
    }

    public function postContacts(){

        $uid = $_SESSION['uid'];
        $contacts = $_POST;

		$contacts = json_decode($contacts['data'], true);
		//print_r($contacts);
        $contact = M('contact');
        $result = $contact->where("uid='$uid'")->select();
        $data['uid'] = $uid;
        foreach($contacts as $v){
            $name1 = $v['name'];          //通讯录中的姓名
            $name2 = $contact->where("name='$name1'")->getField('name');        //根据通讯录姓名查询
			if(empty($name1)){
				continue;
			}
            if(!$name2){
                $data['name'] = $v['name'];
                $data['phone'] = $v['phone'];
                $contact->data($data)->add();
            }else{
                $data['name'] = $v['name'];
                $data['phone'] = $v['phone'];
                $contact->where("name='$name1'")->data($data)->save();
            }
        }
        $this->success($_POST['data']);
    }

}