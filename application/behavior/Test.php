<?php
namespace app\behavior;

use think\Request;

/**
 * 行为定义
 */
class Test {
    
    //public function run($params){}
    //可以在行为方法中使用依赖注入
    public function run(Request $request, $params)
    {
        dump($params);
        echo '默认方法';
        // 行为逻辑
    }
    
    public function fun1($params)
    {
        dump($params);
        echo 'fun1方法';
        // 行为逻辑
    }
    
    public function fun2($params)
    {
        dump($params);
        echo 'fun2方法';
        // 行为逻辑
    }
}
