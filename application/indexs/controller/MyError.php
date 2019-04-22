<?php
namespace app\index\controller;
use think\Controller;

/**
 * 空控制器的概念是指当系统找不到指定的控制器名称的时候，系统会尝试定位空控制器(Error)，利用这个机制我们可以用来定制错误页面和进行URL的优化。
 * 'empty_controller'      => 'MyError',
 */
class MyError extends Controller
{
    public function indexPage()
    {
        //错误页面的默认跳转页面是返回前一页，通常不需要设置
        $this->error('失败');
        
    }
    
    /**
     * 空操作 找不到指定的操作方法的时候，会定位到空操作（_empty）方法来执行，利用这个机制，我们可以实现错误页面和一些URL的优化。
     */
    public function _empty($name)
    {
        echo '空操作1'.$name.'<br/>';
    } 
}
