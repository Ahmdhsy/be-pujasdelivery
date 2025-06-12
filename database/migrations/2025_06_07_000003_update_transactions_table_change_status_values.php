<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Hapus constraint lama jika ada
        DB::statement("ALTER TABLE transactions DROP CONSTRAINT IF EXISTS transactions_status_check");

        // 2. Pastikan kolom status berupa VARCHAR
        DB::statement("ALTER TABLE transactions ALTER COLUMN status TYPE VARCHAR(255)");

        // 3. Set default value (jika perlu)
        DB::statement("ALTER TABLE transactions ALTER COLUMN status SET DEFAULT 'diterima'");

        // 4. Tambahkan constraint baru
        DB::statement("ALTER TABLE transactions ADD CONSTRAINT transactions_status_check CHECK (status IN ('diterima', 'diproses', 'dalam pengantaran', 'selesai'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Hapus constraint baru
        DB::statement("ALTER TABLE transactions DROP CONSTRAINT IF EXISTS transactions_status_check");

        // 2. Kembalikan default (jika perlu)
        DB::statement("ALTER TABLE transactions ALTER COLUMN status DROP DEFAULT");

        // 3. Optional: bisa ubah status ke tipe enum-like lagi kalau sebelumnya enum (tidak wajib)
        DB::statement("ALTER TABLE transactions ALTER COLUMN status TYPE VARCHAR(255)");
    }
};
