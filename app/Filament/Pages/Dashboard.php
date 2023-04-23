<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PostChart;
use App\Filament\Widgets\TotalPost;
use App\Filament\Widgets\TotalUser;
use App\Filament\Widgets\UserChart;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            TotalUser::class,
            TotalPost::class,
            UserChart::class,
            PostChart::class,
        ];
    }
}
