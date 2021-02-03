<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReaderSectionTable extends Migration
{
    /**
     * Table name
     *
     * @var string
     */
    private $table = 'reader_section';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reader_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();

            $table->foreign('reader_id')->references('id')
                ->on('readers')
                ->cascadeOnDelete();

            $table->foreign('section_id')->references('id')
                ->on('sections')
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
