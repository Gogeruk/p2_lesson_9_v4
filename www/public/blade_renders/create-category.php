<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

// remember values
if (empty($_POST)) {
    $id = null;
    $title = null;
    $slug = null;
}else {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $slug = $_POST['slug'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // validate request
    $new_cat = new \Hillel\Model\Category();
    $new_cat ->title = $_POST['title'];
    $new_cat ->slug = $_POST['slug'];
    $new_cat ->save();

    header("location:list-categories.php");
}

echo $blade->make('pages/create-category', ['id' => $id, 'title' => $title, 'slug' => $slug])->render();



?>
