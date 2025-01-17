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
                    <form class="max-w-sm mx-auto" method="POST" action="{{ route('dokter.store') }}">
                        @csrf
                        <div class="mb-5">
                            <label for="nama" class="block mb-2 text-sm font-medium">Nama</label>
                            <input type="text" id="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="nama" placeholder="nama" required />
                        </div>
                        <div class="mb-5">
                            <label for="alamat" class="block mb-2 text-sm font-medium">Alamat</label>
                            <input type="text" id="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="alamat" placeholder="alamat" required />
                        </div>
                        <div class="mb-5">
                            <label for="no_hp" class="block mb-2 text-sm font-medium">No Hp</label>
                            <input type="number" id="no_hp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="no_hp" placeholder="No HP" required />
                        </div>
                        <div class="mb-5">
                            <label for="id_poli" class="block mb-2 text-sm font-medium">Nama Poli</label>
                            <select id="id_poli" name="id_poli"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value="" disabled selected>Pilih Poli</option>
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
