<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {

            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('image', 255);
            $table->text('url_to')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('order')->default();
            $table->string('slug')->unique()->nullable();
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
        Schema::dropIfExists('banners');
    }
}