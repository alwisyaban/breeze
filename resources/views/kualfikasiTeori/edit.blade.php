@extends('layouts.master', ['title' => 'Kualifikasi Teori'])

@section('content')
    <div class="container">
        <form action="{{ route('kualifikasiTerori.update', $kualifikasiTeori->id_kualifikasiTeori) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mt-3">
                <label for="nik">NIK Karyawan</label>
                <input type="text" name="nik" id="nik" class="form-control" value="{{ $kualifikasiTeori->nik }}"
                    readonly>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_kualifikasi">Tanggal Kualifikasi</label>
                <input type="date" name="tanggal_kualifikasi" id="tanggal_kualifikasi" class="form-control"
                    value="{{ $kualifikasiTeori->tanggal_kualifikasi }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="nilai">Nilai</label>
                <input type="number" name="nilai" id="nilai" class="form-control"
                    value="{{ $kualifikasiTeori->nilai }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="hasil">Hasil</label>
                <select name="hasil" id="hasil" class="form-control" required>
                    <option value="QUALIFIED" {{ $kualifikasiTeori->hasil == 'QUALIFIED' ? 'selected' : '' }}>QUALIFIED
                    </option>
                    <option value="NOT QUALIFIED" {{ $kualifikasiTeori->hasil == 'NOT QUALIFIED' ? 'selected' : '' }}>NOT
                        QUALIFIED
                    </option>
                </select>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_rekualifikasi">Tanggal Rekualifikasi (Opsional)</label>
                <input type="date" name="tanggal_rekualifikasi" id="tanggal_rekualifikasi" class="form-control"
                    value="{{ $kualifikasiTeori->tanggal_rekualifikasi }}">
            </div>
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            <a href="{{ route('kualifikasiTerori.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
