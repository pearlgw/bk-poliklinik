<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama_poli' => 'poli 1',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, quod!',
            ],
            [
                'nama_poli' => 'poli 2',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, ut esse?',
            ],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
