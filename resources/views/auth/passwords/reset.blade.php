@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
<div class="auth-wrap">
  <div class="card auth-card">
    <div class="card-header">
      <h5 class="auth-title">{{ __('Reset Password') }}</h5>
      <div class="auth-subtitle">{{ __('Atur ulang kata sandi akun Anda') }}</div>
    </div>

    <div class="card-body p-4 p-md-5">
      <form method="POST" action="{{ route('password.update') }}" novalidate>
        @csrf
        {{-- Token reset wajib --}}
        <input type="hidden" name="token" value="{{ $token }}">

        {{-- Email --}}
        <div class="form-floating mb-3">
          <input id="email" type="email"
                 class="form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email', $email ?? '') }}" required autocomplete="email"
                 placeholder="name@example.com">
          <label for="email">{{ __('Email Address') }}</label>
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Password baru --}}
        <div class="form-floating mb-3">
          <input id="password" type="password"
                 class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="new-password"
                 placeholder="••••••••">
          <label for="password">{{ __('New Password') }}</label>
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Konfirmasi password --}}
        <div class="form-floating mb-4">
          <input id="password-confirm" type="password"
                 class="form-control"
                 name="password_confirmation" required autocomplete="new-password"
                 placeholder="••••••••">
          <label for="password-confirm">{{ __('Confirm New Password') }}</label>
        </div>

        {{-- Submit --}}
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-brand btn-lg">
            {{ __('Reset Password') }}
          </button>
        </div>

        {{-- Link back to login --}}
        <div class="text-center">
          <a href="{{ route('login') }}" class="link-brand">{{ __('Back to Login') }}</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
