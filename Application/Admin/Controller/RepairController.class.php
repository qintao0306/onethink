<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 14:58
 */

namespace Admin\Controller;


use Think\Page;
use Think\View;

class RepairController extends AdminController
{
    public function index(){
        /* 获取频道列表 */
         $status_all=[
            2=>'待处理',
            1=>'处理中',
            0=>'已处理',
        ];

        $map = array('status'=>array('gt',-1));
        $count=M('Repair')->where($map)->count();
        $page = new Page($count,10);
        //分页输出
        $show = $page->show();

        $list = M('Repair')->where($map)->order('id asc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('status_all', $status_all);
        $this->meta_title = '报修管理';
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
            if($data){
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

    public function changeStatus($method=null){

        if ( empty($_REQUEST['id']) ) {
            $this->error('请选择要操作的数据!');
        }
        switch ( strtolower($method) ){
            case 'forbid':
                $this->resume('Repair',[],array( 'success'=>'正在处理中！', 'error'=>'处理失败！'));
                break;
            case 'resume':
                $this->forbid('Repair',[],array( 'success'=>'处理完成！', 'error'=>'处理失败！'));
                break;
            case 'delete':
                $this->delete('Repair',[],array( 'success'=>'删除成功！', 'error'=>'删除失败！'));
                break;
            default:
                $this->error($method.'参数非法');
        }
    }




}