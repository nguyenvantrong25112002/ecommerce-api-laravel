<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_bills', function (Blueprint $table) {
            $table->dropColumn('payment');
            $table->dropColumn('subtotal');
            $table->dropColumn('tax_vat');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_bills', function (Blueprint $table) {
            $table->string('payment_methods', 100);
            $table->integer('status_bill_id');
        });
    }
};