<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Poli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="mx-auto" method="POST" action="/konsultasi/{{ $konsultasi->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-5">
                            <label for="subjek" class="block mb-2 text-sm font-medium text-gray-900">Subjek</label>
                            <input type="text" id="subjek" name="subjek"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Sakit Kamu Apa?" required value="{{ $konsultasi->subjek }}" />
                        </div>
                        <div class="mb-5">
                            <label for="pertanyaan"
                                class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                            <input type="text" id="pertanyaan" name="pertanyaan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Apa yang ingin kamu tanyakan?" required
                                value="{{ $konsultasi->pertanyaan }}" />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
