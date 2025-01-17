<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="/data-dokter/{{ $dokter->id }}/edit"
                        class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Edit</a>
                    <div class="relative overflow-x-auto mt-5">
                        <table class="w-full text-sm text-left rtl:text-right">
                            <tr>
                                <td>Nama</td>
                                <td scope="col" class="px-6 py-3">
                                    : {{ $dokter->nama }}
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td scope="col" class="px-6 py-3">
                                    : {{ $dokter->alamat }}
                                </td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td scope="col" class="px-6 py-3">
                                    : {{ $dokter->no_hp }}
                                </td>
                            </tr>
                            <tr>
                                <td>Poli</td>
                                <td scope="col" class="px-6 py-3">
                                    : {{ $dokter->poli->nama_poli }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
