<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use \Pdo;
class mycattest extends Controller
{
    
    public function select()
    { 
        //$re = Db::connect('mycat_db_config')->name('mycat_label')->where('names', '323423')->select();
        //var_dump($re);
        //乱序
        //分片后不能排序
        //Mycat切分后带来的问题：
        //引入分布式事务的问题
        //跨节点join问题--可以通过ER分片来解决
        //跨节点合并并排序分页问题
        //数据热点问题
        
        
        // 1 脚本单独提取部分数据到指定数据库查询 返回来获取数据
        // 2 merge查询
        // 3 每个分区单独处理后合并数据到内存在排序查询
        // 4 搜索引擎
        
        //join
        /*
        mycat 支持跨分片join，主要有四种方法：
        1、全局表
        字典表（变动不频繁，数据量总体变化不大，数据规模不大很少超过10W条记录）可以做为全局表
        特性：
        1）全局表的插入，更新操作会实时在所有节点上执行，保持各个分片的数据一致性。没有太激烈的update操作。
        2）全局表查询只从一个节点获取
        3）全局表可以和任何一个表进行JOIN操作

        4) 多线程update 可以不是同一条记录，如果多线程udpate 全局表同一条记录会出现死锁，批量insert 是可以的。

        配置：
        <table name="company" primaryKey="ID" type="global" dataNode="dn1,dn2,dn3" />
        不用写rule规则，要在所有节点为执行DDL语句
        2、ER分片
        借鉴了foundation DB的设计思路，将子表的存储位置依赖于主表，并且物理上坚信存放，因此彻底解决了JOIN的效率和性能问题。根据这一思路，mycat 提出了E-R 关系的数据分片策略，子表的记录与所关联的父表记录存放在同一个数据分片上。
        有一类业务，比如订单（order）和订单明细（order_detail）,明细表会依赖订单表，也就是说存在表的主从关系。这类表适用于ER分片表，子表的记录与所关联的父表记录存放在同一个分片上，避免数据的JOIN跨库操作。
        schema.xml 配置：
        以order与order_detail 为例，schema.xml 中定义如下分片配置，order、order_detail 根据order_id 进行数据分片，保证相同的order_id的数据分到同一个分片上，在进行数据插入操作时，mycat会获取order所在在分片，然后将order_detail 也插入到order所在的分片。

        <table name="order" dataNode="dn$1-32" rule="mod-long">
        <childTable name="order_detail" primaryKey="id" joinKey="order_id" parentKey="order_id" />
        </table>

        3、catletT(人工智能)
        mycat提供api ，通过编程解决业务系统中特定几个必须跨分片的SQL 的JOIN 逻辑。

        4、ShareJoin
        ShareJoin 是一个简单的跨分片 Join,基于 HBT 的方式实现。目前支持 2 个表癿的join,原理就是解析 SQL 语句，拆分成单表的 SQL 语句执行，然后把各个节点的数据汇集。
        ShareJoin 在开发，前三种1.3.0.1 支持。
         * 
         */
        
        
        $re = Db::connect('mycat_db_config')->name('mycat_label')->order('id', 'desc')->select();
        var_dump($re);
        
    }
    
    
    /**
     * 分库多次查询
     */
    public function fenkuselect()
    { 
//        $re = Db::connect('mycat_db_config')->name('mycat_label')->select();
//        var_dump($re);
//        
//        $re = Db::connect('mycat_db_config')->name('mycat_label')->select();
//        var_dump($re);
        
        
        
//        $re = Db::connect('mycat_db_config')->query('select * from mycat_label where id=7');
//        var_dump($re);var_dump($re[0]['id']);
//        $re = Db::connect('mycat_db_config')->query('select * from mycat_label where id=7');
//        var_dump($re);var_dump($re[0]['id']);
        
        
//        $conn = new PDO("mysql:host=127.0.0.1:8066;dbname=mycat", 'root', 'root',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));       
//        //使用命名（:name）参数来准备SQL语句
//        $stmt = $conn->prepare("select * from mycat_label where id = :id");
//        $stmt->execute(array('id' => 7));
//        $re = $stmt->fetchAll(PDO::FETCH_ASSOC);//返回一个索引为结果集列名的数组
//        var_dump($re);
//        
//        $stmt = $conn->prepare("select * from mycat_label where id = :id");
//        $stmt->execute(array('id' => 7));
//        $re = $stmt->fetchAll(PDO::FETCH_ASSOC);//返回一个索引为结果集列名的数组
//        var_dump($re); 
        
        
//        $conn = new PDO("mysql:host=127.0.0.1:8066;dbname=mycat", 'root', 'root',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));       
//        //使用命名（:name）参数来准备SQL语句
//        $stmt = $conn->prepare("select * from mycat_label where id = 7");
//        $stmt->execute();
//        $re = $stmt->fetchAll(PDO::FETCH_ASSOC);//返回一个索引为结果集列名的数组
//        var_dump($re);
//        
//        $stmt = $conn->prepare("select * from mycat_label where id = 7");
//        $stmt->execute();
//        $re = $stmt->fetchAll(PDO::FETCH_ASSOC);//返回一个索引为结果集列名的数组
//        var_dump($re);
    
        
    }
    
