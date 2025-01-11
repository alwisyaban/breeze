@extends('layouts.master', ['title' => 'Report Kualifikasi Teori'])

@section('content')
    <form method="GET" action="/export/kualifikasi-teori" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control" placeholder="Tanggal Mulai" required>
            </div>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control" placeholder="Tanggal Selesai" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success">Export ke Excel</button>
            </div>
        </div>
    </form>
@endsection
