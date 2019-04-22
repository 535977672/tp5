<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Mysql extends Controller
{
    

    public function selectPage(){
        //where('字段名','表达式','查询条件');
        //whereOr('字段名','表达式','查询条件');
        //表达式	含义
        //EQ、=	等于（=）
        //NEQ、<>	不等于（<>）
        //GT、>	大于（>）
        //EGT、>=	大于等于（>=）
        //LT、<	小于（<）
        //ELT、<=	小于等于（<=）
        //LIKE	模糊查询
        //[NOT] BETWEEN	（不在）区间查询
        //[NOT] IN	（不在）IN 查询
        //[NOT] NULL	查询字段是否（不）是NULL
        //[NOT] EXISTS	EXISTS查询
        //EXP	表达式查询，支持SQL语法
        //> time	时间比较
        //< time	时间比较
        //between time	时间比较
        //notbetween time	时间比较      
        
        //链式操作方法
        //where table alias field order limit page group having join 
        //union distinct lock cache comment fetchSql force bind partition strict failException sequence
        //系统支持的链式操作方法有：
        //连贯操作	作用	支持的参数类型
        //where*	用于AND查询	字符串、数组和对象
        //whereOr*	用于OR查询	字符串、数组和对象
        //wheretime*	用于时间日期的快捷查询	字符串
        //table	用于定义要操作的数据表名称	字符串和数组
        //alias	用于给当前数据表定义别名	字符串
        //field*	用于定义要查询的字段（支持字段排除）	字符串和数组
        //order*	用于对结果排序	字符串和数组
        //limit	用于限制查询结果数量	字符串和数字
        //page	用于查询分页（内部会转换成limit）	字符串和数字
        //group	用于对查询的group支持	字符串
        //having	用于对查询的having支持	字符串
        //join*	用于对查询的join支持	字符串和数组
        //union*	用于对查询的union支持	字符串、数组和对象
        //view*	用于视图查询	字符串、数组
        //distinct	用于查询的distinct支持	布尔值
        //lock	用于数据库的锁机制	布尔值
        //cache	用于查询缓存	支持多个参数
        //relation*	用于关联查询	字符串
        //with*	用于关联预载入	字符串、数组
        //bind*	用于数据绑定操作	数组或多个参数
        //comment	用于SQL注释	字符串
        //force	用于数据集的强制索引	字符串
        //master	用于设置主服务器读取数据	布尔值
        //strict	用于设置是否严格检测字段名是否存在	布尔值  如果开启字段严格检查的话，在更新和写入数据库的时候，一旦存在非数据表字段的值，则会抛出异常
        //sequence	用于设置Pgsql的自增序列名	字符串
        //failException	用于设置没有查询到数据是否抛出异常	布尔值
        //partition	用于设置分表信息	数组 字符串        
        
        //聚合查询
        //方法	说明
        //count	统计数量，参数是要统计的字段名（可选）
        //max	获取最大值，参数是要统计的字段名（必须）
        //min	获取最小值，参数是要统计的字段名（必须）
        //avg	获取平均值，参数是要统计的字段名（必须）
        //sum	获取总分，参数是要统计的字段名（必须）   
        
        //查询事件（V5.0.4+） Query::event('after_insert','callback');
        //从5.0.4+版本开始，增加了数据库的CURD操作事件支持，包括：
        //事件	描述
        //before_select	select查询前回调
        //before_find	find查询前回调
        //after_insert	insert操作成功后回调
        //after_update	update操作成功后回调
        //after_delete	delete操作成功后回调  
        
        //事务操作
        //Db::transaction(function(){
        //    Db::table('think_user')->find(1);
        //    Db::table('think_user')->delete(1);
        //});        
        //// 启动事务
        //Db::startTrans();
        //try{
        //    Db::table('think_user')->find(1);
        //    Db::table('think_user')->delete(1);
        //    // 提交事务
        //    Db::commit();    
        //} catch (\Exception $e) {
        //    // 回滚事务
        //    Db::rollback();
        //}        
        
        //监听SQL 操作前注册
        Db::listen(function($sql, $time, $explain){
            // 记录SQL
            //echo $sql. ' ['.$time.'s]';
            // 查看性能分析结果
            //dump($explain);
        });
        
        //存储过程 
        //$result = Db::query('call sp_query(8)');
        
      
        //1.查询一个数据使用：
        //find 方法查询结果不存在，返回 null
        $re = Db::table('test1')->where('id',1)->find();
        //$re = db('test1')->where('id',1)->find();
        var_dump($re);
        
        //2. 查询数据集使用
        //select 方法查询结果不存在，返回空数组
        $re = Db::table('test1')->where('status', 1)->select();
        //$re = db('test1')->where('status',1)->select();
        var_dump($re);
        
        
        //3. 使用Query对象或闭包查询
//        $query = new \think\db\Query();
//        $query->table('test1')->where('status',1);
        
//        $re = Db::find($query);
//        var_dump($re);
        
//        $re = Db::select($query);
//        var_dump($re);
        
        $re = Db::select(function($query){
            $query->table('test1')->where('status',1);
        });
        var_dump($re);
        
        //4. 查询某个字段的值可以用 value 方法查询结果不存在，返回 null
        $re = Db::table('test1')->where('id',1)->value('name');
        var_dump($re);
        
        //5. 查询某一列的值可以用 column 方法查询结果不存在，返回空数组
        $re = Db::table('test1')->where('status',1)->column('id,name,code');
        var_dump($re);
        
        
        //6.数据集分批处理
        Db::table('test1')
                ->where('status',1)
                ->field('id,name,code')
                ->chunk(2, function($u){
                    $t = array();
                    foreach ($u as $v){
                        $t[] = $v;
                    }
                    var_dump($t);
                });
        
    }
    
    public function insertPage(){
        $re = '';
        //1.添加一条数据
        //insert 方法添加数据成功返回添加成功的条数，insert 正常情况返回 1
        $data = ['name' => 'Ml6A4', 'code' => 5, 'status' => 3];
        //$re = Db::table('test1')->insert($data, '', true);
        //$re = Db::table('test1')->insertGetId($data);
        //$re = db('test1')->insert($data);
        //快捷更新
        //$re = Db::table('test1')->data($data)->insert([], '', true);
        var_dump($re);
        
        //2. 添加多条数据
        //insertAll 方法添加数据成功返回添加成功的条数
        $data = [
            ['name' => 'SCAR-L', 'code' => 6, 'status' => 4],
            ['name' => 'SCAR-L', 'code' => 7, 'status' => 5],
            ['name' => 'SCAR-L', 'code' => 8, 'status' => 6]
        ];
        //$re = Db::table('test1')->insertAll($data);
        //$re = db('test1')->insertAll($data);
        var_dump($re);
    }    
    
    public function updatePage(){
        $re = '';
        //1.更新数据表中的数据
        //update 方法返回影响数据的条数，没修改任何数据返回 0
        $re = Db::table('test1')->where('id', 1)->update(['code' => 4]);
        //$re = db('test1')->insert($data);
        var_dump($re);
        
        //2. setField 方法返回影响数据的条数，没修改任何数据字段返回 0
        $re = Db::table('test1')->where('id', 1)->setField('code', 5);
        var_dump($re);
        
        //3. 自增或自减一个字段的值
        //setInc/setDec 方法返回影响数据的条数
        $re = Db::table('test1')->where('id', 1)->setInc('code', 2);
        $re = Db::table('test1')->where('id', '<' ,3)->setDec('num', 0);
        var_dump($re);
        //V5.0.5+
        //$re = Db::table('test1')->where('id', 1)->setInc('code', 2)->setDec('code', 1)->update();
    }   
    
    public function deletePage(){
        $re = '';
        //1.根据主键删除
        //delete 方法返回影响数据的条数，没有删除返回 0
        $re = Db::table('test1')->delete([26,25]);
        //db('test1')->delete(1);;
        var_dump($re);
        
        //2. 条件删除    
        $re = Db::table('test1')->where('id', 24)->delete();
        //db('test1')->where('id',1)->delete();
        var_dump($re);

    }  
}
