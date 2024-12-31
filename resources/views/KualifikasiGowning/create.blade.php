@extends('layouts.master', ['title' => 'Kualifikasi Gowning'])

@section('content')
    <div class="container">
        <form action="{{ route('kualifikasiGowning.store') }}" method="POST">
            @csrf
            <div class="form-group mt-3 w-50">
                <label for="nik">Pilih Karyawan</label>
                <select name="nik" id="nik" class="form-control select2" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($karyawans as $item)
                        <option value="{{ $item->nik }}">{{ $item->nik }} - {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3 w-50">
                <label for="jenis_kualifikasi">Jenis Kualifikasi</label>
                <select name="jenis_kualifikasi" id="jenis_kualifikasi"
                    class="form-control @error('jenis_kualifikasi') is-invalid @enderror" required>
                    <option value="">-- Pilih Type --</option>
                    <option value="initial-1">initial-1</option>
                    <option value="initial-2">initial-2</option>
                    <option value="rekualifikasi">rekualifikasi</option>
                    <option value="aseptis">aseptis</option>
                </select>
                <span class="text-danger">{{ $errors->first('jenis_kualifikasi') }}</span>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_kualifikasi">Tanggal Kualifikasi</label>
                <input type="date" name="tanggal_kualifikasi" id="tanggal_kualifikasi" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="dahi">Dahi</label>
                <input type="number" name="dahi" id="dahi" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="muka_ka">Muka Kanan</label>
                <input type="number" name="muka_ka" id="muka_ka" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="muka_ki">Muka Kiri</label>
                <input type="number" name="muka_ki" id="muka_ki" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="dada_ka">Dada Kanan</label>
                <input type="number" name="dada_ka" id="dada_ka" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="dada_ki">Dada Kiri</label>
                <input type="number" name="dada_ki" id="dada_ki" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="lengan_ka">Lengan Kanan</label>
                <input type="number" name="lengan_ka" id="lengan_ka" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="lengan_ki">Lengan Kiri</label>
                <input type="number" name="lengan_ki" id="lengan_ki" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="finger_ka">Finger Kanan</label>
                <input type="number" name="finger_ka" id="finger_ka" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="finger_ki">Finger Kiri</label>
                <input type="number" name="finger_ki" id="finger_ki" class="form-control" required>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="hasil">Hasil</label>
                <select name="hasil" id="hasil" class="form-control" required>
                    <option value="">-- Pilih Hasil --</option>
                    <option value="QUALIFIED">QUALIFIED</option>
                    <option value="NOT QUALIFIED">NOT QUALIFIED</option>
                </select>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_rekualifikasi">Tanggal Rekualifikasi (Opsional)</label>
                <input type="date" name="tanggal_rekualifikasi" id="tanggal_rekualifikasi" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('kualifikasiGowning.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
