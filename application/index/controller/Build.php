<?php
namespace app\index\controller;

use think\Controller;

/**
 * 
 */
class Build extends Controller
{
    
    public function initialize()
    { 
       
    }
    
    
    public function elasticsearch() {
        $build = include APP_PATH.'build.php';//在能直接访问的方法中,引入需要执行的文件
        \think\Build::run($build);//执行文件
        return '成功';
    }
    
   
}


