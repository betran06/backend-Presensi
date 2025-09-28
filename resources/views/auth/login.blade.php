@extends('layouts.auth')
@section('title', 'Login')

@section('content')
  <div class="auth-wrap">
    <div class="card auth-card">
      <div class="card-header">
        <h5 class="auth-title">{{ __('Login') }}</h5>
        <div class="auth-subtitle">{{ __('Masuk untuk mulai presensi') }}</div>
      </div>

      <div class="card-body p-4 p-md-5">
        <form method="POST" action="{{ route('login') }}" novalidate>
          @csrf
          <div class="form-floating mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                   placeholder="name@example.com">
            <label for="email">{{ __('Email Address') }}</label>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-floating mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password" placeholder="••••••••">
            <label for="password">{{ __('Password') }}</label>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember"
                     {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
            </div>
            @if (Route::has('password.request'))
              <a class="link-brand" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            @endif
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-brand btn-lg">{{ __('Login') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
