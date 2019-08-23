<?php
namespace app\index\controller\tp;

use think\Controller;
use think\facade\Hook;
/**
 * 行为和钩子
 * 可以把行为想象成在应用执行过程中的一个动作
 * 行为发生作用的位置称之为钩子
 * 应用: 路由检测 静态缓存 权限检测 业务逻辑 浏览器检测 多语言检测等等
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
        
        //如果标签位有传入参数的话，闭包也可以支持传入参数
        //Hook::listen('钩子名称','参数','是否只有一次有效返回值');
        $params = [1,2,3];
        Hook::add('fun2','app\\behavior\\Test');
        Hook::listen('fun2',$params);
        
        //直接执行行为 默认run
        //add方法注册行为
        //$result = Hook::exec('app\\behavior\\Test', [1,2,3]);//run
        //执行行为类的其它方法
        //$result = Hook::exec(['app\\behavior\\Test', 'fun1'], [1,2,3]);//run
        
        //dump(Hook::get());
        //dump(Hook::__debugInfo());
        return '成功';
    }
    
   
}


