@extends('layouts.master', ['title' => 'Data Karyawan'])

@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <h2>Data Karyawan</h2>
                @if (Auth::user()->name == 'admin' || Auth::user()->name == 'HCO')
                    <a href="karyawan/create" class="btn btn-success"><i class="fa-solid fa-plus"></i> Karyawan</a>
                @endif
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
                            <th width=5%><i class="fa-solid fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['nik'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['initial'] }}</td>
                                <td>{{ $item['departemen'] }}</td>
                                <td><a href="karyawan/{{ $item['id_karyawan'] }}/edit" class="btn btn-primary btn-sm"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="/karyawan/{{ $item['id_karyawan'] }}" method="post" class="d-inline">
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
