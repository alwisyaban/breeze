<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Departemen;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = karyawan::orderBy('departemen')
            ->orderBy('name', 'asc')
            ->get();
        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departemens = Departemen::all()->pluck('departemen');
        return view('karyawan.create', compact('departemens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nik' => 'required|unique:karyawans,nik',
            'name' => 'required',
            'initial' => 'required',
            'departemen' => 'required'
        ]);

        $karyawans = new karyawan();
        $karyawans->fill($requestData);
        $karyawans->save();

        return redirect()->route('karyawan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $karyawans = karyawan::find($id);
        $departemens = Departemen::all()->pluck('departemen');
        return view('karyawan.edit', compact('karyawans', 'departemens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'initial' => 'required',
            'departemen' => 'required'
        ]);

        $karyawans = karyawan::find($id);
        $karyawans->fill($requestData);
        $karyawans->save();
        session()->flash('success', 'Data berhasil diubah!');

        return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karyawans = karyawan::findOrFail($id);
        $karyawans->KualifikasiTeori()->delete();
        $karyawans->kualifikasiGowning()->delete();
        $karyawans->delete();
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }

    public function export()
    {
        return Excel::download(new LaporanExport, 'karyawan.xlsx');
    }
}
