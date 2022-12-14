<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Purchase;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class kcalM10to12PieChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $caloriesConsumed = round((Purchase::whereHas('student', function ($query) {
            $query->where('sex', 'M')->whereBetween('birthDate', [Carbon::now()->subYear(12), Carbon::now()->subYear(10)]);
        })
        ->avg('totalKcal') * 100) / 2060);
        return $this->chart->donutChart()
            ->addData([
                $caloriesConsumed,
                100 - $caloriesConsumed
            ])
            ->setLabels(['Consumed', 'Left'])
            ->setToolBar(true);
    }
}
