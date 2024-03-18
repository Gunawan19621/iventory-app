<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuratJalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('surat_jalans')->insert([
                'surat_jalan' => 'SJ00' . $i,
                'tgl_sj' => now()->subDays($i), // Menetapkan tanggal surat jalan mundur secara berurutan
                'id_pabrik' => $i, // Mengasumsikan id_pabrik sama dengan $i
                'id_user' => $i, // Mengasumsikan id_user sama dengan $i
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}