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
        Schema::create('calendar_marks', function (Blueprint $table) {
            $table->id();

            // Wajib: user & tanggal
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');

            // Kode status untuk pewarnaan kalender
            // had i r | a l p a | i z i n | s a k i t | c u t i | d i n a s | l e m b u r
            $table->enum('type', ['hadir', 'alpa', 'izin', 'sakit', 'cuti', 'dinas', 'lembur']);

            // Referensi ke sumber data (opsional)
            $table->unsignedBigInteger('presensi_id')->nullable();         // refer ke presensis.id
            $table->unsignedBigInteger('izin_pengajuan_id')->nullable();   // refer ke izin_pengajuans.id
            $table->unsignedBigInteger('lembur_pengajuan_id')->nullable(); // kalau nanti ada tabel lembur

            // Keterangan bebas (opsional)
            $table->string('note')->nullable();

            $table->timestamps();

            // Satu user, satu tanggal, satu jenis mark → unik
            $table->unique(['user_id', 'tanggal', 'type'], 'uniq_user_tanggal_type');

            // Index bantu buat query bulanan
            $table->index(['user_id', 'tanggal'], 'idx_user_tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_marks');
    }
};
