<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Inspeksi;
use App\Models\karyawan;
use App\Models\Sediaan;
use App\Models\Wadah;
use App\Services\InspeksiService;
use Illuminate\Http\Request;

class InspeksiController extends Controller
{
    private InspeksiService $inspeksiService;

    public function __construct(InspeksiService $inspeksiService)
    {
        $this->inspeksiService = $inspeksiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $inspeksi = Inspeksi::with('karyawan')
        //     ->join('karyawans', 'inspeksis.nik', '=', 'karyawans.nik')
        //     ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
        //     ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
        //     ->select('inspeksis.*') // Pilih kolom
        //     ->get();

        $inspeksi = $this->inspeksiService->getInspeksi();
        return view('inspeksi.index', compact('inspeksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = karyawan::get();
        $sediaans = Sediaan::all()->pluck('sediaan');
        $wadahs = Wadah::all()->pluck('wadah');
        return view('inspeksi.create', compact('karyawans', 'sediaans', 'wadahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'tanggal_kualifikasi' => 'required|date',
            'bentuk_sediaan' => 'required|string',
            'jenis_sediaan' => 'required|string',
            'nilai' => 'required|numeric',
            'hasil' => 'required|string',
            'tanggal_rekualifikasi' => 'nullable|date',
        ]);

        // $inspeksi = new Inspeksi();
        // $inspeksi->fill($data);
        // $inspeksi->save();
        $this->inspeksiService->saveInspeksi($request->all());
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
    public function edit($id)
    {
        $inspeksi = Inspeksi::find($id);
        $sediaans = Sediaan::all()->pluck('sediaan');
        $wadahs = Wadah::all()->pluck('wadah');
        return view('inspeksi.edit', compact('inspeksi', 'wadahs', 'sediaans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required',
            'tanggal_kualifikasi' => 'required|date',
            'bentuk_sediaan' => 'required|string',
            'jenis_sediaan' => 'required|string',
            'nilai' => 'required|numeric',
            'hasil' => 'required|string',
            'tanggal_rekualifikasi' => 'nullable|date',
        ]);

        // $inspeksi = Inspeksi::find($id);
        // $inspeksi->fill($data);
        // $inspeksi->save();
        $this->inspeksiService->updateInspeksi($id, $request->all());

        session()->flash('success', 'Data berhasil di Ubah!');

        return redirect()->route('inspeksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $inspeksi = Inspeksi::findOrFail($id);
        // $inspeksi->delete();

        $this->inspeksiService->removeInspeksi($id);
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }
}
