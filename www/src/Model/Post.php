<?php

namespace Hillel\Model;

use \Illuminate\Database\Eloquent\SoftDeletes;

class Post extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
?>
