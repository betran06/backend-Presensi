<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();

            // Relasi user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data presensi
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->decimal('latitude_masuk', 12, 7)->nullable();
            $table->decimal('longitude_masuk', 12, 7)->nullable();

            $table->time('jam_pulang')->nullable();
            $table->decimal('latitude_pulang', 12, 7)->nullable();
            $table->decimal('longitude_pulang', 12, 7)->nullable();

            // Status & catatan
            $table->enum('status', ['hadir', 'telat', 'pulang', 'alpa'])->default('hadir');
            $table->text('keterangan')->nullable();

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
        Schema::dropIfExists('presensis');
    }
}
