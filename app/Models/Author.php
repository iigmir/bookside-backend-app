<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = "authors";
    public $timestamps = false;

    static public function store_author($input) {
        $model = Author::where("name", $input)->first();
        if (!$model) {
            // Author doesn't exist, so create a new one
            $model = new Author();
            $model->name = $input;
            $model->save();
        }
        return $model;
    }
}
