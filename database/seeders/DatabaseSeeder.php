<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lapangan;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin SM Sport',
            'email' => '17230172@bsi.ac.id',
            'password' => Hash::make('smsport123'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin SM Sport 2',
            'email' => 'sm_sport@gmail.com',
            'password' => Hash::make('smsport123'),
            'role' => 'admin'
        ]);
        



        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            
        ]);

        Lapangan::create([
            'nama_lapangan' => 'Futsal 1',
            'jenis_lapangan' => 'Futsal',
            'harga_per_jam' => 150000,
        ]);
        Lapangan::create([
            'nama_lapangan' => 'Futsal 2',
            'jenis_lapangan' => 'Futsal',
            'harga_per_jam' => 150000,
        ]);
        Lapangan::create([
            'nama_lapangan' => 'Badminton 1',
            'jenis_lapangan' => 'Badminton',
            'harga_per_jam' => 50000,
        ]);
        Lapangan::create([
            'nama_lapangan' => 'Badminton 2',
            'jenis_lapangan' => 'Badminton',
            'harga_per_jam' => 50000,
        ]);
        Lapangan::create([
            'nama_lapangan' => 'Badminton 3',
            'jenis_lapangan' => 'Badminton',
            'harga_per_jam' => 50000,
        ]);
    }
}
