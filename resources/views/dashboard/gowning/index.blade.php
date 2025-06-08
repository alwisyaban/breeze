@extends('layouts.master', ['title' => 'Data Gowning'])

@section('content')
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-dark mb-4">
                    <div class="card-body">
                        <strong>
                            Rekualifikasi Teori Di {{ $startMonth }} - {{ $endMonth }} = <br> {{ $teori }}
                            Personel
                        </strong>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('teori') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-dark mb-4">
                    <div class="card-body"><strong>Rekualfikasi Steril Di
                            {{ $startMonth }} - {{ $endMonth }} = <br>
                            {{ $steril }} Perosonel</strong></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('steril') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-dark mb-4">
                    <div class="card-body"><strong>Rekualfikasi Aseptis Di
                            {{ $startMonth }} - {{ $endMonth }} = <br>
                            {{ $aseptis }} Perosonel</strong></div>
                    <div class="card-footer
                            d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('aseptis') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        {{ $hari }}
                    </div>
                    <div class="card-body">
                        {{-- <h1>{{ $minus }}</h1>
                        <div>
                            <div class="mb-3">
                                <label for="waktu_selesai" class="form-label">Waktu Selesai:</label>
                                <input type="datetime-local" id="waktu_selesai" name="waktu_selesai" class="form-control"
                                    required>
                            </div>
                        </div> --}}
                        <canvas id="myAreaChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Employee Number</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Rekualifikasi Teori</th>
                            <th>Hasil</th>
                            <th>Rekualifikasi Gowning </th>
                            <th>Hasil</th>
                            <th>Rekualifikasi Gowning Aseptis</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
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
                                <td>
                                    {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'rekualifikasi'))->hasil ?? 'NOT QUALIFIED' }}
                                </td>
                                <td>
                                    {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->tanggal_rekualifikasi ?? 'NA' }}
                                </td>
                                <td>
                                    {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->hasil ?? 'NOT QUALIFIED' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data yang sesuai filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
