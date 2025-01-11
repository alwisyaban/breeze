<?php

namespace App\Http\Controllers;

use App\Exports\KualifikasiTeoriExport;
use App\Models\karyawan;
use App\Models\KualifikasiTeori;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KualifikasiTeoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kualifikasiTeori = KualifikasiTeori::with('karyawan')
            ->join('karyawans', 'kualifikasi_teoris.nik', '=', 'karyawans.nik')
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('kualifikasi_teoris.*') // Pilih kolom dari kualifikasi_gownings
            ->get();
        return view('kualfikasiTeori.index', compact('kualifikasiTeori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = karyawan::doesntHave('KualifikasiTeori')->get();
        return view('kualfikasiTeori.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:karyawans,nik|unique:kualifikasi_teoris,nik',
            'tanggal_kualifikasi' => 'required|date',
            'nilai' => 'required|numeric',
            'hasil' => 'required|string',
            'tanggal_rekualifikasi' => 'nullable|date',
        ]);

        KualifikasiTeori::create($request->all());

        return redirect()->route('kualifikasiTerori.index')->with('success', 'Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KualifikasiTeori $kualifikasiTeori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kualifikasiTeori = KualifikasiTeori::findOrFail($id);
        return view('kualfikasiTeori.edit', compact('kualifikasiTeori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_kualifikasi' => 'required|date',
            'nilai' => 'required|numeric',
            'hasil' => 'required|string',
            'tanggal_rekualifikasi' => 'nullable|date',
        ]);

        $kualifikasiTeori = KualifikasiTeori::findOrFail($id);
        $kualifikasiTeori->update($request->all());

        return redirect()->route('kualifikasiTerori.index')->with('success', 'Kualifikasi teori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kualifikasiTeori = KualifikasiTeori::findOrFail($id);
        $kualifikasiTeori->delete();

        return redirect()->route('kualifikasiTerori.index')->with('success', 'Kualifikasi teori berhasil dihapus.');
    }


    public function export(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(
            new KualifikasiTeoriExport($startDate, $endDate),
            'kualifikasi-teori.xlsx'
        );
    }
}
