<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookCollection extends Model
{
    use HasFactory;
    protected $table = "book_list";
    protected $primaryKey = "isbn";
    protected $casts = [
        "isbn" => "string",
    ];


    public function store_book($input) {
        $book_model = new Book();
        // Essiencial data
        $book_model->isbn = $input["isbn"];
        $book_model->name = $input["book"];
        // Wikidata
        if (isset($input["wikidata"])) {
            $book_model->wikidata = $input["wikidata"];
        }
        $book_model->save();
        // Set author
        $author_model = Author::store_author($input["author"]);
        // Set link
        DB::table("book_author_links")->insert([
            "isbn" => $input["isbn"],
            "aid" => $author_model->id
        ]);
        return $book_model;
    }
}
