<?php
namespace app\index\controller\tp;

use think\Controller;

use app\facade\FacadeTest as Test1;
use app\comm\FacadeTest as Test2;
use app\facade\MyFacadeTest as Test3;

//容器（Container）实现类的统一管理，确保对象实例的唯一性。

//门面（Facade）为容器（Container）中的类提供了一个静态调用接口，相比于传统的静态方法调用， 
//带来了更好的可测试性和扩展性，你可以为任何的非静态类库定义一个facade类。
class FacadeTest extends Controller
{
    protected function initialize(){
        parent::initialize();
        
        //没有继承时候，你用self::class 和 static::class是一样的，都是获取当前类名
        //self指向的是当前方法存在的这个类，也就是父类。static指向的是最终那个子类
        echo __CLASS__.'<br/>';//app\index\controller\FacadeTest  当前类
        echo static::class.'<br/>';//app\index\controller\FacadeTest  子类
        echo self::class.'<br/>';//app\index\controller\FacadeTest   当前类
        
        //门面（Facade）原理 不存在的静态方法
        //__callStatic($method, $params)
        //call_user_func_array();
        
        //单例模式
        //new self() 返回的实列是不会变的，无论谁去调用，都返回的一个类的实列，
        //new static则是由调用者决定的。
        
        //反射 自动加载插件，自动生成文档，甚至可用来扩充PHP语言
        //ReflectionClass
    }
    
    public function index()
    {
        Test1::index();
        Test1::index2();
        
        $test2 = new Test2;
        $test2->index();
        Test2::index2();
        
        
        Test3::index();
        Test3::index2(['name' => 10], 100);
    }
}

