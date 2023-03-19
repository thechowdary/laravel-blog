<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Post;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PostsStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All Posts', Post::all()->count()),
            Card::make('Published', Post::where('is_published',1)->count() ),
            Card::make('Today\'s Posts', Post::whereBetween('created_at', [Carbon::parse('1 year ago'),Carbon::now()])->count()),
        ];
    }
}
