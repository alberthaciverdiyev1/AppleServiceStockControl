<?php

namespace App\Filament\Resources\SaleResource\Pages;

use App\Filament\Resources\SaleResource;
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
    }
}
