<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Company extends Page
{
    protected static ?string $navigationGroup = 'Settings';

    protected static string $view = 'filament.pages.company';
}
