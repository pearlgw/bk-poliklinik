<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Poli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="max-w-sm mx-auto" method="POST" action="/poli/{{ $poli->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-5">
                            <label for="nama_poli" class="block mb-2 text-sm font-medium">Nama Poli</label>
                            <input type="text" id="nama_poli"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="nama_poli" placeholder="nama_poli" required value="{{ $poli->nama_poli }}" />
                        </div>
                        <div class="mb-5">
                            <label for="keterangan" class="block mb-2 text-sm font-medium">Keterangan</label>
                            <input type="text" id="keterangan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="keterangan" placeholder="keterangan" required value="{{ $poli->keterangan }}" />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
