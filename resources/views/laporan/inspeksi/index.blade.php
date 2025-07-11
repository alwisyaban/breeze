@extends('layouts.master', ['title' => 'Report'])
@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Laporan Inspeksi</h3>

        <!-- Form Filter -->
        <div class="row">
            <div class="col-md-4">
                <form method="GET" action="{{ route('inspeksi-laporan.index') }}" class="mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <label class="form-label">Filter Sediaan</label>
                            <div class="d-flex align-items-center">
                                <div class="dropdown me-3"> <!-- Tambahkan margin kanan untuk memberi jarak -->
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Bentuk Sediaan
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($wadahs as $item)
                                            <li>
                                                <div class="form-check m-3">
                                                    <input type="checkbox" name="wadah[]" id="wadah_{{ $item['wadah'] }}"
                                                        value="{{ $item['wadah'] }}" class="form-check-input"
                                                        {{ in_array($item['wadah'], $selectedWadah) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="wadah_{{ $item['wadah'] }}">
                                                        {{ $item['wadah'] }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>

                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form method="GET" action="{{ route('laporan-gowning.generatePDF') }}" target="_blank">
                    @if (request('departemen'))
                        @foreach (request('departemen') as $item)
                            <input type="hidden" name="departemen[]" value="{{ $item }}">
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <select class="form-select" id="line" name="line">
                            <option value="">Pilih Line :</option>
                            <option value="LINE 02" {{ request('line') == 'LINE 02' ? 'selected' : '' }}>LINE 02</option>
                            <option value="LINE 07" {{ request('line') == 'LINE 07' ? 'selected' : '' }}>LINE 07</option>
                            <option value="LINE 08" {{ request('line') == 'LINE 08' ? 'selected' : '' }}>LINE 08</option>
                            <option value="LINE 05" {{ request('LINE') == 'LINE 05' ? 'selected' : '' }}>LINE 05</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Download PDF</button>
                    <a href="{{ route('karyawan.export') }}" class="btn btn-success ms-2"><i
                            class="fa-solid fa-download"></i>
                        Unduh Excel</a>
                </form>
            </div>
        </div>

        <!-- Table Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Employee Number</th>
                        <th>Name</th>
                        <th>Initial</th>
                        <th>Department</th>
                        <th>Tanggal Rekualifikasi</th>
                        <th>Sediaan</th>
                        <th>Wadah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $karyawan)
                        @foreach ($karyawan->KualifikasiInspeksi as $inspeksi)
                            <tr>
                                <td>{{ $loop->parent->iteration }}</td>
                                <td>{{ $karyawan->nik }}</td>
                                <td>{{ $karyawan->name }}</td>
                                <td>{{ $karyawan->initial }}</td>
                                <td>{{ $karyawan->departemen }}</td>
                                <td>
                                    {{ $inspeksi->tanggal_rekualifikasi ? \Carbon\Carbon::parse($inspeksi->tanggal_rekualifikasi)->format('d M Y') : '' }}
                                </td>
                                <td>{{ $inspeksi->jenis_sediaan ?? '' }}</td>
                                <td>{{ $inspeksi->bentuk_sediaan ?? '' }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data untuk ditampilkan.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
