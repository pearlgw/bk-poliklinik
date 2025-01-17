<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwalPeriksas = [
            [
                'id_dokter' => 4,
                'hari' => 'Senin',
                'jam_mulai' => '07:00',
                'jam_selesai' => '08:00',
                'status' => 'Aktif',
            ],
            [
                'id_dokter' => 4,
                'hari' => 'Rabu',
                'jam_mulai' => '09:00',
                'jam_selesai' => '10:00',
                'status' => 'Non Aktif',
            ],
            [
                'id_dokter' => 5,
                'hari' => 'Selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:00',
                'status' => 'Aktif',
            ],
            [
                'id_dokter' => 6,
                'hari' => 'Kamis',
                'jam_mulai' => '11:00',
                'jam_selesai' => '12:00',
                'status' => 'Aktif',
            ],
        ];

        foreach ($jadwalPeriksas as $jadwalPeriksa) {
            JadwalPeriksa::create($jadwalPeriksa);
        }
    }
}
