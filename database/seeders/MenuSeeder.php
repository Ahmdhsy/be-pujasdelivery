<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'nama' => 'Nasi Goreng Spesial',
                'harga' => 18000.00,
                'deskripsi' => 'Nasi goreng dengan telur, ayam, dan kerupuk',
                'gambar' => 'nasi-goreng.jpg',
                'tenant_id' => 1, // Sesuaikan dengan tenant ID yang ada
                'category' => 'Makanan Utama', // Atau 'category_id' => 1 jika menggunakan model Category
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Mie Ayam Bakso',
                'harga' => 15000.00,
                'deskripsi' => 'Mie ayam lengkap dengan bakso dan sayur segar',
                'gambar' => 'mie-ayam-bakso.jpg',
                'tenant_id' => 1,
                'category' => 'Makanan Utama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Es Teh Manis',
                'harga' => 5000.00,
                'deskripsi' => 'Minuman es teh manis segar',
                'gambar' => 'es-teh-manis.jpg',
                'tenant_id' => 1,
                'category' => 'Minuman',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Ayam Geprek Level 3',
                'harga' => 20000.00,
                'deskripsi' => 'Ayam geprek pedas level 3 dengan nasi dan lalapan',
                'gambar' => 'ayam-geprek.jpg',
                'tenant_id' => 2, // Tenant lain
                'category' => 'Makanan Utama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Sate Ayam Lontong',
                'harga' => 22000.00,
                'deskripsi' => 'Sate ayam dengan lontong dan bumbu kacang',
                'gambar' => 'sate-ayam.jpg',
                'tenant_id' => 2,
                'category' => 'Makanan Utama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}