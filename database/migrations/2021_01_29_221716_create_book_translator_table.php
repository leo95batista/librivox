<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTranslatorTable extends Migration
{
    /**
     * Table name
     *
     * @var string
     */
    private $table = 'book_translator';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('translator_id');

            $table->foreign('book_id')->references('id')
                ->on('books')
                ->cascadeOnDelete();

            $table->foreign('translator_id')->references('id')
                ->on('translators')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_translator');
    }
}
