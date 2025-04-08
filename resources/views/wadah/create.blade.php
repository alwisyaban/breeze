@extends('layouts.master', ['title' => 'Data Wadah'])

@section('content')
    <div class="card">
        <h5 class="card-header">Tambah Data Wadah</h5>
        <div class="card-body">
            <form action="/wadah" method="POST">
                @csrf

                <div class="form-group mt-1 mb-3">
                    <label for="wadah">Wadah</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('wadah') is-invalid @enderror" id="wadah"
                        name="wadah" value="{{ old('wadah') }}">
                    <span class="text-danger">{{ $errors->first('wadah') }}</span>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            </form>
        </div>
    </div>
@endsection
