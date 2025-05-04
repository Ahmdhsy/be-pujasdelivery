<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('harga', 10, 2);
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->string('category')->nullable(); // Jika menggunakan string category
            // Atau $table->unsignedBigInteger('category_id')->nullable(); // Jika menggunakan model Category
            $table->timestamps();
            
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
            // Jika menggunakan model Category
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}