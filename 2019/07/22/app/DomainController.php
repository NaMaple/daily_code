<?php
/**
 * Created by PhpStorm.
 * User: edz
 * Date: 2019-07-22
 * Time: 19:15
 */
namespace Sample\Controllers;

use \interop\Container\ContainerInterface;

class DomainController
{
    protected $app;

    public function __construct(ContainerInterface $ci)
    {
        $this->app = $ci;
    }

    public function get($request, $response, $params)
    {
        echo 'Welcome Slim';
    }
}