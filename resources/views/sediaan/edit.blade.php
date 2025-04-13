@extends('layouts.master', ['title' => 'Data Sediaan'])

@section('content')
    <div class="card">
        <h5 class="card-header">Edit Data Sediaan : <b>{{ $sediaan['sediaan'] }}</b></h5>
        <div class="card-body">
            <form action="/sediaan/{{ $sediaan['id'] }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="sediaan">Nama Sediaan</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('sediaan') is-invalid @enderror" id="sediaan"
                        name="sediaan" value="{{ old('sediaan') ?? $sediaan['sediaan'] }}">
                    <span class="text-danger">{{ $errors->first('sediaan') }}</span>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            </form>
        </div>
    </div>
@endsection
