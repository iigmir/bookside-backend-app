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
        Schema::table("books", function (Blueprint $table) {
            $table->string("wikidata", 16)->nullable()->comment("Identifier from Wikidata");
        });
        Schema::table("authors", function (Blueprint $table) {
            $table->string("wikidata", 16)->nullable()->comment("Identifier from Wikidata");
        });

        DB::statement("ALTER TABLE books ADD CONSTRAINT chk_wikidata_format CHECK (wikidata LIKE 'Q%' AND wikidata NOT LIKE 'Q%[^0-9]%')");
        DB::statement("ALTER TABLE authors ADD CONSTRAINT chk_wikidata_format CHECK (wikidata LIKE 'Q%' AND wikidata NOT LIKE 'Q%[^0-9]%')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("books", function (Blueprint $table) {
            $table->dropColumn("wikidata");
            DB::statement("ALTER TABLE books DROP CONSTRAINT chk_wikidata_format");
        });
        Schema::table("authors", function (Blueprint $table) {
            $table->dropColumn("wikidata");
            DB::statement("ALTER TABLE authors DROP CONSTRAINT chk_wikidata_format");
        });
    }
};
