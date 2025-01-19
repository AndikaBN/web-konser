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
        Schema::create('konser', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade');
            $table->string('nama_konser');
            $table->date('tanggal_konser');
            $table->time('waktu_konser');
            $table->string('lokasi');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_tiket', 10, 2);
            $table->integer('jumlah_tiket');
            $table->text('promosi_diskon')->nullable(); 
            $table->string('gambar_konser')->nullable();
            $table->string('status_konser')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konser');
    }
};
