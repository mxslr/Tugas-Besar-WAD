<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room; 
use Illuminate\Support\Facades\DB; 

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'room_code' => 'GKU-A101',
            'room_name' => 'Ruang Kelas A101',
            'building' => 'Gedung Kuliah Umum A',
            'floor' => 1,
            'capacity' => 50,
            'facilities' => json_encode(['Proyektor', 'AC', 'Papan Tulis']), 
            'description' => 'Ruang kelas standar di lantai 1 Gedung A.',
            'status' => 'available', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Room::create([
            'room_code' => 'LAB-KOMP-B2',
            'room_name' => 'Laboratorium Komputer B2',
            'building' => 'Gedung Laboratorium Terpadu B',
            'floor' => 2,
            'capacity' => 30,
            'facilities' => json_encode(['Komputer Client', 'Proyektor', 'AC']),
            'description' => 'Lab Komputer dengan 30 unit PC.',
            'status' => 'available',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Room::create([
            'room_code' => 'R-RAPAT-C3',
            'room_name' => 'Ruang Rapat Cendana',
            'building' => 'Gedung Rektorat C',
            'floor' => 3,
            'capacity' => 20,
            'facilities' => json_encode(['Meja Rapat Besar', 'Proyektor', 'AC', 'Sound System Mini']),
            'description' => 'Ruang rapat eksekutif.',
            'status' => 'maintenance', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('rooms')->insert([
            [
                'room_code' => 'GKU-A102',
                'room_name' => 'Ruang Kelas A102',
                'building' => 'Gedung Kuliah Umum A',
                'floor' => 1,
                'capacity' => 45,
                'facilities' => json_encode(['Proyektor', 'AC']),
                'description' => 'Ruang kelas standar lainnya.',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}