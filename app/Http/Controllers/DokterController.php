<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polis = Poli::all();
        $dokters = Dokter::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dokter.index', compact('dokters', 'polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,14',
            'id_poli' => 'required|integer',
        ]);

        Dokter::create($validate);
        $user = User::create($validate);

        $user->password = Hash::make($validate['alamat']);
        $user->update();

        $user->assignRole('dokter');

        return redirect()->route('dokter');
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
        $polis = Poli::all();
        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $validate = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,14',
            'id_poli' => 'required|integer',
        ]);

        $user = User::where('nama', $dokter->nama)->where('alamat', $dokter->alamat)->first();

        if ($user) {
            if ($user->nama === $validate['nama'] && $user->alamat === $validate['alamat']) {
                $user->update([
                    'id_poli' => $validate['id_poli'],
                    'no_hp' => $validate['no_hp'],
                ]);
            } else {
                $user->update([
                    'nama' => $validate['nama'],
                    'alamat' => $validate['alamat'],
                    'no_hp' => $validate['no_hp'],
                    'id_poli' => $validate['id_poli'],
                ]);
            }
        }

        $dokter->update($validate);

        return redirect()->route('dokter');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokter = Dokter::where('no_hp', $id)->first();
        $user = User::where('no_hp', $id)->first();

        $user->delete();
        $dokter->delete();

        return redirect()->route('dokter');
    }
}
