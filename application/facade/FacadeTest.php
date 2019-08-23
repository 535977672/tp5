<?php
namespace app\facade;

use think\Facade;

//门面（Facade）
class FacadeTest extends Facade
{
    protected static function getFacadeClass()
    {
    	return 'app\comm\FacadeTest';
    }
}
