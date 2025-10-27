@extends('layouts.app')

@section('title', 'Daftar User & Admin')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-11">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">👥 Daftar Pengguna Sistem</h4>
        <a href="{{ route('user.create') }}" class="btn btn-brand shadow-sm">
          ➕ Tambah User
        </a>
      </div>

      {{-- Filter --}}
      <form method="GET" class="row g-2 mb-4 align-items-end">
        <div class="col-md-3">
          <label for="q" class="form-label">Cari Nama / Email</label>
          <input type="text" class="form-control" id="q" name="q" value="{{ request('q') }}" placeholder="Cari...">
        </div>
        <div class="col-md-2">
          <label for="role" class="form-label">Role</label>
          <select name="role" id="role" class="form-select">
            <option value="">Semua</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="is_active" class="form-label">Status</label>
          <select name="is_active" id="is_active" class="form-select">
            <option value="">Semua</option>
            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="departemen" class="form-label">Departemen</label>
          <input type="text" name="departemen" id="departemen" class="form-control" placeholder="Opsional" value="{{ request('departemen') }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
          <button type="submit" class="btn btn-brand flex-fill">Filter</button>
          <a href="{{ url('user') }}" class="btn btn-secondary flex-fill">Reset</a>
        </div>
      </form>

      {{-- Table --}}
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table-users" class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Departemen</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                  <tr>
                    <td class="fw-semibold">
                      <img src="{{ $user->avatar_url }}" alt="avatar" class="rounded-circle me-2" width="32" height="32">
                      {{ $user->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->departemen ?? '—' }}</td>
                    <td>
                      <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                        {{ ucfirst($user->role) }}
                      </span>
                    </td>
                    <td>
                      @if($user->is_active)
                        <span class="badge bg-success">Aktif</span>
                      @else
                        <span class="badge bg-danger">Nonaktif</span>
                      @endif
                    </td>

                    {{-- Aksi Dropdown --}}
                    <td class="text-center">
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="aksiDropdown{{ $user->id }}" data-bs-toggle="dropdown"
                                aria-expanded="false">
                          ⋮
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aksiDropdown{{ $user->id }}">
                          <li>
                            <a href="#" class="dropdown-item text-primary">
                              👁️ View Detail
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('user.edit', $user->id) }}" class="dropdown-item text-warning">
                              ✏️ Edit
                            </a>
                          </li>
                          <li>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="m-0">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="dropdown-item text-danger"
                                      onclick="return confirm('Yakin ingin menghapus user ini?')">
                                🗑️ Hapus
                              </button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted py-3">
                      <i class="bi bi-person-x fs-4 d-block mb-2"></i>
                      Belum ada data pengguna
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(function () {
    $('#table-users').DataTable({
      responsive: true,
      autoWidth: false,
      order: [[0, 'asc']],
      columnDefs: [
        { targets: [2,3,4,5], orderable: false }
      ],
      language: {
        search: "🔍 Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_–_END_ dari _TOTAL_ pengguna",
        infoEmpty: "Tidak ada data",
        zeroRecords: "Tidak ditemukan",
        paginate: { previous: "←", next: "→" }
      }
    });
  });
</script>
@endpush
