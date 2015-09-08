<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('user_id', 50)->index();
            $table->string('filename');
            $table->string('path');
            $table->string('mime_type');
            $table->text('text')->nullable();
            $table->enum('location', ['local', 's3']);
            $table->enum('status', ['pending', 'complete']);
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
        Schema::drop('images');
    }
}
