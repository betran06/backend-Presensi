@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<div class="auth-wrap">
  <div class="card auth-card">
    <div class="card-header">
      <h5 class="auth-title">{{ __('Register') }}</h5>
      <div class="auth-subtitle">{{ __('Buat akun baru untuk presensi') }}</div>
    </div>

    <div class="card-body p-4 p-md-5">
      <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        {{-- Name --}}
        <div class="form-floating mb-3">
          <input id="name" type="text" 
                 class="form-control @error('name') is-invalid @enderror"
                 name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                 placeholder="Nama Lengkap">
          <label for="name">{{ __('Name') }}</label>
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="form-floating mb-3">
          <input id="email" type="email" 
                 class="form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email') }}" required autocomplete="email"
                 placeholder="name@example.com">
          <label for="email">{{ __('Email Address') }}</label>
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Password --}}
        <div class="form-floating mb-3">
          <input id="password" type="password" 
                 class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="new-password"
                 placeholder="••••••••">
          <label for="password">{{ __('Password') }}</label>
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-floating mb-4">
          <input id="password-confirm" type="password" 
                 class="form-control"
                 name="password_confirmation" required autocomplete="new-password"
                 placeholder="••••••••">
          <label for="password-confirm">{{ __('Confirm Password') }}</label>
        </div>

        {{-- Submit --}}
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-brand btn-lg">{{ __('Register') }}</button>
        </div>

        {{-- Link to Login --}}
        <div class="text-center">
          <span class="text-muted">{{ __('Sudah punya akun?') }}</span>
          <a href="{{ route('login') }}" class="link-brand">{{ __('Login') }}</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
