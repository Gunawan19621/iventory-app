<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_role' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'alamat' => 'Jl. Admin No. 1',
            'created_at' => now(),
        ]);
    
        for($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'id_role' => 2,
                'name' => 'User '.$i,
                'email' => 'user'.$i.'@dummy.com',
                'password' => bcrypt('password'),
                'alamat' => 'Jl. User '.$i.' No. '.$i,
                'created_at' => now(),
            ]);
        }
    }
}
