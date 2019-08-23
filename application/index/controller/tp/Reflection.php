<?php
namespace app\index\controller\tp;

use think\Controller;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionProperty;
use Exception;

use app\comm\ReflectionTest;

/*
 * 反射
 * PHP5 具有完整的反射API，添加对类、接口、函数、方法和扩展进行反向工程的能力
 * 它是指在PHP运行状态中，扩展分析PHP程序，导出或提取出关于类、方法、属性、参数等的详细信息，包括注释。
 * 这种动态获取的信息以及动态调用对象的方法的功能称为反射API。
 * 反射是操纵面向对象范型中元模型的API，其功能十分强大，可帮助我们构建复杂，可扩展的应用。
 * 其用途如：自动加载插件，自动生成文档，甚至可用来扩充PHP语言。
 */
class Reflection extends Controller
{
    protected function initialize(){
        parent::initialize();
        
        //反射 自动加载插件，自动生成文档，甚至可用来扩充PHP语言
        //ReflectionClass
    }
    
    public function index()
    {
       try {
            $reflect = new ReflectionClass('app\comm\ReflectionTest');
            //$method = new ReflectionMethod('app\comm\ReflectionTest', 'getName');
            
            $param = ['name' => 'name', 'code' => 'code'];
            $param = ['name','code'];
            
            //null
            //object(ReflectionMethod)#145 (2) { ["name"]=> string(11) "__construct" ["class"]=> string(23) "app\comm\ReflectionTest" }
            $constructor = $reflect->getConstructor();
            //var_dump($constructor);
            
            //$args = $constructor ? $this->bindParams($constructor, $param) : [];
            $args = $param;
            
            //ReflectionProperty::IS_STATIC
            //ReflectionProperty::IS_PUBLIC
            //ReflectionProperty::IS_PROTECTED
            //ReflectionProperty::IS_PRIVATE
            //$reflect->getProperties(ReflectionProperty::IS_PUBLIC);
            $properties = $reflect->getProperties();
            foreach ($properties as $property) {
                echo $property->getName() . "\n";//code name name_protected name_private name_public_static
                
                if ($property->isProtected()) {
                    $docblock = $property->getDocComment();
                    //var_dump($docblock);
                }
            }
            //getMethods()       来获取到类的所有methods。
            //hasMethod(string)  是否存在某个方法
            //getMethod(string)  获取方法
            

            $object = $reflect->newInstanceArgs($args);
            
            echo $object->getName().'<br/>';
            echo $object->getCode().'<br/>';
            echo $object->getNamePrivate().'<br/>';
            echo $object->getNamePublicStatic().'<br/>';
                
        } catch (ReflectionException $e) {
            echo $e->getMessage();
        }
    }
    
    /**
     * 绑定参数
     * @access protected
     * @param  \ReflectionMethod|\ReflectionFunction $reflect 反射类
     * @param  array                                 $vars    参数
     * @return array
     */
    protected function bindParams($reflect, $vars = [])
    {
        //参数个数 2
        if ($reflect->getNumberOfParameters() == 0) {
            return [];
        }

        // 判断数组类型 数字数组时按顺序绑定参数
        reset($vars);
        //key() 函数返回数组中内部指针指向的当前单元的键名
        $type   = key($vars) === 0 ? 1 : 0;
        $params = $reflect->getParameters();
        //array(2) { [0]=> object(ReflectionParameter)#146 (1) { ["name"]=> string(4) "name" } [1]=> object(ReflectionParameter)#147 (1) { ["name"]=> string(4) "code" } }

        foreach ($params as $param) {
            $name      = $param->getName();
            $class     = $param->getClass();//null

            if ($class) {
                $args[] = $this->getObjectParam($class->getName(), $vars);
            } elseif (1 == $type && !empty($vars)) {//['name' => 'name', 'code' => 'code'];
                $args[] = array_shift($vars);
            } elseif (0 == $type && isset($vars[$name])) {//['name','code']
                $args[] = $vars[$name];
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } else {
                throw new Exception('method param miss:' . $name);
            }
        }

        return $args;
    }
    
    /**
     * 获取对象类型的参数值
     * @access protected
     * @param  string   $className  类名
     * @param  array    $vars       参数
     * @return mixed
     */
    protected function getObjectParam($className, &$vars)
    {
        $array = $vars;
        $value = array_shift($array);

        if ($value instanceof $className) {
            $result = $value;
            array_shift($vars);
        } else {
            throw new Exception('error param :' . $className);
        }

        return $result;
    }
}

