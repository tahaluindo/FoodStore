<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Purchase;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class avgTotFatM13to15Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
        ->setTitle('Males Ages 13 to 15')
        ->setHeight(240)
        ->addData('Average Calorie', [
            round(Purchase::whereHas('student', function ($query) {
                $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(15), Carbon::now()->subYear(13)]);
            })->whereBetween('created_at', ['2022-08-01', '2022-11-30'])
                ->avg('totalTotFat'), 2),
            round(Purchase::whereHas('student', function ($query) {
                $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(15), Carbon::now()->subYear(13)]);
            })->whereBetween('created_at', ['2022-12-01', '2023-03-31'])
                ->avg('totalTotFat'), 2),
            round(Purchase::whereHas('student', function ($query) {
                $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(15), Carbon::now()->subYear(13)]);
            })->whereBetween('created_at', ['2023-04-01', '2023-06-30'])
                ->avg('totalTotFat'), 2),
            round(Purchase::whereHas('student', function ($query) {
                $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(15), Carbon::now()->subYear(13)]);
            })->whereBetween('created_at', ['2023-07-01', '2023-07-31'])
                ->avg('totalTotFat'), 2)
        ])
        ->setXAxis(['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])
        ->setToolBar(true);
    }
}
