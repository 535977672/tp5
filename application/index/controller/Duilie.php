<?php
namespace app\index\controller;
/**
 * 队列
 * linux先运行QUEUE=* php myresque.php
 * 查看进程ps aux | grep resque
 * kill -9 pid
 */
use think\Controller;
use think\Db;
use Exception;

use app\index\service\redisduilie\Queue;

class duilie extends Controller
{
    
    public function index()
    { 
        for($i = 0; $i<10000; $i++){
            $args = [
                'time' => '1_'.time()
            ];
            $jobId = Queue::in('MyJob', $args, 'default');
            echo $jobId;
        }
    }
    
    public function index2()
    { 
        for($i = 0; $i<10000; $i++){
            $args = [
                'time' => '2_'.time()
            ];
            $jobId = Queue::in('MyJob', $args, 'default');
            echo $jobId;
        }
    }
    
    public function index3()
    { 
        for($i = 0; $i<10000; $i++){
            $args = [
                'time' => '3_'.time()
            ];
            $jobId = Queue::in('MyJob', $args, 'default');
            echo $jobId;
        }
    }
    
    public function index4()
    { 
        for($i = 0; $i<30; $i++){
            $args = [
                'time' => '3_'.time()
            ];
            
            $redis = new \Redis();
            $redis->connect('127.0.0.1',6379);
            $redis->lPush('job2', json_encode($args));
        }
    }
    
}


