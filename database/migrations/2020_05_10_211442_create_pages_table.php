<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('menu_id')->nullable()->comment('選單id');
            $table->string('editor')->comment('編輯者');
            $table->string('title')->comment('標題');
            $table->string('url')->comment('頁面網址');
            $table->longText('content')->nullable()->comment('頁面內容');
            $table->boolean('is_open')->default(true)->comment('是否開放');
            $table->boolean('is_slide')->default(true)->comment('是否輪播');
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
        Schema::dropIfExists('pages');
    }
}
