<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PostChart extends LineChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Chart';

    protected int|string|array $columnSpan = 2;

    protected static ?string $maxHeight = '400px';

    protected function getHeading(): string
    {
        return 'Posts';
    }

    protected function getData(): array
    {
        $data = Trend::model(Post::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
