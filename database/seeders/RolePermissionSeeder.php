<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'mengelola dokter',
            'mengelola pasien',
            'mengelola poli',
            'mengelola obat',
            'pendaftaran pasien',
            'mendaftar poli',
            'memperbarui data dokter',
            'input jadwal periksa',
            'memeriksa pasien',
            // 'menghitung biaya periksa',
            'memberikan catatan obat',
            'menampilkan riwayat pasien',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $pasienRole = Role::firstOrCreate([
            'name' => 'pasien'
        ]);

        $pasienPermission = [
            'pendaftaran pasien',
            'mendaftar poli',
        ];

        $userPasiens = [
            [
                'nama' => 'pasien umam',
                'alamat' => 'letjen suprapto',
                'password' => bcrypt('letjen suprapto'),
                'no_ktp' => '1234567890987654',
                'no_hp' => '123456789098',
                'no_rm' => 202517 - 101,
            ],
            [
                'nama' => 'pasien handoko',
                'alamat' => 'ungaran',
                'password' => bcrypt('ungaran'),
                'no_ktp' => '1234567890987654',
                'no_hp' => '123456789098',
                'no_rm' => 202517 - 102,
            ],
            [
                'nama' => 'pasien Siti',
                'alamat' => 'Surabaya',
                'password' => bcrypt('Surabaya'),
                'no_ktp' => '1234567890987654',
                'no_hp' => '123456789098',
                'no_rm' => 202517 - 103,
            ]
        ];

        foreach ($userPasiens as $userPasien) {
            $createdUser = User::create($userPasien);
            $createdUser->assignRole($pasienRole);
        }

        foreach ($userPasiens as $userPasien) {
            unset($userPasien['password']);
            Pasien::create($userPasien);
        }

        $pasienRole->syncPermissions($pasienPermission);

        $dokterRole = Role::firstOrCreate([
            'name' => 'dokter'
        ]);

        $dokterPermission = [
            'memperbarui data dokter',
            'input jadwal periksa',
            'memeriksa pasien',
            'menampilkan riwayat pasien',
        ];

        $userDokters = [
            [
                'nama' => "dokter chandra",
                'alamat' => "gunung pati",
                'password' => bcrypt('gunung pati'),
                'no_hp' => "123456789011",
                'id_poli' => 2,
            ],
            [
                'nama' => "dokter Kiki",
                'alamat' => "Jl. Suprapto",
                'password' => bcrypt('Jl. Suprapto'),
                'no_hp' => "123456789012",
                'id_poli' => 1,
            ],
            [
                'nama' => "dokter kiko",
                'alamat' => "Jl. Supratman",
                'password' => bcrypt('Jl. Supratman'),
                'no_hp' => "123456789013",
                'id_poli' => 1,
            ]
        ];

        foreach ($userDokters as $userDokter) {
            $createdUser = User::create($userDokter);
            $createdUser->assignRole($dokterRole);
        }

        foreach ($userDokters as $userDokter) {
            unset($userDokter['password']);
            Dokter::create($userDokter);
        }

        $dokterRole->syncPermissions($dokterPermission);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $adminPermission = [
            'mengelola dokter',
            'mengelola pasien',
            'mengelola poli',
            'mengelola obat',
        ];

        $userAdmin = User::create([
            'nama' => 'admin',
            'alamat' => 'password',
            'password' => bcrypt('password'),
        ]);

        $userAdmin->assignRole($adminRole);
        $adminRole->syncPermissions($adminPermission);
    }
}
