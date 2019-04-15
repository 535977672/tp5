<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use \app\index\model\Test;

//读写分离
class Mysqlslave extends Controller
{
    

    public function selectPage(){
        // 设置当前模型的数据库连接
        //防火墙开启3306端口访问规则
        $connection =  [
            // 数据库类型
            'type'            => 'mysql',
            // 服务器地址
            'hostname'        => '127.0.0.1,192.168.1.112',
            // 数据库名
            'database'        => 'tp5',
            // 用户名
            'username'        => 'root,slave',
            // 密码
            'password'        => '11111111,11111111',
            // 端口
            'hostport'        => '3306,3306',
            // 连接dsn
            'dsn'             => '',
            // 数据库连接参数
            'params'          => [],
            // 数据库编码默认采用utf8
            'charset'         => 'utf8',
            // 数据库表前缀
            'prefix'          => '',
            // 数据库调试模式
            'debug'           => true,
            
            
            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy'          => 1,
            // 数据库读写是否分离 主从式有效
            'rw_separate'     => true,
            // 读写分离后 主服务器数量
            'master_num'      => 1,
            // 指定从服务器序号
            'slave_no'        => '',
            
            
            // 是否严格检查字段是否存在
            'fields_strict'   => true,
            // 数据集返回类型
            'resultset_type'  => 'array', //collection 数据集
            // 自动写入时间戳字段
            'auto_timestamp'  => false,
            // 时间字段取出后的默认时间格式
            'datetime_format' => 'Y-m-d H:i:s',
            // 是否需要进行SQL性能分析
            'sql_explain'     => false,
        ];
        $re = Db::connect($connection)->name('test1')->find(2); 
        var_dump($re);
      
        $test = Test::get(2);
        $re = $test->toArray();
        var_dump($re);
        
        $test = new Test;
        $re = $test->readMaster()->get(2)->toArray();
        var_dump($re);
    }
}
