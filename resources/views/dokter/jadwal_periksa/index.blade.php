<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('dokter.jadwal_periksa.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Buat</a>
                    <div class="relative overflow-x-auto mt-5">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-100 text-black">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Dokter
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
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwalPeriksas as $jadwalPeriksa)
                                    <tr class="border-b text-black">
                                        <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $jadwalPeriksa->user->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="capitalize">
                                                {{ $jadwalPeriksa->hari }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $jadwalPeriksa->jam_mulai }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $jadwalPeriksa->jam_selesai }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $jadwalPeriksa->status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($jadwalPeriksa->status === 'Non Aktif')
                                                <form action="/jadwal-periksa/{{ $jadwalPeriksa->id }}/aktif"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button
                                                        class="text-white bg-yellow-700 hover:bg-yellow-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Aktif</button>
                                                </form>
                                            @elseif ($jadwalPeriksa->status === 'Aktif')
                                                <form action="/jadwal-periksa/{{ $jadwalPeriksa->id }}/non-aktif"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button
                                                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Non
                                                        Aktif</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <p>Data belum ada</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $jadwalPeriksas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
