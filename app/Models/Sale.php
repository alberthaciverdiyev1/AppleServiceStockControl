<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'seller_id',
        'product_id',
        'quantity',
        'price',
        'note'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
