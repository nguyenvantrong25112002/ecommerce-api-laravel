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
        Schema::connection('mysql_2')->create('administrative_units', function (Blueprint $table) {
            $table->id()->comment('Mã định danh của đơn vị hành chính');
            $table->string('full_name', 255)->comment('Tên tiếng Việt đầy đủ của đơn vị hành chính');
            $table->string('full_name_en', 255)->comment('Tên tiếng Anh đầy đủ của đơn vị hành chính');
            $table->string('short_name', 255)->comment('Tên tiếng Việt thông dụng của đơn vị hành chính');
            $table->string('short_name_en', 255)->comment('Tên tiếng Anh thông dụng của đơn vị hành chính');
            $table->string('code_name', 255)->comment('Tên mã đơn vị dạng tiếng Việt dựa trên cột full_name, tạo theo định dạng chữ thường xếp gạch');
            $table->string('code_name_en', 255)->comment('Tên mã đơn vị dạng tiếng Anh dựa trên cột full_name_en, tạo theo định dạng chữ thường xếp gạch');
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
        Schema::connection('mysql_2')->dropIfExists('administrative_units');
    }
};