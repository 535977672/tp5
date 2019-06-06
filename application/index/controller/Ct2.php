<?php
namespace app\index\controller;

set_time_limit(0);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
ini_set('display_errors', '1');

use think\Controller;
use think\Db;
use \PDO;
class Ct2 extends Controller
{
    public  $con1 = [
        // 数据库类型
        'type' => 'mysql',
        // 服务器地址
        'hostname'        => '119.3.161.184',//华为云mysql
        // 数据库名
        'database'        => 'cp',
        // 用户名
        'username' => 'root',
        // 密码
        'password' => 'Wd23@*ds3dD',
        // 端口
        'hostport' => '3306',
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
    
    public $table = 'cp190606';
    

    public function index()
    {
        
        //持久连接 PDO::ATTR_PERSISTENT
        $conn = new PDO("mysql:host=119.3.161.184:3306;dbname=cp", 'root', 'Wd23@*ds3dD',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'', PDO::ATTR_PERSISTENT => true));
        $stmt1 = $conn->prepare("select * from $this->table where num = :num limit 1");
        $stmt2 = $conn->prepare("UPDATE $this->table SET n = :nn  WHERE id = :id");
        
        $ns = [];
        //$n = 100000000;
        $n = 10000;
        $nss = $n-1;
        
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
            
            $stmt1->execute(array('num' => $num));
            $rr = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($rr)) {
                $nn = intval($rr[0]['n']) + 1;
                
                $stmt2->execute(array('nn' => $nn, 'id' => $rr[0]['id']));
            }else{
                $kk = array_search($num, $ns);
                if($kk === false){
                    $nnn[] = ['num'=>$num, 'n' => 1];
                    $ns[] = $num;
                }else{
                    $nnn[$kk]['n'] = $nnn[$kk]['n']+1;
                }
                
                if($i%30000 == 0 || $i == $nss){
                    $sql = 'INSERT INTO '.$this->table.' (`num` , `n`) VALUES ';
                    foreach ($nnn as $v){
                        $sql .= '(\'' . $v['num'] . '\', ' .$v['n'] . ') , ';
                    }
                    $sql = substr($sql, 0, -3);
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $nnn = [];
                    $ns = [];
                    $sql = '';
                }
            }
            $stmt = '';
            $arr1 = [];
            $r = [];
            
            if($i%1000000 == 0){
				echo str_repeat(" ", 1024);//ie/safari
				echo $i.'-'.date('H:i:s').'<br>';// br opear/safari
                ob_flush();
                flush();
            }
        }
        ob_end_flush();
    }
    
    public function count()
    { 
        $count = Db::connect($this->con1)->name($this->table)->count();
        var_dump($count);
    }
    
    public function sum()
    { 
        $sum = Db::connect($this->con1)->name($this->table)->sum('n');
        var_dump($sum);
    }
    
    
    
    public function max()
    { 
        $sum = Db::connect($this->con1)->name($this->table)->max('n');
        var_dump($sum);
    }
    
        
    
    public function truncate()
    { 
        $r = Db::connect($this->con1)->query("TRUNCATE TABLE $this->table");
        var_dump($r);
    }
   
}
