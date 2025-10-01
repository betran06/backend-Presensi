<?php

namespace App\Http\Controllers;

use App\Models\User;

class DaftarUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Hanya menampilkan daftar user (list)
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.daftar', compact('users'));
    }
}
