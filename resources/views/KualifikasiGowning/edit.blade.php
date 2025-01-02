@extends('layouts.master', ['title' => 'Kualifikasi Gownig'])


@section('content')
    <div class="container">
        <form action="{{ route('kualifikasiGowning.update', $kualifikasiGowning->id_kualifikasiGowning) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mt-3">
                <label for="nik">NIK Karyawan</label>
                <input type="text" name="nik" id="nik" class="form-control" value="{{ $kualifikasiGowning->nik }}"
                    readonly>
            </div>
            <div class="form-group mt-3">
                <label for="jenis_kualifikasi">Jenis Kualifikasi</label>
                <select name="jenis_kualifikasi" id="jenis_kualifikasi" class="form-control">
                    <option value="initial-1" {{ $kualifikasiGowning->jenis_kualifikasi == 'initial-1' ? 'selected' : '' }}>
                        initial-1</option>
                    <option value="initial-2" {{ $kualifikasiGowning->jenis_kualifikasi == 'initial-2' ? 'selected' : '' }}>
                        initial-2</option>
                    <option value="rekualifikasi"
                        {{ $kualifikasiGowning->jenis_kualifikasi == 'rekualifikasi' ? 'selected' : '' }}>rekualifikasi
                    </option>
                    <option value="aseptis" {{ $kualifikasiGowning->jenis_kualifikasi == 'aseptis' ? 'selected' : '' }}>
                        aseptis</option>
                </select>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_kualifikasi">Tanggal Kualifikasi</label>
                <input type="date" name="tanggal_kualifikasi" id="tanggal_kualifikasi" class="form-control"
                    value="{{ $kualifikasiGowning->tanggal_kualifikasi }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="dahi">Dahi</label>
                <input type="number" name="dahi" id="dahi" class="form-control"
                    value="{{ $kualifikasiGowning->dahi }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="muka_ka">Muka Kanan</label>
                <input type="number" name="muka_ka" id="muka_ka" class="form-control"
                    value="{{ $kualifikasiGowning->muka_ka }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="muka_ki">Muka Kiri</label>
                <input type="number" name="muka_ki" id="muka_ki" class="form-control"
                    value="{{ $kualifikasiGowning->muka_ki }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="dada_ka">Dada Kanan</label>
                <input type="number" name="dada_ka" id="dada_ka" class="form-control"
                    value="{{ $kualifikasiGowning->dada_ka }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="dada_ki">Dada Kiri</label>
                <input type="number" name="dada_ki" id="dada_ki" class="form-control"
                    value="{{ $kualifikasiGowning->dada_ki }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="lengan_ka">Lengan Kanan</label>
                <input type="number" name="lengan_ka" id="lengan_ka" class="form-control"
                    value="{{ $kualifikasiGowning->lengan_ka }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="lengan_ki">Lengan Kiri</label>
                <input type="number" name="lengan_ki" id="lengan_ki" class="form-control"
                    value="{{ $kualifikasiGowning->lengan_ki }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="finger_ka">Finger Kanan</label>
                <input type="number" name="finger_ka" id="finger_ka" class="form-control"
                    value="{{ $kualifikasiGowning->finger_ka }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="finger_ki">Finger Kiri</label>
                <input type="number" name="finger_ki" id="finger_ki" class="form-control"
                    value="{{ $kualifikasiGowning->finger_ki }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="hasil">Hasil</label>
                <select name="hasil" id="hasil" class="form-control" required>
                    <option value="QUALIFIED" {{ $kualifikasiGowning->hasil == 'QUALIFIED' ? 'selected' : '' }}>QUALIFIED
                    </option>
                    <option value="NOT QUALIFIED" {{ $kualifikasiGowning->hasil == 'NOT QUALIFIED' ? 'selected' : '' }}>NOT
                        QUALIFIED
                    </option>
                </select>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_rekualifikasi">Tanggal Rekualifikasi (Opsional)</label>
                <input type="date" name="tanggal_rekualifikasi" id="tanggal_rekualifikasi" class="form-control"
                    value="{{ $kualifikasiGowning->tanggal_rekualifikasi }}">
            </div>
            <button type="submit" class="btn btn-primary mt-3"><i class="fa-regular fa-floppy-disk"></i> Save</button>
            <a href="{{ route('kualifikasiGowning.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
