@extends('layouts.master', ['title' => 'Data Departemen'])

@section('content')
    <div class="card">
        <h5 class="card-header">Edit Data Wadah : <b>{{ $wadahs['wadah'] }}</b></h5>
        <div class="card-body">
            <form action="/wadah/{{ $wadahs['id'] }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="wadah">Nama wadah</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('wadah') is-invalid @enderror" id="wadah"
                        name="wadah" value="{{ old('wadah') ?? $wadahs['wadah'] }}">
                    <span class="text-danger">{{ $errors->first('wadah') }}</span>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            </form>
        </div>
    </div>
@endsection
