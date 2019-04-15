<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use \app\index\model\Test;

class Model extends Controller
{
    

    public function selectPage(){
        // 静态调用
        $re = Test::get(1);
        // 实例化模型
        $testModel = new Test;
        //使用 Loader 类实例化（单例）
        $testModel = \think\Loader::model('Test');
        //或者使用助手函数`model`
        $testModel = model('Test');
        
        //get或者find方法返回的是当前模型的对象实例，可以使用模型的方法。
        //1.获取单个数据
        // 1.1 取出主键为1的数据
        $re = Test::get(1);
        echo $re->name;
        //1.2 使用数组查询
        $re = Test::get(['code' =>5]);
        //1.3 使用闭包查询
        $re = Test::get(function($query){
            $query->where('code', 5);
        });
        //1.4 实例化模型后调用查询方法
        $testModel = new Test;
        $re = $testModel->where('code', 5)->find();
        var_dump($re->toArray());
        
        //2. 获取多个数据  支持在模型中设置resultSetType返回数据集对象的名称 模型的all方法或者select方法返回的是一个包含模型对象的二维数组或者数据集对象。
        //2.1 根据主键获取多个数据
        $list = Test::all('1');
        $list = Test::all(1);
        $list = Test::all([1,2,3]);
        //使用数组查询
        $list = Test::all(['code' => 7]);
        //使用闭包查询 
        //数组方式和闭包方式的数据查询的区别在于，数组方式只能定义查询条件，闭包方式可以支持更多的连贯操作，包括排序、数量限制等。
        $list = Test::all(function($query){
            $query->where('code', 5)->order('id', 'desc')->limit(2);
        });
        
        //3. 实例化模型后调用查询方法
        $testModel = new Test;
        $list = $testModel->where('code', 5)->order('id', 'desc')->limit(2)->select();
        
        foreach ($list as $key => $v) {
            var_dump($v->toArray());
        }
        
        //4.获取某个字段或者某个列的值 注意value和column方法返回的不再是一个模型对象实例，而是单纯的值或者某个列的数组。
        $list = Test::where('code', 5)->value('name');
        var_dump($list);
        $list = Test::where('code', 5)->limit(2)->column('id,name,code');
        var_dump($list);
        
        //5. 通过Query类查询 使用数据库的查询方法
        $list = Test::where('code', 5)->order('id', 'desc')->limit(2)->select();
        foreach ($list as $key => $v) {
            var_dump($v->toArray());
        }
        
        //6. 数据分批处理
        Test::chunk(10, function($list){
            $r = [];
            foreach ($list as $key => $v) {
                $temp = $v->toArray();
                $r[] = $temp['id'];
            }
            var_dump($r);
        });
        
        //7. 查询缓存 get方法和all方法的第三个参数表示是否使用查询缓存，或者设置缓存标识。
        $list = Test::all([1]);
        foreach ($list as $key => $v) {
            var_dump($v->toArray());
        }
        $list = Test::all([1], '', true);
        foreach ($list as $key => $v) {
            var_dump($v->toArray());
        }
        
        //8. 分布式 主库读取master()  
        //readMaster() 后续该模型的操作从主库读取数据
        //'read_master'	=> true 设置开启后，一旦你的模型写入数据，那么该请求后续的模型读取操作都会自动读取主库。
        //设置和方法 直接调用Db类查询无效。
        
        
        
        //9. 聚合查询
        //count	统计数量，参数是要统计的字段名（可选）
        //max	获取最大值，参数是要统计的字段名（必须）
        //min	获取最小值，参数是要统计的字段名（必须）
        //avg	获取平均值，参数是要统计的字段名（必须）
        //sum	获取总分，参数是要统计的字段名（必须）     
        
        //9.1 静态调用 动态调用
        $re = Test::count('num');
        $testModel = new Test;
        $re = $testModel->count('num');
        var_dump($re);
        
        
        $re = Test::max('num');
        $testModel = new Test;
        $re = $testModel->max('num');
        var_dump($re);
        
        $re = Test::min('num');
        $testModel = new Test;
        $re = $testModel->min('num');
        var_dump($re);
        
        $re = Test::avg('num');
        $testModel = new Test;
        $re = $testModel->avg('num');
        var_dump($re);
        
        $re = Test::sum('num');
        $testModel = new Test;
        $re = $testModel->sum('num');
        var_dump($re);
        
        
        //10. 拾取器 
        //获取器的作用是在获取数据的字段值后自动进行处理
        $re = Test::get(1);
        echo $re->code;
        echo $re->code_text;
        var_dump($re->append(['code_text'])->toArray());//通过获取器获取字段
        var_dump($re->getData());//获取原始字段数据
    }
    
    public function insertPage(){
        $re = '';
        $data = [ 'code' => 1, 'name' => 'AKM', 'xiu' => '1'];
        
        //1.添加一条数据
        $testModel = new Test;
        $testModel->code = 2;
        $testModel->name = 'AKM1';
        $re = $testModel->save();
        var_dump($re);
        
        $testModel = new Test;
        $testModel->data($data);
        $re = $testModel->save();
        var_dump($re);
        
        $testModel = new Test($data);
        $re = $testModel->save();
        var_dump($re);
        
        $testModel = new Test();
        $re = $testModel->save($data);
        var_dump($re);
        
        //2. 添加多条数据
        $data = [
            [ 'code' => 1, 'name' => 'AKM2'],
            [ 'code' => 1, 'name' => 'AKM3']
        ];
        $testModel = new Test();
        $re = $testModel->saveAll($data);
        var_dump($re);
        
        //3. 助手函数
        $testModel = model('Test');
        $re = $testModel->saveAll($data);
        var_dump($re);
        
        //4. 修改器
        $data = [ 'code' => 1, 'name' => 'AKM', 'xiu' => '1'];
        $testModel = new Test();
        $re = $testModel->save($data);
        var_dump($re);
        
        $testModel = new Test();
        $testModel->data($data, true);
        $re = $testModel->save();
        var_dump($re);
        
        $data = [
            [ 'code' => 1, 'name' => 'AKM2', 'xiu' => '2', 'status' => 21],
            [ 'code' => 1, 'name' => 'AKM3', 'xiu' => '2']
        ];
        $testModel = new Test();
        $re = $testModel->saveAll($data);
    }    
    
