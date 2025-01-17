<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama_obat' => 'Obat Enak',
                'kemasan' => 'Sachet',
                'harga' => 12000,
            ],
            [
                'nama_obat' => 'poli 2',
                'kemasan' => 'Kapsul',
                'harga' => 10000,
            ],
        ];

        foreach ($polis as $poli) {
            Obat::create($poli);
        }
    }
}
