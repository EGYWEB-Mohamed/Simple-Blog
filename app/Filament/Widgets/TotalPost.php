<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Carbon;

class TotalPost extends BaseWidget
{
    use HasWidgetShield;

    protected function getCards(): array
    {
        return [
            Card::make('Today Posts', Post::where('created_at', Carbon::today())->count()),
            Card::make('All Posts', Post::count()),
        ];
    }
}
