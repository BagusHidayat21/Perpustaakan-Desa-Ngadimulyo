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
        Schema::create('buku__favorits', function (Blueprint $table) {
            $table->id(); // kolom id
            $table->unsignedBigInteger('id_user'); // kolom id_user
            $table->unsignedBigInteger('id_buku'); // kolom id_buku
            $table->timestamps(); // kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku__favorits');
    }
};
