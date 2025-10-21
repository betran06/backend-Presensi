<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id');
    }

    /**
     * GET /api/presensis
     * Menampilkan seluruh data presensi milik user login.
     */
    public function getPresensis()
    {
        $userId = Auth::id();

        $presensis = Presensi::where('user_id', $userId)
            ->orderByDesc('tanggal')
            ->get()
            ->map(function ($item) {
                $tanggal = Carbon::parse($item->tanggal);
                $masuk   = $item->jam_masuk ? Carbon::parse($item->jam_masuk)->format('H:i') : '-';
                $pulang  = $item->jam_pulang ? Carbon::parse($item->jam_pulang)->format('H:i') : '-';

                return [
                    'id'               => $item->id,
                    'tanggal'          => $tanggal->translatedFormat('l, j F Y'),
                    'jam_masuk'        => $masuk,
                    'jam_pulang'       => $pulang,
                    'status'           => $item->status,
                    'keterangan'       => $item->keterangan,
                    'latitude_masuk'   => $item->latitude_masuk,
                    'longitude_masuk'  => $item->longitude_masuk,
                    'latitude_pulang'  => $item->latitude_pulang,
                    'longitude_pulang' => $item->longitude_pulang,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data presensi',
            'data'    => $presensis
        ], 200);
    }

    /**
     * POST /api/presensi
     * Body JSON: { "latitude": -6.200, "longitude": 106.816 }
     * - Jika belum ada record hari ini => Check-In
     * - Jika sudah ada record tanpa jam_pulang => Check-Out
     */
    public function savePresensi(Request $request)
    {
        $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $userId  = Auth::id();
        $today   = date('Y-m-d');
        $now     = date('H:i:s');

        // Cek apakah user sudah presensi hari ini
        $presensi = Presensi::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->first();

        if (!$presensi) {
            // === CHECK-IN ===
            $presensi = Presensi::create([
                'user_id'         => $userId,
                'tanggal'         => $today,
                'jam_masuk'       => $now,
                'latitude_masuk'  => $request->latitude,
                'longitude_masuk' => $request->longitude,
                'status'          => 'hadir',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil presensi masuk',
                'data'    => $presensi
            ], 201);
        }

        if ($presensi->jam_pulang) {
            // Sudah absen pulang
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan presensi pulang hari ini',
                'data'    => null
            ], 422);
        }

        // === CHECK-OUT ===
        $presensi->update([
            'jam_pulang'       => $now,
            'latitude_pulang'  => $request->latitude,
            'longitude_pulang' => $request->longitude,
            'status'           => 'pulang',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil presensi pulang',
            'data'    => $presensi->fresh()
        ], 200);
    }
}
