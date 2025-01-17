<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Periksa Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="max-w-sm mx-auto" method="POST" action="{{route('dokter.daftarPasien.store')}}">
                        @csrf
                        <input type="hidden" name="id_daftar_poli" value="{{ $id }}">
                        <div class="mb-5">
                            <label for="jadwalPeriksaSelect" class="block mb-2 text-sm font-medium">Obat</label>
                            <select id="jadwalPeriksaSelect" name="id_obat[]" multiple
                                class="w-full rounded-lg bg-gray-50 border border-gray-300 p-2.5">
                                <option value="" disabled>Pilih obat</option>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} | {{ $obat->kemasan }} |
                                        Rp.{{ number_format($obat->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="biaya_periksa" class="block mb-2 text-sm font-medium">Biaya Periksa</label>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-900">Rp.</span>
                                <input type="number" id="biaya_periksa"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 ml-2"
                                    name="biaya_periksa" required readonly />
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="catatan" class="block mb-2 text-sm font-medium">Catatan</label>
                            <input type="text" id="catatan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                name="catatan" placeholder="catatan" required />
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect("#jadwalPeriksaSelect", {
            placeholder: "Cari obat...",
            create: false, // Tidak perlu menambah opsi baru
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jadwalPeriksaSelect = document.getElementById('jadwalPeriksaSelect');
        const totalHargaInput = document.getElementById('biaya_periksa');
        const biayaStatis = 150000;

        // Fungsi untuk menghitung total harga
        function updateTotalHarga() {
            let totalHarga = biayaStatis;
            const selectedOptions = jadwalPeriksaSelect.selectedOptions;

            // Menjumlahkan harga dari setiap obat yang dipilih
            Array.from(selectedOptions).forEach(option => {
                totalHarga += parseInt(option.getAttribute('data-harga'));
            });

            // Menampilkan total harga pada input
            totalHargaInput.value = totalHarga;
        }

        // Memanggil fungsi saat ada perubahan pilihan
        jadwalPeriksaSelect.addEventListener('change', updateTotalHarga);

        // Inisialisasi total harga pada awal
        updateTotalHarga();
    });
</script>