    public function updatePage(){
        $re = '';
        $data = [ 'code' => 1, 'name' => 'AKM'];
        
        //1.查找并更新
        $t = Test::get(1);
        $t->name = 'Mysql-1';
        $re = $t->save();
        var_dump($re);
        
        
        //2. 直接更新数据  allowField过滤非数据表字段的数据
        $testModel = new Test;
        $re = $testModel->allowField(true)->save(['name' => 'Mysql-2'], ['id' => 1]);
        //$re = $testModel->allowField(['code', 'num'])->save(['name' => 'Mysql-2'], ['id' => 1]);
        var_dump($re);
        
        //3. 批量更新数据 批量更新仅能根据主键值进行更新，其它情况请使用foreach遍历更新。
        //isUpdate() 强制进行数据更新操作而不是新增操作
        $testModel = new Test;
        $data = [
            ['name' => 'Mysql-3', 'id' => 1], 
            ['name' => 'baidu-3', 'id' => 2]
        ];
        $re = $testModel->saveAll($data);
        var_dump($re);
        
        //4. 通过数据库类更新数据
        $testModel = new Test;
        $re = $testModel->where('id', 1)->update(['name' => 'Mysql-4']);
        //5. 静态方法
        //$re = $testModel::where('id', 1)->update(['name' => 'Mysql-5']);
        var_dump($re);
        
        //6. 闭包更新
        //模型的新增和更新方法都是save方法        
        //实例化模型后调用save方法表示新增；
        //查询数据后调用save方法表示更新；
        //save方法传入更新条件后表示更新；   
        
        //显式指定更新数据操作 isUpdate(true)
        //显式指定当前操作为新增操作 isUpdate(false)
        
        //不要在一个模型实例里面做多次更新，会导致部分重复数据不再更新，正确的方式应该是先查询后更新或者使用模型类的update方法更新
        //如果你调用save方法进行多次数据写入的时候，需要注意，第二次save方法的时候必须使用isUpdate(false)，否则会视为更新数据。
        $testModel = new Test;
        $re = $testModel->save(['name' => 'Mysql-6'], function($query){
            $query->where('id', 1);
        });
        var_dump($re);
        
        //7. 修改器
        $testModel = new Test;
        $data = [
            ['name' => 'Mysql-5', 'id' => 1, 'xiu' => '3'], 
            ['name' => 'baidu-5', 'id' => 2, 'xiu' => '3']
        ];
        $re = $testModel->saveAll($data);
        var_dump($re);
    }
    
    public function deletePage(){
        $re = '';
        $data = [ 'code' => 1, 'name' => 'AKM'];
        
        //1.删除当前模型
        $testModel = Test::get(48); //返回 null
        if($testModel){
            $re = $testModel->delete();
            var_dump($testModel);
        }
        
        //2. 根据主键删除
        $re = Test::destroy([47,46]);
        var_dump($re);
        
        //3. 条件删除 闭包删除
        $re = Test::destroy(['id' => 45]);
        var_dump($re);
        
        //4. 闭包删除
        $re = Test::destroy(function($query){
            $query->where('id', '>=', 43)->where('id', '<=', 44);
        });
        var_dump($re);
        
        
        //5. 数据库类的查询条件删除
        $re = Test::where('id', 42)->delete();
        var_dump($re);
    }    
    
    //模型分层
    public function layerPage(){
        $testModel = new Test;
        $re = $testModel->where('code', 5)->find();
        var_dump($re->toArray());
        
        $testModel = \think\Loader::model('Test','service');
        $re = $testModel->where('code', 5)->find();
        var_dump($re->toArray());
        
        $re = $testModel->layer();
        var_dump($re);
    }

    //关联
    public function joinPage(){
        $re = Test::get(1, 'test2');
        var_dump($re->toArray());
        var_dump($re->t2code);
        var_dump($re->test2->toArray());
        
        $re = Test::hasWhere('Test2', ['code' => 12])->find(); //null
        if($re){
            var_dump($re->toArray());
            var_dump($re->test2->toArray());
        }
        
        $re = Test::hasWhere('Test2', ['code' => 12])->select(); //null
        if($re){
            foreach ($re as $key =>$value ) {
                var_dump($value->toArray());
                var_dump($value->test2->toArray());
            }
        }

        $re = Test::all(function($query){
            $query->where('code', 7)->order('id', 'desc')->limit(2);
        }, 'test2'); //null
        if($re){
            foreach ($re as $key =>$value ) {
                var_dump($value->toArray());
                var_dump($value->test2->toArray());
            }
        }
        
        //关联预载入
        $re = Test::with(['test2' => function($query){$query->where('code', 12);}])->limit(3)->select();
        if($re){
            foreach ($re as $key =>$value ) {
                var_dump($value->toArray());
            }
        }
    }
    
}
