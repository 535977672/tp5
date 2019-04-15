<?php
namespace app\index\model;
use think\Model;

/**
 * 
 */
class Test extends Model{
    protected $pk = 'id'; //默认主键
    protected $table = 'test1'; //设置数据表    
   
    protected $autoWriteTimestamp = 'datetime'; //动写入创建和更新的时间戳字段
    // 定义时间戳字段名
    protected $createTime = 'create_time_ymd';
    protected $updateTime = 'update_time_ymd';
    // 关闭自动写入update_time字段
    //protected $updateTime = false;
    
    //只读字段用来保护某些特殊的字段值不被更改，这个字段的值一旦写入，就无法更改。
    protected $readonly = ['num'];
    
    //支持给字段设置类型自动转换
    protected $type = [
        'num' => 'integer' //integer float boolean array object  serialize json timestamp datetime
    ];

    //数据自动完成指在不需要手动赋值的情况下对字段的值进行处理后写入数据库。
    //开发者需要理清“修改器”与“自动完成”的关系。
    protected $auto = [];
    protected $insert = ['status' => 1];  //优先save($data)
    protected $update = [];
    // 设置当前模型的数据库连接
    //防火墙开启3306端口访问规则
    protected $connection =  [
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
            // 主库写入后从主从库读取
            'read_master'	=> true,
            
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
        
        
//        protected $connection =  [
//            // 数据库类型
//            'type'            => 'mysql',
//            // 服务器地址
//            'hostname'        => '127.0.0.1',
//            // 数据库名
//            'database'        => 'tp5',
//            // 用户名
//            'username'        => 'root',
//            // 密码
//            'password'        => '11111111',
//            // 端口
//            'hostport'        => '3306',
//            // 连接dsn
//            'dsn'             => '',
//            // 数据库连接参数
//            'params'          => [],
//            // 数据库编码默认采用utf8
//            'charset'         => 'utf8',
//            // 数据库表前缀
//            'prefix'          => '',
//            // 数据库调试模式
//            'debug'           => true,
//            
//            
//            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
//            'deploy'          => 0,
//            // 数据库读写是否分离 主从式有效
//            'rw_separate'     => false,
//            // 读写分离后 主服务器数量
//            'master_num'      => 1,
//            // 指定从服务器序号
//            'slave_no'        => '',
//            
//            
//            // 是否严格检查字段是否存在
//            'fields_strict'   => true,
//            // 数据集返回类型
//            'resultset_type'  => 'array', //collection 数据集
//            // 自动写入时间戳字段
//            'auto_timestamp'  => false,
//            // 时间字段取出后的默认时间格式
//            'datetime_format' => 'Y-m-d H:i:s',
//            // 是否需要进行SQL性能分析
//            'sql_explain'     => false,
//        ];

    // 定义全局的查询范围
    protected function base($query)
    {
        $query->where('status',1);
    }
    
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    
    //自定义初始化
    protected static function init(){
        
        //模型事件
        Test::event('before_insert', function($m){
            if($m['code'] != 2){
                return false;
            }
        }); 
    }

    

    //拾取器
    public function getCodeAttr($value)
    {
        return $value . '-拾取器';
    }
    
    //获取器还可以定义数据表中不存在的字段 $re->code_text;获取 ->append(['code_text'])->toArray()
    public function getCodeTextAttr($value, $data)
    {
        return $data['code'] . '-Text-拾取器';
    }
    
    //修改器的作用是可以在数据赋值的时候自动进行转换处理
    public function setXiuAttr($value)
    {
        return $value . '-修改器';
    }
    
    /**
     * 关联模型
     */
    // 一对一关联
    public function test2(){
        return $this->hasOne('Test2', 't1_id', 'id', 'LEFT')->bind(['t2code' => 'code'])->field('t1_id,code,data,name')->setEagerlyType(0);
    }
}
