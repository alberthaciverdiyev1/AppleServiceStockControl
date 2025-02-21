<?php

namespace App\Filament\Resources\SaleResource\Pages;

use App\Filament\Resources\SaleResource;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Quantity;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;
    protected function afterCreate(): void
    {

        Quantity::create([
            'product_id' => $this->record->product_id,
            'quantity' => $this->record->quantity,
            'type' => 'sale',
        ]);
        Payment::create([
            'sale_id' => $this->record->id,
            'purchase' => null,
            'amount'=> $this->record->quantity * $this->record->price,
            'type' => $this->data['pay_type'] ,
            'sale_or_purchase' => 'sale'
        ]);

        $product = Product::find($this->record->product_id);
        if ($product) {
            $product->update([
                'quantity' => $product->quantity - $this->record->quantity,
            ]);
        }
    }
}
