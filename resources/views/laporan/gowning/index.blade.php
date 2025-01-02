@extends('layouts.master', ['title' => 'Report'])
@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Laporan Gowning</h3>

        <!-- Form Filter -->
        <div class="row">
            <div class="col-md-4">
                <form method="GET" action="{{ route('laporan-gowning.index') }}" class="mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <label class="form-label">Filter Departemen</label>
                            <div class="d-flex align-items-center">
                                <div class="dropdown me-3"> <!-- Tambahkan margin kanan untuk memberi jarak -->
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Departemen
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($departments as $department)
                                            <li>
                                                <div class="form-check m-3">
                                                    <input type="checkbox" name="departemen[]"
                                                        id="departemen_{{ $department }}" value="{{ $department }}"
                                                        class="form-check-input"
                                                        {{ in_array($department, $selectedDepartments) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="departemen_{{ $department }}">
                                                        {{ $department }}
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
                            <option value="LINE 09" {{ request('line') == 'LINE 08' ? 'selected' : '' }}>LINE 08</option>
                            <option value="CHEPALOSPORINE" {{ request('line') == 'CHEPALOSPORINE' ? 'selected' : '' }}>
                                CHEPALOSPORINE</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Download PDF</button>
                    <a href="{{ route('karyawan.export') }}" class="btn btn-success ms-2">Export Excel</a>
                </form>
            </div>
        </div>

        <!-- Table Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Employee Number</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Rekualifikasi Teori</th>
                        <th>Hasil</th>
                        <th>Rekualifikasi Gowning</th>
                        <th>Hasil</th>
                        <th>Rekualifikasi Gowning Aseptis</th>
                        <th>Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $karyawan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $karyawan->nik }}</td>
                            <td>{{ $karyawan->name }}</td>
                            <td>{{ $karyawan->departemen }}</td>
                            <td>
                                {{ $karyawan->kualifikasiTeori->tanggal_rekualifikasi
                                    ? \Carbon\Carbon::parse($karyawan->kualifikasiTeori->tanggal_rekualifikasi)->format('d M Y')
                                    : 'NOT QUALIFIED' }}
                            </td>
                            <td>{{ $karyawan->kualifikasiTeori->hasil ?? 'NOT QUALIFIED' }}</td>
                            <td>
                                {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'rekualifikasi'))->tanggal_rekualifikasi
                                    ? \Carbon\Carbon::parse(
                                        optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'rekualifikasi'))->tanggal_rekualifikasi,
                                    )->format('d M Y')
                                    : 'NOT QUALIFIED' }}
                            </td>
                            <td>{{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'rekualifikasi'))->hasil ?? 'NOT QUALIFIED' }}
                            </td>
                            <td>
                                {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->tanggal_rekualifikasi
                                    ? \Carbon\Carbon::parse(
                                        optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->tanggal_rekualifikasi,
                                    )->format('d M Y')
                                    : 'NOT QUALIFIED' }}
                            </td>
                            <td>{{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->hasil ?? 'NOT QUALIFIED' }}
                            </td>
                        </tr>
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
