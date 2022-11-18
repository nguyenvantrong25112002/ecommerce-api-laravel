<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_address', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id')->nullable();
            $table->integer('user_id');
            $table->string('full_name', 255);
            $table->string('phone_number', 20);
            $table->string('email', 255);
            $table->string('city_province', 255);
            $table->string('district', 255);
            $table->string('commune_ward_town', 255);
            $table->text('detailed_address');
            $table->integer('default')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_address');
    }
}