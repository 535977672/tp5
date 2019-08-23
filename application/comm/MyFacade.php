<?php
namespace app\comm;

use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionProperty;
use Exception;

class MyFacade{
    protected static function createFacade($class = '', $args = [], $newInstance = false)
    {
        $class = $class ?: static::class;

        $facadeClass = static::getFacadeClass();

        if ($facadeClass) $class = $facadeClass;
        
        return \think\Container::getInstance()->make($class, $args, $newInstance);
    }
    
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {}
   

    // 调用实际类的方法
    public static function __callStatic($method, $params)
    {
        //return call_user_func_array([static::createFacade(), $method], $params);
        
        return call_user_func_array([static::createFacade2(), $method], $params);
        
        //$name = '\\' . static::getFacadeClass();
        //return call_user_func_array([new $name, $method], $params);
    }  
    
    
    
    
    protected static function createFacade2($class = '', $args = [])
    {

        $class = static::getFacadeClass();
        if(!$class){
            throw new Exception('class miss');
        }

        return static::createObject($class, $args);
    }
    
    protected static function createObject($class, $args)
    {
       try {
            $reflect = new ReflectionClass($class);
            $constructor = $reflect->getConstructor();
            $args = $constructor ? static::bindParams($constructor, $args) : [];
            return $reflect->newInstanceArgs($args);
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
    protected static function bindParams($reflect, $vars = [])
    {
        if ($reflect->getNumberOfParameters() == 0) {
            return [];
        }

        reset($vars);
        $type   = key($vars) === 0 ? 1 : 0;
        $params = $reflect->getParameters();
        
        foreach ($params as $param) {
            $name      = $param->getName();
            $class     = $param->getClass();

            if ($class) {
                $args[] = static::getObjectParam($class->getName(), $vars);
            } elseif (1 == $type && !empty($vars)) {
                $args[] = array_shift($vars);
            } elseif (0 == $type && isset($vars[$name])) {
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
    protected static function getObjectParam($className, &$vars)
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