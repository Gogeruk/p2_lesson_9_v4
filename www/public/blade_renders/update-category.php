<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

// remember values
if (empty($_GET)) {
    $id = null;
    $title = null;
    $slug = null;
}else {
    $id = $_GET['id'];
    $title = $_GET['title'];
    $slug = $_GET['slug'];
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    // validate request
    if (!empty($_GET)) {
        $up_cat = \Hillel\Model\Category::find($_GET['id']);
        $up_cat ->title = $_GET['title'];
        $up_cat ->slug = $_GET['slug'];
        $up_cat->save();

        header("location:list-categories.php");
    }
}

echo $blade->make('pages/update-category', ['id' => $id, 'title' => $title, 'slug' => $slug])->render();


?>
