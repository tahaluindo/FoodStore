<?php

namespace App\Charts;

use App\Models\Bmi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class bmiCount4thQtrPieChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $underweight = 0;
        $normal = 0;
        $overweight = 0;
        $obese = 0;

        $BMIs = Bmi::get(['Q4BMI'])->toArray();
        foreach ($BMIs as $BMI) {
            if ($BMI['Q4BMI'] < 18.5) {
                $underweight++;
            } else if ($BMI['Q4BMI'] >= 18.5 && $BMI['Q4BMI'] < 25) {
                $normal++;
            } else if ($BMI['Q4BMI'] >= 25 && $BMI['Q4BMI'] < 29.9) {
                $overweight++;
            } else if ($BMI['Q4BMI'] >= 30) {
                $obese++;
            }
        }
        return $this->chart
            ->pieChart()
            ->addData([
                $underweight,
                $normal,
                $overweight,
                $obese,

            ])
            ->setLabels(['Underweight', 'Normal', 'Overweight', 'Obese']);
    }
}
