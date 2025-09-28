<nav class="navbar navbar-light bg-white shadow-sm px-3 fixed-top d-flex align-items-center" style="height:56px;">
  <div class="d-flex align-items-center justify-content-between w-100">

    {{-- Sidebar toggle (mobile only) --}}
    <button class="btn btn-sm btn-outline-secondary d-md-none me-2" id="sidebarToggle">
      ☰
    </button>

    {{-- User menu --}}
    <div class="dropdown ms-auto">
      <a class="nav-link dropdown-toggle fw-medium d-flex align-items-center" href="#" id="userDropdown"
         role="button" data-bs-toggle="dropdown">
        <span class="me-2">{{ Auth::user()->name ?? 'Guest' }}</span>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Guest') }}&background=8759A4&color=fff&size=32"
             alt="avatar" class="rounded-circle" width="32" height="32">
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        @auth
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        @else
          <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
