<?php

    // 如果是相同名稱的 router, 後面的會蓋掉前面的
    
    // http://phalcon.5iunix.net/reference/routing.html
    $router = new \Phalcon\Mvc\Router(false);

    // default
    $router->add('/', array(
        'controller' => 'index',
        'action'     => 'index',
    ));




    // not found
    $router->notFound(array(
        "controller" => 'error',
        "action"     => 'index'
    ));
    return $router;


/*
    // error 404
    $router->add('/404', array(
        "controller" => 'error',
        "action"     => 'index'
    ));

    // matches "/es/news"
    $router->add('/([a-z]{2})', array(
        "controller" => 'index',
        "action"     => 'index',
        "language"   => 1,
    ));

    /demo/aa/33/44
    $router->add("/demo/:params", array(
        'controller' => 'happy',
        'action'     => 'index',
        "params"     => 1,
    ));

    /demo/2000/01/02
    $router->add("/demo/([0-9]{4})/([0-9]{2})/([0-9]{2})/:params", array(
        'controller' => 'happy',
        'action'     => 'index',
        "yearx"      => 1,
        "month"      => 2,
        "day"        => 3,
        "params"     => 4,
    ));

    /demo/2000/01/02
    $router->add("/demo/{year:[0-9]{4}}/{month:[0-9]+}/{day:[0-9]+}", array(
        'controller' => 'happy',
        'action'     => 'index',
    ));

    $router->add("/login", array(
        'module'     => 'backend',
        'controller' => 'login',
        'action'     => 'index',
    ));

    $router->add("/products/:action", array(
        'controller' => 'products',
        'action'     => 1,
    ));

    $router->add(
        "/admin/:controller/:action/:int",
        array(
            "controller" => 1,
            "action"     => 2,
            "id"         => 3,
        )
    );
*/
