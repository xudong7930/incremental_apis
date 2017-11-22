<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lesson';
    protected $fillable = ['title', 'content', 'some_bool'];
    protected $hidden = [];

    public function some_bool()
    {
        return (boolean)$this->smeo_bool;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
