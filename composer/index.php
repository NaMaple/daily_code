<?php
require('vendor/autoload.php');

use NoahBuscher\Macaw\Macaw;

Macaw::get('/', function(){
    echo 1;
});
Macaw::get('/hello', function(){
    echo 2;
});
Macaw::get('page', 'Controllers\demo@page');
Macaw::get('view/(:num)', 'Controllers\demo@view');

Macaw::dispatch();