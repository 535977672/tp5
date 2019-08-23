<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThinkQueueTest
 *
 * @author Administrator
 */

namespace app\job;
use think\queue\Job;
use think\facade\Cache;


class ThinkQueueTest {
    function task1(Job $job, $data){
        
        if ($job->attempts() > 1) {
            $job->delete();
            return;
        }
  
        $data['time2'] = microtime(true);
        
        Cache::store('redis')->set('tpcachejob:'.$data['time'].':'.$data['time2'], json_encode($data));

        $job->delete();
    }
    
    function task2(Job $job, $data){
        //var_dump($data);
        
        //每60s会重复执行
        //这里执行具体的任务
        if ($job->attempts() > 1) {
             //通过这个方法可以检查这个任务已经重试了几次了
            
            $job->delete();
            return;
        }
  
        $data['data']['time2'] = time();
        
        Cache::store('redis')->set('tpcachejob:'.$data['data']['time'].':'.$data['data']['time2'], json_encode($data, JSON_UNESCAPED_UNICODE));

       //如果任务执行成功后 记得删除任务，不然这个任务会重复执行，直到达到最大重试次数后失败后，执行failed方法
       $job->delete();

       // 也可以重新发布这个任务
       //$job->release($delay); //$delay为延迟时间
    }
    
    public function failed($data){
    
        // ...任务达到最大重试次数后，失败了
    }
    
}
