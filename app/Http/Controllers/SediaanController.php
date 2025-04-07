<?php

namespace App\Http\Controllers;

use App\Models\Sediaan;
use App\Services\SediaanService;
use Illuminate\Http\Request;

class SediaanController extends Controller
{
    private SediaanService $sediaanService;

    public function __construct(SediaanService $sediaanService)
    {
        $this->sediaanService = $sediaanService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sediaans = $this->sediaanService->getSediaan();
        return view('sediaan.index', compact('sediaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sediaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sediaan' => 'required||unique:sediaans'
        ]);
        $this->sediaanService->saveSediaan($request->all());
        session()->flash('success', 'Data berhasil ditambahkan!');
        return redirect()->route('sediaan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sediaan $sediaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sediaan = Sediaan::find($id);
        return view('sediaan.edit', compact('sediaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sediaan' => 'required||unique:sediaans'
        ]);

        $this->sediaanService->updateSediaan($id, $request->only(['sediaan']));
        session()->flash('success', 'Data berhasil ditambahkan!');
        return redirect()->route('sediaan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->sediaanService->removeSediaan($id);
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }
}
