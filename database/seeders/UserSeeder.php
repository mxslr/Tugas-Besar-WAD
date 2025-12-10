<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'adminbpa',
            'email' => 'admin.bpa@telkomuniversity.ac.id',
            'password_hash' => bcrypt('password123'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(), 
        ]);

        User::create([
            'username' => 'marshall',
            'email' => 'marshallrm@student.telkomuniversity.ac.id',
            'password' => 'password123', 
            'role' => 'mahasiswa',
            'status' => 'active',
            'email_verified_at' => now(), 
        ]);
    }
}