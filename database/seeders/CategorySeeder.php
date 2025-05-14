<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        $categories = [
            [
                'id' => 1,
                'name' => 'Makanan',
                'description' => 'Berbagai menu makanan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Minuman',
                'description' => 'Berbagai menu minuman',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        
        foreach ($categories as $category) {
            DB::table('categories')
                ->updateOrInsert(
                    ['id' => $category['id']],
                    $category
                );
        }
    }
}