<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApartmentResource\Pages;
use App\Filament\Resources\ApartmentResource\RelationManagers;
use App\Models\Apartment;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApartmentResource extends Resource
{
    protected static ?string $model = Apartment::class;

    protected static ?string $navigationGroup = 'Houses';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('city')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(10)
                            ->columnSpanFull(),
                    ])->columnSpan(8)->columns(2),
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->required()
                            ->options(Category::all()->pluck('name', 'id'))
                            ->label('Category'),

                        Forms\Components\FileUpload::make('images')
                            ->required()
                            ->image()
                            ->multiple(),
                    ])->columnSpan(4),
                Section::make('Price and Main Features')
                    ->schema([
                        Forms\Components\TextInput::make('price_per_month')
                            ->required()
                            ->prefixIcon('heroicon-o-banknotes')
                            ->numeric(),
                        Forms\Components\TextInput::make('number_of_rooms')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('number_of_bedrooms')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('number_of_bathrooms')
                            ->required()
                            ->numeric(),

                    ])->columns(4),

                Section::make('Services')
                    ->schema([
                        Forms\Components\Toggle::make('cctv_available')
                            ->required(),
                        Forms\Components\Toggle::make('borehole_available')
                            ->required(),
                        Forms\Components\Toggle::make('parking_available')
                            ->required(),
                        Forms\Components\Toggle::make('internet_connection')
                            ->required(),
                        Forms\Components\Toggle::make('solar_system')
                            ->required(),
                        Forms\Components\Toggle::make('swimming_pool')
                            ->required(),
                    ])->columns(3),




            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->description(fn (Apartment $record): string => $record->name),
               
                Tables\Columns\TextColumn::make('number_of_rooms')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_bedrooms')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('number_of_bathrooms')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price_per_month')
                    ->searchable(),
                Tables\Columns\IconColumn::make('cctv_available')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('borehole_available')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('parking_available')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('internet_connection')
                    ->boolean(),
                Tables\Columns\IconColumn::make('solar_system')
                    ->boolean(),
                Tables\Columns\IconColumn::make('swimming_pool')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListApartments::route('/'),
            'create' => Pages\CreateApartment::route('/create'),
            'view' => Pages\ViewApartment::route('/{record}'),
            'edit' => Pages\EditApartment::route('/{record}/edit'),
        ];
    }
}
