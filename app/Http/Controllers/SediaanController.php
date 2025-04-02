<?php

namespace App\Http\Controllers;

use App\Models\Sediaan;
use Illuminate\Http\Request;

class SediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sediaans = Sediaan::all();
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
        $data = $request->validate([
            'name' => 'required|unique:sediaans'
        ]);

        $sediaans = new Sediaan();
        $sediaans->fill($data);
        $sediaans->save();
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
        $sediaans = Sediaan::find($id);
        return view('sediaan.edit', compact('sediaans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $sediaans = Sediaan::find($id);
        $sediaans->fill($data);
        $sediaans->save();

        session()->flash('success', 'Data berhasil di Ubah!');

        return redirect()->route('sediaan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sediaans = Sediaan::find($id);
        $sediaans->delete();
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }
}
