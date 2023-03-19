<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Settings extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';
 
}
