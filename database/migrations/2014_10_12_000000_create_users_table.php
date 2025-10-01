<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Tambahan untuk absensi & admin
            $table->string('role')->default('user');          // 'admin' | 'user'
            $table->string('departemen')->nullable();         // nama departemen (opsional)
            $table->string('jabatan')->nullable();            // jabatan/posisi
            $table->string('phone')->nullable();              // no hp opsional
            $table->boolean('is_active')->default(true);      // status akun aktif/nonaktif

             // Device binding & aktivitas login
            $table->string('device_id')->nullable();          // simpan ID device app (opsional)
            $table->timestamp('last_login_at')->nullable();   // terakhir login
            $table->string('last_login_ip', 45)->nullable();  // IPv4/IPv6

            // Profil tambahan
            $table->string('avatar_url')->nullable();         // foto profil opsional
            
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
        Schema::dropIfExists('users');
    }
}
