@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white d-flex align-items-center justify-content-between">
          <h5 class="mb-0 fw-semibold">✏️ Edit Data User</h5>
          <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </div>

        <div class="card-body p-4">
          <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4 align-items-start">
              {{-- Kiri: Foto Profil --}}
              <div class="col-md-4 text-center border-end">
                <div class="avatar-wrapper">
                  <img id="preview-avatar" 
                       src="{{ $user->avatar_url ? asset($user->avatar_url) : asset('images/default-avatar.png') }}" 
                       class="rounded-circle shadow-sm mb-3"
                       style="width: 140px; height: 140px; object-fit: cover; border: 3px solid #eee;">
                  <div class="mt-2">
                    <input type="file" name="avatar" id="avatar" class="form-control form-control-sm"
                           accept="image/*" onchange="previewImage(event)">
                  </div>
                  <small class="text-muted d-block mt-2">Format: JPG/PNG, max 2MB</small>
                  @error('avatar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>
              </div>

              {{-- Kanan: Form Data --}}
              <div class="col-md-8">
                <div class="row g-3">
                  {{-- Nama --}}
                  <div class="col-md-6">
                    <label for="name" class="form-label fw-medium">Nama Lengkap</label>
                    <input type="text" class="form-control shadow-sm" id="name" name="name"
                           value="{{ old('name', $user->name) }}" required>
                  </div>

                  {{-- Email --}}
                  <div class="col-md-6">
                    <label for="email" class="form-label fw-medium">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email"
                           value="{{ old('email', $user->email) }}" required>
                  </div>

                  {{-- Departemen --}}
                  <div class="col-md-6">
                    <label for="departemen" class="form-label fw-medium">Departemen</label>
                    <input type="text" class="form-control shadow-sm" id="departemen" name="departemen"
                           value="{{ old('departemen', $user->departemen) }}">
                  </div>

                  {{-- Jabatan --}}
                  <div class="col-md-6">
                    <label for="jabatan" class="form-label fw-medium">Jabatan</label>
                    <input type="text" class="form-control shadow-sm" id="jabatan" name="jabatan"
                           value="{{ old('jabatan', $user->jabatan) }}">
                  </div>

                  {{-- No HP --}}
                  <div class="col-md-6">
                    <label for="phone" class="form-label fw-medium">Nomor HP</label>
                    <input type="text" class="form-control shadow-sm" id="phone" name="phone"
                           value="{{ old('phone', $user->phone) }}">
                  </div>

                  {{-- Role --}}
                  <div class="col-md-3">
                    <label for="role" class="form-label fw-medium">Role</label>
                    <select name="role" id="role" class="form-select shadow-sm">
                      <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                      <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                  </div>

                  {{-- Status --}}
                  <div class="col-md-3 d-flex align-items-center">
                    <div class="form-check form-switch mt-3">
                      <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                             value="1" {{ $user->is_active ? 'checked' : '' }}>
                      <label class="form-check-label" for="is_active">Aktif</label>
                    </div>
                  </div>

                  {{-- Password --}}
                  <div class="col-md-6">
                    <label for="password" class="form-label fw-medium">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" class="form-control shadow-sm" id="password" name="password" placeholder="••••••••">
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
              <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4">← Kembali</a>
              <button type="submit" class="btn btn-brand px-4">💾 Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script preview avatar --}}
<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = e => document.getElementById('preview-avatar').src = e.target.result;
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
@endsection
