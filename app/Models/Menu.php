<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'nama', 'harga', 'deskripsi', 'gambar', 'tenant_id', 'category',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor opsional (tidak wajib kalau pakai field asli)
    public function getNameAttribute()
    {
        return $this->nama;
    }

    public function getPriceAttribute()
    {
        return $this->harga;
    }

    public function getDescriptionAttribute()
    {
        return $this->deskripsi;
    }
}
