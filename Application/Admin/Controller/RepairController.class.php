<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 14:58
 */

namespace Admin\Controller;


use Think\View;

class RepairController extends AdminController
{
    public function index(){
        /* 获取频道列表 */
         $status_all=[
            0=>'待处理',
            1=>'处理中',
            2=>'已处理',
        ];
        $list = M('Repair')->order('id asc')->select();

        $this->assign('list', $list);
        $this->assign('status_all', $status_all);
        $this->meta_title = '报修管理';
        $this->display();
    }

    public function add(){

        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
            if($data){
                $Repair->sn=uniqid();
                $Repair->time=time();
                $id = $Repair->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_repair', 'repair', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Repair->getError());
            }
        }
        $this->display();
    }

    public function detail($id=0){
        $info = M('Repair')->find($id);
        $this->assign('info', $info);
        $this->meta_title = '查看详细';
        $this->display();
    }


    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Repair')->where($map)->delete()){
            //记录行为
            action_log('update_repair', 'repair', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }



}