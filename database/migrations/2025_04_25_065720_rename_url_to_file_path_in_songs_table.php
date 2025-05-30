<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUrlToFilePathInSongsTable extends Migration
{
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('url', 'file_path');
        });
    }

    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('file_path', 'url');
        });
    }
}