@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
<div class="auth-wrap">
  <div class="card auth-card">
    <div class="card-header">
      <h5 class="auth-title">{{ __('Forgot Password') }}</h5>
      <div class="auth-subtitle">{{ __('Masukkan email untuk reset password') }}</div>
    </div>

    <div class="card-body p-4 p-md-5">
      {{-- Pesan sukses jika link reset sudah dikirim --}}
      @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        {{-- Email --}}
        <div class="form-floating mb-4">
          <input id="email" type="email" 
                 class="form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email') }}" required autocomplete="email"
                 placeholder="name@example.com">
          <label for="email">{{ __('Email Address') }}</label>
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Submit --}}
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-brand btn-lg">
            {{ __('Send Password Reset Link') }}
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
