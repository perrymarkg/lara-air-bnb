<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('property_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id');
            $table->integer('user_image_id');
            $table->text('title');
            $table->text('description');
            $table->integer('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('property_images');
    }
}
