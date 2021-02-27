<?php

require_once '../vendor/autoload.php';
require_once '../config/eloquent.php';

////////////////////////////////////////////
////    В файле index.php реализовать:  ////
////////////////////////////////////////////

////    1. Создать 5 категорий (insert)    ////

// I
$task1_1 = new \Hillel\Model\Category();
$task1_1->title = "C1";
$task1_1->slug = "S1";
$task1_1->save();
// II
$task1_2 = new \Hillel\Model\Category();
$task1_2->title = "C2";
$task1_2->slug = "S2";
$task1_2->save();
// III
$task1_3 = new \Hillel\Model\Category();
$task1_3->title = "C3";
$task1_3->slug = "S3";
$task1_3->save();
// IV
$task1_4 = new \Hillel\Model\Category();
$task1_4->title = "C4";
$task1_4->slug = "S4";
$task1_4->save();
// V
$task1_5 = new \Hillel\Model\Category();
$task1_5->title = "C5";
$task1_5->slug = "S5";
$task1_5->save();


////    2. Изменить 1 категорию (update)    ////

$task2_u = \Hillel\Model\Category::find(2);
$task2_u->title = "C6";
$task2_u->save();


////    3. Удалить 1 категорию (delete)    ////

$task3_d = \Hillel\Model\Category::find(1);
$task3_d->delete();


////    4. Создать 10 постов, прикрепив случайную категорию    ////
// v2

$cat = \Hillel\Model\Category::all();
for ($i = 1; $i < 11; $i++){
    $task4 = new \Hillel\Model\Post();
    $task4->title = "ran_name".$i;
    $task4->body = "ran_name".$i;
    $task4->slug = "ran_name".$i;
    $task4->category_id = $cat[rand(0,2)]["id"];
    $task4->save();
}


////   5. Обновить 1 пост, заменив поля + категорию  ////
// v2

$cat = \Hillel\Model\Category::all();
$task5 = \Hillel\Model\Post::find(4);
$task5->title = "C888";
$task5->slug = "S888";
$task5->body = "B888";
$task5->category_id = $cat[0]["id"];
$task5->save();


////    6. Удалить пост    ////


$post = \Hillel\Model\Post::find(5);
if($tags = $post->tags) {
    foreach ($tags as $tag) {
        $post->tags()->detach($tag->id);
    }
    $post->delete();
} else $post->delete();


////    7. Создать 10 тегов  ////

for ($i=1; $i < 11; $i++) {
    $tag = new \Hillel\Model\Tag();
    $tag->title = "C"."$i";
    $tag->slug = "S"."$i";
    $tag->save();
}


////    8. Каждому уже сохранённому посту прикрепить по 3 случайных тега    ////
// v3

$tags = \Hillel\Model\Tag::all();
$r1 = $tags[0]->id;
$r2 = count($tags);

$post = \Hillel\Model\Post::all();
foreach ($post as $key => $value) {

    // ROLL
    $rand_1  = rand($r1, $r2);
    $rand_2  = rand($r1, $r2);
    $rand_3  = rand($r1, $r2);

    // Validate random for non equals
    $somevar = 0;
    while ($somevar == 0){
        if ($rand_1 == $rand_2 or $rand_1 == $rand_3) {
            $rand_1  = rand($r1, $r2);
        }
        if ($rand_2 == $rand_3) {
            $rand_2  = rand($r1, $r2);
        }
        if ($rand_1 != $rand_2 and $rand_1 != $rand_3 and $rand_2 != $rand_3) {
            $somevar = 1;
        }
    }

    // do not exec if rand di not go properly
    $post_f = \Hillel\Model\Post::find($key + 1);
    if (!empty($post_f["id"])) {
        $post_f->tags()->attach([$rand_1, $rand_2, $rand_3]);
    }
}


?>
