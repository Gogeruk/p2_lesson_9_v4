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
    $category = \Hillel\Model\Category::find($_POST['id']);
    if($posts = $category->post) {
        foreach ($posts as $post) {
            $category->posts()->detach($category->id);
        }
        $category->delete();
    } else $category->delete();

    header("location:list-categories.php");

}

echo $blade->make('pages/delete-category', ['id' => $id])->render();


?>
