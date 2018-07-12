<?php

namespace Desk\Controller;

use Think\Controller;

class MainController extends BaseController{
    public function index(){
        if(IS_AJAX){
            $this->success('成功', '/desk/main/index');
        }

        $this->display();
    }
}