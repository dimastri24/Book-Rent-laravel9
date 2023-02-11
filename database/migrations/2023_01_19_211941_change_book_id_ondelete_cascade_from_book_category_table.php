<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_category', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_category', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->foreign('book_id')->references('id')->on('books')->onDelete('restrict');
        });
    }
};
