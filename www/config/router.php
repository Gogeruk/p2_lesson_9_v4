<?php

use  Illuminate\Events\Dispatcher;

$request = \Illuminate\Http\Request::createFromGlobals();
function request() {
    global $request;

    return $request;
}



$dispatcher = new Dispatcher;
$container = new \Illuminate\Container\Container();
$router = new \Illuminate\Routing\Router($dispatcher, $container);
function router() {
    global $router;

    return $router;
}

\Illuminate\Pagination\Paginator::currentPageResolver(fn() => $_GET['page'] ?? 1);

// index
$router->get('/', "\Hillel\Controllers\HomeController@home");

// Categories
$router->get('/category', "\Hillel\Controllers\CategoryController@table");

$router->get('/category/create', "\Hillel\Controllers\CategoryController@create");
$router->post('/category/create', "\Hillel\Controllers\CategoryController@saveCreate");

$router->get('/category/{id}/update', "\Hillel\Controllers\CategoryController@update");
$router->post("/category/{id}/update", "\Hillel\Controllers\CategoryController@saveUpdate");
$router->get('/category/{id}/update', "\Hillel\Controllers\CategoryController@update");
$router->post("/category/{id}/update", "\Hillel\Controllers\CategoryController@saveUpdate");

$router->get("/category/{id}/delete", "\Hillel\Controllers\CategoryController@saveDelete");


// Tags
$router->get('/tag', "\Hillel\Controllers\TagController@table");

$router->get('/tag/create', "\Hillel\Controllers\TagController@create");
$router->post('/tag/create', "\Hillel\Controllers\TagController@saveCreate");

$router->get('/tag/{id}/update', "\Hillel\Controllers\TagController@update");
$router->post("/tag/{id}/update", "\Hillel\Controllers\TagController@saveUpdate");
$router->get('/tag/{id}/update', "\Hillel\Controllers\TagController@update");
$router->post("/tag/{id}/update", "\Hillel\Controllers\TagController@saveUpdate");

$router->get('/tag/{id}/delete', "\Hillel\Controllers\TagController@saveDelete");

// posts
$router->get('/post', "\Hillel\Controllers\PostController@table");

$router->get('/post/create', "\Hillel\Controllers\PostController@create");
$router->post('/post/create', "\Hillel\Controllers\PostController@saveCreate");

$router->get('/post/{id}/update', "\Hillel\Controllers\PostController@update");
$router->post("/post/{id}/update", "\Hillel\Controllers\PostController@saveUpdate");
$router->get('/post/{id}/update', "\Hillel\Controllers\PostController@update");
$router->post("/post/{id}/update", "\Hillel\Controllers\PostController@saveUpdate");

$router->get('/post/{id}/delete', "\Hillel\Controllers\PostController@saveDelete");

?>
