<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Mengubah kolom bukti_pembayaran agar tidak nullable.
     */
    public function up(): void
    {
        // Pastikan tidak ada data dengan bukti_pembayaran null
        DB::table('transactions')->whereNull('bukti_pembayaran')->update(['bukti_pembayaran' => 'placeholder.jpg']);

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable(false)->change()->comment('Path ke file bukti pembayaran (wajib)');
        });
    }

    /**
     * Reverse the migrations.
     * Mengembalikan kolom bukti_pembayaran menjadi nullable.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->change();
        });
    }
};