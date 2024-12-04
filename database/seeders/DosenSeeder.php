<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        DB::table('dosen')->insert([
            [
                'nama' => 'Dr. Ahmad Fauzi',
                'nip' => '198506162009121001',
                'no_telepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Prof. Budi Santoso',
                'nip' => '197204092000112002',
                'no_telepon' => '082345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ir. Dina Kartika, M.T.',
                'nip' => '199003072015112003',
                'no_telepon' => '083456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
