<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('tenant_id')->constrained('tenants')->onDelete('cascade');
        $table->foreignId('gedung_id')->after('tenant_id')->constrained('gedungs');
        $table->enum('status', ['diterima', 'diproses', 'dalam pengantaran', 'selesai'])->default('diterima');
        $table->decimal('total_price', 10, 2)->default(0);
        $table->string('bukti_pembayaran')->nullable()->after('total_price');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
