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
            $table->text('title')->nullable();
            $table->text('language')->nullable();
            $table->text('description')->nullable();
            $table->text('url_text_source')->nullable();
            $table->integer('copyright_year')->nullable();
            $table->integer('num_sections')->nullable();
            $table->text('url_rss')->nullable();
            $table->text('url_zip_file')->nullable();
            $table->text('url_project')->nullable();
            $table->text('url_librivox')->nullable();
            $table->text('url_other')->nullable();
            $table->text('totaltime')->nullable();
            $table->text('totaltimesecs')->nullable();
            $table->text('url_iarchive')->nullable();
            $table->text('thumbnail')->nullable();
            $table->timestamps();
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
