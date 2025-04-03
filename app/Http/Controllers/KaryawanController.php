<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Departemen;
use App\Models\karyawan;
use App\Services\KaryawanService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{

    private KaryawanService $karyawanService;

    public function __construct(KaryawanService $karyawanService)
    {
        $this->karyawanService = $karyawanService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = $this->karyawanService->getKaryawan();
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
        $request->validate([
            'nik' => 'required|unique:karyawans,nik',
            'name' => 'required',
            'initial' => 'required',
            'departemen' => 'required'
        ]);

        $this->karyawanService->saveKaryawan($request->all());
        session()->flash('success', 'Data berhasil ditambahkan!');
        return redirect()->route('karyawan.index');
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
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'initial' => 'required',
            'departemen' => 'required'
        ]);

        $this->karyawanService->updateKaryawan($id, $request->only(['nik', 'name', 'initial', 'departemen']));
        session()->flash('success', 'Data berhasil diubah!');
        return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->karyawanService->removeKaryawan($id);
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }

    public function export()
    {
        return Excel::download(new LaporanExport, 'karyawan.xlsx');
    }
}
