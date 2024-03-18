<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan semua kategori yang ada di database
        $barangs = DB::table('barangs')->pluck('kode_barang');

        // Menyiapkan data barang
        $list_barangs = [];

        // Melakukan iterasi untuk setiap kategori
        foreach ($barangs as $barang) {
            // Menghasilkan 5 barang untuk setiap kategori
            for ($i = 1; $i <= 1; $i++) {
                $list_barangs[] = [
                    'id_sj' => $i,
                    'kode_barang' => $barang,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Memasukkan data barang ke dalam tabel 'barangs'
        DB::table('list_barangs')->insert($list_barangs);

        // Memasukkan data barang ke dalam tabel 'barangs'
        // DB::table('barangs')->insert($barangs);
        // for ($i = 1; $i <= 10; $i++) {
        //     DB::table('list_barangs')->insert([
        //         'id_sj' => $i, // Mengasumsikan id_pabrik sama dengan $i
        //         'surat_jalan' => 'SJ00' . $i,
        //         'tgl_sj' => now()->subDays($i), // Menetapkan tanggal surat jalan mundur secara berurutan
        //         'id_pabrik' => $i, // Mengasumsikan id_pabrik sama dengan $i
        //         'id_user' => $i, // Mengasumsikan id_user sama dengan $i
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}