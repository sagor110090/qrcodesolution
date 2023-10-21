<?php

namespace App\Charts;

use App\Models\Analytics;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CountryVisitor
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $analytics = Analytics::selectRaw('count(*) as total, country')
                    ->groupBy('country')
                    ->orderBy('total', 'desc')
                    ->limit(6)
                    ->pluck('total', 'country');
        $countries = [];
        $data = [];

        foreach ($analytics as $key => $value) {
            $countries[] = $key;
            $data[] = $value;
        }



        return $this->chart->barChart()
            ->setTitle('Country Visitor')
            ->setSubtitle('Visitors and Page Views by Country')
            ->addData('Visitors', $data)
            ->setXAxis($countries);
    }
}
