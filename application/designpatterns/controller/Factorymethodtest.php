<?php

/**
 * Created by Netbeans.
 * User: mf
 * Date: 2019-3-7
 * Time: 14:50:52
 */
namespace app\designpatterns\controller;

require dirname(__FILE__) . '/../../unit/FactoryMethod.php';

use app\unit\StdoutLoggerFactory;

class Factorymethodtest
{
    public function testCanCreateStdoutLogging()
    {
        $loggerFactory = new StdoutLoggerFactory();
        $logger = $loggerFactory->createLogger();
        $logger->log('ewwerer');
    }

}