@extends('layouts.master', ['title' => 'Jenis Sediaan'])

@section('content')
    <div class="card">
        <h5 class="card-header">Tambah Data</h5>
        <div class="card-body">
            <form action="{{ route('sediaan.store') }}" method="POST">
                @csrf

                <div class="form-group mt-1 mb-3">
                    <label for="name">Jenis Sediaan</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            </form>
        </div>
    </div>
@endsection
