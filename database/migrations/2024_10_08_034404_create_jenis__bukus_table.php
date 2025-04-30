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
        Schema::create('jenis__bukus', function (Blueprint $table) {
            $table->id('id'); // kolom id
            $table->string('jenis_buku'); // kolom jenis buku
            $table->timestamps(); // kolom untuk created_at dan updated_at
        });

        // Insert data jenis buku setelah tabel dibuat
        DB::table('jenis__bukus')->insert([
            ['jenis_buku' => 'Karya Umum'],
            ['jenis_buku' => 'Filsafat & Psikologi'],
            ['jenis_buku' => 'Agama'],
            ['jenis_buku' => 'Ilmu Sosial'],
            ['jenis_buku' => 'Bahasa'],
            ['jenis_buku' => 'IPA & Matematika'],
            ['jenis_buku' => 'Teknologi'],
            ['jenis_buku' => 'Seni & Rekreasi'],
            ['jenis_buku' => 'Sastra'],
            ['jenis_buku' => 'Sejarah & Geografi'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis__bukus');
    }
};
