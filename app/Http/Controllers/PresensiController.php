<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User; // ✅ pastikan model User dipanggil di sini
use Illuminate\Http\Request;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Rekap presensi untuk admin, hanya akun role "user".
     * Filter:
     *  - ?tanggal=YYYY-MM-DD
     *  - ?bulan=YYYY-MM
     */
    public function rekap(Request $request)
    {
        $query = Presensi::with(['user:id,name,role,is_active'])
            ->whereHas('user', function ($q) {
                $q->where('role', 'user')
                  ->where('is_active', true); 
            });

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        elseif ($request->filled('bulan')) {
            try {
                $month = Carbon::parse($request->bulan);
                $query->whereMonth('tanggal', $month->month)
                      ->whereYear('tanggal', $month->year);
            } catch (\Throwable $e) {
            }
        }

        $presensis = $query->orderByDesc('tanggal')
            ->get()
            ->map(function ($item) {
                $dt = Carbon::parse($item->tanggal)->locale('id');
                $dt->settings(['formatFunction' => 'translatedFormat']);
                $item->tanggal_formatted = $dt->format('l, j F Y');
                return $item;
            });

        $users = User::where('role', 'user')->where('is_active', true)->orderBy('name')->get();

        return view('admin.recap', compact('presensis', 'users'));
    }
}
