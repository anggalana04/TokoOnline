<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use Illuminate\Support\Facades\File;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua file gambar dari folder storage/img-produk
        $fotoPath = storage_path('app/public/img-produk');
        $fotoFiles = collect(File::files($fotoPath))
            ->filter(function ($file) {
                return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif']);
            })
            ->pluck('basename')
            ->toArray();

        if (empty($fotoFiles)) {
            throw new \Exception("Folder storage/app/public/img-produk/ kosong. Silakan tambahkan file gambar terlebih dahulu.");
        }

        $produkList = [
            [
                'kategori_id' => 1,
                'nama_produk' => 'Brownies Coklat',
                'detail' => 'Brownies lembut dengan coklat premium.',
                'harga' => 35000,
                'berat' => 500,
                'stok' => 20,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 1,
                'nama_produk' => 'Brownies Keju',
                'detail' => 'Brownies dengan topping keju melimpah.',
                'harga' => 37000,
                'berat' => 500,
                'stok' => 15,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 2,
                'nama_produk' => 'Combro Original',
                'detail' => 'Combro isi oncom gurih.',
                'harga' => 20000,
                'berat' => 300,
                'stok' => 25,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 3,
                'nama_produk' => 'Dawet Ayu',
                'detail' => 'Dawet segar khas Banjarnegara.',
                'harga' => 12000,
                'berat' => 250,
                'stok' => 30,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 4,
                'nama_produk' => 'Mochi Kacang',
                'detail' => 'Mochi isi kacang manis dan kenyal.',
                'harga' => 18000,
                'berat' => 200,
                'stok' => 40,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 5,
                'nama_produk' => 'Wingko Babat',
                'detail' => 'Wingko babat legit dan gurih.',
                'harga' => 22000,
                'berat' => 300,
                'stok' => 18,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 3,
                'nama_produk' => 'Dawet Tape',
                'detail' => 'Dawet dengan tape manis.',
                'harga' => 13000,
                'berat' => 250,
                'stok' => 22,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 4,
                'nama_produk' => 'Mochi Coklat',
                'detail' => 'Mochi isi coklat lumer.',
                'harga' => 20000,
                'berat' => 200,
                'stok' => 35,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 2,
                'nama_produk' => 'Combro Mini',
                'detail' => 'Combro ukuran mini, cocok untuk camilan.',
                'harga' => 10000,
                'berat' => 150,
                'stok' => 50,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 5,
                'nama_produk' => 'Wingko Pandan',
                'detail' => 'Wingko babat rasa pandan.',
                'harga' => 23000,
                'berat' => 300,
                'stok' => 20,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 1,
                'nama_produk' => 'Brownies Matcha',
                'detail' => 'Brownies dengan rasa matcha Jepang.',
                'harga' => 39000,
                'berat' => 500,
                'stok' => 10,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 2,
                'nama_produk' => 'Combro Pedas',
                'detail' => 'Combro dengan isian oncom pedas.',
                'harga' => 21000,
                'berat' => 300,
                'stok' => 30,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 3,
                'nama_produk' => 'Dawet Durian',
                'detail' => 'Dawet dengan campuran durian asli.',
                'harga' => 17000,
                'berat' => 300,
                'stok' => 15,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 4,
                'nama_produk' => 'Mochi Stroberi',
                'detail' => 'Mochi isi selai stroberi segar.',
                'harga' => 21000,
                'berat' => 200,
                'stok' => 25,
                'status' => 1,
                'user_id' => 1,
            ],
            [
                'kategori_id' => 5,
                'nama_produk' => 'Wingko Coklat',
                'detail' => 'Wingko babat dengan rasa coklat.',
                'harga' => 24000,
                'berat' => 300,
                'stok' => 12,
                'status' => 1,
                'user_id' => 1,
            ],
        ];

        foreach ($produkList as $produk) {
            Produk::create(array_merge($produk, ['foto' => '']));
        }
    }
}
