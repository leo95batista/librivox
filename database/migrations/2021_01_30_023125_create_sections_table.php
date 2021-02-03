<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Table name
     *
     * @var string
     */
    private $table = 'sections';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_id')->unsigned();
            $table->integer('section_number')->nullable();
            $table->text('title')->nullable();
            $table->text('listen_url')->nullable();
            $table->text('language')->nullable();
            $table->integer('playtime')->nullable();
            $table->text('file_name')->nullable();
            $table->timestamps();

            $table->foreign('book_id')->references('id')
                ->on('books')
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
        Schema::dropIfExists($this->table);
    }
}
