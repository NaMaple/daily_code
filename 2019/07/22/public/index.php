<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-22
 * Time: 19:09
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php'; //自动加载的脚本

$settings = require '../app/setting.php'; //引入设置的配置文件
$app = new \Slim\App($settings);

require '../app/dependencies.php'; //引入controller配置文件
require '../app/routes.php'; //引入路由管理文件

$app->run(); //执行