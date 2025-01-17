<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto mt-5">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-100 text-black">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Poli
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Pasien
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Dokter
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Periksa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Catatan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Biaya Periksa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Obat
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($periksas as $periksa)
                                    <tr class="border-b text-black">
                                        <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $periksa->daftarPoli->jadwalPeriksa->user->poli->nama_poli }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $periksa->daftarPoli->user->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $periksa->daftarPoli->jadwalPeriksa->user->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $periksa->tanggal_periksa }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ \Illuminate\Support\Str::words($periksa->catatan, 4) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $periksa->biaya_periksa }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @foreach ($periksa->detailPeriksa as $detail)
                                                <p>{{ $detail->obat->nama_obat }}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                @empty
                                    <p>Data belum ada</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $periksas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
