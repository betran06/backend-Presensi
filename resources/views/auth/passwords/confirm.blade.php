@extends('layouts.auth')
@section('title', 'Confirm Password')

@section('content')
<div class="auth-wrap">
  <div class="card auth-card">
    <div class="card-header">
      <h5 class="auth-title">{{ __('Confirm Password') }}</h5>
      <div class="auth-subtitle">
        {{ __('Silakan konfirmasi password Anda sebelum melanjutkan.') }}
      </div>
    </div>

    <div class="card-body p-4 p-md-5">
      <form method="POST" action="{{ route('password.confirm') }}" novalidate>
        @csrf

        {{-- Password --}}
        <div class="form-floating mb-4">
          <input id="password" type="password" 
                 class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="current-password"
                 placeholder="••••••••">
          <label for="password">{{ __('Password') }}</label>
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Submit --}}
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-brand btn-lg">
            {{ __('Confirm Password') }}
          </button>
        </div>

        {{-- Forgot password link --}}
        @if (Route::has('password.request'))
          <div class="text-center">
            <a class="link-brand" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a>
          </div>
        @endif
      </form>
    </div>
  </div>
</div>
@endsection
