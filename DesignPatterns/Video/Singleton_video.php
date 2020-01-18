<?php

/**
 * 第一步普通类，外部new
 */

class Singleton {

}

$s1 = new Singleton();
$s2 = new Singleton();

///**
// * 两个对象是一个的时候，才全等
// */
//if ($s1 === $s2) {
//    echo '1' . PHP_EOL;
//} else {
//    echo '0' . PHP_EOL;
//}

/**
 * 第二步，封锁外部new操作，一个都new不了
 * new的时候，会触发__construct()构造函数
 * 将构造函数控制访问权限改为protected，private；外部不允许new
 * 之前只知道，访问方法受限制
 * public 任何地方；
 * protected 本类，子类，父类访问；
 * private 本类访问
 */
//class Singleton {
//    private function __construct()
//    {
//        echo '1' . PHP_EOL;
//    }
//}

//$s1 = new Singleton();

/**
 * 第三步，留个接口new对象
 */
//class Singleton {
//    public static function getIns() {
//        // new 自己，自身类实例化
//        return new self();
//    }
//
//    protected function __construct() {}
//}
//
//$s1 = Singleton::getIns();
//$s2 = Singleton::getIns();
//
///**
// * 两个对象是一个的时候，才全等
// */
//if ($s1 === $s2) {
//    echo '是一个对象' . PHP_EOL;
//} else {
//    echo '不是一个对象' . PHP_EOL;
//}

/**
 * 第四步
 */
//class Singleton {
//    protected static $ins = null;
//
//    public static function getIns() {
//        // 做判断，防止重复new
//        if (self::$ins == null) {
//            // new 自己，自身类实例化
//            // 将对象赋值给静态属性
//            self::$ins = new self();
//        }
//        return self::$ins;
//
//
//    }
//
//    protected function __construct() {}
//}

//$s1 = Singleton::getIns();
//$s2 = Singleton::getIns();
//
///**
// * 两个对象是一个的时候，才全等
// */
//if ($s1 === $s2) {
//    echo '是一个对象' . PHP_EOL;
//} else {
//    echo '不是一个对象' . PHP_EOL;
//}

/**
 * 第五步
 * 被继承后，公开了
 * 回避被继承问题，final，防止继承后修改权限
 */
//class Singleton {
//    protected static $ins = null;
//
//    public static function getIns() {
//        // 做判断，防止重复new
//        if (self::$ins == null) {
//            // new 自己，自身类实例化
//            // 将对象赋值给静态属性
//            self::$ins = new self();
//        }
//        return self::$ins;
//
//
//    }
//
//    // 方法前加final，则方法不能被覆盖；
//    // 类前加final，则类不能被继承
//    final protected function __construct() {}
//}
//
//class multi extends Singleton {
//}
//
//$s1 = Singleton::getIns();
//// 被克隆了，又产生了多个对象
//$s2 = clone $s1;
//
///**
// * 两个对象是一个的时候，才全等
// */
//if ($s1 === $s2) {
//    echo '是一个对象' . PHP_EOL;
//} else {
//    echo '不是一个对象' . PHP_EOL;
//}

/**
 * 第六步，禁止clone
 */
//class Singleton {
//    protected static $ins = null;
//
//    public static function getIns() {
//        // 做判断，防止重复new
//        if (self::$ins == null) {
//            // new 自己，自身类实例化
//            // 将对象赋值给静态属性
//            self::$ins = new self();
//        }
//        return self::$ins;
//
//
//    }
//
//    // 方法前加final，则方法不能被覆盖；
//    // 类前加final，则类不能被继承
//    final protected function __construct() {}
//
//    // 封锁clone
//    final protected function __clone() {}
//}
//
//$s1 = Singleton::getIns();
//// 被克隆了，又产生了多个对象
//$s2 = clone $s1;
//
///**
// * 两个对象是一个的时候，才全等
// */
//if ($s1 === $s2) {
//    echo '是一个对象' . PHP_EOL;
//} else {
//    echo '不是一个对象' . PHP_EOL;
//}