<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use App\Filament\Resources\PurchaseResource;
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
    }
}
