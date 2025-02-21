<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use App\Filament\Resources\PurchaseResource;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Quantity;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;

    protected function afterCreate(): void
    {
        Quantity::create([
            'product_id' => $this->record->product_id,
            'quantity' => $this->record->quantity,
            'type' => 'purchase',
        ]);

        Payment::create([
            'purchase_id' => $this->record->id,
            'amount'=> $this->record->quantity * $this->record->price,
            'type' => $this->data['pay_type'] ,
            'sale_or_purchase' => 'purchase'
        ]);

        $product = Product::find($this->record->product_id);
        if ($product) {
            $product->update([
                'quantity' => $product->quantity + $this->record->quantity,
            ]);
        }
    }
}
