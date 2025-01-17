<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="max-w-sm mx-auto" method="POST" action="/pasien/{{ $pasien->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-5">
                            <label for="nama" class="block mb-2 text-sm font-medium">Nama</label>
                            <input type="text" id="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="nama" placeholder="nama" required value="{{ $pasien->nama }}" />
                        </div>
                        <div class="mb-5">
                            <label for="alamat" class="block mb-2 text-sm font-medium">Alamat</label>
                            <input type="text" id="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="alamat" placeholder="alamat" required value="{{ $pasien->alamat }}" />
                        </div>
                        <div class="mb-5">
                            <label for="no_ktp" class="block mb-2 text-sm font-medium">No KTP</label>
                            <input type="text" id="no_ktp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="no_ktp" placeholder="no_ktp" required value="{{ $pasien->no_ktp }}" />
                        </div>
                        <div class="mb-5">
                            <label for="no_hp" class="block mb-2 text-sm font-medium">No HP</label>
                            <input type="text" id="no_hp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="no_hp" placeholder="no_hp" required value="{{ $pasien->no_hp }}" />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>