<?php

namespace Desk\Controller;

use Think\Controller;

require dirname(__DIR__) . '/Api/Sms.php';
/**
 * 
 */
class EntryController extends Controller{

    public $rule_login = array(

    );

    //注册验证规则
    public $rule_register = array(
        array('username','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
   );

    //登录
    public function login(){
        
        if(IS_AJAX){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = M('user');
            $result = $user->where("username='$username' and password='$password'")->find();
            if($result){
                $uid = $user->where("username='$username'")->getField('uid');
                session('uid', $uid);
                session('username', $username);
                $this->success('登陆成功', '/desk/main/index');
            }else{
                $this->error('用户名或密码错误');
            }
        }
        $this->display();
    }

    //注册
    public function register(){

        if(IS_AJAX){
            $username = $_POST['username'];
            $captcha = $_POST['captcha'];
            $code = $_POST['code'];         //获取用户输入的推荐码
            $pid = self::checkCode($code);  //检测推荐码，获取该推荐码所属的用户id

            if($pid == 0){
                $level = 1;
            }else{
                $level = $user = M('user')->where("uid='$pid'")->getField('level');
                $level = $level + 1;
            }

            $data = array(
                'username' => $username,
                'nickname' => $_POST['nickname'],
                'password' => $_POST['password'],
                'pid' => $pid,
                'code' => md5($username),      //md5方式生成唯一推荐码
                'create_time' => date('Y:m:d H:i:s'),
                'level' => $level
            );

            if($username != $_SESSION['number']){
                $this->error('验证码错误');
                exit();
            }

            if($captcha != $_SESSION['captcha']){
                $this->error('验证码错误');
                exit();
            }

            $user = M('user');
            if($user->validate($this->rule_register)->create()){
                $result = $user->data($data)->add();
                if($result){
                    $uid = $user->where("username='$username'")->getField('uid');
                    $user_info = M('user_info');
                    $user_info->execute("insert into user_info(uid,number,head) values('$uid','$username','我是图片')");
                    self::createFile($username);
                    session('number', null);
                    session('captcha', null);
                    $this->success('注册成功，即将跳转登录页面');
                }
            }else{
                $this->error($user->getError());
            }
        }
        $this->display();
    }

    //忘记密码
    public function forget(){
        if(IS_AJAX){
            $username = $_POST['username'];
            $captcha = $_POST['captcha'];
            $password = $_POST['password'];
            $user = M('user');
            $username = $user->where("username='$username'")->getField('username');

            if(!$username){
                $this->success('未注册的账号，请先注册');
            }

            if($username != $_SESSION['number']){
                $this->error('验证码错误');
            }

            if($captcha != $_SESSION['captcha']){
                $this->error('验证码错误');
            }

            $data = [
                'password' => $password
            ];
            $result = $user->where("username='$username'")->data($data)->save();
            if($result){
                session('number', null);
                session('captcha', null);
                $this->success('密码修改成功', '/desk/entry/login');
            }else{
                $this->error('密码修改失败');
            }

        }

        $this->display();
        
    }

    public function recommendation(){
        if(IS_AJAX){
            $code = $_POST['code'];
            $user = M('user');
            $result = $user->where("code='$code'")->find();
            if($result){
                session('uid', $result['uid']);
                session('username', $result['username']);
                $this->success('登陆成功', '/desk/main/index');
            }else{
                $this->error('登陆失败');
            }
        }

        $this->display();
    }

    //获取验证码
    public function getCaptcha(){

        $number = $_POST['username'];
        $captcha = mt_rand(100000, 999999);
        session('number', $number);             //将用户输入的number存储在session中
        session('captcha', $captcha);
        $response = \Api\Sms::sendSms($number, $captcha);
        if($response->Message == 'OK'){
            $this->success('发送成功');
        }else{
            $this->error('发送失败');
        }
    
    }

    //推荐码判断
    public function checkCode($code){

        if($code == ''){
            return 0;
        }

        $user = M('user');
        $result = $user->where("code='$code'")->getField("uid");
        if($result){
            return $result;
        }else{
            $this->error('您输入的推荐码有误');
        }
    }

    //创建用户文件夹
    public function createFile($username){

        $heads = 'files/' . $username . '/heads';
        $pics = 'files/' . $username . '/pics';
        if(!is_dir($heads)){
            mkdir($heads, 0777, true);
        }
        if(!is_dir($pics)){
            mkdir($pics, 0777, true);
        }

    }
	
	//H5注册
        public function h5register(){

            if(IS_AJAX){
                $username = $_POST['username'];
                $captcha = $_POST['captcha'];
                $code = $_POST['code'];         //获取用户输入的推荐码
                $pid = self::checkCode($code);  //检测推荐码，获取该推荐码所属的用户id
    
                if($pid == 0){
                    $level = 1;
                }else{
                    $level = $user = M('user')->where("uid='$pid'")->getField('level');
                    $level = $level + 1;
                }
    
                $data = array(
                    'username' => $username,
                    'nickname' => $_POST['nickname'],
                    'password' => $_POST['password'],
                    'pid' => $pid,
                    'code' => md5($username),      //md5方式生成唯一推荐码
                    'create_time' => date('Y:m:d H:i:s'),
                    'level' => $level
                );
    
                if($username != $_SESSION['number']){
                    $this->error('验证码错误');
                    exit();
                }
    
                if($captcha != $_SESSION['captcha']){
                    $this->error('验证码错误');
                    exit();
                }
    
                $user = M('user');
                if($user->validate($this->rule_register)->create()){
                    $result = $user->data($data)->add();
                    if($result){
                        $uid = $user->where("username='$username'")->getField('uid');
                        $user_info = M('user_info');
                        $user_info->execute("insert into user_info(uid,number,head) values('$uid','$username','我是图片')");
                        self::createFile($username);
                        session('number', null);
                        session('captcha', null);
                        $this->success('注册成功，即将跳转下载页');
                    }
                }else{
                    $this->error($user->getError());
                }
            }
            $this->display();
        }
		
		public function tijiao(){
			$this->display();
		}
}