@extends('layouts.master', ['title' => 'Data sediaan'])


@section('content')
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <a href="sediaan/create" class="btn btn-success"><i class="fa-solid fa-plus"></i> Sediaan</a>
            </div>
            <div class="card-body">
                <!-- id ke datatables -->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sediaan</th>
                            <th width=5%><i class="fa-solid fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sediaans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['sediaan'] }}</td>
                                <td><a href="sediaan/{{ $item['id'] }}/edit" class="btn btn-primary btn-sm"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="/sediaan/{{ $item['id'] }}" method="post" class="d-inline">
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
