<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    
    protected $fillable = [
        'nama', 'harga', 'deskripsi', 'gambar', 'tenant_id', 'category_id'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    
    // Jika Anda memiliki model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Getter untuk menyesuaikan nama kolom dengan yang diharapkan view
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