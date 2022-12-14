<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Purchase;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class avgCalorieM6to9Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('Males Ages 6 to 9')
            ->setHeight(240)
            ->addData('Average Calorie', [
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', ['2022-11-17', '2022-11-19'])
                    ->avg('totalKcal'), 2),
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', ['2022-11-20', '2022-11-22'])
                    ->avg('totalKcal'), 2),
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', ['2022-11-23', '2022-11-25'])
                    ->avg('totalKcal'), 2),
                round(Purchase::whereHas('student', function ($query) {
                    $query->where('sex', 'M')->whereBetween('birthdate', [Carbon::now()->subYear(9), Carbon::now()->subYear(6)]);
                })->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d'), Carbon::today()->format('Y-m-d')])
                    ->avg('totalKcal'), 2)
            ])
            ->setXAxis(['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])
            ->setToolBar(true);
    }
}