<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('country_id');
            $table->integer('type')->default(1);
            $table->string('title');
            $table->string('address');
            $table->float('lat', 10, 6)->nullable();
            $table->float('lng', 10, 6)->nullable();
            $table->float('price');
            $table->string('phone')->nullable();
            $table->integer('max_adults')->nullable();
            $table->integer('max_kids')->default(0);
            $table->integer('bedrooms');
            $table->integer('beds');
            $table->integer('baths');
            $table->text('description')->nullable();
            $table->text('rules')->nullable();
            $table->text('cancellation')->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('properties');
    }
}
