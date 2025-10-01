<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarMark extends Model
{
    use HasFactory;

    protected $table = 'calendar_marks';

    /**
     * Kolom yang boleh mass assignment.
     */
    protected $fillable = [
        'user_id',
        'tanggal',
        'type',
        'presensi_id',
        'izin_pengajuan_id',
        'lembur_pengajuan_id',
        'note',
    ];

    /**
     * Relasi ke user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi opsional ke presensi.
     */
    public function presensi()
    {
        return $this->belongsTo(Presensi::class, 'presensi_id');
    }

    /**
     * Relasi opsional ke izin pengajuan.
     */
    public function izinPengajuan()
    {
        return $this->belongsTo(IzinPengajuan::class, 'izin_pengajuan_id');
    }

    /**
     * Relasi opsional ke lembur pengajuan.
     */
    public function lemburPengajuan()
    {
        return $this->belongsTo(LemburPengajuan::class, 'lembur_pengajuan_id');
    }
}
