<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\MonitoringDr;
use Illuminate\Http\Request;

class MonitoringDrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoringDr = MonitoringDr::all();
        return view('DR.index', compact('monitoringDr'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departemens = Departemen::all()->pluck('departemen');
        return view('DR.create', compact('departemens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'dr_number' => 'required'
        ]);
        $monitoringDr = new MonitoringDr();
        $monitoringDr->fill($requestData);
        $monitoringDr->save();
        session()->flash('success', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MonitoringDr $monitoringDr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $monitoringDr = MonitoringDr::findOrFail($id);
        $departemens = Departemen::all()->pluck('departemen');
        return view('DR.edit', compact('monitoringDr', 'departemen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'dr_number' => 'required'
        ]);
        $monitoringDr = MonitoringDr::findOrFail($id);
        $monitoringDr->fill($requestData);
        $monitoringDr->save();
        session()->flash('success', 'Data berhasil ditambah!');

        return redirect()->route('monitoringDR.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $monitoringDr = MonitoringDr::findOrFail($id);
        $monitoringDr->delete();
        session()->flash('success', 'Data berhasil Dihapus!');
        return back();
    }
}
