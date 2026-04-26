<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->string('judul_penelitian')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('link_media')->nullable();
            $table->string('gambar_cover')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn([
                'judul_penelitian',
                'tahun_terbit',
                'link_media',
                'gambar_cover'
            ]);
        });
    }
};
