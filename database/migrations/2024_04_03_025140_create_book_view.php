<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW book_list AS SELECT
                books.isbn AS isbn,
                books.name AS book,
                authors.name AS author
            FROM book_author_links
                LEFT JOIN books ON book_author_links.isbn = books.isbn
                LEFT JOIN authors ON book_author_links.aid = authors.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS book_list");
    }
};
