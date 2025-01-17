<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DokterRoleController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $polis = Poli::all();
        $dokter = User::where('id', $user)->first();
        // $dokters = Dokter::where('created_at', 'desc')->paginate(10);
        return view('dokter.update.index', compact('dokter', 'polis'));
    }

    public function edit($id)
    {
        $polis = Poli::all();
        $dokter = User::where('id', $id)->first();
        return view('dokter.update.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validate = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,14',
            'id_poli' => 'required|integer',
        ]);

        $dokter = Dokter::where('nama', $user->nama)->where('alamat', $user->alamat)->first();

        if ($dokter) {
            if ($dokter->nama === $validate['nama'] && $dokter->alamat === $validate['alamat']) {
                $dokter->update([
                    'id_poli' => $validate['id_poli'],
                    'no_hp' => $validate['no_hp'],
                ]);
            } else {
                $dokter->update([
                    'nama' => $validate['nama'],
                    'alamat' => $validate['alamat'],
                    'no_hp' => $validate['no_hp'],
                    'id_poli' => $validate['id_poli'],
                ]);
            }
        }

        $user->update($validate);

        return redirect()->route('dokter.index');
    }

    public function jadwalPeriksaIndex()
    {
        $jadwalPeriksas = JadwalPeriksa::orderBy('created_at', 'desc')->where('id_dokter', Auth::id())->paginate(10);
        return view('dokter.jadwal_periksa.index', compact('jadwalPeriksas'));
    }

    public function jadwalPeriksaCreate()
    {
        return view('dokter.jadwal_periksa.create');
    }

    public function jadwalPeriksaStore(Request $request)
    {
        $validate = $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $validate['id_dokter'] = Auth::id();
        $validate['status'] = 'Non Aktif';
        JadwalPeriksa::create($validate);

        return redirect()->route('dokter.jadwal_periksa');
    }

    public function jadwalPeriksaUpdateAktif($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        if (!$jadwalPeriksa) {
            return redirect()->route('dokter.jadwal_periksa');
        }

        $dokterId = Auth::id();

        $jadwalAktif = JadwalPeriksa::where('id_dokter', $dokterId)->where('status', 'Aktif')->first();

        if ($jadwalAktif) {
            $jadwalAktif->status = 'Non Aktif';
            $jadwalAktif->save();
        }

        $jadwalPeriksa->status = 'Aktif';
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal_periksa');
    }

    public function jadwalPeriksaUpdateNonAktif($id)
    {
        $jadwalPeriksa = JadwalPeriksa::where('id', $id)->first();
        $jadwalPeriksa->status = 'Non Aktif';
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal_periksa');
    }

    public function daftarPasienIndex()
    {
        $daftarPoliByDokters = DaftarPoli::with('jadwalPeriksa')->where('status', 'process')
            ->whereHas('jadwalPeriksa', function ($query) {
                $query->where('id_dokter', Auth::id());
            })->paginate(10);

        return view('dokter.daftar_pasien.index', compact('daftarPoliByDokters'));
    }

    public function daftarPasienCreate($id)
    {
        $obats = Obat::all();
        return view('dokter.daftar_pasien.create', compact('obats', 'id'));
    }

    public function daftarPasienStore(Request $request)
    {
        $validate = $request->validate([
            'catatan' => 'required',
            'biaya_periksa' => 'required',
            'id_obat' => 'required|array',
            'id_obat.*' => 'exists:obats,id'
        ]);

        $validate['id_daftar_poli'] = $request->id_daftar_poli;
        $validate['tanggal_periksa'] = now();
        $periksa = Periksa::create($validate);

        foreach ($request->id_obat as $obatId) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obatId,
            ]);
        }

        $daftarPoli = DaftarPoli::find($request->id_daftar_poli);
        $daftarPoli->status = 'diperiksa';
        $daftarPoli->save();

        return redirect()->route('dokter.daftarPasien');
    }

    public function riwayatPasien()
    {
        $periksas = Periksa::whereHas('daftarPoli.jadwalPeriksa', function ($query) {
            $query->where('id_dokter', Auth::id());
        })->paginate(10);
        return view('dokter.riwayat_pasien.index', compact('periksas'));
    }
}
