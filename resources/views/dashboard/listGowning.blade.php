@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                {{-- Filter Checkbox List --}}
                <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <label class="form-label">Filter Departemen</label>
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach ($departments as $department)
                                        <div class="form-check">
                                            <input type="checkbox" name="departemen[]" id="departemen_{{ $department }}"
                                                value="{{ $department }}" class="form-check-input"
                                                {{ in_array($department, $selectedDepartments) ? 'checked' : '' }}>
                                            <label for="departemen_{{ $department }}" class="form-check-label">
                                                {{ $department }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Terapkan Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">

                </div>
            </div>
        </div>


        {{-- Tabel Data --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light text-center">
                            <tr>
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
                                    <td>{{ $karyawan->nik }}</td>
                                    <td>{{ $karyawan->name }}</td>
                                    <td>{{ $karyawan->departemen }}</td>
                                    <td>{{ $karyawan->kualifikasiTeori->tanggal_rekualifikasi ?? 'NOT QUALIFIED' }}</td>
                                    <td>{{ $karyawan->kualifikasiTeori->hasil ?? 'NOT QUALIFIED' }}</td>
                                    <td>
                                        {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'rekualifikasi'))->tanggal_rekualifikasi ?? 'NOT QUALIFIED' }}
                                    </td>
                                    <td>
                                        {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'rekualifikasi'))->hasil ?? 'NOT QUALIFIED' }}
                                    </td>
                                    <td>
                                        {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->tanggal_rekualifikasi ??
                                            'NOT QUALIFIED' }}
                                    </td>
                                    <td>
                                        {{ optional($karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis'))->hasil == 'Lulus'
                                            ? $karyawan->kualifikasiGowning->firstWhere('jenis_kualifikasi', 'aseptis')->hasil
                                            : 'NOT QUALIFIED' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data yang sesuai filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
