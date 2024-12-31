@extends('layouts.master', ['title' => 'Kualifikasi Teori'])

@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-body">
                <!-- id ke datatables -->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Initial</th>
                            <th>Departemen</th>
                            <th>Tanggal Kualifikasi</th>
                            <th>Nilai</th>
                            <th>Hasil</th>
                            <th>Tanggal Rekualifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kualifikasiGowning as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->karyawan->nik }}</td>
                                <td>{{ $item->karyawan->name }}</td>
                                <td>{{ $item->karyawan->initial }}</td>
                                <td>{{ $item->karyawan->departemen }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal_kualifikasi)->format('d M Y') }}</td>
                                <td>{{ $item->nilai }}</td>
                                <td>{{ $item->hasil }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal_rekualifikasi)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
