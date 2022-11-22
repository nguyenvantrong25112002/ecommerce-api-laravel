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
        Schema::connection('mysql_2')->create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->comment('Mã đơn vị chính thức, quy ước bởi chính phủ');
            $table->string('name', 255)->comment('Tên tiếng Việt');
            $table->string('name_en', 255)->comment('Tên tiếng Anh');
            $table->string('full_name', 255)->comment('Tên tiếng Việt đầy đủ kèm tên đơn vị hành chính');
            $table->string('full_name_en', 255)->comment('Tên tiếng Anh đầy đủ kèm tên đơn vị hành chính');
            $table->string('code_name', 255)->comment('Tên mã dựa trên cột name, tạo theo định dạng chữ thường xếp gạch');
            $table->integer('province_code')->comment('Mã tỉnh thành (province) mà đối tượng quận huyện này thuộc về');
            $table->integer('administrative_unit_id')->comment('Mã đơn vị hành chính của đối tượng');
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
        Schema::connection('mysql_2')->dropIfExists('districts');
    }
};