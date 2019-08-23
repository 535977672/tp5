<?php
namespace app\index\controller;

use think\Controller;
use think\Queue;
/**
 * think-queue for ThinkPHP5.1
 *
 * Listen 模式 慢 重建work 代码更新不用重启
 * php think queue:listen
 * 
 * Work 模式 快 代码内循环 代码更新要重启work 快速消耗redis资源
 * php think queue:work --daemon（不加--daemon为执行单个任务） 是否循环执行，如果不加该参数，则该命令处理完下一个消息就退出
 */
class Thinkqueue extends Controller
{
    public function index()
    {
        echo 'think-queue-test';
        $job = 'app\job\ThinkQueueTest@task2';
        $data = ['name' => '第三代康师傅', 'data' => ['name' => 232312, 'time'=>time()]];
        
        // database 驱动时，返回值为 1|false  ;   redis 驱动时，返回值为 随机字符串|false
        $isPushed = Queue::push($job, $data, null);//立即执行
        //$isPushed = \think\Queue::later(10, $job, $data, null);//在$delay秒后执行
        
        var_dump($isPushed);//IsFL7rh7g1GLwfdsF5vYZAwPsW35WyhM
        //{
        //  "job": "app\\job\\ThinkQueueTest@task2",
        //  "data": {
        //    "name": "\u7b2c\u4e09\u4ee3\u5eb7\u5e08\u5085",
        //    "data": {
        //      "name": 232312,
        //      "time": 1566266573
        //    }
        //  },
        //  "id": "IsFL7rh7g1GLwfdsF5vYZAwPsW35WyhM",
        //  "attempts": 1
        //}
    }
    
    public function index2()
    {
        set_time_limit(0);
        echo 'think-queue-test';
        $job = 'app\job\ThinkQueueTest@task1';
        $data = ['name' => 232312];
        for($i = 0; $i < 10; $i++){
            $data['time'] = microtime(true). uniqid();
            Queue::push($job, $data, null);
        }
    }
}

