<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Services\DepartemenService;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{

    private DepartemenService $departemenService;

    public function __construct(DepartemenService $departemenService)
    {
        $this->departemenService = $departemenService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departemens = $this->departemenService->getDepertemen();
        return view('departemen.index', compact('departemens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departemen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->departemenService->saveDepartemen($request->all());
        session()->flash('success', 'Data berhasil ditambahkan!');
        return redirect()->route('departemen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departemen $departemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departemen $departemen, $id)
    {
        $departemens = Departemen::find($id);
        return view('departemen.edit', compact('departemens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'departemen' => 'required||unique:departemens'
        ]);

        $this->departemenService->updateDepartemen($id, $request->only(['departemen']));
        session()->flash('success', 'Data berhasil ditambahkan!');
        return redirect()->route('departemen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->departemenService->removeDepartemen($id);
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }
}
