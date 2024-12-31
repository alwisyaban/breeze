@extends('layouts.master', ['title' => 'Create Report'])


@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col">
                {{-- Filter Departemen Dropdown (Hamburger Style) --}}
                <form method="GET" action="{{ route('laporan-gowning.index') }}" class="mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <label class="form-label">Filter Departemen</label>
                            <div class="d-flex align-items-center">
                                <div class="dropdown me-3"> <!-- Tambahkan margin kanan untuk memberi jarak -->
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Pilih Departemen
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($departments as $department)
                                            <li>
                                                <div class="form-check m-3">
                                                    <input type="checkbox" name="departemen[]"
                                                        id="departemen_{{ $department }}" value="{{ $department }}"
                                                        class="form-check-input"
                                                        {{ in_array($department, $selectedDepartments) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="departemen_{{ $department }}">
                                                        {{ $department }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
