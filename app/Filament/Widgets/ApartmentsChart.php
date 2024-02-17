<?php

namespace App\Filament\Widgets;

use App\Models\Apartment;
use Flowframe\Trend\Trend;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ApartmentsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'apartmentsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ApartmentsChart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        // Fetch trend data for contacts per month
        $trend = Trend::model(Apartment::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        // Assuming $trend is correctly fetched and contains required data
        $months = $trend->pluck('date')->map(function ($date) {
            // Check if $date is already a DateTime object
            if ($date instanceof \DateTime) {
                return $date->format('M');
            }

            // If $date is a string, attempt to parse it into a DateTime object
            try {
                return (new \DateTime($date))->format('M');
            } catch (\Exception $e) {
                // If parsing fails, return null or handle the error accordingly
                return null;
            }
        });

        $contactCounts = $trend->pluck('aggregate');

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'ContactChart',
                    'data' => $contactCounts,
                ],
            ],
            'xaxis' => [
                'categories' => $months->filter()->values()->toArray(),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#080815'],
        ];
    }
}
