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
        Schema::table('songs', function (Blueprint $table) {
            // Đổi quality thành ENUM('cao', 'thap')
            $table->enum('quality', ['cao', 'thap'])->nullable()->change();

            // Đổi trending_score thành decimal(5,1) để hỗ trợ số thập phân
            $table->decimal('trending_score', 5, 1)->nullable()->change();

            // Tăng độ dài thumbnail_url lên 1000
            $table->string('thumbnail_url', 1000)->nullable()->change();

            // Đảm bảo is_recommended không NULL, mặc định là 0
            $table->boolean('is_recommended')->default(0)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->string('quality', 255)->nullable()->change();
            $table->integer('trending_score')->nullable()->change();
            $table->string('thumbnail_url', 255)->nullable()->change();
            $table->tinyint('is_recommended')->nullable()->change();
        });
    }
};
