<?php
namespace app\index\validate;
use think\Validate;

/**
 * 验证器
 */
class Test extends Validate{
    //规则
    
    //格式验证类
    // require number/integer float boolean email array date dateFormat:format
    // accepted(是否为为 yes, on, 或是 1)
    // alpha/是否为字母 alphaNum/是否为字母和数字  alphaDash/否为字母和数字，下划线_及破折号-
    // chs/值只能是汉字 chaAlpha/只能是汉字、字母 chsAlphaNum chsDash
    // activeUrl/是否为有效的域名或者IP url/有效的URL地址 ip/有效的IP地址
    
    //长度和区间验证类
    //notIn/inn:num1,num2  
    //notbetween/between:num1,num2 
    //length:num1,num2 length:num1
    //min/max:number
    //before/after:日期 值是否在某个日期之后after:2016-3-18
    //expire:开始时间,结束时间  是否在某个有效日期之内
    //allowIp:allow1,allow2,... IP是否在某个范围
    //denyIp:allow1,allow2,... IP是否禁止访问
    
    //字段比较类
    //confirm 验证某个字段是否和另外一个字段的值一致 require|confirm:password
    //different
    //eq/==/same  egt/>=  gt/> elt/<= lt/< 
    
    
    protected $rule = [
        ['name', ['require'], '必须']
    ];  
    
    //场景
    protected $scene = [
        'edit' => ['name']
    ];
   
}
