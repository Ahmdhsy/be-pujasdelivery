<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom 'catatan' ke tabel transaction_items untuk menyimpan catatan pengguna per item pesanan.
     */
    public function up(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            // Kolom catatan untuk menyimpan catatan pengguna per item (opsional)
            $table->text('catatan')->nullable()->after('subtotal')->comment('Catatan pengguna untuk item pesanan, misalnya "Tanpa bawang"');
        });
    }

    /**
     * Reverse the migrations.
     * Menghapus kolom 'catatan' dari tabel transaction_items.
     */
    public function down(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }
};