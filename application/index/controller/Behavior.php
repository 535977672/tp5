<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Hook;
/**
 * 
 */
class Behavior extends Controller
{
    
    public function initialize()
    { 
       
    }
    
    
    public function index() {
        
        // 注册 app\behavior\Test行为类到app_init标签位
        //Hook::add('app_init','app\\behavior\\Test'); 
        
        //直接执行行为 默认run
        $result = Hook::exec('app\\behavior\\Test', [1,2,3]);//run
        //执行行为类的其它方法
        $result = Hook::exec(['app\\behavior\\Test', 'fun1']);//run
        
        return '成功';
    }
    
   
}


