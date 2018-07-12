<?php

namespace Desk\Controller;

use Think\Controller;

class BaseController extends Controller {

    public function _initialize(){
        
        if($_SESSION['username'] == ''){
            $this->redirect('/desk/entry/login');
        }
        
    }

    // public function createFile($username){
    //     $path = 'files/' . $username;
    //     mkdir($path, 0777, true);
    // }

}