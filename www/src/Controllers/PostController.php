<?php

namespace Hillel\Controllers;

use Hillel\Model\Post;
use Hillel\Model\Category;
use Hillel\Model\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Validator;

class PostController
{

    /**
     * -- go to table
     */
    public function table()
    {
        $posts = \Hillel\Model\Post::paginate(2);

        $_SESSION['pagination_of'] = 'post';

        return view('pages/list-posts', ['posts' => $posts]);
    }

    /**
     * -- go to create
     */
    public function create()
    {
        $_SESSION['creating'] = true;

        $categories = Category::all();
        $tags = Tag::all();

        $data = request()->all();
        if (empty($data)) {
            $title    = null;
            $slug     = null;
            $body     = null;
            $category = null;
            $tags_s   = [];
        }else {
            $title    = $data['title'];
            $slug     = $data['slug'];
            $body     = $data['body'];
            $category = $data['category'];
            if(array_key_exists('tags', $data)){
                $tags_s = $data['tags'];
            }else {
                $tags_s = [];
            }
        }
        return view('pages/form-post', ['tags_s'     => $tags_s,
                                        'category_s' => $category,
                                        'categories' => $categories,
                                        'title'      => $title,
                                        'slug'       => $slug,
                                        'body'       => $body,
                                        'tags'       => $tags
                                        ]);
    }

    /**
     * -- save created stuff
     */
    public function saveCreate()
    {
        $data = request()->all();
        // VALDATION
        $validator = validator()->make($data, [
            'slug'     => ['required', 'min:5', 'max:255', 'string'],
            'title'    => ['required', 'min:5', 'max:255', 'string'],
            'body'     => ['required', 'min:5', 'max:3000', 'string'],
            'category' => ['exists:categories,id', 'required'],
            'tags'     => ['exists:tags,id', 'required', ]
        ]);

        $errors = $validator->errors();
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors->toarray();
            return \Hillel\Controllers\PostController::create();
        }else {     // Validation is passed
            $cat = \Hillel\Model\Category::find($data['category']);
            $new_post = new \Hillel\Model\Post();
            $new_post ->title       = $data['title'];
            $new_post ->slug        = $data['slug'];
            $new_post ->body        = $data['body'];
            $new_post ->category_id = $cat['id'];
            $new_post ->save();
            $new_post->tags()->attach($data['tags']);

            $_SESSION['status'] = 'A new post has benn created.';

            return new RedirectResponse('/post');
        }
    }

    /**
     * -- go to update
     */
    public function update($id)
    {
        $_SESSION['creating'] = false;

        $post       = \Hillel\Model\Post::find($id);
        $categories = Category::all();
        $tags       = Tag::all();

        $data       = request()->all();
        $category   = $post->category->id;
        $tags_s     = $post->tags->pluck('id')->toarray();
        if (empty($data)) {
            $title    = $post['title'];
            $slug     = $post['slug'];
            $body     = $post['body'];
        }else {
            $title    = $data['title'];
            $slug     = $data['slug'];
            $body     = $data['body'];
            $category = $data['category'];
            if(array_key_exists('tags', $data)){
                $tags_s = $data['tags'];
            }else {
                $tags_s = [];
            }
        }

        return view('pages/form-post', ['tags_s'      => $tags_s,
                                        'category_s'  => $category,
                                        'categories'  => $categories,
                                        'title'       => $title,
                                        'slug'        => $slug,
                                        'body'        => $body,
                                        'tags'        => $tags,
                                        'category_id' => $post['category_id'],
                                        'id'          => $post['id'],
                                        ]);
    }

    /**
     * -- update stuff
     */
    public function saveUpdate($id)
    {
        $data = request()->all();
        $up_post = \Hillel\Model\Post::find($id);

        // VALDATION
        $validator = validator()->make($data, [
            'slug'     => ['required', 'min:5', 'max:255', 'string'],
            'title'    => ['required', 'min:5', 'max:255', 'string'],
            'body'     => ['required', 'min:5', 'max:3000', 'string'],
            'category' => ['exists:categories,id', 'required'],
            'tags'     => ['exists:tags,id', 'required', ]
        ]);

        $errors = $validator->errors();
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors->toarray();
            return \Hillel\Controllers\PostController::update($up_post->id);
        }else{      // Validation is passed
            $cat = \Hillel\Model\Category::find($data['category']);
            $up_post ->title       = $data['title'];
            $up_post ->slug        = $data['slug'];
            $up_post ->body        = $data['body'];
            $up_post ->category_id = $cat['id'];
            $up_post ->save();
            $up_post->tags()->detach();
            $up_post->tags()->attach($data['tags']);

            $_SESSION['status'] = "A post #".$id." has benn updated.";

            return new RedirectResponse('/post');
        }
    }

    /**
     * -- delte stuff
     */
    public function saveDelete($id)
    {
        $post = \Hillel\Model\Post::find($id);
        $post->tags()->detach();
        $post->delete();

        $_SESSION['status'] = "A post #".$id." has benn deleted.";

        return new RedirectResponse('/post');
    }
}
