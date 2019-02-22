<?php
namespace app\index\service\redisduilie;
//PHP-resque是由三个角色组成的：Job、Queue、Worker；
//其中Job负责处理对应事件的逻辑，
//Queue(队列)用于接收队列消息，
//Worker常驻内存，循环POP队列中的服务。
require_once '../vendor/chrisboulton/php-resque/lib/Resque.php';
use Resque;//必须，否则找不到Resque类
class Queue
{
        public static function in($job_name, $args, $query_name = 'default'){
        if(empty($job_name)){
            return false;
        }
        
        Resque::setBackend('127.0.0.1:6379');//连接redis
        //auth

        $jobId = Resque::enqueue($query_name, $job_name, $args, true);
        //echo "Queued job ".$jobId."\n\n";
        return $jobId.'<br />';
    }
}