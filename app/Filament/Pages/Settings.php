<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Filament\Resources\PostResource\Widgets\LatestPosts;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Settings extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';
 
    public static function getWidgets(): array
    {
        return [
            LatestPosts::class,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LatestPosts::class,
        ];
    }
}
