<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/10
 * Time: 16:09
 */

namespace Admin\Model;


use Think\Model;

class RepairModel extends Model
{
    public static $status=[
        0=>'待处理',
        1=>'处理中',
        2=>'已处理',
    ];
    protected $_validate = array(
        array('name', 'require', '姓名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );
}