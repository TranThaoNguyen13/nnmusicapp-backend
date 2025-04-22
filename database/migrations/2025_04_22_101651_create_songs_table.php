<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->string('url')->nullable();
            $table->string('quality')->nullable();
            $table->integer('trending_score')->nullable();
            $table->boolean('is_recommended')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->foreignId('album_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('lyrics')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
