<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google" content="notranslate">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin') | Presensi</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Bootstrap & DataTables -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">

  <!-- Presensi CSS (public) -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
    <!-- Auth mix CSS(resources)-->
  <link rel="stylesheet" href="{{ mix('css/app.css')}}">
</head>
<body>
  <div id="app" class="d-flex">
    
    {{-- Sidebar --}}
    @include('admin.sidebar')

    {{-- Main Content --}}
    <div class="main flex-grow-1 d-flex flex-column">

        {{-- Navbar di dalam main --}}
        @include('admin.navbar')

        {{-- Page Content --}}
        <main class="flex-grow-1 p-4">
            <div class="container-fluid py-4 mt-5">
                @yield('content')
             </div>
        </main>
    </div>

  </div>

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script>
    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
      document.querySelector('.sidebar').classList.toggle('active');
    });
  </script>
  @stack('scripts')
</body>
</html>
