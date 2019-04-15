<?php
namespace app\index\service;
use think\Model;

/**
 * 
 */
class Test extends Model{
    protected $pk = 'id'; //默认主键
    protected $table = 'test1'; //设置数据表   
    
    
    public function layer()
    {
        $re = $this->where('code', 4)->find();
        return $re->toArray();
    }
    
}
