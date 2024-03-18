<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PabrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pabriks')->insert([
            'nama_pabrik' => 'Pabrik 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('pabriks')->insert([
                'nama_pabrik' => 'Pabrik' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}