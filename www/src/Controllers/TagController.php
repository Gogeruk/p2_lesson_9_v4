<?php

namespace Hillel\Controllers;

use Hillel\Model\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Validator;

class TagController
{

    /**
     * -- go to table
     */
    public function table()
    {
        $tags = \Hillel\Model\Tag::paginate(2);

        $_SESSION['pagination_of'] = 'tag';

        return view('pages/list-tags', ['tags' => $tags]);
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
        return view('pages/form-tag', ['title' => $title, 'slug' => $slug]);
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
            return \Hillel\Controllers\TagController::create();
        }else {     // Validation is passed
            $new_tag = new \Hillel\Model\Tag();
            $new_tag ->title = $data['title'];
            $new_tag ->slug  = $data['slug'];
            $new_tag ->save();

            $_SESSION['status'] = 'A new tag has benn created.';

            return new RedirectResponse('/tag');
        }
    }

    /**
     * -- go to update
     */
    public function update($id)
    {
        $_SESSION['creating'] = false;

        $data = request()->all();
        $tag = \Hillel\Model\Tag::find($id);

        if ($data != null) {
            $title = $data['title'];
            $slug = $data['slug'];
        }else {
            $title = $tag['title'];
            $slug = $tag['slug'];
        }

        return view('pages/form-tag', ['id' => $tag['id'], 'title' => $title, 'slug' => $slug]);
    }

    /**
     * -- update stuff
     */
    public function saveUpdate($id)
    {
        $data = request()->all();
        $up_tag = \Hillel\Model\Tag::find($id);

        // VALDATION
        $validator = validator()->make($data, [
            'slug'  => ['required', 'min:5', 'max:255', 'string'],
            'title' => ['required', 'min:5', 'max:255', 'string'],
        ]);

        $errors = $validator->errors();
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors->toarray();
            return \Hillel\Controllers\TagController::update($up_tag->id);
        }else{      // Validation is passed
            $up_tag ->title = $data['title'];
            $up_tag ->slug  = $data['slug'];
            $up_tag ->save();

            $_SESSION['status'] = "A tag #".$id." has benn updated.";

            return new RedirectResponse('/tag');
        }
    }

    /**
     * -- delte stuff
     */
    public function saveDelete($id)
    {
        $tag = \Hillel\Model\Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();

        $_SESSION['status'] = "A tag #".$id." has benn deleted.";

        return new RedirectResponse('/tag');
    }
}
