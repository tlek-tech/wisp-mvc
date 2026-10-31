<?php
global $app;

// Demo/debug-only routes showing the MVC plugin features.
// Never registered unless APP_DEBUG=true, same convention as other demo routes.
if (($_ENV['APP_DEBUG'] ?? 'false') === 'true') {
    // 1. Controller@action string routing style
    $app->get('/mvc-demo', 'UserController@index');

    // 2. [ControllerClass, action] array routing style
    $app->get('/mvc-demo/db', ['UserController', 'dbDemo']);
}
