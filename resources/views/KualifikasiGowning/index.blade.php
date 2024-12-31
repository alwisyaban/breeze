@extends('layouts.master', ['title' => 'Kualifikasi Gowning'])


@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <h2>Data Kualifikasi Gowning</h2>
                {{-- @if (auth()->user()->name == 'QC' || auth()->user()->name == 'admin')
                @endif --}}
                <a href="{{ route('kualifikasiGowning.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i>
                    Kualifikasi Gowning</a>
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
                            <th>Type</th>
                            <th>Tanggal Kualifikasi</th>
                            <th>Hasil</th>
                            <th>Tanggal Rekualifikasi</th>
                            <th width=5%><i class="fa-solid fa-gear"></i></th>
                            <th>Dahi</th>
                            <th>Muka_Ka</th>
                            <th>Muka_Ki</th>
                            <th>Dada_Ka</th>
                            <th>Dada_Ki</th>
                            <th>Lengan_Ka</th>
                            <th>Lengan_Ki</th>
                            <th>Finger_Ka</th>
                            <th>Finger_Ki</th>

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
                                <td>{{ $item->jenis_kualifikasi }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal_kualifikasi)->format('d M Y') }}</td>
                                <td>{{ $item->hasil }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal_rekualifikasi)->format('d M Y') }}</td>
                                <td>
                                    {{-- @if (auth()->user()->name == 'admin' || auth()->user()->name == 'QC')
                                    @endif --}}
                                    <a href="{{ route('kualifikasiGowning.edit', $item->id_kualifikasiGowning) }}"
                                        class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('kualifikasiGowning.destroy', $item->id_kualifikasiGowning) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm ml-2"
                                            onclick="return confirm('Ingin Menghapus Data ?')"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                                <td>{{ $item->dahi }}</td>
                                <td>{{ $item->muka_ka }}</td>
                                <td>{{ $item->muka_ki }}</td>
                                <td>{{ $item->dada_ka }}</td>
                                <td>{{ $item->dada_ki }}</td>
                                <td>{{ $item->lengan_ka }}</td>
                                <td>{{ $item->lengan_ki }}</td>
                                <td>{{ $item->finger_ka }}</td>
                                <td>{{ $item->finger_ki }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
