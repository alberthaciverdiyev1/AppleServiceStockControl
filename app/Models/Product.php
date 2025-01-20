<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'brand_id',
        'part_id',
        'seller_id',
        'name',
        'code',
        'quantity',
        'buying_price',
        'selling_price'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function part(){
        return $this->belongsTo(Part::class);
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
