@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-11">
      <h4 class="mb-3">👥 Daftar User</h4>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table-users" class="table table-striped table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Departemen</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->departemen ?? '—' }}</td>
                    <td class="text-center">
                      <a href="{{ route('user.edit', $item->id) }}" 
                         class="btn btn-sm btn-warning me-1">
                        ✏️ Edit
                      </a>
                      <form action="{{ route('user.destroy', $item->id) }}" 
                            method="POST" 
                            class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                          🗑️ Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
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
  $(document).ready(function () {
    $('#table-users').DataTable({
      responsive: true,
      autoWidth: false,
      columnDefs: [
        { targets: [2,3], orderable: false } // kolom departemen & aksi tidak bisa di-sort
      ],
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        paginate: { previous: "Sebelumnya", next: "Berikutnya" }
      }
    });
  });
</script>
@endpush
