<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class mycattest extends Controller
{
    
    public function select()
    { 
        $re = Db::connect('mycat_db_config')->name('mycat_label')->where('names', '323423')->select();
        //分片后不能排序
//Mycat切分后带来的问题：
//引入分布式事务的问题
//跨节点join问题--可以通过ER分片来解决
//跨节点合并并排序分页问题
//数据热点问题
        var_dump($re);
    }
    
    
   
}
