<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
set_time_limit(0);
ini_set('memory_limit', '-1');
class ct extends Controller
{
    public  $con1 = [
        // 数据库类型
        'type' => 'mysql',
        // 服务器地址
        'hostname'        => '127.0.0.1',
        // 数据库名
        'database'        => 'mycat',
        // 用户名
        'username' => 'root',
        // 密码
        'password' => 'root',
        // 端口
        'hostport' => '8066',
        // 连接dsn
        'dsn' => '',
        // 数据库连接参数
        'params' => [],
        // 数据库编码默认采用utf8
        'charset' => 'utf8',
        // 数据库表前缀
        'prefix' => '',
        // 数据库调试模式
        'debug' => false,
        // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        'deploy' => 0,
        // 数据库读写是否分离 主从式有效
        'rw_separate' => false,
        // 读写分离后 主服务器数量
        'master_num' => 1,
        // 指定从服务器序号
        'slave_no' => '',
        // 自动读取主库数据
        'read_master' => false,
        // 是否严格检查字段是否存在
        'fields_strict' => true,
        // 数据集返回类型
        'resultset_type' => 'array',
        // 自动写入时间戳字段
        'auto_timestamp' => false,
        // 时间字段取出后的默认时间格式
        'datetime_format' => 'Y-m-d H:i:s',
        // 是否需要进行SQL性能分析
        'sql_explain' => false,
        // Builder类
        'builder' => '',
        // Query类
        'query' => '\\think\\db\\Query',
        // 是否需要断线重连
        'break_reconnect' => false,
        // 断线标识字符串
        'break_match_str' => [],
    ];
    
    public  $con2 = [
        // 数据库类型
        'type' => 'mysql',
        // 服务器地址
        'hostname'        => '127.0.0.1',
        // 数据库名
        'database'        => 'mycat',
        // 用户名
        'username' => 'root',
        // 密码
        'password' => 'root',
        // 端口
        'hostport' => '8066',
        // 连接dsn
        'dsn' => '',
        // 数据库连接参数
        'params' => [],
        // 数据库编码默认采用utf8
        'charset' => 'utf8',
        // 数据库表前缀
        'prefix' => '',
        // 数据库调试模式
        'debug' => false,
        // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        'deploy' => 0,
        // 数据库读写是否分离 主从式有效
        'rw_separate' => false,
        // 读写分离后 主服务器数量
        'master_num' => 1,
        // 指定从服务器序号
        'slave_no' => '',
        // 自动读取主库数据
        'read_master' => false,
        // 是否严格检查字段是否存在
        'fields_strict' => true,
        // 数据集返回类型
        'resultset_type' => 'array',
        // 自动写入时间戳字段
        'auto_timestamp' => false,
        // 时间字段取出后的默认时间格式
        'datetime_format' => 'Y-m-d H:i:s',
        // 是否需要进行SQL性能分析
        'sql_explain' => false,
        // Builder类
        'builder' => '',
        // Query类
        'query' => '\\think\\db\\Query',
        // 是否需要断线重连
        'break_reconnect' => true,
        // 断线标识字符串
        'break_match_str' => [],
    ];
    
