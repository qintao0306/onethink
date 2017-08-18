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
        array('tel', 'require', '电话号码不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', '/^1[3|4|5|8][0-9]\d{4,8}$/', '电话号码不正确', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('title', 'require', '问题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('time', NOW_TIME, self::MODEL_INSERT),
        array('sn', 'uniqid', self::MODEL_INSERT,'function'),
        array('status', '2', self::MODEL_INSERT),

    );
}