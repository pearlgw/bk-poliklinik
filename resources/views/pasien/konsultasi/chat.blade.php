<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="mx-auto" method="POST" action="/konsultasi/{{ $id }}">
                        @csrf
                        <div class="mb-5">
                            <label for="subjek" class="block mb-2 text-sm font-medium text-gray-900">Subjek</label>
                            <input type="text" id="subjek" name="subjek"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Sakit Kamu Apa?" required />
                        </div>
                        <div class="mb-5">
                            <label for="pertanyaan"
                                class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                            <input type="text" id="pertanyaan" name="pertanyaan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Apa yang ingin kamu tanyakan?" required />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto mt-5">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-100 text-black">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pasien
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Dokter
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Subjek
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Pertanyaan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggapan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal Konsultasi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($konsultasis as $konsultasi)
                                    <tr class="border-b text-black">
                                        <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $konsultasi->pasien->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $konsultasi->dokter->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $konsultasi->subjek }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $konsultasi->pertanyaan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($konsultasi->tanggapan)
                                                {{ $konsultasi->tanggapan }}
                                            @else
                                                <span class="text-yellow-500">
                                                    belum ada tanggapan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $konsultasi->created_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <a href="/konsultasi/{{ $konsultasi->id }}/edit"
                                                    class="text-white bg-yellow-700 hover:bg-yellow-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Edit</a>
                                                <form action="/konsultasi/{{ $konsultasi->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Data belum ada</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
