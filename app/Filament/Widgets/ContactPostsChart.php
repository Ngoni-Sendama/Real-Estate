<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Flowframe\Trend\Trend;

class ContactPostsChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'contactPostsChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ContactPostsChart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        // Fetch trend data for contacts per month
        $trend = Trend::model(Contact::class)
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
            'colors' => ['#0024d9'],
        ];
    }
}
