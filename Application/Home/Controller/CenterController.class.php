<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14
 * Time: 17:56
 */

namespace Home\Controller;


use Think\Controller;

class CenterController extends Controller
{
    public function index(){

        $open_id = session('open_id');
        $user =D('member_id')->where(['open_id'=>$open_id])->find();
        var_dump($user);exit;


        $this->display();
    }


}