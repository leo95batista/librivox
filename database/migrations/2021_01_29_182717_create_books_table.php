<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Table name
     *
     * @var string
     */
    private $table = 'books';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->integer('copyright_year')->nullable();
            $table->integer('num_sections')->nullable();
            $table->text('url_text_source')->nullable();
            $table->text('url_rss')->nullable();
            $table->text('url_zip_file')->nullable();
            $table->text('url_project')->nullable();
            $table->text('url_librivox')->nullable();
            $table->text('url_other')->nullable();
            $table->text('url_iarchive')->nullable();
            $table->string('totaltime')->nullable();
            $table->integer('totaltimesecs')->nullable();
            $table->text('thumbnail')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('language_id')->references('id')
                ->on('languages')
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
