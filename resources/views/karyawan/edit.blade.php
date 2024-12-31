@extends('layouts.master', ['title' => 'Data Karyawan'])

@section('content')
    <div class="card">
        <h5 class="card-header">Edit Data karyawan : <b>{{ $karyawans->name }}</b></h5>
        <div class="card-body">
            <form action="/karyawan/{{ $karyawans->id_karyawan }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group mt-1 mb-3">
                    <label for="nik">NIK</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                        name="nik" value="{{ old('nik') ?? $karyawans->nik }}">
                    <span class="text-danger">{{ $errors->first('nik') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="name">Nama</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') ?? $karyawans->name }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="initial">initial</label>
                    <!-- pada input terdapat validasi ketika salah maka data tidak hilang -->
                    <input type="text" class="form-control @error('initial') is-invalid @enderror" id="initial"
                        name="initial" value="{{ old('initial') ?? $karyawans->initial }}">
                    <span class="text-danger">{{ $errors->first('initial') }}</span>
                </div>
                <div class="form-group mt-1 mb-3">
                    <label for="departemen">Departemen</label>
                    <div class="col-lg-4">
                        <select name="departemen" id="departemen" class="form-control" required>
                            <option value="{{ old('initial') ?? $karyawans->departemen }}">
                                {{ old('initial') ?? $karyawans->departemen }}</option>
                            @foreach ($departemens as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            </form>
        </div>
    </div>
@endsection
