<?php
/**
 * 是什么
 * 经典场景的经典解决方案（套路，比如看手相）
 *
 * 干什么用的
 * 1.深入理解面向对象思想
 * 2.可扩展性å
 *
 * 怎么用
 *
 * 动态语言与静态语言
 * 静态语言（强类型语言）：静态语言是在编译时变量的数据类型即可确定的语言，多数静态类型语言要求在使用变量之前必须声明数据类型。
 * Java；C/C++
 * 动态语言（弱类型语言）：动态语言是在运行时确定数据类型的语言。变量使用之前不需要类型声明，通常变量的类型是被赋值的那个值的类型。
 * PHP、Python
 *
 * 多态
 * 生物学专用名词：同一物种不同形态。西伯利亚虎重210-260公斤；孟加拉虎重280-230公斤。
 * 面向对象中，某种对象实例不同表现形态。
 * 通用类的子类，人类，学生、老师。
 * 子类用不同的变化。
 */

abstract class Tiger {
    public abstract function climb();
}

class XblyTiger extends Tiger {
    public function climb()
    {
        echo '西伯利亚虎不会爬树' . PHP_EOL;
    }
}

class MjlTiger extends Tiger {
    public function climb()
    {
        echo '孟加拉虎会爬树' . PHP_EOL;
    }
}

class Cat {
    public function climb()
    {
        echo '猫会爬树' . PHP_EOL;
    }
}

/**
 * 驯兽师类
 * 类名重复，todo 怎么解决
 */
class Trainer {
    // 传参，参数为对象
    public static function call(Tiger $animal) {
//        var_dump($animal);
        $animal->climb();
    }
}

// 传参为对象
$t1 = Trainer::call(new XblyTiger());
$t2 = Trainer::call(new MjlTiger());
//$t3 = Trainer::call(new Cat());