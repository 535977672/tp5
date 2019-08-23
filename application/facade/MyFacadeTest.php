<?php
namespace app\facade;

use app\comm\MyFacade;

//门面（Facade）
class MyFacadeTest extends MyFacade
{
    protected static function getFacadeClass()
    {
    	return 'app\comm\FacadeTest';
    }
}