<?php

namespace Hillel\Controllers;

use Hillel\Model\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Validator;

class CategoryController
{

    /**
     * -- go to table
     */
    public function table()
    {
        $categories = \Hillel\Model\Category::paginate(2);

        $_SESSION['pagination_of'] = 'category';

        return view('pages/list-categories', ['categories' => $categories]);
    }

    /**
     * -- go to create
     */
    public function create()
    {
        $_SESSION['creating'] = true;

        $data = request()->all();

        if (empty($data)) {
            $title = null;
            $slug  = null;
        }else {
            $title = $data['title'];
            $slug  = $data['slug'];
        }
        return view('pages/form-category', ['title' => $title, 'slug' => $slug]);
    }

    /**
     * -- save created stuff
     */
    public function saveCreate()
    {
        $data = request()->all();

        // VALDATION
        $validator = validator()->make($data, [
            'slug'  => ['required', 'min:5', 'max:255', 'string'],
            'title' => ['required', 'min:5', 'max:255', 'string'],
        ]);

        $errors = $validator->errors();
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors->toarray();
            return \Hillel\Controllers\CategoryController::create();
        }else {     // Validation is passed
            $new_cat = new \Hillel\Model\Category();
            $new_cat ->title = $data['title'];
            $new_cat ->slug  = $data['slug'];
            $new_cat ->save();

            $_SESSION['status'] = 'A new category has benn created.';

            return new RedirectResponse('/category');
        }
    }

    /**
     * -- go to update
     */
    public function update($id)
    {
        $_SESSION['creating'] = false;

        $data = request()->all();
        $category = \Hillel\Model\Category::find($id);

        if ($data != null) {
            $title = $data['title'];
            $slug = $data['slug'];
        }else {
            $title = $category['title'];
            $slug = $category['slug'];
        }

        return view('pages/form-category', ['id' => $category['id'], 'title' => $title, 'slug' => $slug]);
    }

    /**
     * -- update stuff
     */
    public function saveUpdate($id)
    {
        $data = request()->all();
        $up_cat = \Hillel\Model\Category::find($id);


        // VALDATION
        $validator = validator()->make($data, [
            'slug'  => ['required', 'min:5', 'max:255', 'string'],
            'title' => ['required', 'min:5', 'max:255', 'string'],
        ]);

        $errors = $validator->errors();
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors->toarray();
            return \Hillel\Controllers\CategoryController::update($up_cat ->id);
        }else{      // Validation is passed
            $up_cat ->title = $data['title'];
            $up_cat ->slug  = $data['slug'];
            $up_cat->save();

            $_SESSION['status'] = "A category #".$id." has benn updated.";

            return new RedirectResponse('/category');
        }
    }

    /**
     * -- delte stuff
     */
    public function saveDelete($id)
    {

        $category = \Hillel\Model\Category::find($id);
        $posts = $category->posts;
        foreach ($posts as $post) {
            $post->tags()->detach();
            $post->delete();
        }
        $category->delete();;

        $_SESSION['status'] = "A category #".$id." has benn deleted.";

        return new RedirectResponse('/category');
    }
}
