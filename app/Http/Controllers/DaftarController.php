<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       // pastikan login
    }

    public function index(Request $request)
    {
        $query = User::query()
            ->select([
                'id', 'name', 'email', 'departemen', 'role', 'is_active', 'created_at'
            ])
            // opsional: tampilkan hanya user (bukan admin) sebagai default
            ->when(!$request->filled('role'), fn ($q) => $q->where('role', 'user'))
            ->when($request->filled('role') && in_array($request->role, ['user','admin']), function ($q) use ($request) {
                $q->where('role', $request->role);
            })
            ->when($request->filled('is_active') && in_array((string)$request->is_active, ['0','1']), function ($q) use ($request) {
                $q->where('is_active', (bool)$request->is_active);
            })
            ->when($request->filled('departemen'), function ($q) use ($request) {
                $q->where('departemen', $request->departemen);
            })
            ->when($request->filled('q'), function ($q) use ($request) {
                $kw = trim($request->q);
                $q->where(function ($w) use ($kw) {
                    $w->where('name', 'like', "%{$kw}%")
                      ->orWhere('email', 'like', "%{$kw}%");
                });
            })
            // ->withCount('presensis')
            ->latest(); // created_at desc

        $users = $query->get();

        return view('admin.daftar', compact('users'));
    }
}