    public function index()
    { 
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        //$n = 100000000;
        $ns = [];
        $n = 100;
        $arr2 = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16'];
        for($i = 0; $i < $n; $i++){
            $arr1 = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33'];
            $r = [];
            for($j = 0; $j < 6; $j++){
                $t = array_rand($arr1);
                $r[] =$arr1[$t];
                unset($arr1[$t]);
            }
            sort($r, SORT_NUMERIC);
            $t2 = array_rand($arr2);
            $r[] = $arr2[$t2];
            
            $num = implode('', $r);
            $num = '01020309122813';
            //重复查询mycat报错General error: 1220 Unknown pstmtId when executing.
            //$rr = Db::connect($this->con1)->name('cai')->where('num', $num)->find();
            $rr = Db::connect($this->con1)->query("select * from `cai` where `num`=$num limit 1");
            if(!empty($rr)) {
                $nn = intval($rr[0]['n']) + 1;//echo 111;
                //mycat报错General error: 1220 Unknown pstmtId when executing.
                //Db::connect($this->con1)->name('cai')->where('num', $num)->update(['n' => $nn]);
                Db::connect($this->con1)->query("UPDATE `cai` SET `n`=$nn  WHERE `num`=$num");
            }else{
//                $kk = array_search($num, $ns);
//                if($kk === false){
//                    $nnn[] = ['num'=>$num, 'n' => 1];$ns[] = $num;
//                }else{
//                    $nnn[$kk]['n'] = $nnn[$kk]['n']+1;
//                }
//                if($i%10000 == 0 ||($i == $n-1)){
//                    Db::connect($this->con1)->name('cai')->data($nnn)->limit(300)->insertAll();
//                    $nnn = [];
//                    $ns = [];
//                }else if($i%300 == 0 ||($i == $n-1)){
//                    Db::connect($this->con1)->name('cai')->data($nnn)->limit(300)->insertAll();
//                    $nnn = [];
//                    $ns = [];
//                }
            }
            unset($arr1);
            unset($r);
            
            if($i%1000000 == 0){
                echo $i.'-'.date('H:i:s').'<br>';
                ob_flush();
                flush();
            }
        }
        ob_end_flush();
    }
    
    
    public function index2()
    { 
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        //$n = 100000000;
        $ns = [];
        $n = 100;
        $arr2 = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16'];
        for($i = 0; $i < $n; $i++){
            $arr1 = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33'];
            $r = [];
            for($j = 0; $j < 6; $j++){
                $t = array_rand($arr1);
                $r[] =$arr1[$t];
                unset($arr1[$t]);
            }
            sort($r, SORT_NUMERIC);
            $t2 = array_rand($arr2);
            $r[] = $arr2[$t2];
            
            $num = implode('', $r);
            $num = '01020309122813';
            //重复查询mycat报错General error: 1220 Unknown pstmtId when executing.
            //$rr = Db::connect($this->con1)->name('cai')->where('num', $num)->find();
            $rr = Db::connect($this->con1)->query("select * from `cai` where `num`=$num limit 1");
            if(!empty($rr)) {
                $nn = intval($rr[0]['n']) + 1;//echo 111;
                //mycat报错General error: 1220 Unknown pstmtId when executing.
                //Db::connect($this->con1)->name('cai')->where('num', $num)->update(['n' => $nn]);
                Db::connect($this->con1)->query("UPDATE `cai` SET `n`=$nn  WHERE `num`=$num");
            }else{
//                $kk = array_search($num, $ns);
//                if($kk === false){
//                    $nnn[] = ['num'=>$num, 'n' => 1];$ns[] = $num;
//                }else{
//                    $nnn[$kk]['n'] = $nnn[$kk]['n']+1;
//                }
//                if($i%10000 == 0 ||($i == $n-1)){
//                    Db::connect($this->con1)->name('cai')->data($nnn)->limit(300)->insertAll();
//                    $nnn = [];
//                    $ns = [];
//                }else if($i%300 == 0 ||($i == $n-1)){
//                    Db::connect($this->con1)->name('cai')->data($nnn)->limit(300)->insertAll();
//                    $nnn = [];
//                    $ns = [];
//                }
            }
            unset($arr1);
            unset($r);
            
            if($i%1000000 == 0){
                echo $i.'-'.date('H:i:s').'<br>';
                ob_flush();
                flush();
            }
        }
        ob_end_flush();
    }
    
    public function count()
    { 
        $count = Db::connect($this->con1)->name('cai')->count();
        var_dump($count);
    }
    
    public function sum()
    { 
        $sum = Db::connect($this->con1)->name('cai')->sum('n');
        var_dump($sum);
    }
    
    public function t()
    { 
        //mycat报错General error: 1220 Unknown pstmtId when executing.
        //$rr = Db::connect($this->con1)->name('cai')->where('num', 111)->select();
        //$rr = Db::connect($this->con1)->name('cai')->where('num', 1419098091)->select();
        
        $rr = Db::connect($this->con1)->query("select * from cai  limit 1");
        var_dump($rr[0]);
        $rr = Db::connect($this->con1)->query("select * from cai where num=06131719212707  limit 1");
        var_dump($rr);
        
    }
    
    
    
    public function max()
    { 
        $sum = Db::connect($this->con1)->name('cai')->max('n');
        var_dump($sum);
    }
    
        
    
    public function truncate()
    { 
        $r = Db::connect($this->con1)->query("TRUNCATE TABLE cai");
        var_dump($r);
    }
   
}
