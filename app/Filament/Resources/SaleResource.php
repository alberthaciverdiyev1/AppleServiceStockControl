<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Satış';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->options(function () {
                        return Product::whereNull('deleted_at')->get()
                            ->mapWithKeys(function ($product) {
                                return [
                                    $product->id => ($product->part->brand->name ?? ($product->model->brand->name .' '. $product->model->name)) . ' ' .( $product->part->model->name ?? '') . ' ' . ($product->part->name ?? ''),
                                ];
                            })->toArray();
                    })
                    ->afterStateUpdated(function ($state, $set) use ($form) {
                        $product = Product::find($state);
                        if ($product) {
                            $set('price', $product->selling_price);
                        }
                    })
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->label('Müştəri')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
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
                    })->prefix('₼'),
                Forms\Components\Textarea::make('note'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_id')
                    ->getStateUsing(fn($record) => $record->productName())
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
