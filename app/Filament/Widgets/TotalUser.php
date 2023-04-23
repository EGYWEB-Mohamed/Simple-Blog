<?php

namespace App\Filament\Widgets;

use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Carbon;

class TotalUser extends BaseWidget
{
    use HasWidgetShield;

    protected function getCards(): array
    {
        return [
            Card::make('Client Registered Today', User::role('client')->where('created_at', Carbon::today())->count()),
            Card::make('All Client', User::role('client')->count()),
        ];
    }
}
