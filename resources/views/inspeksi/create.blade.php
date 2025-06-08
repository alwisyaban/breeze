@extends('layouts.master', ['title' => 'Kualifikasi Teori'])

@section('content')
    <div class="container">
        <form action="{{ route('inspeksi.store') }}" method="POST">
            @csrf
            <div class="form-group mt-3">
                <label for="nik">Pilih Karyawan</label>
                <select name="nik" id="nik" class="form-control select2" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($karyawans as $item)
                        <option value="{{ $item->nik }}">{{ $item->nik }} - {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_kualifikasi">Tanggal Kualifikasi</label>
                <input type="date" name="tanggal_kualifikasi" id="tanggal_kualifikasi" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="nomer">ID</label>
                <input type="number" name="nomer" id="nomer" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="kualifikasi">Kualifikasi Ke-</label>
                <select name="kualifikasi" id="kualifikasi" class="form-control" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="bentuk_sediaan">Bentuk Sediaan</label>
                <select name="bentuk_sediaan" id="bentuk_sediaan" class="form-control select2" required>
                    <option value="">Pilih Sediaan</option>
                    @foreach ($wadahs as $key => $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-1 mb-3">
                <label for="jenis_sediaan">Jenis Sediaan</label>
                <div class="col-lg-4">
                    <select name="jenis_sediaan" id="jenis_sediaan" class="form-control select2" required>
                        <option value="">Pilih Sediaan</option>
                        @foreach ($sediaans as $key => $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="nilai">Nilai</label>
                <input type="number" name="nilai" id="nilai" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="salah">Salah</label>
                <input type="number" name="salah" id="salah" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="false_reject">False Reject</label>
                <input type="number" name="false_reject" id="false_reject" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label for="hasil">Hasil</label>
                <select name="hasil" id="hasil" class="form-control" required>
                    <option value="">-- Pilih Hasil --</option>
                    <option value="QUALIFIED">QUALIFIED</option>
                    <option value="NOT QUALIFIED">NOT QUALIFIED</option>
                </select>
            </div>
            <div class="form-group mt-3 w-25">
                <label for="tanggal_rekualifikasi">Tanggal Rekualifikasi</label>
                <input type="date" name="tanggal_rekualifikasi" id="tanggal_rekualifikasi" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('inspeksi.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
@endsection
