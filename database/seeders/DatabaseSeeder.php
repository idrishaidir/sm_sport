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
            'email' => 'sm_sport@gmail.com',
            'password' => Hash::make('smsport123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => "Pelanggan 1",
            'email' => "pelanggan1@gmail.com",
            'password' => Hash::make('pelanggan1'),
            'role' => 'pelanggan'
        ]);
        User::create([
            'name' => "Pelanggan 2",
            'email' => "pelanggan2@gmail.com",
            'password' => Hash::make('pelanggan2'),
            'role' => 'pelanggan'
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
