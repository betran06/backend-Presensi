@extends('layouts.app')

@section('title', 'Rekap Presensi')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">📊 Rekap Presensi</h4>
      </div>

      {{-- Filter Form --}}
      <form method="GET" class="row g-2 mb-3 align-items-end">
        <div class="col-md-3">
          <label for="tanggal" class="form-label">Tanggal</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
        </div>

        <div class="col-md-3">
          <label for="bulan" class="form-label">Bulan</label>
          <input type="month" name="bulan" id="bulan" class="form-control" value="{{ request('bulan') }}">
        </div>

        <div class="col-md-2">
          <button class="btn btn-brand w-100" type="submit">Filter</button>
        </div>
        <div class="col-md-2">
          <a href="{{ route('presensi.rekap') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
      </form>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table-rekap" class="table table-hover align-middle w-100">
              <thead class="table-light">
                <tr>
                  @if(auth()->user()->role === 'admin')
                    <th>Nama</th>
                  @endif
                  <th>Tanggal</th>
                  <th>Masuk</th>
                  <th>Pulang</th>
                  <th>Lokasi</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($presensis as $p)
                  <tr>
                    @if(auth()->user()->role === 'admin')
                      <td>{{ $p->user->name ?? '-' }}</td>
                    @endif

                    {{-- Tanggal --}}
                    <td class="text-nowrap">{{ $p->tanggal_formatted ?? $p->tanggal }}</td>

                    {{-- Jam Masuk / Pulang --}}
                    <td class="text-nowrap">
                      {{ $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i') : '—' }}
                    </td>
                    <td class="text-nowrap">
                      {{ $p->jam_pulang ? \Carbon\Carbon::parse($p->jam_pulang)->format('H:i') : '—' }}
                    </td>

                    {{-- Lokasi --}}
                    <td>
                      <div class="small text-muted">
                        <div>
                          <span class="fw-semibold">Masuk:</span>
                          @if(!is_null($p->latitude_masuk) && !is_null($p->longitude_masuk))
                            {{ number_format($p->latitude_masuk, 5) }}, {{ number_format($p->longitude_masuk, 5) }}
                          @else
                            —
                          @endif
                        </div>
                        <div>
                          <span class="fw-semibold">Pulang:</span>
                          @if(!is_null($p->latitude_pulang) && !is_null($p->longitude_pulang))
                            {{ number_format($p->latitude_pulang, 5) }}, {{ number_format($p->longitude_pulang, 5) }}
                          @else
                            —
                          @endif
                        </div>
                      </div>
                    </td>

                    {{-- Status --}}
                    <td>
                      @php
                        $status = strtolower($p->status ?? 'hadir');
                        $badge = match($status) {
                          'hadir' => 'bg-success',
                          'telat' => 'bg-warning text-dark',
                          'pulang' => 'bg-secondary',
                          'alpa' => 'bg-danger',
                          'izin', 'cuti' => 'bg-info text-dark',
                          'dinas' => 'bg-purple text-light',
                          'lembur' => 'bg-warning text-dark',
                          default => 'bg-light text-dark'
                        };
                      @endphp
                      <span class="badge {{ $badge }} px-3 py-2 text-capitalize">{{ $status }}</span>
                      @if(!empty($p->keterangan))
                        <div class="small text-muted mt-1">{{ $p->keterangan }}</div>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted py-3">Belum ada data presensi</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Legenda --}}
          <div class="mt-3 small text-muted">
            <span class="badge bg-success me-1">&nbsp;</span>Hadir
            <span class="badge bg-warning text-dark ms-3 me-1">&nbsp;</span>Telat
            <span class="badge bg-secondary ms-3 me-1">&nbsp;</span>Pulang
            <span class="badge bg-danger ms-3 me-1">&nbsp;</span>Alpa
            <span class="badge bg-info text-dark ms-3 me-1">&nbsp;</span>Izin / Cuti
            <span class="badge bg-purple text-light ms-3 me-1">&nbsp;</span>Dinas
            <span class="badge bg-warning text-dark ms-3 me-1">&nbsp;</span>Lembur
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
    $('#table-rekap').DataTable({
      responsive: true,
      autoWidth: false,
      order: [[ {{ auth()->user()->role === 'admin' ? 1 : 0 }}, 'desc' ]],
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_–_END_ dari _TOTAL_ entri",
        infoEmpty: "Tidak ada data",
        zeroRecords: "Data tidak ditemukan",
        paginate: { previous: "Sebelumnya", next: "Berikutnya" }
      },
      columnDefs: [
        { targets: [ {{ auth()->user()->role === 'admin' ? 4 : 3 }}, {{ auth()->user()->role === 'admin' ? 5 : 4 }} ], orderable: false },
      ]
    });
  });
</script>
@endpush
