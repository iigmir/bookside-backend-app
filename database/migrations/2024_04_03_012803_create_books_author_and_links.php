<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("books", function (Blueprint $table) {
            $table->char("isbn", 13)->primary()->unique();
            $table->string("name", 128);
        });
        Schema::create("authors", function (Blueprint $table) {
            $table->id();
            $table->string("name", 128)->default("unknown");
        });
        Schema::create("book_author_links", function (Blueprint $table) {
            $table->char("isbn", 13);
            $table->unsignedBigInteger("aid");

            $table->foreign("isbn")->references("isbn")->on("books");
            $table->foreign("aid")->references("id")->on("authors");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("books");
        Schema::dropIfExists("authors");
        Schema::dropIfExists("book_author_links");
    }
};
