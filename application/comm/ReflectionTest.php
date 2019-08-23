<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\comm;

class ReflectionTest {
    
    /**
     * $code
     */
    protected $code = '';
    
    /**
     * $name
     */
    protected $name = 'name';
    
    protected $name_protected = 'name_protected';
    private $name_private = 'name_private';
    public static $name_public_static = 'name_public_static';
    
    public function __construct($name, $code = 'c'){
        $this->name = $name;
        $this->code = $code;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getCode() {
        return $this->code;
    }
    
    public function getNameProtected() {
        return $this->name_protected;
    }
    
    
    public function getNamePrivate() {
        return $this->name_private;
    }
    
    
    public function getNamePublicStatic() {
        return self::$name_public_static;
    }
    
}
