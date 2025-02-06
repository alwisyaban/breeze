<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Inspeksi;
use App\Models\karyawan;
use Illuminate\Http\Request;

class InspeksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inspeksi = Inspeksi::with('karyawan')
            ->join('karyawans', 'inspeksis.nik', '=', 'karyawans.nik')
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('inspeksis.*') // Pilih kolom dari kualifikasi_gownings
            ->get();
        return view('inspeksi.index', compact('inspeksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = karyawan::get();
        return view('inspeksi.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|unique:inspeksis,nik',
            'tanggal_kualifikasi' => 'required|date',
            'jenis_sediaan' => 'required|string',
            'nilai' => 'required|numeric',
            'hasil' => 'required|string',
            'tanggal_rekualifikasi' => 'nullable|date',
        ]);

        $inspeksi = new Inspeksi();
        $inspeksi->fill($data);
        $inspeksi->save();
        return redirect()->route('inspeksi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inspeksi $inspeksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inspeksi $inspeksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inspeksi $inspeksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspeksi $inspeksi)
    {
        //
    }
}
