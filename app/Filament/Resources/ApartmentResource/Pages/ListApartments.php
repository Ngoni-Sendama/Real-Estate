<?php

namespace App\Filament\Resources\ApartmentResource\Pages;

use Filament\Actions;
use App\Models\Category;
use App\Models\Apartment;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ApartmentResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListApartments extends ListRecords
{
    protected static string $resource = ApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        $tabs = [
            'All' => Tab::make('All')->query(function () {
                // Fetch all apartments
                return Apartment::query(); // return query builder instance
            }),
        ];
    
        $categories = Category::all();
    
        foreach ($categories as $category) {
            $tabs['Category_' . $category->id] = Tab::make()
                ->label($category->name)
                ->query(function () use ($category) {
                    // Fetch apartments belonging to this category
                    return $category->apartments()->getQuery(); // return query builder instance
                });
        }
    
        return $tabs;
    }
    
}
