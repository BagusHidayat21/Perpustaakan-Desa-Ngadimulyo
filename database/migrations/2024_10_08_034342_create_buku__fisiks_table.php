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
        Schema::create('buku__fisiks', function (Blueprint $table) {
            $table->id(); // kolom id
            $table->string('judul_buku'); // kolom judul buku
            $table->string('jenis_buku'); // kolom jenis buku
            $table->string('penulis'); // kolom penulis
            $table->string('penerbit'); // kolom penerbit
            $table->year('tahun_terbit'); // kolom tahun terbit
            $table->string('nomor_buku')->unique(); // kolom nomor buku
            $table->string('status')->default('Tersedia');; // kolom nomor buku
            $table->string('cover_buku')->nullable();
            $table->timestamps(); // kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku__fisiks');
    }
};
