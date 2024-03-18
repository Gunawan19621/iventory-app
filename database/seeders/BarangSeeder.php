<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan semua kategori yang ada di database
        $kategoris = DB::table('kategoris')->pluck('kode_kategori');

        // Menyiapkan data barang
        $barangs = [];

        // Melakukan iterasi untuk setiap kategori
        foreach ($kategoris as $kategori) {
            // Menghasilkan 5 barang untuk setiap kategori
            for ($i = 1; $i <= 1; $i++) {
                $barangs[] = [
                    'kode_barang' => 'BRG_' . $kategori . '_' . $i,
                    'nama_barang' => 'Barang ' . $kategori . ' ' . $i,
                    'kode_kategori' => $kategori,
                    'foto_barang' => null, // Isi dengan URL foto jika ada
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Memasukkan data barang ke dalam tabel 'barangs'
        DB::table('barangs')->insert($barangs);
    }
}