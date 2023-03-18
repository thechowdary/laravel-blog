<?php

namespace App\Filament\Resources\PostResource\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;

class LatestPosts extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        // ...
        return Post::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('title')
                ->label('Post Title'),
        ];
    }
}
