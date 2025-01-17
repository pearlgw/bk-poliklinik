<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="max-w-sm mx-auto" method="POST" action="/obat/{{ $obat->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-5">
                            <label for="nama_obat" class="block mb-2 text-sm font-medium">Nama Obat</label>
                            <input type="text" id="nama_obat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="nama_obat" placeholder="nama_obat" required value="{{ $obat->nama_obat }}" />
                        </div>
                        <div class="mb-5">
                            <label for="kemasan" class="block mb-2 text-sm font-medium">Kemasan</label>
                            <input type="text" id="kemasan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="kemasan" placeholder="kemasan" required value="{{ $obat->kemasan }}" />
                        </div>
                        <div class="mb-5">
                            <label for="harga" class="block mb-2 text-sm font-medium">Harga</label>
                            <input type="number" id="harga"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="harga" placeholder="harga" required value="{{ $obat->harga }}" />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
