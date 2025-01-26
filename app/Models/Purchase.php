<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'seller_id',
        'name',
        'quantity',
        'price',
        'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function productName()
    {
        return $this->product->part->brand->name . ' ' . $this->product->part->model->name . ' ' . $this->product->part->name;
    }
}
