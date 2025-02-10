<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'demo@gmail.com'], // Cek apakah email sudah ada
            [
                'name' => 'demo',
                'password' => Hash::make('demo1234'), // Ganti dengan password yang diinginkan
                'usertype' => 'admin', // Pastikan ada kolom role di tabel users
            ]
        );
    }
}