<?php
namespace app\index\controller;

use think\Config;
use think\Controller;
use think\View;
use think\Debug;
use think\Loader;

class Index extends Controller
{
    public function indexPage()
    {
        dump('tp5测试');
    }
    
    public function configPage()
    {
        //读取配置参数
        //dump(config());//config('配置参数.二级参数'); 助手函数config
        dump(Config::get());
        
        ////使用set方法动态设置参数
        //Config::set('配置参数','配置值');
        // 或者使用助手函数
        //config('配置参数','配置值');
        
        //Config::set([
        //    '配置参数1'=>'配置值',
        //    '配置参数2'=>'配置值'
        //]);
        //// 或者使用助手函数
        //config([
        //    '配置参数1'=>'配置值',
        //    '配置参数2'=>'配置值'
        //]);
    }
    
    public function routePage($study='kancloud', $name='php')
    {
        dump($_GET);
        //http://tp5.test.com/index.php/index/index/route/dsds/ffff
        return '欢迎来'.$study.'学习'.$name.'开发技术~~';
    }
    
    
    /**
     * ***************************************视图***************************************
     */
    public function viewPage(){
        //fetch	渲染模板输出 display方法直接输出模板文件渲染后的内容，fetch方法是返回模板文件渲染后的内容
        //display	渲染内容输出
        //assign	模板变量赋值
        //engine	初始化模板引擎        
        
        //return $this->fetch();// index/view
        //return $this->fetch('index');  //index/index
        //return $this->fetch('controllers/index');
        //return  $this->fetch('index');
        
        //性能调试
        Debug::remark('begin');
        
        $this->assign('name', '淘宝');
        $data = [
            ['name' => 'AKM', 'code' => '1'],
            ['name' => 'AKM2', 'code' => '2'],
            ['name' => 'AKM3', 'code' => '3']
        ];
        $this->assign('list', $data);
        
        Debug::remark('end');
        echo Debug::getRangeTime('begin','end').'s';
        dump($data);
        
        return view();
    }
    
    //模板
    public function view2Page(){  
        $view = new View();
        $view->name = '淘宝';
        $data = [
            ['name' => 'AKM', 'code' => '1'],
            ['name' => 'AKM2', 'code' => '2'],
            ['name' => 'AKM3', 'code' => '3']
        ];
        $view->assign('list', $data);
        return $view->fetch(APP_PATH.request()->module().'/template/index/view.html');
    }
    
    //验证器 安全
    public function validatePage() {
        $data = [
            'name' => '验证器'
        ];
        //$validate = new Validate($rule, $msg);
        //$validate = validate('Test');
        $validate = Loader::validate('Test');
        if(!$validate->check($data)){
            echo $validate->getError();
        }
        
        //场景
        $validate->scene('edit', function($key,$data){
            dump($key);
        });
        if(!$validate->scene('edit')->check($data)){
            echo $validate->getError();
        }
        
        //控制器验证
        $result = $this->validate($data, 'Test.edit');
        //模型验证
        $model = new \app\index\model\Test;
        $result = $model->validate('Test.edit')->save($data);
        
        //表单令牌 可以有效防止表单的重复提交等安全防护
        
        //输入安全
        //设置public目录为唯一对外访问目录，不要把资源文件放入应用目录；
        //开启表单令牌验证避免数据的重复提交，能起到CSRF防御作用；
        //使用框架提供的请求变量获取方法（Request类param方法及input助手函数）而不是原生系统变量获取用户输入数据；
        //对不同的应用需求设置default_filter过滤规则（默认没有任何过滤规则），常见的安全过滤函数包括stripslashes、htmlentities、htmlspecialchars和strip_tags等，请根据业务场景选择最合适的过滤方法；
        //使用验证类或者验证方法对业务数据设置必要的验证规则；
        //如果可能开启强制路由或者设置MISS路由规则，严格规范每个URL请求；
        
        //数据库安全
        //尽量少使用数组查询条件而应该使用查询表达式替代；
        //尽量少使用字符串查询条件，如果不得已的情况下 使用手动参数绑定功能；
        //不要让用户输入决定要查询或者写入的字段；
        //对于敏感数据在输出的时候使用hidden方法进行隐藏；
        //对于数据的写入操作应当做好权限检查工作；
        //写入数据严格使用field方法限制写入字段；
        //对于需要输出到页面的数据做好必要的XSS过滤；      
        
        //上传安全 think\File
    }
    
    //杂项
    public function morePage(){
        
    }
}
