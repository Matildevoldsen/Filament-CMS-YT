<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Posts'),
            'published' => Tab::make('Published')->modifyQueryUsing(function ($query) {
                return $query->where('is_published', true);
            }),
            'draft' => Tab::make('Draft')->modifyQueryUsing(function ($query) {
                return $query->where('is_published', false);
            }),
            'featured' => Tab::make('Featured')->modifyQueryUsing(function ($query) {
                return $query->where('is_featured', true);
            })
        ];
    }
}
