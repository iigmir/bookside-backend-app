<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCollection;
use App\Models\Book;
use App\Rules\FormatIsbn;

class Books extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = BookCollection::all();
        return response([
            "message" => "success",
            "result" => $model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function format_isbn($isbn) {
        // Remove any non-digit characters from the ISBN
        $cleaned_isbn = preg_replace("/[^0-9]/", "", $isbn);
        return $cleaned_isbn;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "isbn" => ["required", "unique:books", new FormatIsbn],
            "book" => ["required"],
            // "wikidata" => ["unique:books"],
        ]);
        if( $validated ) {
            $model = new BookCollection();
            $input = [
                "isbn" => $this->format_isbn($request->isbn),
                "book" => $request->book,
                "author" => $request->author,
                "wikidata" => $request->wikidata,
            ];
            $model->store_book($input);
            return [
                "message" => "success",
                "result" => $model
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Book::find($id);
        $code = isset($model) ? 200 : 404;
        $message = isset($model) ? "success" : "not found";
        return response([
            "message" => $message,
            "result" => $model
        ], $code);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
