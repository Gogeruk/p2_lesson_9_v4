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
    $new_tag = new \Hillel\Model\Tag();
    $new_tag ->title = $_POST['title'];
    $new_tag ->slug = $_POST['slug'];
    $new_tag ->save();

    header("location:list-tags.php");
}

echo $blade->make('pages/create-tag', ['id' => $id, 'title' => $title, 'slug' => $slug])->render();








?>
