<?php

namespace App\Http\Controllers;

use App\Models\Wadah;
use App\Services\WadanService;
use Illuminate\Http\Request;

class WadahController extends Controller
{
    private WadanService $wadanService;

    public function __construct(WadanService $wadanService)
    {
        $this->wadanService = $wadanService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wadahs = $this->wadanService->getWadah();
        return view('wadah.index', compact('wadahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wadah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wadah' => 'required|unique:wadahs',
        ]);

        $this->wadanService->saveWadah($request->all());

        return redirect()->route('wadah.index')->with('succes', 'Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wadah $wadah) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $wadahs = Wadah::findOrFail($id);
        return view('wadah.edit', compact('wadahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'wadah' => 'required'
        ]);
        $this->wadanService->updateWadah($id, $request->all());
        return redirect()->route('wadah.index')->with('seccess', 'Data Berhasil Dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->wadanService->removeWadah($id);
        return redirect()->route('wadah.index')->with('seccess', 'Data Berhasil Dihapus!');
    }
}
