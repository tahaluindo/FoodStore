<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Purchase;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class avgSugarM6to9Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setHeight(240)
            ->addData('Average Added Sugar', [
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', ['2022-08-01', '2022-11-30'])
                    ->avg('totalSugar'), 2),
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', ['2022-12-01', '2023-03-31'])
                    ->avg('totalSugar'), 2),
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', ['2023-04-01', '2023-06-30'])
                    ->avg('totalSugar'), 2),
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', ['2023-07-01', '2023-07-31'])
                    ->avg('totalSugar'), 2)
            ])
            ->setXAxis(['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])
            ->setToolBar(true);
    }
}
