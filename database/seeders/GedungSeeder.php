<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gedung;

class GedungSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_gedung' => 'Gedung A'],
            ['nama_gedung' => 'Gedung B'],
            ['nama_gedung' => 'Gedung C'],
            ['nama_gedung' => 'Gedung D'],
            ['nama_gedung' => 'Gedung E'],
            ['nama_gedung' => 'Gedung F'],
            ['nama_gedung' => 'Gedung H'],
            ['nama_gedung' => 'Gedung Direktorat'],
            ['nama_gedung' => 'Gedung MKU'],
            ['nama_gedung' => 'Pendopo'],
        ];

        foreach ($data as $gedung) {
            Gedung::create($gedung);
        }
    }
}
