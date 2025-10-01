@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-header">
          <h5 class="mb-0">➕ Tambah User</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('user.store') }}">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
              @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
              @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Departemen --}}
            <div class="mb-3">
              <label for="departemen" class="form-label">Departemen</label>
              <input type="text" class="form-control" id="departemen" name="departemen" value="{{ old('departemen') }}" placeholder="Opsional">
              @error('departemen') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Jabatan --}}
            <div class="mb-3">
              <label for="jabatan" class="form-label">Jabatan</label>
              <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Opsional">
              @error('jabatan') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-3">
              <label for="phone" class="form-label">No. HP</label>
              <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Opsional">
              @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Role --}}
            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-select" id="role" name="role" required>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
              @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
              @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            {{-- Status aktif --}}
            <div class="form-check form-switch mb-4">
              <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
              <label class="form-check-label" for="is_active">Aktifkan Akun</label>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between">
              <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-brand">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