    /**
     * 单库分表 数据库 mycates 数据表mycat_fenbiao$1-3
     */
    public function fenbiaoinsert()
    { 
        $data = [
            ['id' => 1, 'name' => '打上单er'],
            ['id' => 2, 'name' => '打上单324'],
            ['id' => 3, 'name' => '打上单45'],
            ['id' => 4, 'name' => '打上单d'],
            ['id' => 5, 'name' => '打上单4'],
            ['id' => 6, 'name' => '打上单ret'],
            ['id' => 7, 'name' => '打上单gd']
        ];
        $re = Db::connect('mycat_db_config')->name('mycat_fenbiao')->data($data)->insertAll();
        var_dump($re);
        
    }
    
    public function fenbiaoselect()
    { 
        $re = Db::connect('mycat_db_config')->name('mycat_fenbiao')->select();
        var_dump($re);
        //乱序
        
        $re = Db::connect('mycat_db_config')->name('mycat_fenbiao')->order('id')->select();
        var_dump($re);
        
        $re = Db::connect('mycat_db_config')->name('mycat_fenbiao')->where('id', '>', 100)->select();
        var_dump($re);
        
        $re = Db::connect('mycat_db_config')->name('mycat_fenbiao')->where('id', '>', 100)->fetchSql(true)->select();
        var_dump($re);
        //SELECT * FROM `mycat_fenbiao` WHERE  `id` > 100
        
        $re = Db::connect('mycat_db_config')->query("EXPLAIN SELECT * FROM `mycat_fenbiao` WHERE  `id` > 100");
        var_dump($re);
        //data_node        sql
        //dn0           SELECT * FROM mycat_fenbiao1 WHERE `id` > 100 LIMIT 100
        //dn0           SELECT * FROM mycat_fenbiao2 WHERE `id` > 100 LIMIT 100
        //dn0           SELECT * FROM mycat_fenbiao3 WHERE `id` > 100 LIMIT 100
        
        
        $re = Db::connect('mycat_db_config')->query("EXPLAIN INSERT INTO `mycat_fenbiao` (id, name) VALUES (52312, '电视0'),(12312, '电视1'),(7312, '电视2'),(13312, '电视6')");
        var_dump($re);
        //data_node        sql
        //dn0           INSERT INTO mycat_fenbiao1 (`id`, `name`) VALUES ('12312', `电视`)
        //dn0           INSERT INTO mycat_fenbiao2 (`id`, `name`) VALUES ('52312', `电视0`),  ('7312', `电视2`),  ('13312', `电视6`)

    }
   
}
