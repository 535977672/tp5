<?php
namespace app\index\controller;
use think\Controller;
use think\View;

class Controllers extends Controller
{
    //1. 前置操作方法
    protected $beforeActionList = [
        'first', //无值的话为当前控制器下所有方法的前置方法。
        'second' => ['except' => 'indexPage,configPage'], //表示这些方法不使用前置方法，
        'three' => ['only' => 'indexPage'] //表示只有这些方法使用前置方法。
    ];


    //2. 初始化 __construct
    public function _initialize() {
        echo 'init<br/>';
    }

    //前置
    protected function first() {
        echo 'first<br/>';
    }
    protected function second() {
        echo 'second<br/>';
    }
    protected function three() {
        echo 'three<br/>';
    }

    public function indexPage()
    {
        dump('欢迎1');////视图文件在view_path
        return $this->fetch('index');
    }
    
    public function viewIndexPage()
    {
        dump('欢迎2');
        $view = new View();//视图文件在view
        return $view->fetch('index');
    }
    
    
    public function configPage()
    {
        //dump(config());
        dump(Config::get());
    }
    
    /**
     * 3. 跳转和重定向qqe
     */
    public function jumpPage()
    {
        //'dispatch_success_tmpl'  => APP_PATH . BIND_MODULE . DS . 'template' . DS . 'comm' . DS .   'dispatch_jump.tpl',
        //'dispatch_error_tmpl'    => APP_PATH . BIND_MODULE . DS . 'template' . DS . 'comm' . DS .   'dispatch_jump.tpl',
        //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
        //$this->success('成功', 'index/index');
        $this->success('成功'); //重新访问当前页面
        
        
        //错误页面的默认跳转页面是返回前一页，通常不需要设置
        //$this->error('失败');
        
        //重定向
        //$this->redirect('index/index');
        //$this->redirect('https://www.baidu.com/index.php?tn=02049043_32_pg');
        //return redirect('index/index')->remember();
        //需要跳转到上次记住的URL的时候使用：
        //redirect()->restore();
    }
    
    /**
     * 4. 空操作 找不到指定的操作方法的时候，会定位到空操作（_empty）方法来执行，利用这个机制，我们可以实现错误页面和一些URL的优化。
     */
    public function _empty($name)
    {
        echo '空操作'.$name.'<br/>';
    }    
    
}
