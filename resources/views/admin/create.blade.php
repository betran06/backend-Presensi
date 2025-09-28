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

            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="departemen" class="form-label">Departemen</label>
              <input type="text" class="form-control" id="departemen" name="departemen" placeholder="Opsional">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

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
