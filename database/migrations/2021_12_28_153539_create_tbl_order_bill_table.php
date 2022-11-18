<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('shipping_address_id');
            $table->text('order_notes')->nullable();
            $table->integer('user_id');
            $table->string('code_qr', 255)->unique();
            $table->string('payment');
            $table->integer('total_money');
            $table->integer('subtotal');
            $table->integer('tax_vat');
            $table->integer('status');
            $table->string('token', 255)->nullable();
            $table->integer('quantity_product')->nullable();
            $table->timestamps();
        });
        Schema::create('status_bills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('order_status_bills')->default(0);
            $table->integer('active')->nullable();
            $table->timestamps();
        });
        Schema::create('detailed_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->integer('product_id');
            $table->text('name_product');
            $table->integer('price_product');
            $table->integer('quantily');
            $table->integer('price');
            $table->string('attribute', 20);
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
        Schema::dropIfExists('order_bills');
        Schema::dropIfExists('status_bills');
        Schema::dropIfExists('detailed_bills');
    }
}