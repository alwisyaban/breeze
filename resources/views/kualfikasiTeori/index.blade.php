@extends('layouts.master', ['title' => 'Kualifikasi Teori'])

@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <h2>Data Kualifikasi Teori</h2>
                {{-- @if (auth()->user()->name == 'admin' || auth()->user()->name == 'HCO')
                @endif --}}
                <a href="{{ route('kualifikasiTerori.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i>
                    Kualifikasi Teori</a>

            </div>
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
                                    {{-- @if (auth()->user()->name == 'admin' || auth()->user()->name == 'HCO')
                                    @endif --}}
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
