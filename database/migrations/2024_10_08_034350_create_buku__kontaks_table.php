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
        Schema::create('buku__kontaks', function (Blueprint $table) {
            $table->id(); // kolom id
            $table->string('nama'); // kolom nama
            $table->string('email')->unique(); // kolom email
            $table->text('pesan'); // kolom pesan
            $table->timestamps(); // kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku__kontaks');
    }
};
