<?php

namespace App\Filament\Widgets;

use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserChart extends LineChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Chart';

    protected int|string|array $columnSpan = 2;

    protected static ?string $maxHeight = '400px';

    protected function getHeading(): string
    {
        return 'Clients';
    }

    protected function getData(): array
    {
        $data = Trend::query(User::query()->role('client'))
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Clients',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
