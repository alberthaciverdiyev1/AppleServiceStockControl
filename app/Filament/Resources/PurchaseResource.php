<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Brand;
use App\Models\Part;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Alış';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->options(function () {
                        return Product::whereNull('deleted_at')->get()
                            ->mapWithKeys(function ($product) {
                                return [
                                    $product->id => $product->part->brand->name . ' ' . $product->part->model->name . ' ' . $product->part->name,
                                ];
                            })->toArray();
                    })
                    ->afterStateUpdated(function ($state, $set) use ($form) {
                        $product = Product::find($state);
                        if ($product) {
                            $set('price', $product->buying_price);
                        }
                    })
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('seller_id')
                    ->options(function () {
                        return Seller::whereNull('deleted_at')->pluck('name', 'id')->toArray();
                    })
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),

                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\Select::make('pay_type')
                    ->options([
                        'cash' => 'Nağd',
                        'debt' => 'Nisyə'
                    ])->default('cash'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(function ($get) {
                        return $get('price');
                    })
                    ->prefix('₼'),
                Forms\Components\Textarea::make('note'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('purchase.product_name')
                    ->getStateUsing(fn($record) => $record->productName())
                    ->sortable(),
                Tables\Columns\TextColumn::make('seller_id')
                    ->getStateUsing(fn($record) => $record->seller->name)
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('azn')
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
