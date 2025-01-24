<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'brand_id'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function parts(){
        return $this->hasMany(Part::class);
    }
}
