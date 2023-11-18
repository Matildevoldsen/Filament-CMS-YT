<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Products'),
            'published' => Tab::make('Published')->modifyQueryUsing(function ($query) {
                return $query->whereDate('published_at', '<=', Carbon::today());
            }),
            'draft' => Tab::make('Draft')->modifyQueryUsing(function ($query) {
                return $query->whereDate('published_at', '>', Carbon::today());
            })
        ];
    }
}
