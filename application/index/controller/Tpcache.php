<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use Exception;
use think\facade\Cache;

/**
 * tp cache 测试
 */
class Tpcache extends Controller
{
    
    public function insertcache()
    { 
        $tpcachekey = Cache::store('redis')->get('tpcachekey');
        if(!$tpcachekey){
            Cache::store('redis')->set('tpcachekey', 1);
            $tpcachekey = 1;
        }else{
            $tpcachekey++;
            Cache::store('redis')->inc('tpcachekey');
        }
        $content = $tpcachekey.$this->rand_str();
        Db::name('info')
            ->cache('Tpcache')
            ->insert([
                'title' => $tpcachekey,
                'content' => $content,
                'content2' => $content,
            ]);
        
        //cache 后 select缓存不更新
        \think\facade\Cache::rm('Tpcache');
    }
    
    /**
     * 增加缓存key，分页失效，每次获取数据一样
     * 
     */
    public function index()
    { 
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(1)
            ->limit(2)
            ->cache('Tpcache')
            ->select();
        
        dump($re, true, 1);
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(2)
            ->limit(2)
            ->cache('Tpcache')
            ->select();
        
        dump($re, true, 2);
        
        
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->cache('Tpcache')  //不加缓存不更新
            ->update(['id'=>$re[1]['id'],'content2'=>$this->rand_str()]);
        
        dump($re);
        
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(1)
            ->limit(2)
            ->cache('Tpcache')
            ->select();
        dump($re, true, '1_1');
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(2)
            ->limit(2)
            ->cache('Tpcache')
            ->select();
        dump($re, true, '2_1');
        
        //直接获取缓存
        $data = \think\facade\Cache::get('Tpcache');
        dump($data, true, '3_1');
    }

    
    
    public function insertcache2()
    { 
        $tpcachekey = Cache::store('redis')->get('tpcachekey');
        if(!$tpcachekey){
            Cache::store('redis')->set('tpcachekey', 1);
            $tpcachekey = 1;
        }else{
            $tpcachekey++;
            Cache::store('redis')->inc('tpcachekey');
        }
        $content = $tpcachekey.$this->rand_str();
        Db::name('info')
            ->cache(true, 36000, ['Tpcachetaginsert' , 'Tpcachetag']) //cache('key',60,'tagName') Cache::tag('tag',['name1','name2']);
            ->insert([
                'title' => $tpcachekey,
                'content' => $content,
                'content2' => $content,
            ]);
        
        // 清除tag标签的缓存数据  只是清除标签，没有清除数据
        //\think\facade\Cache::clear('Tpcachetag');//clear Tpcachetaginsert更新前查询时无效
        \think\facade\Cache::clear('Tpcachetaginsert');
        \think\facade\Cache::clear('Tpcachetag');
    }
    
    public function index2()
    { 
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(1)
            ->limit(2)
            ->cache(true, 36000, 'Tpcachetag')
            ->select();
        
        dump($re, true, 1);
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(2)
            ->limit(2)
            ->cache(true, 36000, 'Tpcachetag')
            ->select();
        
        dump($re, true, 2);
        
        
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->cache(true, 36000, 'Tpcachetag')  //不加缓存不更新
            ->update(['id'=>$re[1]['id'],'content2'=>$this->rand_str()]);
        
        dump($re);
        
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(1)
            ->limit(2)
            ->cache(true, 36000, 'Tpcachetag')
            ->select();
        dump($re, true, '1_1');
        
        $re = Db::name('info')
            ->field('id,content,content2')
            ->order('id', 'desc')
            ->page(2)
            ->limit(2)
            ->cache(true, 36000, 'Tpcachetag')
            ->select();
        dump($re, true, '2_1');

    }
    
    
    
    public function caches() {
        $handler = Cache::store('redis')->handler();
        //$handler = new \Redis();
        $handler->hSet('file1', 'dwew', 2323);
        $handler->hSet('file1', 'dfdf', 23423);
        $handler->hSet('file1', 'bgn', 676);
        $handler->hSet('file1', 'lio', 980);
        $handler->hSet('file1', '/rrtert/trytyrty/tytryrt/yrtuyyutyu/huh.uyiuyi', 980);
        
        
        $r = $handler->hGet('file1', 'lio');var_dump($r);
        
        $r = $handler->hDel('file1', 'lio');
        
        $r = $handler->hKeys('file1');
        var_dump($r);
    }
    
    public function rand_str($randLength = 10){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST123456789';
        $len = strlen($chars);
        $randStr = '';
        for ($i = 0; $i < $randLength; $i++) {
            $randStr .= $chars[rand(0, $len - 1)];
        }
        return $randStr;
    }
}
