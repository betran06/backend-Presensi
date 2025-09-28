<nav class="sidebar">
  <div class="sidebar-header p-3 text-center border-bottom">
    <a href="{{ url('/') }}" class="navbar-brand fw-bold text-brand">
      {{ config('app.name', 'Presensi') }}
    </a>
  </div>

  <ul class="nav flex-column px-2 py-3 flex-grow-1">
    <li class="nav-item">
      <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="#">
        🏠 Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('presensi*') ? 'active' : '' }}" href="#">
        ⏱️ Presensi
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('presensi.rekap') ? 'active' : '' }}" href="{{ route('presensi.rekap')}}">
        📊 Rekap Presensi
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}" href="{{ route('user.index') }}"
>
        👥 Daftar User
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('user.create') ? 'active' : '' }}" href="{{ route('user.create') }}"
>
        ➕ Tambah User
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('shift*') ? 'active' : '' }}" href="#">
        📅 Shift & Jadwal
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}" href="#">
        📑 Laporan
      </a>
    </li>
  </ul>

  <div class="sidebar-footer border-top p-3">
    <a class="nav-link {{ request()->is('settings*') ? 'active' : '' }}" href="#">
      ⚙️ Pengaturan
    </a>
  </div>
</nav>
