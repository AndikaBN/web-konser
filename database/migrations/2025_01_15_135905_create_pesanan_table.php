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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konser_id')->constrained('konser');
            $table->foreignId('rekening_id')->constrained('rekening');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('jumlah_tiket');
            $table->decimal('total_harga', 10, 2);
            $table->string('status_pesanan')->default('Menunggu Pembayaran');
            $table->string('bukti_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
