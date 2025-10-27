@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0 fw-semibold">➕ Tambah User Baru</h5>
          <span class="badge bg-brand text-light px-3 py-2">Form User</span>
        </div>

        <div class="card-body p-4">
          <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-4 align-items-start">
              {{-- Kiri: Foto Profil --}}
              <div class="col-md-4 text-center border-end">
                <div class="avatar-wrapper">
                  <img id="preview-avatar" 
                       src="{{ asset('images/default-avatar.png') }}" 
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
                           value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                  </div>

                  {{-- Email --}}
                  <div class="col-md-6">
                    <label for="email" class="form-label fw-medium">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email" 
                           value="{{ old('email') }}" required>
                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                  </div>

                  {{-- Departemen --}}
                  <div class="col-md-6">
                    <label for="departemen" class="form-label fw-medium">Departemen</label>
                    <input type="text" class="form-control shadow-sm" id="departemen" 
                           name="departemen" value="{{ old('departemen') }}" placeholder="Opsional">
                  </div>

                  {{-- Jabatan --}}
                  <div class="col-md-6">
                    <label for="jabatan" class="form-label fw-medium">Jabatan</label>
                    <input type="text" class="form-control shadow-sm" id="jabatan" 
                           name="jabatan" value="{{ old('jabatan') }}" placeholder="Opsional">
                  </div>

                  {{-- Phone --}}
                  <div class="col-md-6">
                    <label for="phone" class="form-label fw-medium">Nomor HP</label>
                    <input type="text" class="form-control shadow-sm" id="phone" 
                           name="phone" value="{{ old('phone') }}" placeholder="08xxxx">
                  </div>

                  {{-- Role --}}
                  <div class="col-md-3">
                    <label for="role" class="form-label fw-medium">Role</label>
                    <select class="form-select shadow-sm" id="role" name="role" required>
                      <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                      <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                  </div>

                  {{-- Status aktif --}}
                  <div class="col-md-3 d-flex align-items-center">
                    <div class="form-check form-switch mt-3">
                      <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                      <label class="form-check-label" for="is_active">Aktif</label>
                    </div>
                  </div>

                  {{-- Password --}}
                  <div class="col-md-6">
                    <label for="password" class="form-label fw-medium">Password</label>
                    <input type="password" class="form-control shadow-sm" id="password" name="password" required>
                  </div>
                </div>
              </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
              <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4">← Kembali</a>
              <button type="submit" class="btn btn-brand px-4">💾 Simpan User</button>
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
