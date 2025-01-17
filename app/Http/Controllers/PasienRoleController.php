<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienRoleController extends Controller
{
    public function daftarPoliIndex()
    {
        $pasienInformations = DaftarPoli::where('status', 'process')->where('id_pasien', Auth::id())->get();
        $jadwalPeriksas = JadwalPeriksa::where('status', 'Aktif')->get();
        return view('pasien.index', compact('jadwalPeriksas', 'pasienInformations'));
    }

    public function daftarPoliStore(Request $request)
    {
        $validate = $request->validate([
            'id_jadwal' => 'required',
            'keluhan' => 'required|string',
        ]);

        $validate['id_pasien'] = Auth::id();
        
        $today = now()->format('Y-m-d');

        $existingQueue = DaftarPoli::whereDate('created_at', $today)->where('id_jadwal', $validate['id_jadwal'])->count();

        $validate['no_antrian'] = $existingQueue + 1;
        $validate['status'] = 'process';

        DaftarPoli::create($validate);

        return redirect()->route('pasien.daftarPoli');
    }
}
