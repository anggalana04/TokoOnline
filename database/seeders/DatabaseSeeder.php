<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Kategori; 
use Database\Seeders\ProdukSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'nama' => 'Administrator',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('123'),
        ]);

        User::firstOrCreate([
            'email' => 'sopian4ji@gmail.com',
        ], [
            'nama' => 'Sopian Aji',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('123'),
        ]); 
        #data kategori 
        Kategori::create([ 
            'nama_kategori' => 'Brownies', 
        ]); 
        Kategori::create([ 
            'nama_kategori' => 'Combro', 
        ]); 
        Kategori::create([ 
            'nama_kategori' => 'Dawet', 
        ]); 
        Kategori::create([ 
            'nama_kategori' => 'Mochi', 
        ]); 
        Kategori::create([ 
            'nama_kategori' => 'Wingko', 
        ]); 
        
        $this->call(ProdukSeeder::class);
    }
}
