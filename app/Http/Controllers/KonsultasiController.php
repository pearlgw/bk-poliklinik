<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function index()
    {
        $jadwalPeriksas =  JadwalPeriksa::where('status', 'Aktif')->get();
        return view('pasien.konsultasi.index', compact('jadwalPeriksas'));
    }

    public function getChat($id)
    {
        $konsultasis = Konsultasi::where('id_dokter', $id)->where('id_pasien', Auth::id())->get();
        return view('pasien.konsultasi.chat', compact('id', 'konsultasis'));
    }

    public function postChat(Request $request, $id)
    {
        $validate = $request->validate([
            'pertanyaan' => 'required|string',
            'subjek' => 'required|string',
        ]);

        $validate['id_pasien'] = Auth::id();
        $validate['id_dokter'] = $id;
        Konsultasi::create($validate);

        return redirect()->route('konsultasi.pasien');
    }

    public function getEdit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        return view('pasien.konsultasi.edit', compact('konsultasi'));
    }

    public function patchChat(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $validate = $request->validate([
            'pertanyaan' => 'required|string',
            'subjek' => 'required|string',
        ]);

        $konsultasi->update($validate);

        return redirect()->route('konsultasi.pasien');
    }

    public function deleteChat($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        $konsultasi->delete();

        // return redirect(url()->current());
        return redirect()->route('konsultasi.pasien');
    }
}
