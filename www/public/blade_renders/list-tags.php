<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

$tags = \Hillel\Model\Tag::all();

echo $blade->make('pages/list-tags', ['tags' => $tags])->render();








?>
