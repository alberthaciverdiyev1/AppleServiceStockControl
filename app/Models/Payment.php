<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'sale_id',
        'purchase_id',
        'amount',
        'type',
        'sale_or_purchase'
    ];
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
    public function product(){
        return sale()->brand;
    }
}
