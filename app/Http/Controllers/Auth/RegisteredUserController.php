<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
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
