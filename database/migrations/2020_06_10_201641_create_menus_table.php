<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('navbar_id')->comment('導覽列');
            $table->string('name')->comment('名稱');
            $table->string('link')->nullable()->comment('對外連結');
            $table->integer('sort')->nullable()->comment('排序');
            $table->boolean('is_list')->default(true)->comment('清單顯示');
            $table->boolean('is_open')->default(true)->comment('是否開放');
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
        Schema::dropIfExists('menus');
    }
}
