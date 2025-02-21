<?php
namespace App\Http\Helpers;

use App\Models\Product;

class PriceHelper
{
    public static function calculatePrice($productId, $quantity, $payType)
    {
        $product = Product::find($productId);
        $quantity = $quantity ?: 1;

        if (!$product) {
            return 0;
        }

        $price = $product->selling_price * $quantity;

//        if ($payType === 'debt') {
//            $price *= 1.05;
//        }
//dd($price);
        return round($price, 2);
    }
}
