<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Form create user baru.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:8'],
            'role'       => ['required', 'in:admin,user'], // default admin atau user
            'departemen' => ['nullable', 'string', 'max:100'],
            'jabatan'    => ['nullable', 'string', 'max:100'],
            'phone'      => ['nullable', 'string', 'max:30'],
            'is_active'  => ['boolean'],
        ]);

        // create user (password otomatis di-hash via mutator di model User)
        User::create($validated);

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password'   => ['nullable', 'string', 'min:8'],
            'role'       => ['required', 'in:admin,user'],
            'departemen' => ['nullable', 'string', 'max:100'],
            'jabatan'    => ['nullable', 'string', 'max:100'],
            'phone'      => ['nullable', 'string', 'max:30'],
            'is_active'  => ['boolean'],
        ]);

        // kalau password kosong, jangan ubah
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}
