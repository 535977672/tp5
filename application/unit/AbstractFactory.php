<?php

/**
 * Created by Netbeans.
 * User: mf
 * Date: 2019-3-7
 * Time: 16:47:45
 */

namespace app\unit;

/**
 * 在这种情况下，抽象工厂是创建一些组件的契约
 * 在 Web 中。 有两种呈现文本的方式：HTML 和 JSON
 */
abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}


class JsonFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new JsonText($content);
    }
}

class HtmlFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new HtmlText($content);
    }
}

abstract class Text
{
    /**
     * @var string
     */
    protected $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}


class JsonText extends Text
{
    public function getText()
    {
        return json_encode($this->text);
    }
}

class HtmlText extends Text
{
    public function getText()
    {
        return $this->text;
    }
}