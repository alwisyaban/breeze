@extends('layouts.master', ['title' => 'Kualifikasi Kejernihan'])

@section('content')
    <div class="container">
        <form action="{{ route('inspeksi.update', $inspeksi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mt-3">
                <label for="nik">NIK Karyawan</label>
                <input type="text" name="nik" id="nik" class="form-control" value="{{ $inspeksi->nik }}" readonly>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_kualifikasi">Tanggal Kualifikasi</label>
                <input type="date" name="tanggal_kualifikasi" id="tanggal_kualifikasi" class="form-control"
                    value="{{ $inspeksi->tanggal_kualifikasi }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="bentuk_sediaan">Bentuk Sediaan</label>
                <select name="bentuk_sediaan" id="bentuk_sediaan" class="form-control" required>
                    <option value="{{ old('bentuk_sediaan') ?? $inspeksi->bentuk_sediaan }}">
                        {{ old('bentuk_sediaan') ?? $inspeksi->bentuk_sediaan }}</option>
                    @foreach ($wadahs as $key => $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="nilai">Jenis Sediaan</label>
                <select name="jenis_sediaan" id="jenis_sediaan" class="form-control" required>
                    <option value="{{ old('jenis_sediaan') ?? $inspeksi->jenis_sediaan }}">
                        {{ old('jenis_sediaan') ?? $inspeksi->jenis_sediaan }}</option>
                    @foreach ($sediaans as $key => $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="nilai">Nilai</label>
                <input type="number" name="nilai" id="nilai" class="form-control" value="{{ $inspeksi->nilai }}"
                    required>
            </div>
            <div class="form-group mt-3">
                <label for="hasil">Hasil</label>
                <select name="hasil" id="hasil" class="form-control" required>
                    <option value="QUALIFIED" {{ $inspeksi->hasil == 'QUALIFIED' ? 'selected' : '' }}>QUALIFIED
                    </option>
                    <option value="NOT QUALIFIED" {{ $inspeksi->hasil == 'NOT QUALIFIED' ? 'selected' : '' }}>NOT
                        QUALIFIED
                    </option>
                </select>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_rekualifikasi">Tanggal Rekualifikasi (Opsional)</label>
                <input type="date" name="tanggal_rekualifikasi" id="tanggal_rekualifikasi" class="form-control"
                    value="{{ $inspeksi->tanggal_rekualifikasi }}">
            </div>
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            <a href="{{ route('inspeksi.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
