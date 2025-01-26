<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Quantity;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        Quantity::create([
            'product_id' => $this->record->id,
            'quantity' => $this->data["quantity"],
            'type' => null,
        ]);
    }
}
