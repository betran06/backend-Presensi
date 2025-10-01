<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_pengajuans', function (Blueprint $table) {
            $table->id();

            // Relasi user yang mengajukan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Jenis pengajuan
            $table->enum('jenis', ['izin', 'sakit', 'cuti', 'dinas']);

            // Rentang tanggal
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            // Detail
            $table->text('alasan')->nullable();

            // Status approval
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // Admin yang memproses
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izin_pengajuans');
    }
}
