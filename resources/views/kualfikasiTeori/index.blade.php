@extends('layouts.master', ['title' => 'Kualifikasi Teori'])

@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <h2>Data Kualifikasi Teori</h2>
                @if (Auth::user()->name == 'admin' || Auth::user()->name == 'HCO')
                    <a href="{{ route('kualifikasiTerori.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i>
                        Kualifikasi Teori</a>
                @endif
                <div class="">
                    <form method="GET" action="{{ route('kualifikasiTeori.export') }}" class="mb-3 mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="date" name="start_date" class="form-control" placeholder="Tanggal Mulai"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="end_date" class="form-control" placeholder="Tanggal Selesai"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-download"></i>
                                    Unduh Excel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <!-- id ke datatables -->
                <table id="datatablesSimple" class="text-center">
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
                            <th width=5%><i class="fa-solid fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kualifikasiTeori as $item)
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
                                <td>
                                    @if (Auth::user()->name == 'admin' || Auth::user()->name == 'HCO')
                                        <a href="{{ route('kualifikasiTerori.edit', $item->id_kualifikasiTeori) }}"
                                            class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('kualifikasiTerori.destroy', $item->id_kualifikasiTeori) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm ml-2"
                                                onclick="return confirm('Ingin Menghapus Data ?')"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
