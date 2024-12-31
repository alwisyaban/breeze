@extends('layouts.master', ['title' => 'Data Departemen'])

@section('content')
    <div class="card">
        <h5 class="card-header">Edit Data Departemen : <b>{{ $departemens->departemen }}</b></h5>
        <div class="card-body">
            <form action="/departemen/{{ $departemens->id_departemen }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="departemen">Nama Departemen</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('departemen') is-invalid @enderror" id="departemen"
                        name="departemen" value="{{ old('departemen') ?? $departemens->departemen }}">
                    <span class="text-danger">{{ $errors->first('departemen') }}</span>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            </form>
        </div>
    </div>
@endsection
