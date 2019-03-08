<?php

/**
 * Created by Netbeans.
 * User: mf
 * Date: 2019-3-7
 * Time: 14:50:52
 */
namespace app\designpatterns\controller;

require dirname(__FILE__) . '/../../unit/AbstractFactory.php';

use app\unit\HtmlFactory;
use app\unit\HtmlText;
use app\unit\JsonFactory;
use app\unit\JsonText;

class Abstractfactorytest
{
    public function testCanCreateHtmlText()
    {
        $factory = new HtmlFactory();
        $text = $factory->createText('foobar');
        
        echo $text->getText();
    }

    public function testCanCreateJsonText()
    {
        $factory = new JsonFactory();
        $text = $factory->createText('foobar1');

        echo $text->getText();
    }
}