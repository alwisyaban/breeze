@extends('layouts.master', ['title' => 'Data Departemen'])


@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <a href="departemen/create" class="btn btn-success"><i class="fa-solid fa-plus"></i> Departemen</a>
            </div>
            <div class="card-body">
                <!-- id ke datatables -->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Departemen</th>
                            <th width=5%><i class="fa-solid fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departemens as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->departemen }}</td>
                                <td><a href="departemen/{{ $item->id_departemen }}/edit" class="btn btn-primary btn-sm"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="/departemen/{{ $item->id_departemen }}" method="post" class="d-inline">
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
