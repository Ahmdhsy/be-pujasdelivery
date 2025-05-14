<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tenants')->insert([
            [
                'id' => 1, // Explicitly set ID
                'name' => 'Warung Pak Budi',
                'phone' => '08123456789',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Dapur Bu Siti',
                'phone' => '08567891234',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Cafe Santai',
                'phone' => '08912345678',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Pizza Express',
                'phone' => '08234567891',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'Bakso Malang Pak Joko',
                'phone' => '08765432109',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 11, // Add tenant with ID 11
                'name' => 'Warung CuCo',
                'phone' => '08199887766',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 12, // Add tenant with ID 12
                'name' => 'Harimun Jaya',
                'phone' => '082116672198',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],          
        ]);
    }
}