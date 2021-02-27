<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';
require_once '../config/blade.php';

// remember values
if (empty($_POST)) {
    $id = null;
}else {
    $id = $_POST['id'];
}


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // validate request
    $tag = \Hillel\Model\Tag::find($_POST['id']);
    if($posts = $tag->posts) {
        foreach ($posts as $post) {
            $tag->posts()->detach($post->id);
        }
        $tag->delete();
    } else $tag->delete();

    header("location:list-tags.php");
}

echo $blade->make('pages/delete-tag', ['id' => $id])->render();


?>
