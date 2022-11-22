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
        Schema::connection('mysql_2')->create('administrative_regions', function (Blueprint $table) {
            $table->id()->comment('Mã định danh của khu vực');
            $table->string('name', 255)->comment('Tên khu vực bằng tiếng Việt');
            $table->string('name_en', 255)->comment('Tên khu vực bằng tiếng Anh');
            $table->string('code_name', 255)->comment('Tên mã khu vực bằng tiếng Việt, tạo theo định dạng chữ thường xếp gạch	');
            $table->string('code_name_en', 255)->comment('Tên mã khu vực bằng tiếng Anh, tạo theo định dạng chữ thường xếp gạch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_2')->dropIfExists('administrative_regions');
    }
};