<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polis = Poli::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.poli.index', compact('polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_poli' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        Poli::create($validate);

        return redirect()->route('poli');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.poli.edit', compact('poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);
        $validate = $request->validate([
            'nama_poli' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $poli->update($validate);

        return redirect()->route('poli');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);

        $poli->delete();

        return redirect()->route('poli');
    }
}
