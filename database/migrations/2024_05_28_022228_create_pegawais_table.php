<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('nama');
            $table->text('alamat');
            $table->string('tempatLahir');
            $table->date('tglLahir');
            $table->string('kelamin');
            $table->string('jabatan');
            $table->date('mulaiMasuk');
            $table->text('job');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
