<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            'kode_kategori' => 'KAT001',
            'nama_kategori' => 'Kategori 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            DB::table('kategoris')->insert([
                'kode_kategori' => 'KAT00' . $i, // Misalnya, untuk menghasilkan KAT001, KAT002, dst.
                'nama_kategori' => 'Kategori ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}