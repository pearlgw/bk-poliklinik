<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiDokterController extends Controller
{
    public function index()
    {
        $konsultasis = Konsultasi::where('id_dokter', Auth::id())->get();
        return view('dokter.konsultasi.index', compact('konsultasis'));
    }

    public function create($id)
    {
        return view('dokter.konsultasi.create', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $validate = $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $konsultasi->update($validate);

        return redirect()->route('konsultasi.dokter');
    }

    public function edit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('dokter.konsultasi.edit', compact('konsultasi'));
    }
}
