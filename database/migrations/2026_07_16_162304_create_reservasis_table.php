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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lapangan_id')->constrained('lapangans')->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->integer('durasi_jam');
            $table->decimal('total_bayar', 10, 2);

            $table->enum('status', ['Pending', 'Lunas', 'Gagal'])->default('Pending');
            $table->string('keterangan')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->timestamp('batas_waktu_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
