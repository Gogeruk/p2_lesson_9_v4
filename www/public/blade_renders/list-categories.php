<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

$categories = \Hillel\Model\Category::all();

echo $blade->make('pages/list-categories', ['categories' => $categories])->render();








?>
