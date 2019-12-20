<?php
namespace think;

require __DIR__ . '/base.php';

Container::get('app', [defined('APP_PATH') ? APP_PATH : ''])
    ->run()
    ->send();