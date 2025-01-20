<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Brand;
use App\Models\Part;
use App\Models\Product;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $sellers = Seller::all()->pluck('name', 'id')->toArray();
        $brands = Brand::all()->pluck('name', 'id')->toArray();
        $parts = Part::all()->pluck('name', 'id')->toArray();
        return $form
            ->schema([
                Forms\Components\Select::make('brand_id')
                    ->options($brands)
                    ->required()
                    ->native(false)
                    ->afterStateUpdated(function ($state, $set) use ($form) {
                        $parts = Part::where('brand_id', $state)->pluck('name', 'id')->toArray();
                        $set('part_id', null);
                        $set('parts', $parts);
                    }),
                Forms\Components\Select::make('part_id')
                    ->options(function ($get) {
                        return $get('parts') ?: [];
                    })
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('seller_id')
                    ->options($sellers)
                    ->required()
                    ->native(false)
                    ->label('Seller')
                    ->placeholder('Select a seller'),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('buying_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('selling_price')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brand.name')
                    ->sortable()
                    ->searchable()
                    ->label('Brend'),
                Tables\Columns\TextColumn::make('part.name')
                    ->searchable()
                    ->sortable()
                    ->label('Hisse'),
                Tables\Columns\TextColumn::make('seller.name')
                    ->searchable()
                    ->sortable()
                    ->label('Satici'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Ad'),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label('Kod'),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Say')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('buying_price')
                    ->numeric()
                    ->sortable()
                    ->label('Alis Qiymeti'),
                Tables\Columns\TextColumn::make('selling_price')
                    ->numeric()
                    ->sortable()
                    ->label('Satis Qiymeti')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Yaradilma Tarixi'),

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
