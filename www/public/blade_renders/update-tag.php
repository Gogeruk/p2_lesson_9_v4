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
        $up_tag = \Hillel\Model\Tag::find($_GET['id']);
        $up_tag ->title = $_GET['title'];
        $up_tag ->slug = $_GET['slug'];
        $up_tag->save();

        header("location:list-tags.php");
    }
}

echo $blade->make('pages/update-tag', ['id' => $id, 'title' => $title, 'slug' => $slug])->render();






?>
