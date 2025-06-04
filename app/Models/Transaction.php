<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'tenant_id','gedung_id', 'status', 'total_price', 'bukti_pembayaran',];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function items() {
        return $this->hasMany(TransactionItem::class);
    }
    
    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
    }

