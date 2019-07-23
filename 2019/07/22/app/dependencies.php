<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-22
 * Time: 19:18
 */

$container = $app->getContainer();

//hello
$container['Sample\Controllers\DomainController'] = function ($c) {
    return new \Sample\Controllers\DomainController($c);
};