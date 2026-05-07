<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {

        /*
         * Home page
         */
        $builder->connect(
            '/',
            ['controller' => 'Pages', 'action' => 'display', 'home']
        );

        /*
         * API Routes
         */
        $builder->connect(
            '/summary',
            ['controller' => 'Api', 'action' => 'summary']
        );

        $builder->connect(
            '/query',
            ['controller' => 'Api', 'action' => 'query']
        );

        /*
         * Optional pages route
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Fallback routes
         */
        $builder->fallbacks();
    });
};