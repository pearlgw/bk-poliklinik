<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = Pasien::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_ktp' => 'required|numeric|digits:16',
            'no_hp' => 'required|numeric|digits_between:10,14',
        ]);

        $validate['no_rm'] = $this->generateNoRekamMedis();
        Pasien::create($validate);

        $user = User::create($validate);
        $user->password = Hash::make($validate['alamat']);
        $user->update();

        $user->assignRole('pasien');

        return redirect()->route('pasien');
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
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        $validate = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_ktp' => 'required|numeric|digits:16',
            'no_hp' => 'required|numeric|digits_between:10,14',
        ]);

        $user = User::where('nama', $pasien->nama)->where('alamat', $pasien->alamat)->first();

        if ($user) {
            if ($user->nama === $validate['nama'] && $user->alamat === $validate['alamat']) {
                $user->update([
                    'no_ktp' => $validate['no_ktp'],
                    'no_hp' => $validate['no_hp'],
                ]);
            } else {
                $user->update([
                    'nama' => $validate['nama'],
                    'alamat' => $validate['alamat'],
                    'no_ktp' => $validate['no_ktp'],
                    'no_hp' => $validate['no_hp'],
                ]);
            }
        }

        $pasien->update($validate);

        return redirect()->route('pasien');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pasien = Pasien::where('no_ktp', $id)->first();
        $user = User::where('no_ktp', $id)->first();

        $user->delete();
        $pasien->delete();

        return redirect()->route('pasien');
    }

    private function generateNoRekamMedis()
    {
        $tahunBulan = Carbon::now()->format('Ym');
        $lastRecord = Pasien::where('no_rm', 'like', "{$tahunBulan}-%")->orderBy('no_rm', 'desc')->first();

        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->no_rm, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 101;
        }

        return "{$tahunBulan}-" . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
