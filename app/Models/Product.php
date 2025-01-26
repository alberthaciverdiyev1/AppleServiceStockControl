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
        'model_id',
        'name',
        'code',
        'buying_price',
        'selling_price'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function quantities()
    {
        return $this->hasMany(Quantity::class);
    }

    public function productCount()
    {
        $totalSales = $this->quantities()->where('type', 'sale')->sum('quantity');
        $totalPurchases = $this->quantities()->where('type', 'purchase')->sum('quantity');
        $totalOthers = $this->quantities()->whereNull('type')->sum('quantity');

        return ($totalPurchases + $totalOthers) - $totalSales;
    }
}
