<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\KualifikasiGowning;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KualifikasiGowningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $kualifikasiGowning = KualifikasiGowning::with('karyawan')->get();
        // return view('KualifikasiGowning.index', compact('kualifikasiGowning'));
        $kualifikasiGowning = KualifikasiGowning::with('karyawan')
            ->join('karyawans', 'kualifikasi_gownings.nik', '=', 'karyawans.nik') // Gabungkan tabel karyawan
            ->orderBy('karyawans.departemen') // Urutkan berdasarkan departemen
            ->orderBy('karyawans.name') // Lalu urutkan berdasarkan name
            ->select('kualifikasi_gownings.*') // Pilih kolom dari kualifikasi_gownings
            ->get();

        return view('KualifikasiGowning.index', compact('kualifikasiGowning'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // // Hanya mengambil karyawan yang memiliki kualifikasiTeori dan belum memiliki kualifikasiGowning
        // $karyawans = Karyawan::whereHas('kualifikasiTeori') // Hanya karyawan dengan kualifikasi teori
        //     ->doesntHave('kualifikasiGowning') // Belum memiliki kualifikasi gowning
        //     ->get();
        // return view('KualifikasiGowning.create', compact('karyawans'));
        // Hanya mengambil karyawan yang memiliki kualifikasiTeori dan belum memiliki kualifikasiGowning
        $karyawans = Karyawan::whereHas('kualifikasiTeori') // Belum memiliki kualifikasi gowning
            ->get();
        return view('KualifikasiGowning.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:karyawans,nik',
            'jenis_kualifikasi' => [
                'required',
                Rule::unique('kualifikasi_gownings')->where(function ($query) use ($request) {
                    return $query->where('nik', $request->nik);
                }),
            ],
            'tanggal_kualifikasi' => 'required|date',
            'dahi' => 'required|integer',
            'muka_ka' => 'required|integer',
            'muka_ki' => 'required|integer',
            'dada_ka' => 'required|integer',
            'dada_ki' => 'required|integer',
            'lengan_ka' => 'required|integer',
            'lengan_ki' => 'required|integer',
            'finger_ka' => 'required|integer',
            'finger_ki' => 'required|integer',
            'hasil' => 'required|string',
            'tanggal_rekualifikasi' => 'nullable|date',
        ]);

        KualifikasiGowning::create($request->all());
        return redirect()->route('kualifikasiGowning.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KualifikasiGowning $kualifikasiGowning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kualifikasiGowning = KualifikasiGowning::findOrFail($id);
        return view('KualifikasiGowning.edit', compact('kualifikasiGowning'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|exists:karyawans,nik',
            'jenis_kualifikasi' => 'required',
            'tanggal_kualifikasi' => 'required|date',
            'dahi' => 'required|integer',
            'muka_ka' => 'required|integer',
            'muka_ki' => 'required|integer',
            'dada_ka' => 'required|integer',
            'dada_ki' => 'required|integer',
            'lengan_ka' => 'required|integer',
            'lengan_ki' => 'required|integer',
            'finger_ka' => 'required|integer',
            'finger_ki' => 'required|integer',
            'hasil' => 'required|string',
            'tanggal_rekualifikasi' => 'nullable|date',
        ]);

        $kualifikasiGowning = KualifikasiGowning::findOrFail($id);
        $kualifikasiGowning->update($request->all());

        return redirect()->route('kualifikasiGowning.index')->with('success', 'Kualifikasi teori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kualifikasiGowning = KualifikasiGowning::findOrFail($id);
        $kualifikasiGowning->delete();

        return redirect()->route('kualifikasiGowning.index')->with('success', 'Kualifikasi teori berhasil dihapus.');
    }


    public function dashboard(Request $request)
    {
        // Ambil filter departemen dari request (array)
        $selectedDepartments = $request->input('departemen', []);

        // Query utama
        $data = Karyawan::with(['kualifikasiTeori', 'kualifikasiGowning' => function ($query) {
            $query->whereIn('jenis_kualifikasi', ['rekualifikasi', 'aseptis']);
        }])
            ->whereHas('kualifikasiTeori', function ($query) {
                $query->where('hasil', 'QUALIFIED'); // Filter hanya yang QUALIFIED pada kualifikasi teori
            })
            ->whereHas('kualifikasiGowning', function ($query) {
                $query->where('jenis_kualifikasi', 'rekualifikasi')
                    ->where('hasil', 'QUALIFIED'); // Filter hanya yang QUALIFIED pada rekualifikasi
            })
            ->when($selectedDepartments, function ($query) use ($selectedDepartments) {
                $query->whereIn('departemen', $selectedDepartments); // Filter berdasarkan departemen
            })
            ->get();

        // Ambil daftar departemen untuk dropdown filter
        $departments = Karyawan::select('departemen')->distinct()->pluck('departemen');

        // Kirim data ke view
        return view('dashboard.listGowning', compact('data', 'departments', 'selectedDepartments'));
    }
}
