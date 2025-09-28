@extends('layouts.auth')
@section('title', 'Verify Email')

@section('content')
<div class="auth-wrap">
  <div class="card auth-card">
    <div class="card-header">
      <h5 class="auth-title">{{ __('Verify Your Email Address') }}</h5>
      <div class="auth-subtitle">
        {{ __('Kami telah mengirimkan link verifikasi ke email Anda.') }}
      </div>
    </div>

    <div class="card-body p-4 p-md-5">

      {{-- Pesan sukses jika link baru terkirim --}}
      @if (session('resent'))
        <div class="alert alert-success mb-4" role="alert">
          {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
        </div>
      @endif

      <p class="mb-4">
        {{ __('Sebelum melanjutkan, silakan cek email Anda untuk link verifikasi.') }}
        {{ __('Jika tidak menerima email, klik tombol di bawah untuk kirim ulang.') }}
      </p>

      {{-- Form resend verification --}}
      <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-brand btn-lg">
            {{ __('Kirim Ulang Email Verifikasi') }}
          </button>
        </div>
      </form>

      {{-- Link ke logout --}}
      <div class="text-center">
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="link-brand">
          {{ __('Keluar') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
