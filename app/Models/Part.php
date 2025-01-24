<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand_id','model_id'];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function model(){
        return $this->belongsTo(ProductModel::class);
    }
}
