<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="max-w-sm mx-auto" method="POST" action="{{ route('pasien.daftarPoli.store') }}">
                        @csrf
                        <div class="mb-5">
                            <label for="id_jadwal" class="block mb-2 text-sm font-medium">Jadwal Periksa</label>
                            <select id="jadwalPeriksaSelect" name="id_jadwal"
                                class="w-full rounded-lg bg-gray-50 border border-gray-300 p-2.5">
                                <option value="" disabled selected>Pilih jadwal periksa</option>
                                @foreach ($jadwalPeriksas as $jadwalPeriksa)
                                    <option value="{{ $jadwalPeriksa->id }}">
                                        {{ $jadwalPeriksa->user->poli->nama_poli }} | {{ $jadwalPeriksa->user->nama }} |
                                        {{ $jadwalPeriksa->hari }} |
                                        {{ $jadwalPeriksa->jam_mulai }} | {{ $jadwalPeriksa->jam_selesai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="keluhan" class="block mb-2 text-sm font-medium">Keluhan</label>
                            <input type="text" id="keluhan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="keluhan" placeholder="keluhan" required />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="relative overflow-x-auto mt-5">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs uppercase text-black">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Pasien
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Poli
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dokter
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Antrian
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hari
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Mulai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Selesai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Keluhan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pasienInformations as $pasienInformation)
                                <tr class="border-b text-black">
                                    <td class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ auth()->user()->nama }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pasienInformation->jadwalPeriksa->user->poli->nama_poli }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pasienInformation->jadwalPeriksa->user->nama }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pasienInformation->no_antrian }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pasienInformation->jadwalPeriksa->hari }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pasienInformation->jadwalPeriksa->jam_mulai }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pasienInformation->jadwalPeriksa->jam_selesai }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Illuminate\Support\Str::words($pasienInformation->keluhan, 4) }}
                                    </td>
                                </tr>
                            @empty
                                <p class="px-5 py-1">Belum pernah mendaftar</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect("#jadwalPeriksaSelect", {
            placeholder: "Cari jadwal...",
            create: false, // Tidak perlu menambah opsi baru
        });
    });
</script>
