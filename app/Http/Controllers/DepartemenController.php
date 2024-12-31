<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departemens = Departemen::all();
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
        $requestData = $request->validate([
            'departemen' => 'required|unique:departemens'
        ]);

        $departemens = new Departemen();
        $departemens->fill($requestData);
        $departemens->save();
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
    public function update(Request $request, Departemen $departemen, $id)
    {
        $requestData = $request->validate([
            'departemen' => 'required'
        ]);

        $departemens = Departemen::find($id);
        $departemens->fill($requestData);
        $departemens->save();
        session()->flash('success', 'Data berhasil ditambahkan!');

        return redirect()->route('departemen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departemen $departemen, $id)
    {
        $departemens = Departemen::find($id);
        $departemens->delete();
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }
}
